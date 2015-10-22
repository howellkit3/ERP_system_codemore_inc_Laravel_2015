<?php if($indicator == "purchasing"){
	
		 echo $this->element('Purchasing.purchasings_option');?><br><br> <?php 
	}else{

	 echo $this->element('setting_option');?><br><br><?php
	 

} ?><br><br>
<?php echo $this->Html->script(array(
									'jquery',
									'compound_substrate',
									'AddLayerCorrugatedPaper',
									'AddLayerCompoundSubstrate'
							)); ?>
<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
					<h1 class="pull-left">
						Edit Compound Substrate
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'item_group','tab' => 'tab-compound_substrates'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('CompoundSubstrate',array('url'=>(array('controller' => 'settings','action' => 'compound_substrate'))));?>
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Name</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('CompoundSubstrate.name', array(
																		'class' => 'form-control item_type required',
								                                         'label' => false,
								                                         'placeholder' => 'Compoundn Substrate name'
																		)); 
	                                            echo $this->Form->input('CompoundSubstrate.id', array(
																		'class' => 'form-control item_type',
								                                        'label' => false,
								                                        'hidden' => 'hidden'
																		)); 
												echo $this->Form->input('CompoundSubstrate.indicator', array(
																		'class' => 'form-control ',
											                            'label' => false,
											                            'type' => 'hidden',
											                            'value' => $indicator));
																		
                                            ?>

										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Category</label>
										<div class="col-lg-8">
											<?php 
												echo $this->Form->input('CompoundSubstrate.category_id', array(
														'options' => array($categoryData),
														'type' => 'select',
														'label' => false,
														'class' => 'form-control required categorylist',
														'empty' => '---Select Item Category---'
													)); 
											?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('ItemTypeHolder.id',array('id' => 'selected_type')); ?>
												<?php echo $this->Form->input('CompoundSubstrate.type_id', array(
														'options' => '',
														'type' => 'select',
														'label' => false,
														'class' => 'form-control required categorylist',
														'empty' => '---Select Item Type---'
												)); 
												?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Manufacturer</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('CompoundSubstrate.manufacturer_id', array(
														'options' => array($supplierData),
														'type' => 'select',
														'label' => false,
														'class' => 'form-control categorylist',
														'empty' => '---Select Supplier---'
											)); 
											?>
										</div>
									</div>

									<div class="form-group substrate-layers compoundMe"> <br>
										<label class="col-lg-2 control-label">
											<span style="color:red">*</span>Layer
										</label>
										<div class="col-lg-7">
											<?php 
												echo $this->Form->input('CompoundSubstrate.layers', array(
													'class' => 'form-control required layer edit coumpundVal',
													'readonly' => true,
						                            'label' => false,
						                           	'style'=>'width: 150px'));
											?>
										</div>
										<div class="col-lg-1">
											<a href="#" class="btn btn-primary addCompundNow mrg-b-lg pull-right"><i class="fa fa-plus-circle fa-lg"></i> Add Layer</a>
										</div>
									</div>

									
									<?php if (!empty($this->request->data['CompoundSubstrate']['layers'])) : ?>	

										<?php foreach($this->request->data['ItemGroupLayer'] as $key => $layers) : 
											echo $this->Form->input('IdHolder.'.$key.'.id', array(
                    								'class' => 'form-control item_type editable',
                    								'value' => $layers['id'],
                                                    'label' => false,
                                                    'type' => 'hidden'
                									)); 
										?>	
											<div class="form-group newField">
												<label class="col-lg-3 control-label">
													<span style="color:red">*</span>Substrate 
												</label>

												<div class="col-lg-6">
													<input type="text" maxlength="120" required = "required" placeholder = "Substrate name" class="form-control required layer" name="data[ItemGroupLayer][<?php echo $key ?>][substrate]" value="<?php echo $layers['substrate']?>">

												</div>

												<?php	if( $key != 0) { ?>
													<div class="col-lg-2">
														<button type="button" class="remove-field remove-CompoundMe btn btn-danger" ><i class="fa fa-minus" ></i> </button>
													</div>
												<?php } ?>

											</div>
										<?php endforeach; ?>
									<?php endif; ?>

									<section class="compoundLayer"></section>
									
									<div class="form-group">
										<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('CompoundSubstrate.remarks', array(
                        								'class' => 'form-control item_type',
	                                                    'label' => false,
	                                                    'placeholder' => 'Remarks'));
                                            ?>

										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit Compound Substrate</button>&nbsp;
											<?php 
						                        echo $this->Html->link('Cancel', array('controller' => 'settings', 'action' => 'item_group','tab' => 'tab-compound_substrates'),array('class' =>'btn btn-default','escape' => false));
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
 
<script>
	jQuery(document).ready(function($){
  		$("#CompoundSubstrateCompoundSubstrateEditForm").validate();
  	});
</script>