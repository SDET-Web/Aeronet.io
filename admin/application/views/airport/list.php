			<thead>
				<tr> 
    				<th>3 Letter ID</th> 
    				<th>Name</th> 
    				<th>County</th> 
    				<th>City</th> 
    				<th>State</th> 
    				<th>Action</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr> 
    				<td><?php echo $record->LETTER_3; ?></td> 
    				<td><?php echo $record->AIRPORT; ?></td> 
    				<td><?php echo $record->COUNTY; ?></td> 
    				<td><?php echo $record->CITY; ?></td> 
    				<td><?php echo $record->STATE; ?></td> 
    				<td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a class="delete" href="?delete=<?php echo $record->id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
				</tr> 
				<?php } ?>
				<?php }else{ ?>
				<tr>
					<td colspan="8"><?php echo RIZ_MSG; ?></td>
				</tr>
				<?php } ?>
			</tbody> 
