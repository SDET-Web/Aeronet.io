<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class enlist extends CI_Controller {

	public function aircraft()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('name',$this->input->post('search'))->or_like('mfr_name',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('directory_aircrafts')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'aircraft';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'aircraft','data'=>array('import'=>'aircraft_upload','controller'=>'aircraft','view'=>'aircraft/list','data'=>$records)));
	}

	public function maker(){
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('manufacturer',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('directory_manufacturer')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'maker';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'maker','data'=>array('controller'=>'maker','view'=>'manufacturer/list','data'=>$records)));
	}

	public function model()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('model',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('directory_models')->join('directory_manufacturer','directory_manufacturer.maker_id = directory_models.maker_id')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'model';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'model','data'=>array('controller'=>'model','view'=>'model/list','data'=>$records)));
	}

	public function airport()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('AIRPORT',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('directory_airports')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'airport';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'airport','data'=>array('import'=>'airfile_upload','controller'=>'airport','view'=>'airport/list','data'=>$records)));
	}

	public function pilot()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('user_fname',$this->input->post('search'))->or_like('user_lname',$this->input->post('search'));
		}
		$records['records'] = $this->db->select('user.*,(SELECT count(course_id) FROM user_course WHERE user_course.user_id = user.user_id) AS course_count')->from('user')->where('user_type','p')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'pilot';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'pilot','data'=>array('controller'=>'pilot','view'=>'pilot/list','data'=>$records)));
	}

	public function nonpilot()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('user_fname',$this->input->post('search'))->or_like('user_lname',$this->input->post('search'));
		}
                $tnames = array('p', 'd');
		$records['records'] = $this->db->select('user.*,(SELECT count(course_id) FROM user_course WHERE user_course.user_id = user.user_id) AS course_count')->from('user')->where_not_in('user_type',$tnames)->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'nonpilot';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'nonpilot','data'=>array('controller'=>'nonpilot','view'=>'pilot/list','data'=>$records)));
	}



	public function pilot_aircraft()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('user_aircraft.name',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('user_aircraft')->join('user','user.user_id = user_aircraft.user_id')->join('directory_aircrafts','directory_aircrafts.id = user_aircraft.aircraft_id')->where('user_type !=','d')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'pilot_aircraft';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'pilot_aircraft','data'=>array('controller'=>'pilot_aircraft','view'=>'pilot/aircraft/list','data'=>$records)));
	}

	public function directory_pilot()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('first_name',$this->input->post('search'))->or_like('last_name',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('directory_pilot')->where('type',0)->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'directory_pilot';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'directory_pilot','data'=>array('import'=>'pilot_upload','controller'=>'pilot_directory','view'=>'pilot_directory/list','data'=>$records)));
	}

	public function nonpilot_directory()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('first_name',$this->input->post('search'))->or_like('last_name',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('directory_pilot')->where('type',1)->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'nonpilot_directory';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'nonpilot_directory','data'=>array('import'=>'pilot_upload','controller'=>'nonpilot_directory','view'=>'nonpilot_directory/list','data'=>$records)));
	}

	public function department()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('user_fname',$this->input->post('search'))->or_like('user_lname',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('user')->where('user_type','d')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'department';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'department','data'=>array('controller'=>'department','view'=>'department/list','data'=>$records)));
	}

	public function directory_deptartment()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('company',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('directory_deptartment')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'directory_deptartment';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'directory_department','data'=>array('import'=>'department_upload','controller'=>'directory_department','view'=>'directory_department/list','data'=>$records)));
	}

	public function department_aircraft()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('name',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('user_aircraft')->join('user','user.user_id = user_aircraft.user_id')->join('directory_aircrafts','directory_aircrafts.id = user_aircraft.aircraft_id')->where('user_type','d')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'department_aircraft';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'department_aircraft','data'=>array('controller'=>'department_aircraft','view'=>'department/aircraft/list','data'=>$records)));
	}

	public function job()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('job_desc',$this->input->post('search'));
		}

		$records['records'] = $this->db->from('job')->join('directory_models','directory_models.model_id = job.job_model')->join('directory_manufacturer','directory_manufacturer.maker_id = job.job_make')->join('user','user.user_id = job.user_id')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'job';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'job','data'=>array('controller'=>'job','view'=>'job/list','data'=>$records)));
	}

	public function application()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('app_subject',$this->input->post('search'));
			$this->db->or_like('app_message',$this->input->post('search'));
		}

		$records['records'] = $this->db->from('job_application')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'application';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'application','data'=>array('controller'=>'application','view'=>'application/list','data'=>$records)));
	}

	public function connection()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('app_subject',$this->input->post('search'));
			$this->db->or_like('app_message',$this->input->post('search'));
		}

		$records['records'] = $this->db
			->select('CONCAT(user.user_fname, \' \' ,user.user_lname) as username, CONCAT(conn.user_fname, \' \' ,conn.user_lname) as conn, conn_status, conn_type, conn_created',FALSE)
			->from('connection')
			->join('user user','user.user_id = connection.user_id')
			->join('user conn','conn.user_id = connection.conn_id')
			->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)
			->get();
		$records['controller'] = 'connection';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'connection','data'=>array('controller'=>'connection','view'=>'community/connection/list','data'=>$records)));
	}

	public function comment()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		$records['records'] = $this->db
			->from('comment')
			->join('user','user.user_id = comment.user_id')
			->join('post','post.post_id = comment.post_id')
			->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)
			->get();
		$records['controller'] = 'comment';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'comment','data'=>array('controller'=>'comment','view'=>'community/comment/list','data'=>$records)));
	}

	public function message()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		$records['records'] = $this->db
			->select('CONCAT(user.user_fname, \' \' ,user.user_lname) as username, CONCAT(conn.user_fname, \' \' ,conn.user_lname) as conn, mess_text, mess_status, mess_created',FALSE)
			->from('message')
			->join('user user','user.user_id = message.user_id')
			->join('user conn','conn.user_id = message.mess_to')
			->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)
			->get();
		$records['controller'] = 'message';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'message','data'=>array('controller'=>'message','view'=>'community/message/list','data'=>$records)));
	}

	public function post()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		$records['records'] = $this->db->from('post')->join('user','user.user_id = post.user_id')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'post';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'post','data'=>array('controller'=>'post','view'=>'social/post/list','data'=>$records)));
	}

	public function photo()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		$records['records'] = $this->db->from('photo')->join('user','user.user_id = photo.user_id')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'photo';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'photo','data'=>array('controller'=>'photo','view'=>'social/photo/list','data'=>$records)));
	}

	public function activity()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		$records['records'] = $this->db->from('activity')->join('user','user.user_id = activity.user_id')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'activity';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'activity','data'=>array('controller'=>'activity','view'=>'social/activity/list','data'=>$records)));
	}

	public function faq()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		$records['records'] = $this->db->from('job_application')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'application';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'application','data'=>array('controller'=>'application','view'=>'application/list','data'=>$records)));
	}

	public function state()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		$records['records'] = $this->db->from('job_application')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'application';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'application','data'=>array('controller'=>'application','view'=>'application/list','data'=>$records)));
	}

	public function course($user_id)
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('course_name',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('user_course')->where('user_id',$user_id)->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'course';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'course','data'=>array('controller'=>'course/'.$user_id,'view'=>'course/list','data'=>$records)));
	}

	public function news()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		if($this->input->post('search')!=''){
			$this->db->like('course_name',$this->input->post('search'));
		}
		$records['records'] = $this->db->from('news')->order_by('news_date','desc')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'news';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'news','data'=>array('controller'=>'news','view'=>'news/list','data'=>$records)));
	}

	public function video_questions()
	{
		is_logged_in();
		$page = 0;
		if($this->input->get('page')!=''){
			$page = $this->input->get('page');
		}
		$records['records'] = $this->db->from('video_questions')->limit(RIZ_PAGE_SIZE,RIZ_PAGE_SIZE*$page)->get();
		$records['controller'] = 'video_questions';
		set_pager($this->db->last_query());
		$this->load->view('main',array('view'=>'enlist','controller'=>'video_questions','data'=>array('controller'=>'video_questions','view'=>'video_questions/list','data'=>$records)));
	}

	public function delete(){

		$controller = table_name_parser($this->input->post('controller'));
		if($controller[0] == "user") {
			$this->db->delete("jobs", ["user_id" => $this->input->post('val')]);
			$this->db->delete("message", ["user_id" => $this->input->post('val')]);
			$this->db->delete("applications", ["user_id" => $this->input->post('val')]);
		}
		$this->db->delete($controller[0],array($controller[1]=>str_replace('?delete=','',$this->input->post('val'))));
		echo '1';
	}

}
