<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Purchasing Orders', array('controller' => 'purchasing_orders', 'action' => 'index')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Sales Order List</b></h2>
                
                <div class="filter-block pull-right">
                    <?php
                       //echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Make Quotation ', array('controller' => 'quotations', 'action' => 'create'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
                </div>
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Quotation Name</span></a></th>
                                <!-- <th><a href="#"><span>Company</span></a></th> -->
                                <th class="text-center"><a href="#"><span>Status</span></a></th>
                                <th class="text-center"><a href="#"><span>Created</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php echo $this->element('sales_order_table'); ?>

                    </table>
                    <hr>
                </div>
                <!-- <ul class="pagination pull-right">
                    <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                </ul> -->
            </div>
    
        </div>
    </div>
</div>
