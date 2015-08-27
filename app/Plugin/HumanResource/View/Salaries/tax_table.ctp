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
			                <h2 class="pull-left"><b>Tax Table</b> </h2>
			                <div class="filter-block pull-left">
			                 <div class="form-group pull-left">
			                 	
								</div>

             </div>
            </header>

			       <div class="main-box-body clearfix">
			            	<div id="result-table">
			            		   <div class="table-responsive">
                                <div class="table-responsive">

                        <?php foreach ($taxes as $key => $value) : ?>
                          <strong><?php echo ucwords(str_replace('_',' ',$value['TaxDeduction']['type'] )); ?></strong>
                          <br>
                          <p> Deductions  </p>

                        
             <table class="table table-bordered">
                <thead>
                <tr>
                  <th>1</th>
                  <th>2</th>
                  <th>3</th>
                  <th>4</th>
                  <th>5</th>
                  <th>6</th>
                  <th>7</th>
                  <th>8</th>
                  
                </tr>
                </thead>
                <tbody>
                <tr>
                 <?php for($tax=1;$tax<= 8; $tax++) : ?>
                    <td><?php echo $value['TaxDeduction']['tax_'.$tax]; ?></td>
                 <?php endfor; ?>
                </tr>
                   
                </tbody>
               </table>


                <?php endforeach; ?>
                <table class="table table-bordered">
                <thead>
                <tr>
                  <th><a href="#"><span>Code</span></a></th>
                  <th><a href="#" class="desc"><span>Exempt Rate</span></a></th>
                  <th><a href="#" class="asc"><span>1</span></a></th>
                  <th class="text-center"><span>2</span></th>
                  <th class="text-center"><span>3</span></th>
                  <th class="text-right"><span>4</span></th>

                  <th class="text-right"><span>5</span></th>

                  <th class="text-right"><span>6</span></th>

                  <th class="text-right"><span>7</span></th>

                  <th class="text-right"><span>8</span></th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($value['Tax'])) :  ?>
                  <?php foreach ($value['Tax'] as $key => $range) { ?>
                    <tr>
                      <td class="text-center">
                        <?php echo $range['Tax']['code']?>
                      </td>
                      <td class="text-center">
                        <?php echo $range['Tax']['exempt_rate']?>
                      </td>
                      <td class="text-center">
                        <?php echo $range['Tax']['taxes_1']?>
                      </td>

                      <td class="text-center">
                        <?php echo $range['Tax']['taxes_2']?>
                      </td class="text-center">
                      <td class="text-center">
                        <?php echo $range['Tax']['taxes_3']?>
                      </td>
                      <td class="text-right">
                      <?php echo $range['Tax']['taxes_4']?>
                      </td>
                      <td class="text-right">
                      <?php echo $range['Tax']['taxes_5']?>
                      </td>
                      <td class="text-right">
                      <?php echo $range['Tax']['taxes_6']?>
                      </td>
                      <td class="text-right">
                      <?php echo $range['Tax']['taxes_7']?>
                      </td>
                      <td class="text-right">
                      <?php echo $range['Tax']['taxes_8']?>
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