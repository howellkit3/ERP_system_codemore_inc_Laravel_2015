
<div class="row">
	<div class="col-xs-12">
		<div id="login-box">
			<div id="login-box-holder">
				<div class="row">
					<div class="col-xs-12">
						<?php echo $this->Session->flash('auth'); ?>
						<header id="login-header">
							<div id="login-logo">
								<!-- <img src="img/logo.png" alt="Koufu Net"/> -->
								Koufu Net
							</div>
						</header>
						<div id="login-box-inner">

							<?php echo $this->Form->create('User', array('role' => 'form')); ?>
					
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<?php echo $this->Form->input('email', array('class' => 'form-control','label' => false,'placeholder' => 'Email address'));?>

								</div>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-key"></i></span>
									<?php echo $this->Form->input('password', array('class' => 'form-control','label' => false,'placeholder' => 'Password'));?>
								</div>
								
								<div class="row">
									<div class="col-xs-12">
										<button type="submit" class="btn btn-success col-xs-12">Login</button>
										<?php echo $this->Form->end(); ?>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<div id="login-box-footer">
				<div class="row">
					<div class="col-xs-12">
						Do not have an account? 
						<?php echo $this->Html->link(__('Register now'), array('controller' => 'users','action' => 'add')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>