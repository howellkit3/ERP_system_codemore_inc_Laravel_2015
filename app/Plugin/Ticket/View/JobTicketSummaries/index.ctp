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
                  echo $this->Html->link('<i class="fa fa-check-square fa-lg"></i> Edit ', 
                        array('controller' => 'jobTicketSummaries', 
                            'action' => 'edit',
                            $companyDetails['JobTicketDetail']['unique_id']
                           
                            ),
                        array('class' =>'btn btn-primary pull-right',
                            'escape' => false));


                ?>  

               <br><br>
           </div>
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Job Ticket Details</b></h2>
                
            </header>
            
            <?php 
              $value= "";

              if( !empty($description[3]['JobTicketSummary']['value'])){
                    $value = array( $description[2]['JobTicketSummary']['value'], $description[3]['JobTicketSummary']['value'],  !empty($description[4]['JobTicketSummary']['value']));
                   
              } 
              else{
                   $value =array($this->Html->link('<span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fa fa-truck fa-stack-1x fa-inverse"></i>
                                            </span> ', 
                                                        array( 
                                            'controller' => 'requestDeliverySchedules', 
                                            'action' => 'add',
                                            $quotationId['Quotation']['id'],'ticket',
                                            'plugin' =>'sales'
                                            ),
                                                        array(
                                            'class' =>' table-link',
                                            'escape' => false,
                                            'title'=>'Request Delivery'
                                            )), "Not Yet Available" , "Not Yet Available");
              }
            ?>
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
               						<tbody>

                 							<tr>
                   								<td>Job Ticket Id</td>
                   								<td><?php echo $companyDetails['JobTicketDetail']['unique_id']; ?></td>
                 							</tr>

                 							<tr>
                   								<td>Company Name</td>
                   								<td><?php echo $companyDetails['JobTicketDetail']['company_name']; ?></td>
                 							</tr>

                 							<tr>
                   								<td>Quantity</td>
                   								<td><?php echo $description[0]['JobTicketSummary']['value']; ?></td>
                 							</tr>

                              <tr>
                                  <td>Process</td>
                                  <td><?php //echo $description[0]['JobTicketSummary']['value']; ?></td>
                              </tr>

                              <tr>
                                  <td>Materials</td>
                                  <td><?php //echo $description[0]['JobTicketSummary']['value']; ?></td>
                              </tr>

                              <tr>
                                  <td>Sizes and Thickness</td>
                                  <td><?php //echo $description[0]['JobTicketSummary']['value']; ?></td>
                              </tr>

                 							<tr>
                   								<td>Unit Price</td>
                   								<td><?php echo $description[1]['JobTicketSummary']['value']; ?></td>
                 							</tr>

                              <tr>
                                  <td>Schedule of Delivery</td>
                                  <td><?php echo $value[0]; ?></td>
                              </tr>

                 							<tr>
                   								<td>Quantity Needed to be Deliver</td>
                   								<td><?php echo $value[1]; ?></td>
                 							</tr>

                 							

                 							<tr>
                   								<td>Delivered Quantity</td>
                   								<td><?php echo $value[2] ?></td>
                 							</tr>

               						</tbody>
                    </table>
                    <hr>
                </div>
            </div>
            
        </div>
    </div>
</div>
