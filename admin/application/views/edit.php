
		<div class="row">
			<div class="col-lg-12 portlets ui-sortable">
				<div class="panel">
					<div class="panel-header bg-dark">
						<h3><i class="fa fa-table"></i> <strong>List of</strong> <?php echo $controller; ?> <small></h3>
						<div class="clearfix"></div>
					</div>
					<div class="filter-left">
						<div class="panel-content pagination2 table-responsive">
							<div class="clear">&nbsp;</div>
							<form method="post" class="form-horizontal" enctype="multipart/form-data">
								<div class="row">
									<?php foreach($records as $key=>$val){?>
										<?php if (wysiwyg_fields($key)):; ?>
											<div class="clearfix"></div>
										<?php endif; ?>
										<?php if(dont_show($key) && dont_show_certain($type,$key)){ ?>
											<div class="<?php echo (wysiwyg_fields($key)?'col-md-11':'col-md-4'); ?>">
												<div class="form-group">
													<label class="<?php echo (wysiwyg_fields($key)?'hidden':'col-sm-3'); ?> control-label"><?php echo field_name_parser($key); ?></label>
													<div class="<?php echo (wysiwyg_fields($key)?'col-md-12':'col-sm-9'); ?>s">
														<?php echo input_parser($key,$val); ?>
													</div>
												</div>
											</div>
										<?php }?>

									<?php }?>

									<div class="clear"></div>
								</div>
								<div class="row">
									<div class="text-center m-t-20">
										<button type="submit" class="btn btn-embossed btn-primary">Save</button>
										<button type="reset" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancel</button>
									</div>
								</div>
							</form>
							<div class="clear">&nbsp;</div>
						</div>
					</div>
				</div>
			</div>
		</div>