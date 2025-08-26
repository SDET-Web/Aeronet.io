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


function select_user_type($select = ''){
    $ar = array(
        ''=>'Select',
        'f'=>'Free User',
        'p'=>'Paid User',
        'd'=>'Department',

        );

    return ($select != ''?$ar[$select]:$ar);
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
    $ar = array(
        'A-300', 'A-310', 'A-320', 'A-330', 'A-340', 'A-350', 'A-380', 'AB-139', 'ATR-42', 'ATR-72', 'AW-139', 'AW-650', 'B-247', 'B-307', 'B-314', 'B-377', 'B-707', 'B-720', 'B-727', 'B-737', 'B-747', 'B-747-4', 'B-757', 'B-777', 'B-787', 'BA-111', 'BA-3100', 'BA-4100', 'BAE-125', 'BAE-146', 'BAE-ATP', 'BE-1900', 'BE-2000', 'BE-2000S', 'BE-300/350', 'BE-90/200', 'BH-14ST', 'BR-305','BU-2000', 'BV-107', 'BV-234', 'BV-44', 'C-295', 'C-82A', 'CA-212', 'CE-500', 'CE-510', 'CE-510S', 'CE-525', 'CE-525S', 'CE-560XL','CE-650', 'CE-680', 'CE-750', 'CL-21', 'CL-215', 'CL-30', 'CL-415', 'CL-44', 'CL-600', 'CL-604', 'CL-65', 'CL-66', 'CONCRD','CV-240', 'CV-340', 'CV-600', 'CV-880, CV-990', 'CV-LB30', 'CV-N1, CV-N2', 'CV-P4Y', 'CV-PB2Y', 'CV-PBY5', 'CW-46', 'D-328JET','DA-10', 'DA-20', 'DA-2000', 'DA-2EASY', 'DA-50', 'DA-7X', 'DA-EASY', 'DC-10', 'DC-3', 'DC-3TP', 'DC-7', 'DC-8', 'DC-9','DHC-4', 'DHC-6', 'DHC-7', 'DHC-8', 'DO-228', 'DO0328', 'EA-500', 'EA-500S', 'EC225LP', 'EMB-110', 'EMB-120', 'EMB-145','EMB-500', 'EMB-505', 'EMB-550', 'ERJ-170', 'ERJ-190', 'F-27', 'FA-119C', 'FA-C123', 'FK-100', 'FO-5', 'G-100', 'G-111', 'G-1159','G-159', 'G-200', 'G-73', 'G-73T', 'G-IV', 'G-V'
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

?>