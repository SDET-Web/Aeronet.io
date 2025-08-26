    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-hidden">
            <div class="hidden-xs">
            <?php $this->load->view('profile/sidebar/pilot',array('data'=>$data)); ?>
        </div></div>
         <div class="col-md-8 col-sm-8 col-xs-12">

            <br/>
                    <div class="panel widget">
                  <div class="panel-heading vd_bg-green">
                    <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-podcast"></i> </span> CREW CONNECTIONS  </h3>

                  </div>
                  <div class="panel-body">
                      
                   <div  data-rel="scroll">
                  <div class="content-grid  mgbt-xs-20">
                       <div>
<ul class="list-wrapper">
                                    <?php 
                                      if(count($data['connections'])): ?>
                                    <?php foreach($data['connections'] as $key=>$item): $item = (array)$item;  ?>
    <?php if(get_data_value($item,'conn_type')<>'d'):?>
    <li style="padding:15px;">
<div class="menu-icon"><a href="<?php echo site_url('pilot/'.$item['conn_id']); ?>"><img src="<?php echo get_user_pic_url($item['user_image'],$item['user_type']); ?>" name="aboutme" width="120"  height="120" class="img-circle"></a></div>
                     
                        <span class="menu-text"> <?php echo get_data_value($item,'user_fname'); ?> <?php echo get_data_value($item,'user_lname'); ?>
                            <span class="menu-info">
                                <span class="menu-date"><?php echo get_data_value($item,'user_city'); ?>, <?php echo get_data_value($item,'user_state'); ?> </span>
                                 <?php if($item['conn_id']== $this->session->userdata('user_id')): ?>
                                <span class="menu-action">
				<?php if($item['conn_status'] == 'p'): ?>
<span class="btn vd_btn vd_bg-green accept-users" object-id="<?php echo $item['user_id']; ?>"> Accept </span>
<span class="btn vd_btn vd_bg-gray decline-user" object-id="<?php echo $item['user_id']; ?>">  Decline </span>
<?php else: ?>
<span class="deleteOption label label-danger" object-id="<?php echo $item['user_id']; ?>">Disconnect</span>
<?php endif; ?>
                      <?php else: ?>
                      <span class="menu-action"><span class="btn vd_btn vd_bg-green"> Request Sent </span></span>  
                      <?php endif; ?>
                            </span></span>
                        </span>
                     </li>
<?php endif; ?>
                                    <?php endforeach;?>

                                </ul>
                           
                            <?php else: ?>
                                <div class="font-semibold vd_red">No Crew Connection in Network</div>
                            <?php endif; ?>

                       </div></div></div>

                  </div>
                </div>

            <div class="panel widget">                                  
                                
                 <div class="panel-heading vd_bg-dark-green">
                  <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-link"></i> </span> FLIGHT DEPARTMENTS YOU'RE FOLLOWING </h3></div>
                  <div class="panel-body">
                   <div  data-rel="scroll">
                        <?php if(count($data['departments'])): ?>
                                    <div class="content-grid  mgbt-xs-20">
                                        <ul class="list-wrapper pd-lr-5">
                                            <?php foreach($data['departments'] as $key=>$item): $item = (array)$item; ?>
                                            <li style="padding:15px;"><br/>
                                                <div class="menu-icon"><a href="<?php echo site_url('department/' . $item['user_id']); ?>"><img src="<?php echo get_user_pic_url($item['user_image'],'d'); ?>" width="120" height="120" class="img-circle"></a></div>
                                                <div class="menu-text">
                                               <a href="<?php echo site_url('department/' . $item['user_id']); ?>"><?php echo get_data_value($item,'user_company'); ?></a>
                                                    <div class="menu-info">

                            <span class="menu-text"> <?php echo ucwords(strtolower(get_data_value($item,'company'))); ?>
                            <span class="menu-info">
                            <span class="menu-date"><?php echo get_data_value($item,'user_city'); ?>, <?php echo get_data_value($item,'user_state'); ?> </span></span>
                            </span>

                                                        <span class="menu-date">
                                                           <?php if(count(get_data_value($item,'user_count')) > 1): ?>
                                                            <?php echo get_data_value($item,'user_count'); ?> Followers
                                                        <?php else:?>
                            1 Follower
                        <?php endif; ?>

                                                        </span>

                                                    </div>
                                                    <p><?php //echo substr(get_data_value($item,'user_bio'),0,100); ?></p>
                                                    <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
                                <span class="menu-action">
				<?php if($item['conn_status'] == 'p'): ?>
<button type="button" class="accept-followme btn vd_btn vd_bg-grey " object-id="<?php echo $item['conn_id']; ?>">
                        <i class="fa fa-check-circle append-icon"></i>Accept</button>                                    
<?php else: ?>
<p style="cursor:pointer;"><span class="deleteOption label label-danger" object-id="<?php echo $item['user_id']; ?>">Unfollow</span></p>
<?php endif; ?>
					</span>
                              
                                                    
                                               <?php endif; ?>
                                                </div>
                                            </li>




                                                <?php endforeach; ?>
                                        </ul>
                                    </div>

                        <?php else:?>
                            <div class="font-semibold vd_red">You are not Following any Flight department.</div>
                        <?php endif; ?>
                </div>
            </div>
                
            
            </div>
         </div></div>
<script>
$(document).ready(function () {
  $(".deleteOption").click(function() {
  $("#deleteYes").attr("href", "<?php echo site_url("unfollow");?>" + "/" + $(this).attr("object-id") + "/" + $user.id);
  $("#delModal").modal("show");
  });
});

</script>
<div class="modal fade" id="delModal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header vd_bg-red">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title vd_white">Un Follow</h4>
         </div>
         <div class="modal-body">
            <div>
               <div class="col-md-12 col-xs-12">
                   <h5><strong class="font-semibold">Do you really want to Unfollow or Disconnect?                   
                      </strong></h5>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a id="deleteYes" href="#" type="button" class="btn vd_btn vd_bg-blue">Yes </a>
            <button type="button" class="btn vd_btn" class="close" data-dismiss="modal">Close</button>

         </div>
      </div>
   </div>
</div>