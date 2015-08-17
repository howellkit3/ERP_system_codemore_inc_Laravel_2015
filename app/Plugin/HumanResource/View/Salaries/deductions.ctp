<?php 
 echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'timepicker',
                    'datetimepicker/jquery.datetimepicker',
)); 

echo $this->Html->script(array(
					'jquery.maskedinput.min',
					'HumanResource.moment',
          'HumanResource.select2.min',
					'HumanResource.custom',
					'HumanResource.deductions',
          'datetimepicker/jquery.datetimepicker'

)); 


echo $this->element('hr_options');
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
			                <h2 class="pull-left"><b>Deductions</b> </h2>
                      <div class="clearfix"></div>
			               
                    <div class="filter-block pull-left">


                          <div class="form-group pull-left">
                            <div class="input-group" style="max-width:150px;">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input placeholder="Date Range" name="from_date" data="1" type="text" class="form-control myDateRange datepickerDateRange" id="datepickerDateRange"  style="min-width:217px">
                                                    </div>
                          </div>

                        <div class="form-group pull-left" style="min-width:200px;">
                            <?php echo $this->Form->input('employee_id',array(
                              'type' => 'select',
                              'options' => $employeeList,
                              'class' => 'autocomplete',
                              'label' => false,
                              'id' => 'selectEmployee'
                            )); ?>
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
                         
                              echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add', 
                                  array('controller' => 'salaries', 
                                          'action' => 'deductions_add',),
                                  array('class' =>'btn btn-primary',
                                      'escape' => false)); 

                          ?>
                     </div>
            </header>

			       <div class="main-box-body clearfix">
			            	<div id="result-table">
			            		   <div class="table-responsive">
                                <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                <tr>
                  <th><a href="#"><span>Code</span></a></th>
                  <th><a href="#" class="desc"><span>Name</span></a></th>
                  <th class="text-center"><a href="#" class="asc"><span>From</span></a></th>
                  <th class="text-center"><span>To</span></th>
                  <th class="text-center"><span>Mode</span></th>
                  <th class="text-center"><span>Amount</span></th>
                  <th class="text-right"><span>Reason</span></th>
                 <!--  <th class="text-right"><span>Actions</span></th> -->
                </tr>
                </thead>
                <tbody>
                  <?php if (!empty($deductions)) :?>
                  <?php foreach ($deductions as $key => $deduction) { ?>
                    <tr>
                      <td>
                        <?php echo $deduction['Employee']['code']; ?>  
                      </td>
                      <td>
                        <?php echo $this->CustomText->getFullname($deduction['Employee']); ?>  
                      </td>
                      <td class="text-center">
                       <?php echo !empty($deduction['Deduction']['from']) && $deduction['Deduction']['from'] != '00:00:00' ? date('Y-m-d', strtotime($deduction['Deduction']['from'])) : ''; ?>  
                      </td>

                      <td class="text-center">
                       <?php 
                       echo !empty($deduction['Deduction']['to']) && $deduction['Deduction']['to'] != '00:00:00' ? date('Y-m-d', strtotime($deduction['Deduction']['to'])) : ''; ?>  
                      </td class="text-center">
                      <td class="text-center">
                        <?php echo ucwords($deduction['Deduction']['mode'])?>   
                      </td>
                      <td class="text-center">
                        <?php echo $deduction['Deduction']['amount']?>   
                      </td>
                      <td class="text-right">
                        <?php echo $deduction['Deduction']['reason']?>   
                      </td>
                  </tr>
                  <?php } ?>
                <?php endif; ?>
                  </tbody>
                </table>
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