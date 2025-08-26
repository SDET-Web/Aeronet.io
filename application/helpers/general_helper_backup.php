
<?php

/**
* Wrap data for ajax generation
*
* @param string $data
* @param string $call
*
* @return string
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/

function wrap_data($data,$call){
    return ($call != ""?$call."(".$data.")":$data);
}

/**
* Formate timestamp to date
*
* @param string $time
*
* @return string
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/

function format_date($time){
    return date("m/d/Y",$time);
}

/**
* Validate Call
*
* @return int
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/

function validate_call(){
    if(isset($_GET["user"]) && $_GET["user"] != ""){
        return $_GET["user"];
    }else{
        header('Content-Type: application/json');
        echo render_data(json_encode(array("message"=>"error")),isset($_GET["callback"])?$_GET["callback"]:"");
        exit;
    }
}

/**
* Render Data
*
* @param string $data
* @param string $call
*
* @return int
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/

function render_data($data,$call){
    return ($call != ''?$call."(".$data.")":$data);
}



/*
* Get Map Code from State
*/

function g_makeGroupArray($data, $groupField){

    $result = array();

    foreach ($data as $record) {
        if (!isset($record[$groupField])) {
            continue;
        }
        $result[$record[$groupField]][] = $record;
    }

    return $result;
}
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
        'singleEngine'				=>	'Single Engine',
        'multiEngine'				=>	'Multi Engine',
        'pilotInCommand'			=>	'Pilot-in-Command',
        //'turbine'				    =>	'Turbine',
        'TurbineInCommand'			=>	'Turbine Pilot-in-Command',
        'tailwheel'					=>	'Tailwheel',
        'floats'					=>	'Floats',
        'amphibious'				=>	'Amphibious',
        'glider'					=>	'Glider',
        //'constantSpeedPropeller'	=>	'Constant Speed Propeller',
        //'insSimulated'				=>	'Instrument (Simulated)',
        //'insActual'					=>	'Instrument (Actual)',
        //'retractableGear'			=>	'Retractable Gear',
        //'last12'					=>	'Last 12 Month',
        /*'hoursApplyign'				=>	'Hours in Make and Model Aircraft in which you are applying for'*/
    );
    return $flightTime;
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
    if($ci->session->userdata('user_id')==''){
        return false;
    }else{
        return true;
    }
}

function is_logged_in_redirect(){
    $ci =& get_instance();
    if($ci->session->userdata('user_id')==''){
        redirect('login');
    }else{
        return true;
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


function get_messages_bar(){

    $ci =& get_instance();
    $user = array();
    $id = $ci->session->userdata('user_id');
    $user_education = $ci->db->query('SELECT * FROM `connection` JOIN `user` ON (CASE WHEN conn_id = '.$id.' THEN connection.user_id ELSE conn_id END) = user.user_id WHERE (connection.user_id = '.$id.' OR connection.conn_id = '.$id.') AND `conn_type` = \'p\' AND `conn_status` = \'a\'');;
    if ($user_education->num_rows() > 0) {
        $user['connections'] = $user_education->result_array();
    } else {
        $user['connections'] = array();
    }


    return $user;
}

function get_seprator($class = ''){
    ?>
    <div class="seprator<?php echo ' '.$class; ?>"><div class="sep_left"></div><div class="sep_right"></div><div class="clear"></div></div>
    <?php
}
function get_page($id){
    $ci =& get_instance();
    $row = $ci->db->from('page')->where('page_id',$id)->get()->row();
    if(strpos($row->page_content,'[[URLIF(job,job/post)]]')!== FALSE){
        if(is_owner()){
            $row->page_content = str_replace('[[URLIF(job,job/post)]]','/job/post.html',$row->page_content);
        }else{
            $row->page_content = str_replace('[[URLIF(job,job/post)]]','/job.html',$row->page_content);
        }
    }
    $row->page_content = str_replace(')]]','.html',str_replace('[[URL(','/',$row->page_content));
    return $row;
}
function get_state_name($state){
    $ci =& get_instance();
    return $ci->db->select('state_name')->from('states')->where('st',$state)->get()->row()->state_name;
}
function generate_pagination($count,$current){
    $total_page = 0;
    $pagesize = 20;
    $visible_pages = 5;
    $return = '';
    if($count > $pagesize){
        $return = '<div class="paginate">
		<ul class="pagination pagination-lg">';
        $return .= '<li><a href="#">Pages</a></li>';
        if($count%$pagesize == 0){
            $total_page = $count / $pagesize;
        }else{
            $total_page = intval($count / $pagesize) + 1;
            //echo $total_page;
        }
        if($total_page <= 5){
            for($i = 1;$i<=$total_page;$i++){
                $return .= '<li '.($current == $i?'class="page_active"':'').'><a href="?page='.$i.'">'.$i.'</a></li>';
            }
        }else{
            if($current != 1){
                $return .= '<li><a href="?page="> << </a></li>';
                $return .= '<li><a href="?page='.($current - 1).'"> < </a></li>';
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
                $return .= '<li '.($current == $i?'class="page_active"':'').'><a href="?page='.$i.'">'.$i.'</a></li>';
            }
            if($current != $total_page){
                $return .= '<li><a href="?page='.($current + 1).'"> > </a></li>';
                $return .= '<li><a href="?page='.$total_page.'"> >> </a></li>';
            }
        }
    }else{
        return '';
    }
    return $return.'</ul></div>';
}

function set_pager(){
    $ci =& get_instance();
//	echo substr($ci->db->last_query(),0,strpos($ci->db->last_query(), 'LIMIT'));//exit();
//echo substr(str_replace('\%20','&nbsp;',$ci->db->last_query()),0,strpos(str_replace('\%20','&nbsp;',$ci->db->last_query()), 'LIMIT'));
    $total = $ci->db->query(substr($ci->db->last_query(),0,strpos($ci->db->last_query(), 'LIMIT')))->num_rows();
    $page = ($ci->input->get('page')!=''?$ci->input->get('page'):1);
    $ci->session->set_userdata('list_pager',generate_pagination($total,$page));
    //print_r($ci->session);
}

function set_pager_return(){
    $ci =& get_instance();
    //echo substr($ci->db->last_query(),0,strpos($ci->db->last_query(), 'LIMIT'));exit();
    $total =$ci->db->query(substr(str_replace('\%20','&nbsp;',$ci->db->last_query()),0,strpos(str_replace('\%20','&nbsp;',$ci->db->last_query()), 'LIMIT')))->num_rows();
    $page = ($ci->input->get('page')!=''?$ci->input->get('page'):1);
    //$ci->session->set_userdata('list_pager',generate_pagination($total,$page));
    //print_r($ci->session);
    return '<div class="space">'.generate_pagination($total,$page).'</div>';
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
    $arExInt['inCabinetry'] = 'Cabinetry';
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
    $arExInt['inCabinetry'] = 'Interior Trim';
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
        $ci->session->set_flashdata('msg_error',$message);
    }else{
        $ci->session->set_flashdata('msg_success',$message);
    }
}

function pop_message(){
    $ci =& get_instance();
    $ret = '';

    $tmp_error = $ci->session->flashdata('msg_error');
    $tmp_success = $ci->session->flashdata('msg_success');

    if($tmp_error!=''){
        $ret = '<div class="alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong>Error!</strong><p>'.$tmp_error.'</p></div>';
    }else if($tmp_success!=''){
        $ret = '<div class="alert alert-success fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong>Success!</strong><p>'.$tmp_success.'</p></div>';
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
function get_select_state($selected = ""){
    return select_state_id($selected);
}
function get_select_county($state = "", $selected = ""){
    /*$ci =& get_instance();
    $query = $ci->db->query('SELECT county FROM counties '.($state!=''?'WHERE state=\''.$state.'\'':'').' order by county');
    $return = '<option value="">Select A County</option>';
    if($query->num_rows() > 0){
        foreach($query->result() as $row){
            $return .= '<option value="'.$row->county.'"'.($row->county == $selected?' selected="selected"':'').'>'.$row->county.'</option>';
        }
    }*/
    return array();
}

function get_select_radius($selected = ""){
    //$ci =& get_instance();
//	$query = $ci->db->query('SELECT maker_id, manufacturer FROM manufacturer order by manufacturer');
    $return = '<option value="">Select Radius</option>
	<option value="10"'.('10' == $selected?' selected="selected"':'').'>10</option>
	<option value="25"'.('25' == $selected?' selected="selected"':'').'>25</option>
	<option value="50" selected>50</option>
	<option value="100"'.('100' == $selected?' selected="selected"':'').'>100</option>
	<option value="200"'.('200' == $selected?' selected="selected"':'').'>200</option>';
    /*	if($query->num_rows() > 0){
            foreach($query->result() as $row){
                if($row->manufacturer!=''){
                    $return .= '<option value="'.$row->maker_id.'"'.($row->maker_id == $selected?' selected="selected"':'').'>'.$row->manufacturer.'</option>';
                }
            } */
    //}
    return $return;
}
function get_select_cfi($selected = ""){
    //$ci =& get_instance();
//	$query = $ci->db->query('SELECT maker_id, manufacturer FROM manufacturer order by manufacturer');
    $return = '
	<option value="CFI Rate"'.('Not a CFI' == $selected?' selected="selected"':'').'>CFI Rate</option>
	<option value="Not a CFI"'.('Not a CFI' == $selected?' selected="selected"':'').'>Not a CFI</option>
	';
    /*	if($query->num_rows() > 0){
            foreach($query->result() as $row){
                if($row->manufacturer!=''){
                    $return .= '<option value="'.$row->maker_id.'"'.($row->maker_id == $selected?' selected="selected"':'').'>'.$row->manufacturer.'</option>';
                }
            } */
    //}
    return $return;
}
function get_select_counties($state = "", $selected = ""){
    $ci =& get_instance();
    $query = $ci->db->query('SELECT name as county FROM county '.($state!=''?'WHERE state_id in (select id from state where shortname = \''.$state.'\')':'').' order by county');
    $return = '<option value="">Select A County</option>';
    if($query->num_rows() > 0){
        foreach($query->result() as $row){
            $return .= '<option value="'.$row->county.'"'.($row->county == $selected?' selected="selected"':'').'>'.$row->county.'</option>';
        }
    }
    return $return;
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
    $query = $ci->db->query('SELECT maker_id, manufacturer FROM manufacturer order by manufacturer');
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
    if($make_id != ""){
        $query = $ci->db->query('SELECT model_id, model FROM models '.($make_id!=''?'where maker_id = '.$make_id:'').' order by model');
    }
    $return = '<option value="">Select Model</option>';
    if($make_id != ""){
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $return .= '<option value="'.$row->model_id.'"'.($row->model_id == $selected?' selected="selected"':'').'>'.$row->model.'</option>';
            }
        }
    }
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
    for($key = 1940;$key <= date('Y');$key++){
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
    //$arCertificate = array('Student','Private','Commerical','ATP','Recreational','Sport');
    $arCertificate = array('Commerical','ATP');
    $return = '<option value="">Select your Certificate</option>';
    foreach($arCertificate as $val){
        $return .= '<option value="'.$val.'"'.($val == $selected?' selected="selected"':'').'>'.$val.'</option>';
    }
    return $return;
}
function get_select_user_type($selected = ''){
    $array = array(
        'p'=>'Pilot',
        'd'=>'Department',
        'o'=>'Owner',
        'f'=>'Free User',
        'q'=>'Q User',
        't'=>'T User',
        "A" => "Air Traffic Controller",
        "D" => "Flight Dispatcher",
        "E" => "",
        "F" => "Flight Attendent",
        "G" => "",
        "I" => "",
        "L" => "",
        "M" => "Mechanic",
        "N" => "",
        "P" => "Pilot",
        "R" => "",
        "T" => "",
        "U" => "",
        "W" => "",
        "X" => "",  );

    if($selected == ''){
        return $array;
    }else{
        return $array[$selected];
    }
}

function get_select_user_status($selected = ''){
    $array = array(
        'a'=>array('Active','success'),
        'n'=>array('Not Active','danger'),
        'v'=>array('Verified','success'),
        'p'=>array('Pending','warning')
    );

    if($selected == ''){
        return $array;
    }else{
        return $array[$selected];
    }
}
/*
 * Updated Form Generator
 */



function form_new_input_side($label,$name,$value,$required,$class = '',$placeholder = '',$wrap_class = 'col-sm-3',$label_class = 'col-sm-2'){
    ?>
    <?php $error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
    <label class="<?php echo (trim($label_class) == ''?'col-sm-2':$label_class); ?> control-label"><?php echo $label; ?></label>
    <div class="<?php echo (trim($wrap_class) == ''?'col-sm-3':$wrap_class); ?> controls">
        <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="input-border-btm <?php echo ($class!=''?$class:''); ?>" placeholder="<?php echo $placeholder; ?>" />
        <?php echo $error; ?>
    </div>


    <?php
}


function form_new_text_side($label,$name,$value,$required,$class = '',$placeholder = ''){
    ?>
    <div class="form-group<?php echo ($required == true?' required':''); ?>">
        <label class="col-sm-3 control-label"><?php echo $label; ?></label>
        <div class="col-sm-7 controls">
            <textarea class="width-90<?php echo ($class!=''?' '.$class.'':''); ?>" id="<?php echo $name; ?>" name="<?php echo $name; ?>"><?php echo $value; ?></textarea>
        </div>
    </div>
    <?php
}

function form_new_select_side($list, $label,$name,$value, $required = false,$type = 'text', $class = '',$placeholder = ''){
    $options = 'class ="input-border-btm '.$class.'" id="'.$name.'"';

    if($required){
        $options .=' required="required"';
    }

    echo form_dropdown($name,$list,$value,$options);
}

function form_new_select_side_with_option($label,$name,$select_box,$required,$class='select',$chtml = ''){
    ?>
    <?php $error = form_error($name, '<p class="error help-block"><span class="label label-important">', '</span></p>'); ?>
    <select class="input-border-btm <?php echo $class; ?>" name="<?php echo $name; ?>" id="<?php echo $name; ?>">
        <?php echo $select_box; ?>
    </select>
    <?php echo $error; ?>
    <?php
}


function form_new_input($label,$name,$value,$required,$class = '',$placeholder = ''){
    ?>
    <?php $error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
    <div class="form-group<?php echo ($error!=''?' error':''); ?><?php echo ($required == true?' required':''); ?>">
        <label><?php echo $label; ?></label>
        <div class="controls">
            <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo ($class!=''?$class:'form-control'); ?>" placeholder="<?php echo $placeholder; ?>" />
            <?php echo $error; ?>
        </div>
    </div>
    <?php
}



function form_new_ffd($label,$name,$value,$required,$type = 'text',$class = '',$placeholder = '', $icon = ''){
    ?>
    <?php $error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
    <div class="form_ele control-group<?php echo ($error!=''?' error':''); ?><?php echo ($required == true?' required':''); ?>">
        <?php if($label != ''){?><label><?php echo $label; ?></label><?php } ?>
        <div class="form-level">
            <input name="<?php echo $name; ?>" id="<?php echo $name; ?>"  placeholder="<?php echo $placeholder; ?>" value="<?php echo $value; ?>" type="<?php echo $type; ?>" class="<?php echo ($class!=''?$class:'input-block'); ?>"/>
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

function form_new_textarea($labl,$name,$value,$required,$class = 'form-control', $rows = 8){
    ?>
    <?php $error = form_error($name,'<p class="error help-block"><span class="label label-important">','</span></p>'); ?>
    <div class="form-group<?php echo ($required == true?' required':''); ?>">
        <label><?php echo $labl; ?></label>
        <div class="controls">
            <textarea rows="<?php echo $rows; ?>" <?php echo ($class!=''?' class="'.$class.'"':''); ?> id="<?php echo $name; ?>" name="<?php echo $name; ?>"><?php echo $value; ?></textarea>
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
            <?php echo $error; ?>
        </div>
    </div>
    <?php
}

function form_new_checkbox($label,$id,$name,$value,$checked,$required,$class='',$push_left = false,$csHTML = ''){
    ?>
    <div class="form_ele_radio control-group <?php echo ($push_left == true?'':'no-margin-left'); ?> <?php echo ($required == true?' required':''); ?>">
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

function forum_cover($name, $label, $input){
    $error = form_error($name,'<span class="help-block m-b-none">','</span>');
    return '<div class="form-level">'.($label != ''?'<p>'.$label.'</p>':'').$input.$error.'</div>';
}

function form_new_input_updated($label,$name,$value, $required = false,$type = 'text', $class = '',$placeholder = '',$private = ''){
    $options = array(
        'name' => $name,
        'value'=> $value,
        'placeholder' => $placeholder,
        'class'=>$class,
        'type'=>$type,
    );
    if($required){
        $options['required'] = 'required';
    }
    $html = '';
    if($private != ''){
        if(strpos($private,'span')===FALSE){
            $options['style'] = 'width:70%;';
            $html = '<input type="checkbox" id="'.$private.'" name="'.$private.'" value="y"  /><label for="c4"> Keep Private</label>';
        }else{
            $html = $private;
        }
    }
    echo forum_cover($name, $label, form_input($options).$html);
}

function form_new_textarea_updated($label,$name,$value, $required = false,$rows = 3, $class = '',$placeholder = ''){
    $options = array(
        'name' => $name,
        'value'=> $value,
        'placeholder' => $placeholder,
        'class'=>$class,
        'rows'=>$rows
    );
    if($required){
        $options['required'] = 'required';
    }
    echo forum_cover($name, $label, form_textarea($options));
}

function form_new_select_updated($list, $label,$name,$value, $required = false,$type = 'text', $class = '',$placeholder = '', $js = ''){
    $options = 'class ="'.$class.'" id="'.$name.'" '.$js;

    if($required){
        $options .=' required="required"';
    }

    echo forum_cover($name, $label, form_dropdown($name,$list,$value,$options));
}

//Functions to calculate distance

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

// calculate geographical proximity
function mathGeoProximity( $latitude, $longitude, $radius, $miles = true )
{
    $radius = $miles ? $radius : ($radius * 0.621371192);

    $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
    $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
    $lat_min = $latitude - ($radius / 69);
    $lat_max = $latitude + ($radius / 69);

    return array(
        'latitudeMin'  => $lat_min,
        'latitudeMax'  => $lat_max,
        'longitudeMin' => $lng_min,
        'longitudeMax' => $lng_max
    );
}

// calculate geographical distance between 2 points
function mathGeoDistance( $lat1, $lng1, $lat2, $lng2, $miles = true )
{
    $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lng1 *= $pi80;
    $lat2 *= $pi80;
    $lng2 *= $pi80;

    $r = 6372.797; // mean radius of Earth in km
    $dlat = $lat2 - $lat1;
    $dlng = $lng2 - $lng1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $km = $r * $c;

    return ($miles ? ($km * 0.621371192) : $km);
}

function get_user_pic_url($url, $type = ''){
    if($type != 'd') {
        $userType = get_user_type(strtoupper($type));
        if (isset($userType["icon"])) {
            return $url == '' ? RIZ_ASSETS . 'images/types/' . $userType["icon"] : RIZ_UPLOAD_USER . $url;
        } else {
            //print_r($userType);
            return $url == ''?'data:image/png;base64,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':RIZ_UPLOAD_USER.$url;
        }
    }else{
        return $url == ''?'data:image/png;base64,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':RIZ_UPLOAD_USER.$url;
    }
}

function get_photo_url($url, $type = ''){
    return $url == ''?RIZ_BASE_URL.'assets/temp/images/avatars/avatar'.rand(1,11).'_big.png':RIZ_UPLOAD_PHOTO.$url;
}

function get_news_photo_url($url){
    return $url == ''?RIZ_BASE_URL.'assets/temp/images/avatars/avatar'.rand(1,11).'_big.png':RIZ_UPLOAD_NEWS.$url;
}

function get_aircraft_photo_url($url){
    return $url == ''?'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMS45OTkgNTExLjk5OSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTExLjk5OSA1MTEuOTk5OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBzdHlsZT0iZmlsbDojNUM1NDZBOyIgZD0iTTE0OS42LDQ0MS43NDdsNzMuNDY5LTgwbC0xNS43MzgtNDEuMDgzYzAsMC00Ny4zMzMsNi42NjctNDguNjY3LDEwLjY2NyAgICBjLTEuMzMzLDQtNS4zMzMsNTcuMzMzLTYsNjYuNjY3QzE1MS45OTgsNDA3LjMzLDE0OS42LDQ0MS43NDcsMTQ5LjYsNDQxLjc0NyIvPgoJPC9nPgoJPGc+CgkJPHBhdGggc3R5bGU9ImZpbGw6I0I5QkJDMTsiIGQ9Ik01MDkuNzY0LDM4LjQ1Yy0yLjIxOS0yLjI5Ny01LjU3OC0zLjA0Ny04LjU0Ny0xLjk1M2wtNDk2LDE4NCAgICBjLTMuMDMxLDEuMTI1LTUuMDg2LDMuOTYxLTUuMjExLDcuMTkxczEuNzAzLDYuMjE5LDQuNjQxLDcuNTc0bDg5LjIyNyw0MS4xNzZjNi45MzgsMy4yMDcsMTEuOTc3LDkuNTk0LDEzLjQ3NywxNy4wODYgICAgbDI4LjgwNSwxNDQuMDQzYzAuNjY0LDMuMzA1LDMuMzI4LDUuODQ0LDYuNjY0LDYuMzQ0YzMuMjgxLDAuNDczLDYuNjE3LTEuMTUyLDguMjI3LTQuMTIxbDQ1LjQ3Ny04NC40NTMgICAgYzEuMjM0LTIuMjkzLDMuNDIyLTMuODA1LDYtNC4xNDFjMi42MDItMC4zMzYsNS4wNzgsMC41NTEsNi44NTksMi40NDlMMzIyLjE3LDQ3My40ODFjMS41MzEsMS42MjEsMy42NDEsMi41MTYsNS44MjgsMi41MTYgICAgYzAuNDc3LDAsMC45NjEtMC4wNDMsMS40MzgtMC4xMjljMi42NzItMC40ODgsNC45MTQtMi4yOTcsNS45NTMtNC44MDVsMTc2LTQyNEM1MTIuNjA3LDQ0LjEyNiw1MTEuOTY3LDQwLjc0Myw1MDkuNzY0LDM4LjQ1eiIvPgoJPC9nPgoJPGc+CgkJPHBhdGggc3R5bGU9ImZpbGw6IzhCODk5NjsiIGQ9Ik01MDYuMTk4LDM2LjM2NWwtNDA0Ljk3MSwyNDUuNThjMy4wMTIsMy4yMjUsNS4yMzgsNy4xNTgsNi4xMjQsMTEuNTc4bDI4LjgwNSwxNDQuMDQzICAgIGMwLjY2NCwzLjMwNSwzLjMyOCw1Ljg0NCw2LjY2NCw2LjM0NGMzLjI4MSwwLjQ3Myw2LjYxNy0xLjE1Miw4LjIyNy00LjEyMWw0NS40NzctODQuNDUzYzAuMzItMC41OTQsMC44NTUtMC45NywxLjI5My0xLjQ1MiAgICBjMC4wMzUtMC4xNzYsMC4wNjktMC4zNTEsMC4wNjktMC4zNTFMNTA5LjcwMiwzOC40MDNDNTA4LjcxMywzNy4zOTksNTA3LjQ5NSwzNi43MzgsNTA2LjE5OCwzNi4zNjV6Ii8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==':RIZ_UPLOAD_AIRCRAFT.$url;
}

function get_input_value($data,$name,$field){
    $ci =& get_instance();
    if($ci->input->post($field) != ''){
        return $ci->input->post($field);
    }else if(isset($data[$name])){
        return $data[$name];
    }else{
        return '';
    }
}

function get_value($name){
    $ci =& get_instance();
    if($ci->input->post($name) != ''){
        return $ci->input->post($name);
    }else{
        return '';
    }
}

function get_data_value($data,$name){
    return isset($data[$name])?$data[$name]:'';
}

function get_data_value_date($data,$name){
    return isset($data[$name])?date(RIZ_FORMAT,$data[$name]):'';
}
/**
 * Generate a CURL get call
 *
 * @param $url
 *
 * @return mixed
 *
 * @since   2014-04-03
 * @author  Rizwan Ali <riz@bitspro.com>
 */
function get_curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, 'http://dev.hireexpertprogrammers.com/Aircraft/safetypilot.html');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function select_job_type($select = ''){
    $ar = array(
        ''=>'Select',
        'p'=>'Pilots',
        'm'=>'Mechanic',
        'a'=>'Flight Attendent',
        'd'=>'Flight Dispatcher',

    );

    return ($select != ''?$ar[$select]:$ar);
}


function select_aircraft_model($select = "")
{
    $ci =& get_instance();
    $data = $ci->db->select("model_id AS key, model AS val")->from("directory_models")->get()->result_array();
    $result = array('' => 'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}


function select_aircraft_make($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("maker_id AS key, manufacturer AS val")->from("directory_manufacturer")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}


function select_state($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("st AS key, state_name AS val")->from("directory_states")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}




function json_render($data){
    header('Content-Type: application/json');
    echo json_encode($data);
}

function get_notification_icon($text){
    if(strpos($text,'like')!==FALSE){
        return 'fa-thumbs-up';
    }else{
        return 'fa-comment';
    }
}

function get_post_type_icon_color($type)
{
    if ($type == 'p') {
        return
            array('icon' => 'fa-image',
                'color' => 'warning',
                'border' => 'vd_yellow');

    } else if ($type == 'n') {
        return array(
            'icon' => 'fa-edit',
            'color' => 'primary',
            'border' => 'vd_black'
        );
    } else if ($type == 's') {
        return array(
            'icon' => 'fa-comments',
            'color' => 'success',
            'border' => 'vd_green'
        );
    }

}

function get_latlng($query){
    $response = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.str_replace(' ','+',str_replace('%20','+',$query)).'&key='.GOOGLE_BROWSER_API_KEY);
    $response = json_decode($response);
    if(isset($response->results) && count($response->results) > 0){
       return $response->results[0]->geometry->location;
    }
    return false;
}

function get_user_type($selected = ''){
    $ar = [
        "A" => ["name" => "Air Traffic Controller", "icon" => "A.png"],
        "D" => ["name" => "Flight Dispatcher", "icon" => "D.png"],
        "E" => ["name" => "", "icon" => ""],
        "F" => ["name" => "Flight Attendent", "icon" => "F.png"],
        "G" => ["name" => "", "icon" => ""],
        "I" => ["name" => "", "icon" => ""],
        "L" => ["name" => "", "icon" => ""],
        "M" => ["name" => "Mechanic", "icon" => "M.png"],
        "N" => ["name" => "", "icon" => ""],
        "P" => ["name" => "Pilot", "icon" => "P.png"],
        "R" => ["name" => "", "icon" => ""],
        "T" => ["name" => "", "icon" => ""],
        "U" => ["name" => "", "icon" => ""],
        "W" => ["name" => "", "icon" => ""],
        "X" => ["name" => "", "icon" => ""]
    ];

    if($selected == ''){
        return $ar;
    }else{
        return $ar[$selected];
    }
}

function xl_company_name(){
    return [
        "Aero Commander Division"               =>  "AERO COMMANDER",
        "Aérospatiale, France"                  =>  "AEROSPATIALE",
        "Airbus (formerly known as"             =>  "AIRBUS",
        "Aircraft Industries a.s."              =>  "AIRCRAFT INDUSTRIES AS",
        "The Boeing Company"                    =>  "BOEING",
        "Bombardier Inc."                       =>  "BOMBARDIER INC",
        "British Aerospace"                     =>  "BRITISH AEROSPACE",
        "British Aircraft Corporation, UK"      =>  "BRITISH AIRCRAFT CORP",
        "Bushmaster Aircraft Corporation,"      =>  "BUSHMASTER",
        "Canadair Ltd., Canada"                 =>  "CANADAIR LTD",
        "Textron Aviation Inc."                 =>  "CESSNA",
        "Cirrus Design Corporation"             =>  "CIRRUS DESIGN CORP",
        "Curtiss-Wright Corporation, USA"       =>  "CURTISS WRIGHT",
        "Dee Howard Co., USA"                   =>  "DEE HOWARD COMPANY",
    ];
}

function non_pilot_types($type){
    $types = [
        'P' => 'PILOT',
        'F' => 'FLIGHT INSTRUCTOR',
        'A' => 'AUTHORIZED AIRCRAFT INSTRUCTOR',
        'U' => 'REMOTE PILOT',
        'G' => 'GROUND INSTRUCTOR',
        'E' => 'FLIGHT ENGINEER',
        'H' => 'FLIGHT ENGINEER',
        'X' => 'FLIGHT ENGINEER (Foreign Based)',
        'M' => 'MECHANIC',
        'T' => 'CONTROL TOWER OPERATOR',
        'R' => 'REPAIRMAN',
        'I' => 'REPAIRMAN EXPERIMENTAL ACFT BUILDER',
        'L' => 'REPAIRMAN LIGHT SPORT AIRCRAFT',
        'W' => 'PARACHUTE RIGGER',
        'D' => 'DISPATCHER',
        'N' => 'FLIGHT NAVIGATOR',
        'J' => 'FLIGHT NAVIGATOR (Special Purpose–Lessee)'
    ];

    if(isset($types[$type])){
        return $types[$type];
    } else {
        return '';
    }
}

function time_ago($d1,$d2){
    $datetime1=date_create($d2);
    $datetime2=date_create($d1);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';
    if($diff->y > 0){
        $timemsg = $diff->y .' year'. ($diff->y > 1?"'s":'');

    }
    else if($diff->m > 0){
        $timemsg = $diff->m . ' month'. ($diff->m > 1?"'s":'');
    }
    else if($diff->d > 0){
        $timemsg = $diff->d .' day'. ($diff->d > 1?"'s":'');
    }
    else if($diff->h > 0){
        $timemsg = $diff->h .' hour'.($diff->h > 1 ? "'s":'');
    }
    else if($diff->i > 0){
        $timemsg = $diff->i .' minute'. ($diff->i > 1?"'s":'');
    }
    else if($diff->s > 0){
        $timemsg = $diff->s .' second'. ($diff->s > 1?"'s":'');
    }

    $timemsg = $timemsg.' ago';
    return $timemsg;
}


?>