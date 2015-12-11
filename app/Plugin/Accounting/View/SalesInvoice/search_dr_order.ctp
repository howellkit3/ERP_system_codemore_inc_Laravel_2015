<?php foreach ($deliveryData as $deliveryDataList ):

    if($deliveryDataList['Delivery']['status'] != 2 ){?>

        <tr class="">

            <td class="">
                <?php echo $deliveryDataList['Delivery']['clients_order_id'] ?>  
            </td>
            <td class="">
                <?php echo $deliveryDataList['ClientOrder']['po_number'] ?>
                
            </td>
            <td class="">
                <?php echo $deliveryDataList['Company']['company_name'] ?>..
            </td>
            <td class="">
                <?php echo $deliveryDataList['Delivery']['dr_uuid']; ?>
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

    <div class="modal fade" id="processModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $heading?></h4>
                </div>
                <div class="modal-body">
                    <div id="result-table">

                    </div>
                </div>
                
            </div>
        </div>
    </div>

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




