<div class="row">
    <div class="col-lg-12 portlets ui-sortable">
        <div class="panel">
            <div class="panel-header">
                <h3><i class="fa fa-table"></i> <strong>List of</strong> <?php echo $controller; ?> <small></h3>
                <div class="clearfix"></div>
            </div>
            <div class="filter-left">
                <div class="panel-content pagination2 table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <div class="row">
                            <div class="col-xs-6">
                                <form method="post">
                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                    <label><input placeholder="Search..." type="search" name="search" value="<?php echo $this->input->post('search'); ?>" class="form-control" aria-controls="DataTables_Table_0"></label>
                                </div>
                                </form>
                            </div>
                            <div class="col-xs-6">
                                <div class="btn-group pull-right">
                                    <a type="button" class="btn btn-sm btn-white active"><i class="fa fa-align-justify"></i> List</a>
                                    <a href="<?php echo site_url('add/'.$controller); ?>" type="button" class="btn btn-sm btn-white"><i class="fa fa-plus"></i> Add New</a>
                                    <?php if(isset($import)): ?>
                                    <a data-toggle="modal" data-target="#modal-large" type="button" class="btn btn-sm btn-white"><i class="fa fa-upload"></i> Import</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="clear">&nbsp;</div>
                        <table class="table table-hover no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <?php $this->load->view($view,$data); ?>
                        </table>
                        <div class="clear">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 10 of 35 entries</div>
                            </div>
                            <div class="col-md-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    <?php echo get_pager(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="clear">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-pirmary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><strong>Import </strong> <?php echo $controller; ?></h4>
                </div>
                <div class="modal-body">
                    <article class="module width_full">
                        <div class="module_content text-center" style="padding:1%;font-size: 20px;">
                            <input type="file" name="file_upload" id="<?php echo isset($import)?$import:''; ?>" />
                            <?php if(isset($import) && $import == 'pilot_upload'): ?>
                            <input type="checkbox" id="is_non_pilot" value="n" /> Non Pilot
                            <?php endif; ?>
                        </div>
                    </article>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>