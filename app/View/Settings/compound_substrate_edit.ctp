<?php echo $this->element('setting_option');?><br><br>
<?php echo $this->Html->script(array(
									'jquery',
									'compound_substrate',
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
		<?php echo $this->Form->create('CompoundSubstrate',array('url'=>(array('controller' => 'settings','action' => 'compound_substrate_edit'))));?>
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
																		'class' => 'form-control item_type',
								                                         'label' => false,
								                                         'placeholder' => 'Compoundn Substrate name'
																		)); 
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
														'empty' => '---Select Item Category---',
														'required' => 'required'
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
														'empty' => '---Select Item Type---',
														'required' => 'required'
												)); 
												?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Manufacturer</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('CompoundSubstrate.manufacturer_id', array(
														'options' => array($supplierData),
														'type' => 'select',
														'label' => false,
														'class' => 'form-control required categorylist',
														'empty' => '---Select Supplier---',
														'required' => 'required'
											)); 
											?>
										</div>
									</div>

									<a data-toggle="modal" href="#myModalLayer" class="btn btn-primary mrg-b-lg pull-right addSchedButton align"><i class="fa fa-plus-circle fa-lg"></i> Add Layer</a>


									<div class="form-group substrate-layers"> <br>
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Layer</label>
										<div class="col-lg-8">
													<?php 
														echo $this->Form->input('CompoundSubstrate.layers', array(
																				'class' => 'form-control layer edit',
													                            'label' => false,
													                            'rule' => 'numeric',
													                           	'style'=>'width: 150px',
													                            'placeholder' => 'Layer'));
													?>
										</div>
									</div>

									
									<!--layers -->
							<?php if (!empty($this->request->data['CompoundSubstrate']['layers'])) : ?>	

								<?php $countLayers = 1; foreach($this->request->data['ItemGroupLayer'] as $key => $layers) : ?>
							<div class="form-group layercount">

								<label class="col-lg-3 control-label">
									<span style="color:red">*</span>Substrate <?php echo $countLayers ?>
								</label>

							<div class="col-lg-7">
								<input type="hidden" maxlength="120"  class="form-control layer" name="data[ItemGroupLayer][no][]" value="<?php echo $key; ?>">
							</div>

							<div class="col-lg-7">
								<input type="text" maxlength="120" required = "required" placeholder = "Substrate name" class="form-control layer" name="data[ItemGroupLayer][substrate][<?php echo $key ?>][substrate]" value="<?php echo $layers['substrate']?>">
									<input type="hidden" required = "required" placeholder = "Substrate name" class="form-control layer" name="data[ItemGroupLayer][substrate][<?php echo $key ?>][id]" value="<?php echo $layers['id']?>">
									<input type="hidden" class="form-control layer remove-field" name="data[ItemGroupLayer][substrate][<?php echo $key ?>][remove]" value="false">
							</div>

							<?php	if( $key != 0) { ?>

									<div class="form-group">
												<label for="inputPassword1" class=" control-label"></label>
										<div class="col-lg-1"> 
											<button type="button" class="remove-field remove-layers btn btn-danger" ><i class="fa fa-minus" ></i> </button>
										</div>
									</div>

									<?php } ?>

							</div>
								<?php $countLayers++; endforeach; ?>

							<?php endif; ?>

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
						                        echo $this->Html->link('Cancel', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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

<div class="modal fade" id="myModalLayer" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Layer</h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('ItemGroupLayer',array('url'=>(array('controller' => 'settings','action' => 'substrate_layer')),'class' => 'form-horizontal'));?>
               			  <?php 
                                echo $this->Form->input('CompoundSubstrate.id', array(
        								'class' => 'form-control item_type',
                                        'label' => false,
                                        'type' => 'hidden'
                                        ));

                            ?>
               

                   
                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Substrate</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('ItemGroupLayer.substrate', array('class' => 'form-control required',
                                                                                                           'required' => 'required', 
                                                                                                            'label' => false));
                                ?>
                            </div>
                        </div>

                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                    </form>
                    
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 