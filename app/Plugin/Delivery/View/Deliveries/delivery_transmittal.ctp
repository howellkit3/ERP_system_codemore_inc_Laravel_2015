<?php echo $this->Html->script('Sales.quantityLimitDelivery'); ?>
<?php echo $this->element('deliveries_options'); ?><br><br>

<div class="row1">
  <div class="col-lg-12">
    <div class="main-box clearfix body-pad">

    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <header class="main-box-header clearfix">
              <h1 class="pull-left">
                Print <?php echo $nameForm; ?> Form 
              </h1>

              <?php
                  echo $this->Html->link('<i class="fa fa-arrow-left fa-lg"></i> Back ', 
                  array('controller' => 'deliveries', 
                  'action' => 'delivery_replacing'
                  ),
                  array('class' =>'btn btn-primary pull-right ',
                  'escape' => false));
                ?>  
            </header>
          </div>
        </div>

      <?php echo $this->Form->create('ClientOrderDeliverySchedule',array(
      'url'=>(array('controller' => 'deliveries', 'action' => 'print_replacing',$drData['Delivery']['dr_uuid'],$drData['Delivery']['schedule_uuid'])),'class' => 'form-horizontal')); ?>
        <div class="col-lg-12">
          <div class="main-box">
            <div class="top-space"></div>
              <div class="main-box-body clearfix">
                <div class="main-box-body clearfix">
                  <div class="form-horizontal">    

                  <?php if($nameForm == 'Transmittal'){ ?> 

                    <div class="form-group ">
                      <label class="col-lg-2 control-label">Transmittal #</label>
                        <div class="col-lg-8 ">
                          <?php 
                            echo $this->Form->input('Transmittal.tr_uuid', array(
                            'class' => 'form-control item_type',
                            'label' => false,
                            'required' => 'required',
                            'placeholder' => 'Transmittal Number'));
                          ?>

                          <?php 
                            echo $this->Form->input('Transmittal.dr_uuid', array(
                            'class' => 'form-control item_type',
                            'label' => false,
                            'required' => 'required',
                            'type' => 'hidden',
                            'placeholder' => 'Transmittal Number',
                            'value' => $drData['Delivery']['dr_uuid']));
                          ?>

                          <?php 
                            echo $this->Form->input('Print.form', array(
                            'class' => 'form-control item_type',
                            'label' => false,
                            'required' => 'required',
                            'type' => 'hidden',
                            'value' => '1'));
                          ?>

                        </div>
                      </div>

                      <div class="form-group ">
                        <label class="col-lg-2 control-label">To:</label>
                        <div class="col-lg-8 ">
                          <?php 
                            echo $this->Form->input('Transmittal.contact_person', array(
                            'class' => 'form-control item_type',
                            'label' => false,
                            'required' => 'required',
                            'placeholder' => 'Contact Person'));
                          ?>
                        </div>
                      </div>

                      <div class="form-group">
                          <label class="col-lg-2 control-label">Item</label>
                        <div class="col-lg-8">
                          <?php 
                          echo $this->Form->input('Transmittal.number', array(
                          'class' => 'form-control item_type',
                          'label' => false,
                          'readonly' => 'readonly',
                          'required' => 'required',
                          'placeholder' => 'Item Name',
                          'value' => $clientData['Product']['name']));
                          ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-lg-2 control-label">Quantity</label>
                        <div class="col-lg-8">
                          <?php 
                            echo $this->Form->input('Transmittal.quantity', array(
                            'class' => 'form-control item_type quantityLimit',
                            'label' => false,
                            'required' => 'required',
                            'placeholder' => 'Item Quantity',
                            'value' => $drData['DeliveryDetail']['quantity'] - $drData['DeliveryDetail']['delivered_quantity'] ));

                            echo $this->Form->input('DeliveryDetail.limit', array(
                            'class' => 'form-control item_type editable required ',
                            'label' => false,
                            'type' => 'hidden',
                            'required' => 'required',
                            'readonly' => 'readonly',
                            'id' => 'quantity',
                            'value' => $drData['DeliveryDetail']['quantity'] - $drData['DeliveryDetail']['delivered_quantity'] 
                          ));
                          ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-lg-2 control-label">Unit</label>
                          <div class="col-lg-8">
                          <?php 
                          echo $this->Form->input('Transmittal.unit', array(
                          'class' => 'form-control item_type',
                          'label' => false,
                          'required' => 'required',
                          'placeholder' => 'Item Unit',
                          'value' => $clientData['QuotationItemDetail']['unit_price_unit_id']));
                          ?>
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="col-lg-2 control-label">Remarks</label>
                         <div class="col-lg-8">
                            <?php echo $this->Form->textarea('Transmittal.remarks', array(
                            'class' => 'form-control item_type',
                            'label' => false));
                        ?>
                        </div>
                      </div>

                        <?php }else{ ?>

                        <div class="form-group ">
                            <label class="col-lg-2 control-label">Delivery Receipt #</label>
                            <div class="col-lg-8 ">

                        <?php 
                            echo $this->Form->input('Transmittal.dr_uuid', array(
                            'class' => 'form-control item_type',
                            'label' => false,
                            'readonly' => 'readonly',
                            'required' => 'required',
                            'placeholder' => 'Transmittal Number',
                            'value' => $drData['Delivery']['dr_uuid']));
                        ?>

                        <?php 
                            echo $this->Form->input('Print.form', array(
                            'class' => 'form-control item_type',
                            'label' => false,
                            'required' => 'required',
                            'type' => 'hidden',
                            'value' => '0'));
                          ?>

                            </div>
                        </div> 

                        <div class="form-group">
                          <label class="col-lg-2 control-label">Item</label>
                         <div class="col-lg-8">
                          <?php 
                          echo $this->Form->input('Transmittal.number', array(
                                  'class' => 'form-control item_type',
                                  'label' => false,
                                  'readonly' => 'readonly',
                                  'required' => 'required',
                                  'placeholder' => 'Item Name',
                                  'value' => $clientData['Product']['name']));
                          ?>
                        </div>
                      </div>    

                        <div class="form-group">
                            <label class="col-lg-2 control-label">P.O. Number</label>
                                <div class="col-lg-8">
                                    <input type="hidden" id="category_selected_type" value="">
                                    <?php echo $this->Form->input('ClientOrder.po_number', array(
                                    'class' => 'form-control item_type',
                                    'label' => false,
                                    'readonly' => 'readonly',
                                    'value' => $clientData['ClientOrder']['po_number'],
                                    'placeholder' => 'Item Name'));
                                    ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Schedule</label>
                            <div class="col-lg-8">
                                <?php 
                                    echo $this->Form->input('DeliveryDetail.schedule', array(
                                    'label' => false,
                                    'required' => 'required',
                                    'class' => 'form-control item_type datepick required',
                                    'type' => 'text',
                                    'id' => 'date',
                                    'readonly' => 'readonly',
                                    'value' => 
                                    date('Y-m-d',strtotime($drData['DeliveryDetail']['schedule']))
                                                                   ));
                                ?>
                    
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Location</label>
                            <div class="col-lg-8">
                        <?php 
                            echo $this->Form->input('DeliveryDetail.location', array(
                            'class' => 'form-control item_type',
                            'label' => false,
                            'type' => 'text',
                            'required' => 'required',
                            'readonly' => 'readonly',
                            'class' => 'form-control item_type datepik editable required',
                            'value' => 
                            $drData['DeliveryDetail']['location']
                         ));
                        ?>

                        </div>
                        </div>

                      <div class="form-group">
                        <label class="col-lg-2 control-label">Quantity</label>
                        <div class="col-lg-8">
                          <?php 
                            echo $this->Form->input('DeliveryDetail.quantity', array(
                            'class' => 'form-control item_type quantityLimit',
                            'label' => false,
                            'required' => 'required',
                            'placeholder' => 'Item Quantity',
                            'value' => $drData['DeliveryDetail']['quantity'] - $drData['DeliveryDetail']['delivered_quantity'] ));

                            echo $this->Form->input('DeliveryDetail.limit', array(
                            'class' => 'form-control item_type editable required ',
                            'label' => false,
                            'type' => 'hidden',
                            'required' => 'required',
                            'readonly' => 'readonly',
                            'id' => 'quantity',
                            'value' => $drData['DeliveryDetail']['quantity'] - $drData['DeliveryDetail']['delivered_quantity'] 
                          ));
                          ?>
                        </div>
                      </div>

                      <div class="form-group">
                            <label class="col-lg-2 control-label">Unit</label>
                              <div class="col-lg-8">
                              <?php 
                              echo $this->Form->input('DeliveryDetail.unit', array(
                              'class' => 'form-control item_type',
                              'label' => false,
                              'required' => 'required',
                              'readonly' => 'readonly',
                              'placeholder' => 'Item Unit',
                              'value' => $clientData['QuotationItemDetail']['unit_price_unit_id']));
                              ?>
                              </div>
                          </div>   

                        <!-- <div class="form-group">
                            <label class="col-lg-2 control-label">Remarks</label>
                             <div class="col-lg-8">
                                <?php echo $this->Form->textarea('DeliveryDetail.remarks', array(
                                'class' => 'form-control item_type',
                                'label' => false,
                                'value' => $drData['DeliveryDetail']['remarks']));
                            ?>
                            </div>
                          </div>    --> 

                        <?php } ?>   

                      <div class="form-group">
                        <div class="col-lg-2"></div>
                          <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary pull-left">Print</button>&nbsp;
                          <?php 
                          echo $this->Html->link('Cancel', array('controller' => 'products', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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
  </div>
</div>              
              
 <style>

 .backMargin{
  margin-right: 20px;

 }

 </style>

