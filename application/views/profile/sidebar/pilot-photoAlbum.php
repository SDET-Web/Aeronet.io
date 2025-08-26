<?php $fullname= ucwords(strtolower(get_data_value($data,'user_fname')).' '.strtolower(get_data_value($data,'user_lname'))); ?>
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="pprofile large">
     <div class="pcover" style="background:url(<?php echo get_user_bg_url(get_data_value($data,'user_bgimage'),get_data_value($data,'user_type')); ?>);background-size: 100% 100%;background-repeat:no-repeat;">
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
 
<?php if($data['user_id'] <> $this->session->userdata('user_id')): ?>
<div class="panel-body light-widget" style="background-color:#fff;margin-top:-15px;">
<div style="margin-top:-5px;text-align:center;font-size:16px;font-weight:bold;">
<a href="<?php echo site_url('pilot/'.$data['user_id'].'/profile'); ?>"> About  </a> &nbsp; |  &nbsp;
<a href="<?php echo site_url($data['userUrl'].''); ?>"> Posts  </a> 
<?php if($data['user_type'] == 'd'): ?>
&nbsp; |  &nbsp; <a target="_blank" href="<?php echo site_url('upload/member/resume/' . get_input_value($data, 'user_resume', 'profile_resume')); ?>"> Resume  </a>
 <?php endif; ?> </div> </div> 
<?php endif; ?>   

                     
<?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
<?php require_once("explore_dep.php");  ?>
<!----- EXPLORE CREW Talent -->
<?php require_once("explore_crew.php");  ?>    

<div class="panel widget light-widget" style="margin-top:5px;margin-bottom:0px;">   
<div class="panel-body-list">
<p class="pd-10"></p>  
<h3 class="pd-20 mgbt-xs-0 text-center  font-semibold vd_blue"> Flight Album </h3>
                    <div class="tl-post-friends">
                        
                <div class="row" style='padding-left:10px;'>
                <div class="col-md-12">
                 <?php if(count($data['photos']) > 0): ?>
                <div class="isotope js-isotope vd_gallery">
                <ul class="img-grid" style="margin: 0 auto;">
                 <?php foreach($data['photos'] as $key=>$item): $item = (array)$item;if($key > 3){continue;} ?>
                    <li style='margin-left:10px;'>                    
                        <?php if($item['photo_title'] == 'Profile Photo'): ?>
                          <a href="<?php echo get_user_pic_url($item['photo_path']); ?>" data-rel="prettyPhoto[2]">
                              <img alt="photo" src="<?php echo get_user_pic_url($item['photo_path']); ?>"></a>
                        <?php else: ?>
                          <a href="<?php echo get_photo_url($item['photo_path']); ?>" data-rel="prettyPhoto[2]">
                              <img alt="photo" src="<?php echo get_photo_url($item['photo_path']); ?>"></a>
                        <?php endif; ?>
                      
                    </li>
                    <?php endforeach; ?>
                    
                </ul></div><?php else: ?>
                 <p class="text-center">No photos in flight album</p>
            <?php endif; ?></div>
                        </div>
                          </div>
                        
                 <?php if(count($data['photos']) >= 0): ?>
                    <div class="closing text-center" style=""> <a href="<?php echo site_url($data['userUrl'].'photos'); ?>">Post/View Photos<i class="fa fa-angle-double-right prepend-icon"></i></a> </div>
                  <?php endif; ?></div> </div>                


 <?php endif; ?>

<style>
      .swiper-container {
        width: 100%;
        height: 100%;
      }

      .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
      }

      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    </style>
    
</style>    

<div class="swiper-container mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">Slide 1</div>
        <div class="swiper-slide">Slide 2</div>
        <div class="swiper-slide">Slide 3</div>
        <div class="swiper-slide">Slide 4</div>
        <div class="swiper-slide">Slide 5</div>
        <div class="swiper-slide">Slide 6</div>
        <div class="swiper-slide">Slide 7</div>
        <div class="swiper-slide">Slide 8</div>
        <div class="swiper-slide">Slide 9</div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>

    <!-- Swiper JS -->
   

   
</div></div>