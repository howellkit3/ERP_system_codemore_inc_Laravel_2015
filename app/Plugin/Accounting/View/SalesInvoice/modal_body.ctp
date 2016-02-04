                    <div class="modal-body">

                        <?php if($indicator == 'si_num'){?>

                            <?php  echo $this->Form->create('InvoiceForm',array(
                                    'url'=>(array('controller' => 'sales_invoice','action' => 'add_invoice', $deliveryUUID )),'class' => 'form-horizontal'));  ?>


                                      <?php 
                                            echo $this->Form->input('SalesInvoice.is_multiple', array(
                                                'type' => 'hidden',
                                                'label' => false,
                                                'value' => !empty($isMultiple) ? 1 : ''
                                                ));
                                        ?>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><span style="color:red">*</span>Customer</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('SalesInvoice.customer', array(
                                                'options' => array('Regular', 'APC'),
                                                'alt' => 'Status',
                                                'label' => false,
                                                'class' => 'form-control col-lg-4 required customer',
                                                'empty' => '--Select Customer--'
                                                ));
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><span style="color:red">*</span>Status</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('SalesInvoice.status', array(
                                                'options' => array('Pre-Invoice', 'Invoice'),
                                                'alt' => 'Status',
                                                'label' => false,
                                                'class' => 'form-control col-lg-4 required',
                                                'empty' => '--Select Status--'
                                                ));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><span style="color:red">*</span>Invoice Number</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('SalesInvoice.sales_invoice_no', array(
                                                'class' => 'form-control item_type required',
                                                'label' => false,
                                                'value' => $seriesSalesNo,
                                                'placeholder' => 'Invoice No.'));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group delivery_number" >
                                    <label class="col-lg-3 control-label"><span style="color:red">*</span>Delivery Number</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('SalesInvoice.dr_uuid', array(
                                                'class' => 'form-control item_type required ',
                                                'label' => false,
                                                'readonly' => true,
                                                'value' => $deliveryUUID,
                                                'placeholder' => 'Invoice No.'));
                                        ?>

                                    </div>
                                </div>

                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                </div>

                                <?php echo $this->Form->input('delivery_id',array('type' => 'text' ,'value' => $deliveryId)); ?>
                            
                            <?php echo $this->Form->end();  ?> 

                        <?php }else{ ?>

                            <?php  echo $this->Form->create('InvoiceForm',array(
                                'url'=>(array('controller' => 'sales_invoice','action' => 'add_statement', $deliveryUUID )),'class' => 'form-horizontal'));  ?>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><span style="color:red">*</span>S.A. Number</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('SalesInvoice.statement_no', array(
                                                'class' => 'form-control item_type required',
                                                'label' => false,
                                                'value' => $seriesSalesNo,
                                                'placeholder' => 'Invoice No.'));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group delivery_number" >
                                    <label class="col-lg-3 control-label"><span style="color:red">*</span>Delivery Number</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('SalesInvoice.dr_uuid', array(
                                                'class' => 'form-control item_type required ',
                                                'label' => false,
                                                'readonly' => true,
                                                'value' => $deliveryUUID,
                                                'placeholder' => 'Invoice No.'));
                                        ?>

                                    </div>
                                </div>

                                <?php 
                                    echo $this->Form->input('SalesInvoice.status', array(
                                        'type' => 'hidden',
                                        'label' => false,
                                        'class' => 'form-control col-lg-4 required',
                                        'value' => 2
                                        ));
                                ?>
                                
                                <?php echo $this->Form->input('delivery_id',array('type' => 'text' ,'value' => $deliveryId)); ?>

                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                </div>
                            
                            <?php echo $this->Form->end();  ?> 

                        <?php } ?>
                    </div>