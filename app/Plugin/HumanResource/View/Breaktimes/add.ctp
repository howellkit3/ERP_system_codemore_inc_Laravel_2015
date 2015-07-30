<?php $this->Html->addCrumb('Employee', array('controller' => 'employees', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'employees', 'action' => 'add')); ?>
<?php echo $this->Html->css(array('HumanResource.default','timepicker'));?>
<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom',
                        'HumanResource.breaktime'
)); ?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('Breaktime',array('url'=>(array('controller' => 'breaktimes','action' => 'add')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>

    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                            Add Breaktime
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
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Name</label>
                                                <div class="col-lg-9">
                                                  
                                                    <?php
                                                        echo $this->Form->input('Breaktime.name', array('class' => 'form-control col-lg-6 required','label' => false));
                                                    ?>

                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Duration</label>
                                                <div class="col-lg-2">
                                                   <?php
                                                                echo $this->Form->input('Breaktime.duration', array(
                                                                    'class' => 'form-control col-lg-6 required number',
                                                                    'type' => 'number',
                                                                    'value' => 1,
                                                                    'label' => false));
                                                         ?>


                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                       
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Time </label>
                                                <div class="col-lg-9">

                                                     <div class="col-lg-5 input-append bootstrap-timepicker">
                                                        <?php
                                                                echo $this->Form->input('Breaktime.from', array('class' => 'form-control col-lg-6 required timepicker','label' => false));
                                                         ?>

                                                     </div>



                                                        <div class="col-lg-2 text-center"> To </div>
                                                      <div class="col-lg-5 input-append bootstrap-timepicker">
                                                        <?php
                                                            echo $this->Form->input('Breaktime.to', array('class' => 'form-control col-lg-6 required timepicker','label' => false));
                                                        ?>
                                                     </div>
                                                  
                                                   

                                                   
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
    
jQuery(document).ready(function($){
       //datepicker
       $('.timepicker').timepicker({
            minuteStep: 5,
            showSeconds: true,
            showMeridian: false,
            disableFocus: false,
            showWidget: true
        }).focus(function() {
            $(this).next().trigger('click');
        });

        $("#HolidayDate").click(function() {
            $(".datepicker-days .day").click(function() {
                $('.datepicker').hide();
            });
        });
});

 </script>