<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| Custom Constants
|--------------------------------------------------------------------------
|
|
|
*/
define('RIZ_FULL_URL',						'http://dev.aeronet.io/');
define('RIZ_HOST',						    'https://aeronet.io');
define('RIZ_BASE_URL',					    'http://dev.aeronet.io/');
define('RIZ_BASE_URL_NO_END',               '/aeronet');
define('RIZ_SITE_NAME',						'AeroNet.io');
define('RIZ_SITE_URL',						'/aeronet/');
define('RIZ_SERVER_URL',					'http://dev.aeronet.io/');
define('RIZ_BASE_SERVER_URL',				'http://dev.aeronet.io/');
define('RIZ_ADMIN_URL',					    '/admin/');
define('RIZ_SKIN',						 	'/skin/');
define('RIZ_SUBSCRIPTION_PRICE',		 	'9.95');
define('RIZ_ONE_TIME_PAY_PRICE',		 	'14.99');
define('RIZ_POSTCARD_PRICE',			 	'0.6');
define('RIZ_PAYPAL_ID',		 	 			'Gungurait@hotmail.com');
define('RIZ_UPLOAD_AIRCRAFT',				'/upload/aircraft/');
define('RIZ_UPLOAD_LOGO',				    '/upload/logo/');
define('RIZ_UPLOAD_USER',				    '/upload/member/');
define('RIZ_UPLOAD_PHOTO',				    '/upload/photo/');
define('RIZ_UPLOAD_VIDEO',				    '/upload/video/');
define('RIZ_UPLOAD_VIDEO_THUMB',	        '/upload/video/thumbnail/');
define('RIZ_UPLOAD_NEWS',				    '/upload/news/');
define('RIZ_FORMAT',						'd/M/Y');
define('RIZ_FORMAT_NEW',					'M Y');
define('RIZ_ASSETS',						'/assets/');
define('RIZ_ASSETS_BACKEND',				'/assets/backend/');
define('RIZ_ASSETS_TEMP',					'/assets/temp/');
//define('GOOGLE_API_KEY',					'AIzaSyAqy4Gblj0bHy3CEjuB5wj1EiGwMRL3Pvs');//'AIzaSyBUsPJG-1spCmnW1Wclj6dHZvqYgLWlo2k');
define('GOOGLE_API_KEY',					'AIzaSyB-UIAfzAIMutEcSyQJRAVdry4Si6UAvLI');
define('GOOGLE_BROWSER_API_KEY',			'AIzaSyC_VqeucCE9S0q1prazDdLqdPf5VtxY448');
define('SITE_ROW_COUNT',					50);
define('RIZ_DEEP_PATH',				        '/var/www/dev/html');
define('UPLOAD_PATH',                       str_replace('application','upload',APPPATH));

define('RIZ_AUTH_PAGE','oauth');
define('RIZ_SI_KEY','lic_8f75a29d-98e1-43b4-aee4-06226');
define('RIZ_PAGE_SIZE', 50);

define('URLL',RIZ_BASE_URL);//'http://dev.hireexpertprogrammers.com/aircraft2/');
define('IMG',RIZ_BASE_URL.'assets/images/');
define('CSS',RIZ_BASE_URL.'assets/css/');
define('JS',RIZ_BASE_URL.'assets/js/');
/* End of file constants.php */


define('L8_INSERT_ERROR_WITH_MESSAGE', -2);
define('L8_INSERT_ERROR', -1);
define('L8_JOB_PLAN_FREE', "f");
define('L8_JOB_PLAN_PAID', "p");


define('L8_PLAN_BASIC', 'l8basic');
define('L8_PLAN_PREMIUM', 'l8premium');
define('L8_PLAN_CTS', 'l8cts');
define('L8_PLAN_PREMIUM_CTS', 'l8premiumcts');

define('L8_PLAN_CTS_EXTRA', 26.00);

define('L8_ADDON_RECRUITER', 'r');
define('L8_ADDON_VIDEO', 'v');
define('L8_ADDON_AVIATION', 'a');
define('L8_ADDON_BACKGROUND', 'b');
define('L8_ADDON_MOTOR', 'm');
define('L8_ADDON_CRIMINAL', 'j');
define('L8_ADDON_RESUME', 'c');
define('L8_ADDON_DRIVING', 'd');


define('L8_PIPELINE_STEP_APPLIED', 'a');
define('L8_PIPELINE_STEP_FEEDBACK', 'f');
define('L8_PIPELINE_STEP_QUALIFIED', 'q');
define('L8_PIPELINE_STEP_DISQUALIFIED', 'd');
