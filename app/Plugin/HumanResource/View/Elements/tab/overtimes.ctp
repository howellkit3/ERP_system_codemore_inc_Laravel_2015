<ul class="nav nav-tabs">
					<li class="<?php echo  ($active_tab == 'overtimes') ? 'active' : '' ?>" alt="tab-holiday">
					
					<?php echo $this->Html->link('Overtimes',array(
									'controller' => 'overtimes',
									'action' => 'index',
									'tab' => 'overtimes',
									'plugin' => 'human_resource'
						)); ?>

					</li>
					
</ul>