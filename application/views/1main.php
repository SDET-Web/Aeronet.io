<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo get_title(); ?></title>
    <!-- core CSS -->

    <link href="<?php echo RIZ_ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo RIZ_ASSETS; ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo RIZ_ASSETS; ?>css/animate.min.css" rel="stylesheet">
    <link href="<?php echo RIZ_ASSETS; ?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo RIZ_ASSETS; ?>css/main.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="<?php echo RIZ_ASSETS; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo RIZ_ASSETS; ?>css/jquery.popSelect.css" rel="stylesheet" >
    <link href="<?php echo RIZ_ASSETS; ?>css/responsive.css" rel="stylesheet">

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.4/quill.snow.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="<?php echo RIZ_ASSETS; ?>js/html5shiv.js"></script>
    <script src="<?php echo RIZ_ASSETS; ?>js/respond.min.js"></script>
    <script src="<?php echo RIZ_ASSETS; ?>js/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <![endif]-->
    <link rel="shortcut icon" href="assets/images/ico/lazyeight.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo RIZ_ASSETS; ?>images/ico/lazyeight144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo RIZ_ASSETS; ?>images/ico/lazyeight-114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo RIZ_ASSETS; ?>images/ico/lazyeight-72.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo RIZ_ASSETS; ?>images/ico/lazyeight-57.png">
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-47963409-1', 'lazy-eights.com');
        ga('send', 'pageview');
    </script>
    <script src="//code.jquery.com/jquery-latest.js" type="text/javascript"></script>
    <script src="http://alexgorbatchev.com/pub/sh/current/scripts/shCore.js" type="text/javascript"></script>


    <script>
        $baseURL = '<?php echo RIZ_BASE_URL; ?>';
        <?php if(is_logged_in()): ?>
        $user = {
            id:<?php echo $this->session->userdata('user_id'); ?>,
        };
        <?php else: ?>
        $user = {
            id:0,
        };
        <?php endif; ?>
    </script>
    <!-- <script src="<?php echo RIZ_ASSETS; ?>js/custom.js" type="text/javascript"></script> -->
    <script type="text/javascript" src="//platform.linkedin.com/in.js">
        api_key: 86v3ewl6suhypy
        authorize: true
        onLoad: onLinkedInLoad
        scope: r_basicprofile r_emailaddress
    </script>
    <?php  echo isset($data['map']['js'])?$data['map']['js']:''; ?>

 <link href="https://vjs.zencdn.net/7.1.0/video-js.css" rel="stylesheet">

  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
  <script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>    
    
    
</head><!--/head-->
<body>
    <header id="header">

        <nav class="navbar navbar-inverse navbar-fixed-top" role="banner">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo site_url(''); ?>"><img  src="<?php echo RIZ_ASSETS; ?>images/logo.png" alt='AeroNet'></a>

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

                </div>

                <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            
             <?php if($this->session->userdata('user_id')==''): ?>
                        <li class="active"><a href="<?php echo site_url('login'); ?>">SIGN IN</a></li>
                                        <?php else: ?>
                                        <li class="active"><a  href="<?php echo site_url('dashboard'); ?>">MY ACCOUNT</a></li>
<li> <a href="<?php echo site_url('logout'); ?>"> Sign Out </a> </li>                                   
 <?php endif; ?>
            
            
                      <!--  <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">COMPANY <i class="fa fa-angle-double-down"></i></a>
                            <ul class="dropdown-menu">
                                
                                <li><a href="<?php //echo site_url('contact'); ?>">Contact us</a></li>
                                <li><a href="<?php //echo site_url('faq'); ?>">FAQs</a></li>

                            </ul>
                        </li>
                      
                      <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> NEWS/BLOGS/FORUMS <i class="fa fa-angle-double-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php //echo site_url('news'); ?>">Trending News</a></li>
                               <li><a href="<?php //echo site_url('blogs'); ?>">Skywriter Blogs</a></li>
                               <li><a href="<?php //echo site_url('forum'); ?>">Accredited Forums</a></li>

                            </ul>
                        </li>
                      
                      -->
                      
                        <li><a href="<?php echo site_url('about'); ?>">About</a></li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">For AVIATION TALENT <i class="fa fa-angle-double-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('career-center'); ?>">Job Search NextGen </a></li>
                                <li><a href="<?php echo site_url('salary'); ?>">Salary Navigator </a></li>
                                <li><a href="<?php echo site_url('flight-dispatch-board'); ?>">Jobs Board</a></li>

                            </ul>
                        </li>
                        <!--  <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">For GENERAL AVIATORS <i class="fa fa-angle-double-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php //echo site_url('pilot-proficiency-program'); ?>">Pilot Proficiency Program</a></li>
                                <li><a href="<?php //echo site_url('safety-pilot-network'); ?>">Safety Pilot Network</a></li>
                                
                            </ul>
                        </li>-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">For FLIGHT DEPARTMENTS <i class="fa fa-angle-double-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('pilot-recruitment'); ?>">AeroNet Recruit</a></li>
                                <li><a href="<?php echo site_url('hiring-solutions'); ?>">AeroNet Source</a></li>
                               <!-- <li><a href="<?php echo site_url('onboard'); ?>">AeroNet Onboard</a></li>-->
                                <li><a href="<?php echo site_url('faq'); ?>">Post a Job</a></li>
                               <li><a href="<?php echo site_url('pricing'); ?>">Pricing</a></li>
                            </ul>
                        </li>
                          
                        
                         
                        


                                        
                                        
                    </ul>
        
        </div>
                
                
                
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->



<div><?php echo pop_message(); ?></div>

    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.4/quill.js"></script>

<?php (isset($data)?$this->load->view($view,$data):$this->load->view($view)); ?>



    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12" style="text-align:center;">
                    
                    <ul>
                        <li><a href="<?php echo site_url('directory/search'); ?>"><b>Directory</b></a></li>
                        <li><a href="<?php echo site_url('contact'); ?>"><b>Support</b></a></li>
                         <br/>
                         <a target="_blank" href="<?php echo site_url(''); ?>">AeroNet.io</a> is a member of NBAA
                
                <br/>
                &copy; 2018 <a target="_blank" href="<?php echo site_url(''); ?>">AeroNet.io</a>  
                    </ul>
       
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-12"><br/><br/>
                    <ul class="pull-right" >
                        <li><a href="<?php echo site_url('privacy'); ?>"><i>Security</i></a></li>
                         <li><a href="<?php echo site_url('terms'); ?>"><i>Terms of Use</i></a></li>
                        <li><a href="<?php echo site_url('sitemap'); ?>"><i>Site Map</i></a></li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="<?php echo RIZ_ASSETS; ?>js/jquery.js"></script>
    <script src="<?php echo RIZ_ASSETS; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo RIZ_ASSETS; ?>js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo RIZ_ASSETS; ?>js/jquery.isotope.min.js"></script>
    <script src="<?php echo RIZ_ASSETS; ?>js/main.js?<?php echo time(); ?>"></script>
    <script src="<?php echo RIZ_SKIN; ?>js/notify.min.js"></script>
    <script src="<?php echo RIZ_ASSETS; ?>js/public.js"></script>
    <script src="<?php echo RIZ_ASSETS; ?>js/dropzone.js"></script>
    <script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/jquery.emojiarea.js"></script>
    <script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/public.js"></script>
    <script src="<?php echo RIZ_ASSETS; ?>js/custom.js"></script>
    <script src="<?php echo RIZ_ASSETS; ?>js/wow.min.js"></script>
    <script src="<?php echo RIZ_ASSETS; ?>js/autoComplete/jquery.autocomplete.js"></script>
    <!-- popSelect jQuery plugin -->
    <script src="<?php echo RIZ_ASSETS; ?>js/jquery.popSelect.min.js"></script>
    <!-- Initilization Scripts -->

    <script src="https://vjs.zencdn.net/7.1.0/video.js"></script>

</body>
</html>
