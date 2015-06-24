<div class="modal fade" id="myModalReturn<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content margintop">

            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Delivered P.O. Quantity</h4>
            </div> 

            <div class="modal-body">

            <?php echo $this->Form->create('ClientOrderDeliverySchedule',array(
            'url'=>(array('controller' => 'deliveries','action' => 'delivery_return',$scheduleInfo['ClientOrderDeliverySchedule']['id'],$scheduleInfo['QuotationDetail']['quotation_id'], $scheduleInfo['ClientOrderDeliverySchedule']['uuid']) ),'class' => 'form-horizontal')); ?>

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

                  echo $this->Form->input('DeliveryDetail.limit', array(
                                              'class' => 'form-control item_type editable required MaximumQuantity',
                                              'label' => false,
                                              'required' => 'required',
                                              'readonly' => 'readonly',
                                              'value' => $deliveryDataList['DeliveryDetail']['quantity'] - $deliveryDataList['DeliveryDetail']['delivered_quantity'] 
                                                ));

                  echo $this->Form->input('DeliveryDetail.delivered_quantity', array(
                                              'empty' => 'None',
                                              'required' => 'required',
                                              'class' => 'form-control item_type editable  ',
                                              'label' => false,
                                              'value' => $deliveryDataList['DeliveryDetail']['quantity'] - $deliveryDataList['DeliveryDetail']['delivered_quantity'] 
                                            
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
                                              'class' => 'form-control item_type editable ',
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

            </div>



          </div>
        </div>
      <?php  

      echo $this->Form->end();  
      ?> 
    </div>