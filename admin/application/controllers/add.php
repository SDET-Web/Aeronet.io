<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class add extends CI_Controller {
	public function data($type,$user = '')
	{
		is_logged_in();
		$controller = table_name_parser($type);
		$head = array('controller'=>$controller[0]);
		$head['type'] = $type;
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = $_POST;
			if (isset($_FILES)) {
				if (count($_FILES) > 0) {
					foreach ($_FILES as $key => $file) {
						if ($_FILES[$key]['name'] != '') {
							$field_name = $key;
							$config['upload_path'] = ($key == 'prod_pic' ? RIZ_ABSOLUTE_MAIN . 'upload/product/' : ($key == 'logo' || $key == 'dept_logo' ? RIZ_ABSOLUTE_MAIN . 'upload/logo/' : ($key == 'news_photo'? RIZ_ABSOLUTE_MAIN . 'upload/news/' : RIZ_ABSOLUTE_MAIN . 'upload/aircraft/')));
							$config['allowed_types'] = '*';
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload($field_name)) {
								print_r($this->upload->display_errors());
							} else {
								$dataTmp = array('upload_data' => $this->upload->data());
								//print_r($dataTmp);exit;
								$data[$key] = $dataTmp['upload_data']['file_name'];
							}
						}
					}
				}
			}
			if (isset($data['course_date'])) {
				$data['course_created'] = time();
				$data['course_date'] = date('Y-m-d',strtotime($data['course_date']));
				$user_data = $this->db->from('user')->where('user_id',$user)->get()->row_array();
				$users = $this->db->query('
					SELECT
					  user_id, user_fname, user_lname, user_email, (
						3959 * acos (
						  cos ( radians('.$user_data['user_lat'].') )
						  * cos( radians( user_lat ) )
						  * cos( radians( user_lng ) - radians('.$user_data['user_lng'].') )
						  + sin ( radians('.$user_data['user_lat'].') )
						  * sin( radians( user_lat ) )
						)
					  ) AS distance
					FROM user
					WHERE user_id != '.$user_data['user_id'].'
					HAVING distance < 100
					ORDER BY distance;
				')->result_array();
				$this->load->model('Model_email');
				foreach($users as $local){
					$this->Model_email->course_submitted($local['user_email'],$local['user_fname'].' '.$local['user_lname'], $user_data['user_id'], $user_data['user_fname'].' '.$user_data['user_lname']);
				}
			}

			if(isset($data['news_date'])){
				$data['news_date'] = ($data['news_date'] != ''?strtotime($data['news_date']):time());
				$data['news_created'] = time();
			}

			if ($user != ''){
				$data['user_id'] = $user;
			}
			$this->db->insert($controller[0], $data);
			$head['success_msg'] = 'New Record added Successfully';
		}
		$records['records'] = $this->db->list_fields($controller[0]);
		$records['controller'] = $controller[0];
		$records['type'] = $type;
		$this->load->view('main',array_merge($head,array('view'=>'new','data'=>$records)));
		/*$this->load->view('head',$head);
		$this->load->view('new',$records);
		$this->load->view('foot');*/
	}
}