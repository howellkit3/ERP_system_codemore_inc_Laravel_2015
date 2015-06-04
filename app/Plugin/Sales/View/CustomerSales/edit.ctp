<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'customer_sales', 'action' => 'add')); ?>

<div style="clear:both"></div>

<?php echo $this->element('sales_option'); ?><br><br>
<?php echo $this->Html->script('Sales.company_quotation');?>
<?php  echo $this->Form->create('Customer',array('url'=>(array('controller' => 'customer_sales','action' => 'update')),'class' => 'form-horizontal')); ?>
<div class="row">
    <div class="col-lg-12">
        
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                    
                    <center>
                        <h1 class="pull-left">
                            Customer Information
                        </h1>
                    </center>
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
                </header>

            </div>
        </div>
        <?php echo $this->Form->input('Company.id', array('class' => 'form-control item_type',
                        'type' => 'hidden',
                        'value' => !empty($this->request->data['Company']['id']) ? $this->request->data['Company']['id'] : '' ,
                        'label' => false)); 
                   // pr($this->request->data);exit();
                ?>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1>Company</h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Name</label>
                                        <div class="col-lg-9">
                                            <?php
                                                echo $this->Form->input('Company.company_name', array('class' => 'form-control col-lg-6 required','label' => false));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"> Description</label>
                                        <div class="col-lg-9">
                                            <?php
                                                echo $this->Form->input('Company.description', array('type' => 'text', 
                                                                                                    'maxlength'=>'1000',
                                                                                                     'class' => 'form-control col-lg-6 ',
                                                                                                     'label' => false
                                                                                                     ));
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

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">TIN</label>
                                        <div class="col-lg-9">
                                            <?php
                                                echo $this->Form->input('Company.tin', array('class' => 'form-control col-lg-6 ','label' => false,'type' => 'text'));
                                            ?>
                                
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Payment Term</label>
                                        <div class="col-lg-9">
                                       
                                              <?php 
                                                echo $this->Form->input('Company.payment_term', array(
                                                    'options' => array($paymentTermData),
                                                    'label' => false,
                                                    'style' => 'text-transform:capitalize',
                                                    'class' => 'form-control',
                                                    'default' => !empty($this->request->data['Company']['payment_term']) ? $this->request->data['Company']['payment_term'] : '--Please Select Payment Term--'
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
            <?php foreach ($this->request->data['Address'] as $key => $value) { 
                               
                    echo $this->Form->input('Address.'.$key.'.id', array('class' => 'form-control item_type',
                        'type' => 'hidden',
                        'value' => !empty($value['id']) ? $value['id'] : '' ,
                        'label' => false));
                    ?>
                <section class="cloneMe addressSection">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box"> 
                                  <h1><?php echo ($key == 0) ? 'Company Address' : '';  ?></h1>
                                <!-- <div class="top-space"></div> -->
                                <div class="main-box-body clearfix">
                                    <div class="main-box-body clearfix">
                                        <div class="form-horizontal">
                                
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Address(1)</label>
                                                <div class="col-lg-2">
                                                    <?php 
                                                        echo $this->Form->input('Address.'.$key.'.type', array(
                                                            'options' => array('Work', 'Home', 'Business','Plant'),
                                                            'alt' => 'type',
                                                            'label' => false,
                                                            'class' => 'form-control col-lg-4 required',
                                                            'empty' => false,
                                                            'data-name' => 'Address',
                                                            'default' => !empty($value['type']) ? $value['type'] : ''
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

                                           <!--  <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label">Address(2)</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('Address.'.$key.'.address2', array('class' => 'form-control item_type',
                                                            'alt' => 'address2',
                                                            'label' => false));
                                                    ?>
                                                </div>
                                            </div> -->

                                             <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"> City</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('Address.'.$key.'.city', array('class' => 'form-control ',
                                                            'alt' => 'city',
                                                            'label' => false));
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label">State Province</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('Address.'.$key.'.state_province', array('class' => 'form-control ',
                                                            'alt' => 'state_province',
                                                            'label' => false));
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"> Zip Code</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('Address.'.$key.'.zip_code', array('class' => 'form-control number',
                                                            'alt' => 'zip_code',
                                                            'label' => false,'type' => 'text'));
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label">Country</label>
                                                <div class="col-lg-9">
                                                     <?php echo( $this->Country->select('Address.'.$key.'.country',null,array('class' => 'form-control required','default' => !empty($value['country']) ? $value['country'] : '')));?>  
                                                </div>
                                            </div>
                                            <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                        

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                                <div class="col-lg-10">
                                               
                                                    <button type="button" data-model='Address' class="add-field table-link danger btn btn-success" onclick="cloneData('addressSection',this)"> <i class="fa fa-plus"></i></button>
                                                 <?php if ($key > 0) : ?>
                                                    <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('addressSection')"><i class="fa fa-minus"></i> </button>
                                                  <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>

            <?php $count = 1; foreach ($this->request->data['Contact'] as $key => $value) {
                    echo $this->Form->input('Contact.'.$key.'.id', array('class' => 'form-control item_type',
                        'type' => 'hidden',
                        'value' => !empty($value['id']) ? $value['id'] : '' ,
                        'label' => false));
                        ?>
                <section class="cloneMe1 contact_section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box">
                                <h1><?php echo ($key == 0) ? 'Company Number' : '';  ?></h1>
                                <!-- <div class="top-space"></div> -->
                                <div class="main-box-body clearfix">
                                    <div class="main-box-body clearfix">
                                        <div class="form-horizontal">
                                
                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label">Contact Number 
                                                <span><?php //echo $count; ?></span></label>
                                                <div class="col-lg-2">
                                                    <?php 
                                                        echo $this->Form->input('Contact.'.$key.'.type', array(
                                                            'options' => array('Tel', 'Fax', 'Mobile'),
                                                            'label' => false,
                                                            'alt' => 'type',
                                                            'class' => 'form-control',
                                                            'empty' => false,
                                                            'default' => !empty($value['type']) ? $value['type'] : ''
                                                        ));

                                                    ?>
                                                   
                                                </div>
                                                
                                                <div class="col-lg-6">
                                                    <?php 
                                                        echo $this->Form->input('Contact.'.$key.'.number', array('class' => 'form-control',
                                                            'alt' => 'number',
                                                            'label' => false,
                                                            ));

                                                    ?>
                                                     <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('contact_section',this)"><i class="fa fa-plus"></i></button>
                                                    <?php if ($key > 0) : ?>
                                                    <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('contact_section')"><i class="fa fa-minus"></i> </button>
                                                    <?php endif;?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php $count++; }  ?>

            <?php foreach ($this->request->data['Email'] as $key => $value) {
                echo $this->Form->input('Email.'.$key.'.id', array('class' => 'form-control item_type',
                    'type' => 'hidden',
                    'value' => !empty($value['id']) ? $value['id'] : '' ,
                    'label' => false));
                    ?>
                <section class="cloneMe1 email_section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box">
                                <h1><?php echo ($key == 0) ? 'Company Email' : '';  ?></h1>
                                <!-- <div class="top-space"></div> -->
                                <div class="main-box-body clearfix">
                                    <div class="main-box-body clearfix">
                                        <div class="form-horizontal">
                                
                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"> Email Address</label>
                                                <div class="col-lg-2">
                                                    <?php 
                                                        echo $this->Form->input('Email.'.$key.'.type', array(
                                                            'options' => array('Work', 'Home', 'Business'),
                                                            'label' => false,
                                                            'class' => 'form-control',
                                                            'empty' => false,
                                                            'default' => !empty($value['type']) ? $value['type'] : ''
                                                        )); ?>
                                                </div>
                                                <div class="col-lg-6">
                                                    <?php 
                                                        echo $this->Form->input('Email.'.$key.'.email', array('class' => 'form-control email','label' => false));
                                                    ?>
                                                    <span class="lighter-color2">Ex. example@email.com</span>
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('email_section',this)"><i class="fa fa-plus"></i></button>
                                                    <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('email_section')"><i class="fa fa-minus"></i> </button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>


            <?php if (!empty($this->request->data['ContactPersonData'])) : ?>
            <?php foreach ($this->request->data['ContactPersonData'] as $key => $value) { 
                                
                echo $this->Form->input('ContactPersonData.'.$key.'.ContactPerson.'.$key.'.id', array('class' => 'form-control item_type',
                    'type' => 'hidden',
                    'value' => !empty($value['ContactPerson']['id']) ? $value['ContactPerson']['id'] : '' ,
                    'label' => false));
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">
                            <h1><?php echo ($key == 0) ? 'Contact Person' : '';  ?></h1>
                            <!-- <div class="top-space"></div> -->
                            <div class="main-box-body clearfix">
                                <div class="main-box-body clearfix">
                                    <div class="form-horizontal">
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

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Position</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.ContactPerson.0.position', array('class' => 'form-control','label' => false,'value' => !empty($value['ContactPerson']['position']) ? $value['ContactPerson']['position'] : ''));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php foreach ($this->request->data['ContactPersonData'] as $key => $value) {

                foreach ($value['Contact'] as $indexkey => $indexvalue) {
                  
                  
                    echo $this->Form->input('ContactPersonData.'.$key.'.Contact.'.$indexkey.'.id', array('class' => 'form-control item_type',
                        'type' => 'hidden',
                        'value' => !empty($indexvalue['id']) ? $indexvalue['id'] : '' ,
                        'label' => false));
                   
                    ?>
                <section class="cloneMe1 contactPersonNumber_section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box">
                                <h1><?php echo ($indexkey == 0) ? 'Contact Person Number' : '';  ?></h1>
                                <!-- <div class="top-space"></div> -->
                                <div class="main-box-body clearfix">
                                    <div class="main-box-body clearfix">
                                        <div class="form-horizontal">
                                
                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"> Contact Number</label>
                                                <div class="col-lg-2">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.'.$key.'.Contact.'.$indexkey.'.type', array(
                                                            'options' => array('Tel', 'Fax', 'Mobile'),
                                                            'label' => false,
                                                            'class' => 'form-control',
                                                            'default' => !empty($indexvalue['type']) ? $indexvalue['type'] : ''
                                                        ));

                                                    ?>
                                                </div>
                                                <div class="col-lg-6">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.'.$key.'.Contact.'.$indexkey.'.number', array('class' => 'form-control','label' => false, ));
                                                    ?>
                                                    <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('contactPersonNumber_section', this)"><i class="fa fa-plus"></i></button>
                                                    <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('contactPersonNumber_section')"><i class="fa fa-minus"></i> </button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } } ?>

            <?php foreach ($this->request->data['ContactPersonData'] as $key => $value) {

                foreach ($value['Email'] as $indexkey => $indexvalue) {
                    echo $this->Form->input('ContactPersonData.'.$key.'.Email.'.$indexkey.'.id', array('class' => 'form-control item_type',
                        'type' => 'hidden',
                        'value' => !empty($indexvalue['id']) ? $indexvalue['id'] : '' ,
                        'label' => false));
                    ?>
                <section class="cloneMe1 contactPersonEmail_section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box">
                               <h1><?php echo ($indexkey == 0) ? 'Contact Person Email' : '';  ?></h1>

                                <!-- <div class="top-space"></div> -->
                                <div class="main-box-body clearfix">
                                    <div class="main-box-body clearfix">
                                        <div class="form-horizontal">
                                
                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label">Email</label>
                                                <div class="col-lg-2">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.'.$key.'.Email.'.$indexkey.'.type', array(
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
                                                        echo $this->Form->input('ContactPersonData.'.$key.'.Email.'.$indexkey.'.email', array('class' => 'form-control email','label' => false));
                                                    ?>
                                                    <span class="lighter-color2">Ex. example@email.com</span>
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('contactPersonEmail_section',this)"><i class="fa fa-plus"></i></button>
                                                    <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('contactPersonEmail_section')"><i class="fa fa-minus"></i> </button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } } ?>
            <?php else :?>
                  <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1>Contact person</h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Firstname</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPersonData.0.ContactPerson.0.firstname', array('class' => 'form-control','label' => false));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Middlename</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPersonData.0.ContactPerson.0.middlename', array('class' => 'form-control','label' => false));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Lastname</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPersonData.0.ContactPerson.0.lastname', array('class' => 'form-control','label' => false));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Position</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPersonData.0.ContactPerson.0.position', array('class' => 'form-control','label' => false));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="cloneMe1 contactPersonNumber_section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">
                            <h1>Contact Person Number</h1>
                            <!-- <div class="top-space"></div> -->
                            <div class="main-box-body clearfix">
                                <div class="main-box-body clearfix">
                                    <div class="form-horizontal">
                            
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"> Contact Number</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.Contact.0.type', array(
                                                        'options' => array('Tel', 'Fax', 'Mobile'),
                                                        'label' => false,
                                                        'class' => 'form-control',
                                                        'empty' => false
                                                    ));

                                                ?>
                                            </div>
                                            <div class="col-lg-6">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.Contact.0.number', array('class' => 'form-control','label' => false, ));
                                                ?>
                                                <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('contactPersonNumber_section', this)"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('contactPersonNumber_section')"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="cloneMe1 contactPersonEmail_section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">
                            <h1>Contact Person Email</h1>
                            <!-- <div class="top-space"></div> -->
                            <div class="main-box-body clearfix">
                                <div class="main-box-body clearfix">
                                    <div class="form-horizontal">
                            
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Email</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.Email.0.type', array(
                                                        'options' => array('Work', 'Home', 'Business'),
                                                        'label' => false,
                                                        'class' => 'form-control',
                                                        'empty' => false
                                                    ));

                                                ?>
                                            </div>
                                            <div class="col-lg-6">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.Email.0.email', array('class' => 'form-control email','label' => false));
                                                ?>
                                                <span class="lighter-color2">Ex. example@email.com</span>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('contactPersonEmail_section',this)"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('contactPersonEmail_section')"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif; ?>    
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                       
                        <div class="top-space"></div>
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                        
                                    <div class="multi-field clearfix">
                                        <div class="col-xs-2 col-md-2"></div>
                                        <div class="col-xs-2 col-md-2 2">
                                            <?php 
                                                echo $this->Form->submit('Submit Customer Information', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                            ?>
                                          
                                        </div>
                                        <div class="col-xs-2 col-md-2 2">
                                            <?php 
                                                echo $this->Html->link('Cancel ', array('controller' => 'customer_sales', 'action' => 'index'),array('class' =>'btn btn-primary','escape' => false));
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
 <?php echo $this->Form->end(); ?>
<script>
    $("#CompanyAddForm").validate();
</script>


<script>
 jQuery(document).ready(function($){

        //masked inputs
        $("#CompanyTin").mask("999-999-999-999");
        jQuery('.remove').hide();
        jQuery("#CompanyAddForm").validate();

    });
</script>`