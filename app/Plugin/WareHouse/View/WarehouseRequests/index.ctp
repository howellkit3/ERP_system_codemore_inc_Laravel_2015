<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php echo $this->element('ware_house_option');?>

      
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">

          <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Request List</b></h2>
                
                <div class="filter-block pull-right">
                    <div class="form-group pull-left">
                        
                            <input placeholder="Search..." class="form-control searchRequest "  />
                            <i class="fa fa-search search-icon"></i>
                        
                    </div>
                    <?php

                         echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Request ', array('controller' => 'warehouse_requests', 'action' => 'create'),array('class' =>'btn btn-primary pull-right','escape' => false));
                       
                    ?>
                </div>
            </header>

            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Request #</th>
                                <th>Name</th>
                                <th>Prepared By</th>
                                <th>Deducted</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="requestFields" role="alert" >
                          
                        <?php echo $this->element('request_table'); ?>
                         
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>
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

<script>
    
    jQuery(document).ready(function(){
        
       setTimeout(function (){
            location.reload();
        }, 1000); 

    
  
</script>