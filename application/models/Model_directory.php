<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The Model_directory class is the model which includes Business Logic of all types directories including pilot, states etc.
 *
 * @package   model
 * @version   0.01
 * @since     2016-06-27
 * @author    Rizwan Ali<riz@bitspro.com>
 */
class Model_directory extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_pilot($id)
    {
        $pilot = $this->db->from('directory_pilot')->where('unique_id', $id)->get()->row_array();
        $pilot['certificates'] = $this->db->from('directory_pilot_certificate')->where('unique_id', $pilot['unique_id'])->get()->result_array();
        return $pilot;
    }

    function get_directory_department($id)
    {
        return $this->db->from('directory_deptartment')->where('id', $id)->get()->row_array();
    }

    function browse_directory_department($term)
    {

        if ($term != '') {
            $this->db->like('company', $term, 'after')->order_by('company');
            $this->db->limit(10);
            $data = $this->db
                ->select('company as title')
                ->from('directory_deptartment')
                ->where('company NOT IN (SELECT DISTINCT user_company FROM user WHERE user_company IS NOT NULL)')
                ->get()->result_array();

            $query = $this->db->last_query();
            pr($query);
            $query = substr($query, 0, strpos($query, 'LIMIT'));
            $query = substr($query, strpos($query, 'FROM'));


            $count = $this->db->query('SELECT COUNT(*) as count ' . $query)->row()->count;
            return array('total' => $count, 'data' => $data);

        } else {
            return array('total' => 0, 'data' => array());
        }

    }

    function browse_directory_department_new($term)
    {

        if ($term != '') {
            $this->db->like('company', $term, 'after')->order_by('company');
            $this->db->limit(10);
            $data = $this->db
                ->select('company as title')
                ->from('directory_deptartment')
                // ->where('company NOT IN (SELECT DISTINCT user_company FROM user WHERE user_company IS NOT NULL)')
                ->get()->result_array();

            $query = $this->db->last_query();
            // pr($query);
            $query = substr($query, 0, strpos($query, 'LIMIT'));
            $query = substr($query, strpos($query, 'FROM'));

            $count = $this->db->query('SELECT COUNT(*) as count ' . $query)->row()->count;
            return array('total' => $count, 'data' => $data);

        } else {
            return array('total' => 0, 'data' => array());
        }

    }


    function browse_directory_pilot($term)
    {
        $term = urldecode($term);
        if ($term != '') {
            $this->db->like('full_name', $term, 'after')->order_by('full_name');
            $this->db->limit(50);
            $data = $this->db
                ->select('full_name as title')
                ->from('directory_pilot_search')
                ->where('directory_pilot_search.unique_id NOT IN (SELECT user_pilot_id FROM user)', '', FALSE)
                ->get()->result_array();

            $query = $this->db->last_query();
            $query = substr($query, 0, strpos($query, 'LIMIT'));
            $query = substr($query, strpos($query, 'FROM'));


            $count = $this->db->query('SELECT COUNT(*) as count ' . $query)->row()->count;
            return array('total' => $count, 'data' => $data);

        } else {
            return array('total' => 0, 'data' => array());
        }
    }
}
?>
