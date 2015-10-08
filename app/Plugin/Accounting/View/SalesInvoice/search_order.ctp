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
                
                <a data-toggle="modal" href="#processModal" class="modal_button table-link " value="<?php echo $deliveryDataList['Delivery']['id']?>" deliveryUUID="<?php echo $deliveryDataList['Delivery']['dr_uuid']?>"><i class="fa fa-lg "></i><span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x "></i>
                                            <i class="fa  fa-plus-circle fa-stack-1x fa-inverse  "></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Invoice</font></span></a> 
      
            </td>
        </tr>

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






