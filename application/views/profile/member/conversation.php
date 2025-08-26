   <div class="row" >
        <div class="col-md-4 col-sm-4 col-xs-hidden">
            <div class="hidden-xs">
            <?php $this->load->view('profile/sidebar/pilot',array('data'=>$data)); ?>
        </div></div>
         <div class="col-md-8 col-sm-8 col-xs-12">
             
    	<div class="pd-20">
        	<h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-envelope mgr-10 profile-icon"></i> MESSAGES</h3>

     <div class="row">       
          <div class="panel widget light-widget">
                                                        <div class="panel-body">
                                                            <div class="row mgbt-xs-0">  
    <div class="col-md-12 col-xs-12">
                                            <div class="content-list content-image content-chat">
                                                <ul class="list-wrapper no-bd-btm pd-lr-10 conversation-list"  zeroMessage="You don't have any favorite articles." barShowFuntion="" isBlocked="false" page="0" sort=""  barTitle="Favorite Articles" countContainer="" searchTerm="" url="<?php echo site_url('conversations/'.$this->session->userdata('user_id')); ?>" ></ul>
                                            </div>

                                        </div> 
            
            </div> 
                            
            </div>
                          
                        </div>
        </div></div></div>
        </div>
        
                  
    


