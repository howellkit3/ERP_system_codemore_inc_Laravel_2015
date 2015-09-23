 <?php $employeeData = !empty($this->request->data) ? $this->request->data : ''; ?>
 <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1>Personal Info</h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                    	<div class="col-lg-6">

                                    		<div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Contract</label>
		                                        <div class="col-lg-9">
		                                        	
		                                            <?php echo $this->Form->input('Employee.contract_id',
					                                         array('class' => 'autocomplete required',
					                                        'options' => $contractList,
					                                        'placeholder' => 'Department name',
					                                        'empty' => 'Select Contract',
					                                        'default' => !empty($employeeData['Employee']['contract_id']) ? $employeeData['Employee']['contract_id'] : '',
					                                        'div' => 'col-lg-12',
					                                        'label' => false));

					                                ?>

		                                        </div>
		                                    </div>

		                                     <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Last Name</label>
		                                        <div class="col-lg-9">
		                                            <?php
		                                               
		                                                echo $this->Form->input('Employee.id', array('class' => 'form-control col-lg-6 required name-check','label' => false));

		                                                echo $this->Form->input('Employee.last_name', array('class' => 'form-control required name-check','label' => false ,'div' => 'col-lg-12'));
		                                            ?>
		                                        </div>
		                                     </div>

                                     		<div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> First Name</label>
		                                        <div class="col-lg-9">
		                                        	
		                                            <?php

		                                                echo $this->Form->input('Employee.first_name', array('class' => 'form-control required name-check','label' => false,'div' => 'col-lg-12'));
		                                            ?>

		                                        </div>
		                                     </div>

		                                     <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"> Middle Name</label>
			                                        <div class="col-lg-9">

			                                            <?php

			                                                echo $this->Form->input('Employee.middle_name', array('class' => 'form-control name-check','label' => false,'div' => 'col-lg-12'));
			                                            ?>
			                                            
			                                        </div>
		                                     </div>

		                                      <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"> Suffix</label>
			                                        <div class="col-lg-9">
			                                            <?php
			                                                echo $this->Form->input('Employee.suffix', array('class' => 'form-control','label' => false,'div' => 'col-lg-12'));
			                                            ?>
			                                        </div>
		                                     </div>

		                                 </div>

		                                 <div class="col-lg-6">
                                     		<div class="form-group">
		                                       
		                                        <div class="col-lg-7">
			                                        <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Department</label>
			                                            	<?php
				                                            
				                                            	$department = array($departmentList);

				                                            	$department = array_merge($department,array('other' => 'Others'));
				                                            ?>
				                                            <?php 

				                                            echo $this->Form->input('Employee.department_id',
							                                         array('class' => 'autocomplete required',
							                                        'options' => $department,
							                                        'placeholder' => 'Department name',
							                                        'empty' => 'Select Department',
							                                        'default' => !empty($employeeData['Employee']['department_id']) ? $employeeData['Employee']['department_id'] : '',
							                                        'div' => 'col-lg-7',
							                                        'label' => false));

							                                ?>
			                                          </div>

			                                           <div class="form-group department-other hide">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span> Department Name</label>
			                                            	
				                                            <?php 

				                                            echo $this->Form->input('Employee.department_id_others',
							                                         array('class' => 'form-control required',
							                                        'placeholder' => 'Other Name',
							                                        'div' => 'col-lg-7',
							                                        'label' => false));

							                                ?>
			                                          </div>


			                                          <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Position</label>
			                                            	<?php
				                                            	
				                                            	$position = array($positionList);

				                                            	$position = array_merge($position,array('other' => 'Others'));

				                                            	echo $this->Form->input('Employee.position_id',
							                                         array('class' => 'autocomplete required',
							                                        'options' => $position,
							                                        'placeholder' => 'Position name',
							                                        'empty' => 'Select Position',
							                                        'default' => !empty($employeeData['Employee']['position_id']) ? $employeeData['Employee']['position_id'] : '',
							                                        'div' => 'col-lg-7',
							                                        'label' => false));

							                                ?>
			                                          </div>

			                                           <div class="form-group position-other hide">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span> Position Name</label>
			                                            	
				                                            <?php 

				                                            echo $this->Form->input('Employee.position_id_others',
							                                         array('class' => 'form-control required',
							                                        'placeholder' => 'Other Name',
							                                        'div' => 'col-lg-7',
							                                        'label' => false));

							                                ?>
			                                          </div>

			                                          <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Status</label>
			                                           	 <div class="">
															<?php 
															$status = array($statusList);

			                                             	echo $this->Form->input('Employee.status',
							                                         array('class' => 'autocomplete required',
							                                        'options' => $status,
							                                        'placeholder' => 'Status name',
							                                        'empty' => 'Select Status',
							                                        'default' => !empty($employeeData['Employee']['status']) ? $employeeData['Employee']['status'] : '',
							                                        'div' => 'col-lg-7',
							                                        'label' => false));
			                                        	?>				
														 </div>
			                                          </div>

			                                           <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Date Hired</label>
			                                           	 <div class="">
															<?php 
															
			                                             	echo $this->Form->input('Employee.date_hired',
							                                         array('type' => 'text','class' => 'form-control required datepick',
							                                        'value' => !empty($employeeData['Employee']['date_hired']) ? date('Y-m-d',strtotime($employeeData['Employee']['date_hired']))  : '', 	
							                                        'div' => 'col-lg-7',
							                                        'label' => false));
			                                        		?>


														 </div>
			                                          </div>
			                                          
			                                          <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Code</label>
			                                           	 <div class="">
															<?php 
															
			                                             	echo $this->Form->input('Employee.code',
							                                         array('class' => 'form-control required',
							                                        'div' => 'col-lg-7',
							                                        'label' => false));
			                                             	if (!empty($this->request->data['Employee']['code'])) {
			                                             		$checkMe = 'checked';
			                                             	} else {
			                                             		$checkMe = ' ';
			                                             	}
			                                        	?>


														 </div>
			                                          </div>

			                                          <div class="form-group">
				                                          <div class="col-lg-4">	
	                                                        </div> 
	                                                        <div class="col-lg-5">		
																<div class="checkbox-nice">
	                                                                    <input type="checkbox" id="checkbox-generate" onclick="getCode(this)" name="generate_code" <?php echo $checkMe ?> >
	                                                                    <label for="checkbox-generate">
	                                                                    Generate Code
	                                                                    </label>
	                                                             </div>
	                                                        </div> 
			                                          </div>



			                                          
		                                        </div>
		                                        <div class="col-lg-4">
			                                         <?php
			                                        $style = '';

			                                        if (!empty($this->request->data['Employee']['image'])) {

			                                        $serverPath = $this->Html->url('/',true);	
			                                        $background =  $serverPath.'img/uploads/employee/'.$this->request->data['Employee']['image'];	
			                                        $style = 'background:url('.$background.')';
			                                        } 

			                                        ?>
		                                        	<div class="image_profile" style="<?php echo $style; ?>">



			                                        	<?php 
			                                        		echo $this->Form->input('Employee.file', array(
			                                        		'type' => 'file',
			                                             	'class' => 'form-control btn-success',
			                                             	'onchange' => 'readURL(this,"image_profile")',
			                                             	'label' => false));
			                                        	?>


		                                        	</div>

		                                        	<button class="btn btn-success upload-image"> Upload Photo</button>
		                                     	</div>



		                                     </div>
		                                 </div>


                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1>Additional Info</h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                    	<div class="col-lg-6">
                                     		<div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label">Date of Birth </label>
		                                        <div class="col-lg-9">
	                                      		   <?php
		                                                echo $this->Form->input('EmployeeAdditionalInformation.id', array('class' => 'form-control col-lg-6',
		                                                	'type' => 'hidden',
		                                                	'label' => false));
		                                         		echo $this->Form->input('EmployeeAdditionalInformation.birthday', array('class' => 'form-control col-lg-6 datepick','label' => false,
		                                         			'data-date-viewmode' => 'years',
		                                         			'data-date-minviewmode' => 'months'

		                                         			));
		                                            ?>
		                                        </div>
		                                    </div>

		                                    <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label">Place of Birth</label>
		                                        <div class="col-lg-9">
	                                      		   	<?php
		                                                
		                                         		echo $this->Form->input('EmployeeAdditionalInformation.birth_place', array('class' => 'form-control col-lg-6','label' => false
		                                         			));
		                                            ?>
		                                        </div>
		                                    </div>

		                                    <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"> Email </label>
		                                        <div class="col-lg-9">
		                                         	<?php
		                                                echo $this->Form->input('Emails.id',array(
		                                              		'type' => 'hidden',
		                                                 	'label' => false,
		                                                 	'value' => !empty($employeeData['Email'][0]['id']) ? $employeeData['Email'][0]['id'] : ''
		                                                 ));

		                                                echo $this->Form->input('Emails.type', array(
		                                                	'type' => 'hidden',
		                                                	'label' => false,
		                                                	'value' => !empty($employeeData['Email'][0]['type']) ? $employeeData['Email'][0]['type'] : '0'
		                                                ));
		                                           
		                                                echo $this->Form->input('Emails.email', array('class' => 'form-control col-lg-6',
		                                                	'label' => false,
		                                                	'value' => !empty($employeeData['Email'][0]['email']) ? $employeeData['Email'][0]['email'] : ''
		                                                	));
		                                            ?>
		                                        </div>
		                                    </div>

		                                    <?php
		                                    	
			                                    if (!empty($this->request->data['EmployeeAdditionalInformation']['gender'])) {
			                                    	
			                                    	if ($this->request->data['EmployeeAdditionalInformation']['gender'] == 'M') {
			                                    		$maleCheck = 'checked';
			                                    	} else {
			                                    		$maleCheck = ' ';
			                                    	}

			                                    	if ($this->request->data['EmployeeAdditionalInformation']['gender'] == 'F') {
			                                    		$fmaleCheck = 'checked';
			                                    	} else {
			                                    		$fmaleCheck = ' ';
			                                    	}
			                                   	}else{
			                                   		$maleCheck = ' ';
			                                   		$fmaleCheck = ' ';
			                                   	}
		                                    	
		                                    ?>

	                                        <div class="form-group">
	                                        	<label class="col-lg-2 control-label">
	                                        	<span style="color:red">*</span>Gender</label>
	                                           	<div class="radio col-lg-7">
													<input type="radio" name="data[EmployeeAdditionalInformation][gender]" id="categoryRadio1" value="M" <?php echo $maleCheck ?> >
													<label for="categoryRadio1">Male
													</label>
													<input type="radio" name="data[EmployeeAdditionalInformation][gender]" id="categoryRadio2" value="F" <?php echo $fmaleCheck ?> >
													<label for="categoryRadio2">Female
													</label>
												</div>
	                                        </div>

	                                        <?php
		                                    	
			                                    if (!empty($this->request->data['EmployeeAdditionalInformation']['status'])) {
			                                    	
			                                    	if ($this->request->data['EmployeeAdditionalInformation']['status'] == 'S') {
			                                    		$sCheck = 'checked';
			                                    	} else {
			                                    		$sCheck = ' ';
			                                    	}

			                                    	if ($this->request->data['EmployeeAdditionalInformation']['status'] == 'M') {
			                                    		$mCheck = 'checked';
			                                    		$showMarriedSection = 'showMarriedSection';

			                                    	} else {
			                                    		$mCheck = ' ';
			                                    		$showMarriedSection = ' ';
			                                    	}
			                                   	}else{
			                                   		$sCheck = ' ';
			                                   		$mCheck = ' ';
			                                   		$showMarriedSection = ' ';
			                                   	}
		                                    	
		                                    ?>

	                                        <div class="form-group">
	                                        	<label class="col-lg-2 control-label">
	                                        	<span style="color:red">*</span>Status</label>
	                                           	<div class="radio col-lg-7">
													<input type="radio" name="data[EmployeeAdditionalInformation][status]" class="select-status" id="categoryRadio3" value="S" <?php echo $sCheck ?> >
													<label for="categoryRadio3">Single
													</label>
													<input type="radio" name="data[EmployeeAdditionalInformation][status]" class="select-status" id="married-section" value="M" <?php echo $mCheck ?> >
													<label for="married-section">Married
													</label>
												</div>
	                                        </div>

	                                        <div class="for-married-section <?php echo $showMarriedSection ?>" style="display:none;">
		                                        <div class="form-group">
			                                        <label for="inputEmail1" class="col-lg-2 control-label">Name of Spouse</label>
			                                        <div class="col-lg-7">
			                                            <?php
			                                                echo $this->Form->input('EmployeeAdditionalInformation.spouse', array('class' => 'form-control col-lg-6','label' => false));
			                                            ?>
			                                        </div>
			                                        <div class="col-lg-2">
			                                            <?php
			                                                echo $this->Form->input('EmployeeAdditionalInformation.no_children', array('class' => 'form-control col-lg-6','label' => false,'placeholder' => 'No. of Children'));
			                                            ?>
			                                        </div>
			                                    </div>
			                                </div>

		                                     <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label">Height</label>
		                                        <div class="col-lg-9">
		                                            <?php
		                                                echo $this->Form->input('EmployeeAdditionalInformation.height', array('class' => 'form-control col-lg-6','label' => false));
		                                            ?>
		                                        </div>
		                                     </div>

		                                     <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"> Weight</label>
			                                        <div class="col-lg-9">
			                                            <?php
			                                                echo $this->Form->input('EmployeeAdditionalInformation.weight', array('class' => 'form-control col-lg-6','label' => false));
			                                            ?>
			                                        </div>
		                                     </div>

		                                 </div>

		                                 <div class="col-lg-6">
                                     		
		                                     <div class="form-group">
		                                        <label  class="col-lg-2 control-label"> Blood Type </label>
		                                        <div class="col-lg-9">
		                                            <?php
		                                                echo $this->Form->input('EmployeeAdditionalInformation.blood',
		                                                 array( 
		                                                 	'options' => array('O' => 'O','A' => 'A','B' => 'B','AB' => 'AB'),
		                                                 	'class' => 'col-lg-6 autocomplete',
		                                                	'label' => false,
		                                                	'empty' => '------Select Blood-Type -----'
		                                                	));
		                                            ?>
		                                        </div>
		                                     </div>

		                                     <div class="form-group">
		                                        <label class="col-lg-2 control-label"> Languages </label>
			                                        <div class="col-lg-9">
			                                            <?php
			                                                echo $this->Form->input('EmployeeAdditionalInformation.languages', array('class' => 'form-control col-lg-6','label' => false));
			                                            ?>
			                                        </div>
		                                     </div>
		                                     <div class="form-group">
		                                        <label  class="col-lg-2 control-label"> Skills </label>
			                                        <div class="col-lg-9">
			                                            <?php
			                                                echo $this->Form->input('EmployeeAdditionalInformation.skills', array('class' => 'form-control col-lg-6',
			                                                	'type' => 'textarea',
			                                                	'label' => false));
			                                            ?>
			                                        </div>
		                                     </div>

		                                 </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

               <div class="row">
	            <div class="col-lg-12">
	                <div class="main-box">
	                    <h1>Dependents</h1>
	                    <!-- <div class="top-space"></div> -->
	                    <div class="main-box-body clearfix">
	                        <div class="main-box-body clearfix">
	                        	

                        		<?php if (!empty($this->request->data['Dependent'])) { ?>

                        			<?php foreach ($this->request->data['Dependent'] as $key => $dependentlist) { ?>
                        				<input name="data[DependentIdHolder][id][]" value="<?php echo $dependentlist['id']?>" type="hidden">
                        				<section class="cloneMe dependent_section">
		                        			<div class="form-horizontal">
			                    
				                                <div class="form-group">
				                                    <label for="inputPassword1" class="col-lg-2 control-label">Dependent</label>
				                                    <div class="col-lg-5">
				                                        <?php 
				                                            echo $this->Form->input('Dependent.'.$key.'.name',
			                                                 array( 
			                                                 	'class' => 'col-lg-6 form-control',
			                                                	'label' => false,
			                                                	'placeholder' => 'Dependent'
			                                                	));

				                                        ?>
				                                       
				                                    </div>
				                                    
				                                    <div class="col-lg-3">
				                                        <?php 
				                                            echo $this->Form->input('Dependent.'.$key.'.birth_date',
			                                                 array( 
			                                                 	'class' => 'form-control datepick',
			                                                	'label' => false,
			                                                	'placeholder' => 'Birth Date',
			                                                	'data-date-viewmode' => 'years',
		                                         				'data-date-minviewmode' => 'months'
			                                                	));

					                                            if ($key != 0 ) {
					                                            	$showRemove = 'showRemoveButton';
					                                            }else{
					                                            	$showRemove = ' ';
					                                            }

					                                        ?>
				                                         <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
				                                    </div>

				                                    <div class="col-lg-2">
				                                        <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('dependent_section',this)"><i class="fa fa-plus"></i></button>
				                                        <button type="button" class="remove-field btn btn-danger remove <?php echo $showRemove ?>" onclick="removeClone('dependent_section')" style="display:none"><i class="fa fa-minus"></i> </button>
				                                    </div>
				                                </div>

				                            </div>
				                        </section>
			                        <?php } ?>
                        		<?php } else { ?>
	                        		<section class="cloneMe dependent_section">
			                            <div class="form-horizontal">
			                    
			                                <div class="form-group">
			                                    <label for="inputPassword1" class="col-lg-2 control-label">Dependent</label>
			                                    <div class="col-lg-5">
			                                        <?php 
			                                            echo $this->Form->input('Dependent.0.name',
			                                                 array( 
			                                                 	'class' => 'col-lg-6 form-control',
			                                                	'label' => false,
			                                                	'placeholder' => 'Dependent Name'
			                                                	));

			                                        ?>
			                                       
			                                    </div>
			                                    
			                                    <div class="col-lg-3">
			                                        <?php 
				                                        echo $this->Form->input('Dependent.0.birth_date',
			                                                 array( 
			                                                 	'class' => 'form-control datepick',
			                                                	'label' => false,
			                                                	'placeholder' => 'Birth Date',
			                                                	'data-date-viewmode' => 'years',
		                                         			'data-date-minviewmode' => 'months'
			                                                	));
				                                         
				                                        ?>
			                                         <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
			                                    </div>
			                                    
			                                    <div class="col-lg-2">
			                                        <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('dependent_section',this)"><i class="fa fa-plus"></i></button>
			                                        <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('dependent_section')" style="display:none"><i class="fa fa-minus"></i> </button>
			                                    </div>
			                                </div>

			                            </div>
			                        </section>
		                        <?php } ?>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>

            <div class="row">
	            <div class="col-lg-12">
	                <div class="main-box">
	                    <h1>Educational Background</h1>
	                    <!-- <div class="top-space"></div> -->
	                    <div class="main-box-body clearfix">
	                        <div class="main-box-body clearfix">
	 
	                        		<?php if (!empty($this->request->data['EmployeeEducationalBackground'])) { ?>

	                        			<?php foreach ($this->request->data['EmployeeEducationalBackground'] as $key => $educationlist) { ?>
	                        				<input name="data[EducationIdHolder][id][]" value="<?php echo $educationlist['id']?>" type="hidden">
	                        				<section class="cloneMe educational_background">
			                        			<div class="form-horizontal">
				                    
					                                <div class="form-group">
					                                    <label for="inputPassword1" class="col-lg-2 control-label">Stage</label>
					                                    <div class="col-lg-2">
					                                        <?php 
					                                            echo $this->Form->input('EmployeeEducationalBackground.'.$key.'.stages',
				                                                 array( 
				                                                 	'options' => array('Secondary' => 'Secondary','Tertiary' => 'Tertiary'),
				                                                 	'class' => 'col-lg-6 form-control',
				                                                	'label' => false,
				                                                	'empty' => '------ Select Stage -----'
				                                                	));

					                                        ?>
					                                       
					                                    </div>
					                                    
					                                    <div class="col-lg-3">
					                                        <?php 
					                                            echo $this->Form->input('EmployeeEducationalBackground.'.$key.'.degree',
				                                                 array( 
				                                                 	'class' => 'col-lg-6 form-control',
				                                                	'label' => false,
				                                                	'placeholder' => 'Degree'
				                                                	));

					                                        ?>
					                                         <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
					                                    </div>

					                                    <div class="col-lg-2">
					                                        <?php 
					                                            echo $this->Form->input('EmployeeEducationalBackground.'.$key.'.year',
				                                                 array( 
				                                                 	'class' => 'col-lg-6 form-control',
				                                                	'label' => false,
				                                                	'placeholder' => 'Year'
				                                                	));
					                                            if ($key != 0 ) {
					                                            	$showRemove = 'showRemoveButton';
					                                            }else{
					                                            	$showRemove = ' ';
					                                            }

					                                        ?>
					                                         <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
					                                    </div>
					                                    <div class="col-lg-2">
					                                        <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('educational_background',this)"><i class="fa fa-plus"></i></button>
					                                        <button type="button" class="remove-field btn btn-danger remove <?php echo $showRemove ?>" onclick="removeClone('educational_background')" style="display:none"><i class="fa fa-minus"></i> </button>
					                                    </div>
					                                </div>

					                            </div>
					                        </section>
				                        <?php } ?>
	                        		<?php } else { ?>
		                        		<section class="cloneMe educational_background">
				                            <div class="form-horizontal">
				                    
				                                <div class="form-group">
				                                    <label for="inputPassword1" class="col-lg-2 control-label">Stage</label>
				                                    <div class="col-lg-2">
				                                        <?php 
				                                            echo $this->Form->input('EmployeeEducationalBackground.0.stages',
			                                                 array( 
			                                                 	'options' => array('Secondary' => 'Secondary','Tertiary' => 'Tertiary'),
			                                                 	'class' => 'col-lg-6 form-control',
			                                                	'label' => false,
			                                                	'empty' => '------ Select Stage -----'
			                                                	));

				                                        ?>
				                                       
				                                    </div>
				                                    
				                                    <div class="col-lg-3">
				                                        <?php 
				                                            echo $this->Form->input('EmployeeEducationalBackground.0.degree',
			                                                 array( 
			                                                 	'class' => 'col-lg-6 form-control',
			                                                	'label' => false,
			                                                	'placeholder' => 'Degree'
			                                                	));

				                                        ?>
				                                         <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
				                                    </div>

				                                    <div class="col-lg-2">
				                                        <?php 
				                                            echo $this->Form->input('EmployeeEducationalBackground.0.year',
			                                                 array( 
			                                                 	'class' => 'col-lg-6 form-control',
			                                                	'label' => false,
			                                                	'placeholder' => 'Year'
			                                                	));

				                                        ?>
				                                         <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
				                                    </div>
				                                    <div class="col-lg-2">
				                                        <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('educational_background',this)"><i class="fa fa-plus"></i></button>
				                                        <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('educational_background')" style="display:none"><i class="fa fa-minus"></i> </button>
				                                    </div>
				                                </div>

				                            </div>
				                        </section>
			                        <?php } ?>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>

		   	<section class="cloneMe addressSection">
		   		<?php if (!empty($employeeData['Address'])) : ?>
		   			<?php foreach ($employeeData['Address'] as $address_key => $adress) {
		   					$this->request->data['Address'][$address_key] = $adress;
		   			 ?>
		   			<div class="row">
		            <div class="col-lg-12">
		                <div class="main-box">
		                    <h1>Employee Address</h1>
		                    <!-- <div class="top-space"></div> -->
		                    <div class="main-box-body clearfix">
		                        <div class="main-box-body clearfix">
		                            <div class="form-horizontal">
		                            <?php 
		                            echo $this->Form->input('Address.'.$address_key.'.id', array(
		                    							'type' => 'hidden',	
		                                            ));
		                              
		                              echo $this->Form->input('Address.'.$address_key.'.model', array(
		                    							'type' => 'hidden',	
		                                                'data-name' => 'Address'
		                                            ));
		                               ?>
		                                <div class="form-group">
		                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Address(1)</label>
		                                    <div class="col-lg-2">
		                                        <?php 
		                                            echo $this->Form->input('Address.'.$address_key.'.type', array(
		                                                'options' => array('Work', 'Home', 'Business','Plant'),
		                                                'alt' => 'type',
		                                                'label' => false,
		                                                'class' => 'form-control col-lg-4 required',
		                                                'empty' => false,
		                                                'data-name' => 'Address'
		                                            ));
		                                        ?>

		                                    </div>
		                                    <div class="col-lg-7">
		                                        <?php 
		                                            echo $this->Form->input('Address.'.$address_key.'.address_1', array('class' => 'form-control item_type required',
		                                                'alt' => 'address1',
		                                                'label' => false));
		                                        ?>
		                                    </div>
		                                </div>

		                                 <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label"> City</label>
		                                    <div class="col-lg-9">
		                                        <?php 
		                                            echo $this->Form->input('Address.'.$address_key.'.city', array('class' => 'form-control ',
		                                                'alt' => 'city',
		                                                'label' => false));
		                                        ?>
		                                    </div>
		                                </div>

		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">State Province</label>
		                                    <div class="col-lg-9">
		                                        <?php 
		                                            echo $this->Form->input('Address.'.$address_key.'.state_province', array('class' => 'form-control ',
		                                                'alt' => 'state_province',
		                                                'label' => false));
		                                        ?>
		                                    </div>
		                                </div>

		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label"> Zip Code</label>
		                                    <div class="col-lg-9">
		                                        <?php 
		                                            echo $this->Form->input('Address.'.$address_key.'.zipcode', array('class' => 'form-control number',
		                                                'alt' => 'zip_code',
		                                                'label' => false,'type' => 'text'));
		                                        ?>
		                                    </div>
		                                </div>

		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">Country</label>
		                                    <div class="col-lg-9">
		                                        <?php echo( $this->Country->select('Address.'.$address_key.'.country',null,array('class' => 'required autocomplete')));?> 
		                                    </div>
		                                </div>
		                                <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
		                            

		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
		                                    <div class="col-lg-10">
		                                      <!--   <button type="button" data-model='Address' class="add-field table-link danger btn btn-success" onclick="cloneData('addressSection',this)"> <i class="fa fa-plus"></i></button>
		                                        <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('addressSection')" style="display:none"><i class="fa fa-minus"></i> </button> -->
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		   			<?php } ?>
		   			
		        </div>
		   		<?php else : ?>
		   		<div class="row">
		            <div class="col-lg-12">
		                <div class="main-box">
		                    <h1>Employee Address</h1>
		                    <!-- <div class="top-space"></div> -->
		                    <div class="main-box-body clearfix">
		                        <div class="main-box-body clearfix">
		                            <div class="form-horizontal">
		                    		<?php echo $this->Form->input('Address.0.model', array(
		                    							'type' => 'hidden',	
		                    							'value' => 'Employee',
		                                                'data-name' => 'Address'
		                                            ));
		                               ?>
		                                <div class="form-group">
		                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Address(1)</label>
		                                    <div class="col-lg-2">
		                                        <?php 
		                                            echo $this->Form->input('Address.0.type', array(
		                                                'options' => array('Work', 'Home', 'Business','Plant'),
		                                                'alt' => 'type',
		                                                'label' => false,
		                                                'class' => 'form-control col-lg-4 required',
		                                                'empty' => false,
		                                                'data-name' => 'Address'
		                                            ));
		                                        ?>

		                                    </div>
		                                    <div class="col-lg-7">
		                                        <?php 
		                                            echo $this->Form->input('Address.0.address_1', array('class' => 'form-control item_type required',
		                                                'alt' => 'address1',
		                                                'label' => false));
		                                        ?>
		                                    </div>
		                                </div>

		                                 <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label"> City</label>
		                                    <div class="col-lg-9">
		                                        <?php 
		                                            echo $this->Form->input('Address.0.city', array('class' => 'form-control ',
		                                                'alt' => 'city',
		                                                'label' => false));
		                                        ?>
		                                    </div>
		                                </div>

		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">State Province</label>
		                                    <div class="col-lg-9">
		                                        <?php 
		                                            echo $this->Form->input('Address.0.state_province', array('class' => 'form-control ',
		                                                'alt' => 'state_province',
		                                                'label' => false));
		                                        ?>
		                                    </div>
		                                </div>

		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label"> Zip Code</label>
		                                    <div class="col-lg-9">
		                                        <?php 
		                                            echo $this->Form->input('Address.0.zipcode', array('class' => 'form-control number',
		                                                'alt' => 'zip_code',
		                                                'label' => false,'type' => 'text'));
		                                        ?>
		                                    </div>
		                                </div>

		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">Country</label>
		                                    <div class="col-lg-9">
		                                        <?php echo( $this->Country->select('Address.0.country',null,array('class' => 'required autocomplete')));?> 
		                                    </div>
		                                </div>
		                                <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
		                            

		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
		                                    <div class="col-lg-10">
		                                        <button type="button" data-model='Address' class="add-field table-link danger btn btn-success" onclick="cloneData('addressSection',this)"> <i class="fa fa-plus"></i></button>
		                                        <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('addressSection')" style="display:none"><i class="fa fa-minus"></i> </button>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		   		<?php endif; ?>	
		       
		    </section>


		    <section class="cloneMe1 contact_section">
		    <?php if (!empty($employeeData['Contact'])) : ?>
		    	<?php foreach ($employeeData['Contact'] as $contact_key => $value) { 

		    		$this->request->data['Contact'][$contact_key] = $value;
		    	?>
		    		
					<div class="row">
		            <div class="col-lg-12">
		                <div class="main-box">
		                    <h1>Employee Number</h1>
		                    <!-- <div class="top-space"></div> -->
		                    <div class="main-box-body clearfix">
		                        <div class="main-box-body clearfix">
		                            <div class="form-horizontal">
		                    
		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">Contact Number</label>
		                                    <div class="col-lg-2">

		                                      <?php 
		                                            echo $this->Form->input('Contact.'.$contact_key.'.id');
 
		                                            echo $this->Form->input('Contact.'.$contact_key.'.type', array(
		                                                'options' => array('Tel', 'Fax', 'Mobile'),
		                                                'label' => false,
		                                                'alt' => 'type',
		                                                'class' => 'form-control',
		                                                'empty' => false
		                                            ));

		                                        ?>
		                                       
		                                    </div>
		                                    
		                                    <div class="col-lg-6">
		                                        <?php 
		                                            echo $this->Form->input('Contact.'.$contact_key.'.number', array('class' => 'form-control',
		                                                'alt' => 'number',
		                                                'label' => false,
		                                                ));

		                                        ?>
		                                         <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
		                                    </div>
		                                    <div class="col-lg-2">
		                                        <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('contact_section',this)"><i class="fa fa-plus"></i></button>
		                                        <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('contact_section')" style="display:none"><i class="fa fa-minus"></i> </button>
		                                    </div>
		                                </div>

		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>

		    	<?php } ?>
		    <?php else : ?>
		    	<div class="row">
		            <div class="col-lg-12">
		                <div class="main-box">
		                    <h1>Employee Number</h1>
		                    <!-- <div class="top-space"></div> -->
		                    <div class="main-box-body clearfix">
		                        <div class="main-box-body clearfix">
		                            <div class="form-horizontal">
		                    
		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">Contact Number</label>
		                                    <div class="col-lg-2">
		                                        <?php 
		                                            echo $this->Form->input('Contact.0.type', array(
		                                                'options' => array('Tel', 'Fax', 'Mobile'),
		                                                'label' => false,
		                                                'alt' => 'type',
		                                                'class' => 'form-control',
		                                                'empty' => false
		                                            ));

		                                        ?>
		                                       
		                                    </div>
		                                    
		                                    <div class="col-lg-6">
		                                        <?php 
		                                            echo $this->Form->input('Contact.0.number', array('class' => 'form-control',
		                                                'alt' => 'number',
		                                                'label' => false,
		                                                ));

		                                        ?>
		                                         <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
		                                    </div>
		                                    <div class="col-lg-2">
		                                        <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('contact_section',this)"><i class="fa fa-plus"></i></button>
		                                        <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('contact_section')" style="display:none"><i class="fa fa-minus"></i> </button>
		                                    </div>
		                                </div>

		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		   	<?php endif;  ?> 	
		       
		    </section>

		    <section class="cloneMe1 agency_section">
		        <div class="row">
		            <div class="col-lg-12">
		                <div class="main-box">
		                    <h1>Government Records</h1>
		                    <!-- <div class="top-space"></div> -->
		                    <div class="main-box-body clearfix">
		                        <div class="main-box-body clearfix">
		                            <div class="form-horizontal">
		                           <?php if (!empty($employeeData['GovernmentRecord'])) :
		                           	
		                           	$agencies = array(
												'sss' => 'SSS',
												'philhealth' => 'PhilHealth',
												'bir' => 'Tin',
												'pagibig' => 'Pag-Ibig');

		                            foreach($employeeData['GovernmentRecord'] as $gov_key => $data) {

		                           	$this->request->data['EmployeeAgencyRecord'][$gov_key] = $data;

		                           	?>

		                           		<div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">
		                                    <?php echo 	$nameList[$data['agency_id']]['name'] ?> <?php echo  $nameList[$data['agency_id']]['field'] ?></label>
		                                    <div class="col-lg-9">
		                                     	<?php 
		                                     		 echo $this->Form->input('EmployeeAgencyRecord.'.$gov_key.'.id', array(
		                                               'type' => 'hidden',
		                                            ));
		                                            echo $this->Form->input('EmployeeAgencyRecord.'.$gov_key.'.agency', array(
		                                                'label' => false,
		                                                'type' => 'hidden',
		                                                'class' => 'form-control',
		                                                'empty' => false
		                                            ));

		                                            echo $this->Form->input('EmployeeAgencyRecord.'.$gov_key.'.value', array(
		                                                'label' => false,
		                                                'alt' => 'type',
		                                                'class' => 'form-control gov-number',
		                                                'empty' => false
		                                            ));

		                                        ?>
		                                       
		                                    </div>
		                                    
		                                </div>

		                           	<?php } ?>	
		                           
		                           <?php else : ?>
		                           		<?php 
		          //                  		$agencies = array(
												// 'sss' => 'SSS',
												// 'philhealth' => 'PhilHealth',
												// 'bir' => 'Tin',
												// 'pagibig' => 'Pag-Ibig');
									
									$count = 0; foreach ($agencyList as $key => $agency) { ?>
		                    		 	<div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label"><?php echo ucfirst($agency['Agency']['name']) ?> <?php echo ucfirst($agency['Agency']['field']) ?></label>
		                                    <div class="col-lg-9">
		                                     	<?php 
		                                            echo $this->Form->input('EmployeeAgencyRecord.'.$count.'.agency_id', array(
		                                                'label' => false,
		                                                'type' => 'hidden',
		                                                'value' => $agency['Agency']['id'],
		                                                'class' => 'form-control',
		                                                'empty' => false
		                                            ));

		                                            echo $this->Form->input('EmployeeAgencyRecord.'.$count.'.value', array(
		                                                'label' => false,
		                                                'alt' => 'type',
		                                                'class' => 'form-control gov-number',
		                                                'empty' => false
		                                            ));

		                                        ?>
		                                       
		                                    </div>
		                                    
		                                </div>
		                    			<?php $count++; } ?>
		                              


		                           <?php endif; ?> 	

								

		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </section>

	        <div class="row">
	            <div class="col-lg-12">
	                <div class="main-box">
	                    <h1>Bank Details</h1>
	                    <!-- <div class="top-space"></div> -->
	                    <div class="main-box-body clearfix">
	                        <div class="main-box-body clearfix">
	                        	
	                            <div class="form-horizontal">
	                    
	                                <div class="form-group">
	                                    <label for="inputPassword1" class="col-lg-2 control-label">Bank</label>
	                                    <div class="col-lg-9">
	                                        <?php 
	                                            echo $this->Form->input('EmployeeAdditionalInformation.bank_id',
	                                                 array( 
	                                                 	'options' => array($bankList),
	                                                 	'class' => 'col-lg-6 form-control',
	                                                	'label' => false,
	                                                	'empty' => '--- Select Bank ---'
	                                                	));

	                                        ?>
	                                       
	                                    </div>
	                                    
	                                </div>

	                                <div class="form-group">
	                                    <label for="inputPassword1" class="col-lg-2 control-label">Bank Account Type</label>
	                                    <div class="col-lg-9">
	                                        <?php 
	                                            echo $this->Form->input('EmployeeAdditionalInformation.bank_account_type',
	                                                 array( 
	                                                 	'options' => array('Savings' => 'Savings','Current' => 'Current'),
	                                                 	'class' => 'col-lg-6 form-control',
	                                                	'label' => false,
	                                                	'empty' => '--- Bank Account Type ---'
	                                                	));

	                                        ?>
	                                       
	                                    </div>
	                                    
	                                </div>

	                                <div class="form-group">
	                                    <label for="inputPassword1" class="col-lg-2 control-label">Bank Account #</label>
	                                    <div class="col-lg-9">
	                                        <?php 
	                                            echo $this->Form->input('EmployeeAdditionalInformation.bank_account_number',
	                                                 array( 
	                                                 	'class' => 'col-lg-6 form-control',
	                                                	'label' => false,
	                                                	'placeholder' => 'Bank Account #'
	                                                	));

	                                        ?>
	                                       
	                                    </div>
	                                    
	                                </div>

	                            </div>
		                        
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>

		   	<h1>In case of emergency</h1>
		    <section class="cloneMe1 contactPersonEmail_section">
		        <div class="row">
		            <div class="col-lg-12">
		                <div class="main-box">
		                    <h1>Contact Person</h1>
		                    <!-- <div class="top-space"></div> -->
		                    <div class="main-box-body clearfix">
		                        <div class="main-box-body clearfix">
		                            <div class="form-horizontal">

		                            	<?php 
			                            	if (!empty($employeeData['ContactPerson']))  {
			                            		$this->request->data['ContactPersonData'][0] = $employeeData['ContactPerson'];
			                            	}
			                            	if (!empty($employeeData['ContactPersonNumber']))  {
			                            		$this->request->data['ContactPersonData']['Contact'][0] = $employeeData['ContactPersonNumber'];
			                            	}
			                            	if (!empty($employeeData['ContactPersonAddress']))  {
			                            		$this->request->data['ContactPersonData']['Address'][0] = $employeeData['ContactPersonAddress'];
			                            	}
			                            	if (!empty($employeeData['ContactPersonEmail']))  {
			                            		$this->request->data['ContactPersonData']['Email'][0] = $employeeData['ContactPersonEmail'];
			                            		
			                            	}
		                            	?>

		                            	<div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">First Name</label>
		                                   
		                                    <div class="col-lg-9">
		                                   	 	<?php 
		                                            echo $this->Form->input('ContactPersonData.0.id', array('class' => 'form-control','type' => 'hidden','label' => false));
		                                      
		                                            echo $this->Form->input('ContactPersonData.0.firstname', array('class' => 'form-control','label' => false));
		                                        ?>
											</div>
		                                </div>
		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">Middle Name</label>
		                                   
		                                    <div class="col-lg-9">
		                                        <?php 
		                                            echo $this->Form->input('ContactPersonData.0.middlename', array('class' => 'form-control','label' => false));
		                                        ?>

		                                        
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">Last Name</label>
		                                   
		                                    <div class="col-lg-9">
		                                        <?php 
		                                            echo $this->Form->input('ContactPersonData.0.lastname', array('class' => 'form-control','label' => false));
		                                        ?>

		                                        
		                                    </div>
		                                </div>

		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">Email</label>
		                                  
		                                    <div class="col-lg-9">
		                                        <?php 
		                                            echo $this->Form->input('ContactPersonData.Email.0.email', array('class' => 'form-control email','label' => false));
		                                        ?>
		                                        <span class="lighter-color2">Ex. example@email.com</span>
		                                    </div>
		                                </div>

		                                <div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label">Contact Number</label>
		                                    <div class="col-lg-2">
		                                        <?php 
		                                            echo $this->Form->input('ContactPersonData.Contact.0.type', array(
		                                                'options' => array('Tel', 'Fax', 'Mobile'),
		                                                'label' => false,
		                                                'alt' => 'type',
		                                                'class' => 'form-control',
		                                                'empty' => false
		                                            ));

		                                        ?>
		                                       
		                                    </div>
		                                    
		                                    <div class="col-lg-6">
		                                        <?php 
		                                            echo $this->Form->input('ContactPersonData.Contact.0.number', array('class' => 'form-control',
		                                                'alt' => 'number',
		                                                'label' => false,
		                                                ));

		                                        ?>
		                                         <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
		                                    </div>
		                                </div>

		                                
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </section>

		    <!-- address -->

		         <section class="cloneMe addressSection">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box">
                    <h1>Contact Person Address</h1>
                    <!-- <div class="top-space"></div> -->
                    <div class="main-box-body clearfix">
                        <div class="main-box-body clearfix">
                            <div class="form-horizontal">
                    		<?php echo $this->Form->input('ContactPersonData.Address.0.model', array(
                    									'type' => 'hidden',
		                    							'value' => 'Employee',
		                                                'data-name' => 'Address'
		                                            ));
		                               ?>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Address(1)</label>
                                    <div class="col-lg-2">
                                        <?php 
                                            echo $this->Form->input('ContactPersonData.Address.0.type', array(
                                                'options' => array('Work', 'Home', 'Business','Plant'),
                                                'alt' => 'type',
                                                'label' => false,
                                                'class' => 'form-control col-lg-4',
                                                'empty' => false,
                                                'data-name' => 'Address'
                                            ));
                                        ?>

                                    </div>
                                    <div class="col-lg-7">
                                        <?php 
                                            echo $this->Form->input('ContactPersonData.Address.0.address_1', array('class' => 'form-control item_type',
                                                'alt' => 'address1',
                                                'label' => false));
                                        ?>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label"> City</label>
                                    <div class="col-lg-9">
                                        <?php 
                                            echo $this->Form->input('ContactPersonData.Address.0.city', array('class' => 'form-control ',
                                                'alt' => 'city',
                                                'label' => false));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label">State Province</label>
                                    <div class="col-lg-9">
                                        <?php 
                                            echo $this->Form->input('ContactPersonData.Address.0.state_province', array('class' => 'form-control ',
                                                'alt' => 'state_province',
                                                'label' => false));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label"> Zip Code</label>
                                    <div class="col-lg-9">
                                        <?php 
                                            echo $this->Form->input('ContactPersonData.Address.0.zipcode', array('class' => 'form-control number',
                                                'alt' => 'zip_code',
                                                'label' => false,'type' => 'text'));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label">Country</label>
                                    <div class="col-lg-9">
                                        <?php echo( $this->Country->select('ContactPersonData.Address.0.country',null,array('class' => 'form-control required')));?> 
                                    </div>
                                </div>
                                <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                            

                                <!-- <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <button type="button" data-model='Address' class="add-field table-link danger btn btn-success" onclick="cloneData('addressSection',this)"> <i class="fa fa-plus"></i></button>
                                        <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('addressSection')" style="display:none"><i class="fa fa-minus"></i> </button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <style type="text/css">
        .department_id{
           /* width: 200px !important;
            margin-bottom: 15px !important;*/
        }
    </style>
    <script type="text/javascript">
    	$('.showRemoveButton').show();
    	$('.showMarriedSection').show();

    </script>