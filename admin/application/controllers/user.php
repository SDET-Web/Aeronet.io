<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {
	public function index()
	{
		is_not_logged_in();
		$head = array('success_msg'=>'','error_msg'=>'');
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//echo $this->db->from('admin')->where('username',$this->input->post('userEmail'))->where('password',$this->input->post('userPassword'))->get()->num_rows();exit;
			$tmp = $this->db->from('admin')->where('username',$this->input->post('userEmail'))->where('password',$this->input->post('userPassword'))->get();
			if($tmp->num_rows() > 0){
				$this->session->set_userdata('user_id',$tmp->row()->admin_id);
				$this->session->set_userdata('name','Admin');
				$_SESSION['is_admin'] = 'yes';
				$_SESSION['user_id'] = $tmp->row()->admin_id;
				$_SESSION['name'] = $tmp->row()->username;
				redirect('user/dashboard');
			}else{
				$head['error_msg'] = 'Enter correct Credentials';				
			}
		}
		$this->load->view('user/login',$head);
	}
	
	public function forgot($msg ='')
	{
		is_not_logged_in();
		$head = array('success_msg'=>'','error_msg'=>'');
		if($msg != ''){
			$head['error_msg'] = 'You have wrong link, try again';
		}
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($this->db->from('admin')->where('email',$this->input->post('userEmail'))->get()->num_rows() > 0){
				$headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$body = 'Please follow the link <br /><a href="'.RIZ_SITE_URL.site_url('user/change/'.urlencode(base64_encode($this->input->post('userEmail')))).'">'.RIZ_SITE_URL.site_url('user/change/'.urlencode(base64_encode($this->input->post('userEmail')))).'</a>';
				mail($this->input->post('userEmail'),'Reset your Password for TimeForAWash Admin',$body,$headers);
				$head['success_msg'] = 'Email has been sent to your account';	
			}else{
				$head['error_msg'] = 'Your email doesn\'t exists';				
			}
		}
		
		$this->load->view('user/forget',$head);
	}
	
	public function change($email)
	{
		is_not_logged_in();
		$head = array('success_msg'=>'','error_msg'=>'');
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$data['password'] = $this->input->post('userPassword');
			$this->db->where('email',base64_decode(urldecode($email)));
			$this->db->update('admin',$data);
			$head['success_msg'] = 'Password changed successfully';
		}
		if($this->db->from('admin')->where('email',base64_decode(urldecode($email)))->get()->num_rows() > 0){
			$this->load->view('user/reset',$head);
		}else{
			redirect('user/forgot/msg');
		}
	}
	
	public function dashboard()
	{
		is_logged_in();
		$start = $month = strtotime(date('Y').'-01-01');
		$end = time();
		$subs = array();
		$cred = array();
		$prod = array();
		while($month < $end){
			$subs[date('M', $month)] = 0;//$this->db->select_sum('subs_amount')->from('user_subscription')->where('subs_start between '.$month.' and '.strtotime("-1 second",strtotime("+1 month", $month)),'',FALSE)->get()->row()->subs_amount;
			$cred[date('M', $month)] = 0;//$this->db->select_sum('cred_amount')->from('user_postcard_credit')->where('cred_created between '.$month.' and '.strtotime("-1 second",strtotime("+1 month", $month)),'',FALSE)->where('cred_amount IS NOT NULL','',FALSE)->get()->row()->cred_amount;
			$prod[date('M', $month)] = 0;//$this->db->select_sum('order_amount')->from('product_order')->where('order_created between '.$month.' and '.strtotime("-1 second",strtotime("+1 month", $month)),'',FALSE)->where('order_status','p')->get()->row()->order_amount;
			$month = strtotime("+1 month", $month);
		}
		
		$records['jobs'] = $this->db->count_all('job');
		$records['apps'] = $this->db->count_all('job_application');
		$records['owner'] = $this->db->select('count(user_id) as cuser')->from('user')->where('user_type', 'o')->get()->row()->cuser;
		$records['piolet'] = $this->db->select('count(user_id) as cuser')->from('user')->where('user_type', 'p')->get()->row()->cuser;
		
		$records['subs'] = $subs;
		$records['cred'] = $cred;
		$records['prod'] = $prod;
		$records['controller'] = 'Dashboard';
		$records['type'] = 'Dashboard';
		//$this->db->from('users')->limit(5)->get()
		//$this->db->from('postcard_order')->join('user','user.user_id = postcard_order.user_id')->limit(5)->get()
		$records['records'] = array('product'=>$this->db->from('user')->where('user_type !=','d')->limit(5)->get(),'order'=>$this->db->from('user')->where('user_type','d')->limit(5)->get());
		
		$head['controller'] = 'Dashboard';
		$head['type'] = 'Dashboard';
		$this->load->view('main',array_merge($head,array('view'=>'user/dashboard','data'=>$records)));
		/*$this->load->view('head',$head);
		$this->load->view('user/dashboard',$records);
		$this->load->view('foot');*/
	}

	public function setting(){
		$head = array('success_msg'=>'','error_msg'=>'','controller'=>'Setting');
		if($this->input->post('username') != '' && $this->input->post('email')!=''){
			$this->db->where('admin_id',$this->session->userdata('user_id'));
			if($this->input->post('password')!= ''){
				$this->db->update('admin',array('email'=>$this->input->post('email'),'username'=>$this->input->post('username'),'password'=>$this->input->post('password')));
			}else{
				$this->db->update('admin',array('email'=>$this->input->post('email'),'username'=>$this->input->post('username')));
			}
			$head['success_msg'] = 'Information updates successfully';
		}
		$records = $this->db->from('admin')->where('admin_id',$this->session->userdata('user_id'))->get()->row_array();
		$records['controller'] = 'Setting';
		$this->load->view('main',array_merge($head,array('view'=>'user/setting','data'=>$records)));
	}

	public function logout(){
		$this->session->set_userdata('user_id','');
		$this->session->set_userdata('name','');
		unset($_SESSION['is_admin']);
		unset($_SESSION['user_id']);
		unset($_SESSION['name']);
		redirect('user');
	}
}