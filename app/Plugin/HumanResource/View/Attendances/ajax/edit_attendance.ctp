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

<div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Time :   </label>
                                <div class="col-lg-9">
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
                                                        <input type="text" name="data[Attendance][out]" id="categoryRadio1" value="<?php echo 
                                                         !empty($attendance['Attendance']['out']) ? date('Y-m-d H:i',strtotime($attendance['Attendance']['out'])) : ''
                                                         ; ?>" class="form-control time_input datetime">
                                                        
                                        </div>

                                </div>
                        </div>

<?php if (empty($attendance["Attendance"]['status'])) { ?>
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label"> Status :   </label>
        <!-- <div class="col-lg-9">
            <div class="time-pad" style="padding-top:3px;">
                <?php 
                date_default_timezone_set('Asia/Manila'); 
                $date = explode(' ', $attendance['WorkShift']['from']);
                
                    if ($attendance['WorkShift']['from'] <= date('H:i:s')) {
                        echo "<span class='label label-danger pull-left'>Late</span>";
                        $status = 'Late';
                    }else{
                        echo "<span class='label label-success pull-left'>OnTime</span>";
                        $status = 'OnTime';
                    }
                    echo $this->Form->input('Attendance.status',
                        array('class' => 'form-control',  
                            'value' => $status,
                            'type' =>'hidden',
                            'label' => false));
                ?>
            </div>
        </div> -->
    </div>
<?php } ?>

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


<script>
    
     $(".datetime").datetimepicker( {
                format:'Y-m-d H:i',
          });
</script>