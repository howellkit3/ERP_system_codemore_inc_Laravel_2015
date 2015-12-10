<?php echo $this->element('account_option'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">

            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Statement of Account List</b></h2>
                <div class="filter-block pull-right">
                   <?php
                   
                      echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Create Statement of Account ', 
                            array('controller' => 'sales_invoice', 
                                    'action' => 'add_statement',),
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
								<th><a href="#"><span>Statement of Account No.</span></a></th>
								<th><a href="#"><span>Delivery No.</span></a></th>
								<th><a href="#"><span>Action</span></a></th>
							</tr>
						</thead>
						<?php 
					        if(!empty($invoiceData)){
					            foreach ($invoiceData as $invoiceDataList): ?>

					                <tbody aria-relevant="all" aria-live="polite" role="alert">

					                    <tr class="">

					                        <td class="">
					                            <?php echo $invoiceDataList['SalesInvoice']['statement_no'];?> 
					                        </td>

					                        <td class="">
					                            <?php echo $invoiceDataList['SalesInvoice']['dr_uuid'];?>
					                        </td>
					                        
					                       	<td>
					                            <?php

					                            	echo $this->Html->link('<span class="fa-stack">
								                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'sales_invoice', 'action' => 'view',$invoiceDataList['SalesInvoice']['id'],'sa_no'), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
								                    ));

					                            	echo $this->Html->link('<span class="fa-stack">
								                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-paper-plane  fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> Move</font></span></span> ', array('controller' => 'sales_invoice', 'action' => 'move',$invoiceDataList['SalesInvoice']['id'],'sa_no'), array('class' =>' table-link','escape' => false, 'title'=>'Move to Sales Invoice',  'confirm' => 'Do you want to move this  Statement of Account to Sales Invoice?'
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
