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
                    'HumanResource.select2.min',
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
			                <h2 class="pull-left"><b>Daily Info</b> </h2>
			                <div class="filter-block pull-right">
			                 <div class="form-group pull-left">
			                 	<?php echo $this->Form->create('Attendance',array('controller' => 'attendances','action' => 'daily_info', 'type'=> 'get')); ?>
			                 		<input type="text" name="data[date]" id="changeDate" class="form-control datepick" value="<?php echo $date ?>">

			                            <i class="fa fa fa-calendar calendar-icon"></i>

			                 		
			                    </div>
			                    <div class="form-group pull-left">
			                 		 <input placeholder="Employee Code/Name" class="form-control searchCustomer" value="<?php echo $search ?>" name="data[name]" />
			                            <i class="fa fa-search search-icon"></i>

			                           
			                         
			                    </div>
			                     <div class="form-group pull-left">
			                    	 <button class="btn btn-success">Go</button> 
			                     </div>
			                     <a data-toggle="modal" href="#dailyInfo" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>
			                    <?php echo $this->Form->end(); ?>
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
											<th><a href="#"><span>Date</span></a></th>
											<th><a href="#"><span>Work</span></a></th>
											<th><a href="#"><span>OT</span></a></th>
											<th><a href="#"><span>OB</span></a></th>
											<th><a href="#"><span>NIGHT</span></a></th>
											<th><a href="#"><span>NIGHT OT</span></a></th>
											<th><a href="#"><span>LEAVE</span></a></th>
											<th><a href="#"><span>No Work</span></a></th>
											<th><a href="#"><span>Type</span></a></th>
											<th><a href="#"><span>Remark</span></a></th>
										</tr>
									</thead>

									<tbody aria-relevant="all" aria-live="polite" role="alert">
									<?php 
								        if(!empty($dailyInfos)){

								            foreach ($dailyInfos as $key => $daily): ?>
													
													<tr>
														<td> <?php echo $daily['Employee']['code']; ?></td>
								                   
														<td> <?php echo $this->CustomText->getFullname($daily['Employee']); ?></td>
								                   
														<td> <?php echo date('Y/m/d',strtotime($daily['DailyInfo']['date'])); ?></td>
								                    
														<td>  <?php echo !empty($daily['DailyInfo']['work']) ? $daily['DailyInfo']['work'] : ''; ?> </td>
								                   
														<td> </td>
								                   
														<td> <?php //echo $daily['Employee']['code']; ?></td>
								                    
														<td> <?php //echo $daily['Employee']['code']; ?></td>
								                   
														<td> <?php //echo $daily['Employee']['code']; ?></td>
								                   
														<td> <?php //echo $daily['Employee']['code']; ?></td>
								                    
														<td> <?php //echo $daily['Employee']['code']; ?></td>
								                  
														<td> <?php //echo $daily['Employee']['code']; ?></td>
								                  
														<td> <?php //echo $daily['Employee']['code']; ?></td>
								                    </tr>


								                
								        <?php 
								            endforeach; 
								        } ?> 
									</tbody>
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
<div class="modal fade" id="dailyInfo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Attendance </h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('Attendance',array('url'=>(array('controller' => 'attendances','action' => 'export_dailyinfo')),'class' => 'form-horizontal'));?>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label">Date</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('Attendance.from_date', array(
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

<?php echo $this->element('modals/time_in_attendance'); ?>