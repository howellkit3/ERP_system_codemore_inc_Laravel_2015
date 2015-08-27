<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Jobs', array('controller' => 'jobs', 'action' => 'plans')); ?>
<?php $this->Html->addCrumb('Plans', array('controller' => 'jobs', 'action' => 'plans')); 
	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
?>
<?php echo $this->Html->script('Sales.jquery-sortable');?>
<?php echo $this->Html->script('Sales.draggableproducts');?>
<?php 	//echo $this->element('production_options'); ?>
<div class="main-box">
	<div class="main-box-body clearfix">
		<div class="row">
			<div class="col-md-12">
				<br>
				<?php 	//echo $this->element('production_options'); ?>
				<?php 
					$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
				 	echo $this->element('tab/jobs',array('active_tab' => $active_tab)); 
				 ?>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<div class="top-pad"></div>
			<div class="main-box-body clearfix">
			 
				<div class="tabs-wrapper">
					<div class="tab-content">
						<div class="tab-pane active" id="tab-calendar">
							<header class="main-box-header clearfix">
				                <h2 class="pull-left"><b>Items</b> </h2>
				                <div class="filter-block pull-right">
				                 	<div class="form-group pull-left">
				                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
				                            <input placeholder="Search..." class="form-control searchMachine"  />
				                            <i class="fa fa-search search-icon"></i>
				                         <?php //echo $this->Form->end(); ?>
				                    </div>

				                    <div class="form-group pull-left">
			                 	
			                 			<input type="text" name="data[date]" id="changeDate" class="form-control datepick" value="<?php echo date('Y-m-d'); ?>">

			                            <i class="fa fa fa-calendar calendar-icon"></i>

			                    	</div>

				                   <br><br>
				               	</div>
				            </header>

							<div class="form-horizontal">	
								<!--text fields -->
								<section class="label-draggable-section">
									<section class="header-drag-section">
									    	<div class="form-group">
									    		<div class="col-lg-2 sched-header">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
													<b>Schedule No.</b>
												</div>
												<div class="col-lg-2 sched-header">
													<b>Customer</b>
												</div>
												<div class="col-lg-2 sched-header">
													<b>Product</b>
												</div>
												<div class="col-lg-2 sched-header">
													<b>Quantity</b>
												</div>
												<div class="col-lg-2 sched-header">
													<b>Production Status</b>
												</div>
												<div class="col-lg-2 sched-header">
													<b>Action</b>
												</div>
											</div>
									      
									  </section>
									<ul id="sortable">
										
										<?php 
									        if(!empty($jobData)){
									            foreach ($jobData as $key => $jobList): ?>
													<li class="ui-state-default">
													  <section class="dragField">
													    	<header class="dragHeader">
													          	<a class="remove_field pull-right" href="#">
																	<i class="fa fa-times-circle fa-fw fa-lg"></i>
																</a>
													    	</header>

													    	<div class="form-group">
													    		<div class="col-lg-2">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
																	<?php echo 'SCH - '.$jobList['ClientOrderDeliverySchedule']['uuid']; ?>
																</div>
																<div class="col-lg-2">
																	<?php echo ucfirst($companyData[$jobList['Product']['company_id']]); ?>
																</div>
																<div class="col-lg-2">
																	<?php echo ucfirst($jobList['Product']['name']); ?>
																</div>
																<div class="col-lg-2">
																	<?php echo $jobList['ClientOrderDeliverySchedule']['quantity']; ?>
																</div>
																<div class="col-lg-2">
																	<?php 
										                           		if (empty($jobList['JobTicket']['production_status'])) {
										                           			echo "<span class='label label-default'>Waiting For Schedule</span>";
										                           		}
										                           	?>
																</div>
																<div class="col-lg-2">
																	<a data-toggle="modal" href="#myModalSchedule<?php echo $jobList['JobTicket']['id'] ?>" class="table-link">
																		<i class="fa fa-lg "></i>
																		<span class="fa-stack">
	                                            							<i class="fa fa-square fa-stack-2x "></i>
	                                            							<i class="fa  fa-calendar fa-stack-1x fa-inverse "></i>&nbsp;&nbsp;&nbsp;
	                                            							<span class ="post">
	                                            								<font size = "1px"> Sched </font>
	                                            							</span>
	                                            						</span>
	                                            					</a>
																</div>
															
															</div>
													      
													  </section>
													</li>
											<?php 
									            endforeach; 
									    } ?>
										
									</ul>
								</section>
								
							</div>

				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.fa-stack{
		color: #03a9f4;
	}
	.header-drag-section{
		background: #03A9F4;
		padding: 15px 1px 1px;
	}
	.sched-header{
		color: white;
	}
	.dragField{
		padding: 0px;
	}
	.table-link{
		position: relative;
		top: -17px;
	}
</style>