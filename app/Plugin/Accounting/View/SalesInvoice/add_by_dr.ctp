<?php $this->Html->addCrumb('Accounting', array('controller' => 'sales_invoice', 'action' => 'index')); ?>

<?php echo $this->element('account_option'); ?>

<?php echo $this->Html->script('Accounting.accounting');?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
              <?php echo $this->element('invoice_option'); ?>
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Create Sales Invoice</b></h2>
                
                <div class="filter-block pull-right">
                    <div class="form-group pull-left">
                        <?php echo $this->Form->create('SalesInvoice',array('url' => array('controller' => 'sales_invoice','action' => 'add','dr_num')));?>
                        <input placeholder="Search..." class="form-control searchDR" value="<?php echo $search; ?>"  name="search"/>
                        <i class="fa fa-search search-icon"></i>

                        <?php echo $this->Form->end(); ?>
                    
                </div>

                </div>
            </header>

<div class="main-box-body clearfix" id="result-table-list">

        <table class="table footable toggle-circle-filled" data-page-size="6" data-filter="#filter" data-filter-text-only="true">
        <thead>
        <tr>
        <th>Delivery Number</th>
        <th>Delivery Sched</th>
        <th data-hide="phone">Company</th>
        <th data-hide="phone,tablet" class="text-center">Action</th>

        <th data-hide="all" class="text-right"> 
        &nbsp </th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $dr = '';
            foreach ($deliveryData as $deliveryDataList ):
            //pr($deliveryDataList['Delivery']['clients_order_id']); exit;
            if($deliveryDataList['Delivery']['status'] != 2 ){ 

            $clientData = $this->AccountingFunction->getDetails($deliveryDataList['Delivery']['clients_order_id']);

            $items = $this->AccountingFunction->getItems($deliveryDataList['Delivery']['dr_uuid']);

         ?>
        <tr>
        <td>
        <a href="#"> #<?php echo str_pad($deliveryDataList['Delivery']['dr_uuid'],5,'0',STR_PAD_LEFT); ?> </a>
        </td>
        <td>
        <?php echo !empty($clientData[0]['ClientOrderDeliverySchedule']['schedule']) ? $clientData[0]['ClientOrderDeliverySchedule']['schedule'] : '' ?>
        </td>
        <td>
        <a href="#"><?php echo !empty($clientData[0]['Company']['company_name']) ? $clientData[0]['Company']['company_name'] : '' ?></a>
        </td>
        <td class="text-center">

                                    <a href="#processModal" class="modal_button" data-toggle="modal" data-id="<?php echo $deliveryDataList['Delivery']['id'] ?>" data-uuid="<?php echo $deliveryDataList['Delivery']['dr_uuid'] ?>">
                                    <button class="btn btn-success" href="print_sales_invoice">
                                            PRINT S.I
                                    </button>
                                    </a>
        </td>



                                           

        <td class="text-right">
                        
                        <?php if (!empty($items) && is_array($items)) { ?>


                                    <table class="table table-striped table-hover ">
                                        <thead>
                                            <tr>
                                                <th><span>CLients Order # </span></th>
                                                <th><span>DR #</span></th>
                                                <th><span>PO number </span></th>
                                                <th class="text-center"><span>Schedule</span></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php foreach ($items as $key => $value) : ?>
                                                    
                                                <tr>
                                                <td>
                                               <?php echo $value['ClientOrder']['uuid']?>
                                                </td>
                                                <td>
                                                    <?php echo $value['Delivery']['dr_uuid']?>
                                                </td>
                                                 <td>
                                                    <?php echo $value['ClientOrder']['po_number']?>
                                                </td>
                                                
                                                <td class="text-center">
                                                  <?php echo !empty($value['ClientOrderDeliverySchedule']['schedule']) ? date('Y-m-d', strtotime($value['ClientOrderDeliverySchedule']['schedule'])) : '' ?>
                                                </td>
                                                </tr>

                                        <?php endforeach; ?>
                                         </tbody>
                                            </table>

                                   
                                   <?php  }  ?> 
        </td>
        </tr>

        <?php } ?>
        <?php endforeach; ?>
        </tbody>
        </table>
<section class = "indicator" value = "<?php echo $indicator;?>"> </section>

                    <div class="paging" id="dr_pagination">
                            <?php

                            echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Delivery','model' => 'Delivery'), null, array('class' => 'disable','model' => 'Delivery'));
                            echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Delivery'), array('paginate' => 'Delivery'));
                            echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Delivery','model' => 'Delivery'), null, array('class' => 'disable'));
                            ?>

                   </div>
               
 </div>
            </div>
    </div>
</div>


    <div class="modal fade" id="processModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Create Sales Invoice</h4>
                </div>
                <div class="modal-body">
                    <div id="result-table">

                    </div>
                </div>
                
            </div>
        </div>
    </div>


<script>

    jQuery(document).ready(function($){

        $('.footable').footable();
  

        $("#SalesInvoiceAddForm").validate();


          $('body').on('click','.modal_button',function(){

            var indicator = $('.indicator').attr('value');
            var deliveryId = $(this).attr('data-id');
            var deliveryUUID = $(this).attr('data-uuid');

            var multipleItem = true

            $container = $('#result-table');

            $.ajax({
            url: serverPath + "accounting/sales_invoice/invoice_modal/"+deliveryId+"/"+deliveryUUID+"/si_num/is_multiple",
            type: "GET",
            dataType: "html",
           
            success: function(data) {
                
                $container.html(data); 
                
                }
            });
        });
            
    });

    function searchDR(searchInput) {

        var searchInput = $('.searchDR').val();

        var indicator = $('.indicator').attr("value");

        var view = "index";

        // if(searchInput != ''){

        //     $('.OrderFields').hide();
        //     $('.searchAppend').show();

        // }else{
        //     $('.OrderFields').show();
        //     $('.searchAppend').hide();
        // }

        type = 1;

        $.ajax({
                type: "POST",
                url: serverPath + "accounting/sales_invoice/add/dr_num",
                data : {"search" : searchInput },
                dataType: "html",
                success: function(data) {

                    if(data){

                        $('#result-table-list').html(data);

                    } 
                    if (data.length < 5 ) {

                        $('#result-table-list').html('<font color="red"><b>No result..</b></font>');
                         
                    }

                   $('.footable').footable();
                    
                    
                }
            });
    }

    var timeout;

    $('.searchDR').keypress(function() {

        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }

        timeout = setTimeout(searchDR,600)
    })

</script>