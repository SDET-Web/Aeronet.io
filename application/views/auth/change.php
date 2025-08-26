<section id="main-sliderBlack" style="height:auto;padding:10px;">
<div class="center wow fadeInDown"><p class="pt-30"></p> </div>      
</section><section id="feature">
    <div class="container">
        <div class="row">
            
            <div class=" col-md-5 col-sm-12 col-xs-12 col-md-offset-1">
                 <h1>Update Password</h1>
                <form class="form" method="post" id="changePassword">
                    <input type="hidden" name="action" value="change" />
                    <div class="form">
                        <?php form_new_input_updated('','userPassword',$this->input->post('userPassword'),true,'password','','New Password','<span class="form-icon fa fa-lock"></span>'); ?>
                        <?php form_new_input_updated('','userPasswordConfirm',$this->input->post('userPasswordConfirm'),true,'password','','New Password (Confirm)','<span class="form-icon fa fa-lock"></span>'); ?>
                        <div class="form-level">
                            <button type="submit" value="Login Now" class="buttons button-blue" > Login Now</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class=" col-md-6 col-sm-12 col-xs-12" > <br/>
                <a href="<?php echo site_url('/register'); ?>"><div class="shadow-bringerd">Talent Signup </div></a>
               <a href="<?php echo site_url('/register/department'); ?>"><div class="shadow-bringerd">Flight Department Signup </div></a>
                <a href="<?php echo site_url('login'); ?>"><div class="shadow-bringerd">Login </div></a>
            </div>
            
            
        </div><!--/.row-->
    </div>
</section><!--/#about-->
