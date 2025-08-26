		<form method="post">
		<article class="module width_full">
			<header><h3><div style="float:right;"><?php echo strtoupper($controller); ?></div></h3></header>
				<div class="module_content" style="padding:1%;">
					<div class="width_full">
						<h4>Title</h4>
						<input type="text" class="width_full" name="page_title" id="page_title" value="<?php echo $records->page_title; ?>" />
					</div>
					<div class="width_full">
						<h4>Content</h4>
						<div><input type="file" name="page_editor" id="page_editor" /></div>
						<textarea name="page_content" id="page_content"><?php echo $records->page_content; ?></textarea>
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