  <?php echo $this->Form->create('Attendance',array('url'=>(array('controller' => 'attendances','action' => 'edit_attendance')),'class' => 'form-horizontal'));?>
 <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label text-left"><span style="color:red">*</span> Employee :</label>

    <div class="col-lg-9 text-left">
        <?php echo $this->Form->input('Attendance.employee_id',array('type' => 'hidden','value' => $attendance["Employee"]['id'])); ?>
         <?php echo $this->Form->input('Attendance.id',array('type' => 'hidden','value' => $attendance["Attendance"]['id'])); ?>
        <span class="code"> <?php echo $attendance['Employee']['code'] ?> - </span>
        <?php echo $this->CustomText->getFullname($attendance['Employee']); ?>
    </div>
</div>
                        
                         <!--        <div class="col-lg-9">
                                       <div >
                                                          <label for="categoryRadio1">
                                                           In
                                                        </label>
                                                         <input type="text" name="data[Attendance][in]" id="categoryRadio1" value="<?php echo 
                                                         !empty($attendance['Attendance']['in']) ? date('Y-m-d H:i',strtotime($attendance['Attendance']['in'])) : ''
                                                         ; ?>" class="form-control time_input datetime" >
                                                      
                                                          <label for="categoryRadio2">
                                                           Out
                                                        </label>
                                                        <?php 
                                                         $value = '';

                                                        if (!empty($attendance['Attendance']['out']) && $attendance['Attendance']['out'] != 'n\a' ) {

                                                           $value = date('Y-m-d H:i',strtotime($attendance['Attendance']['out']));
                                                        }

                                                       ?>
                                                        <input type="text" name="data[Attendance][out]" id="categoryRadio1" value="<?php echo $value ?>" class="form-control time_input datetime">
                                                        
                                        </div>

                                </div>
 -->



                     <div class="form-group">
                            <label for="exmaplePrependCheck"  class="col-lg-2 control-label">Time In</label>
                            <div class="input-group col-lg-9">

                             <?php 

                                  $value = '';

                                    if (!empty($attendance['Attendance']['in']) && $attendance['Attendance']['in'] != 'n\a' ) {

                                       $value = date('Y-m-d H:i',strtotime($attendance['Attendance']['in']));
                                    }

                                    echo $this->Form->input('Attendance.in',
                                         array(
                                        'class' => 'item_type form-control datetime',  
                                        'type' => 'text',
                                        'placeholder' => 'Time',
                                         'value' => $value,
                                        'id' => 'datetimepickerTime',
                                        'label' => false));
                             ?>
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="exmaplePrependCheck"  class="col-lg-2 control-label">Time Out</label>
                        <div class="input-group col-lg-9 add_time" alt="time-in">

                             <?php 

                                  $value = '';

                                    if (!empty($attendance['Attendance']['out']) && $attendance['Attendance']['out'] != 'n\a' ) {

                                       $value = date('Y-m-d H:i',strtotime($attendance['Attendance']['out']));
                                    }


                                    echo $this->Form->input('Attendance.out',
                                         array(
                                        'class' => 'item_type  form-control  datetime',  
                                        'type' => 'text',
                                        'placeholder' => 'Time',
                                        'value' => $value,
                                        'id' => 'datetimepickerTime',
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


<div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa icon-save"></i> Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>


<?php echo $this->form->end(); ?>

<script type="text/javascript">
    $(document).ready(function(){

          $(".datetime").datetimepicker( {
                format:'Y-m-d H:i',
            });

            $('.add_time input:checkbox').click(function(){

                $this = $(this);

                if ($(this).is(':checked')) {

                    $this.parents('.form-group').find('.time_input').attr('disabled',false);
                } else {

                    $this.parents('.form-group').find('.time_input').attr('disabled','disabled');
                }

            });

    });
 </script>