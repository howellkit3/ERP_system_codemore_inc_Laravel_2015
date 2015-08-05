<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom'
)); ?>
<?php echo $this->element('hr_options');
	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-employee';
 ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<ul class="nav nav-tabs">
					<li class="<?php echo ($active_tab == 'tab-employee') ? 'active' : '' ?>" alt="tab-category"><a href="#tab-employee" data-toggle="tab">Employee</a></li>
					<li class="<?php echo ($active_tab == 'tab-tooling') ? 'active' : '' ?>" alt="tab-type"><a href="#tab-tooling" id = 'itemType' data-toggle="tab">Tooling</a></li> 
				</ul>
		<div class="main-box-body clearfix">
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane fade  <?php echo ($active_tab == 'tab-employee') ? 'in active' : '' ?>" id="tab-employee">
						<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Employee List</b></h2>
			                <div class="filter-block pull-right">
			                 <div class="form-group pull-left">
			                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
			                            <input placeholder="Search..." class="form-control searchCustomer"  />
			                            <i class="fa fa-search search-icon"></i>
			                         <?php //echo $this->Form->end(); ?>
			                    </div>
			                   <?php
			                   
			                      echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Employee', 
			                            array('controller' => 'employees', 
			                                    'action' => 'add',),
			                            array('class' =>'btn btn-primary',
			                                'escape' => false)); ?>
      
			                       <a data-toggle="modal" href="#myEmployeeReport" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>

			                   <br><br>
			               </div>
			            </header>
			            <div class="main-box-body clearfix">
						    <div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th><a href="#"><span>Code</span></a></th>
			                                <!-- <th><a href="#"><span>Statement of Account No.</span></a></th> -->
											<th><a href="#"><span>Name</span></a></th>
											<th class="text-center"><a href="#"><span>Department</span></a></th>
											<th class="text-center"><a href="#"><span>Position</span></a></th>
											<th class="text-center"><a href="#"><span>Status</span></a></th>
											<th class="text-center"><a href="#"><span>Gender</span></a></th>
											<th><a href="#"><span>Actions</span></a></th>
										</tr>
									</thead>

									<?php 
								        if(!empty($employees)){
								            foreach ($employees as $key => $employee): ?>
												<tbody aria-relevant="all" aria-live="polite" role="alert">
													<tr class="">
														<td class="">
								                            <?php echo $employee['Employee']['code'];?> 
								                        </td>
														<td class="">
								                            <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
								                        </td>
								                        
								                        <td class="text-center">
								                           <?php echo !empty($employee['Department']['name']) ? $employee['Department']['name'] : '';  ?>
								                        </td>

								                         <td class="text-center">
								                           <?php echo !empty($employee['Position']['name']) ? $employee['Position']['name'] : '';  ?>
								                        </td>

								                        <td class="text-center">


								                           <?php echo !empty($employee['Employee']['status']) ? ' <span class="label label-success">'.ucwords($employee['Status']['name']).'</span>'  : '';  ?>
								                        </td>

								                        <td>
								                           <?php echo !empty($employee['Employee']['gender']) ? $employee['Employee']['gender'] : '';  ?>
								                        </td>

								                       	<td>
								                            <?php echo $this->Html->link('<span class="fa-stack">
											                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'employees', 'action' => 'view',$employee['Employee']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
											                    ));

								                            ?>

														<?php
														echo $this->Html->link('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
														</span> ', array('controller' => 'employees', 'action' => 'edit',$employee['Employee']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
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
					<div class="tab-pane fade  <?php echo ($active_tab == 'tab-tooling') ? 'in active' : '' ?>" id="tab-tooling">
						<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Toolings</b></h2>
			                <div class="filter-block pull-right">
			                 <div class="form-group pull-left">
			                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
			                            <input placeholder="Search..." class="form-control searchCustomer"  />
			                            <i class="fa fa-search search-icon"></i>
			                         <?php //echo $this->Form->end(); ?>
			                    </div>
			                   <?php
			                   		echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Assign Tools', 
			                            array('controller' => 'toolings', 
			                                    'action' => 'assign',),
			                            array('class' =>'btn btn-primary',
			                                'escape' => false));

			                    ?> 

			                    <a data-toggle="modal" href="#myToolReport" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>

			                  <br><br>
			               </div>
			            </header>
			            <div class="main-box-body clearfix">
						    <div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th><a href="#"><span>Employee Name</span></a></th>
											<th class="text-center"><a href="#"><span>Tools</span></a></th>
											<th class="text-center"><a href="#"><span>Quantity</span></a></th>
											<th class="text-center"><a href="#"><span>Price</span></a></th>
											<th class="text-center"><a href="#"><span>Pay</span></a></th>
											<th class="text-center"><a href="#"><span>Status</span></a></th>
											<th><a href="#"><span>Actions</span></a></th>
										</tr>
									</thead>
									  <?php if(!empty($toolings)) {
								            foreach ($toolings as $key => $tooling): ?>
													<tbody aria-relevant="all" aria-live="polite" role="alert">
														<tr class="">
														<td class="">
								                            <?php echo ucfirst($tooling['Employee']['first_name'])?>
								                            <?php echo ucfirst($tooling['Employee']['last_name'])?>
								                            <?php echo ucfirst($tooling['Employee']['suffix'])?>
								                        </td>
								                        
								                        <td class="text-center">
								                        	<?php echo ucfirst($toolList[$tooling['Tooling']['tools_id']]); ?>
								                        </td>

								                        <td class="text-center">
								                           <?php echo $tooling['Tooling']['quantity']; ?>
								                        </td>

								                        <td class="text-center">
								                         <?php echo $tooling['Tooling']['price']; ?>
								                        </td>

								                        <td class="text-center">
								                         <?php echo $tooling['Tooling']['pay']; ?>
								                        </td>

								                        <td class="text-center">
								                         <?php echo $tooling['Tooling']['status']; ?>
								                        </td>

								                       	<td>
								                         <?php echo $this->Html->link('<span class="fa-stack">
											                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'toolings', 'action' => 'view',$tooling['Tooling']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
											                    ));

								                           
														echo $this->Html->link('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
														</span> ', array('controller' => 'toolings', 'action' => 'edit',$tooling['Tooling']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
														?>
								                        </td>
								                    </tr>

								                </tbody>
								        <?php 
								            endforeach; 
								        } ?>  
								
								</table>	

								<hr>

			                   <!--  <div class="paging" id="item_type_pagination">
			                            <?php
			                           
			                            echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable','model' => 'ClientOrder'));
			                            echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Employee'), array('paginate' => 'Employee'));
			                            echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable'));

			                            ?>
			                    </div> -->

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





