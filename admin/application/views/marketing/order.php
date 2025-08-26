		<article class="module width_full">
			<header><h3><?php echo get_pager(); ?><div style="float:right;"><?php echo strtoupper($controller); ?></div></h3></header>
				<div class="module_content">
					<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Date</th> 
    				<th>Buyer</th> 
    				<th>Aircrafts</th> 
    				<th>Status</th> 
    				<th>Action</th>
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<?php $options = $this->db->from('aircrafts')->where('id in ('.$record->order_aircrafts.')','',FALSE)->get(); ?>
				<tr> 
					<td><?php echo date('Y-m-d',$record->order_created); ?></td>
    				<td><a href="<?php echo site_url('detail/user/'.$record->user_id); ?>"><?php $record->user_fname.' '.$record->user_lname; ?></a></td> 
    				<td><?php if($options->num_rows()){ ?>
    					<table>
    						<tr> 
			    				<th>N-Number</th> 
			    				<th>Name</th> 
			    				<th>Address</th> 
			    				<th>Make</th>
			    				<th>Model</th> 
							</tr> 
						<?php foreach($options->result() as $option){ ?>
						<tr> 
		    				<td><?php echo $option->n_number; ?></td> 
		    				<td><?php echo $option->name; ?></td> 
		    				<td><?php echo $option->street.' '.$option->city.', '.$option->state.'('.$option->zip_code.')'; ?></td> 
		    				<td><?php echo $option->mfr_name; ?></td> 
		    				<td><?php echo $option->model_name; ?></td> 
						</tr> 
					<?php } ?>
				
				</table>
					<?php } ?>
				</td>
   				<td><?php echo ($record->order_status == 'x'?'Pending':($record->order_status == 'p'?'<a href="?s=p&i='.$record->order_id.'">Paid</a>':'Shipped')); ?></td> 
   				<td><a target="_blank" href="/user/resume_view/<?php echo $record->user_id; ?>">View Resume</a><a class="delete" href="?delete=<?php echo $record->order_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
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