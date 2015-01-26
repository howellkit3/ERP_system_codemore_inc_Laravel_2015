<?php foreach ($company as $customerlist): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo $customerlist['Company']['company_name'] ?>  
            </td>

            <td class="">
                <?php echo $customerlist['Company']['description'] ?>
            </td>

            <td class="">
                <?php echo $customerlist['Company']['website'] ?>
            </td>

            <td class="">
                1.<?php echo $customerlist['Address']['address1'] ?><br>
                2.<?php echo $customerlist['Address']['address2'] ?><br>
                City - <?php echo $customerlist['Address']['city'] ?><br>
                State Province - <?php echo $customerlist['Address']['state_province'] ?><br>
                Zip Code - <?php echo $customerlist['Address']['zip_code'] ?><br>
                Country - <?php echo $customerlist['Address']['country'] ?>

            </td>

            <td class="">
                <?php echo $customerlist['Contact']['number'] ?><br>
                <?php echo $customerlist['Email']['email'] ?>
            </td>

            <td class="">
                <?php //echo $customerlist['ContactPerson'][0]['lastname']","
                           // $customerlist['ContactPerson'][0]['firstname'];"&nbsp;"; ?>
                <?php //echo $customerlist['ContactPerson'][0]['middlename'] ?>
            </td>

            <td class="">
                1.<?php //echo $customerlist['Address'][0]['address1'] ?><br>
                2.<?php //echo $customerlist['Address'][0]['address2'] ?>
            </td>

            <td class="">
                <?php //echo $customerlist['Contact'][0]['number'] ?>
            </td>
           
              <td class="">
                <?php //echo $this->Html->link(__('View'), array('controller' => 'user_lists','action' => 'view', $userlist['User']['id'])); ?> |
                <?php //echo $this->Html->link(__('Edit'), array('controller' => 'user_lists','action' => 'edit', $userlist['User']['id'])); ?> |
                <?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'user_lists','action' => 'delete', $userlist['User']['id']), array(), __('Are you sure you want to delete # %s?', $userlist['User']['id'])); ?>
            </td>

        </tr>

    </tbody>
<?php endforeach; ?> 