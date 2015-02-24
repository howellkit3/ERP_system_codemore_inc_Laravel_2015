
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Schedule Requests</b></h2>
                
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Sales Order</span></a></th>
                                <th><a href="#"><span>Schedule</span></a></th>
                                <th><a href="#"><span>Location</span></a></th>
                                <th><a href="#"><span>Status</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php 
                        if(!empty($scheduleData)){
                            foreach ($scheduleData as $scheduleDataList): ?>

                                <tbody aria-relevant="all" aria-live="polite" role="alert">

                                    <tr class="">

                                        <td class="">
                                            <?php echo $scheduleDataList['Schedule']['sales_order_id']; ?>  
                                        </td>

                                        <td class="">
                                            
                                             <?php echo $scheduleDataList['Schedule']['schedule'];?>  
                                        </td>

                                        <td>
                                           <?php echo $scheduleDataList['Schedule']['location']; ?>  
                                           
                                        </td>

                                        <td>
                                           <?php echo $scheduleDataList['Schedule']['status']; ?>    
                                        </td>
                                        <td>
                                            <?php
                                                echo $this->Html->link('<span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                    </span> ', array('controller' => 'Schedules', 
                                                                        'action' => 'view',
                                                                        $scheduleDataList['Schedule']['sales_order_id'] 
                                                                    ),
                                                                    array(
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
                        } ?> 
                    </table>
                    <hr>
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