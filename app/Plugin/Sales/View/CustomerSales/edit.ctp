<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Edit', array('controller' => 'customer_sales', 'action' => 'edit',$this->data['Company']['id'])); ?>

<div style="clear:both"></div>

<?php echo $this->element('sales_option'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
        
            <header class="main-box-header clearfix">
                <center><h1><u>Customer Information</u></h1></center><hr>
            </header>
            
            <div class="main-box-body clearfix">

                <?php echo $this->Form->create('Customer',array('url'=>(array('controller' => 'customer_sales','action' => 'add')),'class' => 'form-horizontal'));
                   
                    echo $this->Form->input('Company.id', array('class' => 'form-control item_type',
                        'type' => 'hidden',
                        'value' => !empty($this->request->data['Company']['id']) ? $this->request->data['Company']['id'] : '' ,
                        'label' => false));
                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">

                            <header class="main-box-header clearfix">
                                <h1>Company</h1>
                            </header>
                            
                            <div class="main-box-body clearfix">
                                
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Name</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Company.company_name', array('class' => 'form-control col-lg-6','label' => false));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Company.description', array('class' => 'form-control col-lg-6','label' => false));
                                        ?>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label">Website</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Company.website', array('class' => 'form-control col-lg-6','label' => false));
                                        ?>
                                    </div>
                                </div>
                               
                            </div> 

                        </div>
                    </div>  
                </div>

                <div class="row ">
                    <div class="col-lg-12">
                        <div class="main-box">
                            <?php foreach ($this->request->data['Address'] as $key => $value) { 
                               
                                echo $this->Form->input('Address.0.id', array('class' => 'form-control item_type',
                                    'type' => 'hidden',
                                    'value' => !empty($value['id']) ? $value['id'] : '' ,
                                    'label' => false));
                                ?>
                                <section class="cloneMe addressSection">
                                    <header class="main-box-header clearfix">
                                        <h1>Company Address</h1><span class="wordCount"></span>
                                    </header>
                                    <div class="main-box-body clearfix">

                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-2 control-label">Address(1)</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('Address.0.type', array(
                                                        'options' => array('Work', 'Home', 'Business'),
                                                        'alt' => 'type',
                                                        'label' => false,
                                                        'class' => 'form-control col-lg-4',
                                                        'empty' => false,
                                                        'default' => !empty($value['type']) ? $value['type'] : ''
                                                    ));
                                                ?>
                                            </div>
                                            <div class="col-lg-7">
                                                <?php 
                                                    echo $this->Form->input('Address.0.address1', array('class' => 'form-control item_type',
                                                        'alt' => 'address1',
                                                        'label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Address(2)</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('Address.0.address2', array('class' => 'form-control item_type',
                                                        'alt' => 'address2',
                                                        'label' => false));
                                                ?>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">City</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('Address.0.city', array('class' => 'form-control',
                                                        'alt' => 'city',
                                                        'label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">State Province</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('Address.0.state_province', array('class' => 'form-control',
                                                        'alt' => 'state_province',
                                                        'label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Zip Code</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('Address.0.zip_code', array('class' => 'form-control',
                                                        'alt' => 'zip_code',
                                                        'label' => false,'type' => 'text'));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Country</label>
                                            <div class="col-lg-9">
                                                <?php echo( $this->Country->select('Address.0.country',null,array('class' => 'form-control','default' => !empty($value['country']) ? $value['country'] : '')));?>  
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
                                </section>
                            <?php } ?>
                        </div>
                    </div>  
                </div>

                <div class="row ">
                    <div class="col-lg-12">
                        <div class="main-box">

                            <header class="main-box-header clearfix">
                                <h1>Contact Number</h1>
                            </header>
                            
                            <div class="main-box-body clearfix ">
                                <?php foreach ($this->request->data['Contact'] as $key => $value) {
                                    echo $this->Form->input('Contact.0.id', array('class' => 'form-control item_type',
                                        'type' => 'hidden',
                                        'value' => !empty($value['id']) ? $value['id'] : '' ,
                                        'label' => false));
                                        ?>
                                    <section class="cloneMe1 contact_section">
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Contact Number</label>
                                            <div class="col-lg-2">
                                               <?php 
                                                    echo $this->Form->input('Contact.0.type', array(
                                                        'options' => array('Work', 'Home', 'Business'),
                                                        'label' => false,
                                                        'alt' => 'type',
                                                        'default' => !empty($value['type']) ? $value['type'] : '',
                                                        'class' => 'form-control',
                                                        'empty' => false
                                                    ));

                                                ?>
                                            </div>
                                            <div class="col-lg-6">
                                                <?php 
                                                    echo $this->Form->input('Contact.0.number', array('class' => 'form-control',
                                                        'alt' => 'number',
                                                        'label' => false));
                                                ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('contact_section',this)"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contact_section')"><i class="fa fa-minus"></i> </button>
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
                                <h1>Email</h1>
                            </header>
                            
                            <div class="main-box-body clearfix">
                            <?php foreach ($this->request->data['Email'] as $key => $value) {
                                echo $this->Form->input('Email.0.id', array('class' => 'form-control item_type',
                                    'type' => 'hidden',
                                    'value' => !empty($value['id']) ? $value['id'] : '' ,
                                    'label' => false));
                                    ?>
                                    <section class="cloneMe1 email_section" data-model ="Contact">
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Email Address</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('Email.0.type', array(
                                                        'options' => array('Work', 'Home', 'Business'),
                                                        'label' => false,
                                                        'default' => !empty($value['type']) ? $value['type'] : '',
                                                        'class' => 'form-control',
                                                        'empty' => false
                                                    ));

                                                ?>
                                            </div>
                                            <div class="col-lg-6">
                                                <?php 
                                                    echo $this->Form->input('Email.0.email', array('class' => 'form-control','label' => false));
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
                            <?php foreach ($this->request->data['ContactPersonData'] as $key => $value) { 
                                
                                echo $this->Form->input('ContactPersonData.0.ContactPerson.0.id', array('class' => 'form-control item_type',
                                    'type' => 'hidden',
                                    'value' => !empty($value['ContactPerson']['id']) ? $value['ContactPerson']['id'] : '' ,
                                    'label' => false));
                                ?>
                                <section class="cloneMe1 contactPerson_section"> 
                                    <header class="main-box-header clearfix">
                                        <h1>Contact person</h1>
                                    </header>
                                    <div class="main-box-body clearfix">

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Firstname</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.ContactPerson.0.firstname', array('class' => 'form-control','label' => false,'value' => !empty($value['ContactPerson']['firstname']) ? $value['ContactPerson']['firstname'] : ''));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Middlename</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.ContactPerson.0.middlename', array('class' => 'form-control','label' => false,'value' => !empty($value['ContactPerson']['middlename']) ? $value['ContactPerson']['middlename'] : ''));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Lastname</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.ContactPerson.0.lastname', array('class' => 'form-control','label' => false,'value' => !empty($value['ContactPerson']['lastname']) ? $value['ContactPerson']['lastname'] : ''));
                                                ?>
                                            </div>
                                        </div>
                                    </div> 

                                    <hr>
                   
                                    <header class="main-box-header clearfix">
                                        <h1>Contact Person Number</h1>
                                    </header>
                                
                                    <div class="main-box-body clearfix">
                                        <?php foreach ($this->request->data['ContactPersonData'] as $key => $value) {
                                            foreach ($value['Contact'] as $indexkey => $indexvalue) {
                                              
                                              
                                                echo $this->Form->input('ContactPersonData.0.Contact.0.id', array('class' => 'form-control item_type',
                                                    'type' => 'hidden',
                                                    'value' => !empty($indexvalue['id']) ? $indexvalue['id'] : '' ,
                                                    'label' => false));
                                               
                                                ?>
                                                <section class="cloneMe1 contactPersonNumber_section" id="Bien">
                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label">Contact Number</label>
                                                        <div class="col-lg-2">
                                                            <?php 
                                                                echo $this->Form->input('ContactPersonData.0.Contact.0.type', array(
                                                                    'options' => array('Work', 'Home', 'Business'),
                                                                    'label' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => false,
                                                                    'default' => !empty($indexvalue['type']) ? $indexvalue['type'] : ''

                                                                ));

                                                            ?>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <?php 
                                                                echo $this->Form->input('ContactPersonData.0.Contact.0.number', array('class' => 'form-control','label' => false));
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('contactPersonNumber_section', this)"><i class="fa fa-plus"></i></button>
                                                            <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contactPersonNumber_section')"><i class="fa fa-minus"></i> </button>
                                                        </div>
                                                    </div>
                                                    <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                                </section>
                                        <?php } } ?>
                                       
                                    </div> 
                         
                                    <hr>

                                    <header class="main-box-header clearfix">
                                        <h1>Contact Person Email</h1>
                                    </header>
                                
                                    <div class="main-box-body clearfix">
                                        <?php foreach ($this->request->data['ContactPersonData'] as $key => $value) {
                                            foreach ($value['Email'] as $indexkey => $indexvalue) {
                                                echo $this->Form->input('ContactPersonData.0.Email.0.id', array('class' => 'form-control item_type',
                                                    'type' => 'hidden',
                                                    'value' => !empty($indexvalue['id']) ? $indexvalue['id'] : '' ,
                                                    'label' => false));
                                                ?>
                                                <section class="cloneMe1 contactPersonEmail_section">
                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label">Email</label>
                                                        <div class="col-lg-2">
                                                            <?php 
                                                                echo $this->Form->input('ContactPersonData.0.Email.0.type', array(
                                                                    'options' => array('Work', 'Home', 'Business'),
                                                                    'label' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => false,
                                                                    'default' => !empty($indexvalue['type']) ? $indexvalue['type'] : ''
                                                                ));

                                                            ?>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <?php 
                                                                echo $this->Form->input('ContactPersonData.0.Email.0.email', array('class' => 'form-control','label' => false));
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('contactPersonEmail_section',this)"><i class="fa fa-plus"></i></button>
                                                            <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contactPersonEmail_section')"><i class="fa fa-minus"></i> </button>
                                                        </div>
                                                    </div>
                                                    <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                                </section>
                                        <?php } } ?>
                                    </div>

                                    <hr>
                                    <?php foreach ($this->request->data['ContactPersonData'] as $key => $value) { 
                                        foreach ($value['Address'] as $indexkey => $indexvalue) {
                                            echo $this->Form->input('ContactPersonData.0.Address.0.id', array(
                                                'empty' => false,
                                                'type'  =>'hidden',
                                                'value' => !empty($indexvalue['id']) ? $indexvalue['id'] : '' 
                                                ));

                                            ?>
                                            <section class="cloneMe1 contactPersonAddress_section">
                                                <header class="main-box-header clearfix">
                                                    <h1>Contact Person Address</h1>
                                                </header>
                                        
                                                <div class="main-box-body clearfix">
                                                    
                                                    <div class="form-group">
                                                        <label for="inputEmail1" class="col-lg-2 control-label">Address(1)</label>
                                                        <div class="col-lg-2">
                                                            <?php 
                                                            echo $this->Form->input('ContactPersonData.0.Address.0.type', array(
                                                                'options' => array('Work', 'Home', 'Business'),
                                                                'label' => false,
                                                                'class' => 'form-control',
                                                                'empty' => false,
                                                                'default' => !empty($indexvalue['type']) ? $indexvalue['type'] : '' 
                                                            ));

                                                        ?>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <?php 
                                                                echo $this->Form->input('ContactPersonData.0.Address.0.address1', array('class' => 'form-control item_type','label' => false));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label">Address(2)</label>
                                                        <div class="col-lg-9">
                                                            <?php 
                                                                echo $this->Form->input('ContactPersonData.0.Address.0.address2', array('class' => 'form-control item_type','label' => false));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label">City</label>
                                                        <div class="col-lg-9">
                                                            <?php 
                                                                echo $this->Form->input('ContactPersonData.0.Address.0.city', array('class' => 'form-control','label' => false));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label">State Province</label>
                                                        <div class="col-lg-9">
                                                            <?php 
                                                                echo $this->Form->input('ContactPersonData.0.Address.0.state_province', array('class' => 'form-control','label' => false));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label">Zip Code</label>
                                                        <div class="col-lg-9">
                                                            <?php 
                                                                echo $this->Form->input('ContactPersonData.0.Address.0.zip_code', array('class' => 'form-control','label' => false,'type' => 'text'));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label">Country</label>
                                                        <div class="col-lg-9">
                                                            <?php echo( $this->Country->select('ContactPersonData.0.Address.0.country',null,array('class' => 'form-control','default' => !empty($value['country']) ? $value['country'] : '')));?> 
                                                        </div>
                                                    </div>
                                                    <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                                    
                                                
                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                                        <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('contactPersonAddress_section',this)"><i class="fa fa-plus"></i></button>
                                                        <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contactPersonAddress_section')"><i class="fa fa-minus"></i> </button>
                                                    </div>
                                                    <hr style="height:1px; border:none; color:#666666; background-color:#666666;">
                                                </div>
                                            </section>
                                    <?php } } ?>
                                 
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                        <div class="col-lg-4">
                                            <button type="button" class="add-field6 table-link danger btn btn-success" onclick="cloneData('contactPerson_section',this)"> <i class="fa fa-plus"> Add Contact Person</i></button>
                                            <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contactPerson_section')"><i class="fa fa-minus"></i> </button>
                                        </div>
                                    </div>
                                </section>
                            <?php } ?>
                        </div>
                    </div>  
                </div>
                    
                <hr>

                <div class="row">
                    <div class="multi-field-wrapper clearfix">
                        <div class="multi-fields clearfix">
                            <div class="multi-field clearfix">
                                <div class="col-xs-2 col-md-2"></div>
                                <div class="col-xs-8 col-md-8 2">
                                    <?php 
                                        echo $this->Form->submit('Submit Customer Information', array('class' => 'btn btn-success',  'title' => 'Click here to add the customer') );
                                    ?>
                                </div>
                                <div class="col-xs-4 col-md-2 1"><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo $this->Form->end(); ?>

            </div>
        </div>
    </div>
</div>