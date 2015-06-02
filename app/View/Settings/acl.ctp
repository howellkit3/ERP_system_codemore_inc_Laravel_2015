<?php //echo $this->Html->script(array('ajax_pagination','tabs', 'category')); ?>
<?php echo $this->element('setting_option');?><br><br>
<?php 

$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-category';
?>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<ul class="nav nav-tabs">
				<li class="<?php echo ($active_tab == 'tab-category') ? 'active' : '' ?>" alt="tab-category"><a href="#tab-category" data-toggle="tab">Role</a></li>
				<li class="<?php echo ($active_tab == 'tab-type') ? 'active' : '' ?>" alt="tab-type"><a href="#tab-type" id = 'itemType' data-toggle="tab">Permission</a></li>
			</ul>
			<div class="main-box-body clearfix">
				<div class="tabs-wrapper">					
					<div class="tab-content">
						<div class="tab-pane fade  <?php echo ($active_tab == 'tab-category') ? 'in active' : '' ?>" id="tab-category">
							<div class="row" >
								<div class="col-lg-12">
									<div class="row">
									<div class="col-lg-12">
										<header class="main-box-header clearfix">
												<h1 class="pull-left">
													Add Role
												</h1>

												<?php 
												echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
												?>
										</header>
									</div>
								</div>

								<?php echo $this->Form->create('Role',array('url'=>(array('controller' => 'settings','action' => 'acl'))));?>

								<div class="row">
									<div class="col-lg-12">
										<div class="main-box">
											<div class="main-box-body clearfix">
												<div class="main-box-body clearfix">
													<div class="form-horizontal">
														<div class="form-group"> <br>
															<label class="col-lg-2 control-label"><span style="color:red">*</span>Role Name</label>
															<div class="col-lg-8">
																<?php 
																echo $this->Form->input('Role.name', array(
																							'class' => 'form-control item_type',
																                            'label' => false,
																                            'placeholder' => 'Role Name'));
																?>
															</div>
														</div>


														<div class="form-group">
															<div class="col-lg-2"></div>
																<div class="col-lg-8">

																	<button type="submit" class="btn btn-primary pull-left">Submit Role</button>&nbsp;

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
											<h1>Role List</h1>
											</header>
												<div class="main-box-body clearfix">
												<div class="table-responsive">
													<table class="table table-striped table-hover">
													<thead>
													<tr>
													<th><a href="#"><span>Role Name</span></a></th>
													<th class="text-center"><a href="#"><span>Created</span></a></th>
													<th style="width:135px">Action</th>
													</tr>
													</thead>

													<?php echo $this->element('role_table'); ?>
													</table>
														<br>
														 <div class="paging" id="item_category_pagination">
									                <?php

									                // echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'ItemCategoryHolder','model' => 'ItemCategoryHolder'), null, array('class' => 'disable','model' => 'ItemCategoryHolder'));
									                // echo $this->Paginator->numbers(array('separator' => '','paginate' => 'ItemCategoryHolder'), array('paginate' => 'ItemCategoryHolder'));
									                // echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'ItemCategoryHolder','model' => 'ItemCategoryHolder'), null, array('class' => 'disable'));
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
								Add Permission
								</h1>

								<?php 
								echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
								?>

								</header>

								</div>
								</div>

								<?php echo $this->Form->create('Permission',array('url'=>(array('controller' => 'settings','action' => 'acl'))));?>

								<div class="row">
									<div class="col-lg-12">
										<div class="main-box">
											<div class="top-space"></div>
												<div class="main-box-body clearfix">
													<div class="main-box-body clearfix">
														<div class="form-horizontal">
															<div class="form-group">
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Permission Name</label>
																<div class="col-lg-8">
																	<?php 
																	echo $this->Form->input('Permission.name', array(
																				'class' => 'form-control item_type required',
																	            'label' => false,
																	            'placeholder' => 'Permission Name'));
																	?>
																</div>
															</div>
												
															<div class="form-group">
																<div class="col-lg-2"></div>
																	<div class="col-lg-8">
																		<button type="submit" class="btn btn-primary pull-left">Submit Permission</button>&nbsp;
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
												<h1>Permission List</h1>
												</header>
													<div class="main-box-body clearfix">
														<div class="table-responsive">
															<table class="table table-striped table-hover">
																<thead>
																	<tr>		                              
																		<th><a href="#"><span>Permission Name</span></a></th>
																		<th class="text-center"><a href="#"><span>Created</span></a></th>
																		<th>Action</th>
																	</tr>
																</thead>

															<?php echo $this->element('permission_table'); ?>
												  
															</table>

														<hr>
															 
											           <div class="paging" id="item_type_pagination">
										                <?php
										               
										                // echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'ItemTypeHolder','model' => 'ItemTypeHolder'), null, array('class' => 'disable','model' => 'ItemTypeHolder'));
										                // echo $this->Paginator->numbers(array('separator' => '','paginate' => 'ItemTypeHolder'), array('paginate' => 'ItemTypeHolder'));
										                // echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'ItemTypeHolder','model' => 'ItemTypeHolder'), null, array('class' => 'disable'));

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