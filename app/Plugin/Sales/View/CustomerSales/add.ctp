<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'customer_sales', 'action' => 'add')); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
        <?php $this->Session->flash(); ?>
            <header class="main-box-header clearfix">
                <h2><u>Customer Information</u></h2>
            </header>
            
            <div class="main-box-body clearfix">

                <?php echo $this->Form->create('Customer',array('url'=>(array('controller' => 'customer_sales','action' => 'add'))));?>

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2">Company Name</div>
                                    <div class="col-xs-8 col-md-8 2">
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

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2">Company Address</div>
                                    <div class="col-xs-8 col-md-8 2">
                                        <?php 
                                            echo $this->Form->input('Company.company_address', array('class' => 'form-control','label' => false,'placeholder' => 'Company Address'));
                                        ?>
                                    </div>
                                    <div class="col-xs-4 col-md-2 1">
                                        <button type="button" class="add-field table-link danger btn btn-success"> <i class="fa fa-plus"></i></button>
                                        <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2">State Province</div>
                                    <div class="col-xs-8 col-md-8 2">
                                        <?php 
                                            echo $this->Form->input('Company.state_province', array('class' => 'form-control','label' => false,'placeholder' => 'State Province'));
                                        ?>
                                    </div>
                                    <div class="col-xs-4 col-md-2 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2">Company Contact</div>
                                    <div class="col-xs-8 col-md-8 2">
                                        <?php 
                                            echo $this->Form->input('Company.company_contact', array('class' => 'form-control','label' => false,'placeholder' => 'Company Contact'));
                                        ?>
                                    </div>
                                    <div class="col-xs-4 col-md-2 1">
                                        <button type="button" class="add-field table-link danger btn btn-success"> <i class="fa fa-plus"></i></button>
                                        <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <header class="main-box-header clearfix">
                        <h2><u>Contact Information</u></h2>
                    </header>

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2">Firstname</div>
                                    <div class="col-xs-8 col-md-8 2">
                                        <?php 
                                            echo $this->Form->input('Customer.firstname', array('class' => 'form-control','label' => false,'placeholder' => 'Firstname'));
                                        ?>
                                    </div>
                                    <div class="col-xs-4 col-md-2 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2">Middlename</div>
                                    <div class="col-xs-8 col-md-8 2">
                                        <?php 
                                            echo $this->Form->input('Customer.middlename', array('class' => 'form-control','label' => false,'placeholder' => 'Middlename'));
                                        ?>
                                    </div>
                                    <div class="col-xs-4 col-md-2 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2">Lastname</div>
                                    <div class="col-xs-8 col-md-8 2">
                                        <?php 
                                            echo $this->Form->input('Customer.lastname', array('class' => 'form-control','label' => false,'placeholder' => 'Lastname'));
                                        ?>
                                    </div>
                                    <div class="col-xs-4 col-md-2 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2">Email</div>
                                    <div class="col-xs-8 col-md-8 2">
                                        <?php 
                                            echo $this->Form->input('Customer.email', array('class' => 'form-control','label' => false,'placeholder' => 'Email'));
                                        ?>
                                    </div>
                                    <div class="col-xs-4 col-md-2 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2">Contact Number</div>
                                    <div class="col-xs-8 col-md-8 2">
                                        <?php 
                                            echo $this->Form->input('Customer.contact_number', array('class' => 'form-control','label' => false,'placeholder' => 'Contact Number'));
                                        ?>
                                    </div>
                                    <div class="col-xs-4 col-md-2 1"><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="multi-field-wrapper clearfix">
                            <div class="multi-fields clearfix">
                                <div class="multi-field clearfix">
                                    <div class="col-xs-2 col-md-2">Address</div>
                                    <div class="col-xs-8 col-md-8 2">
                                        <?php 
                                            echo $this->Form->input('Customer.address', array('class' => 'form-control','label' => false,'placeholder' => 'Address'));
                                        ?>
                                    </div>
                                    <div class="col-xs-4 col-md-2 1"><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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