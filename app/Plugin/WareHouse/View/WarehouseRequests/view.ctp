<?php $this->Html->addCrumb('Request List', array('controller' => 'requests', 'action' => 'request_list')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'requests', 'action' => 'view')); ?>

<div style="clear:both"></div>

<?php echo $this->element('ware_house_option'); ?><br><br>

<div class="filter-block pull-right">
                    
    <?php 
        
         echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg " ></i>  Go Back ', array('controller' => 'warehouse_requests','action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
            ?> &nbsp;

            <?php  echo $this->Html->link('<i class="fa fa-print fa-lg"></i>  Print ', array('controller' => 'warehouse_requests','action' => 'print_request', $requestData['WarehouseRequest']['id']),array('class' =>'btn btn-primary pull-right','escape' => false));
            ?>
     
        <?php 

            if($requestData['WarehouseRequest']['status_id'] == 8){

                 echo $this->Html->link('<i class="fa fa-check fa-lg"></i> Approve ', array('controller' => 'warehouse_requests','action' => 'approve', $requestData['WarehouseRequest']['id']),array('class' =>'btn btn-primary pull-right','escape' => false));

        } 

        echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit', array('controller' => 'warehouse_requests', 'action' => 'edit_request',$requestData['WarehouseRequest']['id']),array('class' =>'btn btn-primary pull-right','escape' => false));
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
                        
                            <h1 style = "margin-bottom:0px; margin-top:0px; padding-top:0px;"><b>REQUISITION SLIP</b></h1>
                        
                        </td>
                    </tr>

                </table>    
               
               <br><br>
                
            <div class="main-box-body clearfix">
                

            <table border="0" width="100%" style = "margin:0px; padding:0px; line-height:0px;">
                <tbody>
                
                    <tr>
                        <td></td>
                        <td><b>Position: </b><?php echo $roleData[$userData['User']['role_id']];?></td>
                        <td ></td>
                        <td align="right" style="line-height:8px;"><b>No: </b>RQ<?php echo $requestData['WarehouseRequest']['uuid']; ?><br><br><br><b>Date: </b><?php echo (new \DateTime())->format('d/m/Y') ?><br></td>
                    </tr>

                </tbody>
            </table>
            <br>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th class="text-center">Item Decription</th>
                            <th class="text-center">Qty Needed</th>
                            <th class="text-center">UOM</th>
                            <th class="text-center">Current Stock</th>
                            <th class="text-center">Date Needed</th>
                            <th class="text-center">Purpose</th>
                            <th class="text-center">Remarks</th>
                        </thead>
                        <?php   foreach ($requestData['RequestItem'] as $key => $value) { $key++ ?>
                           
                            <tr>
                                <td><?php echo $key ?></td>
                                <td class="text-center"><?php echo $value['name']?></td>
                                <td class="text-center">
                                    <?php  
                                    if(!empty($value['quantity'])){ 
                                        echo $value['quantity']?>
                                <?php } ?>

                                </td>

                                 <td class="text-center">
                                    <?php  
                                    if(!empty($unitData[$value['quantity_unit_id']])){ 
                                    echo $unitData[$value['quantity_unit_id']];
                                   } ?>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"><?php  
                                   if(!empty($requestData['remarks'])){ 
                                    echo$requestData['remarks'];
                                   } ?></td>
                                
                            </tr>
                        <?php 
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




                        </tr>
                    </table>
                       
                    <table class="table table-bordered">
                        <thead>
                            <th class="text-center">Requested by :</th>
                            <th class="text-center">Approved by :</th>
                            <th class="text-center">Issued by :</th>
                            <th class="text-center">Received by :</th>
                        </thead>
                        
                        <tr>
                            <td class="text-center"><?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></td>
                            <td class="text-center">Shou Yi Yu</td>
                            <td class="text-center"></td>
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
