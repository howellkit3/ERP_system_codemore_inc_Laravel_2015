<style type="text/css">.table a.table-link {margin: 0 7px ;}.post {left: -5px;}
</style>
<?php foreach ($ticketData as $ticketDataList): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo $ticketDataList['Ticket']['unique_id'] ?>  
            </td>
            <td class="">
                
                 <?php echo date('M d, Y', strtotime($ticketDataList['Ticket']['created'])); ?>
            </td>
            <td style="text-align:center">
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<div class ="post"><font size = "0.75px"> Timeline </font></div>
                                            </span> ', 
                                                     array(
                                            'controller' => 'ticketing_systems', 
                                            'action' => 'view', 
                                            $ticketDataList['Ticket']['id']
                                                ), array( 
                                            'class' =>' table-link','escape' => false, 
                                            'title'=>'View Timeline'

                                            ));
                ?>
                 <?php
                        echo $this->Html->link('<span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa fa-check-square fa-lg fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<div class ="post"><font size = "1px"> Summary </font></div>
                                                </span> ', array( 
                                                'controller' => 'jobTicketSummaries', 
                                                'action' => 'index', 
                                                $ticketDataList['Ticket']['unique_id']
                                                
                                                        ), array(
                                                'class' =>' table-link',
                                                'escape' => false,
                                                'title'=>'View Job Ticket Summary'
                                ));

                    ?>
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 