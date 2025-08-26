<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class JobController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_message');
        $this->load->model('Model_connection');
        $this->load->model('Model_job_new');
        $this->load->model('Model_subscription');
        $this->load->helper('inflector');
    }

    public function index()
    {
        set_title('Flight Dispatch Board');
        $jobs = array(
            JOB_TARGET_PILOT => $this->Model_job_new->Browse($this->input->post("page"), JOB_TARGET_PILOT),
            JOB_TARGET_MECHANIC => $this->Model_job_new->Browse($this->input->post("page"), JOB_TARGET_MECHANIC),
            JOB_TARGET_DISPATCHER => $this->Model_job_new->Browse($this->input->post("page"), JOB_TARGET_DISPATCHER),
            JOB_TARGET_ATTENDENT => $this->Model_job_new->Browse($this->input->post("page"), JOB_TARGET_ATTENDENT),
        );

        $this->load->view('main', array('view' => 'jobs/list_new', "data" => $jobs));
    }

    public function job_delete($id)
    {
        $job = $this->Model_job_new->Get(decrypt($id));
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }

        $this->load->view('jobs/delete', array('id' => $id));
    }

    public function job_delete_confirm($id)
    {
        if (!$this->Model_job_new->Delete(decrypt($id))) {
            push_message('Job has been deleted successfully');
            redirect('flight-dispatch-board');
        } else {
            push_message('An unexpected error occured please try again', true);
            redirect('flight-dispatch-board');
        }
    }

    public function detail($id)
    {
        set_title('Job Details');
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
         if ($this->input->post("action") == "postApplication") {
        if($department != L8_INSERT_ERROR && $job->plan != L8_JOB_PLAN_PAID) {
        $this->Model_job_new->PostApplication(decrypt($id), $applicant->user_resume);redirect($_SERVER['HTTP_REFERER']); }else{
         $this->Model_job_new->SaveApplication(decrypt($id), $applicant->user_resume, "d");redirect($_SERVER['HTTP_REFERER']);}}
         
        $this->load->view('main', array('view' => 'jobs/detail', 'data' => array('job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application)));
    }
    
    
    public function jobdetail($id)
    {
        set_title('Job Details');
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
         if ($this->input->post("action") == "postApplication") {
        if($department != L8_INSERT_ERROR && $job->plan != L8_JOB_PLAN_PAID) {
        $this->Model_job_new->PostApplication(decrypt($id), $applicant->user_resume);redirect($_SERVER['HTTP_REFERER']); }else{
         $this->Model_job_new->SaveApplication(decrypt($id), $applicant->user_resume, "d");redirect($_SERVER['HTTP_REFERER']);}}
         
        $this->load->view('main', array('view' => 'cts/jobdetail', 'data' => array('job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application)));
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

    public function addendum($id)
    {
        set_title('Job Details');
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
        $this->Model_job_new->PostApplication(decrypt($id), $applicant->user_resume);
        $application = $this->Model_job_new->GetApplication($this->session->userdata('user_id'), decrypt($id));
        $appId=$application->id;
        //echo('test'.$appId);
        if ($this->input->post("action") == "postApplication") {
            $this->Model_job_new->SaveAddendum($appId);
            $this->Model_job_new->UpdatePipline($appId, PIPLE_STEP_INTERVIEW_PROVIDED, '');
            if ($id != L8_INSERT_ERROR && $id != L8_INSERT_ERROR_WITH_MESSAGE) {
                push_message("Addendum has been updated successfully.");
                redirect($_SERVER['HTTP_REFERER']);
            } elseif ($id != L8_INSERT_ERROR_WITH_MESSAGE) {
                push_message("An unexpected error occured. Please try again.", true);
            }
        }     
        
    $this->load->view('main', array('view' => 'cts/addendum', 'data' => array('job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application)));

      }

    public function create($plan = '')
    {
        $this->Model_job_new->Post();
        $subscription = $this->Model_subscription->Get($this->session->userdata("user_id"));
        if (!is_object($subscription) && $subscription == L8_INSERT_ERROR && $plan == '') {
            $this->Model_subscription->PostNew(L8_PLAN_BASIC, []);
            $subscription = $this->Model_subscription->Get($this->session->userdata("user_id"));
        }
        set_title("Post Job");
        $this->load->view('main_backend', array('view' => 'job/post_form', 'data' => ["braintreeToken" => $this->braintree_lib->generateClientToken(), "plan" => $plan, "subscription" => $subscription]));
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
     //$this->load->view('main_backend', array('view' => 'jobs/subscribe', 'data' => ["subscription" => $this->Model_subscription->Get($this->session->userdata("user_id")), "braintreeToken" => $this->braintree_lib->generateClientToken()]));
     $this->load->view('main_backend', array('view' => 'flight-dispatch-board/subscribe/addons/l8premiumcts', 'data' => ["subscription" => $this->Model_subscription->Get($this->session->userdata("user_id")), "braintreeToken" => $this->braintree_lib->generateClientToken()]));
        
                }

    public function addons($plan)
    {
        $subscription = $this->Model_subscription->Get($this->session->userdata("user_id"));
        $subscribedAircrafts = $subscription->aircrafts == null ? [] : $subscription->aircrafts;
        $selectedAircrafts = [];
        if ($this->input->get("aircrafts") != "") {
            $selectedAircrafts = explode(",", $this->input->get("aircrafts"));
        }

        $newAircraftCount = count($selectedAircrafts) - count($subscribedAircrafts);
        $displayPaymentForm = count($selectedAircrafts) > 0 && $newAircraftCount != 0;
        $trial_ended = $this->Model_subscription->isTrialExpired($this->session->userdata("user_id"));

        if (count($selectedAircrafts) > 0 && $newAircraftCount == 0 && $subscription->braintree_plan == L8_PLAN_PREMIUM_CTS) {
            $this->Model_subscription->updateAircrafts($subscription->id, $selectedAircrafts);
            $subscription = $this->Model_subscription->Get($this->session->userdata("user_id"));
            $subscribedAircrafts = $subscription->aircrafts;
        }


        if ($this->input->post("action") == "postAddons") {
            if (!isset($subscription->braintree_plan) || $subscription->braintree_plan != L8_PLAN_PREMIUM_CTS) {
                $addons = $this->input->post("addons") != "" ? explode(",", $this->input->post("addons")) : [];
                $this->Model_subscription->PostNew($plan, $selectedAircrafts, $addons);
            } else {
                $this->Model_subscription->Update($selectedAircrafts);
            }
            $this->session->set_userdata("subscription", $this->Model_subscription->Get($this->session->userdata("user_id")));
            $this->Model_job_new->PostAddon($id);
            push_message("Thanks for subscribing to Applicant Tracking System.");
            set_title("Subscribe");
            redirect("flight-dispatch-board/subscribe/addons/l8premiumcts");
        }

        $btAccount = $this->braintree_lib->getSubscription($subscription->braintree_id);        
        $this->load->library("braintree_lib");
        set_title("Subscribe");
        $this->load->view('main_backend', array('view' => 'jobs/addons', 'data' => [
            "braintreeToken" => $this->braintree_lib->generateClientToken(),
            "amount" => $this->Model_subscription->CalculateAmount($plan, $selectedAircrafts, $subscribedAircrafts),
            "ctsAmount" => $this->Model_subscription->CalculateCts(),
            "plan" => $plan,
            "selectedAircrafts" => $selectedAircrafts,
            "subscribedAircrafts" => $subscribedAircrafts,
            "aircrafts" => count($selectedAircrafts) > 0 ? $selectedAircrafts : $subscribedAircrafts,
            "newAircraftCount" => $newAircraftCount,
            "displayPaymentForm" => $displayPaymentForm,
            "trial_ended" => $trial_ended,
            "is_trial" => $btAccount["isTrial"],
            "trial_days" => $btAccount["trialTime"],
            "subscription" => $subscription]));
    }


    public function addon_add()
    {
        header('Content-Type: application/json');
        $subscriptionId = $this->input->get_post('subs');
        $addon = $this->input->get_post('addon');
        $status = $this->input->get_post('status');
        $price = addon_prices($this->input->get_post('addon'));
        if ($status == 'y') {
            $status = $this->db->insert('user_subscription_addons', ['subscription_id' => $subscriptionId, 'type' => $addon, 'price' => $price, "created" => time()]);
        } else {
            $status = $this->db->delete('user_subscription_addons', ['subscription_id' => $subscriptionId, 'type' => $addon, "created" => time()]);
        }
        echo json_encode(["status" => $status]);
        exit;
    }

    public function cancel()
    {
        $this->Model_subscription->CancelSubscription();
        set_title("Subscribe");
        redirect("flight-dispatch-board/subscribe/addons/l8premiumcts");
    }

    public function applications($type)
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
        // is_cts_subscribed_redirect($this->Model_subscription->Get($this->session->userdata("user_id")));

        $jobs = [
            APP_STATUS_PENDING => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_PENDING),
            APP_STATUS_FEEDBACK => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_FEEDBACK),
            APP_STATUS_DISQUALIFIED => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_DISQUALIFIED),
            APP_STATUS_QUALIFIED => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_QUALIFIED),
        ];

        $this->load->view('main_backend', array('view' => 'applications/board', 'data' => ["jobs" => $jobs, "type" => $type]));
    }

    public function application_shortlist($id, $appId)
    {
        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }
        $application = $this->Model_job_new->GetApplicationById($appId);
        $applicant = $this->Model_job_new->GetApplicant($application->user_id);
        $this->load->view('applications/shortlist' . ($job->type != "j" ? "-cts" : ""), array('id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application));
    }

    public function application_shortlist_confirm($id, $appId)
    {
        if ($this->Model_job_new->PostApplicationShortlisted($appId)) {
            push_message('Application has been shortlisted successfully');
            redirect('applications/for-pilots');
        } else {
            push_message('An unexpected error occured please try again', true);
            redirect('applications/for-pilots');
        }
    }

    public function application_feedback($id, $appId)
    {
        if ($this->input->post("action") == "feedbackApplication") {
            if ($this->Model_job_new->SaveMessage($this->session->userdata("user_id"), $appId, $this->input->post('message'))) {
                $this->load->model('Model_message');
                $application = $this->Model_job_new->GetApplicationById($appId);
                $this->Model_message->insert($this->session->userdata("user_id"), $application->user_id, $this->input->post('message'));
                push_message('Feedback has been sent successfully');
                // redirect('applications/for-pilots');

            } else {
                push_message('An unexpected error occured please try again', true);
                // redirect('applications/for-pilots');
            }
        }

        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }

        $application = $this->Model_job_new->GetApplicationById($appId);
        $messages = $this->Model_job_new->BrowseMessage($appId);
        $this->load->view('main_popup', array('view' => 'applications/feedback', 'data' => array('messages' => $messages, 'id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application)));
    }

    public function application_accept($id, $appId)
    {
        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }

        $application = $this->Model_job_new->GetApplicationById($appId);
        $this->load->view('main_popup', array('view' => 'applications/accept', 'data' => array('id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application)));
    }

    public function application_accept_confirm($id, $appId)
    {
        if ($this->Model_job_new->PostApplicationAccept($appId)) {
            push_message('Application has been accepted successfully');
            echo '<script>parent.location.reload();</script>';exit;
            // redirect('applications/accept/' . $id . '/' . $appId);
        } else {
            push_message('An unexpected error occured please try again', true);
            redirect('applications/accept/' . $id . '/' . $appId);
        }
    }

    public function application_reject($id, $appId)
    {
        if ($this->input->post("action") == "rejectApplication") {
            if ($this->Model_job_new->PostApplicationDeclined($appId, $this->input->post('reason'))) {
                push_message('Application has been rejected successfully');
                redirect('applications/for-pilots');
            } else {
                push_message('An unexpected error occured please try again', true);
                redirect('applications/for-pilots');
            }
        }

        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }

        $application = $this->Model_job_new->GetApplicationById($appId);
        $this->load->view('applications/reject', array('id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application));
    }

    public function application_disqualify_confirm($id, $appId)
    {
        if ($this->Model_job_new->PostApplicationDisqualify($appId, "")) {
            push_message('Application has been placed in rejected list successfully');
            redirect('applications/for-pilots');
        } else {
            push_message('An unexpected error occured please try again', true);
            push_message('Application has been submitted successfully.');
            redirect('applications/for-pilots');
        }
    }

    public function application_screening($id, $appId)
    {
        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }

        $application = $this->Model_job_new->GetApplicationById($appId);
        $this->load->view('applications/screening', array('id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application));
    }

    public function ctslist($type = 'for-pilots')
    {
        $this->load->model('Model_message');
        $this->load->model('Model_user');
        $this->load->model('Model_connection');
        $data = $this->Model_user->get_member($this->session->userdata('user_id'));
        $userUrl = 'my/';
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
            APP_STATUS_PENDING => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_PENDING, 1, "d"),
            APP_STATUS_FEEDBACK => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_FEEDBACK, 1, "d"),
            APP_STATUS_VIDEO => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_VIDEO, 1, "d"),
            APP_STATUS_BACKGROUND => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_BACKGROUND, 1, "d"),
            APP_STATUS_DISQUALIFIED => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_DISQUALIFIED, 1, "d"),
            APP_STATUS_QUALIFIED => $this->Model_job_new->BrowseApplication(-1, $type, APP_STATUS_QUALIFIED, 1, "d"),
        ];
        $data["jobs"] = $jobs;
        $data["type"] = $type;
        $data['subscription'] = $this->Model_subscription->Get($this->session->userdata("user_id"));
        set_title($data['user_fname'] . ' ' . $data['user_lname']);
        $data['userUrl'] = $userUrl;
        $this->load->view('main_backend', array('view' => 'job/new/ctslist', 'data' => $data));
    }
}
