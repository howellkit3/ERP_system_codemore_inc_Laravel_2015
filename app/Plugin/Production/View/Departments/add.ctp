<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Department', array('controller' => 'settings', 'action' => 'departments','tab' => 'departments')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'departments', 'action' => 'add')); ?>

<?php 	echo $this->element('production_options'); ?>

<br><br><br>
	
<?php echo $this->Form->create('Department',array('url'=>(array('controller' => 'departments','action' => 'add')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>

    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                                Add Department Information
                            </h1>
                        </center>
                        <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'departments','tab' => 'departments','plugin' => 'production'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </header>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1>Department Info</h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                    	
                                		<div class="form-group">

	                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Name</label>
	                                        <div class="col-lg-8">
	                                        	
	                                            <?php echo $this->Form->input('Department.name',
				                                         array('class' => 'form-control required',
				                                        'placeholder' => 'Department Name',
				                                        'label' => false));

				                                ?>

	                                        </div>
	                                    </div>

	                                    <div class="form-group">

	                                        <label class="col-lg-2 control-label"><span style="color:red">*</span> Description</label>
	                                        <div class="col-lg-8">
	                                        	
	                                            <?php echo $this->Form->input('Department.description',
				                                         array('class' => 'form-control required',
				                                        'placeholder' => 'Description',
				                                        'label' => false));

				                                ?>

	                                        </div>
	                                    </div>

	                                    <div class="form-group">

	                                        <label class="col-lg-2 control-label">Remarks</label>
	                                        <div class="col-lg-8">
	                                        	
	                                            <?php echo $this->Form->input('Department.remarks',
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
                                        echo $this->Form->submit('Submit Department Information', array('class' => 'btn btn-success pull-left',  'title' => 'Click here to add the department'));
                                    ?>
                                  
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'settings', 'action' => 'departments','tab' => 'departments','plugin' => 'production'),array('class' =>'btn btn-default','escape' => false));
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
        $("#DepartmentAddForm").validate();
            
    });
</script>

