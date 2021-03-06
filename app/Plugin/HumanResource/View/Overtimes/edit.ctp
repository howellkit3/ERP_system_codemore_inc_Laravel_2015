<?php $this->Html->addCrumb('Overtime', array('controller' => 'overtimes', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Request OT', array('controller' => 'overtimes', 'action' => 'add')); ?>
<?php 
echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'datetimepicker/jquery.datetimepicker',
                    'HumanResource.../js/jquery-impromptu/jquery-impromptu.css',
                    'sweet-alert'
)); 

echo $this->Html->script(array(
                    'jquery.maskedinput.min',
                    'datetimepicker/jquery.datetimepicker',
                    'HumanResource.select2.min',
                    'HumanResource.custom',
                    'HumanResource.jquery-impromptu/jquery-impromptu.js',
                    'sweet-alert.min',   
                    'HumanResource.overtime'

)); 
?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('Overtime',array('url'=>(array('controller' => 'overtimes','action' => 'edit')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data','id' => 'ovetimeForm'));?>
 <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                            Overtime
                            </h1>
                        </center>


                        <div class="filter-block pull-right">

                         <?php 

                        echo $this->Html->script('Approved',array('controler' => 'overtimes' )); 

                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back', array('controller' => 'overtimes', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        
                        echo $this->Html->link('<i class="fa fa-print fa-lg"></i> PRINT', array(
                          'controller' => 'overtimes', 'action' => 'print_request',$this->request->data['Overtime']['id']),array(
                            'class' =>'btn btn-primary pull-right',
                            'escape' => false,
                            'id' => 'printRequest'
                          ));
                        
                        
                        // echo $this->Html->link('<i class="fa fa-times fa-lg"></i> Rejected ', array('controller' => 'overtimes', 'action' => 'process',$this->request->data['Overtime']['id'],'reject'),
                        //     array('class' =>' table-link btn btn-primary pull-right overtime-process',
                        //     'escape' => false,
                        //     'data-process' => 'reject',  
                        //     'title'=>'Edit Information',
                        //     ));

                    if (in_array($userData['User']['role_id'],array('19','12'))) {

                        echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i> Approved ', array('controller' => 'overtimes',
                            'action' => 'process',
                            $this->request->data['Overtime']['id'],'approved'),
                            array('class' =>' table-link btn btn-primary pull-right overtime-process',
                                  'data-process' => 'approved',   
                                  'escape' => false));

                      }
                                            
                        ?>
                        </div>

                    </header>

                </div>
            </div>
            
        <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <br/>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                               <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <!-- <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>  <b> Department </b> </label>
                                                       -->  <div class="col-lg-9">
                                                            <?php 
                                                            echo $this->Form->input('Overtime.id');

                                                            // echo $this->Form->input('Overtime.department_id', array(
                                                            //     'class' => 'col-lg-6 required autocomplete',
                                                            //     'options' => $departments,
                                                            //     'empty' => '--- Select Department ---',
                                                            //     'onchange' => 'checkDepartmentEmployee(this)',
                                                            //     'label' => false,
                                                            //     'disabled' => true));

                                                            // echo $this->Form->input('Overtime.department_id', array(
                                                            //     'class' => 'col-lg-6 required autocomplete',
                                                            //     'options' => $departments,
                                                            //     'empty' => '--- Select Department ---',
                                                            //     'onchange' => 'checkDepartmentEmployee(this)',
                                                            //     'label' => false));
                                                            ?>

                                                        </div>
                                                     </div>
                                                </div>
                                            </div> 


                                              <div class="form-group">
                                                  <div class="col-lg-2 text-right">
                                                    <label for="exampleRadio"> <span style="color:red">*</span>  <b>Search Employee</b> </label>
                                                  </div>
                                                <div class="col-lg-9">
                                                      
                                                            <div class="input-group">
                                                            <span class="input-group-addon">
                                                                    <i class="fa fa-search"></i>
                                                            </span>
                                                            <input type="text" id="SearchEmployee" class="form-control">
                                                    </div>
                                                    </div>
                                                </div>  

                                                       <div class="clearfix"></div>
                                         <div class="form-group">
                                               <label for="inputEmail1" class="col-lg-2 control-label"></label>
                                                  <div class="col-lg-9"  id="selection" >
                                                   
                                                    <ul style="margin:0;padding:0" id="result-tale-employee">
                                                 
                                                      </ul>  
                                                </div>

                                                </div>

                                                  <div class="clearfix"></div>

                                             <div class="form-group">
                                               <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>  <b>Date </b> </label>
                                                        <div class="col-lg-9">

                                                               <?php echo $this->Form->input('Overtime.date', array(
                                                                            'class' => 'form-control col-lg-6 required datepick',
                                                                            'type' => 'text',
                                                                            'label' => false,
                                                                            'readonly' => true
                                                                            ));
                                                                 ?>

                                                        </div>
                                                     </div>
                                                     <div class="form-group">
                                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>  <b>From </b> </label>
                                                        <div class="col-lg-9">

                                                             <div class="col-lg-5 input-append bootstrap-timepicker">
                                                                <?php
                                                                        echo $this->Form->input('Overtime.from', array(
                                                                            'class' => 'form-control col-lg-6 required datetimepick',
                                                                            'type' => 'text',
                                                                            'label' => false
                                                                            ));
                                                                 ?>

                                                             </div>
                                                                <div class="col-lg-2 text-center date-range-to">  <b> To </b> </div>
                                                              <div class="col-lg-5 input-append bootstrap-timepicker">
                                                                <?php
                                                                    echo $this->Form->input('Overtime.to', array(
                                                                        'class' => 'form-control col-lg-6 required datetimepick',
                                                                        'type' => 'text',    
                                                                        'label' => false
                                                                        ));
                                                                ?>
                                                             </div>
                                                          
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>

                                             <div class="form-group">
                                               <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>  <b>Day Type </b></label>
                                                        <div class="col-lg-9">
                                                           <?php
                                                                        echo $this->Form->input('Overtime.day_type_id', array(
                                                                            'class' => 'form-control col-lg-6 required disabled',
                                                                            'options' => array(
                                                                                '1' => 'Working Day',
                                                                                '2' => 'Rest Day', 
                                                                                '3' => 'RegularHoliday',
                                                                                '4' => 'SpecialDay'
                                                                                ),
                                                                            'id' => 'AbsenceTotalTime',
                                                                            'label' => false));
                                                            ?>
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>

                                             <div class="form-group">
                                               <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>  <b>Remarks </b> </label>
                                                        <div class="col-lg-9">
                                                           <?php
                                                                        echo $this->Form->input('Overtime.remarks', array(
                                                                            'class' => 'form-control col-lg-6 required disabled',
                                                                            'placeholder' => 'Notes',
                                                                            'label' => false));
                                                                 ?>


                                                        </div>
                                                     </div>
                                                </div>
                                            </div>


                                        </div>
                                         <div class="col-lg-6">
                                                  <?php 

                                                  if (!empty($this->request->data['OvertimeDetail'])) {

                                                      $overtimeDeatils = array();

                                                      foreach ($this->request->data['OvertimeDetail'] as $key => $overtime ) {
                                                      
                                                         $overtimeDetails['OvertimeDetail'][$overtime['employee_id']] = $overtime; 
          
                                                      }
                                                    }

                                                  ?>
                                                  <div class="form-group">
                                                    <div class="col-lg-12 main-box-body">
                                                        <label class="large-label"><span style="color:red;">*</span> <b>Employees </b> </label>
                                                        <label class="selected-text"></label>
                                                        <div class="clearfix"></div>
                                                        <div class="main-box feed"  >
                                                          <ul id="resultList">
                                                          <?php $keys = 0; foreach ($employees as $KeyId => $value) { 
                                                             $in  = !empty($value['Employee']['in']) ? $value['Employee']['in'] : '';
                                                             $out = !empty($value['Employee']['out']) ? $value['Employee']['out'] : '';
                                                          ?>
                                                          <li class="clearfix parent-li">

                                                          <input type="hidden" name="data[Employee][id][<?php echo $KeyId ?>]" class="select_employee" value="<?php echo $value['Employee']['id']; ?>" id="checkbox-<?php echo $KeyId; ?>">

                                                          <input type="hidden" name="data[Attendance][id][<?php echo $KeyId ?>]" class="select_employee" value="<?php echo $in; ?>" id="checkbox-<?php echo $KeyId; ?>">

                                                          <div class="img">

                                                          <?php  $style = '';
                                                          $serverPath = $this->Html->url('/',true);  

                                                          if (!empty($value['Employee']['image'])) {
                                                            $background =  $serverPath.'img/uploads/employee/'.$value['Employee']['image'].'?d='.rand(0,1000).time();    
                                                          } else {
                                                            $background =  $serverPath.'img/default-profile.png';   
                                                          }

                                                          ?>

                                                          <img alt="" src="<?php echo $background?>">
                                                          </div>
                                                          <div class="title">
                                                          <a href="#">

                                                          <?php 
                                                          $name = $value['Employee']['first_name'];

                                                          $name .= !empty($value['Employee']['middle_name']) ? ' '.$value['Employee']['middle_name'][0] : '';
                                                          $name .= !empty($value['Employee']['last_name']) ? ' '.$value['Employee']['last_name'] : '';
                                                          $name .= !empty($value['Employee']['suffix']) ? ' '.$value['Employee']['suffix'] : '';

                                                          echo ucwords($name); ?> 
                                                          </a>
                                                          </div>
                                                          <div class="post-time">
                                                          <span class="time-in"> <?php echo !empty( $value['Attendance']['in']) ? 'Time in ( '.date('h:i a',strtotime($value['Attendance']['in'])).' )' : ''; ?>  </span>
                                                          </div>
                                                          <div class="time-ago">
                                                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                          </div>

                                                           <div class="clearfix"></div>
                                                          <div class="reason col-lg-6">

                                                              <label class=""> <span style="color:red">*</span> Reason </label>
                                                              <?php 

                                                                $reason = !empty($overtimeDetails['OvertimeDetail'][$value['Employee']['id']]) ? $overtimeDetails['OvertimeDetail'][$value['Employee']['id']]['reason'] : '';

                                                                $overtimeDetailId =  !empty($overtimeDetails['OvertimeDetail'][$value['Employee']['id']]) ? $overtimeDetails['OvertimeDetail'][$value['Employee']['id']]['id'] : '';

                                                              ?>
                                                             <input type="text" name="data[OvertimeDetail][<?php echo $KeyId ?>][reason]" class="form-control employee_reason" value="<?php echo  $reason ; ?>" id="checkbox">  
                                                             
                                                             <input type="hidden"  name="data[OvertimeDetail][<?php echo $KeyId ?>][employee_id]" class="form-control employee_id" value="<?php echo  $value['Employee']['id']; ?>" id="checkbox">

                                                             <input type="hidden" name="data[OvertimeDetail][<?php echo $KeyId ?>][id]" class="form-control overtime_detail_id" value="<?php echo  $overtimeDetailId; ?>" >



                                                          </div>


                                                          </li>

                                                          <?php $keys++; } ?>
                                                          </ul>                                                       
                                                          </div>

                                                        <div class="clearfix"></div>
                                                    </div>
                                            </div>
                                         </div>
                                 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

      </div>
    </div>
      <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
               
                <div class="top-space"></div>
                <div class="main-box-body clearfix">
                    <div class="main-box-body clearfix">
                        <div class="form-horizontal">
                
                            <div class="multi-field clearfix">
                                <div class="col-xs-2 col-md-2"></div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Form->submit('Submit', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                    ?>
                                  
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                   <button type="reset" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->Form->end(); ?>
<script>
         $(document).ready(function(){

                $('.datetimepick').datetimepicker({
                    format:'Y-m-d H:i',
                });

                $('body').on('change','#OvertimeDate',function(){
                    
                    var selectedDate = $.datepicker.formatDate('yy/mm/dd', new Date($(this).val()));
                    
                    $("#OvertimeFrom,#OvertimeTo").datetimepicker( {
                        format:'Y-m-d H:i',
                        minDate: selectedDate
                    });
                });

               // $('#OvertimeDepartmentId').change();
                // quick routine for scrolling nav
              

        });
 </script>