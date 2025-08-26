<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


/* ------------------
 * GLOBAL
* ------------------- */

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* ------------------
 * AUTH
* ------------------- */
$route['register'] = 'Auth/register';
$route['register/pilot'] = 'Auth/register';
$route['register/pilot/(:any)/(:any)'] = 'Auth/register/$1/$2';
$route['register/pilot/(:any)'] = 'Auth/register/$1';
$route['department'] = 'Auth/register_department';
$route['register/department'] = 'Auth/register_department';
$route['register/department/(:any)'] = 'Auth/register_department/$1';
$route['register/department/(:any)/(:any)'] = 'Auth/register_department/$1/$2';
$route['login'] = 'Auth/login';
$route['login/seemless'] = 'Auth/seemless';
$route['forgot'] = 'Auth/forgot';
$route['change'] = 'Auth/change';
$route['confirm/(:any)'] = 'Auth/confirm/$1';
$route['logout'] = 'Auth/logout';

/* ------------------
 * SOCIAL
* ------------------- */
$route['search'] = 'Member/search/u';
$route['search/advanced'] = 'Member/search_advanced';
$route['search/department'] = 'Member/search/d';
$route['search/(:any)'] = 'User/search/$1';
$route['search/invite'] = 'User/invite';




/* ------------------
 * AJAX
* ------------------- */
$route['ajax/department_directory/(:any)'] = 'Ajax/department_directory/$1';
$route['connect/(:any)/(:any)'] = 'Member/follow/$1/$2/p';
$route['follow/(:any)/(:any)'] = 'Member/follow/$1/$2/d';
$route['invite/(:any)/(:any)'] = 'Member/invite/$1/$2/i';
$route['unfollow/(:any)/(:any)'] = 'Member/unfollow/$1/$2';
$route['accept/(:any)/(:any)'] = 'Member/status/$1/$2/a';
$route['decline/(:any)/(:any)'] = 'Member/status/$1/$2/d';

/* ------------------
 * ACTIVITY CENTER
* ------------------- */
$route['post'] = 'Post';
$route['post/add'] = 'Post/add';
$route['post/photo/(:any)'] = 'Post/add_photo/$1';
$route['post/edit/(:any)'] = 'Post/edit/$1';
$route['post/comment'] = 'Post/comment';
$route['post/(:any)'] = 'Post/detail/$1';
$route['post/like/(:any)'] = 'Post/like/$1';
$route['post/notimark/(:any)'] = 'Post/notimark/$1';
$route['post/(:any)'] = 'Post/user/$1';

/* ------------------
 * MESSAGE
* ------------------- */
$route['conversation/mark/(:any)'] = 'Message/mark/$1';
$route['conversation/add/(:any)/(:any)'] = 'Message/add/$1/$2';
$route['conversation/(:any)/(:any)'] = 'Message/conversation/$1/$2';
$route['conversation/(:any)'] = 'Message/chat/$1';
$route['messages/(:any)'] = 'Message/messages/$1';
$route['conversations/(:any)'] = 'Message/conversations/$1';

/* ------------------
 * WORKSPACE
* ------------------- */


/* ------------------
 * MEMBER
* ------------------- */
$route['account'] = 'User/setting';
$route['account/admire'] = 'User/follower';
$route['account/follower'] = 'User/follower';
$route['account/following'] = 'Department/connection/a';
$route['account/invitation'] = 'User/connection/p';
$route['account/connection'] = 'User/connection/a';
$route['account/history'] = 'User/history';
$route['account/activity'] = 'Activity/user';
$route['account/resume'] = 'User/resume';
$route['directory/search'] = 'Member/search_directory';
$route['account/resume/(:any)'] = 'User/resume/$1';

$route['my/posts'] = 'Profile/post';
$route['my/photos'] = 'Profile/photo';
$route['my/profile'] = 'Profile/profile';
$route['my/network'] = 'Profile/friend';
$route['my/departments'] = 'Profile/department';
$route['my/courses'] = 'Profile/course';
$route['courses'] = 'Profile/course_all';
$route['my/invitations'] = 'Profile/invitation';
$route['my/conversations'] = 'Profile/conversation';
$route['my/notifications'] = 'Profile/notification';
$route['my/appliedjobs'] = 'Profile/jobapplied';
$route['my/aircraft'] = 'Profile/aircraft';
$route['my/headhunter'] = 'Profile/headhunter';

$route['my/profile/photo'] = 'Profile/profile_upload_update';
$route['test'] = 'Profile/testque';
$route['headhunter/shortlist/(:any)/(:any)/(:any)/(:any)']= 'CTS/shortlistHeadHunter/$1/$2/$3/$4';
$route['pilot/shortlist/(:any)/(:any)']= 'CTS/shortlistMessage/$1/$2';

//$route['pilot/(:any)'] = 'Profile/post/$1';
//$route['pilot/(:any)'] = 'Profile/post/$1';
$route['pilot/(:any)'] = 'Profile/showpost/$1';
$route['pilot/(:any)/photos'] = 'Profile/photo/$1';
$route['pilot/(:any)/profile'] = 'Profile/profile/$1';
$route['pilot/(:any)/network'] = 'Profile/friend/$1';
$route['pilot/(:any)/departments'] = 'Profile/department/$1';
$route['pilot/(:any)/courses'] = 'Profile/course/$1';
$route['pilot/(:any)/posts'] = 'Profile/post/$1';
//$route['pilot/(:any)/invitations'] = 'Profile/invitation/$1';
//$route['pilot/(:any)/conversations'] = 'Profile/conversation/$1';
//$route['pilot/(:any)/notifications'] = 'Profile/notification/$1';

$route['department/(:any)/photos'] = 'Profile/photo/$1';
//$route['department/(:any)'] = 'Profile/post/$1';
$route['department/(:any)'] = 'Profile/showpost/$1';

$route['department/(:any)/network'] = 'Profile/friend/$1';
$route['department/(:any)/profile'] = 'Profile/profile/$1';
$route['department/(:any)/aircraft'] = 'Profile/aircraft/$1';



//$route['department/(:any)/departments'] = 'Profile/department/$1';
//$route['department/(:any)/courses'] = 'Profile/course/$1';
//$route['department/(:any)/invitations'] = 'Profile/invitation/$1';
//$route['department/(:any)/conversations'] = 'Profile/conversation/$1';
//$route['department/(:any)/notifications'] = 'Profile/notification/$1';


$route['dashboard'] = 'Profile/post';
$route['showflight'] = 'Profile/showpost';
$route['setting'] = 'Member/setting';
$route['ResumeUpload'] = 'Member/ResumeUpload';
//$route['department/dashboard'] = 'Department';
$route['notifications'] = 'Profile/notification';
$route['invitation'] = 'Member/invitation';
$route['contact'] = "Home/contact";
$route['faq'] = "Home/faq";
$route['sitemap'] = "Home/sitemap";
$route['sitemap.xml'] = "Home/sitemap/xml";
//$route['flight-dispatch-board'] = "Job/board";
$route['flight-board-subscription/(:any)'] = "Job/subscription/$1";



$route['news'] = 'News/landing';
$route['news/(:any)'] = 'News/single/$1';
$route['news/category/(:any)'] = 'News/category/$1';
$route['skywriter'] = 'News/articles';
$route['skywriter/json'] = 'News/articleJSON';
$route['skywriter/add'] = 'News/articlesAdd';
$route['skywriter/(:any)'] = 'News/article_single/$1';
$route['our-skywriter'] = 'Home/skywriter';

/* ------------------
 * Others
* ------------------- */

$route['doupload/(:any)/(:any)'] = 'Thumb/upload/$1/$2';
//$route['pilot/(:any)'] = 'Member/profile/$1';
//$route['department/(:any)'] = 'Member/profile/$1';
$route['pilot-recruitment'] = 'Home/pilot_recruitment';
$route['forum'] = 'Home/forum';
$route['blogs'] = 'Home/blogs';
$route['recruit'] = 'Home/recruit';
$route['screen'] = 'Home/screen';
$route['interview'] = 'Home/interview';
$route['onboard'] = 'Home/onboard';
$route['salary'] = 'Home/salary';
$route['contract'] = 'Home/contract';
$route['contractTrip'] = 'Home/contractTrip';
$route['pricing'] = 'Home/pricing';
$route['jobpost'] = 'Home/jobpost';
$route['emptest'] = 'Home/emptest';
$route['eeoc'] = 'Home/eeoc';

//Added by Ayesha
$route['job/cts'] = 'JobController/ctslist';
$route['job/cts/(:any)'] = 'JobController/ctslist/$1';
$route['jobs/applied'] = 'Jobs/applied';
$route['job/create'] = 'Job/create';
$route['job/(:any)'] = 'Job/details/$1';
$route['job/(:any)/apply'] = 'Job/application';


$route['flight-dispatch-board/subscribe/(:any)'] = 'JobController/subscribe/$1';
$route['flight-dispatch-board/subscribe/addons/add'] = 'JobController/addon_add';
$route['flight-dispatch-board/subscribe/addons/(:any)'] = 'JobController/addons/$1';
$route['flight-dispatch-board/subscribe'] = 'JobController/subscribe';
$route['flight-dispatch-board/create'] = 'JobController/create';
$route['flight-dispatch-board/create/(:any)'] = 'JobController/create/$1';
$route['flight-dispatch-board/(:any)/addons/(:any)'] = 'JobController/addon/$1/$2';
$route['flight-dispatch-board/detail/(:any)'] = 'JobController/detail/$1';
$route['flight-dispatch-board/jobdetail/(:any)'] = 'JobController/jobdetail/$1';
$route['flight-dispatch-board/delete/(:any)'] = 'JobController/job_delete/$1';
$route['flight-dispatch-board/delete/(:any)/confirm'] = 'JobController/job_delete_confirm/$1';
$route['flight-dispatch-board/apply/(:any)'] = 'JobController/apply/$1';
$route['flight-dispatch-board/addendum/(:any)'] = 'JobController/addendum/$1';

$route['flight-dispatch-board/video/(:any)/(:any)'] = 'CTS/video_upload/$1/$2';
$route['flight-dispatch-board/video/(:any)'] = 'CTS/video_delete/$1';
$route['flight-dispatch-board/background-check/(:any)/(:any)'] = 'CTS/background_upload/$1/$2';
$route['flight-dispatch-board/background-check/(:any)'] = 'CTS/background_delete/$1';
$route['flight-dispatch-board/cancel'] = 'JobController/cancel';
$route['flight-dispatch-board'] = 'JobController/index';

$route['applications/(:any)'] = 'JobController/applications/$1/s';
$route['applications/accept/(:any)/(:any)'] = 'JobController/application_accept/$1/$2';
$route['applications/accept/(:any)/(:any)/confirm'] = 'JobController/application_accept_confirm/$1/$2';
$route['applications/shortlist/(:any)/(:any)'] = 'JobController/application_shortlist/$1/$2';
$route['applications/shortlist/(:any)/(:any)/confirm'] = 'JobController/application_shortlist_confirm/$1/$2';
$route['applications/feedback/(:any)/(:any)'] = 'JobController/application_feedback/$1/$2';
$route['applications/reject/(:any)/(:any)'] = 'CTS/application_reject/$1/$2';
$route['applications/j/reject/(:any)/(:any)'] = 'JobController/application_reject/$1/$2';
$route['applications/disqualify/(:any)/(:any)'] = 'JobController/application_disqualify_confirm/$1/$2';

$route['applications/screening/(:any)/(:any)'] = 'JobController/application_screening/$1/$2';
$route['careers'] = 'CTS/career';
$route['careers/edit'] = 'CTS/careerEdit';
$route['careers/(:any)'] = 'CTS/career/$1';
$route['department/(:any)/career'] = 'CTS/career/$1';
$route['subscription/addon/add/(:any)/(:any)'] = 'CTS/subscription_addon_add/$1/$2';
$route['candidate-tracking/addendum/(:any)/(:any)'] = 'CTS/addendum/$1/$2';
$route['candidate-tracking/shortlist/(:any)/(:any)/confirm'] = 'CTS/shortlist_confirm/$1/$2';
$route['candidate-tracking/shortlist/(:any)/(:any)/confirm/(:any)'] = 'CTS/shortlist_confirm/$1/$2/$3';
$route['candidate-tracking/shortlist/(:any)/(:any)/(:any)'] = 'CTS/shortlist/$1/$2/$3';
$route['candidate-tracking/shortlist/(:any)/(:any)'] = 'CTS/shortlist/$1/$2';
$route['candidate-tracking/screening/(:any)/(:any)'] = 'CTS/screening/$1/$2';
$route['candidate-tracking/screening/(:any)/(:any)/confirm'] = 'CTS/screening_confirm/$1/$2';
$route['candidate-tracking/video/(:any)/(:any)'] = 'CTS/video/$1/$2';
$route['candidate-tracking/video/(:any)/(:any)/confirm'] = 'CTS/video_confirm/$1/$2';
$route['candidate-tracking/background/(:any)/(:any)'] = 'CTS/background/$1/$2';
$route['candidate-tracking/background/(:any)/(:any)/confirm'] = 'CTS/background_confirm/$1/$2';
$route['candidate-tracking/accept/(:any)/(:any)'] = 'CTS/accept/$1/$2';
$route['candidate-tracking/accept/(:any)/(:any)/confirm'] = 'CTS/accept_confirm/$1/$2';
$route['candidate-tracking'] = 'CTS/management';
$route['candidate-tracking/disqualify/temp/(:any)/(:any)'] = 'CTS/application_temp_disqualify_confirm/$1/$2';
$route['candidate-tracking/disqualify/(:any)/(:any)'] = 'CTS/application_disqualify_confirm/$1/$2';
$route['candidate-tracking/reject/(:any)/(:any)'] = 'CTS/application_reject/$1/$2';
$route['candidate-tracking/(:any)'] = 'CTS/management/$1';


$route['profileCalc'] = 'Profile/profileCalc';


$route['oauth'] = 'Member/oauth';
$route['import/contacts/(:any)'] = 'Ajax/process_importing/$1';
$route['(:any)'] = 'Home/page/$1';


/*$route['ftv'] = "home/ftv";
$route['about'] = "home/about";
$route['terms'] = "home/terms";
$route['ftv/thanks'] = "home/thanks";
$route['resume'] = "user/resume";
$route['resume/update'] = "user/resume_update";
//$route['search_resume'] = 'user/resume/search_resume';
$route['resume/view'] = "user/resume_view";

$route['privacy-policy']   = 'home/privacy_policy';
$route['terms'] = 'home/terms';
$route['home/sitemap'] = 'home/sitemaps';
$route['sitemap'] = "home/sitemap";

$route['registerstate'] = 'registerpilots/registerstate';
$route['viewindex'] = 'registerpilots/viewindex';
$route['viewflightregister'] = 'registerpilots/viewflightregister';
$route['viewflightregisternew'] = 'registerpilots/viewflightregisternew';
$route['verifydep'] = 'registerpilots/verifydep';
$route['uploaddb'] = 'registerpilots/uploaddb';*/
