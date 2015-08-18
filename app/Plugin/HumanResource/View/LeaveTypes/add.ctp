<?php $this->Html->addCrumb('Settings', array('controller' => 'settings', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Leave types', array('controller' => 'settings', 'action' => 'leave_types','tab'=>'leave_types')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'leave_types', 'action' => 'add')); ?>
<?php echo $this->Html->script(array(
                        'jquery.maskedinput.min',
                        'HumanResource.custom'
)); ?>
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
                    'HumanResource.monthpicker-master/jquery.monthpicker',
                    'HumanResource.work_schedules',

)); ?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('LeaveType',array('url'=>(array('controller' => 'leave_types','action' => 'add')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>

    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                            Leave Type Information
                            </h1>
                        </center>
                        <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'leave_types','tab'=>'leave_types'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </header>

                </div>
            </div>
           <?php echo $this->element('leave_type_form'); ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                       <!--  <h1>Personal Info</h1> -->
                        <div class="top-space"></div>
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <div class="form-group">

                                                <label for="inputEmail1" class="col-lg-2 control-label"> </label>
                                                <div class="col-lg-4">
                                                    <?php 
                                                        echo $this->Form->submit('Submit Status Information', array('class' => 'btn btn-success pull-left',  'title' => 'Click here to add leave type'));
                                                        echo "&nbsp;";
                                                        echo $this->Html->link('Cancel ', array('controller' => 'settings', 'action' => 'leave_types','tab'=>'leave_types','plugin' => 'human_resource'),array('class' =>'btn btn-default ','escape' => false));

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

<?php echo $this->Form->end(); ?>
<script>
   jQuery(document).ready(function($){
        $("#LeaveTypeAddForm").validate();
            
    });
</script>