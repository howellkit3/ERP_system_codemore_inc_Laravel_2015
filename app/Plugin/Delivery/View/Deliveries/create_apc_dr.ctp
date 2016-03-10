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
						    						'class' => 'form-control item_type required',
						    						'label' => false
						    				)); ?>
		                                </div>
		                              <div class="col-lg-2 text-right">TEL</div>
										<div class="col-lg-4">
						    				<?php echo $this->Form->input('tel_num',array(
						    					
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

								<table class="table table-bordered">
										<tr>
											<th>Item</th>
											<th>Customer PO</th>
											<th>Terms</th>
											<th>Remarks</th>
										</tr>
										<tbody class="result">

										</tbody>
								</table>
						</div>
            </div>

            <?php echo $this->Form->end(); ?>
    
        </div>
    </div>
</div>

<div class="modal fade" id="checkItem" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content margintop">
                <div class="modal-header">
                    <button type="button" cl`ss="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delivery Schedule</h4>
                </div>
                 
                 <div class="content">
                 		<div class="col-lg-12">

                 				DEL Sched : 
                 		</div>
                 </div>
            </div>
        </div>
    </div>