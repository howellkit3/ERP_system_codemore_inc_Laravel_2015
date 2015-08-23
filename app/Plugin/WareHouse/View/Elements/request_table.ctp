<?php  foreach ($requestData as $requestDataList ): ?>

        <tr class="">

            <td class="">
                <?php echo ucfirst($requestDataList['Request']['uuid']) ?>  
            </td>

            <td class="">

                <?php echo ucfirst($requestDataList['Request']['name']) ?>

            </td>

            <td class="">
                <?php echo ucfirst($requestDataList['PurchasingType']['name']) ?>
            </td>

            <td >
               
                       <span class='label label-default'>Waiting</span>
                  
            </td>

            <td class="">

                <?php echo ucwords($userNameList[$requestDataList['Request']['prepared_by']]) ?>

            </td>

            <td class="">

                <?php echo ucwords($roleData[$userROleList[$requestDataList['Request']['prepared_by']]]) ?>

            </td>


             <td class="">

                <?php echo date('M d, Y', strtotime($requestDataList['Request']['created'])); ?>

            </td>

            <td>

                 <?php
                        echo $this->Html->link('<span class="fa-stack">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-search fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View</font></span>
                            </span> ', array('controller' => 'receivings', 'action' => 'view', $requestDataList['Request']['id'], $requestDataList['Request']['uuid'], 0),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                    ?>                    

                <a data-toggle="modal" href="#myModalReturn<?php echo $requestDataList['Request']['id']?>" class="table-link "><i class="fa fa-lg "></i><span class="fa-stack">
                                      <i class="fa fa-square fa-stack-2x"></i>
                                      <i class="fa  fa-sign-in fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> OutRecord </font></span></a> 

            </td>

            <div class="modal fade" id="myModalReturn<?php echo $requestDataList['Request']['id']?>" role="dialog" >
                <div class="modal-dialog">
                    <div class="modal-content margintop">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">In Record</h4>
                        </div> 

                        <div class="modal-body">

                            <?php // $id = $requestOrderDataList['ReceivedOrder']['id'];

                                echo $this->Form->create('InRecord',array(
                                    'url'=>(array('controller' => 'receivings','action' => 'in_record')),'class' => 'form-horizontal')); 
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
            </div>
<div class="md-overlay"></div>


<?php endforeach; ?> 

