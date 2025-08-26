<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The post class is the controller used for handling all requests of post.
 *
 * @package   controller
 * @version   0.01
 * @since     2016-06-27
 * @author    Rizwan Ali<riz@bitspro.com>
 */
class Post extends CI_Controller
{


    var $user = 0;

    /**
     *
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Model_post');
    }


    /**
     * Search post
     *
     *
     * @return string
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $data = json_encode(array('message' => 'success', 'data' => $this->Model_post->search($this->session->userdata('user_id'))));
        echo render_data($data, $this->input->get('callback'));
    }


    public function user($id)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $data = json_encode(array('message' => 'success', 'data' => $this->Model_post->search($id)));
        echo render_data($data, $this->input->get('callback'));
    }


    /**
     * Details of post
     *
     * @param $id
     *
     * @return string
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function detail($id)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $this->db->where('post_id', $id);
        $data = $this->Model_post->browse(0);
        echo json_encode(array('message' => 'success', 'data' => $data['data'][0]));
    }

    /**
     * Create a New post
     *
     *
     * @return string
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function add()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        //echo render_data(json_encode($this->Model_post->insert(json_decode(file_get_contents('php://input'),true))),$this->input->get('callback'));
        echo render_data(json_encode($this->Model_post->insert($_POST)), $this->input->get('callback'));
    }

    /**
     * Create a New post
     *
     *
     * @return string
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function add_photo($userId)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $album = 'Album ' . time();
        $data = array(
            'user_id' => $userId,
            'post_type' => 'p',
            'post_content' => $album,
            'post_created' => time()
        );

        $this->db->insert('post', $data);
        $id = $this->db->insert_id();
        $this->db->where('user_id', $userId)->where('photo_category', $userId);
        $this->db->update('photo', array('photo_category' => $album));
        echo render_data(json_encode(array('status' => 'success', 'data' => $this->Model_post->get($id))), $this->input->get('callback'));
    }


    /**
     * Edit existing post
     *
     * @param $id
     *
     * @return string
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function edit($id)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        if ($this->Model_post->update($this->user, $_GET)) {
            $data = json_encode(array('message' => 'success', 'data' => $this->get($id)));
        } else {
            if (validation_errors() == '') {
                $data = json_encode(array('message' => 'invalid'));
            } else {
                $data = json_encode(array('message' => 'error', 'data' => validation_errors()));
            }
        }

        echo render_data($data, $this->input->get('callback'));
    }

    /**
     * Delete existing post
     *
     *
     * @return string
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function delete($id)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        if ($this->Model_post->delete($id)) {
            $data = json_encode(array('message' => 'success'));
        } else {
            $data = json_encode(array('message' => 'error'));
        }
        echo render_data($data, $this->input->get('callback'));
    }

    /**
     * Liek add
     *
     *
     * @return string
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function like($id)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        if ($this->db->from('like')->where('user_id', $this->session->userdata('user_id'))->where('post_id', $id)->get()->num_rows() <= 0) {
            $this->db->insert('like', array('like_created' => time(), 'post_id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->query('UPDATE post SET post_like = ' . $this->db->from('like')->where('post_id', $id)->get()->num_rows() . ' WHERE post_id=' . $id);
        }
        echo $this->db->from('like')->where('post_id', $id)->get()->num_rows();
    }

    /**
     * Commit
     *
     *
     * @return string
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function comment()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        echo render_data(json_encode($this->Model_comment->insert($_POST)), $this->input->get('callback'));
    }

    /**
     * Mark notification
     *
     *
     * @return string
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function notimark($id)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $this->db->where('noti_id', $id);
        $this->db->update('notification', array('noti_status' => 'f'));

        $noti = $this->db->from('notification')->join('activity', 'notification.activ_id = activity.activ_id')->where('noti_id', $id)->get()->row_array();

        $this->db->where('post_id', $noti['activ_entity_id']);
        $data = $this->Model_post->browse(0);
        echo json_encode(array('message' => 'success', 'data' => $data['data'][0]));
    }
}
