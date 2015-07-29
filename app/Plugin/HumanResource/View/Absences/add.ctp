<?php $this->Html->addCrumb('Employee', array('controller' => 'employees', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'employees', 'action' => 'add')); ?>
<?php 
echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
)); 

echo $this->Html->script(array(
                    'jquery.maskedinput.min',
                    'HumanResource.custom',
                    'HumanResource.select2.min',
                    'HumanResource.absences'

)); 
?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('Absence',array('url'=>(array('controller' => 'absences','action' => 'add')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>
 <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                            Absence
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
                                    <div class="form-group">
                                       
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Employee </label>
                                                <div class="col-lg-9">
                                                  
                                                    <?php echo $this->Form->input('Absence.employee_id', array(
                                                        'class' => 'col-lg-6 required autocomplete',
                                                        'options' => $employees,
                                                        'empty' => '--- Select Employee ---',
                                                        'onchange' => 'checkEmployee(this)',
                                                        'label' => false));
                                                    ?>

                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Code</label>
                                                <div class="col-lg-9">
                                                   <?php
                                                                echo $this->Form->input('Absence.code', array(
                                                                    'class' => 'form-control col-lg-6 required disabled',
                                                                    'placeholder' => 'Auto Generated',
                                                                    'label' => false));
                                                         ?>


                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                       <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Period </label>
                                                <div class="col-lg-9">

                                                     <div class="col-lg-5 input-append bootstrap-timepicker">
                                                        <?php
                                                                echo $this->Form->input('Absence.from', array(
                                                                    'class' => 'form-control col-lg-6 required datepick',
                                                                    'type' => 'text',
                                                                    'label' => false
                                                                    ));
                                                         ?>

                                                     </div>
                                                        <div class="col-lg-2 text-center date-range-to"> to </div>
                                                      <div class="col-lg-5 input-append bootstrap-timepicker">
                                                        <?php
                                                            echo $this->Form->input('Absence.to', array(
                                                                'class' => 'form-control col-lg-6 required datepick',
                                                                'type' => 'text',    
                                                                'label' => false
                                                                ));
                                                        ?>
                                                     </div>
                                                  
                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                       <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Total Time</label>
                                                <div class="col-lg-9">
                                                   <?php
                                                                echo $this->Form->input('Absence.total_time', array(
                                                                    'class' => 'form-control col-lg-6 required disabled',
                                                                    'label' => false));
                                                         ?>


                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                       <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Code</label>
                                                <div class="col-lg-9">
                                                   <?php
                                                                echo $this->Form->input('Absence.reason', array(
                                                                    'class' => 'form-control col-lg-6 required disabled',
                                                                    'placeholder' => 'Reason for absence',
                                                                    'label' => false));
                                                         ?>


                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                  <!--   <div class="form-group">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Type </label>
                                                <div class="col-lg-9">
                                                  
                                                    <?php
                                                        $holiday_types = array(
                                                            'regular' => 'Regular Holiday',
                                                            'special' => 'Special Non-Working',
                                                            );
                                                        echo $this->Form->input('Holiday.type', array(
                                                            'options' => $holiday_types ,
                                                            'class' => 'form-control col-lg-6 required',
                                                            'label' => false,
                                                            'empty' => '-- Select Type --'
                                                            ));
                                                    ?>
                                                </div>
                                             </div>
                                        </div>
                                    </div> -->



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
<style type="text/css">
    .datepicker-hide .ui-datepicker-year
    {
        display:none;   
    }
</style>
<script>

 </script>