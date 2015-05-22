<?php echo $this->Html->script('role');?>
<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					                    
					<h1 class="pull-left">
						Roles and Permissions
					</h1>

					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'dashboards', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>
			</div>
		</div>
	
		<div class="row">
			<?php echo $this->Form->create('Role',array('url'=>(array('controller' => 'settings','action' => 'role_perm'))));?>
				<div class="col-lg-6">
					<div class="main-box">
						<div class="top-space"></div>
						<h1 class="pull-left">
							Assign role
						</h1>
						<br><br><br>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-lg-3 control-label">Users</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('User.id', array(
                                                    'options' => array($userDatList),
                                                    'label' => false,
                                                    'style' => 'text-transform:capitalize',
                                                    'class' => 'form-control',
                                                    'empty' => '--Please Select User--'));
                                            ?>
										</div>

									</div>

									<div class="form-group">
										<label class="col-lg-3 control-label">Role description</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Role.id', array(
                                                    'options' => array($roleDataListAll),
                                                    'label' => false,
                                                    'style' => 'text-transform:capitalize',
                                                    'class' => 'form-control myRole',
                                                    'empty' => '--Please Select Role Description--'));
	                            
                                            ?>
										</div>

									</div>

									<div class="form-group permissionCheck" style="display:none;">
										<label>Permissions</label>
										<section class="checkpermission">
										</section>
										<?php //foreach ($permissionDataList as $key => $permission) { ?>

											<!-- <div class="checkbox-nice">
												<input type="checkbox" id="<?php echo $permission['Permission']['name'] ?>" >
												<label for="<?php echo $permission['Permission']['name'] ?>">
													<?php //echo ucfirst($permission['Permission']['name']);?>
												</label>
											</div> -->

										<?php //} ?>

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
			<?php echo $this->Form->end(); ?>
			<div class="col-lg-6">
				<div class="main-box">
					<div class="top-space"></div>
					<h1 class="pull-left">
						Assign permissions
					</h1>
					<br><br><br>
					<div class="main-box-body clearfix">
						<div class="main-box-body clearfix">
							<div class="form-horizontal">
								<?php echo $this->Form->create('Role',array('url'=>(array('controller' => 'settings','action' => 'role_perm_edit'))));?>
									<div class="form-group">
										<label class="col-lg-3 control-label">Role Description</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Role.id', array(
	                                                'options' => array($roleDataListLimit),
	                                                'label' => false,
	                                                'style' => 'text-transform:capitalize',
	                                                'class' => 'form-control editRole',
	                                                'empty' => '--Please Select Role Description--'));
	                            
	                                        ?>
										</div>

									</div>

									<div class="form-group permissionCheck1">
										<label>Permissions</label>
										<?php foreach ($permissionDataList as $key => $permission) { 
											//$permName = "data[Permission][RolePerm]["+$permission['Permission']['id']+"]";

											?>

											<div class="checkbox-nice">
												<input type="checkbox" name="Permission[<?php echo $permission['Permission']['id']?>]" id="<?php echo $permission['Permission']['name'] ?>" data-id="<?php echo $permission['Permission']['id'] ?>" >
												<label for="<?php echo $permission['Permission']['name'] ?>">
													<?php echo ucfirst($permission['Permission']['name']);?>
												</label>
											</div>

										<?php } ?>

									</div>
									<br><br>
									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Edit Role</button>&nbsp;
											<?php 
						                        echo $this->Html->link('Cancel', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
						                    ?>
										</div>
									</div>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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

				$(".check").remove();

				if(data != ''){

					$('.permissionCheck').show();

				}else{
					$('.permissionCheck').hide();
				}

				$.each(data, function(key, value) {
					
					// $option = "<option class='option-append2' selected value="+value.Product.id+">"+value.Product.name+"</option>";	
					$option = "<div class='checkbox-nice check' >\
									<input type='checkbox' id="+value.Permission.name+" checked='checked' onclick='return false' >\
									<label for="+value.Permission.name+">\
										"+value.Permission.name+"\
									</label>\
								</div>";	
					
					$('.checkpermission').append($option);
					
				});
			
			}
		});
	});

	$('.editRole').change(function(){
		var roleId = $(this).val();

		$.ajax({
			url: serverPath + "settings/editPermission/"+roleId,
			type: "get",
			dataType: "json",
			success: function(data) {

				$('.permissionCheck1 .checkbox-nice > input').prop('checked',false);

				$array = [];
				$.each(data, function(key, value) {

					$array.push(value);

				});

				$('.permissionCheck1 .checkbox-nice > input').each(function(){

					$this = $(this);

					var number = $this.attr('data-id');

						if ($.inArray(number,$array) >= 0) {
							$this.prop('checked',true);
						}
				});
				
		
			}
		});
	});

</script>