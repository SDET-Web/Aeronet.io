<!DOCTYPE html>
<html class="" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="<?php echo RIZ_ASSETS; ?>assets/images/favicon.png" type="image/png">
    <title><?php echo strtoupper($controller); ?> | Lazy-Eights.com ADMIN</title>
    <link href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS; ?>assets/css/style.css" rel="stylesheet"> <!-- MANDATORY -->
    <link href="<?php echo RIZ_ASSETS; ?>assets/css/theme.css" rel="stylesheet"> <!-- MANDATORY -->
    <link href="<?php echo RIZ_ASSETS; ?>assets/css/ui.css" rel="stylesheet"> <!-- MANDATORY -->
    <link href="<?php echo RIZ_ASSETS; ?>assets/plugins/datatables/dataTables.min.css" rel="stylesheet">
    <link href="<?php echo RIZ_ASSETS; ?>assets/plugins/trumbowyg/dist/ui/trumbowyg.css" rel="stylesheet">
    <link href="../builder/page-builder/plugins/slider-pips/jquery-ui-slider-pips.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <link rel="stylesheet" href="<?php echo RIZ_SKIN; ?>uploadify/uploadify.css" type="text/css" media="screen" />

</head>
<!-- LAYOUT: Apply "submenu-hover" class to body element to have sidebar submenu show on mouse hover -->
<!-- LAYOUT: Apply "sidebar-collapsed" class to body element to have collapsed sidebar -->
<!-- LAYOUT: Apply "sidebar-top" class to body element to have sidebar on top of the page -->
<!-- LAYOUT: Apply "sidebar-hover" class to body element to show sidebar only when your mouse is on left / right corner -->
<!-- LAYOUT: Apply "submenu-hover" class to body element to show sidebar submenu on mouse hover -->
<!-- LAYOUT: Apply "fixed-sidebar" class to body to have fixed sidebar -->
<!-- LAYOUT: Apply "fixed-topbar" class to body to have fixed topbar -->
<!-- LAYOUT: Apply "rtl" class to body to put the sidebar on the right side -->
<!-- LAYOUT: Apply "boxed" class to body to have your page with 1200px max width -->
<!-- THEME STYLE: Apply "theme-sdtl" for Sidebar Dark / Topbar Light -->
<!-- THEME STYLE: Apply  "theme sdtd" for Sidebar Dark / Topbar Dark -->
<!-- THEME STYLE: Apply "theme sltd" for Sidebar Light / Topbar Dark -->
<!-- THEME STYLE: Apply "theme sltl" for Sidebar Light / Topbar Light -->
<!-- THEME COLOR: Apply "color-default" for dark color: #2B2E33 -->
<!-- THEME COLOR: Apply "color-primary" for primary color: #319DB5 -->
<!-- THEME COLOR: Apply "color-red" for red color: #C9625F -->
<!-- THEME COLOR: Apply "color-default" for green color: #18A689 -->
<!-- THEME COLOR: Apply "color-default" for orange color: #B66D39 -->
<!-- THEME COLOR: Apply "color-default" for purple color: #6E62B5 -->
<!-- THEME COLOR: Apply "color-default" for blue color: #4A89DC -->
<!-- BEGIN BODY -->
<body class="fixed-topbar sidebar-condensed theme-sdtl submenu-hover color-blue">
<section>
    <!-- BEGIN SIDEBAR -->
    <div class="sidebar">
        <div class="logopanel" style="color: #23527c;">
            <h1><a href="dashboard.html"  style="color: #23527c;">LazyEight</a></h1>
        </div>
        <div class="sidebar-inner">
            <div class="sidebar-top">
                <div class="clearfix">&nbsp;</div>
                <div class="userlogged clearfix">
                    <i class="icon icons-faces-users-01"></i>
                    <div class="user-details">
                        <h4><?php echo $_SESSION['name']; ?></h4>
                    </div>
                </div>
            </div>
            <ul class="nav nav-sidebar">
                <li class="tm nav-active"><a href="<?php echo site_url('user/dashboard'); ?>"><i class="icon-home"></i><span>Dashboard</span></a></li>
                <li class="tm nav-parent">
                    <a href="#"><i class="icon-paper-plane"></i><span>Aircrafts</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="<?php echo site_url('enlist/aircraft'); ?>">Directory</a></li>
                        <li><a href="<?php echo site_url('enlist/maker'); ?>">Aircraft Makes</a></li>
                        <li><a href="<?php echo site_url('enlist/model'); ?>">Aircraft Models</a></li>
                        <li><a href="<?php echo site_url('enlist/airport'); ?>">Airports</a></li>
                    </ul>
                </li>
                <li class="tm nav-parent">
                    <a href="#"><i class="icon-briefcase"></i><span>Departments</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="<?php echo site_url('enlist/department'); ?>">Registered</a></li>
                        <li><a href="<?php echo site_url('enlist/department/directory'); ?>">Directory</a></li>
                        <li><a href="<?php echo site_url('enlist/department/aircraft'); ?>">Aircrafts</a></li>
                    </ul>
                </li>
                <li class="tm nav-parent">
                    <a href="#"><i class="icon-user"></i><span>Pilots</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="<?php echo site_url('enlist/pilot'); ?>">Registered</a></li>
                        <li><a href="<?php echo site_url('enlist/pilot/directory'); ?>">Directory</a></li>
                        <li><a href="<?php echo site_url('enlist/pilot/aircraft'); ?>">Aircrafts</a></li>
                    </ul>
                </li>
                <li class="tm nav-parent">
                    <a href="#"><i class="icon-user"></i><span>Non Pilots</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="<?php echo site_url('enlist/nonpilot'); ?>">Registered</a></li>
                        <li><a href="<?php echo site_url('enlist/nonpilot/directory'); ?>">Directory</a></li>
                    </ul>
                </li>
                <li class="tm nav-parent">
                    <a href="#"><i class="icon-screen-tablet"></i><span>Dispatch Board</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="<?php echo site_url('enlist/job'); ?>">Posted</a></li>
                        <li><a href="<?php echo site_url('enlist/application'); ?>">Applications</a></li>
                    </ul>
                </li>
                <li class="tm">
                    <a href="<?php echo site_url('enlist/news'); ?>"><i class="fa fa-newspaper-o"></i><span>News</span> <span class="fa arrow"></span></a>
                </li>
                <li class="tm nav-parent">
                    <a href="#"><i class="icon-users"></i><span>Community</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="<?php echo site_url('enlist/connection'); ?>">Connections</a></li>
                        <li><a href="<?php echo site_url('enlist/comment'); ?>">Comments</a></li>
                        <li><a href="<?php echo site_url('enlist/message'); ?>">Messages</a></li>
                    </ul>
                </li>
                <li class="tm nav-parent">
                    <a href="#"><i class="icon-share"></i><span>Social Panel</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="<?php echo site_url('enlist/post'); ?>">Posts</a></li>
                        <li><a href="<?php echo site_url('enlist/photo'); ?>">Photos</a></li>
                        <li><a href="<?php echo site_url('enlist/activity'); ?>">Activities</a></li>
                    </ul>
                </li>
                <li class="tm nav-parent">
                    <a href="#"><i class="fa fa-cog"></i><span>Settings</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="<?php echo site_url('enlist/video_questions'); ?>">Video Questions</a></li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-widgets">
                <ul class="folders">
                    <li>
                        <a href="#"><i class="icon-question c-primary"></i><span>FAQ</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-map"></i><span>States</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END SIDEBAR -->
    <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
            <div class="header-left">
                <div class="topnav">
                    <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
                    <ul class="nav nav-icons">
                        <li style="padding: 7px 5px;"><form action="#" method="post" class="searchform" id="search-results">
                                <input type="text" class="form-control" name="keyword" placeholder="Search...">
                            </form></li>
                    </ul>
                </div>

            </div>
            <div class="header-right">
                <ul class="header-menu nav navbar-nav">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <li class="dropdown" id="notifications-header">
                        <a href="<?php echo site_url('import/courses'); ?>">
                            <i class="fa fa-upload"></i>
                        </a>
                        <ul class="dropdown-menu hidden">
                            <li class="dropdown-header clearfix">
                                <p class="pull-left">12 Pending Notifications</p>
                            </li>
                            <li class="hidden">
                                <ul class="dropdown-menu-list withScroll mCustomScrollbar _mCS_1" data-height="220" style="height: 220px;"><div class="mCustomScrollBox mCS-light" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;"><div class="mCSB_container mCS_no_scrollbar" style="position:relative; top:0;">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-star p-r-10 f-18 c-orange"></i>
                                                    Steve have rated your photo
                                                    <span class="dropdown-time">Just now</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-heart p-r-10 f-18 c-red"></i>
                                                    John added you to his favs
                                                    <span class="dropdown-time">15 mins</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-file-text p-r-10 f-18"></i>
                                                    New document available
                                                    <span class="dropdown-time">22 mins</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-picture-o p-r-10 f-18 c-blue"></i>
                                                    New picture added
                                                    <span class="dropdown-time">40 mins</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-bell p-r-10 f-18 c-orange"></i>
                                                    Meeting in 1 hour
                                                    <span class="dropdown-time">1 hour</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-bell p-r-10 f-18"></i>
                                                    Server 5 overloaded
                                                    <span class="dropdown-time">2 hours</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-comment p-r-10 f-18 c-gray"></i>
                                                    Bill comment your post
                                                    <span class="dropdown-time">3 hours</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-picture-o p-r-10 f-18 c-blue"></i>
                                                    New picture added
                                                    <span class="dropdown-time">2 days</span>
                                                </a>
                                            </li>
                                        </div><div class="mCSB_scrollTools" style="position: absolute; display: none;"><div class="mCSB_draggerContainer"><div class="mCSB_dragger" style="position: absolute; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="position:relative;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></ul>
                            </li>
                            <li class="dropdown-footer clearfix">
                                <a href="#" class="pull-left">See all notifications</a>
                                <a href="#" class="pull-right">
                                    <i class="icon-settings"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN MESSAGES DROPDOWN -->
                    <li class="dropdown" id="messages-header">
                        <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-paper-plane"></i>
                <span class="badge badge-primary badge-header">
                8
                </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header clearfix">
                                <p class="pull-left">
                                    You have 8 Messages
                                </p>
                            </li>
                            <li class="dropdown-body">
                                <ul class="dropdown-menu-list withScroll mCustomScrollbar _mCS_2" data-height="220" style="height: 220px;"><div class="mCustomScrollBox mCS-light" id="mCSB_2" style="position:relative; height:100%; overflow:hidden; max-width:100%;"><div class="mCSB_container mCS_no_scrollbar" style="position:relative; top:0;">
                                            <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="<?php echo RIZ_ASSETS; ?>assets/images/avatars/avatar3.png" alt="avatar 3">
                        </span>
                                                <div class="clearfix">
                                                    <div>
                                                        <strong>Alexa Johnson</strong>
                                                        <small class="pull-right text-muted">
                                                            <span class="glyphicon glyphicon-time p-r-5"></span>12 mins ago
                                                        </small>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="<?php echo RIZ_ASSETS; ?>assets/images/avatars/avatar4.png" alt="avatar 4">
                        </span>
                                                <div class="clearfix">
                                                    <div>
                                                        <strong>John Smith</strong>
                                                        <small class="pull-right text-muted">
                                                            <span class="glyphicon glyphicon-time p-r-5"></span>47 mins ago
                                                        </small>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="<?php echo RIZ_ASSETS; ?>assets/images/avatars/avatar5.png" alt="avatar 5">
                        </span>
                                                <div class="clearfix">
                                                    <div>
                                                        <strong>Bobby Brown</strong>
                                                        <small class="pull-right text-muted">
                                                            <span class="glyphicon glyphicon-time p-r-5"></span>1 hour ago
                                                        </small>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="<?php echo RIZ_ASSETS; ?>assets/images/avatars/avatar6.png" alt="avatar 6">
                        </span>
                                                <div class="clearfix">
                                                    <div>
                                                        <strong>James Miller</strong>
                                                        <small class="pull-right text-muted">
                                                            <span class="glyphicon glyphicon-time p-r-5"></span>2 days ago
                                                        </small>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                                </div>
                                            </li>
                                        </div><div class="mCSB_scrollTools" style="position: absolute; display: none;"><div class="mCSB_draggerContainer"><div class="mCSB_dragger" style="position: absolute; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="position:relative;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></ul>
                            </li>
                            <li class="dropdown-footer clearfix">
                                <a href="mailbox.html" class="pull-left">See all messages</a>
                                <a href="#" class="pull-right">
                                    <i class="icon-settings"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END MESSAGES DROPDOWN -->
                    <!-- BEGIN USER DROPDOWN -->
                    <li class="dropdown" id="user-header">
                        <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img src="<?php echo RIZ_ASSETS; ?>assets/images/avatars/user1.png" alt="user image">
                            <span class="username">Hi, <?php echo $_SESSION['name']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><i class="icon-settings"></i><span>Account Settings</span></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('user/logout'); ?>"><i class="icon-logout"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER DROPDOWN -->
                </ul>
            </div>
            <!-- header-right -->
        </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">

            <?php echo (isset($success_msg)?get_message($success_msg):''); ?>
            <div class="header">
                <h2><?php if($controller == 'piolet'){ $controller ='Pilot/Detailers';
                    }else if($controller == 'owner'){ $controller ='Aircraft Owners';
                    }else if($controller == 'order'){ $controller ='Postcard Marketing Orders';
                    }else if($controller == 'product'){ $controller ='Product Line and Orders';
                    }else if($controller == 'product_order'){ $controller ='Product Orders';
                    }else if($controller == 'job '){ $controller ='Jobs Board Postings';
                    }else if($controller == 'quote'){ $controller ='Estimates';
                    }else if($controller == 'application'){ $controller ='Applications Against Work Orders';
                    }else if($controller == 'aircraft'){ $controller ='Aircraft for Marketing Map';
                    }else if($controller == 'airport'){ $controller ='Airports for Marketing Map';
                    }else if($controller == 'maker'){ $controller ='Aircraft Make for Estimates';
                    }else if($controller == 'model'){ $controller ='Aircraft Model for Estimates';
                    }else if($controller == 'exterior'){ $controller ='Exterior Price Guide';
                    }else if($controller == 'interior'){ $controller ='Interior Price Guide';
                    }else if($controller == 'package'){ $controller ='Postcard Price Guide';
                    }else if($controller == 'user'){ $controller ='Users';
                    }else if($controller == 'cms'){ $controller ='CMS';}

                    ?>
                    <?php echo (isset($type)?strtoupper($type):strtoupper($controller)); ?>
                    <article class="breadcrumbs"> <div class="breadcrumb_divider"></div> </article>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li><a href="index.html"><?php echo RIZ_SITE_NAME; ?></a>
                            </li>
                            <li class="active"><?php echo strtoupper($controller); ?></li>
                        </ol>
                    </div>
                </h2>
            </div>
            <?php $this->load->view($view,$data); ?>
            <div class="footer">
                <div class="copyright">
                    <p class="pull-left sm-pull-reset"> <span>Copyright <span class="copyright">©</span> 2014 </span> <span>THEMES LAB</span>. <span>All rights reserved. </span> </p>
                    <p class="pull-right sm-pull-reset"> <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span> </p>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT -->

        <!-- END PAGE CONTENT -->
    </div>
    <!-- END MAIN CONTENT -->
</section>
<!-- Preloader -->
<div class="loader-overlay">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/gsap/main-gsap.min.js"></script> <!-- HTML Animations -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/bootbox/bootbox.min.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom Scrollbar sidebar -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script> <!-- Show Dropdown on Mouseover -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <!-- Animated Progress Bar -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/switchery/switchery.min.js"></script> <!-- IOS Switch -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/retina/retina.min.js"></script>  <!-- Retina Display -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/jquery-cookies/jquery.cookies.js"></script> <!-- Jquery Cookies, for theme -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/bootstrap/js/jasny-bootstrap.min.js"></script> <!-- File Upload and Input Masks -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/select2/select2.min.js"></script> <!-- Select Inputs -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/bootstrap-tags-input/bootstrap-tagsinput.min.js"></script> <!-- Select Inputs -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/bootstrap-loading/lada.min.js"></script> <!-- Buttons Loading State -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/timepicker/jquery-ui-timepicker-addon.min.js"></script> <!-- Time Picker -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/multidatepicker/multidatespicker.min.js"></script> <!-- Multi dates Picker -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/colorpicker/spectrum.min.js"></script> <!-- Color Picker -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script> <!-- A mobile and touch friendly input spinner component for Bootstrap -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/autosize/autosize.min.js"></script> <!-- Textarea autoresize -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/icheck/icheck.min.js"></script> <!-- Icheck -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/bootstrap-editable/js/bootstrap-editable.min.js"></script> <!-- Inline Edition X-editable -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/bootstrap-context-menu/bootstrap-contextmenu.min.js"></script> <!-- File Upload and Input Masks -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/prettify/prettify.min.js"></script> <!-- Show html code -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/slick/slick.min.js"></script> <!-- Slider -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/countup/countUp.min.js"></script> <!-- Animated Counter Number -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/charts-chartjs/Chart.min.js"></script>  <!-- ChartJS Chart -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/bootstrap-slider/bootstrap-slider.js"></script> <!-- Bootstrap Input Slider -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/visible/jquery.visible.min.js"></script> <!-- Visible in Viewport -->
<script src="<?php echo RIZ_ASSETS; ?>assets/js/builder.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/js/sidebar_hover.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/js/application.js"></script> <!-- Main Application Script -->
<script src="<?php echo RIZ_ASSETS; ?>assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
<script src="<?php echo RIZ_ASSETS; ?>assets/js/widgets/notes.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/js/quickview.js"></script> <!-- Quickview Script -->
<script src="<?php echo RIZ_ASSETS; ?>assets/js/pages/search.js"></script> <!-- Search Script -->
<!-- BEGIN PAGE SCRIPTS -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/summernote/summernote.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/skycons/skycons.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/simple-weather/jquery.simpleWeather.min.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/js/widgets/widget_weather.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>assets/js/widgets/todo_list.js"></script>
<!-- END PAGE SCRIPTS -->
<!--[if lt IE 9]>
<script src="<?php echo RIZ_ASSETS; ?>assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>assets/plugins/trumbowyg/dist/trumbowyg.js"></script>
<script type="text/javascript" src="<?php echo RIZ_SKIN; ?>tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    $('textarea').trumbowyg();
    /*tinymce.init({
        selector: "textarea",
        theme: "modern",
        convert_urls: false,
        height: 500,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        content_css: "css/content.css",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ]
    });*/
</script>
<script type="text/javascript" src="<?php echo RIZ_SKIN; ?>uploadify/jquery.uploadify.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $airports = Array();
        $exterior = Array();
        $interior = Array();
        $count = 0;
        //$(".tablesorter").tablesorter();
        $("#airfile_upload").uploadify({
            fileTypeDesc    : 'Excel Files (*.xls; *.xlsx)',
            fileTypeExts         : '*.xls;*.xlsx',
            swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
            uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
            removeCompleted : false,
            onQueueComplete : function(queueData){
                for($i = 0;$i < $airports.length; $i++){
                    $.post('<?php echo site_url('import/airport_ajax'); ?>',{xelFile:$airports[$i]},function(data){
                        $("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
                        $count = $count + 1;
                    });
                }
            },
            onUploadSuccess : function(file, data, response){
                $airports[$airports.length] = data;
            },
        });

        $("#aircraft_upload").uploadify({
            fileTypeDesc    : 'Excel Files (*.xls; *.xlsx)',
            fileTypeExts         : '*.xls;*.xlsx',
            swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
            uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
            removeCompleted : false,
            onQueueComplete : function(queueData){
                for($i = 0;$i < $airports.length; $i++){
                    $.post('<?php echo site_url('import/aircraft_ajax'); ?>',{xelFile:$airports[$i]},function(data){
                        $("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
                        $count = $count + 1;
                    });
                }
            },
            onUploadSuccess : function(file, data, response){
                $airports[$airports.length] = data;
            },
        });

        $("#exterior_upload").uploadify({
            fileTypeDesc    : 'Excel Files (*.xls; *.xlsx)',
            fileTypeExts         : '*.xls;*.xlsx',
            swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
            uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
            removeCompleted : false,
            onQueueComplete : function(queueData){

                for($i = 0;$i < $exterior.length; $i++){
                    $.post('<?php echo site_url('import/exterior_ajax'); ?>',{xelFile:$exterior[$i]},function(data){
                        $("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
                        $count = $count + 1;
                    });
                }
            },
            onUploadSuccess : function(file, data, response){
                $exterior[$exterior.length] = data;
            },
        });

        $("#interior_upload").uploadify({
            fileTypeDesc    : 'Excel Files (*.xls; *.xlsx)',
            fileTypeExts         : '*.xls;*.xlsx',
            swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
            uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
            removeCompleted : false,
            onQueueComplete : function(queueData){

                for($i = 0;$i < $interior.length; $i++){
                    $.post('<?php echo site_url('import/interior_ajax'); ?>',{xelFile:$interior[$i]},function(data){
                        $("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
                        $count = $count + 1;
                    });
                }
            },
            onUploadSuccess : function(file, data, response){
                $interior[$interior.length] = data;
            },
        });

        $("#page_editor").uploadify({
            fileTypeDesc    : 'Image Files (*.png; *.jpg; *.jpeg; *.gif; *.bmp)',
            fileTypeExts         : '*.png; *.jpg; *.jpeg; *.gif; *.bmp',
            swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
            uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadifyImg.php',  // The path to the server-side upload script
            buttonText: 'Add / Insert Image',
            removeCompleted : false,
            onUploadSuccess : function(file, data, response){
                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '<img src="' + data + '" />');
            },
        });

        $(".delete").click(function(){
            $this = $(this);
            if(confirm('Are you sure you want to delete?')){
                $.post('<?php echo site_url('enlist/delete'); ?>',{controller : '<?php echo $controller; ?>',val : $(this).attr('href')},function(data){
                    if(data == 1){
                        $this.parent().parent().remove();
                    }
                });
            }
            return false;
        });
        $pilot_files = [];
        $("#pilot_upload").uploadify({
            fileTypeDesc    : 'Excel Files (*.xls; *.xlsx), CSV (*.csv)',
            fileTypeExts         : '*.xls;*.xlsx;*.csv',
            swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
            uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
            removeCompleted : false,
            onQueueComplete : function(queueData){
                for($i = 0;$i < $pilot_files.length; $i++){
                    $type = 'p';
                    if($('#is_non_pilot').prop('checked') == true){
                        $type = 'n';
                    }
                    $.post('<?php echo site_url('import/pilot_ajax'); ?>',{xelFile:$pilot_files[$i],type:$type},function(data){
                        $("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
                        $count = $count + 1;
                    });
                }
            },
            onUploadSuccess : function(file, data, response){
                console.log(file);
                console.log(data);
                console.log(response);
                $pilot_files[$pilot_files.length] = data;
            },
        });

        $("#department_upload").uploadify({
            fileTypeDesc    : 'Excel Files (*.xls; *.xlsx), CSV (*.csv)',
            fileTypeExts         : '*.xls;*.xlsx;*.csv',
            swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
            uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
            removeCompleted : false,
            onQueueComplete : function(queueData){
                for($i = 0;$i < $interior.length; $i++){
                    $.post('<?php echo site_url('import/department_ajax'); ?>',{xelFile:$interior[$i]},function(data){
                        console.log(data);
                        $("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
                        $count = $count + 1;
                    });
                }
            },
            onUploadSuccess : function(file, data, response){
                $interior[$interior.length] = data;
            },
        });
    });
    $(document).ready(function() {

        //When page loads...
        $(".tab_content").hide(); //Hide all content
        $("ul.tabs li:first").addClass("active").show(); //Activate first tab
        $(".tab_content:first").show(); //Show first tab content

        //On Click Event
        $("ul.tabs li").click(function() {

            $("ul.tabs li").removeClass("active"); //Remove any "active" class
            $(this).addClass("active"); //Add "active" class to selected tab
            $(".tab_content").hide(); //Hide all tab content

            var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
            $(activeTab).fadeIn(); //Fade in the active ID content
            return false;
        });

        if($('.courseListingClass').length > 0){
            $ar = [];
            $('.courseListingClass .row.rowwidth.rightBorder').each(function(){
                $columnAction = $(this).find('.column1');
                $columnID = $(this).find('.column2');
                $columnTitle = $(this).find('.titleColumn');
                $columnCost = $(this).find('.column4');
                $columnAuthor = $(this).find('.authorColumn');
                $columnCredit = $(this).find('.creditColumn');

                $desc = $.trim($columnTitle.find('a').attr('onmouseover'));

                $ar.push({
                    'a'    :   $.trim($columnID.html()),
                    'b' :   $.trim($columnTitle.find('a').html()),
                    'c' :   $.trim($columnCost.html()),
                    'd':   $.trim($columnAuthor.html()),
                    'e':   $.trim($columnCredit.find('.phaseCredit').html()),
                    'f'  :   $desc.substr(16,$desc.length - 5),
                    'g'   :   $.trim($columnAction.find('a:first-child').attr('href')),
                });
            });
            $.post('<?php echo site_url('import/courses'); ?>',{action:'postit','data':$ar},function($response){
                $('.message').html('Completed');
            });
        }

    });
</script>
<script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
</body>
</html>
