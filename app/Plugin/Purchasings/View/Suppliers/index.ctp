<?php $this->Html->addCrumb('Suppliers', array('controller' => 'suppliers', 'action' => 'index')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>
<?php echo $this->element('purchasings_option');?><br><br>


<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Suppliers List</b></h2>

                  <div class="filter-block pull-right">
                    
                    <?php echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Supplier ', array('controller' => 'customer_sales', 'action' => 'add'),array('class' =>'btn btn-primary pull-right','escape' => false));
                     ?>
                </div>
                
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Company</span></a></th>
                                <th><a href="#"><span>Product</span></a></th>
                                <th class="text-center"><a href="#"><span>Status</span></a></th>
                                <th class="text-center"><a href="#"><span>Created</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php //echo $this->element('purchasing_order_table'); ?>

                    </table>
                    <hr>
                </div>
              
            </div>
    
        </div>
    </div>
</div>
