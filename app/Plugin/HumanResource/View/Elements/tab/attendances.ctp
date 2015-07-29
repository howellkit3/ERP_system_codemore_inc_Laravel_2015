<ul class="nav nav-tabs">
					<li class="<?php echo ($active_tab == 'attendance' || ($this->params['controller'] == 'attendances' && $this->params['action'] == 'index')) ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Attendance',array(
									'controller' => 'attendances',
									'action' => 'index',
									'tab' => 'attendance',
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

					<li class="<?php echo ($active_tab == 'absences') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Absences',array(
									'controller' => 'attendances',
									'action' => 'absences',
									'tab' => 'absences',
									'plugin' => 'human_resource'
						)); ?>
					</li>
</ul>