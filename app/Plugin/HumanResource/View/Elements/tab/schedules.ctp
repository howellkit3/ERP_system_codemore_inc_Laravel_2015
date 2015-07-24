<ul class="nav nav-tabs">
					<li class="<?php echo ($active_tab == 'tab-holiday') ? 'active' : '' ?>" alt="tab-holiday"><a href="#tab-employee" data-toggle="tab">Holidays</a></li>
					<li class="<?php echo ($active_tab == 'calendar') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Calendar',array(
									'controller' => 'schedules',
									'action' => 'calendar',
									'tab' => 'calendar',
									'plugin' => 'human_resource'
						)); ?>
					</li>
					<li class="<?php echo ($active_tab == 'breaktime') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Breaktime',array(
									'controller' => 'schedules',
									'action' => 'breaktime',
									'tab' => 'breaktime',
									'plugin' => 'human_resource'
						)); ?>
					</li>

					<li class="<?php echo ($active_tab == 'workshift') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Work Shift',array(
									'controller' => 'schedules',
									'action' => 'workshifts',
									'tab' => 'workshift',
									'plugin' => 'human_resource'
						)); ?>
					</li>
					<li class="<?php echo ($active_tab == 'work-schedules') ? 'active' : '' ?>" alt="tab-type">
						<?php echo $this->Html->link('Work Schedules',array(
									'controller' => 'schedules',
									'action' => 'workshifts',
									'tab' => 'workshift',
									'plugin' => 'human_resource'
						)); ?>
					</li>
</ul>