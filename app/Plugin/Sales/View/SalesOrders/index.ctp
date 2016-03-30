<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Clients Order', array('controller' => 'sales_orders', 'action' => 'index')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>

<?php echo $this->element('summary_header');?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <div class="filter-block">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Client Order List</b></h2>

                  <div class="form-group pull-right">
                        <?php echo $this->Form->create('SaleOrder',array('controller' => 'sales_orders','action' => 'search', 'type'=> 'get')); ?>
                            <div class="pull-left col-lg-5">
                            <input placeholder="Search..." name="data[SaleOrder][search]"class="form-control searchClientOrder"  />
                            <i class="fa fa-search search-icon"></i>
                            </div>
                            <?php 
                                echo $this->Form->input('type',array(
                                        'type' => 'select',
                                        'options' => array(
                                            'po_number' => 'PO NUMBER',
                                            'item' => 'Item',
                                            'schedule_num' => 'CO Number'
                                        ),
                                        'empty' => '-- Search CO --',
                                        'label' => false,
                                        'class' => 'form-control',
                                        'div' => 'pull-left'
                                ));
                            ?>
                            <button class="btn btn-success" id="search"> <i class="fa fa-search"></i> Search </button>
                         <?php echo $this->Form->end(); ?>
                    </div>
            </header>
        </div>
            <div class="main-box-body clearfix">
                <div class="table-responsive">

                  


                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Client Order No.</span></a></th>
                                <th><a href="#"><span>PO No.</span></a></th>
                                <th><a href="#"><span>Company</span></a></th>
                                <th><a href="#"><span>Item</span></a></th>
                                <th class="text-center"><a href="#"><span>Created</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php echo $this->element('sales_order_table'); ?>

                    </table>
                    <hr>

                    <div class="paging" id="item_type_pagination">
                                <?php
                                echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                echo $this->Paginator->numbers(array('separator' => ''));
                                echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                                ?>
                    </div>


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
<style>
.search-icon {
  right: 20px !important;
}
</style>