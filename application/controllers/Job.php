<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller
{

    /*
     * Job Board - Home
     */

    public function index()
    {
        $page = get_page(6);
        set_title($page->page_title);
        $this->load->model('Model_form');
        $this->load->view('browser/head');
        $this->load->view('browser/job/home', array('content' => $page->page_content));
        $this->load->view('browser/foot');
    }

    /*
     * Job Board - Post Job
     */
    public function post()
    {
        set_title('Post A Flight');
        if (!is_owner()) {
            if (is_logged_in()) {
                push_message('You have a member\'s account. In order to post a job please login with Owner\'s account', true);
            }
            redirect('job');
        }

        $this->load->model('Model_aircraft');
        $aircraft = false;
        $int_ext = false;
        if ($this->input->get('model') != '') {
            $int_ext = $this->Model_aircraft->get_interior_exterior($this->input->get('model'));
        }
        //if($this->input->post('action') == 'postJob'){
        //$aircraft = $this->Model_aircraft->get_craft_picture($this->input->post('aircraftModel'));
        //}

        $this->load->model('Model_form');
        //$this->load->model('Model_email');
        $this->load->model('Model_job');
        $this->Model_job->post();
        $this->load->view('browser/head');
        $this->load->view('browser/job/post', array('aircraft' => $aircraft, 'int_ext' => $int_ext));
        $this->load->view('browser/foot');
    }

    /*
     * Job Board - Board
     */
    public function board()
    {
        set_title('Flight Dispatch Board');
        //$this->load->model('Model_job');
        $this->load->model('Model_job_new');
        $this->load->model('Model_message');
        $this->load->model('Model_connection');
        $this->Model_job->post();
        $this->load->view('main', array('view' => 'job/list'));
    }

    public function subscription($posting_type)
    {

        $this->load->model('Model_message');
        $this->load->model('Model_user');
        $this->load->model('Model_connection');
        $id = $this->session->userdata('user_id');
        $data = $this->Model_user->get_member($id);
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;


        $this->load->model('Model_job');

        if ($this->session->has_userdata('user_id')) {
            $subscription_array = $this->Model_job->check_subscription();
            if (empty($subscription_array)) {
                set_title('Select Subscription type');
                $data['selected_type'] = $posting_type;
                $this->load->view('main_backend', array('view' => 'job/subscription', 'data' => $data));
            } else {
                set_title('Post Job');
                $data['selected_type'] = $posting_type;
                $this->Model_job->post();
                $this->load->view('main_backend', array('view' => 'job/post_form', 'data' => $data));
            }
        } else {
            $this->load->view('main', array('view' => 'job/list'));
        }
        /*echo "<pre>";
        print_r($is_subscribed);
        echo "</pre>";

        exit();
        */
    }

    public function subscribed($subscription_type, $posting_type)
    {
        $this->load->model('Model_job');

        if ($this->session->has_userdata('user_id')) {
            $result = $this->Model_job->add_subscription($subscription_type);
            if ($result) {
                set_title('Post Job');
                redirect('flight-board-subscription/p', 'refresh');
                //$data['selected_type'] = $posting_type;
                //$this->load->view('main', array('view' => 'job/post_form', 'data' => $data));
            } else {
                set_title('Select Subscription type');
                $this->load->view('main', array('view' => 'job/subscription'));
            }
        } else {
            $this->load->view('main', array('view' => 'job/list'));
        }
    }

    /*
     * Job Board - Details
     */

    public function detail($id)
    {
        set_title('Flight Details');
        $this->load->model('Model_job');
        $job = $this->Model_job->get($id);
        if ($job == false) {
            push_message('Job has been eidther deleted or not present', TRUE);
            redirect('job/board');
        }
        $this->load->view('main', array('view' => 'job/detail', 'data' => array('job' => $job)));
    }

    public function apply_job($job_id = "")
    {
        //echo "asdsadfasdf ";
        //exit();
        //
        if ($job_id == "" && $this->session->has_userdata('selected_job_id')) {
            $job_id = $this->session->userdata('selected_job_id');
        }
        if ($job_id == "") {
            redirect('job/board');
        }
        $this->load->model('Model_job');
        $job = $this->Model_job->get($job_id);

        if ($this->session->userdata('user_type') == $job->job_type) {

            if ($job == false) {
                push_message('Job has been eidther deleted or not present', TRUE);
                redirect('job/board');
            } else {
                $applied = $this->Model_job->check_applied($job->job_id);
                if ($applied) {
                    push_message('Job application is already sent to the department', false);
                    redirect('job/board');
                } else {
                    if ($job->job_category == "premium") {
                        if (isset($_POST['organization'])) {
                            $this->apply_premium($job_id);
                        } else {
                            $this->session->set_userdata('selected_job_id', $job_id);
                            $this->load_addendum();
                        }
                    } else {


                        $this->apply_free_job($job);
                    }
                }
            }
        } else {
            $lbl = "";
            if ($job->job_type == "p") {
                $lbl = "Pilot";
            } else if ($job->job_type == "m") {
                $lbl = "Mechanic";
            } else if ($job->job_type == "f") {
                $lbl = "Flight attendent";
            } else if ($job->job_type == "d") {
                $lbl = "Flight despatcher";
            }
            push_message('You does not meet the criteria of this job, it is only for a ' . $lbl, false);
            redirect('job/detail/' . $job_id);
            //redirect('job/board/');
        }
    }

    private function apply_free_job($job)
    {
        $this->load->model('Model_job');
        $this->load->model('Model_email');
        //$this->Model_job->send_job_application($job->job_id);
        $this->Model_email->apply_free_job("rizalishan@gmail.com", $job->job_name);
        push_message('Job application sent to the department', false);
        redirect('job/board');
    }

    public function load_addendum()
    {
        $this->load->model('Model_job');
        $user_id = $this->session->userdata("user_id");
        $old_job_addendum = $this->Model_job->get_prev_addendum($user_id);
        $this->load->view('main', array('view' => 'job/application_form', 'data' => array('addendum' => $old_job_addendum)));
    }

    public function apply_premium($job)
    {
        $this->load->model('Model_job');
        $this->load->model('Model_email');
        $this->Model_job->send_premium_job_application($job->job_id);
        $this->Model_email->apply_premium_job("rizalishan@gmail.com", $job->job_name, $job->job_id);
        push_message('Job application sent to the department', false);
        redirect('job/board');
    }

    public function show_addendum($job_id, $user_id)
    {
        $this->load->model('Model_job');
        if ($job_id == "" || $user_id == "") {
            //echo " YOU";
        } else {
            $job_addendum = $this->Model_job->get_addendum($job_id, $user_id);
            if ($job_addendum == false) {
                echo "addendum failed";
            } else {
                $this->load->view('main', array('view' => 'job/addendum_answers', 'data' => array('addendum' => $job_addendum)));
            }
        }
    }

    /*
     * Job Board - Apply
     */

    public function apply($id)
    {
        set_title('Send Resume');
        $this->load->model('Model_form');
        $this->load->model('Model_job');
        $this->load->model('Model_email');
        $this->load->model('Model_user');
        $job = $this->Model_job->get($id);
        $this->Model_job->apply(base64_decode(urldecode($id)));
        $this->load->view('browser/head');
        $this->load->view('browser/job/apply', array('job' => $job));
        $this->load->view('browser/foot');

    }

    public function enlist($id = '')
    {
        $this->load->model('Model_message');
        $this->load->model('Model_user');
        $this->load->model('Model_connection');
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        $data = $this->Model_user->get_member($id);
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        $this->load->view('main_backend', array('view' => 'job/new/list', 'data' => $data));
    }

    public function ctslist($id = '')
    {
        $this->load->model('Model_message');
        $this->load->model('Model_user');
        $this->load->model('Model_connection');
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        $data = $this->Model_user->get_member($id);
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        $this->load->view('main_backend', array('view' => 'job/new/ctslist', 'data' => $data));
    }


    public function details($url)
    {
        $this->load->model('Model_message');
        $this->load->model('Model_user');
        $this->load->model('Model_connection');
        $id = '';
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        $data = $this->Model_user->get_member($id);
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        $this->load->view('main_backend', array('view' => 'job/new/detail', 'data' => $data));
    }

    public function create($id = '')
    {
        $this->load->model('Model_message');
        $this->load->model('Model_user');
        $this->load->model('Model_connection');
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        $data = $this->Model_user->get_member($id);
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        $this->load->view('main_backend', array('view' => 'job/new/create', 'data' => $data));
    }

    public function application($id = '')
    {
        $this->load->model('Model_message');
        $this->load->model('Model_user');
        $this->load->model('Model_connection');
        if ($id == '') {
            $id = $this->session->userdata('user_id');
        }
        $data = $this->Model_user->get_member($id);
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        $this->load->view('main', array('view' => 'job/new/apply', 'data' => $data));
    }
}
