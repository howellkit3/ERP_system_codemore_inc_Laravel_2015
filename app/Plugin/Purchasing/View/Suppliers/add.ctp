<?php $this->Html->addCrumb('Supplier', array('controller' => 'suppliers', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'suppliers', 'action' => 'add')); ?>
<?php echo $this->Html->script('Purchasings.add_supplier'); ?>
<?php echo $this->Html->css('purchasings/custom'); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="row">
    <div class="col-lg-12">
      
        <header class="main-box-header clearfix">
            <center>
                <h1 class="pull-left">
                    Supplier Information
                </h1>
            </center>
                    
            <?php 
                echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'suppliers', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
            ?>
               
        </header>

        <div class="main-box-body clearfix">
            <?php echo $this->Form->create('Supplier',array('url'=>(array('controller' => 'suppliers','action' => 'add')),'class' => 'form-horizontal'));?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">

                            <header class="main-box-header clearfix">
                                <h1>Supplier</h1>
                            </header>
                            
                            <div class="main-box-body clearfix">
                                
                                <div class="form-group">
                                    <label class="col-lg-2 control-label"><span style="color:red">*</span> Name</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Supplier.name', array(
                                                'class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Short Name</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Supplier.short_name', array(
                                                'class' => 'form-control col-lg-6','label' => false));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Supplier.description', array('class' => 'form-control col-lg-6 ','label' => false,'type' => 'text'));
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

                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Tin No.</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Supplier.tin', array('class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div> 
                     </div>
                </div>


                <section class="cloneMe addressSection">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box">
                                
                                <header class="main-box-header clearfix">
                                    <h1>Supplier Address</h1>
                                </header>
                                <!-- <div class="top-space"></div> -->
                                <div class="main-box-body clearfix">
                                    <div class="main-box-body clearfix">
                                        <div class="form-horizontal">
                                
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
                                                    <button type="button" style="display:none;" class="remove-field btn btn-danger remove" onclick="removeClone('addressSection')"><i class="fa fa-minus"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="cloneMe1 contact_section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box">
                                <header class="main-box-header clearfix">
                                    <h1>Supplier Number</h1>
                                </header>
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
                                                    <button type="button" style="display:none;" class="remove-field btn btn-danger remove" onclick="removeClone('contact_section')"><i class="fa fa-minus"></i> </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>   

                <section class="cloneMe1 email_section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box">
                                <header class="main-box-header clearfix">
                                    <h1>Supplier Email</h1>
                                </header>
                                <!-- <div class="top-space"></div> -->
                                <div class="main-box-body clearfix">
                                    <div class="main-box-body clearfix">
                                        <div class="form-horizontal">
                                
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
                                                    <span class="lighter-color2" style="color:#aaa;">Ex. example@email.com</span>
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneData('email_section',this)"><i class="fa fa-plus"></i></button>
                                                    <button type="button" style="display:none;" class="remove-field btn btn-danger remove" onclick="removeClone('email_section')"><i class="fa fa-minus"></i> </button>
                                                </div>
                                            </div>
                                            
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
                            <header class="main-box-header clearfix">
                                <h1>Contact person</h1>
                            </header>
                            <!-- <div class="top-space"></div> -->
                            <div class="main-box-body clearfix">
                                <div class="main-box-body clearfix">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Firstname</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.SupplierContactPerson.SupplierContactPerson.firstname', array('class' => 'form-control','label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Middlename</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.SupplierContactPerson.SupplierContactPerson.middlename', array('class' => 'form-control','label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Lastname</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.SupplierContactPerson.SupplierContactPerson.lastname', array('class' => 'form-control','label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Position</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('ContactPersonData.0.SupplierContactPerson.SupplierContactPerson.position', array('class' => 'form-control','label' => false));
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
                                <header class="main-box-header clearfix">
                                    <h1>Contact Person Number</h1>
                                </header>
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
                                                    <button type="button" style="display:none;" class="remove-field btn btn-danger remove" onclick="removeClone('contactPersonNumber_section')"><i class="fa fa-minus"></i> </button>
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
                                <header class="main-box-header clearfix">
                                    <h1>Contact Person Email</h1>
                                </header>
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
                                                    <span class="lighter-color2" style="color:#aaa;">Ex. example@email.com</span>
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('contactPersonEmail_section',this)"><i class="fa fa-plus"></i></button>
                                                    <button type="button" style="display:none;" class="remove-field btn btn-danger remove" onclick="removeClone('contactPersonEmail_section')"><i class="fa fa-minus"></i> </button>
                                                </div>
                                            </div>
                                            
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
                           
                            <div class="top-space"></div>
                            <div class="main-box-body clearfix">
                                <div class="main-box-body clearfix">
                                    <div class="form-horizontal">
                            
                                        <div class="multi-field clearfix">
                                            <div class="col-xs-2 col-md-2"></div>
                                            <div class="col-xs-2 col-md-2 2">
                                                <?php 
                                                    echo $this->Form->submit('Submit Supplier Information', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the supplier'));
                                                ?>
                                              
                                            </div>
                                            <div class="col-xs-2 col-md-2 2">
                                                <?php 
                                                   echo $this->Html->link('Cancel', array('controller' => 'suppliers', 'action' => 'index','plugin' => 'purchasing'),array('class' =>'btn btn-default','escape' => false));
                                                ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($){

        //masked inputs
        $("#SupplierTin").mask("999-999-999-999");
       

    });
    $("#SupplierAddForm").validate({
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

<!--  <div class="row">  
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
                                                <tr class="permitInput">
                                                    <td>
                                                        <?php echo $this->Form->input('Permit.0.name',array(
                                                            'label' => false,
                                                            'class' => 'input required'
                                                        )); ?>
                                                    </td>
                                                    <td><?php echo $this->Form->input('Permit.0.permit_number',array(
                                                            'label' => false,
                                                            'class' => 'required'
                                                        )); ?></td>
                                                    <td>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>    
                                                    <?php echo $this->Form->input('Permit.0.date_issued',array(
                                                            'label' => false,
                                                            'class' => 'datepick required'
                                                        )); ?></td>
                                                   <td>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                   <?php echo $this->Form->input('Permit.0.date_expired',array(
                                                            'label' => false,
                                                            'class' => 'datepick required'
                                                        )); ?></td>
                                                </tr>
                                                <tr class="add-button">
                                                    <td colspan="4">
                                                        <div class="form-group">
                                                            <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                                            <div class="col-lg-12">
                                                                <button type="button" data-model='Product' class="add-field table-link danger btn btn-success" onclick="cloneInputTable('permitInput',this)"> <i class="fa fa-plus"></i></button>
                                                                <button type="button" style="display:none;" class="remove-field btn btn-danger remove" onclick="removeCloneInputTable('permitInput')"><i class="fa fa-minus"></i> </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>  -->

                    <!-- <div class="row">  
                        <div class="col-lg-12">
                            <div class="main-box">

                                <header class="main-box-header clearfix">
                                    <h1>Business Organization</h1>
                                </header>
                                    
                                <div class="main-box-body clearfix">
                                    
                                    <div class="form-group">
                                        <label for="OrganizationTypes" class="col-lg-2 control-label">Business Organization Type</label>
                                        <div class="col-lg-9">
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
                    </div> -->

                   <!--  <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box">

                                <header class="main-box-header clearfix">
                                    <h1>Products</h1>
                                </header>
                                <section class="cloneMe productSection">
                                    <div class="form-group">
                                        <label for="OrganizationTypes" class="col-lg-2 control-label">Product</label>
                                        <div class="col-lg-9">
                                            <?php echo $this->Form->input('Product.0.name', array(
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
                                            <button type="button" style="display:none;" class="remove-field btn btn-danger remove" onclick="removeClone('productSection')"><i class="fa fa-minus"></i> </button>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div> -->
