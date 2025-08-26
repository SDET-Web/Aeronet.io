<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_application_pipline extends CI_Model
{

    function get($application_id)
    {
        return $this->db
            ->from("application_pipline")
            ->where("application_id", $application_id)
            ->get()
            ->result_array();
    }

    function insert($application_id, $step, $response)
    {

        $data['applications_id'] = $this->session->userdata('user_id');
        $data['step'] = $resume;
        $data['message'] = $this->input->post('message');
        $data['response'] = $job_id;
        $data['created'] = time();

        if ($this->input->post('id') == '') {
            $this->db->insert('application_pipline', $data);
            $id = $this->db->insert_id();
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('application_pipline', $data);
            $id = $this->input->post('id');
        }

        return array("status" => "success");


    }

    public function delete()
    {
        $this->db->delete('job', array('id' => base64_decode(urldecode($this->input->get('id')))));
        return array("status" => "success");

    }
}