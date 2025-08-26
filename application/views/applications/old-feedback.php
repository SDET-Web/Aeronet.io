<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header vd_bg-green">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title vd_white">Send FeedBack</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form method="POST" action="<?php echo site_url("applications/feedback/" . $id . "/" . $application->id); ?>">
                        <input type="hidden" name="action" value="feedbackApplication" />
                        <h4>Post Your Feedback or Inquiries</h4>
                        <textarea rows="3" cols="20" name="message"></textarea>
                        <div class="form-group">
                            <button type="submit" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon"><i class="fa fa-upload"></i></span> Post Now </button>
                        </div>
                    </form>
                    <br/>
                    <?php if(count($messages) > 0): ?>
                    <div class="panel widget">
                        <div class="panel-heading vd_bg-yellow">
                            <h3 class="panel-title"> <i class="fa fa-comments"></i> Last Feedbacks </h3>
                        </div>
                        <div class="panel-body-list">
                            <div class="content-list content-image menu-action-right">
                                <div  data-rel="scroll"	>
                                    <ul class="list-wrapper pd-lr-15">
                                        <?php foreach($messages as $message): ?>
                                        <li>
                                            <div class="menu-icon"><a href="#"><img alt="department logo" src="<?php echo get_user_pic_url(get_data_value($message,'user_image'),get_data_value($message,'user_type')); ?>"></a></div>
                                            <div class="menu-text"> <?php echo $message["message"]; ?> </div>
                                            <div class="menu-text">
                                                <div class="menu-info"> Your Feedback  - <span class="menu-date"><?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $message["message"])); ?> </span> </div>
                                            </div>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer vd_bg-green">
    </div>
</div>