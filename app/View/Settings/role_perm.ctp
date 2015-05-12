<?php echo $this->Html->script('role');?>
<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					                    
					<h1 class="pull-left">
						Role and permission
					</h1>

					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'dashboards', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>
			</div>
		</div>

		<?php echo $this->Form->create('Role',array('url'=>(array('controller' => 'settings','action' => 'role_perm'))));?>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-lg-2 control-label">Users</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('User.name', array(
                                                    'options' => array($userDatList),
                                                    'label' => false,
                                                    'style' => 'text-transform:capitalize',
                                                    'class' => 'form-control',
                                                    'empty' => '--Please Select User--'));
                                            ?>
										</div>

									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Role Description</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Role.name', array(
                                                    'options' => array($roleDatList),
                                                    'label' => false,
                                                    'style' => 'text-transform:capitalize',
                                                    'class' => 'form-control myRole',
                                                    'empty' => '--Please Select Role Description--'));
	                            
                                            ?>
										</div>

									</div>

									<div class="form-group permissionCheck">
										<label>Permissions</label>

										<?php foreach ($permissionDataList as $key => $permission) { ?>

											<div class="checkbox-nice">
												<input type="checkbox" id="<?php echo $permission['Permission']['name'] ?>" >
												<label for="<?php echo $permission['Permission']['name'] ?>">
													<?php echo ucfirst($permission['Permission']['name']);?>
												</label>
											</div>

										<?php } ?>

									</div>
									<br>
									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit Role</button>&nbsp;
											<?php 
						                        echo $this->Html->link('Cancel', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
						                    ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<script>
	$('.myRole').change(function(){
		var roleId = $(this).val();

		$.ajax({
			url: serverPath + "settings/permissionData/"+roleId,
			type: "get",
			dataType: "json",
			success: function(data) {
				
				$.each(data, function(key, value) {
					if (value.id == itemtypeid) {
					$option = "<option class='option-append2' selected value="+value.Product.id+">"+value.Product.name+"</option>";	
					} else {
					$option = "<option class='option-append2' value="+value.Product.id+">"+value.Product.name+"</option>";
					}
					$('#product_holder_id').append($option);
					
				});
				 $('.loading_event').remove();
			
			}
		});
	});
</script>