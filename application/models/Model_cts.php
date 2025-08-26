<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_cts extends CI_Model
{

    public function Browse($id, $page = '', $target = '')
    {
        if ($page != '') {
            $page = RIZ_PAGE_SIZE * ($page - 1);
            $this->db->limit(RIZ_PAGE_SIZE, $page);
        } else {
            $this->db->limit(RIZ_PAGE_SIZE);
        }

        if ($target != '') {
            $this->db->where("target", $target);
        }


        $this->db->order_by('id desc');

        return ["data" => $this->db
            ->select("jobs.*, dir_acftref.mfr, dir_acftref.model")
            ->from("jobs")
            ->join("user_aircraft", "user_aircraft.air_id = jobs.aircraft_id")
            ->join("dir_master", "user_aircraft.aircraft_id = dir_master.id")
            ->join("dir_acftref", "dir_master.mfr_mdl_code = dir_acftref.code")
            ->where("jobs.type", "d")
            //->where("due >", time())
            ->where("jobs.user_id", $id)
            ->get()
            ->result(), "pager" => set_pager_return()];
    }

    public function CTSAcceptingStatus()
    {
        if ($this->input->get("hiring") != "") {
            $this->db->where("user_id", $this->session->userdata("user_id"))->update("user", ["user_hiring" => $this->input->get("hiring")]);
        }
        if ($this->input->get("application") != "") {
            $this->db->where("user_id", $this->session->userdata("user_id"))->update("user", ["user_accepting_application" => $this->input->get("application")]);
        }
    }

    public function CareerSubmit($id = '')
    {
        $this->CTSAcceptingStatus();
        $this->Model_job_new->Post("d");

        if ($this->input->get("delete") != "") {
            $this->Model_job_new->Delete($this->input->get("delete"));
            redirect("careers");
        }

        if ($this->input->get("apply") != "") {
            $this->Model_job_new->SaveApplication($this->input->get("apply"), $this->session->userdata("user_resume"), "d");
            if ($id != '') {
                redirect("careers/" . $id);
            }
        }
    }

    public function SaveAddendum($application, $resume = '')
    {
        if ($this->input->post("action") == "postApplication") {
            $this->Model_job_new->SaveAddendum($application);
            $this->Model_job_new->UpdatePipline($application, PIPLE_STEP_INTERVIEW_PROVIDED, '');
            if ($id != L8_INSERT_ERROR && $id != L8_INSERT_ERROR_WITH_MESSAGE) {
                push_message("Application has been updated successfully.");
                redirect("candidate-tracking/addendum/" . encrypt($application));
            } elseif ($id != L8_INSERT_ERROR_WITH_MESSAGE) {
                push_message("An unexpected error occured. Please try again.", true);
            }
        }
    }



    public function ApplicantApplications()
    {
        $results = [];
        $jobs = $this->db->select("job_id")->from("applications")->where("type", "d")->where("user_id", $this->session->userdata("user_id"))->get()->result_array();
        foreach ($jobs as $job) {
            $results[] = $job["job_id"];
        }
        return $results;
    }
    public function userApplicantApplications($userid)
    {

        $results = [];
        $jobs = $this->db->select("job_id")->from("applications")->where("user_id", $userid)->get()->result_array();
        foreach ($jobs as $job) {
            $results[] = $job["job_id"];
        }
        return $results;
    }

    public function Accept($applicationId)
    {
        $application = $this->Model_job_new->GetApplicationById($applicationId);
        $applicant = $this->Model_job_new->GetApplicant($application->user_id);
        $this->UpdatePipline($applicationId, PIPLE_STEP_ACCEPTED);
        $this->db->where('id', $applicationId);
        if ($this->db->update('applications', ['status' => APP_STATUS_QUALIFIED, 'updated' => time()])) {
            $this->Model_email->application_accept($applicant->user_email, $applicant->user_fname . ' ' . $applicant->user_lname);
        }
    }

    public function Shortlist($applicationId)
    {
        // $application = $this->GetApplicationById($applicationId);
        //$applicant = $this->GetApplicant($application->user_id);
        $application = $this->Model_job_new->GetApplicationById($applicationId);
        $applicant = $this->Model_job_new->GetApplicant($application->user_id);
        //$job = $this->Get($application->job_id);
        $this->Model_email->application_shortlisted($applicant->user_email, $applicant->user_fname . ' ' . $applicant->user_lname, $application->user_id, $job->title);

        $this->Model_job_new->UpdatePipline($applicationId, PIPLE_STEP_SHORT_LISTED, "");
        $this->db->where('id', $applicationId);
        return $this->db->update('applications', ['status' => APP_STATUS_FEEDBACK, 'updated' => time()]);
    }

    public function VideoInterview($applicationId)
    {
        $this->db->where('id', $applicationId);
        return $this->db->update('applications', ['status' => APP_STATUS_VIDEO, 'updated' => time()]);
    }

    public function Background($applicationId)
    {
        $this->db->where('id', $applicationId);
        return $this->db->update('applications', ['status' => APP_STATUS_BACKGROUND, 'updated' => time()]);
    }

    public function Screening($applicationId, $action)
    {
        if ($action == 'addendum_send') {
            $this->SendAddendum($applicationId);
            push_message('Addendums has been sent successfully');
        } elseif ($action == 'accept') {
            $this->Accept($applicationId);
            push_message('Application has been accepted successfully');
        } elseif ($action == 'video') {
            $this->VideoInterview($applicationId);
            push_message('Application has been added to video interview list successfully');
        } elseif ($action == 'background') {
            $this->Background($applicationId);
            push_message('Application has been added to background check list successfully');
        }
        return true;
    }

    private function SendAddendum($applicationId)
    {
        $this->Model_job_new->UpdatePipline($applicationId, PIPLE_STEP_INTERVIEW_REQUESTED, "");
        $application = $this->Model_job_new->GetApplicationById($applicationId);
        $applicant = $this->Model_job_new->GetApplicant($application->user_id);
        $this->Model_email->application_addendum_request($applicant->user_email, $applicant->user_fname . ' ' . $applicant->user_lname, $applicationId);
    }

    public function SendVideoInterview($applicationId, $selectedQuestions)
    {
        $application = $this->Model_job_new->GetApplicationById($applicationId);
        $applicant = $this->Model_job_new->GetApplicant($application->user_id);
        $this->db->delete("application_video_questions", ["application_id" => $applicationId]);
        foreach ($selectedQuestions as $key => $val) {
            $this->db->insert("application_video_questions", ["application_id" => $applicationId, "question_id" => $key, "created" => time(), "updated" => time()]);
        }
        $this->Model_email->application_video_interview_request($applicant->user_email, $applicant->user_fname . ' ' . $applicant->user_lname, $application->job_id, $selectedQuestions, $application->user_id);
        $this->Model_job_new->UpdatePipline($applicationId, PIPLE_STEP_VIDEO_INTERVIEW_REQUESTED, "");
        return true;
    }

    public function SaveVideoUpload($id)
    {
        $upload = $this->Model_upload->upload(UPLOAD_PATH . 'member/resume', 'videofile', JOB_STATUS_ACTIVE, 'wmv|rv|jp2|j2k|jpf|jpg2|jpx|jpm|mj2|mjp2|mpeg|mpg|mpe|qt|mov|avi|movie|3g2|3gp|mp4|f4v|flv|ogg');
        if ($upload["status"] == "success") {
            $this->Model_job_new->UpdatePipline($id, PIPLE_STEP_VIDEO_INTERVIEW_PROVIDED, $upload["filename"]);
            push_message('Your video has been uploaded successfully' . $upload["filename"] . $id);
        } else {
            push_message($upload["messages"], true);
            return L8_INSERT_ERROR_WITH_MESSAGE;
        }
    }

    public function SaveBackgroundUpload($id, $type)
    {
        $upload = $this->Model_upload->upload(UPLOAD_PATH . 'member/resume', 'videofile', JOB_STATUS_ACTIVE, '*');
        if ($upload["status"] == "success") {
            $this->Model_job_new->UpdatePipline($id, $type, $upload["filename"]);
            push_message('Your video has been uploaded successfully');
        } else {
            push_message($upload["messages"], true);
            return L8_INSERT_ERROR_WITH_MESSAGE;
        }
    }

    public function SendBackgroundCheckForm($applicationId, $type)
    {
        $application = $this->Model_job_new->GetApplicationById($applicationId);
        $applicant = $this->Model_job_new->GetApplicant($application->user_id);
        $this->Model_email->application_background_check_request($applicant->user_email, $applicant->user_fname . ' ' . $applicant->user_lname, $application->job_id, $type, $application->user_id);
        $this->Model_job_new->UpdatePipline($applicationId, $type);
        return true;
    }

    public function GetPiplineStatus($applicationId, $step)
    {
        $pipelineStep = $this->db->from('application_pipline')->where('application_id', $applicationId)->where('step', $step)->get();
        if ($pipelineStep->num_rows() > 0) {
            return $pipelineStep->row();
        } else {
            return L8_INSERT_ERROR_WITH_MESSAGE;
        }
    }

    public function GetApplicationVideoQuestion($applicationId)
    {
        $questions_rows = $this->db->from("application_video_questions")->where("application_id", $applicationId)->get()->result_array();
        $questions = [];
        foreach ($questions_rows as $question) {
            $questions[] = $question["question_id"];
        }
        return $this->Model_cts->GetVideoQuestions($questions);
    }

    public function GetVideoQuestions($selected = [])
    {
        $result = [];
        if (count($selected) > 0) {
            $this->db->where_in("id", $selected);
        }
        $data = $this->db->from('video_questions')->get()->result();
        foreach ($data as $item) {
            if ($item->question <> '') {
                $result[$item->id] = $item->question;
            }
        }
        return $result;
    }


    public function GetMatchedMembers($type = '')
    {
        $typeRatings = [];
        $where = "";
        if ($type != '') {
            $this->db->where("jobs.target", $type);
        }
        $data = $this->db->select("jobs.id, user_aircraft.aircraft_id, aircraft_type_rating, jobs.title")->from("jobs")->join("user_aircraft", "jobs.aircraft_id = user_aircraft.air_id")->join("dir_master", "user_aircraft.aircraft_id = dir_master.id")->where("jobs.user_id", $this->session->userdata("user_id"))->where("jobs.type", "d")->get()->result_array();
        foreach (array_column($data, "aircraft_type_rating") as $t) {
            foreach (explode(",", $t) as $r) {
                $typeRatings[] = $r;
            }
        }
        $pilots = $this->db->from("user");
        if ($type == '') {
            $pilots->where("user_type !=", "d");
        } else {
            $pilots->where("user_type", $type);
        }
        if (count($typeRatings) > 0) {
            $where .= "(";
            foreach ($typeRatings as $r) {
                $where .= "user_rating_type LIKE '%" . $r . "%' OR ";
            }
            $where = substr($where, 0, -3) . ")";
            $this->db->where($where, '', FALSE);
        }
        $users = $this->db->get()->result_array();
        foreach ($users as $key => $user) {
            foreach ($data as $job) {
                if (isset($job["user_rating_type"]) && $job["user_rating_type"] != "" && isset($job["aircraft_type_rating"]) && $job["aircraft_type_rating"] != "" && strpos($user["user_rating_type"], $job["aircraft_type_rating"]) !== FALSE || strpos($job["aircraft_type_rating"], $user["user_rating_type"]) !== FALSE) {
                    $users[$key]["job"] = $job;
                }
            }
        }
        return $users;
    }

   
    public function GetMatchedDepartments($inputRatings, $aircrafts = [])
    {
        $typeRatings = [];
        $where = "";

        if (count($inputRatings) > 0) {
            $where .= "(";
            foreach ($inputRatings as $r) {
                $where .= "type_rating LIKE '%" . $r . "%' OR ";
            }
            $where = substr($where, 0, -3) . ")";
        }


        $data = $this->db->from("dir_nnumber_model_type_rating")->where($where, "", FALSE)->get()->result_array();
        if (count(array_merge($aircrafts, array_column($data, "id"))) > 0) {
            $users = $this->db->distinct()->select("user.*")->from("user")->join('user_aircraft', 'user_aircraft.user_id = user.user_id')->where("user_type", "d")->where_in('user_aircraft.aircraft_id', array_merge($aircrafts, array_column($data, "id")))->get()->result_array();
        } else {
            $users = [];
        }
        return $users;
    }

    public function UpdatePipline($application, $step, $response = '')
    {
        $data['step'] = $step;
        $data['application_id'] = $application;
        $data['response'] = $response;
        $data['created'] = time();
        $this->db->insert('application_pipline', $data);
    }
}
