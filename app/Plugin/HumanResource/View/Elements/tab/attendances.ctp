<ul class="nav nav-tabs">
	<li class="<?php echo ($active_tab == 'attendance' || ($this->params['controller'] == 'attendances' && $this->params['action'] == 'index')) ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Attendance',array(
					'controller' => 'attendances',
					'action' => 'index',
					'tab' => 'attendance',
					'plugin' => 'human_resource'
		)); ?>
	</li>

	<li class="<?php echo ($this->params['controller'] == 'attendances' && $this->params['action'] == 'irreg_ot') ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Irregular OT',array(
					'controller' => 'attendances',
					'action' => 'irreg_ot',
					'tab' => 'irreg_ot',
					'plugin' => 'human_resource'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'timekeep') || $this->params['action'] == 'timekeep' ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Sign I/O',array(
					'controller' => 'attendances',
					'action' => 'timekeep',
					'tab' => 'timekeep',
					'plugin' => 'human_resource'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'daily_info') || $this->params['action'] == 'daily_info' ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Daily Info',array(
					'controller' => 'attendances',
					'action' => 'daily_info',
					'tab' => 'daily_info',
					'plugin' => 'human_resource'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'absences' || $this->params['action'] == 'absences') ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Absences',array(
					'controller' => 'attendances',
					'action' => 'absences',
					'tab' => 'absences',
					'plugin' => 'human_resource'
		)); ?>
	</li>
	<li class="<?php echo ($active_tab == 'leaves' || $this->params['action'] == 'leaves') ? 'active' : '' ?>" alt="tab-type">
		<?php echo $this->Html->link('Leaves',array(
					'controller' => 'attendances',
					'action' => 'leaves',
					'tab' => 'leaves',
					'plugin' => 'human_resource'
		)); ?>
	</li>
</ul>