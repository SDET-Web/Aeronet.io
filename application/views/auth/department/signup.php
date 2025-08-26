<section id="main-sliderBlack" style="height:auto;">
    <div class="container" style="padding:10px;">
<div class="center wow fadeInDown"><p class="pt-40"></p><h2>Flight Department Sign up  </h2>       
</div>

            <div class="row" style="margin-top:-40px;">
                
                    <div class="col-md-8 col-xs-12 col-md-offset-2">
                                     <form method="post" action="" id="registerDepartment">
                                    <input type="hidden" name="action" value="register_department_step_1_5" />
                                    <h5>Enter your email address and password to create account.</h5>
                                    
                                    <input type="hidden" name="json" value="" />
                                    <?php form_new_input_updated('','email',$this->input->post('email'),true,'text','','Your Email *','<span class="form-icon fa fa-user"></span>'); ?>
                                    <?php form_new_input_updated('','password',$this->input->post('password'),true,'password','','Your Password','<span class="form-icon fa fa-lock"></span>'); ?>
                                
                               
                                <p> <?php echo get_input_value($data,'bio','bio');?></p>
                                
                                
                                <button type="submit" class="button-main2"> &nbsp; Signup Now &nbsp;  </button>
                        <!-- <a class="button-main2" href="<?php //echo site_url('register/department/signup/'.$data['id']);?>">Signup</a> -->
                        <br/><br/> <a class="button-main3" href="<?php echo site_url('register/department/');?>"> Cancel </a>
                   </form></div>
                            </div>
                        </div>
                   
        </section>
<style>.alert{
    position:fixed; 
    top: 5px; 
    left: 25%; 
    width:72%;
    z-index:9999; }
</style>