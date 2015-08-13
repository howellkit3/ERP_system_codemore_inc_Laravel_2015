<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php echo $this->element('ware_house_option');
$int = 0;
echo $this->Form->create('Receivings',array('url'=>(array('controller' => 'receivings','action' => 'receive_order',$purchaseOrderData['PurchaseOrder']['id'], $purchaseOrderData['RequestItem']['request_uuid'] )),'class' => 'form-horizontal'));?>

<br><br>

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box">
                    <header class="main-box-header clearfix">

                        <h2 class="pull-left">Purchased Order</h2>

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
                                                                            'value' => $purchaseOrderData['PurchaseOrder']['uuid'],
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
                                                                            'value' => ucwords($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']])));
                                        ?>
                                    </div>
                                </div>          

                                <?php  if(!empty($requestData['PurchaseItem'])){

                                    foreach ($requestData['PurchaseItem'] as $requestDataList): ?>

                                    <?php $int ++; ?>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>
                                      
                                        <div class="col-lg-8">
                                           <div class = "checkbox-nice">
                                             <input type="checkbox" class="check-ref-uuid checked" name="requestPurchasingItem[<?php echo $int ?>][$requestDataList['PurchaseItem']['foreign_key']]" id="<?php echo $int?>" >
                                                    <label for="<?php echo $int?>"> <?php echo $requestDataList['PurchaseItem']['name'] ?></label>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                <?php 
                                    echo $this->Form->input('DeliveryDetail.measure', array(         
                                                                    'required' => 'required',
                                                                    'class' => 'form-control required  ',

                                                                    'options' => array('by bundle', 'by pack' , 'by piece', 'by box', 'by pallet'),
                                                                    'empty' => '--Select Measure--',
                                                                    'label' => false,
                                                                    'type' => 'select',
                                                                    'required' => 'required',
                                                                    ));
                                ?>
                            </div>

                                    </div>

                                             <?php 
                                        endforeach; 

                                }else{

                                    foreach ($requestPurchasingItem as $requestDataList): ?>

                                    <?php $int++; ?>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>
                                      
                                        <div class="col-lg-8">
                                           <div class = "checkbox-nice">
                                             <input type="checkbox" class="check-ref-uuid checked" name="requestPurchasingItem[<?php echo $int ?>][<?php echo $requestDataList['RequestItem']['foreign_key'] ?>]" id="<?php echo $int?>" >
                                                    <label for="<?php echo $int?>"> <?php echo $requestDataList['RequestItem']['name'] ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>
                                      <div class="col-lg-8">
                                        <?php 
                                    echo $this->Form->input('DeliveryDetail.measure', array(         
                                                                    'required' => 'required',
                                                                    'class' => 'form-control required  ',

                                                                    'options' => array('by bundle', 'by pack' , 'by piece', 'by box', 'by pallet'),
                                                                    'empty' => '--Select Measure--',
                                                                    'label' => false,
                                                                    'type' => 'select',
                                                                    'required' => 'required',
                                                                    ));
                                ?>
                                    </div>
                                </div>


                                             <?php 
                                        endforeach; 
                                              
                                } ?>

                             <div class="form-group">
                                <label class="col-lg-2 control-label"></label>
                                <div class="col-lg-16">

                                <label><I>*check only the items received</I></label>

                                </div>
                            </div>

                        
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 control-label">Remarks</label>
                                <div class="col-lg-9">
                                    <?php 
                                        echo $this->Form->textarea('ReceivedItems.remarks', array('class' => 'form-control required',
                                                                    'class' => 'form-control ',
                                                                    'label' => false
                                    ));
                                    ?> 
                                </div>
                            </div>

                            <br><br>

                            <div class="modal-footer">
                                 <div class="col-lg-3">

                                    <?php 
                                        echo $this->Form->submit('Receive Item/s', array('class' => 'btn btn-success pull-right'));
                                    ?>
                                  
                                </div>

                                <div class="col-lg-1">
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'receivings', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
                                    ?>
                                </div>
                            </div>
                                

                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>  
            </div>
        </div>
    </div>
</div>


