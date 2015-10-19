<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php echo $this->element('ware_house_option');?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Received Order List</b></h2>

            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Receive No</span></a></th>
                                <th><a href="#"><span>Purchase Order No.</span></a></th>
                                <th><a href="#"><span>Delivery No</span></a></th>
                                <th><a href="#"><span>Supplier</span></a></th>
                                <th><a href="#"><span>Received</span></a></th>
                                <th class="text-center"><a  href="#"><span>Status</span></a></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <?php echo $this->element('received_table'); ?>
    
                     </table>
                    <hr>
                </div>
 
                <div class="paging" id="dr_pagination">
                    
                    <?php
                        echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'DeliveredOrder','model' => 'DeliveredOrder'), null, array('class' => 'disable','model' => 'DeliveredOrder'));
                        echo $this->Paginator->numbers(array('separator' => '','paginate' => 'DeliveredOrder'), array('paginate' => 'DeliveredOrder'));
                        echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'DeliveredOrder','model' => 'DeliveredOrder'), null, array('class' => 'disable'));
                    ?>
                </div>
              
            </div>
    
        </div>
    </div>
</div>
