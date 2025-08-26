<div class="panel widget light-widget" style="margin-top:5px;margin-bottom:0px;">
    <div class="panel-body-list">
       <h3 class="pd-20 mgbt-xs-0 text-center  font-semibold vd_grey"> Explore Crew Talent</h3>

    <div class="swiper-container s2">
    <div class="swiper-wrapper">
        <?php if(!isset($dept)): ?>
<?php $user_conn = $this->Model_connection->non_connections($this->session->userdata('user_id'),'','p',7);
//$this->Model_connection->friends_of_friends($this->session->userdata('user_id'),'p',5); ?>
    <?php if(count($user_conn) > 0): ?>
     <?php foreach($user_conn as $user): ?>

        <div class="swiper-slide">
            <div class="container">
             <ul class="list-wrapper pd-lr-15">
                        <li>
 <a href="<?php echo site_url('pilot/'.$user['id']); ?>">
     <span class="menu-icon">
          <img alt="pilot" class="center-block" src="<?php echo get_user_pic_url($user['image'],$user['type']); ?>" name="aboutme" width="120"  height="120" class="img-circle">
         </span> </a>
                            <div style="width:95%;text-align:center;">
                        <span class="menu-text center">
<?php echo ucwords(strtolower(get_data_value($user,'fname'))); ?> <?php echo ucwords(strtolower(get_data_value($user,'lname'))); ?>
                            <span class="menu-info" >
                                <span class="menu-date">
                                  <h5 style="color:#00AEEF;"><?php echo get_select_user_type(get_data_value($user,'type')); ?></h5></span>

                            </span>


                           <div class="m-t-xs btn-group">
                    <button type="button" class="btn vd_btn vd_bg-grey invite" object-id="<?php echo $user['id']; ?>">
                        <i class="fa fa-check-circle append-icon"></i>Send Invite to follow</button>
                  </div>
                            </span></div>
                        </li>


                    </ul>
            </div></div>
            <?php endforeach;?>
              <?php endif; ?>

       <?php $user_conn = $this->Model_connection->non_connections($this->session->userdata('user_id'),'','m',5);?>
   <?php if(count($user_conn) > 0): ?>
     <?php foreach($user_conn as $user): ?>
        <div class="swiper-slide">
            <div class="container">
                <ul class="list-wrapper pd-lr-15">
                        <li>
 <a href="<?php echo site_url('pilot/'.$user['id']); ?>">
     <span class="menu-icon">
          <img alt="pilot" class="center-block" src="<?php echo get_user_pic_url($user['image'],$user['type']); ?>" name="aboutme" width="120"  height="120" class="img-circle">
         </span> </a>
                            <div style="width:95%;text-align:center;">
                        <span class="menu-text center">
<?php echo ucwords(strtolower(get_data_value($user,'fname'))); ?> <?php echo ucwords(strtolower(get_data_value($user,'lname'))); ?>
                            <span class="menu-info" >
                                <span class="menu-date">
                                  <h5 style="color:#00AEEF;"><?php echo get_select_user_type(get_data_value($user,'type')); ?>Mechanic</h5></span>

                            </span>


                           <div class="m-t-xs btn-group">
                    <button type="button" class="btn vd_btn vd_bg-grey invite" object-id="<?php echo $user['id']; ?>">
                        <i class="fa fa-check-circle append-icon"></i>Send Invite to follow</button>
                  </div>
                            </span></div>
                        </li>


                    </ul>
            </div></div>
            <?php endforeach;?>
              <?php endif; ?>

        <?php $user_conn = $this->Model_connection->non_connections($this->session->userdata('user_id'),'','s',5); ?>
   <?php if(count($user_conn) > 0): ?>
     <?php foreach($user_conn as $user): ?>

        <div class="swiper-slide">
            <div class="container">
               <ul class="list-wrapper pd-lr-15">
                        <li>
 <a href="<?php echo site_url('pilot/'.$user['id']); ?>">
     <span class="menu-icon">
          <img alt="pilot" class="center-block" src="<?php echo get_user_pic_url($user['image'],$user['type']); ?>" name="aboutme" width="120"  height="120" class="img-circle">
         </span> </a>
                            <div style="width:95%;text-align:center;">
                        <span class="menu-text center">
<?php echo ucwords(strtolower(get_data_value($user,'fname'))); ?> <?php echo ucwords(strtolower(get_data_value($user,'lname'))); ?>
                            <span class="menu-info" >
                                <span class="menu-date">
                                  <h5 style="color:#00AEEF;"><?php echo get_select_user_type(get_data_value($user,'type')); ?>Dispatcher</h5> </span>

                            </span>


                           <div class="m-t-xs btn-group">
                    <button type="button" class="btn vd_btn vd_bg-grey invite" object-id="<?php echo $user['id']; ?>">
                        <i class="fa fa-check-circle append-icon"></i>Send Invite to follow</button>
                  </div>
                            </span></div>
                        </li>


                    </ul>
            </div></div>
     <?php endforeach;?> <?php endif; ?>
 </div>
    <!-- Add Pagination --><br/><br/>
    <div class="swiper-pagination"></div>
  </div>
   <?php endif; ?>
</div></div>