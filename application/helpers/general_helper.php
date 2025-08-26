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

function wrap_data($data, $call)
{
    return ($call != "" ? $call . "(" . $data . ")" : $data);
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

function format_date($time)
{
    return date("m/d/Y", $time);
}

/**
 * Validate Call
 *
 * @return int
 *
 * @since   2016-27-06
 * @author  Rizwan Ali <riz@bitspro.com>
 */

function validate_call()
{
    if (isset($_GET["user"]) && $_GET["user"] != "") {
        return $_GET["user"];
    } else {
        header('Content-Type: application/json');
        echo render_data(json_encode(array("message" => "error")), isset($_GET["callback"]) ? $_GET["callback"] : "");
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

function render_data($data, $call)
{
    return ($call != '' ? $call . "(" . $data . ")" : $data);
}


/*
* Get Map Code from State
*/

function g_makeGroupArray($data, $groupField)
{

    $result = array();

    foreach ($data as $record) {
        if (!isset($record[$groupField])) {
            continue;
        }
        $result[$record[$groupField]][] = $record;
    }

    return $result;
}

function get_code_from_state($state)
{
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

function flight_time()
{
    $flightTime = array(
        'totalFlightTime' => 'Total Flight Time',
        'singleEngine' => 'Single Engine',
        'multiEngine' => 'Multi Engine',
        'pilotInCommand' => 'Pilot-in-Command',
        //'turbine'				    =>	'Turbine',
        'TurbineInCommand' => 'Turbine Pilot-in-Command',
        'tailwheel' => 'Tailwheel',
        'floats' => 'Floats',
        'amphibious' => 'Amphibious',
        'glider' => 'Glider',
        //'constantSpeedPropeller'	=>	'Constant Speed Propeller',
        //'insSimulated'				=>	'Instrument (Simulated)',
        //'insActual'					=>	'Instrument (Actual)',
        //'retractableGear'			=>	'Retractable Gear',
        //'last12'					=>	'Last 12 Month',
        /*'hoursApplyign'				=>	'Hours in Make and Model Aircraft in which you are applying for'*/
    );
    return $flightTime;
}

function is_mobile()
{
    if (strstr($_SERVER['HTTP_USER_AGENT'], "iPad") || strstr($_SERVER['HTTP_USER_AGENT'], "iPhone")) {
        return true;
    } else {
        return false;
    }
}


function generate_video_thumbnail($video_file_path)
{
    $time = time();
    $cmd = 'ffmpeg -i ' . $video_file_path . ' -ss 00:00:01 -vframes 1 ' . RIZ_DEEP_PATH . RIZ_UPLOAD_VIDEO_THUMB . $time . '.jpg 2>&1';
    exec($cmd, $output, $retval);
    if ($output != null) {
        return RIZ_UPLOAD_VIDEO_THUMB . $time . '.jpg';
    } else {
        return false;
    }
}

function flight_time_picker($ar, $key)
{
    foreach ($ar as $val) {
        if ($val['time_key'] == $key) {
            return $val['time_val'];
        }
    }
}

function is_logged_in()
{
    $ci = &get_instance();
    if ($ci->session->userdata('user_id') == '') {
        return false;
    } else {
        return true;
    }
}

function is_logged_in_redirect()
{
    $ci = &get_instance();
    if ($ci->session->userdata('user_id') == '') {
        redirect('login');
    } else {
        return true;
    }
}

function is_paid_member()
{
    $ci = &get_instance();
    if ($ci->session->userdata('user_type') == 'p' || $ci->session->userdata('user_type') == 'q') {
        return true;
    } else {
        return false;
    }
}

function is_owner()
{
    $ci = &get_instance();
    if ($ci->session->userdata('user_type') == 'o') {
        return true;
    } else {
        return false;
    }
}

function is_user_type($type)
{
    $ci = &get_instance();
    if ($ci->session->userdata('user_type') == $type) {
        return true;
    } else {
        return false;
    }
}

function is_department()
{
    if (is_user_type("d")) {
        return true;
    } else {
        return false;
    }
}

function is_pilot()
{
    if (is_user_type("p")) {
        return true;
    } else {
        return false;
    }
}

function is_not_department()
{
    if (is_logged_in() && !is_department()) {
        return true;
    } else {
        return false;
    }
}

function is_non_pilot()
{
    if (is_not_department() && !is_pilot()) {
        return true;
    } else {
        return false;
    }
}


function get_messages_bar()
{

    $ci = &get_instance();
    $user = array();
    $id = $ci->session->userdata('user_id');
    $user_education = $ci->db->query('SELECT * FROM `connection` JOIN `user` ON (CASE WHEN conn_id = ' . $id . ' THEN connection.user_id ELSE conn_id END) = user.user_id WHERE (connection.user_id = ' . $id . ' OR connection.conn_id = ' . $id . ') AND `conn_type` = \'p\' AND `conn_status` = \'a\'');;
    if ($user_education->num_rows() > 0) {
        $user['connections'] = $user_education->result_array();
    } else {
        $user['connections'] = array();
    }


    return $user;
}

function get_seprator($class = '')
{
?>
    <div class="seprator<?php echo ' ' . $class; ?>">
        <div class="sep_left"></div>
        <div class="sep_right"></div>
        <div class="clear"></div>
    </div>
<?php
}

function get_page($id)
{
    $ci = &get_instance();
    $row = $ci->db->from('page')->where('page_id', $id)->get()->row();
    if (strpos($row->page_content, '[[URLIF(job,job/post)]]') !== FALSE) {
        if (is_owner()) {
            $row->page_content = str_replace('[[URLIF(job,job/post)]]', '/job/post.html', $row->page_content);
        } else {
            $row->page_content = str_replace('[[URLIF(job,job/post)]]', '/job.html', $row->page_content);
        }
    }
    $row->page_content = str_replace(')]]', '.html', str_replace('[[URL(', '/', $row->page_content));
    return $row;
}

function get_state_name($state)
{
    $ci = &get_instance();
    return $ci->db->select('state_name')->from('directory_states')->where('st', $state)->get()->row()->state_name;
}

function location_range($selected)
{
    return $selected == "l" ? "Less than 100 miles" : "Any Distance";
}

function generate_pagination($count, $current)
{
    $total_page = 0;
    $pagesize = 20;
    $visible_pages = 5;
    $return = '';
    if ($count > $pagesize) {
        $return = '<div class="paginate">
		<ul class="pagination pagination-lg">';
        $return .= '<li><a href="#">Pages</a></li>';
        if ($count % $pagesize == 0) {
            $total_page = $count / $pagesize;
        } else {
            $total_page = intval($count / $pagesize) + 1;
            //echo $total_page;
        }
        if ($total_page <= 5) {
            for ($i = 1; $i <= $total_page; $i++) {
                $return .= '<li ' . ($current == $i ? 'class="page_active"' : '') . '><a href="?page=' . $i . '">' . $i . '</a></li>';
            }
        } else {
            if ($current != 1) {
                $return .= '<li><a href="?page="> << </a></li>';
                $return .= '<li><a href="?page=' . ($current - 1) . '"> < </a></li>';
            }
            $begin = 1;
            $end = 5;
            if ($current == 1 || $current - 2 <= 1) {
                $begin = 1;
                $end = 5;
                //echo $begin;
            } else if ($current == $total_page || $current + 2 >= $total_page) {
                $begin = $total_page - 4;
                $end = $total_page;
            } else {
                $begin = $current - 2;
                $end = $current + 2;
            }
            for ($i = $begin; $i <= $end; $i++) {
                $return .= '<li ' . ($current == $i ? 'class="page_active"' : '') . '><a href="?page=' . $i . '">' . $i . '</a></li>';
            }
            if ($current != $total_page) {
                $return .= '<li><a href="?page=' . ($current + 1) . '"> > </a></li>';
                $return .= '<li><a href="?page=' . $total_page . '"> >> </a></li>';
            }
        }
    } else {
        return '';
    }
    return $return . '</ul></div>';
}

function set_pager()
{
    $ci = &get_instance();
    //	echo substr($ci->db->last_query(),0,strpos($ci->db->last_query(), 'LIMIT'));//exit();
    //echo substr(str_replace('\%20','&nbsp;',$ci->db->last_query()),0,strpos(str_replace('\%20','&nbsp;',$ci->db->last_query()), 'LIMIT'));
    $total = $ci->db->query(substr($ci->db->last_query(), 0, strpos($ci->db->last_query(), 'LIMIT')))->num_rows();
    $page = ($ci->input->get('page') != '' ? $ci->input->get('page') : 1);
    $ci->session->set_userdata('list_pager', generate_pagination($total, $page));
    //print_r($ci->session);
}

function set_pager_return()
{
    $ci = &get_instance();
    //echo substr($ci->db->last_query(),0,strpos($ci->db->last_query(), 'LIMIT'));exit();
    $total = $ci->db->query(substr(str_replace('\%20', '&nbsp;', $ci->db->last_query()), 0, strpos(str_replace('\%20', '&nbsp;', $ci->db->last_query()), 'LIMIT')))->num_rows();
    $page = ($ci->input->get('page') != '' ? $ci->input->get('page') : 1);
    //$ci->session->set_userdata('list_pager',generate_pagination($total,$page));
    //print_r($ci->session);
    return '<div class="space">' . generate_pagination($total, $page) . '</div>';
}

function get_pager()
{
    $ci = &get_instance();
    $ret = $ci->session->userdata('list_pager');
    $ci->session->set_userdata('list_pager', '');
    return $ret;
}

function get_exint_dbfield_title($key)
{
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

function get_exint_dbfield_title_new($key)
{
    $arExInt = array();
    $arExInt['exWet_Wash'] = array('name' => 'Wet Wash', 'type' => 'ext');
    $arExInt['exDry_Wash'] = array('name' => 'Dry Wash', 'type' => 'ext');
    $arExInt['Wet_Wash'] = array('name' => 'Wet Wash', 'type' => 'ext');
    $arExInt['Dry_Wash'] = array('name' => 'Dry Wash', 'type' => 'ext');
    $arExInt['exExterior_Paint'] = array('name' => 'Exterior Paint', 'type' => 'ext');
    $arExInt['exBright_Work'] = array('name' => 'Bright Work', 'type' => 'ext');
    $arExInt['exDe-Ice_Boots'] = array('name' => 'De-Ice Boots', 'type' => 'ext');
    $arExInt['exLanding_Gear'] = array('name' => 'Landing Gear', 'type' => 'ext');
    $arExInt['exGear_Wells'] = array('name' => 'Gear Wells', 'type' => 'ext');
    $arExInt['inCarpet'] = array('name' => 'Carpet', 'type' => 'int');
    $arExInt['inLeather'] = array('name' => 'Upholstery', 'type' => 'int');
    $arExInt['inCabinetry'] = array('name' => 'Trim/Cabinet', 'type' => 'int');
    $arExInt['inGlass'] = array('name' => 'Windows', 'type' => 'int');
    $arExInt['inTrim'] = array('name' => 'Interior Trim', 'type' => 'int');
    return $arExInt[$key];
}

function get_exint_email_title($key)
{
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
function push_message($message, $is_error = false)
{
    $ci = &get_instance();
    if ($is_error) {
        $ci->session->set_flashdata('msg_error', $message);
    } else {
        $ci->session->set_flashdata('msg_success', $message);
    }
}

function pop_message()
{
    $ci = &get_instance();
    $ret = '';

    $tmp_error = $ci->session->flashdata('msg_error');
    $tmp_success = $ci->session->flashdata('msg_success');

    if ($tmp_error != '') {
        $ret = '<div class="alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong>Error!</strong><p>' . $tmp_error . '</p></div>';
    } else if ($tmp_success != '') {
        $ret = '<div class="alert alert-success fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong>Success!</strong><p>' . $tmp_success . '</p></div>';
    }
    return $ret;
}

function set_title($title)
{
    $ci = &get_instance();
    $ci->session->set_userdata('page_title', $title);
}

function get_title()
{
    $ci = &get_instance();
    return $ci->session->userdata('page_title') . ($ci->session->userdata('page_title') != '' ? ' | ' : '') . RIZ_SITE_NAME;
}

function get_heading()
{
    $ci = &get_instance();
    return $ci->session->userdata('page_title');
}

/*
 * Select Boxes
 */
function get_select_state($selected = "")
{
    return select_state_id($selected);
}

function get_select_county($state = "", $selected = "")
{
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

function get_select_radius($selected = "")
{
    //$ci =& get_instance();
    //	$query = $ci->db->query('SELECT maker_id, manufacturer FROM manufacturer order by manufacturer');
    $return = '<option value="">Select Radius</option>
	<option value="10"' . ('10' == $selected ? ' selected="selected"' : '') . '>10</option>
	<option value="25"' . ('25' == $selected ? ' selected="selected"' : '') . '>25</option>
	<option value="50" selected>50</option>
	<option value="100"' . ('100' == $selected ? ' selected="selected"' : '') . '>100</option>
	<option value="200"' . ('200' == $selected ? ' selected="selected"' : '') . '>200</option>';
    /*	if($query->num_rows() > 0){
            foreach($query->result() as $row){
                if($row->manufacturer!=''){
                    $return .= '<option value="'.$row->maker_id.'"'.($row->maker_id == $selected?' selected="selected"':'').'>'.$row->manufacturer.'</option>';
                }
            } */
    //}
    return $return;
}

function get_select_cfi($selected = "")
{
    //$ci =& get_instance();
    //	$query = $ci->db->query('SELECT maker_id, manufacturer FROM manufacturer order by manufacturer');
    $return = '
	<option value="CFI Rate"' . ('Not a CFI' == $selected ? ' selected="selected"' : '') . '>CFI Rate</option>
	<option value="Not a CFI"' . ('Not a CFI' == $selected ? ' selected="selected"' : '') . '>Not a CFI</option>
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

function get_select_counties($state = "", $selected = "")
{
    $ci = &get_instance();
    $query = $ci->db->query('SELECT name as county FROM county ' . ($state != '' ? 'WHERE state_id in (select id from state where shortname = \'' . $state . '\')' : '') . ' order by county');
    $return = '<option value="">Select A County</option>';
    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $return .= '<option value="' . $row->county . '"' . ($row->county == $selected ? ' selected="selected"' : '') . '>' . $row->county . '</option>';
        }
    }
    return $return;
}

function get_how_hear($selected = "")
{
    $arFrom = array('Long time Visitor', 'Airline pilot forums', 'Flightinfo.com', 'Pilotpointer.com', 'Google Ad', 'Google Search', 'Yahoo Search', 'E-mail', 'Friend', 'Postcard', 'Other');
    $return = '<option value="">Select A Source</option>';
    if ($arFrom > 0) {
        foreach ($arFrom as $row) {
            $return .= '<option value="' . $row . '"' . ($row == $selected ? ' selected="selected"' : '') . '>' . $row . '</option>';
        }
    }
    return $return;
}

function get_medical($selected = "")
{
    $arFrom = array('First Class', 'Second Class', 'Third Class');
    $return = '<option value="">Select A Class</option>';
    if ($arFrom > 0) {
        foreach ($arFrom as $row) {
            $return .= '<option value="' . $row . '"' . ($row == $selected ? ' selected="selected"' : '') . '>' . $row . '</option>';
        }
    }
    return $return;
}

function get_select_make($selected = "")
{
    $ci = &get_instance();
    $query = $ci->db->query('SELECT maker_id, manufacturer FROM manufacturer order by manufacturer');
    $return = '<option value="">Select Make</option>';
    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            if ($row->manufacturer != '') {
                $return .= '<option value="' . $row->maker_id . '"' . ($row->maker_id == $selected ? ' selected="selected"' : '') . '>' . $row->manufacturer . '</option>';
            }
        }
    }
    return $return;
}

function get_select_model($make_id = "", $selected = "")
{
    $ci = &get_instance();
    if ($make_id != "") {
        $query = $ci->db->query('SELECT model_id, model FROM models ' . ($make_id != '' ? 'where maker_id = ' . $make_id : '') . ' order by model');
    }
    $return = '<option value="">Select Model</option>';
    if ($make_id != "") {
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $return .= '<option value="' . $row->model_id . '"' . ($row->model_id == $selected ? ' selected="selected"' : '') . '>' . $row->model . '</option>';
            }
        }
    }
    return $return;
}

function get_select_duex_option($selected = '')
{
    $arFrom = array('Standard' => 'UpKeep', 'Deluxe' => 'Rejuvenation');
    $return = '<option value="">Choose</option>';
    if ($arFrom > 0) {
        foreach ($arFrom as $row) {
            $return .= '<option value="' . $row . '"' . ($row == $selected ? ' selected="selected"' : '') . '>' . $row . '</option>';
        }
    }
    return $return;
}

function get_select_upholstery_option($selected = '')
{
    $arFrom = array('Vinyl' => 'Vinyl', 'Cloth' => 'Cloth', 'Leather' => 'Leather');
    $return = '<option value="">Choose</option>';
    if ($arFrom > 0) {
        foreach ($arFrom as $row) {
            $return .= '<option value="' . $row . '"' . ($row == $selected ? ' selected="selected"' : '') . '>' . $row . '</option>';
        }
    }
    return $return;
}

function select_month($selected = '')
{
    $arMonth = array('1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
    $return = '';
    foreach ($arMonth as $key => $val) {
        $return .= '<option value="' . $key . '"' . ($key == $selected ? ' selected="selected"' : '') . '>' . $val . '</option>';
    }
    return $return;
}

function select_year($selected = '')
{
    $return = '';
    for ($key = 1940; $key <= date('Y'); $key++) {
        $return .= '<option value="' . $key . '"' . ($key == $selected ? ' selected="selected"' : '') . '>' . $key . '</option>';
    }
    return $return;
}

function get_select_rating($selected = '')
{
    $arRating = array('STU', 'MEL', 'SES', 'MES', 'IFR', 'Rotorcraft', 'Glider', 'CFI', 'CFII', 'MEI');
    /*$return = '<option value="">Select your Rating</option>';
    foreach($arRating as $val){
        $return .= '<option value="'.$val.'"'.($val == $selected?' selected="selected"':'').'>'.$val.'</option>';
    }*/
    return $arRating;
}

function get_select_certificate($selected = '')
{
    //$arCertificate = array('Student','Private','Commerical','ATP','Recreational','Sport');
    $arCertificate = array('Commerical', 'ATP');
    $return = '<option value="">Select your Certificate</option>';
    foreach ($arCertificate as $val) {
        $return .= '<option value="' . $val . '"' . ($val == $selected ? ' selected="selected"' : '') . '>' . $val . '</option>';
    }
    return $return;
}

function get_select_user_type($selected = '')
{
    $array = array(
             
        'P' => 'PILOT',
        'D' => 'Flight Department',
        //'o' => 'Owner',
        //'f' => 'Free User',
        //'q' => 'Q User',
        //'t' => 'T User',
        'A' => 'FLIGHT ATTENDANT',
        'F' => 'FLIGHT INSTRUCTOR',
        'AI' => 'AUTHORIZED AIRCRAFT INSTRUCTOR',
        'U' => 'REMOTE PILOT',
        'G' => 'GROUND INSTRUCTOR',
        'E' => 'FLIGHT ENGINEER',
        'H' => 'FLIGHT ENGINEER(Special Purpose–Lessee)',
        'X' => 'FLIGHT ENGINEER (Foreign Based)',
        'M' => 'MECHANIC',
        'T' => 'CONTROL TOWER OPERATOR',
        'R' => 'REPAIRMAN',
        'I' => 'REPAIRMAN EXPERIMENTAL ACFT BUILDER',
        'L' => 'REPAIRMAN LIGHT SPORT AIRCRAFT',
        'W' => 'PARACHUTE RIGGER',
        'S' => 'DISPATCHER',
        'N' => 'FLIGHT NAVIGATOR',
        'J' => 'FLIGHT NAVIGATOR (Special Purpose–Lessee)'
    );

    if ($selected == '') {
        return $array;
    } else {
        return $array[$selected];
    }
}

function get_select_user_status($selected = '')
{
    $array = array(
        'a' => array('Active', 'success'),
        'n' => array('Not Active', 'danger'),
        'v' => array('Verified', 'success'),
        'p' => array('Pending', 'warning')
    );

    if ($selected == '') {
        return $array;
    } else {
        return $array[$selected];
    }
}

/*
 * Updated Form Generator
 */


function form_new_input_side($label, $name, $value, $required, $class = '', $placeholder = '', $wrap_class = 'col-sm-3', $label_class = 'col-sm-2')
{
?>
    <?php $error = form_error($name, '<p class="error help-block"><span class="label label-important">', '</span></p>'); ?>
    <label class="<?php echo (trim($label_class) == '' ? 'col-sm-2' : $label_class); ?> control-label"><?php echo $label; ?></label>
    <div class="<?php echo (trim($wrap_class) == '' ? 'col-sm-3' : $wrap_class); ?> controls">
        <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="input-border-btm <?php echo ($class != '' ? $class : ''); ?>" placeholder="<?php echo $placeholder; ?>" />
        <?php echo $error; ?>
    </div>


<?php
}


function form_new_text_side($label, $name, $value, $required, $class = '', $placeholder = '')
{
?>
    <div class="form-group<?php echo ($required == true ? ' required' : ''); ?>">
        <label class="col-sm-3 control-label"><?php echo $label; ?></label>
        <div class="col-sm-7 controls">
            <textarea class="width-90<?php echo ($class != '' ? ' ' . $class . '' : ''); ?>" id="<?php echo $name; ?>" name="<?php echo $name; ?>"><?php echo $value; ?></textarea>
        </div>
    </div>
<?php
}

function form_new_select_side($list, $label, $name, $value, $required = false, $type = 'text', $class = '', $placeholder = '')
{
    $options = 'class ="input-border-btm ' . $class . '" id="' . $name . '"';

    if ($required) {
        $options .= ' required="required"';
    }

    echo form_dropdown($name, $list, $value, $options);
}

function form_new_select_side_with_option($label, $name, $select_box, $required, $class = 'select', $chtml = '')
{
?>
    <?php $error = form_error($name, '<p class="error help-block"><span class="label label-important">', '</span></p>'); ?>
    <select class="input-border-btm <?php echo $class; ?>" name="<?php echo $name; ?>" id="<?php echo $name; ?>">
        <?php echo $select_box; ?>
    </select>
    <?php echo $error; ?>
<?php
}


function form_new_input($label, $name, $value, $required, $class = '', $placeholder = '')
{
?>
    <?php $error = form_error($name, '<p class="error help-block"><span class="label label-important">', '</span></p>'); ?>
    <div class="form-group<?php echo ($error != '' ? ' error' : ''); ?><?php echo ($required == true ? ' required' : ''); ?>">
        <label><?php echo $label; ?></label>
        <div class="controls">
            <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo ($class != '' ? $class : 'form-control'); ?>" placeholder="<?php echo $placeholder; ?>" />
            <?php echo $error; ?>
        </div>
    </div>
<?php
}


function form_new_ffd($label, $name, $value, $required, $type = 'text', $class = '', $placeholder = '', $icon = '')
{
?>
    <?php $error = form_error($name, '<p class="error help-block"><span class="label label-important">', '</span></p>'); ?>
    <div class="form_ele control-group<?php echo ($error != '' ? ' error' : ''); ?><?php echo ($required == true ? ' required' : ''); ?>">
        <?php if ($label != '') { ?><label><?php echo $label; ?></label><?php } ?>
        <div class="form-level">
            <input name="<?php echo $name; ?>" id="<?php echo $name; ?>" placeholder="<?php echo $placeholder; ?>" value="<?php echo $value; ?>" type="<?php echo $type; ?>" class="<?php echo ($class != '' ? $class : 'input-block'); ?>" />
            <?php echo $icon; ?>
            <?php echo $error; ?>
        </div>
    </div>
<?php
}


function form_new_hidden($label, $name, $value, $required, $class = '', $placeholder = '')
{
?>
    <input type="hidden" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo ($class != '' ? $class : 'input'); ?>" />
<?php
}

function form_new_file($label, $name, $value, $required, $class = '', $placeholder = '')
{
?>
    <?php $error = form_error($name, '<p class="error help-block"><span class="label label-important">', '</span></p>'); ?>
    <div class="form_ele control-group<?php echo ($error != '' ? ' error' : ''); ?><?php echo ($required == true ? ' required' : ''); ?>">
        <label><?php echo $label; ?></label>
        <div class="controls">
            <input type="file" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo ($class != '' ? $class : 'input'); ?>" placeholder="<?php echo $placeholder; ?>" />
            <?php echo $error; ?>
        </div>
    </div>
<?php
}

function form_new_input_sidelabel($label, $name, $value, $required, $class = '', $placeholder = '')
{
?>
    <?php $error = form_error($name, '<p class="error help-block"><span class="label label-important">', '</span></p>'); ?>
    <div class="form_ele control-group<?php echo ($error != '' ? ' error' : ''); ?><?php echo ($required == true ? ' required' : ''); ?>">
        <div class="controls left">
            <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo ($class != '' ? $class : 'short input'); ?>" placeholder="<?php echo $placeholder; ?>" />
            <?php echo $error; ?>
        </div>
        <label class="left short_label"><?php echo $label; ?></label>
        <div class="clear"></div>
    </div>
<?php
}

function form_new_password($label, $name, $value, $required, $class = '', $placeholder = '')
{
?>
    <?php $error = form_error($name, '<p class="error help-block"><span class="label label-important">', '</span></p>'); ?>
    <div class="form_ele control-group<?php echo ($error != '' ? ' error' : ''); ?><?php echo ($required == true ? ' required' : ''); ?>">
        <label><?php echo $label; ?></label>
        <div class="controls">
            <input type="password" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo ($class != '' ? $class : 'input'); ?>" placeholder="<?php echo $placeholder; ?>" />
            <?php echo $error; ?>
        </div>
    </div>
<?php
}

function form_new_select($label, $name, $select_box, $required, $class = 'select', $chtml = '')
{
?>
    <?php $error = form_error($name, '<p class="error help-block"><span class="label label-important">', '</span></p>'); ?>
    <div class="form_ele control-group<?php echo ($error != '' ? ' error' : ''); ?><?php echo ($required == true ? ' required' : ''); ?>">
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

function form_new_radio($labl, $id, $name, $value, $checked, $required, $class = '')
{
?>
    <div class="form_ele_radio control-group<?php echo ($required == true ? ' required' : ''); ?>">
        <input type="radio" name="<?php echo $name; ?>" id="<?php echo $id; ?>" <?php echo ($checked == true ? 'checked="checked"' : ''); ?> value="<?php echo trim($value); ?>" />
        <label><?php echo $labl; ?></label>
        <div class="clear"></div>
    </div>
<?php
}

function form_new_textarea($labl, $name, $value, $required, $class = 'form-control', $rows = 8)
{
?>
    <?php $error = form_error($name, '<p class="error help-block"><span class="label label-important">', '</span></p>'); ?>
    <div class="form-group<?php echo ($required == true ? ' required' : ''); ?>">
        <label><?php echo $labl; ?></label>
        <div class="controls">
            <textarea rows="<?php echo $rows; ?>" <?php echo ($class != '' ? ' class="' . $class . '"' : ''); ?> id="<?php echo $name; ?>" name="<?php echo $name; ?>"><?php echo trim($value); ?></textarea>
        </div>
    </div>
<?php
}

function form_new_textarea_emer($labl, $name, $value, $required, $class = '')
{
?>
    <?php $error = form_error($name, '<p class="error help-block"><span class="label label-important">', '</span></p>'); ?>
    <div class="form_ele control-group<?php echo ($required == true ? ' required' : ''); ?>">
        <label><?php echo $labl; ?></label>
        <div class="controls">
            <textarea <?php echo ($class != '' ? ' class="' . $class . '"' : ''); ?> id="<?php echo $name; ?>" name="<?php echo $name; ?>"><?php echo ($value); ?></textarea>
            <?php echo $error; ?>
        </div>
    </div>
<?php
}

function form_new_checkbox($label, $id, $name, $value, $checked, $required, $class = '', $push_left = false, $csHTML = '')
{
?>
    <div class="form_ele_radio control-group <?php echo ($push_left == true ? '' : 'no-margin-left'); ?> <?php echo ($required == true ? ' required' : ''); ?>">
        <div class="controls">
            <input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $id; ?>" <?php echo ($checked == true ? 'checked="checked"' : ''); ?> value="<?php echo $value; ?>" />
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

function form_new_check_list($label, $name, $list, $value)
{
    if (!is_array($value)) {
        $value = explode(',', $value);
    }
?>
    <div class="form_ele control-group">
        <label><?php echo $label; ?></label>
        <div class="controls">
            <?php foreach ($list as $key => $ckh) {
            ?>
                <input type="checkbox" <?php echo (array_search($ckh, $value) !== FALSE ? 'checked="checked"' : ''); ?> name="<?php echo $name; ?>" value="<?php echo $ckh; ?>" /> <?php echo $ckh; ?>
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

function forum_cover($name, $label, $input)
{
    $error = form_error($name, '<span class="help-block m-b-none">', '</span>');
    return '<div class="form-level">' . ($label != '' ? '<p>' . $label . '</p>' : '') . $input . $error . '</div>';
}

function form_new_input_updated($label, $name, $value, $required = false, $type = 'text', $class = '', $placeholder = '', $private = '', $style = '')
{
    $options = array(
        'id' => $name,
        'name' => $name,
        'value' => trim($value),
        'placeholder' => $placeholder,
        'class' => $class,
        'type' => $type,
        'style' => $style,
    );
    if ($required) {
        $options['required'] = 'required';
    }
    $html = '';
    if ($private != '') {
        if (strpos($private, 'span') === FALSE) {
            $options['style'] = 'width:70%;';
            $html = '<input type="checkbox" id="' . $private . '" name="' . $private . '" value="y"  /><label for="c4"> Keep Private</label>';
        } else {
            $html = $private;
        }
    }
    echo forum_cover($name, $label, form_input($options) . $html);
}

function form_new_textarea_updated($label, $name, $value, $required = false, $rows = 3, $class = '', $placeholder = '')
{
    $options = array(
        'id' => $name,
        'name' => $name,
        'value' => trim($value),
        'placeholder' => $placeholder,
        'class' => $class,
        'rows' => $rows
    );
    if ($required) {
        $options['required'] = 'required';
    }
    echo forum_cover($name, $label, form_textarea($options));
}

function form_new_select_updated($list, $label, $name, $value, $required = false, $type = 'text', $class = '', $placeholder = '', $js = '', $isMultiple = false)
{
    $options = 'v-model="' . $name . '" class ="' . $class . '" id="' . $name . '" ' . $js;

    if ($isMultiple == true) {
        $options .= ' multiple="multiple"';
    }


    if ($required) {
        $options .= ' required="required"';
    }

    echo forum_cover($name, $label, form_dropdown($name, $list, $value, $options));
}

//Functions to calculate distance

function distance($lat1, $lon1, $lat2, $lon2, $unit)
{

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
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
function mathGeoProximity($latitude, $longitude, $radius, $miles = true)
{
    $radius = $miles ? $radius : ($radius * 0.621371192);

    $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
    $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
    $lat_min = $latitude - ($radius / 69);
    $lat_max = $latitude + ($radius / 69);

    return array(
        'latitudeMin' => $lat_min,
        'latitudeMax' => $lat_max,
        'longitudeMin' => $lng_min,
        'longitudeMax' => $lng_max
    );
}

// calculate geographical distance between 2 points
function mathGeoDistance($lat1, $lng1, $lat2, $lng2, $miles = true)
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

function get_user_pic_url($url, $type = '')
{
    if ($type != 'd') {
        if ($url != "") {
            return (strpos($url, 'http') === FALSE ? RIZ_UPLOAD_PHOTO : '') . $url;
        } else {
            $userType = get_user_type(strtoupper($type));
            if (isset($userType["icon"])) {
                return RIZ_ASSETS . 'images/types/' . $userType["icon"];
            } else {
                return RIZ_ASSETS . 'images/types/P.png';
            }
        }
    } else {
        return $url == '' ? 'data:image/png;base64,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' : (strpos($url, 'http') === FALSE ? RIZ_UPLOAD_PHOTO : '') . $url;
    }
}

function get_user_bg_url($url, $type = '')
{
    if ($url != "") {    
    $ci = &get_instance();
    $id = $ci->session->userdata('user_id');
    $user_photo['path'] = $ci->db->select('photo_path')->from('photo')->where('user_id', $id)->where('photo_title', 'Flight Map')->order_by('photo_id DESC')->get()->row()->photo_path;
     if ($user_photo['path']<> '') {
         //echo('check'.$user_photo['path']);
        return '/upload/photo/'.$user_photo['path'];
    } else {
        return (strpos($url, 'http') === FALSE ? RIZ_UPLOAD_PHOTO : '') . $url;
    }       
    } else {
        $userType = get_user_type(strtoupper($type));
        if (isset($userType["icon"])) {
            return RIZ_ASSETS . 'images/types/Pbg.jpeg';
        }
        }
    }
    

function get_photo_url($url, $type = '')
{
    return $url == '' ? RIZ_BASE_URL . 'assets/temp/images/avatars/avatar' . rand(1, 11) . '_big.png' : RIZ_UPLOAD_PHOTO . $url;
}

function get_news_photo_url($url)
{
    return $url == '' ? RIZ_BASE_URL . 'assets/temp/images/avatars/avatar' . rand(1, 11) . '_big.png' : RIZ_UPLOAD_NEWS . $url;
}

function get_aircraft_photo_url($url)
{
    return $url == '' ? 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMS45OTkgNTExLjk5OSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTExLjk5OSA1MTEuOTk5OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBzdHlsZT0iZmlsbDojNUM1NDZBOyIgZD0iTTE0OS42LDQ0MS43NDdsNzMuNDY5LTgwbC0xNS43MzgtNDEuMDgzYzAsMC00Ny4zMzMsNi42NjctNDguNjY3LDEwLjY2NyAgICBjLTEuMzMzLDQtNS4zMzMsNTcuMzMzLTYsNjYuNjY3QzE1MS45OTgsNDA3LjMzLDE0OS42LDQ0MS43NDcsMTQ5LjYsNDQxLjc0NyIvPgoJPC9nPgoJPGc+CgkJPHBhdGggc3R5bGU9ImZpbGw6I0I5QkJDMTsiIGQ9Ik01MDkuNzY0LDM4LjQ1Yy0yLjIxOS0yLjI5Ny01LjU3OC0zLjA0Ny04LjU0Ny0xLjk1M2wtNDk2LDE4NCAgICBjLTMuMDMxLDEuMTI1LTUuMDg2LDMuOTYxLTUuMjExLDcuMTkxczEuNzAzLDYuMjE5LDQuNjQxLDcuNTc0bDg5LjIyNyw0MS4xNzZjNi45MzgsMy4yMDcsMTEuOTc3LDkuNTk0LDEzLjQ3NywxNy4wODYgICAgbDI4LjgwNSwxNDQuMDQzYzAuNjY0LDMuMzA1LDMuMzI4LDUuODQ0LDYuNjY0LDYuMzQ0YzMuMjgxLDAuNDczLDYuNjE3LTEuMTUyLDguMjI3LTQuMTIxbDQ1LjQ3Ny04NC40NTMgICAgYzEuMjM0LTIuMjkzLDMuNDIyLTMuODA1LDYtNC4xNDFjMi42MDItMC4zMzYsNS4wNzgsMC41NTEsNi44NTksMi40NDlMMzIyLjE3LDQ3My40ODFjMS41MzEsMS42MjEsMy42NDEsMi41MTYsNS44MjgsMi41MTYgICAgYzAuNDc3LDAsMC45NjEtMC4wNDMsMS40MzgtMC4xMjljMi42NzItMC40ODgsNC45MTQtMi4yOTcsNS45NTMtNC44MDVsMTc2LTQyNEM1MTIuNjA3LDQ0LjEyNiw1MTEuOTY3LDQwLjc0Myw1MDkuNzY0LDM4LjQ1eiIvPgoJPC9nPgoJPGc+CgkJPHBhdGggc3R5bGU9ImZpbGw6IzhCODk5NjsiIGQ9Ik01MDYuMTk4LDM2LjM2NWwtNDA0Ljk3MSwyNDUuNThjMy4wMTIsMy4yMjUsNS4yMzgsNy4xNTgsNi4xMjQsMTEuNTc4bDI4LjgwNSwxNDQuMDQzICAgIGMwLjY2NCwzLjMwNSwzLjMyOCw1Ljg0NCw2LjY2NCw2LjM0NGMzLjI4MSwwLjQ3Myw2LjYxNy0xLjE1Miw4LjIyNy00LjEyMWw0NS40NzctODQuNDUzYzAuMzItMC41OTQsMC44NTUtMC45NywxLjI5My0xLjQ1MiAgICBjMC4wMzUtMC4xNzYsMC4wNjktMC4zNTEsMC4wNjktMC4zNTFMNTA5LjcwMiwzOC40MDNDNTA4LjcxMywzNy4zOTksNTA3LjQ5NSwzNi43MzgsNTA2LjE5OCwzNi4zNjV6Ii8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==' : RIZ_UPLOAD_AIRCRAFT . $url;
}

function get_input_value($data, $name, $field)
{
    $ci = &get_instance();
    if ($ci->input->post($field) != '') {
        return $ci->input->post($field);
    } else if (isset($data[$name])) {
        return trim($data[$name]);
    } else {
        return '';
    }
}

function get_value($name)
{
    $ci = &get_instance();
    if ($ci->input->post($name) != '') {
        return $ci->input->post($name);
    } else {
        return '';
    }
}

function get_data_value($data, $name)
{
    return isset($data[$name]) ? $data[$name] : '';
}

function get_data_value_date($data, $name)
{
    return isset($data[$name]) ? date(RIZ_FORMAT, $data[$name]) : '';
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
function get_curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, 'http://dev.hireexpertprogrammers.com/Aircraft/safetypilot.html');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function select_job_type($select = '')
{
    $ar = array(
        '' => 'Select',
        'p' => 'Pilots',
        'm' => 'Mechanic',
        'a' => 'Flight Attendent',
        's' => 'Flight Dispatcher',
        'p' => 'Captain',
        'p' => 'Co-Pilot'

    );

    return ($select != '' ? $ar[$select] : $ar);
}

function select_benefits($select = '')
{
    $ar = ["Company Paid Medical Dental and Vision", "Company Paid Short Term Disability, Long Term Disability, and Basic Life", "401k", "Company"];
    return ($select != '' ? $ar[$select] : $ar);
}


function select_aircraft_model($select = "")
{
    $ci = &get_instance();
    $data = $ci->db->select("model_id AS key, model AS val")->from("directory_models")->get()->result_array();
    $result = array('' => 'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}


function select_aircraft_make($select = "")
{
    $ci = &get_instance();
    $data = $ci->db->select("maker_id AS key, manufacturer AS val")->from("directory_manufacturer")->get()->result_array();
    $result = array('' => 'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}

function select_aircraft_make_model_byUserID($userId, $withDefault = true)
{
    $ci = &get_instance();
    $data = $ci->db
        ->select("CONCAT(dir_acftref.mfr, ' ', dir_acftref.model) AS val, user_aircraft.air_id AS key")
        ->from("user_aircraft")
        ->join("dir_master", "user_aircraft.aircraft_id = dir_master.id")
        ->join("dir_acftref", "dir_acftref.code = dir_master.mfr_mdl_code")
        ->where("user_id", $userId)
        ->get()->result_array();

    if ($withDefault == true) {
        $result = array('' => 'Select Aircraft');
    } else {
        $result = array();
    }
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}

function select_aircraft_make_model_byUserID_forSubscription($userId, $withDefault = true)
{
    $ci = &get_instance();
    $data = $ci->db
        ->select("CONCAT(dir_acftref.mfr, ' ', dir_acftref.model) AS val, user_aircraft.air_id AS key")
        ->from("user_aircraft")
        ->join("user_subscription_planes", "user_aircraft.air_id = user_subscription_planes.aircraft_id")
        ->join("dir_master", "user_aircraft.aircraft_id = dir_master.id")
        ->join("dir_acftref", "dir_acftref.code = dir_master.mfr_mdl_code")
        ->where("user_id", $userId)
        ->get()->result_array();

    if ($withDefault == true) {
        $result = array('' => 'Select Aircraft');
    } else {
        $result = array();
    }
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}


function get_aircraft_detail_by_id($aircraft_id)
{
    $ci = &get_instance();
    $data = $ci->db->select("mfr_name AS make, model_name AS model")->from("directory_aircrafts")->where('id', $aircraft_id)->get()->result_array();
    $data = $data[0];
    $make_data = $ci->db->select("maker_id")->from("directory_manufacturer")->where('manufacturer', $data['make'])->get()->result_array();
    $make_data = $make_data[0];
    $model_data = $ci->db->select("model_id")->from("directory_models")->where('model', $data['model'])->where('maker_id', $make_data['maker_id'])->get()->result_array();
    $model_data = $model_data[0];
    $result['make'] = $data['make'];
    $result['model'] = $data['model'];
    $result['maker_id'] = $make_data['maker_id'];
    $result['model_id'] = $model_data['model_id'];
    return $result;
}

function select_state($select = "")
{
    $ci = &get_instance();
    $data = $ci->db->select("st AS key, state_name AS val")->from("directory_states")->get()->result_array();
    $result = array('' => 'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}


function json_render($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
}

function get_notification_icon($text)
{
    if (strpos($text, 'like') !== FALSE) {
        return 'fa-thumbs-up';
    } else {
        return 'fa-comment';
    }
}

function get_post_type_icon_color($type)
{
    if ($type == 'p') {
        return
            array(
                'icon' => 'fa-image',
                'color' => 'warning',
                'border' => 'vd_yellow'
            );
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

function get_latlng($query)
{
    $response = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . str_replace(' ', '+', str_replace('%20', '+', $query)) . '&key=' . GOOGLE_BROWSER_API_KEY);
    $response = json_decode($response);
    if (isset($response->results) && count($response->results) > 0) {
        return $response->results[0]->geometry->location;
    }
    return false;
}

function get_user_type($selected = '')
{
    $ar = [
        "AI" => ["name" => "AUTHORIZED AIRCRAFT INSTRUCTOR", "icon" => "A.png"],
        "S" => ["name" => "Flight DISPATCHER", "icon" => "D.png"],
        "E" => ["name" => "FLIGHT ENGINEER", "icon" => "F.png"],
        "A" => ["name" => "Flight ATTENDANT", "icon" => "F.png"],
        "F" => ["name" => "FLIGHT INSTRUCTOR", "icon" => "F.png"],
        "G" => ["name" => "GROUND INSTRUCTOR", "icon" => "D.png"],
        "I" => ["name" => "REPAIRMAN EXPERIMENTAL ACFT BUILDER", "icon" => "M.png"],
        "L" => ["name" => "REPAIRMAN LIGHT SPORT AIRCRAFT", "icon" => "M.png"],
        "M" => ["name" => "Mechanic", "icon" => "M.png"],
        "N" => ["name" => "FLIGHT NAVIGATOR", "icon" => "A.png"],
        "J" => ["name" => "FLIGHT NAVIGATOR (Special Purpose–Lessee)", "icon" => "A.png"],
        "P" => ["name" => "Pilot", "icon" => "P.png"],
        "R" => ["name" => "REPAIRMAN", "icon" => "M.png"],
        "T" => ["name" => "CONTROL TOWER OPERATOR", "icon" => "A.png"],
        "U" => ["name" => "REMOTE PILOT", "icon" => "P.png"],
        "W" => ["name" => "PARACHUTE RIGGER", "icon" => "A.png"],
        "X" => ["name" => "FLIGHT ENGINEER (Foreign Based)", "icon" => "F.png"],
        "H" => ["name" => "FLIGHT ENGINEER(Special Purpose–Lessee)", "icon" => "F.png"],
    ];

    if ($selected == '') {
        return $ar;
    } else {
        return $ar[$selected];
    }
}

function xl_company_name()
{
    return [
        "Aero Commander Division" => "AERO COMMANDER",
        "Aérospatiale, France" => "AEROSPATIALE",
        "Airbus (formerly known as" => "AIRBUS",
        "Aircraft Industries a.s." => "AIRCRAFT INDUSTRIES AS",
        "The Boeing Company" => "BOEING",
        "Bombardier Inc." => "BOMBARDIER INC",
        "British Aerospace" => "BRITISH AEROSPACE",
        "British Aircraft Corporation, UK" => "BRITISH AIRCRAFT CORP",
        "Bushmaster Aircraft Corporation," => "BUSHMASTER",
        "Canadair Ltd., Canada" => "CANADAIR LTD",
        "Textron Aviation Inc." => "CESSNA",
        "Cirrus Design Corporation" => "CIRRUS DESIGN CORP",
        "Curtiss-Wright Corporation, USA" => "CURTISS WRIGHT",
        "Dee Howard Co., USA" => "DEE HOWARD COMPANY",
    ];
}

function non_pilot_types($type)
{
    $type = strtoupper($type);
    $types = [
        'P' => 'PILOT',
        'F' => 'FLIGHT INSTRUCTOR',
        'A' => 'FLIGHT ATTENDANT',
        'AI' => 'AUTHORIZED AIRCRAFT INSTRUCTOR',
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
        'S' => 'DISPATCHER',
        'N' => 'FLIGHT NAVIGATOR',
        'J' => 'FLIGHT NAVIGATOR (Special Purpose–Lessee)'
    ];

    if (isset($types[$type])) {
        return $types[$type];
    } else {
        return '';
    }
}

function time_ago($d1, $d2)
{
    $datetime1 = date_create($d2);
    $datetime2 = date_create($d1);
    $diff = date_diff($datetime1, $datetime2);
    $timemsg = '';
    if ($diff->y > 0) {
        $timemsg = $diff->y . ' year' . ($diff->y > 1 ? "'s" : '');
    } else if ($diff->m > 0) {
        $timemsg = $diff->m . ' month' . ($diff->m > 1 ? "'s" : '');
    } else if ($diff->d > 0) {
        $timemsg = $diff->d . ' day' . ($diff->d > 1 ? "'s" : '');
    } else if ($diff->h > 0) {
        $timemsg = $diff->h . ' hour' . ($diff->h > 1 ? "'s" : '');
    } else if ($diff->i > 0) {
        $timemsg = $diff->i . ' minute' . ($diff->i > 1 ? "'s" : '');
    } else if ($diff->s > 0) {
        $timemsg = $diff->s . ' second' . ($diff->s > 1 ? "'s" : '');
    }

    $timemsg = $timemsg . ' ago';
    return $timemsg;
}

function check_pilot_certification($certificates)
{
    foreach ($certificates as $certification) {
        //echo "<br>certificate type = ".$certification['type']."<br>";
        if ($certification['type'] == 'P') {
            return true;
        }
    }
    return false;
}

function get_aircraft_maker_id($maker_name)
{
    $ci = &get_instance();
    $query = "select maker_id from directory_manufacturer where manufacturer = '$maker_name'";
    echo $query;
    $data = $ci->db->select("maker_id")->from("directory_manufacturer")->where('manufacturer', $maker_name)->get()->result_array();
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit();
    foreach ($data as $value) {
        return $value['maker_id'];
    }
    return false;
}

function get_aircraft_model_id($maker, $model_name, $is_maker_id = true)
{
    if (!$is_maker_id) {
        $maker = get_aircraft_maker_id($maker);
    }
    $ci = &get_instance();
    $data = $ci->db->select("model_id")->from("directory_models")->where('maker_id', $maker)->where('model', $model_name)->get()->result_array();
    foreach ($data as $value) {
        return $value['model_id'];
    }
    return false;
}


function executeCurlRequest($endpoint, $queryParams)
{
    $username = "Ungurait";
    $apiKey = "cad63eb3aeccd014d0ae495aaaec4f2d76084444";
    $fxmlUrl = "http://flightxml.flightaware.com/json/FlightXML3/";
    $url = $fxmlUrl . $endpoint . '?' . http_build_query($queryParams);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $apiKey);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    if ($result = curl_exec($ch)) {
        curl_close($ch);
        return $result;
    }
    return;
}

function executeCurlRequest2($endpoint, $queryParams)
{
    $username = "Ungurait";
    $apiKey = "4ec450334d9d709fa45df2d69cdb82af951a656d";
    $fxmlUrl = "https://flightxml.flightaware.com/json/FlightXML2/";
    $url = $fxmlUrl . $endpoint . '?' . http_build_query($queryParams);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $apiKey);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    if ($result = curl_exec($ch)) {
        curl_close($ch);
        return $result;
    }
    return;
}

function get_flights($nnumber, $date, $offset = -1)
{

    $ci = &get_instance();
    $info = $ci->db->from("flight_info_cache")->where("nnumber", $nnumber)->where("date", date("Y-m-d", strtotime($date)))->get();
    if ($info->num_rows() > 0) {
        return json_decode($info->row()->content);
    }

    $input = array(
        "ident" => $nnumber
    );
    if ($offset > -1) {
        $input["offset"] = $offset;
    }
    $return = [];
    $response = executeCurlRequest("FlightInfoStatus", $input);
    $flights = json_decode($response, true);
    if (isset($flights["FlightInfoStatusResult"])) {
        foreach ($flights["FlightInfoStatusResult"]["flights"] as $flight) {
            if ($flight["filed_departure_time"]["date"] == $date) {
                $return[] = array(
                    "ident" => $flight["ident"],
                    "faFlightID" => $flight["faFlightID"],
                    "ident" => $flight["ident"],
                    "origin" => $flight["origin"]["code"],
                    "destination" => $flight["destination"]["code"],
                    "departure" => $flight["filed_departure_time"]["time"],
                    "arrival" => $flight["estimated_arrival_time"]["time"],
                );
            } elseif (strtotime($flight["filed_departure_time"]["date"]) < strtotime($date)) {
                $flights["FlightInfoStatusResult"]["next_offset"] = -1;
            }
        }

        $output = '';
        if (count($return) > 0) {
            $return[0]["mapRoute"] = get_flight_map($return[0]["faFlightID"]);
            $output = array("status" => "success", "data" => $return);
        } elseif ($flights["FlightInfoStatusResult"]["next_offset"] != -1) {
            $output = array("status" => "error", "message" => "Flight is out of reach from out subscription Plan.");
        } else {
            $output = array("status" => "error", "message" => "Flight Not found with current query.");
        }

        $ci->db->insert("flight_info_cache", array(
            "nnumber" => $nnumber,
            "date" => date("Y-m-d", strtotime($date)),
            "content" => json_encode($output)
        ));

        return $output;
        //get_flights($nnumber, $date, $flights["FlightInfoStatusResult"]["next_offset"]);
    } else {
        echo json_encode(array("status" => "error", "message" => $flights["error"]));
        exit;
    }
}

function is_cts_subscribed($subscription)
{
    $subscription = (array)$subscription;
    return ($subscription["braintree_plan"] == L8_PLAN_PREMIUM_CTS && strtotime($subscription["ends_at"]) >= time());
}

function is_cts_subscribed_redirect($subscription)
{
    if (!is_cts_subscribed($subscription)) {
        push_message('Please subscribe to Candidate tracking system.', TRUE);
        redirect("flight-dispatch-board/subscribe/addons/l8premiumcts");
    }
}


function get_current_url()
{
    return base_url(uri_string());
}


function get_flight_map($flight)
{
    $ci = &get_instance();
    $info = $ci->db->from("flight_info_cache")->where("nnumber", $flight)->get();
    if ($info->num_rows() > 0) {
        return "data:image/png;base64, {$info->row()->content}";
    }

    $return = array();
    $maps = json_decode(executeCurlRequest2("MapFlightEx", array("faFlightID" => $flight, "mapHeight" => 500, "mapWidth" => 500, "show_data_blocks" => true, "show_airports" => true)), true);

    if (isset($maps["MapFlightExResult"])) {
        $return = $maps["MapFlightExResult"];

        $ci->db->insert("flight_info_cache", array(
            "nnumber" => $flight,
            "date" => "",
            "content" => $return
        ));
        return "data:image/png;base64, $return";
        exit;
    }

    //data:image/png;base64,
    return "data:image/png;base64, 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";
}

function get_flight_route($flight)
{

    $ci = &get_instance();
    $info = $ci->db->from("flight_info_cache")->where("nnumber", $flight)->get();
    if ($info->num_rows() > 0) {
        return json_decode($info->row()->content);
    }

    $return = array();
    $routes = json_decode(executeCurlRequest("DecodeFlightRoute", array("faFlightID" => $flight)), true);
    if (isset($routes["DecodeFlightRouteResult"]["data"]) && count($routes["DecodeFlightRouteResult"]["data"]) > 0) {
        foreach ($routes["DecodeFlightRouteResult"]["data"] as $route) {
            $return[] = array(
                "lat" => $route["latitude"],
                "lng" => $route["longitude"]
            );
        }
        $return = array("status" => "success", "data" => $return);
    } else {
        $return = array("status" => "error", "message" => "No routes were found in our database.");
    }
    $ci->db->insert("flight_info_cache", array(
        "nnumber" => $flight,
        "date" => "",
        "content" => json_encode($return)
    ));
    return $return;
}

function plans($plan)
{
    $ar = [
        L8_PLAN_BASIC => ["price" => 0, "hasCTS" => false, "name" => "Basic Free"],
        L8_PLAN_PREMIUM => ["price" => 99.99, "hasCTS" => false, "name" => "Premium"],
        L8_PLAN_CTS => ["price" => 49.00, "hasCTS" => true, "name" => "CTS"],
        L8_PLAN_PREMIUM_CTS => ["price" => 49.00, "hasCTS" => true, "name" => "Premium + CTS"],
    ];

    return isset($ar[$plan]) ? $ar[$plan] : ["price" => 0, "hasCTS" => false, "name" => "Basic Free"];
}

function plan_addons($addon)
{
    $ar = [
        L8_ADDON_RECRUITER => [
            "amount" => 1,
            "description" => "Charges for Recuriter",
        ],
        L8_ADDON_VIDEO => [
            "amount" => 19.99,
            "description" => "Charges for Video Interview",
        ],
        L8_ADDON_AVIATION => [
            "amount" => 159.00,
            "description" => "Aviation Addon",
        ],
        L8_ADDON_BACKGROUND => [
            "amount" => 199.99,
            "description" => "Charges for Background Check",
        ],
        L8_ADDON_MOTOR => [
            "amount" => 29.99,
            "description" => "Charges for Motor Check",

        ],
        L8_ADDON_CRIMINAL => [
            "amount" => 34.00,
            "description" => "Charges for Criminal Record Check",

        ],
        L8_ADDON_RESUME => [
            "amount" => 19.99,
            "description" => "Charges for Resume Verification",

        ],
        L8_ADDON_DRIVING => [
            "amount" => 19.99,
            "description" => "Charges for Driver Licence",

        ],

    ];

    return $ar[$addon];
}


function dd($data)
{
    print_r($data);
    exit;
}

function decrypt($string)
{
    return base64_decode(urldecode($string));
}

function secure_url($url)
{
    if (!is_logged_in()) {
        return site_url('login');
    } else {
        return site_url($url);
    }
}

function encrypt($string)
{
    return urlencode(base64_encode($string));
}

function get_time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


?>