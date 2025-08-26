<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel widget">
                  <div class="panel-heading vd_bg-grey">
                    <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-magic"></i> </span> Profile </h3>
                  </div>
                  <div class="panel-body">
                    <div class="panel-group" id="accordion">
                      <div class="panel panel-default">
                        <div class="panel-heading vd_bg-green">
                          <center><h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> PERSONAL INFO </a> </h4></center>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                          <div class="panel-body">
                          <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab31'); ?>" > 
                  <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?>                         
                         <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="row mgbt-xs-0">
                                    <label class="col-sm-4 col-xs-4 control-label">First Name:</label>
                                    <div class="col-sm-8 col-xs-8 controls"><?php echo get_data_value($data,'user_fname'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="row mgbt-xs-0">
                                    <label class="col-sm-4 col-xs-4 control-label">Last Name:</label>
                                    <div class="col-sm-8 col-xs-8 controls"><?php echo get_data_value($data,'user_lname'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="row mgbt-xs-0">
                                    <label class="col-sm-4 col-xs-4 control-label">Email:</label>
                                    <div class="col-sm-8 col-xs-8 controls" style="font-size:11px;"><?php echo get_data_value($data,'user_email'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                          <!--  <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">Address:</label>
                                    <div class="col-xs-8 controls"><?php //echo get_data_value($data,'user_address'); ?></div>
                                    
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">City:</label>
                                    <div class="col-xs-8 controls"><?php //echo get_data_value($data,'user_city'); ?></div>
                                   
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">State:</label>
                                    <div class="col-xs-8 controls"><?php //echo get_data_value($data,'user_state'); ?></div>
                                   
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">Zip Code:</label>
                                    <div class="col-xs-8 controls"><?php //echo get_data_value($data,'user_zip'); ?></div>
                                    
                                </div>
                            </div>

                            -->

                            <?php if(get_data_value($data,'user_pmobile') != ''): ?>
                            <div class="col-sm-12 col-xs-12">
                                <div class="row mgbt-xs-0">
                                    <label class="col-sm-4 col-xs-4 control-label">Cell Phone:</label>
                                    <div class="col-sm-8 col-xs-8 controls"><?php echo get_data_value($data,'user_pmobile'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div> <?php endif; ?>
                            
                            <div class="col-sm-12 col-xs-12">
                            <div style="width:100%;display:inline-block; position:relative;float:left;right:0;">
                        <div id="map" style="width:100%;height:275px;"></div></div>    
                            </div>
                         </div>
                        </div></div>
                      <div class="panel panel-default">
                        <div class="panel-heading vd_bg-green">
                          <center><h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> CERTIFICATE & RATINGS</a> </h4></center>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                          <div class="panel-body">
                          <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab32'); ?>">
                  <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?>
          
                                <div class="skill-list">
                                    <div class="skill-name"> <?php echo get_data_value($data,'user_certificate'); ?> Pilot</div>
                                </div>
                                <?php $percent = (count(explode(',',get_data_value($data,'user_rating'))) / count(select_user_rating())) * 100; ?>
                                                        
                               <div class="skill-list">
                                    <div class="skill-name"> <b> Rating : </b><?php echo get_data_value($data,'user_rating'); ?></div>
                                    <div class="progress  progress-xs">
                                        <div style="width: <?php echo $percent; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $percent; ?>" role="progressbar" class="progress-bar progress-bar-info "> <span class="sr-only"><?php echo $percent; ?>%</span> </div>
                                    </div>
                                </div>
                                <?php $percent = (count(explode(',',get_data_value($data,'user_rating_type'))) / count(select_user_rating_type())) * 100; ?>
                                 <div class="skill-list">
                                    <div class="skill-name"> <b> Type Rating : </b> <?php echo get_data_value($data,'user_rating_type'); ?> </div>
                                    <div class="progress  progress-xs">
                                        <div style="width:<?php echo $percent; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $percent; ?>" role="progressbar" class="progress-bar progress-bar-info "> <span class="sr-only"><?php echo $percent; ?>%</span> </div>
                                    </div>
                                </div>
                                       <?php if(get_data_value($data,'user_medical_month')<>0):?>                         
                                    <div class="skill-list">
                                        <div class="skill-name"><b>Flight Physical Exam : </b>   <?php echo get_data_value($data,'user_medical_month'); ?> - <?php echo get_data_value($data,'user_medical_year'); ?>  <?php echo get_data_value($data,'user_medical'); ?></div>            
                                    </div>
                                   <?php endif; ?>  
                              
                              
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading vd_bg-green">
                          <center><h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"> WORK EXPERIENCE </a> </h4></center>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                          <div class="panel-body"> 
          <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab34'); ?>"> <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?>  
           <div class="content-list content-menu">
                                    <ul class="list-wrapper">
                                           <?php if(isset($data['employers'])): ?>
                                            <?php foreach($data['employers'] as $item): $item = (array)$item; ?>
                                                <li class="mgbt-xs-10">  <span class="menu-text"> <a href="#">
 <?php echo get_data_value($item,'empl_jobtitle'); ?></a> at <a href="#"><?php echo get_data_value($item,'empl_company'); ?></a> 
 <span class="menu-info"><span class="menu-date"> <?php echo get_data_value($item,'empl_monthfromjob').' '.get_data_value($item,'empl_yearfromjob'); ?> ~ <?php echo get_data_value($item,'empl_monthtojob').' '.get_data_value($item,'empl_yeartojob'); ?>
 </span><br/><strong>Duties: </strong><?php echo get_data_value($item,'empl_jobduties'); ?></span> </span> </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>         
                          </div>
                        </div>
                      </div>
                      
                          <div class="panel panel-default">
                        <div class="panel-heading vd_bg-green">
                          <center><h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"> EDUCATION </a> </h4></center>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse">
                          <div class="panel-body">
                         <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab35'); ?>"> <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?>    
          <div class="content-list content-menu">
                                    <ul class="list-wrapper">
                                        <?php if(isset($data['educations'])): ?>
                                            <?php foreach($data['educations'] as $item): $item = (array)$item; ?>
                                                <li class="mgbt-xs-10"> <span class="menu-icon vd_green"><i class="fa  fa-university"></i></span> <span class="menu-text"> <?php echo get_data_value($item,'edu_degree'); ?> at <a href="#"><?php echo get_data_value($item,'edu_school'); ?></a> <span class="menu-info"><span class="menu-date"> <?php echo get_data_value($item,'edu_monthfromschool').' '.get_data_value($item,'edu_yearfromschool'); ?> ~ <?php echo get_data_value($item,'edu_monthtoschool').' '.get_data_value($item,'edu_yeartoschool'); ?></span></span> </span> </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                               
                          </div>
                        </div>
                      </div>
                          
               <div class="panel panel-default">
                        <div class="panel-heading vd_bg-green">
                          <center><h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"> TOTAL FLIGHT TIMES  </a> </h4></center>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse">
                          <div class="panel-body">
                          <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab33'); ?>"> <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?> 
          <div class="content-list">
                                        <div data-rel="scroll">
                                            <ul  class="list-wrapper">
                                                <?php if(count($data['flightTime'])): ?>
                                                    <?php foreach($data['flightTime'] as $key=>$item): ?>
                                                        <li> 
        <!--<span class="menu-icon <?php // ($key%2==0?'vd_yellow':($key%3==0?'vd_blue':'vd_red')); ?>"><i class="fa fa-plane"></i></span> -->
        <span class="menu-text"> <?php echo get_data_value($item,'time_key'); ?> 
        <span class="menu-date"> : <?php echo get_data_value($item,'time_val'); ?> </span> </span>  </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        </div>
                   <div class="mgbt-xs-10">
                        <button type="button" class="btn vd_btn vd_bg-grey btn-block"> Flight times last updated : <?php echo get_data_value_date($data,'user_modified'); ?> &nbsp; &nbsp;</button>
                    </div>        
                          
                          </div>
                        </div>
                      </div>       
                          
                          <div class="panel panel-default">
                        <div class="panel-heading vd_bg-green">
                          <center><h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse6"> FLIGHT TIMES BY AIRCRAFT </a> </h4></center>
                        </div>
                        <div id="collapse6" class="panel-collapse collapse">
                          <div class="panel-body">
                          <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab335'); ?>"> <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?>
          <?php if(count($data['aircraft'])): ?>
                                    <?php foreach($data['aircraft'] as $key=>$item): ?>                                
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                              <?php if($item['purchased_date']<>''):
                                                     echo('<b>Purchased Date : </b> '.$item['purchased_date']);?>
                                                     <? endif;?>
                                                     <?php if($item['sale_date']<>''):
                                                     echo('<br/><b>Date of Sale : </b>'.$item['sale_date']);?>
                                                     <? endif;?>
                                                   
                                                
                                            </div>
                                            <div class="col-md-4 col-xs-12"> <div class="text-center vd_info-parent"><br/> 
                                         <img class="img-responsive" class="center-block" alt="aircraft"  src="<?php echo get_aircraft_photo_url(get_input_value($item,'photo','')); ?>"> </div></div>

                                            <div class="col-md-8 col-xs-12">
                                                    
                                                <div class="content-list">
                                                    <div data-rel="scroll">                           
                                                        <ul  class="list-wrapper">
                                                            <li> <span class="menu-text"> Make <span class="menu-date"> : <?php echo $item['mfr_name'].' '.$item['year_mfr']; ?> </span> </span>  </li>
                                                            <li>  <span class="menu-text"> Model <span class="menu-date"> :  <?php echo $item['model_name']; ?> </span></span>  </li>
                                                            <li> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  <?php echo $item['total']; ?> </span></span> </li>
                                                            <li>  <span class="menu-text"> PIC <span class="menu-date"> :  <?php echo $item['pic']; ?> </span></span>   </li>
                                                            <li>  <span class="menu-text"> SIC <span class="menu-date"> :  <?php echo $item['sic']; ?> </span></span>  </li>
                                                            <li>  <span class="menu-text"> Date of Last Flight <span class="menu-date"> :  <?php echo $item['date']; ?> </span></span>   </li>

                                                        </ul>
                                                    </div></div>

                                            </div>

                                        </div>
                                    <?php Endforeach; ?>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-12">No aircrafts found</div>
                                    </div>
                                <?php endif; ?>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  
    </div>
    </div></div>
<script defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_API_KEY; ?>&callback=initMap&sensor=false"></script>

<script>
function initMap() {
var geocoder;
var map;
var address = '<?php if (get_data_value($data,'user_address')<>''){echo get_data_value($data,'user_address').', '.get_data_value($data,'user_city').', '.get_data_value($data,'user_state').', '.get_data_value($data,'user_zip');}else{echo(',OAK LAWN,IL,60453');}?>';
 
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-37.0902, 95.7129);
  var myOptions = {
    zoom:3,
    center: latlng,
    gestureHandling: 'none',
     zoomControl: false,
  };
  map = new google.maps.Map(document.getElementById("map"), myOptions);
   if (geocoder) {
    geocoder.geocode({
      'address': address
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(results[0].geometry.location);

          var infowindow = new google.maps.InfoWindow({
            content: '<b>' + address + '</b>',
            size: new google.maps.Size(150, 50)
          });

          var marker = new google.maps.Marker({
            position: results[0].geometry.location,
            map: map,
            title: address
          });
          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });

        } else {
          alert("No results found");
        }
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
}

</script>


