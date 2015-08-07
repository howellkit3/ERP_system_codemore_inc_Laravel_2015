<header class="main-box-header clearfix">
	<h2>Working Days</h2>
</header>

<ul class="list-group">
<?php if(empty($attendance)) : ?>

	<li class="list-group-item">
		No working days recorded
	</li>

<?php endif; ?>	
<?php 

$times = [];

foreach($attendance as $list) : ?>
	<li class="list-group-item">
		<span class="badge"><?php echo date('Y-m-d',strtotime($list['Attendance']['date'])) ?></span>

		<?php

		$timeIn = (!empty($list['Attendance']['in']) && $list['Attendance']['in']  != '00:00:00') ? date('h:i a',strtotime($list['Attendance']['in'])) : '';
		$timeOut = (!empty($list['Attendance']['out']) && $list['Attendance']['out']  != '00:00:00') ? date('h:i a',strtotime($list['Attendance']['out'])) : '';
		
		echo $this->CustomTime->getDuration($timeIn,$timeOut); 
		$times[] = $this->CustomTime->getDurationTime($timeIn,$timeOut); 
		?> 
	</li>
		
	<?php endforeach; ?>
</ul>
<?php
	$total = '00:00:00';

	if (!empty($times)) :

		$total = $this->CustomTime->AddTime($times); 
	endif;	
?>
<input id="append-total-hours" class="temp-value" type="hidden" value="<?php echo $total; ?>" ?>