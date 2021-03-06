<?php //echo $this->element('account_option'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
		
			<header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Consumables Items</b></h2>
                <div class="filter-block pull-right">
                   <?php 

                   	echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add Consumables', 
                            array('controller' => 'consumables', 
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
								<th><a href="#"><span> # </span></a></th>		
                                <!-- <th><a href="#"><span>Statement of Account No.</span></a></th> -->
								<th><a href="#"><span>Item</span></a></th>

								<th><a href="#"><span> Item Category </span></a></th>
								<th><a href="#"><span> Item Description </span></a></th>
								<th><a href="#"><span> Supplier </span></a></th>
								<th><a href="#"><span> Remaining Stocks	 </span></a></th>

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

                                           <!--  <td class="">
                                               <?php echo $invoiceDataList['SalesInvoice']['statement_no'];?>
                                            </td> -->

					                        <td class="">
					                            <?php echo $invoiceDataList['SalesInvoice']['dr_uuid'];?>
					                        </td>
					                        
					                        <td class="text-center">
					                            <?php 
					                            	if ($invoiceDataList['SalesInvoice']['status'] == 1) {
					                            		echo "<span class='label label-success'>Invoice</span>";
					                            	} else if($invoiceDataList['SalesInvoice']['status'] == 5){
					                            		echo "<span class='label label-danger'>Terminated</span>";
					                            	}else{
					                        			echo "<span class='label label-info'>Pre-Invoice</span>";
					                            	}
					                            ?>
					                        </td>

					                       	<td>
					                            <?php

					                            	echo $this->Html->link('<span class="fa-stack">
								                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'sales_invoice', 'action' => 'view',$invoiceDataList['SalesInvoice']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
								                    ));
					                       //         echo $this->Html->link('<span class="fa-stack">
								                    // <i class="fa fa-square fa-stack-2x"></i>
								                    // <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print </font></span>
								                    // </span> ', array('controller' => 'sales_invoice', 'action' => 'print_invoice',$invoiceDataList['SalesInvoice']['id']),array('class' =>' table-link','escape' => false,'title'=>'Print Information','target' => '_blank'));

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
