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
                Print Transmittal Form 
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
      'url'=>(array('controller' => 'deliveries', 'action' => 'tr',$drData['Delivery']['dr_uuid'],$drData['Delivery']['schedule_uuid'], $drData['Delivery']['clients_order_id'])),'class' => 'form-horizontal')); ?>
        <div class="col-lg-12">
          <div class="main-box">
            <div class="top-space"></div>
              <div class="main-box-body clearfix">
                <div class="main-box-body clearfix">
                  <div class="form-horizontal">    

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
                            'readonly' => 'readonly',
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
                          'disabled' => 'disabled',
                          'required' => 'required',
                          'placeholder' => 'Item Unit',
                          'value' => $clientData['QuotationItemDetail']['unit_price_unit_id']));
                          ?>

                          <?php 
                          echo $this->Form->input('Transmittal.unit', array(
                          'class' => 'form-control item_type',
                          'label' => false,
                          'type' => 'hidden',
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
                            <button type="submit" class="btn btn-primary pull-left refresh">Print</button>&nbsp;
                          <?php 
                          echo $this->Html->link('Cancel', array('controller' => 'deliveries', 'action' => 'delivery_replacing'),array('class' =>'btn btn-default','escape' => false));
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

<script>

var backLocation = document.referrer;

if (backLocation) {

  if (backLocation.indexOf("?") > -1) {
      backLocation += "&randomParam=" + new Date().getTime();
  } else {
      backLocation += "?randomParam=" + new Date().getTime();
  }
       
  $('.refresh').on("click",function(){ 

    setTimeout(function (){
      window.location.assign(backLocation);
    }, 1500);
   
  });
}

</script>


