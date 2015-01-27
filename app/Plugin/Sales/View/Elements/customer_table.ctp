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

                <?php //echo $customerlist['ContactPerson'][0]['lastname']","
                           // $customerlist['ContactPerson'][0]['firstname'];"&nbsp;"; ?>
                <?php //echo $customerlist['ContactPerson'][0]['middlename'] ?>
            </td>

            <td>
                <?php echo date('M d, Y', strtotime($customerlist['Company']['created'])); ?>
            </td>
            <td>
                <a href="#">View</a> |
                <a href="#">Edit</a> |
                <a href="#">Delete</a>
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 