<?php echo $this->Form->create('Schedule', 
										array(
								'url'=>( 
										array( 
								'controller' => 'schedules',
								'action' => 'add'
										)
									)), 
										array( 
								'class' => 'form-horizontal'
								));
?>
<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
          
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Job Ticket Details</b></h2>
                
            </header>
            
            <?php 
              //$value= "";

              // if( !empty($description[3]['JobTicketSummary']['value'])){
              //       $value = array( $description[2]['JobTicketSummary']['value'], $description[3]['JobTicketSummary']['value'],  !empty($description[4]['JobTicketSummary']['value']));
                   
              // } 
              // else{
              //      $value =array($this->Html->link('<span class="fa-stack">
              //                               <i class="fa fa-square fa-stack-2x"></i>
              //                               <i class="fa fa-truck fa-stack-1x fa-inverse"></i>
              //                               </span> ', 
              //                                           array( 
              //                               'controller' => 'requestDeliverySchedules', 
              //                               'action' => 'add',
              //                               $quotationId['Quotation']['id'],'ticket',
              //                               'plugin' =>'sales'
              //                               ),
              //                                           array(
              //                               'class' =>' table-link',
              //                               'escape' => false,
              //                               'title'=>'Request Delivery'
              //                               )), "Not Yet Available" , "Not Yet Available");
              // }
            ?>
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
       						<tbody>

         						  <tr>
	       								<td>Job Ticket Id</td>
	       								<td><div class="col-lg-9">
	                        					<?php
							                          echo $this->Form->input('jobTicketId', array(
							    												'value' => $companyDetails['JobTicketDetail']['unique_id'],
							    												//'readonly' => true,
														    					'alt' => 'type',
														    					'type' => 'text',
														    					'label' => false,
														   						'class' => 'form-control col-lg-4 required',
														    					'empty' => false,
														    					'id' => 'unique_id'
																				));
	                       	 					?>


	                  					</div></td>
         						  </tr>

         						  <tr>
           								<td>Company Name</td>
           								<td><div class="col-lg-9">
	                        					<?php
							                          echo $this->Form->input('jobTicketId', array(
							    												'value' => $companyDetails['JobTicketDetail']['company_name'],
							    												//'readonly' => true,
														    					'alt' => 'type',
														    					'type' => 'text',
														    					'label' => false,
														   						'class' => 'form-control col-lg-4 required',
														    					'empty' => false,
														    					'id' => 'unique_id'
																				));
	                       	 					?>


	                  					</div></td>
         						  </tr>

         						  <tr>
           								<td>Quantity</td>
           								<td><div class="col-lg-9">
	                        					<?php
							                          echo $this->Form->input('jobTicketId', array(
							    												'value' => $description[0]['JobTicketSummary']['value'],
							    												//'readonly' => true,
														    					'alt' => 'type',
														    					'type' => 'text',
														    					'label' => false,
														   						'class' => 'form-control col-lg-4 required',
														    					'empty' => false,
														    					'id' => 'unique_id'
																				));
	                       	 					?>


	                  					</div>
           									<?php //echo ; ?></td>
         						  </tr>
<!-- 
         						  <tr>
           								<td>Unit Price</td>
           								<td><?php echo $description[1]['JobTicketSummary']['value']; ?></td>
         						  </tr>

	                              <tr>
	                                  <td>Schedule of Delivery</td>
	                                  <td><?php //echo $value[0]; ?></td>
	                              </tr>

         						  <tr>
           								<td>Quantity Needed to be Deliver</td>
           								<td><?php //echo $value[1]; ?></td>
         						  </tr> -->

       						</tbody>
                    </table>
                    <hr>
                    <div class="filter-block pull-left">
			               <?php
			                  echo $this->Html->link('<i class="fa  fa-arrow-left fa-lg"></i> Back ', 
									                        array(
						                        	'controller' => 'jobTicketSummaries', 
						                            'action' => 'index', 
									                $companyDetails['JobTicketDetail']['unique_id']
									                            ),
									                        array('class' =>'btn btn-primary pull-right',
									                            'escape' => false));


                			?>  

             				<?php
			                  echo $this->Html->link('<i class="fa fa-check-square fa-lg"></i> Save ', 
			                        array('controller' => 'jobTicketSummaries', 
			                            'action' => 'editQuantity',
			                            $companyDetails['JobTicketDetail']['unique_id']
			                            //$scheduleInfo['Schedule']['sales_order_id']
			                            ),
			                        array('class' =>'btn btn-primary pull-right',
			                            'escape' => false));
                			?>  

               			<br><br>
        			</div>
                </div>
            </div>       
        </div>
    </div>
</div>