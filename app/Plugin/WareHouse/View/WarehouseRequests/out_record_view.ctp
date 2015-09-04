<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php  echo $this->element('ware_house_option');?>
    
    <div class = "pull-right";>

        <?php echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i>  Go Back ', array('controller' => 'warehouse_requests','action' => 'stock'),array('class' =>'btn btn-primary pull-right','escape' => false));
            ?>
             
    </div>

<br><br>

<div class="row">
    <div class="col-lg-12">
        
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                    
                            
                </header>

            </div>
        </div>
                <?php echo $this->Form->create('OutRecord',array('url'=>(array('controller' => 'receivings','action' => 'outrecord_view'))));?>      

        <div class="row">
            <div class="col-lg-12">
                <div class="main-box" >
                    <header class="main-box-header clearfix" >

                        <h2 class="pull-left"><b>Out-Record Details</b></h2>
                        
                    </header>

                    <div class="top-space"></div>                       
                    <div class="main-box-body clearfix">
                        <div class="main-box-body clearfix">
                            <div class="form-horizontal">                                   
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Request Number</label>
                                    
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('OutRecord.uuid', array(
                                                                            'class' => 'form-control item_type',
                                                                            'disabled' => true,
                                                                            'label' => false,       
                                                                            'value' => $outRecordData['WarehouseRequest']['uuid'],
                                                                            'fields' =>array('name')));


                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Remarks</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('OutRecord.remarks', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'disabled' => true,
                                                                            'fields' =>array('name'),
                                                                            'value' => $outRecordData['OutRecord']['remarks']));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Issued by</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('OutRecord.uuid', array(
                                                                            'class' => 'form-control item_type',
                                                                            'disabled' => true,
                                                                            'label' => false,       
                                                                            'value' => $outRecordData['WarehouseRequest']['created_by'],
                                                                            'fields' =>array('name')));


                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Date Issued</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('OutRecord.uuid', array(
                                                                            'class' => 'form-control item_type',
                                                                            'disabled' => true,
                                                                            'label' => false,       
                                                                            'value' => date('M d, Y', strtotime($outRecordData['WarehouseRequest']['created']))));


                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

   
        <?php echo $this->Form->end(); ?>   
    </div>
</div>

<?php foreach ($outRecordData['ItemRecord'] as $key => $value) {  ?>

<div class="row">
    <div class="col-lg-12">
        
        <?php echo $this->Form->create('ItemRecord',array('url'=>(array('controller' => 'receivings','action' => 'outrecord_view'))));?>      

        <div class="row">
            <div class="col-lg-12">
                <div class="main-box" >
                    <header class="main-box-header clearfix" >

                        <h2 class="pull-left"><b>Item Details</b></h2>
                        
                    </header>

                    <div class="top-space"></div>                       
                    <div class="main-box-body clearfix">
                        <div class="main-box-body clearfix">
                            <div class="form-horizontal">                                   
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Item Name</label>
                                    
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('OutRecord.uuid', array(
                                                                            'class' => 'form-control item_type',
                                                                            'disabled' => true,
                                                                            'label' => false,       
                                                                            'value' => $value['foreign_key'],
                                                                            'fields' =>array('name')));


                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Item Group</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('OutRecord.uuid', array(
                                                                            'class' => 'form-control item_type',
                                                                            'disabled' => true,
                                                                            'label' => false,       
                                                                            'value' => $value['model'],
                                                                            'fields' =>array('name')));


                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Issued Quantity</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('OutRecord.uuid', array(
                                                                            'class' => 'form-control item_type',
                                                                            'disabled' => true,
                                                                            'label' => false,       
                                                                            'value' => $value['quantity'],
                                                                            'fields' =>array('name')));


                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Stock Quantity</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('OutRecord.uuid', array(
                                                                            'class' => 'form-control item_type',
                                                                            'disabled' => true,
                                                                            'label' => false,       
                                                                            'value' => $value['stock_quantity']));


                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

   
        <?php echo $this->Form->end(); ?>   
    </div>
</div>

<?php } ?>