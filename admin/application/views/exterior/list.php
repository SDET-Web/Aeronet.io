		<script>
			$(document).ready(function(){
				$("#model").change(function(){
					window.location = '?<?php //echo ($this->input->get('page')!=''?'page='.$this->input->get('page').'&':''); ?>model=' + $(this).val();
				});
			});
		</script>
		<article class="module width_full">
			<header><h3><?php echo get_pager(); ?>	<div style="float:right;"><?php echo '<select id="model" name="model" style="margin-top:-3px;margin-right:10px">'.get_select_model('',$this->input->get('model')).'</select>'; ?><?php echo strtoupper($controller); ?></div></h3></header>
				<div class="module_content">
		<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Title</th> 
    				<th>Model</th> 
    				<th>Price</th> 
    				<th>Rejuvination Price</th>
    				<th>Upkeep Price</th>
    				<th>Action</th>
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr> 
					<td><?php echo $record->title; ?></td>
    				<td><?php echo $record->model; ?></td> 
    				<td><?php echo $record->other_price; ?></td> 
    				<td><?php echo $record->rejuvination_price; ?></td> 
    				<td><?php echo $record->upkeep_price; ?></td> 
    				<td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a class="delete" href="?delete=<?php echo $record->id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
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