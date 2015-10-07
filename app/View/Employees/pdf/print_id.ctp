
<style>
<?php include('word.css'); ?>

</style>

<html>
	<head>
		<title> Print Emp Id </title>
	</head>
	<body>
		<table id="first" style="font-family:sans-serif; width:212px;height:363px;">
				<tr>
						<td>	

								<div class="photo" style="position:absolute; margin-top:100px; margin-left:50px;">

									<?php
			                            $serverPath = $this->Html->url('/',true);	

										if (!empty($employee['Employee']['image'])) { 

			                            $background =  $serverPath.'img/uploads/employee/'.$employee['Employee']['image'];	 ?>
			                            
			                           

		                           	 <?php } else {

		                           	 	  $background =  $serverPath.'img/default-profile.png';	
		                           	 	} ?>
		                           	  <img src ="<?php echo  $background; ?>" width="100px" height="100px;">
		                           	 <div class="id_number" style="margin-left:45px; font-size:13px"> <strong> <?php echo !empty($employee['Employee']['code']) ? $employee['Employee']['code'] : ''; ?> </strong> </div>

								</div>
								<br>
								<div class="name" style="margin-left:60px;margin-top:145px; font-size:10px; font-family:sans-serif;"> 
								<?php echo !empty($employee['Employee']['full_name']) ? $employee['Employee']['full_name'] : ''; ?> 
								

								<div style="margin-top:5px"><?php echo !empty($employee['Department']['notes']) ? $employee['Department']['notes'] : '' ?></div> 
									<div style="margin-top:6px"><?php echo !empty($employee['Position']['name']) ? $employee['Position']['name'] : '' ?></div> 
								</div>



						</td>
				</tr>
		</table>

		 <div style="page-break-before: always;"></div> 

		 	<table id="second" style="font-family:sans-serif; width:212px;height:363px;">
				<tr>
						<td>	

								<div class="sss" style="position:absolute; margin-top:27px; margin-left:70px; font-size:13px">

										<?php echo '0000-0000-000';///!empty($employee['SSS']['value']) ? $employee['SSS']['value'] : '' ?>


										<br>
										<?php echo '0000-0000-000';///!empty($employee['SSS']['value']) ? $employee['SSS']['value'] : '' ?>

										<br>
										<?php echo !empty($employee['Employee']['date_hired']) ? date('Y/m/d',strtotime($employee['Employee']['date_hired'])) : ''; ?>
								</div>
								<br>
								

								<div class="sss" style="position:absolute; margin-top:82px; margin-left:70px; font-size:12px">

										<?php echo !empty($employee['ContactPerson']['firstname']) ? ucfirst($employee['ContactPerson']['firstname']).', '. ucfirst($employee['ContactPerson']['middlename'][0]).' '.ucfirst($employee['ContactPerson']['lastname']): '' ?>

										<br>

										<?php echo !empty($employee['ContactPersonAddress']['address_1']) ? $employee['ContactPersonAddress']['address_1'].', ' : '' ?> 
											<?php echo !empty($employee['ContactPersonAddress']['city']) ? $employee['ContactPersonAddress']['city'].', ' : '' ?>
											<?php echo !empty($employee['ContactPersonAddress']['province']) ? $employee['ContactPersonAddress']['province'].' ' : '' ?>

										<?php echo !empty($employee['ContactPerson']['firstname']) ? ucfirst($employee['ContactPerson']['firstname']).', '. ucfirst($employee['ContactPerson']['middlename'][0]).' '.ucfirst($employee['ContactPerson']['lastname']): '' ?>
										

										<div class="contact_number" style="margin-top:27px">
												
										<?php echo !empty($employee['ContactPersonNumber']['number']) ? ucfirst($employee['ContactPersonNumber']['number']) : '' ?>
										</div>	
								</div>


						</td>
				</tr>
		</table>
	</body>
	</html>	

<script type="text/javascript">
	
</script>