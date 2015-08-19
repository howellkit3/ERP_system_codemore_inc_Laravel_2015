<?php $this->Html->addCrumb('Attendance', array('controller' => 'attendances', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Leaves', array('controller' => 'attendances', 'action' => 'leaves','tab'=>'leaves')); ?>
<?php $this->Html->addCrumb('Edit', array('controller' => 'leaves', 'action' => 'edit',$this->request->data['Leave']['id'])); ?>
<?php echo $this->Html->script(array(
                        'jquery.maskedinput.min',
                        'HumanResource.custom'
)); ?>
<?php 
    echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    //'timepicker'
    ));
     echo $this->Html->script(array(
                    'jquery.maskedinput.min',
                    'HumanResource.custom',
                    'HumanResource.select2.min',
                    //'HumanResource.monthpicker-master/jquery.monthpicker',
                    'HumanResource.work_schedules',
                    'HumanResource.leave',

)); ?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('Leave',array('url'=>(array('controller' => 'leaves','action' => 'edit')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                                Edit Employee Leave Information
                            </h1>
                        </center>
                        <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'attendances', 'action' => 'leaves','tab'=>'leaves'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </header>

                </div>
            </div>
           <?php echo $this->element('leave_form'); ?>

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
                                                        echo $this->Form->submit('Submit Status Information', array('class' => 'btn btn-success pull-left',  'title' => 'Click here to update employee leave'));
                                                        echo "&nbsp;";
                                                        echo $this->Html->link('Cancel ', array('controller' => 'settings', 'action' => 'status','tab'=>'status','plugin' => 'human_resource'),array('class' =>'btn btn-default ','escape' => false));

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
        $("#StatusAddForm").validate();
            
    });
</script>