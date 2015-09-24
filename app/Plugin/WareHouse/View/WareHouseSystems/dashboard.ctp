<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Clients Order', array('controller' => 'sales_orders', 'action' => 'index')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php //echo $this->element('sales_option');?><br><br>

<?php echo $this->element('summary_header');?>