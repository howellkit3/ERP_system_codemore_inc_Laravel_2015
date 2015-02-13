<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'customer_sales', 'action' => 'view',$contactPerson['ContactPerson']['company_id'])); ?>
<?php $this->Html->addCrumb('Person', array('controller' => 'customer_sales', 'action' => 'person',$contactPerson['ContactPerson']['id'])); ?>

<div style="clear:both"></div>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
			<div class="row" id="user-profile">
				<div class="col-lg-12 col-md-4 col-sm-4">
					<div class="main-box clearfix">
						<header class="main-box-header clearfix">
							<h1>
								<center>
									<b>
										<?php echo ucfirst($contactPerson['ContactPerson']['lastname']); ?>,
										<?php echo ucfirst($contactPerson['ContactPerson']['firstname']); ?> &nbsp;
										<?php echo ucfirst($contactPerson['ContactPerson']['middlename']); ?>
									</b>

								<?php
			                       echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'view',$contactPerson['ContactPerson']['company_id']),array('class' =>'btn btn-primary pull-left','escape' => false));
			                    ?>
			                    </center>
							</h1>
						</header>

						<div class="main-box-body clearfix">
							
							<header class="main-box-header clearfix">
								<h1>Address</h1>
							</header>

							
		                	<table class="table table-striped table-hover">
		                        <thead>
		                            <tr>
		                                <th><a href="#"><span>Address</span></a></th>
		                                <th><a href="#"><span>City</span></a></th>
		                                <th><a href="#"><span>State Province</span></a></th>
		                                <th><a href="#"><span>Zip Code</span></a></th>
		                                <th><a href="#"><span>Country</span></a></th>
		                                <th><a href="#"><span>Created</span></a></th>
		                            </tr>
		                        </thead>
		                        <?php
		                			foreach($contactAddress as $personAddress) {  ?>
				                        <tbody aria-relevant="all" aria-live="polite" role="alert">
				                         		<tr>
				                         			<td>
				                         				<?php 
				                         					if (!empty($personAddress['Address']['address2'])) {
				                         						echo "(1)&nbsp";
				                         						echo ucfirst($personAddress['Address']['address1']);
				                         						echo "<br>";
				                         						echo "(2)&nbsp";
				                         						echo ucfirst($personAddress['Address']['address2']);
				                         					}else{
				                         						echo ucfirst($personAddress['Address']['address1']);
				                         					}
				                         				?>
				                         			</td>
				                         			<td><?php echo ucfirst($personAddress['Address']['city']); ?>
				                         			</td>
				                         			<td><?php echo ucfirst($personAddress['Address']['state_province']); ?>
				                         			</td>
				                         			<td><?php echo $personAddress['Address']['zip_code']; ?>
				                         			</td>
				                         			<td><?php echo $this->Country->countryList(ucfirst($personAddress['Address']['country'])); ?>
				                         			</td>
				                         			<td><i class="fa fa-clock-o">
				                         				<?php echo date('M d, Y', strtotime($personAddress['Address']['created']));
				                         				?>
				                         			</td>
				                         		</tr>
				                         </tbody>
		                        <?php }?>
		                    </table>
									

							<header class="main-box-header clearfix">
								<h1>
									Contact
								</h1>
							</header>

							<?php
				                foreach($contactNumber as $personNumber) {  ?>
									<div class="profile-details">
										<ul class="fa-ul">
										<i class="fa fa-phone"></i>&nbsp;
											<?php echo $personNumber['Contact']['number']; ?>
										</ul>
									</div>
							<?php } ?>

							<header class="main-box-header clearfix">
								<h1>
									Email
								</h1>
							</header>

							<?php
				                foreach($contactEmail as $personEmail) {  ?>
									<div class="profile-details">
										<ul class="fa-ul">
											<i class="fa fa-external-link-square"></i>&nbsp;
											<?php echo $personEmail['Email']['email']; ?>
										</ul>
									</div>
							<?php } ?>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
	</div>
</di>