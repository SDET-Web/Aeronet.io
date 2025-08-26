		<article class="module width_full">
			<header><h3><?php echo get_pager(); ?><div style="float:right;"><?php echo strtoupper($controller); ?></div></h3></header>
				<div class="module_content">
					<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Model</th> 
    				<th>Price</th> 
    				<th>Action</th>
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr> 
					<td><?php echo $record->model; ?></td> 
    				<td><?php echo $record->price; ?></td> 
    				<td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a href="?delete=<?php echo $record->id; ?>" class="delete"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
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