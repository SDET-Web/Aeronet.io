<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_application extends CI_Model
{

    function browse($page = '', $target = '', $status = APP_STATUS_PENDING)
    {
        if ($page > 0) {
            $page = RIZ_PAGE_SIZE * ($page - 1);
            $this->db->limit(RIZ_PAGE_SIZE, $page);
        } elseif ($page == '') {
            $this->db->limit(RIZ_PAGE_SIZE, $page);
        }

        if ($target == '') {
            $this->db->where("user_type", $target);
        }

        if ($status != '') {
            $this->db->where("applications.status", $status);
        }

        $this->db->order_by('id desc');

        $data = $this->db
            ->select("applications.id, dir_acftref.mfr, dir_acftref.model, jobs.state, jobs.created, jobs.description, jobs.requirements, user_fname, user_lname, user_image, user_type, user_rating, user_rating_type, user_certificate")
            ->from("applications")
            ->join("user", "user.user_id = applications.user_id")
            ->join("jobs", "jobs.id = applications.job_id")
            ->join("dir_master", "jobs.aircraft_id = dir_master.id")
            ->join("dir_acftref", "dir_master.mfr_mdl_code = dir_acftref.code")
            ->get()
            ->result_array();
        return $data;


    }

    function get($id)
    {
        $id = base64_decode(urldecode($id));
        return $this->db
            ->select("applications.id, dir_master.mfr, dir_master.model, jobs.state, jobs.created, jobs.description, jobs.requirements, user_fname, user_lname, user_image, user_type, user_rating, user_type_rating, user_certificate")
            ->from("applications")
            ->join("user", "user.id = applications.user_id")
            ->join("jobs", "jobs.id = applications.job_id")
            ->join("dir_master", "jobs.aircraft_id = dir_master.id")
            ->join("dir_acftref", "dir_master.mfr_mdl_code = dir_acftref.code")
            ->where("applications.id", $id)
            ->get()
            ->row_array();
    }
    
     
            
            
     function post()
    {
        $this->form_validation->set_rules('job_id', 'Valid Job', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');

        if ($this->form_validation->run() == FALSE) {
            return array("status" => "error", "messages" => validation_errors());

        } else {
            if (count($_FILES) > 0) {
                $config['upload_path'] = './upload/member/resume';
                $config['allowed_types'] = 'pdf|doc|txt|docx|gif|png|jpg';
                $this->load->library('upload', $config);

                $file_pathz = '';

                if ($this->upload->do_upload()) {
                    $resume = $this->upload->data('orig_name');
                    $file_pathz = $actual_file;
                } else {
                    return array("status" => "error", "messages" => $this->upload->display_errors());
                }
            } else {
                $resume = $this->input->post("resume");
            }


            $data['user_id'] = $this->session->userdata('user_id');
            $data['resume'] = $resume;
            $data['message'] = $this->input->post('message');
            $data['job_id'] = $this->session->userdata('job_id');
            $data['status'] = APP_STATUS_PENDING;
            $data['created'] = time();

            if ($this->input->post('id') == '') {
                $this->db->insert('applications', $data);
                $id = $this->db->insert_id();
            } else {
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('applications', $data);
                $id = $this->input->post('id');
            }

            if ($this->input->post("has_addendum") == "y") {
                $this->load->model("Model_addendum");
                $response = $this->Model_addendum->post($id);

                if ($response["status"] == "error") {
                    $this->delete($id);
                    return $response;
                }
            }

            return array("status" => "success");
        }

    }

    public function delete($id)
    {
        $this->db->delete('applications', array('id' => $id));
        return array("status" => "success");
    }
}