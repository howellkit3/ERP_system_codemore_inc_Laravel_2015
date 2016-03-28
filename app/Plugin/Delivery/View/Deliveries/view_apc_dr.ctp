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
                
                    // echo $this->Html->link('<i class="fa  fa-arrow-left fa-lg "></i> Back ', 
                    //     array('controller' => 'deliveries', 
                    //         'action' => 'index'
                    //         ),
                    //     array('class' =>'btn btn-primary pull-right',
                    //         'escape' => false));
                ?>  
                <br><br>
            </div>
   
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>APC delivery</b></h2>
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="main-box clearfix">
                            <table class="table table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td>APC Number</td>
                                        <td><?php echo '# '.$apcDr['ApcDelivery']['apc_dr']; ?></td>
                                    </tr>
                                     <tr>
                                        <td>Customer</td>
                                        <td><?php echo $apcDr['Company']['company_name']; ?></td>
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
                                        <td> Plant : </td>
                                        <td><?php echo !empty($apcDr['Plant']['id']) ? $apcDr['Plant']['name'] : '' ?></td>
                                    </tr>
                                     <tr>
                                        <td> Schedule </td>
                                        <td> <?php echo !empty($apcDr['ClientOrderDeliverySchedule']['schedule']) ?  date('Y/m/d',strtotime($apcDr['ClientOrderDeliverySchedule']['schedule'])) : ''?> </td>
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

                    <h2><b class="pull-left"> ITEMS </b></h2>

                    <div class = "pull-right"> 

                  
                    </div>

                </header>

                <table class="table table-striped table-hover ">
                    <thead>
                        <tr >
                            <th class=""><a href="#"><span>ITEM</span></a>  </th>
                            <th class=""><a href="#"><span>Customer PO</span></a></th>
                            <th class=""><a href="#"><span>Qty</span></a></th>
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
              
            </div>
        </div>
    </div>



</div>   

