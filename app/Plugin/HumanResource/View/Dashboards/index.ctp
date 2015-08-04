<?php $this->Html->addCrumb('Human Resource', array('controller' => 'employees', 'action' => 'index')); ?>


<?php 
echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'datetimepicker/jquery.datetimepicker'
)); 

echo $this->Html->script(array(
					'jquery.maskedinput.min',
					'HumanResource.moment',
					'HumanResource.custom',
                    'HumanResource.select2.min',

));  
?>
<div style="clear:both"></div>

<div class="main-box">
<header class="main-box-header clearfix">
<h2 class="pull-left">Quick Launch</h2>
</header>
<div class="main-box-body clearfix">
<div class="row">
<div class="col-md-9">
<?php 	echo $this->element('hr_options'); ?>
</div>
<div class="col-md-3">
	<div class="clock"></div>
</div>
</div>
</div>
</div>


<div class="main-box">
<header class="main-box-header clearfix">
<h2 class="pull-left">Sales &amp; Earnings</h2>
</header>
<div class="main-box-body clearfix">
<div class="row">
<div class="col-md-9">
<div id="graph-bar" style="height: 240px; padding: 0px; position: relative;"><canvas class="flot-base" width="963" height="240" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 963px; height: 240px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 925px; text-align: center;">Dec</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 40px; text-align: center;">Jan</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 121px; text-align: center;">Feb</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 195px; text-align: center;">Mar</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 278px; text-align: center;">Apr</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 356px; text-align: center;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 441px; text-align: center;">Jun</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 523px; text-align: center;">Jul</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 601px; text-align: center;">Aug</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 684px; text-align: center;">Sep</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 764px; text-align: center;">Oct</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 223px; left: 845px; text-align: center;">Nov</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 209px; left: 20px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 168px; left: 7px; text-align: right;">250</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 126px; left: 7px; text-align: right;">500</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 84px; left: 7px; text-align: right;">750</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 42px; left: 0px; text-align: right;">1000</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 0px; text-align: right;">1250</div></div></div><canvas class="flot-overlay" width="963" height="240" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 963px; height: 240px;"></canvas><div class="legend"><div style="position: absolute; width: 72px; height: 34px; top: 14px; right: 17px; opacity: 0.85; background-color: rgb(255, 255, 255);"> </div><table style="position:absolute;top:14px;right:17px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #000000;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(3,169,244);overflow:hidden"></div></div></td><td class="legendLabel">Revenues</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #000000;padding:1px"><div style="width:4px;height:0;border:5px solid #e84e40;overflow:hidden"></div></div></td><td class="legendLabel">Orders</td></tr></tbody></table></div></div>
</div>
<div class="col-md-3">
<div class="datepick homepage"></div>
</div>
</div>
</div>
</div>




<div class="main-box">
<header class="main-box-header clearfix">
<h2 class="pull-left">Attendance</h2>
</header>
<div class="main-box-body clearfix">
<div class="row">
<div class="col-md-12">

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
											<th><a href="#"><span>Remarks</span></a></th>
										</tr>
									</thead>

									<tbody aria-relevant="all" aria-live="polite" role="alert">
									<?php  if(!empty($attendances)){

								            foreach ($attendances as $key => $schedule): ?>
													<tr class="parent-tr-<?php echo $schedule['Attendance']['id'] ?>">
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

								                        	<?php echo !empty($overtime['Overtime']['status']) ? $overtime['Overtime']['status'] : ''; ?>
															<span class="label <?php echo $schedule['Attendance']['type'] == 'work' ? 'label-success' : 'label-default' ?>"><?php echo $schedule['Attendance']['type'] ?></span>

								                        </td>
														<td> 
								                           <?php echo date('Y/m/d',strtotime($schedule['Attendance']['date'])).' '.date('h:i a',strtotime($schedule['WorkShift']['from'])); ?> 
								                        </td>
								                        <td > 
								                           <?php echo date('Y/m/d',strtotime($schedule['Attendance']['date'])).' '.date('h:i a',strtotime($schedule['WorkShift']['to'])); ?> 
								                        </td>
								                         </td>
								                        <td class="text-center time-in"> 
								                           <?php 
								                           $timeIn = (!empty($schedule['Attendance']['in']) && $schedule['Attendance']['in']  != '00:00:00') ? date('h:i a',strtotime($schedule['Attendance']['in'])) : '';
															echo $timeIn;
								                            ?> 
								                        </td>
								                        </td>
								                        <td class="text-center time-out"> 
								                           <?php 
								                           $timeOut = (!empty($schedule['Attendance']['out']) && $schedule['Attendance']['out']  != '00:00:00') ? date('h:i a',strtotime($schedule['Attendance']['out'])) : '';

								                           	echo $timeOut;
								                           ?> 
								                        </td>
								                         <td class="text-center" > 
								                           <?php echo $this->CustomTime->getDuration($timeIn,$timeOut); ?> 
								                        </td>
								                        <td class="text-center notes-td"> 
								                           <?php echo $schedule['Attendance']['notes']; ?> 
								                        </td>
								                    </tr>

								                
								        <?php 
								            endforeach; 
								        } ?> 
									</tbody>
								</table>	
								<?php  if(!empty($attendances)) { ?> 
								<div class="pull-right">
									<?php echo $this->Html->link('View All',array('controller' => 'attendances','action' => 'index'),array('escape' => false)); ?>
								</div>
								<?php } ?>
							</div>
						</div>		

</div>
</div>
</div>
</div>



<div style="clear:both"></div>

<div class="main-box">
<header class="main-box-header clearfix">
<h2 class="pull-left">Recent Absences</h2>
</header>
<div class="main-box-body clearfix">
<div class="row">
<div class="col-md-12"><div class="main-box-body clearfix">
			            	<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th><a href="#"><span>Code</span></a></th>
											<th><a href="#"><span>Employee Name</span></a></th>
											<th><a href="#" class="text-center"><span>From</span></a></th>
											<th><a href="#" class="text-center"><span>To</span></a></th>
											<th><a href="#"><span>Total Time</span></a></th>
											<th><a href="#" class="text-center"><span>Reason</span></a></th>
										</tr>
									</thead>

									<?php 
								        if(!empty($absences)){
								            foreach ($absences as $key => $absence): ?>
												<tbody aria-relevant="all" aria-live="polite" role="alert">
													<tr class="">
														<td> <?php echo $absence['Employee']['code']; ?></td>
														<td class="">
								                          <?php 
								                          if (!empty($absence['Employee']['id'])) {

								                          		echo $this->CustomText->getFullname($absence['Employee']);

								                          	}
								                           ?>
								                        </td>
														<td> 
								                           <?php  
								                           if (!empty($absence['Absence']['from'])) {
								                           	 		echo date('Y-m-d H:i',strtotime($absence['Absence']['from']));
								                           	 }								                           
								                           ?> 
								                        </td>
								                        <td > 
								                             <?php  
								                           if (!empty($absence['Absence']['from'])) {
								                           	 		echo date('Y-m-d H:i',strtotime($absence['Absence']['to']));
								                           	 }								                           
								                           ?> 
								                        </td>
								                         </td>
								                        <td> 
								                           <?php 
																echo $this->CustomTime->formaTime($absence['Absence']['total_time'],':');
								                            ?> 
								                        </td>
								                        </td>
								                        <td> 
								                           <?php echo $absence['Absence']['reason']; ?> 
								                        </td>
								                    </tr>

								                </tbody>
								        <?php 
								            endforeach; 
								        } ?> 
								
								</table>


								<?php  if(!empty($absences)) { ?> 
								<div class="pull-right">
									<?php echo $this->Html->link('View All',array('controller' => 'attendances','action' => 'absences'),array('escape' => false)); ?>
								</div>
								<?php } ?>

							</div>
						</div>
</div>
</div>
</div>
</div>

<script>

	jQuery($(document).ready(function(){


		 //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		if ($('#graph-bar').length) {
			var data1 = [
			    [gd(2015, 1, 1), 838], [gd(2015, 1, 2), 749], [gd(2015, 1, 3), 634], [gd(2015, 1, 4), 1080], [gd(2015, 1, 5), 850], [gd(2015, 1, 6), 465], [gd(2015, 1, 7), 453], [gd(2015, 1, 8), 646], [gd(2015, 1, 9), 738], [gd(2015, 1, 10), 899], [gd(2015, 1, 11), 830], [gd(2015, 1, 12), 789]
			];
			
			var data2 = [
			    [gd(2015, 1, 1), 342], [gd(2015, 1, 2), 721], [gd(2015, 1, 3), 493], [gd(2015, 1, 4), 403], [gd(2015, 1, 5), 657], [gd(2015, 1, 6), 782], [gd(2015, 1, 7), 609], [gd(2015, 1, 8), 543], [gd(2015, 1, 9), 599], [gd(2015, 1, 10), 359], [gd(2015, 1, 11), 783], [gd(2015, 1, 12), 680]
			];
			
			var series = new Array();

			series.push({
				data: data1,
				bars: {
					show : true,
					barWidth: 24 * 60 * 60 * 12000,
					lineWidth: 1,
					fill: 1,
					align: 'center'
				},
				label: 'Revenues'
			});
			series.push({
				data: data2,
				color: '#e84e40',
				lines: {
					show : true,
					lineWidth: 3,
				},
				points: { 
					fillColor: "#e84e40", 
					fillColor: '#ffffff', 
					pointWidth: 1,
					show: true 
				},
				label: 'Orders'
			});

			$.plot("#graph-bar", series, {
				colors: ['#03a9f4', '#f1c40f', '#2ecc71', '#3498db', '#9b59b6', '#95a5a6'],
				grid: {
					tickColor: "#f2f2f2",
					borderWidth: 0,
					hoverable: true,
					clickable: true
				},
				legend: {
					noColumns: 1,
					labelBoxBorderColor: "#000000",
					position: "ne"       
				},
				shadowSize: 0,
				xaxis: {
					mode: "time",
					tickSize: [1, "month"],
					tickLength: 0,
					// axisLabel: "Date",
					axisLabelUseCanvas: true,
					axisLabelFontSizePixels: 12,
					axisLabelFontFamily: 'Open Sans, sans-serif',
					axisLabelPadding: 10
				}
			});

			var previousPoint = null;
			$("#graph-bar").bind("plothover", function (event, pos, item) {
				if (item) {
					if (previousPoint != item.dataIndex) {

						previousPoint = item.dataIndex;

						$("#flot-tooltip").remove();
						var x = item.datapoint[0],
						y = item.datapoint[1];

						showTooltip(item.pageX, item.pageY, item.series.label, y );
					}
				}
				else {
					$("#flot-tooltip").remove();
					previousPoint = [0,0,0];
				}
			});

			function showTooltip(x, y, label, data) {
				$('<div id="flot-tooltip">' + '<b>' + label + ': </b><i>' + data + '</i>' + '</div>').css({
					top: y + 5,
					left: x + 20
				}).appendTo("body").fadeIn(200);
			}


		var datetime = null,
		date = null;

		var update = function () {
		date = moment(new Date())
		datetime.text(date.format('MMMM-D-YYYY, HH:mm:ss'));
		};

		var updateTime = function(thisElement){

		datetime = $('.clock');
		update();
		setInterval(update, 1000);
		}

		updateTime();

		}

	}));
</script>