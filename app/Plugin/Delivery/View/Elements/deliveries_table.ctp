<?php foreach ($scheduleData as $scheduleDataList): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo $scheduleDataList['Schedule']['sales_order_id']; ?>  
            </td>

            <td class="">
                
                 <?php echo $scheduleDataList['Schedule']['schedule'];?>  
            </td>

            <td>
               <?php echo $scheduleDataList['Schedule']['location']; ?>  
               
            </td>

            <td>
               <?php echo $scheduleDataList['Schedule']['status']; ?>    
            </td>
             <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                        </span> ', array('controller' => 'schedules', 
                                         'action' => 'view',
                                         $scheduleDataList['Schedule']['sales_order_id']
                                        ),
                                        array(
                                            'class' =>' table-link',
                                            'escape' => false,
                                            'title'=>'View Information'
                                            ));

                ?>
        </tr>

    </tbody>
<?php endforeach; ?> 