<section id="main-sliderBlack" style="height:auto;padding:10px;">
<div class="center wow fadeInDown"><p class="pt-20"></p> </div>      
</section>
<?php if($data){ ?>
<section id="error" class="container text-center">
    <h1>Success</h1>
    <p>You have successfully completed the Registration process now you are confirmed member of AeroNet.io</p>
    <a class="btn btn-primary" href="<?php echo site_url('login'); ?>">GO TO LOGIN</a>
</section><!--/#error-->
<?php }else{ ?>
    <section id="error" class="container text-center">
        <h1>Error</h1>
        <p>Link has been expired or not valid please Contact Admin</p>
        <a class="btn btn-primary" href="<?php echo site_url('contact'); ?>">GO TO CONTACT</a>
    </section><!--/#error-->
<?php } ?>
