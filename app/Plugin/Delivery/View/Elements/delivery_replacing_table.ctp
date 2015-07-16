<?php 
$pushRemaining  = array();
$totalremaining = 0;

  if(!empty($deliveryEdit)){ ?>

      <?php  foreach ($deliveryEdit as $deliveryDataList): ?>

                <tbody aria-relevant="all" aria-live="polite" role="alert">

                    <tr class="">

                        <td class="">
                              <?php echo $deliveryDataList['Delivery']['dr_uuid']; ?>
                        </td>

                        <td class="">

                            <?php echo date('M d, Y',strtotime($deliveryDataList['DeliveryDetail']['schedule'])); ?>
                        
                        </td>

                        <td class="">
              
                           <?php echo ucwords($deliveryDataList['DeliveryDetail']['location']); ?>    
                                
                        </td>

                        <td class="">

                            <?php 
    
                            array_push($pushRemaining, $deliveryDataList['DeliveryDetail']['quantity']);
                    
                            echo  $deliveryDataList['DeliveryDetail']['quantity']; ?> <br>
                             
                        
                        </td>

                        <td class="">
                            
                            <?php if(empty($deliveryDataList['DeliveryDetail']['delivered_quantity'])){ 

                                 echo 0; }else{?> 

                                <?php echo $deliveryDataList['DeliveryDetail']['delivered_quantity']; ?>

                            <?php } ?>

                        </td>

                        <td class="">
              
                         <?php  if (!empty($deliveryDataList['DeliveryDetail']['status'])) {  

                                            if($deliveryDataList['DeliveryDetail']['status'] == '3'){

                                              echo "<span class='label label-success'>Delivered</span>"; 

                                            }else if($deliveryDataList['DeliveryDetail']['status'] == '2'){   

                                              echo "<span class='label label-info'>Incomplete</span>";  

                                            }

                                            }else{

                                              echo "<span class='label label-warning'>Delivering</span>"; 

                                          }
                         ?> 
                            
                        </td>

                        <td>


                              <?php 

                              $dr_uuid_holder = $deliveryDataList['Delivery']['dr_uuid'];
                              $dr_type_holder = null;
                              $tr_type_holder = null;

                             foreach ($DeliveryReceiptData as $key) {

                                 if($key['DeliveryReceipt']['dr_uuid'] == $dr_uuid_holder){

                                  if($key['DeliveryReceipt']['type'] == 'replacing'){

                                    $dr_type_holder = 'replacing';

                                  }
                                } 
                              }  

                              foreach ($TransmittalData as $key) {

                                 if($key['Transmittal']['dr_uuid'] == $dr_uuid_holder){

                                  if($key['Transmittal']['type'] == 'replacing'){

                                    $tr_type_holder = 'replacing';

                                  }
                                } 
                              }  

                              if(!empty($dr_type_holder)){

                                echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa  fa-ticket fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px">  D.R.</font></span>
                                    </span> ', array('controller' => 'deliveries', 'action' => 'delivery_receipt',$deliveryDataList['Delivery']['dr_uuid'],$deliveryDataList['Delivery']['schedule_uuid']),array('class' =>' table-link not-active','escape' => false,'title'=>'Print Delivery Receipt'));
                              }else{

                                echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa  fa-ticket fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px">  D.R.</font></span>
                                    </span> ', array('controller' => 'deliveries', 'action' => 'delivery_receipt',$deliveryDataList['Delivery']['dr_uuid'],$deliveryDataList['Delivery']['schedule_uuid']),array('class' =>' table-link ','escape' => false,'title'=>'Print Delivery Receipt'));

                              }

                              
                              if(!empty($tr_type_holder)){
                              
                                echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa  fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> T.F.</font></span>
                                    </span> ', array('controller' => 'deliveries', 'action' => 'delivery_transmittal',$deliveryDataList['Delivery']['dr_uuid'],$deliveryDataList['Delivery']['schedule_uuid']),array('class' =>' table-link not-active','escape' => false,'title'=>'Print Transmittal Receipt'));

                              }else{

                                echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa  fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> T.F.</font></span>
                                    </span> ', array('controller' => 'deliveries', 'action' => 'delivery_transmittal',$deliveryDataList['Delivery']['dr_uuid'],$deliveryDataList['Delivery']['schedule_uuid']),array('class' =>' table-link','escape' => false,'title'=>'Print Transmittal Receipt'));

                              }

                              ?>
                      
                              <a data-toggle="modal" href="#myModalReturn<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" class="table-link "><i class="fa fa-lg "></i><span class="fa-stack">
                                  <i class="fa fa-square fa-stack-2x"></i>
                                  <i class="fa  fa-mail-reply fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Return </font></span></a>
                          
                       </td>  
                    </tr>

                </tbody>

  <div class="modal fade" id="myModalReturn<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" role="dialog" >
    <div class="modal-dialog">
      <div class="modal-content margintop">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Delivered P.O. Quantity</h4>
        </div> 

        <div class="modal-body">

        <?php  echo $this->Form->create('ClientOrderDeliverySchedule',array(
            'url'=>(array('controller' => 'deliveries','action' => 'delivery_return',$clientOrderData[$deliveryDataList['Delivery']['schedule_uuid']], $deliveryDataList['DeliveryDetail']['delivery_uuid'], $deliveryDataList['Delivery']['schedule_uuid']
 ) ),'class' => 'form-horizontal')); ?>

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

               echo $this->Form->input('DeliveryDetail.from_replacing', array(
                                                      'class' => 'form-control item_type editable required ',
                                                      'label' => false,
                                                      'type' => 'hidden',
                                                      'readonly' => 'readonly',
                                                      'value' => 'replacing'
                                                      ));
            ?>

            </div>
          </div>
          <br><br>

        <div class="form-group" id="existing_items">
            <label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
          <div class="col-lg-9">

          <?php 

            echo $this->Form->input('DeliveryDetail.delivered', array(
                                                      'empty' => 'None',
                                                      'type' => 'hidden',
                                                      'required' => 'required',
                                                      'class' => 'form-control item_type editable  ',
                                                      'label' => false,
                                                      'value' => $deliveryDataList['DeliveryDetail']['delivered_quantity'] 
                                                      ));

            echo $this->Form->input('DeliveryDetail.delivered_quantity', array(
                                                      'empty' => 'None',
                                                      'required' => 'required',
                                                      'class' => 'form-control item_type editable quantityLimit ',
                                                      'label' => false,
                                                      'value' => $deliveryDataList['DeliveryDetail']['quantity'] - $deliveryDataList['DeliveryDetail']['delivered_quantity'] 
                                                      ));

            echo $this->Form->input('DeliveryDetail.quantity', array(
                                                      'empty' => 'None',
                                                      'type' => 'hidden',
                                                      'required' => 'required',
                                                      'class' => 'form-control item_type editable ',
                                                      'label' => false,
                                                      'id' => 'quantity',
                                                      'value' => $deliveryDataList['DeliveryDetail']['quantity'] - $deliveryDataList['DeliveryDetail']['delivered_quantity'] 
                                                      
                                                      ));
            echo $this->Form->input('DeliveryDetail.holder', array(
                                                      'empty' => 'None',
                                                      'type' => 'hidden',
                                                      'required' => 'required',
                                                      'class' => 'form-control item_type editable',
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

          <?php echo $this->Form->end();   ?> 
        </div>
     </div>
    </div>
  </div>
                      
        <?php 
          endforeach; 
  } 
  ?> 

<script>
  $( document ).ready(function() {
    $('.transmittalData').change(function(){

        
       $('.appendhere').append('<div class="form-group removeAppended"><br> <br> <br> <label class="col-lg-2 control-label"><span style="color:red">*</span>Number</label> <div class="col-lg-8"><input type="text" maxlength="120" required = "required" placeholder = "Transmittal Number" class="form-control required textfieldwidth" name="data[DeliveryDetail][number]" ></div> <br> <br> <br> </div>');


    });

   jQuery("#ClientOrderDeliveryScheduleDeliveryReplacingForm").validate();
 });


    



</script>

<style>

  .textfieldwidth{
    width: 410px;
  }

</style>

<?php echo $this->element('modals');
 ?>