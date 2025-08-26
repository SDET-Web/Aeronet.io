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
		$headers .= 'From: info@lazy-eights.com' . "\r\n";
		mail($to, $email['subject'], $body, $headers);
	}

	function email_template($name = '', $body)
	{
		return '<html><head></head><table width="626" cellpadding="15" bgcolor="#2a6496" border="0" style="font-family: arial, Helvetica, sans-serif; border-collapse: collapse; text-align: center;">
<tbody><tr><td><center><a href="http://dev.hireexpertprogrammers.com/lazyeight/"> <img src="http://dev.hireexpertprogrammers.com/lazyeight/assets/images/logo.png" border="0" style="display: block;"></a></center>
</td></tr></tbody></table><table width="626" cellpadding="0" bgcolor="#0280af" style="font-family: arial, Helvetica, sans-serif;"><tbody><tr><td><center>
<table border="0" bgcolor="#f2f2f2" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-top-width: 5px; border-top-style: solid; border-top-color:#f0c018;text-align: center;">
<tbody><tr><td width="600" align="center"><center><div style="text-align:left;width:92%;font-family:Arial;font-size:14px;line-height:20px;color:#555;font-weight:500;"><br/>
												     ' . ($name != '' ? 'Hi ' . $name . ',<br />' : '') . '
				' . $body . '
												</div></center><br><br><br><font face="arial" size="2" color="#666666" style="line-height: 1.2;"><strong>Thanks for joining the Lazy-Eights community!</strong></font>&nbsp;<br><br>

 </td></tr></tbody></table><br></center></td></tr></tbody></table>
 </div></div></span></body></html>';
	}

	function course_submitted($to, $USER_NAME, $COURSE_TAKER_ID, $COURSE_TAKER_NAME){
		$this->send_email($to,'course_submitted',array('USER_NAME'=>$USER_NAME,'COURSE_TAKER_ID'=>$COURSE_TAKER_ID,'COURSE_TAKER_NAME'=>$COURSE_TAKER_NAME));
	}

}
?>