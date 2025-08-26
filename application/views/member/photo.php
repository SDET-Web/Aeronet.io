<div class="vd_content-section clearfix">
    <div class="row">
        <div class="col-sm-3">
            <?php $this->load->view('profile/sidebar/pilot',array('data'=>$data)); ?>
        </div>
        <div class="col-sm-9">
            <h1>My Photos</h1>
            <div id="dropzone">
                <div id="uploadPhotos" class="dropzone"></div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-9">
                    <div class="pd-20">
                        <h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-picture-o mgr-10 profile-icon"></i> PHOTOS</h3>
                        <br/>
                        <div class="isotope js-isotope vd_gallery">
                            <?php
                            if(count($data['photos']) > 0):
                                foreach($data['photos'] as $item): $item = (array)$item; ?>
                                    <div class="gallery-item  filter-1">
                                        <a href="<?php echo get_photo_url($item['photo_path']); ?>" data-rel="<?php echo $item['photo_title']; ?>" style="background-image: url('<?php echo get_photo_url($item['photo_path']); ?>');background-position: center;">
                                            <div class="bg-cover"></div>
                                        </a>
                                        <div class="vd_info">
                                            <h3 class="mgbt-xs-15"><?php echo $item['photo_title']; ?></h3>
                                        </div>

                                    </div>
                                <?php endforeach;
                            else:?>
                                <div class="alert info">No photos uploaded</div>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3">
                    <div class="panel widget light-widget">
                        <?php $this->load->view('people_panel'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
