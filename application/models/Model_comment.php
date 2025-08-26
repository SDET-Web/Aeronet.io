<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The Model_comment class is the model which includes Business Logic of all types of comment.
 *
 * @package   model
 * @version   0.01
 * @since     2016-06-27
 * @author    Rizwan Ali<riz@bitspro.com>
 */
class Model_comment extends CI_Model
{

    /**
     *
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Browse comment
     *
     * @param int $commUser
     * @param string $commStatus
     * @param string $commSort
     * @param string $commOrder
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function browse($commPage, $commUser = 0, $commPost = 0, $commStatus = '', $commTerm = '', $commSort = 'comm_created', $commOrder = 'desc', $commType = 'p')
    {
        if ($commUser != 0) {
            $this->db->where('comment.user_id', $commUser);
        }

        if ($commPost != 0) {
            $this->db->where('post_id', $commPost);
        }
        if ($commStatus != '') {
            $this->db->where('comm_status', $commStatus);
        }

        if ($commSort != '') {
            $this->db->order_by($commSort, $commOrder);
        }

        if ($commTerm != '') {
            $this->db->like('', $commTerm);
        }

        if ($commPage >= 0) {
            $this->db->limit(SITE_ROW_COUNT, $commPage * SITE_ROW_COUNT);
        }
        $this->db->where('comm_status !=', 'd');
        $data = $this->db
            ->select('comm_id AS id,comment.user_id AS user_id, CONCAT(user.user_fname,\' \',user.user_lname) AS name, user_image AS photo,post_id AS post_id,comm_text AS text,comm_created AS created')
            ->from('comment')
            ->join('user', 'user.user_id = comment.user_id')
            ->where('comm_type', $commType)
            ->get()->result_array();

        $query = $this->db->last_query();
        $query = substr($query, strpos($query, 'LIMIT'));
        $query = substr($query, strpos($query, 'FROM'));

        $count = $this->db->query('SELECT COUNT(*) as count ' . $query)->row()->count;
        return array('total' => $count, 'data' => $data);
    }

    /**
     * Search comment based on browse after applying filters
     *
     * @param int $user
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function search($user = 0)
    {
        $page = 0;
        $term = '';
        $sort = '';
        $order = 'desc';
        $status = '';
        $type = 'p';

        if ($this->input->get('page') != '') {
            $page = $this->input->get('page');
        }

        if ($this->input->get('term') != '') {
            $term = $this->input->get('term');
        }

        if ($this->input->get('sort') != '') {
            $sort = $this->input->get('sort');
        }

        if ($this->input->get('order') != '') {
            $order = $this->input->get('order');
        }

        if ($this->input->get('type') != '') {
            $type = $this->input->get('type');
        }

        return $this->browse($page, $user, $status, $term, $sort, $order, $type);
    }

    /**
     * Insert a new comment based on action variable
     *
     * @param int $commUser
     * @param mixed $input
     *
     * @return int
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function insert($input)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('text', 'Content', 'required');
        if ($this->form_validation->run() != FALSE) {
            foreach ($input as $key => $value) {
                if ($key != 'action') {
                    if (strpos($key, 'user_id') !== FALSE || strpos($key, 'post_id') !== FALSE) {
                        $data[$key] = $value;
                    } else {
                        $data['comm_' . $key] = $value;
                    }
                }
            }
            $data['comm_created'] = time();
            $this->db->insert('comment', $data);
            return array('status' => 'success', 'data' => $this->get($this->db->insert_id()));
        } else {
            return array('status' => 'error', 'data' => validation_errors());
        }
    }

    /**
     * Update comment based on provided variable and data
     *
     * @param int $commUser
     * @param mixed $input
     *
     * @return int
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function update($commUser, $commId, $input)
    {
        $data = $this->get($commId);
        if ($data['user_id'] == $commUser) {
            $this->load->library('form_validation');

            if ($this->form_validation->run() != FALSE) {
                foreach ($input as $key => $value) {
                    if ($key != 'action') {
                        if (strpos($key, 'lastlogin') !== FALSE || strpos($key, 'dob') !== FALSE) {
                            $data['comm_' . $key] = strtotime($value);
                        } else {
                            $data['comm_' . $key] = ($key == 'password' ? md5($value) : $value);
                        }
                    }
                }

                $this->db->where('comm_id', $commId);
                if ($this->db->update('comment', $data)) {
                    set_message('comm has been updated successfully');
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Delete a particular comment
     *
     * @param $commId
     *
     * @return bool
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function delete($commId)
    {
        $comment = $this->db->select('comm_status')->where('comm_id', $commId)->get();
        if ($comment->num_rows() > 0) {
            if ($comment->row()->comm_status == 'd') {
                $this->db->delete('comment', array('comm_id' => $commId));
                set_message('comm has been deleted successfully');
                return true;
            } else {
                set_message('comm has been trashed successfully');
                $this->set_status($commId, 'd');
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Get a single comment provided the id
     *
     * @param $commId
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function get($commId)
    {
        $this->db->where('comm_id', $commId);
        return $this->db
            ->select('comm_id AS id,comment.user_id AS user_id,post_id AS post_id,comm_text AS text,comm_created AS created, CONCAT(user.user_fname,\' \',user.user_lname) AS name, user.user_image as photo')
            ->from('comment')
            ->join('user', 'user.user_id = comment.user_id')
            ->get()->row_array();
    }

    /**
     * Update status of comment
     *
     * @param $id
     * @param $status
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function set_status($id, $status)
    {
        $data['comm_status'] = $status;
        $this->db->where('comm_id', $id);
        if ($this->db->update('comment', $data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Handle submission for comment
     *
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function submit()
    {
        if ($this->input->get_post('action') == 'delete_comm') {
            if ($this->input->get_post('id') != '') {
                return $this->delete($this->input->get_post('id'));
            }
        } else if ($this->input->get_post('action') == 'update_comm') {
            if ($this->input->get_post('id') != '') {
                return $this->update($this->session->userdata('user_id'), $this->input->get_post('id'), $_POST);
            }
        } else if ($this->input->get_post('action') == 'add_comm') {
            return $this->insert($this->session->userdata('user_id'), $_POST);
        } else if ($this->input->get_post('action') == 'status_comm') {
            if ($this->input->get_post('id') != '' && $this->input->get_post('status') != '') {
                return $this->set_status($this->input->get_post('id'), $this->input->get_post('status'));
            }
        } else if ($this->input->get_post('action') == 'search_comm' || $this->input->get_post('action') == 'search_comm') {
            return $this->search($this->session->userdata('user_id'));
        }
    }

}
?>
