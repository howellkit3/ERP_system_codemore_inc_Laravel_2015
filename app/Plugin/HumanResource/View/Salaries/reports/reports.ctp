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
          'datetimepicker/jquery.datetimepicker'

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
			                <h2 class="pull-left"><b>Gross Reports</b> </h2>
                      <div class="clearfix"></div>

            </header>

			       <div class="main-box-body clearfix">
			            	<div id="result-table">
			            		   <div class="table-responsive">
                                <div class="table-responsive">
                               



                    <div class="tabs-wrapper">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab-home" data-toggle="tab">Monthly</a></li>
                          <li class=""><a href="#tab-help" data-toggle="tab">Yearly</a></li>
                        </ul>
                        <div class="tab-content">

                        <div class="tab-pane fade active in" id="tab-home">
                          

                          <header class="clearfix"><!-- 
                                          <h2 class="pull-left"><b>Salaries</b> </h2> -->
                                    <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                            <input type="text" type="date" name="range[month]" id="changeDate" class="form-control monthpick" value="<?php echo $date ?>">
                                           <i class="fa fa fa-calendar calendar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                            <button href="#" id="computeSalaries"  data-type="monthly" data-url="" class="compute_salary btn btn-primary pull-right "><i class="fa fa-refresh fa-lg"></i> Generate </button>
                                        </div>
                                    </div>
                                    <div class="filter-block pull-right">
                                        <div class="form-group pull-left">
                                            <!-- <button href="#" id="exportMonthlyReport"  data-type="monthly" data-url="" class="btn btn-primary pull-right "><i class="fa fa-file-text-o fa-lg"></i> Export </button> -->

                                            <?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Export ',
                                             array(
                                            'controller' => 'salaries',
                                            'action' => 'export_reports',
                                             'type' => 'monthly'),
                                             array(
                                              'escape' => false,
                                              'class' => 'btn btn-primary pull-right',
                                              'id' => 'exportMonthlyReport'
                                              ))
                                              ?>
                                        </div>
                                    </div>
                          </header>


                          <table class="table table-bordered">
                                      <thead>
                                      <tr>
                                        <th><a href="#"><span>Code</span></a></th>
                                        <th><a href="#" class="desc"><span>Name</span></a></th>
                                        <th class="text-center"><a href="#" class="asc"><span>1st Half</span></a></th>
                                        <th class="text-center"><span>2nd Half</span></th>
                                        <th class="text-center"><span>Total</span></th>
                                      </tr>
                                      </thead>

                                      <tbody id="monthly-result-cont">
                                            <?php  if(!empty($monthly)) { ?>

                                      <?php foreach ($monthly as $key => $employee): ?>

                                      <tr >
                                        <td> <?php echo $employee['Employee']['code']; ?></td>
                                        <td class="">
                                        <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
                                          </td>
                                          <td class="text-center">
                                          <?php echo $employee['first_half']; $total = $employee['first_half']; ?>
                                          </td>
                                          <td class="text-center">
                                          <?php echo $employee['second_half']; $total += $employee['second_half']; ?>
                                          </td>
                                          <td class="text-center">
                                          <?php echo $total; ?>
                                        </td>

                                      </tr>


                                      <?php  endforeach;  ?>
                                      <?php } ?> 

                                      </tbody>
                         </table>
                    </div>
                    <div class="tab-pane fade" id="tab-help">
                          <header class="clearfix"><!-- 
                                    <h2 class="pull-left"><b>Salaries</b> </h2> -->
                              <div class="filter-block pull-left">
                                  <div class="form-group pull-left">
                                      <input type="text" type="date" name="range[year]" id="changeDateYear" class="form-control yearpick" value="<?php echo date('Y') ?>">
                                     <i class="fa fa fa-calendar calendar-icon"></i>
                                  </div>
                              </div>
                              <div class="filter-block pull-left">
                                  <div class="form-group pull-left">
                                      <button href="#" id="computeSalariesYear"  data-type="yearly" data-url="" class="compute_salary btn btn-primary pull-right "><i class="fa fa-refresh fa-lg"></i> Generate </button>
                                  </div>
                              </div>
                                <div class="filter-block pull-right">
                                        <div class="form-group pull-left">
                                            <!-- <button href="#" id="exportMonthlyReport"  data-type="monthly" data-url="" class="btn btn-primary pull-right "><i class="fa fa-file-text-o fa-lg"></i> Export </button> -->

                                            <?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Export ',
                                             array(
                                            'controller' => 'salaries',
                                            'action' => 'export_reports',
                                             'type' => 'yearly'),
                                             array(
                                              'escape' => false,
                                              'class' => 'btn btn-primary pull-right',
                                              'id' => 'exportYearlyReport'
                                              ))
                                              ?>
                                        </div>
                                    </div>
                          </header>


                          <table class="table">
                                      <thead>
                                      <tr>
                                        <th><a href="#"><span>Code</span></a></th>
                                        <th><a href="#" class="desc"><span>Name</span></a></th>
                                        <th class="text-center"><a href="#" class="asc"><span>Total Deduction</span></a></th>
                                        <th class="text-center"><span>Total Earnings</span></th>
                                      </tr>
                                      </thead>

                                      <tbody id="yearly-result-cont">
                                    
                                           <?php  if(!empty($yearly)) { ?>

                                      <?php foreach ($yearly as $key => $employee): ?>

                                      <tr >
                                        <td> <?php echo $employee['Employee']['code']; ?></td>
                                        <td class="">
                                        <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
                                          </td>
                                          <td class="text-center">
                                          <?php echo $employee['total_deduction']; ?>
                                          </td>
                                          <td class="text-center">
                                          <?php echo $employee['total_pay']; ?>
                                          </td>

                                      </tr>


                                      <?php  endforeach;  ?>
                                      <?php } ?> 



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

    $(".yearpick").datepicker( {
        format: "yyyy",
        startView: "years", 
        minViewMode: "years"
      });

  });
</script>