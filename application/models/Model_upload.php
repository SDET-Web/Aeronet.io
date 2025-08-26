<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Model_upload extends CI_Model
{
    public function Upload($path, $field, $status = JOB_STATUS_ACTIVE, $types = 'gif|jpg|png|jpeg')
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = $types;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($field)) {
            return array('status' => 'error', 'messages' => $this->upload->display_errors());
            return FALSE;
        } else {
            $data = $this->upload->data();
            return array('status' => 'success', 'filename' => $data['file_name'], 'path' => $data['full_path']);
        }
    }
}
