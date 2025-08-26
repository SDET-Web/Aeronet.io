<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * The home class is the controller used for handling all requests of front size.
 *
 * @package   controller
 * @version   0.01
 * @since     2016-06-27
 * @author    Rizwan Ali<riz@bitspro.com>
 */

class Home extends CI_Controller
{

    /**
     * Home page
     *
     *
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function index()
    {
        set_title('Welcome');
        $this->load->view('main_home', array('view' => 'front/home'));
    }

    /**
     * FAQ page
     *
     *
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function faq()
    {
        set_title('Frequently Asked Questions');
        $this->load->view('main', array('view' => 'front/faq', 'data' => array('faq' => $this->db->from('faq')->get()->result())));
    }

    /**
     * All rest of static pages from CMS
     *
     *
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function page($url)
    {
        $this->load->model('Model_page');
        $page = $this->Model_page->get($url);
        if (count($page) > 0) {
            set_title($page['title']);
            $this->load->view('main', array('view' => 'front/' . $url, 'data' => $page));
        } else {
            set_title('404');
            $this->load->view('main', array('view' => 'front/notfound'));
        }
    }


    /**
     * Contact
     *
     *
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */

    public function contact()
    {
        set_title('Contact Us');
        $this->load->model('Model_email');
        $this->Model_email->contact();
        $this->load->view('main', array('view' => 'front/contact'));
    }


    /**
     * news
     *
     *
     *
     * @since   2017-03-15
     * @author  Rizwan Ali<riz@bitspro.com>
     */

    public function pilot_recruitment()
    {
        set_title('Pilot Recruitment');
        $this->load->view('main', array('view' => 'front/pilot_recruitment'));


    }

    /**
     * forums
     *
     *
     *
     * @since   2017-03-15
     * @author  Rizwan Ali<riz@bitspro.com>
     */

    public function forum()
    {
        set_title('Accredited Forums');
        $this->load->view('main', array('view' => 'front/forum'));


    }

    public function blogs()
    {
        set_title('Skywriter Blogs');
        $this->load->view('main', array('view' => 'front/blogs'));


    }


    /**
     * recruit
     *
     *
     *
     * @since   2017-03-15
     * @author  Rizwan Ali<riz@bitspro.com>
     */

    public function recruit()
    {
        set_title('Recruitment');
        $this->load->view('main', array('view' => 'front/recruit'));


    }

    /**
     * screen
     *
     *
     *
     * @since   2017-03-15
     * @author  Rizwan Ali<riz@bitspro.com>
     */

    public function screen()
    {
        set_title('Screen');
        $this->load->view('main', array('view' => 'front/screen'));


    }


    /**
     * interview
     *
     *
     *
     * @since   2017-03-15
     * @author  Rizwan Ali<riz@bitspro.com>
     */

    public function interview()
    {
        set_title('Interview');
        $this->load->view('main', array('view' => 'front/interview'));


    }


    /**
     * onboard
     *
     *
     *
     * @since   2017-03-15
     * @author  Rizwan Ali<riz@bitspro.com>
     */

    public function onboard()
    {
        set_title('Onboard');
        $this->load->view('main', array('view' => 'front/onboard'));


    }

    public function jobpost()
    {
        set_title('One Post Multiple Jobs Board ');
        $this->load->view('main', array('view' => 'front/jobpost'));


    }

    public function emptest()
    {
        set_title('Pre-Employment Assessment Testing');
        $this->load->view('main', array('view' => 'front/emptest'));


    }

    public function eeoc()
    {
        set_title('Equal Employment Opportunities Commission');
        $this->load->view('main', array('view' => 'front/eeoc'));


    }

    public function salary()
    {
        set_title('Salary Navigator');
        $this->load->view('main', array('view' => 'front/salary'));


    }
 public function contract()
    {
        set_title('Contract Crew');
        $this->load->view('main', array('view' => 'front/contract'));


    }
    public function contractTrip()
    {
        set_title('Contract Trips');
        $this->load->view('main', array('view' => 'front/contractTrip'));


    }

    public function pricing()
    {
        set_title('Pricing');
        $this->load->view('main', array('view' => 'front/pricing'));


    }


    /**
     * 404
     *
     *
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */

    public function missing()
    {
        set_title('404');
        $this->load->view('main', array('view' => 'front/notfound'));


    }

    /**
     * Sitemap
     *
     * @param $type => which can be xml or empty
     *
     * @since   2016-06-27
     * @author  Rizwan Ali<riz@bitspro.com>
     */
    public function sitemap($type = '')
    {
        $this->load->model('Model_page');
        set_title('Sitemap');
        $route = array();
        $data = array();
        $pages = $this->Model_page->browse();
        if ($pages['total'] > 0) {
            foreach ($pages['data'] as $page) {
                $data[$page['title']] = RIZ_FULL_URL . $page['url'];
            }
        }
        include(APPPATH . 'config/routes.php');
        foreach ($route as $url => $path) {
            if ($url != 'default_controller' && $url != '404_override' && $url != 'logout' && $url != 'translate_uri_dashes' && strpos($url, '(:any)') === FALSE) {
                $data[str_replace('/', ' ', ucfirst($url))] = RIZ_FULL_URL . $url;
            }

        }
        if ($type == 'xml') {
            $this->load->view('front/sitemap_xml', array('data' => $data));
        } else {
            $this->load->view('main', array('view' => 'front/sitemap', 'data' => $data));
        }
    }

}