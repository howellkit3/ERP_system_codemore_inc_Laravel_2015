<ul class="nav nav-tabs">
	<li class="<?php echo ($active_tab == 'department') ? 'active' : '' ?>" alt="tab-type">
	<li class="<?php echo ($active_tab == 'department' || $this->params['controller'] == 'departments' || $this->params['action'] == 'department') ? 'active' : '' ?>" alt="tab-department">
		<?php echo $this->Html->link('Department',array(
					'controller' => 'settings',
					'action' => 'department',
					'tab' => 'department',
					'plugin' => 'human_resource'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'position') ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Position',array(
					'controller' => 'settings',
					'action' => 'position',
					'tab' => 'position',
					'plugin' => 'human_resource'
		)); ?>
	</li>
	<li class="<?php echo ($active_tab == 'status') ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Status',array(
					'controller' => 'settings',
					'action' => 'status',
					'tab' => 'status',
					'plugin' => 'human_resource'
		)); ?>
	</li>
</ul>