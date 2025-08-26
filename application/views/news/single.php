<?php //$this->load->view('tabs',array('type'=>'news')); ?>
<div class="vd_content-section clearfix">
    <div class="">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="blog-item">

                <!-- Post Title -->
                <h1 class="font-alt"><?php echo $post["title"]; ?></h1>
                <h3 style="color:#aeaeae"><?php echo $post["headline"]; ?></h3>

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
                        <?php echo $post["desc"]; ?>
                    </p>
                </div>

                <div class="clearfix pt-20">&nbsp;</div>
                <h2 class="font-alt">Post Comment</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="post-comment" />
                    <div class="form-group">
                        <textarea name="comment" style="height:150px;    width: 100%;"></textarea>
                        <div class="clearfix pt-10">&nbsp;</div>
                        <button type="submit" class="btn vd_btn vd_bg-green finish" style="display: inline-block;"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Post</button>
                    </div>
                </form>
                <div class="clearfix pt-20">&nbsp;</div>
                <h2 class="font-alt">Comments</h2>
                <div class="clearfix pt-20">&nbsp;</div>
                <?php if(count($post['comments']) > 0): ?>
                    <?php foreach($post['comments'] as $comment): ?>
                        <div class="content-list content-image">
                            <ul class="list-wrapper no-bd-btm">
                                <li>
                                    <div class="menu-icon"><img src="<?php echo get_user_pic_url($comment['photo']); ?>" alt="<?php echo $comment['name']; ?>"></div>
                                    <div class="menu-text"> <?php echo $comment['text']; ?>
                                    <div class="menu-info"> <span class="menu-date"><?php echo date("d F, Y",$comment['created']); ?></span> </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h4>No comments were posted</h4>
                <?php endif; ?>
            </div>
            <div class="clearfix pt-20">&nbsp;</div>
        </div>
    </div>
</div>
