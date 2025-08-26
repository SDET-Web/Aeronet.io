<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The Model_page class is the model which includes Business Logic of all types of page.
 *
 * @package   model
 * @version   0.01
 * @since     2016-06-27
 * @author    Rizwan Ali<riz@bitspro.com>
 */
class Model_page extends CI_Model
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
     * Browse page
     *
     * @param int $pageUser
     * @param string $pageStatus
     * @param string $pageSort
     * @param string $pageOrder
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function browse()
    {
        $data = $this->db
            ->select('page_id AS id,page_title AS title,page_url AS url')
            ->from('page')
            ->get()->result_array();
        return array('total' => count($data), 'data' => $data);
    }

    /**
     * Get a single page provided the id
     *
     * @param $pageId
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function get($pageUrt)
    {
        $this->db->where('page_url', $pageUrt);
        return $this->db
            ->select('page_id AS id,page_title AS title,page_content AS content, page_url as url')
            ->from('page')
            ->get()->row_array();
    }

}
?>
