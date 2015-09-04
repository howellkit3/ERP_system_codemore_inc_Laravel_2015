<!-- Standard Bootstrap Modal -->
    <div class="modal fade" id="printPayslip" role="dialog" data-id="" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Filter Report </h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->Form->create('Export',array('url' => array('controller' => 'salaries','action' => 'export_salaries'),'type' => 'get')); ?>
                       <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"> Department </label>
                            <div class="col-lg-10">
                                <?php 
                                    echo $this->Form->input('type',array(
                                        'type' => 'hidden',
                                        'id' => 'exportType',
                                        'value' => 'payslip'
                                        ));

                                     echo $this->Form->input('id',array(
                                        'type' => 'hidden',
                                        'value' =>  $payroll['Payroll']['id']
                                        ));

                                    echo $this->Form->input('from',array(
                                        'type' => 'hidden',
                                        'value' => $payroll['Payroll']['from'],
                                        ));

                                    echo $this->Form->input('to',array(
                                        'type' => 'hidden',
                                        'value' => $payroll['Payroll']['to'],
                                        ));

                                    echo $this->Form->input('departments', array(
                                        'options' => $departments,
                                        'alt' => 'type',
                                        'label' => false,
                                        'class' => 'form-control col-lg-12',
                                        'empty' => '--- All ---',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <label for="inputEmail1" class="col-lg-2 control-label"> Employee Type </label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('employee_type', array(
                                        'options' => array('daily' => 'Daily','monthly' => 'Monthly'),
                                        'alt' => 'type',
                                        'label' => false,
                                        'class' => 'form-control col-lg-12',
                                        'empty' => '--- All ---',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                        </div>
                        <div class="clearfix"></div> 
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"> Bank Account </label>
                            <div class="col-lg-10">
                                <?php 
                                    echo $this->Form->input('bank_acount', array(
                                        'options' => array('yes' => 'Yes','no' => 'No'),
                                        'alt' => 'type',
                                        'label' => false,
                                        'class' => 'form-control col-lg-12',
                                        'empty' => '--- All ---',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>   
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-file-text"></i> Export </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i>  Close</button>
                </div>

              </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  