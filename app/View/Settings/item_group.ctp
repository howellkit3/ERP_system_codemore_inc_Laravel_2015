<?php 

if($indicator == "purchasing"){
	
		 echo $this->element('Purchasing.purchasings_option');?><br><br> <?php 
	}else{

	 echo $this->element('setting_option');?><br><br><?php
	
	 $indicator == "setting";
} ?>

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

<div class="row ">
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

																		<?php 
																		echo $this->Form->input('GeneralItem.indicator', array(
																									'class' => 'form-control ',
																		                            'label' => false,
																		                            'type' => 'hidden',
																		                            'value' => $indicator));
																		?>
																		<?php 

																		if(!empty($this->params['pass'][0])){

																			echo $this->Form->input('GeneralItem.params', array(
																										'class' => 'form-control params ',
																			                            'label' => false,
																			                            'type' => 'hidden',
																			                            'value' => substr($this->params['pass'][0], 0, 10)));
																			}
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
																<label class="col-lg-2 control-label">Manufacturer</label>
																<div class="col-lg-8">
																	<input type="hidden" id="selected_type" value="">
																	<?php echo $this->Form->input('GeneralItem.manufacturer_id', array(
																	'options' => array($supplierData),
																	'type' => 'select',
																	'label' => false,
																	'class' => 'form-control  categorylist',
																	'empty' => '---Select Supplier---'
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

										<div class="row" id="general-item-table ">
											<div class="col-lg-12">
												<div class="main-box model-row">

												<header class="main-box-header clearfix">

													<div class="row">
													  <div class="col-xs-6"><h1>General Item List </h1></div>
													 	<div class="col-xs-6">

															<div class="filter-block pull-right">
										                        <div class="form-group pull-left model-search">
										                            
										                                <input placeholder="Search..." class="form-control searchOrder "  />
										                                <i class="fa fa-search search-icon"></i>

										                                <?php 

																			echo $this->Form->input('CompoundSubstrate.model', array(
																				'class' => 'form-control model-name',
													                            'type' => 'hidden',
													                            'value' => '1',
													                            'placeholder' => 'Corrugated Paper Name'));
																		?>
										                            
										                        </div>
										                        
										                    </div>
							                    		</div>
													</div>
												
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

														<tbody aria-relevant="all" aria-live="polite" class="requestFields" role="alert" >
                          
								                                <?php echo $this->element('general_item_table'); ?>
								                         
								                        </tbody>
								                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
								                        </tbody>

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
								<div class="row ">
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
													                            'placeholder' => 'Substrate Item Name'));
																			?>

																			<?php 
																			echo $this->Form->input('Substrate.indicator', array(
																										'class' => 'form-control ',
																			                            'label' => false,
																			                            'type' => 'hidden',
																			                            'value' => $indicator));
																			?>

																			<?php 
																			echo $this->Form->input('Substrate.model', array(
																										'class' => 'form-control ',
																			                            'label' => false,
																			                            'type' => 'hidden',
																			                            'value' => 'substrate'));
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
																	<label class="col-lg-2 control-label">Manufacturer</label>
																	<div class="col-lg-8">
																		<input type="hidden" id="selected_type" value="">
																		<?php echo $this->Form->input('Substrate.manufacturer_id', array(
																		'options' => array($supplierData),
																		'type' => 'select',
																		'label' => false,
																		'class' => 'form-control categorylist',
																		'empty' => '---Select Supplier---'
																		)); 
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

										<div class="row" id="substrate-table ">
											<div class="col-lg-12">
												<div class="main-box model-row">
												<header class="main-box-header clearfix">

													<div class="row">
													  <div class="col-xs-6"><h1>Substrate List </h1></div>
													 	<div class="col-xs-6">

															<div class="filter-block pull-right">
										                        <div class="form-group pull-left model-search">
										                            
										                                <input placeholder="Search..." class="form-control searchOrder "  />
										                                <i class="fa fa-search search-icon"></i>

										                                <?php 

																			echo $this->Form->input('CompoundSubstrate.model', array(
																				'class' => 'form-control model-name',
													                            'type' => 'hidden',
													                            'value' => '2'));
																		?>
										                            
										                        </div>
										                        
										                    </div>
							                    		</div>
													</div>
												
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

																<tbody aria-relevant="all" aria-live="polite" class="requestFields" role="alert" >
                          
								                                	<?php echo $this->element('substrate_table');  ?>
								                         
										                        </tbody>
										                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
										                        </tbody>

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

																			<?php 
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
																	<label class="col-lg-2 control-label">Manufacturer</label>
																	<div class="col-lg-8">
																		<input type="hidden" id="selected_type" value="">
																		<?php
																			 echo $this->Form->input('CompoundSubstrate.manufacturer_id', array(
																				'options' => array($supplierData),
																				'type' => 'select',
																				'label' => false,
																				'class' => 'form-control  supplier',
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

									<div class="row" id="compound-substrate model-row">
										<div class="col-lg-12">
											<div class="main-box">
											<header class="main-box-header clearfix">

													<div class="row">
													  <div class="col-xs-6"><h1>Compound Substrate List </h1></div>
													 	<div class="col-xs-6">

															<div class="filter-block pull-right">
										                        <div class="form-group pull-left model-search">
										                            
										                                <input placeholder="Search..." class="form-control searchOrder "  />
										                                <i class="fa fa-search search-icon "></i>

										                                <?php 

																			echo $this->Form->input('CompoundSubstrate.model', array(
																				'class' => 'form-control model-name',
													                            'type' => 'hidden',
													                            'value' => '3',
													                            'placeholder' => 'Corrugated Paper Name'));
																		?>
										                            
										                        </div>
										                        
										                    </div>
							                    		</div>
													</div>
												
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

													<tbody aria-relevant="all" aria-live="polite" class="requestFields" role="alert" >
                          
					                               		 <?php echo $this->element('compound_substrate_table'); ?>
					                         
							                        </tbody>

							                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
							                        </tbody>

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

																			<?php 
																			echo $this->Form->input('CorrugatedPaper.indicator', array(
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
																	<label class="col-lg-2 control-label">Manufacturer</label>
																	<div class="col-lg-8">
																		<input type="hidden" id="selected_type" value="">
																		<?php 
																		echo $this->Form->input('CorrugatedPaper.manufacturer_id', array(
																			'options' => array($supplierData),
																			'type' => 'select',
																			'label' => false,
																			'class' => 'form-control categorylist',
																			'empty' => '---Select Supplier---'
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

									<div class="row" id="corrugated-paper-table model-row">
										<div class="col-lg-12">
											<div class="main-box">
											<header class="main-box-header clearfix">

													<div class="row">
													  <div class="col-xs-6"><h1>Corrugated List </h1></div>
													 	<div class="col-xs-6">

															<div class="filter-block pull-right ">
										                        <div class="form-group pull-left model-search">
										                            
										                                <input placeholder="Search..." class="form-control searchOrder "  />
										                                <i class="fa fa-search search-icon"></i>

										                                <?php 

																			echo $this->Form->input('CorrugatedPaper.model', array(
																				'class' => 'form-control model-name',
													                            'type' => 'hidden',
													                            'value' => '4',
													                            'placeholder' => 'Corrugated Paper Name'));
																		?>
										                            
										                        </div>
										                        
										                    </div>
							                    		</div>
													</div>
												
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

															<tbody aria-relevant="all" aria-live="polite" class="requestFieldsCorrugated" role="alert" >
                          
							                               		<?php echo $this->element('corrugated_paper_table'); ?>
							                         
									                        </tbody>

									                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
									                        </tbody>

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

    $("body").on('keyup','.searchOrder', function(e){

    	var thisMe = $(this);
        var model_name = thisMe.parents('.model-search').find('.model-name').val();
     
        var searchInput = $(this).val();
    	var params = $('.params').val();

    	//alert(model_name); 
    	
        if(searchInput != ''){
        	//thisMe.parents('.model-row').find('.table-responsive .requestFields').hide();
            //$('.requestFields').hide();
            $('.requestFields').hide();
            $('.searchAppend').show();
            //alert('hide');

        }else{
            $('.requestFields').show();
           	$('.searchAppend').hide();
           //	console.log(thisMe.parents('.model-row').find('.table-responsive .requestFields'));
           //	$('.requestFieldsCorrugated').hide();
            //thisMe.parents('.model-row').find('.table-responsive .requestFields').hide();
            //$('.requestFieldsCorrugated').hide();

            //alert('show');
        } 
        
        $.ajax({
            type: "GET",
            url: serverPath + "settings/search_order/"+searchInput+"/"+params+"/"+model_name,
            dataType: "html",
            success: function(data) {

                //alert(data);

                if(data){

                    $('.searchAppend').html(data);

                } 
                if (data.length < 5 ) {

                    $('.searchAppend').html('<font color="red"><b>No result..</b></font>');
                     
                }
                
            }
        });

    });

</script>