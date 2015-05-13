<?php echo $this->element('setting_option');?><br><br>
<?php echo $this->element('category_option');?><br><br>

					<div class="row">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12">
									<header class="main-box-header clearfix">

										<h1 class="pull-left">
											Add Category
										</h1>
										<?php 
					                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'category_index'),array('class' =>'btn btn-primary pull-right','escape' => false));
					                    ?>
									</header>
								</div>
							</div>

		<?php echo $this->Form->create('ItemCategoryHolder',array('url'=>(array('controller' => 'settings','action' => 'category'))));?>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-lg-2 control-label">Name Category</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('ItemCategoryHolder.name', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Name Category'));
                                            ?>
										</div>
									</div>

									<div class="form-group">
                                        <label class="col-lg-2 control-label">Item Category</label>
                                        <div class="col-lg-8">
                                          
                                            <?php echo $this->Form->input('Product.item_category_holder_id', array(
                                                    'options' => array($itemCategoryData),
                                                    'type' => 'select',
                                                    'label' => false,
                                                    'class' => 'form-control required',
                                                    'empty' => '---Select Item Category---'
                                                   
                                                     )); 

                                                ?>
                                        </div>
                                    </div>

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit Category</button>&nbsp;
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
				                        <h1>Category List</h1>
				                    </header>
									<div class="main-box-body clearfix">
						                <div class="table-responsive">
						                    <table class="table table-striped table-hover">
						                        <thead>
						                            <tr>
						                                <th><a href="#"><span>Name</span></a></th>
						                                <th><a href="#"><span>Name Type</span></a></th>
						                                <th class="text-center"><a href="#"><span>Created</span></a></th>
						                                <th style="width:135px">Action</th>
						                            </tr>
						                        </thead>

						                        <?php echo $this->settings('category_table'); ?>

						                    </table>
						                    <hr>
						                </div>
						            </div>
								</div>
							</div>
						</div>
					</div>
				</div>