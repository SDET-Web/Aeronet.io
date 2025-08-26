		<article class="module width_full">
			<header><h3><?php echo get_pager(); ?><div style="float:right;"><?php echo strtoupper($controller); ?></div></h3></header>
				<div class="module_content">
					<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Name</th> 
    				<th>Pirce</th> 
    				<th>Credits</th>
    				<th>Action</th>
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr> 
					<td><?php echo $record->pack_name; ?></td> 
    				<td>$<?php echo $record->pack_price; ?></td>
    				<td><?php echo $record->pack_credit; ?> Cards</td> 
    				<td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->pack_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a class="delete" href="?delete=<?php echo $record->pack_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
				</tr> 
				<?php } ?>
				<?php }else{ ?>
				<tr>
					<td colspan="8"><?php echo RIZ_MSG; ?></td>
				</tr>
				<?php } ?>
			</tbody> 
			</table>
			
		</article>