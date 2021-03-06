<?php //echo $this->element('setting_option');?><br><br>
<?php echo $this->Html->script(array(
									'AddSubstrate',
									'AddGeneralItem',
									'AddCompoundSubstrate',
									'AddCorrugatedPaper',
									 'AddLayerCompoundSubstrate',
									 'AddLayerCorrugatedPaper',	
									'ajax_pagination'
							)); ?>

<?php 

$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-general-items';
?>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			
			<ul class="nav nav-tabs">
				<li class="<?php echo ($active_tab == 'tab-general-items') ? 'active' : '' ?>" alt="tab-general-items"><a href="#tab-general-items" data-toggle="tab">General Items</a></li>
				<li class="<?php echo ($active_tab == 'tab-substrates') ? 'active' : '' ?>" alt="tab-type"><a href="#tab-substrates" id = 'subtrates' data-toggle="tab">Substrates</a></li>
				<li class="<?php echo ($active_tab == 'tab-compound_substrates') ? 'active' : '' ?>" alt="tab-compound_substrates"><a href="#tab-compound_substrates" id = 'compound_substrates' data-toggle="tab">Compound Substrates</a></li>
				<li class="<?php echo ($active_tab == 'tab-corrugated_papers') ? 'active' : '' ?>" alt="tab-corrugated_papers"><a href="#tab-corrugated_papers" id = 'corrugated_papers' data-toggle="tab">Corrugated Papers</a></li>
			</ul>
			
			<div class="main-box-body clearfix">
				<div class="tabs-wrapper">
					<div class="tab-content">
							<div class="tab-pane fade  <?php echo ($active_tab == 'tab-general-items') ? 'in active' : '' ?>" id="tab-general-items">
								<div class="row">
									<div class="col-lg-12">
										<div class="row">
										<div class="col-lg-12">
											<header class="main-box-header clearfix">
													<h1 class="pull-left">
														Add General Items
													</h1>

													<?php 
													echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
													?>

											</header>
										</div>
									</div>

										<?php
											 echo $this->Form->create('GeneralItem',array('url'=>(array('controller' => 'settings','action' => 'item_group'))));
										?>

									<div class="row">
										<div class="col-lg-12">
											<div class="main-box">
												<div class="main-box-body clearfix">
													<div class="main-box-body clearfix">
														<div class="form-horizontal">
															<div class="form-group"> <br>
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Name</label>
																<div class="col-lg-8">
																		<?php 
																		echo $this->Form->input('GeneralItem.name', array(
																									'class' => 'form-control item_type',
																		                            'label' => false,
																		                            'required' => 'required',
																		                            'placeholder' => 'Name General Item'));
																		?>
																</div>
															</div>

															<div class="form-group">
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Category</label>
																<div class="col-lg-8">
																	<input type="hidden" id="selected_type" value="">
																	<?php echo $this->Form->input('GeneralItem.category_id', array(
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
																	<input type="hidden" id="selected_type" value="">
																	<?php echo $this->Form->input('GeneralItem.type_id', array(
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
																	<input type="hidden" id="selected_type" value="">
																	<?php echo $this->Form->input('GeneralItem.manufacturer_id', array(
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

															<div class="form-group"> <br>
															<label class="col-lg-2 control-label">Measure</label>
																<div class="col-lg-8">
																	<?php 
																	echo $this->Form->input('GeneralItem.measure', array(
																								'class' => 'form-control item_type',
																	                            'label' => false,
																	                             //'required' => 'required',
																	                            'placeholder' => 'Measure'));
																	?>
																</div>
															</div>

															<div class="form-group">
																<label class="col-lg-2 control-label">Remarks</label>
																<div class="col-lg-8">
																	<?php 
																	echo $this->Form->textarea('GeneralItem.remarks', array(
																	'class' => 'form-control item_type',
																	'label' => false,
																	'placeholder' => 'Remarks'));
																	?>
																</div>
															</div>

															<div class="form-group">
																<div class="col-lg-2"></div>
																	<div class="col-lg-8">

																		<button type="submit" class="btn btn-primary pull-left">Submit General Item</button>&nbsp;

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

										<div class="row" id="general-item-table">
											<div class="col-lg-12">
												<div class="main-box">
												<header class="main-box-header clearfix">
												<h1>General Item List</h1>
												</header>
													<div class="main-box-body clearfix">
														<div class="table-responsive">
														<table class="table table-striped table-hover">
														<thead>
														<tr>
														<th class="text-center" width="153px"><a href="#"><span>General Item ID</span></a></th>
														<th class="text-center"><a href="#"><span>Name</span></a></th>
														<th class="text-center"><a href="#"><span>Category</span></a></th>
														<th class="text-center"><a href="#"><span>Type</span></a></th>
														<th class="text-center"><a href="#"><span>Manufacturer</span></a></th>
														<th class="text-center"><a href="#"><span>Measure</span></a></th>
														<th class="text-center"><a href="#"><span>Created</span></a></th>
														<th style="width:140px">Action</th>
														</tr>
														</thead>

														<?php echo $this->element('general_item_table'); ?>

														</table>
														<hr>

														<div class="paging" id="general_items_pagination">
												

										                 <?php
										               
										                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'GeneralItem','model' => 'GeneralItem'), null, array('class' => 'disable','model' => 'GeneralItem'));
										                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'GeneralItem'), array('paginate' => 'GeneralItem'));
										                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'GeneralItem','model' => 'GeneralItem'), null, array('class' => 'disable'));

										                ?>

										                </div>


														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade  <?php echo ($active_tab == 'tab-substrates') ? 'in active' : '' ?>" id="tab-substrates">
								<div class="row">
									<div class="col-lg-12">
									<div class="row">
									<div class="col-lg-12">
									<header class="main-box-header clearfix">

									<h1 class="pull-left">
															Add Substratres
														</h1>

														<?php 
														echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'item_group'),array('class' =>'btn btn-primary pull-right','escape' => false));
														?>

												</header>
											</div>
										</div>

											<?php
												 echo $this->Form->create('Substrate',array('url'=>(array('controller' => 'settings','action' => 'substrate'))));
											?>

										<div class="row">
											<div class="col-lg-12">
												<div class="main-box">
													<div class="main-box-body clearfix">
														<div class="main-box-body clearfix">
															<div class="form-horizontal">
																<div class="form-group"> <br>
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Name</label>
																	<div class="col-lg-8">
																			<?php 
																			echo $this->Form->input('Substrate.name', array(
																				'class' => 'form-control item_type required',
													                            'label' => false,
													                            'placeholder' => 'Name General Item'));
																			?>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Category</label>
																	<div class="col-lg-8">
																		<input type="hidden" id="selected_type" value="">
																		<?php echo $this->Form->input('Substrate.category_id', array(
																		'options' => array($categoryData),
																		'type' => 'select',
																		'label' => false,
																		'class' => 'form-control required categorylist',
																		'empty' => '---Select Item Category---',
																		'id' => 'substrateCaterogy'
																		)); 
																	?>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
																	<div class="col-lg-8">
																		<input type="hidden" id="selected_type" value="">
																		<?php echo $this->Form->input('Substrate.type_id', array(
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
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Manufacturer</label>
																	<div class="col-lg-8">
																		<input type="hidden" id="selected_type" value="">
																		<?php echo $this->Form->input('Substrate.manufacturer_id', array(
																		'options' => array($supplierData),
																		'type' => 'select',
																		'label' => false,
																		'class' => 'form-control required categorylist',
																		'empty' => '---Select Supplier---'
																		)); 
																	?>
																	</div>
																</div>

																<div class="form-group"> <br>
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
																	<div class="col-lg-8">
																		<?php 
																		echo $this->Form->input('Substrate.type', array(
																			'class' => 'form-control item_type required',
												                            'label' => false,
												                            'placeholder' => 'Type'));
																		?>
																	</div>
																</div>

																<div class="form-group"> <br>
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Thickness</label>
																	<div class="col-lg-8">
																		<?php 
																		echo $this->Form->input('Substrate.thickness', array(
																									'class' => 'form-control item_type required',
																		                            'label' => false,
																		                            'placeholder' => 'Thickness'));
																		?>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-lg-2 control-label">Remarks</label>
																	<div class="col-lg-8">
																		<?php 
																		echo $this->Form->textarea('Substrate.remarks', array(
																		'class' => 'form-control item_type',
																		'label' => false,
																		'placeholder' => 'Remarks'));
																		?>
																	</div>
																</div>

																<div class="form-group">
																	<div class="col-lg-2"></div>
																		<div class="col-lg-8">

																			<button type="submit" class="btn btn-primary pull-left">Submit Substrates</button>&nbsp;

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

										<div class="row" id="substrate-table">
											<div class="col-lg-12">
												<div class="main-box">
												<header class="main-box-header clearfix">
												<h1>Substrate List</h1>
												</header>
													<div class="main-box-body clearfix">
														<div class="table-responsive">
															<table class="table table-striped table-hover">
																<thead>
																<tr>
																	<th class="text-center" width="153px"><a href="#"><span>Substrate ID</span></a></th>
																	<th class="text-center"><a href="#"><span>Name</span></a></th>
																	<th class="text-center"><a href="#"><span>Category</span></a></th>
																	<th class="text-center"><a href="#"><span>Type</span></a></th>
																	<th class="text-center"><a href="#"><span>Manufacturer</span></a></th>
																	<th class="text-center"><a href="#"><span>Type</span></a></th>
																	<th class="text-center"><a href="#"><span>Thickness</span></a></th>
																	<th class="text-center"><a href="#"><span>Created</span></a></th>
																	<th style="width:135px">Action</th>
																</tr>
																</thead>

																<?php
																	 echo $this->element('substrate_table'); 
																  ?>

															</table>
															<hr>

														<div class="paging" id="substrate_pagination">
															 <?php
											               
											                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Substrate','model' => 'Substrate'), null, array('class' => 'disable','model' => 'Substrate'));
											                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Substrate'), array('paginate' => 'Substrate'));
											                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Substrate','model' => 'Substrate'), null, array('class' => 'disable'));

											                ?>
										                </div>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="tab-pane fade  <?php echo ($active_tab == 'tab-compound_substrates') ? 'in active' : '' ?>" id="tab-compound_substrates">
								<div class="row">
									<div class="col-lg-12">
										<div class="row">
										<div class="col-lg-12">
											<header class="main-box-header clearfix">
													<h1 class="pull-left">
														Add Compound Substrates
													</h1>

													<?php 
													echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'category_index'),array('class' =>'btn btn-primary pull-right','escape' => false));
													?>

											</header>
										</div>
									</div>

									<?php
										 echo $this->Form->create('CompoundSubstrate',array('url'=>(array('controller' => 'settings','action' =>'compound_substrate'))));
									?>

										<div class="row">
											<div class="col-lg-12">
												<div class="main-box">
													<div class="main-box-body clearfix">
														<div class="main-box-body clearfix">
															<div class="form-horizontal">
																<div class="form-group"> <br>
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Name</label>
																	<div class="col-lg-8">
																			<?php 
																				echo $this->Form->input('CompoundSubstrate.name', array(
																					'class' => 'form-control required name',
														                            'label' => false,
														                            'placeholder' => 'Compound Substrate Name'));
																			?>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Category</label>
																	<div class="col-lg-8">
																		<input type="hidden" id="selected_type" value="">
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
																		<input type="hidden" id="selected_type" value="">
																		<?php 
																			echo $this->Form->input('CompoundSubstrate.type_id', array(
																				'options' => '',
																				'type' => 'select',
																				'label' => false,
																				'class' => 'form-control required typelist',
																				'empty' => '---Select Item Type---'
																			)); 
																	?>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Manufacturer</label>
																	<div class="col-lg-8">
																		<input type="hidden" id="selected_type" value="">
																		<?php
																			 echo $this->Form->input('CompoundSubstrate.manufacturer_id', array(
																				'options' => array($supplierData),
																				'type' => 'select',
																				'label' => false,
																				'class' => 'form-control required supplier',
																				'empty' => '---Select Supplier---'
																				)); 
																	?>
																	</div>
																</div>

																<div class="form-group compoundMe"> <br>
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Layer</label>
																	<div class="col-lg-7">
																			<?php 
																				echo $this->Form->input('CompoundSubstrate.layers', array(
																					'class' => 'form-control layer required coumpundVal',
														                            'label' => false,
														                            'readonly' => true,
														                            'type' => 'text',
														                           	'style'=>'width: 150px',
														                            'value' => 1));
																			?>
																	</div>
																	<div class="col-lg-1">
																		<a href="#" class="btn btn-primary addCompundNow mrg-b-lg pull-right"><i class="fa fa-plus-circle fa-lg"></i> Add Layer</a>
																	</div>
																</div>

																<section class="compoundLayer">
																	<div class="form-group newField">
						 												<label class="col-lg-3 control-label">
						 													<span style="color:red">*</span>Substrate
						 												</label>
																		<div class="col-lg-6">
																			<input type="text" placeholder="Substrate Name" class="form-control required" name="data[ItemGroupLayer][0][substrate]" />
																		</div>
			 														</div>
																</section>

																<div class="form-group">
																	<label class="col-lg-2 control-label">Remarks</label>
																	<div class="col-lg-8">
																		<?php 
																		echo $this->Form->textarea('CompoundSubstrate.remarks', array(
																			'class' => 'form-control remark',
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

									<div class="row" id="compound-substrate">
										<div class="col-lg-12">
											<div class="main-box">
											<header class="main-box-header clearfix">
											<h1>Compound Substrate List</h1>
											</header>
												<div class="main-box-body clearfix">
													<div class="table-responsive">
													<table class="table table-striped table-hover">
													<thead>
													<tr>
													<th class="text-center"><a href="#"><span>Compound Substrate ID</span></a></th>
													<th class="text-center"><a href="#"><span>Name</span></a></th>
													<th class="text-center"><a href="#"><span>Category</span></a></th>
													<th class="text-center"><a href="#"><span>Type</span></a></th>
													<th class="text-center"><a href="#"><span>Manufacturer</span></a></th>
													<th class="text-center"><a href="#"><span>Created</span></a></th>
													<th style="width:135px">Action</th>
													</tr>
													</thead>

													<?php echo $this->element('compound_substrate_table'); ?>

													</table>
													<hr>

													<div class="paging" id="compound_substrate_pagination">
															 <?php
											               
											                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'CompoundSubstrate','model' => 'CompoundSubstrate'), null, array('class' => 'disable','model' => 'CompoundSubstrate'));
											                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'CompoundSubstrate'), array('paginate' => 'CompoundSubstrate'));
											                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'CompoundSubstrate','model' => 'CompoundSubstrate'), null, array('class' => 'disable'));

											                ?>
										                </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade  <?php echo ($active_tab == 'tab-corrugated_papers') ? 'in active' : '' ?>" id="tab-corrugated_papers">
								<div class="row">
									<div class="col-lg-12">
										<div class="row">
										<div class="col-lg-12">
											<header class="main-box-header clearfix">
													<h1 class="pull-left">
														Add Corrugated Papers
													</h1>

													<?php 
													echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'category_index'),array('class' =>'btn btn-primary pull-right','escape' => false));
													?>

											</header>
										</div>
									</div>

									<?php echo $this->Form->create('CorrugatedPaper',array('url'=>(array('controller' => 'settings','action' =>'corrugated_paper')))); ?>

										<div class="row">
											<div class="col-lg-12">
												<div class="main-box">
													<div class="main-box-body clearfix">
														<div class="main-box-body clearfix">
															<div class="form-horizontal">
																<div class="form-group"> <br>
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Name</label>
																	<div class="col-lg-8">
																			<?php 
																			echo $this->Form->input('CorrugatedPaper.name', array(
																				'class' => 'form-control item_type required',
													                            'label' => false,
													                            'placeholder' => 'Corrugated Paper Name'));
																			?>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Category</label>
																	<div class="col-lg-8">
																		<input type="hidden" id="selected_type" value="">
																		<?php echo $this->Form->input('CorrugatedPaper.category_id', array(
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
																		<input type="hidden" id="selected_type" value="">
																		<?php echo $this->Form->input('CorrugatedPaper.type_id', array(
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
																		<input type="hidden" id="selected_type" value="">
																		<?php 
																		echo $this->Form->input('CorrugatedPaper.manufacturer_id', array(
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
																<section class="layerSection">
																	<div class="form-group layerLanding"> <br>
																		<label class="col-lg-2 control-label"><span style="color:red">*</span>Layer</label>
																		<div class="col-lg-7">
																				<?php 
																					echo $this->Form->input('CorrugatedPaper.layers', array(
																						'class' => 'form-control required layersC',
															                            'label' => false,
															                            'type' => 'text',
															                            'readonly' => true,
															                           	'style'=>'width: 150px',
															                           	'id' => 'layers',
															                            'value' => 1));
																				?>
																		</div>
																		<div class="col-lg-1">
																			<a href="#" class="btn btn-primary addLayerNow mrg-b-lg pull-right"><i class="fa fa-plus-circle fa-lg"></i> Add Layer</a>
																		</div>
																	</div>
																	<section class="appendLayer">
																		<div class="form-group">
																			<label class="col-lg-3 control-label"><span style="color:red">*</span>Substrate</label>
																			<div class="col-lg-2">
																					<?php 
																						echo $this->Form->input('ItemGroupLayer.0.substrate', array(
																							'class' => 'form-control required',
																                            'label' => false,
																                            'placeholder' => 'Substrate Name'));
																					?>
																			</div>
																			<label class="col-lg-1 control-label">Flute</label>
																			<div class="col-lg-2">
																					<?php 
																						echo $this->Form->input('ItemGroupLayer.0.flute', array(
																							'class' => 'form-control',
																                            'label' => false,
																                            'placeholder' => 'Flute'));
																					?>
																			</div>
																		</div>
																	</section>
																</section>

																<div class="form-group"> <br>
																	<label class="col-lg-2 control-label">Brust</label>
																	<div class="col-lg-8">
																			<?php 
																				echo $this->Form->input('CorrugatedPaper.brust', array(
																					'class' => 'form-control fct',
														                            'label' => false,
														                            'rule' => 'numeric',
														                           	'style'=>'width: 150px',
														                            'placeholder' => 'Brust'));
																			?>
																	</div>
																</div>

																<div class="form-group"> <br>
																	<label class="col-lg-2 control-label">FCT</label>
																	<div class="col-lg-8">
																			<?php 
																				echo $this->Form->input('CorrugatedPaper.fct', array(
																					'class' => 'form-control layer',
														                            'label' => false,
														                            'rule' => 'numeric',
														                           	'style'=>'width: 150px',
														                            'placeholder' => 'FCT'));
																			?>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-lg-2 control-label">Remarks</label>
																	<div class="col-lg-8">
																		<?php 
																			echo $this->Form->textarea('CorrugatedPaper.remark', array(
																				'class' => 'form-control item_type',
																				'label' => false,
																				'placeholder' => 'Remarks'));
																		?>
																	</div>
																</div>

																<div class="form-group">
																	<div class="col-lg-2"></div>
																		<div class="col-lg-8">

																			<button type="submit" class="btn btn-primary pull-left">Submit Corrugated Paper</button>&nbsp;

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

									<div class="row" id="corrugated-paper-table">
										<div class="col-lg-12">
											<div class="main-box">
											<header class="main-box-header clearfix">
											<h1>Corrugated Paper Lists</h1>
											</header>
												<div class="main-box-body clearfix">
													<div class="table-responsive">
														<table class="table table-striped table-hover">
															<thead>
																<tr>
																	<th class="text-center"><a href="#"><span>Corrugated Paper ID</span></a></th>
																	<th style="width:310px" class="text-center"><a href="#"><span>Name</span></a></th>
																	<th class="text-center"><a href="#"><span>Category</span></a></th>
																	<th class="text-center"><a href="#"><span>Type</span></a></th>
																	<th class="text-center"><a href="#"><span>Manufacturer</span></a></th>
																	<th class="text-center"><a href="#"><span>Created</span></a></th>
																	<th style="width:140px">Action</th>
																</tr>
															</thead>

															<?php echo $this->element('corrugated_paper_table'); ?>

														</table>
														<hr>
													 	<div class="paging" id="corrugated_paper_pagination">
															 <?php
											               
											                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'CorrugatedPaper','model' => 'CorrugatedPaper'), null, array('class' => 'disable','model' => 'CorrugatedPaper'));
											                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'CorrugatedPaper'), array('paginate' => 'CorrugatedPaper'));
											                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'CorrugatedPaper','model' => 'CorrugatedPaper'), null, array('class' => 'disable'));

											                ?>
										                </div>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	// jQuery(document).ready(function($){
 //  		$("#CorrugatedPaperItemGroupForm").validate();
 //  		$("#CompoundSubstrateItemGroupForm").validate();
 //  		$("#SubstrateItemGroupForm").validate();

  		

	// 	var option = $(this).val();$('#SubstrateCategoryId').change(function(){
	// 			$('.option-append').remove();
			
	// 			 var selected = $('#SubstrateCategoryId').val();
	// 			$.ajax({
	// 				url: serverPath + "settings/ajax_categ/"+option,
	// 				type: "get",
	// 				async: false,
	// 				dataType: "json",
	// 				success: function(data) {

	// 					$.each(data, function(key, value) {

	// 						if (value.id == selected) {

	// 							$option = "<option class='option-append' selected value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";	

	// 						} else {

	// 							$option = "<option class='option-append'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
								
	// 						}
	// 					     $('#SubstrateTypeId').append($option);
	// 					});			
	// 				}
	// 			});			

	// 	}).trigger('change');
	// });


</script>
