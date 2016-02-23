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

                     <a href="#addByDr" data-toggle="modal" > <button class="btn btn-success"> Create Invoice </button></a>

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

                                            <a href="#addItem" data-toggle="modal" data-dr-uuid="<?php echo $deliveryDataList['Delivery']['dr_uuid'];  ?>" class="btn btn-danger"> ADD ITEM </a>



                                   
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

    <div class="modal fade" id="addItem" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Item to this DR</h4>
                </div>
                <div class="modal-body">
                    <div id="result-table">
                        <div class="modal-body">

                               <div class="form-group">
                                    <label class="col-lg-3 control-label"><span style="color:red">*</span> CLIENTS ORDER </label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('clients_order', array(
                                               'alt' => 'Clients Order',
                                                'label' => false,
                                                'class' => 'form-control col-lg-4 required',
                                                ));
                                        ?>
                                    </div>
                                </div>                                
                                <div class="result_fields">
                                </div>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>


       <div class="modal fade" id="addByDr" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add DR to Invoice</h4>
                </div>
                <div class="modal-body">
                    <div id="result-table">
                        <div class="modal-body">
                            <?php echo $this->Form->create('SalesInvoice',array('url' => array('controller' => 'sales_invoice', 'action' => 'create_multiple_apc'))); ?>

                               <div class="form-group">
                                    <label class="col-lg-3 control-label"><span style="color:red">*</span> Invoice Number </label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('sales_invoice', array(
                                               'alt' => 'Clients Order',
                                                'label' => false,
                                                'class' => 'form-control col-lg-4 required',
                                                'value' => $seriesSalesNo,
                                                'readonly' => true
                                                ));
                                        ?>
                                    </div>
                                </div>    
                                <div class="clearfix"></div>
                                <br>
                               <div class="form-group">
                                    <label class="col-lg-3 control-label"><span style="color:red">*</span> Delivery Number </label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('dr_uuid', array(
                                               //'alt' => 'Clients Order',
                                                'label' => false,
                                                'class' => 'form-control col-lg-4 required',
                                               // 'value' => $seriesSalesNo
                                                ));
                                        ?>
                                    </div>
                                </div>                 
                                 
                            <div class="clearfix"></div>
                                <div class="result_fields">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"> Search DR </label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('dr_uuid_search', array(
                                               //'alt' => 'Clients Order',
                                                'label' => false,
                                                'class' => 'form-control col-lg-4',

                                               // 'value' => $seriesSalesNo
                                                ));
                                       
                                            echo $this->Form->input('delivery_ids', array(
                                               'type' => 'hidden',
                                                'label' => false,
                                                'class' => 'form-control col-lg-4',

                                               // 'value' => $seriesSalesNo
                                                ));
                                        ?>
                                    </div>
                                </div> 
                                    <div class="form-group">
                                        <label class="col-lg-12 control-label"> Selected DR : <div class="select_cont"><ul></ul></div>
                                        </label>

                                    </hr>
                                        <div class="col-lg-12" id="resultDrTable">
                                            <ul>
                                                <?php foreach ($allItems as $key => $value) { ?>
                                                <li>
                                                        <input type="checkbox" value="<?php echo $value; ?>" name="data[SalesInvoice][dr_number][]">
                                                        <?php echo $value; ?>
                                                </li>   
                                               <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                </div>

                                <?php echo $this->Form->end(); ?>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>

<style>
    .result_fields li {
  display: inline-block;
  list-style: outside none none;
  width: 16%;
}

.tags {
  background:#03a9f4;
  border-radius: 6px;
  color: #fff;
  margin: 3px 4px;
  text-align: center;
}

.tags .fa.fa-close {
  float: right;
  margin: 3px;
  cursor: pointer;
}

.select_cont {
  border-bottom: 1px solid #ccc;
  margin-bottom: 13px;
}
</style>
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
    });

    
    function searchOrder(searchInput) {

        $.ajax({
                type: "GET",
                url: serverPath + "accounting/sales_invoice/search_dr",
                data : {"uuid" : searchInput },
                dataType: "HTML",
                success: function(data) {

                    $('#resultDrTable').html(data);
                }
            });
    }


    var timeout;

    $('#SalesInvoiceDrUuidSearch').keyup(function() {

        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }
        
        timeout = setTimeout(searchOrder($(this).val(),7000));
    });

    $('body').on('click','#resultDrTable input',function(){
         
     
        $this = $(this);
        
        $values = $('#SalesInvoiceDeliveryIds').val();


        if ($this.is(':checked')) {

            $tags = '<li>';
            $tags += '<div class="tags" data-id="'+$this.val()+'">'
            $tags += $this.val();
            $tags += '<i class="fa fa-close"></i></div>';
            $tags += '</li>';

            $('.select_cont').append($tags);

            $values =  $values + (!$values ? '' : ', ') + $this.val();

            $('#SalesInvoiceDeliveryIds').val($values);

         }



    });

      $('body').on('click','.tags .fa-close',function(){

            $parent = $(this).parent();

            $parent.parent().remove();

            $list = $('#SalesInvoiceDeliveryIds').val();

              $text =  $list.replace($parent.data('id'),'');

             $('#SalesInvoiceDeliveryIds').val($text);
      });
</script>