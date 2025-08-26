<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model
{

    function browse($userId, $userPage, $userType = '', $userStatus = '', $userTerm = '', $userSort = '', $userOrder = 'desc')
    {
        if ($userStatus != '') {
            $this->db->where('user_status', $userStatus);
        }

        if ($userTerm != '') {
            $this->db->where("(`user_fname` LIKE '%" . $userTerm . "%' ESCAPE '!' OR `user_lname` LIKE '%" . $userTerm . "%' ESCAPE '!' OR `user_company` LIKE '%" . $userTerm . "%' ESCAPE '!')");
        }

        if ($userId != '') {
            $this->db->where('user_id !=', $userId);
        }
        $this->db->where('user_status !=', 'd');
        $this->db->limit(50, $userPage * 50);

        $data = $this->db
            ->select('user.user_id, CONCAT(user_fname,\' \',user_lname) as user_name, user_company, user_address, user_city, user_state, user_type, user_image, user_rating, user_modified, user_lat, user_lng')
            ->from('user')
            ->where('user.user_id NOT IN (SELECT user_id FROM connection WHERE conn_id = ' . $userId . ') AND user.user_id NOT IN (SELECT conn_id FROM connection WHERE user_id = ' . $userId . ')', '', FALSE)
            ->get()
            ->result_array();

        $query = $this->db->last_query();

        $query = substr($query, 0, strpos($query, 'LIMIT'));
        $query = substr($query, strpos($query, 'FROM'));
        $count = $this->db->query('SELECT COUNT(*) as count ' . $query)->row()->count;
        return array('total' => $count, 'data' => $data);
    }

    function search($type, $user)
    {
        $page = 0;
        $term = '';
        $sort = '';
        $order = 'desc';
        $status = '';

        if ($this->input->get('page') != '') {
            $page = $this->input->get('page');
        }

        if ($this->input->post('term') != '') {
            $term = $this->input->post('term');
        }

        if ($this->input->get('sort') != '') {
            $sort = $this->input->get('sort');
        }

        if ($this->input->get('order') != '') {
            $order = $this->input->get('order');
        }

        return $this->browse($user, $page, $type, $status, $term, $sort, $order);
    }

    function search_advanced($userId)
    {

        if (isset($_POST['aircrafts'])) {
            /*$aircrafts = $this->db->from('user_aircraft')->join('directory_aircrafts', 'directory_aircrafts.id = user_aircraft.aircraft_id')->where_in('air_id', $_POST['aircrafts'])->get()->result_array();
            if(count($aircrafts) > 0){
                $where = '(';
                foreach($aircrafts as $aircraft){
                    $where .= "aircrafts like '%".$aircraft['aircraft_id'].",%' OR ";
                }
                $where =(strlen($where) > 5?substr($where,0,-4):'').')';
                $this->db->where($where,'',FALSE);
            }*/
            $this->db->join('user_aircraft', 'user.user_id = user_aircraft.user_id')->where_in('aircraft_id', $_POST['aircrafts']);
        }

        if (isset($_POST['typeRating']) && $_POST['typeRating'] == true) {
            $this->db->where('LENGTH(user_rating_type) >=', 5);
        }

        if (isset($_POST['typeTime']) && $_POST['typeTime'] == true) {

        }

        if (isset($_POST['typeTimePilot']) && $_POST['typeTimePilot'] == true) {

        }

        if (isset($_POST['totalTime']) && $_POST['totalTime'] == true) {

        }

        if (isset($_POST['totalTimePilot']) && $_POST['totalTimePilot'] == true) {

        }

        if (isset($_POST['recency']) && $_POST['recency'] == true) {

        }

        if (isset($_POST['location']) && $_POST['location'] == true) {
            //$this->db->where('user_state', $_POST['location']);
        }

        if (isset($_POST['letter']) && $_POST['letter'] == true) {

        }

        if (isset($_POST['collegeDegree']) && $_POST['collegeDegree'] == true) {
            $this->db->join('user_education', 'user_education.user_id = user.user_id', 'LEFT');
            $this->db->like('edu_degree', 'Bechlor');
        }

        if (isset($_POST['gpa']) && $_POST['gpa'] == true) {

        }

        if (isset($_POST['master']) && $_POST['master'] == true) {
            $this->db->like('edu_degree', 'Master');
        }

        if (isset($_POST['volunteer']) && $_POST['volunteer'] == true) {
            $this->db->where('LENGTH(user_volunteerwork) >=', 50);
        }

        if (isset($_POST['pageViews']) && $_POST['pageViews'] == true) {

        }

        $data = $this->db
            ->select('user.user_id, CONCAT(user_fname,\' \',user_lname) as user_name, user_company, user_address, user_city, user_state, user_type, user_image, user_rating, user_modified, user_lat, user_lng')
            ->from('user', 'tmpUser')
            ->join('connection', 'user.user_id = connection.conn_id')
            //->join('user_aircraft_combined','user.user_id = user_aircraft_combined.user_id','LEFT')
            ->where('connection.user_id', $userId)
            ->where('user_type', 'p')
            ->get()->result_array();

        return array('total' => count($data), 'data' => $data);
    }

    function get($user)
    {
        $data = $this->db->from('user')->where('user_id', $user)->get();
        if ($data->num_rows() > 0) {
            $data = $data->row_array();
            // $data['profile'] = $this->db->from('user_profile')->where('user_id', $user)->get()->row_array();
            $data['flight_time'] = $this->db->from('user_flighttime')->where('user_id', $user)->get()->result_array();
        } else {
            $data = false;
        }
        return $data;
    }

    function insert_pilot_from_id($pilot, $ID, $status = 'a')
    {
        $certificates = $this->db->from('directory_pilot_certificate')->where('unique_id', $ID)->get()->result_array();
        $rating = [];
        $rating_type = [];
        foreach ($certificates as $certificate) {
            $rating[] = $certificate['rating'];
            $rating_type[] = $certificate['type_rating'];
            $data['user_certificate'] = $certificate['level'];
        }
        $data['user_rating'] = implode($rating, ',');
        $data['user_rating_type'] = implode($rating_type, ',');

        /* Nauman Functionality changed
        $data['user_fname'] = $pilot['first_name'];
        $data['user_lname'] = $pilot['last_name'];
        $data['user_address'] = $pilot['street1'];
        $data['user_address_alt'] = $pilot['street1'];
        $data['user_city'] = $pilot['city'];
        $data['user_state'] = $pilot['state'];
        $data['user_zip'] = $pilot['zip'];
        */
        $data['user_fname'] = $this->input->post('first_name');
        $data['user_lname'] = $this->input->post('last_name');
        $data['user_address'] = $this->input->post('address');
        $data['user_address_alt'] = $pilot['street1'];
        $data['user_city'] = $this->input->post('city');
        $data['user_state'] = $this->input->post('state');
        $data['user_zip'] = $this->input->post('zipcode');


        $data['user_email'] = $this->input->post('email');
        $data['user_password'] = md5($this->input->post('password'));
        $data['user_pilot_id'] = $ID;
        $data['user_type'] = strtolower($this->input->post('type')) != "d" ? strtolower($this->input->post('type')) : "s";
        $data['user_status'] = $status;
        $data['user_created'] = time();
        $data['user_modified'] = time();
        if ($data['user_address'] != '' && $data['user_city'] != '' && $data['user_state'] != '') {
            $latLng = get_latlng($data['user_address'] . ' ' . $data['user_city'] . ' ' . $data['user_state']);
            if ($latLng->lat != null && $latLng->lng != null) {
                $data['user_lat'] = $latLng->lat;
                $data['user_lng'] = $latLng->lng;
            }
        }

        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    function insert_pilot_from_linkedin($ID)
    {
        $certificates = $this->db->from('directory_pilot_certificate')->where('unique_id', $ID)->get()->result_array();
        $rating = [];
        $rating_type = [];
        foreach ($certificates as $certificate) {
            $rating[] = $certificate['rating'];
            $rating_type[] = $certificate['type_rating'];
            $data['user_certificate'] = $certificate['level'];
        }
        $data['user_rating'] = implode($rating, ',');
        $data['user_rating_type'] = implode($rating_type, ',');

        $data['user_fname'] = $this->input->post('first_name');
        $data['user_lname'] = $this->input->post('last_name');
        $data['user_city'] = $this->input->post('city');


        $data['user_email'] = $this->input->post('email');
        $data['user_password'] = md5($this->input->post('password'));
        $data['user_pilot_id'] = $ID;
        $data['user_type'] = 'p';
        $data['user_status'] = 'a';
        $data['user_source'] = 'linkedin';
        $data['user_image'] = $this->input->post('image');
        $data['user_bgimage'] = $this->input->post('bgimage');
        $data['user_linkedin_profile'] = $this->input->post('profile');
        $data['user_created'] = time();
        $data['user_modified'] = time();
        if ($data['user_city'] != '') {
            $latLng = get_latlng($data['user_city']);
            if ($latLng->lat != null && $latLng->lng != null) {
                $data['user_lat'] = $latLng->lat;
                $data['user_lng'] = $latLng->lng;
            }
        }
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    function update_lat_lng()
    {
        $data = $this->db->from('user')->where('user_address !=', '')->where('user_city !=', '')->where('user_state !=', '')->get()->result_array();
        foreach ($data as $item) {
            $tmp = array();
            if ($item['user_address'] != '' && $item['user_city'] != '' && $item['user_state'] != '') {
                $latLng = get_latlng($item['user_address'] . ' ' . $item['user_city'] . ' ' . $item['user_state']);
                $tmp['user_lat'] = $latLng->lat;
                $tmp['user_lng'] = $latLng->lng;
            }
            $this->db->where('user_id', $item['user_id']);
            $this->db->update('user', $tmp);
        }
    }

    function get_member($id)
    {
        $this->update_photo();
        $user = array();
        $user_account = $this->db->from('user')->where('user_id', $id)->get();
        if ($user_account->num_rows() > 0) {
            $user = $user_account->row_array();
            if($user['user_type'] <> 'd') {
              $uid = $this->db->from('user')->where('user_id', $ID)->where('user_status', 'a')->get()->row_array();
             
              return $this->get_non_department($user, $id);  
            } else {   
                return $this->get_department($user, $id);
            }

        } else {
            return false;
        }

    }


    function get_non_department($user, $id) {
    
           
    $user_education = $this->db->query('SELECT * FROM `connection` JOIN `user` ON (CASE WHEN conn_id = ' . $id . ' THEN connection.user_id ELSE conn_id END) = user.user_id WHERE (connection.user_id = ' . $id . ' OR connection.conn_id = ' . $id . ') AND `conn_type` <> \'d\'');
        
//$user_education = $this->db->from('connection')->join('user', '(CASE WHEN conn_id = '.$id.' THEN connection.user_id ELSE conn_id END) = user.user_id',TRUE)->where('(connection.user_id = '.$id.' OR connection.conn_id = '.$id.')', '',FALSE)->where('conn_type', 'p')->where('conn_status','a')->get();
        if ($user_education->num_rows() > 0) {
            $user['connections'] = $user_education->result();
        } else {
            $user['connections'] = array();
        }

        $user_education = $this->db->from('connection')->join('user', 'conn_id = user.user_id')->where('connection.user_id', $id)->where('conn_type', 'd')->get();
        if ($user_education->num_rows() > 0) {
            foreach ($user_education->result() as $key => $val) {
                $user['departments'][$key] = $val;
                $user['departments'][$key]->dept_count = $this->db->query('SELECT COUNT(conn_id) as count FROM connection WHERE user_id=' . $id . ' AND conn_type = \'d\'')->row()->count;
            }
        } else {
            $user['departments'] = array();
        }

        if ($this->session->userdata('user_id') != '') {
            $user['is_connected'] = $this->db->from('connection')->where('(user_id = ' . $id . ' AND conn_id=' . $this->session->userdata('user_id') . ') OR (conn_id = ' . $id . ' AND user_id=' . $this->session->userdata('user_id') . ')', '', FALSE)->get()->row();
        } else {
            $user['is_connected'] = array();
        }

        // $user['aircraft'] = $this->db->from('user_aircraft')->join('directory_aircrafts', 'user_aircraft.aircraft_id = directory_aircrafts.id')->where('user_id', $id)->where('type', 'o')->get()->result_array();
        // Changed BY Muhammad Danish Khan
        $user['aircraft'] = $this->db->from('user_aircraft')->join('directory_aircrafts', 'user_aircraft.aircraft_id = directory_aircrafts.id')->where('user_id', $id)->get()->result_array();
        // $user['aircraft_flown'] = $this->db->from('user_aircraft')->join('directory_aircrafts', 'user_aircraft.aircraft_id = directory_aircrafts.id')->where('user_id', $id)->where('type', 'f')->get()->result_array();
        $user['aircraft_flown'] = [];
        foreach ($user['aircraft'] as $key => $air) {
            $user['aircraft'][$key]['requirements'] = $this->db->from('user_requirement')->where('user_id', $id)->where('air_id', $air['air_id'])->get()->result_array();
        }

        $user['photos'] = $this->db->from('photo')->where('user_id', $id)->order_by('photo_id desc')->get()->result_array();
        // $user['course'] = $this->db->from('user_course')->where('user_id', $id)->get()->result_array();
        // $this->load->model('Model_subscription');
        // $user['subscription'] = (array)$this->Model_subscription->Get($id);

        $aid = $this->db->from('user_aircraft')->where('user_id', $id)->get()->row_array();
        if($aid <> ''){
        $this->load->model('Model_cts');
        $aircrafts = array_map(function($item) {
          return $item["aircraft_id"];
        }, $user["aircraft"]);
        $matched = $this->Model_cts->GetMatchedDepartments(explode(",", $user["user_rating_type"]), $aircrafts);
        foreach ($matched as $key => $dep) {
            foreach ($user["departments"] as $mainDep) {
                if ($mainDep->user_id == $dep["user_id"]) {
                    unset($matched[$key]);
                }
            }
        }

        $user["matched"] = $matched;}
        $user['countApplicant'] = $this->db->select('COUNT(id) as c')->from('applications')->where('user_id', $id)->where('job_id >', 0)->where('status !=', '-')->get()->row()->c;
        return $user;
    }

    function get_department($user, $id) {
        $user['following'] = [
            "p" => [],
            "m" => [],
            "a" => [],
            "s" => []
        ];

        $user_education = $this->db->query('SELECT * FROM `connection` JOIN `user` ON connection.user_id = user.user_id WHERE connection.conn_id = ' . $id . ' AND `conn_type` = \'d\'');
        //$user_education = $this->db->from('connection')->join('user', '(CASE WHEN conn_id = '.$id.' THEN connection.user_id ELSE conn_id END) = user.user_id',TRUE)->where('(connection.user_id = '.$id.' OR connection.conn_id = '.$id.')', '',FALSE)->where('conn_type', 'p')->where('conn_status','a')->get();
        if ($user_education->num_rows() > 0) {
            $temp = $user_education->result();

            foreach ($temp as $tmp) {
                $user['following'][$tmp->user_type][] = $tmp;
            }
        }

        if ($this->session->userdata('user_id') != '') {
            $user['is_connected'] = $this->db->from('connection')->where('(user_id = ' . $id . ' AND conn_status = "a" AND conn_id=' . $this->session->userdata('user_id') . ') OR (conn_id = ' . $id . ' AND conn_status = "a" AND user_id=' . $this->session->userdata('user_id') . ')', '', FALSE)->get()->row();
        } else {
            $user['is_connected'] = array();
        }

        $user['photos'] = $this->db->from('photo')->where('user_id', $id)->order_by('photo_id desc')->get()->result_array();
        $user['subscription'] = (array) $this->session->userdata('subscription'); //(array)$this->Model_subscription->Get($id);
        return $user;
    }

    function update_user($id)
    {
        if ($this->input->post('action') == 'resumeUpdate') {
            $this->form_validation->set_rules('firstName', 'First Name', 'required');
            $this->form_validation->set_rules('lastName', 'Last Name', 'required');
            $this->form_validation->set_rules('address', 'Primary Address', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('zip', 'Zip', 'required');
            $this->form_validation->set_rules('rating', 'Rating', 'required');
            if ($this->form_validation->run() != FALSE) {
                $data_user['user_profile_percent'] = $this->db->select('user_profile_percent')->from('user')->where('user_id', $id)->get()->row()->user_profile_percent;
                $data_user['user_fname'] = $this->input->post('firstName');
                $data_user['user_lname'] = $this->input->post('lastName');
                $data_user['user_address'] = $this->input->post('address');
                $data_user['user_city'] = $this->input->post('city');
                $data_user['user_state'] = $this->input->post('state');
                $data_user['user_zip'] = $this->input->post('zip');
                $data_user['user_phome'] = $this->input->post('homePhone');
                $data_user['user_pmobile'] = $this->input->post('cellPhone');
                $data_user['user_modified'] = time();


                $data_user['user_skype'] = $this->input->post('skype');
                $data_user['user_email'] = $this->input->post('email');
                $data_user['user_dob'] = $this->input->post('birthday');
                $data_user['user_experience'] = $this->input->post('experienc');
                $data_user['user_skill'] = $this->input->post('additionalSkills');
                $data_user['user_info'] = $this->input->post('personalInfo');
                if ($this->input->post('personalInfo') != '' && $this->db->select('user_info')->from('user')->where('user_id', $id)->get()->row()->user_info == '') {
                    $data_user['user_profile_percent'] = $data_user['user_profile_percent'] + 5;
                }
                $data_user['user_rating'] = implode(',', $_POST['rating']);
                if ($this->input->post('rating') != '' && $this->db->select('user_rating')->from('user')->where('user_id', $id)->get()->row()->user_rating == '') {
                    $data_user['user_profile_percent'] = $data_user['user_profile_percent'] + 5;
                }
                $data_user['user_certificate'] = $this->input->post('certificate');
                $data_user['user_medical'] = $this->input->post('medical');
                $data_user['user_medical_month'] = $this->input->post('medicalMonth');
                $data_user['user_medical_year'] = $this->input->post('medicalYear');
                $data_user['user_public'] = $this->input->post('public');
                $data_user['user_id'] = $id;
                $data_user['user_modified'] = time();


                $config['upload_path'] = realpath($_SERVER['DOCUMENT_ROOT']) . '/skin/upload/job';
                $config['allowed_types'] = 'gif|jpg|png';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile')) {
                    echo $this->upload->display_errors();
                    exit;
                } else {
                    $data1 = $this->upload->data();
                    $data_profile['user_image'] = $data1['file_name'];
                    if ($this->db->select('user_image')->from('user')->where('user_id', $id)->get()->row()->user_image == '') {
                        $data_user['user_profile_percent'] = $data_user['user_profile_percent'] + 10;
                    }
                }

                $this->db->where('user_id', $id);
                $this->db->update('user', $data_user);

                /*
                if ($this->db->from('user_profile')->where('user_id', $id)->get()->num_rows() > 0) {
                    $this->db->where('user_id', $id);
                    $this->db->update('user_profile', $data_profile);
                } else {
                    $this->db->insert('user_profile', $data_profile);
                }*/

                foreach (flight_time() as $key => $val) {
                    $data_ft['user_id'] = $id;
                    $data_ft['time_key'] = $val;
                    $data_ft['time_val'] = $this->input->post($key);
                    $user_rs = $this->db->select('*')->from('user_flighttime')->where('user_id', $id)->where('time_key', $val)->get();
                    if ($user_rs->num_rows() > 0) {

                        $this->db->where('time_key', $val)->where('user_id', $id);
                        $this->db->update('user_flighttime', $data_ft);
                    } else {
                        $this->db->insert('user_flighttime', $data_ft);
                    }
                }
                $empId = $this->input->post('empId');
                $empl_company = $this->input->post('empcompanyName');
                $empl_monthfromjob = $this->input->post('empmonthFormJob');
                $empl_yearfromjob = $this->input->post('empyearFromJob');
                $empl_monthtojob = $this->input->post('empmonthToJob');
                $empl_yeartojob = $this->input->post('empyearToJob');
                $empl_jobtitle = $this->input->post('empjobTitle');
                $empl_jobduties = $this->input->post('empjobDuties');
                if ($empId != '' && count($empId) > 0) {
                    $data_empl['empl_modified'] = time();
                    foreach ($empId as $key => $val) {
                        $data_empl['empl_company'] = $empl_company[$key];
                        $data_empl['empl_monthfromjob'] = $empl_monthfromjob[$key];
                        $data_empl['empl_yearfromjob'] = $empl_yearfromjob[$key];
                        $data_empl['empl_monthtojob'] = $empl_monthtojob[$key];
                        $data_empl['empl_yeartojob'] = $empl_yeartojob[$key];
                        $data_empl['empl_jobtitle'] = $empl_jobtitle[$key];
                        $data_empl['empl_jobduties'] = $empl_jobduties[$key];
                        if ($val == 0) {
                            $data_empl['empl_created'] = time();
                            $data_empl['user_id'] = $id;
                            $this->db->insert('user_employeement', $data_empl);
                        } else {
                            $this->db->where('empl_id', $val);
                            $this->db->update('user_employeement', $data_empl);
                        }
                    }
                }
                $eduId = $this->input->post('eduId');
                $edu_school = $this->input->post('eduschoolName');
                $edu_monthfromschool = $this->input->post('edumonthFromSchool');
                $edu_yearfromschool = $this->input->post('eduyearFromSchool');
                $edu_monthtoschool = $this->input->post('edumonthToSchool');
                $edu_yeartoschool = $this->input->post('eduyearToSchool');
                $edu_monthgrad = $this->input->post('eduyearGrad');
                $edu_yeargrad = $this->input->post('edumonthGrad');
                $edu_degree = $this->input->post('eduDegree');
                $key = 0;
                if ($eduId != '' && count($eduId) > 0) {
                    $data_edu['edu_modified'] = time();
                    foreach ($eduId as $key => $val) {
                        $data_edu['edu_school'] = $edu_school[$key];
                        $data_edu['edu_monthfromschool'] = $edu_monthfromschool[$key];
                        $data_edu['edu_yearfromschool'] = $edu_yearfromschool[$key];
                        $data_edu['edu_monthtoschool'] = $edu_monthtoschool[$key];
                        $data_edu['edu_yeartoschool'] = $edu_yeartoschool[$key];
                        $data_edu['edu_monthgrad'] = $edu_monthgrad[$key];
                        $data_edu['edu_yeargrad'] = $edu_yeargrad[$key];
                        $data_edu['edu_degree'] = $edu_degree[$key];
                        if ($val == 0) {
                            $data_edu['edu_created'] = time();
                            $data_edu['user_id'] = $this->session->userdata('user_id');
                            $this->db->insert('user_education', $data_edu);
                        } else {
                            $this->db->where('edu_id', $val);
                            $this->db->update('user_education', $data_edu);
                        }
                    }
                }
                push_message('Resume updated Successfully');
            } else {

            }
        }
    }

    function resume_search()
    {
        if ($this->input->post('action') == 'search') {
            $this->form_validation->set_rules('location', 'Location', 'required');
            if ($this->form_validation->run() != FALSE) {
                $lat_long = $this->googlemaps->get_lat_long_from_address($this->input->post('location'));
                $recordsWithinRadius = array();
                if (!isset($lat_long[2])) {
                    $sourceLat = $lat_long[0];
                    $sourceLon = $lat_long[1];
                    $radiusKm = $this->input->post('radius');
                    $user_rs = $this->db->select('*')->from('user')->where("(user_type!='o')")->where("(user_address!='' OR user_zip!='')")->where("(user_status='a' OR user_status='p')")->where('is_deleted', 'n')->get();
                    if ($user_rs->num_rows() > 0) {
                        foreach ($user_rs->result() as $locations) {
                            $zip = $locations->user_zip;
                            if ($zip != '')
                                $address = $zip;
                            else
                                $address = $locations->user_address;

                            $latdes_longdes = $this->googlemaps->get_lat_long_from_address($address);
                            $dis = distance($sourceLat, $sourceLon, $latdes_longdes[0], $latdes_longdes[1], "M");
                            if ($dis <= $radiusKm) {
                                $recordsWithinRadius[] = $locations;
                            }

                        }
                    }
                    if (sizeof($recordsWithinRadius) < 1)
                        push_message('No resumes found, but don\'t worry; many of our pilots prefer to keep their resume private.   Simply post a flight to the dispatch board and local safety pilots will be notified with the option to send their resume to your Lazy-Eights account');

                    return $recordsWithinRadius;
                } else
                    push_message('Not a Valid Location');
            }
        } else {
            $lat_long = $this->googlemaps->get_lat_long_from_address('32114');
            if (!isset($lat_long[2])) {
                $sourceLat = $lat_long[0];
                $sourceLon = $lat_long[1];
                $radiusKm = '50';
                $recordsWithinRadius = array();
                $user_rs = $this->db->select('*')->from('user')->where("(user_type!='o')")->where("(user_address!='' OR user_zip!='')")->where("(user_status='a' OR user_status='p')")->where('is_deleted', 'n')->get();
                if ($user_rs->num_rows() > 0) {
                    foreach ($user_rs->result() as $locations) {
                        $zip = $locations->user_zip;
                        if ($zip != '')
                            $address = $zip;
                        else
                            $address = $locations->user_address;

                        $latdes_longdes = $this->googlemaps->get_lat_long_from_address($address);
                        $dis = distance($sourceLat, $sourceLon, $latdes_longdes[0], $latdes_longdes[1], "M");
                        if ($dis <= $radiusKm) {
                            $recordsWithinRadius[] = $locations;
                        }
                    }
                }
                return $recordsWithinRadius;
            }
        }
    }

    function delete_empl()
    {
        if ($this->input->get('action') == 'delemp') {
            $this->db->delete('user_employeement', array('empl_id' => base64_decode(urldecode($this->input->get('d')))));
            push_message('Employment History Deleted Successfully');
        }
    }

    function delete_edu()
    {
        if ($this->input->get('action') == 'deledu') {
            $this->db->delete('user_education', array('edu_id' => base64_decode(urldecode($this->input->get('d')))));
            push_message('Education History Deleted Successfully');
        }
    }

    function update()
    {
        if ($this->input->post('action') == 'submit') {
            $this->load->library('upload');

            $user_data = array();
            $user_data['user_profile_percent'] = $this->db->select('user_profile_percent')->from('user')->where('user_id', $this->session->userdata('user_id'))->get()->row()->user_profile_percent;
            if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['name'] != '') {
                $config['upload_path'] = UPLOAD_PATH . 'photo/';
                $config['allowed_types'] = '*';
                $config['overwrite'] = FALSE;
                $this->upload->initialize($config);
                if ($this->upload->do_upload('profile_photo') !== False) {
                    $img = $this->upload->data();
                    $user_data['user_image'] = $img['file_name'];
                    if ($this->db->select('user_image')->from('user')->where('user_id', $this->session->userdata('user_id'))->get()->row()->user_image == '') {
                        $user_data['user_profile_percent'] = $user_data['user_profile_percent'] + 5;
                    }
                    $this->load->model('Model_photo');
                    $this->Model_photo->insert($this->session->userdata('user_id'), [
                      'title' => 'Profile Photo',
                      'path' => $user_data['user_image'],
                      'category' => time(),
                    ]);
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    push_message(implode($error, ','), 'ERRO');
                }
            }

             if (isset($_FILES['profile_bgphoto']) && $_FILES['profile_bgphoto']['name'] != '') {
                $config['upload_path'] = UPLOAD_PATH . 'photo/';
                $config['allowed_types'] = '*';
                $config['overwrite'] = FALSE;
                $this->upload->initialize($config);
                if ($this->upload->do_upload('profile_bgphoto') !== False) {
                    $img = $this->upload->data();
                    $user_data['user_bgimage'] = $img['file_name'];
                    if ($this->db->select('user_bgimage')->from('user')->where('user_id', $this->session->userdata('user_id'))->get()->row()->user_bgimage == '') {
                        $user_data['user_profile_percent'] = $user_data['user_profile_percent'] + 5;
                    }
                    $this->load->model('Model_photo');
                    $this->Model_photo->insert($this->session->userdata('user_id'), [
                      'title' => 'Profile Photo',
                      'path' => $user_data['user_bgimage'],
                      'category' => time(),
                    ]);
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    push_message(implode($error, ','), 'Success');
                }
            }

            if (isset($_FILES['profile_resume']) && $_FILES['profile_resume']['name'] != '') {
                $config['upload_path'] = UPLOAD_PATH . 'resume/';
                $config['allowed_types'] = '*';
                $config['overwrite'] = FALSE;
                $this->upload->initialize($config);
                if ($this->upload->do_upload('profile_resume') !== False) {
                    $img = $this->upload->data();
                    $user_data['user_resume'] = $img['file_name'];
                    if ($this->db->select('user_resume')->from('user')->where('user_id', $this->session->userdata('user_id'))->get()->row()->user_resume == '') {
                        $user_data['user_profile_percent'] = $user_data['user_profile_percent'] + 5;
                    }
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    push_message(implode($error, ','), 'ERRO');
                }
            }


            $emp_data = array();

            $planes = array();
 if (isset($_POST['manufacturer'])) {
            foreach ($_POST['manufacturer'] as $val) {
                if ($val != '') {
                    $planes[] = $val;
                }
            }

            foreach ($_POST as $key => $val) {
                if (
                    $key != 'airstatus' &&
                    $key != 'airId' &&
                    $key != 'manufacturer' &&
                    $key != 'model' &&
                    $key != 'rating' &&
                    $key != 'rating_type' &&
                    $key != 'purchased_date' &&
                    $key != 'currently_own' &&
                    $key != 'sale_date' &&
                    $key != 'total' &&
                    $key != 'pic' &&
                    $key != 'sic' &&
                    $key != 'date' &&
                    $key != 'time' &&
                    $key != 'flighttime-key' &&
                    $key != 'flighttime' &&
                    $key != 'empId' &&
                    $key != 'empcompanyName' &&
                    $key != 'empjobTitle' &&
                    $key != 'empjobDuties' &&
                    $key != 'empmonthFormJob' &&
                    $key != 'empyearFromJob' &&
                    $key != 'empmonthToJob' &&
                    $key != 'empyearToJob' &&
                    $key != 'edustatus' &&
                    $key != 'eduId' &&
                    $key != 'eduschoolName' &&
                    $key != 'eduyearGrad' &&
                    $key != 'edumonthGrad' &&
                    $key != 'edumonthFromSchool' &&
                    $key != 'eduyearFromSchool' &&
                    $key != 'edumonthToSchool' &&
                    $key != 'eduyearToSchool' &&
                    $key != 'eduDegree' &&
                    $key != 'empstatus' &&
                    $key != 'action' &&
                    $key != 'cpassword' &&
                    $key != 'optionsRadios2' &&
                    $key != 'airtype' &&
                    $key != 'nnumber' &&
                    $key != 'planes' &&
                    $key != 'req_type' &&
                    $key != 'req_certificate' &&
                    $key != 'req_ftime' &&
                    $key != 'air_id' &&
                    $key != 'req_ttime' &&
                    $key != 'req_pic' &&
                    $key != 'req_id' &&
                    $key != 'reqstatus' &&
                    $key != 'req_degree' &&
                    $key != 'password'
                ) {
                    $user_data['user_' . $key] = $val;
                } else if ($key == 'rating' || $key == 'rating_type') {
                    foreach ($_POST[$key] as $r) {
                        isset($user_data['user_' . $key]) ? $user_data['user_' . $key] .= ',' . $r : $user_data['user_' . $key] = $r;
                    }
                } else if ($key == 'password') {
                    if ($_POST['password'] != '' && $_POST['cpassword'] != $_POST['password']) {
                        $user_data['user_password'] = md5($_POST['password']);
                    }
                }
            }
 }

            if ($this->input->post('rating') != '' && $this->db->select('user_rating')->from('user')->where('user_id', $this->session->userdata('user_id'))->get()->row()->user_rating == '') {
                $user_data['user_profile_percent'] = $user_data['user_profile_percent'] + 5;
            }

            if ($this->input->post('bio') != '' && $this->db->select('user_info')->from('user')->where('user_id', $this->session->userdata('user_id'))->get()->row()->user_info == '') {
                $user_data['user_profile_percent'] = $user_data['user_profile_percent'] + 5;
            }

            $user_data['user_planes'] = implode($planes, '/');
            $user_data['user_modified'] = time();

            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->update('user', $user_data);
            if (isset($user_data['user_image'])) {
                $this->session->set_userdata('user_image', $user_data['user_image']);
            }

            if (isset($_POST['empstatus'])) {
                foreach ($_POST['empstatus'] as $key => $emp) {
                    if ($emp == 'update') {
                        $tmp = array(
                            'empl_company' => $_POST['empcompanyName'][$key],
                            'empl_jobtitle' => $_POST['empjobTitle'][$key],
                            'empl_monthfromjob' => $_POST['empmonthFormJob'][$key],
                            'empl_yearfromjob' => $_POST['empyearFromJob'][$key],
                            'empl_monthtojob' => $_POST['empmonthToJob'][$key],
                            'empl_yeartojob' => $_POST['empyearToJob'][$key],
                            'empl_jobduties' => $_POST['empjobDuties'][$key],
                            'empl_modified' => time(),
                            'user_id' => $this->session->userdata('user_id')
                        );
                        $this->db->where('empl_id', $_POST['empId'][$key]);
                        $this->db->update('user_employeement', $tmp);
                    } else if ($emp == 'add' && $_POST['empcompanyName'][$key] != '') {
                        $tmp = array(
                            'empl_company' => $_POST['empcompanyName'][$key],
                            'empl_jobtitle' => $_POST['empjobTitle'][$key],
                            'empl_monthfromjob' => $_POST['empmonthFormJob'][$key],
                            'empl_yearfromjob' => $_POST['empyearFromJob'][$key],
                            'empl_monthtojob' => $_POST['empmonthToJob'][$key],
                            'empl_yeartojob' => $_POST['empyearToJob'][$key],
                            'empl_jobduties' => $_POST['empjobDuties'][$key],
                            'empl_created' => time(),
                            'empl_modified' => time(),
                            'user_id' => $this->session->userdata('user_id')
                        );
                        $this->db->insert('user_employeement', $tmp);
                    } else if ($emp == 'delete') {
                        $this->db->delete('user_employeement', array('empl_id' => $_POST['empId'][$key]));
                    }

                }
            }

            if (isset($_POST['edustatus'])) {
                foreach ($_POST['edustatus'] as $key => $emp) {
                    if ($emp == 'update') {
                        $tmp = array(
                            'edu_school' => $_POST['eduschoolName'][$key],
                            'edu_monthfromschool' => $_POST['edumonthFromSchool'][$key],
                            'edu_yearfromschool' => $_POST['eduyearFromSchool'][$key],
                            'edu_monthtoschool' => $_POST['edumonthToSchool'][$key],
                            'edu_yeartoschool' => $_POST['eduyearToSchool'][$key],
                            'edu_monthgrad' => $_POST['edumonthToSchool'][$key],
                            'edu_yeargrad' => $_POST['eduyearGrad'][$key],
                            'edu_degree' => $_POST['eduDegree'][$key],
                            'edu_modified' => time(),
                            'user_id' => $this->session->userdata('user_id')
                        );
                        $this->db->where('edu_id', $_POST['eduId'][$key]);
                        $this->db->update('user_education', $tmp);
                    } else if ($emp == 'add' && $_POST['eduschoolName'][$key] != '') {
                        $tmp = array(
                            'edu_school' => $_POST['eduschoolName'][$key],
                            'edu_monthfromschool' => $_POST['edumonthFromSchool'][$key],
                            'edu_yearfromschool' => $_POST['eduyearFromSchool'][$key],
                            'edu_monthtoschool' => $_POST['edumonthToSchool'][$key],
                            'edu_yeartoschool' => $_POST['eduyearToSchool'][$key],
                            'edu_monthgrad' => $_POST['edumonthToSchool'][$key],
                            'edu_yeargrad' => $_POST['eduyearGrad'][$key],
                            'edu_degree' => $_POST['eduDegree'][$key],
                            'edu_created' => time(),
                            'edu_modified' => time(),
                            'user_id' => $this->session->userdata('user_id')
                        );
                        $this->db->insert('user_education', $tmp);
                    } else if ($emp == 'delete') {
                        $this->db->delete('user_education', array('edu_id' => $_POST['eduId'][$key]));
                    }

                }
            }

            $config1['upload_path'] = UPLOAD_PATH . 'aircraft/';
            $config1['allowed_types'] = '*';
            $config1['overwrite'] = FALSE;
            $this->upload->initialize($config1);
            if (isset($_POST['airstatus'])) {

                foreach ($_POST['airstatus'] as $key => $emp) {
                    $name = '';
                    $photo = '';
                    $model = '';
                    if ($_POST['manufacturer'][$key] != '' && $_POST['manufacturer'][$key] != '0') {
                        $tmpModel = $this->db->from('directory_aircraft_search')->where('nnumber', $_POST['manufacturer'][$key])->get();
                        if ($tmpModel->num_rows() > 0) {
                            //$model = $model->row()->code;
                            $model = $tmpModel->row()->code;
                        }
                    }


                    if (isset($_FILES['photo']['name'][$key]) && $_FILES['photo']['name'][$key] != "") {
                        if ($this->upload->do_upload('photo', $key) !== False) {
                            $img = $this->upload->data();
                            $photo = $img['file_name'];
                        } else {
                            $error = array('error' => $this->upload->display_errors());
                            push_message(implode($error, ','), 'ERRO');
                        }
                    }

                    if ($emp == 'update') {
                        $tmp = array(
                            'aircraft_id' => $model,
                            'purchased_date' => $_POST['purchased_date'][$key],
                            'currently_own' => $_POST['currently_own'][$key],
                            'sale_date' => $_POST['sale_date'][$key],
                            'total' => $_POST['total'][$key],
                            'pic' => $_POST['pic'][$key],
                            'sic' => $_POST['sic'][$key],
                            'date' => $_POST['date'][$key],
                            'type' => $_POST['airtype'][$key],
                            'name' => $_POST['manufacturer'][$key],
                            'user_id' => $this->session->userdata('user_id')
                        );
                        if ($photo != '') {
                            $tmp['photo'] = $photo;
                        }
                        $this->db->where('air_id', $_POST['airId'][$key]);
                        $this->db->update('user_aircraft', $tmp);
                    } else if ($emp == 'add' && $model != '' && $model != '0') {
                        $tmp = array(
                            'aircraft_id' => $model,
                            'purchased_date' => $_POST['purchased_date'][$key],
                            'currently_own' => $_POST['currently_own'][$key],
                            'sale_date' => $_POST['sale_date'][$key],
                            'total' => $_POST['total'][$key],
                            'pic' => $_POST['pic'][$key],
                            'sic' => $_POST['sic'][$key],
                            'date' => $_POST['date'][$key],
                            'type' => $_POST['airtype'][$key],
                            'name' => $_POST['manufacturer'][$key],
                            'user_id' => $this->session->userdata('user_id')
                        );
                        if ($photo != '') {
                            $tmp['photo'] = $photo;
                        }
                        $this->db->insert('user_aircraft', $tmp);
                    } else {
                        $this->db->delete('user_aircraft', array('air_id' => $_POST['airId'][$key]));
                    }

                }
            }
            if (isset($_POST['flighttime-key'])) {
                $this->db->delete('user_flighttime', array('user_id' => $this->session->userdata('user_id')));
                foreach ($_POST['flighttime-key'] as $key => $ft) {
                    $this->db->insert('user_flighttime', array(
                        'user_id' => $this->session->userdata('user_id'),
                        'time_key' => $_POST['flighttime-key'][$key],
                        'time_val' => $_POST['flighttime'][$key]
                    ));
                }
            }

            if (isset($_POST['reqstatus'])) {

                foreach ($_POST['reqstatus'] as $key => $emp) {
                    if ($emp == 'update') {
                        $tmp = array(
                            'air_id' => $_POST['air_id'][$key],
                            'req_type' => $_POST['req_type'][$key],
                            'req_certificate' => $_POST['req_certificate'][$key],
                            'req_ttime' => $_POST['req_ttime'][$key],
                            'req_pic' => $_POST['req_pic'][$key],
                            'req_ftime' => $_POST['req_ftime'][$key],
                            'req_degree' => $_POST['req_degree'][$key],
                            'user_id' => $this->session->userdata('user_id')
                        );
                        if ($photo != '') {
                            $tmp['photo'] = $photo;
                        }
                        $this->db->where('req_id', $_POST['req_id'][$key]);
                        $this->db->update('user_requirement', $tmp);
                    } else if ($emp == 'add') {
                        $tmp = array(
                            'air_id' => $_POST['air_id'][$key],
                            'req_type' => $_POST['req_type'][$key],
                            'req_certificate' => $_POST['req_certificate'][$key],
                            'req_ttime' => $_POST['req_ttime'][$key],
                            'req_pic' => $_POST['req_pic'][$key],
                            'req_ftime' => $_POST['req_ftime'][$key],
                            'req_degree' => $_POST['req_degree'][$key],
                            'user_id' => $this->session->userdata('user_id')
                        );
                        if ($photo != '') {
                            $tmp['photo'] = $photo;
                        }
                        $this->db->insert('user_requirement', $tmp);
                    }

                }
            }

            push_message('You profile has been updated successfully');
        }
    }
    
    
    function search_directory($zip = '10016')
    {

        if ($this->input->post('action') != '') {
            if ($this->session->userdata('user_id') != '') {
                if ($this->input->post('location') != '') {
                    $zip = $this->input->post('location');
                }

                if ($this->input->post('keyword') != '') {
                    $this->db->where('(user_fname like "%' . $this->input->post('keyword') . '" OR user_lname like "%' . $this->input->post('keyword') . '" OR user_company like "%' . $this->input->post('keyword') . '")', '', FALSE);
                }
            } else {
                push_message('Please create free account to search pilots', true);
            }
        }
        //$this->db->where('user_type','p');
        //$this->db->from('directories')->like('zip',$zip)->limit(100)->get()->result();
        return $this->db->select('user_id as id, user_type as type, (CASE WHEN user_type = \'p\' THEN CONCAT(user_fname,\' \',user_lname) ELSE user_company END) as name, user_address as address, user_city as city, user_state as state, user_zip as zip, user_image as image')->from('user')->get()->result();
    }

    function courses($user_id)
    {
        $courses = $this->db->select('course_id, course_name, course_date, DATE_FORMAT(course_date,"%b") as course_month, user_id, course_offered_by, course_faa_id')->from('user_course')->where('user_id', $user_id)->where('course_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR)', '', FALSE)->get()->result_array();
        $stats = ['Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'Jun' => 0, 'Jul' => 0, 'Aug' => 0, 'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0];
        foreach ($courses as $course) {
            $stats[$course['course_month']]++;
        }
        return array('courses' => $courses, 'stats' => $stats);
    }

    function set_user_hiring()
    {
        if ($this->input->get("hiring") != "") {
            $this->db->where("user_id", $this->session->userdata("user_id"))->update("user", ["user_hiring" => $this->input->get("hiring")]);
        }
        if ($this->input->get("application") != "") {
            $this->db->where("user_id", $this->session->userdata("user_id"))->update("user", ["user_accepting_application" => $this->input->get("application")]);
        }
    }

    function update_photo() {
      if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['name'] != '') {
          $config['upload_path'] = UPLOAD_PATH . 'photo/';
          $config['allowed_types'] = '*';
          $config['overwrite'] = FALSE;
          $this->load->library('upload', $config);
          if ($this->upload->do_upload('profile_photo') !== False) {
              $img = $this->upload->data();
              $user_data['user_image'] = $img['file_name'];
              if ($this->db->select('user_image')->from('user')->where('user_id', $this->session->userdata('user_id'))->get()->row()->user_image == '') {
                  $user_data['user_profile_percent'] = $user_data['user_profile_percent'] + 5;
              }
              $this->db->where('user_id', $this->session->userdata('user_id'));
              $this->db->update('user', $user_data);
              $this->load->model('Model_photo');
              $this->Model_photo->insert($this->session->userdata('user_id'), [
                'title' => 'Profile Photo',
                'path' => $user_data['user_image'],
                'category' => time(),
              ]);
              push_message('Profile photo updated successfully', 'SUCC');
          } else {
              $error = array('error' => $this->upload->display_errors());
              push_message('Profile photo updated successfully', 'SUCC');
          }
      }
    }

    function update_background() {
      if (isset($_FILES['profile_bgphoto']) && $_FILES['profile_bgphoto']['name'] != '') {
          $config['upload_path'] = UPLOAD_PATH . 'photo/';
          $config['allowed_types'] = '*';
          $config['overwrite'] = FALSE;
          $this->load->library('upload', $config);
          if ($this->upload->do_upload('profile_bgphoto') !== False) {
              $img = $this->upload->data();
              $user_data['user_bgimage'] = $img['file_name'];
              if ($this->db->select('user_bgimage')->from('user')->where('user_id', $this->session->userdata('user_id'))->get()->row()->user_bgimage == '') {
                  $user_data['user_profile_percent'] = $user_data['user_profile_percent'] + 5;
              }
              $this->db->where('user_id', $this->session->userdata('user_id'));
              $this->db->update('user', $user_data);
              $this->load->model('Model_photo');
              $this->Model_photo->insert($this->session->userdata('user_id'), [
                'title' => 'Profile Photo',
                'path' => $user_data['user_bgimage'],
                'category' => time(),
              ]);
              push_message('Background photo updated successfully', 'SUCC');
          } else {
              $error = array('error' => $this->upload->display_errors());
              push_message(implode($error, ','), 'ERRO');
          }
      }
    }

    function get_department_aircrafts($id)
    {
        $user['aircraft'] = $this->db->from('user_aircraft')->join('directory_aircrafts', 'user_aircraft.aircraft_id = directory_aircrafts.id')->where('user_id', $id)->get()->result_array();
        // $user['aircraft_flown'] = $this->db->from('user_aircraft')->join('directory_aircrafts', 'user_aircraft.aircraft_id = directory_aircrafts.id')->where('user_id', $id)->where('type', 'f')->get()->result_array();
        $user['aircraft_flown'] = [];
        foreach ($user['aircraft'] as $key => $air) {
            $user['aircraft'][$key]['requirements'] = $this->db->from('user_requirement')->where('user_id', $id)->where('air_id', $air['air_id'])->get()->result_array();
        }
        return $user;
    }

    function get_pilot_flights($id)
    {
        $user = [];
        $user_flighttime = $this->db->from('user_flighttime')->where('user_id', $id)->get();
        if ($user_flighttime->num_rows() > 0) {
            $user['flightTime'] = $user_flighttime->result_array();
        } else {
            $user['flightTime'] = array();
        }
        return $user;
    }

    function get_pilot_extra_info($id)
    {
        $user = [];
        $user_employeement = $this->db->from('user_employeement')->where('user_id', $id)->get();
        if ($user_employeement->num_rows() > 0) {
            $user['employers'] = $user_employeement->result();
        } else {
            $user['employers'] = array();
        }
        $user_education = $this->db->from('user_education')->where('user_id', $id)->get();
        if ($user_education->num_rows() > 0) {
            $user['educations'] = $user_education->result();
        } else {
            $user['educations'] = array();
        }
        return $user;
    }
}
