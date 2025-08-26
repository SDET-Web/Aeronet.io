		<article class="module width_full">
			<header><h3><?php echo get_pager(); ?><div style="float:right;"><?php echo $controller; ?></div></h3></header>
				<div class="module_content">
					<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Subject</th> 
    				<th>Action</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr> 
    				<td><?php echo $record->email_subject; ?></td> 
    				<td><a class="edit" href="<?php echo site_url('cms/edit/email/'.$record->email_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a></td> 
				</tr> 
				<?php } ?>
				<?php }else{ ?>
				<tr>
					<td colspan="2"><?php echo RIZ_MSG; ?></td>
				</tr>
				<?php } ?>
			</tbody> 
			</table>
			
		</article>