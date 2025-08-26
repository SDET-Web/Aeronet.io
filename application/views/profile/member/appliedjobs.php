<style>
table {width:100%;border-collapse: collapse;}
@media only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {
        /* Section three*/
             .JBoard table, thead, tbody, th, td, tr { 
                        display: block;border: 0 !important;width:100%;
                }
             .ATS table, thead, tbody, th, td, tr { 
                        display: block;border: 0 !important;width:100%;
                }
               
                /* Section four*/
                .JBoard thead tr { 
                        position: absolute;
                        top: -9999px;
                        left: -9999px;
                }
                .ATS thead tr { 
                        position: absolute;
                        top: -9999px;
                        left: -9999px;
                }             
                .JBoard tr { width:92%; background: #fff;height:auto; margin: 1rem;
  position: relative;margin-top:20px;border-bottom: 2px solid #777777; 
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23); }
                .ATS tr { width:92%; background: #fff;height:auto; margin: 1rem;
  position: relative;margin-top:20px;border-bottom: 2px solid #23709e; 
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23); }
                
/* Section five*/
                .JBoard td { 
                    border: 0 !important;padding:10px;
                    height:40px;width:100%;
                     font-weight:500;
                     left:0px;font-size:14px; color:#777;
                }
                .ATS td { 
                     border: 0 !important;padding:10px;
                     height:40px;width:100%;
                     font-weight:500;
                     left:0px;font-size:14px; color:#23709e;
                     
                }
               .JBoard td:before { 
                        position:relative;padding:10px;
                        white-space: nowrap;
                        overflow: hidden;
                         text-overflow: ellipsis;                       
                        font-weight: bold;
                }
                .ATS td:before { 
                        position:relative;padding:10px;
                        
                        font-weight: bold;  white-space: nowrap;
                        overflow: hidden;
                         text-overflow: ellipsis;              }
                
                /*
    Label the data
    */
     .JBoard td:nth-of-type(1):before { content: "JobList#"; }
     .JBoard td:nth-of-type(2):before { content: "Aircraft (Make - Model)"; }
     .JBoard td:nth-of-type(3):before { content: "Airport Location"; }
     .JBoard td:nth-of-type(4):before { content: "Job Title"; }
     .JBoard td:nth-of-type(5):before { content: "Submitted"; }
     .JBoard td:nth-of-type(6):before { content: "Job Status"; }
     .JBoard td:nth-of-type(7):before { content: ""; }

    .ATS td:nth-of-type(1):before { content: "JobList#"; }
    .ATS td:nth-of-type(2):before { content: "Aircraft (Make - Model)"; }
    .ATS td:nth-of-type(3):before { content: "Job Title"; }
    .ATS td:nth-of-type(4):before { content: "Job Position"; }
    .ATS td:nth-of-type(5):before { content: "Job Type"; }
    .ATS td:nth-of-type(6):before { content: "Submitted"; }
    .ATS td:nth-of-type(7):before { content: "Job Status"; }
    .ATS td:nth-of-type(8):before { content: ""; }
}
</style>


    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-hidden"> 
            <div class="hidden-xs">
            <?php $this->load->view('profile/sidebar/pilot',array('data'=>$data)); ?></div>
        </div>
         <div class="col-md-8 col-sm-8 col-xs-12">        
            <div class="row">
                <div class="col-md-12 col-xs-12">
                  <!--<p class="pt-80"><br/></p> FREE JOB POST MODULE
                  <div class="panel-heading vd_bg-grey vd_white">
                    <h3 class="panel-title center" > <span class="menu-icon"> <i class="fa fa-list"></i> </span>  Your Jobs Board Applications  </h3>
                  </div>
                  
                  <div class="panel-body" style="background-color:#DBF4FD;padding:0px;">
                  <?php //echo $this->Model_job->my_app(true,'j'); //s ?>                            
                  </div>  -->         
<div class="center">
 <br/><br/>
    <a href="#">
    <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/ApplicationList.jpeg" type="button" data-toggle="modal" data-target="#APT" class="img-responsive center-block"> </a>
</div><br/>
                  
                  
                  <div class="panel-body" style="background-color:#DBF4FD;padding:0px;">
                    <?php echo $this->Model_job->my_app(true,'d'); //s ?>
                  </div></div>
               
                </div>
               </div></div>                
    
<script>
$(document).ready(function () {
  $(".deleteOption").click(function() {
    $("#deleteYes").attr("href", "?action=deleteapp&id=" + $(this).attr("data-id"));
    $("#delModal").modal("show");
  });
});
</script>


         <div class="modal fade" id="delModal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header vd_bg-red">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title vd_white">
            Delete</strong></h4>
         </div>
         <div class="modal-body">
            <div>
               <div class="col-md-12 col-xs-12">
                  <h5><strong class="font-semibold">Are you sure you want to delete this position. </strong></h5>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a id="deleteYes" href="#" type="button" class="btn vd_btn vd_bg-blue">Yes </a>
            <button type="button" class="btn vd_btn" class="close" data-dismiss="modal">Close</button>

         </div>
      </div>
   </div>
</div>
<div id="APT" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/ApplicationList.jpeg" class="img-responsive center-block">
      </div>
      <div class="modal-body">
        <p>
AeroNets' application tracking system (ATS)   continually screens, sorts, and stores up-to-date, dynamic resumes specific to each individual flight departments preferences. 
        </p>
        <p>
        <b>What this means for you:</b> You can submit your CV and resume to select flight departments.  Then continually monitor the status, of your review process, in their recruiting pipeline and even update it in real time.  Showcase new type ratings, recurrent checks, total times, even relocations.
        </p>
        <p><b class="font-bold vd_blue">"Post and Pray" has had its day.</b></p>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>   