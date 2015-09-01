<?php if(!empty($requestData)){

 foreach ($requestData as $requestList ): ?>


        <tr class="">

            <td class="">
                <?php echo ucfirst($requestList['WarehouseRequest']['uuid']) ?>  
            </td>

            <td class="">

                <?php if(!empty($requestList['WarehouseRequest']['name'])){ 

                  echo ucfirst($requestList['WarehouseRequest']['name']); 

                } ?>

            </td>

            <td> 

                <?php echo ucfirst($userName[$requestList['WarehouseRequest']['created_by']]) ?>

            </td>

            <td class="text-center">

                <?php 
                    if($requestList['WarehouseRequest']['status_id'] == 8){ 
                        echo "<span class='label label-default'>Waiting</span>";
                    }
                    if($requestList['WarehouseRequest']['status_id'] == 1){ 
                        echo "<span class='label label-info'>Approved</span>";
                    }
                    if($requestList['WarehouseRequest']['status_id'] == 12){ 
                        echo "<span class='label label-success'>Deducted</span>";
                    }
                    if($requestList['WarehouseRequest']['status_id'] == 0){ 
                        echo "<span class='label label-success'>Purchase Order</span>";
                    }
                ?>

            </td>

            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array('controller' => 'warehouse_requests', 'action' => 'view',$requestList['WarehouseRequest']['id']),array('class' =>' table-link','escape' => false,'title'=>'Review Request'));
                ?>

                <!-- <a data-toggle="modal" href="#myModalOutRecord<?php echo $requestList['WarehouseRequest']['id'] ?>" class="table-link"><i class="fa fa-lg  "></i><span class="fa-stack ">
                                      <i class="fa fa-square fa-stack-2x "></i>
                                      <i class="fa  fa-sign-in fa-stack-1x fa-inverse "></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> OutRecord </font></span></a> -->

            
                    </td>

            <!-- <div class="modal fade" id="myModalOutRecord<?php echo $requestList['WarehouseRequest']['id'] ?>" role="dialog" >
                <div class="modal-dialog">
                    <div class="modal-content margintop">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Out Record</h4>
                        </div> 

                        <div class="modal-body">

                            <?php 

                            $id = $requestList['WarehouseRequest']['id'];

                                echo $this->Form->create('OutRecord',array(
                                    'url'=>(array('controller' => 'warehouse_requests','action' => 'out_record', $id)),'class' => 'form-horizontal')); 
                            ?>

                            <br>

                            <?php foreach ($requestList['WarehouseRequestItem'] as $key => $value) {?>

                                    <div class="form-group" id="existing_items">
                                        <label class="col-lg-2 control-label">Item</label>
                                        <div class="col-lg-9">
                                            <?php 
                                                echo $this->Form->input('WarehouseRequestItem.'.$key.'.name', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'readonly' => true,
                                                                            'fields' =>array('name'),
                                                                            'value' => $value['name']));
                                            ?>
                                        </div>
                                    </div>

                                    <br>

                                     <div class="form-group" id="existing_items">
                                        <label class="col-lg-2 control-label"></label>
                                        <div class="col-lg-6">
                                            <?php 
                                                echo $this->Form->input('WarehouseRequestItem.'.$key.'.quantity', array(
                                                                            'class' => 'form-control item_type toBeLimited',
                                                                            'label' => false,
                                                                            'fields' =>array('name'),
                                                                            'value' => $value['quantity']));
                                            ?>

                                            <?php 
                                                echo $this->Form->input('WarehouseRequestItem.'.$key.'.quantitylimit', array(
                                                                            'class' => 'form-control quantityLimit',
                                                                            'label' => false,
                                                                            'type' => 'hidden',
                                                                            'fields' =>array('name'),
                                                                            'value' => $value['quantity']));
                                            ?>

                                            <?php 
                                                echo $this->Form->input('WarehouseRequestItem.'.$key.'.foreign_key', array(
                                                                            'class' => 'form-control ',
                                                                            'label' => false,
                                                                            'type' => 'hidden',
                                                                            'fields' =>array('name'),
                                                                            'value' => $value['foreign_key']));
                                            ?>

                                             <?php 
                                                echo $this->Form->input('WarehouseRequestItem.'.$key.'.model', array(
                                                                            'class' => 'form-control quantityLimit',
                                                                            'label' => false,
                                                                            'type' => 'hidden',
                                                                            'fields' =>array('name'),
                                                                            'value' => $value['model']));
                                            ?>
                                        </div>

                                        <div class="col-lg-3">
                                            <?php 
                                                echo $this->Form->input('WarehouseRequestItem.'.$key.'.quantity_unit', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'fields' =>array('name'),
                                                                            'options' => array($unitData),
                                                                            'value' => $value['quantity_unit_id']));
                                            ?>
                                        </div>


                                    </div>
                                    

                                    <br><br>

                                <?php } ?>

                                <div class="form-group" id="existing_items">
                                    <label class="col-lg-2 control-label">Remarks</label>
                                    <div class="col-lg-9">
                                        <?php 
                                            echo $this->Form->textarea('OutRecord.remarks', array(
                                                'empty' => 'None',
                                                'required' => 'required',
                                                'class' => 'form-control item_type editable limitQuantity',
                                                'label' => false
                                               
                                            ));
                                        ?>
                                    </div>
                                </div>

                                <br><br>
                                <br><br>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                </div>
                            <?php echo $this->Form->end();  ?> 
                        </div>
                    </div>
                </div>
            </div> -->
        </tr>


<?php endforeach; } ?> 