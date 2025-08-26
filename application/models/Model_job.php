<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_job extends CI_Model
{

    /*
     * Job Board / List
     */

    function browse($render = true, $is_owner = false, $type = 's')
    {

        if ($this->input->get('page') != '') {
            $page = 40 * ($this->input->get('page') - 1);
            $this->db->limit(40, $page);
        } else {
            $this->db->limit(40);
        }
        if ($is_owner == false) {
            $this->db->where('job_status', 'p');
        }
        if ($type != '') {
            $this->db->where('job_type', $type);
        }
        $this->db->order_by('job_id desc');

        $current_time = time();
        $iSecsInDay = 86400;
        $iTotalDays = 30;
        $thirty_days = $current_time - ($iSecsInDay * $iTotalDays);

        // $rs = $this->db->select('job_status, (select id from directory_airports where LETTER_3 = job_location limit 1) as air_id, job_location, (select count(app_id) from job_application where job_application.job_id = job.job_id limit 1) as app_count,(SELECT manufacturer FROM directory_manufacturer where maker_id = job_make limit 1) as job_make, job_nnumber, job_id, job_name, (SELECT model FROM directory_models where model_id = job_model limit 1) as job_model, job_created, job_open, (select state_name FROM directory_states where st = job_state limit 1) as state_name')->from('job')->where('job.is_deleted','n')->where('job_created >',$thirty_days)->get();
        $rs = $this->db->select('job_status, (select id from directory_airports where LETTER_3 = job_location limit 1) as air_id, job_location, (select count(app_id) from job_application where job_application.job_id = job.job_id limit 1) as app_count, job_make, job_type, job_nnumber, job_id, job_name, job_model, job_created, job_open, (select state_name FROM directory_states where st = job_state limit 1) as state_name')->from('job')->where('job.is_deleted', 'n')->where('job_created >', $thirty_days)->get();
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
                    return '<table class="table-fill" style="width:100%"><tr><th>Date Posted</th><th>Make</th><th>Model</th><th>State</th><th>Action</th></tr>' . $ret . '</table>' . $pager;
                } else {
                    return '<table class="table-fill" style="width:100%"><tr><th>Date Posted</th><th>Make</th><th>Model</th><th>State</th><th> </th>' . ($is_owner == true ? '<th>Applications</th>' : '') . '</tr>' . $ret . '</table>' . $pager;
                }
            } else {
                if ($is_owner) {
                    return '<table class="table-fill" style="width:100%"><tr><th>Date Posted</th><th>Make</th><th>Model</th><th>State</th><th>Action</th></tr><tr><td colspan="4">No Job found</td></tr></table>' . $pager;
                } else {
                    return '<table class="table-fill" style="width:100%"><tr><th colspan="2">Date Posted</th><th>Make</th><th>Model</th><th>State</th><th> </th>' . ($is_owner == true ? '<th>Applications</th>' : '') . '</tr><tr><td colspan="7">No Job found</td></tr></table>' . $pager;
                }
            }
        } else {
            return $rs->result();
        }
    }


    function browse2($render = true, $is_owner = false)
    {

        if ($this->input->get('page') != '') {
            $page = 500 * ($this->input->get('page') - 1);
            $this->db->limit(500, $page);
        } else {
            $this->db->limit(500);
        }
        if ($is_owner == false) {
            $this->db->where('job_status', 'p');
        }
        $this->db->order_by('job_id desc');
        $rs = $this->db->select('job_status, (select id from directory_airports where LETTER_3 = job_location limit 1) as air_id, job_location, (select count(app_id) from job_application where job_application.job_id = job.job_id limit 1) as app_count,(SELECT manufacturer FROM directory_manufacturer where maker_id = job_make limit 1) as job_make, job_nnumber, job_id, job_name, (SELECT model FROM directory_models where model_id = job_model limit 1) as job_model, job_created, job_open, (select state_name FROM directory_states where st = job_state limit 1) as state_name')->from('job')->where('job.is_deleted', 'n')->get();

        //set_pager(); /* for not logged in colspan="2" and for logged in colspan="2"  */
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
                    return '<table class="table-fill" style="width:100%"><tr><th>Date Posted</th><th>Make</th><th>Model</th><th>State</th><th>Action</th></tr>' . $ret . '</table>';
                } else {
                    return '<table class="table-fill scrollTable" ><thead class="fixedHeader"><tr><th style="width:18%">Date Posted</th><th style="width:16%">Make</th><th style="width:20%">Model</th><th style="width:15%">State</th><th style="width:20%"> </th>' . ($is_owner == true ? '<th>Applications</th>' : '') . '</tr></thead><tbody class="scrollContent">' . $ret . '</tbody></table>';
                }
            } else {
                if ($is_owner) {
                    return '<table class="table-fill" style="width:100%"><tr><th>Date Posted</th><th>Make</th><th>Model</th><th>State</th><th>Action</th></tr><tr><td colspan="4">No Job found</td></tr></table>';
                } else {
                    return '<table class="table-fill scrollTable"><thead class="fixedHeader"><tr><th>Date Posted</th><th>Make</th><th>Model</th><th>State</th><th>Flt Info/Contact</th>' . ($is_owner == true ? '<th>Applications</th>' : '') . '</tr></thead><tr><td colspan="7">No Job found</td></tr></table>';
                }
            }
        } else {
            return $rs->result();
        }
    }


    /*
         * Job Board / Application
         */

    function browse_app($render = true, $is_owner = false, $type = 'd')
    {

        if ($this->input->get('page') != '') {
            $page = 40 * ($this->input->get('page') - 1);
            $this->db->limit(40, $page);
        } else {
            $this->db->limit(40);
        }

        if (is_owner()) {
            $this->db->where('jobs.user_id', $this->session->userdata('user_id'));
            $this->db->where('applications.type = ', $type);
        } else {
            $this->db->where('applications.user_id', $this->session->userdata('user_id'));
            $this->db->where('applications.type = ', $type);
        }

        // $rs = $this->db->select('job.user_id as job_owner, (select id from directory_airports where LETTER_3 = job_location limit 1) as air_id, job_location, (select count(app_id) from job_application where job_application.job_id = job.job_id) as app_count,(SELECT manufacturer FROM directory_manufacturer where maker_id = job_make limit 1) as job_make, job_nnumber, job.job_id, job_name, (SELECT model FROM directory_models where model_id = job_model limit 1) as job_model, job_created, job_open, (select state_name FROM directory_states where st = job_state limit 1) as state_name,job_application.*')->from('job_application')->join('job', 'job.job_id = job_application.job_id')->where('job_application.is_deleted', 'n')->get();

        $rs = $this->db->select('applications.*, jobs.target, jobs.state, jobs.title,dir_acftref.mfr, dir_acftref.model, jobs.state,jobs.salary_range, jobs.created as job_created, jobs.user_id as job_user_id' )->from('applications')
        ->join('jobs', 'jobs.id = applications.job_id')
        ->join("user_aircraft", "user_aircraft.air_id = jobs.aircraft_id")
        ->join("dir_master", "user_aircraft.aircraft_id = dir_master.id")
        ->join("dir_acftref", "dir_master.mfr_mdl_code = dir_acftref.code")
        ->where('jobs.is_deleted', 'n')
        ->order_by('job_created', 'desc')
        ->get();
           //print_r($this->db->last_query());

        set_pager();
        if ($render) {
            if($type == 'd') {
                $table = '<table class="table table-striped ATS" >
                <thead class="vd_bg-green vd_white">
                  <tr>
                    <th>#</th>
                    <th>Aircraft (Make - Model)	</th>
                    <th>Job Title	</th>
                    <th>Job Position	</th>
                    <th>Job Type	</th>
                    <th>Submitted	</th>
                    <th>Status</th>
                    <th> </th>
                  </tr>
                </thead>
                <tbody>';
            }
            else {
                $table = '<table class="table table-striped JBoard">
                <thead class="vd_bg-green vd_white">
                  <tr>
                    <th>#</th>
                    <th>Aircraft (Make - Model)	</th>
                    <th>Airport Location	</th>
                    <th>Job Title	</th>
                    <th>Submitted	</th>
                    <th>Status</th>
                    <th> </th>
                  </tr>
                </thead>
                <tbody>';
            }

            if ($rs->num_rows() > 0) {
                $ret = '';
                $indexItm = 1;
                foreach ($rs->result() as $craft) {
                    // echo "<pre>";
                    // print_r($craft);
                    $ret .= $this->render_app($craft, $is_owner, $type, $indexItm++);
                }
                $table .=  $ret . '</tbody></table>';


            } else {
                //return '<table class="table-fill" style="width:100%"><tr><th colspan="2">Job Title</th><th>Applicant Name</th><th>Applicant Email</th><th>Application Subject</th><th>Status</th><th>Submitted</th>'.(is_owner()?($this->session->userdata('user_id') == $craft->job_owner?'<th>Action</th>':''):'').'</tr><tr><td colspan="'.(is_owner()?($this->session->userdata('user_id') == $craft->job_owner?'8':'7'):'7').'">No applications submitted</td></tr></table>';
                $table .=  '<tr><td colspan="' . (is_owner() ? '8' : '7') . '">No applications submitted</td></tr>'. '</tbody></table>';
                // return '<table class="table-fill" style="width:100%"><tr><th colspan="2">Job Title</th><th>Job Type</th><th>Make</th><th>Model</th><th>Message</th><th>Status</th><th>Submitted</th>'
                //     . '</tr><tr><td colspan="' . (is_owner() ? '8' : '7') . '">No applications submitted</td></tr></table>';
            }
            return $table;
        } else {
            return $rs->result();
        }
    }

    /*
     * Job Board / Render
     <!-- <td class="'.$class.'">'.($is_new==true?'<img src="'.RIZ_SKIN.'pic/icon/new.png" />':'<div class="height-32">&nbsp;</div>').'</td>
     */

    function render($job, $is_owner, $class = 'odd')
    {
        $is_new = false;
        $diff_time = time() - $job->job_created;
        if ($diff_time <= 24 * 60 * 60 * 15) {
            $is_new = true;
        }
        return '<tr><td class="' . $class . '">' . date(RIZ_FORMAT, $job->job_created) . '</td><td class="' . $class . '">' . $job->job_make . '</td><td class="' . $class . '">' . $job->job_model . '</td><td class="' . $class . '">' . $job->state_name . '</td><td class="' . $class . '">' . (!is_logged_in() || is_owner() ? (is_owner() ? 'Members Only' : '<a class="color-darkblue" href="' . site_url('auth/login') . '">Members Only</a>') : '<a class="color-darkblue" href="' . site_url((is_logged_in() ? 'job/detail/' . urlencode(base64_encode($job->job_id)) : 'job')) . '">Additional Info</a>') . '</td>' . ($is_owner == true ? '<td class="' . $class . '">' . $job->app_count . '</td>' : '') . '</tr>';
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

    function render_app($job, $is_owner, $type, $indexItm)
    {
         $diff_time = time() - $job->job_created;
         $isJobExpired = !($diff_time <= 365*60*60*24);
        if($this->input->get('action')=='deleteapp'){
            if($isJobExpired){$this->Model_job->deleteApp();}else{push_message('Only Expired Jobs are allowed to delete.');} }
            
        $tr = "";
        if (isset($job->job_owner) && $this->session->userdata('user_id') == $job->job_owner) {

            return '<tr><td colspan="2">' . $job->job_make . '-' . $job->job_model . '</td><td>' . $job->app_name . '</td><td>' . $job->app_email . '</td><td>' . $job->app_subject . '</td><td>' . ($job->app_status == 'a' ? 'Pending' : ($job->app_status == 'r' ? 'Rejected' : 'Accepted')) . '</td><td>' . date(RIZ_FORMAT, $job->app_created) . '</td><td><a class="color-darkblue" target="_blank" href="/user/resume_view/' . $job->user_id . '">Resume</a> | <a class="color-darkblue" href="?action=disable&id=' . urlencode(base64_encode($job->app_id)) . '&n=' . urlencode(base64_encode($job->app_name)) . '&e=' . urlencode(base64_encode($job->app_email)) . '&j=' . urlencode(base64_encode($job->job_id)) . '">Delete</a>'
                /*<a href="?action=accept&id='.urlencode(base64_encode($job->app_id)).'&n='.urlencode(base64_encode($job->app_name)).'&e='.urlencode(base64_encode($job->app_email)).'&j='.urlencode(base64_encode($job->job_id)).'">Accept</a> | <a href="?action=reject&id='.urlencode(base64_encode($job->app_id)).'&n='.urlencode(base64_encode($job->app_name)).'&e='.urlencode(base64_encode($job->app_email)).'&j='.urlencode(base64_encode($job->job_id)).'">Reject</a>*/ . '</td></tr>';
        } else {

           if($type == 'j') {     
            $statusTxt = "";
            if($job->status == 'p'){
                $statusTxt = '<span class="label label-success btn-lg">Active</span>';
                $statusMsg = 'Your Application is under review ';
            }
            else if($job->status == 'f'){
                $statusTxt= '<span class="label label-warning btn-lg">Feedback</span>';
                $statusMsg = 'Feedback after reviewing your application: <br/>' . $job->message;
               // $statusMsg =
            }
            else if($job->status == 'd'){
                $statusTxt = '<span class="label label-danger btn-lg">DisQualified</span>';
                $statusMsg =  !empty($job->message) ? $job->message : 'Sorry to say you are Disqualified';

            }
            else if($job->status == '-'){
                $statusTxt = '<span class="label label-danger btn-lg">Rejected</span>';
                $pipelineReslt = $this->db->select('response')->from('application_pipline')
                        ->where('application_id',$job->id)
                        ->where('response > ', 0)
                        ->get()
                         ->row_array();
                $reason = isset($pipelineReslt['response']) ?  select_disqualify_reason($pipelineReslt['response']) : "";
                $statusMsg =  'Sorry to say your application is Rejected because of the following reason:<br/><b>'. $reason.'</b>';
            }
            else if($job->status == 'q'){
                $statusTxt = '<span class="label label-success btn-lg">Qualified</span>';
                $statusMsg = 'Congratulation you are Qualified for this job';
            }

                if($isJobExpired){
                $statusTxt = '<span class="label label-default btn-lg">Expired</span> ';
                $statusMsg = 'Job has expired you can find more jobs on our jobboard';
            }

            $tr = '<tr>
            <td>'.$indexItm.'</td>
            <td>'.$job->mfr .' '.$job->model.'</td>
            <td class="center">'.$job->state.'</td>
            <td class="center">'.$job->title.'</td>
            <td class="center">' . date(RIZ_FORMAT, $job->created) . '</td>
            <td class="center">
            <div class="pull-right append-icon vd_info-parent">
            <a href="javascript:void(0);"  data-action="click-trigger">
            '. $statusTxt  .'</a>

            <div data-action="click-target" class="vd_mega-menu-content  width-xs-3 width-sm-3  right-xs-3" style="left:-150px;">
            <div class="child-menu">
            <div style="display:inline;float:left; overflow:hidden;width:100%;font-size:14px;padding:10px;white-space: initial;">

            '. $statusMsg . '</div></div></div></div></td>
            <td class="menu-action">
           <a target="_blank" href="'. site_url((is_logged_in() ? 'flight-dispatch-board/detail/' . urlencode(base64_encode($job->job_id)) : 'job')) . '" data-original-title="View original Job Post" data-toggle="tooltip" data-placement="top" class="btn vd_btn vd_bg-grey"> <i class="fa fa-search-plus"> </i> </a>'
            . '<button type="button" data-id="'. urlencode(base64_encode($job->job_id)) . '" class="deleteOption btn vd_btn vd_bg-red" data-original-title="Delete" data-toggle="tooltip" data-placement="top">  <i class="fa fa-times"></i>  </button></td>
          </tr>';
            
        }
        else {

            $statusTxt = "";
            if($job->status == 'p'){
                $statusTxt = '<span class="label label-success btn-lg">Active</span>';
                $statusMsg = 'Your Application is under review ';
            }

            else if($job->status == 'd' || $job->status == '-'){
                $statusTxt = '<span class="label label-danger btn-lg">Rejected</span>';
                $pipelineReslt = $this->db->select('response')->from('application_pipline')
                        ->where('application_id',$job->id)
                        ->where('response > ', 0)
                        ->get()
                         ->row_array();
                $reason = isset($pipelineReslt['response']) ?  select_disqualify_reason($pipelineReslt['response']) : "";
                $statusMsg =  'Sorry to say your application is Rejected because of the following reason:<br/><b>'. $reason.'</b>';
            }
            else if($job->status == 'q'){
                $statusTxt = '<span class="label label-success btn-lg">Qualified</span>';
                $statusMsg = 'Congratulation you are Qualified for this job';
            }
             else if($job->status == 'f'){
                $statusTxt= '<span class="label label-warning btn-lg">Assessment Test</span>';
echo('test test test test '.$job->id .PIPLE_STEP_INTERVIEW_REQUESTED);
                $pipelineAddendumSent = $this->Model_cts->GetPiplineStatus($job->id, PIPLE_STEP_INTERVIEW_REQUESTED);
               $pipelineAddendumAnswered = $this->Model_cts->GetPiplineStatus($job->id, PIPLE_STEP_INTERVIEW_PROVIDED);
                $statusMsg = 'Wait for Addendum Questions to start Assessment Testing Process:
';
                if($pipelineAddendumSent != L8_INSERT_ERROR):
                $applicationId = urlencode(base64_encode($job->job_id));
                $statusMsg = 'Answer the following Addendum Form to complete your Assessment test.<br/><br/>'
                . '<a class="btn vd_btn vd_bg-yellow btn-block" target="_blank" href="'. site_url("flight-dispatch-board/addendum/". $applicationId) .'"> View Addendum Form </a><br/>';
                endif;
                if($pipelineAddendumAnswered != L8_INSERT_ERROR):
                $statusMsg = "Thanks to answer the Addendum Form we will get back to you after reviewing it.<br/>";
                endif;
            }
               else if($job->status == 'v'){
                $statusTxt = '<span class="label label-warning btn-lg">Video Interview</span>';
                $pipelineSent = $this->Model_cts->GetPiplineStatus($job->id, PIPLE_STEP_VIDEO_INTERVIEW_REQUESTED);
                $pipelineAnswered = $this->Model_cts->GetPiplineStatus($job->id, PIPLE_STEP_VIDEO_INTERVIEW_PROVIDED);
                $appQuestions = $this->Model_cts->GetApplicationVideoQuestion($job->id);
                $statusMsg = '<b>Video Interview under process</b><br/>';
               if($pipelineSent != L8_INSERT_ERROR):
                $applicationId = urlencode(base64_encode($job->job_id));
                $i=1; $mesg='Please answer the following questions in a video and upload the recorded video. <br />';
                $mesg .= '<a class="btn vd_btn vd_bg-yellow btn-block" href="'. site_url("flight-dispatch-board/video/". $applicationId.'/'. $job->id) .'" target="_blank"> Upload Video Answers </a>';
                foreach($appQuestions as $question):
                $mesg .= '<br/>'. $i++ .' - ' .$question;
                endforeach;
                endif;
                $statusMsg .= $mesg;
                if($pipelineAnswered != L8_INSERT_ERROR):
                $statusMsg = "Thanks to Upload your Video we will get back to you after reviewing it.<br/>";
                endif;
           }
            else if($job->status == 'b'){
                $statusTxt = '<span class="label label-warning btn-lg">Background Checks</span>';
                $applicationId = urlencode(base64_encode($job->job_id));
                 $statusMsg = ' Find Status';
                 $statusMsg .= '<a class="btn vd_btn vd_bg-yellow btn-block" href="'. site_url("flight-dispatch-board/background-check/". $applicationId.'/'. $job->id) .'" target="_blank"> View Details </a><br/>';
            }
            if($isJobExpired){
                $statusTxt = '<span class="label label-default btn-lg">Expired</span> ';
                $statusMsg = 'Job has expired you can find more jobs on our Job board';
            }

            $jobType = $job->is_fulltime == 'y' ? "Full Time" : "Contract Pilot";
            $jobType .= " ". $job->salary_range;
            $positionsArr = array(
                'p' => "Chief Pilot",
                'c' => "Captain",
                'o' => "Co-Pilot",
                'm' => "Maintenance Technician",
                'a' => "Flight Attendent",
                'd' => "Flight Dispatcher",
            );
            $tr = '<tr>
            <td>'.$indexItm.'</td>
            <td>'.$job->mfr .' '.$job->model.'</td>
            <td class="center">'.$job->title.'</td>
            <td class="center">'.(isset($positionsArr[strtolower($job->target)]) ? $positionsArr[strtolower($job->target)] : "N/A").'</td>
             <td class="center">'.$jobType.'</td>
             <td class="center">' . date(RIZ_FORMAT, $job->created) .'</td>
             <td class="center">

             <div class="pull-right append-icon vd_info-parent">
              <a href="javascript:void(0);"  data-action="click-trigger">
            '. $statusTxt  .'</a>

            <div data-action="click-target" class="vd_mega-menu-content  width-xs-3 width-sm-3  right-xs-3" style="left:-150px;">
            <div class="child-menu">
            <div style="display:inline;float:left; overflow:hidden;width:100%;font-size:14px;padding:10px;white-space: initial;">

            '. $statusMsg . '</div></div></div></div></td>
            <td class="menu-action">
            
                <a target="_blank" href="'. site_url((is_logged_in() ? 'department/' . $job->job_user_id.'/career' : 'job')) . '" data-original-title="View original Job Post" data-toggle="tooltip" data-placement="top" class="btn vd_btn vd_bg-grey"> <i class="fa fa-search-plus"></i> </a>
                <button type="button" data-id="'. urlencode(base64_encode($job->job_id)). '" class="deleteOption btn vd_btn vd_bg-red" data-original-title="Delete" data-toggle="tooltip" data-placement="top"> <i class="fa fa-times"></i>  </button>
                     
            </td>
          </tr>';
        }
          return $tr;
            // return '<tr><td colspan="2"><a class="color-darkblue" href="'. site_url((is_logged_in() ? 'flight-dispatch-board/detail/' . urlencode(base64_encode($job->job_id)) : 'job')) . '">' . $job->title . '</a></td><td>' . ($job->is_fulltime == 'y' ? "Full Time" : "Part Time"). " (". $job->salary_range .")" . '</td><td>' . $job->mfr . '</td><td>' . $job->model . '</td><td>' . $job->message . '</td><td>' . ($job->status == 'p' ? 'Processing' : ($job->status == 'q' ? 'Qualified' : ($job->status == 'f' ? 'Further Processing' : ($job->status == 'r' || $job->status == 'b' ? 'Rejected' : 'N/A')))) . '</td><td>' . date(RIZ_FORMAT, $job->created) . '</td></tr>';
        
          
            }
    }


    /*
     * Job Board / Get
     */

    function get($id)
    {
        $id = base64_decode(urldecode($id));
        $job = $this->db->select('job.user_id, job.job_owneremail as job_owneremail, job.post_category as job_category, job.job_type as job_type,
		(select AIRPORT from directory_airports where LETTER_3 = job_location limit 1) as airportz,job_location,
		(CASE WHEN job_pic<>\'\' THEN CONCAT(\'job/\',job_pic ) ELSE (select CONCAT(\'aircraft/\',aircraftpicture )
		FROM directory_models where model_id = job_model) END) as job_pic, (select id from directory_airports
		where LETTER_3 = job_location limit 1) as air_id, (select count(app_id) from job_application
		where job_application.job_id = job.job_id) as app_count,(SELECT manufacturer FROM directory_manufacturer
		where maker_id = job_make limit 1) as job_make, job_nnumber, job_id, job_name,
		(SELECT model FROM directory_models where model_id = job_model limit 1) as job_model,
		job_created, job_open, (select state_name FROM directory_states where
		st = job_state limit 1) as state_name,  job_directcontact, job_desc, job_requirements,
		job_options, job_title')->from('job')->where('job_id', $id)->get();
        if ($job->num_rows() > 0) {
            return $job->row();
        } else {
            return false;
        }
    }

    function get_addendum($job_id, $user_id)
    {
        $job_id = base64_decode(urldecode($job_id));
        $user_id = base64_decode(urldecode($user_id));
        $job = $this->db->select('*')->from('user_job_addendum')->where('job_id', $job_id)->where('user_id', $user_id)->get();
        if ($job->num_rows() > 0) {
            return $job->row();
        } else {
            return false;
        }
    }

    function get_prev_addendum($user_id)
    {
        $job = $this->db->select('*')->from('user_job_addendum')->where('user_id', $user_id)->order_by('addendum_id', 'DESC')->get();
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

    function my_app($render = true, $type = 'd', $all = false)
    {
        if ($all == false) {
            $this->db->limit(5);
        }

        return $this->browse_app($render, true, $type);
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
    function search($render = true, $type = 's')
    {
        return $this->browse($render, false, $type);
    }

    function search2($render = true)
    {
        return $this->browse2($render);
    }

    function check_subscription()
    {
        $user_id = $this->session->userdata('user_id');

        $current_time = time();

        $rs = $this->db->select('*')->from('user_subscription')->where('user_id', $user_id)->where('expiry_date > ', $current_time)->get();
        return $rs->result();
    }

    function add_subscription($type)
    {
        $user_id = $this->session->userdata('user_id');

        $subscription_time = time();
        $iSecsInDay = 86400;
        $iTotalDays = 30;
        $expiry_time = $subscription_time + ($iSecsInDay * $iTotalDays);

        $data['user_id'] = $user_id;
        $data['subscription_id'] = $type;
        $data['subscription_date'] = $subscription_time;
        $data['expiry_date'] = $expiry_time;

        $result = $this->db->insert('user_subscription', $data);
        return $result;
    }

    /*
     * Job Board / Post
     */

    function post()
    {
        if ($this->input->post('action') == 'postJob') {
            //$this->form_validation->set_rules('aircraftMake', 'Aircraft Make', 'required');
            //$this->form_validation->set_rules('aircraftModel', 'Aircraft Model', 'required');
            //$this->form_validation->set_rules('aircraftLocation', 'Aircraft Location',  '');
            //$this->form_validation->set_rules('aircraftEmail', 'Email Resumes to', 'required|valid_email');
            //$this->form_validation->set_rules('aircraftDesc', 'Job Description', 'required');
            /*$this->form_validation->set_rules('ownerFName', 'First Name', 'required');
            $this->form_validation->set_rules('ownerLName', 'Last Name', 'required');
            $this->form_validation->set_rules('ownerEmail', 'Contact Email', 'required');
            $this->form_validation->set_rules('ownerNumber', 'Contact Number', 'required');*/
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('job_title', 'Job Title', 'required');
            $this->form_validation->set_rules('aircraft_id', 'Aircraft Make and Model', 'required');

            if ($this->form_validation->run() == FALSE) {
                push_message(validation_errors(), true);

            } else {
                $config['upload_path'] = './upload/job/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';
                $this->load->library('upload', $config);

                $file_pathz = '';

                if ($this->upload->do_upload()) {
                    $actual_file = $this->upload->data('orig_name');
                    //$actual_file_type = $this->upload->data('image_type');
                    $file_pathz = $actual_file;
                } else {
                    //echo "Not uploaded";
                    //echo $this->upload->display_errors();
                    //exit();
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

                $aircraft_detail = get_aircraft_detail_by_id($this->input->post('aircraft_id'));

                $data['user_id'] = $this->session->userdata('user_id');
                $data['job_make'] = $aircraft_detail['make'];       // $this->input->post('aircraftMake');
                $data['job_model'] = $aircraft_detail['model'];     // $this->input->post('aircraftModel');
                $data['job_location'] = $this->input->post('aircraftLocation');
                $data['job_state'] = $this->input->post('state');
                $data['job_pic'] = $file_pathz;
                $data['job_nnumber'] = $tamount;
                $data['job_email'] = $this->input->post('aircraftEmail');
                $data['job_desc'] = $this->input->post('aircraftDesc');
                $data['job_name'] = $this->input->post('ownerFName');
                $data['job_title'] = $this->input->post('job_title');
                $data['job_owneremail'] = $this->input->post('ownerEmail');
                $data['job_directcontact'] = $this->input->post('ownerNumber');
                $data['job_options'] = serialize($options);
                $data['job_created'] = time();
                $data['job_open'] = $this->input->post('open');
                $data['job_status'] = 'p';
                $data['post_category'] = $this->input->post('post_category');
                $data['job_requirements'] = $this->input->post('job_requirements');
                $data['job_type'] = $this->input->post('type');

                //print_r($data);exit;
                if ($this->input->post('id') == '') {
                    $this->db->insert('job', $data);
                    //	$this->Model_email->postjob($jobz->row());
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

    public function deleteApp()
    {  
        if ($this->input->get('action') == 'deleteapp') {
           $id = base64_decode(urldecode($this->input->get('id')));
             $this->db->delete("applications", ["applications.user_id" => $this->session->userdata("user_id"), "applications.job_id" => $id]);
             push_message('Application against work order deleted Successfully');
             redirect('my/appliedjobs');      

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

    public function check_applied($job_id)
    {
        $user_id = $this->session->userdata('user_id');
        $rs = $this->db->select('*')->from('user_job_applied')->where('user_id', $user_id)->where('job_id', $job_id)->get();
        if ($rs->num_rows() > 0) {
            return $rs->row();
        } else {
            return false;
        }
    }

    public function send_job_application($job_id)
    {
        $data['user_id'] = $this->session->userdata('user_id');
        $data['job_id'] = $job_id;
        $this->db->insert('user_job_applied', $data);
    }

    public function send_premium_job_application($job_id)
    {


        $data['user_id'] = $this->session->userdata('user_id');
        $data['job_id'] = $job_id;
        $data['cover_letter'] = $this->input->post('coverLetter');
        $data['organization'] = $this->input->post('organization');
        $data['organization_detail'] = $this->input->post('organization_detail');
        $data['interviewed'] = $this->input->post('interviewed');
        $data['interviewed_detail'] = $this->input->post('interviewed_detail');
        $data['employed'] = $this->input->post('employed');
        $data['employed_detail'] = $this->input->post('employed_detail');
        $data['employed_position'] = $this->input->post('employed_position');
        $data['Recommendation'] = $this->input->post('Recommendation');
        $data['Recommendation_detail'] = $this->input->post('Recommendation_detail');
        $data['arrested'] = $this->input->post('arrested');
        $data['arrested_date'] = $this->input->post('arrested_date');
        $data['arrested_charge'] = $this->input->post('arrested_charge');
        $data['arrested_disposition'] = $this->input->post('arrested_disposition');
        $data['job_function'] = $this->input->post('job_function');
        $data['drug_test'] = $this->input->post('drug_test');
        $data['alcohol_test'] = $this->input->post('alcohol_test');
        $data['pre_employment_test'] = $this->input->post('pre_employment_test');
        $data['barred'] = $this->input->post('barred');
        $data['license'] = $this->input->post('license');
        $data['license_explain'] = $this->input->post('license_explain');
        $data['license_nature'] = $this->input->post('license_nature');
        $data['license_date'] = $this->input->post('license_date');
        $data['license_country'] = $this->input->post('license_country');
        $data['license_state'] = $this->input->post('license_state');
        $data['fined'] = $this->input->post('fined');
        $data['fined_explain'] = $this->input->post('fined_explain');
        $data['fined_nature'] = $this->input->post('fined_nature');
        $data['fined_date'] = $this->input->post('fined_date');
        $data['fined_country'] = $this->input->post('fined_country');
        $data['fined_state'] = $this->input->post('fined_state');
        $data['fined_extra'] = $this->input->post('fined_extra');
        $data['involved'] = $this->input->post('involved');
        $data['involved_explain'] = $this->input->post('involved_explain');
        $data['administered'] = $this->input->post('administered');
        $data['administered_explain'] = $this->input->post('administered_explain');
        $data['failed'] = $this->input->post('failed');
        $data['failed_explain'] = $this->input->post('failed_explain');
        $data['checkride'] = $this->input->post('checkride');
        $this->db->insert('user_job_addendum', $data);

        $record['user_id'] = $this->session->userdata('user_id');
        $record['job_id'] = $job_id;
        $this->db->insert('user_job_applied', $record);


    }

}
