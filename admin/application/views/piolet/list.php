		<article class="module width_full">
			<header><h3><?php echo get_pager(); ?><div style="float:right;"><?php echo strtoupper($controller); ?></div></h3></header>
				<div class="module_content">
					<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Email</th> 
    				<th>Joined</th> 
    				<th>Applications</th>
					<th>Type</th>
    				<th>Action</th>
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr> 
					<td><?php echo $record->user_email; ?></td> 
    				<td><?php echo date('Y-m-d',$record->user_created); ?></td>
    				<td><?php echo $record->jobs; ?></td> 
					<td><?php //echo $record->user_status; 
					if($record->user_status == 'p')echo "Paid"; else  if($record->user_status == 'a') echo "Active/Non-Paid"; else  if($record->user_status == 'n') echo "Not Verified"; ?></td> 
					
    				<td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->user_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a href="?delete=<?php echo $record->user_id; ?>" class="delete"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
				</tr> 
				<?php } ?>
				<?php }else{ ?>
				<tr>XC
					<td colspan="8"><?php echo RIZ_MSG; ?></td>
				</tr>
				<?php } ?>
			</tbody> 
			</table>
			
		</article>