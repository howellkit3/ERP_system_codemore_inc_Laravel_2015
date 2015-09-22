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
          'HumanResource.reports'

)); 


echo $this->element('payroll_options');
$active_tab = 'gross_reports';
 ?>

 <div class="row" id="sss-result-main-cont">
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
                                                'options' => $statuses,
                                                'class' => 'form-control',
                                                'empty' => '---- All ----',
                                                'label' => false
                                            )); ?>
                                        </div>
                                    </div>
                                    
                                   <!--  <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                            
                                          <div class="checkbox-nice checkbox-inline">
                                            <input type="checkbox" value="employee_contribution" id="checkboxContibution">
                                            <label for="checkboxContibution">
                                            Employer Contribution
                                            </label>
                                          </div>

                                        </div>
                                    </div> -->
                                    
                                    <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                            <button href="#" id="filterEmp"  data-type="sss" data-url="" class="btn btn-primary pull-right "><i class="fa fa-refresh fa-lg"></i> Generate </button>
                                        </div>
                                    </div>


                                    <div class="filter-block pull-right">
                                        <div class="form-group pull-left">

                                          <?php 
                                          
                                          $url = $this->Html->url('/',true);
                                           
                                          echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Export',
                                            array(
                                              'controller' => 'salaries', 
                                              'action' => 'sss_reports',
                                              'type' => 'excel'),
                                            array(
                                              'data-url' => $url.'/human_resource/salaries/sss_reports/type:excel',
                                              'class' => 'btn btn-primary pull-right',
                                              'id' => 'SSSReports',
                                              'escape' => false,
                                              'target' => '_blank'
                                              ));
                                           ?>
                                        </div>
                                    </div>
                          </header>

                          <div id="sss-result-cont">
                            <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th><a href="#"><span>SSS Number</span></a></th>
                                            <th class="text-center"><a href="#" class="asc"><span>Last Name</span></a></th>
                                            <th class="text-center"><span>First Name</span></th>
                                            <th class="text-center"><span>Middle Initial</span></th>
                                            <th class="text-center"><span>Date of Birth</span></th>
                                            <th class="text-center"><span>Emp Status</span></th>
                                          </tr>
                                        </thead>

                                      <tbody>
                                        <?php if(!empty($employees)) : ?>
                                          <?php foreach ($employees as $key => $emp) : ?>
                                            <tr>
                                                <td> <?php echo $emp['GovernmentRecord']['value']; ?></td>
                                                <td class="text-center"> <?php echo ucwords($emp['Employee']['first_name']); ?></td>
                                                <td class="text-center"> <?php echo ucwords($emp['Employee']['last_name']); ?> </td>
                                                <td class="text-center"> <?php echo ucwords($emp['Employee']['middle_name'][1]); ?> </td>
                                                <td class="text-center"> <?php echo !empty($emp['EmployeeAdditionalInformation']['birthday']) ? date('F/d/Y',strtotime($emp['EmployeeAdditionalInformation']['birthday'])) : ''  ?> </td>
                                                <td class="text-center"> 
                                                <?php echo !empty($emp['Status']['name']) ? '<span class="label label-success">'.ucwords($emp['Status']['name']) .'</span>' : ''; ?>
                                                </td>
                                            </tr>
                                          <?php endforeach; ?>
                                        <?php endif; ?>
                                   </tbody>
                              </table>

                            <div class="paging" id="item_type_pagination" data-result="#sss-result-cont">
                              <?php
                                  echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                  echo $this->Paginator->numbers(array('separator' => ''));
                                  echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                              ?>
                            </div>

                           </div>
                                   
                         <!-- <table class="table table-bordered">
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
                              <header class="clearfix"><!-- 
                                            <h2 class="pull-left"><b>Salaries</b> </h2> -->
                                      <div class="filter-block pull-left">
                                          <div class="form-group pull-left">
                                              <input type="text" type="date" name="range[month]" id="changeDate" class="form-control monthpick" value="<?php echo date('m-Y') ?>">
                                             <i class="fa fa fa-calendar calendar-icon"></i>
                                          </div>
                                      </div>
                                      <div class="filter-block pull-left">
                                          <div class="form-group pull-left">
                                              <button href="#" id="SSSMonthlyContribution"  data-type="monthly" data-url="" class="btn btn-primary pull-right "><i class="fa fa-refresh fa-lg"></i> Generate </button>
                                          </div>
                                      </div>

                                        <div class="filter-block pull-right">
                                        <div class="form-group pull-left">

                                          <?php 
                                            
                                            $url = $this->Html->url('/',true);
                                            echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Export',
                                            array('controller' => 'salaries', 
                                              'action' => 'sss_report_contributions', 
                                              'excel'),
                                            array(
                                                'class' => 'btn btn-primary pull-right',
                                                'data-url' => $url.'/human_resource/salaries/sss_report_contributions/type:excel',
                                                'id' => 'SSSContributionReports',
                                                'escape' => false,
                                                'target' => '_blank'
                                              ));
                                           ?>
                                        </div>
                                    </div>
                          </header>

                           <div id="sss-contribution-result-cont">
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
<script type="text/javascript">
  $(document).ready(function(){

    $(".monthpick").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
      });

  });
</script>