<?php $user_chk = $this->Model_connection->non_connections($this->session->userdata('user_id'),'','',2);
if(count($user_chk) > 0):?>
<?php $user_conn = $this->Model_connection->non_connections($this->session->userdata('user_id'),'','d',10);
//$this->Model_connection->friends_of_friends($this->session->userdata('user_id'),'d',5);?>
 
<div class="panel widget light-widget" style="margin-top:5px;margin-bottom:0px;">
    <div class="panel-body-list">
       <h3 class="pd-20 mgbt-xs-0 text-center  font-semibold vd_blue"> Explore Flight Departments</h3>

     <div class="swiper-container s1">
    <div class="swiper-wrapper"> 
<?php if(count($user_conn) > 0): ?>
<?php foreach($user_conn as $user): ?>

        <div class="swiper-slide">
            <div class="container">
             <ul class="list-wrapper pd-lr-15">
                        <li >
 <a href="<?php echo site_url('department/'.$user['id']); ?>">

     <span class="menu-icon"><img class="img-circle center-block" src="<?php echo get_user_pic_url($user['image'],'d'); ?>" name="aboutme" width="120"  height="120"></span>
                         </a>
                        <div style="width:95%;text-align:center;margin-top:5px;">
                            <span class="menu-text center"><h5 style="color:#00AEEF;"><?php echo ucwords(strtolower($user['company'])); ?></h5>
                            <span class="menu-info center">
                                <span class="menu-date">
                                  <h5 style="color:#9ea7af;"><?php echo ucwords(strtolower($user['user_city'])); ?><?php echo 'user'.ucwords(strtolower($user['user_type'])); ?></h5></span>
                            </span>
                           <div class="m-t-xs btn-group">
                    <button type="button" class="btn vd_btn vd_bg-grey follow_big" object-id="<?php echo $user['id']; ?>">
                        <i class="fa fa-link append-icon"></i>Follow</button>
                  </div>
                        </span></div>
                    </li>
                   </ul>
            </div></div>
            <?php endforeach;?>
              <?php endif; ?>

        <?php if(count($data["matched"]) > 0): ?>
<?php foreach($data["matched"] as $user): ?>
            <div class="swiper-slide">
                <div class="container">
                <ul class="list-wrapper pd-lr-15">
                        <li >
 <a href="<?php echo site_url('department/'.$user['user_id']); ?>">

     <span class="menu-icon"><img class="center-block" src="<?php echo get_user_pic_url($user['user_image'],'d'); ?>" name="aboutme" width="120"  height="120" class="img-circle"></span>
                        </a>
                        <div style="width:95%;text-align:center;margin-top:5px;">
                            <span class="menu-text center"><h5 style="color:#080"> <?php echo ucwords(strtolower($user['user_company'])); ?> </h5>
                            <span class="menu-info center">
                                <span class="menu-date">
                                  <h5 style="color:#9ea7af;">
                  <?php echo ucwords(strtolower($user['user_city'])); ?> <?php echo 'user'.ucwords(strtolower($user['user_type'])); ?></h5></span>
                            </span>
                           <div class="m-t-xs btn-group">
                    <button type="button" class="btn vd_btn vd_bg-grey follow_big" object-id="<?php echo $user['user_id']; ?>">
                        <i class="fa fa-link append-icon"></i>Follow</button>
                  </div>
                        </span></div>
                  </li>

                    </ul>
                </div></div>
        <?php endforeach;?>   <?php endif; ?>     
 </div>
    <!-- Add Pagination --><br/><br/>
    <div class="swiper-pagination"></div>
  </div>
      
     </div></div>

<!----- EXPLORE CREW Talent -->
<?php require_once("explore_crew.php");  ?>    
<?php endif; ?> 