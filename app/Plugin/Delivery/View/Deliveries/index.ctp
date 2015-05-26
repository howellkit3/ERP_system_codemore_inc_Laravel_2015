<?php echo $this->element('deliveries_options'); ?><br><br>
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

                        <?php echo $this->element('schedule_requests_table'); ?>
                      
                    </table>
                    <hr>
                </div>
            </div>
    
        </div>
    </div>
</div>