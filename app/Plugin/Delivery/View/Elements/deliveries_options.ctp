<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>DR Monitoring</span>", array(
                                                                                            'controller' => 'deliveries', 
                                                                                            'action' => 'index',
                                                                                            ),
                                                                                     array(
                                                                                            'escape' => false,
                                                                                            'class' => 'btn'
                                                                                            )); 
            ?>
           
        </li>

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>DR Replacing</span>", array(
                                                                                   'controller' => 'deliveries', 
                                                                                    'action' => 'delivery_replacing',
                                                                                    ),
                                                                            array(
                                                                                   'escape' => false,
                                                                                   'class' => 'btn'
                                                                                   )); 
            ?>
           
        </li>

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Transmittal Records</span>", array(
                                                                                   'controller' => 'deliveries', 
                                                                                    'action' => 'delivery_transmittal_record',
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