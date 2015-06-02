<?php $this->Html->addCrumb('Ticketing System', array('controller' => 'ticketing_systems', 'action' => 'index')); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Ticketing Lists</b></h2>
                
                <div class="filter-block pull-right">
                  
                </div>
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Ticket id</span></a></th>
                                <th><a href="#"><span>Product No. </span></a></th>
                                <th><a href="#"><span>PO No. </span></a></th>
                                <th><a href="#"><span>Item Name </span></a></th>
                                <th><a href="#"><span>Company </span></a></th>
                                <th><a href="#"><span>Created</span></a></th>
                                <!-- <th style="text-align:center">Action</th> -->
                            </tr>
                        </thead>

                        <?php echo $this->element('ticket_table'); ?>


                    </table>
                    <hr>
                </div>
                
            </div>
    
        </div>
    </div>
</div>
<?php //echo $this->element('sql_dump'); ?>