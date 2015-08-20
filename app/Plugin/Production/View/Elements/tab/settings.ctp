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
	
</ul>