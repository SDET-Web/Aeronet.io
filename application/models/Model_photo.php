<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The Model_photo class is the model which includes Business Logic of all types of photo.
 *
 * @package   model
 * @version   0.01
 * @since     2016-06-27
 * @author    Rizwan Ali<riz@bitspro.com>
 */
class Model_photo extends CI_Model
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
     * Browse photo
     *
     * @param int $photoUser
     * @param string $photoStatus
     * @param string $photoSort
     * @param string $photoOrder
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function browse($photoPage, $photoCategory = '', $photoUser = 0, $photoTerm = '', $photoSort = 'photo_created', $photoOrder = 'asc')
    {
        if ($photoUser != 0) {
            $this->db->where('user_id', $photoUser);
        }

        if ($photoCategory != '') {
            $this->db->where('photo_category', $photoCategory);
        }

        if ($photoUser != 0) {
            $this->db->where('user_id', $photoUser);
        }

        if ($photoSort != '') {
            $this->db->order_by($photoSort, $photoOrder);
        }

        if ($photoTerm != '') {
            $this->db->like('photo_title', $photoTerm);
        }
        if ($photoPage >= 0) {
            $this->db->limit(SITE_ROW_COUNT, $photoPage * SITE_ROW_COUNT);
        }
        $data = $this->db
            ->select('photo_id AS id,photo_title AS title,photo_path AS path,user_id AS user_id,photo_created AS created,photo_category AS category,')
            ->from('photo')
            ->get()->result_array();

        $query = $this->db->last_query();
        $query = substr($query, strpos($query, 'LIMIT'));
        $query = substr($query, strpos($query, 'FROM'));

        $count = $this->db->query('SELECT COUNT(*) as count ' . $query)->row()->count;
        return array('total' => $count, 'data' => $data);
    }

    /**
     * Search photo based on browse after applying filters
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
        $category = '';

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

        if ($this->input->get('category') != '') {
            $category = $this->input->get('category');
        }

        return $this->browse($page, $category, $user, $term, $sort, $order);
    }

    /**
     * Insert a new photo based on action variable
     *
     * @param int $photoUser
     * @param mixed $input
     *
     * @return int
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function insert($photoUser, $input)
    {
        $this->load->library('form_validation');

            foreach ($input as $key => $value) {
                if ($key != 'action') {
                    if (strpos($key, 'lastlogin') !== FALSE || strpos($key, 'dob') !== FALSE) {
                        $data['photo_' . $key] = strtotime($value);
                    } else {
                        $data['photo_' . $key] = ($key == 'password' ? md5($value) : $value);
                    }
                }
            }
            $data['photo_created'] = time();
            $data['user_id'] = $photoUser;

            $this->db->insert('photo', $data);
            return $this->db->insert_id();
    }

    /**
     * Update photo based on provided variable and data
     *
     * @param int $photoUser
     * @param mixed $input
     *
     * @return int
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function update($photoUser, $photoId, $input)
    {
        $data = $this->get($photoId);
        if ($data['user_id'] == $photoUser) {
            $this->load->library('form_validation');

            if ($this->form_validation->run() != FALSE) {
                foreach ($input as $key => $value) {
                    if ($key != 'action') {
                        if (strpos($key, 'lastlogin') !== FALSE || strpos($key, 'dob') !== FALSE) {
                            $data['photo_' . $key] = strtotime($value);
                        } else {
                            $data['photo_' . $key] = ($key == 'password' ? md5($value) : $value);
                        }
                    }
                }

                $this->db->where('photo_id', $photoId);
                if ($this->db->update('photo', $data)) {
                    set_message('photo has been updated successfully');
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
     * Delete a particular photo
     *
     * @param $photoId
     *
     * @return bool
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function delete($photoId)
    {
        $this->db->delete('photo', array('photo_id' => $photoId));
        set_message('photo has been deleted successfully');
        return true;
    }

    /**
     * Get a single photo provided the id
     *
     * @param $photoId
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function get($photoId)
    {
        $this->db->where('photo_id', $photoId);
        return $this->db
            ->select('photo_id AS id,photo_title AS title,photo_path AS path,user_id AS user_id,photo_created AS created,photo_category AS category,')
            ->from('photo')
            ->get()->row_array();
    }


    /**
     * Handle submission for photo
     *
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function submit()
    {
        if ($this->input->get_post('action') == 'delete_photo') {
            if ($this->input->get_post('id') != '') {
                return $this->delete($this->input->get_post('id'));
            }
        } else if ($this->input->get_post('action') == 'update_photo') {
            if ($this->input->get_post('id') != '') {
                return $this->update($this->session->userdata('user_id'), $this->input->get_post('id'), $_POST);
            }
        } else if ($this->input->get_post('action') == 'add_photo') {
            return $this->insert($this->session->userdata('user_id'), $_POST);
        } else if ($this->input->get_post('action') == 'search_photo' || $this->input->get_post('action') == 'search_photo') {
            return $this->search($this->session->userdata('user_id'));
        }
    }
}
?>
