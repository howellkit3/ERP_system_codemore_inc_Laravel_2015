<style type="text/css">.main-box > h1 {padding: 20px 0 6px 20px;}</style>
<?php echo $this->Html->css('/Sales/css/default'); ?>

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
            
            <?php echo $this->Html->link("<span class='count'>Clients Order</span>", array('controller' => 'sales_orders', 'action' => 'index'),array('escape' => false,'class' => 'btn')); ?>
        
        </li>
        <!-- <li class="dropdown hidden-xs"> -->
            <?php //echo $this->Html->link("<span class='count'>Summary</span>", array('controller' => 'summaries', 'action' => 'index'),array('escape' => false,'class' => 'btn')); ?>
        <!-- </li> -->
<!-- 
        <li class="dropdown hidden-xs">
            <?php echo $this->Html->link("<span class='count'>Settings</span>", array('controller' => 'customer_sales', 'action' => 'index'),array('escape' => false,'class' => 'btn')); ?>
        </li> -->

        <li class="dropdown hidden-xs">
            
            <?php echo $this->Html->link("<span class='count'>Products</span>", array('controller' => 'products', 'action' => 'index'),array('escape' => false,'class' => 'btn')); ?>
        
        </li>
   
    </ul>
</div>
<br><br>