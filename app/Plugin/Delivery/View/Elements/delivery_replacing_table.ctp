<?php 
$pushRemaining  = array();
$totalremaining = 0;

  if(!empty($deliveryEdit)){ ?>

      <?php foreach ($deliveryEdit as $deliveryDataList): 
                ?>

                <tbody aria-relevant="all" aria-live="polite" role="alert">

                    <tr class="">

                        <td class="">
                              <?php echo $deliveryDataList['Delivery']['dr_uuid']; ?>
                        </td>

                        <td class="">

                            <?php echo date('M d, Y',strtotime($deliveryDataList['DeliveryDetail']['schedule'])); ?>
                        
                        </td>

                        <td class="">
              
                           <?php echo  $deliveryDataList['DeliveryDetail']['location']; ?>    
                                
                        </td>

                        <td class="">

                            <?php 
    
                            array_push($pushRemaining, $deliveryDataList['DeliveryDetail']['quantity']);
                    
                            echo  $deliveryDataList['DeliveryDetail']['quantity']; ?> <br>
                             
                        
                        </td>

                        <td class="">
                            
                            <?php if(empty($deliveryDataList['DeliveryDetail']['delivered_quantity'])){ 

                                 echo 0; }else{?> 

                                <?php echo ($deliveryDataList['DeliveryDetail']['quantity'] - $deliveryDataList['DeliveryDetail']['delivered_quantity'])   ; ?>

                            <?php } ?>

                        </td>

                        <td class="">
              
                         <?php if (!empty($deliveryDataList['DeliveryDetail']['status'])) {  

                                            if($deliveryDataList['DeliveryDetail']['status'] == 'Completed'){

                                              echo "<span class='label label-success'>Completed</span>"; 

                                            }else if($deliveryDataList['DeliveryDetail']['status'] == 'Incomplete'){   

                                              echo "<span class='label label-danger'>Incomplete</span>";  

                                            }

                                            }else{

                                              echo "<span class='label label-warning'>Delivering</span>"; 

                                          }
                         ?> 
                            
                        </td>

                        <td>
                            <?php 
                                echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit</font></span>
                                    </span> ', array('controller' => 'deliveries', 'action' => 'delivery_edit',$deliveryDataList['Delivery']['dr_uuid'], $deliveryDataList['Delivery']['schedule_uuid']),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                            ?>

                              <a data-toggle="modal" href="#myModalPrint<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" class="table-link "><i class="fa fa-lg "></i><span class="fa-stack">
                                  <i class="fa fa-square fa-stack-2x"></i>
                                  <i class="fa  fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print </font></span></a>

                              <a data-toggle="modal" href="#myModalReturn<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" class="table-link "><i class="fa fa-lg "></i><span class="fa-stack">
                                  <i class="fa fa-square fa-stack-2x"></i>
                                  <i class="fa  fa-mail-reply fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Return </font></span></a>
                     
                       </td>  
                    </tr>

                </tbody>

  <div class="modal fade" id="myModalPrint<?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" role="dialog" >
    <div class="modal-dialog">
      <div class="modal-content margintop">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Delivered P.O. Quantity</h4>
        </div> 

        <div class="modal-body">

        <?php  

          echo $this->Form->create('ClientOrderDeliverySchedule',array(
            'url'=>(array('controller' => 'deliveries', 'action' => 'print_replacing',$deliveryDataList['Delivery']['dr_uuid'],$deliveryDataList['Delivery']['schedule_uuid'])),'class' => 'form-horizontal')); ?>

          <br>

          <div class="form-group appendhere" id="existing_items">
              <label class="col-lg-2 control-label ">Delivery Form</label>
            <div class="col-lg-9 ">

            <?php 
              echo $this->Form->input('Delivery.id', array(
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

              echo $this->Form->input('Delivery.print', array(
                                                    'options' => array('Delivery Receipt','Transmittal'),
                                                    'type' => 'select',
                                                    'label' => false,
                                                    'class' => 'form-control required transmittalData ',
                                                    'empty' => '---Select Delivery Form---',
                                                    'required' => 'required'
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
                                                      'class' => 'form-control item_type editable quantity ',
                                                      'label' => false,
                                                      'value' => $deliveryDataList['DeliveryDetail']['quantity'] - $deliveryDataList['DeliveryDetail']['delivered_quantity'] 
                                                      ));

            echo $this->Form->input('DeliveryDetail.quantity', array(
                                                      'empty' => 'None',
                                                      'type' => 'hidden',
                                                      'required' => 'required',
                                                      'class' => 'form-control item_type editable MaximumQuantity',
                                                      'label' => false,
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

        </div>



      </div>
    </div>


  <?php  

  echo $this->Form->end();  

  ?> 



  </div>

                            
        <?php 
          endforeach; 
  } 

  ?> 

<?php echo $this->element('modals');
 ?>

<script>

    $('.transmittalData').change(function(){

      if($('.transmittalData :selected').text() == 'Transmittal'){

       $('.removeAppended').remove();
        
       $('.appendhere').append('<div class="form-group removeAppended"><br> <br> <br> <label class="col-lg-2 control-label"><span style="color:red">*</span>Number</label> <div class="col-lg-8"><input type="text" maxlength="120" required = "required" placeholder = "Transmittal Number" class="form-control editable required " name="data[DeliveryDetail][appended][]" ></div> <br> <br> <br> <label class="col-lg-2 control-label"><span style="color:red">*</span>To :</label> <div class="col-lg-8 "><input type="text" maxlength="120" required = "required" placeholder = "Customer Contact Person" class="form-control editable required" name="data[DeliveryDetail][appended][]" ></div> <br> <br> <br> <label class="col-lg-2 control-label">Remarks</label> <div class="col-lg-8 "><input textarea = "text" maxlength="120" required = "required" placeholder = "Remarks" class="form-control editable required" name="data[DeliveryDetail][appended][]" ></div></div>');

      }else{

        $('.removeAppended').remove();

        $('.appendhere').append('<div class="form-group removeAppended"><br> <br> <br> <label class="col-lg-2 control-label"><span style="color:red">*</span>Number</label> <div class="col-lg-8"><input type="text" maxlength="120" required = "required" placeholder = "Delivery Number" class="form-control editable required " name="data[DeliveryDetail][appended][]" ></div> </div>');

      }
    });

</script>