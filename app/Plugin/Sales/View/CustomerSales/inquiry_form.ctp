<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Inquiry', array('controller' => 'customer_sales', 'action' => 'inquiry')); ?>
<?php $this->Html->addCrumb('Form', array('controller' => 'customer_sales', 'action' => 'inquiry_form')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<?php //echo $this->Session->flash(); ?>
			<header class="main-box-header clearfix">
				<h2>
					Inquiry form
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'inquiry'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</h2>
			</header>
			<?php echo $this->Form->create('Company',array('url'=>(array('controller' => 'customer_sales','action' => 'inquiry_form')),'class' => 'form-horizontal'));?>
				<div class="main-box-body clearfix">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label">Company</label>
							<div class="col-lg-8">
							<?php 
	                            echo $this->Form->input('Company.id', array(
	                                'options' => array($companyData),
	                                'type' => 'select',
	                                'label' => false,
	                                'class' => 'form-control col-lg-4',
	                                'empty' => '---Select Company---',
	                                'id' => 'select_company'
	                                 ));
	                        ?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label">Address</label>
							<div class="col-lg-8">
								<?php 
	                                echo $this->Form->input('Address.address1', array('class' => 'form-control item_type',
	                                    'alt' => 'Address',
	                                    'label' => false,
	                                    'readonly' => 'readonly',
	                                    'id' => 'address1'));
	                            ?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label">Contact</label>
							<div class="col-lg-8">
								<?php 
	                                echo $this->Form->input('Contact.contact', array('class' => 'form-control item_type',
	                                    'alt' => 'Contact',
	                                    'label' => false,
	                                    'readonly' => 'readonly',
	                                    'id' => 'contact'
	                                    ));
	                            ?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label">Email</label>
							<div class="col-lg-8">
								<?php 
	                                echo $this->Form->input('Email.email', array('class' => 'form-control item_type',
	                                    'alt' => 'Email',
	                                    'label' => false,
	                                    'readonly' => 'readonly',
	                                    'id' => 'email'
	                                    ));
	                            ?>
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label">Request Inquiry</label>
							<div class="col-lg-8">
								<?php 
	                                echo $this->Form->textarea('Inquiry.quotes', array('class' => 'form-control item_type',
	                                    'alt' => 'Request Inquiry',
	                                    'label' => false,
	                                    'rows' => '6'));
	                            ?>
	                             
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label">Remarks</label>
							<div class="col-lg-8">
								<?php 
	                                echo $this->Form->textarea('Inquiry.remarks', array('class' => 'form-control item_type',
	                                    'alt' => 'Request Inquiry',
	                                    'label' => false,
	                                    'rows' => '6'));
	                            ?>
	                             
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button type="submit" class="btn btn-success">Submit</button>
							
							
								<?php 
			                        echo $this->Html->link('Cancel ', array('controller' => 'customer_sales', 'action' => 'inquiry'),array('class' =>'btn btn-primary ','escape' => false));
			                    ?>
							</div>
						</div>
					</form>
				</div>	
			<?php echo $this->Form->end(); ?>							
		</div>
	</div>	
</div>
