<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Ticket Details</span>", array(
                                                                                            'controller' => 'jobTicketSummaries', 
                                                                                            'action' => 'index',
                                                                                            $ticketDetails['Quotation']['unique_id'],

                                                                                            ),
                                                                                     array(
                                                                                            'escape' => false,
                                                                                            'class' => 'btn'
                                                                                            )); 
            ?>
           
        </li>

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Delivery Information</span>", array(
                                                                                    'controller' => 'ticketDeliveries', 
                                                                                    'action' => 'delivery_info',
                                                                                    $ticketDetails['Quotation']['unique_id']
                                                                                    
                                                                                    ),
                                                                             array(
                                                                                    'escape' => false,
                                                                                    'class' => 'btn'
                                                                                    )); 
            ?>
           
        </li>

   
    </ul>
</div>
<br><br>