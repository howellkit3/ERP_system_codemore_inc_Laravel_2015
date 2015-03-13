<html>
	<div class="row">
	    <div class="col-lg-12">
	        <div class="main-box clearfix body-pad">

	            <header class="main-box-header clearfix">
	                <h2 class="pull-left"><b>Sales Invoice List</b></h2>
	                <div class="filter-block pull-right">
                   <?php
                    //pr($truckAvailability);
                    //pr($truckId);
                      echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Create Sales Invoice ', 
                            array('controller' => 'salesInvoice', 
                                    'action' => 'add',

                                ),
                            array('class' =>'btn btn-primary pull-right',
                                'escape' => false));


                    ?>  

                   <br><br>
               </div>
	            </header>
	             
				<div class="main-box-body clearfix">
				    <div class="table-responsive">

						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>
										Purchase No
										
									</th>
									<th>
										Delivery No
									</th>
									<th>
										Action
									</th>
								</tr>
							</thead>
							 <?php 
						        if(!empty($scheduleData)){
						            foreach ($scheduleData as $scheduleDataList): ?>

						                <tbody aria-relevant="all" aria-live="polite" role="alert">

						                    <tr class="">

						                        <td class="">
						                              <?php echo $scheduleDataList['Schedule']['sales_order_id'];?> 
						                        </td>

						                        <td class="">
						                            
						                             
						                             <?php echo $scheduleDataList['Schedule']['delivery_no']; ?> 
						                        </td>
						                       	<td>
						                            <?php
						                                echo $this->Html->link('<span class="fa-stack">
						                                                        <i class="fa fa-square fa-stack-2x"></i>
						                                                        <i class="fa fa fa-check-square fa-lg fa-stack-1x fa-inverse"></i>
						                                                        </span> ', array( 
						                                                        'controller' => 'salesInvoice', 
						                                                        'action' => 'add',
						                                                         $scheduleDataList['Schedule']['sales_order_id']
						                                                                ), array(
						                                                        'class' =>' table-link',
						                                                        'escape' => false,
						                                                        'title'=>'View Information'
						                                        ));

						                            ?>
						                        </td>
						                    </tr>

						                </tbody>
						        <?php 
						            endforeach; 
						        } ?> 
						</table>	
					</div>
				</div>
		    </div>
	    </div>
	</div>
</html>