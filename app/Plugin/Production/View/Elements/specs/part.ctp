<tr>
    <td class="td-heigth indent" style="width:80px;border:1px solid #EAEAEA;">C<?php echo $key ?>-Part<?php echo $key ?></td>
    <td class="td-heigth" style="width:220px;border:1px solid #EAEAEA;font-family: arial;"><?php echo !empty($formatDataSpecs['ProductSpecificationPart']['name']) ? $formatDataSpecs['ProductSpecificationPart']['name'] : $formatDataSpecs['ProductSpecificationPart']['material'] ?></td>

    <td class="td-heigth" style="width:270px;border:1px solid #EAEAEA;"><?php echo $formatDataSpecs['ProductSpecificationPart']['quantity']?></td>
</tr>
<tr>
    <td class="td-heigth" style="width:120px;border:1px solid #EAEAEA;"> </td>
    <td class="td-heigth" style="width:220px;border:1px solid #EAEAEA;"> </td>
    <td class="td-heigth" style="width:270px;border:1px solid #EAEAEA;">
        <?php echo $formatDataSpecs['ProductSpecificationPart']['material']?> >>
        <?php echo $formatDataSpecs['ProductSpecificationPart']['color']?>
    </td>
</tr>
<tr>
    <td class="td-heigth" style="width:120px;border:1px solid #EAEAEA;"> </td>
    <td class="td-heigth" style="width:220px;border:1px solid #EAEAEA;"> </td>
    <td class="td-heigth" style="width:270px;border:1px solid #EAEAEA;">
        <?php
            $outs = floatval($formatDataSpecs['ProductSpecificationPart']['outs1']) * floatval($formatDataSpecs['ProductSpecificationPart']['outs2']);
        ?>
        <?php echo $formatDataSpecs['ProductSpecificationPart']['size1']?> x
        <?php echo $formatDataSpecs['ProductSpecificationPart']['size2']?> >>
        <?php echo $outs ?> Outs >>
        <?php $quantityOuts = $formatDataSpecs['ProductSpecificationPart']['quantity'] / $outs; ?>
        <?php echo // $formatDataSpecs['ProductSpecificationPart']['quantity'] 
        round($quantityOuts) ?> 
        +
        <?php 

            if(!empty($formatDataSpecs['ProductSpecificationPart']['allowance'])){ 
                echo $formatDataSpecs['ProductSpecificationPart']['allowance'];
            } else{
                echo $specs['ProductSpecification']['stock'];
            }
        ?>
        
        <?php echo !empty($unitData[$formatDataSpecs['ProductSpecificationPart']['quantity_unit_id']]) ? $unitData[$formatDataSpecs['ProductSpecificationPart']['quantity_unit_id']] : '' ?>
    </td>
</tr>