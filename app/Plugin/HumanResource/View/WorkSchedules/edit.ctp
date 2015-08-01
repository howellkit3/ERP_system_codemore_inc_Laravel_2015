<?php $this->Html->addCrumb('Schedules', array('controller' => 'Schedules', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Workshifts', array('controller' => 'schedules', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'workshifts', 'action' => 'add')); ?>
<?php echo $this->Html->css(array(
    'HumanResource.default',
    'HumanResource.select2.css',
    'timepicker'
    ));?>
<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom',
                        'HumanResource.select2.min',
                        'HumanResource.work_schedules'
)); ?>
<div style="clear:both"></div>
<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('WorkSchedule',array('url'=>(array('controller' => 'work_schedules','action' => 'edit')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>

    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                            Add Schedule
                            </h1>
                        </center>
                        <?php  echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'schedules', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </header>

                </div>
            </div>
            
        <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <br/>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                <div class="col-lg-6">    
                                    <?php echo $this->Form->input('WorkSchedule.id'); ?>
                                
                                    <div class="form-group">
                                       <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span>  Add schedule by :   </label>
                                                <div class="col-lg-9">
                                                   <div class="radio">


                                                                            <input type="radio" name="data[WorkSchedule][model]" id="categoryRadio1" value="Employee" checked>
                                                                            <label for="categoryRadio1">
                                                                                Employee
                                                                            </label>
                                                                            <input type="radio" name="data[WorkSchedule][model]" id="categoryRadio2" value="Department">
                                                                            <label for="categoryRadio2">
                                                                                Department
                                                                            </label>
                                                                </div>

                                                </div>
                                             </div>
                                        </div>
                                    </div>                   
                                    <div class="form-group select2-cont">
                                       <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span>Employee Name</label>
                                                <div class="col-lg-9">
                                                  
                                                    <?php
                                                        echo $this->Form->input('WorkSchedule.foreign_key',
                                                            array(
                                                                'id' => 'SearchEmployee',
                                                                'class' => 'col-lg-6 required autocomplete',
                                                                'label' => false,
                                                                'options' => $employees,
                                                                'empty' => '-- Select Employee --'
                                                                ));
                                                    ?>

                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                      <div class="form-group">
                                       <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span>Day</label>
                                                <div class="col-lg-9">
                                                  
                                                    <?php
                                                        echo $this->Form->input('WorkSchedule.day',
                                                            array(
                                                                'type' => 'text',
                                                                'class' => 'form-control col-lg-6 required datepick',
                                                                'label' => false,
                                                                'value' => date('Y-m-d')
                                                                ));
                                                    ?>

                                                </div>
                                             </div>
                                        </div>
                                    </div>


                                    <div class="form-group select2-cont">
                                        <div class="col-lg-12">
                                            <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Shift </label>
                                            <div class="col-lg-9">
                                              
                                                <?php

                                                    echo $this->Form->input('WorkSchedule.work_shift_id', array(
                                                        'type' => 'select',
                                                        'empty' => '--- Select shift ---',
                                                        'class' => 'col-lg-6 autocomplete required',
                                                        'options' => $workshifts,
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
                                        echo $this->Form->submit('Submit', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                    ?>
                                  
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'schedules', 'action' => 'holiday','plugin' => 'human_resorce'),array('class' =>'btn btn-default','escape' => false));
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

<?php echo $this->element('modals/workshift'); ?>
<script type="text/javascript">
    $(document).ready(function(){
           $('.datepick').datepicker({
                format: 'yyyy-mm-dd'
            });
        $(".autocomplete").select2();
    });
</script>