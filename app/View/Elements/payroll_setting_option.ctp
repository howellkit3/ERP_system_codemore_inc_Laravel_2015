<?php echo $this->Html->css('/Sales/css/default'); ?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
  
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> Loans </span>", array('controller' => 'payroll_settings', 'action' => 'settings'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>

     <!--     <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> Benefits </span>", array('controller' => 'payroll_settings', 'action' => 'philhealth_ranges'),array('escape' => false,'class' => 'btn')); ?>
           
        </li> -->
         <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> OT Rates </span>", array('controller' => 'payroll_settings', 'action' => 'ot_rates'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
    </ul>


</div>
<br><br>