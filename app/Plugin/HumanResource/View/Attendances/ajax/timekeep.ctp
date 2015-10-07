 <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label text-left"><span style="color:red">*</span> Employee :</label>

    <div class="col-lg-9 text-left">
        <?php echo $this->Form->input('Attendance.employee_id',array('type' => 'hidden','value' => $attendance["Employee"]['id'])); ?>
         <?php echo $this->Form->input('Attendance.id',array('type' => 'hidden','value' => $attendance["Attendance"]['id'])); ?>
        <span class="code"> <?php echo $attendance['Employee']['code'] ?> - </span>
        <?php echo $this->CustomText->getFullname($attendance['Employee']); ?>
    </div>
</div>
<!--  <div class="form-group text-left">
    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Type :   </label>
   <div class="col-lg-9">
       <div class="radio">
            <?php if (!empty($attendance['Attendance']['in'])) :?>
                <input type="radio" name="data[Attendance][type]" id="categoryRadio1" value="in">
                <label for="categoryRadio1">
                   Time in : <?php echo date('h:i:s',strtotime($attendance['Attendance']['in'])); ?>
                </label>
            <?php else :?>
                <input type="radio" name="data[Attendance][type]" id="categoryRadio1" value="in">
                <label for="categoryRadio1">
                   In
                </label>
            <?php endif; ?> 

              <input type="radio" name="data[Attendance][type]" id="categoryRadio1" value="in">
                <label for="categoryRadio1">
                   In
                </label>

                <input type="radio" name="data[Attendance][type]" id="categoryRadio2" value="out" <?php echo !empty($attendance['Attendance']['in']) ? 'checked' : ''?>>
                <label for="categoryRadio2" >
                   Out
                </label>


        </div>
    </div> 
</div>-->
<div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Type :   </label>
                                <div class="col-lg-9">
                                       <div >
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
                'id' => 'datetimepickerTime',
                'placeholder' => 'Time',
                'value' => date('Y-m-d h:i'),
                'label' => false));
        ?>
    </div>
</div>
<?php if (empty($attendance["Attendance"]['status'])) { ?>
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label"> Status :   </label>
        <div class="col-lg-9">
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
        </div>
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

<script type="text/javascript">
    $(document).ready(function(){
         $("#datetimepickerTime,#AttendanceTime").datetimepicker( {
            format:'Y-m-d H:i',
        });

    });
   

</script>
