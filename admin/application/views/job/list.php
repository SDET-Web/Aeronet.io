			<thead>
				<tr> 
    				<th>Date</th> 
    				<th>Owner</th> 
    				<th>Make</th> 
    				<th>Model</th> 
    				<th>Location</th> 
    				<th>Option</th>
    				<th>Action</th>
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<?php $options = ($record->job_options!=''?unserialize($record->job_options):false); ?>
				<tr> 
					<td><?php echo date('Y-m-d',$record->job_created); ?></td>
    				<td><a href="<?php echo site_url('detail/user/'.$record->user_id); ?>"><?php $record->user_fname.' '.$record->user_lname; ?></a></td> 
    				<td><?php echo $record->manufacturer; ?></td> 
    				<td><?php echo $record->model; ?></td> 
    				<td><?php echo $record->job_location; ?></td> 
    				<td><?php if($options!=false){ ?>
						<?php $int = '';$ext = ''; ?>
							<?php $first =true; ?>
							<?php foreach($options as $key=>$option){
								$tmp = get_exint_dbfield_title_new($key);
								if($tmp['type'] == 'int'){
									$int .= '<li>'.$tmp['name'].(strlen($option) > 5?' ('.$option.')':'').'</li>';
								}else{
									$ext .= '<li>'.$tmp['name'].(strlen($option) > 5?' ('.$option.')':'').'</li>';
								}
							} ?>
							<div id="contenttype-html">
							<table>
								<thead>
									<tr>
										<th>Exterior</th>
										<th>Interior</th>
									</tr>
								</thead>
								<tr>
									<td><ul style="margin: 5px 25px;"><?php echo $ext; ?></ul></td>
									<td><ul style="margin: 5px 25px;"><?php echo $int; ?></ul></td>
								</tr>
							</table>
							</div>
						<?php } ?></td>
    				<td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->job_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a class="delete" href="?delete=<?php echo $record->job_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
				</tr> 
				<?php } ?>
				<?php }else{ ?>
				<tr>
					<td colspan="8"><?php echo RIZ_MSG; ?></td>
				</tr>
				<?php } ?>
			</tbody> 