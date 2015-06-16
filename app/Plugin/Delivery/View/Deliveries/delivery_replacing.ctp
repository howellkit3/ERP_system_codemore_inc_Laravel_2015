<?php echo $this->element('deliveries_options'); ?><br><br>

<?php echo $this->Html->script('Sales.quantityLimitDelivery');?>

<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block pull-right marginDelivery">
               <?php   
                
                  echo $this->Html->link('<i class="fa  fa-arrow-left fa-lg "></i> Back ', 
                        array('controller' => 'deliveries', 
                            'action' => 'index'
                            ),
                        array('class' =>'btn btn-primary pull-right',
                            'escape' => false));
                ?>  

               <br><br>
           </div>
   

            <div class="filter-block pull-right marginDelivery">

           </div>
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Delivery Schedule</b></h2>
                
            </header>

    <div class="main-box-body clearfix">
        <div class="table-responsive">
            <div class="main-box clearfix body-pad">        
                 <table class="table table-striped table-hover ">
                        <thead>
                            <tr >
                                <th class=""><a href="#"><span>Delivery Receipt #</span></a></th>
                                <th class=""><a href="#"><span>Schedule</span></a></th>
                                <th class=""><a href="#"><span>Location</span></a></th>
                                <th class=""><a href="#"><span>Quantity</span></a></th>
                                <th class=""><a href="#"><span>Remaining</span></a></th>
                                <th class=""><a href="#"><span>Status</span></a></th>
                                <th class=""><a href="#"><span>Action</span></a></th> 
                            </tr>
                        </thead>

                         <?php echo $this->element('delivery_replacing_table'); ?>   
                    </table>
              </div>
        </div>
    </div>  


<div class="modal fade" id="myModalReturn<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content margintop">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delivered P.O. Quantity</h4>
      </div> 

      <div class="modal-body">

      <?php  

        echo $this->Form->create('ClientOrderDeliverySchedule',array(
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

             echo $this->Form->input('DeliveryDetail.quantity', array(
                                                    'class' => 'form-control item_type editable required ',
                                                    'label' => false,
                                                    'type' => 'hidden',
                                                    'readonly' => 'readonly',
                                                    'value' => $deliveryDataList['DeliveryDetail']['quantity'],
                                                    'id' => 'maxQuantity'
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
                                                    'class' => 'form-control item_type editable limitQuantity',
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

    
             
<?php echo $this->element('modals'); ?>

<style>
.margintop{
    margin-top : 10%; 

</style    

