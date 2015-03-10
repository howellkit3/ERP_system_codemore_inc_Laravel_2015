<?php echo $this->element('deliveries_options'); ?><br><br>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Delivery Details</b></h2>
                
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Sales Order</span></a></th>
                                <th><a href="#"><span>Status</span></a></th>
                                <th><a href="#"><span>Action</span></a></th>
                                
                            </tr>
                        </thead>
                          <?php 
                            if(!empty($salesId)){
                                foreach ($salesId as $salesIdList): ?>

                                    <tbody aria-relevant="all" aria-live="polite" role="alert">

                                        <tr class="">

                                            <td class="">
                                                <?php echo $salesIdList['Delivery']['sales_order_id']; ?>  
                                            </td>

                                            <td class="">
                                                
                                                 <?php echo $salesIdList['Delivery']['status'];?>  
                                            </td>

                                            <td>
                                                <?php
                                                    echo $this->Html->link('<span class="fa-stack">
                                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                                            <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                                            </span> ', array(
                                                                            'controller' => 'Deliveries', 
                                                                            'action' => 'delivery_info'
                                                                            //$scheduleDataList['Schedule']['sales_order_id'] 
                                                                                        ), array(
                                                                            'class' =>' table-link',
                                                                            'escape' => false,
                                                                            'title'=>'View Information'
                                                                        ));

                                                ?>

                                            </td>
                                        </tr>

                                    </tbody>
                            <?php 
                                endforeach; 
                            } 
                             ?> 
                        
                    </table>
                    <hr>
                </div>
            </div>
    
        </div>
    </div>
</div>