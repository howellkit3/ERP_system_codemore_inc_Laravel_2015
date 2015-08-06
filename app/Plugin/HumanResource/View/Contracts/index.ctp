<?php $this->Html->addCrumb('Contract', array('controller' => 'contracts', 'action' => 'index')); ?>
<?php echo $this->element('hr_options'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><b>Contract List</b></h2>
                
                <div class="filter-block pull-right">
                    <div class="form-group pull-left">
                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
                            <input placeholder="Search..." class="form-control searchCustomer <?php //echo $noPermission; ?>"  />
                            <i class="fa fa-search search-icon"></i>
                         <?php //echo $this->Form->end(); ?>
                    </div>
                    <?php

                        //echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Contract ', array('controller' => 'contracts', 'action' => 'add'),array('class' =>'btn btn-primary pull-right ','escape' => false));
                       
                    ?>
                   
                </div>
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr> 
                                <th><a href="#"><span>Employee Name</span></a></th>
                                <th><a href="#"><span>Position</span></a></th>
                                <th><a href="#"><span>Status</span></a></th>
                                <th><a href="#"><span>Type</span></a></th>
                                <th><a href="#"><span>Created</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="customerFields" role="alert">
                            <?php //echo $this->element('customer_table'); ?>
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" style="display:none;">
                        </tbody>
 
                    </table>
                    <hr>

                <div class="paging">
                <?php

                //echo $this->Paginator->prev('< ' . __('previous'), null, null, array('class' => 'disable'));
                //echo $this->Paginator->numbers(array('separator' => ''));
                //echo $this->Paginator->next(__('next') . ' >', null, null, array('class' => 'disable'));
                ?>
                </div>
                <?php //echo $this->Html->image('loader.gif', array('class' => 'hide', 'id' => 'loader')); ?>
                <?php //echo $this->Js->writeBuffer(); ?>
                </div>
                
            </div>
    
        </div>
    </div>
</div>
