<?php $this->Html->addCrumb('Request List', array('controller' => 'requests', 'action' => 'request_list')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'requests', 'action' => 'view',$requestId)); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="filter-block pull-right">
                    
    <?php

        if($userData['User']['role_id'] != 1 && $userData['User']['role_id'] != 2 && $userData['User']['role_id'] != 7 && $userData['User']['role_id'] != 16  ){

            $active = "not-active" ;
        }else {

            $active = "" ;
        }
        
        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'requests', 'action' => 'request_list'),array('class' =>'btn btn-primary pull-right ' ,'escape' => false));

        if (empty($purchased)) {

            echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print', array('controller' => 'requests', 'action' => 'print_request', $requestId),array('class' =>'btn btn-primary pull-right ','escape' => false, 'target' => '_blank'));
        

            echo $this->Html->link('<i class="fa fa fa-pencil-square-o fa-lg"></i> Create Order', array('controller' => 'requests', 'action' => 'create_order',$requestId),array('class' =>'btn btn-primary pull-right','escape' => false));

            echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Receive by Cash', array('controller' => 'requests', 'action' => 'create_order',$requestId, 1),array('class' =>'btn btn-primary pull-right','escape' => false));

            echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit', array('controller' => 'requests', 'action' => 'edit',$requestId),array('class' =>'btn btn-primary pull-right','escape' => false));

        }
    ?>
    <br><br>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            
            <br><br>

               <table width = "100%">
                    <tr>
                        <td >
                            <img src="<?php echo Router::url('/', true) ?>img/koufu_logo.jpg" alt="logo" style="width:248px;height:45px;padding-bottom:10;">
                        </td>
                        <td width = "65%">
                        
                            <h1 style = "margin-bottom:0px; margin-top:0px; padding-top:0px;"><b>PURCHASE REQUISITION </b></h1>
                        
                        </td>
                    </tr>

                </table>    
               
               <br><br>
                
            <div class="main-box-body clearfix">
                

            <table border="0" width="100%" style = "margin:10px; padding:0px; line-height:0px;">
                <tbody>
                
                    <tr>
                        <td></td>
                        <td></td>
                        <td ></td>
                        <td align="right" style="line-height:8px;"><b>No: </b>RQ<?php echo $requestData['Request']['uuid']; ?><br><br><br><b>Date: </b><?php echo date('Y/m/d') ?><br></td>
                    </tr>

                </tbody>
            </table>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th class="text-center">Item Decription</th>
                            <th class="text-center">Qty Needed</th>
                            <th class="text-center">UOM</th>
                            <th class="text-center">Current Stock</th>
                            <th class="text-center">For Purchasing</th>
                            <th class="text-center">Date Needed</th>
                            <th class="text-center">Purpose</th>
                            <th class="text-center">Remarks</th>
                        </thead>

                        <?php if(!empty($purchased)){?>

                          <?php  foreach ($requestPurchasingItem as $key => $value) {   ?>

                            <?php $key++ ?> 

                            <?php $specs1 = !empty($value['RequestItem']['size1']) ? $value['RequestItem']['size1'] . " " . $unitData[$value['RequestItem']['size1_unit_id']] : "";

                                $specs2 = !empty($value['RequestItem']['size2']) ? " x " . $value['RequestItem']['size2'] . " " . $unitData[$value['RequestItem']['size2_unit_id']] : "";

                                $specs3 = !empty($value['RequestItem']['size3']) ? " x " .  $value['RequestItem']['size3'] . " " . $unitData[$value['RequestItem']['size3_unit_id']] : "";

                                $specsAll = $specs1 . " " . $specs2  . " " . $specs3 ;

                                $nameWithSpecs = $value['RequestItem']['name'] . " " . $specsAll;

                            ?>
                                    <tr>
                                        <td><?php echo $key ?></td>
                                        <td class="text-center"><?php echo $nameWithSpecs?></td>
                                        <td class="text-center">
                                            <?php  
                                            if(!empty($value['RequestItem']['quantity'])){ 
                                                echo $value['RequestItem']['quantity']?>
                                        <?php } ?>

                                        </td>

                                         <td class="text-center">
                                            <?php  
                                            if(!empty($unitData[$value['RequestItem']['quantity_unit_id']])){ 
                                            echo $unitData[$value['RequestItem']['quantity_unit_id']];
                                           } ?>
                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center" style ="font-size:70%;"><?php echo date("Y-m-d", strtotime($value['RequestItem']['date_needed'])) ?></td>
                                        <td class="text-center"><?php echo $value['RequestItem']['purpose'] ?></td>
                                        <td class="text-center"><?php echo $value['RequestItem']['remarks'] ?></td>
                                        
                                    </tr>
                            <?php 
                                    } 
                                
                            }else{ ?>

                                <?php  foreach ($requestPurchasingItem as $key => $value) {  $key++ ?>

                                    <?php if($value['RequestItem']['status_id'] != 1 ){

                                        $specs1 = !empty($value['RequestItem']['size1']) ? $value['RequestItem']['size1'] . " " . $unitData[$value['RequestItem']['size1_unit_id']] : "";

                                        $specs2 = !empty($value['RequestItem']['size2']) ? " x " . $value['RequestItem']['size2'] . " " . $unitData[$value['RequestItem']['size2_unit_id']] : "";

                                        $specs3 = !empty($value['RequestItem']['size3']) ? " x " .  $value['RequestItem']['size3'] . " " . $unitData[$value['RequestItem']['size3_unit_id']] : "";

                                        $specsAll = $specs1 . " " . $specs2  . " " . $specs3 ;

                                        $nameWithSpecs = $value['RequestItem']['name'] . " " . $specsAll;

                                        ?>
                                            <tr>
                                                <td><?php echo $key ?></td>
                                                <td class="text-center"><?php echo $nameWithSpecs?></td>
                                                <td class="text-center">
                                                    <?php  
                                                    if(!empty($value['RequestItem']['quantity'])){ 
                                                        echo $value['RequestItem']['quantity']?>
                                                <?php } ?>

                                                </td>

                                                 <td class="text-center">
                                                    <?php  
                                                    if(!empty($unitData[$value['RequestItem']['quantity_unit_id']])){ 
                                                    echo $unitData[$value['RequestItem']['quantity_unit_id']];
                                                   } ?>
                                                </td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center" style ="font-size:70%;"><?php echo date("Y-m-d", strtotime($value['RequestItem']['date_needed'])) ?></td>
                                                <td class="text-center"><?php echo $value['RequestItem']['purpose'] ?></td>
                                                <td class="text-center"><?php echo $value['RequestItem']['remarks'] ?></td>
                                                
                                            </tr>
                                    <?php 
                                            } 
                                        }
                             } ?>
                        <tr>
                            <td> </td>
                            <td class="text-center">------END------</td>
                            <td class="text-center"> </td>
                            <td class="text-center"> </td>
                            <td class="text-center"> </td>
                            <td class="text-center"> </td>
                            <td class="text-center"> </td>
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
                            <td class="text-center">Ms. Carryl Yu</td>
                            <td class="text-center"></td>
                        </tr>
                        
                    </table>
                    <div class = " pull-right ">
                        <label font-size:60%;>
                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KP-FR-LG1-001 R0 <br>Effective Date: 10 Aug 2015 
                        </label>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
