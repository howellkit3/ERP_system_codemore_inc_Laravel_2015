<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2>Sheeter</h2>
				</header>
					<?php echo $this->Form->input('DepartmentProcess.department_process_id',array(
								'type' 	=> 'hidden',
								'class' => 'form-control',
								'label' =>  false,
								'value' =>  $departmentProcessId
					)); ?>
					<div class="main-box-body clearfix">
					<div class="form-group">
					<label class="" for="exampleInputEmail2"><strong> Pallet # :  </strong> </label>
						<?php echo $this->Form->input('DepartmentProcess.pallet',array('class' => 'form-control','label' => false)); ?>
					</div>
					<div class="form-group">
					<label class="" for="exampleInputPassword2"> <strong> Qty / Pallet : </strong> </label>
						
						<?php echo $this->Form->input('DepartmentProcess.qty_pallet',array('class' => 'form-control','label' => false)); ?>
					</div>
					<div class="form-group">
					<label class="" for="exampleInputPassword2"> <strong> Height : </strong> </label>
						
						<?php echo $this->Form->input('DepartmentProcess.height',array('class' => 'form-control','label' => false)); ?>
					</div>
		
		</div>
	</div>
</div>
</div>