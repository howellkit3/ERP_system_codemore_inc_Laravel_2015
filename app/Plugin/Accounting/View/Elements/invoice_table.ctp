<?php foreach ($deliveryData as $deliveryDataList ):?>


        <tr class="">

            <td class="">
                <?php echo $deliveryDataList['Delivery']['clients_order_id'] ?>  
            </td>
            <td class="">
                <?php echo $poNumber[$deliveryDataList['Delivery']['clients_order_id']] ?>
                
            </td>
            <td class="">
                <?php echo $companyData[$deliveryDataList['Delivery']['company_id']] ?>..
            </td>
            <td class="">
                <?php echo $deliveryDataList['Delivery']['dr_uuid']; ?>
            </td>
            
            <td>

             <!--  <?php  echo $this->Html->link($subProcessData[$processList['ProductSpecificationProcessHolder']['sub_process_id']], 
                            '#processModal'
                            ); ?> -->

               <!-- <button type="submit" class="btn btn-success modal_button" value="<?php echo $deliveryDataList['Delivery']['id']?>"><i class="fa fa-plus-circle fa-lg"></i></button> -->
                
                <a data-toggle="modal" href="#processModal" class="modal_button table-link " value="<?php echo $deliveryDataList['Delivery']['id']?>" deliveryUUID="<?php echo $deliveryDataList['Delivery']['dr_uuid']?>"><i class="fa fa-lg "></i><span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x "></i>
                                            <i class="fa  fa-plus-circle fa-stack-1x fa-inverse  "></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Invoice</font></span></a> 
      
            </td>
        </tr>

    <!-- <div class="modal fade" id="myModalReturn<?php echo $deliveryDataList['Delivery']['id'] ?>" role="dialog" >
            <div class="modal-dialog">
                <div class="modal-content margintop">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Invoice Details</h4>
                    </div> 

                    <div class="modal-body">

                        <?php 

                            echo $this->Form->create('InvoiceForm',array(
                                'url'=>(array('controller' => 'sales_invoice','action' => 'add_invoice', $deliveryDataList['Delivery']['dr_uuid'] )),'class' => 'form-horizontal')); 
                        ?>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"><span style="color:red">*</span>Customer</label>
                                <div class="col-lg-8">
                                    <?php 
                                        echo $this->Form->input('SalesInvoice.customer', array(
                                            'options' => array('Regular', 'APC'),
                                            'alt' => 'Status',
                                            'label' => false,
                                            'class' => 'form-control col-lg-4 required customer',
                                            'empty' => '--Select Customer--'
                                            ));
                                    ?>
                                </div>
                            </div>
                            
                            <br><br>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"><span style="color:red">*</span>Status</label>
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
                            </div>

                            <br><br>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"><span style="color:red">*</span>Invoice Number</label>
                                <div class="col-lg-8">
                                    <?php 
                                        echo $this->Form->input('SalesInvoice.sales_invoice_no', array(
                                            'class' => 'form-control item_type required',
                                            'label' => false,
                                            'readonly' => true,
                                            'value' => $seriesSalesNo,
                                            'placeholder' => 'Invoice No.'));
                                    ?>
                                </div>
                            </div>

                            <br><br>

                            <div class="form-group delivery_number" style = "margin-bottom:60px;" >
                                <label class="col-lg-3 control-label"><span style="color:red">*</span>Delivery Number</label>
                                <div class="col-lg-8">
                                    <?php 
                                        echo $this->Form->input('SalesInvoice.dr_uuid', array(
                                            'class' => 'form-control item_type required ',
                                            'label' => false,
                                            'readonly' => true,
                                            'value' => $deliveryDataList['Delivery']['dr_uuid'],
                                            'placeholder' => 'Invoice No.'));
                                    ?>

                                </div>
                            </div>

                            
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        <?php echo $this->Form->end();  ?> 
                    </div>
                </div>
            </div>
        </div>  -->

    <div class="modal fade" id="processModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Invoice Details</h4>
                </div>
                <div class="modal-body">
                    <div id="result-table">

                    </div>
                </div>
                
            </div>
        </div>
    </div>

<?php endforeach; ?> 

<script>

    $(document).ready(function(){

        $('body').on('click','.modal_button',function(){

            var deliveryId = $(this).attr('value');
            var deliveryUUID = $(this).attr('deliveryUUID');
            
            $container = $('#result-table');

            $.ajax({
            url: serverPath + "accounting/sales_invoice/invoice_modal/"+deliveryId+"/"+deliveryUUID,
            type: "GET",
            dataType: "html",
           // data : { 'processId' : $processId , 'subProcess' : $subProcess , 'ticketId' : $ticketUuid },
            success: function(data) {
                
                $container.html(data); 
                
                }
            });
        });
    });

</script>




