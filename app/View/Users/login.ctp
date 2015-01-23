
<div class="row">
				<div class="col-xs-12">
					<div id="login-box">
						<div id="login-box-holder">
							<div class="row">
								<div class="col-xs-12">
									<header id="login-header">
										<div id="login-logo">
											<img src="img/logo.png" alt="Koufu Net"/>
										</div>
									</header>
									<div id="login-box-inner">

										<?php echo $this->Session->flash('auth'); ?>

										<?php echo $this->Form->create('User', array('role' => 'form')); ?>
								
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
												<?php echo $this->Form->input('email', array('class' => 'form-control','label' => false,'placeholder' => 'Email address'));?>

											</div>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-key"></i></span>
												<?php echo $this->Form->input('password', array('class' => 'form-control','label' => false,'placeholder' => 'Password'));?>
											</div>
											<div id="remember-me-wrapper">
												<div class="row">
													<div class="col-xs-6">
														<div class="checkbox-nice">
															<input type="checkbox" id="remember-me" checked="checked" />
															<label for="remember-me">
																Remember me
															</label>
														</div>
													</div>
													<a href="forgot-password-full.html" id="login-forget-link" class="col-xs-6">
														Forgot password?
													</a>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<button type="submit" class="btn btn-success col-xs-12">Login</button>
													<?php echo $this->Form->end(); ?>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<p class="social-text">Or login with</p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12 col-sm-6">
													<button type="submit" class="btn btn-primary col-xs-12 btn-facebook">
														<i class="fa fa-facebook"></i> facebook
													</button>
												</div>
												<div class="col-xs-12 col-sm-6">
													<button type="submit" class="btn btn-primary col-xs-12 btn-twitter">
														<i class="fa fa-twitter"></i> Twitter
													</button>
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
									<a href="registration-full.html">
										Register now
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>