<?php
  if($this->input->post("action") == "updatePss") {
    if($this->input->post("password") != "" && $this->input->post("password") == $this->input->post("cpassword")){
      $user_data['user_password'] = md5($this->input->post("password"));
      $user_data['user_source'] = '';
      $this->db->where('user_id', $this->session->userdata('user_id'));
      $this->db->update('user', $user_data);
      push_message('You profile has been updated successfully');
      redirect(str_replace("/lazyeight","",$_SERVER['REQUEST_URI']), 'refresh');
    } else {
      push_message('Passwords do not match, please try again',true);
      redirect(str_replace("/lazyeight","",$_SERVER['REQUEST_URI']), 'refresh');
    }
  }
?>
<?php $fullname= ucwords(strtolower(get_data_value($data,'user_fname')).' '.strtolower(get_data_value($data,'user_lname'))); ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
      
      <div class="pprofile large">
     <div class="pcover" style="background:url(<?php echo get_user_pic_url(get_data_value($data,'user_bgimage'),get_data_value($data,'user_type')); ?>);background-size: 100% 100%;background-repeat:no-repeat;">
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
     
     <div class="username">
        <div class="name"><h3 class="font-bold mgbt-xs-5" style="color:#1f83ae;"><?php echo($fullname);?></h3></div>
        <div class="about"><h4><?php echo get_select_user_type(get_data_value($data,'user_type')); ?></h4></div>
      </div>
        
    <div class="userdetails">
    
 <?php if($data['user_id'] != $this->session->userdata('user_id')): ?>
                  <div class="row">
                <?php if($data['is_connected'] == null): ?>
                    <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-md btn-block no-br connect_big" object-id="<?php echo $data['user_id']; ?>"><i class="fa fa-check-circle append-icon" ></i>Connect</a> </div>
                    <div class="col-xs-12"> <a class="btn vd_btn vd_bg-grey btn-md btn-block no-br" href="<?php echo site_url('conversation/'.($this->session->userdata('user_id') > $data['user_id']?$this->session->userdata('user_id').'::'.$data['user_id']:$data['user_id'].'::'.$this->session->userdata('user_id'))); ?>"><i class="fa fa-envelope append-icon"></i>Send Message</a> </div>
                <?php else: ?>
                    <?php if($data['is_connected']->conn_status == 'p'): ?>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-md btn-block no-br" style="background-color:#f89c2c !important"><i class="fa fa-check-circle append-icon" ></i>Pending</a> </div>
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
            <h5 class="font-semibold" ><span class="vd_white">  <i> Total Time </i> : <?php echo isset($data['flightTime'][0])?get_data_value($data['flightTime'][0],'time_val'):''; ?></span></h5>
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
            <h5 class="font-semibold" ><span class="vd_white">  <i> Equipment</i> : </span></h5>
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
 
<div class="panel-body light-widget" style="background-color:#fff;margin-top:-15px;">
 <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>                      
  <a href="<?php echo site_url('setting'); ?>" class="vd_blue vd_timeline">Improve your profile</a><br />

            <div class="progress">
                 <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo get_data_value($data,'user_profile_percent'); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo get_data_value($data,'user_profile_percent'); ?>%">
                            <span class="sr-only"><?php echo get_data_value($data,'user_profile_percent'); ?>% Complete</span>
                        </div> &nbsp;<?php echo get_data_value($data,'user_profile_percent'); ?>%<br/>

                            </div>
        <div style="margin-top:-15px;"> Last updated :<?php echo get_data_value_date($data,'user_modified'); ?></div>

<?php endif; ?>    
<?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
    <div style="margin-top:15px;text-align:center;font-size:16px;font-weight:bold;">
     <a href="<?php echo site_url('pilot/'.$data['user_id'].'/profile'); ?>"> About </a> &nbsp; | &nbsp;
     <a href="<?php echo site_url($data['userUrl'].'network'); ?>">  Connections </a>
    </div>
    <?php else: ?>
   <div style="margin-top:15px;text-align:center;font-size:16px;font-weight:bold;">
   <a href="<?php echo site_url('pilot/'.$data['user_id'].'/profile'); ?>"> About  </a> &nbsp; |  &nbsp;
   <a href="<?php echo site_url($data['userUrl'].''); ?>"> Posts  </a>
<!-- <?php //echo '<a href="'.site_url($data['userUrl'].'courses').'">'; ?>
    <button type="button" class="btn vd_btn vd_bg-twitter btn-block">
        Flight Times</button>
        <?php //echo '</a>';?>
-->  </div>
<?php endif; ?>     
</div>

<!-- panel widget for photos -->
<div class="panel widget light-widget" style="margin-top:5px;">
                  <div class="panel-body-list">
                    <h3 class="pd-20 mgbt-xs-0"><!--<i class="fa fa-users mgr-10"></i>--> Flight Album</h3>

                    <div class="tl-post-friends">
                    <div class="row" style='padding-left:12px;'>
                <div class="col-md-12">
                 <?php if(count($data['photos']) > 0): ?>
                <div class="isotope js-isotope vd_gallery">
                <ul class="img-grid" style="margin: 0 auto;">
                 <?php
                        foreach($data['photos'] as $key=>$item): $item = (array)$item;if($key > 3){continue;} ?>

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
                    <?php else: ?>
                <li> <p class="text-center">No photos in flight album</p></li>
            <?php endif; ?>
                </ul></div></div>
                        </div>
                          </div>
                        </div>
                 <?php if(count($data['photos']) >= 0): ?>
                    <div class="closing text-center" style=""> <a href="<?php echo site_url($data['userUrl'].'photos'); ?>">Post/View Photos<i class="fa fa-angle-double-right prepend-icon"></i></a> </div>
                  <?php endif; ?>
                    
<?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
<div class="panel-body-list">
    <p class="pd-15"></p> 
    <a href="<?php echo site_url('news'); ?>">
    <img src="/lazyeight/assets/backend/img/IndustryNews.png" class="img-responsive center-block"> </a>
    <p class="pd-5"></p> 
    <a href="<?php echo site_url('flight-dispatch-board'); ?>">
    <img src="/lazyeight/assets/backend/img/jobsboard.png" class="img-responsive center-block"> </a>
    <p class="pd-5"></p>
    <a href="<?php echo site_url('my/appliedjobs'); ?>">
    <img src="/lazyeight/assets/backend/img/applied.png" class="img-responsive center-block"> </a>
    <p class="pd-5"></p>
    <a href="<?php echo site_url('salary'); ?>">
    <img src="/lazyeight/assets/backend/img/salarynav.png" class="img-responsive center-block"> </a>
    <p class="pd-5"></p> 
</div></div>
                 
<?php require_once("explore_dep.php");  ?>

<!----- EXPLORE CREW Talent -->

<?php require_once("explore_crew.php");  ?>

 <?php endif; ?>

</div> 
</div>

<!--
                    <div id="passwordModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Become a permanent Member</h4>
                          </div>
                          <form class="form-horizontal" method="post" novalidate enctype="multipart/form-data">
                          <div class="modal-body">
                              <input type="hidden" name="action" value="updatePss" />
                              <?php //form_new_password('Password','password','',true,'password','','',''); ?>
                              <?php //form_new_password('Confirm Password','cpassword','',true,'password','','',''); ?>
                          </div>
                          <div class="modal-footer">
                            <button class="btn vd_btn vd_bg-green finish" type="submit"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </form>
                        </div>

                      </div>
                    </div>
                <!-- panel widget -->
