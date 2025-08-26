<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The Model_directory class is the model which includes Business Logic of all types directories including pilot, states etc.
 *
 * @package   model
 * @version   0.01
 * @since     2016-06-27
 * @author    Rizwan Ali<riz@bitspro.com>
 */
class Model_auth extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function login()
    {
        if ($this->input->post('action') == 'login') {
            $this->form_validation->set_rules('userLoginEmail', 'Email Address', 'required|valid_email');
            $this->form_validation->set_rules('userLoginPassword', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {

            } else {
                $user_rs = $this->db->select('user_id, user_email, user_status, user_type, user_fname, user_lname, user_phome, user_credit, user_image, user_resume, user_lat, user_lng')->from('user')->where('user_email', $this->input->post('userLoginEmail'))->where('user_password', md5($this->input->post('userLoginPassword')))->where("(user_status='a' OR user_status='paid')")->where('is_deleted', 'n')->get();
                if ($user_rs->num_rows() > 0) {
                    $user = $user_rs->row_array();
                    $this->load->model("Model_subscription");
                    $user["subscription"] = $this->Model_subscription->Get($user["user_id"]);
                    $this->session->set_userdata($user);
                    $this->load->model("Model_user");
                    redirect('dashboard');
                } else {
                    push_message($this->lang->line('message_wrong_credentials'), true);
                }
            }
        } elseif ($this->input->post('action') == 'authLinkedIn') {
            $this->form_validation->set_rules('json', 'LinkedIn Account', 'required');
            if ($this->form_validation->run() == FALSE) {

            } else {
                $object = json_decode($this->input->post('json'));
                $user_rs = $this->db->select('user_id, user_email, user_status, user_type, user_fname, user_lname, user_phome, user_credit, user_image, user_resume, user_lat, user_lng')->from('user')->where('user_email', $object->emailAddress)->where("(user_status='a' OR user_status='paid')")->where('is_deleted', 'n')->get();
                if ($user_rs->num_rows() > 0) {
                    $user = $user_rs->row_array();
                    $this->session->set_userdata($user);
                    redirect('dashboard');
                } else {
                    push_message($this->lang->line('message_wrong_account'), true);
                    echo '
                    redirecting ...
                    <script type="text/javascript" src="//platform.linkedin.com/in.js">
                        api_key: 86v3ewl6suhypy
                        authorize: true
                        onLoad: onLinkedInLoad
                        scope: r_basicprofile r_emailaddress
                    </script>
                    <script>
                    function onLinkedInLoad(){
                        IN.User.logout(removeProfileData);
                    }
                    function removeProfileData(){
                        window.location.href = "' . site_url('login') . '";
                    }
                    </script>
                    ';
                    exit;
                }
            }

        }
    }

    function confirm($id = '', $type)
    {
        if ($id == '') {
            redirect('/');
        } else {
            $this->db->where('user_email', base64_decode(urldecode($id)));
            $this->db->update('user', array('user_status' => 'a'));
            return true;
        }
        return false;
    }

    function forgot()
    {
        if ($this->input->post('action') == 'forgot') {
            $this->form_validation->set_rules('userEmail', 'Email', 'required|valid_email');
            if ($this->form_validation->run() == FALSE) {
                //push_message(validation_errors(),true);
            } else {
                $this->db->select("user_id, user_fname, user_status");
                $this->db->from("user");
                $this->db->where("user_email", $this->input->post('userEmail'));
                $this->db->where("is_deleted", "n");
                $this->db->limit(1);
                $query = $this->db->get();

                if ($query->num_rows() == 1) {
                    $row = $query->row();
                    //print_r($row);exit();
                    if ($row->user_status != 'a') {
                        push_message($this->lang->line('message_account_blocked'), true);
                    } else {
                        push_message($this->lang->line('message_password_sent'));
                        $this->Model_email->forgot($row->user_fname);
                        redirect('login');
                    }
                } else {
                    push_message($this->lang->line('message_no_account'), true);
                    return false;
                }

            }
        }
    }

    function change($id)
    {
        if ($this->input->post('action') == 'change') {
            if ($this->input->get('user') == '') {
                redirect('auth');
            } else {
                $this->form_validation->set_rules('userPassword', 'Password', 'required|matches[userPasswordConfirm]');
                $this->form_validation->set_rules('userPasswordConfirm', 'Confirm Password', 'required');
                if ($this->form_validation->run() == FALSE) {
                    //push_message(validation_errors(),true);
                } else {
                    $this->db->where('user_email', base64_decode(urldecode($id)));
                    $this->db->update('user', array('user_password' => md5($this->input->post('userPassword'))));
                    $this->Model_email->send_email(base64_decode(urldecode($id)), 'email_change');
                    push_message($this->lang->line('message_reset_success'));
                    redirect('login');
                }
            }
        }
    }

    function updatepass($id)
    {
        if ($this->input->post('action') == 'change') {
            $this->form_validation->set_rules('userPassword', 'Password', 'required|matches[userPasswordConfirm]');
            $this->form_validation->set_rules('userPasswordConfirm', 'Confirm Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                //push_message(validation_errors(),true);
            } else {
                $this->db->where('user_id', base64_decode(urldecode($id)));
                $this->db->update('user', array('user_password' => md5($this->input->post('userPassword'))));
                push_message($this->lang->line('message_change_success'));
            }
        }
    }

    function logout()
    {
        $is_owner = is_owner();
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_uname');
        $this->session->unset_userdata('user_dname');
        $this->session->unset_userdata('user_status');
        $this->session->unset_userdata('user_phome');
        $this->session->unset_userdata('user_credit');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata("role_id");
        $this->session->unset_userdata('member');
        if ($is_owner) {
            redirect('login');
        } else {
            redirect('login');
        }
    }


    function register_pilot($ID = '')
    {
        $this->load->model('Model_user');
        if ($this->input->post('action') == 'register_pilot_step_1') {
            //$this->form_validation->set_rules('user_type', 'Professional\'s Type*', 'required');
            $this->form_validation->set_rules('first_name', 'First Name*', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');

            if (!$this->form_validation->run() == FALSE) {
                $pilots_list = $this->db
                    ->select('directory_pilot.*')
                    ->from('directory_pilot')
                    ->join('directory_pilot_certificate', 'directory_pilot.unique_id = directory_pilot_certificate.unique_id', 'LEFT')
                    ->where('directory_pilot.unique_id NOT IN (SELECT user_pilot_id FROM user)', '', FALSE)
                    ->like('first_name', $this->input->post('first_name'), 'after')
                    ->like('last_name', $this->input->post('last_name'), 'after')
                    ->group_by('directory_pilot.unique_id')
                    //->where_in('directory_pilot_certificate.type', $this->input->post('type'))
                    ->get();

                if ($pilots_list->num_rows() > 0) {
                    return $pilots_list->result_array();
                } else {
                    push_message('We counldn\'t find any profile with this name. Please try agian', 'ERRO');
                    redirect('register/pilot');
                }
            }
        /*} else if ($this->input->post('action') == 'register_pilot_step_2') {
            $pilot = $this->db->from('directory_pilot')->where('unique_id', $ID)->get()->row_array();
            if ($this->input->post('type') != 'P' && $this->input->post('norequire') == 'n') {
                redirect('register/pilot/signup/' . $ID);
            } elseif ($this->input->post('type') == 'P' && $this->input->post('expired') == 'y') {
                $id = $this->Model_user->insert_pilot_from_id($pilot, $ID);
                redirect('register/pilot/contact/' . $id);
            } elseif (($this->input->post('type') == 'P' || $this->input->post('type') == '') && $this->input->post('norequire') != 'n') {
                $this->form_validation->set_rules('mdate', 'Medical Date*', 'required');
                if (!$this->form_validation->run() == FALSE) {
                    if ($pilot['med_date'] == $this->input->post('mdate') || $pilot['med_exp_date'] == $this->input->post('mdate')) {
                        redirect('register/pilot/phone/' . $ID);
                    } else {
                        $count = $this->input->post('signup_try');
                        $count = $count + 1;
                        return array('count' => $count, 'msg' => 'Entered medical date is not correct, please try again.');
                    }
                } else {
                    $count = $this->input->post('signup_try');
                    $count = $count + 1;
                    return array('count' => $count, 'msg' => 'Entered medical date is not correct, please try again.');
                }
            } elseif (($this->input->post('type') == 'P' || $this->input->post('type') == '')) {
                push_message('Your account type requires a medical expiration date, please enter.');
            }*/
        } else if ($this->input->post('action') == 'register_pilot_step_phone') {
            $pilot = $this->db->from('directory_pilot')->where('unique_id', $ID)->get()->row_array();
            if ($this->input->post('type') != 'P' && $this->input->post('norequire') == 'n') {
                redirect('register/pilot/signup/' . $ID);
            } elseif ($this->input->post('type') == 'P' && $this->input->post('expired') == 'y') {
                $id = $this->Model_user->insert_pilot_from_id($pilot, $ID);
                redirect('register/pilot/contact/' . $id);
           // } elseif (($this->input->post('type') == 'P' || $this->input->post('type') == '') && $this->input->post('norequire') != 'n') {
            } elseif ($this->input->post('phone')<> '') {
                // Phone Number Validation
                $this->form_validation->set_rules('phone', 'Phone Number ', 'required|regex_match[/^((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}$/]',
                    array('regex_match' => 'Please provide a valid phone number.')
                ); //{10} for 10 digits number

                if (!$this->form_validation->run() == FALSE) {
                    // Use the REST API Client to make requests to the Twilio REST API
                    // Your Account SID and Auth Token from twilio.com/console
                    $sid = "AC565c10c7ad46dd5d5904339d317c75ac"; // Your Account SID from www.twilio.com/console
                    $token = "ba78378ce55fd99b4a472877563772d2";
                    $digits = 4;
                    $code = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
                    $this->db->where('unique_id', $pilot['unique_id']);
                    $this->db->update('directory_pilot', array(
                        'phone' =>  $this->input->post('phone'),
                        'verification_code' =>  $code
                    ));//updating phone number

                    $fullName = $pilot['first_name']." ".$pilot['last_name'];
                    $msg = "Hey {$fullName}, \n {$code} is your AeroNet Verification Code.";
                    $client = new Twilio\Rest\Client($sid, $token);

                        $message = $client->messages
                    ->create($this->input->post('phone'),
                            array(
                                'body' => $msg,
                                'from' => "+16307449834"
                            )
                    );
                    redirect('register/pilot/verify-phone/' . $ID);
                } else {
                    $count = $this->input->post('signup_try');
                    $count = $count + 1;
                    return array('count' => $count, 'msg' => 'Entered phone number is not correct, please try again.');
                }
            } elseif (($this->input->post('type') == 'P' || $this->input->post('type') == '')) {
                push_message('Your account type requires a valid phone number, please enter.');
            }
        } 
        else if ($this->input->post('action') == 'register_pilot_step_phone_verify') {
            $pilot = $this->db->from('directory_pilot')->where('unique_id', $ID)->get()->row_array();
            if ($this->input->post('type') != 'P' && $this->input->post('norequire') == 'n') {
                redirect('register/pilot/signup/' . $ID);
            } elseif ($this->input->post('type') == 'P' && $this->input->post('expired') == 'y') {
                $id = $this->Model_user->insert_pilot_from_id($pilot, $ID);
                redirect('register/pilot/contact/' . $id);
            } elseif (($this->input->post('type') == 'P' || $this->input->post('type') == '') && $this->input->post('norequire') != 'n') {
                $this->form_validation->set_rules('verification_code', 'Verification Code*', 'required');
                if (!$this->form_validation->run() == FALSE) {
                    
                    if ($pilot['verification_code'] == $this->input->post('verification_code')) {
                        redirect('register/pilot/signup/' . $ID);
                    } else {
                        $count = $this->input->post('signup_try');
                        $count = $count + 1;
                        return array('count' => $count, 'msg' => 'Entered verification code is not correct, please try again.');
                    }
                } else {
                    $count = $this->input->post('signup_try');
                    $count = $count + 1;
                    return array('count' => $count, 'msg' => 'Entered verification code is not correct, please try again.');
                }
            } elseif (($this->input->post('type') == 'P' || $this->input->post('type') == '')) {
                push_message('Your account type requires a verification code, please enter.');
            }
        }
        else if ($this->input->post('action') == 'register_pilot_step_3') {
            // vde( $_POST );

            $pilot = $this->db->from('directory_pilot')->where('unique_id', $ID)->get()->row_array();
            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[user.user_email]');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->form_validation->set_rules('first_name', 'First Name', 'required', "fucker enter email address");
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('zipcode', 'Zip', 'required');


            if (isset($pilot) && !$this->form_validation->run() == FALSE) {
                $id = $this->Model_user->insert_pilot_from_id($pilot, $ID, 'n');
                $this->Model_email->signuppilot($this->input->post('email'));
                redirect('register/pilot/complete/' . $id);
            } else {
                $count = $this->input->post('signup_try');
                // if ($count < 3)
                if ($count < 3 && $_POST['type'] !== 'M') {
                    //push_message('Entered medical date is not correct, please try again.', 'ERROR');
                    $count = $count + 1;
                    return array('count' => $count, 'msg' => 'Entered medical date is not correct, please try again.');
                } else {
                    // $pilots_list = $this->db->from('directory_pilot')->where('unique_id', $ID)->get();
                    // $pilot = $pilots_list->row_array();
                    $id = $this->Model_user->insert_pilot_from_id($pilot, $ID);
                    redirect('register/pilot/contact/' . $id);
                }
            }
        } else if ($this->input->post("action") == 'authLinkedIn') {
            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');


            if (!$this->form_validation->run() == FALSE) {
                $this->form_validation->set_rules('email', 'Email Address', 'is_unique[user.user_email]');
                if (!$this->form_validation->run() == FALSE) {
                    $_SESSION['tmp_email'] = trim($_POST['email']);
                    $id = $this->Model_user->insert_pilot_from_linkedin($ID);
                    // $this->Model_email->signuppilot($this->input->post('email'));
                    redirect('register/pilot/complete/' . $id);
                } else {
                    push_message('Account already exists with this email, please login.', true);
                    redirect('register/pilot/signup/' . $ID);
                }
            } else {
                push_message('Linked In profile did not provide complete information.', true);
                redirect('register/pilot/signup/' . $ID);
            }

        } else if ($this->input->get('send_activation') != '') {
            $this->Model_email->register(base64_decode(urldecode($this->input->get('send_activation'))));
        }
        return 0;
    }

    function register_department($ID = '')
    {
        if ($this->input->post('action') == 'register_department_step_1') {
            $this->form_validation->set_rules('nnumber', 'N-Number', 'required');
            if (!$this->form_validation->run() == FALSE) {
                //$aircraft = $this->db->from('directory_aircrafts')->where('n_number', $this->input->post('nnumber'))->get();
                $aircraft = $this->db->from('dir_master')->where('n_number', $this->input->post('nnumber'))->get();
                if ($aircraft->num_rows() > 0) {
                    if ($this->db->from('user_aircraft')->where('aircraft_id', $aircraft->row()->n_number)->get()->num_rows() <= 0) {
                        redirect('register/department/signup/' . $aircraft->row()->n_number);
                    } else {
                        push_message('Department is already registered with this aircraft. Please Login', true);
                        redirect('register/department');
                    }
                } else {
                    push_message('We couldn\'t find the any Aircraft associated with N-Number', true);
                    redirect('register/department');
                }
            } else {
                push_message(validation_errors(), true);
                redirect('register/department');
            }
        } else if ($this->input->post('action') == 'register_department_step_1_5') {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.user_email]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if (!$this->form_validation->run() == FALSE) {
                $_SESSION['tmp_email'] = trim($_POST['email']);
                $_SESSION['tmp_password'] = trim($_POST['password']);
                $_SESSION['tmp_source'] = '';
                redirect('register/department/create/' . $ID);
            } else {
                push_message(validation_errors(), true);
                redirect('register/department/signup/' . $ID);
            }
        } else if ($this->input->post('action') == 'authLinkedIn') {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.user_email]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if (!$this->form_validation->run() == FALSE) {
                $_SESSION['tmp_email'] = trim($_POST['email']);
                $_SESSION['tmp_password'] = trim($_POST['password']);
                $_SESSION['tmp_source'] = 'linkedin';
                $_SESSION['tmp_json'] = json_decode($_POST['json'], true);
                redirect('register/department/create/' . $ID);
            } else {
                push_message(validation_errors(), true);
                redirect('register/department/signup/' . $ID);
            }
        } else if ($this->input->post('action') == 'register_department_step_2') {
            // $this->form_validation->set_rules('photo', 'Company\'s Logo or Aircraft Picture', 'required');
            $this->form_validation->set_rules('company', 'Company Name', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            // $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[user.user_email]');
            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('lname', 'Last Name', 'required');
            $this->form_validation->set_rules('position', 'Position', 'required');
            // $this->form_validation->set_rules('phone', 'Phone Number', 'required');
            // $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('planes', 'Planes', 'required');
            if (!$this->form_validation->run() == FALSE) {

                foreach ($_POST as $key => $value) {
                    if ($key == 'phone') {
                        $data['user_pmobile'] = $value;
                    } else if ($key == 'logo') {
                        $data['user_image'] = $value;
                    } else if ($key != 'action' && $key != 'id') {
                        if (strpos($key, 'lastlogin') !== FALSE || strpos($key, 'dob') !== FALSE) {
                            $data['user_' . $key] = strtotime($value);
                        } else {
                            $data['user_' . $key] = ($key == 'password' ? md5($value) : $value);
                        }
                    }
                }
                if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != "") {
                    $upload = $this->Model_upload->upload(UPLOAD_PATH . '/member', 'photo');
                    if ($upload["status"] == "success") {
                        $data["user_image"] = $upload["filename"];
                    } else {
                        push_message($upload["messages"], true);
                        return L8_INSERT_ERROR_WITH_MESSAGE;
                    }
                }
                $data['user_modified'] = time();
                $data['user_type'] = 'd';
                $data['user_created'] = time();
                if ($data['user_address'] != '' && $data['user_city'] != '' && $data['user_state'] != '') {
                    $latLng = get_latlng($data['user_address'] . ' ' . $data['user_city'] . ' ' . $data['user_state']);
                    $data['user_lat'] = $latLng != false ? $latLng->lat : '';
                    $data['user_lng'] = $latLng != false ? $latLng->lng : '';
                } else {
                    $data['user_lat'] = '';
                    $data['user_lng'] = '';
                }
                $data['user_email'] = $_SESSION['tmp_email'];
                $data['user_password'] = md5($_SESSION['tmp_password']);
                $data['user_source'] = $_SESSION['tmp_source'];
                if ($_SESSION['tmp_source'] == 'linkedin') {
                    $data['user_status'] = 'a';
                }
                $this->db->insert('user', $data);

                $id = $this->db->insert_id();

                $tmp_plane = $this->db->from('dir_master')->where('n_number', $ID)->get();
                if ($tmp_plane->num_rows() > 0) {
                    $data_air['aircraft_id'] = $tmp_plane->row()->id;
                    $data_air['user_id'] = $id;
                    $this->db->insert('user_aircraft', $data_air);
                } else {
                    $has_empty = true;
                }

                if ($_SESSION['tmp_source'] != 'linkedin') {
                    $this->Model_email->register($data['user_email']);
                }
                redirect('register/department/complete/' . $id);
            } else {
                push_message(validation_errors(), true);
            }
        } else if ($this->input->post('action') == 'register_department_step_3') {
            if (count($this->input->post('nnumber')) > 0 && $this->input->post('nnumber') != '') {
                $has_empty = false;
                foreach ($this->input->post('nnumber') as $key => $value) {
                    $data['name'] = $_POST['plane'][$key];
                    $tmp_plane = $this->db->from('directory_aircrafts')->where('n_number', $value)->get();
                    if ($tmp_plane->num_rows() > 0) {
                        $data['aircraft_id'] = $tmp_plane->row()->id;
                        $data['user_id'] = $ID;
                        $this->db->insert('user_aircraft', $data);
                    } else {
                        $has_empty = true;
                    }
                }
                if ($has_empty) {
                    push_message('Some of N-Numbers were wrong please enter aircarft\'s N-Numbers again', true);
                } else {
                    $this->Model_email->register($this->db->from('user')->select('user_email')->where('user_id', $ID)->get()->row()->user_email);
                    redirect('register/department/complete/' . $ID);
                }
            } else {
                push_message('Please enter aircarft\'s N-Numbers', true);
            }

        } else if ($this->input->get('send_activation') != '') {
            $this->Model_email->register(base64_decode(urldecode($this->input->get('send_activation'))));
        }
    }

    function load_manufacturers($search_query)
    {
        $query = "SELECT DISTINCT mfr_name as title FROM directory_aircrafts where mfr_name LIKE '$search_query%' ORDER BY mfr_name ASC limit 0,10";
        $manufacturers_list = $this->db->query($query);
        $data = $manufacturers_list->result();
        return array('total' => 1, 'data' => $data);

    }

    public function load_models($manufacturer_name, $search_query)
    {
        //$manufacturer_name = str_replace("%20"," ",$manufacturer_name);
        $manufacturer_name = urldecode($manufacturer_name);
        $query_string = "SELECT DISTINCT model_name as title FROM directory_aircrafts where mfr_name LIKE '$manufacturer_name' and model_name LIKE '$search_query%' ORDER BY model_name ASC limit 0,10";
        $models_list = $this->db->query($query_string);
        $data = $models_list->result();
        return array('total' => 1, 'data' => $data);
    }

    /* Nauman
    public function load_n_numbers($manufacturer_name, $model_name, $search_query){
        $manufacturer_name = urldecode($manufacturer_name);
        $model_name = urldecode($model_name);
        $query_string = "SELECT DISTINCT n_number as title FROM directory_aircrafts where mfr_name LIKE '$manufacturer_name' and model_name LIKE '$model_name' and n_number LIKE '$search_query%' ORDER BY n_number ASC limit 0,10";
        $models_list = $this->db->query($query_string);
        $data = $models_list->result();
        return array('total'=>1, 'data'=>$data);
    }
    */

    public function load_n_numbers($search_query)
    {
        $search_query = urldecode($search_query);
        $query_string = "SELECT n_number as title FROM directory_aircrafts where n_number LIKE '$search_query%' ORDER BY n_number ASC limit 0,10";
        $models_list = $this->db->query($query_string);
        $data = $models_list->result();
        return array('total' => 1, 'data' => $data);
    }

    public function load_make_model_by_n_number($n_number)
    {
        $n_number = urldecode($n_number);
        $query_string = "SELECT mfr_name, model_name FROM directory_aircrafts where n_number LIKE '$n_number'";
        $models_list = $this->db->query($query_string);
        $data = $models_list->result();
        return array('data' => $data);
    }


}
?>
