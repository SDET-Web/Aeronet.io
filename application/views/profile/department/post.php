<div class="row">
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
             <?php $this->load->view('profile/sidebar/department',array('data'=>$data)); ?>
        </div>
         <div class="col-md-8 col-sm-8 col-xs-12">
          <div class="clearfix pt-10"> &nbsp; </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>

                    <div class="tabs">
                        <ul class="nav nav-tabs widget">
                          <li class="active" style="width:50%;font-size:16px;"  > <a href="#flight-tab" data-toggle="tab"> <span class="menu-icon"><i class="fas fa-plane"></i></span> Showcase a Flight <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                          <li style="width:48%;font-size:16px;" > <a href="#main-tab" data-toggle="tab"> <span class="menu-icon"><i class="fa fa-comments"></i></span> Share Job Post  <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                        </ul>
                        <div class="tab-content  mgbt-xs-20">
                        <div class="tab-pane active" id="flight-tab" style="margin-top: -60px;padding: 15px;padding-bottom:0; ">
                            <form method="post" enctype="multipart/form-data" onsubmit="setItUp();">
                                <input type="hidden" name="type" id="type" value="ifr" />
                                <input type="hidden" name="originLat" id="originLat" value="" />
                                <input type="hidden" name="originLng" id="originLng" value="" />
                                <input type="hidden" name="destinationLat" id="destinationLat" value="" />
                                <input type="hidden" name="destinatinoLng" id="destinatinoLng" value="" />
                                <input type="hidden" name="flightHTML" id="flightHTML" value="" />
                                <input type="hidden" name="flightMAP" id="flightMAP" value="" />
                                <div class="row mb-0">
                                <div class="col-sm-12 col-md-6">
                                  <div class="mgbt-xs-10">
                                    <a class="btn btn-primary" id="ifr">IFR</a>
                                    <a class="btn btn-white" id="vfr">VFR</a>
                                  </div>

                                    <div class="ifr">
                                        <div class="form-group">
                                            <div class="controls">
                                                <input type="text" placeholder="Enter N-Number" name="nnumber" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))"  id="nnumber" object-id="" value="" class="input-border-btm manufacturer-autocomplete" model-id="model-" />
                                                <div class="suggestion" id="suggestion_"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="controls">
                                                <input type="date" style="border:0px solid;border-bottom: 1px solid #D5D5D5;padding: 6px 6px 7px;" placeholder="Choose Flight Date" name="fdate" id="fdate" class="datepicker" value="<?php echo date("Y-m-d"); ?>" />
                                            </div>
                                        </div>
                                        <img src="/assets/image1.png" class="dummy-map" style="max-width:100%" />
                                        <div class="clearfix">&nbsp;</div>
                                        <button class="btn btn-default" type="button" id="flightLookupButton" onclick="getFlights()" >Find My Flight</button>
                                        <div class="clearfix">&nbsp;</div>
                                        <p id="flightDataError" style="display:none;" class="alert alert-danger mt-10 mb-10"></p>
                                        <div class="clearfix">&nbsp;</div>
                                        <div id="flightDetails" style="display: none;">
                                            <div class="panel-group" id="flights" role="tablist" aria-multiselectable="true"></div>
                                            <div id="map"></div>
                                            <input type="text" rows="3" class="mt-10" placeholder="Remarks" id="flightContent" name="flightContent" value="" />
                                            <div class="clearfix">&nbsp;</div>
                                             </div>
                                    </div>
                                    <div class="vfr" style="display:none;">
                                        <input type="text" placeholder="Origin City" name="origin" id="origin" class="mt-20 mb-20 input-border-btm" />
                                        <input type="text" placeholder="Destination City" name="destination" id="destination" class="input-border-btm" />
                                        <div class="clearfix">&nbsp;</div>
                                        <div id="mapManual" style="min-height: 350px"></div>
                                        <input type="text" rows="3" class="mt-10" placeholder="Remarks" id="flightContentVFR" name="flightContentVFR" value="" />
                                        <div class="clearfix">&nbsp;</div>
                                        <?php /*
                                        <div id="dropzoneVFR" class="pb-10" style="position: relative;width: 48%;">
                                            <i class="fa fa-camera" style="z-index: 0;font-size: 3em;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);"></i>
                                            <div id="uploadFlightPhotosVFR" class="dropzone" style="position: relative; z-index: 10000;padding: 0;border-style: solid;border-color: #333;"></div>
                                        </div>
                                        <button class="btn btn-primary" type="button" onclick="saveMyFlightVFr()">Showcase My Flight</button>*/ ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="image-panel-flight"></div>
                                <input type="file" id="filetoattach_flight" class="hidden" />
                                <input type="file" id="videotoattach_flight" name="video" class="hidden" accept="video/*" />
                                <div class="clearfix"></div>
                                <div class="vd_textarea-menu vd_bg-dark-green vd_bd-green" >
                                    <ul class="nav nav-pills ">
                                        <li class="one-icon" id="attachments">
                                            <a data-toggle="tab-post" onclick="$('#filetoattach_flight').trigger('click');" href="javascript:void(0);">
                                              <span class="menu-icon">
                                              <i class="fa fa-camera fa-fw"></i>
                                              </span>
                                            </a>
                                        </li>
                                        <li class="one-icon" id="video-attachments">
                                            <a data-toggle="tab-post" onclick="$('#videotoattach_flight').trigger('click');" href="javascript:void(0);">
                                              <span class="menu-icon">
                                              <i class="fa fa-video fa-fw"></i>
                                              </span>
                                            </a>
                                        </li>
                                        <li class="pull-right">
                                            <button type="submit" onclick="this.form.submit(); this.disabled=true;" style="background:transparent;color:#fff;border:0 solid;padding:6px;" data-toggle="tab-post" href="javascript:void(0);" style="border-left:1px solid rgba(255,255,255,.3)">
                                              <span class="menu-icon">
                                                <i class="fa fa-check fa-fw"></i>
                                              </span>
                                              <span class="menu-text">
                                                Showcase My Flight
                                              </span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            </form>
                        </div>

                           <div class="tab-pane" id="main-tab">
                                <div class="child-menu">
                                    <div class="lead emoji-picker-container" style="margin-top:-60px;">
                                        <textarea id="post-content" class="no-bd" rows="3" placeholder="<?php if($this->session->userdata("user_type") == "d"):?>Share a job opening with your network...<?else:?>What's on your mind? <?endif?>" data-emojiable="true" data-emoji-input="unicode"></textarea>
                                    </div>
                                    <div class="user-panel hidden" text-id="user-content">
                                        <select class="select-main select" id="tagged" style="width:100%;height:50px;" multiple="multiple">
                                            <option value="">Choose</option>
                                            <?php if($data['connections']<>''):
                                            foreach($data['connections'] as $conn): ?>
                                                <option value="<?php echo $conn->user_id; ?>"><?php echo $conn->user_fname.' '.$conn->user_lname; ?></option>
                                            <?php endforeach;endif; ?>
                                        </select>
                                    </div>
                                    <div class="image-panel" text-id="post-content"></div>
                                    <div class="vd_textarea-menu vd_bg-dark-green vd_bd-green" >
                                        <ul class="nav nav-pills ">
                                            <li class="one-icon ">
                                                <a class="post-tag" href="javascript:void(0);">
                                                                                                                                                        <span class="menu-icon">
                                                                                                                                                                <i class="fa fa-user fa-fw"></i>
                                                                                                                                                        </span>
                                                </a>
                                            </li>
                                            <li class="one-icon" id="attachments">
                                                <a data-toggle="tab-post" onclick="$('#filetoattach').trigger('click');" href="javascript:void(0);">
                                                                                                                                                        <span class="menu-icon">
                                                                                                                                                        <i class="fa fa-camera fa-fw"></i>
                                                                                                                                                        </span>
                                                </a>
                                                <input type="file" id="filetoattach" class="hidden" />
                                            </li>
                                            <li class="pull-right" id="post-it">
                                                <a data-toggle="tab-post" href="javascript:void(0);" style="border-left:1px solid rgba(255,255,255,.3)">
                                                                                                                                                        <span class="menu-icon">
                                                                                                                                                                <i class="fa fa-check fa-fw"></i>
                                                                                                                                                        </span>
                                                                                                                                                        <span class="menu-text">
                                                                                                                                                                Post
                                                                                                                                                        </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        
                        
                        </div></div>
                     <?php endif; ?>       

                    <br/><br/>

                    <script type="text/javascript">
    var myvar='<?php echo $this->session->userdata('user_image');?>';
    sessionStorage.setItem('key', myvar);

    </script>
                    <ul class="vd_timeline post-list"  zeroMessage="You don't have any posts" barShowFuntion="" isBlocked="false" page="0" sort=""  barTitle="Favorite Articles" countContainer="#count-favorite-article" searchTerm="" url="<?php echo site_url('post/'.$data['user_id']); ?>" ></ul>

                <br/><br/>
                </div>

            </div>
        </div>
</div>

<div id="ID"></div>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqw2p1vFA0IAskKjyZpu41BcApMt_MzmE&callback=initMapper&libraries=places&sensor=false"></script>
    <script>
    function initMapper(){    }
    </script>

    <div class="videoPopup">
      <div class="popupPlayer"></div>
    </div>