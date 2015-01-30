<?php foreach ($company as $customerlist): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo $customerlist['Company']['company_name'] ?>  
            </td>
            <td class="">
                <?php echo $customerlist['Company']['website'] ?>
            </td>
            <td class="">

                <?php
                foreach($customerlist['ContactPerson'] as $contactPerson) { ?>

                    <div>
                        <?php echo $contactPerson['lastname']; ?>, 
                        <?php echo $contactPerson['firstname']; ?> &nbsp;
                        <?php echo $contactPerson['middlename']; ?>
                    </div>

                <?php } ?>
            </td>

            <td>
                <?php echo date('M d, Y', strtotime($customerlist['Company']['created'])); ?>
            </td>
            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                        </span> ', array('controller' => 'customer_sales', 'action' => 'view',$customerlist['Company']['id']),array('class' =>' table-link','escape' => false,'title'=>'View Information'));
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    </span> ', array('controller' => 'customer_sales', 'action' => 'edit',$customerlist['Company']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                    </span>', array('controller' => 'customer_sales', 'action' => 'delete',$customerlist['Company']['id'],$contactPerson['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information'));
                ?>
                
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 