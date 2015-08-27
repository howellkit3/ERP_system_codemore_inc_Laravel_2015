<div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/jobs',array('active_tab' => $active_tab)); ?>
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

				                    <?php
				                   // 		echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Machines', 
							                // array('controller' => 'machines', 
							                //         'action' => 'add',),
							                // array('class' =>'btn btn-primary',
							                //     'escape' => false)); 
				                    ?> 
				                  	
				                   <br><br>
				               	</div>
				            </header>

				            <div class="main-box-body clearfix">
				            	<div class="table-responsive">
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th><a href="#"><span>Schedule No.</span></a></th>
												<th><a href="#"><span>Customer</span></a></th>
												<th><a href="#"><span>Product</span></a></th>
												<th><a href="#" class="text-center"><span>Production Status</span></a></th>
												<!-- <th><a href="#" class="text-center"><span>Part</span></a></th>
												<th><a href="#" class="text-center"><span>Process</span></a></th> -->
												<th><a href="#"><span>Action</span></a></th>
											</tr>
										</thead>

										<?php 
									        if(!empty($jobData)){
									            foreach ($jobData as $key => $jobList): ?>
													<tbody aria-relevant="all" aria-live="polite" role="alert">
														<tr class="">

															<td class="">
									                           <?php echo 'SCH - '.$jobList['ClientOrderDeliverySchedule']['uuid']; ?>
									                        </td>

									                        <td class="">
									                           <?php echo ucfirst($companyData[$jobList['Product']['company_id']]); ?>
									                        </td>

									                        <td class="">
									                           <?php echo ucfirst($jobList['Product']['name']); ?>
									                        </td>

															<td class="">
									                           <?php 
									                           		if (empty($jobList['JobTicket']['production_status'])) {
									                           			echo "<span class='label label-default'>Waiting For Schedule</span>";
									                           		}
									                           		
									                           //echo ucfirst($departmentList[$machineList['Machine']['department_id']]); 
									                           ?>
									                        </td>

									                        <!-- <td class="">
									                           <?php //echo ucfirst($sectionList[$machineList['Machine']['section_id']]); ?>
									                        </td>

									                        <td class="">
									                           <?php //echo ucfirst($sectionList[$machineList['Machine']['section_id']]); ?>
									                        </td> -->

									                       	<td>
									                      
																<?php

																	echo $this->Html->link('<span class="fa-stack">
	                                                                         <i class="fa fa-square fa-stack-2x"></i>
	                                                                      <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
	                                                                          <span class ="post"><font size = "1px">View</font></span>
	                                                                          </span> ', array('controller' => 'jobs', 
	                                                                                         'action' => 'view',
	                                                                         $jobList['Product']['id']),
	                                                                          array('class' =>' table-link small-link-icon ','escape' => false,'title'=>'View Information'
	                                                                     )); 

																	// echo $this->Html->link('<span class="fa-stack">
																	// 	<i class="fa fa-square fa-stack-2x"></i>
																	// 	<i class="fa fa-calendar fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Schedule </font></span>
																	// 	</span> ', array('controller' => 'jobs', 'action' => 'schedule',$jobList['Product']['id']),array('class' =>' table-link','escape' => false,'title'=>'Schedule Item'));


																	// 	echo $this->Form->postLink('<span class="fa-stack">
																	// 	<i class="fa fa-square fa-stack-2x"></i>
																	// 	<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
																	// 	</span> ', array('controller' => 'machines', 'action' => 'delete',$machineList['Machine']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'),
																	// 		 array('escape' => false), 
														   //                              __('Are you sure you want to delete %s?', 
														   //                              $machineList['Machine']['name'])
																	// 	);

																?>
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

                                            					<div class="modal fade" id="myModalSchedule<?php echo $jobList['JobTicket']['id'] ?>" role="dialog" >
									                                <div class="modal-dialog">
									                                    <div class="modal-content margintop">

									                                        <div class="modal-header">
									                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                                            <h4 class="modal-title">Delivered P.O. Quantity</h4>
									                                        </div> 

									                                        <div class="modal-body">
									                                        	<?php echo $jobList['JobTicket']['id'] ?>
									                                            <?php 

									                                                echo $this->Form->create('ClientOrderDeliverySchedule',array(
									                                                    'url'=>(array('controller' => 'deliveries','action' => 'delivery_return')),'class' => 'form-horizontal')); 
									                                            ?>

									                                                <div class="form-group" id="existing_items">
									                                                    <label class="col-lg-2 control-label">D.R. #</label>
									                                                    <div class="col-lg-9">

									                                                        <?php 
									                                                            echo $this->Form->input('Delivery.dr_uuid', array(
									                                                                'class' => 'form-control item_type editable required',
									                                                                'label' => false,
									                                                                'required' => 'required',
									                                                                'readonly' => 'readonly',
									                                                                //'value' => $deliveryDataList['Delivery']['dr_uuid']
									                                                                ));

									                                                        ?>

									                                                    </div>
									                                                </div>
									                                                <br><br>

									                                                <div class="form-group" id="existing_items">
									                                                    <label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
									                                                    <div class="col-lg-9">

									                                                        <?php 

									                                                            echo $this->Form->input('DeliveryDetail.delivered_quantity', array(
									                                                                'empty' => 'None',
									                                                                'required' => 'required',
									                                                                'class' => 'form-control item_type editable limitQuantity',
									                                                                'label' => false,
									                                                                //'value' => $deliveryDataList['DeliveryDetail']['quantity']
									                                                                ));

									                                                        ?>
									                                                    </div>
									                                                </div>
									                                                <br><br>
									                                                <div class="modal-footer">

									                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
									                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

									                                                </div>
									                                            <?php echo $this->Form->end();  ?> 
									                                        </div>
									                                    </div>
									                                </div>
									                            </div>

									                        <div class="md-overlay"></div> 
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
			                           
				                            // echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable','model' => 'ClientOrder'));
				                            // echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Employee'), array('paginate' => 'Employee'));
				                            // echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable'));

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