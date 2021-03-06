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
                                    'action' => 'add','si_num'),
                            array('class' =>'btn btn-primary pull-right',
                                'escape' => false));

                    ?> 

                    <div class="form-group pull-left">
                
                        <input placeholder="Search..." class="form-control searchSI"  />
                        <i class="fa fa-search search-icon"></i>
                    
                	</div>

                  <br><br>
               </div>
            </header>
             
			<div class="main-box-body clearfix">
			    <div class="table-responsive">

					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><a href="#"><span>Sales Invoice No.</span></a></th>
								<th><a href="#"><span>Delivery No.</span></a></th>
								<th><a href="#"><span>Company</span></a></th>
								<th class="text-center"><a href="#"><span>Status</span></a></th>
								<th><a href="#"><span>Action</span></a></th>
							</tr>
						</thead>
						<?php 
					        if(!empty($invoiceData)){ ?>

				            	<tbody aria-relevant="all" aria-live="polite" class="OrderFields" role="alert" >

				            		<?php foreach ($invoiceData as $invoiceDataList): ?>

				                    <tr class="">

				                        <td class="">
				                            <?php echo $invoiceDataList['SalesInvoice']['sales_invoice_no'];?> 
				                        </td>

				                        <td class="">

				                            <?php echo str_pad($invoiceDataList['SalesInvoice']['dr_uuid'],5,'0',STR_PAD_LEFT);?>
				                        </td>

				                        <td class="">
				                            <?php  

				                            echo $companyName[$clientDataHolder[$deliveryNumHolder[$invoiceDataList['SalesInvoice']['dr_uuid']]]];?>
				                        </td> 
				                        
				                        <td class="text-center">
				                            <?php 
				                            	if ($invoiceDataList['SalesInvoice']['status'] == 1) {

				                            		echo "<span class='label label-success'>Invoice</span>";

				                            	} else if($invoiceDataList['SalesInvoice']['status'] == 5){

				                            		echo "<span class='label label-danger'>Terminated</span>";

				                            	} else if($invoiceDataList['SalesInvoice']['status'] == 3){

				                            		echo "<span class='label label-danger'>Cancel</span>";


				                            	}else{

				                        			echo "<span class='label label-info'>Pre-Invoice</span>";
				                            	}
				                            ?>
				                        </td>

				                       	<td>
				                       		<?php

				                       		if($invoiceDataList['SalesInvoice']['status'] == 3){

				                       			$status = " not-active";

				                       		}else{

				                       			$status = " active";

				                       		}

				                       		?>

				                            <?php

				                            	echo $this->Html->link('<span class="fa-stack">
							                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'sales_invoice', 'action' => 'view',$invoiceDataList['SalesInvoice']['id'],0,
							                    	$invoiceDataList['SalesInvoice']['dr_uuid'],
							                    	$invoiceDataList['SalesInvoice']['sales_invoice_no']
							                    	), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
							                    ));
				        
				                            ?>

				                            <?php

				                            	echo $this->Html->link('<span class="fa-stack">
							                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-paper-plane  fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> Move</font></span></span> ', array('controller' => 'sales_invoice', 'action' => 'move',$invoiceDataList['SalesInvoice']['id'],0,$invoiceDataList['SalesInvoice']['dr_uuid']), array('class' =>' table-link' . $status ,'escape' => false, 'title'=>'Move to Statement of Acccount', 'confirm' => 'Do you want to move this Sales Invoice to Statement of Account?'
							                    ));
				        
				                            ?>

				                            <?php

				                            	echo $this->Html->link('<span class="fa-stack">
							                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash  fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> Cancel </font></span></span> ', array('controller' => 'sales_invoice', 'action' => 'cancel',$invoiceDataList['SalesInvoice']['id']), array('class' =>' table-link','escape' => false, 'title'=>'Cancel Sales Invoice'
							                    ));
				        
				                            ?>

				                        </td>
				                    </tr>

				                <?php endforeach; } ?> 

				               	</tbody>
		                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
		                        </tbody>
					        
					</table>
					<hr>
                        <div class="paging" id="dr_pagination">
                        <?php

                        echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'SalesInvoice','model' => 'SalesInvoice'), null, array('class' => 'disable','model' => 'SalesInvoice'));
                        echo $this->Paginator->numbers(array('separator' => '','paginate' => 'SalesInvoice'), array('paginate' => 'SalesInvoice'));
                        echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'SalesInvoice','model' => 'SalesInvoice'), null, array('class' => 'disable'));
                        ?>

                        </div>	
				</div>
			</div>
	    </div>
    </div>
</div>

<script>

	function searchSI(searchInput) {

	    var searchInput = $('.searchSI').val();

	    var view = "index";

	    if(searchInput != ''){

	        $('.OrderFields').hide();
	        $('.searchAppend').show();

	    }else{
	        $('.OrderFields').show();
	        $('.searchAppend').hide();
	    }

	    type = 0;

	    $.ajax({
	            type: "GET",
	            url: serverPath + "accounting/sales_invoice/search_order/"+view+"/"+searchInput+"/"+type,
	            dataType: "html",
	            success: function(data) {

	                if(data){

	                    $('.searchAppend').html(data);

	                } 
	                if (data.length < 5 ) {

	                    $('.searchAppend').html('<font color="red"><b>No result..</b></font>');
	                     
	                }
	                
	            }
	        });
	}

	var timeout;

	$('.searchSI').keypress(function() {

	    if(timeout) {
	        clearTimeout(timeout);
	        timeout = null;
	    }

	    timeout = setTimeout(searchSI,600)
	})

</script>
