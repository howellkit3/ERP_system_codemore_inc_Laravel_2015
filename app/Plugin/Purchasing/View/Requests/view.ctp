<?php $this->Html->addCrumb('Request List', array('controller' => 'requests', 'action' => 'request_list')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'requests', 'action' => 'view',$requestId)); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="filter-block pull-right">
                    
    <?php 
        
        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'requests', 'action' => 'request_list'),array('class' =>'btn btn-primary pull-right','escape' => false));

        echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i> Approved', array('controller' => 'requests', 'action' => 'approved'),array('class' =>'btn btn-primary pull-right','escape' => false));

        echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit', array('controller' => 'requests', 'action' => 'edit',$requestId),array('class' =>'btn btn-primary pull-right','escape' => false));

        echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print', array('controller' => 'requests', 'action' => 'approved'),array('class' =>'btn btn-primary pull-right','escape' => false));
    ?>
    <br><br>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            <center>
                <header class="main-box-header clearfix"><?php //echo pr($contactInfo);die; ?>
                    <h1>Kou Fu Packaging Corporation</h1>
                    <h5>Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h5>
                    <h6>
                        Tel: +63(2)5844928  &emsp;Fax: +63(2)5844952
                    </h6><br>
                    <b><h2>Purchase Order</h2></b>
                    <br>
                </header>
            </center>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>test</th>
                        <th>test</th>
                        <th>test</th>
                        <th>test</th>
                    </thead>
                    <tr>
                        <td>test</td>
                        <td>tes</td>
                        <td>test</td>
                        <td>test</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
