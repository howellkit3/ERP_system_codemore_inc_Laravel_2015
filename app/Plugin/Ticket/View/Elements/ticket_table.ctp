<style type="text/css">.table a.table-link {margin: 0 7px ;}.post {left: -5px;}
</style>


<?php foreach ($ticketData as $ticketDataList): ?>

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

                     echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-plus-square fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Specs </font></span>
                    </span>', array('controller' => 'products', 'action' => 'specification',$ticketDataList['Product']['id'] , '1', $ticketDataList['JobTicket']['id'] , 'plugin' => 'sales'),array('class' =>' table-link','escape' => false,'title'=>'Add Specifications'
                        ));

                     echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Remove </font></span>
                        </span>', array('controller' => 'ticketing_systems', 'action' => 'terminate',$ticketDataList['JobTicket']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information','confirm' => 'Do you want to remove this Job Ticket?'));
                  

                    ?>
             </td>
        </tr>

<?php endforeach; ?> 
