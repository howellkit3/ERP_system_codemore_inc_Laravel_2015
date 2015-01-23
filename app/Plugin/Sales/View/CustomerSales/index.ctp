<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
    <div style="clear:both"></div>
        <div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
            <ul class="nav navbar-nav pull-left">
                <li class="dropdown hidden-xs">
                    <a data-toggle="dropdown" class="btn dropdown-toggle">
                        <span class="count">Quotation</span>
                    </a>
                    <ul class="dropdown-menu notifications-list">
                        <li class="pointer">
                            <div class="pointer-inner">
                                <div class="arrow"></div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown hidden-xs">
                    <a data-toggle="dropdown" class="btn dropdown-toggle">
                        <span class="count">Settings</span>
                    </a>
                    <ul class="dropdown-menu notifications-list messages-list">
                        <li class="item-footer">
                           <!--  <a href="#">
                            </a> -->
                            <?php echo $this->Html->link(__('Add Custom field'), array('controller' => 'customer_sales','action' => 'custom_field')); ?>
                        </li>
                    </ul>
                </li>
           
            </ul>
        </div>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix">
            <header class="main-box-header clearfix">
                <h2 class="pull-left">Customers List</h2>
                
                <div class="filter-block pull-right">
                    
                    <?php

                        echo $this->Html->link('<i class="fa fa-plus-circle fa-lg"></i> Add Customer ', array('controller' => 'customer_sales', 'action' => 'add'),array('class' =>'btn btn-primary pull-right','escape' => false));
                       
                    ?>
                </div>
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Company Name</span></a></th>
                                <th><a href="#"><span>Company Address</span></a></th>
                                <th><a href="#"><span>State province</span></a></th>
                                <th><a href="#"><span>Company Contact</span></a></th>
                                <th><a href="#"><span>Contact Person</span></a></th>
                                <th><a href="#"><span>Email</span></a></th>
                                <th><a href="#"><span>Contact Number</span></a></th>
                                <th><a href="#"><span>Address</span></a></th>
                                <th><a href="#"><span>Action</span></a></th>
                               
                            </tr>
                        </thead>

                        <?php echo $this->element('customer_table'); ?>

                    </table>
                    <hr>
                </div>
                <ul class="pagination pull-right">
                    <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                </ul>
            </div>
    
        </div>
    </div>
</div>
