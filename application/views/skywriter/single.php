<div class="vd_content-section clearfix">
    <div class="">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="blog-item">

                <!-- Post Title -->
                <h1 class="font-alt"><?php echo $post["title"]; ?></h1>

                <!-- Author, Categories, Comments -->
                <div class="blog-item-data">
                    <i class="fa fa-user"></i>'
                    <a href="<?php echo site_url("pilot/".$post["user_id"]); ?>"><?php echo $post["user_name"]; ?></a>
                    <span class="separator">&nbsp;</span>
                    <a href="<?php echo site_url("skywriter/".$post["id"]); ?>"><i class="fa fa-clock-o"></i> <?php echo date("m/d/Y h:i",$post["created"]); ?></a>
                    <span class="separator">&nbsp;</span>'
                    <a href="<?php echo site_url("skywriter/".$post["id"]); ?>"><i class="fa fa-comments"></i> <?php echo count($post["comments"]); ?> Comments</a>
                </div>

                <!-- Text Intro -->
                <div class="blog-item-body">
                    <p>
                        <?php echo $post["content"]; ?>
                    </p>
                </div>

                <div class="clearfix pt-20">&nbsp;</div>
                <h2 class="font-alt">Post Comment</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="post-comment" />
                    <div class="form-group">
                        <textarea name="comment" style="height:150px;"></textarea>
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
