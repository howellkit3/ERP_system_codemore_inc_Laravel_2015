<?php //pr($deliveryData); exit;

  if(!empty($deliveryData)){ ?>

      <?php  foreach ($deliveryData as $deliveryDataList): ?>
        <tr class="">

            <td class="">
                  <?php echo $deliveryDataList['Delivery']['dr_uuid']; ?>
            </td>

            <td class="">
                  <?php echo substr($deliveryDataList['Company']['company_name'],0,25); ?>..
            </td>

            <td class="">
                  <?php echo $deliveryDataList['Product']['name']; ?>
            </td>

            <td class="">
                  <?php echo $deliveryDataList['Delivery']['clients_order_id']; ?>
            </td>

            <td class="">
                  <?php echo $deliveryDataList['ClientOrder']['po_number']; ?>
            </td>

            <td class="">
                <?php echo date('M d, Y',strtotime($deliveryDataList['DeliveryDetail']['schedule'])); ?>
            </td>

            <td class="">
              <?php echo  $deliveryDataList['DeliveryDetail']['quantity']; ?> <br>
            </td>

         <!--    <td class="">
                <?php echo !empty($deliveryDataList['DeliveryDetail']['delivered_quantity']) ? $deliveryDataList['DeliveryDetail']['delivered_quantity'] : 0 ; ?> <br>
            </td> -->

            <td class="">
  
             <?php  if ($deliveryDataList['DeliveryDetail']['delivered_quantity'] == $deliveryDataList['DeliveryDetail']['quantity']) {  ?>

                <?php echo "<span class='label label-success'>Complete</span>";  ?>

              <?php }else{ ?>

                <?php echo "<span class='label label-warning'>Delivering</span>";  ?>
             
              <?php } ?>

            </td>

        </tr>
          <?php endforeach; } ?> 
            


<style>

  .textfieldwidth{
    width: 410px;
  }

</style>
