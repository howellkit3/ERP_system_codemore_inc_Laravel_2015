<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Create Product', array('controller' => 'products', 'action' => 'create',$companyName['Company']['id'])); ?>

<?php echo $this->element('sales_option'); ?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						Create Product
					</h1>
					<?php 
                        //echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('Product',array('url'=>(array('controller' => 'products','action' => 'create_product'))));?>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									
									<div class="form-group">
										<label class="col-lg-2 control-label">Company Name</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Company.company_name', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'readonly' => 'readonly',
							                                                    'value' => $companyName['Company']['company_name']));
	                                            echo $this->Form->input('Company.id', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'hidden' => 'hidden',
							                                                    'value' => $companyName['Company']['id']));
                                            ?>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									
									<div class="form-group">
										<label class="col-lg-2 control-label">Name</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Product.name', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Name'));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Item Category</label>
										<div class="col-lg-8">
											<?php 
	                                            // echo $this->Form->input('Product.status', array(
	                                            // 								'class' => 'form-control item_type',
							                                      //               'label' => false,
							                                      //               'placeholder' => 'Item Category'));
                                            ?>
                                            <?php echo $this->Form->input('ItemCategoryHolder.id', array(
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
										<label class="col-lg-2 control-label">Item Type</label>
										<div class="col-lg-8">
											 <?php echo $this->Form->input('ItemTypeHolder.id', array(
					                                'options' => array($itemTypeData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required',
					                                'empty' => '---Select Item Type---'
					                               
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Product.remarks', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Remarks'));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit Product</button>&nbsp;
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