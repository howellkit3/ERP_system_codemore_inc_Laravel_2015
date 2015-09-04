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

                  echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit', array('controller' => 'warehouse_requests', 'action' => 'edit_request',$requestData['WarehouseRequest']['id']),array('class' =>'btn btn-primary pull-right','escape' => false)); 

        } ?>

       

        <?php if($requestData['WarehouseRequest']['status_id'] == 1){ ?>

        <a data-toggle="modal" href="#myModalOutRecord<?php echo $requestData['WarehouseRequest']['id']?>" class="btn btn-primary mrg-b-lg pull-right addSchedButton "><i class="fa fa-plus-circle fa-lg tobeTrigger"></i> Out Record</a>

        <?php } ?>            
    
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
                        <td><b>Department: </b><?php echo $roleName;?></td>
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

                        <?php foreach ($requestData['WarehouseRequestItem'] as $key => $value) { $key++ ?>
                           
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
                                <td class="text-center"><?php echo empty($outRecordData['ItemRecord'][$key-1]['stock_quantity']) ? (!empty($value['stock_quantity'])? $value['stock_quantity']: 0) : $outRecordData['ItemRecord'][$key-1]['stock_quantity'];  ?></td>
                               
                                <td class="text-center"><?php echo date('M d, Y', strtotime($value['date_needed'])); ?></td>
                                <td class="text-center"><?php echo $value['purpose']; ?></td>
                                <td class="text-center"><?php  
                                   if(!empty($value['remarks'])){ 
                                    echo $value['remarks'];
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

<div class="modal fade" id="myModalOutRecord<?php echo $requestData['WarehouseRequest']['id']?>" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content margintop">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Out Record</h4>
            </div> 

            <div class="modal-body">

                <?php 

                $id = $requestData['WarehouseRequest']['id'];

                    echo $this->Form->create('OutRecord',array(
                        'url'=>(array('controller' => 'warehouse_requests','action' => 'out_record', $id)),'class' => 'form-horizontal')); 
                ?>

                <?php foreach ($requestData['WarehouseRequestItem'] as $key => $value) {

                if(!empty($value['stock_quantity'])){ ?>

                    <div class = "clone">
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

                         <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-6">
                                <?php 
                                    echo $this->Form->input('WarehouseRequestItem.'.$key.'.quantity', array(
                                                                'class' => 'form-control item_type toBeLimited',
                                                                'label' => false,
                                                                'fields' =>array('name'),
                                                                'value' => $value['stock_quantity'] < $value['quantity'] ? $value['stock_quantity'] : $value['quantity']));
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
                                    echo $this->Form->input('WarehouseRequestItem.'.$key.'.stockQuantity', array(
                                                                'class' => 'form-control stockQuantity',
                                                                'label' => false,
                                                                'type' => 'hidden',
                                                                'fields' =>array('name'),
                                                                'value' => empty($value['stock_quantity']) ? 0 : $value['stock_quantity']));
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
                                                                'class' => 'form-control ',
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
                    </div>    

                    <?php }else{ ?>

                     <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-9">

                            <?php echo $this->Form->input('WarehouseRequestItem.'.$key.'.nostocks', array(
                                                                'class' => 'form-control item_type',
                                                                'label' => false,
                                                                'disabled' => true,
                                                                'fields' =>array('name'),
                                                                'value' => $value['name'])); ?>

                            </div>
                    </div>

                    <div class="form-group" id="existing_items">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-9">

                            <?php echo "<span class='label label-danger'>No Stocks</span>"; ?>

                            </div>
                    </div>

                    <?php } ?> 

                        <?php  } ?>

                    <div class="form-group" id="existing_items">
                        <label class="col-lg-2 control-label">Remarks</label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->textarea('OutRecord.remarks', array(
                                    'empty' => 'None',
                                    'required' => 'required',
                                    'class' => 'form-control item_type editable',
                                    'label' => false
                                   
                                ));
                            ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                <?php echo $this->Form->end();  ?> 
            </div>
        </div>
    </div>
</div>

<script>

jQuery(document).ready(function($){
      
    $("body").on('change','.toBeLimited', function(e){

            var toBeLimited = $(this).val();
            var quantitylimit = $(this).parents('.clone').find('.quantityLimit').val();
            var stockQuantity = $(this).parents('.clone').find('.stockQuantity').val();
           
            var requestDifference = parseInt(quantitylimit) - parseInt(toBeLimited);

            // if (parseInt(stockQuantity) == 0) {

            //     alert('No Stocks for the Item');
            //     $(this).parents('.clone').find('.toBeLimited').val(quantitylimit);

            // }

            if (parseInt(toBeLimited) < 1) {

                alert('Quantity should not be less than or equal to zero.');
                $(this).parents('.clone').find('.toBeLimited').val(quantitylimit);

            }

            if (parseInt(requestDifference) < 0) {

                alert('Quantity should not be exceeded to requested value.');
                $(this).parents('.clone').find('.toBeLimited').val(quantitylimit);

            }

            var stockDifference = parseInt(stockQuantity) - parseInt(toBeLimited);

            if (parseInt(stockDifference) < 0) {

                alert('Insufficient Stock Quantity');
                $(this).parents('.clone').find('.toBeLimited').val(stockQuantity);

            }
            
        });

});


</script>