		<script>
			$(document).ready(function(){
				$("#model").change(function(){
					window.location = '?<?php //echo ($this->input->get('page')!=''?'page='.$this->input->get('page').'&':''); ?>model=' + $(this).val();
				});
			});
		</script>
			<thead>
				<tr> <th>Type</th>
					<th>Photo</th>
					<th>Email</th>
					<th>First Name</th>
    				<th>Last Name</th>
    				<th>Street</th>
    				<th>City</th>
					<th>Courses</th>
					<th>Type</th>
				</tr>
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr <?php echo ($record->user_status == 'n'?'style="background:#cd6a6a;color:#fff;"':'');?>>
				<td><?php
                                $type=$record->user_type;
                                if($record->user_type == 'm'){$type='Machanic';}
                                elseif($record->user_type == 's'){$type='Dispatcher'; } 
                                elseif($record->user_type == 'a'){$type='Flight Attendant'; }
                                           
                                echo $type; ?></td>	
                                <td><?php echo ($record->user_image!=''?'<img src="'.RIZ_AIRCRAFT_UPLOADS.'member/'.$record->user_image.'" height="50px" />':''); ?></td>
				<td><?php echo $record->user_email; ?></td>
    				<td><?php echo $record->user_fname; ?></td>
    				<td><?php echo $record->user_lname; ?></td>
    				<td><?php echo $record->user_address; ?></td>
    				<td><?php echo $record->user_city; ?></td>
					<td align="center"><a href="<?php echo site_url('enlist/course/'.$record->user_id); ?>"><?php echo $record->course_count; ?></a></td>
					<td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->user_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a class="delete" href="?delete=<?php echo $record->user_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td>
				</tr>
				<?php } ?>
				<?php }else{ ?>
				<tr>
					<td colspan="8"><?php echo RIZ_MSG; ?></td>
				</tr>
				<?php } ?>
			</tbody> 
