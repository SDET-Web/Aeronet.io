<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * The Thumb class is the controller used for TimThumb Library and Image manipulation.
 *
 * @package   controller
 * @version   0.01
 * @since     2015-12-20
 * @author    Rizwan Ali <riz@bitspro.com>
 */
class Thumb extends CI_Controller
{

    /**
     * Generate thumbnail based on provided size and image path in GET
     *
     * @param int $memberId
     */
    public function generate()
    {
        $this->load->library('timthumb');
        $this->timthumb->start();
    }

    /**
     * Allow user to upload photos using DropZone
     *
     * @param $type
     * @param string $extra
     *
     * @return void
     *
     * @since   2015-12-20
     * @author  Rizwan Ali <riz@bitspro.com>
     */
    public function upload($type, $extra = '')
    {
        $config = array();
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
        $file_name = time() . '.' . $ext;

        if ($type == 'document') {
            $file_name = $type . '_' . time();
            $config['file_name'] = $file_name;
        }
        $config['upload_path'] = UPLOAD_PATH . $type . '/';
        $config['allowed_types'] = '*';
        $config['file_name'] = $file_name;
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file') !== False) {
            if ($type == 'photo') {
                $data = array(
                    'photo_path' => $file_name,
                    'photo_title' => preg_replace("/[^a-zA-Z]/", "", str_replace('_', ' ', $name)),
                    'photo_created' => time(),
                    'user_id' => $extra,
                    'photo_category' => $extra
                );
                $this->db->insert('photo', $data);
            }
            echo $file_name;
        } else {
            echo print_r(array('error' => $this->upload->display_errors()));
        }
    }

    public function tmp()
    {
        echo '
        <form action="/thumb/upload/photo/" method="post" enctype="multipart/form-data">
        <input type="file" name="file" />
        <input type="submit" value="test">
        </form>
        
        
        ';
    }
}
