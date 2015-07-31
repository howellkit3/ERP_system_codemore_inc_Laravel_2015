<?php echo $this->element('hr_options'); ?><br><br>


<div class="row">
    <div class="col-lg-12">
        
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                                        
                    <h1 class="pull-left">
                        Edit Violation
                    </h1>

                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'cause_memos', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
        
                </header>

            </div>
        </div>

        <?php echo $this->Form->create('DisciplinaryAction',array('url'=>(array('controller' => 'cause_memos','action' => 'edit_disciplinary_action'))));?>            
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <div class="top-space"></div>
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">                                   
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Disciplinary Action Name</label>
                                        <div class="col-lg-8">
                                        
                                          <?php echo $this->Form->input('DisciplinaryAction.name', array(
                                                                                'class' => 'form-control item_type',
                                                                                'label' => false,
                                                                                'value' => $DisciplinaryActionData['DisciplinaryAction']['name'],
                                                                                'placeholder' => 'Violation Name'));
                                                ?>

                                             <?php 
                                                echo $this->Form->input('DisciplinaryAction.id', array(
                                                                                'label' => false,
                                                                                'hidden' => 'hidden',
                                                                                'value' => $DisciplinaryActionData['DisciplinaryAction']['id']
                                                                                ));
                                            ?>

                                        </div>
                                    </div>  


                                    <div class="form-group">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-primary pull-left">Submit Disciplinary Action</button>&nbsp;
                                            <?php 
                                                echo $this->Html->link('Cancel', array('controller' => 'cause_memos', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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
    </div>
</div>

