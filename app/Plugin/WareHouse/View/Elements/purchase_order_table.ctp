
<?php   foreach ($purchaseOrderData as $purchaseOrderDataList ): ?>

        <tr class="">

            <td class="">

                <?php echo ucfirst($purchaseOrderDataList['PurchaseOrder']['po_number']) ?>

            </td>

            <td class="">
                <?php echo ucfirst($supplierData[$purchaseOrderDataList['PurchaseOrder']['supplier_id']]) ?>
            </td>

            <td >
                <?php 
                    if($purchaseOrderDataList['PurchaseOrder']['status'] == 8){ 
                        echo "<span class='label label-default'>Waiting</span>";
                    }

                    if($purchaseOrderDataList['PurchaseOrder']['status'] == 1){ 
                        echo "<span class='label label-default'>Waiting</span>";
                    }
                ?>
            </td>

            <td>

                 <?php 
                        echo $this->Html->link('<span class="fa-stack">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-search fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View</font></span>
                            </span> ', array('controller' => 'receivings', 'action' => 'view', $purchaseOrderDataList['PurchaseOrder']['id'], $purchaseOrderDataList['Request']['uuid'], 0),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                    ?>                    

                 <?php
                        echo $this->Html->link('<span class="fa-stack">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-level-down fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Receive</font></span>
                            </span> ', array('controller' => 'receivings', 'action' => 'receive_order', $purchaseOrderDataList['PurchaseOrder']['id'], $purchaseOrderDataList['Request']['uuid'] ),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                    ?>                    
            </td>
        </tr>


    <div class="modal fade" id="myModalReceiving<?php echo $purchaseOrderDataList['PurchaseOrder']['id'] ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content margintop">
                <div class="modal-header">
                    
                    <h4 class="modal-title">Receive Order</h4>

                </div>
                <div class="modal-body">
                    <?php  echo $this->Form->create('Receivings',array('url'=>(array('controller' => 'receivings', 
                            'action' => 'receive_order',$purchaseOrderDataList['PurchaseOrder']['id'])),'class' => 'form-horizontal'))?>


                     <?php  if(!empty($requestData['PurchaseItem'])){

                                foreach ($requestData['PurchaseItem'] as $requestDataList): ?>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>
                                      
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('PurchaseOrder.item', array(
                                                                                'class' => 'form-control item_type',
                                                                                'disabled' => true,
                                                                                'label' => false,       
                                                                                'value' => $requestDataList['foreign_key'],
                                                                                'fields' =>array('name')));
                                            ?>
                                        </div>
                                    </div>

                                             <?php 
                                        endforeach; 

                                }else{

                                    foreach ($requestPurchasingItem as $requestDataList): ?>
                                        
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>
                                      
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('PurchaseOrder.item', array(
                                                                                'class' => 'form-control item_type',
                                                                                'disabled' => true,
                                                                                'label' => false,       
                                                                                'value' => $requestDataList['RequestItem'],
                                                                                'fields' =>array('name')));
                                            ?>
                                        </div>
                                    </div>

                                             <?php 
                                        endforeach; 
                                              
                                } ?>        

                    

                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label">Remarks</label>
                        <div class="col-lg-9">
                             <?php 
                                echo $this->Form->textarea('Receiving.remarks', array('class' => 'form-control required',
                                                                                   'class' => 'form-control ',
                                                                                    'label' => false
                                                                                    ));
                                 ?> 
                        </div>
                    </div>

                    <br><br><br>

                    <div class="modal-footer">
                         <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Receive</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>
                       
                    <?php echo $this->Form->end(); ?>   
                </div>
            </div>
        </div>
    </div> 
<div class="md-overlay"></div>


<?php endforeach; ?> 

