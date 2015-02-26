<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block pull-right">
               <?php
                //pr($truckAvailability);
                //pr($truckId);
                  echo $this->Html->link('<i class="fa  fa-arrow-left fa-lg"></i> Back ', 
                        array('controller' => 'ticketing_systems', 
                            'action' => 'index'
                            ),
                        array('class' =>'btn btn-primary pull-right',
                            'escape' => false));


                ?>  

              <?php
                //pr($truckAvailability);
                //pr($truckId);
                  echo $this->Html->link('<i class="fa fa-check-square fa-lg"></i>Edit ', 
                        array('controller' => 'truckSchedules', 
                            'action' => 'add',
                            //$scheduleInfo['Schedule']['sales_order_id']
                            ),
                        array('class' =>'btn btn-primary pull-right',
                            'escape' => false));


                ?>  

               <br><br>
           </div>
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Job Ticket Details</b></h2>
                
            </header>
            
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
               						<tbody>

                 							<tr>
                   								<td>Job Ticket Id</td>
                   								<td></td>
                 							</tr>

                 							<tr>
                   								<td>Company Name</td>
                   								<td></td>
                 							</tr>

                 							<tr>
                   								<td>Quantity</td>
                   								<td></td>
                 							</tr>

                 							<tr>
                   								<td>Unit Price</td>
                   								<td></td>
                 							</tr>

                 							<tr>
                   								<td>Quantity Needed to be Deliver</td>
                   								<td></td>
                 							</tr>

                 							<tr>
                   								<td>Schedule of Delivery</td>
                   								<td></td>
                 							</tr>

                 							<tr>
                   								<td>Delivered Quantity</td>
                   								<td></td>
                 							</tr>

               						</tbody>
                    </table>
                    <hr>
                </div>
            </div>
            
        </div>
    </div>
</div>
