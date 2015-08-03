<?php $this->Html->addCrumb('Employee', array('controller' => 'employees', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Edit', array('controller' => 'employees', 'action' => 'edit')); ?>
<?php echo $this->Html->css('HumanResource.default');?>
<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom',
						'HumanResource.toolings'
)); ?>
<?php echo $this->element('modals',array('tools' => $tools)); ?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('Tooling',array('url'=>(array('controller' => 'toolings','action' => 'edit')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>
<div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                                Edit Assign Tools
                            </h1>
                        </center>
                        <?php  echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'employees', 'action' => 'index','tab' => 'tab-tooling'),array('class' =>'btn btn-primary pull-right','escape' => false)); ?>
                    </header>

                </div>
            </div>
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
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Select Person </label>
		                                        <div class="col-lg-9">
		                                        	<?php

		                                        		
		                                                echo $this->Form->input('Tooling.id', array('class' => 'form-control col-lg-6 required','label' => false));

		                                                echo $this->Form->input('Tooling.employee_id', array(
		                                                	'type' => 'select',
		                                                	'class' => 'form-control col-lg-6 required',
		                                                	'label' => false,
		                                                	'default' => $this->request->data['Tooling']['employee_id'],
		                                                	//'id' => 'selectEmployee',
		                                                	'options' => array($employee),
		                                                	'empty' => '-- Select Employee --',
		                                                	//'data-modal' => '#EmployeeModal'
		                                                	));

		                                            ?>
		                                            <span></span>
		                                        </div>
		                                     </div>
		                                     <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Tools </label>
		                                        <div class="col-lg-9">
		                                            <?php
		                                                
		                                             echo $this->Form->input('Tooling.tools_id',
		                                              array('class' => 'form-control col-lg-6 required',
		                                              		'type' => 'select',
		                                              		'label' => false,	
		                                                	//'id' => 'selectTool',
		                                                	'default' => $this->request->data['Tooling']['tools_id'],
		                                                	'options' => array($toolList),
		                                                	'empty' => '-- Select Tool --',
		                                                	//'data-modal' => '#ToolsModal'
		                                                	));
		                                            ?>
		                                        </div>
		                                     </div>
		                                      <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Price </label>
		                                        <div class="col-lg-9">
		                                            <?php
		                                                
		                                             echo $this->Form->input('Tooling.price', array('class' => 'form-control col-lg-6 required','label' => false));
		                                            ?>
		                                        </div>
		                                     </div>
		                                      <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Quantity </label>
		                                        <div class="col-lg-9">
		                                            <?php
		                                                
		                                             echo $this->Form->input('Tooling.quantity', array('class' => 'form-control col-lg-6 required',
		                                             	'type' => 'number',
		                                             	'label' => false));
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
                                        echo $this->Form->submit('Assign', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to assign the employee'));
                                    ?>
                                  
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'employees', 'action' => 'index','tab' => 'tab-tooling'),array('class' =>'btn btn-default','escape' => false));
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
<script>
   jQuery(document).ready(function($){
        $("#ToolingEditForm").validate();
            
    });
</script>