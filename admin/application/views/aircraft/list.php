							<thead>
							<tr>
								<th>N-Number</th>
								<th>Name</th>
								<th>Address</th>
								<th>Make</th>
								<th>Model</th>
								<th class="text-center">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php if($records->num_rows() > 0){ ?>
								<?php foreach($records->result() as $record){ ?>
									<tr>
										<td><?php echo $record->n_number; ?></td>
										<td><?php echo $record->name; ?></td>
										<td><?php echo $record->street.' '.$record->city.', '.$record->state.'('.$record->zip_code.')'; ?></td>
										<td><?php echo $record->mfr_name; ?></td>
										<td><?php echo $record->model_name; ?></td>
										<td class="text-center">
											<a class="edit btn btn-sm btn-default" href="<?php echo site_url('/edit/'.$controller.'/'.$record->id); ?>"><i class="icon-note"></i></a>
											<a class="delete btn btn-sm btn-danger" href="?delete=<?php echo $record->id; ?>"><i class="icons-office-52"></i></a>
										</td>
									</tr>
								<?php } ?>
							<?php }else{ ?>
								<tr>
									<td colspan="8"><?php echo RIZ_MSG; ?></td>
								</tr>
							<?php } ?>
							</tbody>