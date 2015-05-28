<?php echo $this->element('deliveries_options'); ?><br><br>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Delivery Monitoring</b></h2>
                
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Client Order</span></a></th>
                                <th><a href="#"><span>P.O. Number</span></a></th>
                                <th><a href="#"><span>Customer Name</span></a></th>
                                <th><a href="#"><span>Item Name</span></a></th>
                                <th><a href="#"><span>Schedule</span></a></th>
                                <th><a href="#"><span>Location</span></a></th>
                                <th><a href="#"><span>Status</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php echo $this->element('schedule_requests_table'); ?>  
                    </table>
                    <hr>

                    <div class="paging" id="item_type_pagination">
                            <?php
                           
                            echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'ItemTypeHolder','model' => 'ItemTypeHolder'), null, array('class' => 'disable','model' => 'ItemTypeHolder'));
                            echo $this->Paginator->numbers(array('separator' => '','paginate' => 'ItemTypeHolder'), array('paginate' => 'ItemTypeHolder'));
                            echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'ItemTypeHolder','model' => 'ItemTypeHolder'), null, array('class' => 'disable'));

                            ?>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>