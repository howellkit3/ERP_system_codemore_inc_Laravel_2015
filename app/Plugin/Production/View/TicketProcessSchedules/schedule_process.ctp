<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix"><?php  ?>
					<h1>Kou Fu Packaging Corporation</h1>
				</header>
			</center>
			
			<div class="main-box-body clearfix">
				<form class="form-horizontal" role="form">
					
					<div class="form-group">
						<div class="col-lg-2">
							&nbsp;&nbsp;Item
						</div>
						<div class="col-lg-5">
							:&emsp;
							<?php 
								echo !empty($jobTickets['Product']['name']) ? ucfirst($jobTickets['Product']['name']) : '' ;
							?>
						</div>
						<div class="col-lg-4">
							Item size 
							:&emsp;
							<?php 
								echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size1'] : '0'; 
								echo " x ";
								echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size2'] : '0';
								echo " x ";
								echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size3'] : '0';
									
							?>
						</div>
					</div>

					<hr>

					<?php $componentCounter = 1?>
					<?php $partCounter = 1?>
					<?php $processCounter = 1?>
				<!-- 	<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<?php foreach ($formatDataSpecs as $key => $specLists) { ?>
					
									<?php

								      	if($specLists['ProductSpecificationDetail']['model'] == 'Component'){

								      		echo $this->element('Specs/component', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $componentCounter));
								      		$componentCounter++;
								      	}
								      	if($specLists['ProductSpecificationDetail']['model'] == 'Part'){
								      		
								      		echo $this->element('Specs/part', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $partCounter));
								      		$partCounter++;
								      		
								      	}
								      	if($specLists['ProductSpecificationDetail']['model'] == 'Process'){
								      		
								      			echo $this->element('Specs/process', array('dataSpecs' => $formatDataSpecs[$key],'key' => $processCounter,'subProcessData' => $subProcessData,'ticketData' => $jobTickets));
								      		$processCounter++;

								      	}
							      	?>
					      	
								<?php } ?>
							</thead>
					    </table>
				   	</div>  -->
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			
			<header class="main-box-header clearfix">
				<h2>Schedule Process </h2>
			</header>
			<div class="main-box-body clearfix">
				
				<?php echo $this->Form->create('TicketProcessSchedule',array('url'=>(array('controller' => 'ticket_process_schedules','action' => 'add')),'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>

					<?php foreach ($formatDataSpecs as $key => $specLists) { ?>
							
						<?php

					      	if($specLists['ProductSpecificationDetail']['model'] == 'Process'){
					      		
					      		//echo $this->element('Specs/process', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $processCounter));

					      		foreach ($formatDataSpecs[$key]['ProductSpecificationProcess']['ProcessHolder'] as $key => $processList) { $no = $key + 1; ?>
						      		<div class="form-group process-layer">
						      			<label class="col-lg-1 control-label"><?php echo $no ?></label>
										<div class="col-lg-3">
											<?php 
                                                echo $this->Form->input('Ticket.process', array(
                                                    'class' => 'form-control ',
                                                    'label' => false,
                                                    'readonly' => true,
                                                    'value' => ucfirst($subProcessData[$processList['ProductSpecificationProcessHolder']['sub_process_id']])
                                                    ));
                                                //hidden data
                                                echo $this->Form->input('Ticket.job_ticket_id', array(
                                                    'class' => 'form-control ',
                                                    'label' => false,
                                                    'type' => 'hidden',
                                                    'value' => $jobTickets['JobTicket']['id']
                                                    ));
                                            ?>
                                            <input type="hidden" name="data[TicketProcessSchedule][<?php echo $key ?>][order]" value="<?php echo $no ?>">
										</div>
										<div class="col-lg-4">
											<?php 
                                                echo $this->Form->input('TicketProcessSchedule.'.$key.'.department_process_id', array(
                                                	'options' => array($processDepartmentData),
                                                	'empty' => '-- Select Department Process--',
                                                    'class' => 'form-control departmentProcess',
                                                    'label' => false
                                                    //'value' => ucfirst($subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']])
                                                    ));
                                            ?>
										</div>
										<div class="col-lg-4">
											<?php 
                                                echo $this->Form->input('TicketProcessSchedule.'.$key.'.machine_id', array(
                                                	'options' => array(),
                                                	'empty' => '-- Select Machine --',
                                                    'class' => 'form-control machine-append',
                                                    'label' => false
                                                    //'value' => ucfirst($subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']])
                                                    ));
                                            ?>
										</div>
									</div>
								    
								<?php }

					      		$processCounter++;

					      	}
				      	?>
		      	
					<?php } ?>
					<hr>
					<div class="form-group">
		      			<label class="col-lg-5 control-label"></label>
						<div class="col-lg-5">
                            <?php 
                                echo $this->Form->submit('Submit Job Ticket Process Schedule', array('class' => 'btn btn-success pull-left',  'title' => 'Click here to add Process Schedule'));
                            ?>
                          
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-default close-modal pull-right">Cancel</button>
                        </div>
                    </div>
				<?php echo $this->Form->end(); ?>
			</div>
			
		</div>
		
	</div>
</div>