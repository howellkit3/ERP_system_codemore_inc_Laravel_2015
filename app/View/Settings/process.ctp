<?php echo $this->Html->script(array('ajax_pagination','tabs', 'category')); ?>
<?php echo $this->element('setting_option');?><br><br>
<?php 

$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-process';
?>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<div class="main-box-body clearfix">
				<div class="tabs-wrapper">
					<ul class="nav nav-tabs">
						<li class="<?php echo ($active_tab == 'tab-process') ? 'active' : '' ?>" alt="tab-process"><a href="#tab-process" data-toggle="tab">Process</a></li>
						<li class="<?php echo ($active_tab == 'tab-sub_process') ? 'active' : '' ?>" alt="tab-sub_process"><a href="#tab-sub_process" id = 'itemType' data-toggle="tab">Sub Process</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade  <?php echo ($active_tab == 'tab-process') ? 'in active' : '' ?>" id="tab-process">
							<div class="row">
								<div class="col-lg-12">
									
									<div class="row">
										<div class="col-lg-12">
											<header class="main-box-header clearfix">					                    
												<h1 class="pull-left">
													Add Process
												</h1>
												<?php 
							                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
							                    ?>
											</header>
										</div>
									</div>
									<?php echo $this->Form->create('Process',array('url'=>(array('controller' => 'settings','action' => 'process'))));?>
										
										<div class="row">
											<div class="col-lg-12">
												<div class="main-box">
													<div class="top-space"></div>
													<div class="main-box-body clearfix">
														<div class="main-box-body clearfix">
															<div class="form-horizontal">
																<div class="form-group">
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Process</label>
																	<div class="col-lg-8">
																		<?php 
								                                            echo $this->Form->input('Process.name', array(
								                                            								'class' => 'form-control item_type',
														                                                    'label' => false,
														                                                    'placeholder' => 'Process Name'));
							                                            ?> 
																	</div>
																</div>

																<div class="form-group">
																	<div class="col-lg-2"></div>
																	<div class="col-lg-8">
																		<button type="submit" class="btn btn-primary pull-left">Submit Process</button>&nbsp;
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

					<div class="row">
								<div class="col-lg-12">
									<div class="main-box">
									  	<header class="main-box-header clearfix">
					                        <h1>Process List</h1>
					                    </header>
										<div class="main-box-body clearfix">
							                <div class="table-responsive">
							                    <table class="table table-striped table-hover">
							                        <thead>
							                            <tr>
							                              
							                                <th><a href="#"><span>Process</span></a></th>
							                              
							                                <th class="text-center"><a href="#"><span>Created</span></a></th>
							                                <th>Action</th>
							                            </tr>
							                        </thead>

							                        <?php echo $this->element('process_table'); ?>

							                    </table>
							                    <hr>

							                    <ul class="pagination pull-right">
														<?php 
														echo $this->Paginator->prev('< ' . __('previous'), array('before' => 'a','tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'prev disabled'));
														echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
														echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'next disabled')); ?>
												</ul>

							                </div>
							            </div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade  <?php echo ($active_tab == 'tab-sub_process') ? 'in active' : '' ?>" id="tab-sub_process">
							<div class="row">
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-12">
											<header class="main-box-header clearfix">

											<h1 class="pull-left">
												Add Sub Process
											</h1>

											<?php 
												echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
											?>

											</header>

										</div>
									</div>

								<?php echo $this->Form->create('SubProcess',array('url'=>(array('controller' => 'settings','action' => 'sub_process'))));?>

								<div class="row">
									<div class="col-lg-12">
										<div class="main-box">
											<div class="top-space"></div>
												<div class="main-box-body clearfix">
													<div class="main-box-body clearfix">
														<div class="form-horizontal">
															<div class="form-group">
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Sub Process</label>
																<div class="col-lg-8">
																	<?php 
																	echo $this->Form->input('SubProcess.name', array(
																				'class' => 'form-control item_type',
																	            'label' => false,
																	            'placeholder' => 'Type Name'));
																	?>
																</div>
															</div>

															<div class="form-group">
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Process</label>
																<div class="col-lg-8">
																			<?php echo $this->Form->input('SubProcess.process_id', array(
																			'options' => array($processDataDropList),
																			'type' => 'select',
																			'label' => false,
																			'class' => 'form-control required',
																			'empty' => '---Select Process---',
																			'required' => true					                               
																			)); 
																			?>
																</div>
															</div>

															<div class="form-group">
																<div class="col-lg-2"></div>
																	<div class="col-lg-8">
																		<button type="submit" class="btn btn-primary pull-left">Submit Sub Process</button>&nbsp;
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
																		<th><a href="#"><span>Sub Process</span></a></th>
																		<th><a href="#"><span>Process</span></a></th>
																		<th class="text-center"><a href="#"><span>Created</span></a></th>
																		<th>Action</th>
																	</tr>
																</thead>

															<?php echo $this->element('sub_process_table'); ?>
												  
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