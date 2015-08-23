<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Machine', array('controller' => 'settings', 'action' => 'machines','tab' => 'machines')); ?>
<?php $this->Html->addCrumb('Edit', array('controller' => 'machines', 'action' => 'edit',$this->request->data['Machine']['id'])); ?>

<?php 	echo $this->element('production_options'); ?>

<br><br><br>
	
<?php echo $this->Form->create('Machine',array('url'=>(array('controller' => 'machines','action' => 'edit')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>

    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                                Edit Machine Information
                            </h1>
                        </center>
                        <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'machines','tab' => 'machines','plugin' => 'production'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </header>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1>Machine Info</h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                    	
                                		<div class="form-group">

	                                        <label class="col-lg-2 control-label"><span style="color:red">*</span> No.</label>
	                                        <div class="col-lg-8">
	                                        	
	                                            <?php 

	                                            	echo $this->Form->input('Machine.id',
				                                         array('class' => 'form-control required',
				                                        'type' => 'hidden',
				                                        'label' => false));

	                                            	echo $this->Form->input('Machine.no',
				                                         array('class' => 'form-control required',
				                                        'placeholder' => 'Machine no.',
				                                        'label' => false));

				                                ?>

	                                        </div>
	                                    </div>

	                                    <div class="form-group">

	                                        <label class="col-lg-2 control-label"><span style="color:red">*</span> Name</label>
	                                        <div class="col-lg-8">
	                                        	
	                                            <?php echo $this->Form->input('Machine.name',
				                                         array('class' => 'form-control required',
				                                        'placeholder' => 'Machine name',
				                                        'label' => false));

				                                ?>

	                                        </div>
	                                    </div>

	                                    <div class="form-group">

	                                        <label class="col-lg-2 control-label"><span style="color:red">*</span> Area</label>
	                                        <div class="col-lg-8">
	                                        	
	                                            <?php echo $this->Form->input('Machine.area',
				                                         array('class' => 'form-control required',
				                                        'placeholder' => 'Area',
				                                        'label' => false));

				                                ?>

	                                        </div>
	                                    </div>

	                                    <div class="form-group">

	                                        <label class="col-lg-2 control-label">Department</label>
	                                        <div class="col-lg-8">
	                                        	
	                                            <?php echo $this->Form->input('Machine.department_id',
				                                         array('class' => 'form-control machine-department',
				                                         	'options' => array($departmentList),
				                                        	'placeholder' => 'Department',
				                                        	'empty' => '-- Select Department --',
				                                        	'default' => !empty($this->request->data['Machine']['department_id']) ? $this->request->data['Machine']['department_id'] : '',
				                                        	'label' => false));

				                                ?>

	                                        </div>
	                                    </div>

	                                    <div class="form-group">

	                                        <label class="col-lg-2 control-label">Section</label>
	                                        <div class="col-lg-8">
	                                        	
	                                            <?php echo $this->Form->input('Machine.section_id',
				                                         array('class' => 'form-control',
				                                         	'options' => array($sectionList),
				                                        	'placeholder' => 'Section',
				                                        	'empty' => '-- Select Section --',
				                                        	'default' => !empty($this->request->data['Machine']['department_id']) ? $this->request->data['Machine']['department_id'] : '',
				                                        	'label' => false));

				                                ?>

	                                        </div>
	                                    </div>

	                                    <div class="form-group">

	                                        <label class="col-lg-2 control-label">Remarks</label>
	                                        <div class="col-lg-8">
	                                        	
	                                            <?php echo $this->Form->input('Machine.remarks',
				                                         array('class' => 'form-control',
				                                        'placeholder' => 'Remarks',
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
                                        echo $this->Form->submit('Submit Machine Information', array('class' => 'btn btn-success pull-left',  'title' => 'Click here to add the machine'));
                                    ?>
                                  
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'settings', 'action' => 'machines','tab' => 'machines','plugin' => 'production'),array('class' =>'btn btn-default','escape' => false));
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

<script>
   jQuery(document).ready(function($){
        $("#MachineEditForm").validate();
            
    });
</script>

