        <div class="modal-body">
            <div class="row" style="padding: 4em">
                <div class="col-md-12 col-xs-12">


                  <br/>
                  <?php if(count($messages) > 1): ?>
                    <h5> Message: </h5>
                    <?php echo $messages[0]["message"]; ?> <br /><br />
                    <button type="submit" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon"><i class="fa fa-upload"></i>
                    </span>  Sent <?php echo date("m/d/Y h:i:s", $messages[0]["created"]); ?> </button>
                      <?php else: ?>
                        <form method="POST" action="<?php echo site_url("applications/feedback/" . $id . "/" . $application->id); ?>">
                             <input type="hidden" name="action" value="feedbackApplication" />
                             <h4>Post Your Feedback or Inquiries</h4>
                             This will send email and message to Applicant and admin that your application is under process.
                             You can further write your queries below.
                             <textarea rows="3" cols="20" name="message"></textarea>
                             <div class="form-group">
                                 <button type="submit" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon"><i class="fa fa-upload"></i></span> Post Now </button>
                             </div>
                         </form>
                  <?php endif; ?>
                  <br/>

                  <a href="<?php echo site_url('applications/accept/' . $job->id . '/' . $application->id); ?>/confirm" class="btn vd_btn vd_bg-yellow btn-block"><span class="append-icon"><i class="fa fa-trophy"></i>
                  </span> Qualify this Applicant  </a>
                  It will also send a congratulation email to applicant and admin on qualifying for job.

                  <?php //include_once 'shortlist.php'; ?>

                  <!--  <?php// if(count($messages) > 0): ?>
                    <div class="panel widget">
                        <div class="panel-heading vd_bg-yellow">
                            <h3 class="panel-title"> <i class="fa fa-comments"></i> Last Feedbacks </h3>
                        </div>
                        <div class="panel-body-list">
                            <div class="content-list content-image menu-action-right">
                                <div  data-rel="scroll"	>
                                    <ul class="list-wrapper pd-lr-15">
                                        <?php //foreach($messages as $message): ?>
                                        <li>
                                            <div class="menu-icon"><a href="#"><img alt="department logo" src="<?php echo get_user_pic_url(get_data_value($message,'user_image'),get_data_value($message,'user_type')); ?>"></a></div>
                                            <div class="menu-text"> <?php //echo $message["message"]; ?> </div>
                                            <div class="menu-text">
                                                <div class="menu-info"> Your Feedback  - <span class="menu-date"><?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $message["message"])); ?> </span> </div>
                                            </div>
                                        </li>
                                        <?php //endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php //endif; ?>
                  -->

                </div>
            </div>
        </div>
