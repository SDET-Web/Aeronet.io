<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{

    /*
     * Marketing Center - Map Home
     */

    public function flight_data()
    {
        // echo json_encode(get_flights("N628MC","10/01/2020"));
        // exit;
        header('Content-Type: application/json');
        if ($this->input->post("nnumber") == "" || $this->input->post("date") == "") {
            echo json_encode(array("status" => "error", "message" => "Please enter NNumber and date correctly"));
            exit;
        } else {
            $results = json_encode(get_flights("N" . $this->input->post("nnumber"), date("m/d/Y", strtotime($this->input->post("date")))));
            echo $results;
            exit;//"CTN441","02/26/2018");
            //echo '{"status":"success","data":[{"ident":"N12345","faFlightID":"N12345-1519691422-adhoc-0","origin":"KLMO","destination":"KFNL","departure":"05:30PM","arrival":"05:51PM"},{"ident":"N12345","faFlightID":"N12345-1519689329-adhoc-0","origin":"KFNL","destination":"KLMO","departure":"04:55PM","arrival":"05:08PM"}]}';exit;
        }
    }

    public function flight_route($flightId)
    {
        header('Content-Type: application/json');
        if ($flightId == '') {
            echo json_encode(array("status" => "error", "message" => "Please enter valid FlightId"));
            exit;
        } else {
            echo json_encode(get_flight_route($flightId));//"N628MC-1520647275-14-0-9");
            //echo '{"status":"success","data":[{"lat":31.8073333,"lng":-106.3763611},{"lat":30.9522222,"lng":-102.9758333},{"lat":29.6441667,"lng":-98.4613889},{"lat":29.6454167,"lng":-95.2788889}]}';exit;
        }

    }

    public function flight_map($flightId)
    {
        echo get_flight_map($flightId);
        exit;
    }

    public function index()
    {
        $this->load->view('browser/marketing/ajax_sample');
    }

    /*
     * Unique Email
     */
    public function unique_email()
    {
        $email = $this->db->select('user_id')->from('user')->where('user_email', $this->input->post('email'))->get();
        if ($email->num_rows() > 0) {
            echo 0;
        } else {
            echo 1;
        }
    }

    /*
     * Take Models from Make
     */
    public function model()
    {
        echo get_select_model($this->input->post('make'));
    }

    /*
     * Add Aircraft to session
     */
    public function add_aircraft()
    {
        $array = $this->session->userdata('aircrafts_list_html');
        $array[$this->input->post('aircraftID')] = $this->input->post('aircraftHtml');
        $this->session->set_userdata('aircrafts_list_html', $array);
    }

    /*
     * Remove Aircraft to session
     */
    public function remove_aircraft()
    {
        $array = $this->session->userdata('aircrafts_list_html');
        unset($array[$this->input->post('aircraftID')]);
        $this->session->set_userdata('aircrafts_list_html', $array);
    }

    /*
     * Resume HTML
     */
    public function resume_html($id)
    {
        $this->load->model('Model_user');
        $user = $this->Model_user->get_member($id);
        $this->load->view('browser/user/resume/view_html', array('user' => $user));
    }

    /*
     * Upload file
     */

    public function adminUpload()
    {
        $config['upload_path'] = realpath($_SERVER['DOCUMENT_ROOT']) . '/skin/upload/tmpXLS';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        $file_pathz = '';
        if (!$this->upload->do_upload('aircraft_file')) {
            echo $this->upload->display_errors();
        } else {
            $data1 = $this->upload->data();
            header('Location:/admin/index.php?file=airport.import.php&ff=' . $data1['file_name']);
            //print_r($file_path);
        }
    }

    public function load_data($state)
    {
        $data = $this->db->select('id, (select id from state where state.shortname = ac.state) as state_id, (select id from county where county.state_id in (select id from state where state.shortname = ac.state) and county.name = trim(ac.county)) as county_id,"0" as city_id, `USE` as `use`, AIRPORT as facilityName, LETTER_3 as locationID,(select name from county where county.state_id in (select id from state where state.shortname = ac.state) and  county.name = trim(ac.county)) as county_name ', FALSE)->from('airports ac')->where('state', $state)->get();
        $output = g_makeGroupArray($data->result_array(), 'county_name');
        echo json_encode($output);
    }

    public function lookup()
    {
        header('Content-Type: application/json');
        echo get_curl('https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyBUsPJG-1spCmnW1Wclj6dHZvqYgLWlo2k');
    }

    public function send_invitation($user_id, $conn_id, $type = 'u')
    {
        header('Content-Type: application/json');
        if ($user_id != '' && $conn_id != '' && $user_id != 'undefined' && $conn_id != 'undefined' && $user_id != '0' && $conn_id != '0') {
            $this->load->model('Model_user');
            if (count($this->Model_connection->get_connection($user_id, $conn_id)) == 0) {
                if ($this->Model_connection->insert_connection($user_id, $conn_id, 'p', $type) != false) {
                    echo json_encode(array('result' => 'success'));
                } else {
                    echo json_encode(array('result' => 'error', 'message' => 'Request did not get through. Please try again.'));
                }
            } else {
                echo json_encode(array('result' => 'error', 'message' => 'Request has been already sent to user.'));
            }
        } else {
            echo json_encode(array('result' => 'error', 'message' => 'Request denied, please try again.'));
        }
    }


    public function department_directory($term)
    {
        header('Content-Type: application/json');
        $this->load->model('Model_directory');
        echo json_encode($this->Model_directory->browse_directory_department($term));
    }

    public function make_directory($make)
    {
        header('Content-Type: application/json');
        echo json_encode((array)select_maker_name($make));
    }

    public function model_directory($make_id)
    {
        header('Content-Type: application/json');
        echo json_encode((array)select_model_id($make_id));
    }

    public function model_directory_search($make_id, $searchTerm)
    {
        header('Content-Type: application/json');
        echo json_encode((array)search_model_id($make_id, $searchTerm));
    }

    public function make_model_directory_search($searchTerm)
    {
        header('Content-Type: application/json');
        echo json_encode((array)$this->db->distinct()->select('name')->from('directory_aircraft_search')->like('name', urldecode($searchTerm))->limit(100)->get()->result_array());
    }

    public function make_model_from_nnumber($nnumber)
    {
        header('Content-Type: application/json');
        echo json_encode((array)$this->db->distinct()->select('name,code')->from('directory_aircraft_search')->where('nnumber', urldecode($nnumber))->limit(1)->get()->result_array());
    }


    public function latlng($query)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode(get_latlng($query));
    }

    public function set_lat_lng()
    {
        $this->load->model('Model_user');
        $this->Model_user->update_lat_lng();
    }

    public function process_importing($userId)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        if ($this->input->post('action') == 'contacts') {
            $data = json_decode($this->input->post('data'));
            $batch_data = array();
            foreach ($data as $user) {
                if ($this->db->where('user_id', $userId)->where('contact_email', $user->email[0])->from('user_contact')->count_all_results() <= 0) {
                    $batch_data[] = array(
                        'user_id' => $userId,
                        'contact_email' => $user->email[0],
                        'contact_fname' => $user->name->first_name,
                        'contact_lname' => $user->name->last_name,
                        'contact_photo' => $user->imageurl,
                        'contact_created' => time(),
                    );
                }
            }
            if (count($batch_data) > 0) {
                $this->db->insert_batch('user_contact', $batch_data);
            }
            echo json_encode(array('status' => 'success'));
        } else if ($this->input->post('action') == 'selectedcontacts') {
            $data = json_decode($this->input->post('data'));
            $batch_data = array();
            foreach ($data as $user) {
                $contact = $this->db->where('user_id', $userId)->where('contact_email', $user->email[0])->from('user_contact')->select('contact_id')->get();
                if ($contact->num_rows() > 0) {
                    $batch_data[] = $contact->row()->contact_id;
                }
            }
            $this->db->where_in('contact_id', $batch_data);
            $this->db->update('user_contact', array('contact_selected' => 'y'));
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function cron_job_courses()
    {
        $html = file_get_contents('https://www.faasafety.gov/gslac/ALC/course_catalog.aspx');
        if ($this->input->post('action') != '') {
            $this->db->truncate('directory_courses');
            $this->db->insert_batch('directory_courses', $_POST['data']);
            exit;
        }
        $this->load->view('main', array('view' => 'cron/course', 'data' => array('data' => $html)));
    }

    public function delete_photo()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        if ($this->input->post('action') == 'delete_photo') {
            $this->db->delete("photo", array("photo_id" => $this->input->post("photo")));
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    /* public function get_aircraft_manufacturer(){
         $response = array();
         $this->load->model('Model_auth');
         $manufacturers = $this->Model_auth->load_manufacturers();
         $response['query'] = "Unit";
         $response['suggestions'] = $manufacturers;
         echo json_encode($response);
     }*/

    /*
    public function get_aircraft_manufacturer($term)
     {
         header('Content-Type: application/json');
         $this->load->model('Model_auth');
         $manufacturers = $this->Model_auth->load_manufacturers($term);
         echo json_encode($manufacturers);
     }

     public function get_aircraft_models($manufacturer, $term){
         header('Content-Type: application/json');
         $this->load->model('Model_auth');
         $models = $this->Model_auth->load_models($manufacturer, $term);
         echo json_encode($models);
     }

     public function get_aircraft_nNumbers($manufacturer, $model, $term){
         header('Content-Type: application/json');
         $this->load->model('Model_auth');
         $nNumbers = $this->Model_auth->load_n_numbers($manufacturer, $model, $term);
         echo json_encode($nNumbers);
     }
    */
    public function get_aircraft_nNumbers($term)
    {
        header('Content-Type: application/json');
        $this->load->model('Model_auth');
        $nNumbers = $this->Model_auth->load_n_numbers($term);
        echo json_encode($nNumbers);
    }

    public function load_make_model_by_n_number($n_number)
    {
        header('Content-Type: application/json');
        $this->load->model('Model_auth');
        $data = $this->Model_auth->load_make_model_by_n_number($n_number);
        echo json_encode($data);
    }

    public function assign_type_rating()
    {
        $data = $this->db->select("n_number, aircraft_type_rating")->from("directory_aircraft")->where("aircraft_type_rating !=", '')->get()->result_array();
        $reduced = array();
        foreach ($data as $item) {
            $reduced[$item["aircraft_type_rating"]][] = $item["n_number"];
            //``$reduced``[$item["aircraft_type_rating"]][] = $item["n_number"]
            //$this->db->where("n_number",$item["n_number"]);
            //$this->db->update("dir_master",array("aircraft_type_rating" => $item["aircraft_type_rating"]));
        }

        //print_r($reduced);exit;

        foreach ($reduced as $key => $item) {
            $this->db->query("update dir_master set aircraft_type_rating = '" . $key . "' where n_number IN ('" . implode($item, "','") . "')");
        }

    }

    public function info()
    {
        $result = [];
        $data = $this->db->from("dir_nnumber_model_type_rating")->get()->result_array();
        foreach ($data as $item) {
            $this->db->where("id", $item["id"])->update("dir_master", ["aircraft_type_rating" => $item["type_rating"]]);
        }
        dd("Done");
    }

    public function airports()
    {
        header('Content-Type: application/json');
        $data = $this->db->select("CONCAT(AIRPORT, ' (', LETTER_3,')') AS AIRPORT")->from("directory_airports")->like("AIRPORT", $this->input->get("query"))->get()->result_array();
        echo json_encode(array_column($data, "AIRPORT"));
    }
}
