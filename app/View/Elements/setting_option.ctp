<?php echo $this->Html->css('/Sales/css/default'); ?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Category</span>", array('controller' => 'settings', 'action' => 'category'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul>

     <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Status</span>", array('controller' => 'settings', 'action' => 'status'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul>

     </ul>

     <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Packaging</span>", array('controller' => 'settings', 'action' => 'status'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul>
     </ul>

     <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Payment</span>", array('controller' => 'settings', 'action' => 'status'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul>

</div>
<br><br>