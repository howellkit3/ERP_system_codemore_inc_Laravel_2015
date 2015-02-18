<?php echo $this->Html->script('Production.unique_id');?>
<?php echo $this->element('ProductionOptions');?><br><br>

<?php echo $this->Form->create('Schedule',array('url'=>(array('controller' => 'production_systems','action' => 'add'))));?>
	<div class="row">
	    <div class="col-lg-12">
	        <div class="main-box">

	            <header class="main-box-header clearfix">
	                <h1>Add Schedule</h1>
	            </header>
	            
	            <div class="main-box-body clearfix">
	            	<div class="form-group">
	                    <label for="inputPassword1" class="col-lg-2 control-label">Company Name</label>
	                    <div class="col-lg-9">
	                       	<?php 
	                       		echo $this->Form->input('Company.id', array(
		                                'options' => array($companyData),
		                                'type' => 'select',
		                                'label' => false,
		                                'class' => 'form-control col-lg-4 required',
		                                'empty' => '---Select Company---',
		                                'id' => 'select_company'
		                                 )); 

		                       ?>


	                    </div>
	                </div> <br><br>

	                <div class="form-group">
	                    <label for="inputPassword1" class="col-lg-2 control-label">Unique Id</label>
	                    <div class="col-lg-9">
	                        <?php
	                           echo $this->Form->input('Quotation.unique_id', array(
	    												'options' => array(),
								    					'alt' => 'type',
								    					'type' => 'text',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'id' => 'unique_id'
														));
	                        ?>


	                    </div>
	                </div> <br><br>

	                <div class="form-group">
	                    <label for="inputPassword1" class="col-lg-2 control-label">Description</label>
	                    <div class="col-lg-9">
	                        <?php
	                           echo $this->Form->input('job_ticket_id', array(
	    												'options' => array('Prepress', 
	    																'Plate Making', 
	    																'RM Requisition',
							    										'Production',
							    										'Finished Goods',
							    										'Shipping'),
								    					'alt' => 'type',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'data-name' => 'job_ticket_id'
														));
	                        ?>

	                    </div>
	                </div> <br><br>

		            <div class="form-group">
		                <label for="inputPassword1" class="col-lg-2 control-label">Start Date</label>
		                <div class="col-lg-9"> 
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								   <?php
	                           			echo $this->Form->input('schedule_from', array( 'type' => 'text',
	                           							'alt' => 'type',
								    					'label' => false,
								   						'class' => 'form-control',
								    					'empty' => false,
								    					'id' => 'startDate',
								    					'data-name' => 'startDate'
														));
	                        ?>
							</div>
							<span class="help-block">ex. DD/MM/YYYY</span>
		                </div>
		            </div>

		            <div class="form-group">
		                <label for="inputPassword1" class="col-lg-2 control-label">End Date</label>
		                <div class="col-lg-9">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								 <?php
	                           			echo $this->Form->input('schedule_to', array( 'type' => 'text',
	                           							'alt' => 'type',
								    					'label' => false,
								   						'class' => 'form-control',
								    					'empty' => false,
								    					'id' => 'endDate',
								    					'data-name' => 'endDate'
														));
	                        ?>
							</div>
							<span class="help-block">ex. DD/MM/YYYY</span>
		                </div>
		            </div>

	              	<div class="form-group">
						<div class="col-lg-3">
							<button type="submit" class="btn btn-success pull-right">Submit Quotation</button>
						</div>
						<div class="col-lg-8">
							<?php 
		                        echo $this->Html->link('Cancel', array('controller' => 'production_systems', 'action' => 'index'),array('class' =>'btn btn-primary','escape' => false));
		                    ?>
						</div>
					</div>

	            </div> 

	        </div>
	    </div>  
	</div>
<?php echo $this->Form->end(); ?>