<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Model_job_new extends CI_Model
{
    public function Browse($page = '', $target = '', $status = JOB_STATUS_ACTIVE)
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
            ->select("jobs.id, dir_acftref.mfr, dir_acftref.model, jobs.state, jobs.created, jobs.user_id")
            ->from("jobs")
            ->join("user", "user.user_id = jobs.user_id")
            ->join("user_aircraft", "user_aircraft.air_id = jobs.aircraft_id")
            ->join("dir_master", "user_aircraft.aircraft_id = dir_master.id")
            ->join("dir_acftref", "dir_master.mfr_mdl_code = dir_acftref.code")
            ->where("jobs.status", $status)
            ->where("due >", time())
            ->get()
            ->result(), "pager" => set_pager_return()];
    }

    public function BrowseOpenings($page = '', $target = '', $id = 0)
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
            ->where("due >", time())
            ->where("jobs.user_id", $id)
            ->get()
            ->result(), "pager" => set_pager_return()];
    }

    public function Post($type = "j")
    {
        if ($this->input->post("action") == "postJob") {
            $this->form_validation->set_rules("aircraft", "Aircraft", "required");
            $this->form_validation->set_rules("target", "Targetted Group", "required");
            $this->form_validation->set_rules("state", "State", "required");
            // $this->form_validation->set_rules("plan", "Plan", "required");
            if ($this->form_validation->run() != FALSE) {
                $id = $this->Save($type);
                if ($id != L8_INSERT_ERROR && $id != L8_INSERT_ERROR_WITH_MESSAGE) {
                    push_message("Job saved successfully. Please choose further options.");
        $userid=$this->session->userdata("user_id");           
        $data = $this->Model_user->get_member($userid);
         if(count($data["following"]["p"]) > 0):
         foreach($data["following"]["p"] as $user): 
         //echo $user->user_id."".$user->user_fname . " " . $user->user_lname; 
         $msg="<a href=".site_url('department/'.$userid.'/career').">View Our Latest Jobs!</a>";
        $this->Model_message->insert($userid,$user->user_id,$msg);        
         endforeach;endif;
         
                    if ($type == "j") {
                        redirect("flight-dispatch-board/detail/" . encrypt($id));
                    }
                } elseif ($id != L8_INSERT_ERROR_WITH_MESSAGE) {
                    push_message("An unexpected error occured. Please try again.", true);
                }
            } else {
                push_message(validation_errors(), true);
            }
        }
    }

    public function Save($type)
    {
        $subscription = $this->session->userdata("subscription");
        $job["user_id"] = $this->session->userdata("user_id");
        $job["aircraft_id"] = $this->input->post("aircraft");
        $job["target"] = $this->input->post("target");
        $job["state"] = $this->input->post("state");
        $job["title"] = $this->input->post("job_title");
        $job["description"] = nl2br($this->input->post("description"));
        $job["requirements"] = nl2br($this->input->post("requirements"));
        $job["plan"] = isset($subscription->braintree_plan) && ($subscription->braintree_plan == L8_PLAN_PREMIUM || $subscription->braintree_plan == L8_PLAN_CTS || $subscription->braintree_plan == L8_PLAN_PREMIUM_CTS) ? "p" : "f";
        $job["due"] = strtotime("+1 month");
        $job["type"] = $type;

        if ($this->input->post('is_fulltime') != null) {
            $job['is_fulltime'] = $this->input->post('is_fulltime');
            $job['hours'] = $this->input->post('hours');
            $job['far'] = $this->input->post('far');
            $job['distance'] = $this->input->post('state');
            $job['college'] = $this->input->post('college');
            $job['masters'] = $this->input->post('masters');
            $job['volunteer'] = $this->input->post('volunteer');
            $job['salary_range'] = $this->input->post('salary');
            $job['benefits'] = $this->input->post('benefits');

            $job['pilot_0'] = $this->input->post('pilot_0');
            $job['pilot_1'] = $this->input->post('pilot_1');
            $job['pilot_2'] = $this->input->post('pilot_2');
            $job['pilot_3'] = $this->input->post('pilot_3');
            $job['pilot_4'] = $this->input->post('pilot_4');
            $job['pilot_5'] = $this->input->post('pilot_5');
            $job['pilot_6'] = $this->input->post('pilot_6');
            $job['mechanic_0'] = $this->input->post('mechanic_0');
            $job['mechanic_1'] = $this->input->post('mechanic_1');
            $job['mechanic_2'] = $this->input->post('mechanic_2');
            $job['mechanic_3'] = $this->input->post('mechanic_3');
            $job['flight_0'] = $this->input->post('flight_0');
            $job['flight_1'] = $this->input->post('flight_1');
            $job['flight_2'] = $this->input->post('flight_2');
            $job['flight_3'] = $this->input->post('flight_3');
            $job['flight_4'] = $this->input->post('flight_4');
            $job['dispatcher_0'] = $this->input->post('dispatcher_0');
            $job['dispatcher_1'] = $this->input->post('dispatcher_1');
        }


        $job["created"] = time();

        if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != "") {
            $upload = $this->Model_upload->upload(UPLOAD_PATH . '/aircraft', 'userfile');
            if ($upload["status"] == "success") {
                $job["photo"] = $upload["filename"];
            } else {
                push_message($upload["messages"], true);
                return L8_INSERT_ERROR_WITH_MESSAGE;
            }
        }

        if ($this->db->insert("jobs", $job)) {
            $id = $this->db->insert_id();

            return $id;
        } else {
            return L8_INSERT_ERROR;
        }
    }

    public function Get($id)
    {
        $job = $this->db
            ->select("jobs.*, dir_acftref.mfr, dir_acftref.model")
            ->from("jobs")
            ->join("user_aircraft", "user_aircraft.air_id = jobs.aircraft_id")
            ->join("dir_master", "user_aircraft.aircraft_id = dir_master.id")
            ->join("dir_acftref", "dir_master.mfr_mdl_code = dir_acftref.code")
            ->where("jobs.id", $id)->get();
        if ($job->num_rows() > 0) {
            return $job->row();
        } else {
            return L8_INSERT_ERROR;
        }
    }

    public function PostAddon($id)
    {
        $this->SaveAddon($id, 'r');
        if ($this->input->post("action") == "postAddons") {
            if (count($this->input->post("addon")) > 0) {
                foreach ($this->input->post("addon") as $addon) {
                    $this->SaveAddon($id, $addon);
                }
            }
        }
    }

    public function SaveAddon($id, $addon)
    {
        $job["job_id"] = $id;
        $job["type"] = $addon;
        $job["price"] = plan_addons($addon)["amount"];
        $job["created"] = time();
        if ($this->db->insert("job_addons", $job)) {
            return $this->db->insert_id();
        } else {
            return L8_INSERT_ERROR;
        }
    }

    public function BrowseApplication($page = '', $target = '', $status = JOB_STATUS_ACTIVE, $duration = 1, $type = 'j')
    {
        if ($page > 0) {
            $page = RIZ_PAGE_SIZE * ($page - 1);
            $this->db->limit(RIZ_PAGE_SIZE, $page);
        } elseif ($page == '') {
            $this->db->limit(RIZ_PAGE_SIZE, $page);
        }

        if($target == 'p') {
            $this->db->where("(jobs.target = 'p' OR jobs.target = 'c' OR jobs.target = 'o')", null, true);
        }else if ($target != '') {
            $this->db->where("jobs.target", $target);
        }

        if ($status != '') {
            $this->db->where("applications.status", $status);
        }

        if ($type != '') {
            $this->db->where("applications.type", $type);
        }
        $this->db->order_by('id desc');

        return $this->db
            ->select("applications.id, dir_acftref.mfr, dir_acftref.model, jobs.id as job_id, jobs.plan, jobs.state, applications.created, applications.updated, jobs.description, jobs.requirements, user_fname, user_lname, user_image, user_type, user_rating, user_rating_type, user_certificate")
            ->from("applications")
            ->join("user", "user.user_id = applications.user_id")
            ->join("jobs", "jobs.id = applications.job_id")
            ->join("user_aircraft", "user_aircraft.air_id = jobs.aircraft_id")
            ->join("dir_master", "user_aircraft.aircraft_id = dir_master.id")
            ->join("dir_acftref", "dir_master.mfr_mdl_code = dir_acftref.code")
            ->where("jobs.due >", time())
            ->where("user_type !=", "d")  
            ->where("jobs.user_id", $this->session->userdata("user_id"))
            ->get()
            ->result_array();

    }

    public function PostApplication($job, $resume = '')
    {
       // if ($this->input->post("action") == "postApplication") {
           // $this->form_validation->set_rules('message', 'Message', 'required');
            if ($resume == '' && !isset($_FILES['resume']['name'])) {
                $this->form_validation->set_rules('resume', 'Document', 'required');
            }
            if ($this->form_validation->run() != FALSE) {
                $id = $this->SaveApplication($job, $resume);
                if ($id != L8_INSERT_ERROR && $id != L8_INSERT_ERROR_WITH_MESSAGE) {
                    push_message("Application has been posted successfully. Please give us sometime to go throught the application.");
                   // redirect("flight-dispatch-board");
                } elseif ($id != L8_INSERT_ERROR_WITH_MESSAGE) {
                    push_message("An unexpected error occured. Please try again.", true);
                }
            } else {
                push_message(validation_errors(), true);
            }
        //}
    }

    public function PutApplication($job, $resume = '')
    {
        if ($this->input->post("action") == "postApplication") {
            $id = $this->SaveApplication($job, $resume);
            if ($id != L8_INSERT_ERROR && $id != L8_INSERT_ERROR_WITH_MESSAGE) {
                push_message("Application has been updated successfully.");
                redirect("flight-dispatch-board");
            } elseif ($id != L8_INSERT_ERROR_WITH_MESSAGE) {
                push_message("An unexpected error occured. Please try again.", true);
            }
        }
    }

    public function SaveApplication($job, $resume, $type = "j", $user = 0)
    {
        $user = $user == 0 ? $this->session->userdata('user_id') : $user;
        $application = $this->Model_job_new->GetApplication($user, $job);
        if ($application == L8_INSERT_ERROR) {

            $data['user_id'] = $user;
            $data['job_id'] = $job;
            $data['message'] = $this->input->post('message');
            $data['type'] = $type;
            $data["created"] = time();
            $data["updated"] = time();


            if ($resume == '' && isset($_FILES['resume']['name'])) {
                $upload = $this->Model_upload->upload(UPLOAD_PATH . '/member/resume', 'resume');
                if ($upload["status"] == "success") {
                    $data["resume"] = $upload["filename"];
                } else {
                    push_message($upload["messages"], true);
                    return L8_INSERT_ERROR_WITH_MESSAGE;
                }
            } else if ($resume != '') {
                $data["resume"] = $resume;
            }


            if ($this->db->insert("applications", $data)) {
                $id = $this->db->insert_id();
                $this->SaveMessage($this->session->userdata("user_id"), $id, $this->input->post("message"));
                $this->UpdatePipline($id, L8_PIPELINE_STEP_APPLIED, '');
                $this->SaveAddendum($id,$job);
                return $id;
            } else {
                return L8_INSERT_ERROR;
            }
        } else {
            $appId = $application->id;
        }

    }

    public function GetApplication($user, $job)
    {
        $application = $this->db->from('applications')->where('user_id', $user)->where('job_id', $job)->get();
        if ($application->num_rows() > 0) {
            return $application->row();
        } else {
            return L8_INSERT_ERROR;
        }
    }

    public function GetApplicationById($id)
    {
        $application = $this->db->from('applications')->where('id', $id)->get();
        if ($application->num_rows() > 0) {
            return $application->row();
        } else {
            return L8_INSERT_ERROR;
        }
    }

    public function PostApplicationAccept($applicationId)
    {
        $this->UpdatePipline($applicationId, PIPLE_STEP_ACCEPTED);
        $this->db->where('id', $applicationId);
        return $this->db->update('applications', ['status' => APP_STATUS_QUALIFIED, 'updated' => time()]);
    }

    public function PostApplicationShortlisted($applicationId)
    {
        $this->UpdatePipline($applicationId, PIPLE_STEP_SHORT_LISTED, "");
        $this->db->where('id', $applicationId);
        return $this->db->update('applications', ['status' => APP_STATUS_FEEDBACK, 'updated' => time()]);
    }

    public function PostApplicationDeclined($applicationId, $textarea)
    {
        $this->UpdatePipline($applicationId, PIPLE_STEP_DECLINED, $textarea);
        $this->db->where('id', $applicationId);
        return $this->db->update('applications', ['status' => '-', 'updated' => time()]);
    }

    public function PostApplicationDisqualify($applicationId, $textarea)
    {
        $this->UpdatePipline($applicationId, PIPLE_STEP_DECLINED, $textarea);
        $this->db->where('id', $applicationId);
        return $this->db->update('applications', ['status' => 'd', 'updated' => time()]);
    }

    public function GetApplicant($id)
    {
        $user = array();
        $user_account = $this->db->from('user')->where('user_id', $id)->get();
        if ($user_account->num_rows() > 0) {
            $user = $user_account->row();
            $user->addendum = $this->GetAddendum($id);
            $user->flightTime = $this->GetFlightTime($id);
            return $user;
        } else {
            return L8_INSERT_ERROR;
        }

    }

    public function GetAddendum($id)
    {
        $addendum = $this->db->from('application_addendums')->where('user_id', $id)->get();
        if ($addendum->num_rows() > 0) {
            return $addendum->row();
        } else {
            return (object)array();
        }
    }

    public function SaveAddendum($applicationId,$jobId)
    {
        $data['cover_letter'] = $this->input->post('coverLetter');
        $data['organization'] = $this->input->post('organization');
        $data['organization_detail'] = $this->input->post('organization_detail');
        $data['interviewed'] = $this->input->post('interviewed');
        $data['interviewed_detail'] = $this->input->post('interviewed_detail');
        $data['employed'] = $this->input->post('employed');
        $data['employed_detail'] = $this->input->post('employed_detail');
        $data['employed_position'] = $this->input->post('employed_position');
        $data['Recommendation'] = $this->input->post('Recommendation');
        $data['Recommendation_detail'] = $this->input->post('Recommendation_detail');
        $data['arrested'] = $this->input->post('arrested');
        $data['arrested_date'] = $this->input->post('arrested_date');
        $data['arrested_charge'] = $this->input->post('arrested_charge');
        $data['arrested_disposition'] = $this->input->post('arrested_disposition');
        $data['job_function'] = $this->input->post('job_function');
        $data['drug_test'] = $this->input->post('drug_test');
        $data['alcohol_test'] = $this->input->post('alcohol_test');
        $data['pre_employment_test'] = $this->input->post('pre_employment_test');
        $data['barred'] = $this->input->post('barred');
        $data['license'] = $this->input->post('license');
        $data['license_explain'] = $this->input->post('license_explain');
        $data['license_nature'] = $this->input->post('license_nature');
        $data['license_date'] = $this->input->post('license_date');
        $data['license_country'] = $this->input->post('license_country');
        $data['license_state'] = $this->input->post('license_state');
        $data['fined'] = $this->input->post('fined');
        $data['fined_explain'] = $this->input->post('fined_explain');
        $data['fined_nature'] = $this->input->post('fined_nature');
        $data['fined_date'] = $this->input->post('fined_date');
        $data['fined_country'] = $this->input->post('fined_country');
        $data['fined_state'] = $this->input->post('fined_state');
        $data['fined_extra'] = $this->input->post('fined_extra');
        $data['involved'] = $this->input->post('involved');
        $data['involved_explain'] = $this->input->post('involved_explain');
        $data['administered'] = $this->input->post('administered');
        $data['administered_explain'] = $this->input->post('administered_explain');
        $data['failed'] = $this->input->post('failed');
        $data['failed_explain'] = $this->input->post('failed_explain');
        $data['checkride'] = $this->input->post('checkride');

        if ($this->GetAddendum($this->session->userdata('user_id')) == (object)array()) {
            $this->db->insert('application_addendums', array_merge($data, ['user_id' => $this->session->userdata('user_id'),'application_id' => $applicationId,'job_id' => $jobId]));

        } else {
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->update('application_addendums', array_merge($data, ['user_id' => $this->session->userdata('user_id')]));
        }

        
    }

    public function BrowseMessage($applicationId)
    {
        $this->db->order_by('id desc');

        return $this->db
            ->select('application_messages.message, application_messages.created, user.user_id, user.user_image, user.user_type')
            ->from("application_messages")
            ->join("user", "user.user_id = application_messages.user_id")
            ->where("application_id", $applicationId)
            ->get()
            ->result_array();
    }

    public function SaveMessage($userId, $applicationId, $message)
    {
        $data = [];
        $data["user_id"] = $userId;
        $data["application_id"] = $applicationId;
        $data["message"] = $message;
        $data["created"] = time();
        return $this->db->insert("application_messages", $data);
    }

    public function UpdatePipline($application, $step, $response = '')
    {
        $data['step'] = $step;
        $data['application_id'] = $application;
        $data['response'] = $response;
        $data['created'] = time();
        $this->db->insert('application_pipline', $data);
    }

    public function Delete($id)
    {
        $this->db->delete("jobs", ["user_id" => $this->session->userdata("user_id"), "id" => $id]);
    }

    private function GetFlightTime($id)
    {
        $result = [];
        $data = $this->db->from('user_aircraft')->where('user_id', $id)->get()->result();
        foreach ($data as $item) {
            $result[$item->name] = $item->total;
        }
        if(count($result) > 0) {
          $result["maxFlight"] = max($result);

          $data = $this->db->from('user_flighttime')->where('user_id', $id)->get()->result();
          foreach ($data as $item) {
              $result['total'][$item->time_key] = $item->time_val;
          }
        }
        return $result;
    }

      
}
