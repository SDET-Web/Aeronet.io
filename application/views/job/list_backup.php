<section id="content">
	<div class="container">
		<div class="center wow fadeInDown">
			<?php if(is_logged_in() && $this->session->userdata('user_type') == 'd'): ?>
			<h1 class="about-us">Post A Job</h1>
                        <h4 style="text-align:center;">To post a new Job, please select a type from below</h4>
                        <div class="row">
			
			<div class="col-md-3 col-sm-3 col-xs-6 serviceType" id="p">
                            <a href="#" onclick="showPostForm('p');">
				<div align="center"> <h5 class="about-us">Pilots</h5>
					<img class="center-block" onclick="showPostForm('p');"	src="<?php echo RIZ_ASSETS; ?>images/service/pilot.jpeg">
				</div></a>
			</div>

			<div class="col-md-3 col-sm-3 col-xs-6 serviceType" id="m">
                             <a href="#" onclick="showPostForm('m');">
				<div align="center"> <h5 class="about-us">Mechanic</h5>
					<img class="center-block" onclick="showPostForm('m')"	src="<?php echo RIZ_ASSETS; ?>images/service/mechanic.png">
				</div></a>
			</div>

			<div class="col-md-3 col-sm-3 col-xs-6 serviceType" id="a">
                             <a href="#" onclick="showPostForm('a');">
				<div align="center"><h5 class="about-us">Flight Attendent</h5>
					<img class="center-block" onclick="showPostForm('a')" src="<?php echo RIZ_ASSETS; ?>images/service/fattendent.png">
				</div></a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 serviceType" id="d">
                             <a href="#" onclick="showPostForm('d');">
				<div align="center"><h5 class="about-us">Flight Dispatcher</h5>
					<img class="center-block" onclick="showPostForm('d')"  src="<?php echo RIZ_ASSETS; ?>images/service/fdispatcher.png">
				</div></a>
			</div>

		</div>
		
                        <?php else:?>                        
                        <h1 class="about-us">Jobs Board</h1><br/>
                        <div class="row">
			
			<div class="col-md-3 col-sm-3 col-xs-6">
                
				<div align="center"> <h5 class="about-us">Pilots</h5>
					<img class="center-block" src="<?php echo RIZ_ASSETS; ?>images/service/pilot.jpeg">
				</div>
			</div>

			<div class="col-md-3 col-sm-3 col-xs-6">
                            
				<div align="center"> <h5 class="about-us">Mechanic</h5>
					<img class="center-block" src="<?php echo RIZ_ASSETS; ?>images/service/mechanic.png">
				</div>
			</div>

			<div class="col-md-3 col-sm-3 col-xs-6">
                             
				<div align="center"><h5 class="about-us">Flight Attendent</h5>
					<img class="center-block" src="<?php echo RIZ_ASSETS; ?>images/service/fattendent.png">
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
                           
				<div align="center"><h5 class="about-us">Flight Dispatcher</h5>
					<img class="center-block" src="<?php echo RIZ_ASSETS; ?>images/service/fdispatcher.png">
				</div>
			</div>

		</div>
		
                        <?php endif; ?>
	
		</div>
		
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-sm-12 wow fadeInDown">
				<div class="accordion">
					<div class="panel-group" id="accordion1">
						<div class="panel panel-default">
							<div class="panel-heading active">
								<h3 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
										Pilots
										<i class="fa fa-angle-right pull-right"></i>
									</a>
								</h3>
							</div>

							<div id="collapseOne1" class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="media accordion-inner">
										<div class="media-body">
											<div class="table-responsive">
												<?php echo $this->Model_job->search(true,'s'); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1">
										Mechanic
										<i class="fa fa-angle-right pull-right"></i>
									</a>
								</h3>
							</div>
							<div id="collapseTwo1" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="table-responsive">
										<?php echo $this->Model_job->search(true,'c'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
										Flight Attendent
										<i class="fa fa-angle-right pull-right"></i>
									</a>
								</h3>
							</div>
							<div id="collapseThree1" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="table-responsive">
										<?php echo $this->Model_job->search(true,'r'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1">
										Flight Dispatcher
										<i class="fa fa-angle-right pull-right"></i>
									</a>
								</h3>
							</div>
							<div id="collapseFour1" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="table-responsive">
										<?php echo $this->Model_job->search(true,'f'); ?>
									</div>
								</div>
							</div>
						</div>
					</div><!--/#accordion1-->
				</div>
			</div>


		</div>

	</div><!--/.container-->
</section><!--/#content-->
<?php if(is_logged_in() && $this->session->userdata('user_type') == 'd'): ?>

<section id="feature" style="margin-top:-45px;" class="hidden">
    
    
    
    <div class="pricing-area text-center">
       
                <div class="row">
                    
<div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2 plan price-six wow fadeInDown">
                        <!-- <img src="images/ribon_two.png">-->
                        <ul>
                            <li class="heading-six">
                                <h1>
Basic </h1> <span>Free/ 30 day slot</span>
                               
                            </li>
                            <li><span><br/> <b>Post Job Opening</b></span></li>
                            <li>  <br/><span><b>View Resumes & Profiles</b></span></li>
                            <li>  <br/><span><b>Track & Manage Applicants</b></span></li>
                            
                            <li class="plan-action">
                                <a href="<?php echo site_url('register/department'); ?>" class="btn btn-primary">Subscribe Now</a>
                            </li>
                        </ul>
                    </div>
                    
                    
<div class="col-xs-12 col-sm-6 col-md-4 plan price-seven wow fadeInDown">
                        <ul>
                            <li class="heading-seven">
                                <h1> Premium </h1> <span>$99.99/ 30 day slot</span>
                              
                            </li>
                            <li><span><br/><b>Post Job Opening</b></span></li>
                            <li> <br/><span> <b>Sends Career Notification Email Alerts)</b></span></li>
                            <li> <br/><span><b>            Aviation Specific Addendum</b></span></li>
                             <li><span><br/> <b>             Talent Assessment Test</b> </span></li>
                            <li> <br/><span> <b>  View Resumes, Profiles, & Attachments</b></span></li>
                            <li>  <br/><span> <b>   Track & Manage Applicants</b></span></li>
                           
                            <li class="plan-action">
                                <a href="register/department" class="btn btn-primary"> Subscribe Now </a>
                            </li>
                        </ul>
                    </div>
                    </div>
 </div><!--/pricing-area--> 
    
    
	<a name="post"></a>  <div class="container">
				<div class="row"><div class="col-md-10 col-xs-12 col-md-offset-2" style="margin-top:-30px;">
				<form name="form" method="post">
					<input type="hidden" name="action" value="postJob" />
					<input type="hidden" name="aircraftEmail" value="<?php echo $this->session->userdata('user_email'); ?>" />
					<input type="hidden" name="ownerFName" value="<?php echo $this->session->userdata('user_fname'); ?>" />
					<input type="hidden" name="ownerLName" value="<?php echo $this->session->userdata('user_lname'); ?>" />
					<input type="hidden" name="ownerEmail" value="<?php echo $this->session->userdata('user_email'); ?>" />
					<input type="hidden" name="ownerNumber" value="<?php echo $this->session->userdata('user_phome'); ?>" />
					<?php form_new_select_updated(select_job_type(), "Looking for","type",$this->input->post('type'), true,'','','','onchange="showPostForm($(this).val())"'); ?>
                    <div class="form-level">
                        <p>Post Category</p>
                        <select id="post_category" name="post_category">
                            <option value="free">Free post</option>
                            <option value="premium">Premium post for $99</option>
                        </select>
                    </div>
                    <?php form_new_select_updated(select_aircraft_make(), "Choose Aircraft Make","aircraftMake",$this->input->post('aircraftMake'), true); ?>
					<?php form_new_select_updated(select_aircraft_model(), "Choose Aircraft Model","aircraftModel",$this->input->post('aircraftModel'), true); ?>
					<?php form_new_select_updated(select_state(), "Location(Airport)","state",$this->input->post('state'), true); ?>
					<div class="form-level"><p>Your Aircraft Picture (optional)</p>
						<input type="file" name="userfile" id="photo" />
					</div>
					<?php form_new_textarea_updated('Job Description','aircraftDesc',$this->input->post('aircraftDesc'),true,3,'','',''); ?>
                    <?php form_new_textarea_updated('Job Requirements','job_requirements',$this->input->post('job_requirements'),true,3,'','',''); ?>
                    <br/>
                                        <div class="form-level2"><button class="button-main2">  Post  </button>&nbsp;<button type="button" class="button-main2" style="background:#333" onclick="window.location.replace('flight-dispatch-board');">  Back  </button></div>
					<br/><br/>
				</form>
			</div>
		</div>
</section>
<?php endif; ?>
<script type="text/javascript">
	function showPostForm(type){
		$('#feature').removeClass('hidden');
		$('#type').val(type);
		$('.accordion').addClass('hidden');
		$('.serviceType').addClass('hidden');
		$('#' + type).removeClass('hidden');
	}

	function hidePostForm(){
		$('#feature').addClass('hidden');
		$('.accordion').removeClass('hidden');
		$('.serviceType').addClass('hidden');
	}
	<?php if($this->input->get('formType')!=''): ?>
	showPostForm('<?php echo $this->input->get('formType'); ?>');
	<?php endif; ?>
</script>
