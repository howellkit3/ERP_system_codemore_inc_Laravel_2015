<?php $this->Html->addCrumb('Position', array('controller' => 'settings', 'action' => 'position','tab' => 'position')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'positions', 'action' => 'view',$positionData['Position']['id'])); ?>
<?php echo $this->Html->css('HumanResource.default');?>
<?php echo $this->Html->script(array(
                        'jquery.maskedinput.min',
                        'HumanResource.custom'
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
                            Position Information
                        </h1>
                    </center>
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'position','tab'=>'position'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
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
                                               <?php echo ucfirst($positionData['Position']['name']);  ?>
                                               </div>
                                         </div>
                                         <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-3 control-label strong">Description</label>
                                              <div class="col-lg-8 value"> 
                                               <?php echo ucfirst($positionData['Position']['description']);  ?>
                                               </div>
                                         </div>

                                          <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-3 control-label strong">Specification</label>
                                              <div class="col-lg-8 value"> 
                                               <?php echo ucfirst($positionData['Position']['specification']);  ?>
                                               </div>
                                            </div>

                                            <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-3 control-label strong">Notes</label>
                                              <div class="col-lg-8 value"> 
                                               <?php echo !empty($positionData['Position']['notes']) ? ucfirst($positionData['Position']['notes']) : '';  ?>
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