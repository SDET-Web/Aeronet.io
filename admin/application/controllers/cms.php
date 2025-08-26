<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cms extends CI_Controller {
	public function email()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		$records['records'] = $this->db->from('email')->limit(10,10*$page)->get();
		$records['controller'] = 'email';
		set_pager($this->db->last_query());
		$this->load->view('head',array('controller'=>'email'));
		$this->load->view('cms/email/list',$records);
		$this->load->view('foot');
	}
	
	public function edit($type = '', $id = '')
	{
		is_logged_in();
		$controller = table_name_parser($type);
		$head = array('controller'=>$controller[0]);
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$data = $_POST;
			$this->db->where($controller[1],$id);
			$this->db->update($controller[0],$data);
			$head['success_msg'] = 'Updates made Successfully';
		}
		$records['records'] = $this->db->from($controller[0])->where($controller[1],$id)->get()->row();
		$records['controller'] = $controller[0];
		$this->load->view('head',$head);
		$this->load->view('cms/'.$type.'/new',$records);
		$this->load->view('foot');
	}
	
	public function add($type = ''){
		is_logged_in();
		$controller = table_name_parser($type);
		$head = array('controller'=>$controller[0]);
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$data = $_POST;
			$this->db->insert($controller[0],$data);
			$head['success_msg'] = 'Insert was Successfully';
		}
		$records['controller'] = $controller[0];
		$this->load->view('head',$head);
		$this->load->view('cms/'.$type.'/new',array('records'=>null));
		$this->load->view('foot');
	}
	
	public function faq()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		$records['records'] = $this->db->from('faq')->limit(10,10*$page)->get();
		$records['controller'] = 'faq';
		set_pager($this->db->last_query());
		$this->load->view('head',array('controller'=>'faq'));
		$this->load->view('cms/faq/list',$records);
		$this->load->view('foot');
	}
	
	public function page(){
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		$records['records'] = $this->db->from('page')->limit(10,10*$page)->get();
		$records['controller'] = 'page';
		set_pager($this->db->last_query());
		$this->load->view('head',array('controller'=>'page'));
		$this->load->view('cms/page/list',$records);
		$this->load->view('foot');
	}
}