<header class="main-box-header clearfix">
	<div class="filter-block">	

		
		<?php echo $this->Form->create('Attendance',array('controller' => 'attendances','action' => 'ajax_find', 'type'=> 'get')); ?>
	<div class="form-group pull-left">

				<input type="text" name="from" id="changeDate" class="form-control datepick" value="<?php echo $date ?>">

			    <i class="fa fa fa-calendar calendar-icon"></i>

				
			</div>

		<div class="form-group pull-left">
			-
		</div>

			<div class="form-group pull-left">
				
					<input type="text" name="to" id="changeDate" class="form-control datepick" value="<?php echo $date ?>">

			    	<i class="fa fa fa-calendar calendar-icon"></i>

			</div>

			<div class="form-group select2-modal pull-left">
				 <?php
			        echo $this->Form->input('employee_id',
			            array(
			                'id' => 'SearchEmployee',
			                'class' => 'col-lg-6 required autocomplete',
			                'label' => false,
			                'options' => $employees,
			                'default' => $attendances[0]['Employee']['id'],
			                'empty' => '-- Select Employee --',
			                ));
			 	?>
			</div>

			<div class="form-group pull-left">
			 	<button class="btn btn-success">Go</button> 
			</div>
		<?php echo $this->Form->end(); ?>
			                   
		<br><br>
	</div>
</header>

<div class="main-box-body clearfix">
	<div class="table-responsive">

		<table class="table table-striped table-hover">

			<thead>
				<tr>
					<th><a href="#"><span>Code</span></a></th>
					<th><a href="#"><span>Employee Name</span></a></th>
					<th><a href="#"><span>Type</span></a></th>
					<th><a href="#" class="text-center"><span>From</span></a></th>
					<th><a href="#" class="text-center"><span>To</span></a></th>
					<th><a href="#"><span>In</span></a></th>
					<th><a href="#"><span>Out</span></a></th>
					<th><a href="#"><span>Duration</span></a></th>
					<th><a href="#"><span>Status</span></a></th>
					<th><a href="#"><span>Remarks</span></a></th>
				</tr>
			</thead>

			<?php 
		        if(!empty($attendances)){
		            foreach ($attendances as $key => $schedule): ?>
						<tbody aria-relevant="all" aria-live="polite" role="alert">
							<tr class="">
								<td> <?php echo $schedule['Employee']['code']; ?></td>
								<td class="">
		                          <?php 
		                          if (!empty($schedule['Employee'])) {

		                          		echo $this->CustomText->getFullname($schedule['Employee']);
									}
		                          
		                           ?>
		                        </td>
		                        <td class="text-center"> 
		                           	<?php //echo $schedule['WorkSchedule']['type'] ?> 
		                           	<?php echo !empty($overtime['Overtime']['status']) ? $overtime['Overtime']['status'] : ''; ?>
									<span class="label <?php echo $schedule['Attendance']['type'] == 'work' ? 'label-success' : 'label-default' ?>"><?php
									 echo Inflector::humanize($schedule['Attendance']['type'])  ?></span>
		                        </td>
								<td> 
		                           <?php echo date('Y/m/d',strtotime($schedule['Attendance']['date'])).' '.date('h:i a',strtotime($schedule['WorkShift']['from'])); ?> 
		                        </td>
		                        <td > 
		                           <?php echo date('Y/m/d',strtotime($schedule['Attendance']['date'])).' '.date('h:i a',strtotime($schedule['WorkShift']['to'])); ?> 
		                        </td>
		                         </td>
		                        <td class="text-center"> 
		                           <?php 
		                           	
		                           	$timeIn = (!empty($schedule['Attendance']['in']) && $schedule['Attendance']['in']  != '00:00:00') ? date('h:i a',strtotime($schedule['Attendance']['in'])) : '';
									
									echo $timeIn;
		                            ?> 
		                        </td>
		                        </td>
		                        <td class="text-center"> 
		                           <?php 
		                           
		                           	$timeOut = (!empty($schedule['Attendance']['out']) && $schedule['Attendance']['out']  != '00:00:00') ? date('h:i a',strtotime($schedule['Attendance']['out'])) : '';

		                           	echo $timeOut;
		                           ?> 
		                        </td>
		                         <td class="text-center"> 
		                           <?php echo $this->CustomTime->getDuration($timeIn,$timeOut); ?> 
		                        </td>
		                        <td class=""> 
		                           <?php 
		                           		if ($schedule['Attendance']['status'] == 'OnTime') {
		                           			echo "<span class='label label-success'>OnTime</span>";
		                           		}
		                           		if ($schedule['Attendance']['status'] == 'Late') {
		                           			echo "<span class='label label-danger'>&nbsp;&emsp;&emsp;Late&emsp;&emsp;&nbsp;</span>";
		                           		}
		                           			
		                           ?> 
		                        </td>
		                        <td class="text-center"> 
		                           <?php echo $schedule['Attendance']['notes']; ?> 
		                        </td>
		                    </tr>

		                </tbody>
		        <?php 
		            endforeach; 
		        } ?> 
		
		</table>	

		<hr>

		 <div class="paging" id="item_type_pagination">
                <?php
               
                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable','model' => 'ClientOrder'));
                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Employee'), array('paginate' => 'Employee'));
                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable'));

                ?>
        </div>
	</div>
</div>
<style type="text/css">
.select2-modal .input.select {
  min-width: 200px;
}
</style>	

<script type="text/javascript">
	// $(document).ready(function(){


 //    $('body').on('submit','#AttendanceIndexForm',function(e){

 //    	$append_cont = $('#personalAttendance .result_append');

 //    	$append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');

 //    	$this =  $(this);

	// 	var url = $this.attr('action');

    	
	// 	$.ajax({
 //            type: "GET",
 //            url: serverPath+url,
 //            dataType: "html",
 //            success: function(data) {
               
 //            	$append_cont.html(data);

 //            	// $('.datepick').datepicker({
 //             //    	format: 'yyyy-mm-dd'
 //            	// 	});

 //            	// $(".autocomplete").select2();

 //            }
 //        });

 //    	e.preventDefault();
 //    });

	// });
</script>