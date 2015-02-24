<?php $this->Html->addCrumb('Supplier', array('controller' => 'suppliers', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Edit', array('controller' => 'suppliers', 'action' => 'edit')); ?>
<?php echo $this->Html->script('Purchasings.add_supplier'); ?>
<?php echo $this->Html->css('purchasings/custom'); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            <header class="main-box-header clearfix">
                <center>
                    <h1>
                        <u>
                            Supplier Information
                        </u>
                        <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'suppliers', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </h1>
                </center><hr>
                
            </header>

             <div class="main-box-body clearfix">
                  <?php 
                  echo $this->Form->create('Supplier',array('url'=>(array('controller' => 'suppliers','action' => 'edit')),'class' => 'form-horizontal'));

                  echo $this->Form->input('Supplier.id');

                  ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">

                            <header class="main-box-header clearfix">
                                <h1>Supplier</h1>
                            </header>
                            
                            <div class="main-box-body clearfix">
                                
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Name</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Supplier.name', array(
                                                'class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Supplier.description', array('class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label">Website</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Supplier.website', array('class' => 'form-control col-lg-6','label' => false));
                                        ?>
                                    </div>
                                </div>

                                </div>
                            </div> 

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box">

                                <section class="cloneMe addressSection">
                                    <header class="main-box-header clearfix">
                                        <h1>Company Address</h1>
                                    </header>

                                    <?php foreach ($this->request->data['Address'] as $key => $value) {

                                        $this->request->data['Address'][$key] = $value;
                                    
                                        ?>
                                     <div class="main-box-body clearfix">

                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-2 control-label">Address(1)</label>
                                            <div class="col-lg-2">
                                             <?php 
                                                    echo $this->Form->input('Address.'.$key.'.id');
                                                ?>
                                                <?php 
                                                    echo $this->Form->input('Address.'.$key.'.type', array(
                                                        'options' => array('Work', 'Home', 'Business'),
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
                                                    echo $this->Form->input('Address.'.$key.'.address1', array('class' => 'form-control item_type required',
                                                        'alt' => 'address1',
                                                        'label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Address(2)</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('Address.'.$key.'.address2', array('class' => 'form-control item_type',
                                                        'alt' => 'address2',
                                                        'label' => false));
                                                ?>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">City</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('Address.'.$key.'.city', array('class' => 'form-control required',
                                                        'alt' => 'city',
                                                        'label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">State Province</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('Address.'.$key.'.state_province', array('class' => 'form-control required',
                                                        'alt' => 'state_province',
                                                        'label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Zip Code</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('Address.'.$key.'.zip_code', array('class' => 'form-control required number',
                                                        'alt' => 'zip_code',
                                                        'label' => false,'type' => 'text'));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Country</label>
                                            <div class="col-lg-9">
                                                <?php echo( $this->Country->select('Address.'.$key.'.country',null,array('class' => 'form-control required')));?> 
                                            </div>
                                        </div>
                                        <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                    

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                            <div class="col-lg-10">
                                                <button type="button" data-model='Address' class="add-field table-link danger btn btn-success" onclick="cloneData('addressSection',this)"> <i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger" onclick="removeClone('addressSection')"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </section>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">

                            <header class="main-box-header clearfix">
                                <h1>Company Email</h1>
                            </header>
                            
                            <div class="main-box-body clearfix">
                             <?php foreach ($this->request->data['Email'] as $key => $value) {

                                        $this->request->data['Email'][$key] = $value;

                                         echo $this->Form->input('Email.'.$key.'.id');
                                    
                              ?>
                                <section class="cloneMe1 email_section" data-model ="Contact">
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Email Address</label>
                                        <div class="col-lg-2">
                                            <?php 
                                                echo $this->Form->input('Email.'.$key.'.type', array(
                                                    'options' => array('Work', 'Home', 'Business'),
                                                    'label' => false,
                                                    'class' => 'form-control required',
                                                    'empty' => false
                                                ));

                                            ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <?php 
                                                echo $this->Form->input('Email.0.email', array('class' => 'form-control required email','label' => false));
                                            ?>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('email_section',this)"><i class="fa fa-plus"></i></button>
                                             <button type="button" class="remove-field btn btn-danger" onclick="removeClone('email_section')"><i class="fa fa-minus"></i> </button>
                                        </div>
                                    </div>
                                    <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                </section>
                                <?php } ?>
                            </div> 
                        </div>
                    </div>  
                </div>   

                        <div class="row">  
                        <div class="col-lg-12">
                            <div class="main-box">

                                <header class="main-box-header clearfix">
                                    <h1>Business Registration</h1>
                                </header>
                                
                                <div class="main-box-body clearfix">
                                   <div class="business_registation">
                                                <table class="table table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th><a href="#"><span>Permit</span></a></th>
                                                    <th><a href="#"><span>Permit No</span></a></th>
                                                    <th><a href="#"><span>Date Issued</span></a></th>
                                                    <th><a href="#"><span>Expiration Date</span></a></th>
                                                </tr>
                                                </thead>
                                                <tbody aria-relevant="all" aria-live="polite" role="alert" >

                                               <?php foreach ($this->request->data['Permit'] as $key => $value) {

                                                     $this->request->data['Permit'][$key] = $value;

                                                      echo $this->Form->input('Permit.'.$key.'.id');
                                        
                                                ?>
                                                        <tr class="permitInput">
                                                            <td>
                                                                <?php echo $this->Form->input('Permit.'.$key.'.name',array(
                                                                    'label' => false,
                                                                    'class' => 'input required'
                                                                )); ?>
                                                            </td>
                                                            <td><?php echo $this->Form->input('Permit.'.$key.'.permit_number',array(
                                                                    'label' => false,
                                                                    'class' => 'required'
                                                                )); ?></td>
                                                            <td>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>    
                                                            <?php echo $this->Form->input('Permit.'.$key.'.date_issued',array(
                                                                    'label' => false,
                                                                    'class' => 'datepick required',
                                                                    'type' => 'text'
                                                                )); ?></td>
                                                           <td>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                           <?php echo $this->Form->input('Permit.'.$key.'.date_expired',array(
                                                                    'label' => false,
                                                                    'class' => 'datepick required',
                                                                    'type' => 'text'
                                                                )); ?></td>
                                                        </tr>
                                                        <tr class="add-button">
                                                            <td colspan="4">
                                                                <div class="form-group">
                                                                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                                                    <div class="col-lg-12">
                                                                        <button type="button" data-model='Product' class="add-field table-link danger btn btn-success" onclick="cloneInputTable('permitInput',this)"> <i class="fa fa-plus"></i></button>
                                                                        <button type="button" class="remove-field btn btn-danger" onclick="removeCloneInputTable('permitInput')"><i class="fa fa-minus"></i> </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                              <?php } ?>
                                                </tbody>
                                            </table>
                                         </div>
                                    </div> 
                             </div>
                        </div>
                    </div> 

                    <div class="row">  
                        <div class="col-lg-12">
                            <div class="main-box">

                                    <header class="main-box-header clearfix">
                                        <h1>Business Organization</h1>
                                    </header>
                                    
                                    <div class="main-box-body clearfix">
                                        
                                        <div class="form-group">
                                            <label for="OrganizationTypes" class="col-lg-2 control-label">Business Organization Type</label>
                                            <div class="col-lg-9">
                                            <?php echo $this->Form->input('Organization.id');
                                                ?>
                                                <?php echo $this->Form->input('Organization.type', array(
                                                        'class' => 'form-control col-lg-6 required org select_type',
                                                        'label' => false,
                                                        'data-change' => 'business-organization-others',
                                                        'options' => array(
                                                            'Single Proprietorship' => 'Single Proprietorship',
                                                            'Partnership' => 'Partnership',
                                                            'Cooperative' => 'Cooperative',
                                                            'Corporation' => 'Corporation',
                                                            'Others' => 'Others'
                                                            ),

                                                         'format' => array('before', 'input', 'between', 'label', 'after', 'error'), 
                                                        ));
                                                ?>
                                                
                                            </div>
                                        </div>
                                    <div class="form-group business-organization-others">
                                        <label for="OrganizationTypes" class="col-lg-2 control-label"> </label>
                                                <div class="col-lg-9">
                                                <?php echo $this->Form->input('Organization.type_other', array(
                                                'class' => 'form-control col-lg-6 ',
                                                'id' => 'OrgTypeOthers',
                                                'label' => false
                                                ));
                                                ?>
                                        </div>
                                    </div> 

                                        <div class="form-group">
                                            <label for="OperationsType" class="col-lg-2 control-label">Business Operation Type</label>
                                            <div class="col-lg-9">
                                                 <?php echo $this->Form->input('Organization.operation_type', array(
                                                        'class' => 'form-control col-lg-6 required select_type',
                                                        'label' => false,
                                                        'data-change' => 'business-type-others',
                                                        'options' => array(
                                                            'Manufacturing' => 'Manufacturing',
                                                            'Merchandising' => 'Merchandising',
                                                            'Distributor' => 'Distributor',
                                                            'Service Company' => 'Service Company',
                                                            'Others' => 'Others'
                                                            )
                                                        ));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group business-type-others">
                                               <label for="OperationsTypeOthers" class="col-lg-2 control-label">    </label>
                                                <div class="col-lg-9">
                                                        <?php echo $this->Form->input('Organization.operation_type_other', array(
                                                                'class' => 'form-control col-lg-6',
                                                                'label' => false
                                                                ));
                                                        ?>
                                                </div>
                                        </div>
                                </div> 
                            </div>
                        </div>
                    </div>

                     <div class="row">
                         <div class="col-lg-12">
                            <div class="main-box">

                                    <header class="main-box-header clearfix">
                                        <h1>Products</h1>
                                    </header>
                                    <?php foreach ($this->request->data['Product'] as $key => $value) {

                                        $this->request->data['Product'][$key] = $value;

                                         echo $this->Form->input('Product.'.$key.'.id');
                                    
                                    ?>
                                     <section class="cloneMe productSection">
                                         <div class="form-group">
                                            <label for="OrganizationTypes" class="col-lg-2 control-label">Product</label>
                                            <div class="col-lg-9">
                                                <?php echo $this->Form->input('Product.'.$key.'.name', array(
                                                        'class' => 'form-control col-lg-6 required org',
                                                        'label' => false,
                                                        'data-change' => 'business-organization-others',
                                                        ));
                                                ?>
                                                
                                            </div>
                                        </div>
                                  
                                      <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                        <div class="col-lg-10">
                                            <button type="button" data-model='Product' class="add-field table-link danger btn btn-success" onclick="cloneData('productSection',this)"> <i class="fa fa-plus"></i></button>
                                            <button type="button" class="remove-field btn btn-danger" onclick="removeClone('productSection')"><i class="fa fa-minus"></i> </button>
                                        </div>
                                      </div>
                                    </section>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                     <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">

                            <section class="cloneMe1 contactPerson_section"> 
                                <header class="main-box-header clearfix">
                                    <h1>Contact person</h1>
                                </header>
                                <?php
                                    foreach ($this->request->data['ContactPerson'] as $key => $value) {

                                    $this->request->data['ContactPersonData'][$key]['ContactPerson'][$key] = $value;

                                    echo $this->Form->input('ContactPersonData.'.$key.'.ContactPerson.'.$key.'.id');

                                 ?>
                                <div class="main-box-body clearfix">

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Firstname</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPersonData.'.$key.'.ContactPerson.'.$key.'.firstname', array('class' => 'form-control required','label' => false));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Middlename</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPersonData.'.$key.'.ContactPerson.'.$key.'.middlename', array('class' => 'form-control','label' => false));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Lastname</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPersonData.'.$key.'.ContactPerson.'.$key.'.lastname', array('class' => 'form-control required','label' => false));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Position</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPersonData.'.$key.'.ContactPerson.'.$key.'.position', array('class' => 'form-control required','label' => false));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php  } ?> 

                                <hr>
               
                                <header class="main-box-header clearfix">
                                    <h1>Contact Person Number</h1>
                                </header>
                            
                                <div class="main-box-body clearfix">
                                <?php foreach ($this->request->data['Contact'] as $key => $value) {

                                    $this->request->data['ContactPersonData'][$key]['Contact'][$key] = $value;

                                    echo $this->Form->input('ContactPersonData.'.$key.'.Contact.'.$key.'.id');

                                 ?>
                                    <section class="cloneMe1 contactPersonNumber_section" id="Bien">
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Contact Number</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.'.$key.'.Contact.'.$key.'.type', array(
                                                        'options' => array('Work', 'Home', 'Business'),
                                                        'label' => false,
                                                        'class' => 'form-control required',
                                                        'empty' => false
                                                    ));

                                                ?>
                                            </div>
                                            <div class="col-lg-6">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.'.$key.'.Contact.'.$key.'.number', array('class' => 'form-control required','label' => false));
                                                ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('contactPersonNumber_section', this)"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contactPersonNumber_section')"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>
                                        <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                    </section>

                                   <?php } ?>
                                   
                                </div> 
                     
                                <hr>

                                <header class="main-box-header clearfix">
                                    <h1>Contact Person Email</h1>
                                </header>
                            
                                <div class="main-box-body clearfix">
                                    <section class="cloneMe1 contactPersonEmail_section">
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Email</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.Email.0.type', array(
                                                        'options' => array('Work', 'Home', 'Business'),
                                                        'label' => false,
                                                        'class' => 'form-control required',
                                                        'empty' => false
                                                    ));

                                                ?>
                                            </div>
                                            <div class="col-lg-6">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.Email.0.email', array('class' => 'form-control required email','label' => false));
                                                ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('contactPersonEmail_section',this)"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contactPersonEmail_section')"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>
                                        <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                    </section>
                                </div>

                                <hr>
                                <section class="cloneMe1 contactPersonAddress_section">
                                    <header class="main-box-header clearfix">
                                        <h1>Contact Person Address</h1>
                                    </header>
                            
                                    <div class="main-box-body clearfix">
                                        <?php foreach ($this->request->data['ContactPersonInfo']['Address'] as $key => $value) { 

                                            $this->request->data['ContactPersonData'][$key]['Address'][$key] = $value;
                                            
                                            echo $this->Form->input('ContactPersonData.'.$key.'.Address.'.$key.'.id');

                                                 
                                         ?>

                                            <div class="form-group">
                                                
                                            <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Address(1)</label>
                                                <div class="col-lg-2">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.'.$key.'.Address.'.$key.'.type', array(
                                                            'options' => array('Office', 'Plant 1', 'Plant 2'),
                                                            'label' => false,
                                                            'class' => 'form-control required',
                                                            // 'id'    => 'addressID',
                                                            'empty' => false
                                                        ));

                                                    ?>
                                                </div>
                                                <div class="col-lg-7">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.'.$key.'.Address.'.$key.'.address1', array('class' => 'form-control item_type required','label' => false));
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label">Address(2)</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.'.$key.'.Address.'.$key.'.address2', array('class' => 'form-control item_type','label' => false));
                                                    ?>
                                                </div>
                                            </div>

                                             <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> City</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.'.$key.'.Address.'.$key.'.city', array('class' => 'form-control required','label' => false));
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> State Province</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.'.$key.'.Address.'.$key.'.state_province', array('class' => 'form-control required','label' => false));
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Zip Code</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.'.$key.'.Address.'.$key.'.zip_code', array('class' => 'form-control required number','label' => false,'type' => 'text'));
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Country</label>
                                                <div class="col-lg-9">
                                                    <?php echo( $this->Country->select('ContactPersonData.'.$key.'.Address.'.$key.'.country',$value['country'],array('class' => 'form-control required')));?> 
                                                </div>
                                            </div>

                                            <?php } ?>


                                            <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                        
                                    
                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                                <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('contactPersonAddress_section',this)"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contactPersonAddress_section')"><i class="fa fa-minus"></i> </button>
                                            </div>
                                            <!-- <hr style="height:1px; border:none; color:#666666; background-color:#666666;"> -->
                                    </div>
                                </section>
                            </section>
                        </div>
                    </div>  
             </div>


                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2"></div>
                                    <div class="col-xs-2 col-md-2 2">
                                        <?php 
                                            echo $this->Form->submit('Submit Supplier Information', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                        ?>
                                    </div>
                                    <div class="col-xs-2 col-md-2 2">
                                        <?php 
                                            echo $this->Html->link('Cancel', array('controller' => 'purchasings', 'action' => 'index'),array('class' =>'btn btn-primary','escape' => false));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <hr>


                  </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    <script>
    $("#SupplierEditForm").validate({
         rules: {
            'data[Email][email]': {
            required: true,
            email: true
            },
            '[name*=data[Permit]]': {
            required: true,
            email: true
            },
        }      
      });
 </script>
