<?php echo $this->Html->script('Delivery.apc_dr'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
                
                <?php echo $this->element('deliveries_options'); ?>


                <br>
            <header class="main-box-header clearfix">
                <h2 class="pull-left">
                	<b>Create APC Delivery</b>
                </h2>

          
				<div class="filter-block pull-right">
                    <div class="form-group pull-left">
                		<input placeholder="Search..." class="form-control searchDR"  />
                        <i class="fa fa-search search-icon"></i>
                    </div>
				</div>
			</header>
			<?php echo $this->Form->create('Delivery',array(
					'url' => array(
							'controller' => 'deliveries',
							'action' => 'create_apc_dr'
					)
 			)); ?>
            <div class="main-box-body clearfix">
         			<div class="col-lg-12">
								<div class="form-group" >
									<div class="col-lg-2">APC DR-NUM</div>
									<div class="col-lg-10">
										<?php 
								            echo $this->Form->input('apc_dr', array( 
								                						'type' => 'text',
								                						'class' => 'form-control item_type required', 
								                    					'label' => false, 
								                    					'id' => 'dr_number',
								                					));
								        ?>
										
									</div>
								</div>
								<div class="clearfix"></div>
								<br>
								<div class="form-group">
									<div class="col-lg-2">Plant</div>
										<div class="col-lg-10">
						    				<?php echo $this->Form->input('plant_id',array(
						    						'type' => 'select',
						    						'empty' => '-- Select Plant --',
						    						'options' => $plants,
						    						'class' => 'form-control item_type required',
						    						'label' => false
						    				)); ?>
		                                </div>
								</div>
								<div class="clearfix"></div>
								<br>
								<div class="form-group">
									<div class="col-lg-2">Company</div>
										<div class="col-lg-10">
						    				<?php echo $this->Form->input('company_id',array(
						    						'type' => 'select',
						    						'options' => $companyData,
						    						'class' => 'form-control item_type required',
						    						'label' => false
						    				)); ?>
		                                </div>
								</div>
								<div class="clearfix"></div>
								<br>
								<div class="form-group">
									<div class="col-lg-2">Contact</div>
										<div class="col-lg-4">
						    				<?php echo $this->Form->input('contact',array(
						    						'type' => 'select',
						    						'empty' => 'Select Contact',
						    						'class' => 'form-control item_type required',
						    						'label' => false
						    				)); ?>
		                                </div>
		                              <div class="col-lg-2 text-right">TEL</div>
										<div class="col-lg-4">
						    				<?php echo $this->Form->input('tel_num',array(
						    						'type' => 'select',
						    						'empty' => 'Select Number',
						    						'class' => 'form-control item_type required',
						    						'label' => false
						    				)); ?>
		                                </div>
								</div>

								<div class="clearfix"></div>
								<br>
								<div class="form-group">
									<div class="col-lg-2">Address</div>
										<div class="col-lg-10">
						    				<?php echo $this->Form->input('address',array(
						    						'class' => 'form-control item_type required',
						    						'label' => false
						    				)); ?>
		                                </div>
								</div>
						</div>

						<br>

						<div class="col-lg-12">
							<a href="#checkItem" data-toggle="modal"><btn class="btn btn-success"> ADD ITEM </btn></a>
						</div>
						<div class="clearfix"></div>
						<br>
						<div class="col-lg-12">

								<table class="table table-bordered" id="tableAppendModal">
										<tr>
											<th>Item</th>
											<th>Customer PO</th>
											<th>Terms</th>
											<th>Action</th>
										</tr>
										<tbody class="result">

										</tbody>
								</table>
						</div>
						<br>
						<button class="btn btn-primary" type="submit">SUBMIT</button>
						<a href="<?php echo $this->Html->url('/'); ?>delivery/deliveries/index"><button data-dismiss="modal" class="btn btn-default" type="button"> <i class="fa fa-arrow-left"></i> Back</button></a>
            </div>

		
            <?php echo $this->Form->end(); ?>
    
        </div>
    </div>
</div>

<div class="modal fade" id="checkItem" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
		<h4 class="modal-title">Delivery Scheule</h4>
		</div>
		<div class="modal-body">
		<form role="form">
		<div class="form-group">
		<label for="exampleInputPassword1"> Customer </label>
			<?php echo $this->Form->input('company_id',array('type' => 'hidden','id' => 'companyId')); ?>
				<label style="font-weight:strong;color:#000" class="label lbl-customer"> American Power Conversion</label>
		</div>
		<div class="form-group">
			<div class="col-lg-5">
				<label for="exampleInputEmail1">From</label>
				<?php echo $this->Form->input('from',array(
						'class' => 'form-control datepicker',
						'id' => 'dateFrom',
 						'label' => false,
						'value' => date('01/m/Y')

				)); ?>
			</div>
			<div class="col-lg-5">
				<label for="exampleInputEmail1">To</label>
				<?php echo $this->Form->input('to',array(
						'class' => 'form-control datepicker',
						'id' => 'dateTo',
						'label' => false,
						'value' => date('t/m/Y')

				)); ?>
			</div>
			<div class="col-lg-2">
				<br>
					<label> &nbsp </label>
				<button class="btn btn-success" id="findDeliverySchedule"> GO </button>
			</div>
		</div>
		<br>
		<div class="clearfix"></div>
		<br>
			<div id="result">
					<table class="table table-bordered">
							<thead>
									<tr>
									<th><span>Item</span></th>
									<th><span>Customer Po</span></th>
									<th class="text-center"><span>Term</span></th>
									<th class="text-center"><span>Schedule</span></th>
									</tr>
							</thead>
							<tbody class="append-result"></tbody>
					</table>
			</div>
		</form>
		</div>
		<div class="modal-footer">
		<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
		<button data-dismiss="modal" class="btn btn-primary" type="button">Add</button>
		</div>
		</div> 
		</div>
</div>

<style>
.modal-body #result {
  max-height: 450px;
  overflow: auto;
}
.delete-item {
  font-size: 19px;
}
</style>