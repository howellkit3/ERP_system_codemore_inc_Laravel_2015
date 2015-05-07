   <div class="modal fade" id="QuotationEmail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Send Via Email</h4>
                </div>
                   <?php echo $this->Form->create('Quotation',array('url'=>(array('controller' => 'quotations','action' => 'send_email')),'class' => 'form-horizontal'));?>
                <div class="modal-body">
              
                     <?php echo $this->Form->input('id',array('type' => 'hidden','value' => $quotation['Quotation']['id'])); ?>
                     <?php echo $this->Form->input('company_id',array('type' => 'hidden','value' => $quotation['Quotation']['company_id'])); ?>
                    <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> To : </label>
                            <div class="col-lg-10">
                                <?php 
                                    echo $this->Form->input('to', array(
                                        'label' => false,
                                        'class' => 'form-control col-lg-4 required email',
                                        'empty' => false,
                                        'placeholder' => 'to',
                                        'required' => true,
                                        'value' => $quotation['ContactPersonEmail']['email']
                                    ));
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                             <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> CC : </label>

                            <div class="col-lg-10">
                                 <label for="inputEmail1" class="control-label"><span style="color:black">*</span> Note :
                             Emails are separated by comma </label>
                                <?php 
                                    echo $this->Form->input('emails', array('type' => 'textarea',
                                        'class' => 'form-control item_type required email-tag',
                                        'data-role' => 'tagsinput',
                                        'placeholder' => 'cc',
                                        'required' => true,
                                        'label' => false));
                                ?>
                            </div>
                        </div>

                         <div class="form-group">
                             <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Subject : </label>

                            <div class="col-lg-10">
                                <?php 
                                    echo $this->Form->input('subject', array('type' => 'text',
                                        'class' => 'form-control item_type required',
                                        'placeholder' => 'subject',
                                        'value' => 'Quotation form for item: '. $quotation['ProductDetail']['name'] ,
                                        'required' => true, 
                                        'label' => false));
                                ?>
                            </div>
                        </div>

                          <div class="form-group">
                             <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Message : </label>

                            <div class="col-lg-10">
                                <?php 
                                    $message = '';
                                    echo $this->Form->input('message', array('type' => 'textarea',
                                        'class' => 'form-control item_type required number',
                                        'placeholder' => 'Message', 
                                        'required' => true,
                                        'label' => false));
                                ?>
                            </div>
                        </div>

                         <div class="form-group">
                             <label for="inputEmail1" class="col-lg-2 control-label"> Attachment : </label>
                                <div class="col-lg-10">
                              <i class="fa fa-file-pdf-o"></i>
                               <?php 
                               $name = 'product-'.$quotation['ProductDetail']['name'].'-quotation'.time();

                               echo $this->Form->input('pdf',array('type' => 'hidden','value' => $name));  ?>

                               <?php echo $this->Html->link($name.'.pdf',array(
                                        'controller' => 'quotations', 
                                        'action' => 'print_word',
                                        'ext' => 'pdf',
                                        $quotation['Quotation']['id'],$quotation['Quotation']['company_id']
                                        ), array(
                                            'target' => '_blank'
                                        )); 

                               ?>
                            </div>
                        </div>

                        
                        
                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o fa-lg"></i> Send Email</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
            
                    
                </div>
                <?php echo $this->Form->end(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  