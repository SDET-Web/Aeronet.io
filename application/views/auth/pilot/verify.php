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
                                    <input type="hidden" name="action" value="register_pilot_step_2" />

                                    <?php form_new_input_updated('','mdate',$this->input->post('mdate'),false,'text','','Enter your Medical Date MM/YYYY','<span class="form-icon fa fa-medkit"></span>'); ?>
                                    <?php

                                    $date_is_expired_radio_button = "<div class=\"form-group\">
                                                <label>
                                                    <input type=\"radio\"
                                                           id=\"expired\"";
                                    ?>
                                    <?php $date_is_expired_radio_button .= $this->input->post('expired') == 'y' ? 'checked=\"checked\"' : ''; ?>
                                    <?php
                                    $date_is_expired_radio_button .= "name=\"expired\" value=\"y\"/>&nbsp;&nbsp;&nbsp;&nbsp;My medical
                                                    is expired
                                                </label>
                                            </div>";

                                    $date_not_required_radio_button = "<div class=\"form-group\">
                                                <label>
                                                    <input type=\"radio\"
                                                           id=\"norequire\"";
                                    ?>
                                    <?php $date_not_required_radio_button .= $this->input->post('expired') == 'n' ? 'checked=\"checked\"' : ''; ?>
                                    <?php
                                    $date_not_required_radio_button .= "name=\"norequire\" value=\"n\"/>&nbsp;&nbsp;&nbsp;&nbsp;I do not
                                                    require a medical
                                                </label>
                                            </div>";

                                    if($pilot['med_date'] == "" || $pilot['med_date'] == '/'){
                                        if($pilot['user_type'] == 'P'){
                                            // redirect to  contact admin
                                            // this check is already done in controller, it has to be redirect to contact page.
                                            // so done it directly from
                                        } else {
                                            // show them I donot require medical check box
                                            echo $date_not_required_radio_button;
                                        }
                                    } else {
                                        $arr = explode('/',$pilot['med_exp_date']);
                                        $exp_date = $arr[1]."-".$arr[0]."-01";
                                        if(strtotime($exp_date) < time() && $pilot['user_type'] == 'P'){
                                            echo $date_is_expired_radio_button;
                                        } elseif($pilot['user_type'] != 'P') {
                                            echo $date_not_required_radio_button;
                                        }
                                    }

                                    ?>
                                    <!--
                                    <?php form_new_input_updated('','email',$this->input->post('email'),true,'text','','Your Email *','<span class="form-icon fa fa-user"></span>'); ?>
                                    <?php form_new_input_updated('','password',$this->input->post('password'),true,'password','','Your Password','<span class="form-icon fa fa-lock"></span>'); ?>
                                    -->
                                    <input type="hidden" id="mdat" name="mexdate" value="">
                                    <!--input type="submit" value="submit"-->
                        
                        <p class="pt-30"></p>           
                        <button id="btn"class="button-main2" type="submit">Yes, this is me</button><br /><br />
                        <a class="button-main3" href="<?php echo site_url('register/pilot'); ?>">No, this isn't me</a>
                        <p class="pt-30"></p>  
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
