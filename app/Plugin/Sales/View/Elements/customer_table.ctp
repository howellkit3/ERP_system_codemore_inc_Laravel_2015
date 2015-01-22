<?php foreach ($company as $customerlist): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="even">

            <td class="sorting_1">
                <?php echo $customerlist['Company']['company_name'] ?>  
            </td>

            <td class="sorting_1">
                <?php echo $customerlist['Company']['company_address'] ?>
            </td>

            <td class="">
                <?php echo $customerlist['Company']['state_province'] ?>
            </td>

            <td class="">
                <?php echo $customerlist['Company']['company_contact'] ?>
            </td>

            <td class="sorting_1">
                <?php echo $customerlist['Customer'][0]['lastname'],
                            $customerlist['Customer'][0]['firstname'];"&nbsp;"; ?>
                <?php echo $customerlist['Customer'][0]['middlename'] ?>
            </td>

            <td class="">
                <?php echo $customerlist['Customer'][0]['email'] ?>
            </td>

            <td class="">
                <?php echo $customerlist['Customer'][0]['contact_number'] ?>
            </td>

            <td class="">
                <?php echo $customerlist['Customer'][0]['address'] ?>
            </td>
           

              <td class="actions">
                <?php //echo $this->Html->link(__('View'), array('controller' => 'user_lists','action' => 'view', $userlist['User']['id'])); ?> |
                <?php //echo $this->Html->link(__('Edit'), array('controller' => 'user_lists','action' => 'edit', $userlist['User']['id'])); ?> |
                <?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'user_lists','action' => 'delete', $userlist['User']['id']), array(), __('Are you sure you want to delete # %s?', $userlist['User']['id'])); ?>
            </td>

         
        </tr>

    </tbody>
<?php endforeach; ?> 