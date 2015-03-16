<?php echo $this->element('deliveries_options'); ?><br><br>
<html>
	<div class="row1">
    	<div class="col-lg-12">
			 <div class="main-box-body clearfix">
			 	
		        <div class="table-responsive">
		        	<div class="col-lg-10">
			        	<div class="filter-block">
							<?php 
								$location = "";
								if(!empty($url)){
									$location = "index";
								}
								else{
									$location = "delivery_detail";
								}
								echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array( 
																'controller' => 'deliveries', 
																'action' => $location
																), array(
																'class' =>'btn btn-primary pull-right', 
																'escape' => false));
							?>
						</div>
					</div>
		            <table class="table table-striped table-hover">
		            	
						<tbody>
							<tr>
								<td>
									Delivery Number:
								</td>
								<td>
									<?php
										echo $scheduleInfo['Schedule']['delivery_no'];
									?>
								</td>

							</tr>
							<tr>
								<td>
									Purchase Number:
								</td>
								<td>
									<?php
										echo $scheduleInfo['Schedule']['sales_order_id'];
									?>
								</td>
							</tr>
							<tr>
								<td>
									Status:
								</td>
								<td>
									<?php
										echo $status['Delivery']['status'];
									?>
								</td>
							</tr>
							<tr>
								<td>
									Quantity needed to be Deliver:
								</td>
								<td>
									<?php
										echo $scheduleInfo['Schedule']['quantity'];
									?>
								</td>
							</tr>
							<?php foreach ($deliveryDetail as $key => $value) { 
		                               ?>
		                      
		                      <tr>
		                          <td>
		                            <?php echo $deliveryDetail[$key]?>
		                          </td>
		                          <td>
		                              <?php echo $detailValue[$key-1]['Delivery']['description'];?>
		                          </td>
		                          
		                      </tr>
		                      
		                      <?php 
		                       // }
		                      }
		                    ?>
							</tbody>
							
		            </table>
		            <hr>
		        </div>
		    </div>
		</div>
	</div>
</html>