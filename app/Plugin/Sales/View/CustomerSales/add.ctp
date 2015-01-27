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

                <?php echo $this->Form->create('Customer',array('url'=>(array('controller' => 'customer_sales','action' => 'add')),'class' => 'form-horizontal'));?>

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

                            <header class="main-box-header clearfix">
                                <h1>Company Address</h1>
                            </header>
                            
                            <div class="main-box-body clearfix">
                                <section class="cloneMe addressSection" data-model ="Address">
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-2 control-label">Address(1)</label>
                                        <div class="col-lg-2">
                                            <?php 
                                                echo $this->Form->input('Address.0.type', array(
                                                    'options' => array('Work'=>'work', 'Home'=>'home', 'Business'=>'business'),
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
                                            <?php 
                                                echo $this->Form->input('Address.0.country', array(
                                                    'options' => array('country', 'country', 'country'),
                                                    'label' => false,
                                                    'alt' => 'country',
                                                    'class' => 'form-control',
                                                    // 'id'    => 'addressID',
                                                    'empty' => false
                                                ));

                                            ?>
                                        </div>
                                    </div>
                                </section>

                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <button type="button" data-model='Address' class="add-field table-link danger btn btn-success" onclick="cloneData('addressSection')"> <i class="fa fa-plus"></i></button>
                                        <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
                                    </div>
                                </div>

                            </div>

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
                                <section class="cloneMe1 contact_section" data-model ="Contact">
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Contact Number</label>
                                        <div class="col-lg-2">
                                            <?php 
                                                echo $this->Form->input('Contact.0.type', array(
                                                    'options' => array('Work'=>'work', 'Home'=>'home', 'Business'=>'business'),
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
                                                    'label' => false));
                                            ?>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('contact_section')"><i class="fa fa-plus"></i></button>
                                            <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
                                        </div>
                                    </div>
                                </section>
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
                                <div class="cloneMe2">
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Email Address</label>
                                        <div class="col-lg-2">
                                            <?php 
                                                echo $this->Form->input('Email.0.email_type', array(
                                                    'options' => array('Work'=>'work', 'Home'=>'home', 'Business'=>'business'),
                                                    'label' => false,
                                                    'class' => 'form-control',
                                                    'empty' => false
                                                ));

                                            ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <?php 
                                                echo $this->Form->input('Email.0.mail', array('class' => 'form-control','label' => false));
                                            ?>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="add-field2 table-link danger btn btn-success"><i class="fa fa-plus"></i></button>
                                            <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
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

                            <header class="main-box-header clearfix">
                                <h1>Contact person</h1>
                            </header>
                            <div class="cloneMe6"> 
                                <div class="main-box-body clearfix">

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Firstname</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPerson.0.firstname', array('class' => 'form-control','label' => false));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Middlename</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPerson.0.middlename', array('class' => 'form-control','label' => false));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Lastname</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPerson.0.lastname', array('class' => 'form-control','label' => false));
                                            ?>
                                        </div>
                                    </div>
                                </div> 

                                <hr>
               
                                <header class="main-box-header clearfix">
                                    <h1>Contact Number</h1>
                                </header>
                            
                                <div class="main-box-body clearfix">
                                    <div class="cloneMe3">   
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Contact Number</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('ContactPerson.0.personNumber_type', array(
                                                        'options' => array('Work'=>'work', 'Home'=>'home', 'Business'=>'business'),
                                                        'label' => false,
                                                        'class' => 'form-control',
                                                        'empty' => false
                                                    ));

                                                ?>
                                            </div>
                                            <div class="col-lg-6">
                                                <?php 
                                                    echo $this->Form->input('ContactPerson.0.number', array('class' => 'form-control','label' => false));
                                                ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="add-field3 table-link danger btn btn-success"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div> 
                     
                                <hr>

                                <header class="main-box-header clearfix">
                                    <h1>Email</h1>
                                </header>
                            
                                <div class="main-box-body clearfix">
                                    <div class="cloneMe4">
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Email</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('ContactEmail.0.personEmail_type', array(
                                                        'options' => array('Work'=>'work', 'Home'=>'home', 'Business'=>'business'),
                                                        'label' => false,
                                                        'class' => 'form-control',
                                                        'empty' => false
                                                    ));

                                                ?>
                                            </div>
                                            <div class="col-lg-6">
                                                <?php 
                                                    echo $this->Form->input('ContactEmail.0.email', array('class' => 'form-control','label' => false));
                                                ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="add-field4 table-link danger btn btn-success"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <header class="main-box-header clearfix">
                                    <h1>Contact Address</h1>
                                </header>
                            
                                <div class="main-box-body clearfix">
                                    <div class="cloneMe5">
                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-2 control-label">Address(1)</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('ContactPerson.0.personAddress_type', array(
                                                        'options' => array('Work'=>'work', 'Home'=>'home', 'Business'=>'business'),
                                                        'label' => false,
                                                        'class' => 'form-control',
                                                        // 'id'    => 'addressID',
                                                        'empty' => false
                                                    ));

                                                ?>
                                            </div>
                                            <div class="col-lg-7">
                                                <?php 
                                                    echo $this->Form->input('ContactPerson.0.address1', array('class' => 'form-control item_type','label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Address(2)</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPerson.0.address2', array('class' => 'form-control item_type','label' => false));
                                                ?>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">City</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPerson.0.city', array('class' => 'form-control','label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">State Province</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPerson.0.state_province', array('class' => 'form-control','label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Zip Code</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPerson.0.zip_code', array('class' => 'form-control','label' => false,'type' => 'text'));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Country</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPerson.0.country', array(
                                                        'options' => array('country', 'country', 'country'),
                                                        'label' => false,
                                                        'class' => 'form-control',
                                                        // 'id'    => 'addressID',
                                                        'empty' => false
                                                    ));

                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                            <div class="col-lg-10">
                                                <button type="button" class="add-field5 table-link danger btn btn-success"> <i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>

                                        <hr>

                                         
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                        <div class="col-lg-10">
                                            <button type="button" class="add-field6 table-link danger btn btn-success"> <i class="fa fa-plus"> Add Contact Person</i></button>
                                            <button type="button" class="remove-field btn btn-danger"><i class="fa fa-minus"></i> </button>
                                        </div>
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