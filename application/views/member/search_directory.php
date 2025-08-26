<div class="error_msg" style="display:none;">Please login to Search Resume</div>

<section id="main-slider" style="background-color:#0286A5;padding:10px;">

	<div class="container"><br/><br/>

			<div class="row">

			<?php //$this->Model_form->search_resume();?>

			<form name="form" method="post">
				<div class="col-md-4 col-xs-12 ">
					<input type="hidden" name="action" value="search" />
					<div class="form-level">
						<input name="keyword" value="<?php echo $this->input->post('keyword'); ?>" placeholder="Name or Flight Department"  type="text" />
					</div>
				</div>
				<div class="col-md-4 col-xs-7 ">
					<div class="form-level"><!--/.media -->
						<input name="location" value="<?php echo $this->input->post('location'); ?>" placeholder="City, State or Zip Code"  type="text" />
					</div>
				</div>
				<div class="col-md-4 col-xs-5 ">
					
					<div class="form-level" style="margin-left:-25px;">
					<button type="submit" class="button-main" style="padding:13px 40px">Search </button>
					</div>
				</div>



			</form>

                        </div><div class="row">
                            <div class="col-md-12 col-xs-12" style="margin-top:15px;">
                             <div class="gmap-area">
		
			<!--Show different icon colors on map for pilots, non safety pilots and flight departments. -->
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="gmap">
						<?php echo $map['html']; ?>
					</div>
				</div>


			</div>
		
	</div>   
                            </div>   
                        </div>

	</div>

	<!--/.container-->
</section><!--/#feature-->
