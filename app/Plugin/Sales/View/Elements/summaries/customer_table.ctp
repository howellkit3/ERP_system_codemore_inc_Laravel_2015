<?php foreach ($company as $customerlist): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo ucfirst($customerlist['Company']['company_name']) ?>  
            </td>
            <td class="">
                <?php echo $customerlist['Company']['website'] ?>
            </td>
               <td class="">
                <?php echo $customerlist['Company']['tin'] ?>
            </td>
            <td class="">

                <?php
                foreach($customerlist['ContactPerson'] as $contactPerson) { ?>

                    <div>
                        <?php echo ucfirst($contactPerson['lastname']); ?>, 
                        <?php echo ucfirst($contactPerson['firstname']); ?> &nbsp;
                        <?php echo ucfirst($contactPerson['middlename']); ?>
                    </div>

                <?php } ?>
            </td>

            <td>
                <?php echo date('M d, Y', strtotime($customerlist['Company']['created'])); ?>
            </td>
        </tr>
    </tbody>
<?php endforeach; ?> 