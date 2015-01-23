<div class="row">
    <div class="col-lg-12">
        <div id="content-header" class="clearfix">
            <div class="pull-left">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active"><span>Sales</span></li>
                </ol>
                
                <h1>Sales</h1>
            </div>

            <div class="pull-right hidden-xs">
                <div class="xs-graph pull-left">
                    <div class="graph-label">
                        <b><i class="fa fa-shopping-cart"></i> 838</b> Orders
                    </div>
                    <div class="graph-content spark-orders"></div>
                </div>

                <div class="xs-graph pull-left mrg-l-lg mrg-r-sm">
                    <div class="graph-label">
                        <b>&dollar;12.338</b> Revenues
                    </div>
                    <div class="graph-content spark-revenues"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="users form">

    <?php
       
        echo $this->Html->link('Add Customer ', array('controller' => 'customer_sales', 'action' => 'add'));
       
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