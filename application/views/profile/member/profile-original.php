<div class="row">
         <div class="col-md-11 col-md-offset-1 col-sm-11 col-xs-12">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="pd-20">
                        <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> PERSONAL INFO </button>
                    
<?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab31'); ?>" > 
                  <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?></div>
                         <div class="row">

                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">First Name:</label>
                                    <div class="col-xs-8 controls"><?php echo get_data_value($data,'user_fname'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">Last Name:</label>
                                    <div class="col-xs-8 controls"><?php echo get_data_value($data,'user_lname'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">Email:</label>
                                    <div class="col-xs-8 controls" style="font-size:11px;"><?php echo get_data_value($data,'user_email'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">Address:</label>
                                    <div class="col-xs-8 controls"><?php echo get_data_value($data,'user_address'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">City:</label>
                                    <div class="col-xs-8 controls"><?php echo get_data_value($data,'user_city'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">State:</label>
                                    <div class="col-xs-8 controls"><?php echo get_data_value($data,'user_state'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">Zip Code:</label>
                                    <div class="col-xs-8 controls"><?php echo get_data_value($data,'user_zip'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>



                            <div class="col-sm-6">
                                <div class="row mgbt-xs-0">
                                    <label class="col-xs-4 control-label">Cell Phone:</label>
                                    <div class="col-xs-8 controls"><?php echo get_data_value($data,'user_pmobile'); ?></div>
                                    <!-- col-sm-10 -->
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        
                        <div class="row">
                            <!-- col-sm-7 -->
                            <div class="col-sm-7">
                                <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> CERTIFICATE </button>
                    
             <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab32'); ?>">
                  <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?></div>
          
                                <div class="skill-list">
                                    <div class="skill-name"> <?php echo get_data_value($data,'user_certificate'); ?> Pilot</div>
                                </div>
                                <br/><br/>
                                <?php $percent = (count(explode(',',get_data_value($data,'user_rating'))) / count(select_user_rating())) * 100; ?>
                                
                                <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> RATINGS </button>
                    </div>
                                
                               <div class="skill-list">
                                    <div class="skill-name"> <?php echo get_data_value($data,'user_rating'); ?></div>
                                    <div class="progress  progress-sm">
                                        <div style="width: <?php echo $percent; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $percent; ?>" role="progressbar" class="progress-bar progress-bar-info "> <span class="sr-only"><?php echo $percent; ?>%</span> </div>
                                    </div>
                                </div>
                                <br/><br/>
                                <?php $percent = (count(explode(',',get_data_value($data,'user_rating_type'))) / count(select_user_rating_type())) * 100; ?>
                    
                    <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> TYPE RATINGS </button>
                    </div>      
                                
                                
                                <div class="skill-list">
                                    <div class="skill-name"> <?php echo get_data_value($data,'user_rating_type'); ?> </div>
                                    <div class="progress  progress-sm">
                                        <div style="width:<?php echo $percent; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $percent; ?>" role="progressbar" class="progress-bar progress-bar-info "> <span class="sr-only"><?php echo $percent; ?>%</span> </div>
                                    </div>
                                </div>
                                <br /><br />
                                
                                <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> FLIGHT PHYSICAL EXAM </button>
                    </div>
                                
                                    <div class="skill-list">
                                        <div class="skill-name"><b>   <?php echo get_data_value($data,'user_medical_month'); ?> - <?php echo get_data_value($data,'user_medical_year'); ?>  <?php echo get_data_value($data,'user_medical'); ?></b></div>
                                        
                                    </div>
                                   
                                <br/><br/>
                                
        <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> WORK EXPERIENCE </button>
                       <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab34'); ?>"> <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?>  
                    </div>
                                <div class="clearfix"></div>      
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
                     <br/><br/>
                     <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> EDUCATION </button>
                       
          <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab35'); ?>"> <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?>        
           </div> <div class="clearfix"></div>                
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
                            <!-- col-sm-7 -->
                            <div class="col-sm-5">
                            <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> TOTAL FLIGHT TIMES </button>
                        
          <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab33'); ?>"> <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?>   </div>  
                                  <div class="">
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
                                </div>
                                <br />
                                
                    <div class="mgbt-xs-10">
                        <button type="button" class="btn vd_btn vd_bg-grey btn-block"> Flight times last updated : <?php echo get_data_value_date($data,'user_modified'); ?> &nbsp; &nbsp;</button>
                    </div>      
                                <br>      
                                 
                                <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> FLIGHT TIMES BY AIRCRAFT </button>  
                       <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab335'); ?>"> <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?>   </div>       
          
                   
                                 <?php if(count($data['aircraft'])): ?>
                                    <?php foreach($data['aircraft'] as $key=>$item): ?>
                                
                                
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                              <?php if($item['purchased_date']<>''):
                                                     echo('<b>Purchased Date : </b> '.$item['purchased_date']);?>
                                                     <?endif;?>
                                                     <?php if($item['sale_date']<>''):
                                                     echo('<br/><b>Date of Sale : </b>'.$item['sale_date']);?>
                                                     <?endif;?>
                                                   
                                                
                                            </div>
                                            <div class="col-md-4 col-xs-10"> <div class="text-center vd_info-parent"><br/> <img class="img-responsive" class="center-block" alt="aircraft"  src="<?php echo get_aircraft_photo_url(get_input_value($item,'photo','')); ?>"> </div></div>

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
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-sm-6">No aircrafts found</div>
                                    </div>
                                <?php endif; ?>
                                
                                
                                
                     <!--           
                     <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> FLIGHT TIMES BY AIRCRAFT </button>
                    </div>      
                                    
                                    
                                    <?php /* if(count($data['aircraft_flown'])): ?>
                                    <?php foreach($data['aircraft_flown'] as $key=>$item): ?>
                                        <div class="row">
                                            <div class="col-md-4 col-xs-12"> <div class="text-center vd_info-parent"><br/> <img alt="aircraft" class="img-responsive" src="<?php echo get_aircraft_photo_url(get_input_value($item,'photo','')); ?>"> </div></div>

                                            <div class="col-md-8 col-xs-12">
                                                <div class="content-list">
                                                    <div data-rel="scroll">
                                                        <ul  class="list-wrapper">
                                                            <li> <span class="menu-icon vd_green"><i class="fa fa-plane"></i></span> <span class="menu-text"> Make <span class="menu-date"> : <?php echo $item['mfr_name'].' '.$item['year_mfr']; ?> </span> </span>  </li>
                                                            <li> <span class="menu-icon vd_blue"><i class=" fa fa-plane"></i></span> <span class="menu-text"> Model <span class="menu-date"> :  <?php echo $item['model_name']; ?> </span></span>  </li>
                                                            <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  <?php echo $item['total']; ?> </span></span> </li>
                                                            <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> PIC <span class="menu-date"> :  <?php echo $item['pic']; ?> </span></span>   </li>
                                                            <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> SIC <span class="menu-date"> :  <?php echo $item['sic']; ?> </span></span>  </li>
                                                            <li>  <span class="menu-icon vd_green"><i class=" fa fa-clock"></i></span> <span class="menu-text"> Date of Last Flight <span class="menu-date"> :  <?php echo $item['date']; ?> </span></span>   </li>

                                                        </ul>
                                                    </div></div>

                                            </div>

                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-sm-6">No aircrafts found</div>
                                    </div>
                                <?php endif; */?>
                                -->
                            </div>
                        </div>
                        <!-- row -->
                        


                        <hr class="pd-10"  />
                        <div class="row">
                            <div class="col-md-12 col-xs-12 mgbt-xs-20">
                       <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> VOLUNTEER WORK </button>
                    
            <?php if($data['user_id'] == $this->session->userdata('user_id')): ?>
          <div style='position:relative;display:block;float:right;'> <a  href="<?php echo site_url('setting#tab36'); ?>"> <i class="fas fa-edit append-icon vd_blue fa-lg"></i> </a> </div>
          <?php endif; ?> </div>
                                <div class="clearfix"></div>
                                <div class="content-list content-menu">
                                    <ul class="list-wrapper">
                                        <li class="mgbt-xs-10">  
                                             <span class="menu-text"> <?php echo get_data_value($data,'user_volunteerwork'); ?> </span> </li>

                                    </ul>
                                </div>

                                <div class="content-list content-menu">
                                    <ul class="list-wrapper">
                                        <li class="mgbt-xs-10">   
                                
                                <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> ADDITIONAL SKILLS/CERTIFICATIONS </button>
                    </div>
                                <span class="menu-text"> <?php echo get_data_value($data,'user_additional_skills'); ?>  </span> </li>

                                    </ul>
                                </div>

                                <div class="content-list content-menu">
                                    <ul class="list-wrapper">
                                        <li class="mgbt-xs-10">  
                                                
                                            <div class="mgbt-xs-10">
                      <button type="button" class="btn vd_btn vd_bg-facebook btn-block"> ACHIEVEMENTS </button>
                    </div>    
                                                
                     <span class="menu-text"> <?php echo get_data_value($data,'user_bio'); ?> </span> </li>

                                    </ul>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
