<ul class="nav nav-tabs">

	<li class="<?php echo ($active_tab == 'plans' || $this->params['controller'] == 'plans' || $this->params['action'] == 'plans') ? 'active' : '' ?>" alt="tab-plans">
	
		<?php echo $this->Html->link('Planner',array(
					'controller' => 'jobs',
					'action' => 'plans',
					'tab' => 'plans',
					'plugin' => 'production'
		)); ?>

	</li>

	<li class="<?php echo ($active_tab == 'sheeting') ? 'active' : '' ?>" alt="tab-schedules">
		<?php echo $this->Html->link('Sheeting / Cutting',array(
					'controller' => 'jobs',
					'action' => 'sheeting',
					'tab' => 'sheeting',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'printing') ? 'active' : '' ?>" alt="tab-schedules">
		<?php echo $this->Html->link('Printing',array(
					'controller' => 'jobs',
					'action' => 'printing',
					'tab' => 'printing',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'coating') ? 'active' : '' ?>" alt="tab-controls">
		<?php echo $this->Html->link('Coating',array(
					'controller' => 'jobs',
					'action' => 'coating',
					'tab' => 'coating',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'corrugated_lamination') ? 'active' : '' ?>" alt="tab-controls">
		<?php echo $this->Html->link('Corrugated Lamination',array(
					'controller' => 'jobs',
					'action' => 'corrugated_lamination',
					'tab' => 'corrugated_lamination',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'diecutting') ? 'active' : '' ?>" alt="tab-controls">
		<?php echo $this->Html->link('DieCutting',array(
					'controller' => 'jobs',
					'action' => 'diecutting',
					'tab' => 'diecutting',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'stripping') ? 'active' : '' ?>" alt="tab-controls">
		<?php echo $this->Html->link('Stripping',array(
					'controller' => 'jobs',
					'action' => 'stripping',
					'tab' => 'stripping',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'browsing') ? 'active' : '' ?>" alt="tab-controls">
		<?php echo $this->Html->link('Browsing',array(
					'controller' => 'jobs',
					'action' => 'browsing',
					'tab' => 'browsing',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'gluing') ? 'active' : '' ?>" alt="tab-controls">
		<?php echo $this->Html->link('Gluing',array(
					'controller' => 'jobs',
					'action' => 'gluing',
					'tab' => 'gluing',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'final_inspection') ? 'active' : '' ?>" alt="tab-controls">
		<?php echo $this->Html->link('Final Inspection',array(
					'controller' => 'jobs',
					'action' => 'final_inspection',
					'tab' => 'final_inspection',
					'plugin' => 'production'
		)); ?>
	</li>
	
	<li class="<?php echo ($active_tab == 'scrap_items') ? 'active' : '' ?>" alt="tab-controls">
		<?php echo $this->Html->link('Scrap Items',array(
					'controller' => 'jobs',
					'action' => 'scrap_items',
					'tab' => 'scrap_items',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'packing') ? 'active' : '' ?>" alt="tab-controls">
		<?php echo $this->Html->link('Packing',array(
					'controller' => 'jobs',
					'action' => 'packing',
					'tab' => 'packing',
					'plugin' => 'production'
		)); ?>
	</li>

</ul>