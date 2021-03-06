<header class="navbar" id="header-navbar">
	<div class="container">
		<a href="<?php echo Router::url('/', true) ?>dashboards" id="logo" class="navbar-brand">
		<?php echo $this->Html->image('logo.png',array('alt' => '','class' =>'normal-logo logo-black'));  ?>
		<?php echo $this->Html->image('logo-black.png',array('alt' => '','class' =>'normal-logo logo-black'));  ?>
		<?php echo $this->Html->image('logo-small.png',array('alt' => '','class' =>'small-logo hidden-xs hidden-sm hidde'));  ?>
		</a>
		
		<div class="clearfix">
		<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="fa fa-bars"></span>
		</button>
		
		<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
			<ul class="nav navbar-nav pull-left">
				<li>
					<a class="btn" id="make-small-nav">
						<i class="fa fa-bars"></i>
					</a>
				</li>
		<!-- 		<li class="dropdown hidden-xs">
					<a class="btn dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell"></i>
						<span class="count">8</span>
					</a>
					<ul class="dropdown-menu notifications-list">
						<li class="pointer">
							<div class="pointer-inner">
								<div class="arrow"></div>
							</div>
						</li>
						<li class="item-header">You have 6 new notifications</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-comment"></i>
								<span class="content">New comment on ‘Awesome P...</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-plus"></i>
								<span class="content">New user registration</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-envelope"></i>
								<span class="content">New Message from George</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-shopping-cart"></i>
								<span class="content">New purchase</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-eye"></i>
								<span class="content">New order</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item-footer">
							<a href="#">
								View all notifications
							</a>
						</li>
					</ul>
				</li> -->
		<!-- 		<li class="dropdown hidden-xs">
					<a class="btn dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope-o"></i>
						<span class="count">16</span>
					</a>
					<ul class="dropdown-menu notifications-list messages-list">
						<li class="pointer">
							<div class="pointer-inner">
								<div class="arrow"></div>
							</div>
						</li>
						<li class="item first-item">
							<a href="#">
							
									<?php echo $this->Html->image('samples/messages-photo-1.png',array('alt' => 'scarlet-159'));  ?>
								<span class="content">
									<span class="content-headline">
										George Clooney
									</span>
									<span class="content-text">
										Look, just because I don't be givin' no man a foot massage don't make it 
										right for Marsellus to throw...
									</span>
								</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item">
							<a href="#">
								<?php echo $this->Html->image('samples/messages-photo-2.png',array('alt' => 'scarlet-159'));  ?>
								<span class="content">
									<span class="content-headline">
										Emma Watson
									</span>
									<span class="content-text">
										Look, just because I don't be givin' no man a foot massage don't make it 
										right for Marsellus to throw...
									</span>
								</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item">
							<a href="#">
								<?php echo $this->Html->image('samples/messages-photo-3.png',array('alt' => 'scarlet-159'));  ?>
								<span class="content">
									<span class="content-headline">
										Robert Downey Jr.
									</span>
									<span class="content-text">
										Look, just because I don't be givin' no man a foot massage don't make it 
										right for Marsellus to throw...
									</span>
								</span>
								<span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
							</a>
						</li>
						<li class="item-footer">
							<a href="#">
								View all messages
							</a>
						</li>
					</ul>
				</li> -->
		<!-- 		<li class="dropdown hidden-xs">
					<a class="btn dropdown-toggle" data-toggle="dropdown">
						New Item
						<i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li class="item">
							<a href="#">
								<i class="fa fa-archive"></i> 
								New Product
							</a>
						</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-shopping-cart"></i> 
								New Order
							</a>
						</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-sitemap"></i> 
								New Category
							</a>
						</li>
						<li class="item">
							<a href="#">
								<i class="fa fa-file-text"></i> 
								New Page
							</a>
						</li>
					</ul>
				</li> -->
		<!-- 		<li class="dropdown hidden-xs">
					<a class="btn dropdown-toggle" data-toggle="dropdown">
						English
						<i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li class="item">
							<a href="#">
								Spanish
							</a>
						</li>
						<li class="item">
							<a href="#">
								German
							</a>
						</li>
						<li class="item">
							<a href="#">
								Italian
							</a>
						</li>
					</ul>
				</li> -->
			</ul>
		</div>
		
		<div class="nav-no-collapse pull-right" id="header-nav">
			<ul class="nav navbar-nav pull-right">
			<!-- 	<li class="mobile-search">
					<a class="btn">
						<i class="fa fa-search"></i>
					</a>
					
					<div class="drowdown-search">
						<form role="search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Search...">
								<i class="fa fa-search nav-search-icon"></i>
							</div>
						</form>
					</div>
					
				</li> -->
				<li class="dropdown profile-dropdown">
				
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?php // echo $this->Html->image('samples/scarlet-159.png',array('alt' => 'scarlet-159'));  ?>
						<span class="hidden-xs">Profile</span> <b class="caret"></b>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<!-- <li><a href="user-profile.html"><i class="fa fa-user"></i>Profile</a></li> -->
						<?php if($userData['User']['role_id'] == 8 || $userData['User']['role_id'] == 7 || $userData['User']['role_id'] == 4 || $userData['User']['role_id'] == 3 || $userData['User']['role_id'] == 16){ ?>

						<li>
								<?php
			 						echo $this->Html->link( "<i class='fa fa-cog'></i> Settings ",   array('controller' =>'settings','action'=>'category','plugin' => null),array('escape' => false) );
			 					?>
			 			</li>

			 			<?php  }?>

			 			<?php if(in_array($userData['User']['role_id'],array('1','19'))) : ?>

			 				<li>
								<?php
			 						echo $this->Html->link( "<i class='fa fa-cog'></i> Payroll Settings ",   array('controller' =>'payroll_settings','action'=>'settings','plugin' => null),array('escape' => false) );
			 					?>
			 				</li>
			 			<?php endif; ?>	

						
		 				<?php if($userData['User']['role_id'] == 1 || $userData['User']['role_id'] == 2){ ?>
		 					<li>
								<?php
			 						echo $this->Html->link( "<i class='fa fa-cog'></i> Settings ",   array('controller' =>'settings','action'=>'category','plugin' => null),array('escape' => false) );
			 					?>
			 				</li>
			 				<li>
								<?php
			 						echo $this->Html->link( "<i class='fa fa-cog'></i> Payroll Settings ",   array('controller' =>'payroll_settings','action'=>'settings','plugin' => null),array('escape' => false) );
			 					?>
			 				</li>
			 				<li>
								<?php
			 						echo $this->Html->link( "<i class='fa fa-cog'></i> Role and Permission ",   array('controller' =>'settings','action'=>'role_perm','plugin' => null),array('escape' => false) );
			 					?>
			 				</li>
			 				<li>
								<?php
			 						echo $this->Html->link( "<i class='fa fa-user'></i> Registration ",   array('controller' =>'settings','action'=>'register','plugin' => null),array('escape' => false) );
			 					?>
			 				</li>
			 			<?php } ?>


						<li>
							<?php
		 						echo $this->Html->link( "<i class='fa fa-user'></i> Profile Settings ",   array('controller' =>'users','action'=>'profile_settings','plugin' => null),array('escape' => false) );
		 					?>
						</li>
						<!-- <li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li> -->
						<li>
							<?php
		 						echo $this->Html->link( "<i class='fa fa-power-off'></i>Logout ",   array('controller' =>'users','action'=>'logout','plugin' => null),array('escape' => false) );
		 					?>
						</li>
					</ul>
				</li>
				<!-- <li class="hidden-xxs">
					<a class="btn">
						<i class="fa fa-power-off"></i>
					</a>
				</li> -->
			</ul>
		</div>
		</div>
	</div>
</header>
