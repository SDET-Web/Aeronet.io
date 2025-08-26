<div class="vd_content-section clearfix">
    <div class="row" style="margin-top:-15px;" >
        <div class="col-md-4 col-sm-4 col-xs-hidden">
            <div class="hidden-xs">
            <?php $this->load->view('profile/sidebar/pilot',array('data'=>$data)); ?>
        </div></div>
         <div class="col-md-8 col-sm-8 col-xs-12">
             <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div id="friends-tab" class="tab-pane">
    	<div class="pd-20">
        	<h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-building mgr-10 profile-icon"></i> Departments</h3>

            
            
            <div class="row">
                <div class="col-md-12 col-sm-12">
                        <?php if(count($data['departments'])): ?>
                    <div class="row">
                            <?php foreach($data['departments'] as $key=>$item): $item = (array)$item; ?>
                                <div class="col-md-12 col-sm-12">
                                    <div class="content-list content-large menu-action-right">
                                        <ul class="list-wrapper pd-lr-15">
                                            <li class="warning">
                                                <div class="menu-icon"><a href="<?php echo site_url('department/' . $item['user_id']); ?>"><img src="<?php echo get_user_pic_url($item['user_image'],'d'); ?>" alt="example image"></a></div>
                                                <div class="menu-text">
                                                    <h4 class="mgbt-xs-0"><a href="<?php echo site_url('department/' . $item['user_id']); ?>"><?php echo get_data_value($item,'user_company'); ?></a></h4>
                                                    <div class="menu-info">
                                                        <span class="menu-date"> <?php echo get_data_value($item,'user_count'); ?> members </span>

                                                    </div>
                                                    <p><?php echo substr(get_data_value($item,'user_bio'),0,100); ?>...</p>
                                                    <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
                                                        <p style="cursor:pointer;"><span class="label label-danger unfollow-user-short" object-id="<?php echo $item['user_id']; ?>">Unfollow</span></p>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        <?php else:?>
                            <div class="nothing-found">Not following any Department</div>
                        <?php endif; ?>
                </div>
            </div>
            
            
                            
            </div>
                          
                        </div>
        
        </div>
             <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="panel widget light-widget">
                        <?php $this->load->view('people_panel'); ?>
                    </div>
                </div>  
             </div>
        
                    </div>
                </div>
            </div>
        
   