    <div class="row" >
        <div class="col-md-4 col-sm-4 col-xs-hidden">
            <div class="hidden-xs">
           <?php $this->load->view('profile/sidebar/department',array('data'=>$data)); ?>
            </div></div>
         <div class="col-md-8 col-sm-8 col-xs-12"><p class="pd-40"></p>
          <div class="panel widget">
                  <div class="panel-heading vd_bg-green">
                    <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-plane"></i> </span>  Verified Aircrafts </h3>
                    
                  </div>
                 <div class="panel-body">
                    <div class="content-list content-image menu-action-right">   
                  <ul class="list-wrapper pd-lr-15">
                       <?php if(count($data['aircraft'])): ?>
                <?php foreach($data['aircraft'] as $key=>$item): ?>
                          <li>
                           <div class="menu-icon" style="padding:20px;">
                               <span class="menu-rating vd_green fa-stack fa-sm">
  <i class="far fa-circle fa-stack-2x"></i>
  <i class="fas fa-plane fa-stack-1x"></i>
</span>
                               </div> 
                            <div class="menu-text" style="padding:25px;">
                            <h4> Manufacturer  -  <?php echo $item['mfr_name']; ?></h4>
                            <h4>  Model  -  <?php echo $item['model_name']; ?></h4> </div>
                             
                              
                          </li>
                          <?php endforeach; ?>
            <?php else:?>
                            <div class="nothing-found">No Verified Aircrafts</div>
                        <?php endif; ?>
                  </ul>
                     
                     
                 </div>
                 </div>
             </div>
             
             
             
             
             </div>
        
                    </div>
                
           