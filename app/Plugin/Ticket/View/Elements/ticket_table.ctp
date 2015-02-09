<?php foreach ($ticketData as $ticketDataList): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo $ticketDataList['Ticket']['unique_id'] ?>  
            </td>
            <td class="">
                
                 <?php echo date('M d, Y', strtotime($ticketDataList['Ticket']['created'])); ?>
            </td>
            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                        </span> ', array('controller' => 'ticketing_systems', 'action' => 'view',$ticketDataList['Ticket']['id']),array('class' =>' table-link','escape' => false,'title'=>'View Information'));
                ?>
               
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 