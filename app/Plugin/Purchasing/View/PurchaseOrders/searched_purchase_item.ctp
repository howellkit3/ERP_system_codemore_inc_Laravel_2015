<?php foreach ($requestItemData  as $key => $list) { ?>

    <?php 
        $modelTable = $list['model'];
        $ItemTable = $list['modelItem'];
    ?>
    <tr>
        <td>
            <?php echo $list[$ItemTable]['name'] ?>
        </td>
        <td>
            <?php if(!empty($supplierData[$list['PurchaseOrder']['supplier_id']])){?>
                <?php echo $supplierData[$list['PurchaseOrder']['supplier_id']] ?>
              <?php } ?>
        </td>
     
        <td>
            <?php echo $list[$modelTable]['pieces'] ?>
        </td>
        <td>
            <?php echo $list[$modelTable]['unit_price'] ?>
        </td>
        <td>
          <?php if(!empty($currencyData[$list[$modelTable]['unit_price_unit_id']])){?>
            <?php echo $currencyData[$list[$modelTable]['unit_price_unit_id']]  . " " .  $list[$modelTable]['unit_price'] * $list[$modelTable]['pieces']   ?>
          <?php } ?>
        </td>
        
    </tr>
<?php  } ?>
