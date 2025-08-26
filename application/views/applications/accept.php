        <div class="modal-body">
            <div class="row" style="padding: 4em">
                <div class="col-md-8 col-xs-6">
                    <h4> Job Title :  <?php echo $job->title; ?></h4>
                    <h4> Job Description : </h4>
                    <?php echo $job->description; ?>
                    <h4> Job Requirements :  </h4>
                    <?php echo $job->requirements; ?>
                    <?php if($showSideBar): ?>
                    <h4 class="vd_red"> Addendum :  </h4>
                        <h1>Application</h1>
                        <?php if($application != L8_INSERT_ERROR): ?>
                            <div>
                                <h3>Resume</h3>
                                <pre><a target="_blank" href="<?php echo site_url('upload/member/resume/'.$application->resume); ?>"><?php echo $application->resume; ?></a></pre>
                            </div>
                            <div>
                                <h3>Message</h3>
                                <pre><?php echo $application->message; ?></pre>
                            </div>
                        <?php else: ?>
                            <div class="form-group">
                                <label class="control-label">Upload Professional Resume option <br />
                                </label>
                                <div class="controls" style="position: relative;">
                                    <input type="file" name="resume" style="width: 100%;">
                                </div>
                                <?php if(isset($applicant->user_resume)): ?>
                                    <pre style="font-size: 10px; margin-top: 10px;">Don't upload if you want to use <a target="_blank" href="<?php echo site_url('upload/member/resume/'.$applicant->user_resume); ?>"><?php echo $applicant->user_resume; ?></a></pre>
                                    <div class="clearfix"></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Message<br />
                                </label>
                                <?php form_new_textarea_updated('', 'message', "" , false, 3, '', ''); ?>
                            </div>
                        <?php endif; ?>

                        <?php
                        if($department != L8_INSERT_ERROR) {
                            if($application != L8_INSERT_ERROR) {
                                $this->load->view('job/answers', array('addendum' => $applicant->addendum));
                            } else {
                                $this->load->view('job/questions', array('addendum' => $applicant->addendum));
                                echo '<button type="submit" class="btn button-main2" id="purchase" style="width: 100%">Apply Now</button>';
                            }

                        } ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-4 col-xs-6">
                    Aircraft Picture
                    <img style="max-width: 150px" src="<?php echo RIZ_UPLOAD_AIRCRAFT . $job->photo; ?>" /><br/>
                    <h4>Subscribed Plan : </h4>
                    <h4> Aircraft (Make - Model) : <?php echo $job->mfr . ' - ' . $job->model; ?></h4>
                    <h4> Location(Airport): <?php echo $job->state; ?></h4>
                </div>
            </div>
        </div>
        <div class="modal-footer vd_bg-green">
            <a href="<?php echo site_url('applications/accept/' . $id . '/' . $application->id . '/confirm'); ?>">
                <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon"><i class="fa fa-check"></i></span> Approve Application </button>
            </a>
        </div>
