<ul class="nav nav-tabs">
					<!-- <li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'index') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Salaries',array(
									'controller' => 'salaries',
									'action' => 'index',
									'tab' => 'salaries',
									'plugin' => 'human_resource'
						)); ?>
					</li>  -->
					<!-- <li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'calculate') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Calculate',array(
									'controller' => 'salaries',
									'action' => 'calculate',
									'tab' => 'calculate',
									'plugin' => 'human_resource'
						)); ?>
					</li> -->
					<li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'export') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Salary',array(
									'controller' => 'salaries',
									'action' => 'export',
									'tab' => 'export',
									'plugin' => 'human_resource'
						)); ?>
					</li>

					<li class="<?php echo ($this->params['controller'] == 'salaries' && in_array($this->params['action'], array('payroll','payroll_view'))) ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Payroll',array(
									'controller' => 'salaries',
									'action' => 'payroll',
									'tab' => 'export',
									'plugin' => 'human_resource'
						)); ?>
					</li>
					

					<li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'deductions') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Deductions',array(
									'controller' => 'salaries',
									'action' => 'deductions',
									'tab' => 'deductions',
									'plugin' => 'human_resource'
						)); ?>
					</li> 

					 <li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'sss_table') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('SSS',array(
									'controller' => 'salaries',
									'action' => 'sss_table',
									'tab' => 'sss_table',
									'plugin' => 'human_resource'
						)); ?>
					</li> 
					 <li class="<?php echo ($this->params['controller'] == 'salaries' && $this->params['action'] == 'philhealth_table') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('PhilHealth',array(
									'controller' => 'salaries',
									'action' => 'philhealth_table',
									'tab' => 'philhealth_table',
									'plugin' => 'human_resource'
						)); ?>
					</li> 
					 
</ul>