<tr>
    <td class="td-heigth indent" style="border:1px solid #EAEAEA;">C<?php echo $key ?>-Part<?php echo $key ?></td>
    <td class="td-heigth" style="border:1px solid #EAEAEA;font-family: arial;"><?php echo !empty($formatDataSpecs['ProductSpecificationPart']['name']) ? $formatDataSpecs['ProductSpecificationPart']['name'] : $formatDataSpecs['ProductSpecificationPart']['material'] ?></td>

    <td class="td-heigth" style="border:1px solid #EAEAEA;"><?php echo $formatDataSpecs['ProductSpecificationPart']['quantity']?></td>
</tr>
<tr>
    <td class="td-heigth" style="border:1px solid #EAEAEA;"> </td>
    <td class="td-heigth" style="border:1px solid #EAEAEA;"> </td>
    <td class="td-heigth" style="border:1px solid #EAEAEA;">
        <?php echo $formatDataSpecs['ProductSpecificationPart']['material']?> >>
        <?php echo $formatDataSpecs['ProductSpecificationPart']['color']?>
    </td>
</tr>
<tr>
    <td class="td-heigth" style="border:1px solid #EAEAEA;"> </td>
    <td class="td-heigth" style="border:1px solid #EAEAEA;"> </td>
    <td class="td-heigth" style="border:1px solid #EAEAEA;">
        <?php
            $outs = floatval($formatDataSpecs['ProductSpecificationPart']['outs1']) * floatval($formatDataSpecs['ProductSpecificationPart']['outs2']);
        ?>
        <?php echo $formatDataSpecs['ProductSpecificationPart']['size1']?> x
        <?php echo $formatDataSpecs['ProductSpecificationPart']['size2']?> >>
        <?php echo $outs ?> Outs >>
       <!--  <?php echo $formatDataSpecs['ProductSpecificationPart']['paper_quantity'] ?>  -->
       <?php $quantityOut = $specs['ProductSpecification']['quantity'] / $outs; ?>
         <?php echo $quantityOut ?> 
        <?php if(!empty($formatDataSpecs['ProductSpecificationPart']['allowance'])){ ?>
            + <?php echo $formatDataSpecs['ProductSpecificationPart']['allowance'] ?>

            <?php } ?>
        
        <?php echo !empty($unitData[$formatDataSpecs['ProductSpecificationPart']['quantity_unit_id']]) ? $unitData[$formatDataSpecs['ProductSpecificationPart']['quantity_unit_id']] : '' ?>
    </td>
</tr>