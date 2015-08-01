<style type="text/css">#QuotationField12Description{background-color:#fff;}</style>
<div style="clear:both"></div>
<?php  echo $this->Html->script('Purchasing.modal_clone');?>
<?php  //echo $this->Html->script('Purchasing.request_section');?>
<?php echo $this->element('hr_options'); ?><br><br>

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                                            
                    <h1 class="pull-left">
                        Add Violation
                    </h1>
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'cause_memos', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
                </header>

            </div>
        </div>

    <?php echo $this->Form->create('Violation',array('url'=>(array('controller' => 'cause_memos','action' => 'add_violation'))));?>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box">
                    <div class="top-space"></div>
                    <div class="main-box-body clearfix">
                        <div class="main-box-body clearfix">
                            <div class="form-horizontal">

                                <div class="form-group" id="existing_items">
                                    <label class="col-lg-2 control-label"><span style="color:red">*</span>Violation Name</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('Violation.name', 
                                                                    array( 
                                                                    'class' => 'form-control item_type categorylist required', 
                                                                    'label' => false, 
                                                                    'placeholder' => 'Item',
                                                                    'empty' => '--Select Employee--'
                                                                    ));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Description</label>
                                    <div class="col-lg-8">
                                        <?php 
                                        echo $this->Form->input('Violation.description', array('class' => 'form-control item_type',
                                                                    'alt' => 'Request Inquiry',
                                                                    'label' => false,
                                                                    'rows' => '6'));
                                                                    ?>

                                    </div>
                                </div>

                                <!-- <div class="form-group" id="existing_items">
                                    <label class="col-lg-2 control-label"><span style="color:red">*</span>Disciplinary Action</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('Violation.disciplinary_action_id', 
                                                                    array( 
                                                                    'options' => array($disciplinaryData),    
                                                                    'type' => 'select',
                                                                    'class' => 'form-control item_type categorylist required', 
                                                                    'label' => false, 
                                                                    'placeholder' => 'Item',
                                                                    'empty' => '--Select Reference Company Policy--'
                                                                    ));
                                        ?>
                                    </div>
                                </div> -->

                                <br><br>

                                <div class="form-group">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-primary pull-left">Add Assistant</button>&nbsp;
                                        <?php 
                                            echo $this->Html->link('Cancel', array('controller' => 'cause_Memos', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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


