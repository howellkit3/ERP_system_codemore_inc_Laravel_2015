<?php foreach ($formatDataSpecs['ProductSpecificationProcess']['ProcessHolder'] as $key => $processList) { $key++; ?>
    <tr>
        <td class="td-heigth indent" style="width:85px;border:1px solid #EAEAEA;">>>PP<?php echo $key ?></td>
        <td class="td-heigth" style="width:220px;border:1px solid #EAEAEA;">
            <?php echo $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']] ?>
        </td>
        <td class="td-heigth" style="width:270px;border:1px solid #EAEAEA;"> </td>
    </tr>
<?php } ?> 