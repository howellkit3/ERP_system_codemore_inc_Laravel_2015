<ul class="nav nav-tabs">

	<li class="<?php echo ($active_tab == 'plans' || $this->params['controller'] == 'plans' || $this->params['action'] == 'plans') ? 'active' : '' ?>" alt="tab-plans">
	
		<?php echo $this->Html->link('Plans',array(
					'controller' => 'settings',
					'action' => 'plans',
					'tab' => 'plans',
					'plugin' => 'production'
		)); ?>

	</li>

	<li class="<?php echo ($active_tab == 'schedules') ? 'active' : '' ?>" alt="tab-schedules">
		<?php echo $this->Html->link('Schedules',array(
					'controller' => 'settings',
					'action' => 'schedules',
					'tab' => 'schedules',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'controls') ? 'active' : '' ?>" alt="tab-controls">
		<?php echo $this->Html->link('Control',array(
					'controller' => 'settings',
					'action' => 'controls',
					'tab' => 'controls',
					'plugin' => 'production'
		)); ?>
	</li>
	
</ul>