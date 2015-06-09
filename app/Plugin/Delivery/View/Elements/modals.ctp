 
    <div class="modal fade" id="myModalDeliveries" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content margintop">
    
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delivery Schedule</h4>
                </div>
                <div class="modal-body">
                    <?php  
                        echo $this->Form->create('ClientOrderDeliverySchedule',array(
                                    'url'=>(array('controller' => 'deliveries','action' => 'edit', $deliveryEdit['Delivery']['id'], $deliveryEdit['DeliveryDetail']['id'],$scheduleInfo['ClientOrderDeliverySchedule']['id'],$quotationId,$clientsOrderUuid)),'class' => 'form-horizontal'));
                        //$scheduleInfo['ClientOrderDeliverySchedule']['id'],$quotationId,$clientsOrderUuid
                            //, $scheduleInfo['ClientOrderDeliverySchedule']['id']); ?>
                    
                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label">D.R. #</label>
                            <div class="col-lg-9">

                                <?php //pr($scheduleInfo['ClientOrderDeliverySchedule']['uuid']);
                                    echo $this->Form->input('DeliveryDetail.id', array('class' => 'form-control item_type required',
                                        'type' => 'hidden',
                                        'value' => $deliveryEdit['DeliveryDetail']['id']
                                        ));
                                ?>

                                <?php  echo $this->Form->input('ClientOrderDeliverySchedule.quantity', array(
                                                'type' => 'hidden',
                                                'class' => 'form-control item_type',
                                                    'label' => false,
                                                    'value' => $quantityInfo[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']],
                                                    'id' => 'quantity')); 
                                ?>


                                <?php 
                                    echo $this->Form->input('Delivery.dr_uuid', array(
                                                                    'class' => 'form-control item_type editable required',
                                                                    'label' => false,
                                                                    'required' => 'required',
                                                                    'readonly' => 'readonly',
                                                                    'value' => $deliveryEdit['Delivery']['dr_uuid']
                                                                    ));
                                ?>
                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>Schedule</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('DeliveryDetail.schedule', array(
                                                                                'label' => false,
                                                                                'required' => 'required',
                                                                                'class' => 'form-control item_type datepick required',
                                                                                'type' => 'text',
                                                                                'id' => 'date',
                                                                                'value' => date('Y-m-d', strtotime($deliveryEdit['DeliveryDetail']['schedule']))
                                                                                ));
                                    ?>
                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('DeliveryDetail.quantity', array(
                                                                    'empty' => 'None',
                                                                    'class' => 'form-control item_type editable addquantityLimit',
                                                                    'label' => false,
                                                                    'value' => $deliveryEdit['DeliveryDetail']['quantity']
                                                                    ));
                                ?>
                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>Location</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('DeliveryDetail.location', array(
                                                                    'empty' => 'None',
                                                                    'class' => 'form-control item_type editable addquantityLimit',
                                                                    'label' => false,
                                                                    'value' => $deliveryEdit['DeliveryDetail']['location']
                                                                    ));
                                ?>
                            </div>
                        </div>

                       <!--  <div class="form-group" id="existing_items">
                                            <label class="col-lg-2 control-label">Status</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('Delivery.status', array(
                                                                                    'class' => 'form-control item_type editable',
                                                                                    'label' => false,
                                                                                    'value' => 'Waiting',
                                                                                    'readonly' => 'readonly'
                                                                                    ));
                                                ?>
                            </div>
                        </div> -->


                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                    
                    <?php echo $this->Form->end(); ?>   
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 
    <div class="md-overlay"></div>
    <div class="modal fade" id="myModalApprove" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content margintop">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delivery Schedule</h4>
                </div>
                <div class="modal-body">
                    <?php  echo $this->Form->create('ClientOrderDeliverySchedule',array('url'=>(array('controller' => 'deliveries', 
                            'action' => 'add', $scheduleInfo['ClientOrderDeliverySchedule']['id'],$quotationId,$clientsOrderUuid)),'class' => 'form-horizontal'))//, $scheduleInfo['ClientOrderDeliverySchedule']['id']);?>
                    

                        <div class="form-group" id="existing_items">
                            <div class="col-lg-9">

                                            <?php 
                                                echo $this->Form->input('ClientOrderDeliverySchedule.id', array('class' => 'form-control item_type required',
                                                    'type' => 'hidden',
                                                    'value' => $scheduleInfo['ClientOrderDeliverySchedule']['id']
                                                    ));
                                            ?>

                                           <!--  <?php  echo $this->Form->input('QuotationItemDetail.quantity', array(
                                                            'type' => 'hidden',
                                                            'class' => 'form-control item_type',
                                                                'label' => false,
                                                                'value' => $quantityInfo[$scheduleInfo['QuotationDetail']['quotation_id']],
                                                                'id' => 'quantity')); ?> -->
                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>D.R. #</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('Delivery.dr_uuid', array(
                                                                    'empty' => 'None',
                                                                    'class' => 'form-control item_type editable',
                                                                    'label' => false
                                                                    ));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">Remarks</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->textarea('DeliveryDetail.remarks', array('class' => 'form-control required',
                                                                                       'class' => 'form-control item_type editable required',
                                                                                        'label' => false,
                                                                                       
                                                                                       // 'readonly' => 'readonly',
                                                                                        //'value' => $scheduleInfo['Company']['company_name']
                                                                                        ));
                                ?>
                            </div>
                        </div>

                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                   
                    <?php echo $this->Form->end(); ?>   
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 

        

    <div class="md-overlay"></div>

    <script>
    
        jQuery(document).ready(function($){
            $("#ClientOrderDeliveryScheduleViewForm").validate();
            $('#date').datepicker({
                format: 'yyyy-mm-dd'
            });
          
        });

        jQuery("#ClientOrderDeliveryScheduleViewForm").validate();

    </script>

    