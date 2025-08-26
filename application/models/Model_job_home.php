<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_job extends CI_Model
{

    /*
     * Job Board / List
     */

    function browse($render = true, $is_owner = false)
    {

        if ($this->input->get('page') != '') {
            $page = 20 * ($this->input->get('page') - 1);
            $this->db->limit(20, $page);
        } else {
            $this->db->limit(20);
        }
        if ($is_owner == false) {
            $this->db->where('job_status', 'p');
        }
        $this->db->order_by('job_id desc');
        $rs = $this->db->select('job_status, (select id from airports where LETTER_3 = job_location limit 1) as air_id, job_location, (select count(app_id) from job_application where job_application.job_id = job.job_id limit 1) as app_count,(SELECT manufacturer FROM manufacturer where maker_id = job_make limit 1) as job_make, job_nnumber, job_id, job_name, (SELECT model FROM models where model_id = job_model limit 1) as job_model, job_created, (select state_name from states where st = job_state limit 1) as state_name')->from('job')->where('job.is_deleted', 'n')->get();

        //set_pager();
        $pager = set_pager_return();
        if ($render) {
            if ($rs->num_rows() > 0) {
                $ret = '';
                $class = 'odd';
                foreach ($rs->result() as $craft) {
                    if ($is_owner) {
                        $ret .= $this->render_dash($craft, $class);
                    } else {
                        $ret .= $this->render($craft, $is_owner, $class);
                    }
                    if ($class == 'odd') {
                        $class = 'even';
                    } else {
                        $class = 'odd';
                    }
                }
                if ($is_owner) {
                    return '<table class="aircraft" style="width:100%"><tr><th>Date</th><th>Make</th><th>Model</th><th>State</th><th>Action</th></tr>' . $ret . '</table>' . $pager;
                } else {
                    return '<table class="aircraft" style="width:100%"><tr><th colspan="2"  style="width:15%">Date</th><th style="width:15%">Make</th><th style="width:15%">Model</th><th style="width:10%">State</th><th style="width:20%">Airport/Work Order</th>' . ($is_owner == true ? '<th>Applications</th>' : '') . '</tr>' . $ret . '</table>' . $pager;
                }
            } else {
                if ($is_owner) {
                    return '<table class="aircraft" style="width:100%"><tr><th>Date</th><th>Make</th><th>Model</th><th>State</th><th>Action</th></tr><tr><td colspan="4">No Job found</td></tr></table>' . $pager;
                } else {
                    return '<table class="aircraft" style="width:100%"><tr><th colspan="2"  style="width:15%">Date</th><th style="width:15%">Make</th><th style="width:15%">Model</th><th style="width:10%">State</th><th style="width:20%">Airport/Work Order</th>' . ($is_owner == true ? '<th>Applications</th>' : '') . '</tr><tr><td colspan="7">No Job found</td></tr></table>' . $pager;
                }
            }
        } else {
            return $rs->result();
        }
    }

    /*
         * Job Board / Application
         */

    function browse_app($render = true, $is_owner = false)
    {

        if ($this->input->get('page') != '') {
            $page = 20 * ($this->input->get('page') - 1);
            $this->db->limit(20, $page);
        } else {
            $this->db->limit(20);
        }

        $rs = $this->db->select('job.user_id as job_owner, (select id from airports where LETTER_3 = job_location limit 1) as air_id, job_location, (select count(app_id) from job_application where job_application.job_id = job.job_id) as app_count,(SELECT manufacturer FROM manufacturer where maker_id = job_make limit 1) as job_make, job_nnumber, job.job_id, job_name, (SELECT model FROM models where model_id = job_model limit 1) as job_model, job_created, (select state_name from states where st = job_state limit 1) as state_name,job_application.*')->from('job_application')->join('job', 'job.job_id = job_application.job_id')->where('job_application.is_deleted', 'n')->get();

        set_pager();
        if ($render) {
            if ($rs->num_rows() > 0) {
                $ret = '';
                foreach ($rs->result() as $craft) {
                    $ret .= $this->render_app($craft, $is_owner);
                }
                return '<table class="aircraft" style="width:100%"><tr><th colspan="2">Job Title</th><th>Applicant Name</th><th>Applicant Email</th><th>Application Subject</th><th>Status</th><th>Submitted</th>' .//($this->session->userdata('user_id') == $craft->job_owner?
                    '<th>Action</th>'//:'')
                    . '</tr>' . $ret . '</table>';
            } else {
                //return '<table class="aircraft" style="width:100%"><tr><th colspan="2">Job Title</th><th>Applicant Name</th><th>Applicant Email</th><th>Application Subject</th><th>Status</th><th>Submitted</th>'.(is_owner()?($this->session->userdata('user_id') == $craft->job_owner?'<th>Action</th>':''):'').'</tr><tr><td colspan="'.(is_owner()?($this->session->userdata('user_id') == $craft->job_owner?'8':'7'):'7').'">No applications submitted</td></tr></table>';
                return '<table class="aircraft" style="width:100%"><tr><th colspan="2">Job Title</th><th>Applicant Name</th><th>Applicant Email</th><th>Application Subject</th><th>Status</th><th>Submitted</th>' .//(is_owner()?
                    '<th>Action</th>'//:'')
                    . '</tr><tr><td colspan="' . (is_owner() ? '8' : '7') . '">No applications submitted</td></tr></table>';
            }
        } else {
            return $rs->result();
        }
    }

    /*
     * Job Board / Render
     */

    function render($job, $is_owner, $class = 'odd')
    {
        $is_new = false;
        $diff_time = time() - $job->job_created;
        if ($diff_time <= 24 * 60 * 60 * 15) {
            $is_new = true;
        }
        return '<tr><td class="' . $class . '">' . ($is_new == true ? '<img src="' . RIZ_SKIN . 'pic/icon/new.png" />' : '<div class="height-32">&nbsp;</div>') . '</td><td class="' . $class . '">' . date(RIZ_FORMAT, $job->job_created) . '</td><td class="' . $class . '">' . $job->job_make . '</td><td class="' . $class . '">' . $job->job_model . '</td><td class="' . $class . '">' . $job->state_name . '</td><td class="' . $class . '">' . (!is_logged_in() || is_owner() ? (is_owner() ? 'Pilot/Detailers Only' : '<a class="color-darkblue" href="' . site_url('auth/login') . '">Members Only</a>') : '<a class="color-darkblue" href="' . site_url((is_logged_in() ? 'job/detail/' . urlencode(base64_encode($job->job_id)) : 'job')) . '">Additional Info</a>') . '</td>' . ($is_owner == true ? '<td class="' . $class . '">' . $job->app_count . '</td>' : '') . '</tr>';
    }

    /*
     * Job Board / Dashboard Render
     */

    function render_dash($job, $class = 'odd')
    {
        $is_new = false;
        $diff_time = time() - $job->job_created;
        if ($diff_time <= 24 * 60 * 60 * 15) {
            $is_new = true;
        }
        return '<tr><td class="' . $class . '">' . date(RIZ_FORMAT, $job->job_created) . '</td><td class="' . $class . '">' . $job->job_make . '</td><td class="' . $class . '">' . $job->job_model . '</td><td class="' . $class . '">' . $job->state_name . '</td>' ./*<td class="'.$class.'">'.$job->app_count.'</td>*/
            '<td class="' . $class . '"><a class="color-darkblue" href="' . site_url((is_logged_in() ? 'job/detail/' . urlencode(base64_encode($job->job_id)) : 'job')) . '">Details</a> | <a class="color-darkblue" href="?action=delete&id=' . urlencode(base64_encode($job->job_id)) . '">Delete</a>'/* | <a href="?action=close&id='.urlencode(base64_encode($job->job_id)).'&s='.($job->job_status == 'p'?'c':'p').'">'.($job->job_status == 'p'?'Close':'Active').'</a>*/ . '</td></tr>';
    }

    /*
     * Job Board / App Render
     */

    function render_app($job, $is_owner)
    {
        if ($this->session->userdata('user_id') == $job->job_owner) {
            return '<tr><td colspan="2">' . $job->job_make . '-' . $job->job_model . '</td><td>' . $job->app_name . '</td><td>' . $job->app_email . '</td><td>' . $job->app_subject . '</td><td>' . ($job->app_status == 'a' ? 'Pending' : ($job->app_status == 'r' ? 'Rejected' : 'Accepted')) . '</td><td>' . date(RIZ_FORMAT, $job->app_created) . '</td><td><a class="color-darkblue" target="_blank" href="/user/resume_view/' . $job->user_id . '">Resume</a> | <a class="color-darkblue" href="?action=disable&id=' . urlencode(base64_encode($job->app_id)) . '&n=' . urlencode(base64_encode($job->app_name)) . '&e=' . urlencode(base64_encode($job->app_email)) . '&j=' . urlencode(base64_encode($job->job_id)) . '">Delete</a>'
                /*<a href="?action=accept&id='.urlencode(base64_encode($job->app_id)).'&n='.urlencode(base64_encode($job->app_name)).'&e='.urlencode(base64_encode($job->app_email)).'&j='.urlencode(base64_encode($job->job_id)).'">Accept</a> | <a href="?action=reject&id='.urlencode(base64_encode($job->app_id)).'&n='.urlencode(base64_encode($job->app_name)).'&e='.urlencode(base64_encode($job->app_email)).'&j='.urlencode(base64_encode($job->job_id)).'">Reject</a>*/ . '</td></tr>';
        } else {
            return '<tr><td colspan="2">' . $job->job_make . '-' . $job->job_model . '</td><td>' . $job->app_name . '</td><td>' . $job->app_email . '</td><td>' . $job->app_subject . '</td><td>' . ($job->app_status == 'a' ? 'Pending' : ($job->app_status == 'r' ? 'Rejected' : 'Accepted')) . '</td><td>' . date(RIZ_FORMAT, $job->app_created) . '</td><td><a class="color-darkblue" href="?action=deleteapp&id=' . urlencode(base64_encode($job->app_id)) . '">Delete</a>' . '</td></tr>';
        }
    }


    /*
     * Job Board / Get
     */

    function get($id)
    {
        $id = base64_decode(urldecode($id));
        $job = $this->db->select('job.user_id, (select AIRPORT from airports where LETTER_3 = job_location limit 1) as airportz,job_location,(CASE WHEN job_pic<>\'\' THEN CONCAT(\'job/\',job_pic ) ELSE (select CONCAT(\'aircraft/\',aircraftpicture ) from models where model_id = job_model) END) as job_pic, (select id from airports where LETTER_3 = job_location limit 1) as air_id, (select count(app_id) from job_application where job_application.job_id = job.job_id) as app_count,(SELECT manufacturer FROM manufacturer where maker_id = job_make limit 1) as job_make, job_nnumber, job_id, job_name, (SELECT model FROM models where model_id = job_model limit 1) as job_model, job_created, (select state_name from states where st = job_state limit 1) as state_name,  job_directcontact, job_desc, job_options, job_title')->from('job')->where('job_id', $id)->get();
        if ($job->num_rows() > 0) {
            return $job->row();
        } else {
            return false;
        }
    }

    /*
     * Job Board / User
     */

    function my($render = true, $all = false)
    {
        if ($all == false) {
            $this->db->limit(5);
        }
        $this->db->where('job.user_id', $this->session->userdata('user_id'));
        return $this->browse($render, true);
    }

    /*
     * Job Board / User Apps
     */

    function my_app($render = true, $all = false)
    {
        if ($all == false) {
            $this->db->limit(5);
        }
        if (is_owner()) {
            $this->db->where('job.user_id', $this->session->userdata('user_id'));
            $this->db->where('job_application.app_status != ', 'd');
        } else {
            $this->db->where('job_application.user_id', $this->session->userdata('user_id'));
        }
        return $this->browse_app($render, true);
    }

    /*
     * Job App / Single Job
     */

    function job_app($id, $render = true)
    {
        $this->db->where('job.job_id', $id);
        return $this->browse_app($render, true);
    }

    /*
     * Job Board / User Submitted Apps
     */

    function my_submitted_app($render = true, $all = false)
    {
        if ($all == false) {
            $this->db->limit(5);
        }
        $this->db->where('job_application.user_id', $this->session->userdata('user_id'));
        return $this->browse_app($render, true);
    }

    /*
     * Job Board / Search
     */
    function search($render = true)
    {
        return $this->browse($render);
    }


    /*
     * Job Board / Post
     */

    function post()
    {
        if ($this->input->post('action') == 'postJob') {
            $this->form_validation->set_rules('aircraftMake', 'Aircraft Make', 'required');
            $this->form_validation->set_rules('aircraftModel', 'Aircraft Model', 'required');
            $this->form_validation->set_rules('aircraftLocation', 'Aircraft Location', '');
            //$this->form_validation->set_rules('aircraftEmail', 'Email Resumes to', 'required|valid_email');
            //$this->form_validation->set_rules('aircraftDesc', 'Job Description', 'required');
            /*$this->form_validation->set_rules('ownerFName', 'First Name', 'required');
            $this->form_validation->set_rules('ownerLName', 'Last Name', 'required');
            $this->form_validation->set_rules('ownerEmail', 'Contact Email', 'required');
            $this->form_validation->set_rules('ownerNumber', 'Contact Number', 'required');*/
            $this->form_validation->set_rules('state', 'State', 'required');
            if ($this->form_validation->run() == FALSE) {

            } else {
                $config['upload_path'] = realpath($_SERVER['DOCUMENT_ROOT']) . '/skin/upload/job';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';
                $this->load->library('upload', $config);
                $file_pathz = '';
                if (!$this->upload->do_upload('userfile')) {
                } else {
                    $data1 = $this->upload->data();
                    $file_pathz = $data1['file_name'];
                    //print_r($file_path);
                }
                $options = array();
                if ($this->input->post('inCarpet') != '') {
                    $options['inCarpet'] = $this->input->post('inCarpet');
                }
                if ($this->input->post('inLeather') != '') {
                    $options['inLeather'] = $this->input->post('inLeather');
                }
                if ($this->input->post('inTrim') == '1') {
                    $options['inTrim'] = 'Yes';
                }
                if ($this->input->post('inGlass') == '1') {
                    $options['inGlass'] = 'Yes';
                }
                if ($this->input->post('exWet_Wash') == '1') {
                    $options['exWet_Wash'] = 'Yes';
                }
                if ($this->input->post('exDry_Wash') == '1') {
                    $options['exDry_Wash'] = 'Yes';
                }
                if ($this->input->post('exExterior_Paint') != '') {
                    $options['exExterior_Paint'] = $this->input->post('exExterior_Paint');
                }
                if ($this->input->post('exBright_Work') != '') {
                    $options['exBright_Work'] = $this->input->post('exBright_Work');
                }
                if ($this->input->post('exDe-Ice_Boots') != '') {
                    $options['exDe-Ice_Boots'] = $this->input->post('exDe-Ice_Boots');
                }
                if ($this->input->post('exLanding_Gear') != '') {
                    $options['exLanding_Gear'] = $this->input->post('exLanding_Gear');
                }
                if ($this->input->post('exGear_Wells') != '') {
                    $options['exGear_Wells'] = $this->input->post('exGear_Wells');
                }

                $exArray = '';
                $inArray = '';
                $table = '';
                $tamount = 0.00;

                foreach ($_POST as $key => $val) {

                    if ($val != '') {
                        if (substr($key, 0, 2) == 'ex') {
                            $table = 'exterior';
                            $tmp = $this->Model_aircraft->show_field_val($key, $table, $exArray);
                            if (isset($tmp['txt'])) {
                                $tamount += ($tmp['amt'] / $_POST['sharedExpense']);
                            }
                        } else if (substr($key, 0, 2) == 'in') {
                            $table = 'interior';
                            $tmp = $this->Model_aircraft->show_field_val($key, $table, $inArray);
                            if (isset($tmp['txt'])) {
                                $tamount += ($tmp['amt'] / $_POST['sharedExpense']);
                            }
                        }
                    }
                }


                $data['user_id'] = $this->session->userdata('user_id');
                $data['job_make'] = $this->input->post('aircraftMake');
                $data['job_model'] = $this->input->post('aircraftModel');
                $data['job_location'] = $this->input->post('aircraftLocation');
                $data['job_state'] = $this->input->post('state');
                $data['job_pic'] = $file_pathz;
                $data['job_nnumber'] = $tamount;
                $data['job_email'] = $this->input->post('aircraftEmail');
                $data['job_desc'] = $this->input->post('aircraftDesc');
                $data['job_name'] = $this->input->post('ownerFName');
                $data['job_title'] = $this->input->post('ownerLName');
                $data['job_owneremail'] = $this->input->post('ownerEmail');
                $data['job_directcontact'] = $this->input->post('ownerNumber');
                $data['job_options'] = serialize($options);
                $data['job_created'] = time();
                $data['job_status'] = 'p';
                if ($this->input->post('id') == '') {
                    $this->db->insert('job', $data);
                    push_message('Job Posted Successfully');
                    redirect('job/board');
                } else {
                    $this->db->where('job_id', $this->input->post('id'));
                    $this->db->update('job', $data);
                    push_message('Job updated Successfully');
                    redirect('job/board');
                }
            }
        }
    }

    /*
     * Job Board / Apply
     */
    function apply($id)
    {
        if ($this->input->post('action') == 'applyJob') {
            $this->form_validation->set_rules('applyName', 'Your Name', 'required');
            $this->form_validation->set_rules('applySubject', 'Subject', 'required');
            $this->form_validation->set_rules('applyMessage', 'Message', '');
            $this->form_validation->set_rules('applyEmail', 'Your Email Address', 'required|valid_email');
            if ($this->form_validation->run() == FALSE) {

            } else {
                $html = $this->Model_user->get_resume($this->session->userdata('user_id'));
                $data['app_name'] = $this->input->post('applyName');
                $data['app_email'] = $this->input->post('applyEmail');
                $data['app_subject'] = $this->input->post('applySubject');
                $data['app_message'] = $this->input->post('applyMessage');
                $data['job_id'] = $id;
                $data['user_id'] = $this->session->userdata('user_id');
                $data['app_resume_html'] = $html;
                $data['app_created'] = time();
                $this->db->insert('job_application', $data);
                $this->db->join('user', 'user.user_id = job.user_id');
                $this->db->where('job.job_id', $id);
                $jobz = $this->db->from('job')->get();
                $this->Model_email->apply($jobz->row(), $html);
                push_message('Your application has been submitted Sucessfully.');
            }
        }
    }

    public function delete()
    {
        if ($this->input->get('action') == 'delete') {
            $this->db->delete('job', array('job_id' => base64_decode(urldecode($this->input->get('id')))));
            $this->db->delete('job_application', array('job_id' => base64_decode(urldecode($this->input->get('id')))));
            push_message('Job deleted Successfully');
        }
        if ($this->input->get('action') == 'deleteapp') {
            $this->db->delete('job_application', array('app_id' => base64_decode(urldecode($this->input->get('id')))));
            push_message('Application against work order deleted Successfully');
        }

    }

    public function close()
    {
        if ($this->input->get('action') == 'close') {
            $data['job_status'] = $this->input->get('s');
            $this->db->where('job_id', base64_decode(urldecode($this->input->get('id'))));
            $this->db->update('job', $data);
            push_message('Job status changed Successfully');
        }
    }

    public function app_action()
    {
        if ($this->input->get('action') == 'accept' || $this->input->get('action') == 'reject' || $this->input->get('action') == 'disable') {
            $data['app_status'] = 'd';
            $this->db->where('app_id', base64_decode(urldecode($this->input->get('id'))));
            $this->db->update('job_application', $data);
            $job = $this->get($this->input->get('j'));
            $this->Model_email->quote_status($job);
            push_message('Job Application status changed Successfully');
        }
    }
}