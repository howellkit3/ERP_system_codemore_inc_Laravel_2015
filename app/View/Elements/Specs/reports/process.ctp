<?php foreach ($formatDataSpecs['ProductSpecificationProcess']['ProcessHolder'] as $key => $processList) { $key++; ?>
    <tr>
        <td class="td-heigth indent" style="width:85px;border:1px solid #EAEAEA;"> >>PP<?php echo $key ?></td>
        <td class="td-heigth" style="width:100px;border:1px solid #EAEAEA;">
            <?php echo !empty($subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']]) ? $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']] : '' ?>
        </td>
        <td class="td-heigth" style="width:100px;border:1px solid #EAEAEA;"> 



                    <?php  if (!empty($subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']])) {

                        $process = array('21');

                        if (in_array($processList['ProductSpecificationProcessHolder']['sub_process_id'],$process)) {

                           $product = !empty($product['foreign_key']) ? $product['foreign_key'] : '0';
        
                           $machineProcess = $this->PlateMaking->getOffsetDetail($ticketData['JobTicket']['uuid'],$processList['ProductSpecificationProcessHolder']['sub_process_id'], $product);

                            if (!empty( $machineProcess)) {
                                 echo $machines[$machineProcess['PlateMakingProcess']['machine']];
                            }
                           
                        }

                     ?>



                    <?php } ?>

        </td>
    </tr>
<?php } ?> 