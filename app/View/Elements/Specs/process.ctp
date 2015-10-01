<?php foreach ($formatDataSpecs['ProductSpecificationProcess']['ProcessHolder'] as $key => $processList) { $key++; ?>
    <tr>
        <td class="td-heigth indent" style="width:85px;border:1px solid #EAEAEA;"> >>PP<?php echo $key ?></td>
        <td class="td-heigth" style="width:220px;border:1px solid #EAEAEA;">

        	<?php 

        		if (!empty($subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']])) {

                    $process = array('Wood Mould','Cutting');

        			if (in_array($subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']],$process)) {

        					echo $this->Html->link($subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']], 
        					array(
        					'controller' => 'ticketing_systems','action' => 'print_process',
        					$processList['ProductSpecificationProcessHolder']['sub_process_id'],
        					$formatDataSpecs['ProductSpecificationDetail']['product_id'],
                            $ticketData['JobTicket']['uuid']
        					),
        					array(
        						'title' => 'Print '. $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']],
                                'target' => '_blank'
        					)
        					);
        			} else  {

        				echo  $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']];
        			}
        		}

        	?>
            <?php //echo !empty($subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']]) ? $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']] : '' ?>
        </td>
        <td class="td-heigth" style="width:270px;border:1px solid #EAEAEA;"> </td>
    </tr>
<?php } ?> 