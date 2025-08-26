<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_message extends CI_Model
{

    function browse($user_id, $userPage, $status = '', $conversation = false, $count = 0)
    {
        if ($status != '') {
            $this->db->where('status', $status);
        }

        if ($conversation == true) {
            //$this->db->group_by('conversation');
        }

        $data = $this->db->from('(
									SELECT
									user.user_id as id, (CASE WHEN message.user_id > mess_to THEN CONCAT(message.user_id,\'::\',mess_to) ELSE CONCAT(mess_to,\'::\',message.user_id) END) as conversation ,CONCAT(user_fname,\' \', user_lname) as name, user_image as photo, mess_text as text, mess_status as status, user_online as online, mess_created as created, \'sent\' as type, user_type as role
									FROM
									`message`
									INNER JOIN `user` ON `user`.`user_id` = `mess_to`
									WHERE `message`.`user_id` = \'' . $user_id . '\'

									UNION

									SELECT
									user.user_id as id, (CASE WHEN message.user_id > mess_to THEN CONCAT(message.user_id,\'::\',mess_to) ELSE CONCAT(mess_to,\'::\',message.user_id) END) as conversation, CONCAT(user_fname,\' \', user_lname) as name, user_image as photo, mess_text as text, mess_status as status, user_online as online, mess_created as created, \'recieved\' as type, user_type as role
									FROM
									`message`
									INNER JOIN `user` ON `user`.`user_id` = `message`.`user_id`
									WHERE `message`.`mess_to` = \'' . $user_id . '\'

								) messages')->order_by('created desc');

        if ($count == 0) {
            $this->db->limit(50, $userPage * 50);
        } else {
            $this->db->limit($count);
        }
        return $this->db->get()->result_array();
    }

    function get($userPage, $userUser = 0)
    {
        $data = $this->db->from('(
									SELECT
									user.user_id as id, CONCAT(user_fname,\' \', user_lname) as name, user_image as photo, mess_text as text, mess_status as status, mess_created as created, \'sent\' as type
									FROM
									`message`
									INNER JOIN `user` ON `user`.`user_id` = `mess_to`
									WHERE `message`.`user_id` = \'' . $userUser . '\' and mess_to = ' . $this->session->userdata('user_id') . '

									UNION

									SELECT
									user.user_id as id, CONCAT(user_fname,\' \', user_lname) as name, user_image as photo, mess_text as text, mess_status as status, mess_created as created, \'recieved\' as type
									FROM
									`message`
									INNER JOIN `user` ON `user`.`user_id` = `message`.`user_id`
									WHERE `message`.`mess_to` = \'' . $userUser . '\' and `message`.`user_id` = ' . $this->session->userdata('user_id') . '

								) messages')->order_by('created desc');
        $this->db->limit(50, $userPage * 50);
        return array('data' => $this->db->get()->result_array());
    }

    function insert($user_id, $to, $message)
    {
        $data['user_id'] = $user_id != '' ? $user_id : $this->session->userdata('user_id');
        $data['mess_to'] = $to;
        $data['mess_text'] = $message;
        $data['mess_created'] = time();
        $this->db->insert('message', $data);
        return array('id' => $this->db->insert_id, 'data' => $data);
    }

    function conversations($userId)
    {
        $conversations = $this->db
            ->select('conversation')
            ->distinct()
            ->from('conversation')
            ->where('user_id', $userId)
            ->or_where('mess_to', $userId)
            ->get()
            ->result_array();
        $return = array();
        foreach ($conversations as $conversation) {
            $return[$conversation['conversation']] = $this->db->select('mess_id, mess_text, mess_status, mess_created, user_fname, user_lname, user_image')->from('conversation')->join('user', 'user.user_id = conversation.user_id')->where('conversation', $conversation['conversation'])->get()->result_array();
        }
        return $return;
    }

    function conversations_recieved($userId)
    {
        $conversations = $this->db
            ->select('conversation')
            ->distinct()
            ->from('conversation')
            ->where('mess_to', $userId)
            ->where('mess_status !=', 'r')
            ->get()
            ->result_array();
        $return = array();
        foreach ($conversations as $conversation) {
            $return[$conversation['conversation']] = $this->db->select('mess_id, mess_text, mess_status, mess_created, user_fname, user_lname, user_image')->from('conversation')->join('user', 'user.user_id = conversation.user_id')->where('conversation', $conversation['conversation'])->get()->result_array();
        }
        return $return;
    }

    function conversation_list($userId, $page = 0)
    {
        if ($page > 0) {
            $this->db->limit(50, $page * 50);
        }
        $conversations = $this->db
            ->select('conversation')
            ->distinct()
            ->from('conversation')
            ->where('user_id', $userId)
            ->or_where('mess_to', $userId)
            ->get()
            ->result_array();
        $return = array();
        $query = $this->db->last_query();
        $query = substr($query, 0, strpos($query, 'LIMIT'));
        $query = substr($query, strpos($query, 'FROM'));
        $count = $this->db->query('SELECT COUNT(*) as count ' . $query)->row()->count;
        foreach ($conversations as $conversation) {
            $other_user = str_replace('::', '', str_replace($userId, '', $conversation['conversation']));
            $tmp = $this->db->select('mess_text as text, mess_status as status, mess_created as created')->from('conversation')->where('conversation', $conversation['conversation'])->get()->row_array();
            $tmp['convo'] = $conversation['conversation'];
            $obj_other_user = $this->db->select('user_id as user, user_fname as fname, user_lname as lname, user_image as image')->from('user')->where('user_id', $other_user)->get()->row_array();
            if(is_array($obj_other_user)) {
                $return[] = array_merge($tmp, $obj_other_user);
            }
        }
        return array('data' => array('total' => $count, 'data' => $return));
    }

    function mark($conv)
    {
        $users = explode("::", $conv);
        $this->db->where('user_id != ' . $this->session->userdata('user_id') . ' AND (( user_id = ' . $users[0] . ' AND mess_to = ' . $users[1] . ' ) OR ( user_id = ' . $users[1] . ' AND mess_to = ' . $users[0] . ' ))', '', FALSE);
        $this->db->update('message', array('mess_status' => 'r'));
    }

    function message($convo, $page)
    {
        $data = $this->db
            ->select('conversation.conversation, conversation.mess_created AS time, conversation.mess_id AS ID, conversation.mess_text AS message, conversation.mess_to AS TO, CONCAT(user.user_fname, \' \', user.user_lname) AS name, user.user_image AS image')
            ->from('conversation')
            ->join('user', 'user.user_id = conversation.user_id')
            ->where('conversation', $convo)
            ->order_by('mess_created desc')
            ->get()->result_array();
        $this->db->limit(50, $page * 50);

        $query = $this->db->last_query();
        $query = substr($query, 0, strpos($query, 'LIMIT'));
        $query = substr($query, strpos($query, 'FROM'));
        $count = $this->db->query('SELECT COUNT(*) as count ' . $query)->row()->count;
        return array('data' => array('total' => $count, 'data' => $data));
    }

}
