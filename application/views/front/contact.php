<section id="main-slider">  
<div class="segment"><p class="pt-40"></p><h2>Contact us</h2></div>
<div class="down-arrow">
<div class="down-arrow-pad"></div>
<div class="down-arrow-indent"></div>
<div class="down-arrow-pad"></div>
</div>
<div style="width:100%;height:auto;background-color:#fff;padding-top:40px;padding-bottom:25px;">
</div>
 <p class="pt-20"></p> 
</section>
<section id="contact-page" style="background: #fff">
	
	<div class="container" style="margin-top:30px;">
		<div class="center">
			<h2>Drop Your Message</h2>
			<p class="lead">We're happy to answer any questions you have just send us a message in the form below.</p>
		</div>
		<div class="row">
			<div class="status alert alert-success" style="display: none"></div>
			<form method="post">
				<input type="hidden" name="action" value="contact" />
				<div class="col-sm-5 col-sm-offset-1">
					<?php form_new_input('Name','contactName',$this->input->post('contactName'),true); ?>
					<?php form_new_input('Email','contactEmail',$this->input->post('contactEmail'),true); ?>
					<?php form_new_input('Phone','contactPhone',$this->input->post('contactPhone'),true); ?>
				</div>
				<div class="col-sm-5">
					<?php form_new_textarea('Message','contactMessage',$this->input->post('contactMessage'),true); ?>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-lg">Submit Message</button>
					</div>
				</div>
			</form>
		</div><!--/.row-->
	</div><!--/.container-->
</section><!--/#contact-page-->