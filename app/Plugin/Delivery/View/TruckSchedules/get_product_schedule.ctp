Truck Schedule
<?php
	if(!empty($message)){
		if($message == "Conflict"){
		echo "<font color='red'>There is a conflict in the time that you chose!</font>";


		}
	}

?>
<table border = 1 style="width: 100%; border: 0; cellspacing: 0; cellpadding: 0;">
	<tr >
		<td align = "center">
			Time
		</td>
		<td align = "center">
			Location
		</td>
	</tr>
	
	<?php
		foreach ($data as $value) { 
	?>
		<tr>
			<td>
				<?php
					echo "<b>".$value['TruckSchedule']['time_from']."</b> to <b>". $value['TruckSchedule']['time_to']."</b>";
				?>
			</td>
			<td>
				<?php
					echo $value['TruckSchedule']['location'];
				?>
			</td>
		</tr>
	<?php
		}
	?>
</table>
