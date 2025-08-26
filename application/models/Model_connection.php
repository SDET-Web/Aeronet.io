<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The Model_connection class is the model which includes Business Logic of all types of connection.
 *
 * @package   model
 * @version   0.01
 * @since     2016-06-27
 * @author    Rizwan Ali<riz@bitspro.com>
 */
class Model_connection extends CI_Model
{

    /**
     *
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Browse connection
     *
     * @param int $userUser
     * @param string $userStatus
     * @param string $userSort
     * @param string $userOrder
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */

    function browse($userPage, $userUser = 0, $userStatus = '', $userType = '', $userSort = '', $userOrder = 'desc')
    {
        if ($userUser != 0) {
            $this->db->where('conn_id', $userUser);
        }
        if ($userStatus != '') {
            $this->db->where('conn_status', $userStatus);
        }

        if ($userSort != '') {
            $this->db->order_by($userSort, $userOrder);
        }

        if ($userType != '') {
            $this->db->where('conn_type', $userType);
        }

        $this->db->limit(SITE_ROW_COUNT, $userPage * SITE_ROW_COUNT);
        $data = $this->db
            ->select('connection.user_id AS id,conn_id AS conn_id,conn_status AS conn_status,conn_created AS conn_created, user_image as image, user_fname as fname, user_lname as lname, user.user_id, user.user_type as type')
            ->from('connection')
            ->join('user', 'user.user_id = connection.user_id')
            ->get()->result_array();

        $query = $this->db->last_query();
        $query = substr($query, 0, strpos($query, 'LIMIT'));
        $query = substr($query, strpos($query, 'FROM'));

        $count = $this->db->query('SELECT COUNT(*) as count ' . $query)->row()->count;
        return array('total' => $count, 'data' => $data);
    }


    function friends_of_friends($userUser, $type = 'u', $limit = 5)
    {
        return $this->db
            ->select('user.user_id AS id,user_fname AS fname,user_image as image, user_lname AS lname, user_type as type, user_address, user_city, user_state')
            ->from('user')
            ->where('user_id NOT IN (SELECT connection.conn_id FROM connection WHERE user_id = ' . $userUser . ') ', '', FALSE)
            ->where('user.user_type', $type)
            ->limit($limit)
            ->get()->result_array();
    }

    function connections($user, $status = '', $type = '', $limit = 0)
    {
        if ($status != '') {
            $this->db->where('friend_status', $status);
        }
        if ($type != '') {
            $this->db->where('friend_type', $type);
        }
        if ($limit != 0) {
            $this->db->limit($limit);
        }

        if ($status = 'p') {
        $this->db->from('(SELECT user_id AS friend_id, conn_status AS friend_status, conn_type AS friend_type FROM `connection` WHERE conn_id = ' . $user . ') friends');   
        } else {
        $this->db->from('(SELECT (CASE WHEN user_id = ' . $user . ' THEN conn_id ELSE user_id END) AS friend_id, conn_status AS friend_status, conn_type AS friend_type FROM `connection` WHERE user_id = ' . $user . ' OR conn_id = ' . $user . ') friends');
        }

        return $this->db
            ->select('user.user_id AS id,user_fname AS fname,user_image as image, user_lname AS lname, user_type as type, user_address, user_city, user_state, user_company')
            ->join('user', 'user.user_id = friend_id')
            ->get()->result_array();
    }
    
    function invitations($user, $status = '', $type = '', $limit = 0)
    {
        if ($status != '') {
            $this->db->where('friend_status', $status);
        }
        if ($type != '') {
            $this->db->where('friend_type', $type);
        }
        if ($limit != 0) {
            $this->db->limit($limit);
        }       
        if($status = 'p' and $type = 'd') {
        $this->db->from('(SELECT conn_id AS friend_id, conn_status AS friend_status, conn_type AS friend_type FROM `connection` WHERE user_id = ' . $user . ') friends');
        }
        return $this->db
            ->select('user.user_id AS id,user_fname AS fname,user_image as image, user_lname AS lname, user_type as type, user_address, user_city, user_state, user_company')
            ->join('user', 'user.user_id = friend_id')
            ->get()->result_array();
    }
    
    

    function non_connections($user, $status = '', $type = '', $limit = 0)
    {
        if ($status != '') {
            $this->db->where('user_status', $status);
        }
        if ($type != '') {
            $this->db->where('user_type', $type);
        }

        if ($limit != 0) {
            $this->db->order_by('user_id', 'DESC');
            $this->db->limit($limit);
        }
        return $this->db
            ->select('user.user_id AS id,user_fname AS fname,user_image as image, user_lname AS lname, user_type as type, user_address, user_city, user_state, user_company as company')
            ->from('user ')
            ->where('user_id !=', $user)
            ->where('user_id NOT IN (SELECT (CASE WHEN user_id = ' . $user . ' THEN conn_id ELSE user_id END) FROM `connection` WHERE user_id = ' . $user . ' OR conn_id = ' . $user . ')', '', FALSE)
            ->get()->result_array();
    }
    
    /* Function to find the head hunter for subscribed members
    public function GetHeadHunterModels($id, $type)
    {
        return $this->db->select("jb.id as job_id,jb.title as title,jb.aircraft_id,user_aircraft.aircraft_id,directory_aircrafts.mfr_name as make,directory_aircrafts.model_name as model")
            ->from("jobs as jb")
            ->join("user_aircraft", "jb.aircraft_id = user_aircraft.air_id")
            ->join("directory_aircrafts", "user_aircraft.aircraft_id = directory_aircrafts.id")
            ->where("jb.user_id", $id)->where("jb.type", $type)
            //->where("due >", time())
            ->group_by("model")->get()->result_array();
        //print_r($this->db->last_query());
    }*/

    public function GetHeadHunterModels($id, $type)
    {
        
        
        return $this->db->select("user_air.user_id,user_air.aircraft_id,dir_acftref.mfr as make,dir_acftref.model as model")
            ->from("user_aircraft as user_air")
            ->join("dir_master", "dir_master.id  = user_air.aircraft_id")
            ->join("dir_acftref", "dir_acftref.code = dir_master.mfr_mdl_code")
            ->where("user_air.user_id", $id)
            ->group_by("dir_acftref.model")->get()->result_array();
        
     
        
    }
    
    public function GetHeadHunterUsers($model, $type)
    {
        return $this->db->select("user_id,user_type,user_created,user_resume,user_image,user_rating_type,user_rating as rating, user_fname as fname,user_lname as lname")
            ->from("user")->where("user_type", $type)
            ->like("user_rating_type",trim($model),'both')->group_by("user_id")->order_by('user_created', 'desc')
            ->get()->result_array();
    }


    /*public function HeadHunterApplicant($job_id, $user_id)
    {
        return $this->db->select("job_id")->from("applications")->where("job_id", $job_id)->where("type", "d")->where("user_id", $user_id)->get()->result_array();
    }*/

  
    function job_count($user, $type, $status){
        $this->db->where('jobs.user_id', $this->session->userdata('user_id'));
         $this->db->where('applications.type = ', $type);
         $this->db->where('applications.status = ', $status);       
         $rs = $this->db->select('applications.*,jobs.title,jobs.created as job_created, jobs.user_id as job_user_id')
              ->from('applications')
              ->join('jobs', 'jobs.id = applications.job_id')  
              ->where("due >", time())
              ->get();
         return $rs->num_rows();
         
        //print_r($this->db->last_query()); 
       // if ($rs->num_rows() > 0) {
       // echo 'helllo'.$rs->num_rows();    
            
       // }
        /*$this->db->select('*, COUNT DISTINCT(id) as total');
        
        $this->db->from('applications');
        if ($status != '') {
            $this->db->where('status', $status);
            //echo $status;
        }
        if ($type != '') {
            $this->db->where('type', $type);
            // echo $type;  echo $user;
            
        }
        $this->db->where('user_id', $user);
        $this->db->group_by('total');
       
        $query = $this->db->get()->result_array();
        print_r($this->db->last_query());   
        return $query; */
                  
    }

    /**
     * Search connection based on browse after applying filters
     *
     * @param int $user
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function search($user = 0)
    {
        $page = 0;
        $term = '';
        $sort = '';
        $order = 'desc';
        $status = '';

        if ($this->input->get('page') != '') {
            $page = $this->input->get('page');
        }

        if ($this->input->get('term') != '') {
            $term = $this->input->get('term');
        }

        if ($this->input->get('sort') != '') {
            $sort = $this->input->get('sort');
        }

        if ($this->input->get('order') != '') {
            $order = $this->input->get('order');
        }

        return $this->browse($page, $user, $status, $term, $sort, $order);
    }

    /**
     * Insert a new connection based on action variable
     *
     * @param int $userUser
     * @param mixed $input
     *
     * @return int
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function insert($userUser, $connId, $type, $status = 'p')
    {

        $this->load->model('Model_email');

        $count = $this->db->from('connection')->where('user_id', $connId)->where('conn_id', $userUser)->get()->num_rows();
        $count1 = $this->db->from('connection')->where('user_id', $userUser)->where('conn_id', $connId)->get()->num_rows();

        if ($count + $count1 <= 0) {


            $user = $this->db->select('user_id, user_company, user_fname, user_lname, user_email')->from('user')->where('user_id', $userUser)->get()->row_array();
            $conn = $this->db->select('user_id, user_company, user_email')->from('user')->where('user_id', $connId)->get()->row_array();


            $data = array();
            $data['user_id'] = $userUser;
            $data['conn_id'] = $connId;
            $data['conn_status'] = ($type == 'd' ? 'p' : $status);
            if($type == 'i'){$type = 'd';}
            $data['conn_type'] = $type;
            $data['conn_created'] = time();

            $this->db->insert('connection', $data);
            $this->db->insert_id();

            if ($type == 'd') {
                $this->Model_email->following_department($user['user_company'], $user['user_email'], $conn['user_id'], $conn['user_email']);
            } else {
                $this->Model_email->following_pilot($user['user_fname'] . ' ' . $user['user_lname'], $user['user_email'], $conn['user_id'], $conn['user_email']);
            }
        }

        return array('message' => 'success');
    }

    /**
     * Update connection based on provided variable and data
     *
     * @param int $userUser
     * @param mixed $input
     *
     * @return int
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function update($userUser, $userId, $input)
    {
        $data = $this->get($userId);
        if ($data['user_id'] == $userUser) {
            $this->load->library('form_validation');

            if ($this->form_validation->run() != FALSE) {
                foreach ($input as $key => $value) {
                    if ($key != 'action') {
                        if (strpos($key, 'lastlogin') !== FALSE || strpos($key, 'dob') !== FALSE) {
                            $data['user_' . $key] = strtotime($value);
                        } else {
                            $data['user_' . $key] = ($key == 'password' ? md5($value) : $value);
                        }
                    }
                }

                $this->db->where('user_id', $userId);
                if ($this->db->update('connection', $data)) {
                    set_message('user has been updated successfully');
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Delete a particular connection
     *
     * @param $userId
     *
     * @return bool
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function delete($userId, $connId)
    {
        $this->db->delete('connection', array('user_id' => $userId, 'conn_id' => $connId));
        $this->db->delete('connection', array('conn_id' => $userId, 'user_id' => $connId));
        //return array('message' => 'success');
        redirect("my/network");
        
    }

    /**
     * Get a single connection provided the id
     *
     * @param $userId
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function get($userId)
    {
        $this->db->where('user_id', $userId);
        return $this->db
            ->select('user_id AS id,conn_id AS conn_id,conn_status AS conn_status,conn_created AS conn_created,')
            ->from('connection')
            ->get()->row_array();
    }

    /**
     * Update status of connection
     *
     * @param $id
     * @param $status
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function set_status($userId, $connId, $status)
    {       
        $data['conn_status'] = $status;
        $this->db->where('user_id', $userId)->where('conn_id', $connId);
        $this->db->update('connection', $data);
        return array('message' => 'success'); 
        //redirect("my/network");
    }

    /**
     * Handle submission for connection
     *
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function submit()
    {
        if ($this->input->get_post('action') == 'delete_user') {
            if ($this->input->get_post('id') != '') {
                return $this->delete($this->input->get_post('id'));
            }
        } else if ($this->input->get_post('action') == 'update_user') {
            if ($this->input->get_post('id') != '') {
                return $this->update($this->session->userdata('user_id'), $this->input->get_post('id'), $_POST);
            }
        } else if ($this->input->get_post('action') == 'add_user') {
            return $this->insert($this->session->userdata('user_id'), $_POST);
        } else if ($this->input->get_post('action') == 'status_user') {
            if ($this->input->get_post('id') != '' && $this->input->get_post('status') != '') {
                return $this->set_status($this->input->get_post('id'), $this->input->get_post('status'));
            }
        } else if ($this->input->get_post('action') == 'search_user' || $this->input->get_post('action') == 'search_user') {
            return $this->search($this->session->userdata('user_id'));
        }
    }


    function imported_contacts($id)
    {
        return $this->db->select('contact_id, contact_selected, contact_created,contact_photo, contact_email, contact_fname, contact_lname, user.user_id')->from('user_contact')->join('user', 'contact_email = user.user_email', 'LEFT')->where('user_contact.user_id', $id)->get()->result_array();
    }

    function import_contacts($id)
    {
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
            return json_encode(array('status' => 'success'));
        }
    }

    function send_invitation($id)
    {
        if ($this->input->post('action') == 'send_invitation') {
            $this->load->model('Model_email');
            $selected = array();
            foreach ($this->input->post('selected') as $user) {
                $selected[] = $user;
            }
            $this->db->where_in('contact_id', $selected);
            $data = $this->imported_contacts($id);
            foreach ($data as $user) {
                if ($user['user_id'] > 0) {
                    $this->insert($id, $user['user_id'], 'p');
                } else {
                    $sender = $this->db->select('user_fname, user_lname')->from('user')->where('user_id', $id)->get()->row();
                    $this->Model_email->register_invitation($user['contact_email'], $user['contact_fname'] . ' ' . $user['contact_lname'], $sender->user_fname . ' ' . $sender->user_lname);
                }
            }
            push_message('Invitations have been sent successfully.');
        }
    }


    function suggested_pilot_department($id, $type)
    {
        if ($type == 'department') {
            $this->db->where('pilot', $id)->join('user', 'user.user_id = match_pilot_department_by_aircraft.department');
        } else {
            $this->db->where('department', $id)->join('user', 'user.user_id = match_pilot_department_by_aircraft.pilot');
        }
        return $this->db
            ->select('user.user_id AS id,user_fname AS fname,user_image as image, user_lname AS lname, user_type as type, user_address, user_city, user_state, user_company as company')
            ->from('match_pilot_department_by_aircraft')
            ->get()->result_array();
    }

}
?>
