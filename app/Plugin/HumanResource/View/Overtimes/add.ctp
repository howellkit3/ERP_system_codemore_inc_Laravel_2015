<?php $this->Html->addCrumb('Overtime', array('controller' => 'overtimes', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Request OT', array('controller' => 'overtimes', 'action' => 'add')); ?>
<?php 
echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'datetimepicker/jquery.datetimepicker'
)); 

echo $this->Html->script(array(
                    'jquery.maskedinput.min',
                    'datetimepicker/jquery.datetimepicker',
                    'HumanResource.select2.min',
                    'HumanResource.custom',
                    'HumanResource.overtime'

)); 
?>
<div style="clear:both"></div>
<?php 
if (!empty($this->params['named']['in_charge']) && $this->params['named']['in_charge'] == 1) {

echo $this->element('in_charge_option'); 

$incharge = true;
} else {
$incharge = false;
echo $this->element('hr_options'); 
}
?><br><br>
<?php echo $this->Form->create('Overtime',array('url'=>(array('controller' => 'overtimes','action' => 'add')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>
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
                        <?php  echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'overtimes', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
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
                                              <!--  <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>  <b> Department </b> </label>
                                                        <div class="col-lg-9">
                                                          
                                                            <?php echo $this->Form->input('Overtime.department_id', array(
                                                                'class' => 'col-lg-6 required autocomplete',
                                                                'options' => $departments,
                                                                'empty' => false,
                                                                'onchange' => 'checkDepartmentEmployee(this)',
                                                                'label' => false));
                                                            ?>

                                                        </div>
                                                     </div>
                                                </div> -->




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

                                               <label for="inputEmail1" class="col-lg-2 control-label"></label>
                                                  <div class="col-lg-9"  id="selection" >
                                                   
                                                    <ul style="margin:0;padding:0" id="result-tale-employee">
                                                 
                                                      </ul>  
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
                                                                            'value' => date('Y-m-d'),
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
                                                        <label class="large-label"> <b>Breaktime </b> </label>
                                                        <div class="clearfix"></div>
                                                        <div class="selected_breaks" >
                                                            <ul>
                                                                <?php foreach ($breaktimes as $key => $time) { ?>
                                                                    <li>
                                                                   
                                                                  <!--   <div class="checkbox-nice">
                                                                    <input type="radio"  id="checkbox-<?php echo $time['BreakTime']['id']?>" name="data[Workshift][breakids][]" value="<?php echo $time['BreakTime']['id']?>">
                                                                    <label for="checkbox-<?php echo $time['BreakTime']['id']?>">
                                                                    <?php echo date('H:i: a',strtotime($time['BreakTime']['from'])); ?>~<?php echo date('H:i: a',strtotime($time['BreakTime']['to'])); ?>
                                                                    </label>
                                                                    </div> -->


                                                                    <div class="radio">
                                                                    <input type="radio"  id="checkbox-<?php echo $time['BreakTime']['id']?>" value="<?php echo $time['BreakTime']['id']?>" name="data[breakids][]">
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
                                                        <label class="large-label"><span style="color:red;">*</span> <b>Employees </b> </label>
                                                        <label class="selected-text"></label>

<!-- 
                                                        <div class="pull-right">
                                                        <label class="large-label"><b>Select ALL </b> </label>
                                                                 <div class="onoffswitch onoffswitch-success select-all">
                                                                            <input type="checkbox" value="all"  id="myonoffswitch-all" class="onoffswitch-checkbox" name="all-employee">
                                                                            <label for="myonoffswitch-all" class="onoffswitch-label">
                                                                            <div class="onoffswitch-inner"></div>
                                                                            <div class="onoffswitch-switch"></div>
                                                                            </label>
                                                                    </div>
                                                        </div> -->

                                                        <div class="clearfix"></div>
                                                           <div class="main-box feed"  >
                                                                <ul id="resultList">
                                                                </ul>

<!--        
                                                            <table class="table table-border">

                                                                
                                                            </table> -->

                                                        </div>

                                                        <div class="clearfix"></div>
                                                        <div class="employees result">
                                                           <!--  <ul class="widget-users row">
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
                                                                    </div>
                                                                <div class="time">
                                                               
                                                                <?php if($employee['Employee']['position_id']) : ?>
                                                                    <i class="fa fa-check-circle"></i> Position: <span style="color:#000;">
                                                                    <b><?php echo $employee['Employee']['position_id']; ?></b></span>
                                                                <?php endif; ?> 
                                                                 
                                                                 
                                                                </div>
                                                                
                                                                <div class="pull-left">
                                                                    <div class="onoffswitch onoffswitch-success">
                                                                            <input type="checkbox" value="<?php echo $employee['Employee']['id']; ?>"  id="myonoffswitch-<?php echo $employee['Employee']['id']; ?>" class="onoffswitch-checkbox" name="data[Employee][id][]">
                                                                            <label for="myonoffswitch-<?php echo $employee['Employee']['id']; ?>" class="onoffswitch-label">
                                                                            <div class="onoffswitch-inner"></div>
                                                                            <div class="onoffswitch-switch"></div>
                                                                            </label>
                                                                    </div>
                                                                </div>

                                                                </div>
                                                                </li>
                                                            <?php endforeach; ?>    
                                                            </ul> -->
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
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'schedules', 'action' => 'holiday','plugin' => 'human_resorce'),array('class' =>'btn btn-default','escape' => false));
                                    ?>
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
                    
                    $("#OvertimeFrom,#OvertimeTo").val($(this).val()+ ' 00:00');

                    var selectedDate = $.datepicker.formatDate('yy/mm/dd', new Date($(this).val()));
                    
                    $("#OvertimeFrom,#OvertimeTo").datetimepicker( {
                        format:'Y-m-d H:i',
                        current : $(this).val()+ ' 00:00',
                       // current: '2015-11-20 00:00'
                    });
                });


                $('#OvertimeDepartmentId').change();

        });
 </script>