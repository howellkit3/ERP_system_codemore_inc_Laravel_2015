<?php $this->Html->addCrumb('Settings', array('controller' => 'settings', 'action' => 'department')); ?>
<?php $this->Html->addCrumb('Agency', array('controller' => 'settings', 'action' => 'agency','tab' => 'agency')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'agencies', 'action' => 'view',$agencyData['Agency']['id'])); ?>
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
                            Agency Information
                        </h1>
                    </center>
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'agency','tab' => 'agency'),array('class' =>'btn btn-primary pull-right','escape' => false));
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
                                               <?php echo ucfirst($agencyData['Agency']['name']);  ?>
                                               </div>
                                         </div>

                                          <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-3 control-label strong">Field</label>
                                              <div class="col-lg-8 value"> 
                                               <?php echo ucfirst($agencyData['Agency']['field']);  ?>
                                               </div>
                                          </div>

                                          <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-3 control-label strong">Description</label>
                                              <div class="col-lg-8 value"> 
                                               <?php echo ucfirst($agencyData['Agency']['description']);  ?>
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