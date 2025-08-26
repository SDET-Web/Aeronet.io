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
class Model_post extends CI_Model
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
    function browse($postPage, $postUser = 0, $postStatus = '', $postTerm = '', $postSort = 'post_created', $postOrder = 'desc', $postType = '')
    {
        if ($postUser != 0) {
            // $connections = $this->db->query('select (CASE WHEN user_id = ' . $postUser . ' THEN conn_id ELSE user_id END) as conn_id FROM connection WHERE user_id = ' . $postUser . ' OR conn_id = ' . $postUser);
            // $conns = array_map(function($rec){
            //     return $rec['conn_id'];
            // }, $connections->result_array());
            //   if (count($conns) > 0) {
            //     $this->db->where('post.post_id in (SELECT post_user.post_id FROM post_user WHERE post_user.post_id = post.post_id AND post_user.user_id IN (' . $postUser .')) OR post.user_id = ' . $postUser, '', FALSE);
            //   } else {
            //     $this->db->where('post.user_id', $postUser);
            //   }
            $this->db->where('post.user_id in (select (CASE WHEN user_id = ' . $postUser . ' THEN conn_id ELSE user_id END) FROM connection WHERE user_id = ' . $postUser . ' OR conn_id = ' . $postUser . ' AND conn_status = "a" AND conn_type = "p") OR post.user_id IN (select conn_id FROM connection WHERE user_id = ' . $postUser . ' AND conn_status = "a" AND conn_type = "d") OR post.user_id = ' . $postUser, '' , FALSE);
        }

        if ($postType != '') {
            $this->db->where('post_type', $postType);
        }

        $this->db->order_by('post_created', 'desc');

        if ($postTerm != '') {
            $this->db->like('post_title', $postTerm);
        }

        $this->db->limit(SITE_ROW_COUNT, $postPage * SITE_ROW_COUNT);
        $data = $this->db
            ->select('post_id AS id, post_title as title, (CASE WHEN user.user_type != \'d\' THEN CONCAT(user.user_fname,\' \',user.user_lname) ELSE user.user_company END) AS name, user_image AS image,post.user_id AS user_id,post_type AS type, user_type AS user_type,post_content AS content,post_like as like, post_created AS created')
            ->from('post')
            ->join('user', 'user.user_id = post.user_id')
            ->get()->result_array();
        foreach ($data as $index => $post) {
            $data[$index]['photo'] = '';
            $data[$index]['excerpt'] = substr(strip_tags($post["content"]), 0, 250) . (strlen($post["content"]) > 250 ? "..." : "");
            $data[$index]['comment'] = $this->Model_comment->browse(-1, 0, $post['id']);
            preg_match('/(<img[^>]+>)/i', $post["content"], $matches);
            if (count($matches) > 0) {
                $data[$index]['coverPhoto'] = $matches[0];
            }
            if ($data[$index]['type'] == 'p') {
                $data[$index]['photo'] = $this->Model_comment->Model_photo->browse(-1, trim($post['content']), $post['user_id']);
            }

        }

        $query = $this->db->last_query();
        // print_r($query);exit;

        $query = substr($query, strpos($query, 'FROM'));
        $query = substr($query, 0, strpos($query, 'LIMIT'));

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
    function search($user = 0, $type = '')
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

        if ($this->input->get('type') != '') {
            $type = $this->input->get('type');
        }


        return $this->browse($page, $user, $status, $term, $sort, $order, $type);
    }

    /**
     * Insert a new post based on action variable
     *
     * @param int $postUser
     * @param mixed $input
     *
     * @return int
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function insert($input)
    {
        if ($input["tagged"] == "") {
            $input["tagged"] = [];
        }
        if (!is_array($input["images"])) {
            $input["images"] = [];
        }

        if (isset($input["type"]) && $input["type"] == "f") {
            return $this->insert_flight($input);
        }

        if (isset($input["type"]) && $input["type"] == "r") {
            return $this->insert_flight_manual($input);
        }

        $category = 'Album ' . time();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('content', 'Content', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $content = '';
            if (isset($input['images']) && count($input['images']) > 0) {
                foreach ($input['images'] as $image) {
                    $time = time();
                    $filename = $time . '.jpg';
                    $tmpImg = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                    file_put_contents(UPLOAD_PATH . 'photo/' . $filename, $tmpImg);
                    $data_IMG = array(
                        'photo_path' => $filename,
                        'photo_title' => 'PHOTO',
                        'photo_created' => time(),
                        'user_id' => $input['user_id'],
                        'photo_category' => $category
                    );
                    $this->db->insert('photo', $data_IMG);
                    $input['content'] .= '<img src="' . RIZ_UPLOAD_PHOTO . $filename . '" style="width:100%" />';
                }
            }
            if (isset($input['tagged']) && count($input['tagged']) > 0) {
                $users = $this->db->where_in('user_id', $input['tagged'])->from('user')->get()->result_array();
                $tagged = '';
                if (count($users) > 0) {
                    $tagged = '<div class="tagged">--with ' . $tagged;
                    foreach ($users as $user) {
                        $tagged .= '<a href="' . site_url('pilot/' . $user['user_id']) . '">' . $user['user_fname'] . ' ' . $user['user_lname'] . '</a> ';
                    }

                    $input['content'] = $tagged . '<br /><br /><div class="clearfix"></div>' . $input['content'];
                }
            }

            foreach ($input as $key => $value) {
                if ($key != 'action' && $key != 'images' && $key != 'tagged') {
                    if (strpos($key, 'user_id') !== FALSE) {
                        $data[$key] = $value;
                    } else {
                        $data['post_' . $key] = $value;
                    }
                }
            }
            $data['post_created'] = time();
            $this->db->insert('post', $data);
            $postId = $this->db->insert_id();
            if (isset($input['tagged']) && count($input['tagged']) > 0) {
                foreach ($input['tagged'] as $user) {
                    $data = array(
                        'post_id' => $postId,
                        'user_id' => $user
                    );
                    $this->db->insert('post_user', $data);
                }
            }
            return array('status' => 'success', 'data' => $this->get($this->db->insert_id()), 'input' => $input);
        } else {
            return array('status' => 'error', 'data' => validation_errors(), 'input' => $input);
        }
    }

    /**
     * Update post based on provided variable and data
     *
     * @param int $postUser
     * @param mixed $input
     *
     * @return int
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function update($postUser, $postId, $input)
    {
        $data = $this->get($postId);
        if ($data['user_id'] == $postUser) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_id', 'User_id', 'required');
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('permalink', 'Permalink', 'required');
            $this->form_validation->set_rules('content', 'Content', 'required');
            $this->form_validation->set_rules('photo', 'Photo', 'required');
            $this->form_validation->set_rules('tag', 'Tag', 'required');

            if ($this->form_validation->run() != FALSE) {
                foreach ($input as $key => $value) {
                    if ($key != 'action') {
                        if (strpos($key, 'lastlogin') !== FALSE || strpos($key, 'dob') !== FALSE) {
                            $data['post_' . $key] = strtotime($value);
                        } else {
                            $data['post_' . $key] = ($key == 'password' ? md5($value) : $value);
                        }
                    }
                }

                $this->db->where('post_id', $postId);
                if ($this->db->update('post', $data)) {
                    set_message('post has been updated successfully');
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
     * Delete a particular post
     *
     * @param $postId
     *
     * @return bool
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function delete($postId)
    {
        $post = $this->db->select('post_status')->where('post_id', $postId)->get();
        if ($post->num_rows() > 0) {
            if ($post->row()->post_status == 'd') {
                $this->db->delete('post', array('post_id' => $postId));
                set_message('post has been deleted successfully');
                return true;
            } else {
                set_message('post has been trashed successfully');
                $this->set_status($postId, 'd');
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Get a single post provided the id
     *
     * @param $postId
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function get($postId)
    {
        $this->db->where('post_id', $postId);
        $post = $this->db
            ->select('post_id AS id, post_title as title, user.user_id AS user_id, CONCAT(user.user_fname,\' \',user.user_lname) AS user_name,post_type AS type,post_content AS content,post_created AS created')
            ->from('post')
            ->join('user', 'user.user_id = post.user_id')
            ->get()->row_array();
        $post['comments'] = $this->db
            ->select('comm_id AS id,comment.user_id AS user_id, CONCAT(user.user_fname,\' \',user.user_lname) AS name, user_image AS photo,post_id AS post_id,comm_text AS text,comm_created AS created')
            ->from('comment')
            ->join("user", "user.user_id = comment.user_id")
            ->where('comm_type !=', 'n')
            ->where('post_id', $postId)
            ->get()->result_array();

        return $post;
    }

    /**
     * Update status of post
     *
     * @param $id
     * @param $status
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function set_status($id, $status)
    {
        $data['post_status'] = $status;
        $this->db->where('post_id', $id);
        if ($this->db->update('post', $data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Handle submission for post
     *
     *
     * @return mixed
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    function submit()
    {
        if ($this->input->get_post('action') == 'delete_post') {
            if ($this->input->get_post('id') != '') {
                return $this->delete($this->input->get_post('id'));
            }
        } else if ($this->input->get_post('action') == 'update_post') {
            if ($this->input->get_post('id') != '') {
                return $this->update($this->session->userdata('user_id'), $this->input->get_post('id'), $_POST);
            }
        } else if ($this->input->get_post('action') == 'add_post') {
            return $this->insert($this->session->userdata('user_id'), $_POST);
        } else if ($this->input->get_post('action') == 'status_post') {
            if ($this->input->get_post('id') != '' && $this->input->get_post('status') != '') {
                return $this->set_status($this->input->get_post('id'), $this->input->get_post('status'));
            }
        } else if ($this->input->get_post('action') == 'search_post' || $this->input->get_post('action') == 'search_post') {
            return $this->search($this->session->userdata('user_id'));
        }
    }

    function notification($user_id, $status = '', $limit = 0)
    {
        if ($limit != 0) {
            $this->db->limit($limit);
        }
        if ($status != '') {
            $this->db->where('noti_status', $status);
        }
        return $this->db->select('user.user_id AS user, user.user_image AS image, CONCAT(user.user_fname,\' \',user.user_lname,\' \',activity.activ_text,\' post\') AS text, activ_created AS date, NOW() as c_date, noti_status AS status, noti_id AS id, post.post_id as po_id, activ_entity AS link_type, activ_entity_id AS link_id, post_type AS post_type')
            ->from('notification')
            ->join('activity', 'activity.activ_id = notification.activ_id')
            ->join('user', 'user.user_id = activity.user_id')
            ->join('post', 'post.post_id = activity.activ_entity_id')
            ->where('notification.user_id', $user_id)
            ->order_by('activ_created desc')
            ->get()
            ->result_array();
    }

    function notification_read($id)
    {
        $this->db->where('noti_id', $id);
        $this->db->update('notification', array('noti_status' => 'f'));
    }

    function insert_flight()
    {

        $input = $_POST;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nnumber', 'N-Number', 'required');
        $this->form_validation->set_rules('fdate', 'Flight Date', 'required');
        $this->form_validation->set_rules('flightSelected', 'Selected Flight', 'required');
        //$this->form_validation->set_rules('flightContent', 'Remarks', 'required');

        $errors = array();

        if ($this->form_validation->run() !== FALSE) {

            $time = time();



            $content = '<div class="flightinfo"><h4>' . isset($input["flightContent"]) && $input["flightContent"] !== "" ? $input["flightContent"] : $input["flightContentVFR"] . '</h4>';
            $content .= base64_decode($input["flightHTML"]);
            $content .= '<div id="map-' . $time . '" style="min-height:250px;"><img src="' . $input["flightMAP"] . '" style="max-width: 100%;" /></div><br />';

            $tmpImgMap = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $input["flightMAP"]));
            $mapName = 'map-' . time();
            $title = 'Flight';
            file_put_contents(UPLOAD_PATH . 'photo/' . $mapName . '.jpg', $tmpImgMap);

            $this->load->model('Model_photo');
            $this->Model_photo->insert($this->session->userdata('user_id'), [
              'title' => $title.'Map' ,
              'path' => $mapName . '.jpg',
              'category' => time(),
            ]);



            $images = array();
            
            $video = "";
            $videoThumbnail = "";
            if (isset($input['images']) && count($input['images'])) {
                foreach ($input['images'] as $key => $image) {
                    $_time = time();
                    $filename = $_time . '_' . $key . '_' . '.jpg';
                    $tmpImg = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                    file_put_contents(UPLOAD_PATH . 'photo/' . $filename, $tmpImg);
                    $images[] = array("src" => RIZ_UPLOAD_PHOTO . $filename, "alt" => "Photo");
                    $data = array(
                    'photo_path' => $filename,
                    'photo_title' => "Flight Photo",
                    'photo_created' => time(),
                    'user_id' => $this->session->userdata('user_id'),
                    'photo_category' => time(),
                );
                $this->db->insert('photo', $data);
                }
                if (count($images) != 1) {
                    $content .= '<div id="gallery-' . $time . '"></div>';
                } else {
                    $content .= '<div id="gallery-' . $time . '"><img src="' . $images[0]["src"] . '" style="width: 100%; height: auto;" /></div>';
                }
            }

            if (isset($_FILES["video"]) && $_FILES["video"]["tmp_name"] != "") {
                $config['allowed_types'] = '*';
                $config['upload_path'] = UPLOAD_PATH . 'video/';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('video')) {
                    $errors[] = $this->upload->display_errors();
                } else {
                    $data = $this->upload->data();
                    $video = RIZ_UPLOAD_VIDEO . $data["file_name"];

                    $videoThumbnail = generate_video_thumbnail($data["full_path"]);

                    if ($videoThumbnail == false) {
                        $errors[] = "Unable generate video thumbnail.";
                    } else {
                        $content .= '<div class="video" onclick="videoPopup(\'' . $video . '\',\'' . $videoThumbnail . '\')"><img src="' . $videoThumbnail . '" /></div>';
                    }

                    /*$content .= '<video width="400" controls>
                              <source src="' . $video . '" type="' . $data["file_type"] . '">
                            </video>';*/
                }
            }

            $content .= '
                <div class="clearfix"></div>';
            if (count($images) > 1) {
                $content .= '

                <script>
                    $("#gallery-' . $time . '").imagesGrid({
                        images: ' . json_encode($images) . ',
                        align: true,
                    });
                    ';
            }

            if ($video != "") {
                $content .= '
                ';


                /*'
                    $("#video-' . $time . '").html("");
                    $("#video-' . $time . '").lazyPlayer({
                        theme: "light",
                        scrollAutoplay: true,
                        video: "' . $video . '",
                        poster: "' . $videoThumbnail . '",
                        heading: "' . $input["flightContent"] . '",
                        subheading: "",


                    });';*/
            }
            $content .= '
                </script>
            </div>';


            if (count($errors) <= 0) {

                // print_r($contents);exit;
            
                if ($this->db->insert('post', array(
                    "user_id" => $this->session->userdata('user_id'),
                    "post_content" => $content,
                    "post_created" => time(),
                    "post_type" => "f"
                ))) {

                    push_message('Your flight has been recorded successfully');
                }
            }

        } else {
            $errors = validation_errors();
        }

        if (is_array($errors)) {
            push_message(implode("<br />", $errors), true);
        } elseif ($errors != "") {
            push_message($errors, true);
        }
    }


    public function insert_flight_manual()
    {

        $input = $_POST;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('originLat', 'Origin', 'required');
        $this->form_validation->set_rules('destinationLat', 'Destination', 'required');
        //$this->form_validation->set_rules('flightContentVFR', 'Remarks', 'required');

        $errors = array();

        if ($this->form_validation->run() !== FALSE) {
            $time = time();

            $content = '<div class="flightinfo"><h4>' . $input["flightContentVFR"] . '</h4>';
            $origin = '{"lat": ' . $input["originLat"] . ', "lng": ' . $input["originLng"] . '}';
            $desitnation = '{"lat": ' . $input["destinationLat"] . ', "lng": ' . $input["destinatinoLng"] . '}';
            $content .= '<div id="map' . $time . '" style="min-height:250px;"></div><br />';

            $images = array();
            $video = "";
            $videoThumbnail = "";
            if (isset($input['images']) && count($input['images'])) {
                foreach ($input['images'] as $key => $image) {
                    $_time = time();
                    $filename = $_time . '_' . $key . '_' . '.jpg';
                    $tmpImg = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                    file_put_contents(UPLOAD_PATH . 'photo/' . $filename, $tmpImg);
                    $images[] = array("src" => RIZ_UPLOAD_PHOTO . $filename, "alt" => "Photo");
                    $data = array(
                    'photo_path' => $filename,
                    'photo_title' => "Flight Photo",
                    'photo_created' => time(),
                    'user_id' => $this->session->userdata('user_id'),
                    'photo_category' => time(),
                );
                $this->db->insert('photo', $data);
                }

                if (count($images) != 1) {
                    $content .= '<div id="gallery-' . $time . '"></div>';
                } else {
                    $content .= '<div id="gallery-' . $time . '"><img src="' . $images[0]["src"] . '" style="width: 100%; height: auto;" /></div>';
                }
            }

            if (isset($_FILES["video"]) && $_FILES["video"]["tmp_name"] != "") {
                $config['allowed_types'] = '*';
                $config['upload_path'] = UPLOAD_PATH . 'video/';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('video')) {
                    $errors[] = $this->upload->display_errors();
                } else {
                    $data = $this->upload->data();
                    $video = RIZ_UPLOAD_VIDEO . $data["file_name"];

                    $videoThumbnail = generate_video_thumbnail($data["full_path"]);

                    if ($videoThumbnail == false) {
                        $errors[] = "Unable generate video thumbnail.";
                    } else {
                        $content .= '<div class="video" onclick="videoPopup(\'' . $video . '\',\'' . $videoThumbnail . '\')"><img src="' . $videoThumbnail . '" /></div>';
                    }
                }
            }


            $content .= '
              <div class="clearfix"></div>
              <script>
              $("#gallery-' . $time . '").imagesGrid({
                images: ' . json_encode($images) . ',
                align: true
              });';


            if ($video != "") {
                $content .= '

                ';

                /*'
                    $("#video-' . $time . '").html("");
                    $("#video-' . $time . '").lazyPlayer({
                        theme: "light",
                        scrollAutoplay: true,
                        video: "' . $video . '",
                        poster: "' . $videoThumbnail . '",
                        heading: "' . $input["flightContent"] . '",
                        subheading: ""
                    });';*/
            }

            $content .= '

              var map' . $time . ' = new google.maps.Map(document.getElementById("map' . $time . '"), {
                  zoom: 11,
                  center: ' . $origin . ',
                  mapTypeId: "terrain"
              });

              originPin' . $time . ' = new google.maps.Marker({
                  position: ' . $origin . ',
                  map: map' . $time . '
              });

              destiNationPin' . $time . ' = new google.maps.Marker({
                  position: ' . $desitnation . ',
                  map: map' . $time . '
              });

              var flightPath' . $time . ' = new google.maps.Polyline({
                  path: [
                    ' . $origin . ',
                    ' . $desitnation . '
                  ],
                  geodesic: true,
                  strokeColor: "#FF0000",
                  strokeOpacity: 1.0,
                  strokeWeight: 2
              });

              flightPath' . $time . '.setMap(map' . $time . ');

              var bounds' . $time . ' = new google.maps.LatLngBounds();
              bounds' . $time . '.extend(' . $origin . ');
              bounds' . $time . '.extend(' . $desitnation . ');

              map' . $time . '.setCenter(bounds' . $time . '.getCenter());
              map' . $time . '.fitBounds(bounds' . $time . ');



              </script></div>';

            if (count($errors) <= 0) {


                if ($this->db->insert('post', array(
                    "user_id" => $this->session->userdata('user_id'),
                    "post_content" => $content,
                    "post_created" => time(),
                    "post_type" => "f"
                ))) {

                    push_message('Your flight has been recorded successfully');
                }
            }

        } else {
            $errors = validation_errors();
        }

        if (is_array($errors)) {
            push_message(implode("<br />", $errors), true);
        } elseif ($errors != "") {
            push_message($errors, true);
        }
    }
}
?>
