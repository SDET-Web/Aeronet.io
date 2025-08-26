<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo get_title(); ?> </title>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    <link href="<?php echo RIZ_ASSETS; ?>css/main.css" rel="stylesheet"> 
    <link href="<?php echo RIZ_ASSETS; ?>css/site.pages.css" rel="stylesheet">  
     
<script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-47963409-1', 'lazy-eights.com');
        ga('send', 'pageview');
    </script>
    <script src="//code.jquery.com/jquery-latest.js" type="text/javascript"></script>
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
     
    <?php  echo isset($data['map']['js'])?$data['map']['js']:''; ?>
</head><!--/head-->

<body>
        <header id="header">

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            
            <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                                
                
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"></span> <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand"  href="<?php echo site_url(''); ?>"><img class="img-responsive" src="<?php echo RIZ_ASSETS; ?>images/logo.png" alt='AeroNet'></a>

            </div>
            
            
<!--
<div class="col-md-3 col-xs-4 pt-20">
 <?php //if($this->session->userdata('user_id')==''): ?>
 <a class="topbox" href="<?php //echo site_url('login'); ?>"> &nbsp; <i class="fas fa-sign-in-alt"></i>  Login</a> </div>
 <?php //else: ?>
   <a class="topsmall" href="<?php //echo site_url('dashboard'); ?>"> My Account</a><br/>
   <a class="topbox" href="<?php //echo site_url('logout'); ?>"> <i class="fas fa-sign-out-alt"></i> Logout </a>
 <?php //endif; ?> -->



<div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo site_url('about'); ?>">ABOUT</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">AVIATION TALENT <i class="fa fa-angle-double-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('career-center'); ?>">Job Search NextGen </a></li>
                                <li><a href="<?php echo site_url('salary'); ?>">Salary Navigator </a></li>
                               

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">FLIGHT DEPARTMENTS <i class="fa fa-angle-double-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('pilot-recruitment'); ?>">Recruiting Solutions</a></li>
                                <li><a href="<?php echo site_url('hiring-solutions'); ?>">Hiring Solutions</a></li>
                               <!-- <li><a href="<?php echo site_url('onboard'); ?>">AeroNet Onboard</a></li>
                                <li><a href="<?php //echo site_url('faq'); ?>">Post a Job</a></li>-->
                               <li><a href="<?php echo site_url('pricing'); ?>">Pricing</a></li>
                            </ul>
                        </li>
                        <li>                       
 <?php if($this->session->userdata('user_id')==''): ?>
 <a href="<?php echo site_url('login'); ?>">SIGN IN</a>
  <?php else: ?>
   <a href="<?php echo site_url('dashboard'); ?>"> My Account</a>
   <a href="<?php echo site_url('logout'); ?>"> Sign Out </a>
 <?php endif; ?></li>
                    </ul>

        </div>
            </div><!--/.container-->
        </nav><!--/nav-->

        </header>



<style>.alert{
    position:fixed; 
    top: 5px; 
    left: 25%; 
    width:72%;
    z-index:9999; }
</style>
<?php echo pop_message(); ?>

<?php (isset($data)?$this->load->view($view,$data):$this->load->view($view)); ?>



    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <ul>
                        <li><a href="<?php echo site_url('directory/search'); ?>"><b>Directory</b></a></li>
                        <li><a href="<?php echo site_url('contact'); ?>"><b>Support</b></a></li>
                         <br/>
                         <a target="_blank" href="<?php echo site_url(''); ?>">AeroNet.io</a> is a member of NBAA

                <br/>
                &copy; 2024 <a target="_blank" href="<?php echo site_url(''); ?>">AeroNet.io</a>
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
<div class="modal fade" id="rejModal" role="dialog"></div>
<div class="modal fade" id="apprModal" role="dialog"></div>
<script defer="defer" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.3/js/all.min.js" ></script>
<script src="<?php echo RIZ_ASSETS; ?>js/jqueryFlight.js" defer="defer"></script>
<script src='<?php echo RIZ_ASSETS; ?>js/flightslide.js' defer="defer"></script>
<script src="<?php echo RIZ_ASSETS; ?>js/public.js" defer="defer"></script>
<script src="<?php echo RIZ_ASSETS; ?>js/custom.js"></script>
  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) --> 
</body>
</html>
