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
								<button href="#" id="computeSalaries" data-url="" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Generate </button>
							
			               </div>
			               </div>

			            </header>
			            <?php $this->Form->end(); ?>

			          <div class="main-box-body clearfix">
			            	<div id="result-table">
			            		
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

<div class="modal fade" id="myAttendance" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Attendance </h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('Attendance',array('url'=>(array('controller' => 'attendances','action' => 'export')),'class' => 'form-horizontal'));?>

                	<div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Select Department</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('Attendance.department_id', array(
                                                                'type' => 'select',
                                                                'label' => false,
                                                                'class' => 'form-control',
                                                                'empty' => '---Select Employee---',
                                                                'options' => array($departmentList)

                                                              ));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Select Employee</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('Attendance.employee_id', array(
                                                                'type' => 'select',
                                                                'label' => false,
                                                                'class' => 'form-control ',
                                                                'empty' => '---Select Employee---',
                                                                'options' => array($employeeList)

                                                              ));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Date</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('Attendance.from_date', array(
                                                                'label' => false,
                                                                'class' => 'form-control  datepick',
                                                                'placeholder' => 'Date from'

                                                              ));
                            ?>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Date Range</label>

                       <div class="col-lg-6">
                            <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input  placeholder="Date Range" name="from_date" data="1" type="text" class="form-control required myDateRange datepickerDateRange high-z-index" id="datepickerDateRange" >
                                                </div>
                        </div>

                       
                    </div> -->

                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>  
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

</script>