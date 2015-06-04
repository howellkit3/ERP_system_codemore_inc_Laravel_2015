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

                  <?php
                
                  echo $this->Html->link('<i class="fa fa-check-square fa-lg "></i> Approve Schedule ', 
                        array('controller' => 'deliveries', 
                            'action' => 'add', $scheduleInfo['ClientOrderDeliverySchedule']['id']
                            ),
                        array('class' =>'btn btn-primary pull-right',
                            'escape' => false));
                ?>  


                  <a data-toggle="modal" href="#myModalDelivery" class="btn btn-primary mrg-b-lg pull-right addSchedButton "><i class="fa fa-edit fa-lg"></i> Edit Schedule</a>

                <?php } ?>

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

                <h2 class="pull-left"><b>Delivery Schedule</b></h2>
                
            </header>
            
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
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
                                  <td>

                                     <?php    $Scheddate = $scheduleInfo['ClientOrderDeliverySchedule']['schedule'];
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
                    <hr>
                </div>
            </div>
            
            
        </div>
    </div>
</div>

<?php echo $this->element('modals'); ?>