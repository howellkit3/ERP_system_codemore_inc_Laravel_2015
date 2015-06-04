<style type="text/css">.table a.table-link {margin: 0 7px ;}.post {left: -5px;}
</style>
<?php foreach ($ticketData as $ticketDataList): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo $ticketDataList['JobTicket']['uuid'] ?>  
            </td>
            <td class="">
                <?php echo $ticketDataList['Product']['uuid'] ?>  
            </td>
            <td class="">
                <?php echo $ticketDataList['JobTicket']['po_number'] ?> 
            </td>
            <td class="">
                <?php echo $ticketDataList['Product']['name'] ?> 
            </td>
            <td class="">
                <?php echo $companyData[$ticketDataList['Product']['company_id']] ?> 
            </td>
            <td class="">
                 <?php echo date('M d, Y', strtotime($ticketDataList['JobTicket']['created'])); ?>
            </td>
            <td style="text-align:center">
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> Print </font></span></span> ', array('controller' => 'ticketing_systems', 'action' => 'print_ticket',$ticketDataList['Product']['uuid']), array('class' =>' table-link','escape' => false, 'title'=>'View Information','target' => '_blank'
                    // ));

                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="smallBtn"><center><font size = "1px"> View </font></center></span></span> ', array('controller' => 'ticketing_systems', 'action' => 'view',$ticketDataList['Product']['uuid'],$ticketDataList['JobTicket']['id'],$ticketDataList['JobTicket']['client_order_id']), array('class' =>' table-link','escape' => false, 'title'=>'View Information'
                    ));
                    // echo $this->Html->link('<span class="fa-stack">
                    //                         <i class="fa fa-square fa-stack-2x"></i>
                    //                         <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<div class ="post"><font size = "0.75px"> Timeline </font></div>
                    //                         </span> ', 
                    //                                  array(
                    //                         'controller' => 'ticketing_systems', 
                    //                         'action' => 'view', 
                    //                         $ticketDataList['JobTicket']['id']
                    //                             ), array( 
                    //                         'class' =>' table-link','escape' => false, 
                    //                         'title'=>'View Timeline'

                    //                         ));
                
                    //     echo $this->Html->link('<span class="fa-stack">
                    //                             <i class="fa fa-square fa-stack-2x"></i>
                    //                             <i class="fa fa fa-check-square fa-lg fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<div class ="post"><font size = "1px"> Summary </font></div>
                    //                             </span> ', array( 
                    //                             'controller' => 'jobTicketSummaries', 
                    //                             'action' => 'index', 
                    //                             $ticketDataList['JobTicket']['uuid']
                                                
                    //                                     ), array(
                    //                             'class' =>' table-link',
                    //                             'escape' => false,
                    //                             'title'=>'View Job Ticket Summary'
                    //             ));

                    ?>
             </td>
        </tr>

    </tbody>
<?php endforeach; ?> 