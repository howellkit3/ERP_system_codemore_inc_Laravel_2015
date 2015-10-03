   <?php echo $this->Form->create('JobTicket',array('url'=>(array('controller' => 'ticketing_systems','action' => 'add_remarks')),'class' => 'form-horizontal'));?>
               

                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label"> Remarks</label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('JobTicket.remarks', array(
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
                             $parameter['processId'],
                             $parameter['productId'],
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

                         <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Add Remarks</button>


                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>
                </form>