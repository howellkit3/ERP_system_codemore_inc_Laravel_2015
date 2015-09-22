<?php echo $this->Html->css('/Sales/css/default'); ?>

<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
  
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

       <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> Settings </span>", array('controller' => 'payroll_settings', 'action' => 'main_settings'),array('escape' => false,'class' => 'btn')); ?>
        </li>
            

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> Deductions / Loans </span>", array('controller' => 'payroll_settings', 'action' => 'settings'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> Contibutions </span>", array('controller' => 'payroll_settings', 'action' => 'contributions'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>

     <!--     <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> Benefits </span>", array('controller' => 'payroll_settings', 'action' => 'philhealth_ranges'),array('escape' => false,'class' => 'btn')); ?>
           
        </li> -->
         <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> OT Rates </span>", array('controller' => 'payroll_settings', 'action' => 'ot_rates'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
         <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> Wages </span>", array('controller' => 'payroll_settings', 'action' => 'wages'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> SSS Table </span>", array('controller' => 'payroll_settings', 'action' => 'sss_ranges'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
         <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> PhilHealth Table </span>", array('controller' => 'payroll_settings', 'action' => 'philhealth_ranges'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>


         <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'> Tax Settings </span>", array('controller' => 'payroll_settings', 'action' => 'tax_settings' ),array('escape' => false,'class' => 'btn')); ?>
           
        </li>

        
    </ul>


</div>
<br><br>