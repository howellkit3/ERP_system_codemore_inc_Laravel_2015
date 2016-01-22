<?php $this->Html->addCrumb('Accounting', array('controller' => 'sales_invoice', 'action' => 'index')); ?>

<?php echo $this->element('account_option'); ?>

<?php echo $this->Html->script('Accounting.accounting');?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Create Sales Invoice</b></h2>
                
                <div class="filter-block pull-right">
                    <div class="form-group pull-left">
                
                        <input placeholder="Search..." class="form-control searchDR"  />
                        <i class="fa fa-search search-icon"></i>
                    
                </div>

                </div>
            </header>

            <div class="main-box-body clearfix">

         
 <div class="panel-group accordion" id="accordion">                   
<?php 
    $dr = '';
    foreach ($deliveryData as $deliveryDataList ):
    //pr($deliveryDataList['Delivery']['clients_order_id']); exit;
    if($deliveryDataList['Delivery']['status'] != 2 ){  ?>



     <div class="panel panel-default">
             <?php if ($dr != $deliveryDataList['Delivery']['dr_uuid']) : ?>
                   
                        <div class="panel-heading">
                       
                            <div class="col-lg">
                                 <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $deliveryDataList['Delivery']['dr_uuid']; ?>">
                                    <span class="title"> DR # : </span> <?php echo str_pad($deliveryDataList['Delivery']['dr_uuid'],5,'0',STR_PAD_LEFT); ?>   
                                    </a>
                            </h4>
                            </div>
                        </div>
                        <div id="<?php echo $deliveryDataList['Delivery']['dr_uuid']; ?>" class="panel-collapse collapse" style="height: 2px;">
                            <div class="panel-body">

                            <?php $items = $this->AccountingFunction->getItems($deliveryDataList['Delivery']['dr_uuid']);


                            if (!empty($items) && is_array($items)) { ?>


                            <a href="#processModal" class="modal_button" data-toggle="modal" data-id="<?php echo $deliveryDataList['Delivery']['id'] ?>" data-uuid="<?php echo $deliveryDataList['Delivery']['dr_uuid'] ?>">
                            <button class="btn btn-success" href="print_sales_invoice">
                                    PRINT S.I
                            </button>
                            </a>
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
                                        
                            </div>
                        </div>
                

            <?php endif; ?>
 </div>

<?php 

$dr =$deliveryDataList['Delivery']['dr_uuid'];
 }

 endforeach; ?> 

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

<script>

    jQuery(document).ready(function($){
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

        if(searchInput != ''){

            $('.OrderFields').hide();
            $('.searchAppend').show();

        }else{
            $('.OrderFields').show();
            $('.searchAppend').hide();
        }

        type = 1;

        $.ajax({
                type: "GET",
                url: serverPath + "accounting/sales_invoice/search_order/"+view+"/"+searchInput+"/"+type+"/"+indicator,
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

    $('.searchDR').keypress(function() {

        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }

        timeout = setTimeout(searchDR,600)
    })

</script>