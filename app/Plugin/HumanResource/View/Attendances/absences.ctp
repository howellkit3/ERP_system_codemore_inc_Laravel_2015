<?php 
 echo $this->Html->css(array(
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
			                <h2 class="pull-left"><b>Absences Record</b> </h2>
			                <div class="filter-block pull-right">
			                 <div class="form-group pull-left">
			                 	<?php echo $this->Form->create('Attendance',array('controller' => 'attendances','action' => 'absences', 'type'=> 'get')); ?>
			                 		<input type="text" name="date" id="changeDate" class="form-control datepick" value="<?php echo $date ?>">

			                            <i class="fa fa fa-calendar calendar-icon"></i>

			                 		
			                    </div>
			                    <div class="form-group pull-left">
			                 		 <input placeholder="Search..." class="form-control searchCustomer" value="<?php echo $search ?>" name="name" />
			                            <i class="fa fa-search search-icon"></i>

			                           
			                         
			                    </div>
			                     <div class="form-group pull-left">
			                    	 <button class="btn btn-success">Go</button> 
			                     </div>
			                    <?php echo $this->Form->end(); ?>
								<div class="form-group pull-left">
								<?php

									echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Absence', 
			                            array('controller' => 'absences', 
			                                  'action' => 'add'),
				                           array('class' =>'btn btn-primary pull-right',
				                                'escape' => false)); 
									?>
										
			                	</div>

			                	<a data-toggle="modal" href="#absencesReport" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>
			                   <br><br>
			               </div>
			            </header>

			          <div class="main-box-body clearfix">
			            	<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th><a href="#"><span>Code</span></a></th>
											<th><a href="#"><span>Employee Name</span></a></th>
											<th><a href="#" class="text-center"><span>From</span></a></th>
											<th><a href="#" class="text-center"><span>To</span></a></th>
											<th><a href="#"><span>Total Time</span></a></th>
											<th><a href="#" class="text-center"><span>Reason</span></a></th>
											<th><a href="#"><span>Actions</span></a></th>
										</tr>
									</thead>

									<?php 
								        if(!empty($absences)){
								            foreach ($absences as $key => $absence): ?>
												<tbody aria-relevant="all" aria-live="polite" role="alert">
													<tr class="">
														<td> <?php echo $absence['Employee']['code']; ?></td>
														<td class="">
								                          <?php 
								                          if (!empty($absence['Employee']['id'])) {

								                          		echo $this->CustomText->getFullname($absence['Employee']);

								                          	}
								                           ?>
								                        </td>
														<td> 
								                           <?php  
								                           if (!empty($absence['Absence']['from'])) {
								                           	 		echo date('Y-m-d H:i',strtotime($absence['Absence']['from']));
								                           	 }								                           
								                           ?> 
								                        </td>
								                        <td > 
								                             <?php  
								                           if (!empty($absence['Absence']['from'])) {
								                           	 		echo date('Y-m-d H:i',strtotime($absence['Absence']['to']));
								                           	 }								                           
								                           ?> 
								                        </td>
								                         </td>
								                        <td> 
								                           <?php 
																echo $this->CustomTime->formaTime($absence['Absence']['total_time'],':');
								                            ?> 
								                        </td>
								                        </td>
								                        <td> 
								                           <?php echo $absence['Absence']['reason']; ?> 
								                        </td>
								                       	<td>
								                      	<?php
														echo $this->Html->link('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> edit </font></span>
														</span> ',array('controller' => 'absences', 'action' => 'edit',$absence['Absence']['id'] ),
														array('class' =>'table-link',
															   'escape' => false,
															   'data-url' => '/absences/edit/'.$absence['Absence']['id'],
															   'title'=>'Edit Information',
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

<div class="modal fade" id="absencesReport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Attendance </h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('Absence',array('url'=>(array('controller' => 'absences','action' => 'export')),'class' => 'form-horizontal'));?>

                	<div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Employee Name</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('Absence.employee_id', array(
                                                                'type' => 'select',
                                                                'label' => false,
                                                                'class' => 'autocomplete required',
                                                                'empty' => '---Select Employee---',
                                                                'options' => array($employees)

                                                              ));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label">Date</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('Absence.from_date', array(
                                                                'label' => false,
                                                                'class' => 'form-control  datepick required',
                                                                'placeholder' => 'Date'

                                                              ));
                            ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary export-close"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>  
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<?php echo $this->element('modals/personnal_attendance'); ?>