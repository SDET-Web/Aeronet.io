<section id="feature">
	<div class="container">
		<div class="center wow fadeInDown">
			
			<div class="row clearfix">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
					<div class="single-profile-bottom wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
						<div class="media">
							<div class="media-body">
								<h4><?php echo $pilot['user_fname'].' '.$pilot['user_lname'];?></h4>
								<br/>
								<h5> Thank you for signing up with AeroNet.io
									Your account has been created successfully.</h5>
								<?php if(isset($pilot['user_source']) &&  $pilot['user_source'] == 'linkedin'):?>
								<!--Since you signed up using LinkedIn your account is already active, trry login with LinkedIn.-->
								<?php else: ?>
								An email with an activation link is sent on your email address. Please click on activation link to activate your account.
                                                                <p class="pt-20"></p>
								<a href="?send_activation=<?php echo urlencode(base64_encode(get_input_value($data,'user_email','user_email')));?>">Click here to resend activation link or check SPAM. </a>
								<?php endif; ?>
							</div><!--/.media -->
						</div>
                                            <div class="clearfix"><p class="pt-30"></p></div>
                                           					</div>
					
				</div>
			
			</div>
		</div>
	</div>
</section>
