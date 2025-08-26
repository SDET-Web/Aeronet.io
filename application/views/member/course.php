<?php $courses = $this->Model_user->courses($this->session->userdata('user_id')); ?>
<?php $colors = [
    1 => '#FDD5C1',
    2 => '#FDEBCF',
    3 => '#FDFCDA',
    4 => '#EEFDDA',
    5 => '#DDFDDA',
    6 => '#DDFDDA',
    7 => '#DDFDDA',
    8 => '#DDFDDA',
    9 => '#DDFDDA',
    10 => '#DDFDDA',
    11 => '#DDFDDA',
    12 => '#DDFDDA',
    13 => '#DDFDDA',
    14 => '#DDFDDA',
    ]; ?>
<div class="clearfix"></div>
<div class="vd_content-section clearfix">
    <div class="row">
        <div class="col-sm-12">
            <h1>Your credit history from <?php echo date("M Y", strtotime( date( 'Y-m-01' )." +0 months -1 years")); ?> to <?php echo date("M Y", strtotime( date( 'Y-m-01' )." +12 months -1 years")); ?></h1>
            <div class="clearfix pt-20">&nbsp;</div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                        <?php for($i = 0; $i <= 12; $i++): ?>
                        <div class="course-timeline" style="width:7.69%;float:left;margin:0">
                            <div class="colors" style="background-color:<?php echo $colors[$i+1]; ?>">
                                <?php echo $courses['stats'][date("M", strtotime( date( 'Y-m-01' )." +$i months"))]; ?>
                            </div>
                            <div class="month">
                                <?php $dte = date("M", strtotime( date( 'Y-m-01' )." +$i months")); echo $dte == 'Jan'?date("Y", strtotime( date( 'Y-m-01' )." -$i months")):$dte; ?>
                            </div>
                        </div>
                        <?php endfor; ?>
                        <br /><br />
                        <div class="text-center" style="padding-top:50px;">
                            <a class="btn-large btn" href="<?php echo site_url('courses'); ?>">VIEW AVAILABLE COURSES</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
