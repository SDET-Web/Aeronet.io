<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller
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
        $this->load->helper('url');
    }

    public function index()
    {

    }

    public function dashboard()
    {
        is_logged_in_redirect();
        set_title('My Dashboard');
        $this->load->model('Model_user');
        $data = $this->Model_user->get_member($this->session->userdata('user_id'));
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        if ($this->session->userdata('user_type') != 'd') {
            $this->load->view('main_backend', array('view' => 'member/dashboard', 'data' => array('data' => $data)));
        } else {
            $this->load->view('main_backend', array('view' => 'department/dashboard', 'data' => array('data' => $data)));
        }
    }

    public function setting()
    {
        is_logged_in_redirect();
        set_title('Edit Profile');
        $this->load->model('Model_user');
        $this->Model_user->update();
        $data = $this->Model_user->get_member($this->session->userdata('user_id'));
        if($data['user_type'] == 'd') {
            $data = array_merge($data, $this->Model_user->get_department_aircrafts($this->session->userdata('user_id')));
        } else {
            $data = array_merge($data, $this->Model_user->get_pilot_flights($this->session->userdata('user_id')), $this->Model_user->get_pilot_extra_info($this->session->userdata('user_id')));
        }

        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        if ($this->session->userdata('user_type') != 'd') {
            $this->load->view('main_backend', array('view' => 'member/setting', 'data' => array('data' => $data)));
        } else {
            $this->load->view('main_backend', array('view' => 'department/setting', 'data' => array('data' => $data)));
        }
    }
    
     public function ResumeUpload()
    {
        is_logged_in_redirect();
        $this->load->model('Model_user');
        $this->Model_user->update();        
        $data = $this->Model_user->get_member($this->session->userdata('user_id'));
        $data = array_merge($data, $this->Model_user->get_pilot_flights($this->session->userdata('user_id')), $this->Model_user->get_pilot_extra_info($this->session->userdata('user_id')));
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $this->load->view('main_backend', array('view' => 'member/ResumeUpload', 'data' => array('data' => $data)));
    }

    public function follow($connId, $userId, $type)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $this->load->model('Model_connection');
        json_render($this->Model_connection->insert($userId, $connId, $type, 'p'));
    }
    
    public function invite($connId, $userId, $type)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $this->load->model('Model_connection');
        json_render($this->Model_connection->insert($userId, $connId, 'i', 'p'));
    }

    public function unfollow($connId, $userId)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $this->load->model('Model_connection');
        json_render($this->Model_connection->delete($userId, $connId));
    }

    public function status($userId, $connId, $status)
    {  
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
       $this->load->model('Model_connection');
       json_render($this->Model_connection->set_status($userId, $connId, $status));
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
        $this->db->where('conversation', $conv);
        $page = 0;
        if ($this->input->get('page') != '') {
            $page = $this->input->get('page');
        }

        json_render($this->Model_message->message($userId, $page));
    }

    public function profile($id)
    {
        is_logged_in_redirect();    
        set_title('My Profile');
        if ($data['user_type'] != 'd') {
            $data = $this->Model_user->get_member($id);
            set_title($data['user_fname'] . ' ' . $data['user_lname']);
            $data = array_merge($data, $this->Model_user->get_pilot_flights($id), $this->Model_user->get_pilot_extra_info($id));
            $this->load->view('main_backend', array('view' => 'member/profile', 'data' => array('data' => $data)));
        } else {
            
            $data = $this->Model_user->get_member($id);
            set_title($data['user_fname'] . ' ' . $data['user_lname']);
            $this->load->view('main_backend', array('view' => 'department/profile', 'data' => array('data' => $data)));
        }
    }

    public function search($type)
    {
        is_logged_in_redirect();
        $data = $this->Model_user->search('', $this->session->userdata('user_id'));
        $this->load->view('main_backend', array('view' => 'member/search', 'data' => array('data' => $data)));
    }

    public function search_advanced()
    {
        is_logged_in_redirect();
        $data = array();
        if ($this->input->post('action') != '') {
            $data = $this->Model_user->search_advanced($this->session->userdata('user_id'));
        }
        $data = array_merge($data, $this->Model_user->get_member($this->session->userdata('user_id')));
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $this->load->view('main_backend', array('view' => 'member/search/advanced', 'data' => array('data' => $data)));
    }

    public function noti_ready($id)
    {
        $this->Model_post->notification_read($id);
    }

    public function search_directory()
    {
        set_title('Search Directory');
        $this->load->library('googlemaps');
        $this->load->model('model_user', '', TRUE);
        $config['center'] = $this->input->post('location') == '' ? '26.188511, -80.104988' : $this->input->post('location');
        $config['zoom'] = $this->input->post('location') == '' ? 'auto' : '12';
        $config['apiKey'] = GOOGLE_API_KEY;
        $config['map_type'] = 'ROADMAP';
        $config['geocodeCaching'] = TRUE;
        $config['minifyJS'] = TRUE;
        $this->googlemaps->initialize($config);
        $nearestloc = $this->Model_user->search_directory('33308');
       // echo('test'.count($nearestloc));
        if (count($nearestloc) > 0) {
            foreach ($nearestloc as $locs) {
                $address = ($locs->type != 'd' ? ($locs->address == '' ? $locs->zip : $locs->address) : ($locs->state . ' ' . $locs->city));
                //echo('<br/>testk'.$address);
                $marker = array();
                $marker['position'] = $address;
                $marker['icon'] = RIZ_ASSETS . ($locs->type != 'd' ? 'call.png' : 'call2.png');
                $marker['infowindow_content'] = '<font style="color:#333333 !important; font-weight:bold !important;"><img src="' . get_user_pic_url($locs->image, $locs->type) . '" height="50" /><br /><strong>' . $locs->name . '<br>' . $address . '</strong></font><br><font style="color:#333333 !important;"><br><a href="' . site_url(($locs->type == 'p' ? 'pilot' : 'department') . '/' . $locs->id . '/profile/') . '">View Profile</a>';
                //$this->googlemaps->add_marker($marker);
                $ftime = '';
            }
        }
        // Create the map
       $data = array();
       $data['map'] = $this->googlemaps->create_map();
        $this->load->view('main', array('view' => 'member/search_directory', 'data' => $data));

    }

    public function invitation()
    {
        is_logged_in_redirect();
        $this->load->model('Model_user');
        $this->load->model('Model_connection');
        $this->Model_connection->send_invitation($this->session->userdata('user_id'));
        $data = $this->Model_user->get_member($this->session->userdata('user_id'));
        $contacts = $this->Model_connection->imported_contacts($this->session->userdata('user_id'));
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $this->load->view('main_backend', array('view' => 'import/department', 'data' => array('data' => $data, 'contacts' => $contacts)));
    }

    public function oauth()
    {
        $this->load->view('import/oauth');
    }
}
