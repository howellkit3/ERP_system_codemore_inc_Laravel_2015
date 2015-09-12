<?php 
 
echo $this->Html->css(array(
                    'Payroll.default',
                    'Payroll.select2.css',
                    'timepicker',
                    'datetimepicker/jquery.datetimepicker',
)); 

echo $this->Html->script(array(
          'jquery.maskedinput.min',
          'HumanResource.moment',
          'HumanResource.select2.min',
          'HumanResource.custom',
          'sweet-alert.min',  
          'HumanResource.adjustment',
          'datetimepicker/jquery.datetimepicker'

)); 

echo $this->element('payroll_options');

$active_tab = 'sss_table';

?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
        <?php echo $this->element('tab/salaries',array('active_tab' => $active_tab)); ?>
    <div class="main-box-body clearfix">
     
      <div class="tabs-wrapper">
        <div class="tab-content">
          <div class="tab-pane active" id="tab-calendar">
            <header class="main-box-header clearfix">
                      <h2 class="pull-left"><b>Adjustments</b> </h2>
                      <div class="clearfix"></div>
                     
                    <div class="filter-block pull-left">
                          <div class="form-group pull-left">
                            <div class="input-group" style="max-width:150px;">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input placeholder="Date Range" name="from_date" data="1" type="text" class="form-control myDateRange datepickerDateRange" id="datepickerDateRange"  style="min-width:217px">
                                                    </div>
                          </div>

                        <div class="form-group pull-left" style="min-width:200px;">
                            <?php
                             echo $this->Form->input('employee_id',array(
                              'type' => 'select',
                              'options' => $employeeList,
                              'empty' => '--- Select Employee --- ',
                              'class' => 'autocomplete',
                              'label' => false,
                              'id' => 'selectEmployee',
                              'onChange' => 'loadDeduction(this)',
                              'default' => $defaultId
                            ));

                             ?>
                            </div>
                           <div class="form-group pull-left">
                              <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
                                  <input placeholder="Employe Name / Code" class="form-control searchEmployee"  />
                                  <i class="fa fa-search search-icon"></i>
                               <?php //echo $this->Form->end(); ?>
                          </div>

                          <?php
                         
                              // echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Employee', 
                              //     array('controller' => 'employees', 
                              //             'action' => 'add',),
                              //     array('class' =>'btn btn-primary',
                              //         'escape' => false)); 

                          ?>
                    

                           <!-- <a data-toggle="modal" href="#myEmployeeReport" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>
 -->
                         <br><br>
                     </div>

                     <div class="form-group pull-right">
                       <?php
                          echo $this->Html->link('<i class="fa fa-upload fa-fw"></i> Import Data','#addAjustmentImport',
                                  array(
                                    'class' =>'btn btn-primary',
                                    'escape' => false,
                                    'data-toggle' => 'modal'
                                      )); 

                          ?>
                      <?php
                          echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add','#addAjustments',
                                  array(
                                    'class' =>'btn btn-primary',
                                    'escape' => false,
                                    'data-toggle' => 'modal'
                                      )); 

                          ?>
                     </div>
            </header>

             <div class="main-box-body clearfix">
                    <div id="result-table">
                         <div class="table-responsive">
                                <div class="table-responsive">
                <table class="table table-bordered" id="result-cont">
                <thead>
                <tr>
                  <th><a href="#"><span>Code</span></a></th>
                  <th><a href="#" class="desc"><span>Name</span></a></th>
                  <th class="text-center"><span>Amount</span></th>

                  <th class="text-center"><span>Payroll Date</span></th>
                  <th class="text-right"><span>Reason</span></th>
                  <th class="text-right"><span>Action</span></th>
                 <!--  <th class="text-right"><span>Actions</span></th> -->
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($adjustments)) :?>
                  <?php foreach ($adjustments as $key => $adjustment) { ?>
                    <tr>
                      <td>
                        <?php 
                        $employee = $this->CustomEmployee->findEmployee($adjustment['Adjustment']['employee_id']);
                        echo !empty( $employee ) ?  $employee['Employee']['code'] : ''; ?>  
                      </td>
                      <td>  
                        <?php echo $this->CustomText->getFullname($employee['Employee']); ?>  
                      </td>
                      <td>  
                        <?php echo number_format($adjustment['Adjustment']['amount'],2); ?>
                      </td>
                      <td class="text-center">
                        <?php echo !empty($adjustment['Adjustment']['payroll_date']) ? date('Y-m-d',strtotime($adjustment['Adjustment']['payroll_date'])) : ''; ?>
                      </td>

                      <td class="text-center">
                        <?php echo $adjustment['Adjustment']['reason']; ?>
                      </td>
                      <td class="text-right">
                            <?php
                               // echo $this->Html->link('<span class="fa-stack">
                               //            <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span>',
                               //            '#viewDeductions', 
                               //              array('class' =>' table-link view_amortization',
                               //                 'data-id' => $adjustment['Adjustment']['id'], 
                               //                  'escape' => false,
                               //                  'data-toggle' => 'modal',
                               //                  'title'=>'View Amorization'
                               //            ));
                                  echo $this->Html->link('<span class="fa-stack">
                                      <i class="fa fa-square fa-stack-2x"></i>
                                      <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                                      </span> ','#adjustmentModal',
                                      array(
                                        'class' =>'table-link edit_adjustment',
                                        'data-toggle' => 'modal',
                                        'data-id' => $adjustment['Adjustment']['id'],
                                        'escape' => false,'title'=>'Edit Information'));

                                  echo $this->Html->link('<span class="fa-stack">
                                      <i class="fa fa-square fa-stack-2x"></i>
                                      <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                                      </span> ', array('controller' => 'salaries', 'action' => 'adjustment_delete',$adjustment['Adjustment']['id']),array('class' =>' table-link delete_Deduction','escape' => false,'title'=>'Edit Information'));
                            ?>
                      </td>
                  </tr>
                  <?php } ?>
                <?php endif; ?>
                  </tbody>
                </table>
                </div>
             </div> 
             </div>
             
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
<?php echo $this->element('/modals/adjustments'); ?>