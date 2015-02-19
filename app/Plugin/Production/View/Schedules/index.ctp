
<?php echo $this->element('ProductionOptions');?><br><br>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Schedule List</b></h2>

                  <div class="filter-block pull-right">
                    
                    <?php echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Schedule ', array('controller' => 'schedules', 'action' => 'add'),array('class' =>'btn btn-primary pull-right','escape' => false));
                     ?>
                </div>
                
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Unique ID</span></a></th>
                                <th><a href="#"><span>Description</span></a></th>
                                <th><a href="#"><span>Start Date<br>(MM/DD/YYYY)</span></a></th>
                                <th><a href="#"><span>End Date<br>(MM/DD/YYYY)</span></a></th>
                            </tr>
                        </thead>

                        <?php echo $this->element('schedule_table'); ?>

                    </table>
                    <hr>
                </div>
              
            </div>
    
        </div>
    </div>
</div>
