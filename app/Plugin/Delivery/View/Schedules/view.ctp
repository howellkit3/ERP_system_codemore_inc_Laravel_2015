<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block pull-right">
               <?php
                
                  echo $this->Html->link('<i class="fa  fa-arrow-left fa-lg"></i> Back ', 
                        array('controller' => 'deliveries', 
                            'action' => 'index'
                            ),
                        array('class' =>'btn btn-primary pull-right',
                            'escape' => false));


                ?>  

              <?php
                
                  echo $this->Html->link('<i class="fa fa-check-square fa-lg"></i> Create Schedule ', 
                        array('controller' => 'truckSchedules', 
                            'action' => 'add',
                            $scheduleInfo['Schedule']['sales_order_id']
                            ),
                        array('class' =>'btn btn-primary pull-right',
                            'escape' => false));


                ?>  

               <br><br>
           </div>
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Request Details</b></h2>
                
            </header>
            
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
               						<tbody>

                 							<tr>
                   								<td>Purchased Number</td>
                   								<td><?php echo  $scheduleInfo['Schedule']['sales_order_id']; ?></td>
                 							</tr>

                 							<tr>
                   								<td>Schedule</td>
                   								<td><?php echo  $scheduleInfo['Schedule']['schedule']; ?></td>
                 							</tr>

                 							<tr>
                   								<td>Location</td>
                   								<td><?php echo  $scheduleInfo['Schedule']['location']; ?></td>
                 							</tr>

                 							<tr>
                   								<td>Quantity</td>
                   								<td><?php echo  $scheduleInfo['Schedule']['quantity']; ?></td>
                 							</tr>

               						</tbody>
                    </table>
                    <hr>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
