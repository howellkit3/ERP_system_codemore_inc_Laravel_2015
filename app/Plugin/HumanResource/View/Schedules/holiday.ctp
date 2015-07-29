<?php 
 echo $this->Html->css(array(
                        'HumanResource.default',
                        'HumanResource.fullcalendar/fullcalendar',
                           ));

echo $this->Html->script(array(

                        'HumanResource.fullcalendar/lib/moment.min.js',
                        'HumanResource.fullcalendar/fullcalendar.js'
));

	echo $this->element('hr_options');

	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : 'tab-employee';
 ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/schedules',array('active_tab' => $active_tab)); ?>
		<div class="main-box-body clearfix">
		 
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane fade <?php echo ($active_tab == 'holiday' || $this->params['action'] == 'holiday') ? 'in active' : '' ?>" id="holiday">
						<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Holiday List <?php echo date('Y'); ?></b> </h2>
			                <div class="filter-block pull-right">
			                 <div class="form-group pull-left">
			                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
			                            <input placeholder="Search..." class="form-control searchCustomer"  />
			                            <i class="fa fa-search search-icon"></i>
			                         <?php //echo $this->Form->end(); ?>
			                    </div>
			                     <?php
			                   		
			                   		$links = array('controller' => 'schedules', 'action' => 'holiday');

			                   		if (empty($this->request->params['named']['calendar'])) {
			                   			$calendar = "Calendar";
			                   			$links  = array_merge($links,array('calendar' => true));
			                   		}  else {
			                   			$calendar = "List";
			                   		}
			                   		
			                      echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> View on '.$calendar, 
			                           $links ,
			                            array('class' =>'btn btn-primary pull-right',
			                                'escape' => false));
			                   
			                      echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add', 
			                            array('controller' => 'holidays', 
			                                    'action' => 'add',),
			                            array('class' =>'btn btn-primary pull-right',
			                                'escape' => false));

			                    ?> 
			                  
			                   <br><br>
			               </div>
			            </header>

			            <div class="main-box-body clearfix">

			            	<?php if (empty($this->request->params['named']['calendar'])) : ?>
						    <div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th><a href="#"><span>Date</span></a></th>
											<th><a href="#"><span>Name</span></a></th>
											<th class="text-center"><a href="#"><span>Type</span></a></th>
											<th class="text-center"><a href="#"><span>Year</span></a></th>
											<th><a href="#"><span>Actions</span></a></th>
										</tr>
									</thead>

									<?php 
								        if(!empty($holidays)){
								            foreach ($holidays as $key => $holiday): ?>
												<tbody aria-relevant="all" aria-live="polite" role="alert">
													<tr class="">
														<td class="">
								                            <?php echo date('Y/m/d',strtotime($holiday['Holiday']['start_date'])); ?> 
								                        </td>
														<td class="">
								                           <?php echo $holiday['Holiday']['name']; ?>
								                        </td>

								                        <td class="text-center">
								                            <?php echo $holiday['Holiday']['type']; ?>
								                        </td>

								                        <td class="text-center">
								                           <?php echo $holiday['Holiday']['year']; ?>
								                        </td>


								                       	<td>
								                            <?php echo $this->Html->link('<span class="fa-stack">
											                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'holidays', 'action' => 'view',$holiday['Holiday']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
											                    ));

								                            ?>

														<?php
														echo $this->Html->link('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
														</span> ', array('controller' => 'holidays', 'action' => 'edit',$holiday['Holiday']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
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
							  <?php endif; ?> 
							  <?php if (!empty($this->request->params['named']['calendar'])) : ?>
			                      <div id="calendar"></div>
			                  <?php endif; ?>
						</div>
					</div>		
	            </div>
			</div>
		</div>	

	    </div>
    </div>
</div>

<script>
var dateSelected = '<?php echo date("Y-m-d"); ?>';
var eventName = 'Now';

jQuery(document).ready(function($){

<?php  if(!empty($list)) : ?>
	  $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: dateSelected,
            businessHours: true, // display business hours
            editable: true,
            events:  [ 
            		<?php echo $list; ?>
				]
        });

<?php endif; ?>
          


});

 </script>