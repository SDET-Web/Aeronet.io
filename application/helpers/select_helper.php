<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The select_helper has function that includes all status and types values
 *
 * @package   helper
 * @version   0.01
 * @since     %%date%%
 * @author    %%author%%
 */



/**
* admin_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/

function select_disqualify_reason($select = "") {
  $result = [
    ""=>"Select",
    "1"=>"Minimum qualification in the ad not met",
    "2"=>"Does not have the preferred experience as stated in the add",
    "3"=>"Incomplete Application",
    "4"=>"Area of Specialty is not a good fit at this time.",

    "5"=>"Candidate did not show up for  Interview.",
    "6"=>"Candidate does not meet job's time plan requirements.",
    "7"=>"Candidate rejected offer.",
    "8"=>"Candidate selected had more experience/skills ",
    "9"=>"Candidate withdrew/declined Interview ",
    "10"=>"Not satisfactory assessment results ",
    "11"=>"Salary requested is higher than available budget",
  ];

  return $select == "" ? $result : $result[$select];

}

function select_admin_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("admin_id AS key, '' AS val")->from("admin")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* admin_role
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_admin_role($select = ''){
    $ar = array(
        ''=>'Select',
        'b'=>'Backend',
        'e'=>'Blog Editor',
        'h'=>'Backend Helper',

        );

    return ($select != ''?$ar[$select]:$ar);
}



/**
* comm_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_comm_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("comm_id AS key, '' AS val")->from("comment")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* user_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_user_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("user_id AS key, '' AS val")->from("connection")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* conn_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_conn_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("conn_id AS key, '' AS val")->from("connection")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_aircraft_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("id AS key, '' AS val")->from("directory_aircrafts")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* maker_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_maker_id($make, $select = ""){
    $ci =& get_instance();
    $data = $ci->db->distinct()->select("mfr_name AS key, mfr_name AS val")->from("directory_aircrafts")->order_by('mfr_name')->like('mfr_name',urldecode($make))->get()->result_array();
    $result = array();
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }
    return $result;
}

function select_maker_name($make, $select = ""){
    $ci =& get_instance();
    $data = $ci->db->distinct()->select("mfr_name")->from("directory_aircrafts")->order_by('mfr_name')->like('mfr_name',urldecode($make))->get()->result_array();
    $result = array();
    foreach ($data as $value) {
        $result[] = $value["mfr_name"];
    }
    return $result;
}



/**
* model_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_model_id($make,$select = ""){
    $ci =& get_instance();
    $data = $ci->db->distinct()->select("id AS key, CONCAT(model_name,' ',year_mfr) AS val")->from("directory_aircrafts")->order_by('model_name')->where('mfr_name',urldecode($make))->get()->result_array();
    $result = '<option value="">Select</option>';
    foreach ($data as $value) {
        $result .= '<option value="'.$value["key"].'">'.$value["val"].'</option>';
    }
    return $result;
}

function select_model_id_array($make,$select = ""){
    $ci =& get_instance();
    //order_by('model_name')->
    $data = $ci->db->distinct()->select("id AS key, CONCAT(model_name,' ',year_mfr) AS val")->from("directory_aircrafts")->where('mfr_name',urldecode($make))->get()->result_array();
    $result = array('0'=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}

function search_model_id($make,$select = ""){
    $ci =& get_instance();
    $data = $ci->db->distinct()->select("id AS key, CONCAT(model_name,' ',year_mfr) AS val")->from("directory_aircrafts")->order_by('model_name')->where('mfr_name',urldecode($make))->like('model_name',urldecode($select))->limit(100)->get()->result_array();
    return $data;
}


/**
* unique_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_unique_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("unique_id AS key, '' AS val")->from("directory_pilot")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* state_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_state_id($select = "",$start = 'Select'){
    $ci =& get_instance();
    $data = $ci->db->select("st AS key, state_name AS val")->from("directory_states")->get()->result_array();
    $result = array(''=>$start);
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* email_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_email_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("email_id AS key, '' AS val")->from("email")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* faq_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_faq_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("faq_id AS key, '' AS val")->from("faq")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* job_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_job_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("job_id AS key, '' AS val")->from("job")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* app_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_app_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("app_id AS key, '' AS val")->from("job_application")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* like_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_like_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("like_id AS key, '' AS val")->from("like")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* mess_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_mess_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("mess_id AS key, '' AS val")->from("message")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* mess_status
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_mess_status($select = ''){
    $ar = array(
        ''=>'Select',
        's'=>'Sent',
        'p'=>'Pending',

        );

    return ($select != ''?$ar[$select]:$ar);
}

function addon_prices($select = ''){
    $ar = array(
        'r'=>1,
        'v'=>19,
        'a'=>159.99,
        'b' => 199.99,
        'd' => 29.99,
        'm' => 19.99,
        'j' => 34.00,
        'c' => 19.99,


        );

    return ($select != ''?$ar[$select]:$ar);
}



/**
* mess_type
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_mess_type($select = ''){
    $ar = array(
        ''=>'Select',
        'w'=>'Workspace',
        's'=>'Support',

        );

    return ($select != ''?$ar[$select]:$ar);
}



/**
* page_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_page_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("page_id AS key, '' AS val")->from("page")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* photo_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_photo_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("photo_id AS key, '' AS val")->from("photo")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* post_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_post_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("post_id AS key, '' AS val")->from("post")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* post_type
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_post_type($select = ''){
    $ar = array(
        ''=>'Select',
        's'=>'Status',
        'p'=>'Photo',
        'v'=>'Video',

        );

    return ($select != ''?$ar[$select]:$ar);
}



/**
* post_status
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_post_status($select = ''){
    $ar = array(
        ''=>'Select',
        'p'=>'Pending',
        'b'=>'Published',

        );

    return ($select != ''?$ar[$select]:$ar);
}



/**
* share_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_share_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("share_id AS key, '' AS val")->from("share")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* user_type
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_user_type($select = '')
{
    $ar = array(
        '' => 'Select',
        JOB_TARGET_PILOT => 'Commerical Pilot',
        JOB_TARGET_MECHANIC => 'Mechanic',
        JOB_TARGET_DISPATCHER => 'Dispatcher',
        JOB_TARGET_ATTENDENT => 'Flight Attendent'
    );

    return ($select != '' ? $ar[$select] : $ar);
}


/**
* user_status
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_user_status($select = ''){
    $ar = array(
        ''=>'Select',
        'n'=>'Not Active',
        'a'=>'Active',

        );

    return ($select != ''?$ar[$select]:$ar);
}



/**
* Host
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_Host($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("Host AS key, '' AS val")->from("user")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* User
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_User($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("User AS key, '' AS val")->from("user")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* air_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_air_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("air_id AS key, '' AS val")->from("user_aircraft")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* edu_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_edu_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("edu_id AS key, '' AS val")->from("user_education")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}



/**
* empl_id
*
* @param string $select
*
* @return mixed
*
* @since   2016-27-06
* @author  Rizwan Ali <riz@bitspro.com>
*/


function select_empl_id($select = ""){
    $ci =& get_instance();
    $data = $ci->db->select("empl_id AS key, '' AS val")->from("user_employeement")->get()->result_array();
    $result = array(''=>'Select');
    foreach ($data as $value) {
        $result[$value["key"]] = $value["val"];
    }

    return $result;
}


function select_user_rating($select = ''){
    $ar = array(
        'STU',
        'MEL',
        'SES',
        'MES',
        'IFR',
        'Rotorcraft',
        'Glider',
        'CFI',
        'CFII',
        'MEI',
    );

    return ($select != ''?$ar[$select]:$ar);
}

function select_user_rating_type($select = ''){
   // $ar = array(        'A-300', 'A-310', 'A-320', 'A-330', 'A-340', 'A-350', 'A-380', 'AB-139', 'ATR-42', 'ATR-72', 'AW-139', 'AW-650', 'B-247', 'B-307', 'B-314', 'B-377', 'B-707', 'B-720', 'B-727', 'B-737', 'B-747', 'B-747-4', 'B-757', 'B-777', 'B-787', 'BA-111', 'BA-3100', 'BA-4100', 'BAE-125', 'BAE-146', 'BAE-ATP', 'BE-1900', 'BE-2000', 'BE-2000S', 'BE-300/350', 'BE-90/200', 'BH-14ST', 'BR-305','BU-2000', 'BV-107', 'BV-234', 'BV-44', 'C-295', 'C-82A', 'CA-212', 'CE-500', 'CE-510', 'CE-510S', 'CE-525', 'CE-525S', 'CE-560XL','CE-650', 'CE-680', 'CE-750', 'CL-21', 'CL-215', 'CL-30', 'CL-415', 'CL-44', 'CL-600', 'CL-604', 'CL-65', 'CL-66', 'CONCRD','CV-240', 'CV-340', 'CV-600', 'CV-880, CV-990', 'CV-LB30', 'CV-N1, CV-N2', 'CV-P4Y', 'CV-PB2Y', 'CV-PBY5', 'CW-46', 'D-328JET','DA-10', 'DA-20', 'DA-2000', 'DA-2EASY', 'DA-50', 'DA-7X', 'DA-EASY', 'DC-10', 'DC-3', 'DC-3TP', 'DC-7', 'DC-8', 'DC-9','DHC-4', 'DHC-6', 'DHC-7', 'DHC-8', 'DO-228', 'DO0328', 'EA-500', 'EA-500S', 'EC225LP', 'EMB-110', 'EMB-120', 'EMB-145','EMB-500', 'EMB-505', 'EMB-550', 'ERJ-170', 'ERJ-190', 'F-27', 'FA-119C', 'FA-C123', 'FK-100', 'FO-5', 'G-100', 'G-111', 'G-1159','G-159', 'G-200', 'G-73', 'G-73T', 'G-IV', 'G-V'
    //);

     $ar = array(   
     'DO-328','D328JET','SN-601','A-340','A-300','A-310','A-320','A-330','A-350','A-380','CA-212','C-295','L-420','ATR-42,ATR-72','BAE-146,AVR-146','B-17','B-247','B-307','B-314','B-377','B-707','B-720','B-727','B-737','B-747','B-747-4','B-757,B-767','B-757,B-767','B-777','B-787','DC-3','DC-3S','DC-3TP','DC-4','DC-6',' DC-7','DC-8','DC-9','DC-10','MD-11','CL-30','BBD-700','G7500','CL-44','CL-65','CL-66','CL-600','CL-604','DHC-8','BG-905','BR-305','AW-650','BAE-ATP','BAE-125','BA-3100','BA-4100','CONCRD','BA-111',' BU-2000','BD500','YC-122','SF-50','CW-46','DA-7X','DA-10','DA-20','DA-50','DA-200','DA-2000','DA-EASY','DA-2EASY','HW-500','DC-A20','DC-A24','DC-B18','DC-B23','DC-2','DC-B26','EA-500','EA-500S','EMB-110','EMB-120','EMB-145','EMB-500','EMB-505','EMB-550','ERJ-170,ERJ-190','F-27','FA-119C','FA-C123','C-82A','FK-28','FK-100','FO-5','CV-PB2Y','CV-P4Y','CV-PBY5','CV-LB30','CV-240,CV-340,CV-440','CV-A340,CV- A440','CV-600,CV-640','CV-880,CV-990','CV-N1,CV-N2','G-S2','G-TBM','G-111','G-73','G-73T','','G-159','G-1159','G-IV','G-V','GVI','GVII','IA-1125,G-100','G150','G-200','G280','HF-320','HP-300','Y-12F','HS-106','HS-114','HS-748','HA-420','IA-JET','IA-101','AD-4N','LR-JET','LR-JET','LR-45','LR-60','L-P2V','L-14','L-18','L-B34','L-P38','L-300','L-382','L-382J','EC-130Q','L-1011','L-1049','L-1329','T-33','L-188','SA-227','SA-227','SA-227','M-B26','M-PBM5','M-202,M-404','MS-760','YS-11','ND-262','NH-P61','P-808','PC-24','PA-42R','PZL-M28','DO-228','N-B25','SA-2000','SF-340','N-265','N-265','SD-3','SK-43','SK-44','S-210','SJ30','SJ30S','CE-500','CE-500','CE-500','CE-560XL','CE-510','CE-510S','CE-525','CE-525S','CE-650','CE-680','CE-700','CE-750','BE-200','BE-300','BE-300','BE-1900','BE-2000','BE-2000S','MU-300,BE-400','HS-125','BAE-125','RA-390','RA-390S','RA-4000','DHC-4','DHC-6','DHC-6HG','DHC-7','CL-215','CL-415','VC-700,VC-800','SK-56','EC225LP','S-330','AS332E','AB-139, AW-139','AW189','','BH-14','BH-14ST','S-70','BV-234','BV-44','SK-58','BV-234','BV-107','SK-64','S-321','SK-65','SK-64','BV-107','S-70','SK-64','SK-61','S-70','SK-92','H46E'
     );
    return ($select != ''?$ar[$select]:$ar);
}


function select_user_certificate($select = ''){
    $ar = array(
        ''=>'Select',
        'Private'=>'Private',
        'Commerical'=>'Commerical',
        'ATP'=>'ATP',
        'E Certificate'=>'E Certificate',
        'F Certificate'=>'F Certificate',
        'X Certificate'=>'X Certificate',
    );

    return ($select != ''?$ar[$select]:$ar);
}

function select_user_new($select = ''){
    $ar = array(
        ''=>'Select',
        'P' => 'PILOT',
        'A' => 'FLIGHT ATTENDANT',
        'M' => 'MECHANIC',
        'S' => 'DISPATCHER',
        'T' => 'CONTROL TOWER OPERATOR'
       // 'F' => 'FLIGHT INSTRUCTOR',
       // 'AI' => 'AUTHORIZED AIRCRAFT INSTRUCTOR',
        //'U' => 'REMOTE PILOT',
       // 'G' => 'GROUND INSTRUCTOR',
       // 'E' => 'FLIGHT ENGINEER',
        //'H' => 'FLIGHT ENGINEER(Special Purpose–Lessee)',
        //'X' => 'FLIGHT ENGINEER (Foreign Based)',        
        //'R' => 'REPAIRMAN',
        //'I' => 'REPAIRMAN EXPERIMENTAL ACFT BUILDER',
        //'L' => 'REPAIRMAN LIGHT SPORT AIRCRAFT',
        //'W' => 'PARACHUTE RIGGER',        
        //'N' => 'FLIGHT NAVIGATOR',
        //'J' => 'FLIGHT NAVIGATOR (Special Purpose–Lessee)'  
    );
    return ($select != ''?$ar[$select]:$ar);    
}


function select_user_medical_type($select = ''){
    $ar = array(
        ''=>'Select',
        'Private'=>'Private',
        'Commerical'=>'Commerical',
        'ATP'=>'ATP',
    );

    return ($select != ''?$ar[$select]:$ar);
}

function select_air_requirement($select = ''){
    $ar = array(
        'a'=>'Captain Qualifications Minimums',
        'b'=>'Captain Preferred Minimums',
        'c'=>'Co Pilot Qualifications Minimums',
        'd'=>'Co Pilot Preferred Minimums',
    );

    return ($select != ''?$ar[$select]:$ar);
}


function basic_interview_questions ($selected) {
    $ar = [
      "pilot_0" => "Certificates",
      "pilot_1" => "Aircraft Type Rating",
      "pilot_2" => "Currency",
      "pilot_3" => "Time in Type",
      "pilot_4" => "Total Time",
      "pilot_5" => "Total Pilot-in-Command",
      "pilot_6" => "Would you like all pilot candidates to complete the aviation addendum?",
      "mechanic_0" => "3 year minimum experience as A&P mechanic",
      "mechanic_1" => "Must have experience or training on Aircraft",
      "mechanic_2" => "Must have Inspection Authorization (IA)",
      "mechanic_3" => "Bachelors Degree",
      "flight_0" => "2 year minimum experience in Customer Service",
      "flight_1" => "FAA flight attendant certificate (trained under part 121)",
      "flight_2" => "Must have part 91 or 135 training at one of the following",
      "flight_3" => "Must have had part 91 or 135 training in the last 12 months",
      "flight_4" => "Must have experience or training on Aircraft",
      "dispatcher_0" => "2 years minimum experience ",
      "dispatcher_1" => "Must have part 91 or part 135 experience"
    ];
    return isset($ar[$selected]) ? $ar[$selected] : $ar;
}


function select_background_attachment_form ($select = '') {
  $ar = array(
      PIPLE_STEP_AVIATION_BACKGROUND_CHECK_REQUESTED=>'faa8060-10.pdf',
      PIPLE_STEP_BACKGROUND_CHECK_REQUESTED=>'faa8060-10A.pdf',
      PIPLE_STEP_DRIVING_RECORDS_CHECK_REQUESTED=>'faa8060-11.pdf',
      PIPLE_STEP_MOTOR_RECORDS_CHECK_REQUESTED=>'faa8060-11A.pdf',
      PIPLE_STEP_CRIMINAL_RECORDS_CHECK_REQUESTED=>'faa8060-13.pdf',
      PIPLE_STEP_RESUME_VERIFICATION_REQUESTED=>'faa8060-13.pdf',
  );

  return ($select != ''?$ar[$select]:$ar);
}

define('PIPLE_STEP_APPLIED', '0');
define('PIPLE_STEP_INTERVIEW_REQUESTED', '1');
define('PIPLE_STEP_INTERVIEW_PROVIDED', '2');
define('PIPLE_STEP_VIDEO_INTERVIEW_REQUESTED', '3');
define('PIPLE_STEP_VIDEO_INTERVIEW_PROVIDED', '4');
define('PIPLE_STEP_SHORT_LISTED', '5');
define('PIPLE_STEP_DECLINED', '6');
define('PIPLE_STEP_BACKGROUND_CHECK_REQUESTED', '7');
define('PIPLE_STEP_BACKGROUND_CHECK_PROVIDED', '8');
define('PIPLE_STEP_AVIATION_BACKGROUND_CHECK_REQUESTED', '9');
define('PIPLE_STEP_AVIATION_BACKGROUND_CHECK_PROVIDED', '10');
define('PIPLE_STEP_DRIVING_RECORDS_CHECK_REQUESTED', '11');
define('PIPLE_STEP_DRIVING_RECORDS_CHECK_PROVIDED', '12');
define('PIPLE_STEP_MOTOR_RECORDS_CHECK_REQUESTED', '13');
define('PIPLE_STEP_MOTOR_RECORDS_CHECK_PROVIDED', '14');
define('PIPLE_STEP_CRIMINAL_RECORDS_CHECK_REQUESTED', '15');
define('PIPLE_STEP_CRIMINAL_RECORDS_CHECK_PROVIDED', '16');
define('PIPLE_STEP_RESUME_VERIFICATION_REQUESTED', '17');
define('PIPLE_STEP_RESUME_VERIFICATION_PROVIDED', '18');
define('PIPLE_STEP_ACCEPTED', '19');

define('APP_STATUS_PENDING', 'p');
define('APP_STATUS_FEEDBACK', 'f');
define('APP_STATUS_SCREENING', 'c');
define('APP_STATUS_VIDEO', 'v');
define('APP_STATUS_BACKGROUND', 'b');
define('APP_STATUS_SHORTLISTED', 's');
define('APP_STATUS_INTERVIEWED', 'i');
define('APP_STATUS_DISQUALIFIED', 'd');
define('APP_STATUS_QUALIFIED', 'q');

define('QUESTION_TYPE_ADDENDUM', 'a');
define('QUESTION_TYPE_INTERVIEW', 'i');
define('QUESTION_TYPE_VIDEO_INTERVIEW', 'v');

define('AD_TRACKING_STATUS_UNPAID', 'u');
define('AD_TRACKING_STATUS_PAID', 'p');

define('JOB_TARGET_PILOT', 'p');
define('JOB_TARGET_MECHANIC', 'm');
define('JOB_TARGET_DISPATCHER', 'd');
define('JOB_TARGET_ATTENDENT', 'a');

define('JOB_STATUS_ACTIVE', 'p');
define('JOB_STATUS_DEACTIVE', 'd');


define('JOB_ADDON_TYPE_VIDEO', '3');
define('JOB_ADDON_TYPE_BACKGROUND_CHECK', '7');
define('JOB_ADDON_TYPE_AVIATION_BACKGROUND_CHECK', '9');
define('JOB_ADDON_TYPE_DRIVING_RECORDS_CHECK', '11');
define('JOB_ADDON_TYPE_MOTOR_RECORDS_CHECK', '13');
define('JOB_ADDON_TYPE_CRIMINAL_RECORDS_CHECK', '15');
define('JOB_ADDON_TYPE_RESUME_VERIFICATION', '17');

define('JOB_ANSWER_TYPE_TEXT', 't');
define('JOB_ANSWER_TYPE_YES_NO', 'y');
define('JOB_ANSWER_TYPE_DATE', 'd');


?>
