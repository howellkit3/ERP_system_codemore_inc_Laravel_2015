<?php 
 echo $this->Html->css(array(
                        'HumanResource.default',
                        'HumanResource.fullcalendar/fullcalendar',
                           ));

echo $this->Html->script(array(

                        'HumanResource.fullcalendar/lib/moment.min.js',
                        'HumanResource.fullcalendar/fullcalendar.js'
));

	echo $this->element('hr_options');

	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/schedules',array('active_tab' => $active_tab)); ?>
		<div class="main-box-body clearfix">
		 
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane active " id="tab-calendar">
						<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Employee Work Schedule</b> </h2>
			                <div class="filter-block pull-right">
			                 <div class="form-group pull-left">
			                        
			                    </div>
			                    
			                  
			                   <br><br>
			               </div>
			            </header>

			            <div class="main-box-body clearfix">
			            	<div class="box calendar_view">	
				            		<ul class="legends">
				            			<li> <div class="box-color green"></div> Regular working days </li>
				            			<li> <div class="box-color violet"></div> Rest Days </li>
				            			<li> <div class="box-color orange"></div> Holidays </li>
				            		</ul>			

			             		 <div id="calendarSchedule"></div>

			            	</div>		
			            
						</div>
					</div>		
	            </div>
			</div>
		</div>	




	    </div>
    </div>
</div>


<script>
var dateSelected = '<?php echo date("Y-m-d"); ?>';
var eventName = 'Now';

jQuery(document).ready(function($){

  $('#calendarSchedule').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: dateSelected,
            businessHours: true, // display business hours
            editable: true,
            events:  [ 
            		<?php echo $list; ?>
				]
        });
});



 </script>