<?php foreach ($dataSpecs['ProductSpecificationProcess']['ProcessHolder'] as $key => $processList) { $key++; 

    ?>
    <tr>
        <td class="td-heigth indent" style="width:85px;border:1px solid #EAEAEA;"> >>PP<?php echo $key ?></td>
        <td class="td-heigth" style="width:220px;border:1px solid #EAEAEA;">

        	<?php  if (!empty($subProcessData[$processList['ProductSpecificationProcessHolder']['sub_process_id']])) {
                   /*   11 - cutting
                        21 - offset ctp
                        20 - wood mold                    
                    */
                    $process = array('11','21','20');

        			if (in_array($processList['ProductSpecificationProcessHolder']['sub_process_id'],$process)) {

        					// echo $this->Html->link($subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']], 
        					// array(
            	// 				'controller' => 'ticketing_systems','action' => 'print_process',
            	// 				$processList['ProductSpecificationProcessHolder']['sub_process_id'],
            	// 				$formatDataSpecs['ProductSpecificationDetail']['product_id'],
             //                $ticketData['JobTicket']['uuid']
        					// ),
        					// array(
        					// 	'title' => 'Print '. $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']],
             //                    'target' => '_blank'
        					// )
        					// );


                        echo $this->Html->link($subProcessData[$processList['ProductSpecificationProcessHolder']['sub_process_id']], 
                            '#processModal',
                            array(
                                'title' => 'Print '. $subProcessData[$processList['ProductSpecificationProcessHolder']['sub_process_id']],
                                //'target' => '_blank',
                                'data-processId' => $processList['ProductSpecificationProcessHolder']['sub_process_id'],
                                'data-productId' => $dataSpecs['ProductSpecificationDetail']['product_id'],
                                'data-ticket_uuid' =>  $ticketData['JobTicket']['uuid'],
                                'data-toggle' => 'modal',
                                'data-product' => !empty($product['foreign_key']) ? $product['foreign_key'] : '0',
                                'class' => 'process_link',
                                'id' => 'processID-'.$processList['ProductSpecificationProcessHolder']['id'].'-'.$processList['ProductSpecificationProcessHolder']['sub_process_id']
                            )
                            );
        			} else  {

        				echo  $subProcessData[$processList['ProductSpecificationProcessHolder']['sub_process_id']];
        			}
        		}

        	?>
            <?php //echo !empty($subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']]) ? $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']] : '' ?>
        </td>
        <td class="td-heigth" style="width:270px;border:1px solid #EAEAEA;">

                    <?php  if (!empty($subProcessData[$processList['ProductSpecificationProcessHolder']['sub_process_id']])) {

                        $process = array('21');

                        if (in_array($processList['ProductSpecificationProcessHolder']['sub_process_id'],$process)) {

                            $product = !empty($product['foreign_key']) ? $product['foreign_key'] : '0';


                            $machineProcess = $this->PlateMaking->getOffsetDetail($ticketData['JobTicket']['uuid'],$processList['ProductSpecificationProcessHolder']['sub_process_id'], $product);

                            if (!empty( $machineProcess)) {
                                 echo $machineProcess['Machine']['name'];
                            }
                           
                        }

                     ?>



                    <?php } ?>
        </td>
    </tr>
<?php } ?> 