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
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> First Name</label>
		                                        <div class="col-lg-9">
		                                        	<?php
		                                                echo $this->Form->input('Employee.id', array('class' => 'form-control col-lg-6 required','label' => false));
		                                            ?>
		                                            <?php
		                                                echo $this->Form->input('Employee.first_name', array('class' => 'form-control col-lg-6 required','label' => false));
		                                            ?>
		                                        </div>
		                                     </div>
		                                     <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Last Name</label>
		                                        <div class="col-lg-9">
		                                            <?php
		                                                echo $this->Form->input('Employee.last_name', array('class' => 'form-control col-lg-6 required','label' => false));
		                                            ?>
		                                        </div>
		                                     </div>

		                                     <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Middle Name</label>
			                                        <div class="col-lg-9">
			                                            <?php
			                                                echo $this->Form->input('Employee.middle_name', array('class' => 'form-control col-lg-6 required','label' => false));
			                                            ?>
			                                        </div>
		                                     </div>

		                                      <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label"> Suffix</label>
			                                        <div class="col-lg-9">
			                                            <?php
			                                                echo $this->Form->input('Employee.suffix', array('class' => 'form-control col-lg-6','label' => false));
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
				                                            $department = array(
				                                            	'1' => 'Accounting',
				                                            	'2' => 'Sales',
				                                            	'3' => 'Delivery'
				                                            );

				                                             echo $this->Form->input('Employee.department_id', array(
				                                             	'options' => $department, 
				                                             	'class' => 'form-control required',
				                                             	'div' => 'col-lg-7',
				                                             	'empty' => 'Select Department',
				                                             	'label' => false));
				                                            ?>
			                                          </div>

			                                          <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Position</label>
			                                            <?php
				                                            $position = array(
				                                            	'' => 'Select Position',
				                                            	'1' => 'CEO',
				                                            	'2' => 'Vice President',
				                                            	'3' => 'Employee',
				                                            	'4' => 'Others'
				                                            	);

				                                             echo $this->Form->input('Employee.position_id', array(
				                                             	'options' => $position, 
				                                             	'class' => 'form-control required',
				                                             	'div' => 'col-lg-7',
				                                             	'label' => false));
				                                            ?>
			                                          </div>

			                                          <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Status</label>
			                                           	 <div class="radio col-lg-7">
															<?php echo $this->Form->input('Employee.status', array(
			                                             	'class' => 'form-control col-lg-6 required',
			                                             	'label' => false));
			                                        	?>				
														 </div>
			                                          </div>
			                                           <div class="form-group">
			                                        	 <label class="col-lg-4 control-label">
			                                        	 <span style="color:red">*</span>Code</label>
			                                           	 <div class="radio col-lg-7">
															<?php echo $this->Form->input('Employee.code', array(
			                                             	'class' => 'form-control col-lg-6 required',
			                                             	'label' => false));
			                                        	?>				
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

		                                        	<button class="btn btn-success upload-image"> Uplad Photo</button>
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
		                                        <label for="inputEmail1" class="col-lg-2 control-label">Birthday </label>
		                                        <div class="col-lg-9">
		                                      		   <?php
			                                                echo $this->Form->input('EmployeeAdditionalInformation.id', array('class' => 'form-control col-lg-6',
			                                                	'type' => 'hidden',
			                                                	'label' => false));
			                                            ?>
		                                            <?php echo $this->Form->input('EmployeeAdditionalInformation.birthday', array('class' => 'form-control col-lg-6 datepick','label' => false));
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

	                                          <div class="form-group">
	                                        	 <label class="col-lg-2 control-label">
	                                        	 <span style="color:red">*</span>Gender</label>
	                                           	 <div class="radio col-lg-7">
																	<input type="radio" name="data[EmployeeAdditionalInformation][gender]" id="categoryRadio1" value="M" checked>
																	<label for="categoryRadio1">Male
																	</label>
																	<input type="radio" name="data[EmployeeAdditionalInformation][gender]" id="categoryRadio2" value="F">
																	<label for="categoryRadio2">Female
																	</label>
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
		                                                 	'class' => 'form-control col-lg-6',
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
		                                        <?php echo( $this->Country->select('Address.'.$address_key.'.country',null,array('class' => 'form-control required')));?> 
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
		                                        <?php echo( $this->Country->select('Address.0.country',null,array('class' => 'form-control required')));?> 
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
		                                    <?php echo 	$agencies[$data['agency']] ?> Number</label>
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
		                           		<?php $agencies = array(
												'sss' => 'SSS',
												'philhealth' => 'PhilHealth',
												'bir' => 'Tin',
												'pagibig' => 'Pag-Ibig');
									
									$count = 0; foreach ($agencies as $key => $agency) { ?>
		                    		 	<div class="form-group">
		                                    <label for="inputPassword1" class="col-lg-2 control-label"><?php echo $agency ?> Number</label>
		                                    <div class="col-lg-9">
		                                     	<?php 
		                                            echo $this->Form->input('EmployeeAgencyRecord.'.$count.'.agency', array(
		                                                'label' => false,
		                                                'type' => 'hidden',
		                                                'value' => $key,
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
		                                    <label for="inputPassword1" class="col-lg-2 control-label">Fisrt Name</label>
		                                   
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
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Address(1)</label>
                                    <div class="col-lg-2">
                                        <?php 
                                            echo $this->Form->input('ContactPersonData.Address.0.type', array(
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
                                            echo $this->Form->input('ContactPersonData.Address.0.address_1', array('class' => 'form-control item_type required',
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