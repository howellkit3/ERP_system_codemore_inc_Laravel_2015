<?php echo $this->element('setting_option');?><br><br>

<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					<center>
					<h1 class="pull-left">
						Add Supplier
					</h1>
					</center>
				<?php 
				echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'category_index'),array('class' =>'btn btn-primary pull-right','escape' => false));
				?>
				</header>
			</div>
	</div>
	<?php echo $this->Form->create('Supplier',array('url'=>(array('controller' => 'settings','action' => 'supplier')),'class' => 'form-horizontal'));?>
	<div class="row">
		<div class="col-lg-12">
				<div class="main-box">
					<h1>Company</h1>
					<!-- <div class="top-space"></div> -->
					<div class="main-box-body clearfix">
						<div class="main-box-body clearfix">
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Name</label>
									<div class="col-lg-9">
										<?php
										echo $this->Form->input('Company.company_name', array('class' => 'form-control col-lg-6 required','label' => false));
										?>
									</div>
								</div>
							<div class="form-group">
								<label for="inputPassword1" class="col-lg-2 control-label"> Description</label>
								<div class="col-lg-9">
								<?php
								echo $this->Form->input('Company.description', array('type' => 'text', 
								                                                    'maxlength'=>'1000',
								                                                     'class' => 'form-control col-lg-6 ',
								                                                     'label' => false
								                                                     ));
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
</div>