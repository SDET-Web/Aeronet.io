	<h3>
		You are applying to <?php echo $job->job_model.'-'.$job->job_make; ?>. Be sure to include any additional information the aircraft owner has requested in Jobs Board Posting.  Clicking the "Submit" button will send your email along with your online resume.
	</h3>
	<div>
		<?php $this->Model_form->apply_job(); ?>
	</div>