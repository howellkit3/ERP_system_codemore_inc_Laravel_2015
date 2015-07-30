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
								                          if ($schedule['WorkSchedule']['model'] == 'Employee') {

								                          		echo $this->CustomText->getFullname($schedule['Employee']);

								                          } else if ($schedule['WorkSchedule']['model'] == 'Department') {

								                          		echo "Department";
								                          }
								                          
								                           ?>
								                        </td>
								                        <td class="text-center"> 
								                           <?php echo $schedule['WorkSchedule']['type'] ?> 
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
								<div class="paging modal-pagination" id="item_type_pagination">
								<?php
								echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
								echo $this->Paginator->numbers(array('separator' => ''));
								echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
								?>
								</div>


	</div>
<style type="text/css">
.select2-modal .input.select {
  min-width: 200px;
}
</style>
<script type="text/javascript">
	
	jQuery(document).ready(function(){


        $('#item_type_pagination a').click(function(e) {

        	$append_cont = $('#personalAttendance .main-box-body');

            var getUrl = $(this).attr('href');

            $append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');


            $.ajax({
              url:getUrl,
              type: "GET",
              success:function(data){

              	$append_cont.html(data);
              }
            });

            e.preventDefault();

        });

	});

</script>	