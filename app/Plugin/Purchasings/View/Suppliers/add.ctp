<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'customer_sales', 'action' => 'add')); ?>
<?php echo $this->Html->script('Purchasings.add_supplier'); ?>
<?php echo $this->Html->css('purchasings/custom'); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
        	   <?php //echo $this->Session->flash(); ?>
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
                  <?php echo $this->Form->create('Supplier',array('url'=>(array('controller' => 'suppliers','action' => 'add')),'class' => 'form-horizontal'));?>

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

                                 <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Email.email', array('class' => 'form-control col-lg-6','label' => false));
                                        ?>
                                    </div>
                                </div>
                                
                                <!-- <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 control-label">TIN</label>
                                    <div class="col-lg-9">
                                        <?php
                                            echo $this->Form->input('Supplier.tin', array('class' => 'form-control col-lg-6','label' => false));
                                        ?>
                                    </div> -->
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
                                     <div class="main-box-body clearfix">

                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-2 control-label">Address(1)</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('Address.0.type', array(
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
                                                    echo $this->Form->input('Address.0.address1', array('class' => 'form-control item_type required',
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
                                                    echo $this->Form->input('Address.0.city', array('class' => 'form-control required',
                                                        'alt' => 'city',
                                                        'label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">State Province</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('Address.0.state_province', array('class' => 'form-control required',
                                                        'alt' => 'state_province',
                                                        'label' => false));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label">Zip Code</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                    echo $this->Form->input('Address.0.zip_code', array('class' => 'form-control required number',
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
                                                                        <button type="button" class="remove-field btn btn-danger" onclick="removeCloneInputTable('permitInput')"><i class="fa fa-minus"></i> </button>
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
                                                <?php echo $this->Form->input('Organization.type', array(
                                                        'class' => 'form-control col-lg-6 required org select_type',
                                                        'label' => false,
                                                        'data-change' => 'business-organization-others',
                                                        'options' => array(
                                                            'single_proprietorship' => 'Single Proprietorship',
                                                            'partnership' => 'Partnership',
                                                            'cooperative' => 'Cooperative',
                                                            'corporation' => 'Corporation',
                                                            'others' => 'Others'
                                                            ),

                                                         'format' => array('before', 'input', 'between', 'label', 'after', 'error'), 
                                                        ));
                                                ?>
                                                
                                            </div>
                                        </div>
                                    <div class="form-group business-organization-others">
                                        <label for="OrganizationTypes" class="col-lg-2 control-label"> </label>
                                                <div class="col-lg-9">
                                                <?php echo $this->Form->input('Organization.type', array(
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
                                                            'Manufacturing',
                                                            'Merchandising',
                                                            'Distributor',
                                                            'Service Company',
                                                            'others' => 'Others'
                                                            )
                                                        ));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group business-type-others">
                                               <label for="OperationsTypeOthers" class="col-lg-2 control-label">    </label>
                                                <div class="col-lg-9">
                                                        <?php echo $this->Form->input('Organization.type', array(
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
                                            <button type="button" class="remove-field btn btn-danger" onclick="removeClone('productSection')"><i class="fa fa-minus"></i> </button>
                                        </div>
                                      </div>
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
                                  <!--   <button type="button" class="btn btn-success pull-right" onclick="validateForm('CompanyAddForm')">Submit Customer Information</button> -->
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'purchasings', 'action' => 'index'),array('class' =>'btn btn-primary','escape' => false));
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
