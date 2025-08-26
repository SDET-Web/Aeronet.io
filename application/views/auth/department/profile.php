<section id="main-sliderBlack" style="height:180px;">
<div class="center wow fadeInDown"><p class="pt-40"></p><h2>Create your profile</h2> </div>      
</section>
<section id="feature">
	<div class="container" style="padding:10px; ">
             <form method="post" enctype="multipart/form-data">
              <div class="col-xs-12 col-md-8 col-md-offset-2">
                               <h4>Create your Flight Department Profile</h4>
                                <h5>Establish your flight departments professional presence.</h5>
                                <br/>
                                <input type="hidden" name="action" value="register_department_step_2" />
                                <input type="hidden" name="id" value="<?php echo get_input_value($data,'id','id');?>" />
                                <?php //if(!isset($data['logo'])): ?>
                                    <div class="form-level">Upload your Company's Logo or Aircraft Picture*
                                        <input type="file" name="photo"  id="photo" />
                                    </div>
                                <?php //else: ?>
                                <!--
                                <input type="hidden" name="logo" value="<?php //echo get_input_value($data,'logo','logo');?>" />
                                    <div style="text-align:center;padding:3em;">
                                        <img src="<?php //echo get_user_pic_url(get_input_value($data,'logo','logo'));?>" style="width:auto;max-height:100px" />
                                    </div> -->
                                <?php //endif; ?>
                                <?php form_new_input_updated('','company',get_input_value($data,'company','company'),true,'text','','Flight Department Company Name *',''); ?>
                                <?php form_new_input_updated('','address',get_input_value($data,'street','address'),true,'text','','Address *',''); ?>
                                <?php form_new_input_updated('','city',get_input_value($data,'city','city'),true,'text','','Company City *',''); ?>
                                <?php form_new_select_updated(select_state_id(get_input_value($data,'state','state'),'Select a state'), "","state",get_input_value($data,'state','state'), true); ?>
                                <?php form_new_input_updated('','fname',get_input_value($linkedIn,'firstName','fname'),true,'text','','First Name *','fname_prviate'); ?>
                                <?php form_new_input_updated('','lname',get_input_value($linkedIn,'lastName','lname'),true,'text','','Last Name *','lname_prviate'); ?>
                                <?php form_new_input_updated('','position',get_input_value($data,'position','position'),true,'text','','Position *','position_prviate'); ?>
                                <!-- <?php form_new_input_updated('','email',get_input_value($data,'email','email'),true,'text','','Your Email *','email_private'); ?> -->
                                <?php form_new_input_updated('','phone',get_input_value($data,'phone','phone'),false,'text','','Phone','pmobile_private'); ?>
                                <!-- <?php form_new_input_updated('','password',get_input_value($data,'password','password'),true,'password','','Password *',''); ?> -->
                                <?php form_new_textarea_updated('','planes',get_input_value($data,'mfr','planes')." ".get_input_value($data,'model','planes')." ".get_input_value($data,'year_mfr','planes'),true,3,'','',''); ?>
                                <?php //form_new_textarea_updated('','bio',get_input_value($data,'bio','bio'),false,6,'','',''); ?>
                                <input type="hidden" name="bio" value="" />
                                <div class="form-level2">
                        <button id="crtprfl" class="button-main2" type="submit">Create Flight Department Page</button>
                        <!-- <button id="crtprfl" class="button-main2" type="submit"> Create Profile </button> -->
                    </div>
                            </div>
                       
                   
                        </form>
<br/>
                  <br/>
            </div>
    
</section>
<style>
    .alert{
    position:fixed; 
    top: 5px; 
    left: 25%; 
    width:72%;
    z-index:9999; }
</style>