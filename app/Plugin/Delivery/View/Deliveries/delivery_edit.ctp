<?php echo $this->Html->script('Sales.quantityLimitDelivery');?>
<?php echo $this->element('deliveries_options'); ?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					                    
					<h1 class="pull-left">
						Edit Product
					</h1>

				<?php //foreach ($deliveryEdit as $deliveryDataList): ?>	

					<?php  //pr($deliveryEdit); 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'deliveries', 'action' => 'view', $clientsOrder[0]['ClientOrderDeliverySchedule']['id'],$clientsOrder[0]['QuotationDetail']['quotation_id'],$clientsOrder[0]['ClientOrder']['uuid']),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
					
				</header>

			</div>
		</div>
		<?php   echo $this->Form->create('Delivery',array('url'=>(array('controller' => 'deliveries','action' => 'delivery_edit',$clientsOrder[0]['ClientOrderDeliverySchedule']['uuid']))));?>			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">									
									<div class="form-group">
										<label class="col-lg-2 control-label">Delivery Receipt Number</label>
										<div class="col-lg-8">
										
	                                    

											<?php 
	                                            echo $this->Form->input('DeliveryDetail.dr_uuid', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'readonly' => 'readonly',
							                                                    'value' => [$deliveryEdit['Delivery']['clients_order_id']],
							                                                    'placeholder' => 'Item Name'));
                                            ?>

                                             <?php 
	                                            echo $this->Form->input('DeliveryDetail.id', array(
	                                            								'label' => false,
							                                                    'hidden' => 'hidden',
							                                                    'value' => $deliveryEdit['DeliveryDetail']['id']
							                                                    ));
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
							                                                    'value' => $clientOrderData[$deliveryEdit['Delivery']['clients_order_id']],
							                                                    'placeholder' => 'Item Name'));
					                            ?>

					                             <?php 
					                                        echo $this->Form->input('ClientOrderDeliverySchedule.quantity', array('class' => 'form-control item_type',
										                        'hidden' => 'hidden',
										                        'class' => '',
										                        'label' => false,
										                        'value' => $clientsOrder[0]['ClientOrderDeliverySchedule']['quantity']
										                        ));
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
									                                                    'value' => 
									                                                    date('Y-m-d',strtotime($deliveryEdit['DeliveryDetail']['schedule']))

									                                                   ));
			                                        ?>
                                        
											</div>
										</div>

									<div class="form-group">
	                                			<label class="col-lg-2 control-label">Quantity</label>
												<div class="col-lg-8">
													<?php 
			                                              echo $this->Form->input('DeliveryDetail.quantity', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'type' => 'text',
									                                                    'required' => 'required',
									                                                    'class' => 'form-control item_type datepik editable required quantityLimit',
									                                                    'value' => 
									                                                    $deliveryEdit['DeliveryDetail']['quantity']

									                                                   ));
			                                        ?>

			                                        <?php 
					                                        echo $this->Form->input('DeliveryDetail.limitquantity', array('class' => 'form-control item_type',
										                        'hidden' => 'hidden',
										                        'readonly' => 'readonly',
										                        'class' => '',
										                        'label' => false,
										                        'id' => 'quantity',
										                        'value' => $clientsOrder[0]['ClientOrderDeliverySchedule']['quantity']
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
									                                                    'class' => 'form-control item_type datepik editable required',
									                                                    'value' => 
									                                                    $deliveryEdit['DeliveryDetail']['location']

									                                                   ));
			                                        ?>
                                        
										</div>
									</div>

									<div class="form-group">
	                                			<label class="col-lg-2 control-label">Status</label>
												<div class="col-lg-8">
													<?php 
			                                              echo $this->Form->input('DeliveryDetail.status', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'type' => 'text',
									                                                    'class' => 'form-control item_type datepik editable ',
									                                                    'value' => 
									                                                    $deliveryEdit['DeliveryDetail']['status']

									                                                   ));
			                                        ?>
                                        
										</div>
									</div>

									<div class="form-group">
	                                			<label class="col-lg-2 control-label">Remarks</label>
												<div class="col-lg-8">
													<?php 
			                                              echo $this->Form->textarea('DeliveryDetail.remarks', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'type' => 'text',
									                                                    'required' => 'required',
									                                                    'class' => 'form-control item_type datepik editable required',
									                                                    'value' => 
									                                                    $deliveryEdit['DeliveryDetail']['remarks']

									                                                   ));
			                                        ?>
                                        
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit Product</button>&nbsp;
											<?php 
						                        echo $this->Html->link('Cancel', array('controller' => 'deliveries', 'action' => 'view',
                                                                         $clientsOrder[0]['ClientOrderDeliverySchedule']['id'],$clientsOrder[0]['QuotationDetail']['quotation_id'],$clientsOrder[0]['ClientOrder']['uuid']),array('class' =>'btn btn-default','escape' => false));
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
		<?php 
            //endforeach; 
         ?>    
	</div>
</div>

<script>
    
        jQuery(document).ready(function($){
            $("#ClientOrderDeliveryScheduleViewForm").validate();
            $('#date').datepicker({
                format: 'yyyy-mm-dd'
            });
          
        });

        jQuery("#ClientOrderDeliveryScheduleViewForm").validate();
</script>
