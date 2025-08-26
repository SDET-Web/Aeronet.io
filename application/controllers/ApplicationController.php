<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ApplicationController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_message');
        $this->load->model('Model_connection');
        $this->load->model('Model_job_new');
        $this->load->model('Model_subscription');
    }

    public function index($type)
    {
        switch ($type) {
            case 'for-pilots':
                $type = JOB_TARGET_PILOT;
                break;
            case 'for-mechanics':
                $type = JOB_TARGET_MECHANIC;
                break;
            case 'for-dispatchers':
                $type = JOB_TARGET_DISPATCHER;
                break;
            case 'for-attendents':
                $type = JOB_TARGET_ATTENDENT;
                break;
        }
        set_title('Job Applications');
        $this->load->model('Model_application');

        $jobs = [
            APP_STATUS_PENDING => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_PENDING),
            APP_STATUS_FEEDBACK => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_FEEDBACK),
            APP_STATUS_DISQUALIFIED => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_DISQUALIFIED),
            APP_STATUS_QUALIFIED => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_QUALIFIED),
        ];

        $this->load->view('main_backend', array('view' => 'applications/board', 'data' => ["jobs" => $jobs, "type" => $type]));
    }

    public function detail($id)
    {
        set_title('Job Details');
        $this->load->model('Model_job_new');
        $this->load->model('Model_user');
        $job = $this->Model_job_new->Get(decrypt($id));
        if ($job == L8_INSERT_ERROR) {
            push_message('Job has been eidther deleted or not present', TRUE);
            redirect('flight-dispatch-board');
        }


        if ($job->target == "p" && is_non_pilot()) {
            push_message('Job listing is only for pilots', TRUE);
            redirect('flight-dispatch-board');
        }

        $applicant = $this->Model_job_new->GetApplicant($this->session->userdata('user_id'));
        $department = $this->Model_subscription->Get($job->user_id);
        $application = $this->Model_job_new->GetApplication($this->session->userdata('user_id'), decrypt($id));
        $this->Model_job_new->PostApplication(decrypt($id), $applicant->user_resume);

        $this->load->view('main', array('view' => 'jobs/detail', 'data' => array('job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application)));
    }

    public function apply($id)
    {
        set_title('Submit application');
        $this->load->model('Model_job_new');
        $job = $this->Model_job_new->Get(decrypt($id));
        if ($job == L8_INSERT_ERROR) {
            push_message('Job has been eidther deleted or not present', TRUE);
            redirect('flight-dispatch-board');
        }
        $this->load->view('main', array('view' => 'jobs/apply', 'data' => array('job' => $job)));
    }

    public function create($plan = '')
    {
        /*if($this->Model_subscription->Get($this->session->userdata("user_id")) == L8_INSERT_ERROR) {
            redirect('flight-dispatch-board/subscribe');
        }*/
        $this->Model_job_new->Post();
        set_title("Post Job");
        $this->load->view('main_backend', array('view' => 'job/post_form', 'data' => ["braintreeToken" => $this->braintree_lib->generateClientToken(), "plan" => $plan, "subscription" => $this->Model_subscription->Get($this->session->userdata("user_id"))]));
    }

    public function subscribe($plan = '')
    {
        if ($plan != '') {
            if ($plan == L8_PLAN_PREMIUM_CTS) {
                redirect('flight-dispatch-board/subscribe/' . $plan . '/cts/');
            } else {
                if ($this->Model_subscription->PostNew($plan, explode(",", $this->input->get("aircrafts")))) {
                    redirect('/flight-dispatch-board/create');
                }
            }
        }
        set_title("Subscribe");
        $this->load->view('main_backend', array('view' => 'jobs/subscribe', 'data' => ["subscription" => $this->Model_subscription->Get($this->session->userdata("user_id")), "braintreeToken" => $this->braintree_lib->generateClientToken()]));
    }

    public function addons($plan)
    {
        if ($this->input->post("action") == "postAddons") {
            if ($this->Model_subscription->CalculateAmount($plan) > 0) {
                $this->Model_subscription->Post($id, $plan, explode(",", $this->input->get("aircrafts")));
                $this->session->set_userdata("subscription", $this->Model_subscription->Get($this->session->userdata("user_id")));
            }
            $this->Model_job_new->PostAddon($id);
        }

        $this->load->library("braintree_lib");
        $this->load->view('main_backend', array('view' => 'jobs/addons', 'data' => ["braintreeToken" => $this->braintree_lib->generateClientToken(), "amount" => $this->Model_subscription->CalculateAmount($plan), "ctsAmount" => $this->Model_subscription->CalculateCts(), "plan" => $plan, "subscription" => $this->session->userdata("subscription")]));
    }
}
