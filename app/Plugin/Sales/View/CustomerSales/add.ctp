<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'customer_sales', 'action' => 'add')); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
        <?php $this->Session->flash(); ?>
            <header class="main-box-header clearfix">
                <center><h1><u>Customer Information</u></h1></center><hr>
            </header>
            
            <div class="main-box-body clearfix">

                <?php echo $this->Form->create('Customer',array('url'=>(array('controller' => 'customer_sales','action' => 'add'))));?>
                    <header class="main-box-header clearfix">
                        <h1>Company Name</h1>
                    </header>

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2"></div>
                                    <div class="col-xs-8 col-md-9 2">
                                        <?php
                                            echo $this->Form->input('Company.company_name', array('class' => 'form-control col-lg-6','label' => false,'placeholder' => 'Company Name'));
                                        ?>
                                    </div>
                                    <div class="col-xs-4 col-md-2 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <header class="main-box-header clearfix">
                        <h1>Company Address</h1>
                    </header>

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div id="multi">
                                    <div class="row">
                                        
                                        <div class="col-xs-2 col-md-2">
                                            <?php 
                                                echo $this->Form->input('Address.address_type', array(
                                                    'options' => array('Work', 'Home', 'Business'),
                                                    'label' => false,
                                                    'class' => 'form-control',
                                                    'empty' => false
                                                ));

                                            ?>
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                            <?php 
                                                echo $this->Form->input('Address.company_address', array('class' => 'form-control item_type','label' => false,'placeholder' => 'Company Address'));
                                            ?>
                                        </div>

                                        <div class="col-xs-2 col-md-2">
                                            State Province
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                            <?php 
                                                echo $this->Form->input('Address.state_province', array('class' => 'form-control','label' => false,'placeholder' => 'State Province'));
                                            ?>
                                        </div>

                                        <div class="col-xs-2 col-md-2">
                                            Street
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                           <?php 
                                                echo $this->Form->input('Address.street', array('class' => 'form-control','label' => false,'placeholder' => 'Street'));
                                            ?>
                                        </div>



                                        <br><br><br>

                                        <div class="col-xs-2 col-md-2">
                                            
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                           <button type="button" class="add-field table-link danger btn btn-success"> <i class="fa fa-plus"></i></button>
                                            <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
                                            <hr>
                                        </div>
     
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <header class="main-box-header clearfix">
                        <h1>Contact Number</h1>
                    </header>

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">

                                    <div class="row">

                                        <div class="col-xs-2 col-md-2">
                                            <?php 
                                                echo $this->Form->input('Contact.email_type', array(
                                                    'options' => array('Work', 'Home', 'Business'),
                                                    'label' => false,
                                                    'class' => 'form-control',
                                                    'empty' => false
                                                ));

                                            ?>
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                            <?php 
                                                echo $this->Form->input('Contact.company_email', array('class' => 'form-control','label' => false,'placeholder' => 'Email Address'));
                                            ?>
                                        </div>
                                        
                                        <div class="col-xs-2 col-md-2">
                                            <?php 
                                                echo $this->Form->input('Contact.telephone_type', array(
                                                    'options' => array('Work', 'Home', 'Business'),
                                                    'label' => false,
                                                    'class' => 'form-control'
                                                ));

                                            ?>
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                            <?php 
                                                echo $this->Form->input('Contact.company_telephone', array('class' => 'form-control','label' => false,'placeholder' => 'Telephone Number'));
                                            ?>
                                        </div>

                                        <div class="col-xs-2 col-md-2">
                                            <?php 
                                                echo $this->Form->input('Contact.cellphone_type', array(
                                                    'options' => array('Work', 'Home', 'Business'),
                                                    'label' => false,
                                                    'class' => 'form-control',
                                                    'empty' => false
                                                ));

                                            ?>
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                            <?php 
                                                echo $this->Form->input('Contact.company_cellphone', array('class' => 'form-control','label' => false,'placeholder' => 'Cellphone Number'));
                                            ?>
                                        </div>

                                        <br><br><br>

                                        <div class="col-xs-2 col-md-2">
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                           <button type="button" class="add-field table-link danger btn btn-success"> <i class="fa fa-plus"></i></button>
                                            <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
                                            <hr>
                                        </div>
                                     
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <header class="main-box-header clearfix">
                        <h1>Contact person</h1>
                    </header>

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">

                                    <div class="row">

                                        <div class="col-xs-2 col-md-2">
                                            Firstname
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                            <?php 
                                                echo $this->Form->input('ContactPerson.firstname', array('class' => 'form-control','label' => false,'placeholder' => 'Firstname'));
                                            ?>
                                        </div>
                                        
                                        <div class="col-xs-2 col-md-2">
                                            Middlename
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                            <?php 
                                                echo $this->Form->input('ContactPerson.middlename', array('class' => 'form-control','label' => false,'placeholder' => 'Middlename'));
                                            ?>
                                        </div>

                                        <div class="col-xs-2 col-md-2">
                                            Lastname
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                            <?php 
                                                echo $this->Form->input('ContactPerson.lastname', array('class' => 'form-control','label' => false,'placeholder' => 'Lastname'));
                                            ?>
                                        </div>

                                        <div class="col-xs-2 col-md-2">
                                            Email
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                            <?php 
                                                echo $this->Form->input('ContactPerson.email', array('class' => 'form-control','label' => false,'placeholder' => 'Email'));
                                            ?>
                                        </div>

                                        <div class="col-xs-2 col-md-2">
                                            Contact Number
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                            <?php 
                                                echo $this->Form->input('ContactPerson.contact_number', array('class' => 'form-control','label' => false,'placeholder' => 'Contact Number'));
                                            ?>
                                        </div>

                                        <div class="col-xs-2 col-md-2">
                                            Address
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                            <?php 
                                                echo $this->Form->input('ContactPerson.address', array('class' => 'form-control','label' => false,'placeholder' => 'Address'));
                                            ?>
                                        </div>

                                        <br><br><br>

                                        <div class="col-xs-2 col-md-2">
                                        </div>
                                        <div class="col-xs-8 col-md-9 2">
                                           <button type="button" class="add-field table-link danger btn btn-success"> <i class="fa fa-plus"></i></button>
                                            <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
                                            <hr>
                                        </div>
                                     
                                    </div>

                                </div>
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
                                            echo $this->Form->submit('Add Customer Info', array('class' => 'btn btn-success',  'title' => 'Click here to add the customer') );
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