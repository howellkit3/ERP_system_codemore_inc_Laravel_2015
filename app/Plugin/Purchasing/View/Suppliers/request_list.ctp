<?php $this->Html->addCrumb('Suppliers', array('controller' => 'suppliers', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Request List', array('controller' => 'suppliers', 'action' => 'request_list')); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Request List</b></h2>

                  <div class="filter-block pull-right">
                    
                    <?php echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Request ', array('controller' => 'suppliers', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                     ?>
                </div>
                
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span></span></a></th>
                                <th><a href="#"><span></span></a></th>
                                <th><a href="#"><span></span></a></th>
                                <th class="text-center"><a href="#"><span></span></a></th>
                                <th class="text-center"><a href="#"><span>Created</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php 
                        // echo $this->element('supplier_order_table',array(
                        //         'suppliers' => $suppliers
                        //     )); 
                            ?>
                            
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