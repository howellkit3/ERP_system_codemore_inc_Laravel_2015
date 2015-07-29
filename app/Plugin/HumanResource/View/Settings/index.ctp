<?php $this->Html->addCrumb('Settings', array('controller' => 'settings', 'action' => 'index')); ?>
<?php echo $this->element('hr_options');
	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'department';

 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<ul class="nav nav-tabs">
					<li class="<?php echo ($active_tab == 'department') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Department',array(
									'controller' => 'settings',
									'action' => 'index',
									'tab' => 'department',
									'plugin' => 'human_resource'
						)); ?>
					</li>

					<li class="<?php echo ($active_tab == 'position') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Position',array(
									'controller' => 'settings',
									'action' => 'index',
									'tab' => 'position',
									'plugin' => 'human_resource'
						)); ?>
					</li>
				</ul>
				<div class="main-box-body clearfix">
					<div class="tabs-wrapper">
						<div class="tab-content">
							<div class="tab-pane <?php echo ($active_tab == 'department') ? 'active' : '' ?>" id="tab-department">
								<header class="main-box-header clearfix">
					                <h2 class="pull-left"><b>Department List</b></h2>
					                <div class="filter-block pull-right">
					                 <div class="form-group pull-left">
					                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
					                            <input placeholder="Search..." class="form-control searchDepartment"  />
					                            <i class="fa fa-search search-icon"></i>
					                         <?php //echo $this->Form->end(); ?>
					                    </div>
					                   <?php
					                   
					                      echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Department', 
					                            array('controller' => 'settings', 
					                                    'action' => 'department',),
					                            array('class' =>'btn btn-primary pull-right',
					                                'escape' => false));

					                    ?> 
					                  
					                   <br><br>
					               </div>
					            </header>
					            <div class="main-box-body clearfix">
								    <div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><a href="#"><span>#</span></a></th>
													<th><a href="#"><span>Name</span></a></th>
													<th class="text-center"><a href="#"><span>Description</span></a></th>
													<th class="text-center"><a href="#"><span>Specification</span></a></th>
													<th class="text-center"><a href="#"><span>Notes</span></a></th>
													<th><a href="#"><span>Actions</span></a></th>
												</tr>
											</thead>

											<?php 
										        if(!empty($departmentData)){
										            foreach ($departmentData as $key => $departmentList): $key++ ?>
														<tbody aria-relevant="all" aria-live="polite" role="alert">
															<tr class="">
																<td class="">
										                            <?php echo $key;?> 
										                        </td>
																<td class="">
										                            <?php echo ucfirst($departmentList['Department']['name']);  ?>
										                        </td>
										                        
										                        <td class="text-center">
										                           <?php echo ucfirst($departmentList['Department']['description']);  ?>
										                        </td>

										                         <td class="text-center">
										                          <?php echo ucfirst($departmentList['Department']['specification']);  ?>
										                        </td>

										                        <td class="text-center">
										                           <?php echo !empty($departmentList['Department']['notes']) ? $departmentList['Department']['notes'] : '';  ?>
										                        </td>

										                       	<td>
										                            <?php 
										                            echo $this->Html->link('<span class="fa-stack">
													                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'settings', 'action' => 'view_department',$departmentList['Department']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
													                    ));

										                            ?>

																<?php
																echo $this->Html->link('<span class="fa-stack">
																<i class="fa fa-square fa-stack-2x"></i>
																<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
																</span> ', array('controller' => 'settings', 'action' => 'edit_department',$departmentList['Department']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Department'));


																echo $this->Form->postLink('<span class="fa-stack">
																<i class="fa fa-square fa-stack-2x"></i>
																<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
																</span>', array(
																		'controller' => 'settings',
																		'action' => 'delete_department',
																		'plugin' => 'human_resource',
																		$departmentList['Department']['id']),
												                                array('escape' => false,'class'=> 'table-link'), 
												                                __('Are you sure you want to delete %s?', 
												                                $departmentList['Department']['name'])
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
							<div class="tab-pane <?php echo ($active_tab == 'position') ? 'active' : '' ?>" id="tab-position">
								<header class="main-box-header clearfix">
					                <h2 class="pull-left"><b>Positions</b></h2>
					                <div class="filter-block pull-right">
					                 <div class="form-group pull-left">
					                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
					                            <input placeholder="Search..." class="form-control searchCustomer"  />
					                            <i class="fa fa-search search-icon"></i>
					                         <?php //echo $this->Form->end(); ?>
					                    </div>
					                   <?php
					                   		echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Position', 
					                            array('controller' => 'settings', 
					                                    'action' => 'position',),
					                            array('class' =>'btn btn-primary pull-right',
					                                'escape' => false));

					                    ?> 
					                  <br><br>
					               </div>
					            </header>
					            <div class="main-box-body clearfix">
								    <div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><a href="#"><span>#</span></a></th>
													<th><a href="#"><span>Name</span></a></th>
													<th class="text-center"><a href="#"><span>Description</span></a></th>
													<th class="text-center"><a href="#"><span>Specification</span></a></th>
													<th class="text-center"><a href="#"><span>Notes</span></a></th>
													<th><a href="#"><span>Actions</span></a></th>
												</tr>
											</thead>
											  <?php if(!empty($positionData)) {
										            foreach ($positionData as $key => $positionList): $key++ ?>
															<tbody aria-relevant="all" aria-live="polite" role="alert">
																<tr class="">
																	<td class="">
											                            <?php echo $key;?> 
											                        </td>
																	<td class="">
											                            <?php echo ucfirst($positionList['Position']['name']);  ?>
											                        </td>
											                        
											                        <td class="text-center">
											                           <?php echo ucfirst($positionList['Position']['description']);  ?>
											                        </td>

											                         <td class="text-center">
											                          <?php echo ucfirst($positionList['Position']['specification']);  ?>
											                        </td>

											                        <td class="text-center">
											                           <?php echo !empty($positionList['Position']['notes']) ? $positionList['Position']['notes'] : '';  ?>
											                        </td>

											                       	<td>
											                            <?php 
											                            echo $this->Html->link('<span class="fa-stack">
														                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'settings', 'action' => 'view_position',$positionList['Position']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Position'
														                    ));

											                            ?>

																	<?php
																	echo $this->Html->link('<span class="fa-stack">
																	<i class="fa fa-square fa-stack-2x"></i>
																	<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
																	</span> ', array('controller' => 'settings', 'action' => 'edit_position',$positionList['Position']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Position'));


																	echo $this->Form->postLink('<span class="fa-stack">
																	<i class="fa fa-square fa-stack-2x"></i>
																	<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
																	</span>', array(
																			'controller' => 'settings',
																			'action' => 'delete_position',
																			'plugin' => 'human_resource',
																			$positionList['Position']['id']),
													                                array('escape' => false,'class'=> 'table-link'), 
													                                __('Are you sure you want to delete %s?', 
													                                $positionList['Position']['name'])
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