<div class="users form">
    <?php
        echo $this->Html->link( "Sales",   array('plugin' => 'sales', 'controller' => 'sales', 'action' => 'index'));
        echo "---";
        echo $this->Html->link('Add', array('plugin' => 'sales', 'controller' => 'customers', 'action' => 'add'));
        echo "---";
        //echo $this->Html->link( "View",   array('controller' =>'sales','action'=>'') );
        echo "<br>";
        echo "<br>";
    ?>

    <div class="row">
        <div class="col-xs-12">
            <h3 class="header smaller lighter blue">Customers List</h3>
            <table aria-describedby="sample-table-2_info" id="ads-table" class="table table-striped table-bordered table-hover dataTable">
                <thead>
                    <tr role="row">
                        <th aria-label="" colspan="1" rowspan="1" aria-controls="ads-table" tabindex="0" role="columnheader" class="sorting">Company Name</th>
                        <th aria-label="" colspan="1" rowspan="1" aria-controls="ads-table" tabindex="0" role="columnheader" class="sorting">Company Address</th>
                        <th aria-label="" colspan="1" rowspan="1" aria-controls="ads-table" tabindex="0" role="columnheader" class="sorting">State province</th>
                         <th aria-label="" colspan="1" rowspan="1" aria-controls="ads-table" tabindex="0" role="columnheader" class="sorting">Company Contact</th>
                         <th aria-label="" colspan="1" rowspan="1" aria-controls="ads-table" tabindex="0" role="columnheader" class="sorting">Contact Person</th>
                        <th aria-label="" colspan="1" rowspan="1" aria-controls="ads-table" tabindex="0" role="columnheader" class="sorting">Email</th>
                        <th aria-label="" colspan="1" rowspan="1" aria-controls="ads-table" tabindex="0" role="columnheader" class="sorting">Contact Number</th>
                         <th aria-label="" colspan="1" rowspan="1" aria-controls="ads-table" tabindex="0" role="columnheader" class="sorting">Address</th>
                         <th aria-label="" colspan="1" rowspan="1" aria-controls="ads-table" tabindex="0" role="columnheader" class="sorting">Action</th>
                      
                       
                    </tr>
                </thead>
                <?php echo $this->element('customer_table'); ?>
            </table>
        </div>
    </div>
 
</div>

<?php
    if($this->Session->check('Auth.User')){
        echo $this->Html->link( "Return to Dashboard",   array('controller' => '../dashboards','action'=>'index') );
        echo "<br>";
        //echo $this->Html->link( "Customer Info",   array('action'=>'add') );

        echo "<br>";
        echo $this->Html->link( "Logout",   array('controller'=>'../users','action'=>'logout') );

    }else{
        echo $this->Html->link( "Return to Login Screen",   array('action'=>'index') );
    }
?>