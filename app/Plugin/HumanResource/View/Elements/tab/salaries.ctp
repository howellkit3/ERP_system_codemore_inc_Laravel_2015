<ul class="nav nav-tabs">
					<li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'index') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Salaries',array(
									'controller' => 'salaries',
									'action' => 'index',
									'tab' => 'salaries',
									'plugin' => 'human_resource'
						)); ?>
					</li> 
					<li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'calculate') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Calculate',array(
									'controller' => 'salaries',
									'action' => 'calculate',
									'tab' => 'calculate',
									'plugin' => 'human_resource'
						)); ?>
					</li>
					<li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'export') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Summary',array(
									'controller' => 'salaries',
									'action' => 'export',
									'tab' => 'export',
									'plugin' => 'human_resource'
						)); ?>
					</li>
					<!-- <li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'reports') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Reports',array(
									'controller' => 'attendances',
									'action' => 'index',
									'tab' => 'attendance',
									'plugin' => 'human_resource'
						)); ?>
					</li> -->
</ul>