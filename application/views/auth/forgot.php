<section id="main-sliderBlack" style="height:auto;padding:10px;">
<div class="center wow fadeInDown"><p class="pt-30"></p> </div>      
</section>
<section id="feature">
    <div class="container">
        <div class="row">
            <div class=" col-md-5 col-sm-12 col-xs-12 col-md-offset-1">
                 <h1>Recover Password</h1>
                <form class="form" method="post" id="forgotPassword">
                    <input type="hidden" name="action" value="forgot" />
                    <div class="form">
                        <?php form_new_input_updated('','userEmail',$this->input->post('userEmail'),true,'text','','Your Email *','<span class="form-icon fa fa-user"></span>'); ?>
                        <div class="form-level">
                            <button type="submit" value="Login Now" class="buttons button-blue" > Login Now</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class=" col-md-6 col-sm-12 col-xs-12" > <p class="pt-30"></p>
                <a href="<?php echo site_url('/register'); ?>"><div class="shadow-bringerd">Talent Signup </div></a>
               <a href="<?php echo site_url('/register/department'); ?>"><div class="shadow-bringerd">Flight Department Signup </div></a>

            </div>
        </div><!--/.row-->
        <!--/.item-->
    </div><!--/.carousel-inner-->
</section><!--/#about-->
