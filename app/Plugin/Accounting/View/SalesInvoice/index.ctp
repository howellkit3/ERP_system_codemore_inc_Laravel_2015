<?php echo $this->element('account_option'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">

            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Sales Invoice List</b></h2>
                <div class="filter-block pull-right">
                   <?php
                   
                      echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Create Sales Invoice ', 
                            array('controller' => 'sales_invoice', 
                                    'action' => 'add',),
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
								<th><a href="#"><span>Sales Invoice No.</span></a></th>
                                <th><a href="#"><span>Statement of Account No.</span></a></th>
								<th><a href="#"><span>Delivery No.</span></a></th>
								<th class="text-center"><a href="#"><span>Status</span></a></th>
								<th><a href="#"><span>Action</span></a></th>
							</tr>
						</thead>
						<?php 
					        if(!empty($invoiceData)){
					            foreach ($invoiceData as $invoiceDataList): ?>

					                <tbody aria-relevant="all" aria-live="polite" role="alert">

					                    <tr class="">

					                        <td class="">
					                            <?php echo $invoiceDataList['SalesInvoice']['sales_invoice_no'];?> 
					                        </td>

                                            <td class="">
                                               <?php echo $invoiceDataList['SalesInvoice']['statement_no'];?>
                                            </td>

					                        <td class="">
					                            <?php echo $invoiceDataList['SalesInvoice']['dr_uuid'];?>
					                        </td>
					                        
					                        <td class="text-center">
					                            <?php 
					                            	if ($invoiceDataList['SalesInvoice']['status'] == 1) {
					                            		echo "<span class='label label-success'>Invoice</span>";
					                            	} else {
					                            		echo "<span class='label label-success'>Pre-Invoice</span>";
					                            	}
					                            ?>
					                        </td>

					                       	<td>
					                            <?php
					                               echo $this->Html->link('<span class="fa-stack">
								                    <i class="fa fa-square fa-stack-2x"></i>
								                    <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print </font></span>
								                    </span> ', array('controller' => 'sales_invoice', 'action' => 'print_invoice',$invoiceDataList['SalesInvoice']['id']),array('class' =>' table-link','escape' => false,'title'=>'Print Information','target' => '_blank'));

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
