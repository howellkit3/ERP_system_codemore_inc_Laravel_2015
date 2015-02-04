<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Settings', array('controller' => 'settings', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add Custom Field', array('controller' => 'customer_sales', 'action' => 'settings')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?>