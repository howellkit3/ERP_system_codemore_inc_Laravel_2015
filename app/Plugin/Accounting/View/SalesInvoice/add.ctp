<?php $this->Html->addCrumb('Accounting', array('controller' => 'sales_invoice', 'action' => 'index')); ?>

<?php echo $this->element('account_option'); ?>

<?php echo $this->Html->script('Accounting.accounting');?>




<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Approved Clients Order</b></h2>
                
                <div class="filter-block pull-right">
                    <div class="form-group pull-left">
                
                        <input placeholder="Search..." class="form-control searchOrder"  />
                        <i class="fa fa-search search-icon"></i>
                    
                </div>

                </div>
            </header>

            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr> 
                                <th><a href="#"><span>Client Order Number</span></a></th>
                                <th><a href="#"><span>PO Number</span></a></th>
                                <th><a href="#"><span>Item Name</span></a></th>
                                <th><a href="#"><span>DR Number</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="OrderFields" role="alert">
                            <?php echo $this->element('invoice_table'); ?>
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" style="display:none;">
                        </tbody>
 
                    </table>
                    <hr>

                <div class="paging" id="dr_pagination">
                        <?php

                        echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Delivery','model' => 'Delivery'), null, array('class' => 'disable','model' => 'Delivery'));
                        echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Delivery'), array('paginate' => 'Delivery'));
                        echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Delivery','model' => 'Delivery'), null, array('class' => 'disable'));
                        ?>

                        </div>
                <?php //echo $this->Html->image('loader.gif', array('class' => 'hide', 'id' => 'loader')); ?>
                <?php //echo $this->Js->writeBuffer(); ?>
                </div>
                <div hidden>
                    <ul class="pagination pull-right" >
                        <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
    
        </div>
    </div>
</div>
<!-- 
<div class="form-group">
				<label class="col-lg-2 control-label"><span style="color:red">*</span>Status</label>
				<div class="col-lg-8">
					<?php 
                        echo $this->Form->input('SalesInvoice.status', array(
                            'options' => array('Pre-Invoice', 'Invoice'),
                            'alt' => 'Status',
                            'label' => false,
                            'class' => 'form-control col-lg-4 required',
                            'empty' => '--Select Status--'
                        	));
                    ?>
				</div>
			</div> -->

	<!-- <div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<div class="top-space"></div>
				<div class="main-box-body clearfix">
					<div class="main-box-body clearfix">
						<div class="form-horizontal">

                            <div class="form-group">
								<label class="col-lg-2 control-label"></label>
								<div class="col-lg-1">
									<button type="submit" class="btn btn-success pull-left">Save</button>
								</div>
								<div class="col-lg-3">
									<?php
				                        echo $this->Html->link('Cancel', array('controller' => 'salesInvoice','action' => 'index'), array(
											'class' =>'pull-left btn btn-default',
											'escape' => false
											));
					                ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->


<script>
		
	jQuery(document).ready(function($){
		$("#SalesInvoiceAddForm").validate();
			
	});


	 $("body").on('keyup','.searchOrder', function(e){

        var searchInput = $(this).val();

        var view = "add";
    
        //alert(searchInput);
        if(searchInput != ''){

            $('.OrderFields').hide();
            $('.searchAppend').show();
            //alert('hide');

        }else{
            $('.OrderFields').show();
            $('.searchAppend').hide();
            //alert('show');
        }
        
        $.ajax({
            type: "GET",
            url: serverPath + "accounting/sales_invoice/search_order/"+searchInput+"/"+view,
            dataType: "html",
            success: function(data) {

                //alert(data);

                if(data){

                    $('.searchAppend').html(data);

                } 
                if (data.length < 5 ) {

                    $('.searchAppend').html('<font color="red"><b>No result..</b></font>');
                     
                }
                
            }
        });

    });

</script>