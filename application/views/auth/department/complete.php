<section id="main-sliderBlack" style="height:180px;">
<div class="center wow fadeInDown"><p class="pt-40"></p><h2>Sign Up Complete</h2> </div>      
</section>
<section id="feature">
	<div class="container" style="padding:10px; ">
            		<div class="col-xs-12 col-md-8 col-md-offset-2">
                        
								<h4><?php echo get_input_value($data,'user_fname','user_fname').' '.get_input_value($data,'user_lname','user_lname');?></h4>
								<h5 class="black"><?php echo get_input_value($data,'user_email','user_email');?></h5>
								
								<p class="pt-30">
								<h5> Thank you for signing up with  AeroNet.io
									Your account has been created successfully.</h5>
								<?php if(get_input_value($data,'user_source','user_source') != 'linkedin'):?>
								An email with an activation link is sent on your email address. Please click on activation link to activate your account.
								<p class="pt-30">
								<a href="?send_activation=<?php echo urlencode(base64_encode(get_input_value($data,'user_email','user_email')));?>">Click here to resend activation link or check SPAM. </a>
								<?php else: ?>
								<!--Since you signed up with LinkedIn your account is now active.-->
								<?php endif; ?>
								</p>
                               					</div>
			</div><!--/.carousel-inner-->
</section><!--/#about-->
<style>.alert{
    position:fixed; 
    top: 5px; 
    left: 25%; 
    width:72%;
    z-index:9999; }
</style>