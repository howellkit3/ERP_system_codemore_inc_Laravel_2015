<?php echo $this->element('setting_option');?><br><br>
<?php echo $this->Html->script('AddSubstrate'); ?>
<?php echo $this->Html->script('AddGeneralItem'); ?>
<?php echo $this->Html->script('AddCompoundSubstrate');?>
<?php echo $this->Html->script('AddCorrugatedPaper');?>
<?php echo $this->Html->script('AddLayer'); ?>

<?php 
$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-general-items';
?>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<div class="main-box-body clearfix">
				<div class="tabs-wrapper">
					<ul class="nav nav-tabs">
						<li class="<?php echo ($active_tab == 'tab-general-items') ? 'active' : '' ?>" alt="tab-general-items"><a href="#tab-general-items" data-toggle="tab">General Items</a></li>
						<li class="<?php echo ($active_tab == 'tab-substrates') ? 'active' : '' ?>" alt="tab-type"><a href="#tab-substrates" id = 'subtrates' data-toggle="tab">Substrates</a></li>
						<li class="<?php echo ($active_tab == 'tab-compound_substrates') ? 'active' : '' ?>" alt="tab-compound_substrates"><a href="#tab-compound_substrates" id = 'compound_substrates' data-toggle="tab">Compound Substrates</a></li>
						<li class="<?php echo ($active_tab == 'tab-corrugated_papers') ? 'active' : '' ?>" alt="tab-corrugated_papers"><a href="#tab-corrugated_papers" id = 'corrugated_papers' data-toggle="tab">Corrugated Papers</a></li>
					</ul>
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
													echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'category_index'),array('class' =>'btn btn-primary pull-right','escape' => false));
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
																	                            'placeholder' => 'Name Category'));
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

										<div class="row">
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
														<th class="text-center"><a href="#"><span>General Item ID</span></a></th>
														<th class="text-center"><a href="#"><span>Name</span></a></th>
														<th class="text-center"><a href="#"><span>Category</span></a></th>
														<th class="text-center"><a href="#"><span>Type</span></a></th>
														<th class="text-center"><a href="#"><span>Manufacturer</span></a></th>
														<th class="text-center"><a href="#"><span>Measure</span></a></th>
														<th class="text-center"><a href="#"><span>Created</span></a></th>
														<th>Action</th>
														</tr>
														</thead>

														<?php echo $this->element('general_item_table'); ?>

														</table>
														<hr>

														<div class="paging" id="">
														<?php
											               
											                echo $this->Paginator->prev('< ' . __('previous'), null , null, array('class' => 'disable'));
											                echo $this->Paginator->numbers(array('separator' => '',null, array('paginate' => 'ItemTypeHolder')));
											                echo $this->Paginator->next(__('next') . ' >',null, null, array('class' => 'disable'));

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
																		<?php echo $this->Form->input('Substrate.category_id', array(
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
																		<?php echo $this->Form->input('Substrate.type_id', array(
																		'options' => '',
																		'type' => 'select',
																		'label' => false,
																		'class' => 'form-control required categorylist',
																		'empty' => '---Select Item Type---',
																		//'required' => 'required'
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
																		'empty' => '---Select Supplier---',
																		'required' => 'required'
																		)); 
																	?>
																	</div>
																</div>

																<div class="form-group"> <br>
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
																	<div class="col-lg-8">
																		<?php 
																		echo $this->Form->input('Substrate.type', array(
																									'class' => 'form-control item_type',
																		                            'label' => false,
																		                            'required' => 'required',
																		                            'placeholder' => 'Name Category'));
																		?>
																	</div>
																</div>

																<div class="form-group"> <br>
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Thickness</label>
																	<div class="col-lg-8">
																		<?php 
																		echo $this->Form->input('Substrate.thickness', array(
																									'class' => 'form-control item_type',
																		                            'label' => false,
																		                            'required' => 'required',
																		                            'placeholder' => 'Name Category'));
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

										<div class="row">
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
																	<th class="text-center"><a href="#"><span>Substrate ID</span></a></th>
																	<th class="text-center"><a href="#"><span>Name</span></a></th>
																	<th class="text-center"><a href="#"><span>Category</span></a></th>
																	<th class="text-center"><a href="#"><span>Type</span></a></th>
																	<th class="text-center"><a href="#"><span>Manufacturer</span></a></th>
																	<th class="text-center"><a href="#"><span>Type</span></a></th>
																	<th class="text-center"><a href="#"><span>Thickness</span></a></th>
																	<th class="text-center"><a href="#"><span>Created</span></a></th>
																	<th>Action</th>
																</tr>
																</thead>

																<?php
																	 echo $this->element('substrate_table'); 
																  ?>

															</table>
															<hr>

															<div class="paging" id="">
														<?php
											               
											                echo $this->Paginator->prev('< ' . __('previous'), null , null, array('class' => 'disable'));
											                echo $this->Paginator->numbers(array('separator' => '',null, array('paginate' => 'ItemTypeHolder')));
											                echo $this->Paginator->next(__('next') . ' >',null, null, array('class' => 'disable'));

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
																									'class' => 'form-control name',
																		                            'label' => false,
																		                            'required' => 'required',
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
																	<?php 
																		echo $this->Form->input('CompoundSubstrate.type_id', array(
																									'options' => '',
																									'type' => 'select',
																									'label' => false,
																									'class' => 'form-control required typelist',
																									'empty' => '---Select Item Type---'
																									//'required' => 'required'
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
																									'empty' => '---Select Supplier---',
																									'required' => 'required'
																									)); 
																?>
																</div>
															</div>

															<div class="form-group"> <br>
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Layer</label>
																<div class="col-lg-8">
																		<?php 
																			echo $this->Form->input('CompoundSubstrate.layers', array(
																									'class' => 'form-control layer',
																		                            'label' => false,
																		                            'rule' => 'numeric',
																		                           	'style'=>'width: 150px',
																		                            'placeholder' => 'Layer'));
																		?>
																</div>
															</div>

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

									<div class="row">
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
													<th>Action</th>
													</tr>
													</thead>

													<?php echo $this->element('compound_substrate_table'); ?>

													</table>
													<hr>

													<div class="paging" id="">
														<?php
											               
											                echo $this->Paginator->prev('< ' . __('previous'), null , null, array('class' => 'disable'));
											                echo $this->Paginator->numbers(array('separator' => '',null, array('paginate' => 'ItemTypeHolder')));
											                echo $this->Paginator->next(__('next') . ' >',null, null, array('class' => 'disable'));

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

										<?php
											 echo $this->Form->create('CorrugatedPaper',array('url'=>(array('controller' => 'settings','action' =>'corrugated_paper'))));
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
																		echo $this->Form->input('CorrugatedPaper.name', array(
																									'class' => 'form-control item_type',
																		                            'label' => false,
																		                            'required' => 'required',
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

															<div class="form-group"> <br>
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Layer</label>
																<div class="col-lg-8">
																		<?php 
																			echo $this->Form->input('CorrugatedPaper.layers', array(
																									'class' => 'form-control layer',
																		                            'label' => false,
																		                            'rule' => 'numeric',
																		                           	'style'=>'width: 150px',
																		                            'placeholder' => 'Layer'));
																		?>
																</div>
															</div>

															<div class="form-group">
																<label class="col-lg-2 control-label">Remarks</label>
																<div class="col-lg-8">
																	<?php 
																		echo $this->Form->textarea('CorrugatedPaper.remarks', array(
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

									<div class="row">
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
													<th class="text-center"><a href="#"><span>Corrugated Paper ID</span></a></th>
													<th class="text-center"><a href="#"><span>Name</span></a></th>
													<th class="text-center"><a href="#"><span>Category</span></a></th>
													<th class="text-center"><a href="#"><span>Type</span></a></th>
													<th class="text-center"><a href="#"><span>Manufacturer</span></a></th>
													<th class="text-center"><a href="#"><span>Measure</span></a></th>
													<th class="text-center"><a href="#"><span>Created</span></a></th>
													<th>Action</th>
													</tr>
													</thead>

													<?php echo $this->element('general_item_table'); ?>

													</table>
													<hr>
													  <div class="paging" id="">
														<?php
											               
											                echo $this->Paginator->prev('< ' . __('previous'), null , null, array('class' => 'disable'));
											                echo $this->Paginator->numbers(array('separator' => '',null, array('paginate' => 'ItemTypeHolder')));
											                echo $this->Paginator->next(__('next') . ' >',null, null, array('class' => 'disable'));

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




