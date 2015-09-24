<?php $this->Html->addCrumb('Settings', array('controller' => 'settings', 'action' => 'department')); ?>
<?php $this->Html->addCrumb('Department', array('controller' => 'settings', 'action' => 'department')); ?>
<?php echo $this->element('hr_options');
    $active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'department';

 ?>
<?php echo $this->Html->script(array(
    'HumanResource.department'
)); ?>
 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            
            <?php echo $this->element('tab/settings',array('active_tab' => $active_tab)); ?>

            <div class="main-box-body clearfix">
                <div class="tabs-wrapper">
                    <div class="tab-content">
                        <!-- <div class="tab-pane <?php echo ($active_tab == 'department') ? 'active' : '' ?>" id="tab-department"> -->
                        <div class="tab-pane fade <?php echo ($active_tab == 'department' || $this->params['action'] == 'department') ? 'in active' : '' ?>" id="department">
                            <header class="main-box-header clearfix">
                                <h2 class="pull-left"><b>Department List</b></h2>
                                <div class="filter-block pull-right">
                                    <div class="form-group pull-left">
                                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
                                            <input placeholder="Search..." class="form-control searchDepartment"  />
                                            <i class="fa fa-search search-icon"></i>
                                         <?php //echo $this->Form->end(); ?>
                                    </div>
                                    <?php
                                       
                                        echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Department', 
                                                array('controller' => 'departments', 
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
                                                <th><a href="#"><span>Department</span></a></th>
                                                <th class="text-center"><a href="#"><span>Section</span></a></th>
                                                <th class="text-center"><a href="#"><span>Subsection</span></a></th>
                                                <th class="text-center"><a href="#"><span>Short Description</span></a></th>
                                                <th><a href="#"><span>Actions</span></a></th>
                                            </tr>
                                        </thead>
                                         <tbody aria-relevant="all" aria-live="polite" role="alert" class="append-table-department">
                                        <?php 
                                            if(!empty($departmentData)){
                                                foreach ($departmentData as $key => $departmentList): $key++ ?>
                                                        <tr class="">
                                                            <td class="">
                                                                <?php echo $key;?> 
                                                            </td>
                                                            <td class="">
                                                                <?php echo ucfirst($departmentList['Department']['name']);  ?>
                                                            </td>
                                                            
                                                            <td class="text-center">
                                                               <?php echo ucfirst($departmentList['Department']['description']);  ?>
                                                            </td>

                                                             <td class="text-center">
                                                              <?php echo ucfirst($departmentList['Department']['specification']);  ?>
                                                            </td>

                                                            <td class="text-center">
                                                               <?php echo !empty($departmentList['Department']['notes']) ? $departmentList['Department']['notes'] : '';  ?>
                                                            </td>

                                                            <td>
                                                                <?php 
                                                                echo $this->Html->link('<span class="fa-stack">
                                                                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'departments', 'action' => 'view',$departmentList['Department']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
                                                                    ));

                                                                ?>

                                                            <?php
                                                            echo $this->Html->link('<span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                                                            </span> ', array('controller' => 'departments', 'action' => 'edit',$departmentList['Department']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Department'));


                                                            echo $this->Form->postLink('<span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                                                            </span>', array(
                                                                    'controller' => 'departments',
                                                                    'action' => 'delete',
                                                                    'plugin' => 'human_resource',
                                                                    $departmentList['Department']['id']),
                                                                            array('escape' => false,'class'=> 'table-link'), 
                                                                            __('Are you sure you want to delete %s?', 
                                                                            $departmentList['Department']['name'])
                                                                    ); 
                                                            ?>
                                                            </td>
                                                        </tr>

                                                   
                                            <?php 
                                                endforeach; 
                                            } ?> 
                                         </tbody>
                                    </table>    

                                    <hr>

                                    <div class="paging" id="item_type_pagination">
                                            <?php
                                           
                                            echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Department','model' => 'Department'), null, array('class' => 'disable','model' => 'ClientOrder'));
                                            echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Department'), array('paginate' => 'Department'));
                                            echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Department','model' => 'Department'), null, array('class' => 'disable'));

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