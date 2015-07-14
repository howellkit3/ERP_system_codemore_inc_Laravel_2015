<?php $this->Html->addCrumb('Employee', array('controller' => 'employees', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'employees', 'action' => 'add')); ?>
<?php echo $this->Html->css('HumanResource.default');?>
<?php echo $this->Html->script('HumanResource.custom');?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('Employee',array('url'=>(array('controller' => 'employees','action' => 'add')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>
    <div class="row">
        <div class="col-lg-12">
        
            <div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                                Employee Information
                            </h1>
                        </center>
                        <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'employees', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </header>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1>Personal Info</h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                    	<div class="col-lg-6">
                                     		<div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> First Name</label>
		                                        <div class="col-lg-9">
		                                            <?php
		                                                echo $this->Form->input('Employee.first_name', array('class' => 'form-control col-lg-6 required','label' => false));
		                                            ?>
		                                        </div>
		                                     </div>
		                                     <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Last Name</label>
		                                        <div class="col-lg-9">
		                                            <?php
		                                                echo $this->Form->input('Employee.last_name', array('class' => 'form-control col-lg-6 required','label' => false));
		                                            ?>
		                                        </div>
		                                     </div>

		                                     <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Middle Name</label>
			                                        <div class="col-lg-9">
			                                            <?php
			                                                echo $this->Form->input('Employee.middle_name', array('class' => 'form-control col-lg-6 required','label' => false));
			                                            ?>
			                                        </div>
		                                     </div>

		                                      <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"> Suffix</label>
			                                        <div class="col-lg-9">
			                                            <?php
			                                                echo $this->Form->input('Employee.suffix', array('class' => 'form-control col-lg-6 required','label' => false));
			                                            ?>
			                                        </div>
		                                     </div>
		                                 </div>



		                                 <div class="col-lg-6">
                                     		<div class="form-group">
		                                       

		                                        
		                                        <div class="col-lg-7">
			                                        <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Department</label>
			                                            <?php
				                                            $department = array('' => 'Select Department',
				                                            	'1' => 'Accounting',
				                                            	'2' => 'Sales',
				                                            	'3' => 'Delivery'
				                                            );

				                                             echo $this->Form->input('Employee.department_id', array(
				                                             	'options' => $department, 
				                                             	'class' => 'form-control required',
				                                             	'div' => 'col-lg-7',
				                                             	'label' => false));
				                                            ?>
			                                          </div>

			                                          <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Position</label>
			                                            <?php
				                                            $position = array(
				                                            	'' => 'Select Position',
				                                            	'1' => 'CEO',
				                                            	'2' => 'Vice President',
				                                            	'3' => 'Employee',
				                                            	'4' => 'Others'
				                                            	);

				                                             echo $this->Form->input('Employee.position_id', array(
				                                             	'options' => $position, 
				                                             	'class' => 'form-control required',
				                                             	'div' => 'col-lg-7',
				                                             	'label' => false));
				                                            ?>
			                                          </div>

			                                          <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Gender</label>
			                                           	 <div class="radio col-lg-7">
																			<input type="radio" name="data[Employee][gender]" id="categoryRadio1" value="M" checked>
																			<label for="categoryRadio1">Male
																			</label>
																			<input type="radio" name="data[Employee][gender]" id="categoryRadio2" value="F">
																			<label for="categoryRadio2">Female
																			</label>
														</div>
			                                          </div>

			                                          <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Status</label>
			                                           	 <div class="radio col-lg-7">
															<?php echo $this->Form->input('Employee.status', array(
			                                             	'class' => 'form-control col-lg-6 required',
			                                             	'label' => false));
			                                        	?>				
														 </div>
			                                          </div>
			                                          
		                                        </div>
		                                        <div class="col-lg-4">
		                                        	<div class="image_profile">

			                                        	<?php 
			                                        		echo $this->Form->input('Employee.file', array(
			                                        		'type' => 'file',
			                                             	'class' => 'form-control btn-success',
			                                             	'onchange' => 'readURL(this,"image_profile")',
			                                             	'label' => false));
			                                        	?>


		                                        	</div>

		                                        	<button class="btn btn-success upload-image"> Uplad Photo</button>
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


    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
               
                <div class="top-space"></div>
                <div class="main-box-body clearfix">
                    <div class="main-box-body clearfix">
                        <div class="form-horizontal">
                
                            <div class="multi-field clearfix">
                                <div class="col-xs-2 col-md-2"></div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Form->submit('Submit Customer Information', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                    ?>
                                  
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'customer_sales', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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
