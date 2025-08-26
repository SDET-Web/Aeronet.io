<section id="main-sliderHome" class="no-margin">
                <div class="container">
                    <div class="row"><div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-8">
                    <div class="header-content">
                    <h1 class="home animation animated-item-1">  Enter your first and last name to claim your profile. </h1>
                                  <p class="pt-40"></p>
                                    <form class="form" method="post" action="<?php echo site_url('register/pilot/confirm'); ?>">
                                           <input type="hidden" name="action" value="register_pilot_step_1" />
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-level2">
                                                        <input class="name" type="text" name="first_name" placeholder="First Name *" value="" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-level2">
                                                        <input class="name" type="text" name="last_name" placeholder="Last Name *" value="" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-level2">
                                                        <button class="button-home" type="submit">Find My Profile</button>
                                                        
                                                    </div></div>
                                                     </div>
                                    </form>         
                    </div>
                
                </div></div>
                </div><!--/.carousel-->

</section>



