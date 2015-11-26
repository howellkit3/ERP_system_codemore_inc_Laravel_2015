<?php 
 echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'timepicker'
)); 

echo $this->Html->script(array(
                    'jquery.maskedinput.min',
                    'HumanResource.custom',
                    'HumanResource.select2.min',
                    'HumanResource.moment',
                    'HumanResource.attendance',

)); 


echo $this->element('hr_options');

$active_tab = 'pendings';
 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <?php echo $this->element('tab/overtimes',array('active_tab' => $active_tab)); ?>
        <div class="main-box-body clearfix">
         
            <div class="tabs-wrapper">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-calendar">
                        <header class="main-box-header clearfix">                          
                        <div class="filter-block pull-left">
                             <div class="form-group pull-left">
                                <?php echo $this->Form->create('Overtime',array('controller' => 'overtimes','action' => 'pendings', 'type'=> 'get')); ?>
                                    <input type="text" name="date" id="changeDate" class="form-control datepick" value="<?php echo $date ?>">

                                        <i class="fa fa fa-calendar calendar-icon"></i>

                                    
                                </div>
                                <div class="form-group pull-left search-dropdown">
                                    <?php echo $this->Form->input('department_id',array(
                                    'options' => $departments,
                                    'class' => 'autocomplete',
                                    'label' => false,
                                    'div'  => false,
                                    'default' => $department,
                                    'empty'=> '-- Select Department --'

                                    )); ?>
                                </div>
                                 <div class="form-group pull-left">
                                     <button class="btn btn-success">Go</button> 
                                 </div>
                                <?php echo $this->Form->end(); ?>
                           </div>

                                
                           <div class="form-group pull-right">
                                <?php

                                    echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Request OT', 
                                        array('controller' => 'overtimes', 
                                              'action' => 'add'),
                                           array('class' =>'btn btn-primary pull-right',
                                                'escape' => false)); 
                                    ?>
                                        
                            </div>
                        </header>

                      <div class="main-box-body clearfix">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><a href="#"><span>Date</span></a></th>
                                            <th><a href="#"><span>Requested By</span></a></th>
                                            <th><a href="#" ><span>From</span></a></th>
                                            <th><a href="#" ><span>To</span></a></th>
                                            <th><a href="#"><span>Employees</span></a></th>
                                            <th><a href="#"><span>Status</span></a></th>
                                            <th><a href="#"><span>Actions</span></a></th> 
                                            <!-- 
                                            <th><a href="#"><span>Out</span></a></th>
                                            <th><a href="#"><span>Duration</span></a></th>
                                            <th><a href="#"><span>Remarks</span></a></th>
                                            <th><a href="#"><span>Actions</span></a></th> -->
                                        </tr>
                                    </thead>

                                    <?php 
                                        if(!empty($overtimes)){
                                            foreach ($overtimes as $key => $overtime): ?>
                                                <tbody aria-relevant="all" aria-live="polite" role="alert">
                                                    <tr class="">
                                                        
                                                        <td > 
                                                           <?php echo $overtime['Overtime']['date'] ?> 
                                                        </td>
                                                        <td > 
                                                           <?php echo !empty($overtime['User']['fullname']) ? $overtime['User']['fullname'] : ''; ?> 
                                                        </td>
                                                        <td> 
                                                           <?php  $from = (!empty($overtime['Overtime']['from']) && $overtime['Overtime']['from']  != '00:00:00') ? date('Y-m-d h:i a',strtotime($overtime['Overtime']['from'])) : '';
                                                            echo $from;
                                                             ?> 
                                                        </td>
                                                        <td > 
                                                            <?php  $to = (!empty($overtime['Overtime']['to']) && $overtime['Overtime']['to']  != '00:00:00') ? date('Y-m-d h:i a',strtotime($overtime['Overtime']['to'])) : '';
                                                            echo $to;
                                                             ?> 
                                                        </td>
                                                        <td>
                                                         <?php 

                                                            $employees = $this->Employees->overtimeEmployee($overtime['Overtime']['employee_ids']);

                                                            if (!empty($employees)) {

                                                                echo implode('<br>', $employees);
                                                            }   

                                                        ?>
                                                        </td>
                                                        <td > 
                                                            <?php echo !empty($overtime['Overtime']['status']) ? $overtime['Overtime']['status'] : '<span class="label label-default">Pending</span>'; ?>
                                                        </td>
                                                   <!--      <td > 
                                                           <?php echo $overtime['Department']['name']; ?>
                                                        </td> -->
                                                          <td > 
                                                        <?php
                                                        // echo $this->Html->link('<span class="fa-stack">
                                                        // <i class="fa fa-square fa-stack-2x"></i>
                                                        // <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> view </font></span>
                                                        // </span> ',array(
                                                        //      'controller' => 'overtimes',
                                                        //      'action' => 'view',
                                                        //      $overtime['Overtime']['id'] 
                                                        //      ),
                                                        //      array('class' =>'table-link',
                                                        //             'escape' => false,
                                                        //             'data-url' => '/overtimeId/view/'.$overtime['Overtime']['id'],
                                                        //             'title'=>'Edit Information',
                                                        //             'data-toggle' => 'modal',
                                                        //             'data-id' => $overtime['Overtime']['id'],
                                                        //  ));


                                                        echo $this->Html->link('<span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> edit </font></span>
                                                        </span> ',array(
                                                                    'controller' => 'overtimes',
                                                                     'action' => 'edit',
                                                                     $overtime['Overtime']['id']
                                                                ),
                                                                array('class' =>'table-link',
                                                                       'escape' => false,
                                                                       'data-url' => '/absences/edit/'.$overtime['Overtime']['id'],
                                                                       'title'=>'Edit Information',
                                                                    ));


                                                        
                                                        echo $this->Html->link('<span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                                                        </span> ',array(
                                                                    'controller' => 'overtimes',
                                                                     'action' => 'view',
                                                                     $overtime['Overtime']['id']
                                                                ),
                                                                array('class' =>'table-link',
                                                                       'escape' => false,
                                                                       'data-url' => '/absences/edit/'.$overtime['Overtime']['id'],
                                                                       'title'=>'Edit Information',
                                                                    ));
                                                        
                                                         echo $this->Html->link('<span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-trash fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                                                        </span> ',array(
                                                                    'controller' => 'overtimes',
                                                                     'action' => 'delete',
                                                                     $overtime['Overtime']['id']
                                                                ),
                                                                array(
                                                                    'confirm' => 'Are you sure you want to delete this Request?',    
                                                                    'class' =>'table-link',
                                                                       'escape' => false,
                                                                       'data-url' => '/absences/edit/'.$overtime['Overtime']['id'],
                                                                       'title'=>'Edit Information',
                                                                    ));



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
                                echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                echo $this->Paginator->numbers(array('separator' => ''));
                                echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
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
<?php echo $this->element('modals/personnal_attendance'); ?>