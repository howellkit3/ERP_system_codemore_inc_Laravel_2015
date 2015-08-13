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
                <table class="table">
                <thead>
                <tr>
                  <th><a href="#"><span>Code</span></a></th>
                  <th><a href="#" class="desc"><span>Name</span></a></th>
                  <th><a href="#" class="asc"><span>From</span></a></th>
                  <th class="text-center"><span>To</span></th>
                  <th class="text-center"><span>Mode</span></th>
                  <th class="text-left"><span>Amount</span></th>
                  <th class="text-right"><span>Reason</span></th>
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
                      <td>
                       <?php echo !empty($deduction['Deduction']['from']) && $deduction['Deduction']['from'] != '00:00:00' ? date('Y-m-d', strtotime($deduction['Deduction']['from'])) : ''; ?>  
                      </td>

                      <td class="text-center">
                       <?php 
                       echo !empty($deduction['Deduction']['to']) && $deduction['Deduction']['to'] != '00:00:00' ? date('Y-m-d', strtotime($deduction['Deduction']['to'])) : ''; ?>  
                      </td class="text-center">
                      <td class="text-left">
                        <?php echo ucwords($deduction['Deduction']['mode'])?>   
                      </td>
                      <td class="text-left">
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