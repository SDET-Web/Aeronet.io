            <?php $user_model = $this->Model_connection->GetHeadHunterModels($this->session->userdata('user_id'),'d'); 
            if( count($user_model) > 0): ?>
            <?php foreach($user_model as $umodel):?>
             <div class="panel widget">
                  <div class="panel-heading vd_bg-green">
                      <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-plane"></i> </span> Pilot HeadHunter for <?php echo($umodel['make']);?> &nbsp; <?php echo($umodel['model']);?> <?php //echo($umodel['job_id']);?></h3>
                  </div>
                 <div class="panel-body-list">
                        <div class="content-list">
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
                                     <a href="#"><h5><?php echo select_user_type($match['user_type']); ?></h5></a>
                                <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $match['rating']; ?> / TypeRating : <?php echo $match['user_rating_type']; ?></span>
                               <br/> 
                               
                               <span class="menu-date "><i class="fa fa-plane"></i> <b> Pilot HeadHunter </b><?php //echo get_time_elapsed_string(date("Y-m-d h:i:s", $match['user_created'])); ?> </span>

                                 </div>
                             </div> 
                           <?php if($match["user_resume"]<>''):
                             $resume=$match["user_resume"];
                             else:$resume = 'null';
                           endif;?>
<?php $user_apply = $this->Model_connection->HeadHunterApplicant($umodel['job_id'],$match['user_id']); ?>
<?php if(count($user_apply) > 0): ?>
<button type="button" class="btn vd_btn vd_bg-black-50 btn-block vd_white"><i class="fa fa-check-circle"></i> Shortlisted to your ATS</button>
<?php else:?>
<?php if($data["subscription"]["braintree_plan"] == L8_PLAN_PREMIUM_CTS):
$url= 'headhunter/shortlist/' . $umodel["job_id"] . "/" . $resume. "/d" . "/" . $match["user_id"];
else:
$url= 'flight-dispatch-board/subscribe/addons/l8premiumcts';?>
<?php endif; ?>
<a href="<?php echo site_url($url); ?>">
<button type="button" class="btn vd_btn vd_bg-blue btn-block vd_white"><i class="fa fa-check-circle"></i> Shortlist Candidate To Your ATS </button></a>
<?php endif; ?>
</div>
                           </li>
                         </ul> </div> </div>  <?php endforeach;?>

                 
                             <?php endif;?>
<?php endforeach;?>
<?php endif;?>
     
        