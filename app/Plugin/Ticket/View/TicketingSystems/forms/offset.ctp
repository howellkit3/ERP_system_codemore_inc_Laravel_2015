   <?php echo $this->Form->create('PlateMakingProcess',array('url'=>(array('controller' => 'ticketing_systems','action' => 'save_process_to_ticket','type' => 'wood_mold')),'class' => 'form-horizontal','id' => 'offsetForm'));?>
               

                    <div class="form-group">
                        <div class="col-lg-9">

                          <?php
                            echo $this->Form->input('job_ticket_id',array('type' => 'hidden','value' => $parameter['ticketId']

                              ));

                            echo $this->Form->input('process_id',array('type' => 'hidden','value' => $parameter['processId']

                              ));
                            echo $this->Form->input('product_id',array('type' => 'hidden','value' => $parameter['productId']

                              ));

                            echo $this->Form->input('FormId',array('type' => 'hidden','value' => $parameter['formProcesId']

                              ))
                          ?>
                          
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label"> Machine </label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('machine', array(
                                    'label' => false,
                                    'options' => $machines,
                                    'empty' => '-- Select Machine ---',
                                    'class' => 'form-control ',
                                  //  'value' => !empty($ticketData['JobTicket']['remarks']) ? $ticketData['JobTicket']['remarks'] : ' '
                                )); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label">  </label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('item', array(
                                    'label' => false,
                                    'class' => 'form-control number',
                                    'empty' => false,
                                    'value' => '1'
                                  //  'value' => !empty($ticketData['JobTicket']['remarks']) ? $ticketData['JobTicket']['remarks'] : ' '
                                )); ?>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label"> Plate </label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('plate', array(
                                    'label' => false,
                                    'class' => 'form-control number',
                                    'empty' => false,

                                    'readonly' => 'readonly',
                                  //  'value' => !empty($ticketData['JobTicket']['remarks']) ? $ticketData['JobTicket']['remarks'] : ' '
                                )); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label"> Paper Gripper </label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('paper_gripper', array(
                                    'label' => false,
                                    'class' => 'form-control',
                                    'empty' => false,
                                    'readonly' => 'readonly',

                                  //  'value' => !empty($ticketData['JobTicket']['remarks']) ? $ticketData['JobTicket']['remarks'] : ' '
                                )); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label"> Plate Gripper</label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('plate_gripper', array(
                                    'label' => false,
                                    'class' => 'form-control ',
                                    'empty' => false,

                                    'readonly' => 'readonly',
                                  //  'value' => !empty($ticketData['JobTicket']['remarks']) ? $ticketData['JobTicket']['remarks'] : ' '
                                )); ?>
                        </div>
                    </div>

                      <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label"> Remarks </label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('remarks', array(
                                    'label' => false,
                                    'class' => 'form-control ',
                                    'empty' => false,
                                    'type' => 'textarea'
                                  // 'value' => !empty($ticketData['JobTicket']['remarks']) ? $ticketData['JobTicket']['remarks'] : ' '
                                )); ?>
                        </div>
                    </div>
   
                    <div class="modal-footer">
                     <?php 

                            echo $this->Html->link('<i class="fa fa-print"></i> Print Ticket
                            ', 
                            array(
                             'controller' => 'ticketing_systems','action' => 'print_process',
                            'productId' => !empty( $parameter['product']) ?  $parameter['product'] : '',
                             $parameter['processId'],
                             $parameter['productId'],
                            $parameter['ticketId']
                            ),
                            array(
                             //'title' => 'Print '. $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']],
                                'target' => '_blank',
                                'escape' => false,
                                'class' => 'btn btn-success',
                                'data-dismiss' => 'modal'
                            )
                            );

                        ?>

                         <button type="submit" id="submitOffset" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i>  Save </button>


                        <button type="button" id="closeModal" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>
                </form>
