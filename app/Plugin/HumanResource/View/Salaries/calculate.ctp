<?php 
 echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'timepicker',
                    'HumanResource.salaries'
)); 

echo $this->Html->script(array(
					'jquery.maskedinput.min',
					'HumanResource.select2.min',
					'HumanResource.moment',
					'HumanResource.custom',
					'HumanResource.compute_salaries'

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

						<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Calculate Salary</b> </h2>
			                  <div class="pull-right"><button class="export-report btn btn-success"><i class="fa fa-print"></i> Print Report </button></div>	
			                	<div class="clearfix"></div>
			                <hr/>

			            </header>

			          <div class="main-box-body clearfix">
		
			          	<div class="col-lg-3 right-pane salaries" >

			                <h2 class="list-group pull-left"><b>Filter Employee</b> </h2>
			                <div class="clearfix"></div>
			                <div class="filter-block ">

			                  <div class="form-group">
			                 		 <input placeholder="Employee Code" class="form-control searchEmployee" value="" name="data[name]" />
			                            <i class="fa fa-search search-icon"></i>

			                           
			                         
			                  </div>
			                  <div class="clearfix"></div>   
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
			                     <div class="clearfix"></div> 
			                     <br><br>  
			                    <div class="form-group pull-left" id="result_container_employee">
									<ul class="list-group">
										<li class="list-group-item">
											<span class="badge">employee-code</span>
											Employee
										</li>
										
									</ul>
			                    </div>
			          		</div>
			          		<div class="col-lg-9">

			          			<div class="form-group">
			          				 <h2 class="list-group pull-left"><b>Employee Information</b> </h2>
			          				 <br>
			          				 <div class="clearfix"></div>
			          				<div class="col-lg-9">		
				          				<table class="table table-striped table-hover">
				          				 	<tr>
				          				 		<td><label for="inputEmail1" class="col-lg-12 control-label strong">Name</label> </td>
				          				 		<td> 
				          				 		<label class="col-lg-12 control-label strong">
				          				 		<?php echo $this->Form->input('employee_id',array('type' => 'hidden' )); ?>
				          				 		<?php echo $this->Form->input('name', array(
				          				 		'id' => 'employee_name',
				          				 		'readonly' => 'readonly',
				          				 		'class' => 'form-control emp-details',
				          				 		'data-id' => 'employee_name',
				          				 		'label' => false
				          				 		)); ?>
				          				 		</label>
				          				 		</td>
				          				 		<td><label for="inputEmail1" class="col-lg-12 control-label strong"> Employee Code</label>
				          				 		</td> 
				          				 		<td>
				          				 		<label class="col-lg-12 control-label strong">
				          				 		<?php echo $this->Form->input('code', array(
				          				 		'id' => 'employee_code',
				          				 		'readonly' => 'readonly',
				          				 		'class' => 'form-control emp-details',
				          				 		'data-id' => 'employee_code',
				          				 		'label' => false
				          				 		)); ?>
				          				 		</label>	
				          				 		</td>
				          				 	</tr>
				          				 	
				          				 	<tr>
				          				 		<td> <label for="inputEmail1" class="col-lg-12 control-label strong"> Department</label> </td>
				          				 		<td>
				          				 		<label class="col-lg-12 control-label strong">
				          				 		<?php echo $this->Form->input('code', array(
				          				 		'id' => 'employee_department',
				          				 		'readonly' => 'readonly',
				          				 		'class' => 'form-control emp-details',
				          				 		'data-id' => 'employee_department',
				          				 		'label' => false
				          				 		)); ?>
				          				 		</label>
				          				 		</td>
				          				 		<td><label for="inputEmail1" class="col-lg-12 control-label strong"> Position</label></td>
				          				 		<td> 
				          				 		<label class="col-lg-12 control-label strong">
				          				 		<?php echo $this->Form->input('code', array(
				          				 		'id' => 'employee_position',
				          				 		'readonly' => 'readonly',
				          				 		'class' => 'form-control emp-details',
				          				 		'data-id' => 'employee_position',
				          				 		'label' => false
				          				 		)); ?>
				          				 		</label>
				          				 		</td>
				          				 	</tr>
				          				 	
				          				 	<tr>
				          				 		<td> <label for="inputEmail1" class="col-lg-12 control-label strong">Status</label> </td><td> </td>
				          				 		<td></td><td> </td>
				          				 	</tr>
				          				 	
				          				 </table>
			          				 </div>
			          				 <div class="col-lg-3">		
				          				<?php
				                            $style = '';

				                            if (!empty($employee['Employee']['image'])) {

					                            $serverPath = $this->Html->url('/',true);	
					                            $background =  $serverPath.'img/uploads/employee/'.$employee['Employee']['image'];	
					                            $style = 'background:url('.$background.')';
				                            } 

		                       				 ?>
	                            			<div class="image_profile" style="<?php echo $style; ?>"></div>
			          				 </div>
			          				 <br>
			          				 <br>
			          			</div>

			          			<div class="form-group">
			          				 <h2 class="list-group pull-left"><b>Salary Information </b> </h2>
			          				 <br>
			          				 <div class="clearfix"></div>
			          				<div class="row">
			          					<div class="col-lg-6">	
										<header class="main-box-header clearfix">
										<h2>Basic info</h2>
										</header>
				          				<table class="table table-striped table-hover">
				          				 	<tr>
				          				 		<td> <label for="inputEmail1" class="col-lg-12 control-label strong">Basic Salary  :</label> </td><td></td>
				          				 		<td class="price-symbolc"><label for="inputEmail1" class="col-lg-12 control-label strong"> 
				          				 		<input id="basic_pay" type="readonly" class="form-control" value="0.00" /> </label></td><td></td>
				          				 	</tr>
				          				 	
				          				 	<tr>
				          				 		<td> <label for="inputEmail1" class="col-lg-12 control-label strong"> Overtime:</label> </td><td></td>
				          				 		<td class="price-symbolc"><label for="inputEmail1" class="col-lg-12 control-label strong"> 
				          				 		<input id="overtime" type="readonly" class="form-control" value="0.00" /> </label></td><td></td>
				          				 	</tr>
				          				 </table>
			          				 </div>
			          				 <div class="col-lg-6">
										<header class="main-box-header clearfix">
										<h2>Tax</h2>
										</header>		
				          				<table class="table table-striped table-hover">
				          				 	<tr>
				          				 		<td> <label for="inputEmail1" class="col-lg-12 control-label strong"> SSS :</label> </td><td></td>
				          				 		<td class="price-symbolc"><label for="inputEmail1" class="col-lg-12 control-label strong"> 
				          				 		<input type="readonly" class="form-control" value="0.00" /> </label></td><td></td>
				          				 	</tr>
				          				 	
				          				 	<tr>
				          				 		<td> <label for="inputEmail1" class="col-lg-12 control-label strong"> Phil.health :</label> </td><td></td>
				          				 		<td class="price-symbolc"><label for="inputEmail1" class="col-lg-12 control-label strong"> 
				          				 		<input type="readonly" class="form-control" value="0.00" /> </label></td><td></td>
				          				 	</tr>
				          				 	
				          				 	<tr>
				          				 		<td> <label for="inputEmail1" class="col-lg-12 control-label strong"> Pagibig  :</label> </td><td></td>
				          				 		<td class="price-symbolc"><label for="inputEmail1" class="col-lg-12 control-label strong"> 
				          				 		<input type="readonly" class="form-control" value="0.00" /> </label></td><td></td>
				          				 	</tr>
				          				 	<tr>
				          				 		<td> <label for="inputEmail1" class="col-lg-12 control-label strong"> WTAX  :</label> </td><td></td>
				          				 		<td class="price-symbolc"><label for="inputEmail1" class="col-lg-12 control-label strong"> 
				          				 		<input type="readonly" class="form-control" value="0.00" /> </label></td><td></td>
				          				 	</tr>
				          				 </table>
			          				 </div>
			          				 </div>
			          				 <div class="row">
			          				 <div class="col-lg-6">	
										<header class="main-box-header clearfix">
										<h2>Date</h2>
										</header>
				          				<table class="table table-striped table-hover">
				          				 	<tr>
				          				 		<td> <label for="inputEmail1" class="col-lg-12 control-label strong"> Date :</label> </td><td></td>
												<td>
				          				 			<label for="inputEmail1" class="col-lg-12 control-label strong">
				          				 			<input type="readonly" class="form-control datepick" id="month-pay"/> 
				          				 			</label>
				          				 		</td>
				          				 		<td></td>
				          				 	</tr>
				          				 	<tr>
				          				 	<td> <label for="inputEmail1" class="col-lg-12 control-label strong"> From :</label> </td><td></td>
												<td>
				          				 			<label for="inputEmail1" class="col-lg-12 control-label strong date-range">
				          				 				 <div class="radio">
                                                                    <input type="radio" id="checkbox-first-half" class="input" value="1:15" checked name="date_from">
                                                                    <label for="checkbox-first-half"> 1 - 15 </label>
                                                          </div>
                                                          <div class="radio">
                                                                    <input type="radio" id="checkbox-second-half" class="input" value="16:31" name="date_from">
                                                                    <label for="checkbox-second-half"> 16 - 31 </label>
                                                          </div>
				          				 			</label>
				          				 		</td>
				          				 		<td>
				          				 	</td>
				          				 	</tr>
				          				 
				          				 	
				          				 </table>
			          				 </div>

			          				 <div class="col-lg-6">	
			          				 	<div id="days_work">
			          				 	</div>
										
			          				 </div>


			          				 <div class="row">
			          				 	<div class="col-lg-12">	
											<button class="btn btn-success"> Generate</button>
											<br>
											<div class="clearfix"></div>
											<br><br>
				          				<table class="table table-striped table-hover">
				          				 	<tr>
				          				 		<td> <label for="inputEmail1" class="col-lg-12 control-label strong"> Total Hours :</label> </td><td></td>
				          				 		<td class="price-symbolc"><label for="inputEmail1" class="col-lg-12 control-label strong"> 
				          				 		<input type="readonly" class="form-control" value="600 hrs" /> </label></td><td></td>
				          				 	</tr>
				          				 
				          				 	
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
<?php echo $this->element('modals/personnal_attendance'); ?>

<?php echo $this->element('modals/time_in_attendance'); ?>
