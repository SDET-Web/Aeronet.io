			<thead>
				<tr> 
    				<th>Name</th> 
    				<th>Email</th> 
    				<th>Subject</th> 
    				<th>Message</th>
    				<th>Status</th>
    				<th>Action</th>
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr> 
					<td><?php echo $record->app_name; ?></td>
    				<td><?php echo $record->app_email; ?></td> 
    				<td><?php echo $record->app_subject; ?></td> 
    				<td><?php echo $record->app_message; ?></td> 
    				<td><?php echo ($record->app_status == 'a'?'Accepted':($record->app_status == 'd'?'Declined':'Pending')); ?></td> 
    				<td><?php /*<a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->app_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a>*/ ?><a class="delete" href="?delete=<?php echo $record->app_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
				</tr> 
				<?php } ?>
				<?php }else{ ?>
				<tr>
					<td colspan="8"><?php echo RIZ_MSG; ?></td>
				</tr>
				<?php } ?>
			</tbody> 
