<?php echo $this->Html->css('/Sales/css/default'); ?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Category</span>", array('controller' => 'settings', 'action' => 'category'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul>

     <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Suppliers</span>", array('controller' => 'settings', 'action' => 'supplier'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul>
 
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Item Group</span>", array('controller' => 'settings', 'action' => 'item_group'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul> 

     <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Status</span>", array('controller' => 'settings', 'action' => 'status'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul>

     <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Packaging</span>", array('controller' => 'settings', 'action' => 'packaging'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>

    </ul>

    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Process</span>", array('controller' => 'settings', 'action' => 'process'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul>

     <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Term</span>", array('controller' => 'settings', 'action' => 'payment_term'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul>

    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Unit</span>", array('controller' => 'settings', 'action' => 'unit'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul>


</div>
<br><br>