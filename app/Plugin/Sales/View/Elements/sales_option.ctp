<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
    <ul style="margin-left:0" class="nav navbar-nav pull-left">

        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Customer Info</span>", array('controller' => 'customer_sales', 'action' => 'index'),array('escape' => false,'class' => 'btn')); ?>
           
        </li>
        
        <li class="dropdown hidden-xs">
           
            <?php echo $this->Html->link("<span class='count'>Inquiry</span>", array('controller' => 'customer_sales', 'action' => 'inquiry'),array('escape' => false,'class' => 'btn')); ?>

        </li>

        <li class="dropdown hidden-xs">
            
            <?php echo $this->Html->link("<span class='count'>Quotation</span>", array('controller' => 'quotations', 'action' => 'index'),array('escape' => false,'class' => 'btn')); ?>
        
        </li>

        <li class="dropdown hidden-xs">
            
            <?php echo $this->Html->link("<span class='count'>Sales Order</span>", array('controller' => 'sales_orders', 'action' => 'index'),array('escape' => false,'class' => 'btn')); ?>
        
        </li>

        <li class="dropdown hidden-xs">
            <?php echo $this->Html->link("<span class='count'>Settings</span>", array('controller' => 'settings', 'action' => 'index'),array('escape' => false,'class' => 'btn')); ?>
        </li>
   
    </ul>
</div>
<br><br>