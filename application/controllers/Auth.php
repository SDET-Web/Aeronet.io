<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public $linkedin_local = '';

   // function __construct()
   // {
       // parent::__construct();

        // Load linkedin config
     //   $this->load->config('linkedin');
        /*
        $this->load->library('linkedin');

        $config['base_url']             =   'http://localhost/register/pilot/signup';
        $config['callback_url']         =   'http://localhost/register/pilot/linkedin/';

        // nauman linkedin info
        $config['linkedin_access']      =   '81u2dk4nfaytfc';
        $config['linkedin_secret']      =   'WbHYwj9Rus6nCvCf';

        // flight linkedin info
        //$config['linkedin_access']      =   '81y6xule0r5ege';
        //$config['linkedin_secret']      =   'IyUJKon8jBVE4Trj';


        # First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
        $this->linkedin_local = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['callback_url'] );

        /*include_once APPPATH."libraries/OAuth.php";

        $this->data['consumer_key'] = $this->config->item('api_key');
        $this->data['consumer_secret'] = $this->config->item('secret_key');
        //$this->data['callback_url'] = 'http://dev.hireexpertprogrammers.com/register/pilot/linkedin/';
        $this->data['callback_url'] = 'http://localhost/register/pilot/linkedin/';

        $this->load->library('linkedin', $this->data);
        */

        //Load user model
        // $this->load->model('user');
    //}

   /* public function linkedinsignup($ID)
    {
        # Now we retrieve a request token. It will be set as $linkedin->request_token
        $this->linkedin_local->getRequestToken();
        $_SESSION['requestToken'] = serialize($this->linkedin_local->request_token);

        # With a request token in hand, we can generate an authorization URL, which we'll direct the user to
        //echo "Authorization URL: " . $linkedin->generateAuthorizeUrl() . "\n\n";
        header("Location: " . $this->linkedin_local->generateAuthorizeUrl());

        /*
        $token = $this->linkedin->get_request_token();
        $oauth_data = array(
            'oauth_request_token' => $token['oauth_token'],
            'oauth_request_token_secret' => $token['oauth_token_secret'],
            'ID' => $ID
        );
        $this->session->set_userdata($oauth_data);
        $request_link = $this->linkedin->get_authorize_URL($token);
        header("Location: " . $request_link);
        */

   // }

    /*public function logout() {
        //Unset token and user data from session
        $this->session->unset_userdata('oauth_status');
        $this->session->unset_userdata('userData');

        //Destroy entire session
        $this->session->sess_destroy();

        // Redirect to login page
        redirect('/user_authentication');
    }*/


    public function register($action = '', $ID = '')
    {
        set_title('Talent Registration');
        $this->load->model('Model_auth');
        $this->load->model('Model_user');
        $this->load->model('Model_directory');
        $this->load->model('Model_email');

        if ($action == '') {
            $this->load->view('main_home', array('view' => 'auth/pilot/register'));           
        } else if ($action == 'confirm') {
            $pilots = $this->Model_auth->register_pilot($ID);
            $this->load->view('main', array('view' => 'auth/pilot/confirm', 'data' => array('pilots' => $pilots)));
       // Manuall Signup
        } else if ($action == 'phone_check') {
          $this->load->view('main', array('view' => 'auth/pilot/phone_check', 'data' => array('pilots' => 'Anonymus')));
        } else if ($action == 'register_new') {  
          $pilots = $this->Model_auth->register_pilot_new($ID);  
          $this->load->view('main', array('view' => 'auth/pilot/phone_check', 'data' => array('pilot' => 'Anonymus', 'signup_try' => $try['count'], 'msg' => $try['msg'])));                     
        } else if ($action == 'verify-phone-check') {
             $pilots = $this->Model_auth->register_pilot_new($ID); 
             $this->load->view('main', array('view' => 'auth/pilot/verify-phone-check', 'data' => array('pilot' => 'Anonymus', 'signup_try' => $try['count'], 'msg' => $try['msg'])));
        } else if ($action == 'signup-new') {
             $pilots = $this->Model_auth->register_pilot_new($ID); 
             $this->load->view('main', array('view' => 'auth/pilot/signup-new', 'data' => array('pilot' => 'Anonymus', 'signup_try' => $try['count'], 'msg' => $try['msg'])));
         // End Manuall Signup      
        } else if ($action == 'identify') {
            $pilot = $this->Model_directory->get_pilot($ID);
            $is_user_type_pilot = check_pilot_certification($pilot['certificates']);
            if ($is_user_type_pilot) {
                $pilot['user_type'] = 'P';
            } else {
                $pilot['user_type'] = 'Other';
            }
                $this->load->view('main', array('view' => 'auth/pilot/identify', 'data' => array('pilot' => $pilot, 'signup_try' => $try['count'], 'msg' => $try['msg'])));
        
            } else if ($action == 'phone') {
            $pilot = $this->Model_directory->get_pilot($ID);
            $is_user_type_pilot = check_pilot_certification($pilot['certificates']);
            if ($is_user_type_pilot) {
                $pilot['user_type'] = 'P';
            } else {
                $pilot['user_type'] = 'Other';
            }
                $try = $this->Model_auth->register_pilot($ID);
                $this->load->view('main', array('view' => 'auth/pilot/phone', 'data' => array('pilot' => $pilot, 'signup_try' => $try['count'], 'msg' => $try['msg'])));
            }    
                             
        else if ($action == 'verify-phone') {
            $pilot = $this->Model_directory->get_pilot($ID);
            $is_user_type_pilot = check_pilot_certification($pilot['certificates']);
            if ($is_user_type_pilot) {
                $pilot['user_type'] = 'P';
            } else {
                $pilot['user_type'] = 'Other';
            }

            if (($pilot['phone'] == "") && $is_user_type_pilot) {
                //echo "Your date is not there in database to verify and your type is pilot so only way to go is to contact admin about it";
                $pilot = $this->Model_user->get_member($ID);
                $this->load->view('main', array('view' => 'auth/pilot/contact', 'data' => array('pilot' => $pilot)));

            } else {
                $try = $this->Model_auth->register_pilot($ID);
                $this->load->view('main', array('view' => 'auth/pilot/verify-phone', 'data' => array('pilot' => $pilot, 'signup_try' => $try['count'], 'msg' => $try['msg'])));
            }
        } else if ($action == 'signup') {
            $pilot = $this->Model_directory->get_pilot($ID);
            $try = $this->Model_auth->register_pilot($ID);
            $this->load->view('main', array('view' => 'auth/pilot/signup', 'data' => array('pilot' => $pilot, 'signup_try' => $try['count'], 'msg' => $try['msg'])));

        } else if ($action == 'complete') {
           $pilot = array();
           if ($ID != '') {
           $uid = $this->db->from('user')->where('user_id', $ID)->where('user_status', 'a')->get()->row_array();
           if($uid <> ''){
           $pilot = $this->Model_user->get_member($ID);}
           $this->Model_email->register($pilot['user_email']);}
            $this->load->view('main', array('view' => 'auth/pilot/complete', 'data' => array('pilot' => $pilot))); 
        } else if ($action == 'contact') {
            if ($this->input->get_post('contact') == 'send') {
                $this->Model_email->signuppilot();
            }
            $pilot = $this->Model_user->get_member($ID);
            $this->load->view('main', array('view' => 'auth/pilot/contact', 'data' => array('pilot' => $pilot)));
        
        } else if ($action == "justsignup") {
            $pilot = $this->Model_directory->get_pilot($ID);
            $this->load->view('main', array('view' => 'auth/pilot/signup', 'data' => array('pilot' => $pilot, 'signup_try' => $try['count'], 'msg' => $try['msg'])));
        }
    }

    public function register_department($action = '', $ID = '')
    {
        set_title('Flight Department Registration');
        $this->load->model('Model_email');
        $this->load->model('Model_auth');
        $this->load->model('Model_user');
        $this->load->model('Model_directory');
        $this->Model_auth->register_department($ID);
        if ($action == '') {
            $this->load->view('main', array('view' => 'auth/department/register_new'));
        } else if ($action == 'signup') {
            $data = array();
            if ($ID != '') {
                $data = $this->db->from('dir_master')->join('dir_acftref', 'dir_master.mfr_mdl_code = dir_acftref.code')->where('n_number', $ID)->get();
                if ($data->num_rows() > 0) {
                    $data = $data->row_array();
                    $this->load->view('main', array('view' => 'auth/department/signup', 'data' => array('data' => $data)));
                } else {
                    push_message('We couldn\'t find the any Aircraft associated with N-Number', true);
                    redirect('register/department');
                }
            } else {
                push_message('We couldn\'t find the any Aircraft associated with N-Number', true);
                redirect('register/department');
            }
        } else if ($action == 'create') {
            $data = array();
            if ($ID != '') {
                //$data = $this->db->from('directory_aircrafts')->where('id', $ID)->get();
                $data = $this->db->from('dir_master')->join('dir_acftref', 'dir_master.mfr_mdl_code = dir_acftref.code')->where('n_number', $ID)->get();
                if ($data->num_rows() > 0) {
                    $data = $data->row_array();
                    $data['linkedIn'] = isset($_SESSION['tmp_json']) ? $_SESSION['tmp_json'] : "";
                    $this->load->view('main', array('view' => 'auth/department/profile', 'data' => array('data' => $data)));
                } else {
                    push_message('We couldn\'t find the any Aircraft associated with N-Number', true);
                    redirect('register/department');
                }
            } else {
                push_message('We couldn\'t find the any Aircraft associated with N-Number', true);
                redirect('register/department');
            }
        } else if ($action == 'complete') {
            $data = array();
            if ($ID != '') {
                $data = $this->Model_user->get_member($ID);
            }
            $this->load->view('main', array('view' => 'auth/department/complete', 'data' => array('data' => $data)));
        }

    }

    public function login()
    {
         set_title('Login');
        $this->load->library('session');
        set_title('Login to your account');
        $this->load->model('Model_auth');
        $this->Model_auth->login();
        $this->load->view('main_home', array('view' => 'auth/login'));
    }

    public function forgot()
    {
        set_title('Forgot Password');
        $this->load->model('Model_auth');
        $this->load->model('Model_email');
        $this->Model_auth->forgot();
        $this->load->view('main_home', array('view' => 'auth/forgot'));
    }

    public function change()
    {
        set_title('Change Password');
        $this->load->model('Model_auth');
        $this->load->model('Model_email');
        $this->Model_auth->change($this->input->get('user'));
        $this->load->view('main_home', array('view' => 'auth/change'));
    }

    public function confirm($id = '', $type = 'user')
    {
        set_title('Registration Successful');
        $this->load->model('Model_auth');
        $this->load->view('main', array('view' => 'auth/confirm', 'data' => $this->Model_auth->confirm($id, $type)));
    }

    public function logout()
    {
         set_title('Logout');
        $this->load->model('Model_auth');
        $this->Model_auth->logout();
    }

    /*public function seemless()
    {
        $user_rs = $this->db->select('user_id, user_email, user_status, user_type, user_fname, user_lname, user_phome, user_credit, user_image, user_lat, user_lng')->from('user')->where('user_email', $_SESSION['tmp_email'])->where("(user_status='a' OR user_status='paid')")->where('is_deleted', 'n')->get();
        if ($user_rs->num_rows() > 0) {
            unset($_SESSION['tmp_email']);
            unset($_SESSION['tmp_source']);
            unset($_SESSION['tmp_json']);
            unset($_SESSION['tmp_password']);
            $user = $user_rs->row_array();
            $this->session->set_userdata($user);
            redirect('dashboard');
        }
    }*/

}