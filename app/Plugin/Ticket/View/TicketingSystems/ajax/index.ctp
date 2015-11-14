<?php foreach ($ticketData as $ticketDataList): ?>

    <?php if($ticketDataList['JobTicket']['status_production_id'] == 0){?>

        <tr class="">

            <td class="">
                <?php echo $ticketDataList['JobTicket']['uuid'] ?>  
            </td>

            <td class="">
                <?php echo substr($companyData[$ticketDataList['Product']['company_id']],0,25); ?> ..
            </td>

            <td class="">
                <?php echo 'CO-'.$ticketDataList['ClientOrder']['uuid'] ?>  
            </td>
           <!--  <td class="">
                <?php echo $ticketDataList['Product']['uuid'] ?>  
            </td> -->
            <td class="">
                <?php echo $ticketDataList['JobTicket']['po_number'] ?> 
            </td>
            <td class="">
                <?php echo substr($ticketDataList['Product']['name'],0,25); ?> ..
            </td>
          

            <td style="text-align:center">
                <?php
               

                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="smallBtn"><center><font size = "1px"> View </font></center></span></span> ', array('controller' => 'ticketing_systems', 'action' => 'view',$ticketDataList['Product']['uuid'],$ticketDataList['JobTicket']['id'],$ticketDataList['JobTicket']['client_order_id']), array('class' =>' table-link','escape' => false, 'title'=>'View Information'
                    ));
                  

                    ?>
             </td>
        </tr>

<?php } endforeach; ?> 
