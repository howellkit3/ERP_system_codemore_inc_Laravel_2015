<?php echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'timepicker'
)); 
	echo $this->Html->script(array(
					'jquery.maskedinput.min',
					'HumanResource.custom',
                    'HumanResource.select2.min',
                    'HumanResource.moment',
                    'HumanResource.attendance',

)); 

 	echo $this->element('hr_options');

	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    	<?php echo $this->element('tab/attendances',array('active_tab' => $active_tab)); ?>
		<div class="main-box-body clearfix">
		 
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-calendar">

						<header class="main-box-header clearfix">

			                <h2 class="pull-left"><b>Sign I/O records</b> </h2>
			                <div class="clearfix"></div>
							<br>
			              
			                <div class="filter-block pull-left">
			              	
			              	 <?php echo $this->Form->create('Attendance',array('controller' => 'attendances','action' => 'timekeep', 'type'=> 'get')); ?>
			                 	<div class="form-group pull-left">
			                 		<input type="text" name="date" id="changeDate" class="form-control datepick" value="<?php echo $date ?>">
									<i class="fa fa fa-calendar calendar-icon"></i>
								</div>
			                    <div class="form-group pull-left">
			                 		 <input placeholder="Search..." class="form-control searchCustomer" value="<?php echo $search ?>" name="name" />
			                            <i class="fa fa-search search-icon"></i>
								</div>
			                    <div class="form-group pull-left">
			                    	 <button type="submit" class="btn btn-success">Go</button> 
			                    </div>
			                    <?php echo $this->Form->end(); ?>
			               
			                   <br><br>

			               </div>

			                 <div class="filter-block pull-right">

			                	 <button class="btn btn-primary pull-right add-timekeep" onclick="updateTime('.time_input')" data-toggle="modal" href="#timeKeep"> <i class="fa fa-pencil-square-o fa-lg"></i> Add </button>
			                </div>
			                <div class="filter-block pull-right">

			                <a data-toggle="modal" href="#myToolReport" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>
			                </div>
			                 <div class="filter-block pull-right">
			                 &nbsp
			                 </div>
			            </header>

			            <div class="main-box-body clearfix">
			            		 <div class="table-responsive">
								<table class="table table-striped table-hover">
									
									<thead>
										<tr>
											<th><a href="#"><span>Time</span></a></th>
											<th><a href="#"><span>Code</span></a></th>
											<th><a href="#"><span>Employee Name</span></a></th>
											<th><a href="#"><span>Type</span></a></th>
											<th><a href="#"><span>Actions</span></a></th>
										</tr>
									</thead>

									<?php if(!empty($timekeeps)){
								            foreach ($timekeeps as $key => $timekeep): ?>
												<tbody aria-relevant="all" aria-live="polite" role="alert">
													<tr class="">
													
														
														<td> 
								                           <?php echo date('Y/m/d h:i:a',strtotime($timekeep['Timekeep']['date'].' '.$timekeep['Timekeep']['time']));
								                           ?> 
								                        </td>
								                        	<td > 
								                           <?php echo $timekeep['Employee']['code'] ?> 
								                        </td>
								                        <td class="">
								                          <?php 
								                          		echo $this->CustomText->getFullname($timekeep['Employee']);

								                        
								                           ?>
								                        </td>

								                        <td>
								                           <?php echo ucwords($timekeep['Timekeep']['type']); ?> 
								                        </td>
								                       	<td>
								                      	<?php
														
														echo $this->Form->postLink('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
														</span>', array(
																'controller' => 'timekeeps',
																'action' => 'delete',
																'plugin' => 'human_resource',
																$timekeep['Timekeep']['id']),
										                                array('escape' => false), 
										                                __('Are you sure you want to delete %s?', 
										                                $timekeep['Timekeep']['id'])
										 						); 


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
<?php echo $this->element('modals/attendance'); ?>