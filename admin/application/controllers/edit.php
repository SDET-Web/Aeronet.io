<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class edit extends CI_Controller {
	public function data($type, $id)
	{
		is_logged_in();
		$controller = table_name_parser($type);
		$head = array('controller'=>$controller[0]);
		$head['type'] = $type;
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$data = $_POST;
			if(isset($_FILES)){
				if(count($_FILES) > 0){
					foreach($_FILES as $key=>$file){
						if($_FILES[$key]['name']!=''){
							$field_name = $key;
							$config['upload_path'] = ($key == 'prod_pic' ? RIZ_ABSOLUTE_MAIN . 'upload/product/' : ($key == 'logo' || $key == 'dept_logo' ? RIZ_ABSOLUTE_MAIN . 'upload/logo/' : ($key == 'news_photo'? RIZ_ABSOLUTE_MAIN . 'upload/news/' : RIZ_ABSOLUTE_MAIN . 'upload/aircraft/')));
							$config['allowed_types'] = '*';
							$this->load->library('upload', $config);
							if ( ! $this->upload->do_upload($field_name)){
							}else{
								$dataTmp = array('upload_data' => $this->upload->data());
								//print_r($dataTmp);exit;
								$data[$key] = $dataTmp['upload_data']['file_name'];
							}
						}
					}
				}
			}
			if(isset($data['news_date'])){
				$data['news_date'] = ($data['news_date'] != ''?strtotime($data['news_date']):time());
				$data['news_created'] = time();
			}
			$this->db->where($controller[1],$id);
			$this->db->update($controller[0],$data);
			$head['success_msg'] = 'Updates made Successfully';
		}
		$records['records'] = $this->db->from($controller[0])->where($controller[1],$id)->get()->row_array();
		$records['controller'] = $controller[0];
		$records['type'] = $type;
		/*$this->load->view('head',$head);
		$this->load->view('edit',$records);
		$this->load->view('foot');*/
		$this->load->view('main',array_merge($head,array('view'=>'edit','data'=>$records)));

	}
}