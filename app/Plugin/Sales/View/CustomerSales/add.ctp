<div class="row">
    <div class="col-lg-12">
        <div id="content-header" class="clearfix">
            <div class="pull-left">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active"><span>Sales</span></li>
                    <li class="active"><span>Add</span></li>
                </ol>
                
                <h1>Sales</h1>
            </div>

            <div class="pull-right hidden-xs">
                <div class="xs-graph pull-left">
                    <div class="graph-label">
                        <b><i class="fa fa-shopping-cart"></i> 838</b> Orders
                    </div>
                    <div class="graph-content spark-orders"></div>
                </div>

                <div class="xs-graph pull-left mrg-l-lg mrg-r-sm">
                    <div class="graph-label">
                        <b>&dollar;12.338</b> Revenues
                    </div>
                    <div class="graph-content spark-revenues"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->Session->flash(); ?>

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