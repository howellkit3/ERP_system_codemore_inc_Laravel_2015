<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php echo $this->element('ware_house_option');?>


<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Stock List</b></h2>

            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class = "text-center"><a href="#"><span>Stock No</span></a></th>
                                <th class = "text-center"><a href="#"><span>Name</span></a></th>
                                <th class = "text-center"><a href="#"><span>Quantity</span></a></th>
                                <th class = "text-center"><a href="#"><span>Location</span></a></th>
                                <!-- <th class = "text-center"><a href="#"><span>Status</span></a></th> -->
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <?php echo $this->element('stocks_table'); ?>

                                                    
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
