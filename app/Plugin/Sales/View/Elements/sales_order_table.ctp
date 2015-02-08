<?php foreach ($salesOder as $salesOderlist): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo $quoteName[$salesOderlist['SalesOrder']['quotation_id']] ?>  
            </td>
           <!--  <td class="">
                <?php //echo $customerlist['Company']['website'] ?>
            </td> -->
            <td class="text-center">
                <?php echo $salesOderlist['SalesOrder']['status'] != (0) ? '<span class="label label-success">Approved</span>' : '<span class="label label-danger">Pending</span>' ; ?>
            </td>

            <td class="text-center">
                <?php echo date('M d, Y', strtotime($salesOderlist['SalesOrder']['created'])); ?>
            </td>
            <td>
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    //     <i class="fa fa-square fa-stack-2x"></i>
                    //     <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                    //     </span> ', array('controller' => 'customer_sales', 'action' => 'view',$salesOderlist['SalesOder']['id']),array('class' =>' table-link','escape' => false,'title'=>'View Information'));
                ?>
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i>
                    // <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    // </span> ', array('controller' => 'customer_sales', 'action' => 'edit',$customerlist['Company']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i>
                    // <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                    // </span>', array('controller' => 'customer_sales', 'action' => 'delete',$customerlist['Company']['id'],$contactPerson['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information'));
                ?>
                
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 