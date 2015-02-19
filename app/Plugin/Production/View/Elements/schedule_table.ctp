<?php foreach ($scheduleData as $scheduleDataList): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo $scheduleDataList['Schedule']['unique_id'] ?>  
            </td>

            <td class="">
                
                 <?php echo $scheduleDataList['Schedule']['description'] ?>  
            </td>

            <td>
               <?php echo $scheduleDataList['Schedule']['schedule_from'] ?>  
               
            </td>

            <td>
               <?php echo $scheduleDataList['Schedule']['schedule_to'] ?>    
            </td>
            
        </tr>

    </tbody>
<?php endforeach; ?> 