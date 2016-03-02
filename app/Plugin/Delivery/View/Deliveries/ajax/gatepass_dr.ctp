<?php if (!empty($deliveries)) :?>
<?php foreach ($deliveries as $key => $value) {  ?>
                <div class="form-group form-height gatePickUp">
                    <label class="col-lg-2 control-label"> </label>
                    <div class="col-lg-8">
                        <div class="checkbox-nice">
                            <input type="checkbox" class="check-ref-uuid " id="checkbox-<?php echo $key ?>" value="<?php echo $value['Delivery']['dr_uuid']  ?>">
                            <label for="checkbox-<?php echo $key ?>">
                                <?php echo $value['Delivery']['dr_uuid'] ;?>
                            </label>
                            <?php 
                                
                                echo $this->Form->input('GatePass.'.$key.'.ref_uuid', array('class' => 'form-control ref-uuid',
                                    'type' => 'hidden',
                                    'disabled' => false,
                                    'label' => false,
                                    'value' => $value['Delivery']['dr_uuid']));
                          
                                echo $this->Form->input('GatePass.'.$key.'.model', array('class' => 'form-control ref-uuid',
                                    'type' => 'hidden',
                                    'disabled' => false,
                                    'label' => false,
                                    'value' => 'Deliveries'));
                            

                            $keyholder = $key ?>

                            </div>
                        </div>
                </div>
<?php } ?>
<?php else:?>
    <div class="form-group">
            <span style="color:red">No Result</span>
    </div>
<?php endif; ?>