    <div class="modal fade" id="myModalReceiving" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content margintop">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Receive Order</h4>
                </div>
                <div class="modal-body">
                    <?php  echo $this->Form->create('PurchaseOrder',array('url'=>(array('controller' => 'receivings', 
                            'action' => 'receive',$purchaseOrderDataList['PurchaseOrder']['id'])),'class' => 'form-horizontal'))?>
                    

                        <div class="form-group" id="existing_items">
                            <div class="col-lg-9">

                                          <!--   <?php 
                                                echo $this->Form->input('ClientOrderDeliverySchedule.id', array('class' => 'form-control item_type required',
                                                    'type' => 'hidden',
                                                    'value' => $scheduleInfo['ClientOrderDeliverySchedule']['id']
                                                    ));
                                            ?>

                                            <?php  if(!empty($quantityInfo[$scheduleInfo['QuotationDetail']['quotation_id']])){

                                                echo $this->Form->input('QuotationItemDetail.quantity', array(
                                                            'type' => 'select',
                                                            'class' => 'form-control item_type',
                                                            'label' => false,
                                                            'value' => $quantityInfo[$scheduleInfo['QuotationDetail']['quotation_id']],
                                                            'id' => 'quantity'));

                                                } ?>  -->
                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>D.R. #</label>
                            <div class="col-lg-9">
                               <!--  <?php 
                                    echo $this->Form->input('dr_uuid', array(
                                                                    'class' => 'form-control item_type editable required',
                                                                    'label' => false
                                                                    ));
                                ?>

                                <?php 
                                                echo $this->Form->input('ClientOrderDeliverySchedule.quantity', array('class' => 'form-control item_type required',
                                                    'type' => 'hidden',
                                                    'value' => $scheduleInfo['ClientOrderDeliverySchedule']['quantity']
                                                    ));
                                            ?> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">Remarks</label>
                            <div class="col-lg-9">
                               <!--  <?php 
                                    echo $this->Form->textarea('DeliveryDetail.remarks', array('class' => 'form-control required',
                                                                                       'class' => 'form-control item_type editable required',
                                                                                        'label' => false,
                                                                                       
                                                                                       // 'readonly' => 'readonly',
                                                                                        //'value' => $scheduleInfo['Company']['company_name']
                                                                                        ));
                                ?> -->
                            </div>
                        </div>

                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                   
                    <?php echo $this->Form->end(); ?>   
                </div>
                
            </div>
        </div>
    </div> 

    <div class="md-overlay"></div>

    <script>
    
        jQuery(document).ready(function(){
            $("#ClientOrderDeliveryScheduleViewForm").validate();
            $('#date').datepicker({
                format: 'yyyy-mm-dd'
            });
          
        });

       

    </script>

    