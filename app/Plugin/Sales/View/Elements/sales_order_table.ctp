<?php 
if (count($clientOrder) > 0) : ?>

<tbody aria-relevant="all" aria-live="polite" role="alert" class="result_client_table">
<?php foreach ($clientOrder as $clientOderData):  ?>
    <?php //foreach ($clientOder['ClientOrder'] as $clientOderlist):?>

            <tr class="">
                <td class="">
                    <?php echo "CO"."-".$clientOderData['ClientOrder']['uuid'] ?>  
                </td>
                <td class="">
                    <?php echo $clientOderData['ClientOrder']['po_number'] ?>  
                </td>
                <td class="">
                    <?php echo substr($companyData[$clientOderData['ClientOrder']['company_id']],0,25);  ?> ..
                    
                </td>
                <td class="">
                    <?php echo !empty($clientOderData['Product']['name']) ? $clientOderData['Product']['name'] : ''; ?>
                </td> 

                <td class="text-center">
                    <?php echo date('M d, Y', strtotime($clientOderData['ClientOrder']['created'])); ?>
                </td>
                <td>
                    <?php
                        echo $this->Html->link('<span class="fa-stack">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                            </span> ', array('controller' => 'sales_orders', 'action' => 'view',$clientOderData['ClientOrder']['id']),array('class' =>' table-link '.$noPermission,'escape' => false,'title'=>'View Information'));

                    ?>

                    <?php

                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Remove </font></span>
                        </span>', array('controller' => 'sales_orders', 'action' => 'terminate',$clientOderData['ClientOrder']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information','confirm' => 'Do you want to remove this Client Order?'));

                    ?>

                </td>
            </tr>

        
    <?php //endforeach; ?> 
<?php endforeach; ?>
    </tbody>
<?php endif;?> 