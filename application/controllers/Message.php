<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller
{

    /**
     *
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Model_message');
        $this->load->model('Model_connection');
        $this->load->model('Model_user');
    }

    public function conversations($userId)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $this->load->model('Model_message');
        $page = 0;
        if ($this->input->get('page') != '') {
            $page = $this->input->get('page');
        }

        json_render($this->Model_message->conversation_list($userId, $page));
    }

    public function conversation($userId, $connId)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $this->load->model('Model_message');
        $conv = $userId . '::' . $connId;
        if ($userId < $connId) {
            $conv = $connId . '::' . $userId;
        }
        $this->Model_message->mark($conv);
        $this->db->where('conversation', $conv);
        $page = 0;
        if ($this->input->get('page') != '') {
            $page = $this->input->get('page');
        }

        json_render($this->Model_message->browse($userId, $page));
    }

    public function add($userId, $connId)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $this->load->model('Model_message');
        $this->Model_message->insert($userId, $connId, $this->input->post('message'));
        echo json_encode(array('message' => 'success'));
    }

    public function mark($convId)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $this->load->model('Model_message');
        $this->Model_message->mark($convId);
        echo json_encode(array('message' => 'success'));
    }

    public function messages($convoId)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $this->load->model('Model_message');
        $page = 0;
        if ($this->input->get('page') != '') {
            $page = $this->input->get('page');
        }
        json_render($this->Model_message->message($convoId, $page));
    }

    public function chat($convId)
    {
        is_logged_in_redirect();
        $users = explode('::', $convId);
        $otherUser = $users[0];
        if ($users[0] == $this->session->userdata('user_id')) {
            $otherUser = $users[1];
        }
        $this->load->model('Model_user');
        $data = $this->Model_user->get_member($this->session->userdata('user_id'));
        $other = $this->Model_user->get_member($otherUser);
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['convo'] = $convId;
        $this->Model_message->mark($convId);
        /*$convo = $this->db->from('conversation')->where('conversation',$convId)->get()->result_array();
        $messId = [];
        foreach($convo as $tmp){
            $messId[] = $tmp['mess_id'];
        }
        $this->db->where_in('mess_id',$messId);
        $this->db->update('message',array('mess_status'=>'r'));*/
        if ($this->session->userdata('user_type') != 'd') {
            $this->load->view('main_backend', array('view' => 'message/pilot', 'data' => array('data' => array('mainUser' => $data, 'otherUser' => $other))));
        } else {
            $this->load->view('main_backend', array('view' => 'message/pilot', 'data' => array('data' => array('mainUser' => $data, 'otherUser' => $other))));
        }
    }
}