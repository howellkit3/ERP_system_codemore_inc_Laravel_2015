<?php echo $this->Html->css('/Sales/css/default'); ?>

<div class="row">
    <div class="col-lg-12">
        
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                    
                    
                    <h1 class="pull-left">
                        Add Category
                    </h1>
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'category_index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
                </header>

            </div>
        </div>
        <?php echo $this->Form->create('ItemCategoryHolder',array('url'=>(array('controller' => 'settings','action' => 'category'))));?>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <div class="top-space"></div>
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Name Category</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('ItemCategoryHolder.name', array(
                                                                                'class' => 'form-control item_type',
                                                                                'label' => false,
                                                                                'placeholder' => 'Name Category'));
                                            ?>
                                        </div>
                                    </div>

                                    
                                            <?php /*
                                                echo $this->Form->input('ItemCategoryHolder.status', array(
                                                                                'class' => 'form-control item_type',
                                                                                'label' => false,
                                                                                'placeholder' => 'Status')); */
                                            ?>
                                        
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Name Type</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('ItemTypeHolder.name', array(
                                                                                'class' => 'form-control item_type',
                                                                                'label' => false,
                                                                                'placeholder' => 'Name Type'));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-primary pull-left">Submit Category</button>&nbsp;
                                            <?php 
                                                echo $this->Html->link('Cancel', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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
                        <div class="tab-pane fade" id="tab-help">
                         <div class="main-box-body clearfix">
                        <div class="table-responsive">
                        <div class="top-space"></div>
                        <div class="main-box-body clearfix">
                        <div class="main-box-body clearfix">
                        <div class="form-horizontal">
                            <div class="form-group">
                                        <label class="col-lg-2 control-label">Name Type</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('StatusFieldHolder.status', array(
                                                                                'class' => 'form-control item_type',
                                                                                'label' => false,
                                                                                'placeholder' => 'Name Type'));
                                            ?>
                                        </div>
                                    </div>

                                

                                    <div class="form-group">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-primary pull-left">Submit Name Type</button>&nbsp;
                                            <?php 
                                                echo $this->Html->link('Cancel', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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
                                    </div>
                                </div>
                            </div>
                            