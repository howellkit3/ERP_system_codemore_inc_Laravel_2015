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
			                <h2 class="pull-left"><b>SSS R1-A Report</b> </h2>
                      <div class="clearfix"></div>

            </header>

			       <div class="main-box-body clearfix">
			            	<div id="result-table">
			            		   <div class="table-responsive">
                          <div class="table-responsive">
                               
                    <div class="tabs-wrapper">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab-home" data-toggle="tab">Monthly</a></li>
                        </ul>
                        <div class="tab-content">


                        <div class="tab-pane fade active in" id="tab-home">

                          <header class="main-box-header clearfix"><!-- 
                                          <h2 class="pull-left"><b>Salaries</b> </h2> -->
                                    <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                            <input type="text" type="date" name="range[month]" id="changeDate" class="form-control monthpick" value="<?php echo $date ?>">
                                           <i class="fa fa fa-calendar calendar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                           <!--  <button href="#" id="SSSReports"  data-type="monthly" data-url="" class="btn btn-primary pull-right "><i class="fa fa-refresh fa-lg"></i> Generate </button> -->

                                           <?php 
                                           echo $this->Html->link('<i class="fa fa-refresh fa-lg"></i> Generate',
                                            array('controller' => 'salaries', 
                                              'actions' => 'sss_reports',
                                              'data-type' => 'monthly', 'pdf'),
                                            array('class' => 'btn btn-primary pull-right',
                                                  'id' => 'SSSReports',
                                                  'escape' => false,
                                                  'target' => '_blank'
                                              ));
                                           ?>
                                        </div>
                                    </div>
                          </header>


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
    <div class="tab-pane fade" id="tab-help">
          <header class="main-box-header clearfix"><!-- 
                                          <h2 class="pull-left"><b>Salaries</b> </h2> -->
                                    <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                            <input type="text" type="date" name="range[month]" id="changeDate" class="form-control monthpick" value="<?php echo $date ?>">
                                           <i class="fa fa fa-calendar calendar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="filter-block pull-left">
                                        <div class="form-group pull-left">
                                            <button href="#" id="computeSalaries"  data-type="monthly" data-url="" class="btn btn-primary pull-right "><i class="fa fa-refresh fa-lg"></i> Generate </button>
                                        </div>
                                    </div>
                          </header>


                         <!--  <table class="table">
                                      <thead>
                                      <tr>
                                        <th><a href="#"><span>Code</span></a></th>
                                        <th><a href="#" class="desc"><span>Name</span></a></th>
                                        <th class="text-center"><a href="#" class="asc"><span>1st Half</span></a></th>
                                        <th class="text-center"><span>2nd Half</span></th>
                                        <th class="text-center"><span>Total</span></th>
                                      </tr>
                                      </thead>

                                      <tbody id="yearly-result-cont"></tbody>
                         </table> -->
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