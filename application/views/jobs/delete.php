<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header vd_bg-green">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title vd_white">JOB DELETE</h4>
        </div>
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <h4>Are you sure you want to delete this job? </h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?php echo site_url("flight-dispatch-board/delete/$id/confirm"); ?>" class="btn vd_btn vd_bg-blue btn-block  btn-primary"><span class="append-icon">
                        <i class="fa fa-times"></i></span> YES
                </a>
            </div>
        </form>
    </div>
</div>
