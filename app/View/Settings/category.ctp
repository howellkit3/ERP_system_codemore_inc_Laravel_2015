<?php echo $this->Html->script(array('ajax_pagination','tabs', 'category')); ?>
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
						<li class="<?php echo ($active_tab == 'tab-category') ? 'active' : '' ?>" alt="tab-category"><a href="#tab-category" data-toggle="tab">Category</a></li>
						<li class="<?php echo ($active_tab == 'tab-type') ? 'active' : '' ?>" alt="tab-type"><a href="#tab-type" id = 'itemType' data-toggle="tab">Type</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade  <?php echo ($active_tab == 'tab-category') ? 'in active' : '' ?>" id="tab-category">
							<div class="row" >
								<div class="col-lg-12">
									<div class="row">
									<div class="col-lg-12">
										<header class="main-box-header clearfix">
												<h1 class="pull-left">
													Add Category
												</h1>

												<?php 
												echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'category_index'),array('class' =>'btn btn-primary pull-right','escape' => false));
												?>
										</header>
									</div>
								</div>

								<?php echo $this->Form->create('ItemCategoryHolder',array('url'=>(array('controller' => 'settings','action' => 'category'))));?>

								<div class="row">
									<div class="col-lg-12">
										<div class="main-box">
											<div class="main-box-body clearfix">
												<div class="main-box-body clearfix">
													<div class="form-horizontal">
														<div class="form-group"> <br>
															<label class="col-lg-2 control-label"><span style="color:red">*</span>Name Category</label>
															<div class="col-lg-8">
																<?php 
																echo $this->Form->input('ItemCategoryHolder.name', array(
																							'class' => 'form-control item_type',
																                            'label' => false,
																                            'placeholder' => 'Name Category'));
																?>
															</div>
														</div>

														<div class="form-group"> 
															<label class="col-lg-2 control-label"></label>
															<div class="col-lg-8">
																<div class="radio">
																			<input type="radio" name="data[ItemCategoryHolder][category_type]" id="categoryRadio1" value="0" checked>
																			<label for="categoryRadio1">
																			Product Category
																			</label>
																			<input type="radio" name="data[ItemCategoryHolder][category_type]" id="categoryRadio2" value="1">
																			<label for="categoryRadio2">
																			Item Group
																			</label>
																</div>
															</div>
														</div>

														<div class="form-group">
															<div class="col-lg-2"></div>
																<div class="col-lg-8">

																	<button type="submit" class="btn btn-primary pull-left">Submit Category</button>&nbsp;

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
									<div class="row" id="categoryTables">
										<div class="col-lg-12">
											<div class="main-box">
											<header class="main-box-header clearfix">
											<h1>Category List</h1>
											</header>
												<div class="main-box-body clearfix">
												<div class="table-responsive">
													<table class="table table-striped table-hover">
													<thead>
													<tr>
													<th><a href="#"><span>Name</span></a></th>
													<th class="text-center"><a href="#"><span>Created</span></a></th>
													<th>Action</th>
													</tr>
													</thead>

													<?php echo $this->element('category_table'); ?>
													</table>
														<br>
														 <div class="paging" id="item_category_pagination">
									                <?php

									                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'ItemCategoryHolder','model' => 'ItemCategoryHolder'), null, array('class' => 'disable','model' => 'ItemCategoryHolder'));
									                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'ItemCategoryHolder'), array('paginate' => 'ItemCategoryHolder'));
									                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'ItemCategoryHolder','model' => 'ItemCategoryHolder'), null, array('class' => 'disable'));
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

					<div class="tab-pane fade  <?php echo ($active_tab == 'tab-type') ? 'in active' : '' ?>" id="tab-type">
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
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
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
															<label class="col-lg-2 control-label"><span style="color:red">*</span>Category</label>
															<div class="col-lg-8">
																		<?php echo $this->Form->input('ItemTypeHolder.item_category_holder_id', array(
																		'options' => array($categoryDataDropList),
																		'type' => 'select',
																		'label' => false,
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
									<div class="row" id="itemTypeTables">
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
															 
											           <div class="paging" id="item_type_pagination">
										                <?php
										               
										                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'ItemTypeHolder','model' => 'ItemTypeHolder'), null, array('class' => 'disable','model' => 'ItemTypeHolder'));
										                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'ItemTypeHolder'), array('paginate' => 'ItemTypeHolder'));
										                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'ItemTypeHolder','model' => 'ItemTypeHolder'), null, array('class' => 'disable'));

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
</div>