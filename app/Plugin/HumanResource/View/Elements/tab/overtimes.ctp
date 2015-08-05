<ul class="nav nav-tabs">
					<li class="<?php echo  ($active_tab == 'overtimes') ? 'active' : '' ?>" alt="tab-holiday">
					
					<?php echo $this->Html->link('Overtimes',array(
									'controller' => 'overtimes',
									'action' => 'index',
									'tab' => 'overtimes',
									'plugin' => 'human_resource'
						)); ?>

					</li>

					<li class="<?php echo  ($active_tab == 'pendings') ? 'active' : '' ?>" alt="tab-holiday">
					
					<?php echo $this->Html->link('Pending List',array(
									'controller' => 'overtimes',
									'action' => 'pendings',
									'tab' => 'overtimes',
									'plugin' => 'human_resource'
						)); ?>

					</li>
					
</ul>