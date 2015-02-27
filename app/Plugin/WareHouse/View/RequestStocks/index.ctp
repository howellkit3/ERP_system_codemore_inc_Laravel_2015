<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php echo $this->element('ware_house_option');?>


<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Request Stock List</b></h2>

                  <div class="filter-block pull-right">
                    
                    <?php echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Request Stock ', array('controller' => 'request_stocks', 'action' => 'add'),array('class' =>'btn btn-primary pull-right','escape' => false));
                     ?>
                </div>
             
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Description</span></a></th>
                                <th><a href="#"><span>Stock Request #</span></a></th>
                                <th class="text-center"><a href="#"><span>Created</span></a></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <?php echo $this->element('request_list_table'); ?>
                            
                     </table>
                    <hr>
                </div>
<!-- 
            <ul class="pagination pull-right">
                    <?php 
                     echo $this->Paginator->prev('< ' . __('previous'), array('before' => 'a','tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'prev disabled'));
                     echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
                     echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'next disabled')); ?>
               
              </ul> -->
              
            </div>
    
        </div>
    </div>
</div>
