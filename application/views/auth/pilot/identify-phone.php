<section id="main-sliderBlack" style="height:180px;">
<div class="center wow fadeInDown"><p class="pt-40"></p><h2>Verify Your Profile</h2> </div>      
</section>
<style>.alert{
    position:fixed; 
    top: 5px; 
    left: 25%; 
    width:72%;
    z-index:9999; }
</style>
    <?php if($msg != ''): ?>
<div class="alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong>Error!</strong><p><?php echo $msg; ?></p></div>
<?php endif; ?>
<section id="feature" >
    <div class="container" style="padding:10px; ">         
                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="single-profile-bottom wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms" >
                            <div class="media">

                                <div class="media-body">
                                    <form method="post" id="registerPilot">
                <input type="hidden" name="type" value="<?php
                if($pilot['user_type'] == 'P'){
                    echo 'P';
                } else {
                    echo $pilot['certificates'][0]['type'];
                }?>" />            
                
                                    <h4><?php echo $pilot['first_name']."&nbsp". $pilot['last_name'];?></h4>
                                    <h5><?php echo $pilot['street1']."&nbsp". $pilot['street2'].", &nbsp".$pilot['state'];?></h5>
                                    <ul class="tag clearfix">
                                        <?php $count = 1; ?>
                                        <?php
                                        $uniqueArray = array_unique($pilot['certificates'], SORT_REGULAR);
                                        $pilot['certificates'] = $uniqueArray;
                                        foreach($pilot['certificates'] as $certificate): ?>
                                            <?php if(non_pilot_types($certificate['type'])!=""): ?>
                                            <li ><h5> <?php echo non_pilot_types($certificate['type']); ?> </h5></li>
                                            <?php endif; ?>
                                            <?php foreach(explode(',',$certificate['rating']) as $key=>$rating): ?>
                                                <?php if($rating!="0" && $rating!=""): ?>
                                                    <li class="btn"><a><?php echo "Rating ".$count.($rating!="0" && $rating!=""?" : ".$rating:'');?> </a></li>
                                                <?php endif; ?><?php $count = $count + 1; ?>
                                            <?php endforeach; ?>
                                            <?php foreach(explode(',',$certificate['type_rating']) as $key=>$rating): ?>
                                                <?php if($rating!="0" && $rating!=""): ?>
                                                    <li class="btn"><a><?php echo "Type Rating ".$count.($rating!="0" && $rating!=""?" : ".$rating:'');?> </a></li>
                                                <?php endif; ?>
                                                <?php $count = $count + 1; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                    <input type="hidden" name="signup_try" value="<?php echo $signup_try; ?>" />
                                    <input type="hidden" name="action" value="register_pilot_step_phone" />
                                    <!--
                                    <?php //form_new_input_updated('','email',$this->input->post('email'),true,'text','','Your Email *','<span class="form-icon fa fa-user"></span>'); ?>
                                    <?php //form_new_input_updated('','password',$this->input->post('password'),true,'password','','Your Password','<span class="form-icon fa fa-lock"></span>'); ?>
                                    -->
                                    
                                    <input type="hidden" id="unique_id" name="unique_id" value="<?=$pilot['unique_id']?>">
                                    <!--input type="submit" value="submit"-->
                        
                        <p class="pt-30 center-block">          
                       <button id="btn" class="button-round" type="button">Yes, this is me</button>&nbsp;
                       <button id="btn" class="button-round" type="button" onclick="window.location.href('<?php echo site_url('register/pilot'); ?>');">No, this isn't me</button>
                        </p> <p class="pt-30"></p>  
                                </div>
                            </div><!--/.media -->
                        
                    </div>
                    <!--  <div class="col-md-5 col-sm-6 col-xs-12">
                          <h3>Confirm your identity</h3>
                            <p>Before you can view and edit your info, let's verify your identity.</p>
                       
                    </div>-->
                </div>
            </form>
        </div></div>
</section>
<script type="text/javascript">
    
    $('#btn').on('click', function()
    {
        window.location = $baseURL + 'register/pilot/signup/' + $('#unique_id').val() + '/';
    });
</script>
