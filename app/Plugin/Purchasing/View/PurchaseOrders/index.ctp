<?php $this->Html->addCrumb('Purchase Order List', array('controller' => 'requests', 'action' => 'purchase_order_list')); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Purchase Order List</b></h2>

                  <div class="filter-block pull-right">
                    
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'suppliers', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                     ?>
                </div>
                
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Purchase Order No</th>
                                <th>Po No.</th>
                                <th>Supplier</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php echo $this->element('purchase_order_table'); ?>
                            
                     </table>
                    <hr>
                </div>

                <ul class="pagination pull-right">
                    <?php 
                     echo $this->Paginator->prev('< ' . __('previous'), array('before' => 'a','tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'prev disabled'));
                     echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
                     echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'next disabled')); ?>
               
                </ul>
              
            </div>
    
        </div>
    </div>
</div>