<style>

.fontSize{

	font-size:70%;
	margin:0px;
	padding:0px;
}

#config-tool{
	width: 200px;
}

#config-tool.closed {
    right: -200px;
}

</style>

<div id="config-tool" class="open">
		<a id="config-tool-cog">
			<i class="fa fa-cog"></i>
		</a>
		
		<div align = "left" id="config-tool-options" >
			<h4>Production Process</h4>
			<ul>
				<li>
					<?php echo $this->Html->link('Planner',array(
					'controller' => 'jobs',
					'action' => 'plans',
					'tab' => 'plans',
					'plugin' => 'production')); ?>
					
				</li>
				<li>
					<?php echo $this->Html->link('Sheeting / Cutting',array(
					'controller' => 'jobs',
					'action' => 'sheeting',
					'tab' => 'sheeting',
					'plugin' => 'production'
					)); ?>
				</li>
				<li>
					<?php echo $this->Html->link('Printing',array(
					'controller' => 'jobs',
					'action' => 'printing',
					'tab' => 'printing',
					'plugin' => 'production')); ?>
				</li>
				<li>
					<?php echo $this->Html->link('Coating',array(
					'controller' => 'jobs',
					'action' => 'coating',
					'tab' => 'coating',
					'plugin' => 'production')); ?>
				</li>
				<li>
					<?php echo $this->Html->link('Corrugated Lamination',array(
					'controller' => 'jobs',
					'action' => 'corrugated_lamination',
					'tab' => 'corrugated_lamination',
					'plugin' => 'production')); ?>
				</li>

				<li>
					<?php echo $this->Html->link('DieCutting',array(
					'controller' => 'jobs',
					'action' => 'diecutting',
					'tab' => 'diecutting',
					'plugin' => 'production')); ?>
				</li>

				<li>
					<?php echo $this->Html->link('Stripping',array(
					'controller' => 'jobs',
					'action' => 'stripping',
					'tab' => 'stripping',
					'plugin' => 'production'
					)); ?>
				</li>

				<li>
					<?php echo $this->Html->link('Browsing',array(
					'controller' => 'jobs',
					'action' => 'browsing',
					'tab' => 'browsing',
					'plugin' => 'production')); ?>
				</li>

				<li>
					<?php echo $this->Html->link('Gluing',array(
					'controller' => 'jobs',
					'action' => 'gluing',
					'tab' => 'gluing',
					'plugin' => 'production')); ?>
				</li>

				<li>
					<?php echo $this->Html->link('Final Inspection',array(
					'controller' => 'jobs',
					'action' => 'final_inspection',
					'tab' => 'final_inspection',
					'plugin' => 'production')); ?>
				</li>

				<li>
					<?php echo $this->Html->link('Scrap Items',array(
					'controller' => 'jobs',
					'action' => 'scrap_items',
					'tab' => 'scrap_items',
					'plugin' => 'production')); ?>
				</li>

				<li>
					<?php echo $this->Html->link('Packing',array(
					'controller' => 'jobs',
					'action' => 'packing',
					'tab' => 'packing',
					'plugin' => 'production')); ?>
				</li>

				<li>
					<?php echo $this->Html->link('Settings',array(
					'controller' => 'settings',
					'action' => 'machines',
					'tab' => 'machines',
					'plugin' => 'production')); ?>
				</li>

			</ul>
		</div>
	</div>


<!-- <ul class="nav nav-tabs">

	<li class="<?php echo ($active_tab == 'plans' || $this->params['controller'] == 'plans' || $this->params['action'] == 'plans') ? 'active' : '' ?> fontSize" alt="tab-plans">
	
		<?php echo $this->Html->link('Planner',array(
					'controller' => 'jobs',
					'action' => 'plans',
					'tab' => 'plans',
					'plugin' => 'production'
		)); ?>

	</li>

	<li class="<?php echo ($active_tab == 'sheeting') ? 'active' : '' ?> fontSize" alt="tab-schedules">
		<?php echo $this->Html->link('Sheeting / Cutting',array(
					'controller' => 'jobs',
					'action' => 'sheeting',
					'tab' => 'sheeting',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'printing') ? 'active' : '' ?> fontSize" alt="tab-schedules">
		<?php echo $this->Html->link('Printing',array(
					'controller' => 'jobs',
					'action' => 'printing',
					'tab' => 'printing',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'coating') ? 'active' : '' ?> fontSize" alt="tab-controls">
		<?php echo $this->Html->link('Coating',array(
					'controller' => 'jobs',
					'action' => 'coating',
					'tab' => 'coating',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'corrugated_lamination') ? 'active' : '' ?> fontSize" alt="tab-controls">
		<?php echo $this->Html->link('Corrugated Lamination',array(
					'controller' => 'jobs',
					'action' => 'corrugated_lamination',
					'tab' => 'corrugated_lamination',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'diecutting') ? 'active' : '' ?> fontSize" alt="tab-controls">
		<?php echo $this->Html->link('DieCutting',array(
					'controller' => 'jobs',
					'action' => 'diecutting',
					'tab' => 'diecutting',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'stripping') ? 'active' : '' ?> fontSize" alt="tab-controls">
		<?php echo $this->Html->link('Stripping',array(
					'controller' => 'jobs',
					'action' => 'stripping',
					'tab' => 'stripping',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'browsing') ? 'active' : '' ?> fontSize" alt="tab-controls">
		<?php echo $this->Html->link('Browsing',array(
					'controller' => 'jobs',
					'action' => 'browsing',
					'tab' => 'browsing',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'gluing') ? 'active' : '' ?> fontSize" alt="tab-controls">
		<?php echo $this->Html->link('Gluing',array(
					'controller' => 'jobs',
					'action' => 'gluing',
					'tab' => 'gluing',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'final_inspection') ? 'active' : '' ?> fontSize" alt="tab-controls">
		<?php echo $this->Html->link('Final Inspection',array(
					'controller' => 'jobs',
					'action' => 'final_inspection',
					'tab' => 'final_inspection',
					'plugin' => 'production'
		)); ?>
	</li>
	
	<li class="<?php echo ($active_tab == 'scrap_items') ? 'active' : '' ?> fontSize" alt="tab-controls">
		<?php echo $this->Html->link('Scrap Items',array(
					'controller' => 'jobs',
					'action' => 'scrap_items',
					'tab' => 'scrap_items',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'packing') ? 'active' : '' ?> fontSize" alt="tab-controls">
		<?php echo $this->Html->link('Packing',array(
					'controller' => 'jobs',
					'action' => 'packing',
					'tab' => 'packing',
					'plugin' => 'production'
		)); ?>
	</li>

	<li class="<?php echo ($active_tab == 'settings') ? 'active' : '' ?> fontSize" alt="tab-controls">
		<?php echo $this->Html->link('Settings',array(
					'controller' => 'settings',
					'action' => 'machines',
					'tab' => 'machines',
					'plugin' => 'production'
		)); ?>
	</li>

</ul> -->