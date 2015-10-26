<?php echo $this->element('deliveries_options'); ?><br><br>
<?php echo $this->Html->script('Sales.quantityLimitDelivery');
      echo $this->Html->script('Delivery.gatepass');
$pushRemaining  = array();
$totaldifference = 0; 
$totalremaining = 0;


?>
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

                
                <?php }else{ ?>

                     <!-- <a data-toggle="modal" href="#myModalDeliveries" class="btn btn-primary pull-right addSchedButton "><i class="fa fa-edit fa-lg"></i> Edit Schedule</a> -->

                <?php }}else{ ?>

                        <a data-toggle="modal" href="#myModalApprove" class="btn btn-primary mrg-b-lg pull-right "><i class="fa fa-edit fa-lg"></i>Approve Schedule</a>

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
                                        <td>Delivery Type</td>
                                        <td><?php echo  $scheduleInfo['ClientOrderDeliverySchedule']['delivery_type']; ?></td>
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
                                        <td>Total Quantity</td>
                                        <td>
                                            <?php  if(!empty($productSpecification['ProductSpecification']['quantity'])) : ?>
                                                <?php echo  number_format($productSpecification['ProductSpecification']['quantity'],2); ?>
                                            <?php endif; ?>
                                            <?php //echo $scheduleInfo['ClientOrderDeliverySchedule']['quantity']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Schedule Quantity</td>
                                        <td>
                                            <?php echo number_format($scheduleInfo['ClientOrderDeliverySchedule']['quantity'],2); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        <td><?php echo  substr($scheduleInfo['ClientOrderDeliverySchedule']['location'],0,25); ?></td>
                                    </tr>

                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <?php 
                                                $uuidClientsOrder = $scheduleInfo['ClientOrderDeliverySchedule']['uuid'];

                                                $arr = array();

                                                foreach ($deliveryStatus as $key => $value) {

                                                    $IdClientsOrder = $orderListHelper[$value['Delivery']['clients_order_id']];
                                                
                                                    if($value['Delivery']['schedule_uuid'] == $orderDeliveryList[$uuidClientsOrder]){  

                                                        if($value['DeliveryDetail']['status'] != 5){
                                                   
                                                        array_push($arr,$value['DeliveryDetail']['delivered_quantity']);

                                                     }

                                                    }  

                                                }

                                                $arrDelivered = array();

                                                foreach ($deliveryStatus as $key => $value) {

                                                  $DeliveredHolder = $deliveryDetailList[$value['Delivery']['dr_uuid']];
  
                                                    if($value['Delivery']['schedule_uuid'] == $orderDeliveryList[$uuidClientsOrder] AND $value['DeliveryDetail']['status'] != 5 ){  

                                                      array_push($arrDelivered,$DeliveredHolder);

                                                    }  

                                                }

                                                $sumDelivered = array_sum($arrDelivered);

                                                $Scheddate = $scheduleInfo['ClientOrderDeliverySchedule']['schedule'];
                                                
                                                $Currentdate = date("Y-m-d H:i:s");


                                                if (!empty($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']]) || !empty($deliveryList[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']])) {   

                                                    if (array_sum($arr) == $scheduleInfo['ClientOrderDeliverySchedule']['quantity']){ 

                                                        echo "<span class='label label-success'>Completed</span>";

                                                    }elseif ($sumDelivered == $scheduleInfo['ClientOrderDeliverySchedule']['quantity']){

                                                            echo "<span class='label label-success'>Delivered</span>";

                                                    }elseif ($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']] == '1') { 
                                                    
                                                         echo "<span class='label label-warning'>Approved</span>"; ?> &nbsp<?php
                                                    } 
  
                                                }else{

                                                    echo "<span class='label label-default'>Waiting</span>"; ?> &nbsp


                                                    <?php  
                                                     $Scheddate = date('Y-m-d',strtotime($Scheddate)).' 23:00:00';

                                                    if(strtotime($Currentdate) >= strtotime( $Scheddate ))
                                                    {
                                                        echo "<span class='label label-danger'>Due</span>"; 
                                                    } 

                                                     
                                            } ?>

                                        </td>
                                    </tr>
             
                                </tbody>
                        
                            </table>
                        </div>
                        <h9 class ='pull-right'>Date Created : <?php echo date('M d, Y', strtotime($scheduleInfo['ClientOrderDeliverySchedule']['modified'])); ?> &nbsp;&nbsp;  </h9>
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

                <div class="filter-block pull-right marginDelivery"></div>

                <header class="main-box-header clearfix ">

                    <h2><b class="pull-left">Delivery Schedule</b></h2>

                    <div class = "pull-right"> 

                    <?php if (!empty($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']])) { ;

                        if(($totalremaining) == 0) {

                            if($deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']] == '1' || $deliveryData[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']] == '2' ) { 


                                foreach ($deliveryEdit as $deliveryDataList): 

                                   // pr($deliveryDataList['DeliveryReceipt']['type']);

                                     if($deliveryDataList['DeliveryDetail']['status'] == 3 ){
                                        


                                        $difference = $deliveryDataList['DeliveryDetail']['delivered_quantity']; 

                                        array_push($pushRemaining,$difference );

                                    }else if ($deliveryDataList['DeliveryDetail']['status'] != 5){

                                        $difference = $deliveryDataList['DeliveryDetail']['quantity']; 

                                        array_push($pushRemaining,$difference );

                                    

                                    }

                                endforeach; 

                                foreach ($pushRemaining as $key => $value) {

                                    $totaldifference = $totaldifference + $value;

                                }             

                                if($totaldifference != 0){                
                           
                                    $totalremaining =  $scheduleInfo['ClientOrderDeliverySchedule']['quantity'] - $totaldifference;

                                }else{

                                    $totalremaining = $scheduleInfo['ClientOrderDeliverySchedule']['quantity'];
                                }

                                if($totalremaining != 0){ ?>

                                     &nbsp;

                                    <a data-toggle="modal" href="#myModalDeliveries" class="btn btn-primary   "><i class="fa fa-edit fa-lg"></i> Add Schedule</a>


                    <?php  }  } } } ?>
                    &nbsp; 
                    <?php 

                    if(!empty($deliveryDataList['Delivery']['company_id'])){

                        echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Create Gate Pass', array('controller' => 'deliveries', 'action' => 'gate_pass',$deliveryScheduleId,$quotationId,$clientsOrderUuid,$deliveryDataList['Delivery']['company_id']),array('class' =>' btn btn-primary ','escape' => false,'title'=>'Gate Pass'));
                    }

                    ?>
                    </div>

                         &nbsp; 

                </header>

                <table class="table table-striped table-hover ">
                    <thead>
                        <tr >
                            <th class=""><a href="#"><span>Delivery Receipt #</span></a>  </th>
                            <th class=""><a href="#"><span>Schedule</span></a></th>
                            <th class=""><a href="#"><span>P.O. Quantity</span></a></th>
                            <th class=""><a href="#"><span>Delivered</span></a></th>
                            <th class=""><a href="#"><span>Replaced</span></a></th>
                            <th class=""><a href="#"><span>Status</span></a></th>
                            <th class=""><a href="#"><span>Action</span></a></th>
                        </tr>
                    </thead>

                    <?php  if(!empty($deliveryEdit) ) { ?>
                        <?php  foreach ($deliveryEdit as $deliveryDataList): ?>

                            <tbody aria-relevant="all" aria-live="polite" role="alert">

                                <tr class="">

                                    <td class="">
                                          <?php echo $deliveryDataList['Delivery']['dr_uuid']; ?>
                                    </td>

                                    <td class="">
                                        <?php echo date('M d, Y',strtotime($deliveryDataList['DeliveryDetail']['schedule'])); ?>
                                    </td>

                                    <td class="">

                                        <?php 

                                            $difference = $deliveryDataList['DeliveryDetail']['quantity']; 

                                            array_push($pushRemaining,$difference );
                                    
                                            echo  $deliveryDataList['DeliveryDetail']['quantity']; 
                                        ?> <br>
                                    </td>

                                    <td class="">
                            
                                        <?php if(empty($deliveryDataList['DeliveryDetail']['delivered_quantity'])){ 

                                            echo 0; 
                                        }else{?> 

                                            <?php echo $deliveryDataList['DeliveryDetail']['delivered_quantity']; ?>

                                        <?php } ?>  

                                    </td>

                                    <td class="">

                                        <?php if(!empty($deliveryDataList['Delivery']['from'])){ ?>

                                        DR#<?php echo  $deliveryDataList['Delivery']['from'];  }?> 

                                    </td>

                                    <td class="">
              
                                        <?php  

                                            if (!empty($deliveryDataList['DeliveryDetail']['status'])) {  

                                                if($deliveryDataList['DeliveryDetail']['status'] == '4'){

                                                    echo "<span class='label label-success'>Delivered</span>"; 

                                                }else if($deliveryDataList['DeliveryDetail']['status'] == '2'){   

                                                    echo "<span class='label label-info'>Incomplete</span>";  

                                                }else if($deliveryDataList['DeliveryDetail']['status'] == '3'){

                                                     echo "<span class='label label-success'>Delivered</span>"; 

                                                }else if($deliveryDataList['DeliveryDetail']['status'] == '5'){

                                                     echo "<span class='label label-danger'>Terminated</span>"; 

                                                }else if($deliveryDataList['DeliveryDetail']['status'] == '11'){

                                                     echo "<span class='label label-info'>Replaced</span>"; 

                                                }

                                            }else{

                                                echo "<span class='label label-warning'>Pending</span>"; 

                                            } 
                                        ?>   
                            
                                    </td>

                                    <td >

                                    <?php 

                                    $dr_holder = null;

                                        foreach ($DeliveryReceiptData as $key) {

                                            if($key['DeliveryReceipt']['dr_uuid'] == $deliveryDataList['Delivery']['dr_uuid']){

                                                  $dr_holder = 'matched';

                                                  break;

                                                }else{

                                                  $dr_holder = 'not matched';
     
                                                }

                                            } 

                                        if($deliveryDataList['DeliveryDetail']['status'] == '3' || $deliveryDataList['DeliveryDetail']['status'] == '5'){

                                            echo $this->Html->link('<span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit</font></span>
                                                </span> ', array('controller' => 'deliveries', 'action' => 'delivery_edit',$deliveryDataList['Delivery']['dr_uuid'], $scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link not-active','escape' => false,'title'=>'Review Inquiry'));

                                            echo $this->Html->link('<span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print </font></span>
                                                </span>', array('controller' => 'deliveries', 'action' => 'dr',$deliveryDataList['Delivery']['dr_uuid'],$scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link not-active refresh','escape' => false,'title'=>'Print Delivery Receipt')); ?>

                                            <a data-toggle="modal" href="#myModalReturn<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" class="table-link not-active"><i class="fa fa-lg "></i><span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x "></i>
                                            <i class="fa  fa-mail-reply fa-stack-1x fa-inverse "></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delivered </font></span></a>

                                           
                                            <?php 
                                                // echo $this->Html->link('<span class="fa-stack gatePass">
                                                //     <i class="fa fa-square fa-stack-2x"></i>
                                                //     <i class="fa fa-truck fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> GatePass</font></span>
                                                //     </span> ', array('controller' => 'deliveries', 'action' => 'gate_pass',$deliveryScheduleId, $quotationId,$clientsOrderUuid,$deliveryDataList['Delivery']['id'],$deliveryDataList['Delivery']['dr_uuid']),array('class' =>' table-link not-active','escape' => false,'title'=>'Gate Pass'));

                                        }else{


                                        if($dr_holder == 'matched'){

                                            echo $this->Html->link('<span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit</font></span>
                                                </span> ', array('controller' => 'deliveries', 'action' => 'delivery_edit',$deliveryDataList['Delivery']['dr_uuid'], $scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link not-active','escape' => false,'title'=>'Review Inquiry'));

                                            if($scheduleInfo['ClientOrder']['company_id'] == '1223'){        

                                                    echo $this->Html->link('<span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> APC</font></span>
                                                        </span>', array('controller' => 'deliveries', 'action' => 'apc',$deliveryDataList['Delivery']['dr_uuid'],$scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link  ','escape' => false,'title'=>'Print Delivery Receipt')); 
                                                }    
                              
                                            echo $this->Html->link('<span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print </font></span>
                                                </span>', array('controller' => 'deliveries', 'action' => 'dr',$deliveryDataList['Delivery']['dr_uuid'],$scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link  refresh','escape' => false,'title'=>'Print Delivery Receipt')); 

                                            ?>

                                             <a data-toggle="modal" href="#myModalReturn<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" class="table-link"><i class="fa fa-lg "></i><span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x "></i>
                                            <i class="fa  fa-mail-reply fa-stack-1x fa-inverse "></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Update </font></span></a> <?php

                                        }else{


                                            echo $this->Html->link('<span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit</font></span>
                                                </span> ', array('controller' => 'deliveries', 'action' => 'delivery_edit',$deliveryDataList['Delivery']['dr_uuid'], $scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                                        
                                                if($scheduleInfo['ClientOrder']['company_id'] == '1223'){        

                                                    echo $this->Html->link('<span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> APC</font></span>
                                                        </span>', array('controller' => 'deliveries', 'action' => 'apc',$deliveryDataList['Delivery']['dr_uuid'],$scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link  ','escape' => false,'title'=>'Print Delivery Receipt')); 
                                                }       

                                            echo $this->Html->link('<span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print </font></span>
                                                </span>', array('controller' => 'deliveries', 'action' => 'dr',$deliveryDataList['Delivery']['dr_uuid'],$scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link refresh','escape' => false,'title'=>'Print Delivery Receipt')); 

                                                ?>

                                        <a data-toggle="modal" href="#myModalReturn<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" class="table-link not-active"><i class="fa fa-lg "></i><span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x "></i>
                                            <i class="fa  fa-mail-reply fa-stack-1x fa-inverse "></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Update </font></span></a> <?php 

                                       } 


                                             }?>


                                            <?php //$deliveryScheduleId = null, $quotationId = null, $clientsOrderUuid = null, $clientUuid = null)

                                              // echo $this->Html->link('<span class="fa-stack">
                                              //               <i class="fa fa-square fa-stack-2x"></i>
                                              //               <i class="fa fa-trash fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                                              //               </span> ', array('controller' => 'deliveries', 
                                              //                 'action' => 'remove_dr_sched',
                                              //                 $deliveryDataList['Delivery']['dr_uuid'],
                                              //                 $deliveryScheduleId,
                                              //                 $quotationId,
                                              //                 $clientsOrderUuid,
                                              //                 $clientUuid

                                              //                 ),
                                              //               array(
                                              //                   'label' => false,
                                              //                 'class' =>' table-link',
                                              //                 'escape' => false,'title'=>'Edit Information',
                                              //                 'confirm' => 'Are you sure you want to delete this schedule ? ',
                                              //                 'style' => 'margin-left:27px;'
                                              //                 ));
                                            ?>

                                                                    
                                    </td>
                                </tr>
                            </tbody>

                            <div class="modal fade" id="myModalReturn<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" role="dialog" >
                                <div class="modal-dialog">
                                    <div class="modal-content margintop">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Delivered P.O. Quantity</h4>
                                        </div> 

                                        <div class="modal-body">

                                            <?php 

                                                echo $this->Form->create('ClientOrderDeliverySchedule',array(
                                                    'url'=>(array('controller' => 'deliveries','action' => 'delivery_return',$scheduleInfo['ClientOrderDeliverySchedule']['id'],$scheduleInfo['QuotationDetail']['quotation_id'], $scheduleInfo['ClientOrderDeliverySchedule']['uuid'],$clientUuid) ),'class' => 'form-horizontal')); 
                                            ?>

                                                <div class="form-group" id="existing_items">
                                                    <label class="col-lg-2 control-label">D.R. #</label>
                                                    <div class="col-lg-9">

                                                        <?php 
                                                            echo $this->Form->input('Delivery.dr_uuid', array(
                                                                'class' => 'form-control item_type editable required',
                                                                'label' => false,
                                                                'required' => 'required',
                                                                'readonly' => 'readonly',
                                                                'value' => $deliveryDataList['Delivery']['dr_uuid']
                                                                ));

                                                            echo $this->Form->input('DeliveryDetail.id', array(
                                                                'class' => 'form-control item_type editable required',
                                                                'label' => false,
                                                                'required' => 'required',
                                                                'readonly' => 'readonly',
                                                                'value' => $deliveryDataList['DeliveryDetail']['id']
                                                                ));

                                                            echo $this->Form->input('DeliveryDetail.quantity', array(
                                                                'class' => 'form-control item_type editable required maxQuantity',
                                                                'label' => false,
                                                                'type' => 'hidden',
                                                                'readonly' => 'readonly',
                                                                'value' => $deliveryDataList['DeliveryDetail']['quantity']
                                                                
                                                                ));
                                                        ?>

                                                    </div>
                                                </div>
                                                <br><br>

                                                <div class="form-group" id="existing_items">
                                                    <label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
                                                    <div class="col-lg-9">

                                                        <?php 

                                                            echo $this->Form->input('DeliveryDetail.delivered_quantity', array(
                                                                'empty' => 'None',
                                                                'required' => 'required',
                                                                'class' => 'form-control item_type editable limitQuantity',
                                                                'label' => false,
                                                                'value' => $deliveryDataList['DeliveryDetail']['quantity']
                                                                ));

                                                        ?>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                                </div>
                                            <?php echo $this->Form->end();  ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="md-overlay"></div>
                    <?php endforeach; }  ?> 
                </table>
                   
                <h2 class ='pull-right'>Remaining Balance : <?php echo $totalremaining; ?> &nbsp;&nbsp;  </h2>
        
            </div>
        </div>
    </div>
</div>   

<?php 

     echo $this->element('modals',array(
        'clientsOrderUuid' => $clientsOrderUuid, 
        'deliveryScheduleId' => $deliveryScheduleId,
        'quotationId' => $quotationId,
        'clientUuid' => $clientUuid
        ));

 ?>

 
<script>
    
    jQuery(document).ready(function(){

        $("#GatePassViewForm").validate();
        $("#ClientOrderDeliveryScheduleViewForm").validate();
        $('.datepick').datepicker({
            format: 'yyyy-mm-dd'
        });
        
    });

    $('.refreshg').on("click",function(){
        
       setTimeout(function (){
            location.reload();
        }, 1000); 
        
    });



</script>


