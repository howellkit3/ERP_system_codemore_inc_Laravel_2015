    <?php 
        $productID = $parameter['product'];
        $componentName = $parameter['component']; 
    ?>

   <?php echo $this->Form->create('JobTicketProcess',array('url'=>(array('controller' => 'ticketing_systems','action' => 'save_job_ticket_process',$productID, $componentName,'type' => 'corrugated')),'class' => 'form-horizontal'));?>
               

<!--                     <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label"> Flute Combi. </label>
                        <div class="col-lg-9">

                          <?php 

                           

                            // echo $this->Form->input('quantity', array( 'type' => 'hidden', 'value' => $parameter['ticketId']));

                            // echo $this->Form->input('allowance', array( 'type' => 'hidden', 'value' => $parameter['ticketId']));
                          ?>
                            <?php 
                                echo $this->Form->input('fluteCombination', array(
                                    'label' => false,
                                    'class' => 'form-control ',
                                    'empty' => false,
                                )); ?>
                        </div>
                    </div> -->

                    <!-- <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label"> Cutting Size </label>
                        <div class="col-lg-9">
                            <?php 

                                

                                echo $this->Form->input('cutting_size', array(
                                    'label' => false,
                                    'class' => 'form-control ',
                                    'empty' => false,
                            )); 
                            ?>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label">Corrugated Paper</label>
                        <div class="col-lg-9">
                            <?php 

                              echo $this->Form->input('process_id',array('type' => 'hidden','value' => $parameter['processId']));

                              echo $this->Form->input('product_id',array('type' => 'hidden','value' => $parameter['productId']));

                              echo $this->Form->input('job_ticket_id',array('type' => 'hidden','value' => $parameter['ticketuuId']));

                              echo $this->Form->input('ticket_id',array('type' => 'hidden','value' => $parameter['ticketId']));

                              echo $this->Form->input('corrugated_id', array(
                                    'options' => array($corrugated),
                                    'label' => false,
                                    'style' => 'text-transform:capitalize',
                                    'class' => 'form-control',
                                    'id' => 'corrugated', 
                                    'empty' => '--Select Corrugated Paper--'
                                ));
                            ?>

                        </div>
                    </div>

                    <section class = "append">

                    </section>

                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label"> Remarks </label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('remarks', array(
                                    'label' => false,
                                    'class' => 'form-control ',
                                    'empty' => false,
                                    'type' => 'textarea'
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
                              $parameter['ticketId'],
                               ),
                            array(
                             //'title' => 'Print '. $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']],
                                'target' => '_blank',
                                'escape' => false,
                                'class' => 'btn btn-success'
                            )
                            );

                        ?>

                         <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i>  Save </button>


                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>
                </form>

                <?php // echo $this->element('item_modal'); ?>