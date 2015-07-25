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
											<th><a href="#"><span>Actions</span></a></th>
										</tr>
									</thead>

									<?php 
								        if(!empty($employees)){
								            foreach ($employees as $key => $employee): ?>
												<tbody aria-relevant="all" aria-live="polite" role="alert">
													<tr class="text-left">
														<td class="">
								                            <?php echo $employee['Employee']['code'];?> 
								                        </td>
														<td class="employee">
								                            <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
								                        </td>
								                        
								                        <td class="text-center">
								                           <?php echo !empty($departments[$employee['Employee']['department_id']]) ? $departments[$employee['Employee']['department_id']] : '';  ?>
								                        </td>

								                         <td class="text-center">
								                           <?php echo !empty($positions[$employee['Employee']['position_id']]) ? $positions[$employee['Employee']['position_id']] : '';  ?>
								                        </td>

								                       	<td>
								                        <?php 

								                        // echo $this->Html->link('<span class="fa-stack">
											                     // <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'employees', 'action' => 'view',$employee['Employee']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
											                     // ));

														// echo $this->Html->link('<span class="fa-stack">
														// <i class="fa fa-square fa-stack-2x"></i>
														// <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
														// </span> ', array('controller' => 'employees', 'action' => 'edit',$employee['Employee']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));


														?>
														<button class="btn btn-success employee_select" data-dismiss="modal" data-id="<?php echo $employee['Employee']['id'] ?>" > Select </button>
								                        </td>
								                    </tr>

								                </tbody>
								        <?php  endforeach;
								         } ?> 
								
								</table>	

								<hr>
     </div>    
  </div>
    <div class="paging" id="item_type_pagination">
            <?php
           
            echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable','model' => 'ClientOrder'));
            echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Employee'), array('paginate' => 'Employee'));
            echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable'));

            ?>
    </div>