<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom'
)); ?>
<?php echo $this->element('hr_options');
	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-employee';
 ?>

 <?php 
echo $this->Html->css('HumanResource.default');
 
echo $this->Html->css(array(
                    'HumanResource.select2.css',
                    //'timepicker'
)); 
 echo $this->Html->script(array(
                    //'jquery.maskedinput.min',
                    'HumanResource.select2.min',
                    'HumanResource.employee',

)); 

$page = !empty($this->params['named']['page']) ? $this->params['named']['page'] : '';

 ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<ul class="nav nav-tabs">
					<li class="<?php echo ($active_tab == 'tab-employee') ? 'active' : '' ?>" alt="tab-category"><a href="#tab-employee" data-toggle="tab">Employee</a></li>
				</ul>
		<div class="main-box-body clearfix">
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane fade  <?php echo ($active_tab == 'tab-employee') ? 'in active' : '' ?>" id="tab-employee">
						<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Employee Contract</b></h2>

			               <div class="clearfix"></div>
			                <div class="filter-block pull-right">

			                <!-- 		<div class="form-group pull-left search-dropdown">
			                 		<?php 
			                 			echo $this->Form->input('profile',array(
					                 		'options' => array(
					                 			'profile' => 'With Profile',
					                 			'no_profile' => 'No Profile Pic'
					                 		),
					                 		'class' => 'select-profile-view autocomplete',
					                 		'label' => false,
					                 		'div'  => false,
					                 		//'default' => $department,
					                 		'empty'=> '-- Select --'

					                 		)); 

					                ?>
			                    </div>


			                	<div class="form-group pull-left search-dropdown">
			                 		<?php 
			                 			echo $this->Form->input('department_id',array(
					                 		'options' => $departments,
					                 		'class' => 'select-department-view autocomplete end_contract',
					                 		'label' => false,
					                 		'div'  => false,
					                 		//'default' => $department,
					                 		'empty'=> '-- Select Department --'

					                 		)); 

					                ?>
			                    </div> -->
			                    <div class="form-group pull-left search-dropdown">
			                 		<?php 
			                 			echo $this->Form->input('status_id',array(
					                 		'options' => $statusList,
					                 		'class' => ' select-status-view autocomplete end_contract',
					                 		'label' => false,
					                 		'div'  => false,
					                 		//'default' => 1,
					                 		'empty'=> '-- Select Status --'

					                 		)); 
										?>
			                    </div>
			                 	<div class="form-group pull-left">
			                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
			                            <input placeholder="Search..." class="form-control searchEmployee end_contract"  />
			                            <i class="fa fa-search search-icon"></i>
			                         <?php //echo $this->Form->end(); ?>
			                    </div>

			                   <!--  <div class="form-group pull-right search-dropdown1">
	      							<?php echo $this->Form->create('Employee',array('controller' => 'employees','action' => 'print_employee')); ?>
			                            <input type="hidden" name="department" value="" class="form-control departmentHidden"  />
			                            <input type="hidden" name="status" value="" class="form-control statusHidden"  />
			                            <input type="hidden" name="input_search" value="" class="form-control searchHidden"  />

			                            <input type="hidden" name="profile" value="" class="form-control profileHidden"  />

			                            <button type="submit" class="btn btn-success pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</button>
			                         <?php echo $this->Form->end(); ?>
			                    </div> -->

			                     <!-- <a data-toggle="modal" href="#myEmployeeReport" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>
 -->
			                   <br><br>
			               </div>
			            </header>
			            <div class="main-box-body clearfix">
						    <div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th><a href="#"><span> &nbsp </span></a></th>
											<th><a href="#"><span>Code</span></a></th>
			                                <!-- <th><a href="#"><span>Statement of Account No.</span></a></th> -->
											<th><a href="#"><span>Name</span></a></th>
											<th class="text-left"><a href="#"><span>Date Hired</span></a></th>
											<th class="text-left"><a href="#"><span>End Contract</span></a></th>

											<th class="text-left"><a href="#"><span>Contract</span></a></th>

											<th class="text-left"><a href="#"><span>Status</span></a></th>
											<th><a href="#"><span>Actions</span></a></th>
										</tr>
									</thead>

									<tbody aria-relevant="all" aria-live="polite" role="alert" class="append-table-department" style="display:none;">
										<!-- append by department -->
									</tbody>

									<?php 
								        if(!empty($employees)){
								            foreach ($employees as $key => $employee): ?>
												<tbody aria-relevant="all" aria-live="polite" role="alert" class="default-table">
													<tr class="">
														<td class="">
														<?php
														$style = '';
															$serverPath = $this->Html->url('/',true);	
														if (!empty($employee['Employee']['image'])) {

													
														$background =  $serverPath.'img/uploads/employee/'.$employee['Employee']['image'].'?d='.rand(0,1000).time();	
														} else {

															$background =  $serverPath.'img/default-profile.png';	
														}

														?>
															<img src="<?php echo $background; ?>" width="35" height="35" />
								                        </td>

														<td class="">
								                            <?php echo $employee['Employee']['code'];?> 
								                        </td>
														<td class="">
								                            <?php echo $employee['Employee']['fullname'];  ?>
								                        </td>
								                        <td class="">
								                            <?php echo !empty($employee['date_hired']) ? date('Y-m-d',strtotime($employee['date_hired']))  : '' ?>
								                        </td>
								                        <td class="">
								                           <?php 

								                           		if (!empty($employee['Employee']['date_resigned'])) {

								                           			echo date('Y-m-d',strtotime($employee['Employee']['date_resigned']));

								                           		} else if(!empty($employee['end_contract'])) {

								                           			echo date('Y-m-d',strtotime($employee['end_contract']));

								                           		} else {

								                           		}

								                            ?>
								                        </td>
								                        <td class="text-center">
															<?php 

															$status = $employee['Status']['name'] == 'Resigned' ? 'label-danger' : 'label-success';

															echo !empty($employee['Employee']['status']) ? ' <span class="label '.$status.' ">'.ucwords($employee['Status']['name']).'</span>'  : '';  ?>
								                        </td>
								                          <td class="">
								                           <?php 

															//$status = $employee['Contract']['name'] == 'Resigned' ? 'label-danger' : 'label-success';

															echo !empty($employee['Contract']['name']) ? ' <span class="label label-success">'.ucwords($employee['Contract']['name']).'</span>'  : '';  ?>
								                        </td>
								                        
								                  
								                       	<td>
								                            <?php 

								                            if (!empty($this->params['named']['page'])) {
								                            	$view_url = array('controller' => 'employees', 'action' => 'view',$employee['Employee']['id'
											                    	],
											                    	'page' => $page .'?'.rand(1000,9999).'='.date("is")
											                    	);
								                            	$edit_url = array('controller' => 'employees', 'action' => 'edit',$employee['Employee']['id'],'page' => $page.'?'.rand(1000,9999).'='.date("is")
								                            	);
								                            } else {
								                            	$view_url = array('controller' => 'employees', 'action' => 'view',$employee['Employee']['id'
											                    	].'?'.rand(1000,9999).'='.date("is")
											                    );
								                            	$edit_url = array('controller' => 'employees', 'action' => 'edit',$employee['Employee']['id'].'?'.rand(1000,9999).'='.date("is")
								                            		);

								                            }

								                         echo $this->Html->link('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
														</span> ','#changeStatus',array(
															'class' =>' table-link edit_contract',
															'escape' => false,
															'title' => 'Edit Information',
															'data-toggle' => 'modal',
															'data-id' => $employee['Employee']['id']
															));

			                                           echo $this->Html->link('<span class="fa-stack">
			                                            <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'contracts', 'action' => 'view',$employee['Employee']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Contract'
			                                            ));
			                      
														?>
													</td>
								                   </tr>

								                </tbody>
								        <?php 
								            endforeach; 
								        } ?> 
								
								</table>	

								<hr>

			                    <div class="paging" id="item_type_pagination">
			                            <?php
			                           
			                            echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable','model' => 'ClientOrder'));
			                            echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Employee'), array('paginate' => 'Employee'));
			                            echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable'));

			                            ?>
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

<?php echo $this->element('modals'); ?>

<style type="text/css">
	.search-dropdown1 {
		min-width: 105px !important;
	}
	
</style>





