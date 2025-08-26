

<div class="row">
    <div class="col-lg-12 portlets ui-sortable">
        <div class="panel">
            <div class="panel-header bg-dark">
                <h3><i class="fa fa-table"></i> <strong>Settings <small></h3>
                <div class="clearfix"></div>
            </div>
            <div class="filter-left">
                <div class="panel-content pagination2 table-responsive">
                    <div class="clear">&nbsp;</div>
                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Username</label>
                                    <div class="col-sm-9">
                                        <?php echo input_parser('username',$data['username']); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <?php echo input_parser('email',$data['email']); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-9">
                                        <?php echo input_parser('password',''); ?>
                                    </div>
                                </div>
                            </div>
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