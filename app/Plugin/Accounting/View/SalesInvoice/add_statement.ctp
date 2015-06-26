<?php $this->Html->addCrumb('Accounting', array('controller' => 'sales_invoice', 'action' => 'index')); ?>

<?php echo $this->element('account_option'); ?>

<?php echo $this->Html->script('Accounting.accounting');?>

<?php echo $this->Form->create('SalesInvoice',array('url'=>(array('controller' => 'sales_invoice','action' => 'add_statement'))));?>
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
	        		<h1>Create Statement of Account</h1>
	   		 	</header>
				<div class="main-box-body clearfix">
					<div class="main-box-body clearfix">
						<div class="form-horizontal">

							<?php 
                                echo $this->Form->input('SalesInvoice.status', array(
                                	'type' => 'hidden',
                                    'label' => false,
                                    'class' => 'form-control col-lg-4 required',
                                    'value' => 2
                                	));
                            ?>

                            <div class="form-group">
								<label class="col-lg-2 control-label"><span style="color:red">*</span>Invoice No.</label>
								<div class="col-lg-8">
									<?php 
                                        echo $this->Form->input('SalesInvoice.statement_no', array(
            								'class' => 'form-control item_type required',
                                            'label' => false,
                                            'readonly' => true,
                                            'value' => $seriesSalesNo,
                                            'placeholder' => 'Statement No.'));
                                    ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label"><span style="color:red">*</span>Delivery No.</label>
								<div class="col-lg-8">
									<?php 
                                        echo $this->Form->input('SalesInvoice.dr_uuid', array(
            								'class' => 'form-control item_type required',
                                            'label' => false,
                                            'type' =>'text',
											//'options' => array($deliveryNo),
                                            'placeholder' => 'Delivery No.'));
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
								<label class="col-lg-2 control-label"></label>
								<div class="col-lg-1">
									<button type="submit" class="btn btn-success pull-left">Save</button>
								</div>
								<div class="col-lg-3">
									<?php
				                        echo $this->Html->link('Cancel', array('controller' => 'salesInvoice','action' => 'index'), array(
											'class' =>'pull-left btn btn-default',
											'escape' => false
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
<?php echo $this->Form->end(); ?>

<script>
		
	jQuery(document).ready(function($){
		$("#SalesInvoiceAddForm").validate();
			
	});

</script>