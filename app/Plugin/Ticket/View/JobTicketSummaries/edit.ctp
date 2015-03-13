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