<html>
	<div class="main-box-body clearfix">
		<div class="alert alert-success">
			<i class="fa fa-check-circle fa-fw fa-lg"></i>
			Request Accept
		</div>
	</div>
 <div class="filter-block pull-right">
	<?php 
		echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array( 
										'controller' => 'deliveries', 
										'action' => 'index'
										),array(
										'class' =>'btn btn-primary pull-right', 
										'escape' => false));
	?>

	<?php
		echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print ', array(
				        	'controller' => 'Schedules', 
				        	'action' => 'delivery_receipt',
				        	$scheduleInfo['Schedule']['sales_order_id'],
				        	'ext' => 'pdf'
				        	),
				        	array('class' =>'btn btn-primary pull-right',
				        		'escape' => false,'target' => '_blank'
				        		));
	?>
</div>
	<div class="row">
	    <div class="col-lg-12">
	        <div class="main-box clearfix body-pad">
	            <header class="main-box-header clearfix">

	                <h2 class="pull-left"><b>Requested Schedule for Delivery</b></h2>
	                
	            </header>
	            
	            <div class="main-box-body clearfix">
	                <div class="table-responsive">
	                    <table class="table table-striped table-hover">
	                        <thead>
	                            <tr>
	                                <th><a href="#"><span>Sales Order</span></a></th>
	                                <th><a href="#"><span>Schedule</span></a></th>
	                                <th><a href="#"><span>Location</span></a></th>
	                                 <th><a href="#"><span>Quantity</span></a></th>
	                            </tr>
	                        </thead>

	                        <?php 
	                        //pr($scheduleInfo['RequestDeliverySchedule']['sales_order_id']);exit();
	                        //pr($requestScheduleInfo);die;
	                        if(!empty($requestScheduleInfo)){
	                           
	                        ?>
	                                <tbody aria-relevant="all" aria-live="polite" role="alert">

	                                    <tr class="">

	                                        <td class="">
	                                            <?php echo $requestScheduleInfo['RequestDeliverySchedule']['sales_order_id']; ?>  
	                                        </td>

	                                        <td class="">
	                                            
	                                             <?php echo $requestScheduleInfo['RequestDeliverySchedule']['schedule'];?>  
	                                        </td>

	                                        <td>
	                                           <?php echo $requestScheduleInfo['RequestDeliverySchedule']['location']; ?>  
	                                           
	                                        </td>

	                                        <td>
	                                           <?php echo $requestScheduleInfo['RequestDeliverySchedule']['quantity']; ?>  
	                                           
	                                        </td>

	                                    </tr>

	                                </tbody>
	                        <?php 
	                        
	                        } ?> 
	                    </table>
	                    <hr>
	                </div>
	            </div>
	    
	        </div>
	    </div>
	</div>

	<div class="row">
	    <div class="col-lg-12">
	        <div class="main-box clearfix body-pad">
	            <header class="main-box-header clearfix">

	                <h2 class="pull-left"><b>Schedule of Delivery</b></h2>
	                
	            </header>
	            
	            <div class="main-box-body clearfix">
	                <div class="table-responsive">
	                    <table class="table table-striped table-hover">
	                        <thead>
	                            <tr>
	                                <th><a href="#"><span>Sales Order</span></a></th>
	                                <th><a href="#"><span>Schedule</span></a></th>
	                                <th><a href="#"><span>Time</span></a></th>
	                                <th><a href="#"><span>Location</span></a></th>
	                                 <th><a href="#"><span>Quantity</span></a></th>
	                            </tr>
	                        </thead>

	                        <?php 
	                        //pr($scheduleInfo['RequestDeliverySchedule']['sales_order_id']);exit();
	                        if(!empty($scheduleInfo)){
	                           
	                        ?>
	                                <tbody aria-relevant="all" aria-live="polite" role="alert">

	                                    <tr class="">

	                                        <td class="">
	                                            <?php echo $scheduleInfo['Schedule']['sales_order_id']; ?>  
	                                        </td>

	                                        <td class="">
	                                            
	                                             <?php echo $scheduleInfo['Schedule']['schedule'];?>  
	                                        </td>
	                                        <td class="">
	                                            
	                                             <?php echo "<strong>" . 
	                                             					$scheduleInfo['TruckSchedule']['time_from'] .
	                                             			"</strong> 
	                                             					to 
	                                             			<strong>". 
	                                             					$scheduleInfo['TruckSchedule']['time_to'].
	                                             			"</strong>"; 
	                                             ?>  
	                                        </td>

	                                        <td>
	                                           <?php echo $scheduleInfo['Schedule']['location']; ?>  
	                                           
	                                        </td>

	                                        <td>
	                                           <?php echo $scheduleInfo['Schedule']['quantity']; ?>  
	                                           
	                                        </td>

	                                    </tr>

	                                </tbody>
	                        <?php 
	                        
	                        } ?> 
	                    </table>
	                    <hr>
	                </div>
	            </div>
	    
	        </div>
	    </div>
	</div>
</html>