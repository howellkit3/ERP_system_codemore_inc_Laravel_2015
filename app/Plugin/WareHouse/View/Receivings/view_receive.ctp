<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php  echo $this->element('ware_house_option');?>

    <div class="filter-block pull-right">
    <?php 

        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i>  Go Back ', array('controller' => 'receivings','action' => 'receive'),array('class' =>'btn btn-primary pull-right','escape' => false)); 
            ?> &nbsp;

          <?php  if($receivedItemData['DeliveredOrder']['status_id'] != 1) {
                if ($receivedItemData['DeliveredOrder']['status_id'] != 13){    
        
            echo $this->Html->link('<i class="fa fa-check fa-lg"></i> Approve ', array('controller' => 'receivings','action' => 'purchase_approve', $deliveredDataID),array('class' =>'btn btn-primary  pull-right' ,'escape' => false));  
            }
        }  ?>   

        <?php  if ($receivedItemData['DeliveredOrder']['status_id'] != 13){  ?>

        <a data-toggle="modal" href="#myModalInRecord<?php echo $receivedItemData['DeliveredOrder']['id'] ?>" class="btn btn-primary mrg-b-lg pull-right addSchedButton "><i class="fa fa-plus-circle fa-lg tobeTrigger"></i> In Record</a>
    
        <?php } ?>

    <br><br>
</div>
    
<br><br>

<div class="row">
    <div class="col-lg-12">
        
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                    
                            
                </header>

            </div>
        </div>
                <?php echo $this->Form->create('PurchaseOrder',array('url'=>(array('controller' => 'receivings','action' => 'receive_items'))));?>      

        <div class="row">
            <div class="col-lg-12">
                <div class="main-box" >
                    <header class="main-box-header clearfix" >

                        <h2 class="pull-left"><b>Purchase Order Details</b></h2>
                        
                    </header>

                    <div class="top-space"></div>                       
                    <div class="main-box-body clearfix">
                        <div class="main-box-body clearfix">
                            <div class="form-horizontal">                                   

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Supplier</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('PurchaseOrder.quantity', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'disabled' => true,
                                                                            'fields' =>array('name'),
                                                                            'value' => ucwords(empty($receivedItemData['ReceivedOrder']['supplier_id']) ? $supplierData[$receivedItemData['PurchaseOrder']['supplier_id']] : $supplierData[$receivedItemData['ReceivedOrder']['supplier_id']])));
                                        ?>
                                    </div>
                                </div>

                                <?php if(!empty($receivedItemData['ReceivedOrder']['dr_num'])){?>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Delivery Number</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('ReceivedItems.dr_num', array(
                                                                    'class' => 'form-control item_type',
                                                                    'label' => false,
                                                                    'disabled' => true,
                                                                     'value' => !empty($receivedItemData['DeliveredOrder']['dr_num']) ? $receivedItemData['DeliveredOrder']['dr_num'] : " "));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Sales Invoice Number</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('ReceivedItems.dr_num', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'disabled' => true,
                                                                             'value' => !empty($receivedItemData['DeliveredOrder']['dr_num']) ? $receivedItemData['DeliveredOrder']['si_num'] : " "));
                                        ?>
                                    </div>
                                </div>

                                <?php }?>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">P.O. Number</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('PurchaseOrder.quantity', array(
                                                                    'class' => 'form-control item_type',
                                                                    'label' => false,
                                                                    'disabled' => true,
                                                                    'fields' =>array('name'),
                                                                    'value' => !empty($receivedItemData['DeliveredOrder']['purchase_order_uuid']) ? $receivedItemData['DeliveredOrder']['purchase_order_uuid'] : $receivedItemData['ReceivedOrder']['purchase_order_uuid']));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Purchase Order Created</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('PurchaseOrder.schedule', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'disabled' => true,
                                                                            'value' => date("F j, Y ", strtotime(!empty($receivedItemData['PurchaseOrder']['created']) ? $receivedItemData['PurchaseOrder']['created'] : $receivedItemData['ReceivedOrder']['created'])),
                                                                            'fields' =>array('name')));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Created by</label>
                                    <div class="col-lg-8">
                                        <?php  

                                            $nameHolder = !empty($purchaseOrderData['PurchaseOrder']['created_by']) ? $purchaseOrderData['PurchaseOrder']['created_by'] : $receivedItemData['ReceivedOrder']['received_by'];

                                            $Fname = ucfirst($firstName[$nameHolder]); 

                                            $Lname = ucfirst($lastName[$nameHolder]);

                                            echo $this->Form->input('PurchaseOrder.createdBy', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'disabled' => true,
                                                                            'fields' =>array('name'),
                                                                            'value' => $Fname . " " . $Lname));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Remarks</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->textarea('PurchaseOrder.remarks', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'disabled' => true,
                                                                            'fields' =>array('name'),
                                                                            'value' => !empty($purchaseOrderData['PurchaseOrder']['remarks']) ? $purchaseOrderData['PurchaseOrder']['remarks'] : $receivedItemData['ReceivedOrder']['remarks']));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $this->Form->end(); ?>   
    </div>
</div>

<?php if(!empty($receiveItem)){ ?>
 
<div class="col-lg-6">
    <div class="main-box clearfix">

    <header class="main-box-header clearfix">
    <h2>Purchased Item List</h2>
    <span style = "font-size:10px;">
    <I>
        <span class="price table table-products table-hover">
            <i class="fa fa-tags" style = "color:#52D017;"></i>&nbsp; Model
            </span>
                                

        <span class="warranty">
            <i class="fa fa-certificate" style = "color:orange;"></i>&nbsp; Purchased Item
        </span>
    </I>
    </span>
    </header>

        <div class="main-box-body clearfix">
            <div class="table-responsive">
                <table class="table table-products table-hover">
                    <tbody>
                        <?php //pr($receiveItem); exit ?>
                         <?php  foreach ($receiveItem as $key => $requestDataList): ?>
                        <tr>
                            <td>
                            <img src="<?php echo Router::url('/', true) ?>img/itemboxopen.png" alt="logo" style="width:60px;height:60px;padding-bottom:10;">
                            </td>
                            <td>
                                <span class="name">
                                <?php echo $requestDataList[$itemHolder]['name'] ?>
                                </span>
                                <span class="price">
                                <i class="fa fa-tags"></i>&nbsp;<?php echo $requestDataList[$itemHolder]['model'] ?> 
                                </span>
                                <span class="warranty">
                                <i class="fa fa-certificate"></i>&nbsp; <?php echo $requestDataList[$itemHolder]['quantity'] . " " . $unitData[$requestDataList[$itemHolder]['unit_id']] ?>  
                                </span>
                            </td>
                        </tr>

                    <?php  endforeach;  ?>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="main-box clearfix">

    <header class="main-box-header clearfix">
    <h2>Delivered Item List</h2> 
    <span style = "font-size:10px;">
    <I>
        <span class="price table table-products table-hover">
            <i class="fa fa-certificate" style = "color:#52D017;"></i>&nbsp; Good
            </span>
                                

        <span class="warranty">
            <i class="fa fa-certificate" style = "color:orange;"></i>&nbsp; Rejected
        </span>
    </I>
    </span>

    </header>

        <div class="main-box-body clearfix">
            <div class="table-responsive">
                <table class="table table-products table-hover">
                    <tbody> 

                    <?php  
                         foreach ($receiveItem as $key => $requestDataList):?>
                        <tr>
                            <td>
                            <img src="<?php echo Router::url('/', true) ?>img/itembox.png" alt="logo" style="width:85px;height:60px;padding-bottom:10;">
                            </td>
                            <td>
                                <span class="name">
                                <?php echo $requestDataList[$itemHolder]['name'] ?> 

                                <?php if(empty($requestDataList[$itemHolder]['unit_price']) && !empty($receivedItemData['ReceivedOrder']['dr_num'])){ ?>

                                <a data-toggle="modal" href="#myModalUnitPrice<?php echo $requestDataList[$itemHolder]['id']?>" class="btn btn-primary mrg-b-lg pull-right addSchedButton" val = "<?php echo $requestDataList[$itemHolder]['id']?>"><i class="fa fa-plus-circle fa-lg tobeTrigger"></i> Add Unit Price</a>

                                <?php } ?>

                                </span>
                                <span class="price">
                                <i class="fa fa-certificate"></i>&nbsp; <?php

                                if(!empty($requestDataList[$itemHolder]['good_quantity'])){

                                 echo $requestDataList[$itemHolder]['good_quantity'] . " " . $unitData[$requestDataList[$itemHolder]['unit_id']]?> 

                                <?php } ?>
                                </span>
                                <span class="warranty">
                                <i class="fa fa-certificate"></i>&nbsp; <?php 

                                if(!empty($requestDataList[$itemHolder]['reject_quantity'])){

                                 echo $requestDataList[$itemHolder]['reject_quantity'] . " " . $unitData[$itemData[$itemTypeHolder]['quantity_unit_id']]?> 

                                <?php } ?>
                                </span>
                                
                            </td>


                        </tr>

                        <div class="modal fade" id="myModalUnitPrice<?php echo $requestDataList[$itemHolder]['id']?>" role="dialog"  >
                            <div class="modal-dialog">
                                <div class="modal-content margintop">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">In Record</h4>
                                    </div> 

                                    <div class="modal-body">

                                        <?php 
                                                $id = $requestDataList[$itemHolder]['id'];

                                                $deliveredId = $receivedItemData['DeliveredOrder']['dr_num'];

                                                $uuid = $requestDataList[$itemHolder]['uuid'];

                                            echo $this->Form->create('ReceivedItem',array(
                                                'url'=>(array('controller' => 'receivings','action' => 'add_unit_price', $id, $deliveredDataID, $uuid)),'class' => 'form-horizontal')); 
                                        ?>

                                            <div class="form-group" id="existing_items">
                                                <label class="col-lg-2 control-label">Unit Price</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('ReceivedItem.unit_price', array(
                                                            'empty' => 'None',
                                                            'required' => 'required',
                                                            'type' => 'number', 
                                                            'class' => 'form-control item_type editable limitQuantity',
                                                            'label' => false
                                                           
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



                    <?php  endforeach;  ?>
                    
                    </tbody>
                </table>
            </div> 
        </div>
    </div>

</div>


<?php } ?>

<div class="modal fade" id="myModalInRecord<?php echo $receivedItemData[0]['DeliveredOrder']['id'] ?>" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content margintop">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">In Record</h4>
            </div> 

            <div class="modal-body">

                <?php  $id = $receivedItemData[0]['ReceivedOrder']['id'];

                     $DeliveredOrderId = $receivedItemData[0]['DeliveredOrder']['id'];


                    echo $this->Form->create('InRecord',array(
                        'url'=>(array('controller' => 'receivings','action' => 'in_record', $id, $DeliveredOrderId,$receivedItemData[0]['DeliveredOrder']['purchase_orders_id'],$receivedItemData[0]['PurchaseOrder']['supplier_id'] )),'class' => 'form-horizontal')); 
                ?>

                    <div class="form-group" id="existing_items">
                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Store Keeper</label>
                        <div class="col-lg-9">
                            <?php  
                                echo $this->Form->input('InRecord.storekeeper', array(
                                    'class' => 'form-control item_type editable required',
                                    'label' => false,
                                    'type' => 'select',
                                    'options' => array($userNameList),
                                    'required' => 'required',
                                   
                                    ));
                            ?>

                        </div>
                    </div>

                    <div class="form-group" id="existing_items">
                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Location</label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('InRecord.location', array(
                                    'class' => 'form-control item_type editable required',
                                    'label' => false,
                                    'type' => 'select',
                                    'options' => array($areaList),
                                    'required' => 'required',
                                   
                                    ));
                            ?>

                        </div>
                    </div>

                    <div class="form-group" id="existing_items">
                        <label class="col-lg-2 control-label">Remarks</label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->textarea('InRecord.remarks', array(
                                    'empty' => 'None',
                                    'required' => 'required',
                                    'class' => 'form-control item_type editable limitQuantity',
                                    'label' => false
                                   
                                ));
                            ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                <?php echo $this->Form->end();  ?> 
            </div>
        </div>
    </div>
</div>



