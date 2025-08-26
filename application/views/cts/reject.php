<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header vd_bg-green">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title vd_white">DISQUALIFIED (EEO COMPLIANCE)</h4>
        </div>
        <form method="POST" action="<?php echo site_url("applications/reject/" . $id . "/" . $application->id); ?>">
            <input type="hidden" name="action" value="rejectApplication" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <h4>Why do you want to remove and disqualify this Applicant?  </h4>
                        <select id="reason" name="reason" required="required">
                          <?php foreach(select_disqualify_reason() as $key => $reason): ?>
                          <option value="<?php echo $key; ?>"><?php echo $reason; ?></option>
                          <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer vd_bg-green">
                <button type="submit" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                        <i class="fa fa-times"></i></span> Disqualified the Application
                </button>
            </div>
        </form>
    </div>
</div>
