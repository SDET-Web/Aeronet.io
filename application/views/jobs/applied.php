<div class="vd_content-section clearfix">
    <div class="row" style="margin-top:-15px;" >
        <div class="col-md-3 col-sm-4 col-xs-hidden">
            <div class="hidden-xs">
            <?php $this->load->view('profile/sidebar/pilot',array('data'=>$data)); ?>
        </div></div>
         <div class="col-md-8 col-sm-8 col-xs-12">
             
    	<div class="pd-20">
        	<h3 class="mgbt-xs-15 mgtp-10 font-semibold"> Applied Jobs List</h3>
Please show all jobs related to this pilot to view with all statuses
     <div class="row">       
            
    <div class="col-md-12 col-xs-12">
                                   
     <div class="row">
              <div class="col-md-12">
                <div class="panel widget">
                  <div class="panel-heading vd_bg-grey">
                    <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-list"></i> </span> List of Applied Jobs on Job Board  (Means show Job Type J) </h3>
                  </div>

                  <div class="panel-body-list  table-responsive">
                    <table class="table table-striped table-hover no-head-border">
                      <thead class="vd_bg-green vd_white">
                        <tr>
                          <th>#</th>
                          <th>Aircraft (Make - Model)	</th>
                          <th>Airport Location	</th>
                          <th>Job Title	</th>
                          <th>Submitted	</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Make Model</td>
                          <td class="center">show State from db</td>
                          <td class="center">title</td>
                          <td class="center">2010/02/03</td>
                          <td class="center">
                           if status p show     
                          <span class="label label-success">Active</span>
                          <br/> if status f show     
                          <span class="label label-warning">Feedback</span>
                          <br/>if status d or - 
                          <span class="label label-danger">Rejected</span>
                         <br/> if status q show
                          <span class="label label-success">Qualified</span>
                          <br/>  if job created or updated a month before
                          <span class="label label-default">Expired</span>    
                         </td>
                          <td class="menu-action">
                         <a data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-grey vd_grey"> <i class="fa fa-eye"></i> </a> 
                         <a data-original-title="status" data-toggle="tooltip" data-placement="top" class="btn menu-icon  vd_bd-grey vd_grey"> <i class="fa fa-cog"></i> </a> 
                         <a data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon  vd_bd-grey vd_grey"> <i class="fa fa-times"></i> </a>
                         <br/>View will open job details page
                         <br/>Status will open pop-up to show a detail message from flight department against each status.
                         <br/>Delete any application if status is expired or rejected</td>
                        </tr>
                        
                        
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- Panel Widget 
                <ul class="pagination" style="margin-top:-25px;">
                  <li><a href="#">&laquo;</a></li>
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>-->
             
                            <?php echo $this->Model_job->my_app(true,'j'); //s ?>

              
              </div>
              <!-- col-md-12 --> 
            </div>
            <!-- row -->    
        
        
        
        
        <div class="row">
              <div class="col-md-12">
                <div class="panel widget">
                  <div class="panel-heading vd_bg-blue">
                    <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-list"></i> </span> List of Applied Jobs on Applicant Tracking System Means show Job Type D </h3>
                  </div>

                  <div class="panel-body-list  table-responsive">
                    <table class="table table-striped table-hover no-head-border">
                      <thead class="vd_bg-green vd_white">
                        <tr>
                          <th>#</th>
                          <th>Aircraft (Make - Model)	</th>
                          <th>Job Title	</th>
                          <th>Job Position	</th>
                          <th>Job Type	</th>
                          <th>Submitted	</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Johann Un</td>
                          <td class="center">Model</td>
                          <td class="center">Member</td>
                           <td class="center">Member</td>
                          <td class="center">2010/02/03</td>
                          <td class="center">
                           if status p show     
                          <span class="label label-success">Active</span>
                          <br/> if status f show     
                          <span class="label label-warning">Assessment Test</span>
                          <br/> if status v show     
                          <span class="label label-warning">Video Interview</span>
                          <br/> if status b show     
                          <span class="label label-warning">Background Checks</span>
                          <br/>if status d or - 
                          <span class="label label-danger">Rejected</span>
                         <br/> if status q show
                          <span class="label label-success">Qualified</span>
                         <br/>  if job created or updated a month before
                          <span class="label label-default">Expired</span>    
                              
                              
                              
                          </td>
                          <td class="menu-action"><a data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-grey vd_grey"> <i class="fa fa-eye"></i> </a> 
                              <a data-original-title="status" data-toggle="tooltip" data-placement="top" class="btn menu-icon  vd_bd-grey vd_grey"> <i class="fa fa-cog"></i> </a> 
                              <a data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon  vd_bd-grey vd_grey"> <i class="fa fa-times"></i> </a> same like above</td>
                        </tr>
                        
                        
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- Panel Widget 
                <ul class="pagination" style="margin-top:-20px;">
                  <li><a href="#">&laquo;</a></li>
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>-->
                
                              <?php echo $this->Model_job->my_app(true,'d'); //s ?>

                
              </div>
              <!-- col-md-12 --> 
            </div>
            <!-- row -->   

                                        </div> 
            
            </div> 
                            
            </div>
                          
                        </div>
        
        </div>
              
             </div>
        
                    
        
    
