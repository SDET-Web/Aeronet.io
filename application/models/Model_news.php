<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The Model_post class is the model which includes Business Logic of all types of post.
 *
 * @package   model
 * @version   0.01
 * @since     2016-06-27
 * @author    Rizwan Ali<riz@bitspro.com>
 */
class Model_news extends CI_Model
{

    /**
     *
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Model_photo');
        $this->load->model('Model_comment');

    }

    /**
     * Browse post
     *
     * @param int $postUser
     * @param string $postStatus
     * @param string $postSort
     * @param string $postOrder
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function browse($postPage, $postStatus = '', $postTerm = '', $postSort = 'post_created', $postOrder = 'desc', $postCategory)
    {

        $this->db->order_by('news_date', 'desc');

        if ($postTerm != '') {
            $this->db->like('news_title', $postTerm);
        }

        if ($postCategory != '') {
            $this->db->where('news_type', $postCategory);
        }

        $this->db->limit(SITE_ROW_COUNT, $postPage * SITE_ROW_COUNT);
        $data = $this->db
            ->select('news_id AS id, news_title as title, news_type as category, news_photo AS image, news_date as date, news_desc as desc, (SELECT count(*) FROM comment where comm_type = "n" and post_id = news_id) as count')
            ->from('news')
            ->get()->result_array();


        $query = $this->db->last_query();
        $query = substr($query, strpos($query, 'LIMIT'));
        $query = substr($query, strpos($query, 'FROM'));

        $count = $this->db->query('SELECT COUNT(*) as count ' . $query)->row()->count;
        return array('total' => $count, 'data' => $data);
    }

    /**
     * Search post based on browse after applying filters
     *
     * @param int $user
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function search($category = '')
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

        return $this->browse($page, $status, $term, $sort, $order, $category);
    }

    /**
     * List of categories
     *
     * @return array
     */

    function categories()
    {
        return $this->db->select("news_type as category,count(news_type) as count")->from("news")->group_by("news_type")->get()->result_array();
    }


    /**
     * Get a single news provided the id
     *
     * @param $id
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function get($id)
    {
        $this->db->where('news_id', $id);
        $data = $this->db
            ->select('news_excerpt as headline, news_id AS id, news_title as title, news_type as category, news_photo AS image, news_date as date, news_desc as desc, (SELECT count(*) FROM comment where comm_type = "n" and post_id = news_id) as count')
            ->from('news')
            ->get()->row_array();
        $data['comments'] = $this->db
            ->select('comm_id AS id,comment.user_id AS user_id, CONCAT(user.user_fname,\' \',user.user_lname) AS name, user_image AS photo,post_id AS post_id,comm_text AS text,comm_created AS created')
            ->from('comment')
            ->join("user", "user.user_id = comment.user_id")
            ->where('comm_type', 'n')
            ->where('post_id', $id)
            ->get()->result_array();
        return $data;
    }

}
?>
