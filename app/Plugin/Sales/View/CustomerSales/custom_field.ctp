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
    <div class="col-lg-8">
        <div class="main-box">
            <header class="main-box-header clearfix">
                <h2><u>Quotation Field</u></h2>
            </header>
            
            <div class="main-box-body clearfix">

                <?php echo $this->Form->create('Customer',array('url'=>(array('controller' => 'customer_sales','action' => 'add'))));?>
            <div class="row">
                <div class="multi-field-wrapper clearfix">
                    <div class="multi-fields clearfix">
                    <div class="multi-field clearfix">
                        <div class="col-xs-6 col-md-4">Company Name</div>
                        <div class="col-xs-6 col-md-4 2">
                        <?php 
                        echo $this->Form->input('Company.company_name[]', array('class' => 'form-control col-lg-5','label' => false,'placeholder' => 'Company Name'));
                        ?>
                        </div>
                        <div class="col-xs-6 col-md-4 1">    
                        <button type="button" class="add-field table-link danger btn btn-success col-lg-1"> <i class="fa fa-plus"></i></button>
                        <button type="button" class="remove-field btn btn-danger col-lg-1"><i class="fa fa-minus"></i> </button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <script>
        
            </script>
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
<?php echo $this->Html->script(array('jquery','custom'));?>