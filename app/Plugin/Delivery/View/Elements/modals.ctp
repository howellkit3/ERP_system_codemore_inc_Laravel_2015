
    <div class="modal fade" id="myModalDelivery" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delivery Schedule</h4>
                </div>
                <div class="modal-body">
                 <?php  echo $this->Form->create('ClientOrderDeliverySchedule',array('url'=>(array('controller' => 'deliveries', 
                            'action' => 'edit', $scheduleInfo['ClientOrderDeliverySchedule']['id'])),'class' => 'form-horizontal'))//, $scheduleInfo['ClientOrderDeliverySchedule']['id']);?>
                    

                        <div class="form-group" id="existing_items">
                                <label class="col-lg-2 control-label">C.O. #</label>
                            <div class="col-lg-9">

                                            <?php 
                                                echo $this->Form->input('ClientOrderDeliverySchedule.id', array('class' => 'form-control item_type required',
                                                    'type' => 'hidden',
                                                    'value' => $scheduleInfo['ClientOrderDeliverySchedule']['id']
                                                    ));
                                            ?>

                                            <?php  echo $this->Form->input('QuotationItemDetail.quantity', array(
                                                            'type' => 'hidden',
                                                            'class' => 'form-control item_type',
                                                                'label' => false,
                                                                'value' => $quantityInfo[$scheduleInfo['QuotationDetail']['quotation_id']],
                                                                'id' => 'quantity')); ?>


                                                    <?php 
                                                        echo $this->Form->input('ClientOrder.uuid', array(
                                                                                        'class' => 'form-control item_type editable required',
                                                                                        'label' => false,
                                                                                        'required' => 'required',
                                                                                        'readonly' => 'readonly',
                                                                                        'value' => $scheduleInfo['ClientOrder']['uuid']
                                                                                        ));
                                                    ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">P.O. #</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('ClientOrder.po_number', array(
                                                                                        'class' => 'form-control item_type editable required',
                                                                                        'label' => false,
                                                                                        'required' => 'required',
                                                                                        'readonly' => 'readonly',
                                                                                        'value' => $scheduleInfo['ClientOrder']['po_number']
                                                                                        ));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">Customer</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('Company.company_name', array('class' => 'form-control required',
                                                                                       'class' => 'form-control item_type editable required',
                                                                                        'label' => false,
                                                                                        'required' => 'required',
                                                                                        'readonly' => 'readonly',
                                                                                        'value' => $scheduleInfo['Company']['company_name']
                                                                                        ));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">Item Name</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('Product.name', array('class' => 'form-control required addquantityLimit number required',
                                                                                  'class' => 'form-control item_type editable required',
                                                                                    'label' => false,
                                                                                    'required' => 'required',
                                                                                    'readonly' => 'readonly',
                                                                                    'value' => $scheduleInfo['Product']['name']
                                                                                        ));                 
                                ?>
                            </div>
                        </div>

                         <div class="form-group" id="existing_items">
                                                <label class="col-lg-2 control-label"><span style="color:red">*</span>Schedule</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('ClientOrderDeliverySchedule.schedule', array(
                                                                                        'label' => false,
                                                                                        'required' => 'required',
                                                                                        'class' => 'form-control item_type datepick required',
                                                                                        'type' => 'text',
                                                                                        'id' => 'date',
                                                                                        'value' => date('M d, Y', strtotime($scheduleInfo['ClientOrderDeliverySchedule']['schedule']))
                                                                                        ));
                                                    ?>
                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
                                            <label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ClientOrderDeliverySchedule.quantity', array(
                                                                                    'empty' => 'None',
                                                                                    'class' => 'form-control item_type editable addquantityLimit',
                                                                                    'label' => false,
                                                                                    'value' => $scheduleInfo['ClientOrderDeliverySchedule']['quantity']
                                                                                    ));
                                                ?>
                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
                                            <label class="col-lg-2 control-label"><span style="color:red">*</span>Location</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ClientOrderDeliverySchedule.location', array(
                                                                                    'empty' => 'None',
                                                                                    'class' => 'form-control item_type editable addquantityLimit',
                                                                                    'label' => false,
                                                                                    'value' => $scheduleInfo['ClientOrderDeliverySchedule']['location']
                                                                                    ));
                                                ?>
                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
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
                        </div>


                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                    </form>
                 <?php echo $this->Form->end(); ?>   
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 

    <div class="modal fade" id="myModalApprove" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delivery Schedule</h4>
                </div>
                <div class="modal-body">
                 <?php  echo $this->Form->create('ClientOrderDeliverySchedule',array('url'=>(array('controller' => 'deliveries', 
                            'action' => 'add', $scheduleInfo['ClientOrderDeliverySchedule']['id'])),'class' => 'form-horizontal'))//, $scheduleInfo['ClientOrderDeliverySchedule']['id']);?>
                    

                        <div class="form-group" id="existing_items">
                            <div class="col-lg-9">

                                            <?php 
                                                echo $this->Form->input('ClientOrderDeliverySchedule.id', array('class' => 'form-control item_type required',
                                                    'type' => 'hidden',
                                                    'value' => $scheduleInfo['ClientOrderDeliverySchedule']['id']
                                                    ));
                                            ?>



                                            <?php  echo $this->Form->input('QuotationItemDetail.quantity', array(
                                                            'type' => 'hidden',
                                                            'class' => 'form-control item_type',
                                                                'label' => false,
                                                                'value' => $quantityInfo[$scheduleInfo['QuotationDetail']['quotation_id']],
                                                                'id' => 'quantity')); ?>
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
                    </form>
                 <?php echo $this->Form->end(); ?>   
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 

        

    <div class="md-overlay"></div>

    <script>
        
        
        jQuery(document).ready(function($){
            $("#CustomerSaleViewForm").validate();
            $('#date').datepicker({
            format: 'yyyy-mm-dd'
        });
          
        });

     </script>