<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php  echo $this->Html->script('WareHouse.date_range');?>
<?php echo $this->element('ware_house_option');?>


<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Out-Record List</b></h2>

                <div class="form-group col-md-3 pull-left">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input placeholder="Date Filter" name="from_date" data="1" type="text" class="form-control myDateRange datepickerDateRange" id="datepickerDateRange" >
                                            </div>
                                        </div>

                 <?php
                     echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Export ', array('controller' => 'warehouse_requests', 'action' => 'print_deducted_summary'),array('class' =>'btn btn-primary pull-right','escape' => false));
                       
                    ?>

            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class = "text-center"><a href="#"><span>Sequence No.</span></a></th>
                                <th class = "text-center"><a href="#"><span>Request No.</span></a></th>
                                <th class = "text-center"><a href="#"><span>Remarks</span></a></th>
                                <th class = "text-center"><a href="#"><span>Issued by</span></a></th>
                                <th class = "text-center"><a href="#"><span>Issued</span></a></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                          <tbody aria-relevant="all" class="dateRangeAppend" >
                        </tbody> 

                        <tbody aria-relevant="all" class="summaryReport"> 
                             <?php echo $this->element('out_record_table'); ?>
                        </tbody> 
                                                    
                     </table>
                    <hr>
                </div>
 
            <ul class="pagination pull-right">
                    <?php 
                     echo $this->Paginator->prev('< ' . __('previous'), array('before' => 'a','tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'prev disabled'));
                     echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
                     echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'next disabled')); ?>
               
              </ul> 
              
            </div>
    
        </div>
    </div>
</div>

<script>
        
    jQuery(document).ready(function($){

        $('.daterange').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.datepickerDateRange').daterangepicker();

    
    });


</script>

<style>

    .summayReport{


    }

</style>

