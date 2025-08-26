		<form method="post">
		<article class="module width_full">
			<header><h3><div style="float:right;"><?php echo strtoupper($controller); ?></div></h3></header>
				<div class="module_content" style="padding:1%;">
					<div class="width_full">
						<h4>Subject</h4>
						<input type="text" class="width_full" name="email_subject" id="email_subject" value="<?php echo $records->email_subject; ?>" />
					</div>
					<div class="width_full">
						<h4>Email</h4>
						<textarea name="email_message" id="email_message"><?php echo $records->email_message; ?></textarea>
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