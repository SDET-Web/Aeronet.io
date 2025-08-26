<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CTS extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_message');
        $this->load->model('Model_connection');
        $this->load->model('Model_job_new');
        $this->load->model('Model_subscription');
        $this->load->helper('inflector');
        $this->load->model('Model_user');
        $this->load->model('Model_email');
        $this->load->model('Model_cts');
    }

    public function career($id = '')
    {
        is_logged_in_redirect();

        if ($id == '' && $this->session->userdata("user_type") != "d") {
            redirect("flight-dispatch-board");
        }

        $id = ($id != '' ? $id : $this->session->userdata('user_id'));
        $this->Model_cts->CareerSubmit($id);

        $data = $this->Model_user->get_member($id);
        if ($this->session->userdata("user_type") != "d") {
            $data["jobsApplied"] = $this->Model_cts->ApplicantApplications();
        }

        if ($data["user_accepting_application"] == "y") {
            $data["user_hiring"] = "n";
            $data["user_not_hiring"] = "n";
        } elseif ($data["user_hiring"] == "y") {
            $data["user_accepting_application"] = "n";
            $data["user_not_hiring"] = "n";
        } else {
            $data["user_accepting_application"] = "n";
            $data["user_hiring"] = "n";
            $data["user_not_hiring"] = "y";
        }

        set_title($data['user_company']);
        $data["openings"] = $this->Model_cts->Browse($id)["data"];
        $data["isSubscribed"] = true;
        if ($data["subscription"]["braintree_plan"] != L8_PLAN_PREMIUM_CTS || !is_cts_subscribed($data["subscription"])) {
            //$data["user_hiring"] = "n";
            //$data["user_accepting_application"] = "n";
            $data["isSubscribed"] = false;
            //$data["user_not_hiring"] = "y";
        }
        $this->load->view('main_backend', array('view' => 'cts/career', 'data' => array('data' => $data)));
    }


    public function careerEdit($id = '')
    {
        is_logged_in_redirect();

        if ($id == '' && $this->session->userdata("user_type") != "d") {
            redirect("flight-dispatch-board");
        }

        $id = ($id != '' ? $id : $this->session->userdata('user_id'));
        $this->Model_cts->CareerSubmit($id);

        $data = $this->Model_user->get_member($id);
        if ($this->session->userdata("user_type") != "d") {
            $data["jobsApplied"] = $this->Model_cts->ApplicantApplications();
        }

        if ($data["user_accepting_application"] == "y") {
            $data["user_hiring"] = "n";
            $data["user_not_hiring"] = "n";
        } elseif ($data["user_hiring"] == "y") {
            $data["user_accepting_application"] = "n";
            $data["user_not_hiring"] = "n";
        } else {
            $data["user_accepting_application"] = "n";
            $data["user_hiring"] = "n";
            $data["user_not_hiring"] = "y";
        }

        set_title($data['user_company']);
        $data["openings"] = $this->Model_cts->Browse($id)["data"];
        $data["isSubscribed"] = true;
        if ($data["subscription"]["braintree_plan"] != L8_PLAN_PREMIUM_CTS || !is_cts_subscribed($data["subscription"])) {
            $data["user_hiring"] = "n";
            $data["user_accepting_application"] = "n";
            $data["isSubscribed"] = false;
            $data["user_not_hiring"] = "y";
        }
        $this->load->view('main_backend', array('view' => 'cts/career_edit', 'data' => array('data' => $data)));
    }


    public function addendum($id)
    {
        is_logged_in_redirect();
        set_title('Addendum Questionier');
        $this->load->model('Model_user');
        $applicant = $this->Model_job_new->GetApplicant($this->session->userdata('user_id'));
        $this->Model_cts->SaveAddendum(decrypt($id), $applicant->user_resume);
        $job = $this->Model_job_new->Get(decrypt($id));


        /*if (($this->session->userdata("user_type") != "d" && $application->user_id != $this->session->userdata("user_id")) || ($this->session->userdata("user_type") == "d" && $job->user_id != $this->session->userdata("user_id"))) {
            push_message('You are not authorized to view this page.', TRUE);
            redirect('flight-dispatch-board');
        }*/

        if ($job == L8_INSERT_ERROR) {
            push_message('Job has been eidther deleted or not present', TRUE);
            redirect('flight-dispatch-board');
        }


        if ($job->target == "p" && is_non_pilot()) {
            push_message('Job listing is only for pilots', TRUE);
            redirect('flight-dispatch-board');
        }

        $applicant = $this->Model_job_new->GetApplicant($application->user_id);
        $department = $this->Model_subscription->Get($job->user_id);
        $application = $this->Model_job_new->GetApplication($application->user_id, decrypt($id));
        $this->Model_job_new->PutApplication(decrypt($id), $applicant->user_resume);
        $this->load->view('main', array('view' => 'cts/addendum', 'data' => array('job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application)));
    }

    public function management($type = 'for-pilots')
    {
        is_logged_in_redirect();
        set_title('Career Tracking System');
        $data = $this->Model_user->get_member($this->session->userdata('user_id'));
        if (count($data["subscription"]) == 0 || $data["subscription"]["braintree_plan"] != L8_PLAN_PREMIUM_CTS) {
            push_message('Please subscribe to Candidate tracking system.', TRUE);
            redirect("flight-dispatch-board/create");
        }
        is_cts_subscribed_redirect($data["subscription"]);
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

        $matched = $this->Model_cts->GetMatchedMembers($type);
        if (count($matched) > 0) {
            foreach ($matched as $user) {
                $this->Model_job_new->SaveApplication($user["job"]["id"], $user["user_resume"], "d", $user["user_id"]);
            }
        }

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
        $this->load->view('main_backend', array('view' => 'cts/management', 'data' => $data));
    }

    public function shortlistHeadHunter($job_id, $resume, $type, $user_id)
    {
        $job = $this->Model_job_new->Get($job_id);
        if ($job <> '') {
            $this->Model_job_new->SaveApplication($job_id, $resume, "d", $user_id);
            push_message('Application has been shortlisted successfully');
            redirect('my/headhunter');
        } else {
            push_message('An unexpected error occured please try again', true);
            redirect('my/headhunter');
        }
    }

    public function shortlistMessage($connId, $userId)
    {
        $pilot = $this->Model_user->get_member($connId);
        $name = $pilot['user_fname'] . " " . $pilot['user_lname'];
        $msg = $name . " You are shortlisted! Click here to see our career page for latest jobs alert.";
        $this->load->model('Model_message');
        $this->Model_message->insert($userId, $connId, $msg);
        $this->load->model('Model_email');
        $this->Model_email->send_simple($pilot['user_email'], "You are Shortlisted", $msg);
        push_message('Shortlist sent message and email alert to see your career page. ');
        redirect('my/network');
    }


    public function shortlist($id, $appId, $isUser = 'no')
    {
        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }
        $application = $this->Model_job_new->GetApplicationById($appId);
        $applicant = $this->Model_job_new->GetApplicant($application->user_id);
        $this->load->view('cts/shortlist', array('id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application));
    }

    public function shortlist_confirm($id, $appId)
    {
        if ($this->Model_cts->Shortlist($appId)) {
            push_message('Application has been shortlisted successfully');
            redirect('candidate-tracking');
        } else {
            push_message('An unexpected error occured please try again', true);
            redirect('candidate-tracking');
        }
    }

    public function screening($id, $appId)
    {
        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }
        $application = $this->Model_job_new->GetApplicationById($appId);
        $applicant = $this->Model_job_new->GetApplicant($application->user_id);

        $pipelineAddendumSent = $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_INTERVIEW_REQUESTED);
        $pipelineAddendumAnswered = $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_INTERVIEW_PROVIDED);

        $this->load->view('cts/screening', array('id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application, 'pipelineAddendumSent' => $pipelineAddendumSent, 'pipelineAddendumAnswered' => $pipelineAddendumAnswered));
    }

    public function screening_confirm($appId, $type)
    {
        if ($this->Model_cts->Screening($appId, $type)) {        
         redirect('candidate-tracking');
        } else {
            push_message('An unexpected error occured please try again', true);
            redirect('candidate-tracking');
        }
    }

    public function accept($id, $appId)
    {
        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }

        $application = $this->Model_job_new->GetApplicationById($appId);
        $this->load->view('applications/accept', array('id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application));
    }

    public function accept_confirm($id, $appId)
    {
        if ($this->Model_job_new->PostApplicationAccept($appId)) {
            push_message('Application has been accepted successfully');
            redirect('candidate-tracking');
        } else {
            push_message('An unexpected error occured please try again', true);
            redirect('candidate-tracking');
        }
    }

    public function video($id, $appId)
    {
        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }
        $application = $this->Model_job_new->GetApplicationById($appId);
        $applicant = $this->Model_job_new->GetApplicant($application->user_id);
        $subscription = $this->Model_subscription->Get($this->session->userdata("user_id"));

        $pipelineSent = $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_VIDEO_INTERVIEW_REQUESTED);
        $pipelineAnswered = $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_VIDEO_INTERVIEW_PROVIDED);

        $questions = $this->Model_cts->GetVideoQuestions();
        $appQuestions = $this->Model_cts->GetApplicationVideoQuestion($appId);
        $this->load->view('main_popup', array('view' => 'cts/video-interview', 'data' => array('id' => $id, 'appId' => $appId, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application, 'pipelineSent' => $pipelineSent, 'pipelineAnswered' => $pipelineAnswered, "questions" => $questions, "subscription" => $subscription, "appQuestions" => $appQuestions)));
    }

    public function video_confirm($id, $appId)
    {
        $response = ['status' => 'success'];
        if ($this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_VIDEO_INTERVIEW_REQUESTED) === L8_INSERT_ERROR) {
            $application = $this->Model_job_new->GetApplicationById($appId);
            $applicant = $this->Model_job_new->GetApplicant($application->user_id);
            $addon = plan_addons(L8_ADDON_VIDEO);
            $this->load->library('braintree_lib');
            $response = $this->braintree_lib->charge_customer_once($applicant->braintree_id,  $addon['amount'], PIPLE_STEP_VIDEO_INTERVIEW_REQUESTED . '::' . $appId . '::' . $addon['description']);
        }
        if ($response['status'] === 'success') {
            // Apply here
            $qid = [];
            for ($i = 0; $i <= 4; $i++) {
                $qid[] = $this->input->post('q' . $i);
            }
            $questions = $this->Model_cts->GetVideoQuestions($qid);
            if ($this->Model_cts->SendVideoInterview($appId, $questions)) {
                push_message('Video questioner has been sent successfully');
                redirect('candidate-tracking/video/' . $id . '/' . $appId);
            } else {
                push_message('An unexpected error occured please try again', true);
                redirect('candidate-tracking/video/' . $id . '/' . $appId);
            }
        } else {
            print_r($response['message']);
            exit;
            push_message($response['message'], true);
            redirect('candidate-tracking/video/' . $id . '/' . $appId);
        }
    }

    public function background($id, $appId)
    {
        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }
        $application = $this->Model_job_new->GetApplicationById($appId);
        $applicant = $this->Model_job_new->GetApplicant($application->user_id);
        $subscription = $this->Model_subscription->Get($this->session->userdata("user_id"));
        $addons = isset($subscription->addons) && $subscription->addons != null ? $subscription->addons : [];

        $piplelineBackground = [
            PIPLE_STEP_AVIATION_BACKGROUND_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_AVIATION_BACKGROUND_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_AVIATION_BACKGROUND_CHECK_PROVIDED),
                "color" => "vd_bg-soft-green",
                "text" => "Aviation Background Check (Part 91)",
                "subscribed" => array_search(L8_ADDON_AVIATION, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_AVIATION,
            ],
            PIPLE_STEP_BACKGROUND_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_BACKGROUND_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_BACKGROUND_CHECK_PROVIDED),
                "color" => "vd_bg-dark-green",
                "text" => "Background Check (Part 135)",
                "subscribed" => array_search(L8_ADDON_BACKGROUND, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_BACKGROUND,
            ],
            PIPLE_STEP_DRIVING_RECORDS_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_DRIVING_RECORDS_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_DRIVING_RECORDS_CHECK_PROVIDED),
                "color" => "vd_bg-linkedin",
                "text" => "Driving Records Check + National Driver Registry",
                "subscribed" => array_search(L8_ADDON_DRIVING, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_DRIVING,
            ],
            PIPLE_STEP_MOTOR_RECORDS_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_MOTOR_RECORDS_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_MOTOR_RECORDS_CHECK_PROVIDED),
                "color" => "vd_bg-facebook",
                "text" => " Motor Vehicle Records",
                "subscribed" => array_search(L8_ADDON_MOTOR, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_MOTOR,
            ],
            PIPLE_STEP_CRIMINAL_RECORDS_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_CRIMINAL_RECORDS_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_CRIMINAL_RECORDS_CHECK_PROVIDED),
                "color" => "vd_bg-red",
                "text" => "Criminal Background Check + County Criminal, Misdemeanor and Felony Records Search",
                "subscribed" => array_search(L8_ADDON_CRIMINAL, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_CRIMINAL,
            ],
            PIPLE_STEP_RESUME_VERIFICATION_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_RESUME_VERIFICATION_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_RESUME_VERIFICATION_PROVIDED),
                "color" => "vd_bg-facebook",
                "text" => "Resume Verifications per institution or reference  ",
                "subscribed" => array_search(L8_ADDON_RESUME, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_RESUME,
            ]
        ];

        $this->load->view('main_popup', array('view' => 'cts/background-check', 'data' => array('id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application, 'piplelineBackground' => $piplelineBackground, "subscription" => $subscription)));
    }

    public function background_confirm($appId, $type)
    {
        $subscription = $this->Model_subscription->Get($this->session->userdata("user_id"));
        $addons = isset($subscription->addons) && $subscription->addons != null ? $subscription->addons : [];
        $piplelineBackground = [
            PIPLE_STEP_AVIATION_BACKGROUND_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_AVIATION_BACKGROUND_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_AVIATION_BACKGROUND_CHECK_PROVIDED),
                "color" => "vd_bg-soft-green",
                "text" => "Aviation Background Check (Part 91)",
                "subscribed" => array_search(L8_ADDON_AVIATION, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_AVIATION,
            ],
            PIPLE_STEP_BACKGROUND_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_BACKGROUND_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_BACKGROUND_CHECK_PROVIDED),
                "color" => "vd_bg-dark-green",
                "text" => "Background Check (Part 135)",
                "subscribed" => array_search(L8_ADDON_BACKGROUND, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_BACKGROUND,
            ],
            PIPLE_STEP_DRIVING_RECORDS_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_DRIVING_RECORDS_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_DRIVING_RECORDS_CHECK_PROVIDED),
                "color" => "vd_bg-linkedin",
                "text" => "Driving Records Check + National Driver Registry",
                "subscribed" => array_search(L8_ADDON_DRIVING, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_DRIVING,
            ],
            PIPLE_STEP_MOTOR_RECORDS_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_MOTOR_RECORDS_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_MOTOR_RECORDS_CHECK_PROVIDED),
                "color" => "vd_bg-facebook",
                "text" => " Motor Vehicle Records",
                "subscribed" => array_search(L8_ADDON_MOTOR, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_MOTOR,
            ],
            PIPLE_STEP_CRIMINAL_RECORDS_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_CRIMINAL_RECORDS_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_CRIMINAL_RECORDS_CHECK_PROVIDED),
                "color" => "vd_bg-red",
                "text" => "Criminal Background Check + County Criminal, Misdemeanor and Felony Records Search",
                "subscribed" => array_search(L8_ADDON_CRIMINAL, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_CRIMINAL,
            ],
            PIPLE_STEP_RESUME_VERIFICATION_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_RESUME_VERIFICATION_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_RESUME_VERIFICATION_PROVIDED),
                "color" => "vd_bg-facebook",
                "text" => "Resume Verifications per institution or reference  ",
                "subscribed" => array_search(L8_ADDON_RESUME, $addons) === FALSE ? false : true,
                "addon" => L8_ADDON_RESUME,
            ]
        ];


        $response = ['status' => 'success'];
        $pipeline = $piplelineBackground[$type];
        if ($pipeline['sent'] === L8_INSERT_ERROR && $pipeline['answered'] === L8_INSERT_ERROR) {
            $application = $this->Model_job_new->GetApplicationById($appId);
            $applicant = $this->Model_job_new->GetApplicant($application->user_id);
            $addon = plan_addons($pipeline['addon']);
            $this->load->library('braintree_lib');
            $response = $this->braintree_lib->charge_customer_once($applicant->braintree_id, $addon['amount'],  $type . '::' . $appId . '::' . $addon['description']);
        }
        if ($response['status'] === 'success') {
            $application = $this->Model_job_new->GetApplicationById($appId);
            if ($this->Model_cts->SendBackgroundCheckForm($appId, $type)) {
                push_message('You have subscribed to the background check successfully');
                redirect('candidate-tracking/background/' . $application->job_id . '/' .  $appId);
            } else {
                push_message('An unexpected error occured please try again', true);
                redirect('candidate-tracking/background/' . $application->job_id . '/' .  $appId);
            }
        } else {
            push_message($response['message'], true);
            redirect('candidate-tracking/background/' . $application->job_id . '/' .  $appId);
        }
    }


    public function create($plan = '')
    {
        /* foreach($this->Model_job_new->Browse()["data"] as $item) {
            $this->db->where("id", $item->id);
            $this->db->update("jobs", ["due" => strtotime("+1 month",$item->created)]);
        } */

        $this->Model_job_new->Post();
        $subscription = $this->Model_subscription->Get($this->session->userdata("user_id"));
        if ($subscription == L8_INSERT_ERROR && $plan == '') {
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
        $this->load->view('main_backend', array('view' => 'jobs/subscribe', 'data' => ["subscription" => $this->Model_subscription->Get($this->session->userdata("user_id")), "braintreeToken" => $this->braintree_lib->generateClientToken()]));
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

        if (count($selectedAircrafts) > 0 && $newAircraftCount == 0 && $subscription->braintree_plan == L8_PLAN_PREMIUM_CTS) {
            $this->Model_subscription->updateAircrafts($subscription->id, $selectedAircrafts);
            $subscription = $this->Model_subscription->Get($this->session->userdata("user_id"));
            $subscribedAircrafts = $subscription->aircrafts;
        }


        if ($this->input->post("action") == "postAddons") {
            if ($subscription->braintree_plan != L8_PLAN_PREMIUM_CTS) {
                $addons = $this->input->post("addons") != "" ? explode(",", $this->input->post("addons")) : [];
                $this->Model_subscription->PostNew($plan, $aircrafts, $addons);
            } else {
                $this->Model_subscription->Update($selectedAircrafts);
            }
            $this->session->set_userdata("subscription", $this->Model_subscription->Get($this->session->userdata("user_id")));
            $this->Model_job_new->PostAddon($id);
        }

        $this->load->library("braintree_lib");
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
            "subscription" => $subscription
        ]));
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
                push_message('Feedback has been sent successfully');
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
        $messages = $this->Model_job_new->BrowseMessage($appId);
        $this->load->view('applications/feedback', array('messages' => $messages, 'id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application));
    }

    public function application_accept($id, $appId)
    {
        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }

        $application = $this->Model_job_new->GetApplicationById($appId);
        $this->load->view('applications/accept', array('id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application));
    }

    public function application_accept_confirm($id, $appId)
    {
        if ($this->Model_job_new->PostApplicationAccept($appId)) {
            push_message('Application has been accepted successfully');
            redirect('applications/for-pilots');
        } else {
            push_message('An unexpected error occured please try again', true);
            redirect('applications/for-pilots');
        }
    }

    public function application_reject($id, $appId)
    {
        if ($this->input->post("action") == "rejectApplication") {
            if ($this->Model_job_new->PostApplicationDeclined($appId, $this->input->post('reason'))) {
                push_message('Application has been rejected successfully');
                redirect('candidate-tracking/for-pilots');
            } else {
                push_message('An unexpected error occured please try again', true);
                redirect('candidate-tracking/for-pilots');
            }
        }

        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            echo 'Job has been eidther deleted or not present';
            exit;
        }

        $application = $this->Model_job_new->GetApplicationById($appId);
        $this->load->view('cts/reject', array('id' => $id, 'job' => $job, 'applicant' => $applicant, 'showSideBar' => is_not_department(), 'department' => $department, 'application' => $application));
    }

    public function application_disqualify_confirm($id, $appId)
    {
        if ($this->Model_job_new->PostApplicationDeclined($appId, "")) {
            push_message('Application has been placed in rejected list successfully');
            redirect('candidate-tracking/for-pilots');
        } else {
            push_message('An unexpected error occured please try again', true);
            push_message('Application has been submitted successfully.');
            redirect('candidate-tracking/for-pilots');
        }
    }

    public function application_temp_disqualify_confirm($id, $appId)
    {
        if ($this->Model_job_new->PostApplicationDisqualify($appId, "")) {
            push_message('Application has been placed in rejected list successfully');
            redirect('candidate-tracking/for-pilots');
        } else {
            push_message('An unexpected error occured please try again', true);
            push_message('Application has been submitted successfully.');
            redirect('candidate-tracking/for-pilots');
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

    public function video_upload($id, $appId)
    {
        is_logged_in_redirect();
        set_title('Video Interview Request');
        $id =  decrypt($id);

        $this->load->model('Model_user');
        $job = $this->Model_job_new->Get($id);
        if ($job == L8_INSERT_ERROR) {
            push_message('Job has been either deleted or not present', TRUE);
            redirect('flight-dispatch-board');
        }

        if ($job->target == "p" && is_non_pilot()) {
            push_message('Job listing is only for pilots', TRUE);
            redirect('flight-dispatch-board');
        }

        if ($this->input->post('action') == 'submit_video') {
            $this->Model_cts->SaveVideoUpload($appId);
        }

        $application = $this->Model_job_new->GetApplication($this->session->userdata('user_id'), $id);
        $pipelineAnswered = $this->Model_cts->GetPiplineStatus($application->id, PIPLE_STEP_VIDEO_INTERVIEW_PROVIDED);
        $applicant = $this->Model_job_new->GetApplicant($this->session->userdata('user_id'));
        $department = $this->Model_subscription->Get($job->user_id);
        $questions = $this->Model_cts->GetApplicationVideoQuestion($application->id);
        $this->load->view('main', array('view' => 'cts/video-upload', 'data' => array('job' => $job, 'applicant' => $applicant, 'showSideBar' => true, 'department' => $department, 'application' => $application, 'questions' => $questions, 'pipelineAnswered' => $pipelineAnswered)));
    }

    public function background_upload($id, $appId)
    {
        is_logged_in_redirect();
        set_title('Background Checking Request');

        $this->load->model('Model_user');
        $job = $this->Model_job_new->Get(decrypt($id));
        if ($job == L8_INSERT_ERROR) {
            push_message('Job has been either deleted or not present', TRUE);
            redirect('flight-dispatch-board');
        }

        if ($job->target == "p" && is_non_pilot()) {
            push_message('Job listing is only for pilots', TRUE);
            redirect('flight-dispatch-board');
        }

        $piplelineBackground = [

            PIPLE_STEP_AVIATION_BACKGROUND_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_AVIATION_BACKGROUND_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_AVIATION_BACKGROUND_CHECK_PROVIDED),
                "text" => 'Aviation Background Check (Part 91)<p style="font-size:12px;">
                              *  FAA Airman Certificate Verification<br/>
                              *  FAA Pilot Medical Certification Record (Pilots only)<br/>
                              *  FAA Pilot Accident/Incidents Check (Pilots only)<br/>
                              *  DOT Drug/Alcohol verification (2 year)<br/>
                              *  National Driver Registry<br/><br/>
            <b> The PRIA and aviation background check forms are located here to Download</b><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-10.pdf") . '" target="_blank"> FAA GOV PILOT FORM-10</a><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-10A.pdf") . '" target="_blank"> FAA GOV PILOT FORM-10A</a><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-11.pdf") . '" target="_blank"> FAA GOV PILOT FORM-11</a><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-11A.pdf") . '" target="_blank"> FAA GOV PILOT FORM-11A</a><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-12.pdf") . '" target="_blank"> FAA GOV PILOT FORM-12</a><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-13.pdf") . '" target="_blank"> FAA GOV PILOT FORM-13</a><br/>
             these are 6 word document forms that correspond to the background checks available on AeroNet. </a></p>',
                "addon" => '1',
            ],
            PIPLE_STEP_BACKGROUND_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_BACKGROUND_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_BACKGROUND_CHECK_PROVIDED),
                "text" => 'Background Check (Part 135)<p style="font-size:12px;">
                              *  Pilot Certificate Verification<br/>
                              *  Pilot Medical Certification Record<br/>
                              *  Pilot Employer Record (5 year)<br/>
                              *  Drug and Alcohol (5 year)<br/>
                              *  National Driver Registry<br/><br/>
            <b> The PRIA and aviation background check forms are located here to Download</b><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-10.pdf") . '" target="_blank"> FAA GOV PILOT FORM-10</a><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-10A.pdf") . '" target="_blank"> FAA GOV PILOT FORM-10A</a><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-11.pdf") . '" target="_blank"> FAA GOV PILOT FORM-11</a><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-11A.pdf") . '" target="_blank"> FAA GOV PILOT FORM-11A</a><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-12.pdf") . '" target="_blank"> FAA GOV PILOT FORM-12</a><br/>
             <a class="vd_blue" href="' . site_url("/upload/forms/faa8060-13.pdf") . '" target="_blank"> FAA GOV PILOT FORM-13</a><br/>
             these are 6 word document forms that correspond to the background checks available on AeroNet.
                                 </a></p>',
                "addon" => '2',
            ],
            PIPLE_STEP_DRIVING_RECORDS_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_DRIVING_RECORDS_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_DRIVING_RECORDS_CHECK_PROVIDED),
                "text" => 'Driving Records Check + National Driver Registry  <p style="font-size:12px;"><br/>
 <a class="vd_blue" href="' . site_url("/upload/DOCS/Disclosure and Authorisation Form UK.pdf") . '" target="_blank">
 Download BACKGROUND SCREENING DISCLOSURE & AUTHORIZATION DOC   </a></br></p>',
                "addon" => '3',
            ],
            PIPLE_STEP_MOTOR_RECORDS_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_MOTOR_RECORDS_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_MOTOR_RECORDS_CHECK_PROVIDED),
                "text" => 'Motor Vehicle Records  <p style="font-size:12px;"><br/>
 <a class="vd_blue" href="' . site_url("/upload/DOCS/Disclosure and Authorisation Form UK.pdf") . '" target="_blank">
 Download BACKGROUND SCREENING DISCLOSURE & AUTHORIZATION DOC   </a></br></p>',
                "addon" => '4',

            ],
            PIPLE_STEP_CRIMINAL_RECORDS_CHECK_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_CRIMINAL_RECORDS_CHECK_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_CRIMINAL_RECORDS_CHECK_PROVIDED),
                "text" => 'Criminal Background Check + County Criminal, Misdemeanor and Felony Records Search <p style="font-size:12px;"><br/>
 <a class="vd_blue" href="' . site_url("/upload/DOCS/Disclosure and Authorisation Form UK.pdf") . '" target="_blank">
 Download BACKGROUND SCREENING DISCLOSURE & AUTHORIZATION DOC   </a></br></p>',
                "addon" => '5',
            ],
            PIPLE_STEP_RESUME_VERIFICATION_REQUESTED => [
                "sent" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_RESUME_VERIFICATION_REQUESTED),
                "answered" => $this->Model_cts->GetPiplineStatus($appId, PIPLE_STEP_RESUME_VERIFICATION_PROVIDED),
                "text" => 'Resume Verifications per institution or reference <p style="font-size:12px;">
                              * Education<br/>
                              * Employment<br/>
                              * Employment Gap Review<br/>
                              * Professional References<br/><br/>
                               <a class="vd_blue" href="' . site_url("/upload/DOCS/Disclosure and Authorisation Form UK.pdf") . '" target="_blank"> Download BACKGROUND SCREENING DISCLOSURE & AUTHORIZATION DOC   </a>                                    </b>

                           </p> ', "addon" => '6',
            ]
        ];

        foreach ($piplelineBackground as $key => $step) :
            // echo('<br/>'.$step["text"]);
            if ($piplelineBackground[$key]["sent"] != L8_INSERT_ERROR) :
                echo ('<br/>' . $step["addon"]);
                $questions = $step["text"];
                $addons = $step["addon"];
                $type = $key;
                $vid = 0;
            endif;
        endforeach;

        if ($this->input->post('action') == 'submit_video') {
            $this->Model_cts->SaveBackgroundUpload($appId, $type + 1);
        }
        $pipelineAnswered = $this->Model_cts->GetPiplineStatus($appId, $type + 1);

        if ($addons == '1' or $addons == '2') :
            for ($i = 1; $i <= 6; $i++) :
                if ($this->input->post('action') == 'submit_video' . $i) {
                    $this->Model_cts->SaveBackgroundUpload($appId, 'doc' . $i);
                }
                $upl = $this->Model_cts->GetPiplineStatus($appId, 'doc' . $i);
                if ($upl == 1) {
                    $vid = $i;
                }

                $pipelineAnswered = $this->Model_cts->GetPiplineStatus($appId, 'doc' . $i);
                $answers[] = $this->Model_cts->GetPiplineStatus($appId, 'doc' . $i);
                echo $answers[$i];
            endfor;
        endif;


        $applicant = $this->Model_job_new->GetApplicant($this->session->userdata('user_id'));
        $department = $this->Model_subscription->Get($job->user_id);
        $application = $this->Model_job_new->GetApplication($this->session->userdata('user_id'), decrypt($id));


        $this->load->view('main', array('view' => 'cts/background-upload', 'data' => array('job' => $job, 'applicant' => $applicant, 'showSideBar' => true, 'department' => $department, 'application' => $application, 'questions' => $questions, 'addons' => $addons,'video' => $vid,'pipelineAnswered' => $pipelineAnswered)));
    }

    /* Subscription methods */

    public function subscription_addon_add($id, $addon)
    {
        $this->Model_subscription->SaveSubscriptionAddons($id, $addon);
        push_message('You have subscribed to the addon successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
