<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The news class is the controller used for handling all requests of news.
 *
 * @package   controller
 * @version   0.01
 * @since     2016-06-27
 * @author    Rizwan Ali<riz@bitspro.com>
 */
class News extends CI_Controller
{


    var $user = 0;

    /**
     *
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Model_news');
        $this->load->model('Model_message');
        $this->load->model('Model_connection');
    }


    public function landing()
    {
        //is_logged_in_redirect();
        $data = $this->Model_news->search();
        $categories = $this->Model_news->categories();
        set_title("NEWS");
        $this->load->view('main', array('view' => 'news/landing', 'data' => array('data' => $data, 'categories' => $categories)));
    }


    public function single($id)
    {
        if ($this->input->post('action') == 'post-comment') {
            $this->form_validation->set_rules('comment', 'Comment', 'required');
            if ($this->form_validation->run() != FALSE) {
                is_logged_in_redirect();
                $data = array(
                    "user_id" => $this->session->userdata("user_id"),
                    "post_id" => $id,
                    "comm_text" => $this->input->post("comment"),
                    "comm_type" => "n",
                    "comm_created" => time()
                );
                $this->db->insert("comment", $data);
                push_message("Comment was posted successfully.");
            } else {
                push_message(validation_errors(), true);
            }
        }


        $data = $this->Model_news->get($id);
        set_title($data["title"]);
        $this->load->view('main', array('view' => 'news/single', 'data' => array('post' => $data)));
    }

    public function articles()
    {
        is_logged_in_redirect();

        if ($this->input->post("action") == "post-article") {
            $this->db->insert(
                "post",
                array(
                    "post_type" => "a",
                    "post_title" => $this->input->post("title"),
                    "post_content" => $this->input->post("content"),
                    "post_created" => time(),
                    "user_id" => $this->session->userdata("user_id")
                )
            );
        }

        $data = $this->Model_news->search();
        $categories = $this->Model_news->categories();
        set_title("NEWS");
        $this->load->view('main_backend', array('view' => 'skywriter/landing', 'data' => array('data' => $data, 'categories' => $categories)));
    }

    public function articlesAdd()
    {
        is_logged_in_redirect();

        if ($this->input->post("action") == "post-article") {
            $this->db->insert(
                "post",
                array(
                    "post_type" => "a",
                    "post_title" => $this->input->post("title"),
                    "post_content" => $this->input->post("content"),
                    "post_created" => time(),
                    "user_id" => $this->session->userdata("user_id")
                )
            );
            push_message("Article has be created successfully");
            redirect('/skywriter');

        }

        $data = $this->Model_news->search();
        $categories = $this->Model_news->categories();
        set_title("NEWS");
        $this->load->view('main_backend', array('view' => 'skywriter/add', 'data' => array('data' => $data, 'categories' => $categories)));
    }

    public function articleJSON()
    {

        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $data = json_encode(array('message' => 'success', 'data' => $this->Model_post->search(0, 'a')));
        echo render_data($data, $this->input->get('callback'));
    }

    public function article_single($id)
    {

        if ($this->input->post('action') == 'post-comment') {
            $this->form_validation->set_rules('comment', 'Comment', 'required');
            if ($this->form_validation->run() != FALSE) {
                $data = array(
                    "user_id" => $this->session->userdata("user_id"),
                    "post_id" => $id,
                    "comm_text" => $this->input->post("comment"),
                    "comm_created" => time()
                );
                $this->db->insert("comment", $data);
                push_message("Comment was posted successfully.");
            } else {
                push_message(validation_errors(), true);
            }
        }

        is_logged_in_redirect();
        $data = $this->Model_post->get($id);
        set_title($data["title"]);
        $this->load->view('main_backend', array('view' => 'skywriter/single', 'data' => array('post' => $data)));
    }


    /**
     * cateogry news
     *
     *
     * @return string
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function category($id)
    {
        is_logged_in_redirect();
        $data = $this->Model_news->search($id);
        set_title($id);
        $this->load->view('main_backend', array('view' => 'news/landing', 'data' => array('data' => $data, 'category' => $id)));
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
        $this->db->where('post_id', $id);
        $data = $this->Model_post->browse(0);
        echo json_encode(array('message' => 'success', 'data' => $data['data'][0]));
    }
}