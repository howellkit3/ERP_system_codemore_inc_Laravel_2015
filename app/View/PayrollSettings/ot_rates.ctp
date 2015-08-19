<?php echo $this->element('payroll_setting_option');?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					<h1 class="pull-left">
						OT - Rates
					</h1>
				
                    <div class=" filter-block pull-right ">
					 <div class="form-group">
						<?php 
	                        echo $this->Html->link('<i class="fa fa-plus fa-lg"></i> Add ', array('controller' => 'payroll_settings', 'action' => 'ot_rates_add'),array('class' =>'btn btn-primary pull-right','escape' => false));
	                     
	                       
	                    ?>
	                  </div>
                    </div>


				</header>

			</div>
		</div>
	

	<div class="row">

		<div class="main-box-body clearfix">
				<div class="main-box-body clearfix">
						<div class="main-box clearfix">
							<header class="main-box-header clearfix">
							<h2 class="pull-left">Overtime rates</h2>
							<div id="reportrange" class="pull-right daterange-filter">
								<i class="icon-calendar"></i>
								<span></span> <b class="caret"></b>
							</div>
							</header>
							<div class="main-box-body clearfix">
							<div class="table-responsive">
								<table class="table">
								<thead>
									<tr>
										<th><a href="#"><span>Day</span></a></th>
										<th><a href="#" class="desc"><span>Regular</span></a></th>
										<th><a href="#" class="asc"><span>Overtime</span></a></th>
										<th><a href="#" class="desc"><span>Night Differential</span></a></th>
										<th><a href="#" class="asc"><span>Night Differential OT</span></a></th>
									</tr>
								</thead>
								<tbody>
								<?php if (!empty($overtimes)) { ?>
								<?php foreach ($overtimes as $key => $range) { ?>
								<tr>
										<td>
											<?php echo $range['DayType']['name']; ?> 
										</td>
										<td>
											<?php echo $range['OvertimeRate']['rates']; ?> 
										</td>
										<td>
											<?php echo $range['OvertimeRate']['overtime']; ?> 
										</td>
										<td>
											<?php echo $range['OvertimeRate']['night_diffrential']; ?> 
										</td>
										<td>
											<?php echo $range['OvertimeRate']['night_defferential_ot']; ?> 
										</td>


										<td class="text-right">
										<?php
										echo $this->Html->link('<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
										</span> ', array('controller' => 'payroll_settings', 'action' => 'ot_rates_edit',$range['OvertimeRate']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information'));
										
										echo $this->Html->link('<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
										</span>', array('controller' => 'payroll_settings', 'action' => 'ot_rates_delete',$range['OvertimeRate']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Process ?'));
										?>
										</td>
								</tr>
								<?php } ?>
								<?php } ?>
							
									</tbody>
								</table>
							</div>
							</div>


							</div>
						</div>


					</div>
	</div>
</div>