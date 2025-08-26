<?php $fullname= ucwords(strtolower(get_data_value($data,'user_fname')).' '.strtolower(get_data_value($data,'user_lname'))); ?>
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="pprofile large">
     <div class="pcover" style="background:url(<?php echo get_user_bg_url(get_data_value($data,'user_bgimage'),get_data_value($data,'user_type')); ?>);background-size:cover;background-repeat:no-repeat;">
      <div class="piclayer">
        <div class="ploader"></div>
      </div><?php if($data['user_id'] == $this->session->userdata('user_id')): ?><a class="image-wrapper" href="#">
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
     
     <div class="username"><br/>
       <!-- <div class="name"><h3 class="font-bold mgbt-xs-5" style="color:#1f83ae;"><?php //echo($fullname);?></h3></div>
        <div class="about"><h4><?php //echo get_select_user_type(get_data_value($data,'user_type')); ?></h4></div>-->
      </div>
        
    <div class="userdetails">
    
 <?php if($data['user_id'] != $this->session->userdata('user_id')): ?>
                  <div class="row">
                <?php if($data['is_connected'] == null): ?>
                    <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-md btn-block no-br connect_big" object-id="<?php echo $data['user_id']; ?>"><i class="fa fa-check-circle append-icon" ></i><?php if($this->session->userdata('user_type')=='d'){echo('Send  Invite To Follow');}else{echo('Connect');}?></a> </div>
                    <div class="col-xs-12"> <a class="btn vd_btn vd_bg-grey btn-md btn-block no-br" href="<?php echo site_url('conversation/'.($this->session->userdata('user_id') > $data['user_id']?$this->session->userdata('user_id').'::'.$data['user_id']:$data['user_id'].'::'.$this->session->userdata('user_id'))); ?>"><i class="fa fa-envelope append-icon"></i>Send Message</a> </div>
                <?php else: ?>
                    <?php if($data['is_connected']->conn_status == 'p'): ?>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-md btn-block no-br" style="background-color:#f89c2c !important"><i class="fa fa-check-circle append-icon" ></i>Invite Pending</a> </div>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-grey btn-md btn-block no-br" href="<?php echo site_url('conversation/'.($this->session->userdata('user_id') > $data['user_id']?$this->session->userdata('user_id').'::'.$data['user_id']:$data['user_id'].'::'.$this->session->userdata('user_id'))); ?>"><i class="fa fa-envelope append-icon"></i>Send Message</a> </div>
                    <?php else: ?>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-md btn-block no-br" style="background-color:#1b9859!important"><i class="fa fa-check-circle append-icon" ></i>Connected</a> </div>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-grey btn-md btn-block no-br"  href="<?php echo site_url('conversation/'.($this->session->userdata('user_id') > $data['user_id']?$this->session->userdata('user_id').'::'.$data['user_id']:$data['user_id'].'::'.$this->session->userdata('user_id'))); ?>"><i class="fa fa-envelope append-icon"></i>Send Message</a> </div>
                    <?php endif; ?>
                <?php endif; ?>
                  </div>
        <p class="pd-30"></p>
            <?php endif; ?>
  
<div class="swiper-container s1">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="container" style="padding:0px;">
              <div style="background:url(<?php echo RIZ_ASSETS_BACKEND; ?>img/quick.png);opacity:4.5;
                 background-size: 100% 100%;  background-repeat: no-repeat;padding:15px;">

            <div class="news-list pd-10 vd_white  font-light" style="height:250px;">
            <p class="pd-5"></p>
            <h3><i><?php echo($fullname);?></i></h3>
            <h4><i><?php echo get_select_user_type(get_data_value($data,'user_type')); ?></i></h4>
            <p class="pd-10"></p>
            <h5 class="font-semibold" ><span class="vd_white">  <i>Certificate</i> : <?php echo get_data_value($data,'user_certificate'); ?></span></h5>
            <h5 class="font-semibold" ><span class="vd_white">  <i> Ratings </i> : <?php echo get_data_value($data,'user_rating'); ?></span></h5>
            <p class="pd-5"></p><h5 class="font-semibold" ><span class="vd_white">  <i> Type Ratings </i> : <?php echo get_data_value($data,'user_rating_type'); ?></span></h5>
            <h5 class="font-semibold" ><span class="vd_white"><i> Total Time </i> : <?php echo isset($data['flightTime']['0'])?get_data_value($data['flightTime']['0'],'time_val'):''; ?></span></h5>
             <!--Instrument (actual): <?php //echo isset($data['flightTime'][4])?get_data_value($data['flightTime'][4],'time_val'):''; ?><br/>
            Multi Engine: <?php //echo isset($data['flightTime'][6])?get_data_value($data['flightTime'][6],'time_val'):''; ?><br />
            --> 
           
            <p class="pd-5"></p>

             </div>
        </div>
            </div></div>

            <div class="swiper-slide">
                <div class="container" style="padding:0px;">
                <div style="background:url(<?php echo RIZ_ASSETS_BACKEND; ?>img/quick2.png);
      opacity:4.5; background-size: 100% 100%;  background-repeat: no-repeat;padding:15px;" >
    <div class="news-list pd-10 vd_white  font-light" style="height:250px;">
    <p class="pd-10"></p>
    <?php if(isset($data['employers'])): ?>
   <? $i=1;?>
   <?php foreach($data['employers'] as $item): $item = (array)$item; ?>
   <? $i++; ?>
            <h3><i>Current Company</i> :
           <?php echo get_data_value($item,'empl_company'); ?> </h3>
            <h4>Current Position : <i> <?php echo get_data_value($item,'empl_jobtitle'); ?></i></h4>
            <p class="pd-10"></p>
            <h5 class="font-semibold" ><span class="vd_white">  <i> Hire Date</i> :
             <?php $dat= '1'.'-'.get_data_value($item,'empl_monthfromjob').'-'.get_data_value($item,'empl_yearfromjob'); ?>
             <?php $date=date_create($dat); echo date_format($date,"Y-m-d"); ?>
            </span></h5>
            <h5 class="font-semibold" ><span class="vd_white">  <i>Duties and Equipment</i> :  <?php echo get_data_value($item,'empl_jobduties'); ?> </span></h5>
            <p class="pd-10"></p>

<?php if($i > 1){ break; }?>
 <?php endforeach; ?>
 <?php endif; ?>
        </div></div>
                </div></div>
 </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
  </div>  
  </div></div></div>
<!-- End row column Panel Widget -->
                      
<?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
<?php require_once("explore_dep.php");  ?>
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

</div> </div>