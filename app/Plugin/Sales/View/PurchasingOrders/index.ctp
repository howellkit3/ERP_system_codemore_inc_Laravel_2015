<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Purchasing Orders', array('controller' => 'purchasing_orders', 'action' => 'index')); ?>

<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>
