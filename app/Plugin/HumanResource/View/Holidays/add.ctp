<?php $this->Html->addCrumb('Holidays', array('controller' => 'schedules', 'action' => 'holiday')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'holidays', 'action' => 'add')); ?>
<?php echo $this->Html->css('HumanResource.default');?>
<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom'
)); ?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('Holiday',array('url'=>(array('controller' => 'holidays','action' => 'add')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>

    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                            Add Holiday
                            </h1>
                        </center>
                        <?php  echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'schedules', 'action' => 'holiday'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </header>

                </div>
            </div>
            
 <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1>Holiday Info </h1>
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
                                                        echo $this->Form->input('Holiday.name', array('class' => 'form-control col-lg-6 required','label' => false));
                                                    ?>

                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                       
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Month / Day </label>
                                                <div class="col-lg-9">
                                                  
                                                    <?php
                                                        //echo $this->Form->input('Holiday.start_date', array('class' => 'form-control col-lg-6 required','label' => false));
                                                    ?>
                                                    <?php
                                                        ///echo $this->Form->input('Holiday.end_date', array('class' => 'form-control col-lg-6 required','label' => false));
                                                    ?>
                                                     
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input placeholder="Date Range" name="from_date" data="1" type="text" class="form-control myDateRange datepickerDateRange" id="datepickerDateRange" >
                                                    </div>
                                                        
                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                   <!--    <div class="form-group">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Year</label>
                                                <div class="col-lg-9">
                                                

                                                    <?php
                                                        $years = [];
                                                        for ($i=date('Y'); $i > 1990 ; $i--) { 
                                                           $years[] = $i;
                                                        }
                                                        echo $this->Form->input('Holiday.year', array(
                                                            'options' => $years,
                                                            'class' => 'form-control col-lg-6 required',
                                                            'label' => false,

                                                            'value' => date('Y'),
                                                            'empty' => '-- Select Year --',
                                                            ));
                                                    ?>

                                                </div>
                                             </div>
                                        </div>
                                    </div>
 -->
                                        <div class="form-group">
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
<style type="text/css">
    .datepicker-hide .ui-datepicker-year
    {
        display:none;   
    }
</style>
<script>
    
jQuery(document).ready(function($){
       //datepicker
        $('.datepick').datepicker({
            
            changeYear: false,
            autoClose: true
        });

        $("#HolidayDate").click(function() {
            $(".datepicker-days .day").click(function() {
                $('.datepicker').hide();
            });
        });

        $('.datepickerDateRange').daterangepicker();
});

 </script>