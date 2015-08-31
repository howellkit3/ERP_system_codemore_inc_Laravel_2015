<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php  echo $this->element('ware_house_option');?>


    <div class = "pull-right";>

        <?php 

            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i>  Go Back ', array('controller' => 'receivings','action' => 'receive'),array('class' =>'btn btn-primary pull-right','escape' => false));
        
        if($receivedItemData[0]['DeliveredOrder']['status_id'] != 1) {
                if ($receivedItemData[0]['DeliveredOrder']['status_id'] != 13){    
        
            echo $this->Html->link('<i class="fa fa-check fa-lg"></i> Approve ', array('controller' => 'receivings','action' => 'purchase_approve', $deliveredDataID),array('class' =>'btn btn-primary pull-right ' ,'escape' => false));  

            }
        } ?>

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
                                    <label class="col-lg-2 control-label">Purchase Order Number</label>
                                    
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('PurchaseOrder.uuid', array(
                                                                            'class' => 'form-control item_type',
                                                                            'disabled' => true,
                                                                            'label' => false,       
                                                                            'value' => $receivedItemData[0]['PurchaseOrder']['uuid'],
                                                                            'fields' =>array('name')));


                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Supplier</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('PurchaseOrder.quantity', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'disabled' => true,
                                                                            'fields' =>array('name'),
                                                                            'value' => ucwords($supplierData[$receivedItemData[0]['PurchaseOrder']['supplier_id']])));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">P.O. Number</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('PurchaseOrder.quantity', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'disabled' => true,
                                                                            'fields' =>array('name'),
                                                                            'value' => $receivedItemData[0]['PurchaseOrder']['po_number']));
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
                                                                            'value' => date("F j, Y ", strtotime($receivedItemData[0]['PurchaseOrder']['created'])),
                                                                            'fields' =>array('name')));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Created by</label>
                                    <div class="col-lg-8">
                                        <?php $Fname = $firstName[$receivedItemData[0]['PurchaseOrder']['created_by']];

                                            $Fname = ucfirst($firstName[$receivedItemData[0]['PurchaseOrder']['created_by']]); 

                                            $Lname = ucfirst($lastName[$receivedItemData[0]['PurchaseOrder']['created_by']]);

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
                                                                            'value' => $receivedItemData[0]['PurchaseOrder']['remarks']));
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

                         <?php  foreach ($receiveItem as $requestDataList): ?>
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
                                <i class="fa fa-certificate"></i>&nbsp; <?php echo $requestDataList[$itemHolder]['quantity'] ?> pcs
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
                         foreach ($receiveItem as $requestDataList):?>
                        <tr>
                            <td>
                            <img src="<?php echo Router::url('/', true) ?>img/itembox.png" alt="logo" style="width:85px;height:60px;padding-bottom:10;">
                            </td>
                            <td>
                                <span class="name">
                                <?php echo $requestDataList[$itemHolder]['name'] ?>
                                </span>
                                <span class="price">
                                <i class="fa fa-certificate"></i>&nbsp; <?php 

                                if(!empty($requestDataList[$itemHolder]['good_quantity'])){

                                 echo $requestDataList[$itemHolder]['good_quantity'] ?> pcs

                                <?php } ?>
                                </span>
                                <span class="warranty">
                                <i class="fa fa-certificate"></i>&nbsp; <?php 

                                if(!empty($requestDataList[$itemHolder]['reject_quantity'])){

                                 echo $requestDataList[$itemHolder]['reject_quantity'] ?> pcs

                                <?php } ?>
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