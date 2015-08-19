<?php 
 echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'timepicker'
)); 

echo $this->Html->script(array(
					'jquery.maskedinput.min',
					'HumanResource.custom',
                    'HumanResource.select2.min',
                    'HumanResource.moment',
                    'HumanResource.attendance',

)); 


echo $this->element('hr_options');

	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/attendances',array('active_tab' => $active_tab)); ?>
			<div class="main-box-body clearfix">
		 
				<div class="tabs-wrapper">
					<div class="tab-content">
						<div class="tab-pane active" id="tab-calendar">
							<header class="main-box-header clearfix">
			                	<h2 class="pull-left"><b>Employee Leaves Record</b> </h2>
			                	<div class="filter-block pull-right">
			                		<?php echo $this->Form->create('Attendance',array('controller' => 'attendances','action' => 'absences', 'type'=> 'get')); ?>
				                 		<div class="form-group pull-left">
				                 			
				                 				<input type="text" name="date" id="changeDate" class="form-control datepick" value="<?php //echo $date ?>">

				                            	<i class="fa fa fa-calendar calendar-icon"></i>

				                 		
				                    	</div>
					                    <div class="form-group pull-left">
					                 		<input placeholder="Search..." class="form-control searchCustomer" value="<?php //echo $search ?>" name="name" />
					                        <i class="fa fa-search search-icon"></i>
	 
					                    </div>
				                     	<div class="form-group pull-left">
				                    	 	<button class="btn btn-success">Go</button> 
				                     	</div>
			                    	
										<div class="form-group pull-left">

											<a data-toggle="modal" href="#leaveReport" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>

											<?php

												echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Request Leave', 
						                            array('controller' => 'leaves', 
						                                  'action' => 'add'),
							                           array('class' =>'btn btn-primary pull-right',
							                                'escape' => false)); 
											?>

				                		</div>
				                	<?php echo $this->Form->end(); ?>
			                   		<br><br>
			               		</div>
			            	</header>

			         	 	<div class="main-box-body clearfix">
			            		<div class="table-responsive">
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th><a href="#"><span>Code</span></a></th>
												<th><a href="#"><span>Employee Name</span></a></th>
												<th><a href="#" class="text-center"><span>Type</span></a></th>
												<th><a href="#" class="text-center"><span>From</span></a></th>
												<th><a href="#" class="text-center"><span>To</span></a></th>
												<th><a href="#"><span>Status</span></a></th>
												<th><a href="#" class="text-center"><span>Remarks</span></a></th>
												<th><a href="#"><span>Actions</span></a></th>
											</tr>
										</thead>

										<?php 
									        if(!empty($leaveData)){
									            foreach ($leaveData as $key => $leaveList): ?>
													<tbody aria-relevant="all" aria-live="polite" role="alert">
														<tr class="">
															<td> <?php echo $leaveList['Employee']['code']; ?></td>

															<td class="">
									                          <?php 
									                          	if (!empty($leaveList['Employee']['id'])) {

									                          		echo $this->CustomText->getFullname($leaveList['Employee']);

									                          	}
									                           ?>
									                        </td>

									                        <td class="">
									                          	<?php 
									                          
									                          		echo $leaveList['LeaveType']['name'];

									                           	?>
									                        </td>

															<td> 
									                           	<?php  
									                           
									                           	 	echo date('Y-m-d',strtotime($leaveList['Leave']['from']));
									                           							                           
									                           	?> 
									                        </td>

									                        <td > 
									                            <?php  
									                           
									                           	 	echo date('Y-m-d',strtotime($leaveList['Leave']['to']));
									                           							                           
									                           	?> 
									                        </td>
									                         
									                        <td> 
									                           <?php 
									                           		if ($leaveList['Leave']['status'] == 8) {
									                           			echo "<span class='label label-default'>Waiting</span>";
									                           		}
									                           		if ($leaveList['Leave']['status'] == 1) {
									                           			echo "<span class='label label-success'>Approved</span>";
									                           		}
																	
									                            ?> 
									                        </td>

									                        
									                        <td> 
									                           <?php echo $leaveList['Leave']['remarks']; ?> 
									                        </td>

									                       	<td>
										                      	<?php
																echo $this->Html->link('<span class="fa-stack">
																<i class="fa fa-square fa-stack-2x"></i>
																<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> edit </font></span>
																</span> ',array('controller' => 'leaves', 'action' => 'edit',$leaveList['Leave']['id'] ),
																array('class' =>'table-link',
																	   'escape' => false,
																	   'data-url' => '/leaves/edit/'.$leaveList['Leave']['id'],
																	   'title'=>'Edit Information',
																	));

																echo $this->Html->link('<span class="fa-stack">
																<i class="fa fa-square fa-stack-2x"></i>
																<i class="fa fa-search fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
																</span> ', array('controller' => 'leaves', 'action' => 'view',$leaveList['Leave']['id']),array('class' =>' table-link','escape' => false,'title'=>'View Information'));
										                      	

																?>
									                        </td>
									                    </tr>

									                </tbody>
									        <?php 
									            endforeach; 
									    } ?> 
								
									</table>	
									<hr>

				                    <div class="paging" id="item_type_pagination">
										<?php
											echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
											echo $this->Paginator->numbers(array('separator' => ''));
											echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
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

<div class="modal fade" id="leaveReport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Attendance </h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('Leave',array('url'=>(array('controller' => 'leaves','action' => 'export')),'class' => 'form-horizontal'));?>

                	<div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Employee Name</label>
                        
                        <div class="col-lg-6">
                            <?php 
								echo $this->Form->input('Leave.employee_id', array(
								    'type' => 'select',
								    'label' => false,
								    'class' => 'autocomplete',
								    'empty' => '---Select Employee---',
								    'options' => array($employees)

								  ));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label">Leave Type</label>
                        
                        <div class="col-lg-6">
                            <?php 
								echo $this->Form->input('Leave.type_id', array(
								    'type' => 'select',
								    'label' => false,
								    'class' => 'autocomplete',
								    'empty' => '---Select Leave Type---',
								    'options' => array($leaveType)

								  ));
                            ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary export-close"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>  
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<?php echo $this->element('modals/personnal_attendance'); ?>