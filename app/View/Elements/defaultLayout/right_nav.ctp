<div id="nav-col">
	<section id="col-left" class="col-left-nano">
		<div id="col-left-inner" class="col-left-nano-content">
			<div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">

				<?php 
					$serverPath = $this->Html->url('/',true);


				  // if (!empty($userData['User']['image']) && file_exists($serverPath.'img/uploads/users/'.$userData['User']['image'])) {
	
			   //                          $background =  $serverPath.'img/uploads/users/'.$userData['User']['image'];	
			   //                          $style = 'background:url('.$background.'); background-size:cover;bacground-position:center';
	     //             }  else {

	     //             		$style = "background:url('".$serverPath ."img/samples/icon-user-default.png'); background-size:100%";

	     //             }


	                    $style = '';

                     $serverPath = $this->Html->url('/',true);

                     $file = 'img/uploads/users/'.$userData['User']['image'];  // 'images/'.$file (physical path)

                 
                    if (!empty($userData['User']['image']) && file_exists($file) == true) {

                        $background =  $serverPath.'img/uploads/users/'.$userData['User']['image'];	
                        
                    } else {

                    	 $background =  $serverPath.'img/samples/icon-user-default.png';		
                    }

                    $style = 'background:url('.$background.')';

				?>
				<div class="image_profile" style="<?php echo $style; ?>; min-width:70px;border-radius: 8px;height: 100px; max-width: 100px; background-position:center;background-size:100%;">

					<?php //echo $this->Html->image('',array('alt' => 'scarlet-159'));  ?>	
				</div>
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

						<?php  if(in_array($userData['User']['role_id'],array('1','2','3','8', '6', '9', '15'))) {

	 						echo $this->Html->link( " <i class='fa fa-shopping-cart '></i> <span>Sales </span> ",   array('controller' =>'customer_sales','action'=>'index?'.rand(1000,9999).'='.date("is"),'plugin' => 'sales'),array('escape' => false) );
	 					}
	 					?>
					</li>

					<li class="<?php echo ($this->params['plugin'] == 'ticket') ? 'active' : '' ?>">
						
						<?php  if(in_array($userData['User']['role_id'],array('1','2','3','8'))) {

	 						echo $this->Html->link( " <i class='fa fa-ticket'></i> <span>Ticketing System</span>",   array('controller' =>'ticketing_systems','action'=>'index?'.rand(1000,9999).'='.date("is"),'plugin' => 'ticket'),array('escape' => false) );

	 					}
	 					?>
					</li>
					 
					<li class="<?php echo ($this->params['plugin'] == 'purchasing') ? 'active' : '' ?>">

						<?php  if(in_array($userData['User']['role_id'],array('1','2','7','10','6','8','4','16','3'))) {

						 echo $this->Html->link( " <i class='fa fa-th-large'></i> <span>Purchasing</span>",   array('controller' =>'suppliers','action'=>'index?'.rand(1000,9999).'='.date("is"),'plugin' => 'purchasing'),array('escape' => false) );
						}
	 					?>
					</li>


					<li class="<?php echo ($this->params['plugin'] == 'ware_house') ? 'active' : '' ?>">

						<?php  if(in_array($userData['User']['role_id'],array('1','2','4','7','15','8','16','3','12','9', '10'))) {
	 						  echo $this->Html->link( " <i class='fa fa-archive'></i> <span>Ware House</span>",   array('controller' =>'receivings','action'=>'index?'.rand(1000,9999).'='.date("is"),'plugin' => 'ware_house'),array('escape' => false) );
								// echo $this->Html->link( " <i class='fa fa-archive'></i> <span>Ware House</span>",   array('controller' =>'ware_house_systems','action'=>'dashboard','plugin' => 'ware_house'),array('escape' => false) );
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

						<?php  if(in_array($userData['User']['role_id'],array('1','2','5','3','9','6','15','8'))) {	

	 						echo $this->Html->link( " <i class='fa fa-truck'></i> <span>Delivery</span>",   array('controller' =>'deliveries',
	 											'action'=>'index?'.rand(1000,9999).'='.date("is"),
	 											'plugin' => 'delivery'),
	 											array('escape' => false) );
	 					}
	 					?>
					</li>
					<li class="<?php echo ($this->params['plugin'] == 'accounting') ? 'active' : '' ?>">

						<?php  if(in_array($userData['User']['role_id'],array('1','2','6','9','10','11'))) {	

	 						echo $this->Html->link( " <i class='fa fa-money'></i> <span>Accounting</span>",   array('controller' =>'sales_invoice',
	 											'action'=>'index?'.rand(1000,9999).'='.date("is"),
	 											'plugin' => 'accounting'),
	 											array('escape' => false) );
	 					}
	 					?>
					</li>

					<li class="<?php echo ($this->params['plugin'] == 'human_resource' && in_array($this->params['controller'],array('salaries'))) ? 'active' : '' ?>">

						<?php 


						 if(in_array($userData['User']['role_id'],array('19'))) {

	 						echo $this->Html->link( " <i class='fa fa-money'></i> <span> Payroll </span>",   array('controller' =>'salaries',
	 											'action'=>'payroll',
	 											'plugin' => 'human_resource'),
	 											array('escape' => false) );
	 					}
	 					?>
					</li>

				 	<li class="<?php echo ($this->params['plugin'] == 'human_resource' && !in_array($this->params['controller'],array('salaries')))  ? 'active' : '' ?>">

						<?php 

						 if(in_array($userData['User']['role_id'],array('1','12','19'))) {
						
	 						echo $this->Html->link( " <i class='fa fa-user'></i> <span>Human Resource</span>",   array('controller' =>'dashboards','action'=>'index?'.rand(1000,9999).'='.date("is"),'plugin' => 'human_resource'),
	 											array('escape' => false) );
	 						}
	 					?>
					</li> 

					<li class="<?php echo ($this->params['plugin'] == 'production') ? 'active' : '' ?>">

						<?php if($userData['User']['role_id'] == 1 OR $userData['User']['role_id'] == 2 OR $userData['User']['role_id'] == 13 OR $userData['User']['role_id'] == 15 ){


	 						echo $this->Html->link( " <i class='fa fa-cogs'></i> <span>Production</span>",   array('controller' =>'production_dashboards',
	 											'action'=>'index?'.rand(1000,9999).'='.date("is"),
	 											'plugin' => 'production'),
	 											array('escape' => false) );
	 					}
	 					?>
					</li> 

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