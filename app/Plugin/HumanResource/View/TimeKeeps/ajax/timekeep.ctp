 <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Employee :</label>
                       
                            <div class="col-lg-9">
                                <?php echo $this->Form->input('Attendance.employee_id'); ?>
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
                            <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Time :   </label>
                            <div class="col-lg-9">
                                 <?php 
                                    echo $this->Form->input('Attendance.time',
                                         array(
                                        'class' => 'item_type required form-control time_input',  
                                        'type' => 'text',
                                        'placeholder' => 'Time',
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

