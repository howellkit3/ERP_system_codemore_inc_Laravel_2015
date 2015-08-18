<?php $this->Html->addCrumb('Settings', array('controller' => 'settings', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Leave Type', array('controller' => 'settings', 'action' => 'leave_types','tab'=>'leave_types')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'leave_types', 'action' => 'view',$leaveTypeData['LeaveType']['id'])); ?>
<?php echo $this->Html->css('HumanResource.default');?>
<?php echo $this->Html->script(array(
                        'jquery.maskedinput.min',
                        'HumanResource.custom',
                        'HumanResource.sweet-alert.js'
)); ?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>

<div class="row">
    <div class="col-lg-12">
    
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                    
                    <center>
                        <h1 class="pull-left">
                            Leave Type Information
                        </h1>
                    </center>
                    <div class="filter-block pull-right">
                      <?php 

                          echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'leave_types','tab'=>'leave_types'),array('class' =>'btn btn-primary pull-right','escape' => false));
                         
                      ?>
                    </div>
                </header>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box">
                    <h1> &nbsp </h1>
                    <!-- <div class="top-space"></div> -->
                    <div class="main-box-body clearfix">
                        <div class="main-box-body clearfix">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-lg-6">

                                      <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label strong">Name</label>
                                        <div class="col-lg-8 value"> 
                                          <?php echo $leaveTypeData['LeaveType']['name'];   ?>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label strong">Limit Hours</label>
                                        <div class="col-lg-8 value"> 
                                          <?php echo number_format($leaveTypeData['LeaveType']['limit'],2);   ?> Hours/s
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