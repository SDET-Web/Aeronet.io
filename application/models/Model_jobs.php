<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_jobs extends CI_Model
{

    function browse($page = '', $target = '', $status = JOB_STATUS_ACTIVE)
    {

        if ($page != '') {
            $page = RIZ_PAGE_SIZE * ($page - 1);
            $this->db->limit(RIZ_PAGE_SIZE, $page);
        } else {
            $this->db->limit(RIZ_PAGE_SIZE);
        }

        if ($target == '') {
            $this->db->where("target", $target);
        }

        $this->db->order_by('id desc');

        return ["data" => $this->db
            ->select("jobs.id, dir_acftref.mfr, dir_acftref.model, jobs.state, jobs.created")
            ->from("jobs")
            ->join("dir_master", "jobs.aircraft_id = dir_master.id")
            ->join("dir_acftref", "dir_master.mfr_mdl_code = dir_acftref.code")
            ->where("status", $status)
            ->get()
            ->result_array(), "pager" => set_pager_return()];

    }

    function get($id)
    {
        $id = base64_decode(urldecode($id));
        return $this->db
            ->select("jobs.id, dir_acftref.mfr, dir_acftref.model, jobs.state, jobs.created, jobs.description, jobs.requirements, user_company, user_bio, user_image")
            ->from("jobs")
            ->join("user", "user.user_id = jobs.user_id")
            ->join("dir_master", "jobs.aircraft_id = dir_master.id")
            ->join("dir_acftref", "dir_master.mfr_mdl_code = dir_acftref.code")
            ->where("jobs.id", $id)
            ->get()
            ->row_array();
    }

    function post()
    {
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('job_title', 'Job Title', 'required');
        $this->form_validation->set_rules('aircraft_id', 'Aircraft Make and Model', 'required');

        if ($this->form_validation->run() == FALSE) {
            push_message(validation_errors(), true);

        } else {
            $config['upload_path'] = './upload/job/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);

            $file_pathz = '';

            if ($this->upload->do_upload()) {
                $actual_file = $this->upload->data('orig_name');
                $file_pathz = $actual_file;
            } else {
                push_message($this->upload->display_errors(), true);
            }


            $data['user_id'] = $this->session->userdata('user_id');
            $data['aircraft_id'] = $this->input->post('aircraft_id');
            $data['state'] = $this->input->post('state');
            $data['city'] = $this->input->post('city');
            $data['address'] = $this->input->post('address');
            $data['zip'] = $this->input->post('zip');
            $data['lat'] = $this->input->post('lat');
            $data['lng'] = $this->input->post('lng');
            $data['photo'] = $file_pathz;
            $data['description'] = $this->input->post('aircraftDesc');
            $data['title'] = $this->input->post('job_title');
            $data['post_category'] = $this->input->post('post_category');
            $data['requirements'] = $this->input->post('job_requirements');
            $data['target'] = $this->input->post('type');
            $data['created'] = time();

            if ($this->input->post('id') == '') {
                $this->db->insert('job', $data);
                return array("status" => "success");
            } else {
                $this->db->where('job_id', $this->input->post('id'));
                $this->db->update('job', $data);
                return array("status" => "success");
            }
        }

    }

    public function delete($id)
    {
        $this->db->delete('job', array('id' => $id));
        push_message('Job deleted Successfully');
    }
}