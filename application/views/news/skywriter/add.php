<?php //$this->load->view('tabs',array('type'=>'skywriter')); ?>
<div class="vd_content-section clearfix">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
            <h1>
                SKYWriter
                <a href="<?php echo site_url("skywriter"); ?>" class="showPostArticle btn btn-sm vd_btn pull-right vd_green">List Article</a>
            </h1>
            <div class="article-write" style="position:relative;">
                <form method="post">
                    <input type="hidden" name="action" value="post-article" />
                    <button class="btn-close hidePostArticle hidden" type="button"><i class="fa fa-times"></i></button>
                    <input type="text" class="title" name="title" id="title" placeholder="Heading" />
                    <div class="photosUpload dropzone font-alt"></div>
                    <textarea class="wyswyg" name="content" id="content"></textarea>
                    <div class="col-sm-12">
                        <button class="btn btn-lg vd_btn pull-right hidePostArticle" type="button">Cancel</button><button class="btn btn-lg vd_blue vd_btn pull-right" style="margin-right:10px;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>