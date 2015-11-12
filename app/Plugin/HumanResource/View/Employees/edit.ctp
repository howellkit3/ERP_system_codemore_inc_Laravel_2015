<?php $this->Html->addCrumb('Employee', array('controller' => 'employees', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'employees', 'action' => 'add')); ?>
<?php echo $this->Html->css('HumanResource.default');?>
<?php echo $this->Html->script('HumanResource.custom');
echo $this->Html->css(array(
                    'HumanResource.select2.css',
                    'timepicker'
)); 
 echo $this->Html->script(array(
                    'jquery.maskedinput.min',
                    'HumanResource.select2.min',
                    'HumanResource.employee',
                    'HumanResource.webcam_master/jquery.webcam'

)); 

 $page = !empty($this->params['named']['page']) ? $this->params['named']['page'] : ''; 

?>


<div style="clear:both"></div>


<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('Employee',array('url'=>(array('controller' => 'employees','action' => 'edit','page' => $page)),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>
<?php echo $this->Form->input('Employee.id'); ?>
    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                                Employee Information
                            </h1>
                        </center>

                          <div class="filter-block">
                            <?php 
                            // echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'employees', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                            ?>


                            <a href="javascript:history.back(1)" class="btn btn-primary pull-right"> <i class="fa fa-arrow-circle-left fa-lg"></i> Go Back </a>
                            


                            <div class="form-group pull-right" style="margin-right:10px;">

                            <?php echo $this->Html->link('<i class="fa fa-credit-card"></i>
                            Print ID', array('controller' => 'employees', 'action' => 'print_id',$this->request->data['Employee']['id']),array('class' =>'btn btn-primary pull-right','escape' => false,'target' => '_blank'));
                            ?>

                            </div>

                            <?php if (in_array($userData['User']['role_id'],array('19'))) { ?>
                   
                            <div class="form-group pull-right" style="margin-right:25px;">

                            <?php echo $this->Html->link('<i class="fa fa-money fa-lg"></i> Salary Settings', array('controller' => 'salaries', 'action' => 'employee_settings',$this->request->data['Employee']['id']),array('class' =>'btn btn-primary pull-right','escape' => false));
                            ?>

                          </div>

                          <?php } ?>
                     
                    </div
                    </header>

                </div>
            </div>
           <?php echo $this->element('employee_form'); ?>

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
                                        echo $this->Form->submit('Submit Employee Information', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                    ?>
                                  
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        // echo $this->Html->link('Cancel ', array('controller' => 'employees', 'action' => 'index','plugin' => 'human_resource'),array('class' =>'btn btn-default','escape' => false));
                                    ?>

                                    <a href="javascript:history.back(1)" class="btn btn-default">
                                           Cancel 
                                    </a>
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
        
    jQuery(document).ready(function($){
           //datepicker
            $('.datepick').datepicker({
                format: 'yyyy-mm-dd'
            });
            
    });

     </script>

        <?php echo $this->element('modals/employee_webcam'); ?>