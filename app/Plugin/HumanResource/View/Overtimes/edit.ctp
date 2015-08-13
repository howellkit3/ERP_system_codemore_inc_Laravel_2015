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
                        
                        echo $this->Html->link('<i class="fa fa-times fa-lg"></i> Rejected ', array('controller' => 'overtimes', 'action' => 'process',$this->request->data['Overtime']['id'],'reject'),
                            array('class' =>' table-link btn btn-primary pull-right overtime-process',
                            'escape' => false,
                            'data-process' => 'reject',  
                            'title'=>'Edit Information',
                            ));

                        echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i> Approved ', array('controller' => 'overtimes',
                            'action' => 'process',
                            $this->request->data['Overtime']['id'],'approved'),
                            array('class' =>' table-link btn btn-primary pull-right overtime-process',
                                  'data-process' => 'approved',   
                                  'escape' => false));
                                            
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
                                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>  <b> Department </b> </label>
                                                        <div class="col-lg-9">
                                                            <?php 
                                                            echo $this->Form->input('Overtime.id');

                                                            echo $this->Form->input('Overtime.department_id', array(
                                                                'class' => 'col-lg-6 required autocomplete',
                                                                'options' => $departments,
                                                                'empty' => '--- Select Department ---',
                                                                'onchange' => 'checkDepartmentEmployee(this)',
                                                                'label' => false,
                                                                'disabled' => true));

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

                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label class="large-label"><span style="color:red;">*</span> <b>Breaktimes </b> </label>
                                                        <div class="clearfix"></div>
                                                        <div class="selected_breaks" >
                                                            <ul>
                                                                <?php foreach ($breaktimes as $key => $time) { ?>
                                                                    <li>
                                                                   
                                                                <!--     <div class="checkbox-nice">
                                                                    <input type="checkbox" 
                                                                    <?php echo (in_array($time['BreakTime']['id'], $workshiftBreaks)) ? 'checked' : ''; ?>
                                                                    id="checkbox-<?php echo $time['BreakTime']['id']?>" name="data[Workshift][breakids][]" value="<?php echo $time['BreakTime']['id']?>">
                                                                    <label for="checkbox-<?php echo $time['BreakTime']['id']?>">
                                                                    <?php echo date('H:i: a',strtotime($time['BreakTime']['from'])); ?>~<?php echo date('H:i: a',strtotime($time['BreakTime']['to'])); ?>
                                                                    </label>
                                                                    </div>
 -->


                                                                    <div class="radio">
                                                                    <input type="radio" id="checkbox-<?php echo $time['BreakTime']['id']?>" value="<?php echo $time['BreakTime']['id']?>" name="data[Workshift][breakids][]" <?php echo (in_array($time['BreakTime']['id'], $workshiftBreaks)) ? 'checked' : ''; ?>>
                                                                      <label for="checkbox-<?php echo $time['BreakTime']['id']?>">
                                                                    <?php echo date('H:i: a',strtotime($time['BreakTime']['from'])); ?>~<?php echo date('H:i: a',strtotime($time['BreakTime']['to'])); ?>
                                                                    </label>
                                                                    </div>



                                                                            </li>
                                                                <?php } ?>
                                                            </ul>    
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                         <div class="col-lg-6">
                                         

                                             <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label class="large-label"><span style="color:red;">*</span> <b> Employees </b> </label>
                                                        <label class="selected-text"></label>


                                                        <div class="pull-right">
                                                        <label class="large-label"><b>Select ALL </b> </label>
                                                                 <div class="onoffswitch onoffswitch-success select-all">
                                                                            <input type="checkbox" value="all"  id="myonoffswitch-all" class="onoffswitch-checkbox" name="all-employee">
                                                                            <label for="myonoffswitch-all" class="onoffswitch-label">
                                                                            <div class="onoffswitch-inner"></div>
                                                                            <div class="onoffswitch-switch"></div>
                                                                            </label>
                                                                    </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="employees result">
                                                            <ul class="widget-users row">
                                                            <?php foreach ($employees as $key => $employee) : ?>
                                                                <li class="col-md-6">
                                                                    <?php
                                                                        $style = '';

                                                                        if (!empty($employee['Employee']['image'])) {

                                                                        $serverPath = $this->Html->url('/',true);   
                                                                        $background =  $serverPath.'img/uploads/employee/'.$employee['Employee']['image'];  
                                                                          $style = 'background:url('.$background.')';
                                                                    } 

                                                                    ?>
                                                                        <div class="image_profile" style="<?php echo $style; ?>"></div>
                                                                    
                                                                <div class="details">
                                                                    <div class="name">
                                                                       <?php
                                                                        $name =  $this->CustomText->getFullname($employee['Employee'],'first_name',null,'last_name'); 

                                                                         echo $this->Html->link(ucwords($name),array('controller' => 'employees','action' => 'view',$employee['Employee']['id']),array('target' => '_blank'));

                                                                        ?>
                                                                        <input type="hidden" name="data[Idholder][id][]" value="<?php echo $employee['Attendance']['id']?>">
                                                                    </div>
                                                                <div class="time">
                                                                
                                                                <?php if($employee['Employee']['position_id']) : ?>
                                                                    <!-- <i class="fa fa-check-circle"></i> Position: <span style="color:#000;"> -->
                                                                    <b><?php //echo $positionList[$employee['Employee']['position_id']]; ?></b></span>
                                                                <?php endif; ?> 
                                                                    <i class="fa fa-clock-o"></i> Time In : <?php echo $employee['Attendance']['in']?>
                                                                    
                                                                </div>
                                                                
                                                                <div class="pull-left">
                                                                    <div class="onoffswitch onoffswitch-success">
                                                                            <input type="checkbox" <?php echo in_array($employee['Employee']['id'], $selectedEmployee) ? 'checked' : ''?> value="<?php echo $employee['Employee']['id']; ?>-<?php echo $employee['Attendance']['id']?>"  id="myonoffswitch-<?php echo $employee['Employee']['id']; ?>" class="onoffswitch-checkbox" name="data[Employee][id][]">
                                                                            <label for="myonoffswitch-<?php echo $employee['Employee']['id']; ?>" class="onoffswitch-label">
                                                                            <div class="onoffswitch-inner"></div>
                                                                            <div class="onoffswitch-switch"></div>
                                                                            </label>
                                                                    </div>
                                                                </div>

                                                                </div>
                                                                </li>
                                                            <?php endforeach; ?>    
                                                            </ul>
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

                // quick routine for scrolling nav
              

        });
 </script>