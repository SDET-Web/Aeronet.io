                <div class="row">
                    <div class="col-md-11 col-sm-12 col-xs-12">
                        <div class="panel widget">
                            <div class="panel-body-list text-center">
        <div class="center" style="margin-top:60px;">
             <img  class="center-block" src="<?php echo RIZ_ASSETS_BACKEND;?>img/resumepg11.jpg">
              <img  class="center-block" src="<?php echo RIZ_ASSETS_BACKEND;?>img/resumepg12.jpg">
               <img  class="center-block" src="<?php echo RIZ_ASSETS_BACKEND;?>img/resumepg13.jpg">
            
        </div>      
        <div class="center" style="margin-top:30px; padding:30px;">
<form class="form-horizontal" method="post" novalidate enctype="multipart/form-data">
                          <input type="hidden" name="action" value="submit" />
                                     <div class="form-group">
                                         <div class="col-xs-12 controls pd-10 text-center">
                                             <input type="file" name="profile_resume">
                                             <?php if (get_input_value($data, 'user_resume', 'profile_resume') != '') : ?>
                                             <?php endif; ?>
                                         </div>
                                         <div class="col-xs-12 controls pd-10 text-center">
                                             <button type="submit" class="btn-lg vd_btn vd_bg-green  "><span class="menu-icon"><i class="fa fa-fw fa-upload"></i></span>  &nbsp; Upload &nbsp; </button>
                                         </div>
                                      <div class="col-xs-12 controls pd-10 text-center">   
                                          <h5><a target="_blank" href="<?php echo site_url('upload/member/resume/' . get_input_value($data, 'user_resume', 'profile_resume')); ?>" class="vd_black"><i class="fa fa-download"></i> View your resume</a></h5>
                                      </div>       
                                     </div>
                     </form>
        </div>
                                  
       <!-- <div class="center center-block">
            <a href="#demo1"  data-toggle="collapse">
            </a>
            <div id="demo1" name="demo1" class="collapse">   </div>
            <img src="/assets/backend/img/appleview.jpg" class="img-responsive center-block"> 
            <img src="/assets/backend/img/apple.jpg" class="img-responsive center-block" width="75">
                              
        </div>
                                
                                
               <div class="center center-block">
            <a href="#demo2"  data-toggle="collapse">
              </a>
             <div id="demo2" name="demo2" class="collapse"></div>
                                    <img src="/assets/backend/img/androidview.jpg" class="img-responsive center-block">
                                    <img src="/assets/backend/img/android.jpg" class="img-responsive center-block" width="75">
                                  
        </div>              
                                                        
                                
                       
                        <!-- Panel Widget -->
                 </div>    </div>

                </div>
                <!-- row -->

            </div>
            <!-- .vd_content-section -->

        
        <!-- .vd_content   -->
    