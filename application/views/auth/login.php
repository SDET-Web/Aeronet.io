<section id="main-sliderLogin" class="no-margin">
    <div class="container"><div class="header-content">
        <div class="row">
            <div class=" col-md-5 col-sm-12 col-xs-12 col-md-offset-1 ">
                
                <h1>Members Login</h1><p class="pt-30"></p>
                <form class="form" method="post" id="loginMemeber" action="<?php echo site_url('login'); ?>">
                    <input type="hidden" name="action" value="login" />
                    <input type="hidden" name="json" value="" />
                     <div class="form">
                       <!-- <button type="button" class="linked-in-login ln-signin"></button>-->
                        <div class="clearfix">&nbsp;</div>
                        <?php form_new_input_updated('','userLoginEmail',$this->input->post('userLoginEmail'),true,'text','','Your Email *','<span class="form-icon fa fa-user"></span>'); ?>
                        <?php form_new_input_updated('','userLoginPassword',$this->input->post('userLoginPassword'),true,'password','','Your Password','<span class="form-icon fa fa-lock"></span>'); ?>
                        <div class="form-level">
                            <button type="submit" value="Login Now" class="buttons button-blue" > Login Now</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class=" col-md-6 col-sm-12 col-xs-12" > <br/>
                <a href="<?php echo site_url('/register'); ?>"><div class="shadow-bringerd">Talent Signup </div></a>
               <a href="<?php echo site_url('/register/department'); ?>"><div class="shadow-bringerd">Flight Department Signup </div></a>

               <!-- <a href="mailto:admin@lazy-eights.com"><div class="shadow-bringerd">Click Here For Login Problem </div></a>-->
                <a href="<?php echo site_url('forgot'); ?>"><div class="shadow-bringerd">Forgot My Password </div></a>
            </div>
        </div><!--/.row-->
        <!--/.item-->
    </div></div><!--/.carousel-inner-->
</section><!--/#about-->
