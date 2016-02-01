<?php foreach ($deliveryData as $deliveryDataList ):
    //pr($deliveryDataList['Delivery']['clients_order_id']); exit;
    if($deliveryDataList['Delivery']['status'] != 2 ){?>

        <tr class="">

            <td class="">
                CO-<?php echo $deliveryDataList['Delivery']['clients_order_id'] ?>  
            </td>
            <td class="">
                <?php 

                $po_number  = $this->AccountingFunction->findByClientOrder($deliveryDataList['Delivery']['clients_order_id']);

                echo  $po_number[0]['ClientOrder']['po_number'];
                
                // echo !empty($poNumber[$deliveryDataList['Delivery']['clients_order_id']]) ? $poNumber[$deliveryDataList['Delivery']['clients_order_id']] : "" ; ?>
                
            </td>
            <td class="">
                <?php echo $companyData[$deliveryDataList['Delivery']['company_id']] ?>..
            </td>
            <td class="">
                <?php echo str_pad($deliveryDataList['Delivery']['dr_uuid'],5,'0',STR_PAD_LEFT); ?>
            </td>
            <td>
                <?php if($indicator == "si_num" ){

                    $label = " S.I.";
                    $heading = "Sales Invoice Details";

                }else{

                    $label = " S.A.";
                    $heading = " Statement of Account Details";

                } ?>

                <a data-toggle="modal" href="#processModal" class="modal_button table-link " value="<?php echo $deliveryDataList['Delivery']['id']?>" deliveryUUID="<?php echo $deliveryDataList['Delivery']['dr_uuid']?>"><i class="fa fa-lg "></i><span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x "></i>
                    <i class="fa  fa-plus-circle fa-stack-1x fa-inverse  "></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"><?php echo $label?></font></span></a> 
      
            </td>

            <label class = "indicator" value = "<?php echo $indicator?>"></label>
        </tr>


<?php 
    }
    
    endforeach; ?> 

<script>

    $(document).ready(function(){

        $('body').on('click','.modal_button',function(){

            var indicator = $('.indicator').attr('value');
            var deliveryId = $(this).attr('value');
            var deliveryUUID = $(this).attr('deliveryUUID');

            $container = $('#result-table');

            $.ajax({
            url: serverPath + "accounting/sales_invoice/invoice_modal/"+deliveryId+"/"+deliveryUUID+"/"+indicator,
            type: "GET",
            dataType: "html",
           
            success: function(data) {
                
                $container.html(data); 
                
                }
            });
        });
    });

</script>




