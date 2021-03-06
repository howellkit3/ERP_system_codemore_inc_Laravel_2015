<ul class="nav nav-tabs">

	<li class="<?php echo ($active_tab == 'machines' || $this->params['controller'] == 'machines' || $this->params['action'] == 'machines') ? 'active' : '' ?>" alt="tab-machines">
	
		<?php echo $this->Html->link('Machine',array(
					'controller' => 'settings',
					'action' => 'machines',
					'tab' => 'machines',
					'plugin' => 'production'
		)); ?>

	</li>

	<li class="<?php echo ($active_tab == 'departments') ? 'active' : '' ?>" alt="tab-departments">
		<?php echo $this->Html->link('Department',array(
					'controller' => 'settings',
					'action' => 'departments',
					'tab' => 'departments',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'sections') ? 'active' : '' ?>" alt="tab-sections">
		<?php echo $this->Html->link('Section',array(
					'controller' => 'settings',
					'action' => 'sections',
					'tab' => 'sections',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'processes') ||  $this->params['action'] == 'processes' ? 'active' : '' ?>" alt="tab-sections">
		<?php echo $this->Html->link('Process',array(
					'controller' => 'settings',
					'action' => 'processes',
					'tab' => 'processes',
					'plugin' => 'production'
		)); ?>
	</li>
	
</ul>