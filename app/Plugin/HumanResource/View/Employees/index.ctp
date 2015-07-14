<?php echo $this->element('hr_options'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">

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
					                            <?php echo rand(0,100); //$employee['Employee']['code'];?> 
					                        </td>

					                        <td class="">
					                            <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
					                        </td>
					                        
					                        <td class="text-center">
					                           <?php echo !empty($departments[$employee['Employee']['department_id']]) ? $departments[$employee['Employee']['department_id']] : '';  ?>
					                        </td>

					                         <td class="text-center">
					                           <?php echo !empty($positions[$employee['Employee']['position_id']]) ? $positions[$employee['Employee']['position_id']] : '';  ?>
					                        </td>

					                        <td class="text-center">
					                           <?php echo !empty($employee['Employee']['status']) ? $employee['Employee']['status'] : '';  ?>
					                        </td>

					                        <td class="text-center">
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
				</div>
			</div>
	    </div>
    </div>
</div>
