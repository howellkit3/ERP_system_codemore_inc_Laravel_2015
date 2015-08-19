<?php echo $this->element('hr_options'); ?><br><br>


<div class="row">
    <div class="col-lg-12">
        
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                                        
                    <h1 class="pull-left">
                        Edit Cause Memo
                    </h1>

                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'cause_memos', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
        
                </header>

            </div>
        </div>

        <?php echo $this->Form->create('CauseMemo',array('url'=>(array('controller' => 'cause_memos','action' => 'edit'))));?>            
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <div class="top-space"></div>
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">                                   
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Employee Name</label>
                                        <div class="col-lg-8">
                                        
                                          <?php echo $this->Form->input('CauseMemo.employee', array(
                                                                                'class' => 'form-control item_type',
                                                                                'label' => false,
                                                                                'readonly' => 'readonly',
                                                                                'value' => $employeeData[$causeMemoData['CauseMemo']['employee_id']],
                                                                                'placeholder' => 'Employee Name'));
                                                ?>

                                             <?php 
                                                echo $this->Form->input('CauseMemo.id', array(
                                                                                'label' => false,
                                                                                'hidden' => 'hidden',
                                                                                'value' => $causeMemoData['CauseMemo']['id']
                                                                                ));
                                            ?>

                                        </div>
                                    </div>  

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Description</label>
                                        <div class="col-lg-8">
                                           
                                            <?php echo $this->Form->textarea('CauseMemo.description', array(
                                                                                'class' => 'form-control item_type',
                                                                                'label' => false,
                                                                                'value' => $causeMemoData['CauseMemo']['description']));
                                                ?>

                                               
                                        </div>
                                    </div>

                                    <div class="form-group">
                                                <label class="col-lg-2 control-label">Reference Company Policy</label>
                                                <div class="col-lg-8">
                                                    <?php 
                                                           echo $this->Form->input('CauseMemo.violation_id', array(
                                                                                        'type' => 'select',
                                                                                        'label' => false,
                                                                                        'class' => 'form-control required ',
                                                                                        'empty' => '---Select Company Policy---',
                                                                                        'options' => array($violationData),
                                                                                        'default' => $causeMemoData['CauseMemo']['violation_id']

                                                                                      ));
                                                    ?>

                                                    
                                            </div>
                                        </div>

                                         <div class="form-group">
                                                <label class="col-lg-2 control-label">Disciplinary Action</label>
                                                <div class="col-lg-8">
                                                    <?php 
                                                        
                                                          echo $this->Form->input('CauseMemo.disciplinary_action_id', array(
                                                                                        'label' => false,
                                                                                         'options' => array($disciplinaryData),
                                                                                        'required' => 'required',
                                                                                        'class' => 'form-control required',
                                                                                        'default' => $causeMemoData['CauseMemo']['disciplinary_action_id'],
                                                                                        'empty' => '-------'
                                                                                       

                                                                                       ));
                                                          

                                                        //      echo $this->Form->input('CauseMemo.disciplinary_action_id', array(
                                                        // 'options' => array($disciplinaryData),
                                                        // 'type' => 'select',
                                                        // 'label' => false,
                                                        // 'class' => 'form-control required ',
                                                        // 'value' => $disciplinaryData[$causeMemoData['CauseMemo']['disciplinary_action_id']],
                                                        // 'empty' => '---Select Payment Term---',
                                                        //  )); 

                                                
                                                    ?>

                                        
                                            </div>
                                        </div>

                                         <div class="form-group">
                                                <label class="col-lg-2 control-label">Noted By</label>
                                                <div class="col-lg-8">
                                                    <?php 
                                                          echo $this->Form->input('CauseMemo.created_by', array(
                                                                                        'label' => false,
                                                                                        'required' => 'required',
                                                                                        'class' => 'form-control required',
                                                                                         'options' => array($notedByUserHR), 
                                                                                        'default' => $causeMemoData['CauseMemo']['noted_user_id']

                                                                                       ));
                                                    ?>
                                        
                                            </div>
                                        </div>




                                    <div class="form-group">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-primary pull-left">Submit Cause Memo</button>&nbsp;
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

