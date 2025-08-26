<section id="featureW">
    <div class="container"><div class="center wow fadeInDown">
  <p class="pt-60"></p> 
    <a href="#">
    <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/DCT.jpeg" type="button" data-toggle="modal" data-target="#DCT" class="img-responsive center-block"> </a>
        
        
        </div>
        <div class="row">
            <div class="col-sm-12 wow fadeInDown">
                <div class="accordion">
                    <div class="panel-group" id="accordion1">
                        <div class="panel panel-default">
                            <div class="panel-heading active">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
                                        Pilot
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </a>
                                </h3>
                            </div>

                            <div id="collapseOne1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
                                        <div class="media-body">
                                            <div class="table-responsive">
                                                <table class="table-fill" style="width:100%">
                                                    <tr>
                                                        <th>Date Posted</th>
                                                        <th>Make</th>
                                                        <th>Model</th>
                                                        <th>State</th>
                                                        <th>Action</th>
                                                    </tr>
                                                <?php if(count($data[JOB_TARGET_PILOT]["data"])): ?>
                                                <?php foreach($data[JOB_TARGET_PILOT]["data"] as $key => $job):
                                                        $class = $key % 2 == 0 ? 'odd' : ''; ?>
                                                        <tr>
                                                          <td class="<?php echo $class; ?>"><?php echo date(RIZ_FORMAT,$job->created); ?></td>
                                                          <td class="<?php echo $class; ?>"><?php echo $job->mfr; ?></td>
                                                          <td class="<?php echo $class; ?>"><?php echo $job->model; ?></td>
                                                          <td class="<?php echo $class; ?>"><?php echo $job->state; ?></td>
                                                          <td class="<?php echo $class; ?>">
                                                            <a style="font-size:14px;" class="color-darkblue" href="<?php echo secure_url('flight-dispatch-board/detail/'.urlencode(base64_encode($job->id))); ?>">View Details</a> 
                                                            <?php if($this->session->userdata("user_id") == $job->user_id): ?>
<a style="font-size:14px;" href="#" data-modal-external-file="<?php echo secure_url('flight-dispatch-board/delete/'.urlencode(base64_encode($job->id))); ?>" data-target="apprModal" data-close-modal="true" class="color-darkblue"> | Remove </a>
                                                            <?php endif; ?>
                                                        </td></tr>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6">No jobs found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                                </table>
                                                <?php echo $data[JOB_TARGET_PILOT]["pager"]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1">
                                        Mechanic
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseTwo1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table-fill" style="width:100%">
                                            <tr>
                                                <th>Date Posted</th>
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>State</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if(count($data[JOB_TARGET_MECHANIC]["data"])): ?>
                                                <?php foreach($data[JOB_TARGET_MECHANIC]["data"] as $key => $job):
                                                    $class = $key % 2 == 0 ? 'odd' : '';
 echo '<tr><td class="'.$class.'">'.date(RIZ_FORMAT,$job->created).'</td><td class="'.$class.'">'.$job->mfr.'</td><td class="'.$class.'">'.$job->model.'</td><td class="'.$class.'">'.$job->state.'</td><td class="'.$class.'"><a style="font-size:14px;" class="color-darkblue" href="'.secure_url('flight-dispatch-board/detail/'.urlencode(base64_encode($job->id))).'"> View Details</a>';
  if($this->session->userdata("user_id") == $job->user_id): ?>
  <a style="font-size:14px;" href="#" data-modal-external-file="<?php echo secure_url('flight-dispatch-board/delete/'.urlencode(base64_encode($job->id))); ?>" data-target="apprModal" data-close-modal="true" class="color-darkblue"> | Remove</a>
 <?php endif; 
 echo '</td></tr>';
                                                       
                                                    
                                            endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6">No jobs found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>
                                        <?php echo $data[JOB_TARGET_MECHANIC]["pager"]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
                                        Flight Attendent
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseThree1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table-fill" style="width:100%">
                                            <tr>
                                                <th>Date Posted</th>
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>State</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if(count($data[JOB_TARGET_ATTENDENT]["data"])): ?>
                                                <?php foreach($data[JOB_TARGET_ATTENDENT]["data"] as $key => $job):
                                                    $class = $key % 2 == 0 ? 'odd' : '';
                                                /*    echo '<tr><td class="'.$class.'">'.date(RIZ_FORMAT,$job->created).'</td><td class="'.$class.'">'.$job->mfr.'</td><td class="'.$class.'">'.$job->model.'</td><td class="'.$class.'">'.$job->state.'</td><td class="'.$class.'"><a class="color-darkblue" href="'.secure_url('flight-dispatch-board/detail/'.urlencode(base64_encode($job->id))).'">Details</a>' . ($this->session->userdata("user_id") == $job->user_id ? '<a href="#" data-modal-external-file="<?php echo secure_url('flight-dispatch-board/delete/'.urlencode(base64_encode($job->id))); ?>" data-target="apprModal" data-close-modal="true" class="color-darkblue">Delete</a>' : '') . '</td></tr>';
 */
echo '<tr><td class="'.$class.'">'.date(RIZ_FORMAT,$job->created).'</td><td class="'.$class.'">'.$job->mfr.'</td><td class="'.$class.'">'.$job->model.'</td><td class="'.$class.'">'.$job->state.'</td><td class="'.$class.'"><a style="font-size:14px;" class="color-darkblue" href="'.secure_url('flight-dispatch-board/detail/'.urlencode(base64_encode($job->id))).'">View Details</a>';
  if($this->session->userdata("user_id") == $job->user_id): ?>
  <a style="font-size:14px;" href="#" data-modal-external-file="<?php echo secure_url('flight-dispatch-board/delete/'.urlencode(base64_encode($job->id))); ?>" data-target="apprModal" data-close-modal="true" class="color-darkblue"> | Remove</a>
 <?php endif; 
 echo '</td></tr>';
                                         
                                                    
                                                    
                                                    
                                             endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6">No jobs found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>
                                        <?php echo $data[JOB_TARGET_ATTENDENT]["pager"]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1">
                                        Flight Dispatcher
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseFour1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table-fill" style="width:100%">
                                            <tr>
                                                <th>Date Posted</th>
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>State</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php if(count($data[JOB_TARGET_DISPATCHER]["data"])): ?>
                                                <?php foreach($data[JOB_TARGET_DISPATCHER]["data"] as $key => $job):
                                                    $class = $key % 2 == 0 ? 'odd' : '';
                                                   /* echo '<tr><td class="'.$class.'">'.date(RIZ_FORMAT,$job->created).'</td><td class="'.$class.'">'.$job->mfr.'</td><td class="'.$class.'">'.$job->model.'</td><td class="'.$class.'">'.$job->state.'</td><td class="'.$class.'"><a class="color-darkblue" href="'.secure_url('flight-dispatch-board/detail/'.urlencode(base64_encode($job->id))).'">Details</a>' . ($this->session->userdata("user_id") == $job->user_id ? '<a href="#" data-modal-external-file="<?php echo secure_url('flight-dispatch-board/delete/'.urlencode(base64_encode($job->id))); ?>" data-target="apprModal" data-close-modal="true" class="color-darkblue">Delete</a>' : '') . '</td></tr>';
                                              */
                                                    echo '<tr><td class="'.$class.'">'.date(RIZ_FORMAT,$job->created).'</td><td class="'.$class.'">'.$job->mfr.'</td><td class="'.$class.'">'.$job->model.'</td><td class="'.$class.'">'.$job->state.'</td><td class="'.$class.'"><a style="font-size:14px;" class="color-darkblue" href="'.secure_url('flight-dispatch-board/detail/'.urlencode(base64_encode($job->id))).'"> View Details</a>';
  if($this->session->userdata("user_id") == $job->user_id): ?>
  <a style="font-size:14px;" href="#" data-modal-external-file="<?php echo secure_url('flight-dispatch-board/delete/'.urlencode(base64_encode($job->id))); ?>" data-target="apprModal" data-close-modal="true" class="color-darkblue"> | Remove</a>
 <?php endif; 
 echo '</td></tr>';
 
                                                    
                                                    
                                                    endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6">No jobs found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>
                                        <?php echo $data[JOB_TARGET_DISPATCHER]["pager"]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--/#accordion1-->
                </div>
            </div>


        </div>
        <p class="pt-40"></p><p class="pt-40"></p>
    </div><!--/.container-->
</section><!--/#content-->
<!-- Modal -->
<div id="DCT" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/DCT.jpeg" class="img-responsive center-block">
      </div>
      <div class="modal-body">
        <p>If the apply button on the job post preview reads "DCT Apply" this means that the application is hosted by AeroNet. As soon as you click "DCT Apply" on a job post while signed in, your original resume on file and profile information is sent to the potential employer. This serves as your application!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>