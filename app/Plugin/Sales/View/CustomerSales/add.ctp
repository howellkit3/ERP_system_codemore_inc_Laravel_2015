<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'customer_sales', 'action' => 'add')); ?>

<div style="clear:both"></div>

<?php echo $this->element('sales_option'); ?>
<?php echo $this->Html->script('Sales.company_quotation');?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            
            <header class="main-box-header clearfix">
                <center>
                    <h1>
                        <u>
                            Customer Information
                        </u>
                        <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </h1>
                </center><hr>
                
            </header>
            
            <div class="main-box-body clearfix">

                <?php echo $this->Form->create('Company',array('url'=>(array('controller' => 'customer_sales','action' => 'add')),'class' => 'form-horizontal'));?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">

                            <header class="main-box-header clearfix">
                                <h1>Company</h1>
                            </header>
                            
                            <div class="main-box-body clearfix">
                                
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
                                            echo $this->Form->input('Company.tin', array('class' => 'form-control col-lg-6  number','label' => false,'type' => 'text'));
                                        ?>
                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Payment Term</label>
                                    <div class="col-lg-9">
                                        <?php 
                                            echo $this->Form->input('Company.payment_term', array(
                                                'options' => array(
                                                    'PIA - Payment in advance' => 'PIA - Payment in advance',
                                                    'COD – Cash on Delivery',
                                                    'Net 7 - Payment seven days after invoice date' => 'Net 7 - Payment seven days after invoice date',
                                                    'Net 10 - Payment ten days after invoice date' =>'Net 10 - Payment ten days after invoice date'
                                                    ,
                                                    'Net 30 - Payment 30 days after invoice date' => 'Net 30 - Payment 30 days after invoice date',
                                                    'Net 60 - Payment 60 days after invoice date' => 'Net 60 - Payment 60 days after invoice date',
                                                    'Net 90 - Payment 90 days after invoice date' => 'Net 90 - Payment 90 days after invoice date'),
                                                'label' => false,
                                                'class' => 'form-control required',
                                                'empty' => '--Please Select Payment Term--'
                                            ));

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

                            <section class="cloneMe addressSection">
                                <header class="main-box-header clearfix">
                                    <h1>Company Address</h1>
                                </header>
                                 <div class="main-box-body clearfix">

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
                                                echo $this->Form->input('Address.0.address1', array('class' => 'form-control item_type required',
                                                    'alt' => 'address1',
                                                    'label' => false));
                                            ?>
                                        </div>
                                    </div>

                                   <!--  <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Address(2)</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('Address.0.address2', array('class' => 'form-control item_type',
                                                    'alt' => 'address2',
                                                    'label' => false));
                                            ?>
                                        </div>
                                    </div> -->

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
                                                echo $this->Form->input('Address.0.zip_code', array('class' => 'form-control number',
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
                                            <button type="button" class="remove-field btn btn-danger" onclick="removeClone('addressSection')"><i class="fa fa-minus"></i> </button>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>  
                </div>

                <div class="row ">
                    <div class="col-lg-12">
                        <div class="main-box">

                            <header class="main-box-header clearfix">
                                <h1>Company Number</h1>
                            </header>
                            
                            <div class="main-box-body clearfix ">
                                <section class="cloneMe1 contact_section">
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label">Contact Number</label>
                                        <div class="col-lg-2">
                                            <?php 
                                                echo $this->Form->input('Contact.0.type', array(
                                                    'options' => array('Work', 'Home', 'Business'),
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
                                            <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contact_section')"><i class="fa fa-minus"></i> </button>
                                        </div>
                                    </div>
                                    <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                </section>
                                
                            </div> 
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
                                <section class="cloneMe1 email_section" data-model ="Contact">
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"> Email Address</label>
                                        <div class="col-lg-2">
                                            <?php 
                                                echo $this->Form->input('Email.0.type', array(
                                                    'options' => array('Work', 'Home', 'Business'),
                                                    'label' => false,
                                                    'class' => 'form-control',
                                                    'empty' => false
                                                )); ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <?php 
                                                echo $this->Form->input('Email.0.email', array('class' => 'form-control email','label' => false));
                                            ?>
                                            <span class="lighter-color2">Ex. example@email.com</span>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('email_section',this)"><i class="fa fa-plus"></i></button>
                                            <button type="button" class="remove-field btn btn-danger" onclick="removeClone('email_section')"><i class="fa fa-minus"></i> </button>
                                        </div>
                                    </div>
                                    <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                </section>
                            </div> 
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
                                <div class="main-box-body clearfix">

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Firstname</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPersonData.0.ContactPerson.0.firstname', array('class' => 'form-control required','label' => false));
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
                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Lastname</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPersonData.0.ContactPerson.0.lastname', array('class' => 'form-control required','label' => false));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Position</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('ContactPersonData.0.ContactPerson.0.position', array('class' => 'form-control required','label' => false));
                                            ?>
                                        </div>
                                    </div>
                                </div> 

                                <hr>
               
                                <header class="main-box-header clearfix">
                                    <h1>Contact Person Number</h1>
                                </header>
                            
                                <div class="main-box-body clearfix">
                                    <section class="cloneMe1 contactPersonNumber_section" id="Bien">
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"> Contact Number</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.Contact.0.type', array(
                                                        'options' => array('Work', 'Home', 'Business'),
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
                                                <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contactPersonNumber_section')"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>
                                        <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                    </section>
                                   
                                </div> 
                     
                                <hr>

                                <header class="main-box-header clearfix">
                                    <h1>Contact Person Email</h1>
                                </header>
                            
                                <div class="main-box-body clearfix">
                                    <section class="cloneMe1 contactPersonEmail_section">
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
                                                <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contactPersonEmail_section')"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>
                                       <!--  <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;"> -->
                                    </section>
                                </div>

                                
                              <!--   <section class="cloneMe1 contactPersonAddress_section">
                                    <header class="main-box-header clearfix">
                                        <h1>Contact Person Address</h1>
                                    </header>
                            
                                    <div class="main-box-body clearfix">
                                        
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Address(1)</label>
                                                <div class="col-lg-2">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.0.Address.0.type', array(
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
                                                        echo $this->Form->input('ContactPersonData.0.Address.0.address1', array('class' => 'form-control item_type required','label' => false));
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
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> City</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.0.Address.0.city', array('class' => 'form-control required','label' => false));
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> State Province</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.0.Address.0.state_province', array('class' => 'form-control required','label' => false));
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Zip Code</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('ContactPersonData.0.Address.0.zip_code', array('class' => 'form-control required number','label' => false,'type' => 'text'));
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Country</label>
                                                <div class="col-lg-9">
                                                    <?php echo( $this->Country->select('ContactPersonData.0.Address.0.country',null,array('class' => 'form-control required')));?> 
                                                </div>
                                            </div>
                                            <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                        
                                    
                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                                <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('contactPersonAddress_section',this)"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contactPersonAddress_section')"><i class="fa fa-minus"></i> </button>
                                            </div>
                                           
                                    </div>
                                </section> -->
                             
                            
                            </section>
                        </div>
                    </div>  
                </div>
                    
                <hr>

                <div class="row">
                    <div class="multi-field-wrapper clearfix">
                        <div class="multi-fields clearfix">
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

                <?php echo $this->Form->end(); ?>
                <script>
                $("#CompanyAddForm").validate();
                </script>

            </div>
        </div>
    </div>
</div>