  <?php $componentName = $parameter['component']; 
        $productID = $parameter['product'];
       // $holder = 'cutting';?>

   <?php echo $this->Form->create('JobTicketProcess',array('url'=>(array('controller' => 'ticketing_systems','action' => 'save_job_ticket_process',$productID, $componentName , 'type' => 'cutting')),'class' => 'form-horizontal'));?>
                
                <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label"> Remarks </label>
                        <div class="col-lg-9">

                          <?php
                            echo $this->Form->input('job_ticket_id',array('type' => 'hidden','value' => $parameter['ticketuuId']

                              ));

                            echo $this->Form->input('process_id',array('type' => 'hidden','value' => $parameter['processId']

                              ));
                            echo $this->Form->input('product_id',array('type' => 'hidden','value' => $parameter['productId']

                              ));
                              echo $this->Form->input('ticket_id',array('type' => 'hidden','value' => $parameter['ticketId']

                              ))
                          ?>

                          
                            <?php 
                                echo $this->Form->input('remarks', array(
                                    'label' => false,
                                    'class' => 'form-control ',
                                    'empty' => false,
                                  //  'value' => !empty($ticketData['JobTicket']['remarks']) ? $ticketData['JobTicket']['remarks'] : ' '
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
                               'component' => !empty( $parameter['component']) ? $parameter['component'] : '',
                              $parameter['processId'],
                              $parameter['productId'],
                              $parameter['ticketuuId'],
                              0,
                              0,
                              $parameter['ticketId']
                            ),
                            array(
                             //'title' => 'Print '. $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']],
                                'target' => '_blank',
                                'escape' => false,
                                'class' => 'btn btn-success'
                            )
                            );

                        ?>

                         <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Save </button>


                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>
                </form>