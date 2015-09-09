<ul class="nav nav-tabs">
				
					<li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'reports') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Gross Salary',array(
									'controller' => 'salaries',
									'action' => 'export',
									'tab' => 'export',
									'plugin' => 'human_resource'
						)); ?>
					</li>
					<!-- <li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'sss_reports') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('SSS',array(
									'controller' => 'salaries',
									'action' => 'sss_reports',
									'tab' => 'sss_reports',
									'plugin' => 'human_resource'
						)); ?>
					</li> -->
					<li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'sss_report_lists') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('SSS',array(
									'controller' => 'salaries',
									'action' => 'sss_report_lists',
									'tab' => 'sss_report_lists',
									'plugin' => 'human_resource'
						)); ?>
					</li>
					<li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'pagibig_reports') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Pagibig',array(
									'controller' => 'salaries',
									'action' => 'pagibig_reports',
									'tab' => 'pagibig_reports',
									'plugin' => 'human_resource'
						)); ?>
					</li>
					
					

</ul>