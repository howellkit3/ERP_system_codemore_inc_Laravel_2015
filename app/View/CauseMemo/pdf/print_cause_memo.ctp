<!DOCTYPE html>
<style>
<?php include('word.css'); ?>

table {
    border-collapse: collapse;
}
th, td {
    padding: 0; height:20px; width: 90%;  ;
}



</style>

			
<div class="row" style="background:url('http://localhost/koufu_system/img/pr.pngs');background-size: 768px;
  height: 100%;background-repeat:no-repeat;">
	<div class="col-lg-12">
		<div class="main-box main-pdf"  >
			<center>
                <h1 align ="center" style = "margin-bottom:0px; font-size: 40px;">KOUFU</h1>
                <label align ="center" style = "margin-top:0px; padding-top:0px; font-size: 10px;">PACKAGING CORPORATION</label>
                <br>
                <h2 style = "margin-top:10px; font-style: Cooper; font-size: 20px;">SHOW CAUSE MEMO</h2>
                <br>
                
            </center>

			<table class="table table-bordered" style= "margin-bottom : 0px; table-layout: fixed; ">
                              
                <tr>
                    <td  style = " border:1px solid black; width:100px;"><b>To:</b></td>
                    <td  style = " border:1px solid black; width:350px;" class="text-center" ><?php echo $employeeName[$causeMemoData['CauseMemo']['employee_id']]?></td>
                    <td style = " border:1px solid black; width:100px;" class="text-center"><b>Issue Date:</b></td>
                    <td  style = " border:1px solid black; width:200px;" class="text-center"><?php echo (new \DateTime())->format('m/d/Y') ?></td>
                </tr>

                <tr>
                    <td style = " border:1px solid black;" ><b>Section:</b></td>
                    <td style = " border:1px solid black;" class="text-center" ><?php echo $department[$employeeData['Employee']['department_id']]?> Department</td>
                    <td style = " border:1px solid black;"  class="text-center"><b>Position:</b></td>
                    <td style = " border:1px solid black;" class="text-center"><?php echo (new \DateTime())->format('m/d/Y') ?></td>
                </tr>
                        
            </table>

	        <table style = "margin-top : 0px; margin-bottom : 1px;">
	          	<tr>
	           	 <td align ="left" style = "border:1px solid black; height:200px; width: 753px;vertical-align: top;">Description of the Violation: <br>  <?php  echo $causeMemoData['CauseMemo']['description']  ?></td>
	           	</tr>

	        </table>

	        <table  style = "margin-top : 0px; margin-bottom : 1px;">
                              
                <tr>
                    <td  style = " border:1px solid black; width:150px;" ><label><b>Reference Company Policy:</b></label></td>
                    <td  style = " border:1px solid black; width:250px;"  align ="center" ><?php echo $violationData[$causeMemoData['CauseMemo']['violation_id']]?></td>
                    <td style = " border:1px solid black; width:150px;"><b>Associated DA if found guilty</b></td>
                    <td  style = " border:1px solid black; width:200px;"  align ="center"><?php echo  $disciplinaryData[$causeMemoData['CauseMemo']['disciplinary_action_id']] ?></td>
                </tr>

     
            </table>

            <table  style = "margin-top : 0px; margin-bottom : 1px;">
                              
                <tr>
                    <td  align ="left" style = "border:1px solid black; width:375px; height: 50px; vertical-align:top;" ><label><b>Prepared by:</b><br><center><?php echo  ucfirst($userData['User']['first_name']) . " " . ucfirst($userData['User']['last_name']) ?></center><center> Name/Position/Signature<center></label></td>
                    <td  style = " border:1px solid black; width:375px; vertical-align:top; " ><label><b>Noted by:</b><br><center><?php echo ucfirst($employeeName[$causeMemoData['CauseMemo']['created_by']]) ?></center><center> HR Officer <center></label></td>
                   
                </tr>

     
            </table>

            <table style = "margin-top : 0px; margin-bottom : 1px;">
	          	<tr>
	           	 <td align ="left" style = "border:1px solid black;  width: 753px;vertical-align: top;"> You are hereby to show cause in writing <b> within 48 hour </b> from receipt of this memo, why Disciplinary Action (DA) should not be taken against you. Failure to submit  an explanation within the prescribed time shall mean a waiver of your right to be heard, and so, the management shall make a decision without further reference to you.</td>
	           	</tr>

	        </table>

	         <table  style = "margin-top : 0px; margin-bottom : 1px;">
                              
                <tr>
                    <td  align ="left" style = "border:1px solid black; width:375px;  vertical-align:top;" ><label><b>Prepared by:</b></label></td>
                    <td  style = " border:1px solid black; width:375px; vertical-align:top; " ><label><b>Date/Time:</label></td>
                   
                </tr>

     
            </table>

            <table style = "margin-top : 0px; margin-bottom : 1px;">
	          	<tr>
	           	 <td align ="left" style = "border:1px solid black; height:200px; width: 753px;vertical-align: top;"> <b>EXPLANATION: </b> (use the back portion if needed)</td>
	           	</tr>

	        </table>

	        <table  style = "margin-top : 0px; margin-bottom : 1px;">
                              
                <tr>
                    <td  align ="left" style = "border:1px solid black; width:375px;  vertical-align:top;" ><label><b>Submitted by:</b></label></td>
                    <td  style = " border:1px solid black; width:375px; vertical-align:top; " ><label><b>Date/Time:</label></td>
                   
                </tr>

     
            </table>

            <table  style = "margin-top : 0px; margin-bottom : 1px;">
                              
                <tr>
                    <td  align ="left" style = "border:1px solid black; width:375px;  vertical-align:top;" ><label><b>Explanation Received by:</b></label></td>
                    <td  style = " border:1px solid black; width:375px; vertical-align:top; " ><label><b>Date/Time:</label></td>
                   
                </tr>

     
            </table>

            <table  style = "margin-top : 0px; margin-bottom : 1px;">
                              
                <tr>
                    <td  align ="left" style = "border:1px solid black; width:750px;  vertical-align:top;" ><label><b>RECOMMENDATION AND DECISION</b></label></td>
                    
                </tr>

     
            </table>

            <table  style= "margin-bottom : 0px;">
 
                        <tr>
                            <td align ="center" style = "width: 33%;  font-size : 12px;"><input type="checkbox" name="vehicle" value="Bike"> Explanation Accepted</td>
                            <td align ="center" style = "width: 33%;  font-size : 12px;"><input type="checkbox" name="vehicle" value="Bike"> Impose DA Above</td>
                            <td align ="center" style = "width: 34%;  font-size : 12px;"><input type="checkbox" name="vehicle" value="Bike"> Impose another DA below</td>
   
                        </tr>

                        <tr>
                            <td align ="center" style = "width: 33%;  font-size : 12px;"><input type="checkbox" name="vehicle" value="Bike"> Verbal Warning</td>
                            <td align ="center" style = "width: 33%;  font-size : 12px;"><input type="checkbox" name="vehicle" value="Bike"> Suspension ____ days</td>
                            <td align ="center" style = "width: 34%;  font-size : 12px;"><input type="checkbox" name="vehicle" value="Bike"> Termination Effective</td>
   
                        </tr>
                        
                </table>

            <table  style = "margin-top : 0px; margin-bottom : 1px;">
                              
                <tr>
                    <td  align ="left" style = "border:1px solid black; width:375px;  vertical-align:top;" ><label><b>Recommendation by: HR Officer</b></label></td>
                    <td  align ="left" style = "border:1px solid black; width:375px;  vertical-align:top;" ><label><b>Approved by: Operation Manager</b></label></td>
                    
                </tr>

     
            </table>

             <table class="table table-bordered" style= "margin-bottom : 0px;">
 
                        <tr>
                            <td align ="left" style = "width: 50%;  font-size : 12px;">Doc No.: KP-FR-HR1-013 REV 0<br>Effective 01 June 2015
                            
 
                        </tr>
                    
                    </table>

            

			<!-- <table style=" margin-top:0px; border-spacing: 0px;   ">
			
			<tr>
				<td align = "center" style="border:1px solid black;border-collapse: separate; width:60px; vertical-align: text-top;  ">To:</td>
				<td  width= "310px" align = "left" style="border:1px solid black;border-collapse: separate; width:310px; vertical-align: text-top;"></td>
				<td align = "center" style="border:1px solid black;border-collapse: separate; width:60px; vertical-align: text-top;">Issue Date</td>
				<td align = "left" style="border:1px solid black;border-collapse: separate; width:310px; vertical-align: text-top;"><?php echo (new \DateTime())->format('d/m/Y') ?></td>
			</tr>

			<tr>
				<td align = "left" style=" width:30px; padding-right:3px; "></td>
				<td align = "left" >Shou Yi Yu</td>
				<td align = "left" ></td>
				<td align = "left" ></td>
			</tr>
			
			</table> -->

			<!-- <table style="margin-top:0px; border:1px solid black;border-collapse:collapse;">
			
			<tr>
				<td align = "left" style=" width:182px; vertical-align: text-top; ">Purchasing</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Dec. No:</td>
				<td align = "left" style=" width:185px; vertical-align: text-top;">Rev No:</td>
			</tr>
			
			</table> -->

		</div>
	</div>	

</div>	



