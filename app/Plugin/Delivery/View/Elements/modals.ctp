 <?php
    $pushRemaining  = array();
    $totaldifference = 0;
    $totalremaining = 0;

 ?>

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
                                    'url'=>(array(
                                    'controller' => 'deliveries',
                                    'action' => 'add_schedule', 
                                    !empty($deliveryEdit[0]['Delivery']['id']) ? $deliveryEdit[0]['Delivery']['id'] : '',
                                    !empty( $clientsOrder['ClientOrderDeliverySchedule']['id']) ? $clientsOrder['ClientOrderDeliverySchedule']['id'] : '',
                                    $clientsOrderUuid,
                                    $clientUuid
                                    )),'class' => 'form-horizontal')); ?>
                    
                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>D.R. #</label>
                            <div class="col-lg-9">

                                <?php 
                                    foreach ($deliveryEdit as $deliveryDataList): 

                                        if($deliveryDataList['DeliveryDetail']['status'] == 3 && $deliveryDataList['Delivery']['status'] == 1){

                                          $difference = $deliveryDataList['DeliveryDetail']['delivered_quantity']; 

                                          array_push($pushRemaining,$difference );

                                        }else if ($deliveryDataList['DeliveryDetail']['status'] != 5 && $deliveryDataList['Delivery']['status'] == 1 ){

                                        $difference = $deliveryDataList['DeliveryDetail']['quantity']; 

                                        array_push($pushRemaining,$difference );


                                        }

                                    endforeach; 
                                        

                                          foreach ($pushRemaining as $key => $value) {

                                          $totaldifference = $totaldifference + $value;



                                          }   
        

                                          if($totaldifference != 0){                
                                           
                                          $totalremaining =  $clientsOrder['ClientOrderDeliverySchedule']['quantity'] - $totaldifference;

                                          }else{

                                          $totalremaining = $clientsOrder['ClientOrderDeliverySchedule']['quantity'];
                                          }


                                          ?>
                                        

                              <?php 

                                    echo $this->Form->input('DeliveryDetail.delivered', array(
                                                'type' => 'hidden',
                                                'class' => 'form-control item_type',
                                                'label' => false,
                                                'value' => $totalremaining,
                                                'id' => 'quantity'
                                                    )); 
                                    
                                ?>

                                <?php  echo $this->Form->input('Delivery.schedule_uuid', array(
                                                'type' => 'hidden',
                                                'class' => 'form-control item_type',
                                                'label' => false,
                                                'value' => $clientsOrder['ClientOrderDeliverySchedule']['uuid'],
                                                    )); 
                                ?>

                                <?php  echo $this->Form->input('Delivery.clients_order_id', array(
                                                'type' => 'hidden',
                                                'class' => 'form-control item_type',
                                                'label' => false,
                                                'value' => $clientsOrder['ClientOrder']['uuid'],
                                                    )); 
                                ?>


                                <?php 
                                    echo $this->Form->input('Delivery.dr_uuid', array(
                                                                    'class' => 'form-control item_type editable required',
                                                                    'label' => false,
                                                                    'rule' => 'isUnique',
                                                                    'required' => 'required'
                                                                    ));
                                ?>


                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>Schedule</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('DeliveryDetail.schedule', array(
                                        'type' => 'text',
                                        'label' => false,
                                        'required' => 'required',
                                        'class' => 'form-control item_type datepick required',
                                        'id' => 'date'
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
                                                                    'required' => 'required',
                                                                    'class' => 'form-control item_type editable addquantityLimit',
                                                                    'label' => false
                                                                    // 'value' => $deliveryEdit['DeliveryDetail']['quantity']
                                                                    ));
                                ?>
                            </div>

                        </div>

                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>Pieces</label>
                            <div class="col-lg-3">
                                <?php 
                                    echo $this->Form->input('DeliveryDetail.pieces', array(
                                                                    'empty' => 'None',
                                                                    'required' => 'required',
                                                                    'class' => 'form-control item_type editable addquantityLimit',
                                                                    'label' => false
                                                                    // 'value' => $deliveryEdit['DeliveryDetail']['quantity']
                                                                    ));
                                ?>
                            </div>

                             <div class="col-lg-6">
                                <?php 
                                    echo $this->Form->input('DeliveryDetail.measure', array(         
                                                                    'required' => 'required',
                                                                    'class' => 'form-control required  ',

                                                                    'options' => array($measureList),
                                                                    'empty' => '--Select Measure--',
                                                                    'label' => false,
                                                                    'type' => 'select',
                                                                    'required' => 'required',
                                                                    ));
                                ?>
                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>Location</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('DeliveryDetail.location', array(
                                                                    'empty' => '--Select Location--',
                                                                    'class' => 'form-control item_type editable addquantityLimit',
                                                                    'options' => array(!empty($clientsOrder['ClientOrder']['company_id'])) ? $companyAddress[$clientsOrder['ClientOrder']['company_id']] : "" ,
                                                                    'type' => 'select',
                                                                    'required' => 'required',
                                                                    'label' => false,
                                                                     'value' => !empty($deliveryEdit[0]['DeliveryDetail']['location']) ? $deliveryEdit[0]['DeliveryDetail']['location'] : " "                                                                    ));
                                ?>
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

    <div class="modal fade" id="myModalApprove" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content margintop">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delivery Schedule</h4>
                </div>
                <div class="modal-body">
                    <?php  echo $this->Form->create('Delivery',array('url'=>(array('controller' => 'deliveries', 
                            'action' => 'add', $clientsOrder['ClientOrderDeliverySchedule']['id'],$clientsOrderUuid,$clientUuid)),'class' => 'form-horizontal'))?>
                    

                        <div class="form-group" id="existing_items">
                            <div class="col-lg-9">

                                            <?php 
                                                echo $this->Form->input('ClientOrderDeliverySchedule.id', array('class' => 'form-control item_type required',
                                                    'type' => 'hidden',
                                                    'value' => $clientsOrder['ClientOrderDeliverySchedule']['id']
                                                    ));
                                            ?>

                                            <?php  if(!empty($quantityInfo[$clientsOrder['QuotationDetail']['quotation_id']])){

                                                echo $this->Form->input('QuotationItemDetail.quantity', array(
                                                            'type' => 'select',
                                                            'class' => 'form-control item_type',
                                                            'label' => false,
                                                            'value' => $quantityInfo[$clientsOrder['QuotationDetail']['quotation_id']],
                                                            'id' => 'quantity'));

                                                } ?> 
                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>D.R. #</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('dr_uuid', array(
                                                                    'class' => 'form-control item_type editable required',
                                                                    'label' => false
                                                                    ));
                                ?>

                                <?php 
                                                echo $this->Form->input('ClientOrderDeliverySchedule.quantity', array('class' => 'form-control item_type required',
                                                    'type' => 'hidden',
                                                    'value' => $clientsOrder['ClientOrderDeliverySchedule']['quantity']
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
                                                                    'required' => 'required',
                                                                    'class' => 'form-control item_type editable addquantityLimit',
                                                                    'label' => false,
                                                                    'readonly' => 'readonly',
                                                                     'value' => $clientsOrder['ClientOrderDeliverySchedule']['quantity']
                                                                    ));
                                ?>
                            </div>

                        </div>

                         <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>Pieces</label>
                            <div class="col-lg-3">
                                <?php 
                                    echo $this->Form->input('DeliveryDetail.pieces', array(
                                                                    'empty' => 'None',
                                                                    'required' => 'required',
                                                                    'class' => 'form-control item_type editable addquantityLimit',
                                                                    'label' => false
                                                                    // 'value' => $deliveryEdit['DeliveryDetail']['quantity']
                                                                    ));
                                ?>
                            </div>

                             <div class="col-lg-6">
                                <?php 
                                    echo $this->Form->input('DeliveryDetail.measure', array(         
                                                                    'required' => 'required',
                                                                    'class' => 'form-control required  ',

                                                                    'options' => array($measureList),
                                                                    'empty' => '--Select Measure--',
                                                                    'label' => false,
                                                                    'type' => 'select',
                                                                    'required' => 'required',
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
                
            </div>
        </div>
    </div> 

    <div class="md-overlay"></div>

     <div class="modal fade" id="#myModalPrint?php echo $deliveryDataList['DeliveryDetail']['id'] ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content margintop">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delivery Schedule</h4>
                </div>
                <div class="modal-body">
                    <?php  echo $this->Form->create('Delivery',array('url'=>(array('controller' => 'deliveries', 
                            'action' => 'add', $clientsOrder['ClientOrderDeliverySchedule']['id'],$clientsOrderUuid)),'class' => 'form-horizontal'))?>
                    

                        <div class="form-group" id="existing_items">
                            <div class="col-lg-9">

                                            <?php 
                                                echo $this->Form->input('ClientOrderDeliverySchedule.id', array('class' => 'form-control item_type required',
                                                    'type' => 'hidden',
                                                    'value' => $clientsOrder['ClientOrderDeliverySchedule']['id']
                                                    ));
                                            ?>

                                            

                                           <!--  <?php  echo $this->Form->input('QuotationItemDetail.quantity', array(
                                                            'type' => 'hidden',
                                                            'class' => 'form-control item_type',
                                                                'label' => false,
                                                                'value' => $quantityInfo[$clientsOrder['QuotationDetail']['quotation_id']],
                                                                'id' => 'quantity')); ?> -->
                            </div>
                        </div>

                        <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"><span style="color:red">*</span>D.R. #</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('dr_uuid', array(
                                                                    'class' => 'form-control item_type editable required',
                                                                    'label' => false
                                                                    ));
                                ?>

                                <?php 
                                                echo $this->Form->input('ClientOrderDeliverySchedule.quantity', array('class' => 'form-control item_type required',
                                                    'type' => 'hidden',
                                                    'value' => $clientsOrder['ClientOrderDeliverySchedule']['quantity']
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
                
            </div>
        </div>
    </div>

    <script>
    
        jQuery(document).ready(function(){
            $("#ClientOrderDeliveryScheduleViewForm").validate();
            $('#date').datepicker({
                format: 'yyyy-mm-dd'
            });
          
        });

       

    </script>

    