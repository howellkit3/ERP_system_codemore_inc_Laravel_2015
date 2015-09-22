<!-- Standard Bootstrap Modal -->
    <div class="modal fade" id="viewDeductions" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Amortizations </h4>
                </div>
                <div class="modal-body">
                
                        <div class="clearfix"></div>

                        <div id="result_container"></div>

                
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  

   <div class="modal fade" id="addDeductionImport" role="dialog" data-id="" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" > Upload Employee Deductions </h4>
                </div>
                 <?php echo $this->Form->create('Deduction',array('url' => array('controller' => 'deductions','action' => 'bulk_upload','plugin' => 'payroll'), 'type' => 'file')); ?>
                       <div class="form-group">
                        <br>
                            <label for="inputEmail1" class="col-lg-2 control-label"> <span style="color:red">*</span> File </label>
                            <div class="col-lg-10">
                                <?php 
                                    
                                    echo $this->Form->input('file', array(
                                        'type' => 'file',
                                        'label' => false,
                                        'class' => 'col-lg-12',
                                    ));
                                ?>
                            </div>
                            <div class="clearfix"></div>

                        </div>

                         <div class="form-group">
                            <br>
                            <label for="inputEmail1" class="col-lg-5 control-label"> <span style="color:red">*</span> Download Gudide / Template </label>
                            <div class="col-lg-7">
                            <?php echo $this->Html->link('<i class="fa fa-download fa-fw"></i> Download Excel File' ,
                             array('controller' => 'salaries' ,'action' => 'download_deduction_excel')
                            , array(
                            'escape' => false,
                            'class' => 'btn btn-default'
                            ));  ?>
                            </div>
                            <div class="clearfix"></div>

                        </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Import </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i>  Close</button>
                </div>
                 <?php echo $this->Form->end(); ?>
            </div>
        </div>

    </div>
