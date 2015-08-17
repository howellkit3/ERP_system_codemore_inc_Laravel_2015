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
	<li class="<?php echo ($active_tab == 'agency') ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Agency',array(
					'controller' => 'settings',
					'action' => 'agency',
					'tab' => 'agency',
					'plugin' => 'human_resource'
		)); ?>
	</li>
	<li class="<?php echo ($active_tab == 'tool') ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Tool',array(
					'controller' => 'settings',
					'action' => 'tool',
					'tab' => 'tool',
					'plugin' => 'human_resource'
		)); ?>
	</li>
	<li class="<?php echo ($active_tab == 'category') ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Category',array(
					'controller' => 'settings',
					'action' => 'category',
					'tab' => 'category',
					'plugin' => 'human_resource'
		)); ?>
	</li>
	<li class="<?php echo ($active_tab == 'type') ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Type',array(
					'controller' => 'settings',
					'action' => 'type',
					'tab' => 'type',
					'plugin' => 'human_resource'
		)); ?>
	</li>
	<li class="<?php echo ($active_tab == 'leave_types') ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Leave Type',array(
					'controller' => 'settings',
					'action' => 'leave_types',
					'tab' => 'leave_types',
					'plugin' => 'human_resource'
		)); ?>
	</li>
</ul>