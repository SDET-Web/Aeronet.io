
   <?php if($this->session->userdata('user_type') == 'p'): ?>
<?php $user_conn = $this->Model_connection->suggested_pilot_department($this->session->userdata('user_id'),'department');//$this->Model_connection->friends_of_friends($this->session->userdata('user_id'),'p',5); ?>
    <?php if(count($user_conn) > 0): ?> 
                   
          <div class="row">
            <div class="col-sm-12">
           
                     <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block">
                          <span class="append-icon"><i class="fa fa-users fa-fw"></i></span> Suggested Flight Departments </button>
                    </div>    
                    <div class="owl-carousel2 owl-theme">
                    
                        <?php foreach($user_conn as $user): ?>
                        <div class="item">
                             <div class="contact-box center-version">
                 <a href="<?php echo site_url('department/'.$user['id']); ?>">
                  
                  <img class="center-block" src="<?php echo get_user_pic_url($user['image'],'d'); ?>">
                  <h5 class="m-b-xs"><?php echo ucwords(strtolower($user['company'])); ?></h5>
    
                  <h5 style="color:#00AEEF;"><?php echo get_select_user_type(get_data_value($user,'type')); ?></h5>
                </a>
                <div class="contact-box-footer">
                  <div class="m-t-xs btn-group">
                    <button type="button" class="btn vd_btn vd_bg-grey follow" object-id="<?php echo $user['id']; ?>">
                        <i class="fa fa-link append-icon"></i>Follow</button>
                  </div>
                </div>
              </div>   
                                
                                
                            </div>
                  
                        <?php endforeach; ?>
                        </div>
                   
                  
                
          
          </div></div>
<?php endif; ?><?php endif; ?> 

    
    
   <?php $user_conn = $this->Model_connection->non_connections($this->session->userdata('user_id'),'','p',5);
//$this->Model_connection->friends_of_friends($this->session->userdata('user_id'),'p',5); ?>
            <?php if(count($user_conn) > 0): ?>   

            <div class="row">
        <div class="col-xs-12">
                 <h4 style='text-align:center;margin-top:10px;'>Members You May Know </h4>    
                <div class="custom2 owl-carousel owl-theme">
           <?php foreach($user_conn as $user): ?>
            
                    <div class="item">
                             <div class="contact-box center-version">
                <a href="<?php echo site_url('pilot/'.$user['id']); ?>">
                  <img alt="pilot" class="center-block" src="<?php echo get_user_pic_url($user['image'],$user['type']); ?>">
                  <h5 class="m-b-xs"><?php echo ucwords(strtolower(get_data_value($user,'fname'))); ?> <?php echo ucwords(strtolower(get_data_value($user,'lname'))); ?></h5>
    
                  <h5 style="color:#00AEEF;"><?php echo get_select_user_type(get_data_value($user,'type')); ?></h5>
                </a>
                <div class="contact-box-footer">
                  <div class="m-t-xs btn-group">
                    <button type="button" class="btn vd_btn vd_bg-green connect" object-id="<?php echo $user['id']; ?>">
                                                <i class="fa fa-check-circle append-icon"></i>Connect</button>
                  </div>
                </div>
              </div>   
                         </div>
                  
                        <?php endforeach; ?>
                        
                        </div>
                   
               
            </div>

        </div>
    <?php endif; ?>    


