<?php //$this->load->view('tabs',array('type'=>'skywriter')); ?>
<div style="background-color:#fff;padding:30px;position:absolute; z-index: 1000; width:100%;">
    
        <img class="center-block" src="<?php echo RIZ_ASSETS_BACKEND; ?>img/skywriter_logo.jpg" />
    <br/>
    
<div style="margin-top:30px;padding:30px; width:90%;">
       
        <a href="<?php echo site_url("skywriter/add"); ?>"  class="showPostArticle btn btn-sm vd_btn pull-right vd_green col-md-2 col-xs-12" style="font-size:1.5em;">Create Article</a>
        <div class="clearfix pt-20">&nbsp;</div>
        <div class="skywriter-list"  zeroMessage="No articles found in the feed." barShowFuntion="" isBlocked="false" page="0" sort=""  barTitle="SkyWriter Articles" countContainer="#count-favorite-article" searchTerm="" url="<?php echo site_url('skywriter/json'); ?>" ></div>
    </div>
    
    
</div>
 