<?php $this->Html->addCrumb('Request List', array('controller' => 'cause_memos', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'cause_memos', 'action' => 'view')); ?>

<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>

<div class="filter-block pull-right">
                    
    <?php 
        
        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'cause_memos', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));

        if($causeMemoData['CauseMemo']['status_id'] ==  9 || $causeMemoData['CauseMemo']['status_id'] == 5){

            echo $this->Html->link('<i class="fa fa fa-pencil-square-o fa-lg"></i> Approve Request', array('controller' => 'cause_memos', 'action' => 'approve_request', $requestId),array('class' =>'btn btn-primary pull-right','escape' => false));



        }else{

            if($causeMemoData['CauseMemo']['status_id'] ==  1){

                echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print', array('controller' => 'cause_memos', 'action' => 'print_cause_memo', $requestId),array('class' =>'btn btn-primary pull-right','escape' => false));

            }

            if($causeMemoData['CauseMemo']['status_id'] !=  10){

            echo $this->Html->link('<i class="fa fa fa-pencil-square-o fa-lg"></i> Close', array('controller' => 'cause_memos', 'action' => 'close_request', $requestId),array('class' =>'btn btn-primary pull-right','escape' => false));

             }
        } 

         if($causeMemoData['CauseMemo']['status_id'] !=  10){

            if($causeMemoData['CauseMemo']['status_id'] != 5 ){
                 echo $this->Html->link('<i class="fa fa fa-pencil-square-o fa-lg"></i> Terminate', array('controller' => 'cause_memos', 'action' => 'terminate_request', $requestId),array('class' =>'btn btn-primary pull-right','escape' => false));
         }
        }?>
    <br><br>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            <center>
                <h1 align ="center" style = "margin-bottom:0px; font-size: 40px;">KOUFU</h1>
                <label align ="center" style = "margin-top:0px; padding-top:0px; font-size: 10px;">PACKAGING CORPORATION</label>
                <br>
                <h2 style = "margin-top:10px; font-style: Cooper; font-size: 20px;">SHOW CAUSE MEMO</h2>
                <br>
                
            </center>

            <div class="main-box-body clearfix">
            
            
                <div class="table-responsive">
                    <table class="table table-bordered" style= "margin-bottom : 0px;">
                              
                        <tr>
                            <td style = ""width = '100px'><b>To:</b></td>
                            <td style = "" class="text-center" ><?php echo $employeeName[$causeMemoData['CauseMemo']['employee_id']]?></td>
                            <td style = ""width = '100px' class="text-center"><b>Issue Date:</b></td>
                            <td style = ""class="text-center"><?php echo (new \DateTime())->format('m/d/Y') ?></td>
                        </tr>

                        <tr>
                            <td style = "" width = '100px'><b>Section:</b></td>
                            <td style = "" class="text-center" ><?php echo $department[$employeeData['Employee']['department_id']]?> Department</td>
                            <td style = "" width = '100px' class="text-center"><b>Position:</b></td>
                            <td style = "" class="text-center"><?php echo (new \DateTime())->format('m/d/Y') ?></td>
                        </tr>
                        
                    </table>

                    <table class="table table-bordered " style = " border:1px solid black; margin-top : 0px; margin-bottom : 1px;">
                        <td align ="left" style = "height:200px; width: 50%;  font-size : 12px; vertical-align: top;">Description of the Violation: <br><br> &nbsp <?php echo $causeMemoData['CauseMemo']['description']  ?></td>

                    </table>

                    <div class="table-responsive">
                    <table class="table table-bordered" style = "margin-top : 0px; margin-bottom : 0px;">
                              
                        <tr>
                            <td style = " font-size : 14px"width = '150px' ><label><b>Reference Company Policy:</b></label></td>
                            <td style = " "class="text-center" ><?php echo $violationData[$causeMemoData['CauseMemo']['violation_id']]?></td>
                            <td style = " "width = '150px' class="text-center"><b>Associated DA if found guilty</b</td>
                            <td style = " "class="text-center"><?php echo  $disciplinaryData[$causeMemoData['CauseMemo']['disciplinary_action_id']] ?></td>
                        </tr>

                    </table>

                    <table class="table table-bordered" style= "margin-bottom : 0px;">
 
                        <tr>
                            <td align ="left" style = "width: 50%;  font-size : 12px;"><p><b>Prepared by:</b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo ucfirst($userData['User']['first_name']) . " " . ucfirst($userData['User']['last_name']) . "/" .$positionData[$userData['User']['role_id']] . "/" ?><br></p> <p style = "padding:0px; " align = "center">Name/Position/Signature</p></td>
                            <td align ="left" style = "width: 50%;  font-size : 12px;"><p><b>Noted by:</b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo ucfirst($employeeName[$causeMemoData['CauseMemo']['created_by']])  ?><br></p> <p style = "padding:0px; " align = "center">HR Officer</p></td>
                            
                        </tr>
                        
                    </table>

                    <table class="table table-bordered" style= "margin-bottom : 0px;">
 
                        <tr>
                            <td align ="left" style = "width: 50%;  font-size : 12px;"><p>&nbsp You are hereby to show cause in writing <b> within 48 hour </b> from receipt of this memo, why Disciplinary Action (DA) should not be taken against you. Failure to submit  an explanation within the prescribed time shall mean a waiver of your right to be heard, and so, the management shall make a decision without further reference to you. <p></td>

                        </tr>
                        
                    </table>

                    <table class="table table-bordered" style= "margin-bottom : 0px;">
 
                        <tr>
                            <td align ="left" style = "width: 50%;  font-size : 12px;"><p><b>Received by:</td>
                            <td align ="left" style = "  font-size : 12px;"><p><b>Date/ Time:</b></td>
                            
                        </tr>
                        
                    </table>

                     <table class="table table-bordered" style= "margin-bottom : 0px;">
 
                        <tr height = '200px'>
                             <td align ="left" style = "width: 50%;  font-size : 12px; vertical-align: top;"><b>EXPLANATION:</b>(use the back portion if needed) </td>
                            
                         

                        </tr>
                        
                    </table>

                    <table class="table table-bordered" style= "margin-bottom : 0px;">
 
                        <tr>
                            <td align ="left" style = "width: 50%;  font-size : 12px;"><p><b>Submitted by:</td>
                            <td align ="left" style = "  font-size : 12px;"><p><b>Date/ Time:</b></td>
                            
                        </tr>
                        
                    </table>

                    <table class="table table-bordered" style= "margin-bottom : 0px;">
 
                        <tr>
                            <td align ="left" style = "width: 50%;  font-size : 12px;"><p><b>Explanation Received by:</td>
                            <td align ="left" style = "  font-size : 12px;"><p><b>Date/ Time:</b></td>
                            
                        </tr>
                        
                    </table>

                    <table class="table table-bordered" style= "margin-bottom : 0px;">
 
                        <tr>
                            <td align ="center" style = "width: 50%;  font-size : 12px;"><p><b>RECOMMENDATION AND DECISION</b></td>
   
                        </tr>
                        
                    </table>

                    <table class="table table-bordered" style= "margin-bottom : 0px;">
 
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

                   <table class="table table-bordered" style= "margin-bottom : 0px;">
 
                        <tr>
                            <td align ="left" style = "width: 50%;  font-size : 12px;"><p><b>Recommended by: HR Officer</td>
                            <td align ="right" style = "  font-size : 12px;"><p><b>Approved by: Operations Manager</b></td>
                            
                        </tr>
                        
                    </table>

                    <table class="table table-bordered" style= "margin-bottom : 0px;">
 
                        <tr>
                            <td align ="left" style = "width: 50%;  font-size : 12px;">Doc No.: KP-FR-HR1-013 REV 0<br>Effective 01 June 2015
                            
 
                        </tr>
                    
                    </table>
                  
                </div>
            </div>
        </div>
    </div>
</div>
