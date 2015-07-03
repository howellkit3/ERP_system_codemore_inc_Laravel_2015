<?php echo $this->element('deliveries_options'); ?><br><br>

<div class="row">
    <div class="col-lg-12">
        
        <div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                    
                    
                    <h1 class="pull-left">
                        Create Gate Pass
                    </h1>
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'deliveries', 'action' => 'view',$deliveryScheduleId,$quotationId,$clientsOrderUuid),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
                </header>

            </div>
        </div>
        <?php echo $this->Form->create('GatePass',array('url'=>(array('controller' => 'deliveries','action' => 'add_gatepass'))));?>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <div class="top-space"></div>
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>DR No.</label>
                                        <div class="col-lg-8">
                                            <?php 

                                                echo $this->Form->input('Direct.one', array('class' => 'form-control item_type',
                                                    'type' => 'hidden',
                                                    'label' => false,
                                                    'value' => $deliveryScheduleId));

                                                echo $this->Form->input('Direct.two', array('class' => 'form-control item_type',
                                                    'type' => 'hidden',
                                                    'label' => false,
                                                    'value' => $quotationId));

                                                echo $this->Form->input('Direct.three', array('class' => 'form-control item_type',
                                                    'type' => 'hidden',
                                                    'label' => false,
                                                    'value' => $clientsOrderUuid));

                                                echo $this->Form->input('GatePass.foreign_key', array('class' => 'form-control item_type',
                                                    'type' => 'hidden',
                                                    'label' => false,
                                                    'value' => $drId));
                                                echo $this->Form->input('GatePass.model', array('class' => 'form-control item_type',
                                                    'type' => 'hidden',
                                                    'label' => false,
                                                    'value' => 'Delivery'));
                                                echo $this->Form->input('GatePass.dr_no', array('class' => 'form-control item_type required',
                                                    'readonly' => true,
                                                    'label' => false,
                                                    'value' => $druuid));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Truck No.</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('GatePass.truck_id', array(
                                                    'options' => array($truckList),
                                                    'type' => 'select',
                                                    'label' => false,
                                                    'class' => 'form-control required ',
                                                    'empty' => '---Select Item Truck---',
                                                    'required' => 'required'
                                                    )); 
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Driver Name</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('GatePass.driver_id', array(
                                                        'options' => array($driverList),
                                                        'type' => 'select',
                                                        'label' => false,
                                                        'class' => 'form-control required ',
                                                        'empty' => '---Select Driver---',
                                                        'required' => 'required'
                                                        ));
                                            ?>
                                        </div>
                                    </div>

                                    <section class="appendHelper">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label"><span style="color:red">*</span>Helper Name</label>
                                            <div class="col-lg-7">
                                                <?php 
                                                    echo $this->Form->input('GatePassAssistant.0.helper_id', array(
                                                        'options' => array($helperList),
                                                        'type' => 'select',
                                                        'label' => false,
                                                        'class' => 'form-control required ',
                                                        'empty' => '---Select Helper---',
                                                        'required' => 'required'
                                                        )); 
                                                ?>
                                            </div>
                                            <div class="col-lg-2 plusbtn">
                                                <button type="button" onclick="cloneData('appendHelper',this)" class="add-gatepass danger btn btn-success"> <i class="fa fa-plus"></i></button>
                                                <!-- <button type="button" style="display:none;" class="remove-field btn btn-danger remove" onclick="removeClone('appendHelper')"><i class="fa fa-minus"></i> </button> -->
                                            </div>
                                        </div>
                                    </section>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Remarks</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('GatePass.remarks', array(
                                                    'type' => 'textarea',
                                                    'class' => 'form-control item_type',
                                                    'label' => false));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-primary pull-left">Submit</button>&nbsp;
                                            <?php 
                                                echo $this->Html->link('Cancel', array('controller' => 'settings', 'action' => 'view'),array('class' =>'btn btn-default','escape' => false));
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

<script>
    
    jQuery(document).ready(function(){
        
        $("#GatePassGatePassForm").validate();
        
    });

</script>