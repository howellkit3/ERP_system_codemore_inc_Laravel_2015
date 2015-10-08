    <div class="modal fade" id="machineModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Machine </h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('Machine',array('url'=>(array('controller' => 'settings','action' => 'add_machine')),'class' => 'form-horizontal'));?>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">  Name</label>
                           
                            <div class="col-lg-10">
                                <?php

                                    echo $this->Form->input('name', array(
                                        'alt' => 'type',
                                        'label' => false,
                                        'class' => 'form-control col-lg-4',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">  Description </label>
                           
                            <div class="col-lg-10">
                                <?php

                                    echo $this->Form->input('description', array(
                                        'alt' => 'type',
                                        'label' => false,
                                        'class' => 'form-control col-lg-4',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                        </div>

                          <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">  Plate </label>
                           
                            <div class="col-lg-10">
                                <?php

                                    echo $this->Form->input('plate', array(
                                        'alt' => 'type',
                                        'label' => false,
                                        'class' => 'form-control col-lg-4',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                        </div>

                          <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">  Paper Gripper</label>
                           
                            <div class="col-lg-10">
                                <?php

                                    echo $this->Form->input('paper_gripper', array(
                                        'alt' => 'type',
                                        'label' => false,
                                        'class' => 'form-control col-lg-4',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                        </div>

                          <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">  Plate Gripper </label>
                           
                            <div class="col-lg-10">
                                <?php

                                    echo $this->Form->input('plate_gripper', array(
                                        'alt' => 'type',
                                        'label' => false,
                                        'class' => 'form-control col-lg-4',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                        </div>
                        <div id="result_container"></div>
                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"> Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>

                        
                    </form>
                        
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  