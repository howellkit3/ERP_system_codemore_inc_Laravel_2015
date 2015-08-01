<?php $this->Html->addCrumb('Settings', array('controller' => 'settings', 'action' => 'depatment')); ?>
<?php $this->Html->addCrumb('Status', array('controller' => 'settings', 'action' => 'status','tab'=>'status')); ?>
<?php $this->Html->addCrumb('Edit', array('controller' => 'statuses', 'action' => 'edit',$this->request->data['Status']['id'])); ?>
<?php echo $this->Html->css('HumanResource.default');?>
<?php echo $this->Html->script(array(
                        'jquery.maskedinput.min',
                        'HumanResource.custom'
)); ?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>
<?php echo $this->Form->create('Status',array('url'=>(array('controller' => 'statuses','action' => 'edit')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data','method' =>'post' ));?>

    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        
                        <center>
                            <h1 class="pull-left">
                                Edit Status Information
                            </h1>
                        </center>
                        <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'status','tab'=>'status'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </header>

                </div>
            </div>

           <?php echo $this->element('status_form'); ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                       <!--  <h1>Personal Info</h1> -->
                        <div class="top-space"></div>
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <div class="form-group">

                                                <label for="inputEmail1" class="col-lg-2 control-label"> </label>
                                                <div class="col-lg-4">
                                                    <?php 
                                                        echo $this->Form->submit('Submit Status Information', array('class' => 'btn btn-success pull-left',  'title' => 'Click here to add the Status'));
                                                        echo "&nbsp;";
                                                        echo $this->Html->link('Cancel ', array('controller' => 'settings', 'action' => 'status','tab'=>'status','plugin' => 'human_resource'),array('class' =>'btn btn-default ','escape' => false));

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

<?php echo $this->Form->end(); ?>
<script>
   jQuery(document).ready(function($){
        $("#StatusEditForm").validate();
            
    });
</script>