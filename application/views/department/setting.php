<div class="vd_content-wrapper">
    <div class="vd_container">
        <div class="vd_content clearfix">

            <div class="vd_content-section clearfix">
                <div class="row">
                    <div class="col-md-12 panel-bd-top2">
                        <div class="panel widget">
                            <div class="panel-heading vd_bg-grey">
                                <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-magic"></i> </span>Edit Your Flight Department Profile </h3>
                            </div>
                            <div class="panel-body-list">
                                <form class="form-horizontal" method="post" novalidate enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="submit" />
                                    <div id="wizard-3" class="form-wizard condensed">
                                        <ul class="nav nav-pills nav-justified">
                                            <li class="active"><a href="#tab31" data-toggle="tab">
                                                    <div class="menu-icon"> 1 </div>
                                                    COMPANY INFO </a></li>
                                            <li><a href="#tab36" data-toggle="tab">
                                                    <div class="menu-icon"> 2 </div>
                                                    COMPANY BIO </a></li>
                                            <li><a href="#tab32" data-toggle="tab">
                                                    <div class="menu-icon"> 3 </div>
                                                    VERIFIED AIRCRAFT  </a></li>
                                            <li><a href="#tab33" data-toggle="tab">
                                                    <div class="menu-icon"> 4 </div>
                                                    HIRING  QUALIFICATION  </a></li>

                                        </ul>
                                        <div class="tab-content no-bd pd-25">
                                            <div class="tab-pane active" id="tab31">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Your Company Logo </label>
                                                    <div class="col-sm-7 controls">
                                                        <input type="file" name="profile_photo">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <?php form_new_input_side('Company Name','company',get_input_value($data,'user_company','company'),true,'text','','',''); ?>

                                                </div>


                                                <div class="form-group">
                                                    <?php form_new_input_side('Address','address',get_input_value($data,'user_address','user_address'),true,'text','','',''); ?>
                                                    <?php form_new_input_side('City','city',get_input_value($data,'user_city','user_city'),true,'text','','',''); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">State</label>
                                                    <div class="col-sm-3 control-label">
                                                    <?php form_new_select_side(select_state_id(),"State","state",get_input_value($data,'user_state','state'),true,'text','',''); ?>
                                                    </div>
                                                    <?php form_new_input_side('Zip','zip',get_input_value($data,'user_zip','user_zip'),true,'text','','',''); ?>
                                                </div>
                                                <br/>
                                                <h3 style="text-align:center;">Flight Department Owner or Authorized Representative</h3><br/>
                                                <div class="form-group">
                                                    <?php form_new_input_side('First Name','fname',get_input_value($data,'user_fname','user_fname'),true,'text','','col-sm-2'); ?>
                                                    <div class="col-sm-2 controls">
                                                        <div class="vd_checkbox checkbox-success">
                                                            <input type="checkbox" name="fname_prviate" <?php echo get_input_value($data,'user_fname_prviate','fname_prviate') == 'y'?'checked="checked"':''; ?> value="y" id="checkbox-1">
                                                            <label for="checkbox-1"> Keep Private </label>
                                                        </div>  </div>
                                                    <?php form_new_input_side('Last Name','lname',get_input_value($data,'user_lname','user_lname'),true,'text','','col-sm-2'); ?>
                                                    <div class="col-sm-2 controls">
                                                        <div class="vd_checkbox checkbox-success">
                                                            <input type="checkbox" name="lname_prviate" <?php echo get_input_value($data,'user_lname_prviate','lname_prviate') == 'y'?'checked="checked"':''; ?> value="y" id="checkbox-2">
                                                            <label for="checkbox-2"> Keep Private </label>
                                                        </div>  </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php form_new_input_side('Position','position',get_input_value($data,'user_position','position'),true,'text','','col-sm-2'); ?>
                                                    <div class="col-sm-2 controls">
                                                        <div class="vd_checkbox checkbox-success">
                                                            <input type="checkbox" name="position_prviate" <?php echo get_input_value($data,'user_position_prviate','position_prviate') == 'y'?'checked="checked"':''; ?> value="y" id="checkbox-3">
                                                            <label for="checkbox-3"> Keep Private </label>
                                                        </div>  </div>
                                                    <?php form_new_input_side('Email','email',get_input_value($data,'user_email','user_email'),true,'text','','col-sm-2'); ?>
                                                    <div class="col-sm-2 controls">
                                                        <div class="vd_checkbox checkbox-success">
                                                            <input type="checkbox" name="email_priviate" <?php echo get_input_value($data,'user_email_priviate','email_priviate') == 'y'?'checked="checked"':''; ?>  value="y" id="checkbox-4">
                                                            <label for="checkbox-4"> Keep Private </label>
                                                        </div>  </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php form_new_input_side('Cell Phone','pmobile',get_input_value($data,'user_pmobile','user_pmobile'),true,'text','','col-sm-2'); ?>
                                                    <div class="col-sm-2 controls">
                                                        <div class="vd_checkbox checkbox-success">
                                                            <input type="checkbox" name="pmobile_private" <?php echo get_input_value($data,'user_pmobile_private','pmobile_private') == 'y'?'checked="checked"':''; ?>  value="y" id="checkbox-5">
                                                            <label for="checkbox-5"> Keep Private </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <?php form_new_input_side('Password','password','',true,'password','','',''); ?>
                                                    <?php form_new_input_side('Confirm Password','cpassword','',true,'password','','',''); ?>
                                                </div>


                                            </div>
                                            <div class="tab-pane" id="tab32">
                                                <div class="form-group hidden">
                                                    <?php $p = array();foreach($data['aircraft'] as $aircraft){$p[] = $aircraft['mfr_name'];} ?>
                                                    <label class="col-sm-8 col-sm-offset-2 control-label ">Add/Edit your Aircraft names separated by "/" Like Aircraft name1/Aircraft name2</label>
                                                    <div class="col-sm-8 col-sm-offset-2 controls">
                                                        <textarea name="planes" cols="40" rows="3" placeholder="" class="" disabled="disabled" required="required"><?php echo implode($p,'/'); ?></textarea>
                                                    </div>


                                                </div> <br/>
                                                <div class="form-group">
                                                    <div class="col-sm-8 col-sm-offset-2 controls">
                                                        <table style="width:100%;">
                                                            <tr>
                                                                <th style="text-align:center;">Delete</th>
                                                                <th width="50%">Aircraft</th>
                                                                <th>Upload Photo</th>
                                                            </tr>
                                                            <tbody id="aircrafts">
                                                                <?php foreach($data['aircraft'] as $aircraft): ?>
                                                                <tr id="air<?php echo $aircraft['air_id']; ?>">
                                                                    <input type="hidden"name="airstatus[]" value="update" id="airstatus<?php echo $aircraft['air_id']; ?>" />
                                                                    <input type="hidden" name="airId[]" value="<?php echo $aircraft['air_id']; ?>" />
                                                                    <input type="hidden" name="total[]" value="0" />
                                                                    <input type="hidden" name="pic[]" value="0"/>
                                                                    <input type="hidden" name="date[]" value="0"/>
                                                                    <input type="hidden" name="sic[]" value="0">
                                                                    <input type="hidden" name="airtype[]" value="o" />
                                                                    <th style="text-align:center;"><i onclick="markDelete(<?php echo $aircraft['air_id']; ?>,'air')" style="cursor:pointer" class="remove-plane danger fa fa-times"></i></th>
                                                                    <th style="position:relative">
                                                                        <input type="text" name="manufacturer[]" placeholder="Enter N-Number" id="manufacturer_<?php echo $aircraft['air_id']; ?>" object-id="<?php echo $aircraft['air_id']; ?>" value="<?php echo get_input_value($aircraft,'n_number','mfr_name'); ?>" class="input-border-btm" model-id="model-<?php echo $aircraft['air_id']; ?>" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))" />
                                                                        <div class="suggestion" id="suggestion_<?php echo $aircraft['air_id']; ?>"><?php echo $aircraft['mfr_name']; ?><?php echo $aircraft['model_name']; ?><?php echo $aircraft['year_mfr']; ?></div>
                                                                    </th>
                                                                    <th><input type="file" name="photo[]" /></th>
                                                                    <th class="hidden"><input type="text" name="nnumber[]" class="" value="<?php echo $aircraft['n_number']; ?>" placeholder="N-Number" /></th>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                                <tr id="air-1">
                                                                    <input type="hidden" value="add" name="airstatus[]" id="airstatus-1" />
                                                                    <input type="hidden" name="airId[]" value="0" />
                                                                    <input type="hidden" name="total[]" value="0" />
                                                                    <input type="hidden" name="pic[]" value="0"/>
                                                                    <input type="hidden" name="date[]" value="0"/>
                                                                    <input type="hidden" name="sic[]" value="0">
                                                                    <input type="hidden" value="o" name="airtype[]" />
                                                                    <th style="text-align:center;"><i  onclick="addAircraftDepartment('-1')" style="cursor:pointer" class="remove-plane success fa fa-plus"></i></th>
                                                                    <th style="position:relative">
                                                                        <input type="text" name="manufacturer[]" placeholder="Enter N-Number" id="manufacturer_-1" object-id="-1" value="" class="input-border-btm" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))" model-id="model--1" />
                                                                        <div class="suggestion" id="suggestion_-1"></div>
                                                                    </th>
                                                                    <th><input type="file" name="photo[]" /></th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table>
                                                            <tbody class="aircraft_jack hidden">
                                                                <tr id="air__id__">
                                                                    <input type="hidden" value="add" name="airstatus[]" id="airstatus-__id__" />
                                                                    <input type="hidden" name="airId[]" value="0" />
                                                                    <input type="hidden" name="total[]" value="0" />
                                                                    <input type="hidden" name="pic[]" value="0"/>
                                                                    <input type="hidden" name="date[]" value="0"/>
                                                                    <input type="hidden" name="sic[]" value="0">
                                                                    <input type="hidden" value="o" name="airtype[]" />
                                                                    <th style="text-align:center;"><i  onclick="addAircraftDepartment('__id__')" style="cursor:pointer" class="remove-plane success fa fa-plus"></i></th>
                                                                    <th style="position:relative">
                                                                        <input type="text" placeholder="Enter N-Number" name="manufacturer[]" onkeyup="manufacturer_search($(this))" onblur="manufacturer_search($(this))"  id="manufacturer___id__" object-id="__id__" value="" class="input-border-btm" model-id="model-__id__" />
                                                                        <div class="suggestion" id="suggestion___id__"></div>
                                                                    </th>
                                                                    <th><input type="file" name="photo[]" /></th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab33">
                                                <h4>Add Hiring Qualification of Your  <span class="font-semibold"> Verified Air Crafts</span></h4>
                                                <ul class="nav nav-tabs">
                                                    <?php foreach($data['aircraft'] as $key=>$aircraft): ?>
                                                    <li<?php echo $key == 0?' class="active"':'' ?>><a href="#tab<?php echo $aircraft['air_id']; ?>" data-toggle="tab"><?php echo $aircraft['name']; ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <br/>
                                                <div class="tab-content mgbt-xs-20">
                                                    <?php foreach($data['aircraft'] as $key=>$aircraft): ?>
                                                    <div class="tab-pane <?php echo $key == 0?'active':'' ?>" id="tab<?php echo $aircraft['air_id']; ?>">
                                                        <div class="row">
                                                            <?php $ar = count($aircraft['requirements']) > 0?$aircraft['requirements']:select_air_requirement(); $insert = count($aircraft['requirements']) > 0?false:true; ?>
                                                            <?php foreach($ar as $ley=>$walue): $ley = !$insert?$ar[$ley]['req_type']:$ley; ?>
                                                            <div class="col-md-6 col-sm-6">
                                                                <h4 style="text-align:center;font-weight:bold;"><?php echo select_air_requirement($ley); ?></h4><br/>
                                                                <input type="hidden" name="air_id[]" value="<?php echo $aircraft['air_id']; ?>" />
                                                                <input type="hidden" name="req_id[]" value="<?php echo !isset($walue['req_id'])?0:$walue['req_id']; ?>" />
                                                                <input type="hidden" name="req_type[]" value="<?php echo $ley; ?>" />
                                                                <input type="hidden" value="<?php echo $insert?'add':'update'; ?>" name="reqstatus[]" />
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Choose Certificate </label>
                                                                    <div class="col-sm-4 controls">

                                                                        <?php echo form_new_select_side(select_user_certificate(), '','req_certificate[]',get_input_value($walue,'req_certificate','')); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <?php form_new_input_side('Total Flight Time','req_ftime[]',get_input_value($walue,'req_ftime',''),true,'text','', 'col-sm-2','col-sm-3'); ?>
                                                                    <?php form_new_input_side('Total Time in Type','req_ttime[]',get_input_value($walue,'req_ttime',''),true,'text','','col-sm-2','col-sm-3'); ?>
                                                                </div>


                                                                <div class="form-group">
                                                                    <?php form_new_input_side('PIC Time in Type','req_pic[]',get_input_value($walue,'req_pic',''),true,'text','','col-sm-2','col-sm-3'); ?>
                                                                    <label class="col-sm-3 control-label">College degree</label>
                                                                    <div class="col-sm-2">
                                                                        <?php echo form_new_select_side(array('y'=>'Yes','n'=>'No'), '','req_degree[]',get_input_value($walue,'req_degree','')); ?>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                            </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <br/><br/>
                                                <hr/>
                                            </div>
                                            <div class="tab-pane" id="tab36">
                                                <div class="form-group">
                                                    <?php form_new_text_side('Additional Company Info','bio',get_input_value($data,'user_bio','user_bio'),false); ?>
                                                </div>
                                            </div>
                                            <div class="form-actions wizard mgtp-20">
                                                <div class="row mgbt-xs-0">
                                                    <div class="col-xs-6"> <a class="btn vd_btn prev" href="javascript:void(0);"><span class="menu-icon"><i class="fa fa-fw fa-chevron-circle-left"></i></span> Previous</a> </div>
                                                    <div class="col-xs-6 text-right"> <a class="btn vd_btn next" href="javascript:void(0);">Next <span class="menu-icon"><i class="fa fa-fw fa-chevron-circle-right"></i></span></a> <button class="btn vd_btn vd_bg-green finish" type="submit"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Finish</button> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
