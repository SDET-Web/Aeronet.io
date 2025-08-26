<?php
is_logged_in_redirect();
?>
<?php $conversation = $this->Model_message->browse($this->session->userdata('user_id'),0,'p',true,20); ?>
<?php $conversation_all = $this->Model_message->conversations($this->session->userdata('user_id')); ?>
<?php $conversations_recieved = $this->Model_message->conversations_recieved($this->session->userdata('user_id')); ?>
<?php $connections = $this->Model_connection->connections($this->session->userdata('user_id'),'p','p');//$this->Model_connection->browse(0,$this->session->userdata('user_id'),'p','p'); ?>
<?php $notifications = $this->Model_post->notification($this->session->userdata('user_id'),'p'); ?>
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html><!--<![endif]-->

<!-- Specific Page Data -->
<!-- End of Data -->

<head>
<meta charset="utf-8" />
    <title><?php echo get_title(); ?></title>
    <meta name="viewport" content="minimal-ui,width=device-width,height=device-height,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <meta name="description" content="">
<!--<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:bold,300,400,700|Open+Sans:bold,200,200italic,400,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet'> 
  <link href="<?php //echo RIZ_ASSETS_BACKEND; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">  -->  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/fonts.css"  rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/jquery-ui/jquery-ui.custom.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/prettyPhoto-plugin/css/prettyPhoto.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/isotope/css/isotope.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/pnotify/css/pnotify.custom.min.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/mCustomScrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/tagsInput/jquery.tagsinput.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-switch/bootstrap-switch.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
    
    <link href="<?php echo RIZ_ASSETS; ?>css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RIZ_ASSETS; ?>css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/trumbowyg/dist/ui/trumbowyg.css" rel="stylesheet">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/theme.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/theme-responsive.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/custom.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
    
   <!-- <link href="<?php //echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/css/nanoscroller.css" rel="stylesheet" />  chrome only css -->
   <!-- <link href="<?php //echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/css/emoji.css" rel="stylesheet" /> <!-- chrome only css -->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/lazyplayer/css/lazyplayer.css?<?php echo time(); ?>" rel="stylesheet" /> <!-- chrome only css -->
    <link href="<?php echo RIZ_ASSETS; ?>css/easy-autocomplete.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RIZ_ASSETS; ?>grid/images-grid.css?<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-wysiwyg/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS; ?>css/swiper.min.css" rel="stylesheet" type="text/css" />
    <!-- Head SCRIPTS -->
    <script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/mobile-detect.min.js"></script>
    <script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/mobile-detect-modernizr.js"></script>
     <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>grid/images-grid.js?<?php echo time(); ?>"></script>
    <script>
        $baseURL = '<?php echo RIZ_BASE_URL; ?>';
        <?php if(is_logged_in()): ?>
        $user = {
            id:<?php echo $this->session->userdata('user_id'); ?>,
        };
        <?php endif; ?>
    </script>
    <style>
        .image-wrap.video:before {
            content: "\f144"; /*--You can add font icon code here--*/
            font-family: FontAwesome;
            display: inline-block;
            padding-right: 6px;
            vertical-align: middle;
            font-size: 72px;
            color: rgba(222,222,222,0.8);
            position: absolute;
            z-index: 10;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

</head>

<body id="pages" class="full-layout nav-top-fixed responsive clearfix" data-active="pages "  data-smooth-scrolling="1">
<div class="vd_body">

    <!-- Header Start -->

    <header class="header-1" id="header">
        <div class="vd_top-menu-wrapper">
            <div class="container ">
                <div class="vd_panel-header">

                    <div class="rows">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="logo" style="margin-top:15px;">
                            <a href="<?php echo site_url('dashboard'); ?>">
                            <img class="img-responsive" width="215" src="<?php echo RIZ_ASSETS; ?>images/logo.png"></a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="vd_menu-search">
                                <form id="search-box" method="post" action="<?php echo site_url('search'); ?>">
                                    <input type="text" name="term" class="vd_menu-search-text width-50" value="<?php echo $this->input->post('term'); ?>" placeholder="Search">
                                    <div class="vd_menu-search-category"> <span data-action="click-trigger"> <span class="separator"></span> <span class="text">Directory</span> <span class="icon"> <i class="fa fa-caret-down"></i></span> </span>
                                        <div class="vd_mega-menu-content width-xs-2 center-xs-2 right-sm" data-action="click-target">
                                            <div class="child-menu">
                                                <div class="content-list content-menu content">
                                                    <ul class="list-wrapper">
                                                        <li>
                                                            <label>
                                                                <input checked="checked" type="checkbox" name="pilot" value="1">
                                                                <span>Active Pilots</span></label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input checked="checked" type="checkbox" name="department" value="1">
                                                                <span>Flight Departments</span></label>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span onclick="$('#search-box').submit();" class="vd_menu-search-submit"><i class="fa fa-search"></i> </span>
                                </form>
                            </div> <div class=" hidden-md hidden-sm"><br/></div>
                        </div>


                        <div class="hidden-xs">
                        <div class="col-md-5 col-sm-12 col-xs-hidden">
                            <div class="vd_mega-menu-wrapper">

                                <div class="vd_mega-menu pull-right">
                                    <ul class="mega-ul">
                                        <li id="top-menu-1" class="one-icon mega-li">
                                            <a class="mega-link" data-action="click-trigger">
                                                <span class="mega-icon"><i class="fa fa-users"></i></span>
                                                <?php if(count($connections) > 0): ?>
                                                    <span class="badge vd_bg-red"><?php echo count($connections) ;?></span>
                                                <?php endif; ?>
                                            </a>
                                             <div class="vd_mega-menu-content width-xs-3 width-sm-4 width-md-5 width-lg-4 right-xs left-sm" data-action="click-target">
                                              <div class="child-menu">
                                                    <div class="title">
                                                        Connection Requests
                                                    </div>
                                                    <div class="content-grid column-xs-2 column-sm-3 height-xs-4">
                                                        <div data-rel="scroll">
                                                            <ul class="list-wrapper">
                                                                <?php
                                                               if(count($connections) > 0):
                                                                   foreach($connections as $connection):
                                                                        ?>
                                                                        <li> <a href="<?php echo site_url('pilot/'.$connection['id']); ?>">
                                                                                <div class="menu-icon"><img alt="example image" src="<?php echo get_user_pic_url($connection['image'],get_data_value($connection,'type')); ?>"></div>
                                                                            </a>
                                                                            <div class="menu-text"> <?php echo get_data_value($connection,'fname'); ?> <?php echo get_data_value($connection,'lname'); ?>
                                                                                <div class="menu-info">
                                                                                    <div class="menu-date"><?php echo get_select_user_type(get_data_value($connection,'type')); ?></div>
                                                                                    <div class="menu-action">
                                                                                
                                                                                <span class="btn vd_btn vd_bg-green btn-sm btn-block accept-user" object-id="<?php echo $connection['id']; ?>">
                                                                                  Accept
                                                                                </span>
                                                                                <span class="btn vd_btn vd_bg-gray vd_blue btn-sm btn-block decline-user" object-id="<?php echo $connection['id']; ?>">
                                                                                Decline
                                                                                </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                <?php  else: ?>
                                                                    No pending Connection requests.
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> <!-- child-menu -->
                                            </div>   <!-- vd_mega-menu-content -->
                                        </li>
                                        <li id="top-menu-2" class="one-icon mega-li">
                                            <a class="mega-link" data-action="click-trigger">
                                                <span class="mega-icon"><i class="fa fa-envelope"></i></span>
                                                <?php if(count($conversations_recieved) > 0): ?>
                                                    <span class="badge vd_bg-red"><?php echo count($conversations_recieved); ?></span>
                                                <?php endif; ?>


                                            </a>
                                            <div class="vd_mega-menu-content width-xs-3 width-sm-4 width-md-5 width-lg-4 right-xs left-sm" data-action="click-target">
                                                <div class="child-menu">
                                                    <div class="title">
                                                        Messages
                                                        <div class="vd_panel-menu">
                                                             <span data-original-title="Message Setting" data-toggle="tooltip" data-placement="bottom" class="menu">
                                                                <i class="fa fa-cog"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="content-list content-image">
                                                        <div  data-rel="scroll">
                                                            <ul class="list-wrapper pd-lr-10">
                                                                <?php if(count($conversations_recieved) > 0): ?>
                                                                    <?php foreach($conversations_recieved as $key=>$convo): $convo = (array)$convo[count($convo) - 1]; ?>
                                                                        <li style="cursor:pointer;" onclick="window.location='<?php echo site_url('conversation/'.$key); ?>'">
                                                                            <div class="menu-icon"><img alt="example image" src="<?php echo get_user_pic_url($convo['user_image'],"p"); ?>"></div>
                                                                            <div class="menu-text"> <?php echo $convo['mess_text']; ?>
                                                                                <div class="menu-info">
                                                                                    <span class="menu-date"><?php echo date('d/m/Y',$convo['mess_created']); ?></span>
                                                                            <span class="menu-action">
                                                                                <span class="menu-action-icon" data-original-title="Mark as Unread" data-toggle="tooltip" data-placement="bottom">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </span>
                                                                            </span>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <li>No messages recieved</li>
                                                                <?php endif; ?>

                                                            </ul>
                                                        </div>
                                                        <div class="closing text-center" style="">
                                                            <a href="<?php echo site_url('my/conversations'); ?>">See All Messages <i class="fa fa-angle-double-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div> <!-- child-menu -->
                                            </div>   <!-- vd_mega-menu-content -->
                                        </li>
                                        <li id="top-menu-3"  class="one-icon mega-li">
                                            <a class="mega-link" data-action="click-trigger">
                                                <span class="mega-icon"><i class="fa fa-globe"></i></span>
                                                <?php if(count($notifications) > 0): ?>
                                                    <span class="badge vd_bg-red noti-count"><?php echo count($notifications); ?></span>
                                                <?php endif; ?>
                                            </a>
                                           <div class="vd_mega-menu-content width-xs-3 width-sm-4 width-md-5 width-lg-4 right-xs left-sm" data-action="click-target">
                                                <div class="child-menu">
                                                    <div class="title">
                                                        Notifications
                                                        <div class="vd_panel-menu">
                                                             <span data-original-title="Notification Setting" data-toggle="tooltip" data-placement="bottom" class="menu">
                                                                <i class="fa fa-cog"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="content-list">
                                                        <div  data-rel="scroll">
                                                            <ul  class="list-wrapper pd-lr-10">
                                                                <?php
                                                                if(count($notifications) > 0):
                                                                    foreach($notifications as $notification):
                                                                        $type_array = get_post_type_icon_color($notification['post_type']);
                                                                        ?>
                                                                        <li  onclick="publicJS.markNotification($(this),<?php echo $notification['id']; ?>)"> <a href="#">
                                                                                <div class="menu-icon <?php echo $type_array['border']; ?>"><i class="fa <?php echo get_notification_icon($notification['text']); ?>"></i></div>
                                                                                <div class="menu-text"> <?php echo $notification['text']; ?>
                                                                                    <div class="menu-info"><span class="menu-date"><?php echo time_ago($notification['date'], $notification['c_date']); ?></span></div>
                                                                                </div>
                                                                            </a> </li>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <li>No new notifications found.</li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                        <div class="closing text-center" style="">
                                                            <a href="<?php echo site_url('my/notifications'); ?>">See All Notifications <i class="fa fa-angle-double-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div> <!-- child-menu -->
                                            </div>   <!-- vd_mega-menu-content -->
                                        </li>
                                        <li id="top-menu-profile" class="profile mega-li">
                                            <a href="#" class="mega-link"  data-action="click-trigger">
                                                <span  class="mega-image">
                                                    <img src="<?php echo get_user_pic_url($this->session->userdata('user_image'),$this->session->userdata('user_type')); ?>" alt="<?php echo $this->session->userdata('user_fname').' '.$this->session->userdata('user_lname'); ?>" />
                                                </span>
                                                <span class="mega-name">
                                                    <?php echo $this->session->userdata('user_fname'); ?> <i class="fa fa-caret-down fa-fw"></i>
                                                </span>
                                            </a>
                                            <div class="vd_mega-menu-content  width-xs-2  left-xs left-sm" data-action="click-target">
                                                <div class="child-menu">
                                                    <div class="content-list content-menu">
                                                        <ul class="list-wrapper pd-lr-10">
                                                            <li> <a href="<?php echo site_url('dashboard'); ?>"> <div class="menu-icon"><i class=" fa fa-home"></i></div> <div class="menu-text">Home</div> </a> </li>
                                                            <li> <a href="<?php echo site_url('my/profile'); ?>"> <div class="menu-icon"><i class=" fa fa-user"></i></div> <div class="menu-text">Profile</div> </a> </li>
                                                            <li> <a href="<?php echo site_url('setting'); ?>"> <div class="menu-icon"><i class=" fa fa-cogs"></i></div> <div class="menu-text">Edit Profile</div> </a> </li>

                                                            <li> <a href="<?php echo site_url('news'); ?>"> <div class="menu-icon"><i class="fa fa-newspaper"></i></div> <div class="menu-text">News</div> </a> </li>
                                                            <li> <a href="<?php echo site_url('skywriter'); ?>"> <div class="menu-icon"><i class=" fa fa-cloud"></i></div> <div class="menu-text">Blogs</div> </a> </li>
                                                           <?php if($this->session->userdata('user_type') == 'p'): ?>
                                                                <li> <a href="<?php echo site_url('my/courses'); ?>"> <div class="menu-icon"><i class="fa fa-graduation-cap"></i></div> <div class="menu-text">Courses</div> </a> </li>
                                                            <?php endif; ?>
                                                            <?php if($this->session->userdata('user_type') <> 'd'): ?>
                                                            <li> <a href="<?php echo site_url('my/appliedjobs'); ?>"> <div class="menu-icon"><i class=" fa fa-server"></i></div>  <div class="menu-text">Applied Jobs</div> </a> </li>
                                                            <?php endif; ?>
                                                            <?php if($this->session->userdata('user_type') != 'p'): ?>
                                                                <li> <a href="<?php echo site_url('search/advanced'); ?>"> <div class="menu-icon"><i class=" fa fa-search-plus"></i></div>  <div class="menu-text">Advanced Search</div> </a> </li>
                                                            <?php endif; ?>
                                                            <li> <a href="<?php echo site_url('careers'); ?>"> <div class="menu-icon"><i class=" fa fa-search"></i></div> <div class="menu-text">Career</div> </a> </li>
                                                            <li> <a href="<?php echo site_url('logout'); ?>"> <div class="menu-icon"><i class=" fa fa-sign-out-alt"></i></div>  <div class="menu-text">Sign Out</div> </a> </li>



                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                        <li id="top-menu-settings" class="hidden one-big-icon hidden-xs hidden-sm mega-li" data-intro="<strong>Toggle Right Navigation </strong><br/>On smaller device such as tablet or phone you can click on the middle content to close the right or left navigation." data-step=2 data-position="left">
                                            <a href="#" class="mega-link"  data-action="toggle-navbar-right">
           <span class="mega-icon">
                <i class="fa fa-comments"></i>
            </span>
                                                <!--            <span  class="mega-image">
                                                                <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/avatar/avatar.jpg" alt="example image" />
                                                            </span> -->
                                                <?php if(count($conversation) > 0): ?>
                                                    <span class="badge vd_bg-red"><?php echo count($conversation); ?></span>
                                                <?php endif; ?>
                                            </a>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div></div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <div><?php echo pop_message(); ?></div>



            <div class="vd_content-wrapper">
               <!-- <div class="vd_container">
                    <div class="vd_content clearfix">-->
                        <?php (isset($data)?$this->load->view($view,$data):$this->load->view($view)); ?>
                  <!--  </div>-->
                </div>

    <footer id="footer">   
                 <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">                        
                     <p class="text-center">&copy; 2017 <a target="_blank" href="<?php echo site_url(''); ?>">AeroNet.io</a> <i> &nbsp; | &nbsp; &nbsp; &nbsp;<a href="<?php echo site_url('contact'); ?>"><i>Contact Us</i></a></i></p>

                    
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div style="padding:20px;"></div>
                    </div>
                </div>
            
        
    </footer>
    
    
    </div><!--end of body vid -->
    
    <div class="vd_chat-menu">

      <div class="vd_mega-menu-wrapper">
          <div class="vd_mega-menu pull-right">
              <ul class="mega-ul">


   <li class="one-big-icon mega-li mgl-5">
       <!-- <a class="mega-link pd-10" href="javascript:void(0);" data-action="chat-close"> -->
       <a class="mega-link" href="<?php echo site_url('dashboard'); ?>" >
       <span class="mega-icon">
               <i class="fa fa-home"></i>
            </span>
        </a>
    </li>
    <li class="one-big-icon mega-li mgl-5">
       <!-- <a class="mega-link pd-10" href="javascript:void(0);" data-action="chat-close"> -->
       <a class="mega-link" href="<?php echo site_url('showflight'); ?>" >
       <span class="mega-icon">
               <i class="fa fa-plane"></i>
            </span>
        </a>
    </li>

    <li class="one-big-icon mega-li mgl-5">
      <a class="mega-link" data-action="click-trigger">
                                                <span class="mega-icon"><i class="fa fa-users"></i></span>
                                                <?php if(count($connections) > 0): ?>
                                                    <span class="badge vd_bg-red"><?php echo count($connections) ;?></span>
                                                <?php endif; ?>
                                            </a>
      <div class="vd_mega-menu-content open-top width-xs-4 width-md-5 width-lg-4 center-xs-4" data-action="click-target">
        <div class="child-menu">
           <div class="title">
                                                        Connection Requests
                                                    </div>
		   <div class="content-list content-menu">
           	<div data-rel="scroll">
                                                            <ul class="list-wrapper">
                                                                <?php
                                                               if(count($connections) > 0):
                                                                 foreach($connections as $connection):
                                                                        ?>
                                                                        <li> <a href="<?php echo site_url('pilot/'.$connection['id']); ?>">
                                                                                <div class="menu-icon"><img alt="example image" src="<?php echo get_user_pic_url($connection['image'],get_data_value($connection,'type')); ?>"></div>
                                                                            </a>
                                                                            <div class="menu-text"> <?php echo get_data_value($connection,'fname'); ?> <?php echo get_data_value($connection,'lname'); ?>
                                                                                <div class="menu-info">
                                                                                    <div class="menu-date"><?php echo get_select_user_type(get_data_value($connection,'type')); ?></div>
                                                                                    <div class="menu-action">
                                                                                <span class="btn vd_btn vd_bg-green btn-sm btn-block accept-user" object-id="<?php echo $connection['id']; ?>">
                                                                                Accept
                                                                                </span>
                                                                                <span class="btn vd_btn vd_bg-gray vd_blue btn-sm btn-block decline-user" object-id="<?php echo $connection['id']; ?>">
                                                                                Decline
                                                                                </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                        <p>  No pending Connection requests.</p>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>


                                                    </div>
                                                </div> <!-- child-menu -->
                                            </div>   <!-- vd_mega-menu-content -->
    </li>

    <li class="one-big-icon mega-li mgl-5">
      <a class="mega-link" data-action="click-trigger">
                                                <span class="mega-icon"><i class="fa fa-envelope"></i></span>
                                                <?php if(count($conversations_recieved) > 0): ?>
                                                    <span class="badge vd_bg-red"><?php echo count($conversations_recieved); ?></span>
                                                <?php endif; ?>


                                            </a>
      <div class="vd_mega-menu-content open-top width-xs-4 width-md-5 width-lg-4 center-xs-4" data-action="click-target">
        <div class="child-menu">
           <div class="title">
                                                        Messages

                                                    </div>
		   <div class="content-list content-image content-menu">
           	<div  data-rel="scroll">
                                                            <ul class="list-wrapper pd-lr-10">
                                                                <?php if(count($conversations_recieved) > 0): ?>
                                                                    <?php foreach($conversations_recieved as $key=>$convo): $convo = (array)$convo[count($convo) - 1]; ?>
                                                                        <li style="cursor:pointer;" onclick="window.location='<?php echo site_url('conversation/'.$key); ?>'">
                                                                            <div class="menu-icon"><img alt="example image" src="<?php echo get_user_pic_url($convo['user_image'],"p"); ?>"></div>
                                                                            <div class="menu-text"> <?php echo $convo['mess_text']; ?>
                                                                                <div class="menu-info">
                                                                                    <span class="menu-date"><?php echo date('d/m/Y',$convo['mess_created']); ?></span>
                                                                            <span class="menu-action">
                                                                                <span class="menu-action-icon" data-original-title="Mark as Unread" data-toggle="tooltip" data-placement="bottom">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </span>
                                                                            </span>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <li>No messages recieved</li>
                                                                <?php endif; ?>

                                                            </ul>
                                                        </div>

           <div class="closing text-center" style="">
                                                            <a href="<?php echo site_url('my/conversations'); ?>">See All Messages <i class="fa fa-angle-double-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div> <!-- child-menu -->
                                            </div>   <!-- vd_mega-menu-content -->
    </li>
    <li class="one-big-icon mega-li mgl-5">
      <a class="mega-link" data-action="click-trigger">
                                                <span class="mega-icon"><i class="fa fa-globe"></i></span>
                                                <?php if(count($notifications) > 0): ?>
                                                    <span class="badge vd_bg-red noti-count"><?php echo count($notifications); ?></span>
                                                <?php endif; ?>
                                            </a>
      <div class="vd_mega-menu-content open-top width-xs-4 width-md-5 width-lg-4 center-xs-4" data-action="click-target">
        <div class="child-menu">
           <div class="title">
                                                        Notifications

                                                    </div>
		   <div class="content-list content-image content-menu">
           <div  data-rel="scroll">
                                                            <ul  class="list-wrapper pd-lr-10">
                                                                <?php
                                                                if(count($notifications) > 0):
                                                                    foreach($notifications as $notification):
                                                                        $type_array = get_post_type_icon_color($notification['post_type']);
                                                                        ?>
                                                                        <li  onclick="publicJS.markNotification($(this),<?php echo $notification['id']; ?>)"> <a href="#">
                                                                                <div class="menu-icon <?php echo $type_array['border']; ?>"><i class="fa <?php echo get_notification_icon($notification['text']); ?>"></i></div>
                                                                                <div class="menu-text"> <?php echo $notification['text']; ?>
                                                                                    <div class="menu-info"><span class="menu-date"><?php echo time_ago($notification['date'], $notification['c_date']); ?></span></div>
                                                                                </div>
                                                                            </a> </li>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <li>No new notifications found.</li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                        <div class="closing text-center" style="">
                                                            <a href="<?php echo site_url('my/notifications'); ?>">See All Notifications <i class="fa fa-angle-double-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div> <!-- child-menu -->
                                            </div>   <!-- vd_mega-menu-content -->
                                        </li>


    <li class="profile mega-li mgl-5">
        <a class="mega-link pd-10" href="#"  data-action="click-trigger">
            <span class="menu-name">
                <i class="fa fa-bars append-icon"></i>
            </span>
        </a>
      <div class="vd_mega-menu-content open-top width-xs-3 width-md-3 width-lg-5 center-xs-5" data-action="click-target">
        <div class="child-menu">
                                                    <div class="content-list content-menu">
                                                        <ul class="list-wrapper pd-lr-10">
                                                            <li style="padding:5px;border-bottom:1px solid #eaeaea;"> <a href="<?php echo site_url('dashboard'); ?>"> <div class="menu-icon"><i class=" fa fa-home"></i></div> <div class="menu-text">Home</div> </a> </li>
                                                            <li style="padding:5px;border-bottom:1px solid #eaeaea;"> <a href="<?php echo site_url('my/profile'); ?>"> <div class="menu-icon"><i class=" fa fa-user"></i></div> <div class="menu-text">Profile</div> </a> </li>
                                                            <li style="padding:5px;border-bottom:1px solid #eaeaea;"> <a href="<?php echo site_url('setting'); ?>"> <div class="menu-icon"><i class=" fa fa-cogs"></i></div> <div class="menu-text">Edit Profile</div> </a> </li>

                                                            <li style="padding:5px;border-bottom:1px solid #eaeaea;"> <a href="<?php echo site_url('news'); ?>"> <div class="menu-icon"><i class="fa fa-newspaper"></i></div> <div class="menu-text">News</div> </a> </li>
                                                            <li style="padding:5px;border-bottom:1px solid #eaeaea;"> <a href="<?php echo site_url('skywriter'); ?>"> <div class="menu-icon"><i class=" fa fa-cloud"></i></div> <div class="menu-text">Blogs</div> </a> </li>



                                                            <?php if($this->session->userdata('user_type') == 'p'): ?>
                                                                <li style="padding:5px;border-bottom:1px solid #eaeaea;"> <a href="<?php echo site_url('my/courses'); ?>"> <div class="menu-icon"><i class="fa fa-graduation-cap"></i></div> <div class="menu-text">Courses</div> </a> </li>
                                                            <?php endif; ?>
                                                             <?php if($this->session->userdata('user_type') <> 'd'): ?>    
                                                            <li style="padding:5px;border-bottom:1px solid #eaeaea;"> <a href="<?php echo site_url('my/appliedjobs'); ?>"> <div class="menu-icon"><i class=" fa fa-server"></i></div>  <div class="menu-text">Applied Jobs</div> </a> </li>
                                                            <?php endif; ?>
                                                            <?php if($this->session->userdata('user_type') != 'p'): ?>
                                                                <li style="padding:5px;border-bottom:1px solid #eaeaea;"> <a href="<?php echo site_url('search/advanced'); ?>"> <div class="menu-icon"><i class=" fa fa-search-plus"></i></div>  <div class="menu-text">Advanced Search</div> </a> </li>
                                                            <?php endif; ?>
                                                           <!-- <li style="padding:5px;border-bottom:1px solid #eaeaea;"> <a href="<?php //echo site_url('flight-dispatch-board'); ?>"> <div class="menu-icon"><i class=" fa fa-clipboard-list"></i></div> <div class="menu-text">Jobs Board</div> </a> </li>-->


                                                            <li> <a href="<?php echo site_url('logout'); ?>"> <div class="menu-icon"><i class=" fa fa-sign-out-alt"></i></div>  <div class="menu-text">Sign Out</div> </a> </li>



                                                        </ul>
                                                    </div>
                                                </div>
      </div>

    </li>


</ul>
<!-- Head menu search form ends -->
          </div>
      </div>
  </div>




    <?php $user_data = get_messages_bar(); ?>
</div>
<div id="demo-message" class="hidden">
    <li > <a href="#">
            <div class="menu-icon"><img alt="example image" src="<?php echo get_user_pic_url($this->session->userdata('user_image'),$this->session->userdata('user_type')); ?>"></div>
            <div class="menu-text"> MESSAGE
                <div class="menu-info">
                    <span class="menu-date">TIME </span>
                </div>
            </div>
        </a> </li>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Post Details</h4>
            </div>
            <div class="modal-body">
                <ul class="vd_timeline post-list"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rejModal" role="dialog"></div>
<div class="modal fade" id="apprModal" role="dialog"></div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script defer src="<?php echo RIZ_ASSETS_BACKEND; ?>js/fontawesome-all.js"></script>
<!--<script type="text/javascript" src="<?php //echo RIZ_ASSETS_BACKEND; ?>js/bootstrap.min.js"></script>-->
<script type="text/javascript" src='<?php echo RIZ_ASSETS_BACKEND; ?>plugins/jquery-ui/jquery-ui.custom.min.js'></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/plugins.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/breakpoints/breakpoints.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/dataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/prettyPhoto-plugin/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/tagsInput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/blockUI/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/pnotify/js/pnotify.custom.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/select2.full.min.js"></script> <!-- Select Inputs -->
<script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/bootstrap-multiselect.js?<?php echo time(); ?>"></script> <!-- Select Inputs -->
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/theme.js"></script>

<script src="<?php echo RIZ_ASSETS; ?>js/dropzone.js"></script>
<!--<script type="text/javascript" src="<?php //echo RIZ_ASSETS; ?>js/jquery.emojiarea.js"></script>-->
<script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/public.js?<?php echo time(); ?>"></script>

<script type="text/javascript" type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/custom.js?<?php echo time(); ?>"></script>

<!-- Specific Page Scripts Put Here -->
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/isotope/isotope.pkgd.min.js"></script>
<script type="text/javascript" src='<?php echo RIZ_ASSETS_BACKEND; ?>plugins/lazyplayer/js/lazyplayer.js?<?php echo time(); ?>'></script>
<!-- Specific Page Scripts Put Here -->
<script type="text/javascript" src='<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js'></script>
<!--<script src="<?php //echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/nanoscroller.min.js"></script>
<script src="<?php// echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/tether.min.js"></script>
<script src="<?php //echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/config.js"></script>
<script src="<?php //echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/util.js"></script>
<script src="<?php //echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/jquery.emojiarea.js"></script>
<script src="<?php //echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/emoji-picker.js"></script>-->
<script src="<?php echo RIZ_ASSETS; ?>js/jquery.easy-autocomplete.js"></script>
<script src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/trumbowyg/dist/trumbowyg.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/swiper.min.js"></script>

<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-wysiwyg/js/wysihtml5-0.3.0.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-wysiwyg/js/bootstrap-wysihtml5-0.0.2.js"></script>

<script src="<?php echo RIZ_ASSETS; ?>js/eModel.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        "use strict";

        eModal.setEModalOptions({
            size: eModal.size.lg
        });

        $('.wyswyg').trumbowyg();

        // init Isotope
        var $container = $('.isotope').isotope({
            itemSelector: '.gallery-item',
            layoutMode: 'fitRows'
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $container.isotope('layout');
        });
        // bind filter button click
        $('#filters').on( 'click', 'a', function() {
            var filterValue = $( this ).attr('data-filter');
            $('#filters li').removeClass('active');
            $(this).parent().addClass('active');
            $container.isotope({ filter: filterValue });
        });

        $('.airports_autocomplete').autocomplete({
          // minChars: 1,
          source: function(request, response) {
            $.get("<?php echo site_url('ajax/airports'); ?>?query=" + request.term, function(data) {
              response( $.map( data, function( item ) {
                return item;
                })
              );
            });
          },
          select: function (event, ui) {
            // alert(ui.item);
           }
        });

    });
</script>
<!-- Specific Page Scripts END -->
<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. -->
<script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-43329142-3']);
    _gaq.push(['_trackPageview']);
    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

    $(document).ready(function(){
        var options = [];

        $( '.dropdown-menu a' ).on( 'click', function( event ) {

            var $target = $( event.currentTarget ),
                val = $target.attr( 'data-value' ),
                $inp = $target.find( 'input' ),
                idx;

            if ( ( idx = options.indexOf( val ) ) > -1 ) {
                options.splice( idx, 1 );
                setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
            } else {
                options.push( val );
                setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
            }

            $( event.target ).blur();

            console.log( options );
            return false;
        });

        var $tmp = ['Capitan','Co-Pilot','Chief-Pilot'];

        $(".selectAircraft").select2({
            placeholder: "Choose the aircrafts",
            allowClear: true,
        }).on("change", function (e) {
            $('.selectAircraft option').each(function(){
                $(
                    '.jobTitle-'+$(this).val()+',' +
                    '.jobTitle-'+$(this).val()+'-capitan,' +
                    '.jobTitle-'+$(this).val()+'-copilot,' +
                    '.jobTitle-'+$(this).val()+'-chiefpilot'
                ).addClass('hidden');
                $this = $(this);
                $.each($tmp,function(key,val){
                    $(
                        '.jobType-'+$this.val() + '-' + val +',' +
                        '.jobType-'+$this.val() + '-' + val +'-full,' +
                        '.jobType-'+$this.val() + '-' + val +'-contract,' +
                        '.jobSalary-' + $this.val() + '-' + val + '-75k-100k,' +
                        '.jobSalary-' + $this.val() + '-' + val + '-100k-125k,' +
                        '.jobSalary-' + $this.val() + '-' + val + '-125k+'
                    ).addClass('hidden');
                });
            });

            if($(this).val().length > 0){
                $('.group-wise-select,.multiselect-native-select button').removeAttr('disabled');
                $('.multiselect-native-select button').removeClass('disabled');
                $.each($(this).val(),function(keyz,value) {
                    $(
                        '.jobTitle-' + value + ',' +
                        '.jobTitle-' + value + '-capitan,' +
                        '.jobTitle-' + value + '-copilot,' +
                        '.jobTitle-' + value + '-chiefpilot'
                    ).removeClass('hidden');
                    $.each($tmp, function (key, val) {
                        $(
                            '.jobType-'+ value + '-' + val +',' +
                            '.jobType-'+ value + '-' + val +'-full,' +
                            '.jobType-'+ value + '-' + val +'-contract,' +
                            '.jobSalary-' + value + '-' + val + ',' +
                            '.jobSalary-' + value + '-' + val + '-75k-100k,' +
                            '.jobSalary-' + value + '-' + val + '-100k-125k,' +
                            '.jobSalary-' + value + '-' + val + '-125k+'
                        ).removeClass('hidden');
                    });
                });
            }else{
                $('.group-wise-select,.multiselect-native-select button').attr('disabled');
                $('.multiselect-native-select button').addClass('disabled');
                $('.selectAircraft option').prop('selected',false);





            }

            $.each($(this).val(),function(key,val){

            });
        });
        $(".select").select2({
            allowClear: true,
        });
        $(".select-main").select2({
            allowClear: true,
            placeholder: "Who are you with?",
        });

        $('.multiselect').multiselect();
        $('.group-wise-select').multiselect({
            onChange: function(option, checked) {
                if(checked){
                    $('option.' + option[0].className).parent().find('option').each(function(){
                        $(this).prop('selected',false);
                        $('li.' + $(this).attr('class')).removeClass('active').find('input[type="checkbox"]').prop('checked',false);
                    });
                }
                $('option.' + option[0].className).prop('selected',true);
                $('li.' + option[0].className).addClass('active').find('input[type="checkbox"]').prop('checked',true);
            }
        });


        var options = {
            url: function(phrase) {
                return $baseURL + 'ajax/make_model_directory_search/' + phrase;
            },
            getValue: function(element) {
                return element.name;
            },

            list: {
                match: {
                    enabled: true
                },
                onChooseEvent: function() {
                },
            },
            theme: "square"
        };

        $(".makeModelSearch").easyAutocomplete(options);

        $(".profile-photo").click(function() {
          $("#profile-photo-file").trigger('click');
        });

        $("#profile-photo-file").change(function() {
          readURL(this);
        });


    });



    

 function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('.profile-photo').attr('src', e.target.result);
      $('.profile-bgphoto').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    
    $('#profile-photo-post1').submit();
    $('#profile-photo-post').submit();
  }
}


</script>
</body>
</html>
