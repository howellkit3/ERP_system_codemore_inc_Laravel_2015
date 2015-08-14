<?php 
 echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'timepicker'
)); 

echo $this->Html->script(array(
					'jquery.maskedinput.min',
					'HumanResource.moment',
					'HumanResource.custom',
					'HumanResource.calculate'

)); 


echo $this->element('hr_options');

	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/salaries',array('active_tab' => $active_tab)); ?>
		<div class="main-box-body clearfix">
		 
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-calendar">
					<?php echo $this->Form->create('Attendance',array('controller' => 'salaries','action' => 'compute_salaries', 'type'=> 'post')); ?>
						<header class="main-box-header clearfix"><!-- 
			                <h2 class="pull-left"><b>Salaries</b> </h2> -->
			                <div class="filter-block pull-left">
			              <div class="form-group pull-left">
			                 	
			                 		<input type="text" type="date" name="range[month]" id="changeDate" class="form-control monthpick" value="<?php echo $date ?>">
									     <i class="fa fa fa-calendar calendar-icon"></i>
								</div>

							<div class="form-group pull-left">
								<div class="radio inline-block">
									<input type="radio" checked="" value="1:15" id="optionsRadios1" name="range[days]">
									<label for="optionsRadios1">
										1 - 15
									</label>
								</div>
								<div class="radio inline-block">
									<input type="radio" value="16:31" id="optionsRadios2" name="range[days]">
									<label for="optionsRadios2">
										16 - 31
									</label>
								</div>
							</div>

			               </div>
			               <div class="filter-block pull-right">
			               <div class="form-group">
			               		<!-- <a type="" href="#" id="exportData" data-url="" class="btn btn-primary pull-right" style="display:none" >
								<i class="fa fa-file-text-o fa-lg"></i> Export </a> -->
								<?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Export',array(
								'controller' => 'salaries',
								 'action' => 'export_salaries_report' , 'excel'),
								array(
                                    'class' => 'btn btn-primary pull-right',
                                    'id' => 'exportData',
                                    'escape' => false)	
								 ); ?>
								<button href="#" id="computeSalaries" data-url="" class="btn btn-primary pull-right "><i class="fa fa-refresh fa-lg"></i> Generate </button>
							
			               </div>
			               </div>

			            </header>
			            <?php $this->Form->end(); ?>

			          <div class="main-box-body clearfix">
			            	<div id="result-table">
			            		   <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><a href="#"><span>Code</span></a></th>
                    <th><a href="#"><span>Employee</span></a></th>
                    <th><a href="#"><span>Pay Date</span></a></th>
                    <th><a href="#" class="text-center"><span>From</span></a></th>
                    <th><a href="#" class="text-center"><span>To</span></a></th>
                    <th><a href="#"><span>Gross</span></a></th>
                    <th><a href="#"><span>SSS</span></a></th>
                    <th><a href="#"><span>PhilHealth</span></a></th>
                    <th><a href="#"><span>WTax</span></a></th>
                    <th><a href="#"><span>Deductions</span></a></th>

                    <th><a href="#"><span>Remarks</span></a></th>
                </tr>
            </thead>


            <tbody aria-relevant="all" aria-live="polite" role="alert">
                                    <?php  if(!empty($employees)) { ?>

                                           <?php foreach ($employees as $key => $employee): ?>
                                                    
                                                    <tr >
                                                        <td> <?php echo $employee['Employee']['code']; ?></td>
                                                        <td class="">
                                                          <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
                                                        </td>

                                                         <td class="">
                                                          <?php echo date('Y/m/d')  ?>
                                                        </td>
                                                          <td class="">
                                                          <?php echo !empty($customDate['start']) ? date('Y/m/d',strtotime($customDate['start'])) : '' ?>
                                                        </td>
                                                          <td class="">
                                                           <?php echo !empty($customDate['end']) ? date('Y/m/d',strtotime($customDate['end'])) : '' ?>
                                                        </td>

                                                        <td class="">
                                                           <?php $gross = $this->Salaries->gross_pay($employee,$employee['Salary']); echo number_format($gross['gross'],2); ?>
                                                        </td>

                                                        <td class="">
                                                           <?php 
                                                           echo $this->Salaries->sss_pay($employee,$employee['Salary'],$payScheds,$gross['gross']); ?>
                                                        </td>
                                                        <td class="">
                                                           <?php echo $this->Salaries->philhealth_pay($employee,$employee['Salary'],$payScheds,$gross['gross']); ?>
                                                        </td>
                                                        <td class="">
                                                           <?php echo '0.00'; //$this->Salaries->sss_pay($employee['Attendance'],$employee['Salary'],$payScheds,$gross); ?>
                                                        </td>
                                                        <td class="">
                                                           <?php echo '0.00';//$this->Salaries->sss_pay($employee['Attendance'],$employee['Salary'],$payScheds,$gross); ?>
                                                        </td>
                                                        <td class="">
                                                           <?php //echo $this->Salaries->sss_pay($employee['Attendance'],$employee['Salary'],$payScheds,$gross); ?>
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
<?php echo $this->element('modals/personnal_attendance'); ?>

<?php echo $this->element('modals/time_in_attendance'); ?>