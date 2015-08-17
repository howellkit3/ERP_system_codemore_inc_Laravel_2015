<?php $this->Html->addCrumb('Settings', array('controller' => 'settings', 'action' => 'department')); ?>
<?php $this->Html->addCrumb('Leave Type', array('controller' => 'settings', 'action' => 'leave_types','tab'=>'leave_types')); ?>
<?php echo $this->element('hr_options');
    $active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : ' ';

?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            
            <?php echo $this->element('tab/settings',array('active_tab' => $active_tab)); ?>

                <div class="main-box-body clearfix">
                    <div class="tabs-wrapper">
                        <div class="tab-content">
                            <!-- <div class="tab-pane <?php echo ($active_tab == 'position') ? 'active' : '' ?>" id="tab-position"> -->
                            <!-- <div class="tab-pane fade <?php echo ($active_tab == 'position' || $this->params['action'] == 'position') ? 'in active' : '' ?>" id="position"> -->
                            <div class="tab-pane active" id="tab-type">
                                <header class="main-box-header clearfix">
                                    <h2 class="pull-left"><b>Category</b></h2>
                                    <div class="filter-block pull-right">
                                     <div class="form-group pull-left">
                                            <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
                                                <input placeholder="Search..." class="form-control searchCustomer"  />
                                                <i class="fa fa-search search-icon"></i>
                                             <?php //echo $this->Form->end(); ?>
                                        </div>
                                       <?php
                                            echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Leave Type', 
                                                array('controller' => 'leave_types', 
                                                        'action' => 'add',),
                                                array('class' =>'btn btn-primary pull-right',
                                                    'escape' => false));

                                        ?> 
                                      <br><br>
                                   </div>
                                </header>
                                <div class="main-box-body clearfix">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th><a href="#"><span>#</span></a></th>
                                                    <th><a href="#"><span>Name</span></a></th>
                                                    <th class="text-center"><a href="#"><span>Limit</span></a></th>
                                                    <th><a href="#"><span>Actions</span></a></th>
                                                </tr>
                                            </thead>
                                              <?php if(!empty($leavetypeData)) {
                                                    foreach ($leavetypeData as $key => $leavetypeList): $key++ ?>
                                                            <tbody aria-relevant="all" aria-live="polite" role="alert">
                                                                <tr class="">
                                                                    <td class="">
                                                                        <?php echo $key;?> 
                                                                    </td>
                                                                    <td class="">
                                                                        <?php echo ucfirst($leavetypeList['LeaveType']['name']);  ?>
                                                                    </td>
                                                                    
                                                                    <td class="text-center">
                                                                       <?php echo number_format($leavetypeList['LeaveType']['limit'],2);  ?> Hour/s
                                                                    </td>

                                                                    <td>
                                                                        <?php 
                                                                        echo $this->Html->link('<span class="fa-stack">
                                                                            <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'leave_types', 'action' => 'view',$leavetypeList['LeaveType']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Leave Type'
                                                                            ));

                                                                        ?>

                                                                    <?php
                                                                    echo $this->Html->link('<span class="fa-stack">
                                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                                                                    </span> ', array('controller' => 'leave_types', 'action' => 'edit',$leavetypeList['LeaveType']['id']),array('class' =>' table-link','escape' => false,'title'=>'Leave Type'));


                                                                    echo $this->Form->postLink('<span class="fa-stack">
                                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                                                                    </span>', array(
                                                                            'controller' => 'leave_types',
                                                                            'action' => 'delete',
                                                                            'plugin' => 'human_resource',
                                                                            $leavetypeList['LeaveType']['id']),
                                                                                    array('escape' => false,'class'=> 'table-link'), 
                                                                                    __('Are you sure you want to delete %s?', 
                                                                                    $leavetypeList['LeaveType']['name'])
                                                                            ); 
                                                                    ?>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                <?php 
                                                    endforeach; 
                                                } ?>  
                                        
                                        </table>    

                                        <hr>

                                        <div class="paging" id="item_type_pagination">
                                                <?php
                                               
                                                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'LeaveType','model' => 'LeaveType'), null, array('class' => 'disable','model' => 'LeaveType'));
                                                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'LeaveType'), array('paginate' => 'LeaveType'));
                                                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'LeaveType','model' => 'LeaveType'), null, array('class' => 'disable'));

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