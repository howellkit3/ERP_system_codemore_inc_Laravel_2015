<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'customer_sales', 'action' => 'add')); ?>
<div class="row">
    <div class="col-lg-6">
        <div class="main-box">
            <header class="main-box-header clearfix">
                <h2><u>Customer Information</u></h2>
            </header>
            
            <div class="main-box-body clearfix">

                <?php echo $this->Form->create('Customer',array('url'=>(array('controller' => 'customer_sales','action' => 'add'))));?>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Company Name</label>
                        <?php 
                            echo $this->Form->input('Company.company_name', array('class' => 'form-control','label' => false,'placeholder' => 'Company Name'));
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Company Address</label>
                        <?php 
                            echo $this->Form->input('Company.company_address', array('class' => 'form-control','label' => false,'placeholder' => 'Company Address'));
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">State Province</label>
                        <?php 
                            echo $this->Form->input('Company.state_province', array('class' => 'form-control','label' => false,'placeholder' => 'State Province'));
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Company Contact</label>
                        <?php 
                            echo $this->Form->input('Company.company_contact', array('class' => 'form-control','label' => false,'placeholder' => 'Company Contact'));
                        ?>
                    </div>

                    <header class="main-box-header clearfix">
                        <h2><u>Contact Information</u></h2>
                    </header>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Firstname</label>
                        <?php 
                            echo $this->Form->input('Customer.firstname', array('class' => 'form-control','label' => false,'placeholder' => 'Firstname'));
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Middlename</label>
                        <?php 
                            echo $this->Form->input('Customer.middlename', array('class' => 'form-control','label' => false,'placeholder' => 'Middlename'));
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Lastname</label>
                        <?php 
                            echo $this->Form->input('Customer.lastname', array('class' => 'form-control','label' => false,'placeholder' => 'Lastname'));
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <?php 
                            echo $this->Form->input('Customer.email', array('class' => 'form-control','label' => false,'placeholder' => 'Email'));
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Contact Number</label>
                        <?php 
                            echo $this->Form->input('Customer.contact_number', array('class' => 'form-control','label' => false,'placeholder' => 'Contact Number'));
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Address</label>
                        <?php 
                            echo $this->Form->input('Customer.address', array('class' => 'form-control','label' => false,'placeholder' => 'Address'));
                        ?>
                    </div>

                    <div class="form-group">
                    
                        <?php 
                            echo $this->Form->submit('Add Customer Info', array('class' => 'btn btn-success',  'title' => 'Click here to add the customer') );
                        ?>
                        
                    </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>