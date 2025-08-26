<section id="main-sliderHome" class="no-margin">
    <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="header-content">
                        <h1 class="animation animated-item-1">The Aviation Network </h1>
                                
                    <h5 class="animation animated-item-2"> Never Miss A Career Opportunity. </h5>
                        <div class="header-content-inner">
                                    <form class="form-level2" method="post" action="<?php echo site_url('register/pilot/confirm'); ?>">
                                           <input type="hidden" name="action" value="register_pilot_step_1" />
                                           <div class="clear"></div>
                                           <p><label class="col-1-3"><input class="name" type="text" name="first_name" placeholder="First Name *" value="" required /></label>
    <label class="col-1-3"><input class="name" type="text" name="last_name" placeholder="Last Name *" value="" required /></label>
    <label class="col-1-3"><button class="button-home" type="submit">Find My Profile</button></label></p>
                                           <div class="clear"></div><p class="pt-10">Already on AeroNet? <a class="underline" href="<?php echo site_url('login'); ?>">Sign In</a></p>
    <label class="col-1-3"><button class="button-maint" type="button" onclick="location.href='#flight'" id="slide1">Flight Departments</button></label>
    </form>         
                    </div>
                    </div>
                    </div>
                </div>
                
            </div>
           

</section>

<section id="main-slider" style="margin-top:-10px;">  
<div class="segment"><p class="pt-50"></p><h2>Bringing Great People and Great Flight Departments Together.</h2></div>
<div class="down-arrow">
<div class="down-arrow-pad"></div>
<div class="down-arrow-indent"></div>
<div class="down-arrow-pad"></div>
</div>
<div  class="content-screen-width img-fade-bg">
    <div style="width:100%;height:auto;background-color:#fff;padding-top:40px;padding-bottom:25px;">
        <img  src="<?php echo RIZ_ASSETS; ?>images/slider/FlightNetwork.jpg" class="center-block img-responsive">
    </div>
</div>
 <p class="pt-20"></p> 
</section>
<section id="featureW">
<div class="container">
    <div class="col-md-12 col-xs-12 wow fadeInDown">
                  
                    <div class="clients-comments text-center">
                        <img   src="<?php echo RIZ_ASSETS; ?>images/image2.png" class="center-block" >
                        <p class="pt-5"></p>
                        <h3><b>Aviation Talent</b></h3> 
                        
                        <h5>  Pilots | FAs | Mechanics | Dispatchers </h5>
                       <p class="pt-20"></p>
                        <h4>1</h4><h5 class="black">
                            <b>Showcase your aviation CV</b> beyond a resume, stay connected with colleagues, and follow flight department career pages.</h5> 
<p class="pt-30"></p>
<h4>2</h4><h5 class="black">
<b>Confidentially submit your resume </b>into  a flight department’s Applicant Tracking Systems (ATS) and continually update your professional  progression.
</h5>
<p class="pt-30"></p> 
<h4>3</h4><h5 class="black">
    <b>Discover opportunities</b> through your network and directly from flight departments!</h5>
                           
                    <p class="pt-30"></p>
                    <a  href="<?php echo site_url('register/'); ?>">
                       <button class="button-main3">Sign Up. It’s Free.</button>
                    </a>
                       
                    </div>
                </div>
        </div><!--/.container-->

</section>

<section id="feature">
    <div class="container">
        <div class="center wow fadeInDown">
            <div class="clients-comments text-center">
                        <img src="<?php echo RIZ_ASSETS; ?>images/image4.PNG" class="center-block" style="background-color:#F2F2F2;">
                        <p class="pt-5"></p>
                        <h3><b>Flight Departments</b></h3>
                        <h5> 91 | 135 | 61 | 141</h5>
                        <p class="pt-20"></p>
                       
 <h4>1</h4>
 <h5 class="black"><b>Showcase your aircraft,</b> build your employer brand, and fill talent pipelines.</h5> 
<p class="pt-30"></p>
 <h4>2</h4>
 <h5 class="black"><b>Recruit and source top tier talent</b> with AeroNet’s Applicant Tracking Software (ATS) built for small and mid size flight departments
     with work flows that mirror air carrier internal HR processes.</h5>
<p class="pt-30"></p>
<h4>3</h4><h5 class="black">
Take back control, gain precious time, and <b>manage hiring like never before!</b></h5>
<p class="pt-30"></p>
<a  href="<?php echo site_url('register/department'); ?>">
                       <button class="button-main3">Sign Up. It’s Free.</button>
                    </a>
       </div>          
        </div>
        </div>

</section>



<section id="carousel-slider">
        
       
      <!-- Swiper -->
  <div class="swiper-container"><a name="flight"></a>  
        <div class="center wow fadeInDown">
             <h2>Flight Department</h2>
             <h3 style="color:#fff;"> Applicant Tracking Software</h3>
             
                             
        </div>
    
    <div class="swiper-wrapper">  
        <div class="swiper-slide" id="slide1">
       <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-xs-12" >
                                <div class="carousel-contents">
                                    
                               <div align='center'>
                                     <img src="<?php echo(IMG.'slider/flightdepartment.jpeg');?>" class="img-responsive">
                               </div>
                                <p class="pt-20"></p> <!--<h1 style="text-align:center;font-size:20px;">
                                    Build your employer brand for free.</h1>-->
                                   
                                    <div class="animation animated-item-2">
                                <form class="form" method="post" action="<?php echo site_url("register/department"); ?>" autocomplete="off" autocomplete="false">
                                        <input type="hidden" name="action" value="register_department_step_1" />
                                        <div class="row">
                                            <div class="col-md-12">       
                                            <div class="form-level2">
                                             <div class="col-md-1 col-xs-2" style="padding:0px;"> <input name="no" value="N" placeholder="N"  type="text" readonly /></div>
                                            <div class="col-md-9 col-xs-10" style="padding:0px;"><input name="nnumber" id="nnumber" value="<?php echo set_value('nnumber');?>" placeholder="Enter Your N Number" type="text"/>
                                            </div></div>
                                                
                                                <div class="form-level2">
                                                   <button class="button-main2" id="search-regsiter-button"> Get Started. It's Free.</button></div>
                                     </div>
                                            </div>
                                        </form> 
                                        </div>
                                           
                                        
                                   <p class="pt-20"></p>
                          </div></div>
                    </div>
  </div> </div>     
        
        <div class="swiper-slide">
         <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="carousel-contents">
                                    <div align='center'><img src="<?php echo(IMG.'slider/Recruit.jpg');?>" class="img-responsive"></div>
                                    <h1 >Recruit </h1>
                                    
                                    <h2>
                                        Showcase your aircraft and allow members to follow
                                        your career page.</h2>
                                       
                                    <a class="btn-slide" href="pilot-recruitment">Tell me more</a>
                                   <p class="pt-20"></p> 
                                </div>
                            </div>

                            
                        </div>
                    </div>   
        </div>
        <div class="swiper-slide">
        <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="carousel-contents">
                                    <div align='center'> <img src="<?php echo(IMG.'slider/Source.jpg');?>" class="img-responsive"></div>
                                    <h1 >Source </h1>
                                   
                                    <h2>
                                    Applicant Tracking Software (ATS) built around your aircraft and culture.
                                   </h2>
                                    
                                    <a class="btn-slide" href="hiring-solutions">Tell me more</a>
                                    <p class="pt-20"></p>
                                </div>
                            </div>

                            
                        </div>
                    </div>    
            
        </div>
        
        <div class="swiper-slide">
        <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="carousel-contents">
                                    <div align='center'>           
<div class="js-video widescreen">  
    <video  class="video-js" controls  poster="<?php echo(IMG.'video/poster.jpg');?>" >
<source src="<?php echo(IMG.'video/hire.mp4');?>" type="video/mp4" />
</video>
 </div>    </div>                          
                                    <h1> Hire </h1>
                                   
                                    <h2> Stay ahead of hiring with our NextGen approach to crew staffing.</h2>
                                    
                                   
                                     <a class="btn-slide" href="register/department" id="slide3">Sign Up. It’s Free.</a>
                                     <p class="pt-20"></p>
                                </div>
                            </div>

                            
                        </div>
                    </div>    
            
        </div>   
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
  </div>                            
</section>