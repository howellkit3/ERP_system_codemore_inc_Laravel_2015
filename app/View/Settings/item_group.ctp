<?php echo $this->element('setting_option');?><br><br>
<?php 

$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-category';
?>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<div class="main-box-body clearfix">
					<div class="tabs-wrapper">
						<ul class="nav nav-tabs">
							<li class="<?php echo ($active_tab == 'tab-category') ? 'active' : '' ?>" alt="tab-category"><a href="#tab-category" data-toggle="tab">General Items</a></li>
							<li class="<?php echo ($active_tab == 'tab-type') ? 'active' : '' ?>" alt="tab-type"><a href="#tab-type" id = 'itemType' data-toggle="tab">Substrates</a></li>
							<li class="<?php echo ($active_tab == 'tab-type') ? 'active' : '' ?>" alt="tab-type"><a href="#tab-type" id = 'itemType' data-toggle="tab">Compound Substrates</a></li>
							<li class="<?php echo ($active_tab == 'tab-type') ? 'active' : '' ?>" alt="tab-type"><a href="#tab-type" id = 'itemType' data-toggle="tab">Corrugated Papers</a></li>
						</ul>
							<div class="tab-content">
								<div class="tab-pane fade  <?php echo ($active_tab == 'tab-category') ? 'in active' : '' ?>" id="tab-category">
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

										<?php echo $this->Form->create('GeneralItem',array('url'=>(array('controller' => 'settings','action' => 'item_group'))));?>

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
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Measure</label>
																	<div class="col-lg-8">
																		<?php 
																		echo $this->Form->input('GeneralItem.measure', array(
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

														<ul class="pagination pull-right">
															<?php 
																echo $this->Paginator->prev('< ' . __('previous'), array('before' => 'a','tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'prev disabled'));
																echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
																echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'next disabled')); 
															?>
														</ul>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<!--<div class="tab-pane fade  <?php echo ($active_tab == 'tab-type') ? 'in active' : '' ?>" id="tab-type">
							<div class="row">
								<div class="col-lg-12">
								<div class="row">
								<div class="col-lg-12">
								<header class="main-box-header clearfix">

								<h1 class="pull-left">
								Add Type
								</h1>

								<?php 
								echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
								?>

								</header>

								</div>
								</div>

								<?php echo $this->Form->create('ItemCategoryHolder',array('url'=>(array('controller' => 'settings','action' => 'name_type'))));?>

								<div class="row">
									<div class="col-lg-12">
										<div class="main-box">
											<div class="top-space"></div>
												<div class="main-box-body clearfix">
													<div class="main-box-body clearfix">
														<div class="form-horizontal">
															<div class="form-group">
																<label class="col-lg-2 control-label">Type</label>
																<div class="col-lg-8">
																	<?php 
																	echo $this->Form->input('ItemTypeHolder.name', array(
																				'class' => 'form-control item_type',
																	            'label' => false,
																	            'placeholder' => 'Type Name'));
																	?>
																</div>
															</div>
														<div class="form-group">
															<label class="col-lg-2 control-label">Category</label>
															<div class="col-lg-8">
																		<?php echo $this->Form->input('ItemTypeHolder.item_category_holder_id', array(
																		'options' => array($categoryDataDropList),
																		'type' => 'select',
																		'label' => false,
																		'readonly' => 'readonly',
																		'class' => 'form-control required',
																		'empty' => '---Select Category---',
																		'required' => true					                               
																		)); 
																		?>
															</div>
														</div>

														<div class="form-group"> 
															<label class="col-lg-2 control-label"></label>
																<div class="col-lg-8">
																	<div class="radio-type">
																			<input type="radio" name="data[ItemTypeHolder][category_type]" id="TypeRadio2" value="0" checked>
																			<label for="categoryRadio">
																			Product Category
																			</label>
											
																			<input type="radio" name="data[ItemTypeHolder][category_type]" id="TypeRadio2" value="1">
																			<label for="itemGroupRadio">
																			Item Group
																			</label>
																		</div>
																</div>

														</div>

															<div class="form-group">
																<div class="col-lg-2"></div>
																	<div class="col-lg-8">
																		<button type="submit" class="btn btn-primary pull-left">Submit Type</button>&nbsp;
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
											<h1>Type List</h1>
											</header>
												<div class="main-box-body clearfix">
													<div class="table-responsive">
														<table class="table table-striped table-hover">
															<thead>
																<tr>		                              
																	<th><a href="#"><span>Item Type</span></a></th>
																	<th><a href="#"><span>Category</span></a></th>
																	<th class="text-center"><a href="#"><span>Created</span></a></th>
																	<th>Action</th>
																</tr>
															</thead>

														<?php echo $this->element('name_type_table'); ?>

														</table>

													<hr>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	-->					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('#GeneralItemCategoryId').change(function(){
			$('.option-append').remove();
			var option = $(this).val();
			 var selected = $('#GeneralItemCategoryId').val();
			$.ajax({
				url: serverPath + "/settings/ajax_categ/"+option,
				type: "get",
				async: false,
				dataType: "json",
				success: function(data) {

					$.each(data, function(key, value) {

						if (value.id == selected) {
							$option = "<option class='option-append' selected value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";	
						} else {
							$option = "<option class='option-append'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
						}
					     $('#GeneralItemTypeId').append($option);
					});			
				}
			});			

	}).trigger('change');
</script>