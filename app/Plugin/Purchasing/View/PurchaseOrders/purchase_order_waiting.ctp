<div class="row purchase-order">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Purchase Order List</b></h2>

                    <div class="filter-block pull-right">
                        <div class="form-group pull-left">
                            
                                <input placeholder="Search..." class="form-control searchOrder " val = "1" />
                                <i class="fa fa-search search-icon"></i>
                            
                        </div>
                        <?php

                             echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'suppliers', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                           
                        ?>
                    </div>  

                  <!-- <div class="filter-block pull-right">
                    
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'suppliers', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                     ?>
                </div> -->
                
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                               <!--  <th>Purchase Order No</th> -->
                                <th>Purchase Order No.</th>
                                <th>Request No.</th>
                                <th>Supplier</th>
                                <th>Prepared by</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody aria-relevant="all" aria-live="polite" class="requestFields" role="alert" >
                          
                                <?php echo $this->element('purchase_order_table'); ?>
                         
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>

                       
                            
                     </table>
                    <hr>
                </div>

                <div class="paging" id="item_type_pagination">
                    <?php
                    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                    echo $this->Paginator->numbers(array('separator' => ''));
                    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                    ?>
                </div>
              
            </div>
    
        </div>
    </div>
</div>
