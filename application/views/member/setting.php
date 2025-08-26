<style>
  .form-group{font-family:Arial;size:14px;}
  #radioBtn .notActive{
        color: #3276b1;
        background-color: #fff;
    }
    .btn span.glyphicon {    			
	opacity: 0;				
}
.btn.active span.glyphicon {				
	opacity: 1;				
}
</style>
<script>
    $(document).ready(function(){
        $('#radioBtn a').on('click', function(){
            var sel = $(this).data('title');
            var tog = $(this).data('toggle');
            $('#'+tog).prop('value', sel);

            $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
            $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
        })

    });
</script>
<div class="vd_content-wrapper">
    <div class="vd_container">
        <div class="vd_content clearfix">

            <div class="vd_content-section clearfix">
                <div class="row">
                    <div class="col-md-12 panel-bd-top2">
                        <div class="panel widget">
                            <div class="panel-heading vd_bg-grey">
                                <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-magic"></i> </span>Edit Profile </h3>
                            </div>
                            <div class="panel-body-list">
                                <form class="form-horizontal" method="post" novalidate enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="submit" />
                                    <div id="wizard-3" class="form-wizard condensed">
                                        <ul class="nav nav-pills nav-justified">
                                            <li class=" active"><a href="#tab31" data-toggle="tab">
                                                    <div class="menu-icon"> 1 </div>
                                                    PERSONAL INFO </a></li>
                                            <!-- <li><a href="#tab30" data-toggle="tab">
                                                    <div class="menu-icon"> 2 </div>
                                                    AIRCRAFT OWNER </a></li> -->
                                            <li><a href="#tab32" data-toggle="tab">
                                                    <div class="menu-icon"> 2 </div>
                                                    CERTIFICATES and RATINGS  </a></li>
                                            <li><a href="#tab33" data-toggle="tab">
                                                    <div class="menu-icon"> 3 </div>
                                                    Total Flight Times  </a></li>
                                            <li><a href="#tab335" data-toggle="tab">
                                                    <div class="menu-icon"> 4 </div>
                                                    Flight Times by Aircraft </a></li>
                                            <li><a href="#tab34" data-toggle="tab">
                                                    <div class="menu-icon"> 5 </div>
                                                    WORK EXPERIENCE </a></li>
                                            <li><a href="#tab35" data-toggle="tab">
                                                    <div class="menu-icon"> 6 </div>
                                                    EDUCATION </a></li>
                                            <!--<li><a href="#tab36" data-toggle="tab">
                                                    <div class="menu-icon"> 7 </div>
                                                    ADDITIONAL SKILLS / CERTIFICATIONS </a></li>-->
                                        </ul>
                                        <div class="tab-content no-bd pd-25">
                                            <div class="tab-pane active" id="tab31">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Upload Professional Resume option <br /><span style="font-weight: normal">(viewable only by flight departments)</span></label>
                                                    <div class="col-sm-7 controls">
                                                        <input type="file" name="profile_resume">
                                                        <?php if (get_input_value($data, 'user_resume', 'profile_resume') != '') : ?>
                                                        <a target="_blank" href="<?php echo site_url('upload/member/resume/' . get_input_value($data, 'user_resume', 'profile_resume')); ?>"><i class="fa fa-download" style="position: absolute;top: 12px;right: 30px;"></i></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Your Profile Photo </label>
                                                    <div class="col-sm-7 controls">
                                                        <input type="file" name="profile_photo">
                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <?php form_new_input_side('First Name', 'fname', get_input_value($data, 'user_fname', 'user_fname'), true, 'text', '', '', ''); ?>
                                                    <?php form_new_input_side('Last Name', 'lname', get_input_value($data, 'user_lname', 'user_lname'), true, 'text', '', '', ''); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php form_new_input_side('Email', 'email', get_input_value($data, 'user_email', 'user_email'), true, 'text', '', '', ''); ?>
                                                    <?php form_new_input_side('Cell Phone', 'pmobile', get_input_value($data, 'user_pmobile', 'user_pmobile'), true, 'text', '', '', ''); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php form_new_input_side('Password', 'password', '', true, 'password', '', '', ''); ?>
                                                    <?php form_new_input_side('Confirm Password', 'cpassword', '', true, 'password', '', '', ''); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php form_new_input_side('Address', 'address', get_input_value($data, 'user_address', 'user_address'), true, 'text', '', '', ''); ?>
                                                    <?php form_new_input_side('City', 'city', get_input_value($data, 'user_city', 'user_city'), true, 'text', '', '', ''); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">State</label>
                                                    <div class="col-sm-3 control-label">
                                                        <?php form_new_select_side(select_state_id(), "State", "state", get_input_value($data, 'user_state', 'state'), true, 'text', '', ''); ?>
                                                    </div>

                                                    <?php form_new_input_side('Zip', 'zip', get_input_value($data, 'user_zip', 'user_zip'), true, 'text', '', '', ''); ?>
                                                </div>
                                            </div>
                                            <!-- <div class="tab-pane" id="tab30">
                                                <div id="aircrafts22">
                                                <?php foreach ($data['aircraft'] as $aircraft) : ?>
                                                    <div id="air<?php echo $aircraft['air_id']; ?>">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">As AIRCRAFT OWNER </label>
                                                            <input type="hidden" value="update" name="airstatus[]" id="airstatus<?php echo $aircraft['air_id']; ?>" />
                                                            <input type="hidden" value="<?php echo $aircraft['air_id']; ?>" name="airId[]" />
                                                            <input type="hidden" value="<?php echo $aircraft['air_id']; ?>" />
                                                            <input type="hidden" name="total[]" value="0" />
                                                            <input type="hidden" name="pic[]" value="0"/>
                                                            <input type="hidden" name="date[]" value="0"/>
                                                            <input type="hidden" name="sic[]" value="0">
                                                            <input type="hidden" value="o" name="airtype[]" />
                                                            <div class="col-sm-3 controls">
                                                                <input type="text" placeholder="Enter N-Number" name="manufacturer[]" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))"  id="manufacturer_<?php echo $aircraft['air_id']; ?>" object-id="<?php echo $aircraft['air_id']; ?>" value="<?php echo get_input_value($aircraft, 'n_number', 'n_number'); ?>" class="input-border-btm manufacturer-autocomplete" model-id="model-<?php echo $aircraft['air_id']; ?>" />
                                                                <div class="suggestion" id="suggestion_<?php echo $aircraft['air_id']; ?>"><?php echo $aircraft['mfr_name'] . ' ' . $aircraft['model_name'] . ' ' . $aircraft['year_mfr']; ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Upload Aircraft Photo </label>
                                                            <div class="col-sm-4 controls">
                                                                <input type="file" name="photo[]" />
                                                            </div>
                                                            <div class="col-sm-4 controls">
                                                                <img height="100px" src="<?php echo get_aircraft_photo_url(get_input_value($aircraft, 'photo', 'photo')); ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(<?php echo $aircraft['air_id']; ?>,'air')">Delete</button>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                                <div id="air-11">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">As AIRCRAFT OWNER </label>
                                                        <input type="hidden" value="add" name="airstatus[]" id="airstatus-11" />
                                                        <input type="hidden" value="0" name="airId[]" />
                                                        <input type="hidden" name="total[]" value="0" />
                                                        <input type="hidden" name="pic[]" value="0"/>
                                                        <input type="hidden" name="date[]" value="0"/>
                                                        <input type="hidden" name="sic[]" value="0">
                                                        <input type="hidden" value="o" name="airtype[]" />
                                                        <div class="col-sm-3 controls">
                                                            <input type="text" name="manufacturer[]" placeholder="Enter N-Number" id="manufacturer_-11" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))" object-id="-11" value="" class="input-border-btm manufacturer-autocomplete" model-id="model--11" />
                                                            <div class="suggestion" id="suggestion_-11"></div>
                                                        </div>

                                                        <?php /*

                                                        <div class="col-sm-3 controls">
                                                            <?php form_new_select_side(select_model_id_array("findnothing"), "", "model[]","", $required = true,'', $class = 'input-border-btm model-autocomplete model--11'); ?>
                                                        </div>
                                                         */ ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Upload Aircraft Photo </label>
                                                        <div class="col-sm-4 controls">
                                                            <input type="file" name="photo[]" />
                                                        </div>
                                                        <div class="col-sm-4 controls">
                                                            <img height="100px" src="<?php echo get_aircraft_photo_url(""); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="button" class="btn vd_btn vd_bg-green" onclick="addAircraft('-11')">Add</button>
                                                    </div>
                                                </div>
                                                <div class="aircraft_jack hidden">
                                                    <div id="air__id__">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">As AIRCRAFT OWNER </label>
                                                            <input type="hidden" value="add" name="airstatus[]" id="airstatus__id__" />
                                                            <input type="hidden" value="0" name="airId[]" />
                                                            <input type="hidden" name="total[]" value="0" />
                                                            <input type="hidden" name="pic[]" value="0"/>
                                                            <input type="hidden" name="date[]" value="0"/>
                                                            <input type="hidden" name="sic[]" value="0">
                                                            <input type="hidden" value="o" name="airtype[]" />
                                                            <div class="col-sm-3 controls">
                                                                <input type="text" name="manufacturer[]"  placeholder="Enter N-Number" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))"  id="manufacturer___id__" object-id="__id__" value="" class="input-border-btm manufacturer-autocomplete" model-id="model-__id__" />
                                                                <div class="suggestion" id="suggestion___id__"></div>
                                                            </div>
                                                            <?php /*
                                                            <div class="col-sm-3 controls">
                                                                <?php form_new_select_side(select_model_id_array("findnothing"), "", "model[]", "", $required = true,'', $class = 'input-border-btm model-autocomplete model-__id__'); ?>
                                                            </div>
                                                             */ ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Upload Aircraft Photo </label>
                                                            <div class="col-sm-4 controls">
                                                                <input type="file" name="photo[]" />
                                                            </div>
                                                            <div class="col-sm-4 controls">
                                                                <img height="100px" src="<?php echo get_aircraft_photo_url(""); ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button type="button" class="btn vd_btn vd_bg-green" onclick="addAircraft(__id__)">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr/>
                                                </div>
                                            </div> -->
                                            <div class="tab-pane" id="tab32">
                                                <p style="font-family:Arial;size:15px;"><h4> Temporary Certificates ONLY.</h4><br/>


For user convenience and profile accuracy,  certificates and ratings are automatically generated and continually updated against FAA public records.
<br/><br/>

However, if you just received a temporary certificate, rating, or type rating, and the FAA is processing your new one (up to 120 days) you can manually update your profile and instantly share your accomplishment with your network.


</p>
                                                <div class="form-group">

                                                    <label class="col-sm-2 control-label">Manually Update Certificate</label>
                                                    <div class="col-sm-3 controls">
                                                        <?php echo form_new_select_side(select_user_certificate(), '', 'certificate', get_input_value($data, 'user_certificate', 'user_certificate')); ?>

                                                    </div>
                                                    <label class="col-sm-2 control-label hidden">CFI Rates</label>
                                                    <div class="vd_radio radio-success hidden">
                                                        <input type="radio" name="optionsRadios2" id="optionsRadios3" value="option3" checked>
                                                        <label  for="optionsRadios3"> Yes</label>
                                                        <input type="radio" name="optionsRadios2" id="optionsRadios4" value="option4">
                                                        <label  for="optionsRadios4">No  </label>
                                                    </div>
                                                    <!-- <div class="form-group">
                                                     <label class="col-sm-7 control-label">Certified Flight Instructors hourly rates</label>
                                                         <div class="col-sm-3 controls"><input type="text" class="input-border-btm"></div>
                                                    </div>    -->

                                                </div> <br/>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label"> Manually Update Ratings</label>
                                                    <div class="col-sm-9 controls">
                                                        
                                                        
                                                        <div class="btn-group" data-toggle="buttons">
                                                        <?php foreach (select_user_rating() as $rating) : ?>
                                                        <label class="btn btn-primary <?php echo strpos($data['user_rating'], $rating) !== false ? 'active' : ''; ?>">
                                                        <input type="checkbox"  value="<?php echo $rating; ?>" id="checkbox-<?php echo $rating; ?>" autocomplete="off" <?php echo strpos($data['user_rating'], $rating) !== false ? 'checked' : ''; ?> name="rating[]">
                                                        <span class="glyphicon glyphicon-ok active" ></span>
                                                        <label for="checkbox-<?php echo $rating; ?>"> <?php echo $rating; ?> </label>
                                                        </label>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div></div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Manually Update Type Ratings</label>
                                                    <div class="col-md-3 col-sm-12 controls">
                                                        <div class="vd_checkbox checkbox-success">
                                                            <div class="form-level">
                                                            <select name="rating_type[]" class="input-border-btm ">
                                                            <?php foreach (select_user_rating_type() as $rating) :/* ?>
                                                                <input type="checkbox" value="<?php echo $rating; ?>" <?php echo strpos($data['user_rating_type'],$rating)!==FALSE?'checked="checked"':''; ?> id="checkbox-<?php echo $rating; ?>" name="rating_type[]">
                                                                <label for="checkbox-<?php echo $rating; ?>"> <?php echo $rating; ?> </label> */ ?>
                                                                <option <?php echo strpos($data['user_rating_type'], $rating) !== false ? 'selected="selected"' : ''; ?> value="<?php echo $rating; ?>"> <?php echo $rating; ?> </option>
                                                            <?php endforeach; ?>
                                                            </select>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!--
                                                G150</option><option value="122">G280</option><option value="123">GVI</option><option value="124">HF-320</option><option value="125">HS-125</option><option value="126">HS-748</option><option value="127">HW-500</option><option value="128">IA-JET</option><option value="129">KC-135</option><option value="130">L-1011</option><option value="131">L-1329</option><option value="132">L-182</option><option value="133">L-188</option><option value="134">L-382</option><option value="135">L-410</option><option value="136">LR-45</option><option value="137">LR-60</option><option value="164">LR-70</option><option value="138">LR-JET</option><option value="139">MD-11</option><option value="140">MU-2 (SFAR)</option><option value="141">MU-300</option><option value="142">N-265</option><option value="143">RA-390</option><option value="144">RA-390S</option><option value="145">RA-4000</option><option value="146">S-321</option><option value="147">S-330</option><option value="148">S-70</option><option value="149">SA-2000</option><option value="150">SA-227</option><option value="151">SD-3</option><option value="152">SF-340</option><option value="153">SJ30</option><option value="154">SJ30S</option><option value="155">SK-56</option><option value="156">SK-58</option><option value="157">SK-61</option><option value="158">SK-64</option><option value="159">SK-65</option><option value="160">SK-92</option><option value="161">SN-601</option><option value="162">YC-122</option></select>
                                                                        -->

                                                <div class="form-group hidden">
                                                    <label class="col-sm-4 control-label">Are You Safety Pilot?</label>
                                                    <div class="col-sm-6 controls">
                                                        <div class="vd_radio radio-success">
                                                            <input type="radio" name="type" id="optionsRadios3" value="p" checked>
                                                            <label  for="optionsRadios3"> Yes</label>
                                                            <input type="radio" name="type" id="optionsRadios4" value="f">
                                                            <label  for="optionsRadios5">No  </label> <br/>
                                                            <a href="#">What's a Safety Pilot? Learn more</a>
                                                        </div>
                                                    </div>



                                                </div>


                                            </div>
                                            <div class="tab-pane" id="tab335">
                                            <div id="aircrafts">
                                                <?php foreach($data['aircraft'] as $aircraft): ?>
                                                    <div id="air<?php echo $aircraft['air_id']; ?>">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Choose Specific Aircraft Flown </label>
                                                            <input type="hidden" value="update" name="airstatus[]" id="airstatus<?php echo $aircraft['air_id']; ?>" />
                                                            <input type="hidden" value="<?php echo $aircraft['air_id']; ?>" name="airId[]" />
                                                            <input type="hidden" value="<?php echo $aircraft['air_id']; ?>" />
                                                            <!-- <input type="hidden" name="total[]" value="0" />
                                                            <input type="hidden" name="pic[]" value="0"/>
                                                            <input type="hidden" name="date[]" value="0"/>
                                                            <input type="hidden" name="sic[]" value="0"> -->
                                                            <!-- <input type="hidden" value="o" name="airtype[]" /> -->

<?php /*
                                                            <label class="col-sm-3 control-label">As AIRCRAFT OWNER </label>
                                                            <input type="hidden" value="update" name="airstatus[]" id="airstatus<?php echo $aircraft['air_id']; ?>" />
                                                            <input type="hidden" value="<?php echo $aircraft['air_id']; ?>" name="airId[]" />
                                                            <input type="hidden" value="<?php echo $aircraft['air_id']; ?>" />
                                                            <input type="hidden" name="total[]" value="0" />
                                                            <input type="hidden" name="pic[]" value="0"/>
                                                            <input type="hidden" name="date[]" value="0"/>
                                                            <input type="hidden" name="sic[]" value="0">
                                                            <input type="hidden" value="o" name="airtype[]" />
*/ ?>
                                                            <div class="col-sm-3 controls">
                                                                <input type="text" placeholder="Enter N-Number" name="manufacturer[]" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))"  id="manufacturer_<?php echo $aircraft['air_id']; ?>" object-id="<?php echo $aircraft['air_id']; ?>" value="<?php echo get_input_value($aircraft,'n_number','n_number'); ?>" class="input-border-btm manufacturer-autocomplete" model-id="model-<?php echo $aircraft['air_id']; ?>" />
                                                                <div class="suggestion" id="suggestion_<?php echo $aircraft['air_id']; ?>"><?php echo $aircraft['mfr_name'].' '.$aircraft['model_name'].' '.$aircraft['year_mfr']; ?></div>
                                                            </div>
                                                        </div>

                                                        <!-- Aircraft Ownership -->
                                                        <div class="form-group">
                                                            <label for="aircft_ownership" class="col-sm-3 control-label">Aircraft Ownership ?</label>
                                                            <div class="col-sm-7 col-md-7">
                                                                <div class="input-group">
                                                                    <div id="radioBtn" class="btn-group">
                                                                        <a class="btn btn-primary btn-sm <?= $aircraft['type'] != 'f'  ? "active" : "notActive" ?>" data-toggle="aircft_ownership" data-title="o">YES</a>
                                                                        <a class="btn btn-primary btn-sm <?= $aircraft['type'] == 'f' ? "active" : "notActive" ?>" data-toggle="aircft_ownership" data-title="f">NO</a>
                                                                    </div>
                                                                    <input type="hidden" value="<?= $aircraft['type'] == 'f' ? "o" : "f" ?>" name="airtype[]" id="aircft_ownership">
<?php /*
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Upload Aircraft Photo </label>
                                                            <div class="col-sm-4 controls">
                                                                <input type="file" name="photo[]" />
                                                            </div>
                                                            <div class="col-sm-4 controls">
                                                                <img height="100px" src="<?php echo get_aircraft_photo_url(get_input_value($aircraft,'photo','photo')); ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(<?php echo $aircraft['air_id']; ?>,'air')">Delete</button>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                                <div id="air-11">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">As AIRCRAFT OWNER </label>
                                                        <input type="hidden" value="add" name="airstatus[]" id="airstatus-11" />
                                                        <input type="hidden" value="0" name="airId[]" />
                                                        <input type="hidden" name="total[]" value="0" />
                                                        <input type="hidden" name="pic[]" value="0"/>
                                                        <input type="hidden" name="date[]" value="0"/>
                                                        <input type="hidden" name="sic[]" value="0">
                                                        <input type="hidden" value="o" name="airtype[]" />
                                                        <div class="col-sm-3 controls">
                                                            <input type="text" name="manufacturer[]" placeholder="Enter N-Number" id="manufacturer_-11" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))" object-id="-11" value="" class="input-border-btm manufacturer-autocomplete" model-id="model--11" />
                                                            <div class="suggestion" id="suggestion_-11"></div>
                                                        </div>

                                                        <?php /*

                                                        <div class="col-sm-3 controls">
                                                            <?php form_new_select_side(select_model_id_array("findnothing"), "", "model[]","", $required = true,'', $class = 'input-border-btm model-autocomplete model--11'); ?>
                                                        </div>
                                                        *//* ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Upload Aircraft Photo </label>
                                                        <div class="col-sm-4 controls">
                                                            <input type="file" name="photo[]" />
                                                        </div>
                                                        <div class="col-sm-4 controls">
                                                            <img height="100px" src="<?php echo get_aircraft_photo_url(""); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="button" class="btn vd_btn vd_bg-green" onclick="addAircraft('-11')">Add</button>
                                                    </div>
                                                </div>
                                                <div class="aircraft_jack hidden">
                                                    <div id="air__id__">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">As AIRCRAFT OWNER </label>
                                                            <input type="hidden" value="add" name="airstatus[]" id="airstatus__id__" />
                                                            <input type="hidden" value="0" name="airId[]" />
                                                            <input type="hidden" name="total[]" value="0" />
                                                            <input type="hidden" name="pic[]" value="0"/>
                                                            <input type="hidden" name="date[]" value="0"/>
                                                            <input type="hidden" name="sic[]" value="0">
                                                            <input type="hidden" value="o" name="airtype[]" />
                                                            <div class="col-sm-3 controls">
                                                                <input type="text" name="manufacturer[]"  placeholder="Enter N-Number" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))"  id="manufacturer___id__" object-id="__id__" value="" class="input-border-btm manufacturer-autocomplete" model-id="model-__id__" />
                                                                <div class="suggestion" id="suggestion___id__"></div>
                                                            </div>
                                                            <?php /*
                                                            <div class="col-sm-3 controls">
                                                                <?php form_new_select_side(select_model_id_array("findnothing"), "", "model[]", "", $required = true,'', $class = 'input-border-btm model-autocomplete model-__id__'); ?>
                                                            </div>
                                                             *//* ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Upload Aircraft Photo </label>
                                                            <div class="col-sm-4 controls">
                                                                <input type="file" name="photo[]" />
                                                            </div>
                                                            <div class="col-sm-4 controls">
                                                                <img height="100px" src="<?php echo get_aircraft_photo_url(""); ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button type="button" class="btn vd_btn vd_bg-green" onclick="addAircraft(__id__)">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr/>
                                                </div>
                                            <div id="aircrafts_flown">
                                                    <?php foreach ($data['aircraft_flown'] as $aircraft) : ?>
                                                        <div id="air<?php echo $aircraft['air_id']; ?>">
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Choose specific aircraft flown </label>
                                                                <input type="hidden" value="update" name="airstatus[]" id="airstatus<?php echo $aircraft['air_id']; ?>" />
                                                                <input type="hidden" value="<?php echo $aircraft['air_id']; ?>" name="airId[]" />
                                                                <input type="hidden" value="<?php echo $aircraft['air_id']; ?>" />
                                                                <input type="hidden" value="f" name="airtype[]" />
                                                                <div class="col-sm-3 controls">
                                                                    <input type="text" name="manufacturer[]" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))"  placeholder="Enter N-Number"  id="manufacturer_<?php echo $aircraft['air_id']; ?>" object-id="<?php echo $aircraft['air_id']; ?>" value="<?php echo get_input_value($aircraft, 'n_number', 'n_number'); ?>" class="input-border-btm manufacturer-autocomplete" model-id="model-<?php echo $aircraft['air_id']; ?>" />
                                                                    <div class="suggestion" id="suggestion_<?php echo $aircraft['air_id']; ?>"><?php echo $aircraft['mfr_name'] . ' ' . $aircraft['model_name'] . ' ' . $aircraft['year_mfr']; ?></div>
*/ ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Aircraft Ownership -->

                                                        <!-- Aircraft Currently Own -->
                                                        <div class="form-group">
                                                            <label for="aircft_currently_own" class="col-sm-3 control-label">Purchased Date</label>
                                                            <div class="col-sm-7 col-md-7">
                                                                <div class="input-group">
                                                                <input type="text" class="input-border-btm" name="purchased_date[]" value="<?php echo get_input_value($aircraft, 'purchased_date', ''); ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Aircraft Currently Own -->
                                                        <!-- Date Of Purchase -->
                                                        <div class="form-group">
                                                                <label class="col-sm-3 control-label">Currently Own?</label>
                                                                <div class="col-sm-2 controls">
                                                                    <div class="input-group">
                                                                        <div id="radioBtn" class="btn-group">
                                                                            <a class="btn btn-primary btn-sm <?= $aircraft['currently_own'] == 1  ? "active" : "notActive" ?>" data-toggle="aircft_currently_own" data-title="1">YES</a>
                                                                            <a class="btn btn-primary btn-sm <?= $aircraft['currently_own'] != 1 ? "active" : "notActive" ?>" data-toggle="aircft_currently_own" data-title="0">NO</a>
                                                                        </div>
                                                                        <input type="hidden" value="<?= $aircraft['currently_own'] == 1 ? 1 : 0 ?>" name="currently_own[]" id="aircft_currently_own">
                                                                    </div>
                                                                </div>
                                                                <label class="col-sm-3 control-label">Date of Sale</label>
                                                                <div class="col-sm-2 controls">
                                                                    <input type="text" class="input-border-btm" name="sale_date[]" value="<?php echo get_input_value($aircraft, 'sale_date', ''); ?>"/>
<?php /*
                                                                <div class="col-sm-4 controls">
                                                                    <img height="100px" src="<?php echo get_aircraft_photo_url(get_input_value($aircraft, 'photo', '')); ?>" />
*/ ?>
                                                                </div>

                                                            </div>

                                                        <!-- Date Of Purchase -->
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Upload Aircraft Photo </label>
                                                            <div class="col-sm-4 controls">
                                                                <input type="file" name="photo[]" />
                                                            </div>
                                                            <div class="col-sm-4 controls">
                                                                <img height="100px" src="<?php echo get_aircraft_photo_url(get_input_value($aircraft,'photo','photo')); ?>" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                                <label class="col-sm-3 control-label">Total Flight Time</label>
                                                                <div class="col-sm-2 controls">
                                                                    <input type="text" class="input-border-btm" name="total[]" value="<?php echo get_input_value($aircraft, 'total', ''); ?>" />
                                                                </div>


                                                                <label class="col-sm-3 control-label">PIC</label>
                                                                <div class="col-sm-2 controls">
                                                                    <input type="text" class="input-border-btm" name="pic[]" value="<?php echo get_input_value($aircraft, 'pic', ''); ?>"/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">SIC</label>
                                                                <div class="col-sm-2 controls">
                                                                    <input type="text" class="input-border-btm" name="sic[]" value="<?php echo get_input_value($aircraft, 'sic', ''); ?>">
                                                                </div>
                                                                <label class="col-sm-3 control-label">Date of Last Flight</label>
                                                                <div class="col-sm-2 controls">
                                                                    <input type="text" class="input-border-btm" name="date[]" value="<?php echo get_input_value($aircraft, 'date', ''); ?>"/>
                                                                </div>

                                                            </div>
                                                        <div class="form-group text-center">
                                                            <button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(<?php echo $aircraft['air_id']; ?>,'air')">Delete</button>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                                <div id="air-11">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Choose Specific Aircraft Flown </label>
                                                        <input type="hidden" value="add" name="airstatus[]" id="airstatus-11" />
                                                        <input type="hidden" value="0" name="airId[]" />
                                                        <!-- <input type="hidden" name="total[]" value="0" />
                                                        <input type="hidden" name="pic[]" value="0"/>
                                                        <input type="hidden" name="date[]" value="0"/>
                                                        <input type="hidden" name="sic[]" value="0">
                                                        <input type="hidden" value="o" name="airtype[]" /> -->
                                                        <div class="col-sm-3 controls">
                                                            <input type="text" name="manufacturer[]" placeholder="Enter N-Number" id="manufacturer_-11" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))" object-id="-11" value="" class="input-border-btm manufacturer-autocomplete" model-id="model--11" />
                                                            <div class="suggestion" id="suggestion_-11"></div>
                                                        </div>

                                                        <?php /*

                                                        <div class="col-sm-3 controls">
                                                            <?php form_new_select_side(select_model_id_array("findnothing"), "", "model[]","", $required = true,'', $class = 'input-border-btm model-autocomplete model--11'); ?>
                                                        </div>
                                                        */ ?>
                                                    </div>
                                                    <!-- Aircraft Ownership -->
                                                    <div class="form-group">
                                                            <label for="aircft_ownership" class="col-sm-3 control-label">Aircraft Ownership ?</label>
                                                            <div class="col-sm-7 col-md-7">
                                                                <div class="input-group">
                                                                    <div id="radioBtn" class="btn-group">
                                                                        <a class="btn btn-primary btn-sm active" data-toggle="aircft_ownership" data-title="o">YES</a>
                                                                        <a class="btn btn-primary btn-sm notActive" data-toggle="aircft_ownership" data-title="f">NO</a>
                                                                    </div>
                                                                    <input type="hidden" value="o" name="airtype[]" id="aircft_ownership">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Aircraft Ownership -->



                                                        <!-- Aircraft Currently Own -->
                                                        <div class="form-group">
                                                            <label for="aircft_currently_own" class="col-sm-3 control-label">Purchased Date</label>
                                                            <div class="col-sm-7 col-md-7">
                                                                <div class="input-group">
                                                                <input type="text" class="input-border-btm" name="purchased_date[]" value=""/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Aircraft Currently Own -->
                                                        <!-- Date Of Purchase -->
                                                        <div class="form-group">
                                                                <label class="col-sm-3 control-label">Currently Own?</label>
                                                                <div class="col-sm-2 controls">
                                                                    <div class="input-group">
                                                                        <div id="radioBtn" class="btn-group">
                                                                            <a class="btn btn-primary btn-sm active" data-toggle="aircft_currently_own" data-title="1">YES</a>
                                                                            <a class="btn btn-primary btn-sm notActive" data-toggle="aircft_currently_own" data-title="0">NO</a>
                                                                        </div>
                                                                        <input type="hidden" value="1" name="currently_own[]" id="aircft_currently_own">
                                                                    </div>
                                                                </div>
                                                                <label class="col-sm-3 control-label">Date of Sale</label>
                                                                <div class="col-sm-2 controls">
                                                                    <input type="text" class="input-border-btm" name="sale_date[]" value=""/>
                                                                </div>

                                                            </div>

                                                        <!-- Date Of Purchase -->
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Upload Aircraft Photo </label>
                                                        <div class="col-sm-4 controls">
                                                            <input type="file" name="photo[]" />
                                                        </div>
                                                        <div class="col-sm-4 controls">
                                                            <img height="100px" src="<?php echo get_aircraft_photo_url(""); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                            <label class="col-sm-3 control-label">Total Flight Time</label>
                                                            <div class="col-sm-2 controls">
                                                                <input type="text" class="input-border-btm" name="total[]" />
                                                            </div>


                                                            <label class="col-sm-3 control-label">PIC</label>
                                                            <div class="col-sm-2 controls">
                                                                <input type="text" class="input-border-btm" name="pic[]" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">SIC</label>
                                                            <div class="col-sm-2 controls">
                                                                <input type="text" class="input-border-btm" name="sic[]" />
                                                            </div>
                                                            <label class="col-sm-3 control-label">Date of Last Flight</label>
                                                            <div class="col-sm-2 controls">
                                                                <input type="text" class="input-border-btm" name="date[]" />
                                                            </div>

                                                        </div>
                                                    <div class="form-group text-center">
                                                        <button type="button" class="btn vd_btn vd_bg-green" onclick="addAircraft('-11')">Add</button>
                                                    </div>
                                                </div>
                                                <div class="aircraft_jack hidden">
                                                    <div id="air__id__">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Choose Specific Aircraft Flown </label>
                                                            <input type="hidden" value="add" name="airstatus[]" id="airstatus__id__" />
                                                            <input type="hidden" value="0" name="airId[]" />
                                                            <!-- <input type="hidden" name="total[]" value="0" />
                                                            <input type="hidden" name="pic[]" value="0"/>
                                                            <input type="hidden" name="date[]" value="0"/>
                                                            <input type="hidden" name="sic[]" value="0">
                                                            <input type="hidden" value="o" name="airtype[]" /> -->
                                                            <div class="col-sm-3 controls">
                                                                <input type="text" name="manufacturer[]"  placeholder="Enter N-Number" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))"  id="manufacturer___id__" object-id="__id__" value="" class="input-border-btm manufacturer-autocomplete" model-id="model-__id__" />
                                                                <div class="suggestion" id="suggestion___id__"></div>
                                                            </div>
                                                            <?php /*
                                                            <div class="col-sm-3 controls">
                                                                <?php form_new_select_side(select_model_id_array("findnothing"), "", "model[]", "", $required = true,'', $class = 'input-border-btm model-autocomplete model-__id__'); ?>
                                                            </div>
                                                             */ ?>
                                                        </div>
                                                        <!-- Aircraft Ownership -->
                                                        <div class="form-group">
                                                            <label for="aircft_ownership" class="col-sm-3 control-label">Aircraft Ownership ?</label>
                                                            <div class="col-sm-7 col-md-7">
                                                                <div class="input-group">
                                                                    <div id="radioBtn" class="btn-group">
                                                                        <a class="btn btn-primary btn-sm active" data-toggle="aircft_ownership" data-title="o">YES</a>
                                                                        <a class="btn btn-primary btn-sm notActive" data-toggle="aircft_ownership" data-title="f">NO</a>
                                                                    </div>
                                                                    <input type="hidden" value="o" name="airtype[]" id="aircft_ownership">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Aircraft Ownership -->
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Upload Aircraft Photo </label>
                                                            <div class="col-sm-4 controls">
                                                                <input type="file" name="photo[]" />
                                                            </div>
                                                            <div class="col-sm-4 controls">
                                                                <img height="100px" src="<?php echo get_aircraft_photo_url(""); ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Total Flight Time</label>
                                                            <div class="col-sm-2 controls">
                                                                <input type="text" class="input-border-btm" name="total[]" />
                                                            </div>


                                                            <label class="col-sm-3 control-label">PIC</label>
                                                            <div class="col-sm-2 controls">
                                                                <input type="text" class="input-border-btm" name="pic[]" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">SIC</label>
                                                            <div class="col-sm-2 controls">
                                                                <input type="text" class="input-border-btm" name="sic[]" />
                                                            </div>
                                                            <label class="col-sm-3 control-label">Date of Last Flight</label>
                                                            <div class="col-sm-2 controls">
                                                                <input type="text" class="input-border-btm" name="date[]" />
                                                            </div>

                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button type="button" class="btn vd_btn vd_bg-green" onclick="addAircraft(__id__)">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr/>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="tab33">




                                                <div class="form-group">
                                                    <?php $ft = array();
                                                    foreach ($data['flightTime'] as $tmp) {
                                                        $ft[$tmp['time_key']] = $tmp['time_val'];
                                                    }
                                                    $count = 1; ?>
                                                    <?php foreach (flight_time() as $key => $val) {
                                                        ?>

                                                    <input type="hidden" name="flighttime-key[]" value="<?php echo $val; ?>" />
                                                    <?php form_new_input_side($val, 'flighttime[]', get_input_value($ft, $val, ''), true); ?>
                                                    <?php if ($count % 2 == 0) : ?>
                                                </div>
                                                <div class="form-group">


                                                    <?php endif;
                                                    $count++;
                                                } ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab34">
                                                <div id="employers">
                                                    <?php if ($data['employers'] != false) { ?>
                                                        <?php foreach ($data['employers'] as $employer) { ?>
                                                            <div class="employer" id="emp<?php echo $employer->empl_id; ?>">
                                                                <input type="hidden" name="empstatus[]" id="empstatus<?php echo $employer->empl_id; ?>" value="update" />
                                                                <input type="hidden" name="empId[]" value="<?php echo $employer->empl_id; ?>" />
                                                                <div class="form-group">
                                                                    <?php form_new_input_side('Company', 'empcompanyName[]', $employer->empl_company, true); ?>
                                                                    <?php form_new_input_side('Job Title', 'empjobTitle[]', $employer->empl_jobtitle, true); ?>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">From Date</label>
                                                                    <div class="col-sm-4 controls">
                                                                        <?php form_new_select_side_with_option('From', 'empmonthFormJob[]', select_month($employer->empl_monthfromjob), false, 'width-20 short'); ?>
                                                                        <?php form_new_select_side_with_option('&nbsp;', 'empyearFromJob[]', select_year($employer->empl_yearfromjob), false, 'width-20 short'); ?>
                                                                    </div></div>
                                                                    <div class="form-group">    
                                                                    <label class="col-sm-2 control-label">To Date</label>
                                                                    <div class="col-sm-4 controls">
                                                             <?php form_new_select_side_with_option('To', 'empmonthToJob[]', select_month($employer->empl_monthtojob), false, 'width-20 short'); ?>
                                                             <?php form_new_select_side_with_option('&nbsp;', 'empyearToJob[]', select_year($employer->empl_yeartojob), false, 'width-20 short'); ?>
                                                                    </div></div>
                                                                <div class="form-group"><br/><br/>
                                                                    <?php form_new_text_side('Duties and Equipment', 'empjobDuties[]', $employer->empl_jobduties, true); ?>
                                                                </div>
                                                                <div class="form-group text-center">
                                                                    <button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(<?php echo $employer->empl_id; ?>,'emp')">Delete</button>
                                                                </div>
                                                                <hr/>
                                                            </div>
                                                        <?php
                                                    } ?>
                                                    <?php
                                                } ?>
                                                    <div class="employer" id="emp--1111">
                                                        <input type="hidden" name="empId[]" value="0" />
                                                        <input type="hidden" name="empstatus[]" id="empstatus--1111" value="add" />
                                                        <div class="form-group">
                                                            <?php form_new_input_side('Company', 'empcompanyName[]', '', true); ?>
                                                            <?php form_new_input_side('Job Title', 'empjobTitle[]', '', true); ?>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">From Date</label>
                                                            <div class="col-sm-4 controls">
                                                                <?php form_new_select_side_with_option('From', 'empmonthFormJob[]', select_month(), false, 'width-20 short'); ?>
                                                                <?php form_new_select_side_with_option('&nbsp;', 'empyearFromJob[]', select_year(), false, 'width-20 short'); ?>
                                                            </div>

                                                            <label class="col-sm-2 control-label">To Date</label>
                                                            <div class="col-sm-4 controls">
                                                                <?php form_new_select_side_with_option('To', 'empmonthToJob[]', select_month(), false, 'width-20 short'); ?>
                                                                <?php form_new_select_side_with_option('&nbsp;', 'empyearToJob[]', select_year(), false, 'width-20 short'); ?>


                                                            </div></div>
                                                        <div class="form-group"><br/><br/>
                                                            <?php form_new_text_side('Duties', 'empjobDuties[]', '', true); ?>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button type="button" class="btn vd_btn vd_bg-green" onclick="addEmployee('--1111')">Add</button>
                                                        </div>
                                                        <hr/>
                                                    </div>
                                                    <div class="hidden employer_jack">
                                                        <div class="employer" id="emp__id__">
                                                            <input type="hidden" name="empId[]" value="__id__" />
                                                            <input type="hidden" name="empstatus[]" id="empstatus__id__" value="add" />
                                                            <div class="form-group">
                                                                <?php form_new_input_side('Company', 'empcompanyName[]', '', true); ?>
                                                                <?php form_new_input_side('Job Title', 'empjobTitle[]', '', true); ?>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">From Date</label>
                                                                <div class="col-sm-4 controls">
                                                                    <?php form_new_select_side_with_option('From', 'empmonthFormJob[]', select_month(), false, 'width-20 short'); ?>
                                                                    <?php form_new_select_side_with_option('&nbsp;', 'empyearFromJob[]', select_year(), false, 'width-20 short'); ?>
                                                                </div>

                                                                <label class="col-sm-2 control-label">To Date</label>
                                                                <div class="col-sm-4 controls">
                                                                    <?php form_new_select_side_with_option('To', 'empmonthToJob[]', select_month(), false, 'width-20 short'); ?>
                                                                    <?php form_new_select_side_with_option('&nbsp;', 'empyearToJob[]', select_year(), false, 'width-20 short'); ?>


                                                                </div></div>
                                                            <div class="form-group"><br/><br/>
                                                                <?php form_new_text_side('Duties', 'empjobDuties[]', '', true); ?>
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <button type="button" class="btn vd_btn vd_bg-green" onclick="addEmployee(__id__)">Add</button>
                                                            </div>
                                                            <hr/>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab35">
                                                <div id="educations">
                                                    <?php if ($data['educations'] != false) { ?>
                                                        <?php foreach ($data['educations'] as $education) { ?>
                                                            <div class="education" id="edu<?php echo $education->edu_id; ?>">
                                                                <input type="hidden" name="edustatus[]" id="edustatus<?php echo $education->edu_id; ?>" value="update" />
                                                                <input type="hidden" name="eduId[]" value="<?php echo $education->edu_id; ?>" />
                                                                <div class="form-group">
                                                                    <?php echo form_new_input_side('School', 'eduschoolName[]', $education->edu_school, true); ?>                                                                            <label class="col-sm-1 control-label">Graduated</label>
                                                                    <div class="col-sm-6 controls">
                                                                        <?php form_new_select_side_with_option('Gradudated', 'eduyearGrad[]', select_month($education->edu_monthgrad), false, 'width-20 short'); ?>
                                                                        <?php form_new_select_side_with_option('&nbsp;', 'edumonthGrad[]', select_year($education->edu_yeargrad), false, 'width-20 short'); ?>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">From Date</label>
                                                                    <div class="col-sm-4 controls">
                                                                        <?php form_new_select_side_with_option('From', 'edumonthFromSchool[]', select_month($education->edu_monthfromschool), false, 'width-20 short'); ?>
                                                                        <?php form_new_select_side_with_option('&nbsp;', 'eduyearFromSchool[]', select_year($education->edu_yearfromschool), false, 'width-20 short'); ?>


                                                                    </div>

                                                                    <label class="col-sm-1 control-label">To Date</label>
                                                                    <div class="col-sm-4 controls">
                                                                        <?php form_new_select_side_with_option('To', 'edumonthToSchool[]', select_month($education->edu_monthtoschool), false, 'width-20 short'); ?>
                                                                        <?php form_new_select_side_with_option('&nbsp;', 'eduyearToSchool[]', select_year($education->edu_yeartoschool), false, 'width-20 short'); ?>


                                                                    </div></div>
                                                                <div class="form-group"><br/><br/>
                                                                    <?php form_new_text_side('Degree (if College/University):', 'eduDegree[]', $education->edu_degree, true); ?>
                                                                </div>
                                                                <div class="form-group text-center">
                                                                    <button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(<?php echo $education->edu_id; ?>,'edu')">Delete</button>
                                                                </div>
                                                                <hr/>

                                                            </div>
                                                        <?php
                                                    } ?>
                                                    <?php
                                                } ?>
                                                    <div class="education" id="edu1">
                                                        <input type="hidden" name="edustatus[]" id="edustatus1" value="add" />
                                                        <input type="hidden" name="eduId[]" value="0" />
                                                        <div class="form-group">
                                                            <?php echo form_new_input_side('School', 'eduschoolName[]', '', true); ?>                                                                            <label class="col-sm-1 control-label">Graduated</label>
                                                            <div class="col-sm-6 controls">
                                                                <?php form_new_select_side_with_option('Gradudated', 'eduyearGrad[]', select_month(), false, 'width-20 short'); ?>
                                                                <?php form_new_select_side_with_option('&nbsp;', 'edumonthGrad[]', select_year(), false, 'width-20 short'); ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">From Date</label>
                                                            <div class="col-sm-4 controls">
                                                                <?php form_new_select_side_with_option('From', 'edumonthFromSchool[]', select_month(), false, 'width-20 short'); ?>
                                                                <?php form_new_select_side_with_option('&nbsp;', 'eduyearFromSchool[]', select_year(), false, 'width-20 short'); ?>


                                                            </div>

                                                            <label class="col-sm-1 control-label">To Date</label>
                                                            <div class="col-sm-4 controls">
                                                                <?php form_new_select_side_with_option('To', 'edumonthToSchool[]', select_month(), false, 'width-20 short'); ?>
                                                                <?php form_new_select_side_with_option('&nbsp;', 'eduyearToSchool[]', select_year(), false, 'width-20 short'); ?>


                                                            </div></div>
                                                        <div class="form-group"><br/><br/>
                                                            <?php form_new_text_side('Degree (if College/University):', 'eduDegree[]', '', true); ?>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button type="button" class="btn vd_btn vd_bg-green" onclick="addEducation(1)">Add</button>
                                                        </div>
                                                        <hr/>
                                                    </div>
                                                    <div class="hidden education_jack">
                                                        <div class="education" id="edu__id__">
                                                            <input type="hidden" name="eduId[]" value="__id__" />
                                                            <input type="hidden" name="edustatus[]" id="edustatus__id__" value="add" />
                                                            <div class="form-group">
                                                                <?php echo form_new_input_side('School', 'eduschoolName[]', '', true); ?>                                                                            <label class="col-sm-1 control-label">Graduated</label>
                                                                <div class="col-sm-6 controls">
                                                                    <?php form_new_select_side_with_option('Gradudated', 'eduyearGrad[]', select_month(), false, 'width-20 short'); ?>
                                                                    <?php form_new_select_side_with_option('&nbsp;', 'edumonthGrad[]', select_year(), false, 'width-20 short'); ?>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">From Date</label>
                                                                <div class="col-sm-4 controls">
                                                                    <?php form_new_select_side_with_option('From', 'edumonthFromSchool[]', select_month(), false, 'width-20 short'); ?>
                                                                    <?php form_new_select_side_with_option('&nbsp;', 'eduyearFromSchool[]', select_year(), false, 'width-20 short'); ?>


                                                                </div>

                                                                <label class="col-sm-1 control-label">To Date</label>
                                                                <div class="col-sm-4 controls">
                                                                    <?php form_new_select_side_with_option('To', 'edumonthToSchool[]', select_month(), false, 'width-20 short'); ?>
                                                                    <?php form_new_select_side_with_option('&nbsp;', 'eduyearToSchool[]', select_year(), false, 'width-20 short'); ?>


                                                                </div></div>
                                                            <div class="form-group"><br/><br/>
                                                                <?php form_new_text_side('Degree (if College/University):', 'eduDegree[]', '', true); ?>
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <button type="button" class="btn vd_btn vd_bg-green" onclick="addEducation(__id__)">Add</button>
                                                            </div>
                                                            <hr/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="tab-pane" id="tab36">
                                                <?php //form_new_text_side('VOLUNTEER WORK', 'volunteerwork', get_input_value($data, 'user_volunteerwork', 'user_volunteerwork'), false); ?>
                                                <?php // form_new_text_side('Additional Skills/Certifications', 'additional_skills', get_input_value($data, 'user_additional_skills', 'user_additional_skills'), false); ?>
                                                <?php //form_new_text_side('PERSONAL INFORMATION', 'bio', get_input_value($data, 'user_bio', 'user_bio'), false); ?>
                                            </div>-->
                                            <div class="form-actions wizard mgtp-20">
                                                <div class="row mgbt-xs-0">
                                                    <div class="col-xs-4 text-left"> <a class="btn vd_btn prev" href="javascript:void(0);"><span class="menu-icon"><i class="fa fa-fw fa-chevron-circle-left"></i></span> Previous</a> </div>
                                                    <div class="col-xs-4"><button type="submit" class="btn vd_btn vd_bg-green"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Save</button></div>
                                                    <div class="col-xs-4 text-right"> <a class="btn vd_actionbtn next" href="javascript:void(0);">Next <span class="menu-icon"><i class="fa fa-fw fa-chevron-circle-right"></i></span></a> 
                                                    <button type="submit" class="btn vd_btn vd_bg-green finish"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Finish</button> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Panel Widget -->
                    </div>

                </div>
                <!-- row -->

            </div>
            <!-- .vd_content-section -->

        </div>
        <!-- .vd_content   -->
    </div>
    <!-- .vd_container -->
</div>