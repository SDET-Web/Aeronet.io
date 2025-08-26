<?php
session_start();
/*
* Get Map Code from State
*/
function get_code_from_state($state){
	$usermapCodes = array(
		'AK' => 2,
		'MN' => 3,
		'WA' => 4,
		'MT' => 5,
		'ID' => 6,
		'ND' => 7,
		'MI' => 8,
		'ME' => 9,
		'WI' => 10,
		'OR' => 11,
		'SD' => 12,
		'NH' => 13,
		'VT' => 14,
		'NY' => 15,
		'WY' => 16,
		'IA' => 17,
		'NE' => 18,
		'MA' => 19,
		'IL' => 20,
		'PA' => 21,
		'CT' => 22,
		'RI' => 23,
		'CA' => 24,
		'NV' => 25,
		'UT' => 26,
		'OH' => 27,
		'IN' => 28,
		'NJ' => 29,
		'CO' => 30,
		'WV' => 31,
		'MO' => 32,
		'KS' => 33,
		'DE' => 34,
		'MD' => 35,
		'VA' => 36,
		'KY' => 37,
		'DC' => 38,
		'AZ' => 39,
		'OK' => 40,
		'NM' => 41,
		'TN' => 42,
		'NC' => 43,
		'TX' => 44,
		'AR' => 45,
		'SC' => 46,
		'AL' => 47,
		'GA' => 48,
		'MS' => 49,
		'LA' => 50,
		'FL' => 51,
		'HI' => 52,
	);
	return $usermapCodes[$state];
}

function flight_time(){
	$flightTime = array(
		'totalFlightTime'	 		=> 	'Total Flight Time',
		'constantSpeedPropeller'	=>	'Constant Speed Propeller',
		'insActual'					=>	'Instrument (Actual)',
		'floats'					=>	'Floats',
		'insSimulated'				=>	'Instrument (Simulated)',
		'amphibious'				=>	'Amphibious',
		'multiEngine'				=>	'Multi Engine',
		'glider'					=>	'Glider',
		'retractableGear'			=>	'Retractable Gear',
		'last12'					=>	'Last 12 Month',
		'tailwheel'					=>	'Tailwheel',
		/*'hoursApplyign'				=>	'Hours in Make and Model Aircraft in which you are applying for'*/
	);
	return $flightTime;
}

function field_name_parser($key){
	$arVal	= array(
		'n_number'=>'N-Number',
		'serial_number'=>'Serial Number',
		'name'=>'Name',
		'street'=>'Street',
		'city'=>'City',
		'state'=>'State',
		'county'=>'County',
		'zip_code'=>'Zip Code',
		'mfr_name'=>'Make Name',
		'year_mfr'=>'Make Year',
		'model_name'=>'Model',
		'cert_issue_date'=>'Certificate Issued',
		'ac_weight'=>'AC Weight',
		'type_registrant'=>'Type',
		'AIRPORT'=>'Facility Name',
		'LETTER_3'=>'3 Letter ID',
		'AIRPORT_CONTACT'=>'Airport Contact',
		'title'=>'Title',
		'rejuvination_price'=>'Rejuvination',
		'upkeep_price'=>'Upkeep',
		'other_price'=>'Other Price',
		's_order'=>'Sort Order',
		'manufacturer'=>'Manufacturer',
		'model'=>'Model',
		'user_email'=>'Email',
		'user_credit'=>'Postcard Credits',
		'user_type'=>'Type',
		'user_status'=>'Status',
		'pack_name'=>'Title',
		'pack_price'=>'Price',
		'pack_credit'=>'Credits',
		'price'=>'Price',
		'prod_title'=>'Title',
		'prod_price'=>'Price',
		'prod_desc'=>'Description',
		'prod_pic'=>'Picture',
		'quote'=>'Quotation',
		'status'=>'Status',
		'email'=>'Email',
		'username'=>'Username',
		'password'=>'Password',
		'model_id'=>'Model',
		'maker_id'=>'Maker',
		'aircraftpicture'=>'Picture',
		'logo'=>'Logo',
		'phone'=>'Phone',
		'planes'=>'Aircrafts',
		'company'=>'Company',
		'dept_logo'=>'Logo',
		'dept_phone'=>'Phone',
		'dept_planes'=>'Aircrafts',
		'dept_company'=>'Company',
		'dept_fname'=>'First Name',
		'dept_lname'=>'Last Name',
		'dept_address'=>'Address',
		'dept_city'=>'City',
		'dept_state'=>'State',
		'dept_fname_private'=>'First Name Private',
		'dept_lname_private'=>'Last Name Private',
		'dept_fname_private'=>'First Name Private',
		'dept_position'=>'Position',
		'dept_position_private'=>'Position Private',
		'dept_email'=>'Email',
		'dept_email_private'=>'Email Private',
		'dept_bio'=>'Bio',
		'dept_status'=>'Status',
		'user_fname'=>'First Name',
		'user_lname'=>'Last Name',
		'user_address_alt'=>'Alertnative Address',
		'user_address'=>'Address',
		'user_city'=>'City',
		'user_state'=>'State',
		'user_zip'=>'Zip',
		'user_phome'=>'Home Phone',
		'user_pmobile'=>'Mobile Phone',
		'user_pilot_id'=>'Directory ID',
		'unique_id'=>'Unique ID',
		'first_name'=>'First Name',
		'last_name'=>'Last Name',
		'street1'=>'Address',
		'street2'=>'Alertnative Address',
		'zip'=>'Zip',
		'country'=>'Country',
		'region'=>'Region',
		'med_class'=>'Medical Class',
		'med_date'=>'Medical Date',
		'med_exp_date'=>'Medical Exp Date',
		'type'=>'Type',
		'course_name'=>'Course Name',
		'course_offered_by'=>'Offered By',
		'course_faa_id'=>'FAA ID',
		'course_status'=>'Status',
		'course_date'=>'Date',
		'news_title'=>'Title',
		'news_desc'=>'Content',
		'news_type'=>'Category',
		'news_photo'=>'Banner',
		'news_excerpt'=>'Headline',
		'news_photo_caption'=>'Caption',
		'news_date'=>'Date',


	);
	if(isset($arVal[$key])){
		return $arVal[$key];
	}else if(isset($arVal[strtolower($key)])){
		return $arVal[strtolower($key)];
	}else{
		return $key;
	}
}

function table_name_parser($key){
	$arVal = array(
		'aircraft'=>array('directory_aircrafts','id'),
		'airport'=>array('directory_airports','id'),
		'application'=>array('job_application','app_id'),
		'exterior'=>array('exterior','id'),
		'interior'=>array('interior','id'),
		'job'=>array('job','job_id'),
		'order'=>array('postcard_order','order_id'),
		'maker'=>array('directory_manufacturer','maker_id'),
		'model'=>array('directory_models','model_id'),
		'owner'=>array('user','user_id'),
		'package'=>array('marketing_package','pack_id'),
		'piolet'=>array('user','user_id'),
		'piolet1'=>array('user_education','user_id'),
		'piolet2'=>array('user_employeement','user_id'),
		'piolet3'=>array('user_flighttime','user_id'),
		'piolet4'=>array('user_profile','user_id'),
		'piolet5'=>array('user_postcard_credit','user_id'),
		'piolet6'=>array('user_subscription','user_id'),
		'pristine'=>array('pristine','id'),
		'quote'=>array('quote','quote_id'),
		'trip'=>array('trip_ready','id'),
		'user'=>array('admin','admin_id'),
		'email'=>array('email','email_id'),
		'faq'=>array('faq','faq_id'),
		'product'=>array('product','prod_id'),
		'product_order'=>array('product_order','order_id'),
		'page'=>array('page','page_id'),

		'pilot'=>array('user','user_id'),
		'nonpilot'=>array('user','user_id'),
		'pilot_directory'=>array('directory_pilot','unique_id'),
		'nonpilot_directory'=>array('nonpilot_directory','unique_id'),
		'department'=>array('user','user_id'),
		'directory_planes'=>array('department_aircraft','air_id'),
		'directory_department'=>array('directory_deptartment','id'),
		'department_aircraft'=>array('user_aircraft','air_id'),
		'connection'=>array('connection','conn_id'),
		'comment'=>array('connection','comm_id'),
		'message'=>array('message','mess_id'),
		'post'=>array('post','post_id'),
		'photo'=>array('photo','photo_id'),
		'activity'=>array('activity','activ_id'),
		'pilot_aircraft'=>array('user_aircraft','air_id'),
		'course'=>array('user_course','course_id'),
		'news'=>array('news','news_id'),
		'video_questions'=>array('video_questions', 'id'),
	);
	return $arVal[$key];
}

function dont_show($key){
	$no_show_list = array(
		'LETTER_4'=>1,
		'FBO'=>1,
		'FBO_CONTACT'=>1,
		'AIRCRAFT_DETAILER'=>1,
		'DETAILER_CONTACT'=>1,
		'LATITUDE'=>1,
		'LONGITUDE'=>1,
		'id'=>1,
		'airport_id'=>1,
		'aircart_type'=>1,
		'created'=>1,
		'createdby'=>1,
		'modified'=>1,
		'modifiedby'=>1,
		//'maker_id'=>1,
		//'model_id'=>1,
		'created'=>1,
		'createdby'=>1,
		'modified'=>1,
		'modifiedby'=>1,
		'is_deleted'=>1,
		'pack_created'=>1,
		'pack_id'=>1,
		'quote_id'=>1,
		'quote_created'=>1,
		'admin_id'=>1,
		'user_id'=>1,
		'user_password'=>1,
		'user_created'=>1,
		'user_modified'=>1,
		//'user_fname'=>1,
		//'user_lname'=>1,
		//'user_address'=>1,
		//'user_address_alt'=>1,
		//'user_city'=>1,
		//'user_state'=>1,
		//'user_zip'=>1,
		//'user_phome'=>1,
		//'user_pmobile'=>1,
		//'user_source'=>1,
		'user_cfirate'=>1,
		'user_cfi'=>1,
		'user_subsid'=>1,
		'prod_id'=>1,
		'type_id'=>1,
		'page_id'=>1,
		'user_type'=>1,
		'dept_created'=>1,
		'dept_password'=>1,
		'user_bio'=>1,
		'user_source'=>1,
		'user_position'=>1,
		'user_phome'=>1,
		'user_pmobile'=>1,
		'user_credit'=>1,
		'air_id'=>1,
		'user_pilot_id'=>1,
		'course_id'=>1,
		'course_created'=>1,
		'news_id'=>1,
		'news_created'=>1,
		'updated'=>1,

	);
	if(isset($no_show_list[$key])){
		return false;
	}else{
		return true;
	}
}

function dont_show_certain($controller,$key,$type = 'edit'){
	if($type == 'edit'){
		if($controller == 'make'){
			if($key == 'maker_id'){
				return false;
			}
		}else if($controller == 'model'){
			if($key == 'model_id'){
				return false;
			}
		}else if($controller == 'owner'){
			if($key == 'user_credit'){
				return false;
			}
		}else if($controller == 'directory_deptartment'){
			if($key == 'address'){
				return false;
			}
			if($key == 'bio'){
				return false;
			}
			if($key == 'phone'){
				return false;
			}
			if($key == 'email'){
				return false;
			}
		}else if($controller == 'department'){
			if($key == 'dept_id'){
				return false;
			}
		}else if($controller == 'directory_planes'){
			if($key == 'status'){
				return false;
			}

		}
	}else{
		if($controller == 'maker'){
			if($key == 'maker_id'){
				return false;
			}
		}else if($controller == 'model'){
			if($key == 'model_id'){
				return false;
			}
		}else if($controller == 'directory_deptartment'){
			if($key == 'address'){
				return false;
			}
			if($key == 'bio'){
				return false;
			}
			if($key == 'phone'){
				return false;
			}
			if($key == 'email'){
				return false;
			}
		}else if($controller == 'department'){
			if($key == 'dept_id'){
				return false;
			}
		}else if($controller == 'directory_planes'){
			if($key == 'status'){
				return false;
			}
		}
	}
	return true;
}

function select_fields($key){
	$arVal = array(
		'state'=>1,
		'county'=>1,
		'STATE'=>1,
		'COUNTY'=>1,
		'model_id'=>1,
		'make_id'=>1,
		'maker_id'=>1,
		'user_status'=>1,
		'cate_id'=>1,
		'dept_fname_private'=>1,
		'dept_position_private'=>1,
		'dept_lname_private'=>1,
		'dept_email_private'=>1,
		'dept_status'=>1,
		'user_pilot_id'=>1,
		'dept_id'=>1,
		'aircraft_id'=>1,
		'course_status'=>1,
	);

	if(isset($arVal[$key])){
		return true;
	}else{
		return false;
	}
}

function file_fields($key){
	$arVal = array(
		'aircraftpicture'=>1,
		'prod_pic'=>1,
		'logo'=>1,
		'dept_logo'=>1,
		'news_photo'=>1,
	);

	if(isset($arVal[$key])){
		return true;
	}else{
		return false;
	}
}

function wysiwyg_fields($key){
	$arVal = array(
		'news_desc'=>1
	);

	if(isset($arVal[$key])){
		return true;
	}else{
		return false;
	}
}

function date_fields($key){
	$arVal = array(
		'news_date'=>1
	);
	if(isset($arVal[$key])){
		return true;
	}else{
		return false;
	}
}


function get_select_field($key,$val){
	switch($key){
		case 'state':
			return get_select_state($val);
			break;
		case 'county':
			return get_select_county('',$val);
			break;
		case 'STATE':
			return get_select_state($val);
			break;
		case 'COUNTY':
			return get_select_county('',$val);
			break;
		case 'model_id':
			return get_select_model('',$val);
			break;
		case 'make_id':
			return get_select_make($val);
			break;
		case 'maker_id':
			return get_select_make($val);
			break;
		case 'user_status':
			return get_user_status($val);
			break;
		case 'cate_id':
			return get_product_category($val);
			break;
		case 'dept_fname_private':
			return get_yes_no($val);
			break;
		case 'dept_position_private':
			return get_yes_no($val);
			break;
		case 'dept_lname_private':
			return get_yes_no($val);
			break;
		case 'dept_email_private':
			return get_yes_no($val);
			break;
		case 'dept_status':
			return get_user_status($val);
			break;
		case 'user_pilot_id':
			return get_pilot_directory($val);
			break;
		case 'dept_id':
			return get_department($val);
			break;
		case 'aircraft_id':
			return get_aircraft($val);
			break;
		case 'course_status':
			return get_course_status($val);
			break;
		case 'news_type':
			return get_news_type($val);
			break;
	}
}

function input_parser($key,$val){
	if(select_fields($key)){
		return '<select id="'.$key.'" name="'.$key.'" class="form-control form-white">'.get_select_field($key,$val).'</select>';
	}else if(file_fields($key)) {
		return '<input type="file" name="' . $key . '" id="' . $key . '" value="' . $val . '" class="form-control form-white" />';
	}else if(date_fields($key)){
		return '<input type="text"  name="' . $key . '" id="' . $key . '" value="' . date("m/d/Y",$val) . '" class="form-control form-white date-picker" />';
	}else if(wysiwyg_fields($key)){
		return '<textarea name="' . $key . '" id="' . $key . '">' . $val . '</textarea>';
	}else{
		return '<input type="text" name="'.$key.'" id="'.$key.'" value="'.$val.'" class="form-control form-white" />';
	}
}

function menus(){
	$arVal = array(

		'Aircrafts'=>array('icon'=>'icon-plane','menu'=>array('List','New')),

		//'Time Building Pilots'=>array('List'),
		//'Aircraft Owners'=>array('List'),
		//'pristine'=>array('List','New'),
		//'Postcard Marketing Orders'=>array('List'),
		//'Product Line and Orders'=>array('List','New','Product Order'),
		'Flight Dispatch Board Postings'=>array('icon'=>'icon-screen-tablet','menu'=>array('List')),
		//'Estimates'=>array('List'),
		'Applications Against Dispatch Board'=>array('icon'=>'icon-screen-tablet','menu'=>array('List')),
		//'Aircraft for Marketing Map'=>array('List','New','Import'),
		//'Airports for Marketing Map'=>array('List','New','Import'),
		'Aircraft Make for Estimates'=>array('icon'=>'icon-screen-tablet','menu'=>array('List','New')),
		'Aircraft Model for Estimates'=>array('icon'=>'icon-screen-tablet','menu'=>array('List','New')),
		//	'Exterior Price Guide'=>array('List','New','Import'),
		//'trip'=>array('List','New'),
		//	'Interior Price Guide'=>array('List','New','Import'),
		'Flight Departments'=>array('icon'=>'icon-screen-tablet','menu'=>array('List','New')),
		'Flight Department\'s Aircrafts'=>array('icon'=>'icon-screen-tablet','menu'=>array('List','New')),
		'Flight Department Directory'=>array('icon'=>'icon-screen-tablet','menu'=>array('List','New','Import')),
		'Pilots'=>array('icon'=>'icon-screen-tablet','menu'=>array('List','New')),
		'Pilot Directory'=>array('icon'=>'icon-screen-tablet','menu'=>array('List','New','Import')),
		'Non Pilots'=>array('icon'=>'icon-screen-tablet','menu'=>array('List','New')),
		'Non Pilot Directory'=>array('icon'=>'icon-screen-tablet','menu'=>array('List','New','Import')),
		'Postcard Price Guide'=>array('icon'=>'icon-screen-tablet','menu'=>array('List','New')),
		//'CMS'=>array('Email','Page','FAQ'),
		'news'=>array('icon'=>'icon-screen-tablet','menu'=>array('List','New')),

	);
	$ret = '';
	foreach($arVal as $key=>$val){
		?>

		<li class="tm nav-parent">
                    <a href="#"><i class="icon-puzzle"></i><span><?php echo($key); ?></span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
			<?php foreach($val as $v){ ?>



				<?php if($v == 'Email' || $v == 'Message' || $v == 'Page' || $v == 'Picture' || $v == 'FAQ'){ ?>
					<li><a href="<?php echo site_url('cms/'.strtolower($v)); ?>"><?php echo $v; ?></a></li>
				<?php }else if($v == 'Product Order'){ ?>
					<!--	<li class="icn_categories"><a href="<?php //echo site_url('enlist/productorder'); ?>"><?php //echo $v; ?></a></li>	-->
				<?php }else{ ?>
					<li>
						<?php if($key == 'Time Building Pilots'){ $key ='piolet';
						}else if($key == 'Aircraft Owners'){ $key ='owner';
						}else if($key == 'Postcard Marketing Orders'){ $key ='Order';
						}else if($key == 'Product Line and Orders'){ $key ='product';
						}else if($key == 'Flight Dispatch Board Postings'){ $key ='job';
						}else if($key == 'Estimates'){ $key ='quote';
						}else if($key == 'Applications Against Dispatch Board'){ $key ='application';
						}else if($key == 'Aircraft for Marketing Map'){ $key ='aircraft';
						}else if($key == 'Airports for Marketing Map'){ $key ='airport';
						}else if($key == 'Aircraft Make for Estimates'){ $key ='maker';
						}else if($key == 'Aircraft Model for Estimates'){ $key ='model';
						}else if($key == 'Exterior Price Guide'){ $key ='exterior';
						}else if($key == 'Interior Price Guide'){ $key ='interior';
						}else if($key == 'Postcard Price Guide'){ $key ='package';
						}else if($key == 'Flight Departments'){ $key ='department';
						}else if($key == 'Flight Department Directory'){ $key ='directory_deptartment';
						}else if($key == 'Flight Department\'s Aircrafts'){ $key ='directory_planes';
						}else if($key == 'Pilots'){ $key ='pilot';
						}else if($key == 'Pilot Directory'){ $key ='pilot_directory';
						}else if($key == 'Non Pilots'){ $key ='nonpilot';
						}else if($key == 'Non Pilot Directory'){ $key ='nonpilot_directory';
						}else if($key == 'Users'){ $key ='user';
						}else if($key == 'CMS'){ $key ='cms';
						}else if($key == 'News'){ $key ='news';}

						?>
						<a href="<?php echo site_url(($v == 'New'?'add':($v == 'List'?'enlist':'import')).'/'.$key); ?>"><?php echo $v; ?></a></li>
				<?php }?>
			<?php }?>
		</ul>
		<?php
	}
}

function is_mobile(){
	if(strstr($_SERVER['HTTP_USER_AGENT'],"iPad") || strstr($_SERVER['HTTP_USER_AGENT'],"iPhone")){
		return true;
	}else{
		return false;
	}
}

function flight_time_picker($ar,$key){
	foreach($ar as $val){
		if($val['time_key'] == $key){
			return $val['time_val'];
		}
	}
}

function is_logged_in(){
	$ci =& get_instance();
	if(!isset($_SESSION['user_id'])){
		redirect('user');
	}else{
		return true;
	}
}

function is_not_logged_in(){
	$ci =& get_instance();
	if(!isset($_SESSION['user_id'])){
		return true;
	}else{
		redirect('user/dashboard');
	}
}

function is_not_logged_in_redirect(){
	$ci =& get_instance();
	if(!isset($_SESSION['user_id'])){
		redirect('auth/login');
	}else{
		redirect('user/dashboard');
	}
}

function is_paid_member(){
	$ci =& get_instance();
	if($ci->session->userdata('user_type')=='p' || $ci->session->userdata('user_type')=='q'){
		return true;
	}else{
		return false;
	}
}
function is_owner(){
	$ci =& get_instance();
	if($ci->session->userdata('user_type')=='o'){
		return true;
	}else{
		return false;
	}
}
function get_seprator($class = ''){
	?>
	<div class="seprator<?php echo ' '.$class; ?>"><div class="sep_left"></div><div class="sep_right"></div><div class="clear"></div></div>
	<?php
}

function get_state_name($state){
	$ci =& get_instance();
	return $ci->db->select('name as state_name')->from('state')->where('id',$state)->get()->row()->state_name;
}
function generate_pagination($count,$current){
	$total_page = 0;
	$pagesize = RIZ_PAGE_SIZE;
	$visible_pages = 5;
	$return = '';
	if($count > $pagesize){
		$return = '<div class="">
		<ul class="pagination">';
		//$return .= '<li class="paginate_button"><a href="#">Pages</a></li>';
		if($count%$pagesize == 0){
			$total_page = $count / $pagesize;
		}else{
			$total_page = intval($count / $pagesize) + 1;
			//echo $total_page;
		}
		if($total_page <= 5){
			for($i = 1;$i<=$total_page;$i++){
				$return .= '<li '.($current == ($i - 1)?'class="paginate_button active"':'class="paginate_button"').'><a href="?page='.($i - 1).'">'.$i.'</a></li>';
			}
		}else{
			if($current != 1){
				$return .= '<li class="paginate_button previous"><a href="?page=">First</a></a></li>';
				$return .= '<li class="paginate_button previous"><a href="?page='.($current - 1).'"><i class="fa fa-angle-left"></i></a></a></li>';
			}
			$begin = 1;
			$end = 5;
			if($current == 1 || $current - 2 <= 1){
				$begin = 1;
				$end = 5;
				//echo $begin;
			}else if($current == $total_page || $current + 2 >= $total_page){
				$begin = $total_page - 4;
				$end = $total_page;
			}else{
				$begin = $current - 2;
				$end = $current + 2;
			}
			for($i = $begin;$i <= $end ;$i++){
				$return .= '<li '.($current == $i?'class="paginate_button active"':'class="paginate_button"').'><a href="?page='.$i.'">'.$i.'</a></li>';
			}
			if($current != $total_page){
				$return .= '<li class="paginate_button next"><a href="?page='.($current + 1).'">Next</a></li>';
				$return .= '<li class="paginate_button next"><a href="?page='.$total_page.'">Last</a></li>';
			}
		}
	}else{
		return '';
	}
	return $return.'</ul></div>';
}

function set_pager($query){
	$ci =& get_instance();
	$total = $ci->db->query(substr($query,0,strpos($query, 'LIMIT')))->num_rows();
	//echo $total;exit;
	$page = ($ci->input->get('page')!=''?$ci->input->get('page'):1);
	$ci->session->set_userdata('list_pager',generate_pagination($total,$page));
}

function get_pager(){
	$ci =& get_instance();
	$ret = $ci->session->userdata('list_pager');
	$ci->session->set_userdata('list_pager','');
	return $ret;
}

function get_exint_dbfield_title($key){
	$arExInt = array();
	$arExInt['exWet_Wash'] = 'Wet Wash';
	$arExInt['exDry_Wash'] = 'Dry Wash';
	$arExInt['Wet_Wash'] = 'Wet Wash';
	$arExInt['Dry_Wash'] = 'Dry Wash';
	$arExInt['exExterior_Paint'] = 'Exterior Paint';
	$arExInt['exBright_Work'] = 'Bright Work';
	$arExInt['exDe-Ice_Boots'] = 'De-Ice Boots';
	$arExInt['exLanding_Gear'] = 'Landing Gear';
	$arExInt['exGear_Wells'] = 'Gear Wells';
	$arExInt['inCarpet'] = 'Carpet';
	$arExInt['inLeather'] = 'Leather';
	$arExInt['inCabinetry'] = 'Interior Trim';
	$arExInt['inGlass'] = 'Glass';
	$arExInt['inTrim'] = 'Interior Trim';
	return $arExInt[$key];
}

function get_exint_dbfield_title_new($key){
	$arExInt = array();
	$arExInt['exWet_Wash'] = array('name'=>'Wet Wash','type'=>'ext');
	$arExInt['exDry_Wash'] = array('name'=>'Dry Wash','type'=>'ext');
	$arExInt['Wet_Wash'] = array('name'=>'Wet Wash','type'=>'ext');
	$arExInt['Dry_Wash'] = array('name'=>'Dry Wash','type'=>'ext');
	$arExInt['exExterior_Paint'] = array('name'=>'Exterior Paint','type'=>'ext');
	$arExInt['exBright_Work'] = array('name'=>'Bright Work','type'=>'ext');
	$arExInt['exDe-Ice_Boots'] = array('name'=>'De-Ice Boots','type'=>'ext');
	$arExInt['exLanding_Gear'] = array('name'=>'Landing Gear','type'=>'ext');
	$arExInt['exGear_Wells'] = array('name'=>'Gear Wells','type'=>'ext');
	$arExInt['inCarpet'] = array('name'=>'Carpet','type'=>'int');
	$arExInt['inLeather'] = array('name'=>'Upholstery','type'=>'int');
	$arExInt['inCabinetry'] = array('name'=>'Trim/Cabinet','type'=>'int');
	$arExInt['inGlass'] = array('name'=>'Windows','type'=>'int');
	$arExInt['inTrim'] = array('name'=>'Interior Trim','type'=>'int');
	return $arExInt[$key];
}

function get_exint_email_title($key){
	$arExInt = array();
	$arExInt['exWet_Wash'] = 'Wet Wash';
	$arExInt['exDry_Wash'] = 'Dry Wash';
	$arExInt['exExterior_Paint'] = 'Exterior Paint';
	$arExInt['exBright_Work'] = 'Bright Work';
	$arExInt['exDe-Ice_Boots'] = 'De-Ice Boots';
	$arExInt['exLanding_Gear'] = 'Landing Gear';
	$arExInt['exGear_Wells'] = 'Gear Wells';
	$arExInt['inCarpet'] = 'Carpet';
	$arExInt['inLeather'] = 'Upholstery';
	$arExInt['inCabinetry'] = 'Cabinetry';
	$arExInt['inGlass'] = 'Windows';
	$arExInt['inTrim'] = 'Interior Trim';
	return $arExInt[$key];
}
/*
 * General Functions
 */
function push_message($message,$is_error = false){
	$ci =& get_instance();
	if($is_error){
		$ci->session->set_userdata('msg_error',$message);
	}else{
		$ci->session->set_userdata('msg_success',$message);
	}
}
function get_message($message,$is_error = false){
	$ret = '';
	if($is_error != false){
		$ret = '<h4 class="alert_error">'.$message.'</h4>';
	}else if($is_error == false){
		$ret = '<h4 class="alert_success">'.$message.'</h4>';
	}
	return $ret;
}
function pop_message(){
	$ci =& get_instance();
	$ret = '';
	if($ci->session->userdata('msg_error')!=''){
		$ret = '<h4 class="alert_error">'.$ci->session->userdata('msg_error').'</h4>';
		$ci->session->set_userdata('msg_error','');
	}else if($ci->session->userdata('msg_success')!=''){
		$ret = '<h4 class="alert_success">'.$ci->session->userdata('msg_success').'</h4>';
		$ci->session->set_userdata('msg_success','');
	}
	return $ret;

}



function set_title($title){
	$ci =& get_instance();
	$ci->session->set_userdata('page_title',$title);
}

function get_title(){
	$ci =& get_instance();
	return $ci->session->userdata('page_title').($ci->session->userdata('page_title')!=''?' | ':'').RIZ_SITE_NAME;
}

function get_heading(){
	$ci =& get_instance();
	return $ci->session->userdata('page_title');
}
/*
 * Select Boxes
 */

function get_yes_no($selected = "")
{
	$return = '<option value="">Select</option>';
	$array = array(
		'y' => 'Yes',
		'n' => 'No'
	);
	foreach ($array as $key=>$row) {
		$return .= '<option value="' . $key . '"' . ($key == $selected ? ' selected="selected"' : '') . '>' . $row . '</option>';
	}
	return $return;
}
function get_select_state($selected = ""){
	$ci =& get_instance();
	$query = $ci->db->query('SELECT st, state_name FROM directory_states order by state_name');
	$return = '<option value="">Select A State</option>';
	if($query->num_rows() > 0){
		foreach($query->result() as $row){
			$return .= '<option value="'.$row->st.'"'.($row->st == $selected?' selected="selected"':'').'>'.$row->state_name.'</option>';
		}
	}
	return $return;
}
function get_pilot_directory($selected){
	$ci =& get_instance();
	$query = $ci->db->query('SELECT * FROM directory_pilot');
	$return = '<option value="">Select A Pilot</option>';
	if($query->num_rows() > 0){
		foreach($query->result() as $row){
			$return .= '<option value="'.$row->unique_id.'"'.($row->unique_id == $selected?' selected="selected"':'').'>'.$row->first_name.' '.$row->last_name.'</option>';
		}
	}
	return $return;
}

function get_course_status($selected){
	$arFrom = array(
		'p'=>'Passed',
		'f'=>'Failed',
		'd'=>'Pending',

	);
	$return = '<option value="">Choose</option>';
	if($arFrom > 0){
		foreach($arFrom as $row){
			$return .= '<option value="'.$row.'"'.($row == $selected?' selected="selected"':'').'>'.$row.'</option>';
		}
	}
	return $return;
}

function get_news_type($selected){
	$arFrom = array(
		'c'=>'Category One',
		'f'=>'Category Two',
		'd'=>'Category Three',
		'e'=>'Category Four',
		'f'=>'Category Five',

	);
	$return = '<option value="">Choose</option>';
	if($arFrom > 0){
		foreach($arFrom as $row){
			$return .= '<option value="'.$row.'"'.($row == $selected?' selected="selected"':'').'>'.$row.'</option>';
		}
	}
	return $return;
}


function get_department($selected){
	$ci =& get_instance();
	$query = $ci->db->query('SELECT dept_id, dept_company FROM department order by dept_company');
	$return = '<option value="">Select A Category</option>';
	if($query->num_rows() > 0){
		foreach($query->result() as $row){
			$return .= '<option value="'.$row->dept_id.'"'.($row->dept_id == $selected?' selected="selected"':'').'>'.$row->dept_company.'</option>';
		}
	}
	return $return;
}

function get_aircraft($selected){
	$ci =& get_instance();
	$query = $ci->db->query('SELECT id, n_number  FROM directory_aircrafts order by n_number');
	$return = '<option value="">Select A Category</option>';
	if($query->num_rows() > 0){
		foreach($query->result() as $row){
			$return .= '<option value="'.$row->id.'"'.($row->id == $selected?' selected="selected"':'').'>'.$row->n_number.'</option>';
		}
	}
	return $return;
}


function get_product_category($selected){
	$ci =& get_instance();
	$query = $ci->db->query('SELECT * FROM product_category order by cate_name');
	$return = '<option value="">Select A Category</option>';
	if($query->num_rows() > 0){
		foreach($query->result() as $row){
			$return .= '<option value="'.$row->cate_id.'"'.($row->cate_id == $selected?' selected="selected"':'').'>'.$row->cate_name.'</option>';
		}
	}
	return $return;
}
function get_select_county($state = "", $selected = ""){
	/*$ci =& get_instance();
	$query = $ci->db->query('SELECT county FROM counties '.($state!=''?'WHERE state=\''.$state.'\'':'').' order by county');
	$return = '<option value="">Select A County</option>';
	if($query->num_rows() > 0){
		foreach($query->result() as $row){
			$return .= '<option value="'.$row->county.'"'.($row->county == $selected?' selected="selected"':'').'>'.$row->county.'</option>';
		}
	}
	return $return;*/
	return get_select_state($selected);
}

function get_how_hear($selected = ""){
	$arFrom = array('Long time Visitor','Airline pilot forums','Flightinfo.com','Pilotpointer.com','Google Ad','Google Search','Yahoo Search','E-mail','Friend','Postcard','Other');
	$return = '<option value="">Select A Source</option>';
	if($arFrom > 0){
		foreach($arFrom as $row){
			$return .= '<option value="'.$row.'"'.($row == $selected?' selected="selected"':'').'>'.$row.'</option>';
		}
	}
	return $return;
}
function get_medical($selected = ""){
	$arFrom = array('First Class','Second Class','Third Class');
	$return = '<option value="">Select A Class</option>';
	if($arFrom > 0){
		foreach($arFrom as $row){
			$return .= '<option value="'.$row.'"'.($row == $selected?' selected="selected"':'').'>'.$row.'</option>';
		}
	}
	return $return;
}

function get_select_make($selected = ""){
	$ci =& get_instance();
	$query = $ci->db->query('SELECT maker_id, manufacturer FROM directory_manufacturer order by manufacturer');
	$return = '<option value="">Select Make</option>';
	if($query->num_rows() > 0){
		foreach($query->result() as $row){
			if($row->manufacturer!=''){
				$return .= '<option value="'.$row->maker_id.'"'.($row->maker_id == $selected?' selected="selected"':'').'>'.$row->manufacturer.'</option>';
			}
		}
	}
	return $return;
}

function get_select_model($make_id = "", $selected = ""){
	$ci =& get_instance();
	//if($make_id != ""){
	$query = $ci->db->query('SELECT model_id, model FROM models '.($make_id!=''?'where maker_id = '.$make_id:'').' order by model_id');
	//}
	$return = '<option value="">Select Model</option>';
	//if($make_id != ""){
	if($query->num_rows() > 0){
		foreach($query->result() as $row){
			$return .= '<option value="'.$row->model_id.'"'.($row->model_id == $selected?' selected="selected"':'').'>'.$row->model.'</option>';
		}
	}
	//}
	return $return;
}

function get_select_duex_option($selected = ''){
	$arFrom = array('Standard'=>'UpKeep','Deluxe'=>'Rejuvenation');
	$return = '<option value="">Choose</option>';
	if($arFrom > 0){
		foreach($arFrom as $row){
			$return .= '<option value="'.$row.'"'.($row == $selected?' selected="selected"':'').'>'.$row.'</option>';
		}
	}
	return $return;
}

function get_select_upholstery_option($selected = ''){
	$arFrom = array('Vinyl'=>'Vinyl','Cloth'=>'Cloth','Leather'=>'Leather');
	$return = '<option value="">Choose</option>';
	if($arFrom > 0){
		foreach($arFrom as $row){
			$return .= '<option value="'.$row.'"'.($row == $selected?' selected="selected"':'').'>'.$row.'</option>';
		}
	}
	return $return;
}

function select_month($selected=''){
	$arMonth = array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
	$return = '';
	foreach($arMonth as $key=>$val){
		$return .= '<option value="'.$key.'"'.($key == $selected?' selected="selected"':'').'>'.$val.'</option>';
	}
	return $return;
}

function select_year($selected=''){
	$return = '';
	for($key = 1974;$key <= date('Y');$key++){
		$return .= '<option value="'.$key.'"'.($key == $selected?' selected="selected"':'').'>'.$key.'</option>';
	}
	return $return;
}
function get_select_rating($selected = ''){
	$arRating = array('STU','MEL','SES','MES','IFR','Rotorcraft','Glider','CFI','CFII','MEI');
	/*$return = '<option value="">Select your Rating</option>';
	foreach($arRating as $val){
		$return .= '<option value="'.$val.'"'.($val == $selected?' selected="selected"':'').'>'.$val.'</option>';
	}*/
	return $arRating;
}
function get_select_certificate($selected = ''){
	$arCertificate = array('Student','Private','Commerical','ATP','Recreational','Sport');
	$return = '<option value="">Select your Certificate</option>';
	foreach($arCertificate as $val){
		$return .= '<option value="'.$val.'"'.($val == $selected?' selected="selected"':'').'>'.$val.'</option>';
	}
	return $return;
}
function get_user_status($selected = ''){
	$arStatus = array('a'=>'Active','n'=>'Deactive');
	$return = '';
	foreach($arStatus as $key=>$val){
		$return .= '<option value="'.$key.'"'.($key == $selected?' selected="selected"':'').'>'.$val.'</option>';
	}
	return $return;
}
/*
 * Updated Form Generator
 */
function form_new_input($label,$name,$value,$required,$class = '',$placeholder = ''){
	?>
	<?php $error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
	<div class="form_ele control-group<?php echo ($error!=''?' error':''); ?><?php echo ($required == true?' required':''); ?>">
		<label><?php echo $label; ?></label>
		<div class="controls">
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo ($class!=''?$class:'input'); ?>" placeholder="<?php echo $placeholder; ?>" />
			<?php echo $error; ?>
		</div>
	</div>
	<?php
}

/*
 * Updated Form Generator
 */
function form_new_input_updated($label,$name,$value,$required,$class = '',$placeholder = '', $icon = ''){
	?>
	<?php $error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
	<div class="form_ele control-group<?php echo ($error!=''?' error':''); ?><?php echo ($required == true?' required':''); ?>">
		<?php if($label != '')?><label><?php echo $label; ?></label>
		<div class="form-level">
			<input name="<?php echo $name; ?>" id="<?php echo $name; ?>"  placeholder="<?php echo $placeholder; ?>" value="<?php echo $value; ?>" type="text" class="<?php echo ($class!=''?$class:'input-block'); ?>"/>
			<?php echo $icon; ?>
			<?php echo $error; ?>
		</div>
	</div>
	<?php
}



function form_new_hidden($label,$name,$value,$required,$class = '',$placeholder = ''){
	?>
	<input type="hidden" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo ($class!=''?$class:'input'); ?>"/>
	<?php
}

function form_new_file($label,$name,$value,$required,$class = '',$placeholder = ''){
	?>
	<?php $error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
	<div class="form_ele control-group<?php echo ($error!=''?' error':''); ?><?php echo ($required == true?' required':''); ?>">
		<label><?php echo $label; ?></label>
		<div class="controls">
			<input type="file" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo ($class!=''?$class:'input'); ?>" placeholder="<?php echo $placeholder; ?>" />
			<?php echo $error; ?>
		</div>
	</div>
	<?php
}

function form_new_input_sidelabel($label,$name,$value,$required,$class = '',$placeholder = ''){
	?>
	<?php $error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
	<div class="form_ele control-group<?php echo ($error!=''?' error':''); ?><?php echo ($required == true?' required':''); ?>">
		<div class="controls left">
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo ($class!=''?$class:'short input'); ?>" placeholder="<?php echo $placeholder; ?>" />
			<?php echo $error; ?>
		</div>
		<label class="left short_label"><?php echo $label; ?></label>
		<div class="clear"></div>
	</div>
	<?php
}

function form_new_password($label,$name,$value,$required,$class = '',$placeholder = ''){
	?>
	<?php $error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
	<div class="form_ele control-group<?php echo ($error!=''?' error':''); ?><?php echo ($required == true?' required':''); ?>">
		<label><?php echo $label; ?></label>
		<div class="controls">
			<input type="password" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo ($class!=''?$class:'input'); ?>" placeholder="<?php echo $placeholder; ?>" />
			<?php echo $error; ?>
		</div>
	</div>
	<?php
}

function form_new_select($label,$name,$select_box,$required,$class='select',$chtml = ''){
	?>
	<?php $error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
	<div class="form_ele control-group<?php echo ($error!=''?' error':''); ?><?php echo ($required == true?' required':''); ?>">
		<label><?php echo $label; ?><?php echo $chtml; ?></label>
		<div class="controls">
			<select class="<?php echo $class; ?>" name="<?php echo $name; ?>" id="<?php echo $name; ?>">
				<?php echo $select_box; ?>
			</select>
			<?php echo $error; ?>
		</div>
	</div>
	<?php
}

function form_new_radio($labl,$id,$name,$value,$checked,$required,$class = ''){
	?>
	<div class="form_ele_radio control-group<?php echo ($required == true?' required':''); ?>">
		<input type="radio" name="<?php echo $name; ?>" id="<?php echo $id; ?>" <?php echo ($checked==true?'checked="checked"':''); ?> value="<?php echo $value; ?>" />
		<label><?php echo $labl; ?></label>
		<div class="clear"></div>
	</div>
	<?php
}

function form_new_textarea($labl,$name,$value,$required,$class = ''){
	?>
	<?php $error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
	<div class="form_ele control-group<?php echo ($required == true?' required':''); ?>">
		<label><?php echo $labl; ?></label>
		<div class="controls">
			<textarea <?php echo ($class!=''?' class="'.$class.'"':''); ?> id="<?php echo $name; ?>" name="<?php echo $name; ?>"><?php echo $value; ?></textarea>
			<?php echo $error; ?>
		</div>
	</div>
	<?php
}

function form_new_textarea_emer($labl,$name,$value,$required,$class = ''){
	?>
	<div class="form_ele control-group<?php echo ($required == true?' required':''); ?>">
		<label><?php echo $labl; ?></label>
		<div class="controls">
			<textarea <?php echo ($class!=''?' class="'.$class.'"':''); ?> id="<?php echo $name; ?>" name="<?php echo $name; ?>"><?php echo ($value); ?></textarea>
		</div>
	</div>
	<?php
}

function form_new_checkbox($label,$id,$name,$value,$checked,$required,$class='',$push_left = false,$csHTML = ''){
	?>
	<div class="form_ele_radio control-group <?php echo ($push_left == true?'':'no-margin-left'); ?>">
		<div class="controls">
			<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $id; ?>" <?php echo ($checked==true?'checked="checked"':''); ?> value="<?php echo $value; ?>" />
		</div>
		<div class="control-label">
			<label><?php echo $label; ?></label>
			<?php echo $csHTML; ?>
			<div class="controls"></div>
		</div>
		<div class="clear"></div>
	</div>
	<?php
}

function form_new_check_list($label,$name,$list,$value){
	if(!is_array($value)){
		$value = explode(',',$value);
	}
	?>
	<div class="form_ele control-group">
		<label><?php echo $label; ?></label>
		<div class="controls">
			<?php  			foreach($list as $key=>$ckh){
				?>
				<input type="checkbox" <?php echo (array_search($ckh,$value)!== FALSE?'checked="checked"':''); ?> name="<?php echo $name; ?>" value="<?php echo $ckh; ?>" /> <?php echo $ckh; ?>
				<?php
			}
			?>
		</div>
	</div>

	<?php /*$error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
 				<div class="form_ele control-group<?php echo ($error!=''?' error':''); ?><?php echo ($required == true?' required':''); ?>">
					<label><?php echo $label; ?></label>
					<div class="controls">
						<select class="<?php echo $class; ?>" name="<?php echo $name; ?>" id="<?php echo $name; ?>">
							<?php echo $select_box; ?>
						</select>
						<?php echo $error; ?>
					</div>
				</div> */ ?>
	<?php
}


/**
 * Take aircafts list and typerating and return aircraft ids
 *
 * @param $aircrafts
 * @param $typerating
 * @param $manufacturer
 * @return array
 */
function process_aircrafts_typerating($models, $typerating, $manufacturer){
	$ci =& get_instance();
	$tmp = $models;
	$models = explode(",",$models);
	if(count($models) <= 1){
		$models = explode("\n",$models[0]);
	}
	$output = [];
	$where = [];
	foreach($models as $model) {
		$model = trim(preg_replace('/\s+/', ' ', term_filter($model)));
		$model = str_replace("A-", "A", $model);
		$model = str_replace("ATR-", "ATR ", $model);
		$model = str_replace("SN ", "SN-", $model);
		$model = str_replace("Series", "", $model);
		$model = str_replace("Airbus", "", $model);
		$model = str_replace("Long", "", $model);
		$model = str_replace("Short", "", $model);
		$model = str_replace("Body", "", $model);
		if ($model != "") {

			$model = term_filter($model);

			$where[] = "`model_name` =  '".term_filter($model)."'";
			$where[] = "`model_name` LIKE  '%".term_filter($model)."%'";

			$terms = explode(" ", $model);

			foreach ($terms as $key => $term) {
				if (strlen($term) > 2 && strpos($manufacturer["fullName"], $term) !== FALSE) {
					$where[] = "`model_name` =  '" . term_filter($term) . "'";
					$where[] = "`model_name` LIKE  '%" . term_filter($term) . "%'";
				}
			}

			if(strpos($model," ") === FALSE){
				$terms = explode("-", $model);
				foreach ($terms as $key => $term) {
					if (strlen($term) > 2) {
						$where[] = "`model_name` =  '" . term_filter($term) . "'";
						$where[] = "`model_name` LIKE  '%" . term_filter($term) . "-%'";
					}
				}
			}

			if(strpos($model,"/") !== FALSE){
				$terms = explode("/", $model);
				foreach ($terms as $key => $term) {
					if (strlen($term) > 2) {
						$where[] = "`model_name` =  '" . term_filter($term) . "'";
						$where[] = "`model_name` LIKE  '%" . term_filter($term) . "%'";
					}
				}
			}

		}
	}
	$where = array_unique($where, SORT_REGULAR);
	if(count($where) > 0) {
		$count = $ci->db->query("SELECT * FROM (`directory_aircrafts`) WHERE `mfr_name` like  '{$manufacturer["dbName"]}%' AND (" . implode(" OR ", $where) . ")")->num_rows();
		if ($count > 0) {
			$ci->db->query("UPDATE (`directory_aircrafts`) SET aircraft_type_rating = '{$typerating}' WHERE `mfr_name` like  '{$manufacturer["dbName"]}%' AND (" . implode(" OR ", $where) . ")");
		} else {
			//print_r([$models, $manufacturer["dbName"], "SELECT * FROM (`directory_aircrafts`) WHERE `mfr_name` like  '{$manufacturer["dbName"]}%' AND (" . implode(" OR ", $where) . ")"]);
		}
	}
	return [];
}

function term_filter($term){
	$term = trim(preg_replace('/\s+/', ' ', $term));
	$term = str_replace("Boeing","",$term);
	$term = str_replace("B- ","B-",$term);
	return $term;
}
