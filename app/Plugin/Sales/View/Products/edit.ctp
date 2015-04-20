<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php echo $this->Html->script(array('Sales.inquiry'));?>
<?php echo $this->element('sales_option'); ?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					                    
					<h1 class="pull-left">
						Edit Product
					</h1>
					
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('Product',array('url'=>(array('controller' => 'products','action' => 'edit'))));?>			
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
							                                                    'required' => 'required',
							                                                    'placeholder' => 'Item Name'));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Customer</label>
										<div class="col-lg-8">
											<input type="hidden" id="category_selected_type" value="">
                                            <?php echo $this->Form->input('Product.company_id', array(
					                                'options' => array($companyData),
					                                'type' => 'select',
					                                'label' => false,
					                                'readonly' => 'readonly',
					                                'required' => 'required',
					                                'class' => 'form-control required categorylist',
					                                'empty' => '---Select Customer---',
					                               	'required' => 'required'
					                                 )); 
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
					                                'readonly' => 'readonly',
					                                'required' => 'required',
					                                'class' => 'form-control required categorylist',
					                                'empty' => '---Select Item Category---'
					                               
					                                 )); 
					                            ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Item Type</label>
										<input type="hidden" id="selected_item_type" value="<?php echo $this->request->data['Product']['item_type_holder_id']; ?>">
										<div class="col-lg-8">
											 <?php echo $this->Form->input('Product.item_type_holder_id', array(
					                                // 'type' => 'select',
					                                'label' => false,
					                                'readonly' => 'readonly',
					                                'class' => 'form-control required',
					                                'empty' => '---Select Item Type---',
					                                'id' => 'item_type_holder_id',
					                                'required' => 'required',
					                               	'selected'  => $this->request->data['Product']['item_type_holder_id']
					                                 )); 
					                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->textarea('Product.remarks', array(
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
						                        echo $this->Html->link('Cancel', array('controller' => 'products', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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