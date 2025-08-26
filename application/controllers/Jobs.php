<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends CI_Controller
{

    public function index()
    {
        set_title('Flight Dispatch Board');
        $this->load->model('Model_jobs');

        $jobs = array(
            JOB_TARGET_PILOT => $this->Model_jobs->browse($this->input->post("page"), JOB_TARGET_PILOT),
            JOB_TARGET_MECHANIC => $this->Model_jobs->browse($this->input->post("page"), JOB_TARGET_MECHANIC),
            JOB_TARGET_DISPATCHER => $this->Model_jobs->browse($this->input->post("page"), JOB_TARGET_DISPATCHER),
            JOB_TARGET_ATTENDENT => $this->Model_jobs->browse($this->input->post("page"), JOB_TARGET_ATTENDENT),
        );

        print_r($jobs);
        exit;


        $this->load->view('main', array('view' => 'jobs/list', "data" => $jobs));
    }

    public function applied()
    {
        set_title('Flight Dispatch Board');
        $this->load->model('Model_job');

        // print_r($jobs);die;

        $this->load->view('main_backend', array('view' => 'jobs/applied', "data" => []));
    }

    public function detail($id)
    {
        $this->load->model('Model_jobs');
        $job = $this->Model_jobs->get($id);
        set_title($job["title"]);
        $this->load->view('main', array('view' => 'jobs/detail', "data" => $jobs));
    }

    public function create()
    {

        if ($this->input->post("action") == "post") {
            $this->load->model("Model_jobs");
            $response = $this->Model_jobs->post();
            if ($response["status"] == "error") {
                push_message($response["messages"], true);
            } else {
                push_message("Job details saved successfully. Now let's add some more features.");
                redirect("job/create/addon/" . $response["id"]);
            }
        }

        $data = $this->loadSidebar();
        set_title("Post a Job");
        $this->load->view('main_backend', array('view' => 'jobs/create', 'data' => $data));
    }

    public function addons($job)
    {

        if ($this->input->post("action") == "post") {
            $this->load->model("Model_jobs");
            $response = $this->Model_jobs->postAddons();
            if ($response["status"] == "error") {
                push_message($response["messages"], true);
            } else {
                push_message("Job has been posted successfully");
                redirect("job/" . $response["id"]);
            }
        }

        $this->loadSidebar();
        set_title("Job Addons");
        $this->load->view('main_backend', array('view' => 'jobs/addons', 'data' => $data));
    }

    public function loadSidebar()
    {
        $this->load->model('Model_message');
        $this->load->model('Model_user');
        $this->load->model('Model_connection');
        $id = $this->session->userdata('user_id');
        $data = $this->Model_user->get_member($id);
        if ($id == $this->session->userdata('user_id')) {
            $userUrl = 'my/';
        }
        $data['userUrl'] = $userUrl;
        return $data;
    }
}
