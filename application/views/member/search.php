                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="panel widget light-widget">
                            <div class="panel-body">
                                <h4 class="mgbt-xs-20 mgtp-10">
                                    <span class="font-light vd_green"> Search Results</span></h4>
                                <div class="row mgbt-xs-0">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="content-list content-image content-chat">
                                            <ul class="list-wrapper no-bd-btm pd-lr-10">
                                                <?php if(isset($_POST['pilot']) && $_POST['pilot'] == 1): ?>
                                                <li class="group-heading vd_bg-black-20" style="padding:10px;">
                                                    <h4>Crew Members</h4>
                                                </li>
                                                <?php $countP = 0; if(count($data['data'])): ?>
                                                    <?php foreach($data['data'] as $key=>$item): $item = (array)$item;
                                                        if($item['user_type'] != 'd'):
                                                            $countP++
                                                            ?>

                                                            <li style="padding:10px;">
                                                               
                                                                    <div class="menu-icon"><img src="<?php echo get_user_pic_url($item['user_image'],$item['user_type']); ?>" style="height:40px;width:40px;" class="tl-img img-left img-circle  mgtp-5" alt="<?php echo get_data_value($item,'user_name'); ?>"></div>
                                                                    <div class="menu-text"> <a href="<?php echo site_url('pilot/'.$item['user_id']); ?>"><b style="font-size:18px;"><?php echo get_data_value($item,'user_name'); ?></b></a>
                                                                        <div class="menu-info">
                                                            <span class="menu-date" style="font-size:16px;color:#080;font-weight:600;font-style:normal;">
                                                            <?php echo get_select_user_type(get_data_value($item,'user_type')); ?></span>
                                                            <span style="font-size:16px;color:#999;font-weight:600;font-style:normal;">
                                                            <?php echo get_data_value($item,'user_address').' '.get_data_value($item,'user_city').' '.get_data_value($item,'user_state'); ?></span>
                                                            <br/>
                                                            <a href="#" class="btn vd_btn vd_bg-green connect_big" object-id="<?php echo $item['user_id']; ?>">
                                                            <i class="fa fa-check-circle append-icon"></i>Connect</a>
                                                            </div>
                                                            </div>
                                                             <?php //echo $item['user_lat']; ?> <?php //echo $item['user_lng']; ?></li>
                                                        <?php endif;endforeach;?>
                                                <?php endif; ?>
                                                <?php if($countP == 0): ?>
                                                    <li class="group-heading vd_bg-black-20">No Crew Members found</li>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if(isset($_POST['department']) && $_POST['department'] == 1): ?>
                                                <li class="group-heading vd_bg-black-20" style="padding:10px;"> 
                                                <h4>Flight Departments</h4></li>

                                                <?php $countP = 0; if(count($data['data'])): ?>
                                                    <?php foreach($data['data'] as $key=>$item): $item = (array)$item;
                                                        if($item['user_type'] == 'd'):
                                                            $countP++
                                                            ?>
                                                            <li style="padding:10px;">
                                                               
                                                                    <div class="menu-icon"><img src="<?php echo get_user_pic_url($item['user_image'],$item['user_type']); ?>" style="height:40px;width:40px;" class="tl-img img-left img-circle  mgtp-5" alt="<?php echo get_data_value($item,'user_name'); ?>"></div>
                                                                    <div class="menu-text">
                                                                    <a href="<?php echo site_url('department/'.$item['user_id']); ?>">    
                                                                        <b style="font-size:18px;"><?php echo get_data_value($item,'user_company'); ?></b></a>                                                                     
                                                                        <div class="menu-info">
                                                                            <span class="menu-date" style="font-size:16px;color:#080;font-weight:600;font-style:normal;">
                                                                            <?php echo get_select_user_type(get_data_value($item,'user_type')); ?> </span>
                                                                            <span style="font-size:16px;color:#999;font-weight:600;font-style:normal;">
                                                                            <?php echo get_data_value($item,'user_address').' '.get_data_value($item,'user_city').' '.get_data_value($item,'user_state'); ?></span>
                                                                        <br/>
                                                                    <a href="#" class="btn vd_btn vd_bg-blue mgr-10 follow_big" object-id="<?php echo $item['user_id']; ?>">
                                                                    <i class="fa fa-link append-icon"></i>Follow</a>
                                                                    </div>
                                                                    </div>
                                                                    
                                                               
                                                            </li>
                                                        <?php endif;endforeach;?>
                                                <?php endif; ?>
                                                <?php if($countP == 0): ?>
                                                    <li class="group-heading vd_bg-black-20">No Flight Departments found</li>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div style="width:100%;display:inline-block; position:relative;float:left;right:0;">
                        <div id="map" style="width:100%;height:450px;"></div></div>
                        
                       
                    </div>           
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places,geometry&key=<?php echo GOOGLE_API_KEY; ?>&sensor=true">
<script defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_API_KEY; ?>&callback=initMap&sensor=false"></script>
</script>

<script>
var locations = [
<?php foreach($data['data'] as $key=>$item): $item = (array)$item; ?>
 ['<?php echo $item['user_name']; ?>', '<?php echo get_data_value($item,'user_address').' '.get_data_value($item,'user_city').', '.get_data_value($item,'user_state'); ?>', '<?php echo $key; ?>'], 
<?php endforeach; ?>
 ];

var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();

function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-37.0902, 95.7129);
  var myOptions = {
    zoom:3,
    center: latlng,
    gestureHandling: 'none',
    zoomControl: false,
  };
  map = new google.maps.Map(document.getElementById("map"), myOptions);
    
    for (i = 0; i < locations.length; i++) {
        geocodeAddress(locations, i);
    }
}
google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
    var title = locations[i][0];
    var address = locations[i][1];
    var url = locations[i][2];
    
    geocoder.geocode({
        'address': locations[i][1]
    },

    function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var marker = new google.maps.Marker({
                icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
                map: map,
                position: results[0].geometry.location,
                title: title,
                animation: google.maps.Animation.DROP,
                address: address,
                url: url
            })
            infoWindow(marker, map, title, address, url);
            bounds.extend(marker.getPosition());
            map.fitBounds(bounds);
        } else {
            alert("geocode of " + address + " failed:" + status);
        }
    });
}

function infoWindow(marker, map, title, address, url) {
    google.maps.event.addListener(marker, 'click', function () {
        var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><a href='" + url + "'>View location</a></p></div>";
        iw = new google.maps.InfoWindow({
            content: html,
            maxWidth: 350
        });
        iw.open(map, marker);
    });
}

function createMarker(results) {
    var marker = new google.maps.Marker({
        icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
        map: map,
        position: results[0].geometry.location,
        title: title,
        animation: google.maps.Animation.DROP,
        address: address,
        url: url
    })
    bounds.extend(marker.getPosition());
    map.fitBounds(bounds);
    infoWindow(marker, map, title, address, url);
    return marker;
}

    
</script>    
