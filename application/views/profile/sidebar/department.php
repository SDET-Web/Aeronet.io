<?php  $bg=  isset($data['user_bgimage']) && $data['user_bgimage'] != '' ? site_url('/upload/member/' . $data['user_bgimage']) : RIZ_ASSETS . '/images/slider/AviationNetwork.jpg';
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="pprofile large">
    <div class="pcover" style="background:url(<?php echo $bg; ?>);background-size:cover;background-repeat:no-repeat;">
      <div class="piclayer">
        <div class="ploader"></div>
      </div>
         <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
        <a class="image-wrapper" href="#">
        <form id="coverForm" method="post" enctype="multipart/form-data" action="<?php echo site_url('my/profile/photo') ?>">
          <input type="hidden" name="currentPath" value="<?php echo base_url(uri_string()) ?>" />
          <input class="hidden-input" id="changeCover"  name="profile_bgphoto" type="file"/>
          <label class="edit glyphicon glyphicon-pencil" for="changeCover" title="Change cover"></label>
        </form></a><?php endif; ?>
    </div>
    <div class="user-info">
      <div class="profile-pic">
      <img src="<?php echo get_user_pic_url(get_data_value($data,'user_image'),get_data_value($data,'user_type')); ?>">
        <div class="piclayer">
          <div class="ploader"></div>
        </div>
      <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
      <a class="image-wrapper" href="#">
      <form id="profileForm" method="post" enctype="multipart/form-data" action="<?php echo site_url('my/profile/photo') ?>">
              <input type="hidden" name="currentPath" value="<?php echo base_url(uri_string()) ?>" />
            <input class="hidden-input" type="file" id="profile-photo-file" name="profile_photo"/>
            <label class="edit glyphicon glyphicon-pencil" for="profile-photo-file" type="file" title="Change picture"></label>
          </form></a><?php endif; ?>
      </div>
     <div class="username">
        <div class="name"><h3 class="font-bold mgbt-xs-5" style="color:#1f83ae;"><?php echo get_data_value($data,'user_company'); ?></h3></div>
        <div class="about"><h5>Flight Department<?php //echo get_select_user_type(get_data_value($data,'user_type')); ?></h5>
        <?php echo get_data_value($data,'user_bio');?></div>
      </div>

    <div class="userdetails">

     <?php if($data['user_id'] != $this->session->userdata('user_id')): ?>
    <div class="row">
            <?php if($data['is_connected'] == null): ?>
        <div class="col-xs-12"><center> <a class="btn vd_btn vd_bg-green btn-md follow_big" object-id="<?php echo $data['user_id']; ?>">
                <i class="fa fa-check-circle append-icon"></i>Follow</a> </center> </div>
            <?php else: ?>
                <div class="col-xs-12"><center>  <a class="btn vd_btn vd_bg-green btn-md  no-br" style="background-color:#1b9859!important">
                <i class="fa fa-check-circle append-icon"></i>Following</a> </center>  </div>
            <?php endif; ?>
      </div>  <?php endif; ?>
      
 
</div></div></div>   
      
<?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
<div class="panel widget light-widget" style="margin-top:5px;margin-bottom:0px;">
<div class="panel-body-list">       
<?php if($data["subscription"]["braintree_plan"] <> L8_PLAN_PREMIUM_CTS): ?>     
  <p class="pd-5"></p>
    <a href="<?php echo site_url('flight-dispatch-board/subscribe/addons/l8premiumcts'); ?>">
    <img src="/assets/backend/img/Tracking.jpg" class="img-responsive center-block"> </a>
   <?php endif; ?>

 <?php if($data["subscription"]["braintree_plan"] == L8_PLAN_PREMIUM_CTS): ?>
    <p class="pd-5"></p>  
    <a href='<?php echo site_url('careers/edit'); ?>'>
    <img src="/assets/backend/img/Editcareer.jpg" class="img-responsive center-block"> </a>

    <p class="pd-5"></p>
    <a href='<?php echo site_url('candidate-tracking'); ?>'>
    <img src="/assets/backend/img/Tracking.jpg" class="img-responsive center-block"> </a>
    
<?php endif; ?>   
<p class="pd-5"></p> 
<a href="<?php echo site_url('my/network'); ?>">
  <!--   Following Your Flight Department (<?php //echo(count($data["following"]["p"])+count($data["following"]["m"])+count($data["following"]["a"])+count($data["following"]["s"]));?>) -->
<img src="/assets/backend/img/passive.jpeg" class="img-responsive center-block">
</a>  <p class="pd-5"></p>  
</div></div>   
      
<?php require_once("explore_crew_dep.php");  ?>      
   

<div class="panel panel-default vd_bg-white" style="margin-top:5px;margin-bottom:0px;">
<a class=" accordion-toggle btn vd_btn vd_bg-white center-block" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour16">
<img src="/assets/backend/img/photos.jpg" class="img-responsive center-block"></a>
                                
                           <div id="collapseFour16" class="panel-collapse collapse">
                                  
                 <?php if(count($data['photos']) > 0): ?>
               
                               <ul id="rig">
                 <?php foreach($data['photos'] as $key=>$item): $item = (array)$item;if($key > 3){continue;} ?>
                     <li style='padding-right:2px;'>                    
                        <?php $changeDate = date("Y/m/d", $item['photo_created']); ?>  
                         <div class="closing text-center"><?php echo ($changeDate);  ?></div>
                          <a class="rig-cell" href="<?php echo get_photo_url($item['photo_path']); ?>" title="<?php echo ($changeDate);  ?>"  data-rel="prettyPhoto[2]">
                          <img  class="rig-img" src="<?php echo get_photo_url($item['photo_path']); ?>" alt="<?php echo ($item['photo_title']);  ?>" style="height:80px;">
                          <span class="rig-overlay"></span>
                         <span class="rig-text"><i class="fa fa-search"></i></span>
                          </a>
                    </li>
                    <?php endforeach; ?>
                    
                </ul><?php else: ?>
                 <div class="closing text-center">No photos in flight album</div>
            <?php endif; ?>
</div> 
 <?php if(count($data['photos']) >= 0): ?>
 <div class="closing text-center"> <a href="<?php echo site_url('my/photos'); ?>">View more<i class="fa fa-angle-double-right prepend-icon"></i></a> </div>
  <?php endif; ?>
</div>                
<?php endif; ?>   
  </div></div>
 
