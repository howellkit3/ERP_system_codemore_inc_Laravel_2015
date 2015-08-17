<?php $this->Html->addCrumb('Attendance', array('controller' => 'attendances', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Leaves', array('controller' => 'attendances', 'action' => 'leaves','tab'=>'leaves')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'leaves', 'action' => 'view',$leaveData['Leave']['id'])); ?>
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
                            Employee Leave Information
                        </h1>
                    </center>
                    <div class="filter-block pull-right">
                      <?php 

                          echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'attendances', 'action' => 'leaves','tab'=>'leaves'),array('class' =>'btn btn-primary pull-right','escape' => false));

                          echo "&nbsp;";

                          echo "<button class='btn btn-primary pull-right approvedLeave'  data='".$leaveData['Leave']['id']."'><i class='fa fa-check-square-o fa-lg'></i>Approved</button>";

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
                                        <label for="inputEmail1" class="col-lg-3 control-label strong">Code</label>
                                        <div class="col-lg-8 value"> 
                                          <?php echo $leaveData['Employee']['code'];   ?>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label strong">Employee Name</label>
                                        <div class="col-lg-8 value"> 
                                          <?php echo $this->CustomText->getFullname($leaveData['Employee']);  ?>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label strong">Type</label>
                                        <div class="col-lg-8 value"> 
                                          <?php echo $leaveData['Type']['name'];   ?>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label strong">From</label>
                                        <div class="col-lg-8 value"> 
                                          <?php echo $leaveData['Leave']['from'];   ?>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label strong">To</label>
                                        <div class="col-lg-8 value"> 
                                          <?php echo $leaveData['Leave']['to']; ?>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label strong">Status</label>
                                        <div class="col-lg-8 value"> 
                                          <?php 
                                            if ($leaveData['Leave']['status'] == 8) {
                                              echo "<span class='label label-default'>Waiting</span>";
                                            }
                                            if ($leaveData['Leave']['status'] == 1) {
                                              echo "<span class='label label-success'>Approved</span>";
                                            }
                                          ?>
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