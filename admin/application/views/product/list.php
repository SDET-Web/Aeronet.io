		<article class="module width_full">
			<header><h3><?php echo get_pager(); ?><div style="float:right;"><?php echo strtoupper($controller); ?></div></h3></header>
				<div class="module_content">
					<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th colspan="2">Name</th> 
    				<th>Pirce</th> 
    				<th>Category</th>
    				<th>Action</th>
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr> 
					<td><img src="/skin/pic/product/<?php echo $record->prod_pic; ?>" height="50px" /></td> 
					<td><?php echo $record->prod_title; ?></td> 
    				<td>$<?php echo $record->prod_price; ?></td>
    				<td><?php echo $record->cate_name; ?></td> 
    				<td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->prod_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a class="delete" href="?delete=<?php echo $record->prod_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
				</tr> 
				<?php } ?>
				<?php }else{ ?>
				<tr>
					<td colspan="5"><?php echo RIZ_MSG; ?></td>
				</tr>
				<?php } ?>
			</tbody> 
			</table>
			
		</article>