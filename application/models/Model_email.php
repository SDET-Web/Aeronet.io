<?php
/*
 * Project: Duapa
 * File: Email Model
 * Developer: Rizwan Ali
 * Company: BitsPro
 */
class Model_email extends CI_Model
{
    function send_email($to, $type, $args = array(), $skin = true)
    {
        $this->lang->load('email', 'english');
        $email = $this->lang->line($type);
        foreach ($args as $key => $arg) {
            $email['subject'] = str_replace('[[' . $key . ']]', $arg, $email['subject']);
            $email['body'] = str_replace('[[' . $key . ']]', $arg, $email['body']);
        }
        if ($skin == true) {
            $body = $this->email_template('', $email['body']);
        } else {
            $body = $email['body'];
        }
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From: admin@aeronet.io' . "\r\n";
        $headers .= 'Cc: admin@aeronet.io' . "\r\n";
        mail($to, $email['subject'], $body, $headers);
    }

    function send_emails($to, $type, $args = array(), $skin = true)
    {
        $this->lang->load('email', 'english');
        $email = $this->lang->line($type);
        foreach ($args as $key => $arg) {
            $email['subject'] = str_replace('[[' . $key . ']]', $arg, $email['subject']);
            $email['body'] = str_replace('[[' . $key . ']]', $arg, $email['body']);
        }
        if ($skin == true) {
            $body = $this->email_templates('', $email['body']);
        } else {
            $body = $email['body'];
        }
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From: admin@aeronet.io' . "\r\n";
        $headers .= 'Cc: admin@aeronet.io' . "\r\n";
        mail($to, $email['subject'], $body, $headers);
    }

    
    function email_template($name = '', $body)
    {
        return '<html><head></head><table width="626" cellpadding="15" bgcolor="#2a6496" border="0" style="font-family: arial, Helvetica, sans-serif; border-collapse: collapse; text-align: center;">
<tbody><tr><td><center><a href="https://aeronet.io/"> <img src="https://aeronet.io/assets/images/logo.png" border="0" style="display: block;"></a></center>
</td></tr></tbody></table><table width="626" cellpadding="0" bgcolor="#0280af" style="font-family: arial, Helvetica, sans-serif;"><tbody><tr><td><center>
<table border="0" bgcolor="#f2f2f2" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-top-width: 5px; border-top-style: solid; border-top-color:#f0c018;text-align: center;">
<tbody><tr><td width="600" align="center"><center><div style="text-align:left;width:92%;font-family:Arial;font-size:14px;line-height:20px;color:#555;font-weight:500;"><br/>
												     ' . ($name != '' ? 'Hi ' . $name . ',<br />' : '') . '
				' . $body . '
												</div></center><br><br><br><font face="arial" size="2" color="#666666" style="line-height: 1.2;"><strong>Thanks for joining the Aeronet.io community!</strong></font>&nbsp;<br><br>

 </td></tr></tbody></table><br></center></td></tr></tbody></table>
 </div></div></span></body></html>';
    }

    function email_templates($name = '', $body)
    {
        return
            '<html><head></head><table width="626" cellpadding="15" bgcolor="#2a6496" border="0" style="font-family: arial, Helvetica, sans-serif; border-collapse: collapse; text-align: center;">
<tbody><tr><td><center><a href="https://aeronet.io/"> <img src="https://aeronet.io/assets/images/logo.png" border="0" style="display: block;"></a></center>
</td></tr></tbody></table><table width="626" cellpadding="0" bgcolor="#0280af" style="font-family: arial, Helvetica, sans-serif;"><tbody><tr><td><center>
<table border="0" bgcolor="#f2f2f2" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-top-width: 5px; border-top-style: solid; border-top-color:#f0c018;text-align: center;">
<tbody><tr><td width="600" align="center"><center><div style="text-align:left;width:92%;font-family:Arial;font-size:14px;line-height:20px;color:#555;font-weight:500;"><br/>
												     ' . $body . '
												</div></center><br><br><br><font face="arial" size="2" color="#666666" style="line-height: 1.2;"><strong>Thanks for joining the Aeronet.io community!</strong></font>&nbsp;<br><br>

 </td></tr></tbody></table><br></center></td></tr></tbody></table>
 </div></div></span></body></html>';
    }
    
    function send_simple($to, $subject, $body)
    {
        $body = $this->email_template('', $body);
        $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
       $headers .= 'From: admin@aeronet.io' . "\r\n";
        mail($to, $subject, $body, $headers);
        
    }


    /* Specific Emails */
    function signup($id = '')
    {
        $email = $this->input->post('userEmail');
        if ($id != '') {
            $id = base64_decode(urldecode($id));
            $email = $this->db->select('user_email')->from('user')->where('user_id', $id)->get()->row()->user_email;
        }
        $url1 = site_url('confirm/' . urlencode(base64_encode($email)));
        $url = '<a href="' . $url1 . '">' . $url1 . '</a>';
        $this->send_email($email, 'email_register', array('URL' => $url));

    }

    function signuppilot($email = '')
    {
        $email = $this->input->post('email');
        $url1 = site_url('confirm/' . urlencode(base64_encode($email)));
        $url = '<a href="' . $url1 . '">' . $url1 . '</a>';
        $this->send_emails($email, 'email_register', array('URL' => $url));

    }

    function register($email)
    {
        $url1 =  site_url('confirm/' . urlencode(base64_encode($email)));
        $url = '<a href="' . $url1 . '">' . $url1 . '</a>';
        $this->send_emails($email, 'email_register', array('URL' => $url));

    }

    function signup_department($id = '')
    {
        $email = $this->input->post('email');
        if ($id != '') {
            $id = base64_decode(urldecode($id));
            $email = $this->db->select('user_email')->from('user')->where('user_id', $id)->get()->row()->user_email;
        }
        $url1 = site_url('confirm/department/' . urlencode(base64_encode($email)));
        $url = '<a href="' . $url1 . '">' . $url1 . '</a>';
        $this->send_emails($email, 'email_register', array('URL' => $url));

    }

    function enquiry($id)
    {
        $this->send_email('admin@aeronet.io,', 'email_verification', array('ID' => $id));
    }

    function forgot($user_name)
    {
        $this->send_email($this->input->post('userEmail'), 'email_reset', array('user_name' => $user_name, 'user_email' => urlencode(base64_encode($this->input->post('userEmail')))));
    }

    function postcard($aircrafts)
    {
        $member = $this->Model_user->get_member($this->session->userdata('user_id'));
        $this->send_email($this->session->userdata('user_email'), 'email_postcard_confirmation', array('USER_NAME' => $this->session->userdata('user_fname') . ' ' . $this->session->userdata('user_lname'), 'POSTCARD_PLAINS' => '<ul>' . $aircrafts . '</ul>'));
        $this->send_email('admin@aeronet.io', 'email_postcard_details', array('UNAME' => $this->session->userdata('user_fname') . ' ' . $this->session->userdata('user_lname'), 'UEMAIL' => $member['user_email'], 'UADD' => $member['user_address'] . ' ' . $member['user_city'] . '<br/>' . $member['user_state'] . ',' . $member['user_zip'], 'UTele' => $member['user_phome'] . '(home)<br />', 'POSTCARD_PLAINS' => '<ul>' . $aircrafts . '</ul>'));
    }

    function quote($body, $email, $name)
    {
        $this->send_email($email . ',admin@aeronet.io', 'email_send_quote', array('USER_NAME' => $name, 'QUOTE' => $body));
//	$this->send_email($email.',sumaira@team.hireexpertprogrammers.com','email_send_quote',array('USER_NAME'=>$name,'QUOTE'=>$body));
    }

    function apply($job, $html)
    {
        $this->send_email('admin@aeronet.io,' . $job->user_email, 'email_job_application', array('USER_NAME' => $job->user_fname . ' ' . $job->user_lname, 'JOB_LINK' => site_url('job/view/' . base64_encode(urlencode($job->job_id))), 'JOB_TITLE' => $job->job_title, 'APP_NAME' => $this->input->post('applyName'), 'APP_EMAIL' => $this->input->post('applyEmail'), 'APP_MESSAGE' => $this->input->post('applyMessage'), 'APP_SUBJECT' => $this->input->post('applySubject'), 'RESUME' => $html), false);
        $this->send_email($this->input->post('applyEmail'), 'email_job_application_thanks', array('USER_NAME' => $this->input->post('applyName')));
    }

    function postjob($job, $html)
    {
        $this->send_email('admin@aeronet.io,' . $job->user_email, 'email_job_post', array('USER_NAME' => $job->user_fname . ' ' . $job->user_lname, 'JOB_LINK' => site_url('job/view/' . base64_encode(urlencode($job->job_id))), 'JOB_TITLE' => $job->job_title), false);
        //$this->send_email($this->input->post('applyEmail'),'email_job_application_thanks',array('USER_NAME'=>$this->input->post('applyName')));
    }

    function order($html)
    {
        $this->send_email('admin@aeronet.io,', 'email_purchase_order', array('USER_NAME' => $this->input->post('firstName') . ' ' . $this->input->post('lastName'), 'ORDER' => $html));
        $this->send_email($this->input->post('applyEmail'), 'email_purchase_order', array('USER_NAME' => $this->input->post('firstName') . ' ' . $this->input->post('lastName'), 'ORDER' => $html));
    }

    function quote_status($job)
    {
        $this->send_email(base64_decode(urldecode($this->input->get('e'))), 'email_application_status', array('USER_NAME' => base64_decode(urldecode($this->input->get('n'))), 'JOB_URL' => site_url('job/detail/' . urlencode(base64_encode($job->job_id))), 'JOB_TITLE' => $job->job_title, 'STATUS' => $this->input->get('action') . 'ed'));
    }

    function contact()
    {
        if ($this->input->post('action') == 'contact') {
            $this->form_validation->set_rules('contactName', 'Name', 'required');
            $this->form_validation->set_rules('contactEmail', 'Email', 'required');
            $this->form_validation->set_rules('contactMessage', 'Message', 'required');

            if ($this->form_validation->run() != FALSE) {
                $this->send_email('admin@aeronet.io,', 'email_contact', array('NAME' => $this->input->post('contactName'), 'PHONE' => $this->input->post('contactPhone'), 'EMAIL' => $this->input->post('contactEmail'), 'MSG' => $this->input->post('contactMessage')));
                push_message($this->lang->line('contact_request'));
            }
        }
    }

    function invitation($user_id)
    {
        /*$member = $this->Model_user->get_member($this->session->userdata('user_id'));*/
        //$this->send_email('admin@aeronet.io','email_postcard_details',array('UNAME'=>$this->session->userdata('user_fname').' '.$this->session->userdata('user_lname'),'UEMAIL'=>$member['user_email'],'UADD'=>$member['user_address'].' '.$member['user_city'].'<br/>'.$member['user_state'].','.$member['user_zip'],'UTele'=>$member['user_phome'].'(home)<br />','POSTCARD_PLAINS'=>'<ul>'.$aircrafts.'</ul>'));
    }

    function following_department($dept_email, $contact_name, $user_id, $user_name)
    {
        $this->send_email($dept_email, 'follow_invitation', array('UNAME' => $contact_name, 'USER_URL' => RIZ_FULL_URL . 'pilot/' . $user_id, 'USER_TITLE' => $user_name));
    }

    function following_pilot($dept_email, $contact_name, $user_id, $user_name)
    {
        $this->send_email($dept_email, 'connection_invitation', array('UNAME' => $contact_name, 'USER_URL' => RIZ_FULL_URL . 'pilot/' . $user_id, 'USER_TITLE' => $user_name));
    }


    function register_invitation($to, $user_name, $contact_name)
    {
        $this->send_email($to, 'email_register_invitation', array('USER_NAME' => $user_name, 'SENDER_NAME' => $contact_name));
    }

    function course_submitted($to, $user_name, $contact_name)
    {
        $this->send_email($to, 'email_register_invitation', array('USER_NAME' => $user_name, 'SENDER_NAME' => $contact_name));
    }

    function apply_free_job($to, $name)
    {
        $body = "https://aeronet.io/pilot/" . $this->session->userdata('user_id') . "/profile";

        $subject = "Got a job application";

        $body = $this->email_template($name, $body);
        /*$this->load->library('email');
        $this->email->from('admin@aeronet.io', 'Aeronet.io');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
*/
        //$headers = "MIME-Version: 1.0" . "\r\n";
        //$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From: admin@aeronet.io' . "\r\n";
        if ($this->session->userdata('user_resume') != '') {
            $headers .= $this->add_attachment(UPLOAD_PATH . 'member/resume/', $this->session->userdata('user_resume'));
        }
        mail($to, $subject, $body, $headers);

    }

    function apply_premium_job($to, $name, $job_id)
    {
        $job_id = urlencode(base64_encode($job_id));
        $user_id = $this->session->userdata('user_id');
        $user_id = urlencode(base64_encode($user_id));
        $body = "https://aeronet.io/job/show_addendum/" . $job_id . "/" . $user_id;

        $subject = "Got a premium job application";

        $body = $this->email_template($name, $body);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From: admin@aeronet.io' . "\r\n";
        if ($this->session->userdata('user_resume') != '') {
            $headers .= $this->add_attachment(UPLOAD_PATH . 'member/resume/', $this->session->userdata('user_resume'));
        }
        mail($to, $subject, $body, $headers);

    }

    function application_addendum_request($to, $name, $applicationId)
    {
        $applicationId = urlencode(base64_encode($applicationId));
        $body = "https://aeronet.io/flight-dispatch-board/addendumCTS/" . $applicationId;

        $subject = "Request for Addendum Answers";

        $body = $this->email_template($name, $body);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From: admin@aeronet.io' . "\r\n";
        mail($to, $subject, $body, $headers);

    }

    function application_accept($to, $name)
    {
        $subject = "Application PIPLE_STEP_ACCEPTED";
        $body = "Your application has been accepted";

        $body = $this->email_template($name, $body);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From: admin@aeronet.io' . "\r\n";
        mail($to, $subject, $body, $headers);

    }

    function application_video_interview_request($to, $name, $applicationId, $questions, $id)
    {
        $applicationId = urlencode(base64_encode($applicationId));
        $body = "Please answer the following questions in a video and upload the video in your Application Tracking System. <br />";
        foreach ($questions as $key => $question) {
            $body .= $question . ' <br />';
        }
        //$body .= "<a href='https://aeronet.io/flight-dispatch-board/video/" . $applicationId.'/'.$id."'> Click Here </a>";

        $subject = "Request for Video Interview";

        $this->Model_message->insert($this->session->userdata("user_id"), $id, $body);
        $body = $this->email_template($name, $body);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From: admin@aeronet.io' . "\r\n";
        mail($to, $subject, $body, $headers);

    }

    function application_background_check_request($to, $name, $applicationId, $form, $id)
    {
        $applicationId = urlencode(base64_encode($applicationId));
        $body = "Please complete the attached form and then upload in your Application Tracking System.";
      //  $body .= "<a href='https://aeronet.io/flight-dispatch-board/background-check/'.$applicationId.'/'.$form'>Upload</a>";

        $subject = "Request for Background Check";

        $this->Model_message->insert($this->session->userdata("user_id"), $id, $body);
        $body = $this->email_template($name, $body);
        $this->send_with_pdf($name, $to, "Request for Background Check", $body, UPLOAD_PATH . 'forms/', select_background_attachment_form($form), select_background_attachment_form($form));
        //$this->send_with_pdf_alt("admin@aeronet.io", "Request for Background Check", UPLOAD_PATH.'forms/', select_background_attachment_form($form));

        /*$headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From: admin@aeronet.io' . "\r\n";
				$headers .= $this->add_attachment(UPLOAD_PATH.'forms/',select_background_attachment_form($form), "application/pdf");
				mail("admin@aeronet.io", $subject, $body, $headers);*/

    }

    function application_rejected($to, $name, $id, $reason, $job) {
      $body = "Your application for '" . $job . "' has been rejected by the posting company with the following reason. <br /><br />" . $reason . "";
      $subject = "Application Rejected";

      $this->Model_message->insert($this->session->userdata("user_id"), $id, $body);
      $body = $this->email_template($name, $body);
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
      $headers .= 'From: admin@aeronet.io' . "\r\n";
      mail("admin@aeronet.io", $subject, $body, $headers);

    }

    function application_accepted($to, $name, $id, $job) {
      $body = "Your application for '" . $job . "' has been accepted by the posting company with the following reason.";
      $subject = "Application Accepted";

      $this->Model_message->insert($this->session->userdata("user_id"), $id, $body);
      $body = $this->email_template($name, $body);
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
      $headers .= 'From: admin@aeronet.io' . "\r\n";
      mail("admin@aeronet.io", $subject, $body, $headers);

    }

    function application_shortlisted($to, $name, $id, $job) {
      $body = "Your application for '" . $job . "' has been shortlisted by the posting company with the following reason.";
      $subject = "Application Shortlisted";

      $this->Model_message->insert($this->session->userdata("user_id"), $id, $body);
      $body = $this->email_template($name, $body);
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
      $headers .= 'From: admin@aeronet.io' . "\r\n";
      mail("admin@aeronet.io", $subject, $body, $headers);

    }

    function send_with_pdf($name, $email, $subject, $mainMessage, $fileatt, $fileattname, $from = 'admin@aeronet.io')
    {
        $to = "$name <$email>";
        $fileatttype = "application/pdf";
        $headers = "From: admin@aeronet.io ";
        //$headers .= 'Cc: admin@aeronet.io' . "\r\n";

        // File
        $file = fopen($fileatt . $fileattname, 'rb');
        $data = fread($file, filesize($fileatt . $fileattname));
        fclose($file);

        // This attaches the file
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
        $headers .= "\nMIME-Version: 1.0\n" .
            "Content-Type: multipart/alternative;\n" .
            " boundary=\"{$mime_boundary}\"";
        $message = "This is a multi-part message in MIME format.\n\n" .
            "-{$mime_boundary}\n" .
            "Content-Type: text/plain; charset=\"iso-8859-1\n" .
            "Content-Transfer-Encoding: 7bit\n\n" .
            $mainMessage . "\n\n" .
            "--{$mime_boundary}\n" .
            "Content-Type: text/html; charset=\"iso-8859-1\n" .
            "Content-Transfer-Encoding: 7bit\n\n" .
            $mainMessage .
            "\n";

        $data = chunk_split(base64_encode($data));
        $message .= "--{$mime_boundary}\n" .
            "Content-Type: {$fileatttype};\n" .
            " name=\"{$fileattname}\"\n" .
            "Content-Disposition: attachment;\n" .
            " filename=\"{$fileattname}\"\n" .
            "Content-Transfer-Encoding: base64\n\n" .
            $data . "\n\n" .
            "-{$mime_boundary}-\n";

        if (mail($to, $subject, $message, $headers)) {

            echo "The email was sent.";

        } else {

            echo "There was an error sending the mail.";

        }

    }


    function add_attachment($path, $file_name, $fileType = '')
    {

        // Read the file content
        $file = $path . $file_name;
        $file_size = filesize($file);
        $handle = fopen($file, "r");
        $content = fread($handle, $file_size);
        fclose($handle);
        $content = chunk_split(base64_encode($content));

        /* Set the email header */
        // Generate a boundary
        $boundary = md5(uniqid(time()));

        // Multipart wraps the Email Content and Attachment
        if ($fileType != '') {
            $header .= "Content-Type: {$fileatttype};\n";
        } else {
            $header .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"" . PHP_EOL;
        }
        $header .= "This is a multi-part message in MIME format." . PHP_EOL;
        $header .= "--" . $boundary . PHP_EOL;

        // Email content
        // Content-type can be text/plain or text/html
        $header .= "Content-type:text/plain; charset=iso-8859-1" . PHP_EOL;
        $header .= "Content-Transfer-Encoding: 7bit" . PHP_EOL . PHP_EOL;
        $header .= "$message" . PHP_EOL;
        $header .= "--" . $boundary . PHP_EOL;

        // Attachment
        // Edit content type for different file extensions
        $header .= "Content-Type: application/xml; name=\"" . $file_name . "\"" . PHP_EOL;
        $header .= "Content-Transfer-Encoding: base64" . PHP_EOL;
        $header .= "Content-Disposition: attachment; filename=\"" . $file_name . "\"" . PHP_EOL . PHP_EOL;
        $header .= $content . PHP_EOL;
        $header .= "--" . $boundary . "--";

        return $header;
    }

}
?>
