<?php foreach ($stock_table as $stockTableList ): ?>
    
        <tr class="">

            <td class="">
                <?php echo 'WIO' . ucfirst($stockTableList['Stock']['uuid']) ?>  
            </td>

            <td class="">
                <?php echo $stockTableList['Stock']['item_id'] ?>  
            </td>

            <td class="">
                <?php echo ucfirst($supplierData[$stockTableList['Stock']['supplier_id']]) ?>
            </td>

            <td class="">
                <?php echo ucfirst($stockTableList['Stock']['quantity']) ?>
            </td>

            <td class="">
                <?php echo ucfirst($stockTableList['Stock']['location_id']) ?>
            </td>

            <td class="">
                <?php echo date('M d, Y', strtotime($stockTableList['Stock']['created'])) ?>
            </td>

            <td align = "center">

                <?php echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View</font></span>
                          </span> ', array('controller' => 'receivings', 'action' => 'view', $stockTableList['Stock']['id']),array('class' =>' table-link ','escape' => false,'title'=>'Print Transmittal Receipt')); ?>

                   <!--  <a data-toggle="modal" href="#myModalReturn<?php echo $stockTableList['Stock']['id']?>" class="table-link "><i class="fa fa-lg "></i><span class="fa-stack">
                                      <i class="fa fa-square fa-stack-2x"></i>
                                      <i class="fa  fa-sign-in fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> OutRecord </font></span></a>  -->

            </td>

            <!-- <div class="modal fade" id="myModalReturn<?php echo $stockTableList['Stock']['id']?>" role="dialog" >
                <div class="modal-dialog">
                    <div class="modal-content margintop">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">In Record</h4>
                        </div> 

                        <div class="modal-body">

                            <?php $id = $requestOrderDataList['ReceivedOrder']['id'];

                                echo $this->Form->create('InRecord',array(
                                    'url'=>(array('controller' => 'receivings','action' => 'in_record', $id)),'class' => 'form-horizontal')); 
                            ?>

                                <div class="form-group" id="existing_items">
                                    <label class="col-lg-2 control-label"><span style="color:red">*</span>Store Keeper</label>
                                    <div class="col-lg-9">
                                        <?php 
                                            echo $this->Form->input('InRecord.storekeeper', array(
                                                'class' => 'form-control item_type editable required',
                                                'label' => false,
                                                'type' => 'select',
                                                'options' => array($userNameList),
                                                'required' => 'required',
                                               
                                                ));
                                        ?>

                                    </div>
                                </div>

                                <br><br>

                                <div class="form-group" id="existing_items">
                                    <label class="col-lg-2 control-label">Remarks</label>
                                    <div class="col-lg-9">
                                        <?php 
                                            echo $this->Form->textarea('InRecord.remarks', array(
                                                'empty' => 'None',
                                                'required' => 'required',
                                                'class' => 'form-control item_type editable limitQuantity',
                                                'label' => false
                                               
                                            ));
                                        ?>
                                    </div>
                                </div>
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

<?php endforeach; ?> 
