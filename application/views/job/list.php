<section id="content" style="padding: 70px 0 0 0">
	<div class="container">
        <div class="center wow fadeInDown" style="padding-bottom: 0px">
            <?php if (is_logged_in() && $this->session->userdata('user_type') == 'd'): ?>
               
                <h4 style="text-align:center;">To post a new Job, please select a type from below</h4>
                <div class="row">

                    <div class="col-md-3 col-sm-3 col-xs-6 serviceType" id="p">
                        <a href="<?php echo site_url('/flight-board-subscription/p'); ?>">
                            <div align="center"><h5 class="about-us">Pilots</h5>
                            <img class="center-block" src="<?php echo RIZ_ASSETS; ?>images/service/pilot.jpeg">    
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-6 serviceType" id="m">
                        <a href="<?php echo site_url('/flight-board-subscription/m'); ?>">
                            <div align="center"><h5 class="about-us">Mechanic</h5>
                               <img class="center-block" src="<?php echo RIZ_ASSETS; ?>images/service/mechanic.png">
                       
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-6 serviceType" id="a">
                        <a href="<?php echo site_url('/flight-board-subscription/a'); ?>">
                            <div align="center"><h5 class="about-us">Flight Attendent</h5>
                            <img class="center-block" src="<?php echo RIZ_ASSETS; ?>images/service/fattendent.png">
                                                
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 serviceType" id="d">
                        <a href="<?php echo site_url('/flight-board-subscription/d'); ?>">
                            <div align="center"><h5 class="about-us">Flight Dispatcher</h5>
                              <img class="center-block" src="<?php echo RIZ_ASSETS; ?>images/service/fdispatcher.png">
                        
                            </div>
                        </a>
                    </div>

                </div>

            <?php else: ?>
                <h1 class="about-us">Jobs Board</h1><br/>
            <?php endif; ?>

        </div>
		
		<div class="clearfix"></div><br/>

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
												<?php echo $this->Model_job->search(true,'p'); //s ?>
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
										<?php echo $this->Model_job->search(true,'m'); // c ?>
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
										<?php echo $this->Model_job->search(true,'f'); // r ?>
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
										<?php echo $this->Model_job->search(true,'d'); //f ?>
									</div>
								</div>
							</div>
						</div>
					</div><!--/#accordion1-->
				</div>
			</div>


		</div>
<br/><br/>
	</div><!--/.container-->
</section><!--/#content-->
