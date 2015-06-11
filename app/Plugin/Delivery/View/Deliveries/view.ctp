<?php echo $this->Html->script('Sales.quantityLimitDelivery');


$pushRemaining  = array();
$totaldifference = 0; 
$totalremaining = 0;?>
<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block pull-right marginDelivery">
               <?php   //pr($deliveryDetailsData['DeliveryDetail']['schedule']); 
                
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

                 <?php }}else{ 

                    $Scheddate = $scheduleInfo['ClientOrderDeliverySchedule']['schedule'];
                                        $Currentdate = date("Y-m-d H:i:s");

                                        $Scheddate = str_replace('-', '', $Scheddate);
                                        $Currentdate = str_replace('-', '', $Currentdate);  

                      if(strtotime($Scheddate) > strtotime($Currentdate)) { ?>

                       <a data-toggle="modal" href="#myModalApprove" class="btn btn-primary mrg-b-lg pull-right "><i class="fa fa-edit fa-lg"></i>Approve Schedule</a>

                <?php }} ?>

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

                                                        <?php

                                                         if (!empty($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']])) {   

                                                         if($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']] == 'Approved') { 
                                                        
                                                                  echo "<span class='label label-success'>Approved</span>"; ?> &nbsp

                                                    <?php         if(strtotime($Scheddate) < strtotime($Currentdate))
                                                                {
                                                                    echo "<span class='label label-warning'>Due</span>"; 
                                                                } 
                                                          
                                                             }
                                                         
                                                     }else{
                                                                echo "<span class='label label-default'>Waiting</span>"; ?> &nbsp


                                                    <?php                if(strtotime($Scheddate) < strtotime($Currentdate))
                                                                {
                                                                    echo "<span class='label label-warning'>Due</span>"; 
                                                                }  

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
                <?php 
                  



                ?>
                <h2><b class="pull-left">Delivery Schedule</b></h2>
              <?php if (!empty($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']])) { ;

                          if(($totalremaining) == 0) { 

                             if($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']] == 'Approved') { 
                        ?>
                                <a data-toggle="modal" href="#myModalDeliveries" class="btn btn-primary pull-right  "><i class="fa fa-edit fa-lg"></i> Add Schedule</a>

                <?php }}}?>
                 
            </header>

            <table class="table table-striped table-hover ">
                        <thead>
                            <tr >
                                <th class=""><a href="#"><span>Delivery Receipt #</span></a>  </th>
                                <th class=""><a href="#"><span>Schedule</span></a></th>
                                <th class=""><a href="#"><span>Location</span></a></th>
                                <th class=""><a href="#"><span>Quantity</span></a></th>
                                <th class=""><a href="#"><span>Delivered</span></a></th>
                                <th class=""><a href="#"><span>Status</span></a></th>
                                <th class=""><a href="#"><span>Action</span></a></th>
                            </tr>
                        </thead>



                        <?php   

//  pr($deliveryDetailsData);


  if(!empty($deliveryEdit)){
              ?>
      <?php  foreach ($deliveryEdit as $deliveryDataList): 
                ?>
                <tbody aria-relevant="all" aria-live="polite" role="alert">

                    <tr class="">

                        <td class="">
                              <?php echo $deliveryDataList['Delivery']['dr_uuid']; ?>
                        </td>

                        <td class="">

                            <?php echo date('M d, Y',strtotime($deliveryDataList['DeliveryDetail']['schedule'])); ?>
                        
                        </td>

                        <td class="">
              
                           <?php echo  $deliveryDataList['DeliveryDetail']['location']; ?>    
                           
                           
                        </td>

                        <td class="">

                            <?php 

                             $difference = $scheduleInfo['ClientOrderDeliverySchedule']['quantity'] - $deliveryDataList['DeliveryDetail']['quantity']; 

                            array_push($pushRemaining,$difference );
                    
                            echo  $deliveryDataList['DeliveryDetail']['quantity']; ?> <br>
    
                        </td>

                        <td class="">
                            
                            <?php if(empty($deliveryDataList['DeliveryDetail']['delivered_quantity'])){ 

                                 echo 0; }else{?> 

                                <?php echo $deliveryDataList['DeliveryDetail']['delivered_quantity']; ?>

                            <?php } 

                              $Quantity = $deliveryDataList['DeliveryDetail']['delivered_quantity'];  


                           ?>  

                        </td>

                        <td class="">
              
                           <?php  $Scheddate = $scheduleInfo['ClientOrderDeliverySchedule']['schedule'];
                                        $Currentdate = date("Y-m-d H:i:s");

                                        $Scheddate = str_replace('-', '', $Scheddate);
                                        $Currentdate = str_replace('-', '', $Currentdate); ?>  

                                        <?php  if (!empty($deliveryDataList[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']])) {  

                                                    if(strtotime($Scheddate) < strtotime($Currentdate))
                                                        {
                                                            echo "<span class='label label-success'>Due</span>"; 
                                                        }else{   

                                                     if($deliveryDataList[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']] == 'Approved') { 
                                                    
                                                              echo "<span class='label label-warning'>Delivering</span>";  

                                                  
                                                     }
                                                   }
                                                 }else{

                                                            echo "<span class='label label-default'>Delivering</span>";

                                           } ?>   
                            
                        </td>

                        <td>
                            <?php
                                echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit</font></span>
                                    </span> ', array('controller' => 'deliveries', 'action' => 'delivery_edit',$deliveryDataList['Delivery']['dr_uuid'], $scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                            ?>

                            <?php
                                echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-reply fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Return</font></span>
                                    </span> ', array('controller' => 'deliveries', 'action' => 'delivery_edit'),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                            ?>
                     
                            <?php  
                                echo $this->Html->link('<span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print </font></span>
                                </span>', array('controller' => 'deliveries', 'action' => 'print_dr',$deliveryDataList['Delivery']['dr_uuid'],$scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link','escape' => false,'title'=>'Print Delivery Receipt','target' => '_blank'));

                            ?>


                       </td>

                       

                       
                    </tr>

                </tbody>
        <?php 
          endforeach; 
  } 

  foreach ($pushRemaining as $key => $value) {
                    $totaldifference = $totaldifference + $value;
                  } 

  $totalremaining = $totaldifference - $scheduleInfo['ClientOrderDeliverySchedule']['quantity'];

  ?> 




                    </table>
                    <h2 class ='pull-right'>Remaining Quantity : <?php echo $totalremaining; ?> &nbsp&nbsp  </h2>
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

