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
			                <h2 class="pull-left"><b>Calendar</b> </h2>
			                <div class="filter-block pull-right">
			                 <div class="form-group pull-left">
			                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
			                            <input placeholder="Search..." class="form-control searchCustomer"  />
			                            <i class="fa fa-search search-icon"></i>
			                         <?php //echo $this->Form->end(); ?>
			                    </div>
			                     <?php
			                   		
			                   		$links = array('controller' => 'schedules', 'action' => 'holiday');

			                   
			                      echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add', 
			                            array('controller' => 'holidays', 
			                                    'action' => 'add',),
			                            array('class' =>'btn btn-primary pull-right',
			                                'escape' => false));

			                    ?> 
			                  
			                   <br><br>
			               </div>
			            </header>

			            <div class="main-box-body clearfix">

			              <div id="calendar"></div>
			            
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

  $('#calendar').fullCalendar({
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