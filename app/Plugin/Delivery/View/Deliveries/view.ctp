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

                <?php  if (empty($deliveryEdit)) { ?> 

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
                                        <td>Schedule Number</td>
                                        <td><?php echo  $clientsOrder['JobTicket']['uuid']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Client Number</td>
                                        <td><?php echo  $clientsOrder['ClientOrder']['uuid']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Delivery Type</td>
                                        <td><?php echo  $clientsOrder['ClientOrderDeliverySchedule']['delivery_type']; ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>P.O. Number</td>
                                        <td><?php echo  $clientsOrder['ClientOrder']['po_number']; 
                                       ?></td>
                                    </tr>

                                    <tr>
                                        <td>Customer Name</td>
                                        <td><?php echo  $clientsOrder['Company']['company_name']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Item Name</td>
                                        <td><?php echo  $clientsOrder['Product']['name']; ?></td>
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
                                        <td>Delivery Schedule</td>
                                        <td><?php echo date('M d, Y', strtotime($clientsOrder['ClientOrderDeliverySchedule']['schedule'])); ?></td>
                                    </tr>
                                     <tr>
                                        <td>Total Quantity</td>
                                        <td>
                                            <?php  if(!empty($clientsOrder['QuotationItemDetail']['quantity'])) : ?>
                                                <?php echo  number_format($clientsOrder['QuotationItemDetail']['quantity'],2); ?>
                                            <?php endif; ?>
                                            <?php //echo $scheduleInfo['ClientOrderDeliverySchedule']['quantity']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Schedule Quantity</td>
                                        <td>
                                            <?php echo number_format($clientsOrder['ClientOrderDeliverySchedule']['quantity'],2); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        <td><?php echo  substr($clientsOrder['ClientOrderDeliverySchedule']['location'],0,25); ?></td>
                                    </tr>

                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <?php 
                                                $uuidClientsOrder = $clientsOrder['ClientOrderDeliverySchedule']['uuid'];

                                                $arr = $deliveryStatus = array();

                                                $checkItem = $this->DeliveryFunction->getbyScheduleID($uuidClientsOrder);


                                                foreach ($checkItem as $key => $inner) {
                                                  
                                                    if($inner['DeliveryDetail']['status'] != 5 && $inner['Delivery']['status'] != 2 ){
                                                        array_push($arr,$inner['DeliveryDetail']['delivered_quantity']);
                                                      }

                                                       $deliveryStatus[] = $inner['Delivery']['status'];
                                                  }  

                                                  //echo(array_sum($arrholder));

                                                $arrDelivered = array();

                                                foreach ($checkItem as $key => $value) {
                                                    
                                                    $DeliveredHolder = $value['DeliveryDetail']['delivered_quantity'];

                                                    if ($value['DeliveryDetail']['status'] != 5) {
                                                        array_push($arrDelivered,$DeliveredHolder);
                                                      }
                                                }  

                                                // foreach ($deliveryStatus as $key => $value) {

                                                //   $DeliveredHolder = $value['DeliveryDetail']['delivered_quantity'];
  
                                                //     if($value['Delivery']['schedule_uuid'] == $uuidClientsOrder AND $value['DeliveryDetail']['status'] != 5  ){  

                                                //       array_push($arrDelivered,$DeliveredHolder);

                                                //     }  
                                                // }

                                                $sumDelivered = array_sum($arrDelivered);

                                                $Scheddate = $clientsOrder['ClientOrderDeliverySchedule']['schedule'];
                                                
                                                $Currentdate = date("Y-m-d H:i:s");

                                                if (!empty($checkItem)) {   

                                                    if (array_sum($arr) == $clientsOrder['ClientOrderDeliverySchedule']['quantity']){ 

                                                        echo "<span class='label label-success'>Completed</span>";

                                                    }elseif ($sumDelivered == 0 || $value['Delivery']['status'] == '1') { 
                                                    
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

                                    <tr>
                                        <td>Date Created</td>
                                        <td>
                                            <?php echo date('M d, Y', strtotime($clientsOrder['ClientOrderDeliverySchedule']['modified'])); ?></td>
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

                <div class="filter-block pull-right marginDelivery"></div>

                <header class="main-box-header clearfix ">

                    <h2><b class="pull-left">Delivery Schedule</b></h2>

                    <div class = "pull-right"> 

                    <?php 
                    if (!empty($deliveryEdit)) : 
                    foreach ($deliveryEdit as $deliveryDataList): 


                                     if($deliveryDataList['DeliveryDetail']['status'] == 3 && $deliveryDataList['Delivery']['status'] == 1){
                                        
                                        $difference = $deliveryDataList['DeliveryDetail']['delivered_quantity']; 

                                        array_push($pushRemaining,$difference );

                                    }else if ($deliveryDataList['DeliveryDetail']['status'] != 5 && $deliveryDataList['Delivery']['status'] == 1){

                                        $difference = $deliveryDataList['DeliveryDetail']['quantity']; 

                                        array_push($pushRemaining,$difference );

                                    }

                                endforeach; 

                                foreach ($pushRemaining as $key => $value) {

                                    $totaldifference = $totaldifference + $value;

                                }             

                                if($totaldifference != 0){                
                           
                                    $totalremaining =  $clientsOrder['ClientOrderDeliverySchedule']['quantity'] - $totaldifference;

                                }else{

                                    $totalremaining = $clientsOrder['ClientOrderDeliverySchedule']['quantity'];
                                }

                                if($totalremaining != 0 && !empty($deliveryEdit)){ ?>
                                     &nbsp;

                                    <a data-toggle="modal" href="#myModalDeliveries" class="btn btn-primary   "><i class="fa fa-edit fa-lg"></i> Add Schedule</a>


                             <?php  } ?>
                    <?php endif; ?>
                    &nbsp; 
                    <?php 
                   // pr($deliveryDataList); exit;
                    if(!empty($deliveryDataList['DeliveryReceipt']['id'])){

                        echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Create Gate Pass', array('controller' => 'deliveries', 'action' => 'gate_pass',$deliveryScheduleId,$clientsOrderUuid,$deliveryDataList['Delivery']['company_id'],$clientUuid),array('class' =>' btn btn-primary ','escape' => false,'title'=>'Gate Pass'));
                    }

                    ?>
                    </div>

                         &nbsp; 

                </header>

                <table class="table table-striped table-hover ">
                    <thead>
                        <tr >
                            <th class=""><a href="#"><span>Delivery Receipt #</span></a>  </th>
                            <th class=""><a href="#"><span>Delivery Date</span></a></th>
                            <th class=""><a href="#"><span>P.O. Quantity</span></a></th>
                            <th class=""><a href="#"><span>Delivered</span></a></th>
                            <th class=""><a href="#"><span>Replaced</span></a></th>
                            <th class=""><a href="#"><span>Status</span></a></th>
                            <th class="actions"><a href="#"><span>Action</span></a></th>
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

                                                if($deliveryDataList['DeliveryDetail']['status'] == '4' && $deliveryDataList['Delivery']['status'] == '2'){

                                                    echo "<span class='label label-danger'>Deleted</span>"; 
                                                }

                                                else if($deliveryDataList['DeliveryDetail']['status'] == '4'){

                                                    echo "<span class='label label-success'>Delivered</span>"; 

                                                }else if($deliveryDataList['DeliveryDetail']['status'] == '2'){   

                                                    echo "<span class='label label-info'>Incomplete</span>";  

                                                }else if($deliveryDataList['DeliveryDetail']['status'] == '3' ){

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

                                    if($deliveryDataList['Delivery']['status'] != '2'){

                                        if(!empty($deliveryDataList['DeliveryReceipt']['dr_uuid'])){

                                            $activeStatus = "not-active";
                                            $updateStatus = ($deliveryDataList['DeliveryDetail']['status'] == 3) ? "not-active" : "active";
                                            $deleteStatus = ($deliveryDataList['DeliveryDetail']['status'] == 3) ? "active" : "not-active";

                                        }else{

                                            $activeStatus = "active";
                                            $updateStatus = "not-active";
                                            $deleteStatus = "not-active";
     
                                        }

                                    }else{

                                            $activeStatus = "not-active";
                                            $updateStatus = "not-active";
                                            $deleteStatus = "not-active";

                                    }

                                        echo $this->Html->link('<span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-pencil  fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit</font></span>
                                                </span>', array('controller' => 'deliveries', 'action' => 'delivery_edit',$deliveryDataList['Delivery']['dr_uuid'], $clientsOrder['ClientOrderDeliverySchedule']['uuid'],0,
                                                  'delivery_id' =>  $deliveryDataList['DeliveryDetail']['delivery_id']
                                                    ),array('class' =>' table-link '. $activeStatus,'escape' => false,'title'=>'Review Inquiry'));

                                        if($clientsOrder['ClientOrder']['company_id'] == '1223' || $clientsOrder['ClientOrder']['company_id'] =='3' || $clientsOrder['ClientOrder']['company_id'] == '4' || $clientsOrder['ClientOrder']['company_id'] == '5' || $clientsOrder['ClientOrder']['company_id'] == '6' || $clientsOrder['ClientOrder']['company_id'] =='60' || $clientsOrder['ClientOrder']['company_id'] == '102' ){
                                            
                                            // echo $this->Html->link('<span class="fa-stack">
                                            //             <i class="fa fa-square fa-stack-2x"></i>
                                            //             <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> APC</font></span>
                                            //             </span>', array('controller' => 'deliveries', 'action' => 'multiple_apc',$deliveryDataList['Delivery']['dr_uuid'],$clientsOrder['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link ','escape' => false,'title'=>'Print Delivery Receipt',
                                            //                 'data-delivery-id' => $deliveryDataList['Delivery']['id'],
                                            //         'data-dr-uuid' =>  $deliveryDataList['Delivery']['dr_uuid']
                                            //                 ));

                                            echo $this->Html->link('<span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> APC</font></span>
                                                        </span>','#apcPreview',array(
                                                            'escape' => false,
                                                            'data-toggle' => 'modal',
                                                            'data-delivery-id' => $deliveryDataList['Delivery']['id'],
                                                            'data-uuid' => $deliveryDataList['Delivery']['dr_uuid'],
                                                            'data-apc' => $deliveryDataList['DeliveryDetail']['apc_dr'],
                                                            'id' => 'DeliveryReview'
                                                        ));
                                        }

                                        echo $this->Html->link('<span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print </font></span>
                                                </span>', '#printDelivery',array('class' =>' table-link  refresh print_delivery ',
                                                    'escape' => false,
                                                    'title'=>'Print Delivery Receipt',
                                                    'data-toggle' => 'modal',
                                                    'data-delivery-id' => $deliveryDataList['Delivery']['id'],
                                                    'data-dr-uuid' =>  $deliveryDataList['Delivery']['dr_uuid']
                                                    ));  

                                         ?>

                                            <a data-toggle="modal" href="#myModalReturn<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" class="table-link <?php echo $updateStatus ?>"><i class="fa fa-lg "></i><span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x "></i>
                                            <i class="fa  fa-mail-reply fa-stack-1x fa-inverse "></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Update </font></span></a> <?php

                                            echo $this->Html->link('<span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span></span> ', array('controller' => 'deliveries', 'action' => 'remove_dr_sched', $deliveryDataList['Delivery']['dr_uuid'], $deliveryScheduleId,$clientsOrderUuid,$clientUuid ),
                                                            array( 'label' => false,'class' =>' table-link','escape' => false,'title'=>'Edit Information', 'confirm' => 'Are you sure you want to delete this schedule ? '
                                                              ));

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
                                                    'url'=>(array('controller' => 'deliveries','action' => 'delivery_return',$clientsOrder['ClientOrderDeliverySchedule']['id'], $clientsOrder['ClientOrderDeliverySchedule']['uuid'],$clientUuid) ),'class' => 'form-horizontal')); 
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


 <div class="modal fade" id="apcPreview" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content margintop">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">APC DELIVERY RECIEPT</h4>
                </div>
                    <div class="modal-body">
                        <div class="result"></div>

                        <div class="planes">

                            <?php echo $this->Form->input('plant_id',array(
                                'options' => $plants,
                                'class' => 'form-control'
                            )) ?>
                        </div>


                            <br>
                        <div class="modal-footer">
                            <a href="/delivery/">
                             <a class="print_dr" href="#">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-print fa-lg"></i> Print </button>
                         </a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                   
                    <?php echo $this->Form->end(); ?>   
                </div>
                
            </div>
        </div>
    </div>


 
<?php 

     echo $this->element('modals',array(
        'clientsOrderUuid' => $clientsOrderUuid, 
        'deliveryScheduleId' => $deliveryScheduleId,
        'clientUuid' => $clientUuid
        ));

 ?>

 
<script>

    $('#DeliveryReview').click(function(){

        $appendCont = $('#apcPreview .result');

        $drID = $(this).attr('data-delivery-id');
        
        $drUuID = $(this).attr('data-uuid');

        $apcDr = $(this).attr('data-apc');
        
        $plantId = $('#plant_id').val();
        //singe
        $url = serverPath + 'delivery/deliveries/multiple_apc';

        $.ajax({
        url: serverPath + "delivery/deliveries/check_apc_to_print",
        type: "POST",
        data: {"dr_id": $drID , "dr_uuid": $drUuID , 'plant' : $plantId, 'apc_dr' :  $apcDr },
        dataType: "json",
        success: function(data) {

             for (var i in data.result) {

                     var newData = data.result[i];
               }

            $html  = '<div class="content">';
            $html  += '<div class="count"> There are <span class="label label-success">'+data.total+'</span> Item on this DR </div>';
            $html += '<div class="clients"><ul>';

             $.each(data.result, function(key, value){

                 $html += '<li> CLient Order :' + value.Delivery.clients_order_id + '</li>';

            });
            $html += '</ul></div>';
            $html += '<div>';

            $appendCont.html($html);

            // if (data.multiple == true) {

            //     $('.print_dr').attr('href',$multiple_print+'/'+newData.Delivery.dr_uuid);
            // } else { 

                $('.print_dr').attr('data-uuid',newData.Delivery.dr_uuid);

                $('.print_dr').attr('data-sched-id',newData.Delivery.schedule_uuid);

                $('.print_dr').attr('href',$url+'/'+newData.Delivery.dr_uuid+'/'+newData.Delivery.schedule_uuid+'/'+ $plantId+'/'+newData.DeliveryDetail.apc_dr);
           // }
              
            }
        });


    });

    $('#plant_id').change(function(){

        $url = serverPath + 'delivery/deliveries/multiple_apc';

        $drUuID = $('.print_dr').data('uuid');

        $sched = $('.print_dr').data('sched-id');

        $('.print_dr').attr('href',$url+'/'+$drUuID+'/'+$sched+'/'+ $(this).val());
    });
    
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

    $('.print_delivery').click(function(e){

        $appendCont = $('#printDelivery .result');

        $drID = $(this).attr('data-delivery-id');
        $drUuID = $(this).attr('data-dr-uuid');


        //multiple 

        //singe
        $single_print = serverPath + 'delivery/deliveries/dr';
        $multiple_print = serverPath + 'delivery/deliveries/multiple_dr';

        $.ajax({
        url: serverPath + "delivery/deliveries/check_dr_to_print",
        type: "POST",
        data: {"dr_id": $drID , "dr_uuid": $drUuID  },
        dataType: "json",
        success: function(data) {

             for (var i in data.result) {

                     var newData = data.result[i];
               }

            $html  = '<div class="content">';
            $html  += '<div class="count"> There are <span class="label label-success">'+data.total+'</span> Item on this DR </div>';
            $html += '<div class="clients"><ul>';

             $.each(data.result, function(key, value){

                 $html += '<li> CLient Order :' + value.Delivery.clients_order_id + '</li>';

            });
            $html += '</ul></div>';
            $html += '<div>';

            $appendCont.html($html);


            if (data.multiple == true) {

                try  {
                    if (newData.DeliveryDetail.apc_dr != '') {
                        $('.print_dr').attr('href',$multiple_print+'/'+newData.Delivery.dr_uuid+'/'+newData.DeliveryDetail.apc_dr); 
                     }
                } catch(err) {
                     $('.print_dr').attr('href',$multiple_print+'/'+newData.Delivery.dr_uuid);
                }
               

            } else {

                $('.print_dr').attr('href',$single_print+'/'+newData.Delivery.dr_uuid+'/'+newData.Delivery.schedule_uuid+'/'+newData.ClientOrder.ClientOrder.id);
            }
              
            }
        });


    });



</script>


