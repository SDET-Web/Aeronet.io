<section id="page" class="container text-center">

<?php
    if($data['content'] == ''){ ?>
        <h1>Underconstruction</h1>
    <p>The Page you are looking for doesn't exist right now but we will be back soon.</p>
    <a class="btn btn-primary" href="<?php echo site_url('/'); ?>">GO BACK TO THE HOMEPAGE</a>

<?php
    }else{
        echo str_replace('src="/assets','src="'.RIZ_BASE_URL_NO_END.'/assets',$data['content']);
    }

?>
</section>
