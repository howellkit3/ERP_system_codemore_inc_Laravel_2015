<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Schedules</span>", 
                                            array('controller' => 'production_systems', 
                                                'action' => 'index'),
                                                    array('escape' => false,
                                                    'class' => 'btn'
                                                  )); 
            ?>
           
        </li>
        
        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Monitoring</span>", 
                                            array('controller' => 'customer_sales', 
                                            'action' => 'inquiry'),
                                            array('escape' => false,
                                                'class' => 'btn'
                                                )); 
            ?>

        </li>

        <li class="dropdown hidden-xs">
            
            <?php echo $this->Html->link("<span class='count'>Turn Over to the Process</span>", 
                                        array('controller' => 'quotations', 
                                        'action' => 'index'),
                                        array('escape' => false,
                                        'class' => 'btn'
                                        )); 
            ?>
        
        </li>
    </ul>
</div>
<br><br>