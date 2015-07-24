<?php $this->Html->addCrumb('Request List', array('controller' => 'requests', 'action' => 'request_list')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'requests', 'action' => 'view',$requestId)); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="filter-block pull-right">
                    
    <?php 
        
        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'requests', 'action' => 'request_list'),array('class' =>'btn btn-primary pull-right','escape' => false));

        if ($requestData['Request']['status_id'] == 1) {

            echo $this->Html->link('<i class="fa fa fa-pencil-square-o fa-lg"></i> Create Order', array('controller' => 'requests', 'action' => 'create_order',$requestId),array('class' =>'btn btn-primary pull-right','escape' => false));

        }

        if ($requestData['Request']['status_id'] == 0) {

            echo $this->Html->link('<i class="fa fa-gift fa-lg"></i> Purchase Order', array('controller' => 'requests', 'action' => 'create_order',$requestId),array('class' =>'btn btn-primary pull-right disabled','escape' => false));

        }

        if ($requestData['Request']['status_id'] == 8) {

            echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i> Approved', array('controller' => 'requests', 'action' => 'approved',$requestId),array('class' =>'btn btn-primary pull-right','escape' => false));

            echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit', array('controller' => 'requests', 'action' => 'edit',$requestId),array('class' =>'btn btn-primary pull-right','escape' => false));
        }

        echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print', array('controller' => 'requests', 'action' => 'print_request', $requestId),array('class' =>'btn btn-primary pull-right','escape' => false));
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
                    <b><h2>Request Purchase Order</h2></b>
                    <br>
                </header>
            </center>

            <div class="main-box-body clearfix">
                <form class="form-horizontal" role="form">
                    
                    <div class="form-group">
                        
                        <div class="col-lg-2">
                            &emsp;&emsp;Department
                        </div>
                        <div class="col-lg-4">
                            :&emsp;Purchasing Department
                            
                        </div>
                        <div class="col-lg-3">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
                            Date : <u><?php echo date('M d, Y', strtotime($requestData['Request']['created'])); ?></u>
                        </div>
                        <div class="col-lg-3">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
                            No  : <u>RQO<?php echo $requestData['Request']['uuid']; ?></u>
                        </div>
                    </div>
                    
                </form>
            
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th class="text-center">Item Decription</th>
                            <th class="text-center">Quantity/Unit</th>
                            <th class="text-center">Remarks</th>
                        </thead>
                        <?php foreach ($requestPurchasingItem as $key => $value) {  $key++ ?>
                            <tr>
                                <td><?php echo $key ?></td>
                                <td class="text-center"><?php echo $value['PurchasingItem']['name']?></td>
                                <td class="text-center"><?php echo $value['PurchasingItem']['quantity']?>/<?php echo $unitData[$value['PurchasingItem']['quantity_unit_id']]?></td>
                                <td class="text-center"> </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td> </td>
                            <td class="text-center">------END------</td>
                            <td class="text-center"> </td>
                            <td class="text-center"> </td>
                        </tr>
                    </table>
                   
                    Note : <?php echo $requestData['Request']['remarks']; ?><br><br>
                       
                    <table class="table table-bordered">
                        <thead>
                            <th class="text-center">Requested by :</th>
                            <th class="text-center">Approved by :</th>
                            <th class="text-center">Purchased by :</th>
                        </thead>
                        
                        <tr>
                            <td class="text-center"><?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></td>
                            <td class="text-center">Shou Yi Yu</td>
                            <td class="text-center"></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
