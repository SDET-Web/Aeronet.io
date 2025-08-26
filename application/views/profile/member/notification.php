    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-hidden">
            <div class="hidden-xs">
            <?php $this->load->view('profile/sidebar/pilot',array('data'=>$data)); ?>
        </div></div>
         <div class="col-md-8 col-sm-8 col-xs-12">
             
    	<div class="pd-20">
        	<h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-globe mgr-10 profile-icon"></i> Notifications</h3>

     <div class="row">       
            
    <div class="col-md-12 col-xs-12">
                                            <?php $notifications = $this->Model_post->notification($this->session->userdata('user_id')); ?>
                                                    <div class="panel widget light-widget">
                                                        <div class="panel-body">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-md-12 col-xs-12">
                                                                    <div class="content-list content-image content-chat">
                                                                        <ul class="list-wrapper no-bd-btm pd-lr-10">
                                                                            <?php
                                                                            if(count($notifications) > 0):
                                                                                foreach($notifications as $notification):
                                                                                    $type_array = get_post_type_icon_color($notification['post_type']);
                                                                                    ?>
                                                                                    <li  onclick="publicJS.markNotification($(this),<?php echo $notification['id']; ?>)">
                                                                                        <div class="menu-icon <?php echo $type_array['border']; ?>"><i class="fa <?php echo get_notification_icon($notification['text']); ?>"></i></div>
                                                                                        <div class="menu-text"> <?php echo $notification['text']; ?>
                                                                                            <div class="menu-info"><span class="menu-date"><?php echo time_ago($notification['date'], $notification['c_date']); ?></span></div>
                                                                                        </div>
                                                                                    </li>
                                                                                <?php endforeach; ?>
                                                                            <?php else: ?>
                                                                                <li>No Notifications Found.</li>
                                                                            <?php endif; ?>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                            <br/><br/>

                                        </div> 
            
            </div> 
                            
            </div>
                          
                        </div>
        
        </div>
        
                    
        
    
