<?php $this->Html->addCrumb('Ticketing System', array('controller' => 'ticketing_systems', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'ticketing_systems', 'action' => 'view')); ?>

<div class="row">
	<div class="col-lg-12">
		
		<section id="cd-timeline" class="cd-container">
			<div class="cd-timeline-block">
				<div class="cd-timeline-img cd-picture">
					<i class="glyphicon glyphicon-compressed"></i>
				</div>
	
				<div class="cd-timeline-content">
					<h2>Prepress</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
					<div class="clearfix">

						<?php
							if( ($ticketData['Ticket']['status'] == 0) && ($ticketData['Ticket']['job_ticket_id'] == 1)){
						?>

							<span class="label label-default label-large">Pending</span><br><br>
							<hr></hr>
								<?php
                       				echo $this->Html->link('Accept Job', array('controller' => 'ticketing_systems', 
                       							'action' => 'updatePendingStatus', 
                       							$ticketid),array('class' =>'btn btn-info',
                       							'escape' => false));
                       			?>

                       			<?php
                       				echo $this->Html->link('Finished Job', array('controller' => 'ticketing_systems', 
                       								'action' => 'finishedJob',
                       								$ticketid),array('class' =>'btn btn-info',
                       								'escape' => false));
								
							}

							elseif ( ($ticketData['Ticket']['status'] == 1) && ($ticketData['Ticket']['job_ticket_id'] == 1)){
							?>

								<span class="label label-default label-large">Pending</span>
								<span class="label label-warning label-large">On Progress</span><br>
								<hr></hr>
								
								<?php
                       				echo $this->Html->link('Finished Job', array('controller' => 'ticketing_systems', 
                       							 'action' => 'finishedJob',
                       							  $ticketid),array('class' =>'btn btn-info',
                       							  'escape' => false));
                   			 }
                   			 else{

                   			 	?>
                   			 		<span class="label label-default label-large">Pending</span>
									<span class="label label-warning label-large">On Progress</span>
                   			 		<span class="label label-success label-large">Complete</span><br><br>

                   			<?php
                   			 }
                   			?>
						<div class="col-md-1 col-sm-6 col-xs-6 pricing-package pull-right">
							<!-- <div class="pricing-star">Task<br>Done</div> -->

						<!-- 	<div class="package-header yellow-bg">
								<a class="btn yellow-bg pull-right"><font color="white">Finished</font></a>
							</div> -->
						</div>
						
					</div>
					<span class="cd-date">11:59</span>
				</div>
			</div>
	
			<div class="cd-timeline-block">
				<div class="cd-timeline-img cd-movie">
					<i class="fa fa-video-camera fa-2x"></i>
				</div>
	
				<div class="cd-timeline-content">
					<h2>Plate Making</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?</p>
					<div class="clearfix">
						<?php
							if($ticketData['Ticket']['job_ticket_id'] == 1){
						?>
								<span class="label label-default label-large">Waiting</span><br><br>
							<?php

							}
							else{

								if( ($ticketData['Ticket']['status'] == 0) && ($ticketData['Ticket']['job_ticket_id'] == 2)){
						?>

							<span class="label label-default label-large">Pending</span><br><br>
							<hr></hr>
								<?php
                       				echo $this->Html->link('Accept Job', array('controller' => 'ticketing_systems', 
                       							'action' => 'updatePendingStatus', 
                       							$ticketid),array('class' =>'btn btn-info',
                       							'escape' => false));
                       			?>

                       			<?php
                       				
								
							}

							elseif ( ($ticketData['Ticket']['status'] == 1) && ($ticketData['Ticket']['job_ticket_id'] == 2)){
							?>

								<span class="label label-default label-large">Pending</span>
								<span class="label label-warning label-large">On Progress</span><br>
								<hr></hr>
								
								<?php
                       				echo $this->Html->link('Finished Job', array('controller' => 'ticketing_systems', 
                       							 'action' => 'finishedJob',
                       							  $ticketid),array('class' =>'btn btn-info',
                       							  'escape' => false));
                   			 }
                   			 else{

                   			 	?>
                   			 		<span class="label label-default label-large">Pending</span>
									<span class="label label-warning label-large">On Progress</span>
                   			 		<span class="label label-success label-large">Complete</span><br><br>

                   			<?php
                   				 }
                   			}
                   			?>	
					</div>
					<span class="cd-date">15:40</span>
				</div>
			</div>
	
			<div class="cd-timeline-block">
				<div class="cd-timeline-img cd-picture">
					<i class="glyphicon glyphicon-retweet"></i>
				</div>
	
				<div class="cd-timeline-content">
					<h2>RM Requisition</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit similique earum voluptatem doloremque dolorem ipsam quae rerum quis. Odit, itaque, deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat consequuntur perferendis enim amet quae quasi repudiandae sed quod veniam dolore possimus rem voluptatum eveniet eligendi quis fugiat aliquam sunt similique aut adipisci.</p>
					<div class="clearfix">
						<?php
							if(($ticketData['Ticket']['job_ticket_id'] == 1) || ($ticketData['Ticket']['job_ticket_id'] == 2)){
						?>
								<span class="label label-default label-large">Waiting</span><br><br>
						<?php

							}
							else{

									if( ($ticketData['Ticket']['status'] == 0) && ($ticketData['Ticket']['job_ticket_id'] == 3)){
						?>

							<span class="label label-default label-large">Pending</span><br><br>
							<hr></hr>
								<?php
                       				echo $this->Html->link('Accept Job', array('controller' => 'ticketing_systems', 
                       							'action' => 'updatePendingStatus', 
                       							$ticketid),array('class' =>'btn btn-info',
                       							'escape' => false));
                       			?>

                       			<?php
                       				
								
							}

							elseif ( ($ticketData['Ticket']['status'] == 1) && ($ticketData['Ticket']['job_ticket_id'] == 3)){
							?>

								<span class="label label-default label-large">Pending</span>
								<span class="label label-warning label-large">On Progress</span><br>
								<hr></hr>
								
								<?php
                       				echo $this->Html->link('Finished Job', array('controller' => 'ticketing_systems', 
                       							 'action' => 'finishedJob',
                       							  $ticketid),array('class' =>'btn btn-info',
                       							  'escape' => false));
                   			 }
                   			 else{

                   			 	?>
                   			 		<span class="label label-default label-large">Pending</span>
									<span class="label label-warning label-large">On Progress</span>
                   			 		<span class="label label-success label-large">Complete</span><br><br>

                   			<?php
                   				 }
                   			}
                   		?>	
					</div>
					<span class="cd-date">18:12</span>
				</div>
			</div>
	
			<div class="cd-timeline-block">
				<div class="cd-timeline-img cd-location">
					<i class="fa fa-sign-in fa-2x"></i>
				</div>
	
				<div class="cd-timeline-content">
					<h2>Production</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
					<div class="clearfix">

						<?php
							if(($ticketData['Ticket']['job_ticket_id'] == 1) || ($ticketData['Ticket']['job_ticket_id'] == 2) || ($ticketData['Ticket']['job_ticket_id'] == 3)){
						?>
								<span class="label label-default label-large">Waiting</span><br><br>
						<?php

							}
							else{

									if( ($ticketData['Ticket']['status'] == 0) && ($ticketData['Ticket']['job_ticket_id'] == 4)){
						?>

							<span class="label label-default label-large">Pending</span><br><br>
							<hr></hr>
								<?php
                       				echo $this->Html->link('Accept Job', array('controller' => 'ticketing_systems', 
                       							'action' => 'updatePendingStatus', 
                       							$ticketid),array('class' =>'btn btn-info',
                       							'escape' => false));
                       			?>

                       			<?php
                       				
								
							}

							elseif ( ($ticketData['Ticket']['status'] == 1) && ($ticketData['Ticket']['job_ticket_id'] == 4)){
							?>

								<span class="label label-default label-large">Pending</span>
								<span class="label label-warning label-large">On Progress</span><br>
								<hr></hr>
								
								<?php
                       				echo $this->Html->link('Finished Job', array('controller' => 'ticketing_systems', 
                       							 'action' => 'finishedJob',
                       							  $ticketid),array('class' =>'btn btn-info',
                       							  'escape' => false));
                   			 }
                   			 else{

                   			 	?>
                   			 		<span class="label label-default label-large">Pending</span>
									<span class="label label-warning label-large">On Progress</span>
                   			 		<span class="label label-success label-large">Complete</span><br><br>

                   			<?php
                   				 }
                   			}
                   		?>	
					</div>
					<span class="cd-date">20:48</span>
				</div>
			</div>
	
			<div class="cd-timeline-block">
				<div class="cd-timeline-img cd-location">
					<i class="fa fa-trophy fa-2x"></i>
				</div>
	
				<div class="cd-timeline-content">
					<h2>Finished Goods</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum.</p>
					<div class="clearfix">
						<?php
							if(($ticketData['Ticket']['job_ticket_id'] == 1) || ($ticketData['Ticket']['job_ticket_id'] == 2) || ($ticketData['Ticket']['job_ticket_id'] == 3) || 
								($ticketData['Ticket']['job_ticket_id'] == 4)){
						?>
								<span class="label label-default label-large">Waiting</span><br><br>
						<?php

							}
							else{

									if( ($ticketData['Ticket']['status'] == 0) && ($ticketData['Ticket']['job_ticket_id'] == 5)){
						?>

							<span class="label label-default label-large">Pending</span><br><br>
							<hr></hr>
								<?php
                       				echo $this->Html->link('Accept Job', array('controller' => 'ticketing_systems', 
                       							'action' => 'updatePendingStatus', 
                       							$ticketid),array('class' =>'btn btn-info',
                       							'escape' => false));
                       			?>

                       			<?php
                       				
								
							}

							elseif ( ($ticketData['Ticket']['status'] == 1) && ($ticketData['Ticket']['job_ticket_id'] == 5)){
							?>

								<span class="label label-default label-large">Pending</span>
								<span class="label label-warning label-large">On Progress</span><br>
								<hr></hr>
								
								<?php
                       				echo $this->Html->link('Finished Job', array('controller' => 'ticketing_systems', 
                       							 'action' => 'finishedJob',
                       							  $ticketid),array('class' =>'btn btn-info',
                       							  'escape' => false));
                   			 }
                   			 else{

                   			 	?>
                   			 		<span class="label label-default label-large">Pending</span>
									<span class="label label-warning label-large">On Progress</span>
                   			 		<span class="label label-success label-large">Complete</span><br><br>

                   			<?php
                   				 }
                   			}
                   		?>	
					</div>
					<span class="cd-date">21:22</span>
				</div>
			</div>
			 <div class="cd-timeline-block">
				<div class="cd-timeline-img cd-movie">
					<i class="fa fa-share fa-2x"></i>
				</div>
	
				<div class="cd-timeline-content">
					<h2>Shipping</h2>
					<p>This is the content of the last section</p>
					<div class="clearfix">
						<?php
							if(($ticketData['Ticket']['job_ticket_id'] == 1) || ($ticketData['Ticket']['job_ticket_id'] == 2) || ($ticketData['Ticket']['job_ticket_id'] == 3) || 
								($ticketData['Ticket']['job_ticket_id'] == 4) || ($ticketData['Ticket']['job_ticket_id'] == 5)){
						?>
								<span class="label label-default label-large">Waiting</span><br><br>
						<?php

							}
							else{

									if( ($ticketData['Ticket']['status'] == 0) && ($ticketData['Ticket']['job_ticket_id'] == 6)){
						?>

							<span class="label label-default label-large">Pending</span><br><br>
							<hr></hr>
								<?php
                       				echo $this->Html->link('Accept Job', array('controller' => 'ticketing_systems', 
                       							'action' => 'updatePendingStatus', 
                       							$ticketid),array('class' =>'btn btn-info',
                       							'escape' => false));
                       			?>

                       			<?php
                       				
								
							}

							elseif ( ($ticketData['Ticket']['status'] == 1) && ($ticketData['Ticket']['job_ticket_id'] == 6)){
							?>

								<span class="label label-default label-large">Pending</span>
								<span class="label label-warning label-large">On Progress</span><br>
								<hr></hr>
								
								<?php
                       				echo $this->Html->link('Finished Job', array('controller' => 'ticketing_systems', 
                       							 'action' => 'finishedJob',
                       							  $ticketid),array('class' =>'btn btn-info',
                       							  'escape' => false));
                   			 }
                   			 else{

                   			 	?>
                   			 		<span class="label label-default label-large">Pending</span>
									<span class="label label-warning label-large">On Progress</span>
                   			 		<span class="label label-success label-large">Complete</span><br><br>

                   			<?php
                   				 }
                   			}
                   		?>	

					</div>
					<span class="cd-date">23:59</span>
				</div>
			</div>

		</section>
	</div>
</div>
