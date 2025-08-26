<section id="main-sliderBlack" style="height:180px;">
<div class="center wow fadeInDown"><p class="pt-40"></p><h2>Select your profile</h2> </div>      
</section>
<section id="feature">
	<div class="container" style="padding:10px; ">
			<div class="row">
				<div class="col-md-12 col-xs-12" >
					
					<h5>Select your First name and Last name to continue. Old address? 
                                            Don't worry, you can update this later.</h5>
					<form id="myForm"  action="register" method="post">
						<div class="form-level">
							<div class="form-level" id="lab">
							<?php echo form_dropdown('states',select_state_id('','Narrow by State'),'',' id="profile-states" class="select-field"'); ?>
							</div>
						</div>
						<?php foreach($pilots as $item){
                                                 if ($item['state']<>''){   ?>
						<h6 style="margin-left:0px;text-align:left;" class="profile-row" id="profile-<?php echo $item['state'];?>">
							<input type="radio" name="radioName" class="profile-select" id="<?php echo $item['unique_id'];?>" value="<?php echo $item['unique_id'];?>" style="width:18px;height:18px;float:left;"/>
							<label style="margin-left:5px;" for="<?php echo $item['unique_id'];?>"><?php  echo strtoupper($item['first_name']." ".$item['last_name']);?></label>
							<label style="margin-left:5px;color:#9ea7af;" for="<?php echo $item['unique_id'];?>"><?php  echo strtoupper($item['street1'].", ".$item['street2']." ".$item['city'].", ".$item['state']);?></label>
							<hr>
						</h6>
                                                 <?php  } }?>
					</form>
				</div>
			
		</div>
            
            
            <p class="pt-40"></p>
                                <div class="form-level2">
                        <a href="<?php echo site_url('register/pilot/phone_check'); ?>" class="button-main2">My Name Not Found</a>
                    </div>
            <p class="pt-40"></p>
	</div>
</section>
