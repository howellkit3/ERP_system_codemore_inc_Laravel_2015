<div id="nav-col">
	<section id="col-left" class="col-left-nano">
		<div id="col-left-inner" class="col-left-nano-content">
			<div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
			<?php echo $this->Html->image('samples/icon-user-default.png',array('alt' => 'scarlet-159'));  ?>
				<div class="user-box">
					<span class="name">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php 
								if(isset($userData)){
									echo $userData['User']['first_name'].' '.$userData['User']['last_name'];
								}
							?>
							<!-- <i class="fa fa-angle-down"></i> -->
						</a>
						<!-- <ul class="dropdown-menu"> -->
						<!-- 	<li><a href="user-profile.html"><i class="fa fa-user"></i>Profile</a></li>
							<li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
							<li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li> -->
							<!-- <li> -->
								<?php
			 						//echo $this->Html->link( "<i class='fa fa-power-off'></i>Logout ",   array('controller' =>'users','action'=>'logout','plugin' => null),array('escape' => false) );
			 					?>
							<!-- </li> -->
						<!-- </ul> -->
					</span>
					<span class="status">
						<i class="fa fa-circle"></i> Online
					</span>
				</div>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">	
				<ul class="nav nav-pills nav-stacked">
					<li class="nav-header nav-header-first hidden-sm hidden-xs">
						Navigation
					</li>
					<li class="<?php echo (empty($this->params['plugin'])) ? 'active' : '' ?>">

						<?php
	 						echo $this->Html->link( "<i class='fa fa-dashboard '></i>
								<span>Dashboard</span>",   array('controller' =>'dashboards','action'=>'index','plugin' => null),array('escape' => false) );
	 					?>
					</li>

					<li class="<?php echo ($this->params['plugin'] == 'sales') ? 'active' : '' ?>">
						<?php if($userData['User']['role_id'] == 1 OR $userData['User']['role_id'] == 2 OR $userData['User']['role_id'] == 3 OR $userData['User']['role_id'] == 8 OR $userData['User']['role_id'] == 6 OR $userData['User']['role_id'] == 9){
	 						echo $this->Html->link( " <i class='fa fa-shopping-cart '></i> <span>Sales</span> ",   array('controller' =>'customer_sales','action'=>'index','plugin' => 'sales'),array('escape' => false) );
	 					}
	 					?>
					</li>

					<li class="<?php echo ($this->params['plugin'] == 'ticket') ? 'active' : '' ?>">
						<?php  if($userData['User']['role_id'] == 1 OR $userData['User']['role_id'] == 2 OR $userData['User']['role_id'] == 3 OR $userData['User']['role_id'] == 8){

	 						echo $this->Html->link( " <i class='fa fa-ticket'></i> <span>Ticketing System</span>",   array('controller' =>'ticketing_systems','action'=>'index','plugin' => 'ticket'),array('escape' => false) );

	 					}
	 					?>
					</li>
					 
					<!-- <li class="<?php echo ($this->params['plugin'] == 'purchasing') ? 'active' : '' ?>">

						<?php  if($userData['User']['role_id'] == 1 OR $userData['User']['role_id'] == 2 OR $userData['User']['role_id'] == 7 OR $userData['User']['role_id'] == 10 OR $userData['User']['role_id'] == 6){

						 echo $this->Html->link( " <i class='fa fa-th-large'></i> <span>Purchasing</span>",   array('controller' =>'suppliers','action'=>'index','plugin' => 'purchasing'),array('escape' => false) );
						}
	 					?>
					</li> -->

		
					
					<li class="<?php echo ($this->params['plugin'] == 'ware_house') ? 'active' : '' ?>">

						<?php  if($userData['User']['role_id'] == 1 OR $userData['User']['role_id'] == 2 OR $userData['User']['role_id'] == 4 OR $userData['User']['role_id'] == 7){

	 						 echo $this->Html->link( " <i class='fa fa-archive'></i> <span>Ware House</span>",   array('controller' =>'ware_house_systems','action'=>'index','plugin' => 'ware_house'),array('escape' => false) );
	 						}
	 					?>
					</li>
					<!-- <li class="<?php //echo ($this->params['plugin'] == 'production') ? 'active' : '' ?>"> -->
						<?php
	 					//	echo $this->Html->link( " <i class='fa fa-archive'></i> <span>Production</span>",   array('controller' =>'schedules',
	 											// 'action'=>'index',
	 											// 'plugin' => 'production'),
	 											// array('escape' => false) );
	 					?>
					<!-- </li> -->
					<li class="<?php echo ($this->params['plugin'] == 'delivery') ? 'active' : '' ?>">

						<?php  if($userData['User']['role_id'] == 1 OR $userData['User']['role_id'] == 2 OR $userData['User']['role_id'] == 5 OR $userData['User']['role_id'] == 3 OR $userData['User']['role_id'] == 9 OR $userData['User']['role_id'] == 6){

						
	 						echo $this->Html->link( " <i class='fa fa-truck'></i> <span>Delivery</span>",   array('controller' =>'deliveries',
	 											'action'=>'index',
	 											'plugin' => 'delivery'),
	 											array('escape' => false) );
	 					}
	 					?>
					</li>
					<li class="<?php echo ($this->params['plugin'] == 'accounting') ? 'active' : '' ?>">

						<?php if($userData['User']['role_id'] == 1 OR $userData['User']['role_id'] == 2 OR $userData['User']['role_id'] == 6 OR $userData['User']['role_id'] == 9 OR $userData['User']['role_id'] == 10 OR $userData['User']['role_id'] == 11){


	 						echo $this->Html->link( " <i class='fa fa-money'></i> <span>Accounting</span>",   array('controller' =>'sales_invoice',
	 											'action'=>'index',
	 											'plugin' => 'accounting'),
	 											array('escape' => false) );
	 					}
	 					?>
					</li>

					<!-- <li class="<?php echo ($this->params['plugin'] == 'human_resource') ? 'active' : '' ?>">

						<?php  if($userData['User']['role_id'] == 1 OR $userData['User']['role_id'] == 2){

						
	 						echo $this->Html->link( " <i class='fa fa-user'></i> <span>Human Resource</span>",   array('controller' =>'employees','action'=>'index','plugin' => 'human_resource'),
	 											array('escape' => false) );
	 					}
	 					?>
					</li>  -->

					<!-- <li>
						<?php
	 						// echo $this->Html->link( " <i class='fa fa-th-large'></i> <span>Warehouse</span> <span class='label label-success pull-right'>New</span> ",   array('controller' =>'','action'=>'','plugin' => ''),array('escape' => false) );
	 					?>
					</li>

					<li>
						<?php
	 						// echo $this->Html->link( " <i class='fa fa-th-large'></i> <span>Purchasing</span> <span class='label label-success pull-right'>New</span> ",   array('controller' =>'','action'=>'','plugin' => ''),array('escape' => false) );
	 					?>
					</li> -->

				</ul>
			</div>
		</div>
	</section>
	<div id="nav-col-submenu"></div>
</div>