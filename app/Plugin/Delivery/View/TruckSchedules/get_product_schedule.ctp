Truck Schedule
<table border = 1 style="width: 100%; border: 0; cellspacing: 0; cellpadding: 0;">
	<tr>
		<th>
			Time
		</th>
		<th>
			Location
		</th>
	</tr>
	
	<?php
		foreach ($data as $value) { 
	?>
		<tr>
			<td>
				<?php
					echo $value['TruckSchedule']['time_from']." to ". $value['TruckSchedule']['time_to'];
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