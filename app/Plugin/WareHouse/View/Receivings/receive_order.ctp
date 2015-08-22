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
                                            echo $this->Form->input('ReceivedItems.id', array(
                                                                            'class' => 'form-control item_type',
                                                                            'type' => 'hidden',
                                                                            'label' => false,       
                                                                            'value' => $purchaseOrderData['PurchaseOrder']['id'],
                                                                            'fields' =>array('name')));
                                        ?>

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
                                            echo $this->Form->input('PurchaseOrder.supplier', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'disabled' => true,
                                                                            'fields' =>array('name'),
                                                                            'value' => ucwords($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']])));
                                        ?>
                                    </div>
                                </div>          

                                <?php  foreach ($requestPurchasingItem as $key => $requestDataList): 

                                if(empty($requestDataList[$itemHolder]['delivered_quantity'])){

                                    $deliveredQuantityHolder = 0;

                                }else{

                                    $deliveredQuantityHolder = $requestDataList[$itemHolder]['delivered_quantity'];
                                }

                                $remainingQuantity = $requestDataList[$itemHolder]['original_quantity'] - $deliveredQuantityHolder;

                                if($remainingQuantity > 0){  ?>

                                <div class="form-group modal-main-body">
                                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                    <div class="col-lg-8 bgcolor"  >
                                        
                                    <div class = "checkbox-nice">
                                    <input type="checkbox" class="check-ref-uuid checked" name="requestPurchasingItem[<?php echo $key ?>][<?php echo $requestDataList[$itemHolder]['foreign_key'] ?>]" id="<?php echo $key?>" >
                                                        <label for="<?php echo $key?>"> <?php  echo $requestDataList[$itemHolder]['name'] ?></label>

                                    </div>
                                    <div class="form-group ">
                                            
                                            <label class="col-lg-2 control-label">Quantity</label>

                                        <div class="col-lg-2">
                                            
                                            <?php 
                                                echo $this->Form->input('requestPurchasingItem.'.$key.'.quantity', array(
                                                                            'empty' => 'None',
                                                                            'required' => 'required',
                                                                            'class' => 'form-control item_type limitQuantity',
                                                                            'placeholder' => 'Quantity',
                                                                            'label' => false,
                                                                            'disabled' => 'disabled',
                                                                            'value' => $requestDataList[$itemHolder]['original_quantity']
                                                ));
                                            ?>
                                        </div>

                                            <div class="col-lg-2 ">
                                            <?php 
                                                echo $this->Form->input('requestPurchasingItem.'.$key.'.condition', array(         
                                                                        'required' => 'required',
                                                                        'class' => 'form-control required condition ',
                                                                        'options' => array('good', 'reject'),
                                                                        'value' => 0,
                                                                        'label' => false,
                                                                        'disabled' => 'disabled',
                                                                        'type' => 'select',
                                                                        'required' => 'required',
                                                                        ));
                                                 ?>

                                    <?php
                                                echo $this->Form->input('requestPurchasingItem.'.$key.'.model', array(                    'type' => 'hidden',
                                                                        'class' => 'form-control',
                                                                        'value' =>$requestDataList[$itemHolder]['model'],
                                                                        'label' => false,
                                                                        
                                                                        ));
                                    ?>

                                    <?php
                                                echo $this->Form->input('requestPurchasingItem.'.$key.'.original_quantity', array(        
                                                                        'type' => 'hidden',
                                                                        'class' => 'form-control limiter',
                                                                        'value' =>(!empty($requestDataList[$itemHolder]['delivered_quantity']) ? $remainingQuantity: $requestDataList[$itemHolder]['original_quantity']),
                                                                        'label' => false,
                                                                        
                                                                        ));
                                    ?>


                                       
                                     </div>
                                        <div class="col-lg-2 searchAppend"> </div>
                                    
                                    </div>                  
                                </div>
                            </div>
                              
                              
                                             <?php }
                                        endforeach; 
                                              
                                 ?>

                         
                        
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 control-label">Remarks</label>
                                <div class="col-lg-8">
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

<script>

jQuery("body").ready(function(){

    $('.limitQuantity').bind('change', quantityController); });

    $('.checked').on("click", function() {

    if($(this).parents('.bgcolor').find('.checked').prop('checked') == true){

        $(this).parents('.bgcolor').find('.limitQuantity').prop('disabled', false);

        $(this).parents('.bgcolor').find('.condition').prop('disabled', false);

        $(this).parents('.bgcolor').css("background-color", "#eee");

    } else{

        $(this).parents('.bgcolor').find('.limitQuantity').prop('disabled', true);

        $(this).parents('.bgcolor').find('.condition').prop('disabled', true);

        $(this).parents('.bgcolor').css("background-color", "#FFFFFF");

    }

    });

    //  $('.condition').on("change", function() {

    //     $('.searchAppend').html('<input name="data[requestPurchasingItem][0][quantity]" empty="None" required="required" class="form-control item_type limitQuantity valid" placeholder="Quantity" value="12" type="text" id="requestPurchasingItem0Quantity" aria-required="true" aria-invalid="false"> <input name="data[requestPurchasingItem][0][quantity]" empty="None" required="required" class="form-control item_type limitQuantity valid" placeholder="Quantity" value="12" type="text" id="requestPurchasingItem0Quantity" aria-required="true" aria-invalid="false">');

    // });


    function quantityController() {

    var limiter = $(this).parents('.modal-main-body').find('.limiter').val();

    var limitQuantity = $(this).parents('.modal-main-body').find('.limitQuantity').val();

        if(parseInt(limiter) < parseInt(limitQuantity)){

            alert('Maximum Quantity'); 
            $(this).parents('.modal-main-body').find('.limitQuantity').val(limiter);
        
        }
    }



</script>


