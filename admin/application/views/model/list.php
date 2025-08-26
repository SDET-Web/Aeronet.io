				<thead>
				<tr> 
    				<th colspan="2">Model</th> 
    				<th>Maker</th> 
    				<th>Fuel burn per hour (gallons)</th>
    				<th>Price of fuel per gallon</th>
    				<th>Price of oil burned per hour</th>
    				<th>Airport Expenditures</th>
    				<th>Number of pilots sharing expenses</th>
    				<th>Action</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr> 
					<td><img src="<?php echo RIZ_AIRCRAFT_PIC.$record->aircraftpicture; ?>" height="50px" /></td>
    				<td><?php echo $record->model; ?></td> 
    				<td><?php echo $record->manufacturer; ?></td> 
    				<td><?php echo $record->fuel_burn; ?></td> 
    				<td><?php echo $record->fuel_price; ?></td> 
    				<td><?php echo $record->oil_burn; ?></td> 
    				<td><?php echo $record->airport_expense; ?></td> 
    				<td><?php echo $record->piolet_count; ?></td> 
    				<td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->model_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a class="delete" href="?delete=<?php echo $record->model_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
				</tr> 
				<?php } ?>
				<?php }else{ ?>
				<tr>
					<td colspan="8"><?php echo RIZ_MSG; ?></td>
				</tr>
				<?php } ?>
			</tbody> 
			