<?php $this->Html->addCrumb('Tooling', array('controller' => 'toolings', 'action' => 'view')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'toolings', 'action' => 'view',$toolingData['Tooling']['id'])); ?>
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
                            Tooling Information
                        </h1>
                    </center>
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'employees', 'action' => 'index','tab' => 'tab-tooling'),array('class' =>'btn btn-primary pull-right','escape' => false));
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
                                            <label for="inputEmail1" class="col-lg-3 control-label strong">Employee Name</label>
                                              <div class="col-lg-8 value"> 
                                               <?php echo ucfirst($toolingData['Employee']['first_name']);  ?>
                                               <?php echo ucfirst($toolingData['Employee']['middle_name']);  ?>
                                               <?php echo ucfirst($toolingData['Employee']['last_name']);  ?>
                                               <?php echo ucfirst($toolingData['Employee']['suffix']);  ?>
                                               </div>
                                         </div>
                                         <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-3 control-label strong">Tool</label>
                                              <div class="col-lg-8 value"> 
                                               <?php echo ucfirst($toolingData['Tool']['name']);  ?>
                                               </div>
                                         </div>
                                         <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-3 control-label strong">Quantity</label>
                                              <div class="col-lg-8 value"> 
                                               <?php echo ucfirst($toolingData['Tooling']['quantity']);  ?>
                                               </div>
                                         </div>
                                         <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-3 control-label strong">Price</label>
                                              <div class="col-lg-8 value"> 
                                               <?php echo ucfirst($toolingData['Tooling']['price']);  ?>
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