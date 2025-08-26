<?php //$this->load->view('tabs',array('type'=>'news')); ?>
<div class="vd_content-section clearfix">
    <div class="">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
            <h1>NEWS <a href="#" style="color:#F0F0F0;"> &nbsp; BLOGS</a> <a href="#" style="color:#F0F0F0;"> &nbsp; FORUMS </a></h1> 
            <div class="clearfix pt-20">&nbsp;</div>
            <div class="row">

                <div class="col-sm-12">

                    <?php foreach($data["data"] as $key => $post): ?>

                    <?php if($key == 0): ?>
                    <!-- Post Slider -->
                    <div class="blog-item">

                        <!-- Post Title -->
                        <h2 class="blog-item-title font-alt"><a href="<?php echo site_url("news/".$post["id"]); ?>"><?php echo $post["title"]; ?></a></h2>

                        <!-- Author, Categories, Comments -->
                        <div class="blog-item-data">
                            <a href="<?php echo site_url("news/".$post["id"]); ?>"><i class="fa fa-clock-o"></i> <?php echo date("d F",$post["date"]); ?></a>
                            <span class="separator">&nbsp;</span>
                            <i class="fa fa-folder-open"></i>
                            <a href="<?php echo site_url("news/category/".$post["category"]); ?>"><?php echo $post["category"]; ?></a>
                            <span class="separator">&nbsp;</span>
                            <a href="<?php echo site_url("news/".$post["id"]); ?>"><i class="fa fa-comments"></i> <?php echo $post["count"]; ?> Comments</a>
                        </div>

                        <?php if($post["image"] != ""): ?>
                            <!-- Media Gallery -->
                            <div class="blog-media">
                                <img src="<?php echo get_news_photo_url($post["image"]); ?>" alt="">
                            </div>
                        <?php endif; ?>
                        <!-- Text Intro -->
                        <div class="blog-item-body">
                            <p>
                                <?php echo substr(strip_tags($post["desc"]),0,250); ?>...
                            </p>
                        </div>

                        <!-- Read More Link -->
                        <div class="blog-item-foot">
                            <a href="<?php echo site_url("news/".$post["id"]); ?>">Read More</a>
                        </div>

                    </div>
                    <!-- End Post Slider -->
                    <!-- Blog Posts -->
                    <div class="row multi-columns-row">
                        <?php else: ?>

                            <?php if($key%2!=0): ?>
                                <div class="clearfix"></div>
                            <?php endif; ?>

                            <!-- Post Item -->
                            <div class="col-md-6 col-lg-6 mb-30">

                                <?php if($post["image"] != ""): ?>
                                    <div class="post-prev-img">
                                        <a href="<?php echo site_url("news/".$post["id"]); ?>"><img src="<?php echo get_news_photo_url($post["image"]); ?>" alt=""></a>
                                    </div>
                                <?php endif; ?>

                                <div class="post-prev-title font-alt">
                                    <a href="<?php echo site_url("news/".$post["id"]); ?>"><?php echo $post["title"]; ?></a>
                                </div>

                                <div class="post-prev-info font-alt">
                                    <a href="<?php echo site_url("news/category/".$post["category"]); ?>"><?php echo $post["category"]; ?></a> | <?php echo date("d F",$post["date"]); ?>
                                </div>

                                <div class="post-prev-text">
                                    <?php echo substr(strip_tags($post["desc"]),0,150); ?>...
                                </div>

                                <div class="post-prev-more">
                                    <a href="<?php echo site_url("news/".$post["id"]); ?>">Read More</a>
                                </div>

                            </div>
                            <!-- End Post Item -->


                        <?php endif; ?>


                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
