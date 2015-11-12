<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php echo $this->element('ware_house_option');  ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Order List</b></h2>

                <?php

                    echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Receive Receipt ', array('controller' => 'receivings', 'action' => 'receive_receipt'),array('class' =>'btn btn-primary pull-right ','escape' => false));
                           
                ?>

            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Purchase Order No</span></a></th>
                                <th><a href="#"><span>Supplier</span></a></th>
                                <th><a href="#"><span>Status</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php echo $this->element('purchase_order_table'); ?>
                            
                     </table>
                    <hr>
                </div>
<!-- 
            <ul class="pagination pull-right">
                    <?php 
                     echo $this->Paginator->prev('< ' . __('previous'), array('before' => 'a','tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'prev disabled'));
                     echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
                     echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'next disabled')); ?>
               
              </ul> -->
              
            </div>
    
        </div>
    </div>
</div>


<script>
    
    jQuery(document).ready(function(){
        
       setTimeout(function (){
            location.reload();
        }, 1000); 
  
</script>