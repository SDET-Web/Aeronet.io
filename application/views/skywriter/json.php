<!-- Post Item -->
<div class="col-sm-12 mb-30">

    <div class="col-sm-2 col-sm-12">
        <?php if($post["image"] != ""): ?>
            <div class="post-prev-img">
                <a href="<?php echo site_url("news/".$post["id"]); ?>"><img src="<?php echo get_news_photo_url($post["image"]); ?>" alt=""></a>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-sm-10 col-xs-12">

        <div class="post-prev-title font-alt">
            <a style="font-size:1.3em" href="<?php echo site_url("news/".$post["id"]); ?>"><?php echo $post["title"]; ?></a>
        </div>

        <div class="post-prev-info font-alt">
            <a href="<?php echo site_url("news/category/".$post["category"]); ?>"><?php echo $post["category"]; ?></a> | <?php echo date("d F",$post["date"]); ?>
        </div>
        <div class="blog-item-body">
            <p>
                <?php echo substr(strip_tags($post["desc"]),0,200); ?>...
            </p>
        </div>

    </div>

</div>
<!-- End Post Item -->
