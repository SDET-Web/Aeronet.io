<section id="main-slider">  
<div class="segment"><p class="pt-50"></p><h2>Site Map</h2></div>
<div class="down-arrow">
<div class="down-arrow-pad"></div>
<div class="down-arrow-indent"></div>
<div class="down-arrow-pad"></div>
</div>
</section>

<style>
	.sitemaplist li{
		width: 32%;
		float: left;
		list-style-type: none;
		padding: 0.6em;
	}
</style>
<section id="featureW">
    <div class="container">
        <div class="center wow fadeInDown">
            
         <ul class="sitemaplist">
		<li>
			<a href="<?php echo RIZ_FULL_URL;?>">Home</a>
		</li>
		<?php foreach($data as $key=>$url) { ?>
			<li>
				<a href="<?php echo $url; ?>"><?php echo $key ?></a>
			</li>
		<?php } ?>
	</ul>   
            
 </div></div><!--/.container-->

</section>