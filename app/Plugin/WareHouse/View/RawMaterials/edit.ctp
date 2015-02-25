<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'customer_sales', 'action' => 'add')); ?>

<div style="clear:both"></div>

<?php echo $this->element('ware_house_option');?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            <?php //echo $this->Session->flash(); ?>
            <header class="main-box-header clearfix">
                <center>
                    <h1>
                        <u>
                            Raw Material
                        </u>
                       <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'raw_materials', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </h1>
                </center>
                
            </header>
            
            <div class="main-box-body clearfix">

                <?php echo $this->Form->create('RawMaterial',array('url'=>(array('controller' => 'raw_materials','action' => 'add')),'class' => 'form-horizontal'));?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">
                            <section class="cloneMe1 contactPersonAddress_section">
                                <div class="main-box-body clearfix">
                                     <br/>            
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Name</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('name', array('class' => 'form-control item_type','label' => false));
                                                ?>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Unit</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('unit', array('class' => 'form-control required','label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Unit/Cost</label>
                                            <div class="col-lg-9">
                                               <?php 
                                                    echo $this->Form->input('unit_cost', array('class' => 'form-control required number','label' => false,'type' => 'text'));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('qty', array('class' => 'form-control required number','label' => false,'type' => 'text'));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Description</label>
                                            <div class="col-lg-9">
                                                 <?php 
                                                    echo $this->Form->textarea('description', array('class' => 'form-control required','label' => false));
                                                ?>
                                            </div>
                                        </div>
                                </div>
                            </section>
                        </div>
                    </div>  
                </div>
                    
                <hr>

                <div class="row">
                    <div class="multi-field-wrapper clearfix">
                        <div class="multi-fields clearfix">
                            <div class="multi-field clearfix">
                                <div class="col-xs-2 col-md-2"></div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Form->submit('Submit Raw Material', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                    ?>
                                 
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'raw_materials', 'action' => 'index'),array('class' =>'btn btn-primary','escape' => false));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo $this->Form->end(); ?>
                <script>
                $("#RawMaterialAddForm").validate();
                </script>

            </div>
        </div>
    </div>
</div>