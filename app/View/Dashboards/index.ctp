<?php
 echo $this->Html->link( "Sales",   array('controller' =>'customer_sales','action'=>'index','plugin' => 'sales') );
 
 echo "<br>";
 echo "<br>";
 echo $this->Html->link( "Warehouse",   array('controller' =>'customer_sales','action'=>'index') );
 echo "<br>";
 echo "<br>";
 echo $this->Html->link( "Purchasing",   array('action'=>'') );
?>