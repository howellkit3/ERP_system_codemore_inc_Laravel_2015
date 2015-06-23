<?php echo $this->Html->script('Sales.quantityLimitDelivery'); ?>

<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">

          <div class="filter-block pull-right filter-margin">

  
              
              <?php //pr($clientData);
                
                  echo $this->Html->link('<i class="fa fa-check-square fa-lg"></i> Back ', 
                        array('controller' => 'deliveries', 
                            'action' => 'index'
                            ),
                        array('class' =>'btn btn-primary pull-right backMargin',
                            'escape' => false));
                ?>  
           </div>
         
<div class="row">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-lg-12">
        <header class="main-box-header clearfix">
                              
          <h1 class="pull-left">
            Print Transmittal Form
          </h1>
          
        </header>

      </div>
    </div>
    <?php echo $this->Form->create('ClientOrderDeliverySchedule',array(
            'url'=>(array('controller' => 'deliveries', 'action' => 'delivery_transmittal')),'class' => 'form-horizontal')); ?>
        <div class="col-lg-12">
          <div class="main-box">
            <div class="top-space"></div>
            <div class="main-box-body clearfix">
              <div class="main-box-body clearfix">
                <div class="form-horizontal">                 
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Transmittal Number</label>
                    <div class="col-lg-8">
                      <?php 
                            echo $this->Form->input('Transmittal.number', array(
                                            'class' => 'form-control item_type',
                                            'label' => false,
                                            'required' => 'required',
                                            'placeholder' => 'Transmittal Number'));
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
                                            'class' => 'form-control item_type quantity',
                                            'label' => false,
                                            'required' => 'required',
                                            'placeholder' => 'Item Quantity',
                                            'value' => $drData['DeliveryDetail']['quantity'] - $drData['DeliveryDetail']['delivered_quantity'] ));

                                             echo $this->Form->input('DeliveryDetail.limit', array(
                                              'class' => 'form-control item_type editable required MaximumQuantity',
                                              'label' => false,
                                              'required' => 'required',
                                              'readonly' => 'readonly',
                                              'value' => $deliveryDataList['DeliveryDetail']['quantity'] - $deliveryDataList['DeliveryDetail']['delivered_quantity'] 
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
