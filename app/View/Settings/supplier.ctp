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
				echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
				?>
				</header>
			</div>
	</div>
	<?php echo $this->Form->create('Supplier',array('url'=>(array('controller' => 'settings','action' => 'supplier')),'class' => 'form-horizontal'));?>
		<div class="row">
			<div class="col-lg-12">
					<div class="main-box">
					<br>
					<!-- <div class="top-space"></div> -->
					<div class="main-box-body clearfix">
						<div class="main-box-body clearfix">
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Name</label>
									<div class="col-lg-9">
										<?php
										echo $this->Form->input('Supplier.name', array('class' => 'form-control col-lg-6 required','label' => false));
										?>
									</div>
								</div>
							<div class="form-group">
								<label for="inputPassword1" class="col-lg-2 control-label"> Description</label>
								<div class="col-lg-9">
								<?php
								echo $this->Form->input('Supplier.description', array('type' => 'text', 
								                                                    'maxlength'=>'1000',
								                                                     'class' => 'form-control col-lg-6 ',
								                                                     'label' => false
								                                                     ));

								?>
								</div>
							</div>

								<div class="form-group">
									<div class="col-lg-2"></div>
									<div class="col-lg-8">
										<button type="submit" class="btn btn-primary pull-left">Submit Supplier</button>&nbsp;
										<?php 
					                        echo $this->Html->link('Cancel', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
					                    ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
				  	<header class="main-box-header clearfix">
                        <h1>Supplier List</h1>
                    </header>
					<div class="main-box-body clearfix">
		                <div class="table-responsive">
		                    <table class="table table-striped table-hover">
		                        <thead>
		                            <tr>        
		                                <th><a href="#"><span>Supplier</span></a></th>
		                                <th><a href="#"><span>Description</span></a></th>
		                                <th class="text-center"><a href="#"><span>Created</span></a></th>
		                                <th style="width:135px">Action</th>
		                            </tr>
		                        </thead>

		                        <?php echo $this->element('supplier_table'); ?>

		                    </table>
		                    <hr>

		                    	<div class="paging" id="item_type_pagination">
						                <?php
						               
						                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'ItemTypeHolder','model' => 'ItemTypeHolder'), null, array('class' => 'disable','model' => 'ItemTypeHolder'));
						                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'ItemTypeHolder'), array('paginate' => 'ItemTypeHolder'));
						                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'ItemTypeHolder','model' => 'ItemTypeHolder'), null, array('class' => 'disable'));

						                ?>
	                    		</div>

								<!-- <ul class="pagination pull-right">
									<?php 
									echo $this->Paginator->prev('< ' . __('previous'), array('before' => 'a','tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'prev disabled'));
									echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
									echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'next disabled')); ?>
								</ul> -->
		                </div>
		            </div>
				</div>
			</div>
		</div>

	</div>
</div>