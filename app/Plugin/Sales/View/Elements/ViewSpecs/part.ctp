<?php 
            $outs1  = !empty($formatDataSpecs['ProductSpecificationPart']['outs1']) ? $formatDataSpecs['ProductSpecificationPart']['outs1']  : 1;
            $outs2  = !empty($formatDataSpecs['ProductSpecificationPart']['outs2']) ? $formatDataSpecs['ProductSpecificationPart']['outs2']  : 1;
            $outProduct = $outs1 * $outs2; 
            $quantity = $specs['ProductSpecification']['quantity']; 
            $rate  = !empty($formatDataSpecs['ProductSpecificationPart']['rate']) ? $formatDataSpecs['ProductSpecificationPart']['rate']  : 1;
            $stocks = $specs['ProductSpecification']['stock'];
            $allowance = !empty($formatDataSpecs['ProductSpecificationPart']['allowance']) ? $formatDataSpecs['ProductSpecificationPart']['allowance']  : 0;
           // pr($allowance); 
            $product = $rate * $quantity;
            $quotient = ceil($quantity / $outProduct);
            $paper = ($quotient + $stocks); 

?>

<tr >
    <td class="td-heigth indent" style="width:80px;border:1px solid #EAEAEA;">&emsp;&emsp;&emsp;C<?php echo $key ?>-Part<?php echo $key ?></td>
    <td class="td-heigth" style="width:220px;border:1px solid #EAEAEA;"><?php echo !empty($formatDataSpecs['ProductSpecificationPart']['name']) ? $formatDataSpecs['ProductSpecificationPart']['name'] : $formatDataSpecs['ProductSpecificationPart']['material'] ?></td>
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
        <?php echo $paper// $formatDataSpecs['ProductSpecificationPart']['paper_quantity'] ?> + 
        <?php echo $specs['ProductSpecification']['stock'] ?>
        <?php echo $unitData[$formatDataSpecs['ProductSpecificationPart']['quantity_unit_id']] ?>
    </td>
</tr>