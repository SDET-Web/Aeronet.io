            <?php $user_model = $this->Model_connection->GetHeadHunterModels($this->session->userdata('user_id'),'d'); 
            if( count($user_model) > 0): ?>
            <?php foreach($user_model as $umodel):?>
             
                        <?php //$getmodel = $umodel['model'];
                        //$getmodel='A-300'; ?>
                        <?php $user_match = $this->Model_connection->GetHeadHunterUsers($umodel['model'],'p'); ?>
                        <?php if(count($user_match) > 0): ?>
                        <?php foreach($user_match as $match):?>
                            <div class="swiper-slide">
                            <div class="container">
                           <ul class="list-wrapper pd-lr-15">
                           <li>
                               
                               <span class="menu-icon">
          <img alt="pilot" class="center-block" src="<?php echo get_user_pic_url($match['user_image'],$match['user_type']); ?>" name="aboutme" width="120"  height="120" class="img-circle">
         </span>
                               <div style="width:95%;text-align:center;margin-top:15px;">
                                   
                              <a href="<?php echo site_url('pilot/' . $match['user_id']); ?>">
                                  <div class="menu-text"><em> <h5><strong>&nbsp; <?php echo $match['fname'] . " " . $match['lname']; ?></strong></h5></em> </div></a>
                             <div class="menu-text">
                                 <div class="menu-info">
                                 <button type="button"  class="btn vd_btn vd_bg-green"> Pilot HeadHunter </button>
                                  <!--   <a href="#"><h5><?php //echo select_user_type($match['user_type']); ?></h5></a>-->
                                <span class="menu-rating vd_yellow" style="margin-top:10px;"><i class="fas fa-star"></i> Ratings : <?php echo $match['rating']; ?> / TypeRating : <?php echo $match['user_rating_type']; ?></span>
                               <br/> 
                               
                               <span class="menu-date "><i class="fa fa-plane"></i> <b> <?php echo($umodel['make']);?> &nbsp; <?php echo($umodel['model']);?> </b><?php //echo get_time_elapsed_string(date("Y-m-d h:i:s", $match['user_created'])); ?> </span>
                                                                
                                 </div>
                             </div> 
                           <div class="m-t-xs btn-group">
                    <button type="button" class="btn vd_btn vd_bg-grey invite" object-id="<?php echo $user['id']; ?>">
                        <i class="fa fa-check-circle append-icon"></i>Send Invite to follow</button>
                  </div>
                                   
</div>
                           </li>
                         </ul> </div> </div>  <?php endforeach;?>

                 
                             <?php endif;?>
<?php endforeach;?>
<?php endif;?>
     
        