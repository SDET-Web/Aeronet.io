
<div class="vd_content-section clearfix">
	<div class="row">
		<div class="col-sm-3">
			<div class="panel widget light-widget panel-bd-top">
				<div class="panel-heading no-title"> </div>
				<div class="panel-body">
					<div class="text-center vd_info-parent"> <img alt="example image" src="<?php echo get_user_pic_url(get_data_value($data,'user_image')); ?>"> </div>
					<br /><br />
					<div class="row">
						<div class="col-xs-12"><h2 class="font-semibold mgbt-xs-5"><?php echo get_data_value($data,'user_company'); ?></h2><?php echo get_data_value($data,'user_bio'); ?></div>
					</div>
					<h4> Verified Aircrafts</h4>
					<p>
						<?php if(count($data['aircraft'])): ?>
							<?php foreach($data['aircraft'] as $key=>$item): ?>
								<?php echo $item['mfr_name'].' '.$item['model_name']; ?><br />
							<?php endforeach; ?>
						<?php endif; ?>
						 </p>

					<br />
					<br />
					<table class="table table-striped table-hover">
						<tbody>
						<tr>
							<td style="width:60%;">Status</td>
							<td><span class="label label-<?php $tmp = get_select_user_status(get_data_value($data,'user_status'));echo $tmp[1]; ?>"><?php echo $tmp[0]; ?></span></td>
						</tr>
						<tr>
							<td>Profile Completed</td>
							<td><div class="progress">
									<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo get_data_value($data,'user_profile_percent'); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo get_data_value($data,'user_profile_percent'); ?>%">
										<span class="sr-only"><?php echo get_data_value($data,'user_profile_percent'); ?>% Complete</span>
									</div> &nbsp;<?php echo get_data_value($data,'user_profile_percent'); ?>%
								</div></td>
						</tr>
						<tr>
							<td>Flight Times Last Updated</td>
							<td> <?php echo get_data_value_date($data,'user_modified'); ?> </td>
						</tr>
						</tbody>
					</table>

				</div>
			</div>
			<!-- panel widget -->

			<div class="panel widget light-widget">
				<div class="panel-body-list">
					<h3 class="pd-20 mgbt-xs-0"><i class="fa fa-users mgr-10"></i>Pilot Pool</h3>
					<div class="content-grid column-xs-2 column-sm-3 height-xs-auto mgbt-xs-20">
						<div>
							<ul class="list-wrapper">
								<?php if(count($data['pool'])): ?>
									<?php for($i = 0; $i < (count($data['pool']) > 9?9:count($data['pool']));$i++): $item = (array)$data['pool'][$i]; ?>
										<li> <a href="<?php echo site_url('pilot/'.$item['user_id']); ?>"> <span class="menu-icon"><img alt="example image" src="<?php echo get_user_pic_url($item['user_image'],$item['user_type']); ?>"></span> </a> </li>
									<?php endfor;?>
								<?php else: ?>
									<p class="text-center">No connection found</p>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<?php if(count($data['connections']) > 9): ?>
						<div class="closing text-center" style=""> <a href="#">See All Friends<i class="fa fa-angle-double-right prepend-icon"></i></a> </div>
					<?php endif; ?>
				</div>
			</div>
			<!-- panel widget -->

			<!-- panel widget -->

			<div class="panel widget light-widget">
				<div class="panel-body-list">
					<h3 class="pd-10 mgbt-xs-0">Jobs Board</h3>
					<div class="content-grid column-xs-2 column-sm-3 height-xs-auto mgbt-xs-20">
						<div>
							<a href="#">  <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/flight.jpg" class="img-responsive"></a>
						</div>
					</div>
					<div class="closing text-center" style=""> <a href="<?php echo site_url('flight-dispatch-board'); ?>">See All Listings<i class="fa fa-angle-double-right prepend-icon"></i></a> </div>
				</div>
			</div>
			<!-- panel widget -->


		</div>
		<div class="col-sm-9">
			<div class="tabs widget">
				<ul class="nav nav-tabs widget">
					<li class="active"> <a data-toggle="tab" href="#home-tab"> Home <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
					<li > <a data-toggle="tab" href="#profile-tab"> Profile <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
					<li> <a data-toggle="tab" href="#photos-tab"> Photos <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
					<li> <a data-toggle="tab" href="#friends-tab"> Pilot Pool <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
					<li> <a data-toggle="tab" href="#projects-tab"> Publish Post or News  <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>

				</ul>
				<div class="tab-content">

					<div id="home-tab" class="tab-pane active">
						<div class="pd-20">


							<div class="vd_content-section clearfix">

								<div class="row">
									<div class="col-lg-8 col-md-9">
										<div class="row">
											<div class="col-md-6 col-xs-12">
												<div class="panel widget light-widget">
													<div class="panel-body">
														<h3 class="mgbt-xs-20 mgtp-10"> <?php echo get_data_value($data,'user_company'); ?> <span class="font-light"> </span></h3>
														<div style="margin-top:-15px;">
															<a href="<?php echo site_url('setting'); ?>">Improve your profile</a>
														</div></div>

												</div>
											</div>

											<div class="col-md-6 col-xs-12">
												<div class="panel widget light-widget">
													<div class="panel-body">
														<h3 class="mgbt-xs-20 mgtp-10">  <?php echo count($data['connections']); ?> Connection <span class="font-light"> </span></h3>
														<div style="margin-top:-15px;"> <a href="<?php echo site_url('invitation'); ?>">Grow Your Network</a> </div>  </div>
												</div></div>

										</div>
										<div class="tabs">
											<ul class="nav nav-tabs widget">
												<li > <a href="#main-tab" data-toggle="tab"> <span class="menu-icon"><i class="fa fa-comments"></i></span> Share an update <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
												<li> <a href="#posts-tab" data-toggle="tab"> <span class="menu-icon"><i class="fa fa-photo"></i></span> Upload Photo <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
												<li> <a href="#list-tab" data-toggle="tab"> <span class="menu-icon"><i class="fa fa-edit"></i></span> Publish a post <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
												<li> <a href="#follow-tab" data-toggle="tab"> <span class="menu-icon"><i class="fa fa-flag"></i></span> Following <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
											</ul>
											<div class="tab-content  mgbt-xs-20">
												<div class="tab-pane active" id="main-tab">
													<div class="child-menu">

														<textarea id="post-content" class="no-bd" rows="3" placeholder="What are you doing?" ></textarea>
														<div class="image-panel" text-id="post-content"></div>
														<div class="vd_textarea-menu vd_bg-yellow vd_bd-yellow" >
															<ul class="nav nav-pills ">
																<li class="one-icon">
																	<a data-toggle="tab-post" href="javascript:void(0);">
																		<span class="menu-icon">
																			<i class="fa fa-user fa-fw"></i>
																		</span>
																	</a>
																</li>
																<li class="one-icon" id="attachments">
																	<a data-toggle="tab-post" onclick="$('#filetoattach').trigger('click');" href="javascript:void(0);">
																		<span class="menu-icon">
																		<i class="fa fa-camera fa-fw"></i>
																		</span>
																	</a>
																	<input type="file" id="filetoattach" class="hidden" />
																</li>
																<li class="one-icon">
																	<a data-toggle="tab-post" href="javascript:void(0);">
																		<span class="menu-icon">
																			<i class="fa fa-smile-o fa-fw"></i>
																		</span>
																	</a>
																</li>
																<li class="pull-right" id="post-it">
																	<a data-toggle="tab-post" href="javascript:void(0);" style="border-left:1px solid rgba(255,255,255,.3)">
																		<span class="menu-icon">
																			<i class="fa fa-check fa-fw"></i>
																		</span>
																		<span class="menu-text">
																			Post
																		</span>
																	</a>
																</li>

															</ul>

														</div>

													</div> <!-- child-menu -->

												</div>

												<div class="tab-pane" id="posts-tab">
													<div id="dropzone">
														<div id="uploadPhotos" class="dropzone"></div>
													</div>
												</div>
												<div class="tab-pane" id="list-tab">
													<div class="myeditablediv"></div>
													<a id="post-article" href="javascript:void(0);" style="border-left: 1px solid rgba(255,255,255,.3);position: absolute;bottom: 5px;right: 20px;color: #fff;padding: 0 15px;">
																		<span class="menu-icon">
																			<i class="fa fa-check fa-fw"></i>
																		</span>
																		<span class="menu-text">
																			Post
																		</span>
													</a>
												</div>
												<div class="tab-pane" id="follow-tab" style="padding:1.5em;background:#fff;">
													<?php if(count($data['departments'])): ?>
														<?php foreach($data['departments'] as $key=>$item): $item = (array)$item; ?>

															<div class="col-xs-12 col-sm-6">
																<div class="content-list content-large menu-action-right">
																	<ul class="list-wrapper pd-lr-15">
																		<li>
																			<div class="menu-icon"><a href="#"><img src="<?php echo get_user_pic_url($item['user_image'],'d'); ?>" alt="example image"></a></div>
																			<div class="menu-text">
																				<h4 class="mgbt-xs-0"><a href="#"><?php echo get_data_value($item,'user_company'); ?></a></h4>
																				<div class="menu-info">
																					<span class="menu-date"> <?php echo get_data_value($item,'user_count'); ?> members </span>

																				</div>
																				<p><?php echo substr(get_data_value($item,'user_bio'),0,100); ?>...</p>
																				<?php if($item['conn_status'] == 'connected'): ?>
																					<p><span class="label label-danger unfollow-user" object-id="<?php echo $item['user_id']; ?>">Unfollow</span></p>
																				<?php else: ?>
																					<p><span class="label label-success follow-user" object-id="<?php echo $item['user_id']; ?>">Follow</span></p>
																				<?php endif; ?>
																			</div>
																		</li>
																	</ul> <!-- list-wrapper -->
																</div> <!-- content-list -->
															</div> <!-- col-xs-12 col-sm-6 -->
														<?php endforeach;
													else:?>
														<div class="alert info">No groups uploaded</div>
													<?php endif; ?>
													<div class="clearfix"></div>
												</div>
											</div>
										</div>



										<br/><br/>
										<ul class="vd_timeline post-list"  zeroMessage="You don't have any favorite articles." barShowFuntion="" isBlocked="false" page="0" sort=""  barTitle="Favorite Articles" countContainer="#count-favorite-article" searchTerm="" url="<?php echo site_url('post/'.$this->session->userdata('user_id')); ?>" >
										</ul>
										<br/><br/>
									</div>
									<!-- col-md-x -->
									<div class="col-lg-4 col-md-3">
										<div class="panel widget light-widget">
											<?php $this->load->view('people_panel',array('dept'=>'test')); ?>
										</div>
									</div>
								</div class="row">
								<!-- row -->

							</div>
							<!-- .vd_content-section -->

						</div> <!-- pd-20 -->
					</div>  <!-- groups tab -->









					<div id="profile-tab" class="tab-pane">
						<div class="pd-20">
							<div class="vd_info tr"> <a  href="<?php echo site_url('setting'); ?>" class="btn vd_btn btn-xs vd_bg-yellow"> <i class="fa fa-pencil append-icon"></i> Edit </a> </div>
							<h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-user mgr-10 profile-icon"></i> Flight Department Info</h3>
							<div class="row">
								<div class="col-sm-6">
									<div class="row mgbt-xs-0">
										<label class="col-xs-5 control-label">Company Name:</label>
										<div class="col-xs-7 controls"><?php echo get_data_value($data,'user_company'); ?></div>
										<!-- col-sm-10 -->
									</div>
								</div>
								<div class="col-sm-6">
									<div class="row mgbt-xs-0">
										<label class="col-xs-5 control-label">Address:</label>
										<div class="col-xs-7 controls"><?php echo get_data_value($data,'user_address'); ?></div>
										<!-- col-sm-10 -->
									</div>
								</div>
								<div class="col-sm-6">
									<div class="row mgbt-xs-0">
										<label class="col-xs-5 control-label">City:</label>
										<div class="col-xs-7 controls"><?php echo get_data_value($data,'user_city'); ?></div>
										<!-- col-sm-10 -->
									</div>
								</div>

								<div class="col-sm-6">
									<div class="row mgbt-xs-0">
										<label class="col-xs-5 control-label">State:</label>
										<div class="col-xs-7 controls"><?php echo get_data_value($data,'user_state'); ?></div>
										<!-- col-sm-10 -->
									</div>
								</div>
								<div class="col-sm-6">
									<div class="row mgbt-xs-0">
										<label class="col-xs-5 control-label">Zip Code:</label>
										<div class="col-xs-7 controls"><?php echo get_data_value($data,'user_zip'); ?></div>
										<!-- col-sm-10 -->
									</div>
								</div>
								<div class="col-sm-6">
									<div class="row mgbt-xs-0">
										<label class="col-xs-5 control-label">Position:</label>
										<div class="col-xs-7 controls"><?php echo get_data_value($data,'user_position'); ?></div>
										<!-- col-sm-10 -->
									</div>
								</div>
								<div class="col-sm-6">
									<div class="row mgbt-xs-0">
										<label class="col-xs-5 control-label">First Name:</label>
										<div class="col-xs-7 controls"><?php echo get_data_value($data,'user_fname'); ?></div>
										<!-- col-sm-10 -->
									</div>
								</div>
								<div class="col-sm-6">
									<div class="row mgbt-xs-0">
										<label class="col-xs-5 control-label">Last Name:</label>
										<div class="col-xs-7 controls"><?php echo get_data_value($data,'user_lname'); ?></div>
										<!-- col-sm-10 -->
									</div>
								</div>
								<div class="col-sm-6">
									<div class="row mgbt-xs-0">
										<label class="col-xs-5 control-label">Email:</label>
										<div class="col-xs-7 controls"><?php echo get_data_value($data,'user_email'); ?></div>
										<!-- col-sm-10 -->
									</div>
								</div>


								<div class="col-sm-6">
									<div class="row mgbt-xs-0">
										<label class="col-xs-5 control-label">Cell Phone:</label>
										<div class="col-xs-7 controls"><?php echo get_data_value($data,'user_pmobile'); ?></div>
										<!-- col-sm-10 -->
									</div>
								</div>
							</div>
							<!-- row -->
							<hr class="pd-10"  />
							<div class="row">
								<div class="col-sm-11 mgbt-xs-20">
									<h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-star-o mgr-10 profile-icon"></i>Verified Aircraft</h3>
									<div class="skill-list">
										<div class="skill-name">
											<?php if(count($data['aircraft'])): ?>
												<?php foreach($data['aircraft'] as $key=>$item): ?>
													<?php echo $item['mfr_name'].' '.$item['model_name']; ?><br />
												<?php endforeach; ?>
											<?php endif; ?>
										</div>

									</div> <br/><br/>
									<h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-gear mgr-10 profile-icon"></i> Company Bio</h3>

									<div class="content-list content-menu">
										<ul class="list-wrapper">
											<li class="mgbt-xs-10">  <span class="menu-text"><?php echo get_data_value($data,'user_bio'); ?></span> </li>

										</ul>
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-sm-12">

									<h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-globe mgr-10 profile-icon"></i> Hiring Qualification</h3>
									<div class="row">
										<?php if(count($data['aircraft'])): ?>
											<?php foreach($data['aircraft'] as $key=>$item): ?>
												<div class="col-sm-4">
													<div class="">
														<div class="content-list">

															<ul  class="list-wrapper">
																<h3 class="mgbt-xs-15 font-semibold" style="color:#5bc0de;"><?php echo $item['mfr_name'].' '.$item['model_name']; ?></h3>
																<?php if(count($item['requirements'])): ?>
																	<?php foreach($item['requirements'] as $re=>$req): ?>
																		<b><?php echo select_air_requirement($req['req_type']); ?></b>
																		<li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> <?php echo $req['req_certificate']; ?> </span> </span>  </li>
																		<li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  <?php echo $req['req_ftime']; ?> Hour </span></span>  </li>
																		<li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  <?php echo $req['req_ttime']; ?> </span></span> </li>
																		<li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> PIC Time in Type <span class="menu-date"> :  <?php echo $req['req_pic']; ?> </span></span>   </li>
																		<li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  <?php echo $req['req_degree'] == 'y'?"Yes":"No"; ?> </span></span>  </li>
																	<?php endforeach; ?>
																<?php endif; ?>
															</ul>
														</div>
													</div>



												</div>
											<?php endforeach; ?>
										<?php endif; ?>



									</div>
									<!-- col-sm-7 -->
								</div>

							</div>
							<!-- row -->



							<hr class="pd-10"  />

						</div>
						<!-- pd-20 -->
					</div>


					<!-- To Edit Profile -->
					<div id="profile-tab-edit" class="tab-pane">




					</div>
					<!-- end of edit profile -->

					<!-- home-tab -->




					<div id="photos-tab" class="tab-pane">
						<div class="pd-20">
							<h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-picture-o mgr-10 profile-icon"></i> PHOTOS</h3>
							<br/>

							<div class="isotope js-isotope vd_gallery">
								<?php
								if(count($data['photos']) > 0):
									foreach($data['photos'] as $item): $item = (array)$item; ?>
										<div class="gallery-item  filter-1">
											<a href="<?php echo get_photo_url($item['photo_path']); ?>" data-rel="<?php echo $item['photo_title']; ?>" style="background-image: url('<?php echo get_photo_url($item['photo_path']); ?>');background-position: center;">
												<div class="bg-cover"></div>
											</a>
											<div class="vd_info">
												<h3 class="mgbt-xs-15"><?php echo $item['photo_title']; ?></h3>
											</div>

										</div>
									<?php endforeach;
								else:?>
									<div class="alert info">No photos uploaded</div>
								<?php endif; ?>
							</div>

							<div class="clearfix"></div>

						</div>
						<!-- pd-20 -->
					</div> <!-- photos tab -->
					<div id="friends-tab" class="tab-pane">
						<div class="pd-20">
							<h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-users mgr-10 profile-icon"></i> FRIENDS</h3>
							<div class="content-grid column-xs-3 column-sm-4 column-md-4 column-lg-6 height-xs-4 mgbt-xs-20">
								<div>
									<ul class="list-wrapper">
										<?php if(count($data['pool'])): ?>
											<?php foreach($data['pool'] as $key=>$item): $item = (array)$item; ?>
												<li>
													<a href="<?php echo site_url('pilot/' + $item['user_id']); ?>">
												<span class="menu-icon">
													<img src="<?php echo get_user_pic_url($item['user_image'],$item['user_type']); ?>" alt="<?php echo get_data_value($data,'user_fname').' '.get_data_value($data,'user_lname'); ?>" style="width: 100px;height: 100px;" />
												</span>
													</a>
											<span class="menu-text"> <?php echo get_data_value($data,'user_fname').' '.get_data_value($data,'user_lname'); ?>
												<span class="menu-info">
													<span class="menu-date"><?php echo get_data_value($item,'user_city'); ?></span>
													<span class="menu-action">
														<?php /*if($item['conn_status'] == 'p'): ?>
                                                            <span data-placement="bottom" data-toggle="tooltip" data-original-title="Approve" class="menu-action-icon vd_green vd_bd-green accept-user" object-id="<?php echo $item['conn_id']; ?>"><i class="fa fa-check"></i></span>
                                                            <span data-placement="bottom" data-toggle="tooltip" data-original-title="Reject" class="menu-action-icon vd_red vd_bd-red decline-user"  object-id="<?php echo $item['conn_id']; ?>"><i class="fa fa-times"></i></span>
                                                        <?php else: ?>
                                                            <span class="label label-danger unfollow-user" object-id="<?php echo $item['conn_id']; ?>">UNFOLLOW</span>
                                                        <?php endif;*/ ?>
													</span>
												</span>
											</span>
												</li>
											<?php endforeach;?>
										<?php else: ?>
											<p>No friends found</p>
										<?php endif; ?>
									</ul>
									<div class="clearfix"></div>
								</div>
							</div>
						</div><!-- pd-20 -->
					</div>
					<div id="projects-tab" class="tab-pane">
						<div class="pd-20">
							<div class="vd_info tr" > <a id="add-news-article" class="btn vd_btn btn-xs vd_bg-yellow"> <i class="fa fa-plus append-icon"></i> Add News </a> </div>
							<div class="clearfix"></div>
							<div class="hidden new-add-edit" style="margin-top:50px;margin-bottom:50px;">
								<input id="new-id" value="0" type="hidden" />
								<textarea id="news-content" class="no-bd myeditablediv" rows="3" placeholder="What are you doing?" ></textarea>
								<br />
								<button type="submit" id="save-article" class="btn vd_btn btn-xs vd_bg-green"> <i class="fa fa-plus append-icon"></i> SAVE </button>
							</div>


							<h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-bolt mgr-10 profile-icon"></i> Internal Flight Department News</h3>
							<table class="table table-striped table-hover">
								<thead>
								<tr>

									<th> Date</th>
									<th>Details</th>
									<th></th>

								</tr>
								</thead>
								<tbody>
								<?php if(count($data['news'])): ?>
									<?php foreach($data['news'] as $key=>$item): $item = (array)$item;?>
										<tr>
											<td class="center"><?php echo get_data_value_date($item,'post_created'); ?></td>
											<td><?php echo substr(strip_tags($item['post_content']),0,100); ?>... </td>



											<td class="menu-action rounded-btn">
												<a class="btn menu-icon vd_bg-green" onclick="publicJS.postDetail(<?php echo $item['post_id']; ?>);">
													<i class="fa fa-eye"></i>
												</a>
												</a>
												<a class="btn menu-icon vd_bg-red" data-placement="top" data-toggle="tooltip" data-original-title="delete">
													<i class="fa fa-times"></i>
												</a>

											</td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="5">No news found</td>
									</tr>
								<?php endif; ?>
								</tbody>
							</table>
							<div class="">
							</div>
						</div>
					</div>


				</div>
				<!-- tab-content -->
			</div>
			<!-- tabs-widget -->              </div>
	</div>
	<!-- row -->

</div>
