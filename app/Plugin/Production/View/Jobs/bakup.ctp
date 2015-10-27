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
						<li class="ui-state-default data-section">
						  <section class="dragField">
						    	<header class="dragHeader">
						          	<a class="remove-section pull-right" href="#">
										<i class="fa fa-times-circle fa-fw fa-lg"></i>
									</a>
						    	</header>

						    	<div class="form-group parent-div-<?php echo $jobList['JobTicket']['id'] ?>">
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
									<div class="col-lg-2 status-append">
										<?php 
			                           		if (empty($jobList['JobTicket']['production_status'])) {
			                           			echo "<span class='label label-default'>Waiting For Schedule</span>";
			                           		}else{
			                           			if ($jobList['JobTicket']['production_status'] == 1) {
			                           				echo "<span class='label label-success'>Sheeter / Cutting</span>";
			                           			}
			                           		}
			                           	?>
									</div>
									<div class="col-lg-2">

										<?php if (empty($jobList['JobTicket']['production_status'])) { ?>
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
                        				<?php } else { ?>
                        					<a data-toggle="modal" href="#myModalScheduleView<?php echo $jobList['JobTicket']['id'] ?>" class="table-link">
												<i class="fa fa-lg "></i>
												<span class="fa-stack">
                        							<i class="fa fa-square fa-stack-2x "></i>
                        							<i class="fa  fa-search-plus fa-stack-1x fa-inverse "></i>&nbsp;&nbsp;&nbsp;
                        							<span class ="post">
                        								<font size = "1px"> View </font>
                        							</span>
                        						</span>
                        					</a>
                        				<?php } ?>
                    					<div class="modal fade" id="myModalSchedule<?php echo $jobList['JobTicket']['id'] ?>" role="dialog" >
			                                <div class="modal-dialog">
			                                    <div class="modal-content margintop">

			                                        <div class="modal-header">
			                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                                            <h4 class="modal-title">Job Ticket / Machine Schedule</h4>
			                                        </div> 

			                                        <div class="modal-body">
			                                            <?php 

			                                                echo $this->Form->create('MachineSchedule',array(
			                                                    'url'=>(array('controller' => 'machine_schedules','action' => 'add')),'class' => 'form-horizontal','id' => 'updateMachineSchedule')); 
			                                            ?>

			                                                <div class="form-group">
			                                                    <label class="col-lg-2 control-label">Schedule #</label>
			                                                    <div class="col-lg-9">

			                                                        <?php 
			                                                            echo $this->Form->input('MachineSchedule.schedule_no', array(
			                                                                'class' => 'form-control required',
			                                                                'label' => false,
			                                                                'required' => 'required',
			                                                                'disabled' => 'disabled',
			                                                                'value' => $jobList['JobTicket']['uuid']
			                                                                ));

			                                                            echo $this->Form->input('MachineSchedule.job_ticket_id', array(
			                                                                'class' => 'form-control required',
			                                                                'label' => false,
			                                                                'required' => 'required',
			                                                                'type' => 'hidden',
			                                                                'value' => $jobList['JobTicket']['id']
			                                                                ));
			                                                            echo $this->Form->input('MachineSchedule.status_ticket', array(
			                                                                'class' => 'form-control required',
			                                                                'label' => false,
			                                                                'required' => 'required',
			                                                                'type' => 'hidden',
			                                                                'value' => 1
			                                                                ));

			                                                        ?>

			                                                    </div>
			                                                </div>

			                                                <div class="form-group">
			                                                    <label class="col-lg-2 control-label">Customer</label>
			                                                    <div class="col-lg-9">

			                                                        <?php 

			                                                            echo $this->Form->input('MachineSchedule.customer', array(
			                                                                'required' => 'required',
			                                                                'class' => 'form-control item_type editable limitQuantity',
			                                                                'label' => false,
			                                                                'disabled' => 'disabled',
			                                                                'value' => ucfirst($companyData[$jobList['Product']['company_id']])
			                                                                ));

			                                                        ?>
			                                                    </div>
			                                                </div>

			                                                <div class="form-group">
			                                                    <label class="col-lg-2 control-label">Item</label>
			                                                    <div class="col-lg-9">

			                                                        <?php 

			                                                            echo $this->Form->input('MachineSchedule.item', array(
			                                                                'required' => 'required',
			                                                                'class' => 'form-control item_type editable limitQuantity',
			                                                                'label' => false,
			                                                                'disabled' => 'disabled',
			                                                                'value' => ucfirst($jobList['Product']['name'])
			                                                                ));

			                                                        ?>
			                                                    </div>
			                                                </div>

			                                                <div class="form-group">
			                                                    <label class="col-lg-2 control-label">Quantity</label>
			                                                    <div class="col-lg-9">

			                                                        <?php 

			                                                            echo $this->Form->input('MachineSchedule.quantity', array(
			                                                                'required' => 'required',
			                                                                'class' => 'form-control item_type',
			                                                                'label' => false,
			                                                                'readonly' => true,
			                                                                'value' => $jobList['ClientOrderDeliverySchedule']['quantity']
			                                                                ));

			                                                        ?>
			                                                    </div>
			                                                </div>

			                                                <hr>

			                                                <h4 class="modal-title">Machine Schedule</h4>

			                                                <div class="form-group">
			                                                    <label class="col-lg-2 control-label">Machine</label>
			                                                    <div class="col-lg-9">

			                                                        <?php 

			                                                            echo $this->Form->input('MachineSchedule.machine_id', array(
			                                                                'options' => array($machineData),
			                                                                'class' => 'form-control required',
			                                                                'label' => false,
			                                                                'empty' => '-- select machine --'
			                                                                ));

			                                                        ?>
			                                                    </div>
			                                                </div>

			                                                <div class="form-group">
			                                                    <label class="col-lg-2 control-label">Date</label>
			                                                    <div class="col-lg-9">

			                                                        <input type="date" name="data[MachineSchedule][date]" min="<?php echo date('Y-m-d'); ?>" id="changeDate" class="form-control datepick" value="<?php echo date('Y-m-d'); ?>">
			                                                    </div>
			                                                </div>

			                                                <div class="form-group">
			                                                    <label class="col-lg-2 control-label">Time</label>
			                                                    <div class="col-lg-4 bootstrap-timepicker input-append">

			                                                        <?php
		                                                                echo $this->Form->input('MachineSchedule.from', array(
		                                                                    'type' => 'text',    
		                                                                    'class' => 'form-control col-lg-6 required timepicker workshift_from',
		                                                                    'label' => false,
		                                                                    ));
			                                                         ?>
			                                                    </div>

			                                                    <div class="col-lg-4 bootstrap-timepicker input-append">

			                                                        <?php
		                                                                echo $this->Form->input('MachineSchedule.to', array(
		                                                                    'type' => 'text',    
		                                                                    'class' => 'form-control col-lg-6 required timepicker workshift_from',
		                                                                    'label' => false,
		                                                                    ));
			                                                        ?>

			                                                    </div>
			                                                </div>

			                                                <div class="form-group">
			                                                    <label class="col-lg-2 control-label">Remarks</label>
			                                                    <div class="col-lg-9">

			                                                        <?php 

			                                                            echo $this->Form->input('MachineSchedule.remarks', array(
			                                                                'class' => 'form-control',
			                                                                'label' => false,
			                                                                ));

			                                                        ?>
			                                                    </div>
			                                                </div>

			                                                <div class="modal-footer">

			                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-arrow-circle-right fa-lg"></i> Proceed to Sheeter</button>
			                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			                                                </div>
			                                            <?php echo $this->Form->end();  ?> 
			                                        </div>
			                                    </div>
			                                </div>
			                            </div>

			                        	<div class="md-overlay"></div> 
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
<?php
	require_once('connect.php');

	if(!empty($_POST)){
		//echo "<pre>".print_r($_POST)."</pre>";exit();
		$lname = $_POST['lname'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$bdate = $_POST['bday'];
		$birth = $_POST['place_birth'];
		$age = $_POST['age'];
		$religion = $_POST['religion'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$faname = $_POST['fa_name'];
		$ofather = $_POST['oc_father'];
		$moname = $_POST['mo_name'];
		$omother = $_POST['oc_mother'];
		$gname = $_POST['rel_guardian'];		
		$add = $_POST['address_guardian'];

	    if ($conn){
			$sql = 'INSERT INTO student_register (id, lname, fname, mname, bday, place_birth, age, religion, gender, address, fa_name, oc_father, mo_name, oc_mother, rel_guardian, address_guardian) VALUES ("'.$lname.'","'.$fname.'","'.$mname.'","'.$bdate.'","'.$birth.'","'.$age.'","'.$relgion.'","'.$gender.'",
			   	"'.$address.'","'.$faname.'","'.$ofather.'","'.$moname.'","'.$omother.'","'.$gname.'","'.$add.'")';  
			mysql_query($sql) or die('Unsuccessful: ' .mysql_error());

			mysql_query("INSERT INTO student_register (id, lname, fname, mname, bday, place_birth, age, religion, gender, address, fa_name, oc_father, mo_name, oc_mother, rel_guardian, address_guardian)
			VALUES ('$lname', '$fname', '$mname', '$bdate','$birth','$age','$relgion','$gender','$address','$faname','$ofather','$moname','$omother','$gname','$add')");
			
		}

	}

	//this will redirect page
	header("Location: guest.php");

?>


<?php
	require_once('connect.php');
	if(!empty($_POST)){
		//echo "<pre>".print_r($_POST)."</pre>";exit();
		$lname = $_POST['lname'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$bdate = $_POST['bday'];
		$birth = $_POST['place_birth'];
		$age = $_POST['age'];
		$religion = $_POST['religion'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$faname = $_POST['fa_name'];
		$ofather = $_POST['oc_father'];
		$moname = $_POST['mo_name'];
		$omother = $_POST['oc_mother'];
		$guardname = $_POST['guard_name'];
		$gname = $_POST['rel_guardian'];		
		$add = $_POST['address_guardian'];

	   if ($conn){

			mysql_query("INSERT INTO `student_register` (id, lname, fname, mname, bday, place_birth, age, religion, gender, address, fa_name, oc_father, mo_name, oc_mother, rel_guardian, address_guardian)
			VALUES ('".$lname."', '".$fname."', '".$mname."', '".$bdate."','".$birth."','".$age."','".$relgion."','".$gender."','".$address."','".$faname."','".$ofather."','".$moname."','".$omother."','".$gname."','".$add."')");
			
		}
	}
	//this will redirect page
	header("Location: guest.php");
?>