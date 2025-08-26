		<?php $section = array('a'=>'Insurance',
		//'b'=>'FAR 61.113 (c) Shared Flights',
		'c'=>'Logging Pilot in Command Time','d'=>'New Airline Pilot Requirements','e'=>'Flight Maneuvers','g'=>'Aircraft Owners and Time Building Pilots'); ?>
		<article class="module width_full">
			<header><h3><?php echo get_pager(); ?><div style="float:right;"><?php echo $controller; ?></div></h3></header>
				<div class="module_content">
					<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Question</th> 
    				<th>Section</th> 
    				<th>Action</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr> 
    				<td><?php echo $record->faq_question; ?></td> 
    				<td><?php echo $section[$record->faq_section]; ?></td> 
    				<td><a class="edit" href="<?php echo site_url('cms/edit/faq/'.$record->faq_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a href="?delete=<?php echo $record->faq_id; ?>" class="delete"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
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