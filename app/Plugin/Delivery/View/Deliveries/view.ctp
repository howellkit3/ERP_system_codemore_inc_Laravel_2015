<?php echo $this->Html->script('Sales.quantityLimitview');?>

<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block pull-right marginDelivery">
               <?php   
                
                  echo $this->Html->link('<i class="fa  fa-arrow-left fa-lg "></i> Back ', 
                        array('controller' => 'deliveries', 
                            'action' => 'index'
                            ),
                        array('class' =>'btn btn-primary pull-right',
                            'escape' => false));
                ?>  

                
                <?php  if (!empty($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']])) { ?> 

                <?php if($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']] != 'Approved') { ?>

                
                <?php }}else{ ?>

                  <a data-toggle="modal" href="#myModalApprove" class="btn btn-primary mrg-b-lg pull-right addSchedButton "><i class="fa fa-edit fa-lg"></i>Approve Schedule</a>
                  <?php
                  //echo $this->Html->link('<i class="fa fa-check-square fa-lg "></i> Approve Schedule ', 
                        // array('controller' => 'deliveries', 
                        //     'action' => 'add', $scheduleInfo['ClientOrderDeliverySchedule']['id']
                        //     ),
                        // array('class' =>'btn btn-primary pull-right',
                        //     'escape' => false));
                ?>  


                 

                <?php } ?>

                 <a data-toggle="modal" href="#myModalDelivery" class="btn btn-primary mrg-b-lg pull-right addSchedButton "><i class="fa fa-edit fa-lg"></i> Edit Schedule</a>

                 <?php // pr($scheduleInfo); exit;
                
                  // echo $this->Html->link('<i class="fa fa-edit fa-lg "></i> Edit Schedule ', 
                  //       array('controller' => 'deliveries', 
                  //           'action' => 'add'
                  //           ),
                  //       array('class' =>'btn btn-primary pull-right',
                  //           'escape' => false));
                ?> 

               <br><br>
           </div>
   
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Planned Schedule</b></h2>
                
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                  <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="main-box clearfix">
                       
                          <table class="table table-striped table-hover">
                        
                            <tbody>

                                
                                <tr>
                                    <td>Client Order Number</td>
                                    <td><?php echo  $scheduleInfo['ClientOrder']['uuid']; ?></td>
                                </tr>

                                <tr>
                                    <td>P.O. Number</td>
                                    <td><?php echo  $scheduleInfo['Company']['uuid']; ?></td>
                                </tr>

                                <tr>
                                    <td>Customer Name</td>
                                    <td><?php echo  $scheduleInfo['Company']['company_name']; ?></td>
                                </tr>

                                <tr>
                                    <td>Item Name</td>
                                    <td><?php echo  $scheduleInfo['Product']['name']; ?></td>
                                </tr>
                               
                              </tbody>
                        
                            </table>

                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="main-box clearfix">
                       
                          <table class="table table-striped table-hover">
                        
                            <tbody>

                             <tr>
                                    <td>Schedule</td>
                                    <td><?php echo date('M d, Y', strtotime($scheduleInfo['ClientOrderDeliverySchedule']['schedule'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td><?php echo  $scheduleInfo['ClientOrderDeliverySchedule']['quantity']; ?></td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td><?php echo  $scheduleInfo['ClientOrderDeliverySchedule']['location']; ?></td>
                                </tr>
             
                            </tbody>
                        
                            </table>

                    </div>
                  </div>
                </div>
            </div>   
        </div>
    </div>
</div>

<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block pull-right marginDelivery">

           </div>
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Delivery Schedule</b></h2>
                
            </header>

            <table class="table table-striped table-hover ">
                        <thead>
                            <tr >
                                <th class=""><a href="#"><span>Delivery Receipt #</span></a></th>
                                <th class=""><a href="#"><span>Schedule</span></a></th>
                                <th class=""><a href="#"><span>Quantity</span></a></th>
                                <th class=""><a href="#"><span>Location</span></a></th>
                                <th class=""><a href="#"><span>Status</span></a></th>
                            </tr>
                        </thead>

                        <?php echo $this->element('schedule_requests_table'); ?>  
                    </table>
              </div>
        </div>
    </div>      
             <?php 
                        if(!empty($deliveryData)){
              ?>
              <?php foreach ($deliveryData as $deliveryDataList): ?>
   
                          <table class="table table-hover">

                            <tbody aria-relevant="all" aria-live="polite" role="alert">

                                    <tr class="">

                                      <td>
                                          <?php echo $deliveryDataList['DeliveryDetail']['delivery_uuid']; ?>
                                        </td>

                                        <td>
                                          <?php echo date('M d, Y', strtotime($deliveryDataList['DeliveryDetail']['schedule'])); ?>
                                        </td>

                                        <td class="text-center">

                                               <?php echo  $deliveryDataList['DeliveryDetail']['location']; ?>
                                           
                                        </td>

                                        <td class="text-center">

                                           <?php echo  $deliveryDataList['DeliveryDetail']['quantity']; ?>
                                        
                                        </td>

                                        <td class="text-center">
                              
                                        

                                               <!--   <?php  $Scheddate = $deliveryDataList['DeliveryDetail']['schedule'];
                                                        $Currentdate = date("Y-m-d H:i:s");

                                                        $Scheddate = str_replace('-', '', $Scheddate);
                                                        $Currentdate = str_replace('-', '', $Currentdate); ?>  

                                                        <?php  if (!empty($scheduleInfo[$deliveryDataList['ClientOrderDeliverySchedule']['uuid']])) {   

                                                                    if(strtotime($Scheddate) < strtotime($Currentdate))
                                                                        {
                                                                            echo "<span class='label label-warning'>Due</span>"; 
                                                                        }else{   

                                                                     if($deliveryData[$deliveryDataList['ClientOrderDeliverySchedule']['uuid']] == 'Approved') { 
                                                                    
                                                                              echo "<span class='label label-success'>Approved</span>";  

                                                                  
                                                                     }
                                                                   }
                                                                 }else{

                                                                            echo "<span class='label label-default'>Waiting</span>";

                                                           } ?> -->

                                           
                                           <br>
                                           
                                        </td>

                                     
                                    </tr>

                                </tbody>

                            
                        
                            </table>
                    
          <?php 
             endforeach; 
          } ?> 
       
    

<?php echo $this->element('modals'); ?>