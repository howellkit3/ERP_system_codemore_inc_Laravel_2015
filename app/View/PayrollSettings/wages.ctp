<?php echo $this->element('payroll_setting_option');?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					<h1 class="pull-left">
						Wages
					</h1>
					<div class=" filter-block pull-right ">
					 <div class="form-group">
						<?php 
	                        echo $this->Html->link('<i class="fa fa-plus fa-lg"></i> Add ', array('controller' => 'payroll_settings', 'action' => 'wage_add'),array('class' =>'btn btn-primary pull-right','escape' => false));
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
							<h2 class="pull-left">Wages</h2>
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
									<th><a href="#"><span>Name</span></a></th>
									<th><a href="#" class="desc"><span>Amount</span></a></th>

									<th class="text-right"><a href="#" ><span>Action</span></a></th>
								</tr>
								</thead>
								<tbody>
								<?php if (!empty($wages)) { ?>
								<?php foreach ($wages as $key => $wage) { ?>
										
									<tr>
										<td>
											<?php echo $wage['Wage']['name']; ?> 
										</td>
										<td>
										<?php echo $wage['Wage']['amount']; ?> 
										</td>
										
										<td class="text-right">
										<?php
										echo $this->Html->link('<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
										</span> ', array('controller' => 'payroll_settings', 'action' => 'loan_edit',$wage['Wage']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information'));
										
										echo $this->Html->link('<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
										</span>', array('controller' => 'payroll_settings', 'action' => 'loan_delete',$wage['Wage']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Process ?'));
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