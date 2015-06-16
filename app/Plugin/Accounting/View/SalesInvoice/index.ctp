<?php echo $this->element('account_option'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">

            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Sales Invoice List</b></h2>
                <div class="filter-block pull-right">
                   <?php
                    //pr($truckAvailability);
                    //pr($truckId);
                      echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Create Sales Invoice ', 
                            array('controller' => 'sales_invoice', 
                                    'action' => 'add',),
                            array('class' =>'btn btn-primary pull-right',
                                'escape' => false));


                    ?> 
                    <!-- <a data-toggle="modal" href="#myModalInvoice" class="btn btn-primary mrg-b-lg pull-right"><i class="fa fa-plus-circle fa-lg"></i> Create Sales Invoice</a> --> 

                   <br><br>
               </div>
            </header>
             
			<div class="main-box-body clearfix">
			    <div class="table-responsive">

					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><a href="#"><span>Sales Invoicce No.</span></a></th>
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
					                            <?php echo $invoiceDataList['SalesInvoice']['dr_uuid'];?>
					                        </td>
					                        <td class="text-center">
					                            <?php 
					                            	if($invoiceDataList['SalesInvoice']['status'] == 0){ ?>
					                            		<span class="label label-info">Pre-Invoice</span>
					                            <?php 
					                            	}else{ ?>
					                            		<span class="label label-success">Invoice</span>
					                            <?php
					                            	}
					                            ?>
					                        </td>
					                       	<td>
					                            <?php
					                               echo $this->Html->link('<span class="fa-stack">
								                    <i class="fa fa-square fa-stack-2x"></i>
								                    <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print </font></span>
								                    </span> ', array('controller' => 'sales_invoice', 'action' => 'print_invoice',$invoiceDataList['SalesInvoice']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information','target' => '_blank'));

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

<div class="modal fade" id="myModalInvoice" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create Sales Invoice</h4>
            </div>
            <div class="modal-body">
             <?php echo $this->Form->create('SalesInvoice',array('url'=>(array('controller' => '','action' => '')),'class' => 'form-horizontal'));?>
                <?php 
                    // echo $this->Form->input('Company.id', array('class' => 'form-control item_type required',
                    //     'type' => 'hidden',
                    //     'value' => $company['Company']['id']));
                    // echo $this->Form->input('Address.model', array('class' => 'form-control item_type required',
                    //     'type' => 'hidden',
                    //     'value' => 'Company'));
                ?>

                    <div class="form-group">
                        <label class="col-lg-2 control-label"> Invoice No.</label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('SalesInvoice.sales_invoice_no', array('class' => 'form-control ',
                                    'alt' => 'city',
                                    'label' => false));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label">Delivery No.</label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('SalesInvoice.dr_no', array('class' => 'form-control ',
                                    'alt' => 'state_province',
                                    'label' => false));
                            ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                         <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Add Invoice</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>
               <?php echo $this->Form->end(); ?>
                
            </div>
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="md-overlay"></div>
