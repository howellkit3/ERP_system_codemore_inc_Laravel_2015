<?php echo $this->element('setting_option');?><br><br>
<br><br>
<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">					                    
					<h1 class="pull-left">
						Add Area
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>
			</div>
		</div>
		<?php echo $this->Form->create('Area',array('url'=>(array('controller' => 'settings','action' => 'area'))));?>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Area</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Area.name', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Area Name'));
                                            ?> 

										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit Area</button>&nbsp;
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
	</div>
</div>

<div class="row" id="unit-table">
	<div class="col-lg-12">
		<div class="main-box">
		  	<header class="main-box-header clearfix">
                <h1>Area List</h1>
            </header>
			<div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                              
                                <th><a href="#"><span>Area</span></a></th>
                              
                                <th class="text-center"><a href="#"><span>Created</span></a></th>
                                <th style="width:135px">Action</th>
                            </tr>
                        </thead>

                        <?php echo $this->element('area_table'); ?>

                    </table>
                    <hr>

                    <div class="paging" id="unit_pagination">
						                <?php
						               
						                echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'ItemTypeHolder','model' => 'ItemTypeHolder'), null, array('class' => 'disable','model' => 'ItemTypeHolder'));
						                echo $this->Paginator->numbers(array('separator' => '','paginate' => 'ItemTypeHolder'), array('paginate' => 'ItemTypeHolder'));
						                echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'ItemTypeHolder','model' => 'ItemTypeHolder'), null, array('class' => 'disable'));

						                ?>
	                </div>
                </div>
            </div>
		</div>
	</div>
</div>
