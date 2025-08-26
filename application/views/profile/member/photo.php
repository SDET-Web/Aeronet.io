<div class="row">
         <div class="col-md-4 col-sm-4 col-xs-hidden">
            <div class="hidden-xs">
           <?php $this->load->view('profile/sidebar/pilot',array('data'=>$data)); ?>
            </div></div>
         <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    
      <div class="pd-20">
         
          <h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-camera-retro profile-icon"></i> PHOTOS</h3>
<br/>

<!-- <div class="row"><div class="col-md-12  col-sm-6 col-xs-12 ">
            <div class="vd_info tr"> <a class="btn vd_btn btn-xs vd_bg-yellow"> <i class="fa fa-plus append-icon"></i> Add Photo </a>
          </div><br/>
          <?php /*if($data['user_id'] == $this->session->userdata('user_id')): ?>
                    <div id="dropzone">
                        <div id="uploadPhotos" class="dropzone"></div>
                    </div>
          <?php endif; */?><br/></div></div>-->

<?php
                    if(count($data['photos']) > 0): ?>
                <div class="isotope js-isotope vd_gallery">
                    <?php
                            foreach($data['photos'] as $item): $item = (array)$item; ?>
                  <div class="gallery-item  filter-1"> 
                        
                         <?php if($item['photo_title'] == 'Profile Photo'): ?>
                          <a href="<?php echo get_user_pic_url($item['photo_path']); ?>" data-rel="prettyPhoto[2]">
                              <img alt="photo" src="<?php echo get_user_pic_url($item['photo_path']); ?>">
                          <div class="bg-cover"></div> </a>
                        <?php else: ?>
                          <a href="<?php echo get_photo_url($item['photo_path']); ?>" data-rel="prettyPhoto[2]">
                              <img alt="photo" src="<?php echo get_photo_url($item['photo_path']); ?>">
                          <div class="bg-cover"></div> </a>
                        <?php endif; ?>
                      
                  	
                         <div class="vd_info">
                              <h3 class="mgbt-xs-15"><span class="font-semibold"><?php echo $item['photo_title']; ?></h3>
                              
                          <?php if($item['photo_title'] == 'Profile Photo'): ?>
                          
                          <a class="vd_bg-green vd_white mgr-10 btn vd_round-btn btn-xs" role="button" href="<?php echo get_user_pic_url($item['photo_path']); ?>"  data-rel="prettyPhoto[2]"><i class="fa fa-search"></i></a>
                        <?php else: ?>
                          <a class="vd_bg-green vd_white mgr-10 btn vd_round-btn btn-xs" role="button" href="<?php echo get_photo_url($item['photo_path']); ?>"  data-rel="prettyPhoto[2]"><i class="fa fa-search"></i></a>
                        <?php endif; ?>
                                
                              <button class="vd_bg-green vd_white mgr-10 btn vd_round-btn btn-xs deletePhoto" role="button" photoId="<?php echo $item['photo_id']; ?>" href=""><i class="fa fa-times"></i></button>
                         </div>
                      
                  </div> <?php endforeach; ?>
</div>                    
        <?php else:?>
                        <div class="nothing-found">No Photos Uploaded</div>
                    <?php endif; ?>           
                             
                   
                   </div>
     <!-- pd-20 -->       
    

                </div>
                
            </div>
            
        </div>
    </div>


