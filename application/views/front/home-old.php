<section id="main-slider" class="no-margin">
    <div class="carousel slide" data-ride="carousel" data-interval="3000">
        <div class="carousel-inner">
            <div class="item active" style="background-image: url(<?php echo RIZ_ASSETS; ?>images/slider/bgg.jpg);?>">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-md-12 col-xs-12">
                            <div class="carousel-content">
                                <h1 class="animation animated-item-1" style="margin-top:25px;"> The Aviation Network </h1>
                                <h2 class="animation animated-item-2">
                                    Where opportunities take flight.
                                </h2>
                                
                                <div class="shadow-bringer3">
                                    <form class="form" method="post" action="<?php echo site_url('register/pilot/confirm'); ?>">
                                    <div id="Div1" >
                                        
                                            <input type="hidden" name="action" value="register_pilot_step_1" />
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-1">
                                                    <div class="form-level2">
                                                        <input class="name" type="text" name="first_name" placeholder="First Name *" value="" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-level2">
                                                        <input class="name" type="text" name="last_name" placeholder="Last Name *" value="" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-level2">
                                                        <button class="button-home">Find My Profile</button></form>
                                                        <br/>
                                                        <div class="button-maint" onclick="location.href='#flight'" style='margin-top:25px;'>Flight Departments</div>
                                                    </div></div>
                                </div>
                                
                    </div> </div>            
                    </div><!--/.carousel-inner-->
                </div></div></div></div>            
                    <!--/.carousel-->

</section><!--/#main-slider-->


<section id="recent-works">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2><a href="#">Join Today.   It's Free.</a></h2>
            
            <h2 style="color:#173861;"> FAA Verification is Instant and Secure</h2>
<img src="<?php echo(IMG.'profiles.PNG');?>"  style='width:102%;'>
        
         
            
        </div>
     <!--   

        <img src="<?php //echo(IMG.'imageNetwork.jpeg');?>"  style='width:102%;'>
    -->
    </div>



    </div></div><!--/.container-->




</section>

<section id="feature" style="margin-top: -35px;" >

    <div class="container">
        <div class="center wow fadeInDown">
                <img class="center-block" src="<?php echo(IMG.'services/logbook.PNG');?>" class="center-block" width="125">
        <h3 style="color:#000">Connect</h3>
                          <p class="lead">Stay connected with colleagues, flight departments, and your local GA community.</p>
                            
        </div>
</div> 
</section>

<section id="feature" style="background-color:#fff;" style="margin-top: -25px;">
    <div class="container">
        <div class="center wow fadeInDown">
            <img src="<?php echo(IMG.'services/club.PNG');?>" class="center-block" width="125">
            
         <h3 style="color:#000">Pro Opportunities </h3>
        <p class="lead"> Discover professional opportunities through your network, our jobs board, and directly from flight departments.  </p>
                                        
        </div>
        
        </div>
</section>

<section id="feature" style="margin-top: -25px;" >

    <div class="container">
        <div class="center wow fadeInDown">
                <img class="center-block" src="<?php echo(IMG.'services/directory.PNG');?>" class="center-block" width="125">
        <h3 style="color:#000">  GA Opportunities  </h3>
                          <p class="lead">
                           Discover training opportunities through  FAA 'WINGS' online courses, our safety-pilot network, and the CFI connect board.  
                          </p>
                                       
        </div>
</div> 
</section>

<section id="feature" style="background-color:#fff;" style="margin-top: -25px;">
    <div class="container">
        <div class="center wow fadeInDown">
            <img  src="<?php echo(IMG.'services/flight.PNG');?>" class="center-block" width="125">
            
         <h3 style="color:#000">News/Forums </h3>
                          <p class="lead">Follow trending news, even contribute your own.  </p>                               
        </div>
        
        </div>
</section>



<section id="conatcat-info"> 

    <div class="container">
<a id="flight"></a>
        <div class="row">

            <div class="col-sm-8">
                <div class="media contact-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                   
                    <div class="media-body" style="opacity:0.9;background-color:#f5f5f5;">
                        <div style="color:#000;padding:15px;">
                            <h2>FLIGHT DEPARTMENTS</h2>
                            <br/>
                            <h4>Crew Recruiting, Hiring and HR Solutions  </h4>
                            
                            <ul class="hm" style="margin-left:5px;">
                                <li class="hm"> Access AeroNet's professional network.</li>
                                <li class="hm"> Let AeroNet's 'best match'  algorithms build top tier talent pools.</li>
                                <li class="hm"> View candidates beyond a resume.</li>
                                <li class="hm"> Request background checks and resume verifications, conveniently and securely.</li>
                                <li class="hm"> Two ways to conduct online video interviewing.</li>
                                <li class="hm">  Hire right, with confidence-quickly.</li>
                                &nbsp; <a class="hm" href="<?php echo site_url('pilot-recruitment'); ?>"> Tell me more. </a>
                                
                            </ul>
                            
                            <h5 style="color:#666;text-align:center;">Create a free AeroNet Flight Department Page</h5>
                          <br/>
                          <form class="form" method="post" action="<?php echo site_url('register/department'); ?>" autocomplete="off" autocomplete="false">
                                <input type="hidden" name="action" value="register_department_step_1" />
                                <div class="row">
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12" style="padding-bottom: 10px;">
                                        <div class="form-level2">
                                            <input name="companyname" id="companyname" style="border-radius: 0;margin-bottom:0" value="<?php echo set_value('companyname');?>"placeholder="Flight Department / Company Name *" type="text" />
                                            <ul class="companyname_suggestion" style="z-index: 100;">

                                            </ul>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-level2 text-center">
                                            <button class="button-main" id="search-regsiter-button" style="padding:15px 10px 15px 10px;">Create a Flight Department Page</button></div>
                                    
                                    
                                    </div>


                            </form>
                            <br/>
                            <div class='col-md-12 col-xs-12'>
                            <h6 style="color:#666;text-align:center;">* All you need to get started is an "N" number and a verified email address.</h6>
                          </div>
                            
                            <div style='height:165px;'></div>  
                            
                        </div>
                        </div>
                </div>
                </div>
        </div> </div>



<a href="#" class="btn btn-primary btn-lg back-to-top"><i class="fa fa-angle-up"></i></a>
    </div><!--/.container-->
</section><!--/#conatcat-info-->
