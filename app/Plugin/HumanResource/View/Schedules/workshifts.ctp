<?php 
 echo $this->Html->css(array( 'HumanResource.default' ));



$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';

if (!empty($userData['User']['in_charge']) && $userData['User']['in_charge'] == 1) {

echo $this->element('in_charge_option'); 

$incharge = true;
} else {
$incharge = false;
echo $this->element('hr_options'); 
} 


?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/schedules',array('active_tab' => $active_tab)); ?>
		<div class="main-box-body clearfix">
		 
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-calendar">
						<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>WorkShifts</b> </h2>
			                <div class="filter-block pull-right">
			                 <div class="form-group pull-left">
			                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
			                            <input placeholder="Search..." class="form-control searchCustomer"  />
			                            <i class="fa fa-search search-icon"></i>
			                         <?php //echo $this->Form->end(); ?>
			                    </div>
			                     <?php
			                   		

			                   		echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add', 
			                            array('controller' => 'workshifts', 
			                                    'action' => 'add'),
			                            array('class' =>'btn btn-primary',
			                                'escape' => false));

			                   		echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> Export', 
				                            array('controller' => 'workshifts', 
				                                    'action' => 'export',),
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
											<th><a href="#"><span>Name</span></a></th>
											<th class="text-center"><a href="#"><span>From</span></a></th>
											<th class="text-center"><a href="#"><span>To</span></a></th>
											<th><a href="#"><span>Actions</span></a></th>
										</tr>
									</thead>

									<?php 
								        if(!empty($workshifts)){
								            foreach ($workshifts as $key => $workshift): ?>
												<tbody aria-relevant="all" aria-live="polite" role="alert">
													<tr class="">

														<td class="">
								                           <?php echo $workshift['WorkShift']['name']; ?>
								                        </td>
														<td class="text-center">
								                            <?php echo date('H:i: a',strtotime($workshift['WorkShift']['from'])); ?> 
								                        </td>

								                        <td class="text-center">
								                           <?php echo date('H:i a',strtotime($workshift['WorkShift']['to'])); ?> 
								                        </td>


								                       	<td>
								                      
														<?php
														echo $this->Html->link('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
														</span> ', array('controller' => 'workshifts', 'action' => 'edit',$workshift['WorkShift']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));

													
														 	echo $this->Form->postLink('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
														</span> ', array('controller' => 'workshifts', 'action' => 'delete',$workshift['WorkShift']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'),
															 array('escape' => false), 
										                                __('Are you sure you want to delete %s?', 
										                                $workshift['WorkShift']['id'])
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
								echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
								echo $this->Paginator->numbers(array('separator' => ''));
								echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
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
