<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>

			
<?php 
	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
 	echo $this->element('tab/jobs',array('active_tab' => $active_tab)); 
 ?>
	