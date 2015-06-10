<?php echo $this->Html->script('Sales.quantityLimitDelivery');?>

<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block pull-right marginDelivery">
               <?php   //pr($scheduleInfo); exit;
                
                  echo $this->Html->link('<i class="fa  fa-arrow-left fa-lg "></i> Back ', 
                        array('controller' => 'deliveries', 
                            'action' => 'index'
                            ),
                        array('class' =>'btn btn-primary pull-right',
                            'escape' => false));
                ?>  

                
                <?php  if (!empty($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']])) { ?> 

                <?php if($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']] != 'Approved') { ?>

                
                  <?php }else{ ?>

                     <!-- <a data-toggle="modal" href="#myModalDeliveries" class="btn btn-primary pull-right addSchedButton "><i class="fa fa-edit fa-lg"></i> Edit Schedule</a> -->

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
                                    <td><?php echo  $scheduleInfo['ClientOrder']['po_number']; 
                                   ?></td>
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

                                <tr>
                                    <td>Status</td>
                                    <td><?php           //pr($scheduleInfo['ClientOrderDeliverySchedule']['uuid']); exit;
                                                        $Scheddate = $scheduleInfo['ClientOrderDeliverySchedule']['schedule'];
                                                        $Currentdate = date("Y-m-d H:i:s");

                                                        $Scheddate = str_replace('-', '', $Scheddate);
                                                        $Currentdate = str_replace('-', '', $Currentdate); ?>  

                                                        <?php  if (!empty($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']])) {  

                                                                    if(strtotime($Scheddate) < strtotime($Currentdate))
                                                                        {
                                                                            echo "<span class='label label-warning'>Due</span>"; 
                                                                        }else{   

                                                                     if($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']] == 'Approved') { 
                                                                    
                                                                              echo "<span class='label label-success'>Approved</span>";  

                                                                  
                                                                     }
                                                                   }
                                                                 }else{

                                                                            echo "<span class='label label-default'>Waiting</span>";

                                                           } ?>
                                    </td>
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


<div class="main-box-body clearfix">
    <div class="row1">
      <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block pull-right marginDelivery">

           </div>
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Delivery Schedule</b></h2>
                <a data-toggle="modal" href="#myModalDeliveries" class="btn btn-primary pull-right addSchedButton  "><i class="fa fa-edit fa-lg"></i> Add Schedule</a>
                
            </header>

            <table class="table table-striped table-hover ">
                        <thead>
                            <tr >
                                <th class=""><a href="#"><span>Delivery Receipt #</span></a>  </th>
                                <th class=""><a href="#"><span>Schedule</span></a></th>
                                <th class=""><a href="#"><span>Location</span></a></th>
                                <th class=""><a href="#"><span>Quantity</span></a></th>
                                <th class=""><a href="#"><span>Remaining</span></a></th>
                                <th class=""><a href="#"><span>Status</span></a></th>
                                <th class=""><a href="#"><span>Action</span></a></th>
                            </tr>
                        </thead>



                        <?php echo $this->element('delivery_table'); ?>  
                    </table>
              </div>
        </div>
    </div>
  </div>    

    
             
<?php echo $this->element('modals'); ?>

<style>
.margintop{
    margin-top : 10%; 
  }

.navbar,.nav-col{
  z-index: 0 !important;
}
#nav-col{
  z-index: 0 !important;
}

</style>    

