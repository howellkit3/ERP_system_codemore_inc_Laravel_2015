<?php $this->Html->addCrumb('Schedules', array('controller' => 'Schedules', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Workshifts', array('controller' => 'schedules', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'workshifts', 'action' => 'add')); ?>
<?php echo $this->Html->css(array('HumanResource.default','timepicker'));?>
<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom',
                        'HumanResource.workshifts'
)); ?>
<div style="clear:both"></div>
<?php
if (!empty($userData['User']['in_charge']) && $userData['User']['in_charge'] == 1) {

echo $this->element('in_charge_option'); 

$incharge = true;
} else {
$incharge = false;
echo $this->element('hr_options'); 
} 


?><br><br>
<?php echo $this->Form->create('Breaktime',array('url'=>(array('controller' => 'workshifts','action' => 'edit')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>

    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                            Add Workshift
                            </h1>
                        </center>
                        <?php  echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'schedules', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
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
                                <div class="col-lg-6">    
                                    
                                    <div class="form-group">
                                       <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Name</label>
                                                <div class="col-lg-9">
                                                  
                                                    <?php
                                                        echo $this->Form->input('WorkShift.id');
                                                        echo $this->Form->input('WorkShift.name', array('class' => 'form-control col-lg-6 required','label' => false));
                                                    ?>

                                                </div>
                                             </div>
                                        </div>
                                    </div>


                                     <div class="form-group">
                                       <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Duration</label>
                                                <div class="col-lg-2">
                                                   <?php
                                                                echo $this->Form->input('WorkShift.duration', array(
                                                                    'class' => 'form-control col-lg-6 required number',
                                                                    'type' => 'number',
                                                                    'value' => 9,
                                                                    'label' => false));
                                                         ?>


                                                </div>
                                             </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                       
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Time </label>
                                                <div class="col-lg-9">

                                                     <div class="col-lg-5 input-append bootstrap-timepicker">
                                                        <?php
                                                                echo $this->Form->input('WorkShift.from', array(
                                                                    'type' => 'text',    
                                                                    'class' => 'form-control col-lg-6 required timepicker workshift_from',
                                                                    'label' => false,
                                                                    ));
                                                         ?>

                                                     </div>

                                                        <div class="col-lg-2 text-center"> To </div>
                                                      <div class="col-lg-5 input-append bootstrap-timepicker">
                                                        <?php
                                                            echo $this->Form->input('WorkShift.to', array('type' => 'text','class' => 'form-control col-lg-6 required timepicker workshift_to','label' => false));
                                                        ?>
                                                     </div>
                                                  
                                                   

                                                   
                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                       <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label class="large-label"><span style="color:red;">*</span> <b> Breaktime </b> </label>
                                                        <div class="clearfix"></div>
                                                        <div class="selected_breaks" >
                                                            <ul>
                                                                <?php foreach ($breaktimes as $key => $time) {  ?>
                                                                    <li>

                                                                    <div class="radio">
                                                                        <input type="radio"  id="checkbox-<?php echo $time['BreakTime']['id']?>" value="<?php echo $time['BreakTime']['id']?>" name="data[Workshift][breakids][]" <?php echo !empty($time['BreakTime']['id']) && (in_array($time['BreakTime']['id'], $breaks)) ? 'checked' : ''; ?>>
                                                                            <label for="checkbox-<?php echo $time['BreakTime']['id']?>">
                                                                            <?php echo $time['BreakTime']['name'].' ( '.date('H:i: a',strtotime($time['BreakTime']['from'])); ?>~<?php echo date('H:i: a',strtotime($time['BreakTime']['to'])) .' )'; ?>
                                                                            </label>
                                                                        </div>

                                                                    </li>
                                                                <?php } ?>
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
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'schedules', 'action' => 'workshifts','plugin' => 'human_resource'),array('class' =>'btn btn-default','escape' => false));
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

<?php echo $this->element('modals/workshift'); ?>