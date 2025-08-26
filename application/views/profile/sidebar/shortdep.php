<div class="row">
  <div class="col-md-12 col-xs-12">
  <img alt="profile" class="img-responsive" src="<?php echo get_user_pic_url(get_data_value($data,'user_image'),get_data_value($data,'user_type')); ?>">
 <?php if($data['user_id'] != $this->session->userdata('user_id')): ?>
    <div class="row">
            <?php if($data['is_connected'] == null): ?>
                <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-xs btn-block no-br follow_big" object-id="<?php echo $data['user_id']; ?>"><br><h4><i class="fa fa-check-circle append-icon"></i>Follow</h4></a> </div>
            <?php else: ?>
                <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-xs btn-block no-br" style="background-color:#1b9859!important"><br><h4><i class="fa fa-check-circle append-icon"></i>Following</h4></a> </div>
            <?php endif; ?>
      </div>  <?php endif; ?>
  <h3 class="font-bold mgbt-xs-5" style="color:#1f83ae;"><?php echo get_data_value($data,'user_company'); ?></h3>
            <?php echo get_data_value($data,'user_bio'); ?>
         
 </div>
</div>
   
