		<?php $section = array('a'=>'Insurance',
		//'b'=>'FAR 61.113 (c) Shared Flights',
		'c'=>'Logging Pilot in Command Time','d'=>'New Airline Pilot Requirements','e'=>'Flight Maneuvers','g'=>'Aircraft Owners and Time Building Pilots'); ?>
		<form method="post">
		<article class="module width_full">
			<header><h3><div style="float:right;"><?php echo strtoupper($controller); ?></div></h3></header>
				<div class="module_content" style="padding:1%;">
					<div class="width_full">
						<h4>Question</h4>
						<input type="text" class="width_full" name="faq_question" id="faq_question" value="<?php echo ($records!=null?$records->faq_question:''); ?>" />
					</div>
					<div class="width_full">
						<h4>Section</h4>
						<select name="faq_section">
						<?php foreach($section as $key=>$val){ ?>
							<option value="<?php echo $key; ?>" <?php echo ($records!=null?($key == $records->faq_section?'selected="selected"':''):''); ?>><?php echo $val; ?></option>
						<?php }?>
						</select>
					</div>
					<div class="width_full">
						<h4>Answer</h4>
						<textarea name="faq_answer" id="faq_answer"><?php echo ($records!=null?$records->faq_answer:''); ?></textarea>
					</div>
					<div class="clear"></div>
				</div>
				<footer>
				<div class="submit_link">
					<input type="submit" value="Update" class="alt_btn">
					<input type="submit" value="Reset">
				</div>
			</footer>
		</article>
		</form>