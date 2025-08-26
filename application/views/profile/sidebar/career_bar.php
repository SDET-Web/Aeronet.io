<div class="row">
  <div class="col-sm-3 col-xs-12">
  <div class="thumb">
  <img alt="profile" class="img-responsive" src="<?php echo get_user_pic_url(get_data_value($data,'user_image'),get_data_value($data,'user_type')); ?>">
  </div></div>
       <div class="col-sm-8 col-xs-12">
           <h2><?php echo get_data_value($data,'user_company'); ?></h2>
           <h4><?php echo get_data_value($data,'user_bio'); ?></h4>
            <?php if($data['user_id'] != $this->session->userdata('user_id')): ?>
             <div class="row">
            <?php if($data['is_connected'] == null): ?>
                <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-md btn-block follow_big" object-id="<?php echo $data['user_id']; ?>">
                <i class="fa fa-check-circle append-icon"></i>Follow</a> </div>
            <?php else: ?>
                <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-md btn-block no-br" style="background-color:#1b9859!important">
                <i class="fa fa-check-circle append-icon"></i>Following</a> </div>
            <?php endif; ?>
            </div>
        <?php endif; ?>       
 </div>
</div>
   
