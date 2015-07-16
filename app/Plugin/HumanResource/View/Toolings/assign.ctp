<?php $this->Html->addCrumb('Employee', array('controller' => 'employees', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'employees', 'action' => 'add')); ?>
<?php echo $this->Html->css('HumanResource.default');?>
<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom'
)); ?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('Tooling',array('url'=>(array('controller' => 'toolings','action' => 'assign')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>


    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                                Assign Tools
                            </h1>
                        </center>
                        <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'employees', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </header>

                </div>
            </div>
         	

         	 <?php $employeeData = !empty($this->request->data) ? $this->request->data : ''; ?>
 <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1></h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                    	<div class="col-lg-12">
                                     		<div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> First Name</label>
		                                        <div class="col-lg-9">
		                                        	<?php
		                                                echo $this->Form->input('Tooling.id', array('class' => 'form-control col-lg-6 required','label' => false));

		                                                echo $this->Form->input('Tooling.employee_id', array('class' => 'form-control col-lg-6 required','label' => false));
		                                            ?>
		                                            <span></span>
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
			                                                echo $this->Form->input('Employee.suffix', array('class' => 'form-control col-lg-6','label' => false));
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