<div id="nav-col">
	<section id="col-left" class="col-left-nano">
		<div id="col-left-inner" class="col-left-nano-content">
			<div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
			<?php echo $this->Html->image('samples/scarlet-159.png',array('alt' => 'scarlet-159'));  ?>
				<div class="user-box">
					<span class="name">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Scarlett J. 
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="user-profile.html"><i class="fa fa-user"></i>Profile</a></li>
							<li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
							<li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li>
							<li><a href="#"><i class="fa fa-power-off"></i>Logout</a></li>
						</ul>
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
					<li class="active">

						<?php
	 						echo $this->Html->link( "<i class='fa fa-dashboard'></i>
								<span>Dashboard</span>
								<span class='label label-primary label-circle pull-right'>28</span> ",   array('controller' =>'dashboards','action'=>'index','plugin' => null),array('escape' => false) );
	 					?>
					</li>

					<li>
						<?php
	 						echo $this->Html->link( " <i class='fa fa-th-large'></i> <span>Sales</span> <span class='label label-success pull-right'>New</span> ",   array('controller' =>'customer_sales','action'=>'index','plugin' => 'sales'),array('escape' => false) );
	 					?>
					</li>

					<li>
						<?php
	 						echo $this->Html->link( " <i class='fa fa-th-large'></i> <span>Warehouse</span> <span class='label label-success pull-right'>New</span> ",   array('controller' =>'','action'=>'','plugin' => ''),array('escape' => false) );
	 					?>
					</li>

					<li>
						<?php
	 						echo $this->Html->link( " <i class='fa fa-th-large'></i> <span>Purchasing</span> <span class='label label-success pull-right'>New</span> ",   array('controller' =>'','action'=>'','plugin' => ''),array('escape' => false) );
	 					?>
					</li>
					
				</ul>
			</div>
		</div>
	</section>
	<div id="nav-col-submenu"></div>
</div>