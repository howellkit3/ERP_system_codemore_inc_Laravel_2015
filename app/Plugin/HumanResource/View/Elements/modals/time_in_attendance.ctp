

<!-- Standard Bootstrap Modal -->
    <div class="modal fade" id="timeKeep" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Pressence Record </h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('Attendance',array('url'=>(array('controller' => 'attendances','action' => 'add')),'id' => 'TimeInAttendance','class' => 'form-horizontal'));?>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Employee :</label>
                       
                            <div class="col-lg-9">
                                <?php 

                                    echo $this->Form->input('Attendance.employee_id',
                                         array('class' => 'item_type autocomplete',
                                        'options' => $employeeList,
                                        'alt' => 'Employee name',
                                        'placeholder' => 'Employee name',
                                        'onchange' => 'checkexisting(this)',
                                        'empty' => '-- select employee --',
                                        'label' => false));

                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Type :   </label>
                                <div class="col-lg-9">
                                       <div class="radio">
                                                        <input type="radio" name="data[Attendance][type]" id="categoryRadio1" value="in" checked>
                                                        <label for="categoryRadio1">
                                                           In
                                                        </label>
                                                        <input type="radio" name="data[Attendance][type]" id="categoryRadio2" value="out">
                                                        <label for="categoryRadio2">
                                                           Out
                                                        </label>
                                        </div>

                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Time : </label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('Attendance.time',
                                         array(
                                        'class' => 'item_type required form-control time_input',  
                                        'type' => 'text',
                                        'placeholder' => 'Time',
                                        'id' => 'datetimepickerTime',
                                        'value' => date('Y-m-d h:i'),
                                        'label' => false));
                                ?>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"> Notes :   </label>
                            <div class="col-lg-9">
                                 <?php 
                                    echo $this->Form->input('Attendance.notes',
                                         array('class' => 'item_type form-control',  
                                        'placeholder' => 'notes',
                                        'type' =>'textarea',
                                        'label' => false));
                                ?>
                            </div>
                        </div>


                        <div class="clearfix"></div>

                        <div id="result_container"></div>
                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa icon-save"></i> Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>

                        
                    </form>
                        
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  