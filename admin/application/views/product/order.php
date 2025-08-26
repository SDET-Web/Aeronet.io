		<article class="module width_full">
			<header><h3><?php echo get_pager(); ?><div style="float:right;"><?php echo strtoupper($controller); ?></div></h3></header>
				<div class="module_content">
					<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Date</th> 
    				<th>Amount</th> 
    				<th>Status</th>
    				<th>Products</th>
    				<th>Shipping</th>
					<th>Action</th>
				</tr> 
			</thead> 
			<tbody> 
				<?php if($records->num_rows() > 0){ ?>
				<?php foreach($records->result() as $record){ ?>
				<tr> 
					<td><?php echo date('Y-m-d',$record->order_created); ?></td> 
    				<td>$<?php echo $record->order_amount; ?></td>
    				<td><?php //echo ($record->order_status == 'p'?'Paid':'Pending'); 
					echo ($record->order_status == 'd'?'Shipped':($record->order_status == 'p'?'<a href="?s=p&i='.$record->order_id.'">Paid</a>':'Pending'));?></td> 
    				<td>
    					<?php $products =  unserialize($record->order_product); ?>
    					<?php if(is_array($products)){ ?>
    					<table>
    						<tr>
    							<th>
    								Product
    							</th>
    							<th>
    								Quantity
    							</th>
    						</tr>
    						<?php foreach($products as $key=>$prod_info){ ?>
    						<tr>
    							<td><?php $pd = $this->db->select('prod_title')->from('product')->where('prod_id',$key)->get();echo ($pd->num_rows() > 0?$pd->row()->prod_title:'Product Not found'); ?></td>
    							<td><?php echo $prod_info; ?></td>
    						</tr>
    						<?php } ?>
    					</table>
    					<?php }else{?>
    						Not selected
    					<?php } ?>
    				</td>
    				<td>
    					<?php $shipping =  unserialize($record->order_shipping); ?>
    					<?php if(is_array($shipping)){ ?>
    					<table>
    						<?php foreach($shipping as $key=>$shipinfo){ ?>
    						<tr>
    							<td><?php echo $key; ?></td>
    							<td><?php echo $shipinfo; ?></td>
    						</tr>
    						<?php } ?>
    					</table>
    					<?php }else{?>
    						Not provided
    					<?php } ?>
    				</td>
					<td><a class="delete" href="?delete=<?php echo $record->order_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td> 
				</tr> 
				<?php } ?>
				<?php }else{ ?>
				<tr>
					<td colspan="9"><?php echo RIZ_MSG; ?></td>
				</tr>
				<?php } ?>
			</tbody> 
			</table>
			
		</article>