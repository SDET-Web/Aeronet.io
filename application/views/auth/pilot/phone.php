<section id="main-sliderBlack" style="height:165px;">
<div class="center wow fadeInDown"><p class="pt-30"></p><h2>Verify Your Phone</h2><br/> </div>      
</section>
<style>
    .alert{
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
                                                <li class="btn"><a> <?php echo non_pilot_types($certificate['type']); ?> </a></li>
                                            <?php endif; ?>
                                            <?php foreach(explode(',',$certificate['rating']) as $key=>$rating): ?>
                                                <?php if($rating!="0" && $rating!=""): ?>
                                                    <li class="btn"><a><?php echo "Rating ".$count.($rating!="0" && $rating!=""?" : ".$rating:'');?> </a></li>
                                                <?php endif; ?>
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
                                    <label><img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/fusa.png"></label><label> &nbsp; +1 </label>
                                    <?php form_new_input_updated('','phone',$this->input->post('phone'),false,'text','','Enter your Phone','<span class="form-icon fa fa-phone"></span>'); ?>
                                    <label style="font-size:12px">Example (10 digits): xxxxxxxxxx</label>                    
                                    <!--
                                    <?php //form_new_input_updated('','email',$this->input->post('email'),true,'text','','Your Email *','<span class="form-icon fa fa-user"></span>'); ?>
                                    <?php //form_new_input_updated('','password',$this->input->post('password'),true,'password','','Your Password','<span class="form-icon fa fa-lock"></span>'); ?>
                                    
                                    <input type="hidden" id="mdat" name="mexdate" value="">
                                    <!--input type="submit" value="submit"-->
                    
                     <p class="pt-30 center-block">          
                      <button id="btn" class="button-round" type="submit">Send Verification Code</button> 
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
    $("#mdate").focusout(function()
    {
        var str=$("#mdate").val();
        var res=str.split('/')[0];
        var afterComma = str.substr(str.indexOf("/") + 1);
        var ress=res.concat(afterComma);
        $("#mdat").val(ress);
    });
    $('#myForm input').on('change', function()
    {
        $("#selectedid").val($('input[name=radioName]:checked', '#myForm').val());
    });
    $('#btn').on('click', function()
    {
        var str=$("#mdate").val();
        var res=str.split('/')[0];
        var afterComma = str.substr(str.indexOf("/") + 1);
        var ress=res.concat(afterComma);
        $("#mdat").val(ress);
        document.getElementById('registerPilot').submit();
    });
</script>
