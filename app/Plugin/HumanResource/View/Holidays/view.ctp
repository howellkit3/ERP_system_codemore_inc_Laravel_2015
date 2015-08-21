<?php $this->Html->addCrumb('Employee', array('controller' => 'employees', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'employees', 'action' => 'add')); ?>
<?php echo $this->Html->css(array(
                        'HumanResource.default',
                        'HumanResource.fullcalendar/fullcalendar',
                           ));?>
<?php echo $this->Html->script(array(

                        'HumanResource.fullcalendar/lib/moment.min.js',
                        'HumanResource.fullcalendar/fullcalendar.js',
						'jquery.maskedinput.min',
						'HumanResource.custom'
)); ?>
<!-- 
<link href='../fullcalendar.css' rel='stylesheet' />
<link href='../fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='../lib/moment.min.js'></script>
<script src='../lib/jquery.min.js'></script>
<script src='../fullcalendar.min.js'></script>
 -->

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
                            Holidays
                            </h1>
                        </center>

                        
                        <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'schedules', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));

                                
                                  echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Edit', 
                                        array('controller' => 'holidays', 
                                                'action' => 'edit',$holiday['Holiday']['id']),
                                        array('class' =>'btn btn-primary pull-right',
                                            'escape' => false));

                                ?> 
                    </header>

                </div>
            </div>
            
    <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1> <?php echo ucwords($holiday['Holiday']['name'])?> </h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                                <div id="calendar"></div>
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
var dateSelected = '<?php echo $holiday["Holiday"]["start_date"]; ?>';
var dateEnd = '<?php echo $holiday["Holiday"]["end_date"]; ?>';
var eventName = '<?php echo $holiday["Holiday"]["name"]; ?>';

jQuery(document).ready(function($){

            $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: dateSelected,
            businessHours: true, // display business hours
            editable: true,
            events: [
                {
                    title: eventName,
                    start: dateSelected,
                    end : dateEnd
                   // constraint: 'businessHours'
                },
               
            ]
        });


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
});

 </script>