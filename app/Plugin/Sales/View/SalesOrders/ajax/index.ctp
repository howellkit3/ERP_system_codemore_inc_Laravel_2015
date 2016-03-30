
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Client Order No.</span></a></th>
                                <th><a href="#"><span>PO No.</span></a></th>
                                <th><a href="#"><span>Company</span></a></th>
                                <th><a href="#"><span>Item</span></a></th>
                                <th class="text-center"><a href="#"><span>Created</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php
    if (count($clientOrder) > 0) : 
 foreach ($clientOrder as $clientOderData):  ?>
    <tr class="">
                <td class="">
                    <?php echo "CO"."-".$clientOderData['ClientOrder']['uuid'] ?>  
                </td>
                <td class="">
                    <?php echo $clientOderData['ClientOrder']['po_number'] ?>  
                </td>
                <td class="">
                    <?php echo $companyData[$clientOderData['ClientOrder']['company_id']] ?>
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
<?php endforeach; 
?> 
<?php else : ?>
   <font color="red"><b>No result..</b></font>
<?php endif; ?>  

                    </table>
<hr>

<div class="paging" id="item_type_pagination">
<?php
echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
