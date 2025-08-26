<div class="row">
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
             <?php $this->load->view('profile/sidebar/department',array('data'=>$data)); ?>
        </div>
         <div class="col-md-8 col-sm-8 col-xs-12">
            
    <div class="panel widget">
                 
                  <div class="panel-body">
                    <div class="panel-group" id="accordion">
                      <div class="panel panel-default">
                        <div class="panel-heading vd_bg-linkedin">
                        <center><h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Flight Department Info </a></h4></center>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                          <div class="panel-body">                       
                         <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="row mgbt-xs-0">
                                    <label class="col-sm-4 col-xs-4 control-label">Company Name:</label>
                                    <div class="col-sm-8 col-xs-8 controls"><?php echo get_data_value($data,'user_company'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                           
                            <?php if(get_data_value($data,'user_position_private') != 'y'): ?>
                            <div class="col-sm-12 col-xs-12">
                                <div class="row mgbt-xs-0">
                                    <label class="col-sm-4 col-xs-4 control-label">Position:</label>
                                    <div class="col-sm-8 col-xs-8 controls"><?php echo get_data_value($data,'user_position'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if(get_data_value($data,'user_fname') != ''): ?>
                            <div class="col-sm-12 col-xs-12">
                                <div class="row mgbt-xs-0">
                                    <label class="col-sm-4 col-xs-4 control-label">First Name:</label>
                                    <div class="col-sm-8 col-xs-8 controls"><?php echo get_data_value($data,'user_fname'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if(get_data_value($data,'user_lname') != ''): ?>
                            <div class="col-sm-12 col-xs-12">
                                <div class="row mgbt-xs-0">
                                    <label class="col-sm-4 col-xs-4 control-label">Last Name:</label>
                                    <div class="col-sm-8 col-xs-8 controls"><?php echo get_data_value($data,'user_lname'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if(get_data_value($data,'user_pmobile') != ''): ?>
                            <div class="col-sm-12 col-xs-12">
                                <div class="row mgbt-xs-0">
                                    <label class="col-sm-4 col-xs-4 control-label">Cell Phone:</label>
                                    <div class="col-sm-8 col-xs-8 controls"><?php echo get_data_value($data,'user_pmobile'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div> <?php endif; ?>
                             <?php if(get_data_value($data,'user_email_private') != 'y'): ?>
                            <div class="col-sm-12 col-xs-12">
                                <div class="row mgbt-xs-0">
                                    <label class="col-sm-4 col-xs-4 control-label">Email:</label>
                                    <div class="col-sm-8 col-xs-8 controls"><?php echo get_data_value($data,'user_email'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div> 
                            <?php endif; ?>       
                            <div class="col-sm-12 col-xs-12">
                            <div style="width:100%;display:inline-block; position:relative;float:left;right:0;">
                        <div id="map" style="width:100%;height:275px;"></div></div>    
                            </div>        
                                 
                        </div>
                        </div></div>
                          
                          <div class="panel panel-default">
                        <div class="panel-heading vd_bg-linkedin">
                         <center><h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> Careers </a> </h4></center>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                          <div class="panel-body">
                         <center> <a class="btn vd_btn vd_bg-green btn-md follow_big" href="<?php echo site_url('department/'.$data['user_id'].'/career'); ?>">
                <i class="fa fa-list-alt append-icon"></i>See Latest Jobs</a> </center>
                        </div>
                        </div>
                      </div>
                          
                      <div class="panel panel-default">
                        <div class="panel-heading vd_bg-linkedin">
                        <center>  <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwoo"> Verified Aircraft </a> </h4></center>
                        </div>
                        <div id="collapseTwoo" class="panel-collapse collapse">
                          <div class="panel-body">
                                   
                                <div class="skill-list">
                                    <div class="skill-name">
                                        <?php if(count($data['aircraft'])): ?>
                                            <?php foreach($data['aircraft'] as $key=>$item): ?>
                                                <?php echo $item['mfr_name'].' '.$item['model_name']; ?><br />
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>

                                </div> 
                              
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading vd_bg-linkedin">
                        <center>  <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"> Company Bio </a> </h4></center>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                          <div class="panel-body"> 
                              <div class="row" ><div class="col-md-12"><br/>                  
           <div class="content-list content-menu">
                                    <ul class="list-wrapper">
                                        <li class="mgbt-xs-10"><?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='display:block;float:right;'> <a  href="<?php echo site_url('setting#tab36'); ?>"> 
           <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?>  
          </li>
                                        <li class="mgbt-xs-10">  <span class="menu-text"><?php echo get_data_value($data,'user_bio'); ?></span> </li>

                                    </ul>
           </div>  </div></div>      
                          </div>
                        </div>
                      </div>
                      
                          <div class="panel panel-default">
                        <div class="panel-heading vd_bg-linkedin">
                        <center><h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"> Hiring Qualification </a> </h4></center>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse">
                          <div class="panel-body">
                                    <div class="row">
                                    <?php if(count($data['aircraft'])): ?>
                                        <?php foreach($data['aircraft'] as $key=>$item): ?>
                                            <div class="col-md-11 col-sm-11 col-xs-12">
                                                
                                                    <div class="content-list">

                                                        <ul  class="list-wrapper">
                                                            
                                                            <div class="col-sm-12"> <div class="text-center vd_info-parent"><br/> <img height="100px" alt="aircraft" src="<?php echo get_aircraft_photo_url(get_input_value($item,'photo','')); ?>"> </div></div>
                                                            <h4 class="vd_facebook mgbt-xs-15 font-semibold"><?php echo $item['mfr_name'].' '.$item['model_name']; ?></h4>
                                                            <?php if(count($item['requirements'])): ?>
                                                                <?php foreach($item['requirements'] as $re=>$req): ?>
                                                                    <b><?php echo select_air_requirement($req['req_type']); ?></b>
                                                                    <li>  <span class="menu-text"> Certificate <span class="menu-date"> : <?php echo $req['req_certificate']; ?> </span> </span>  </li>
                                                                    <li> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  <?php echo $req['req_ftime']; ?> Hour </span></span>  </li>
                                                                    <li>  <span class="menu-text"> Total Time in Type <span class="menu-date"> :  <?php echo $req['req_ttime']; ?> </span></span> </li>
                                                                    <li>   <span class="menu-text"> PIC Time in Type <span class="menu-date"> :  <?php echo $req['req_pic']; ?> </span></span>   </li>
                                                                    <li>   <span class="menu-text"> College Degree <span class="menu-date"> :  <?php echo $req['req_degree'] == 'y'?"Yes":"No"; ?> </span></span>  </li>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>                               
                          </div>  
                            
                            
                    </div>
                  </div>
      <div class="panel panel-default">
                        <div class="panel-heading vd_bg-linkedin">
                         <center> <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Flight Album </a> </h4></center>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse">
                          <div class="panel-body">     
                         <?php if(count($data['photos']) > 0): ?>
               
                <ul id="rig">
                 <?php foreach($data['photos'] as $key=>$item): $item = (array)$item;if($key > 3){continue;} ?>
                     <?php if($item['photo_title'] <> 'Profile Photo'): ?>
                     <li style='padding-right:2px;'>                    
                        <?php $changeDate = date("Y/m/d", $item['photo_created']); ?>  
                         <div class="closing text-center"><?php echo ($changeDate);  ?></div>
                          <a class="rig-cell" href="<?php echo get_photo_url($item['photo_path']); ?>" title="<?php echo ($changeDate);  ?>"  data-rel="prettyPhoto[2]">
                          <img  class="rig-img" src="<?php echo get_photo_url($item['photo_path']); ?>" alt="<?php echo ($item['photo_title']);  ?>" style="height:80px;">
                          <span class="rig-overlay"></span>
                         <span class="rig-text"><i class="fa fa-search"></i></span>
                          </a>
                    </li><?php endif; ?>
                    <?php endforeach; ?>
                    
                </ul><?php else: ?>
                 <div class="closing text-center">No photos in flight album.</div>
            <?php endif; ?>
              

</div> 
 

                        </div> </div>                       
                          
                          
                          
                </div>
                  
    </div>
    </div></div>
<script defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_API_KEY; ?>&callback=initMap&sensor=false"></script>

<script>
function initMap() {
var geocoder;
var map;
var address = '<?php echo get_data_value($data,'user_address').', '.get_data_value($data,'user_city').', '.get_data_value($data,'user_state').', '.get_data_value($data,'user_zip'); ?>';
 
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
        </div>
</div>