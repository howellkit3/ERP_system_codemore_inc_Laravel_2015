<?php echo $this->element('ticket_option'); ?><br><br>
<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block pull-right">
               <?php
                
                  echo $this->Html->link('<i class="fa  fa-arrow-left fa-lg"></i> Back ', 
                        array('controller' => 'ticketing_systems', 
                            'action' => 'index'
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
                              <?php
                               
                              ?>
                 							<tr>
                   								<td>Job Ticket Id</td>
                   								<td><?php echo $ticketDetails['Quotation']['unique_id']; ?></td>
                 							</tr>
                 							<tr>
                   								<td>Company Name</td>
                   								<td><?php echo $companyName['Company']['company_name']; ?></td>
                 							</tr>
                              <tr>
                                  <td>Address</td>
                                  <td><?php echo $companyName['Address'][0]['address1']; ?></td>

                              </tr>
                              <tr>
                                  <td></td>
                                  <td><?php echo $companyName['Address'][0]['address2']; ?></td>
                                  
                              </tr>
                              <tr>
                                  <td>Contact Numbers</td>
                                  <td><?php echo $companyName['Contact'][0]['number']; ?></td>
                              </tr>
                               <tr>
                                  <td>Email</td>
                                  <td><?php echo $companyName['Email'][0]['email']; ?></td>
                              </tr>

                              <tr>
                                  <td>Item Name</td>
                                  <td><?php echo $productName['Product']['product_name']; ?></td>
                              </tr>
                              <?php  ?>
                              <?php foreach ($customField as $value) { 
                              ?>       
                              
                              <tr>
                                  <td>
                                    <?php echo $value['CustomField']['fieldlabel'];?>

                                  </td>
                                  <td>
                                      <?php echo !empty($customValue[$value['CustomField']['id']]) ? $customValue[$value['CustomField']['id']] : "NO VALUE" ; ?>

                                  </td>
                                  
                                  
                              </tr>
                              
                              <?php 
                               
                              }
                            ?>

               						</tbody>
                    </table>
                    <hr>
                </div>
            </div>
            
        </div>
    </div>
</div>
