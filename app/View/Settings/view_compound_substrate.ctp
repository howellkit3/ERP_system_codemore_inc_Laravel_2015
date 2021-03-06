<div style="clear:both"></div>

<?php if($indicator == "purchasing"){
	
		 echo $this->element('Purchasing.purchasings_option');?> <?php 
	}else{

	 echo $this->element('setting_option');?><?php
	 

} ?>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
					<?php 
                   	 echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'item_group','tab' => 'tab-compound_substrates'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
		<br>	
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<header class="main-box-header clearfix">
						<h2 class="pull-left">Compound Substrate Details</h2>
					</header>
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">									
									<div class="form-group">
										<label class="col-lg-2 control-label">Code</label>
										<input type="hidden" id="selected_type" value="<?php // echo $this->request->data['Product']['id']; ?>">
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('CompoundSubstrate.uuid', array(
	                                            								'class' => 'form-control item_type',
	                                            								'disabled' => true,
							                                                    'label' => false   
							                                            ));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Name</label>
										<div class="col-lg-8">
											<?php 


	                                            echo $this->Form->input('CompoundSubstrate.name', array(
																		'class' => 'form-control item_type',
								                                         'label' => false,
								                                         'disabled' => true
																		)); 
                                            
	                                            
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Category</label>
										<div class="col-lg-8">
											<?php 
												echo $this->Form->input('CompoundSubstrate.category_id', array(
														'options' => array($categoryData),
														'class' => 'form-control item_type',
							                            'label' => false,
							                            'disabled' => true
													)); 
											?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Type</label>
										<div class="col-lg-8">
											<?php 
												echo $this->Form->input('CompoundSubstrate.type_id', array(
																			'options' => array($typeData),
																			'class' => 'form-control item_type',
												                            'label' => false,
												                            'disabled' => true
																		)); 
											?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Manufacturer</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('CompoundSubstrate.manufacturer_id', array(
														'options' => array($supplierData),
														'class' => 'form-control item_type',
							                            'label' => false,
							                            'disabled' => true
											)); 
											?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('CompoundSubstrate.remarks', array(
                        								'class' => 'form-control item_type',
	                                                    'label' => false,
	                                                    'disabled' => true,
	                                                    'placeholder' => 'Remarks'));
                                            ?>

										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<header class="main-box-header clearfix">
						<h2 class="pull-left">Layers</h2>
					</header>
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">									
									<?php foreach ($compoundLayer as $key => $layerList) {  $key++ ?>
										<div class="form-group">
											<label class="col-lg-2 control-label">Substrate <?php echo $key;?></label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('ItemGroupLayers.substrate', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'disabled' => true,
								                                                 	'value' => ucfirst($layerList['ItemGroupLayer']['substrate'])));
	                                            ?>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
	</div>
</div>

<script>

	jQuery(document).ready(function($){
		//datepicker
		$('.datepick').datepicker({
			format: 'yyyy-mm-dd'
		});
		
	});

</script>