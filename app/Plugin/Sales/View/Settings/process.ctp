<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Settings', array('controller' => 'quotation', 'action' => 'index')); ?>

<?php $this->Html->addCrumb('Process', array('controller' => 'quotation', 'action' => 'index')); ?>

<?php  echo $this->Html->script('Sales.inquiry');?>
<?php  echo $this->Html->script('Sales.quantityLimit');?>

<?php echo $this->element('process_options');?><br><br>