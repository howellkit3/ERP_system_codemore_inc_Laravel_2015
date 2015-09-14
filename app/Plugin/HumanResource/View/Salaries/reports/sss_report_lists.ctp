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
          'HumanResource.reports',
					'HumanResource.reports',

)); 


echo $this->element('payroll_options');
$active_tab = 'gross_reports';
 ?>

 <div class="row">
  <div class="col-lg-12">
    <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/salary_reports',array('active_tab' => $active_tab)); ?>
		<div class="main-box-body clearfix">
		 
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-calendar">
						<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>SSS Report</b> </h2>
                      <div class="clearfix"></div>

            </header>

			       <div class="main-box-body clearfix">
			            	<div id="result-table">
			            		   <div class="table-responsive">
                          <div class="table-responsive">
                               
                    <div class="tabs-wrapper">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab-home" data-toggle="tab">Employee List</a></li>
                           <li ><a href="#tab-contribution" data-toggle="tab">Contributions</a></li>
                        </ul>
                        <div class="tab-content">


                        <div class="tab-pane fade active in" id="tab-home">

                          <header class="clearfix"><!-- 
                                          <h2 class="pull-left"><b>Salaries</b> </h2> -->
                                   <!--  <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                            <input type="text" type="date" name="range[month]" id="changeDate" class="form-control monthpick" value="<?php echo $date ?>">
                                           <i class="fa fa fa-calendar calendar-icon"></i>
                                        </div>
                                    </div> -->

                                    <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                            <?php echo $this->Form->input('status',array(
                                                'options' => array(
                                                      '' => 'All',
                                                      '1' => 'Employed',
                                                      '2' => 'Resigned',
                                                  ),
                                                'class' => 'form-control',
                                                'label' => false
                                            )); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                            
                                          <div class="checkbox-nice checkbox-inline">
                                            <input type="checkbox" value="employee_contribution" id="checkboxContibution">
                                            <label for="checkboxContibution">
                                            Employer Contribution
                                            </label>
                                          </div>

                                        </div>
                                    </div>
                                    
                                    <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                            <button href="#" id="filterEmp"  data-type="sss" data-url="" class="btn btn-primary pull-right "><i class="fa fa-refresh fa-lg"></i> Generate </button>
                                        </div>
                                    </div>


                                    <div class="filter-block pull-right">
                                        <div class="form-group pull-left">

                                          <?php 

                                           echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Export',
                                            array('controller' => 'salaries', 
                                              'actions' => 'sss_report_lists',
                                              'data-type' => 'monthly', 'excel'),
                                            array('class' => 'btn btn-primary pull-right',
                                                  'id' => 'SSSReports',
                                                  'escape' => false,
                                                  'target' => '_blank'
                                              ));
                                           ?>
                                        </div>
                                    </div>
                          </header>


                          <table class="table table-bordered">
                                      <thead>
                                      <tr>
                                        <th><a href="#"><span>SSS Number</span></a></th>
                                        <th class="text-center"><a href="#" class="asc"><span>Last Name</span></a></th>
                                        <th class="text-center"><span>First Name</span></th>
                                        <th class="text-center"><span>Middle Initial</span></th>
                                        <th class="text-center"><span>Date of Birth</span></th>
                                      </tr>
                                      </thead>

                                      <tbody id="pagibig-result-cont">
                                      <?php if(!empty($employees)) : ?>
                                        <?php foreach ($employees as $key => $emp) : ?>
                                          <tr>
                                              <td> <?php echo $emp['GovernmentRecord']['value']; ?></td>
                                              <td class="text-center"> <?php echo ucwords($emp['Employee']['first_name']); ?></td>
                                              <td class="text-center"> <?php echo ucwords($emp['Employee']['last_name']); ?> </td>
                                              <td class="text-center"> <?php echo ucwords($emp['Employee']['middle_name'][1]); ?> </td>
                                              <td class="text-center"> <?php echo !empty($emp['EmployeeAdditionalInformation']['birthday']) ? date('F/d/Y',strtotime($emp['EmployeeAdditionalInformation']['birthday'])) : ''  ?> </td>
                                          </tr>
                                        <?php endforeach; ?>
                                      <?php endif; ?>
                                 </tbody>
                            </table>
                                   
                         <!--  <table class="table table-bordered">
                                      <thead>
                                      <tr>
                                        <th><a href="#"><span>Code</span></a></th>
                                        <th><a href="#" class="desc"><span>Name</span></a></th>
                                        <th class="text-center"><a href="#" class="asc"><span>1st Half</span></a></th>
                                        <th class="text-center"><span>2nd Half</span></th>
                                        <th class="text-center"><span>Total</span></th>
                                      </tr>
                                      </thead>

                                      <tbody id="monthly-result-cont"></tbody>
                         </table> -->
                     </div>
                        <div class="tab-pane fade" id="tab-contribution">
                              <header class="main-box-header clearfix"><!-- 
                                            <h2 class="pull-left"><b>Salaries</b> </h2> -->
                                      <div class="filter-block pull-left">
                                          <div class="form-group pull-left">
                                              <input type="text" type="date" name="range[month]" id="changeDate" class="form-control monthpick" value="<?php echo date('m-Y') ?>">
                                             <i class="fa fa fa-calendar calendar-icon"></i>
                                          </div>
                                      </div>
                                      <div class="filter-block pull-left">
                                          <div class="form-group pull-left">
                                              <button href="#" id="computeSalaries"  data-type="monthly" data-url="" class="btn btn-primary pull-right "><i class="fa fa-refresh fa-lg"></i> Generate </button>
                                          </div>
                                      </div>

                                        <div class="filter-block pull-right">
                                        <div class="form-group pull-left">

                                          <?php 

                                           echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Export',
                                            array('controller' => 'salaries', 
                                              'actions' => 'sss_report_contributions',
                                              'data-type' => 'monthly', 'excel'),
                                            array('class' => 'btn btn-primary pull-right',
                                                  'id' => 'SSSReports',
                                                  'escape' => false,
                                                  'target' => '_blank'
                                              ));
                                           ?>
                                        </div>
                                    </div>
                          </header>


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
<script type="text/javascript">
  $(document).ready(function(){

    $(".monthpick").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
      });

  });
</script>