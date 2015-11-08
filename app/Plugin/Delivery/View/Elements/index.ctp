
            
            <div class="main-box-body clearfix ">
                <div class="table-responsive">
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr >
                                <th class="text-center"><a href="#"><span>Client Order</span></a></th>
                                <th class="text-center"><a href="#"><span>P.O. Number</span></a></th>
                                <th class="text-center"><a href="#"><span>Customer Name</span></a></th>
                                <th class="text-center"><a href="#"><span>Item Name</span></a></th>
                                <th class="text-center"><a href="#"><span>Quantity</span></a></th>
                                <th class="text-center"><a href="#"><span>P.O. Balance</span></a></th>
                                <th class="text-center"><a href="#"><span>Status</span></a></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="OrderFields" role="alert" >
                            <!-- <div class ="field"> -->
                            <?php echo $this->element('schedule_requests_table'); ?> 
                            <!-- </div> -->
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>

                       <!--  <tbody aria-relevant="all" aria-live="polite" class="" role="alert" style="display:none;">
                        </tbody> -->

                    </table>
                    <hr>
                        <div class="paging" id="dr_pagination">
                        <?php

                        echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'ClientOrder','model' => 'ClientOrder'), null, array('class' => 'disable','model' => 'ClientOrder'));
                        echo $this->Paginator->numbers(array('separator' => '','paginate' => 'ClientOrder'), array('paginate' => 'ClientOrder'));
                        echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'ClientOrder','model' => 'ClientOrder'), null, array('class' => 'disable'));
                        ?>

                        </div>
                </div>
            </div>
   