

<!-- Owl Stylesheets -->
    <link rel="stylesheet" href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/owl.theme.default.min.css">
    <style>
    .contact-box {
  background-color: #ffffff;
  border: 1px solid #e7eaec;
  padding: 10px;
  margin-bottom: 10px;
}
.contact-box > a {
  color: inherit;
}
.contact-box.center-version {
  border: 1px solid #e7eaec;
  padding: 0;text-align: center;
}
.contact-box.center-version > a {
  display:inline-block;
  background-color: #ffffff;
  padding: 10px;
  text-align: center;
}
.contact-box.center-version > a img {
  width: 80px;
  height: 80px;
  margin-top: 10px;
  margin-bottom: 10px;
}
.contact-box.center-version address {
  margin-bottom: 0;
}
.contact-box .contact-box-footer {
  text-align: center;
  background-color: #ffffff;
  border-top: 1px solid #e7eaec;
  padding: 10px 10px;
}
 .owl-prev {
      
    position: absolute;
    top: 40%;
    left: -25px;
    display: block!IMPORTANT;
    border:0px solid black;
      }
      .owl-next {
          
    position: absolute;
    top: 40%;
    right: -25px;
    display: block!IMPORTANT;
    border:0px solid black;
      }       
    </style>
    
    
<?php if($this->session->userdata('user_type') == 'p'): ?>
<?php $user_conn = $this->Model_connection->suggested_pilot_department($this->session->userdata('user_id'),'department');//$this->Model_connection->friends_of_friends($this->session->userdata('user_id'),'p',5); ?>
<?php if(count($user_conn) > 0): ?> 
<div class="panel widget panel-bd-left light-widget">
<div class="panel-body">
   
    <div class="row">
        <div class="col-xs-12">
            <div class="content-list content-image content-chat">
                        <div class="mgbt-xs-10" style="margin-top:20px;">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"><span class="append-icon"><i class="fa fa-university fa-fw"></i></span> Suggested Flight Departments </button>
                    </div> 
                <div class="custom1 owl-carousel owl-theme">
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
                    
                    

                
            </div>

        </div>
    </div>
</div></div>
<?php endif; ?><?php endif; ?>
    
    
<?php if($this->session->userdata('user_type') == 'd'): ?>
    
    
    <?php $user_conn = $this->Model_connection->suggested_pilot_department($this->session->userdata('user_id'),'pilot');//$this->Model_connection->friends_of_friends($this->session->userdata('user_id'),'p',5); ?>
    <?php if(count($user_conn) > 0): ?>
    <div class="panel widget panel-bd-left light-widget">
    <div class="panel-body">
          <div class="row mgbt-xs-0">
            <div class="col-sm-12">
                
                <div class="content-list content-image content-chat">
                     <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"><span class="append-icon"><i class="fa fa-users fa-fw"></i></span> Suggested Pilots </button>
                    </div>    
                    <div class="owl-carousel owl-theme">
                    
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
          </div></div></div>
<?php endif; ?> <?php endif; ?>        
    
    
<?php $user_conn = $this->Model_connection->non_connections($this->session->userdata('user_id'),'','p',5);//$this->Model_connection->friends_of_friends($this->session->userdata('user_id'),'p',5); ?>
<?php if(count($user_conn) > 0): ?>                     
<div class="panel widget panel-bd-left light-widget">                        
<div class="panel-body">

    <div class="row">
        <div class="col-xs-12">
            <div class="content-list content-image content-chat">
                <h4>Members You May Know </h4>   
                    <div class="owl-carousel owl-theme">
                    
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
    </div>
</div></div>
 <?php endif; ?>     
    
    
    
    
<?php if(!isset($dept)): ?>
<?php $user_conn = $this->Model_connection->non_connections($this->session->userdata('user_id'),'','d',5)//$this->Model_connection->friends_of_friends($this->session->userdata('user_id'),'d',5); ?>
<?php if(count($user_conn) > 0): ?>
                   
<div class="panel widget panel-bd-left light-widget">
    <div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="content-list content-image content-chat">
                        <h4>Departments You May Know </h4>    
                <div class="custom1 owl-carousel owl-theme">
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
            </div>

        </div>
    </div>
    </div></div>
<?php endif; ?>       
<?php endif; ?>



    
<script src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/owl.carousel.js"></script>
<script src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/jquery.mousewheel.min.js"></script>
          <script>
            $(document).ready(function() {
                
              var owl = $('.owl-carousel');
              var owl2 = $('.custom1');
              
              owl.owlCarousel({
                loop: false,
                touchDrag:true,
                nav: true,
                pagination:false,
                dots:false,
                stagePadding:5,
                margin: 10,
                responsive: {
                  0: {
                    items: 2
                  },
                  600: {
                    items: 3
                  },
                  960: {
                    items: 5
                  },
                  1200: {
                    items: 6
                  }
                }
              });
              owl2.owlCarousel({
                loop: false,
                touchDrag:true,
                nav: true,
                pagination:false,
                 stagePadding:5,
                dots:false,
                margin: 10,
                responsive: {
                  0: {
                    items: 2
                  },
                  600: {
                    items: 3
                  },
                  960: {
                    items: 5
                  },
                  1200: {
                    items: 6
                  }
                }
              });
              
  $( ".owl-prev").html('<i class="fa fa-angle-left" aria-hidden="true"></i>');
 $( ".owl-next").html('<i class="fa fa-angle-right" aria-hidden="true"></i>');   
              
            });
          </script>