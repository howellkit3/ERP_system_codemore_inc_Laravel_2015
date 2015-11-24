<?php if (!empty($employees)) { ?>
<?php foreach ($employees as $KeyId => $value) {

  $in  = !empty($value['Employee']['in']) ? $value['Employee']['in'] : '';
  $out = !empty($value['Employee']['out']) ? $value['Employee']['out'] : '';
 ?>
    <li> 

        <div class="checkbox-nice">
            <input type="checkbox" name="data[Empl][id][<?php echo $KeyId ?>]" class="select_employee" value="<?php echo  $value['Employee']['id']; ?>" id="checkbox-<?php echo $KeyId; ?>">

            <input type="hidden" disabled="disabled" name="data[Employee][id][<?php echo $KeyId ?>]" class="select_employee employee" value="<?php echo  $value['Employee']['id']; ?>" id="checkbox-<?php echo $KeyId; ?>">

            <input type="hidden" name="data[Attendance][id][<?php echo $KeyId ?>]" class="select_employee attendance" value="<?php echo !empty($value['Attendance']['in']) ? $value['Attendance']['in']: '';  ?>" id="checkbox-<?php echo $KeyId; ?>">

       
            <label for="checkbox-<?php echo $KeyId; ?>">
                <?php 
                $name = $value['Employee']['first_name'];

                $name .= !empty($value['Employee']['middle_name']) ? ' '.$value['Employee']['middle_name'][0] : '';
                $name .= !empty($value['Employee']['last_name']) ? ' '.$value['Employee']['last_name'] : '';
                $name .= !empty($value['Employee']['suffix']) ? ' '.$value['Employee']['suffix'] : '';

                echo ucwords($name); ?>  

                     <span class="time-in"> <?php echo !empty( $value['Attendance']['in']) ? 'Time in ( '.date('h:i a',strtotime($value['Attendance']['in'])).' )' : ''; ?>  </span>
                     
            </label>





                        <div class="clearfix parent-li hide">
                            
                            <input type="checkbox" name="data[Empl][id][<?php echo $KeyId ?>]" class="select_employee" value="<?php echo  $value['Employee']['id']; ?>" id="checkbox-<?php echo $KeyId; ?>">

                            <input type="hidden" disabled="disabled" name="data[Employee][id][<?php echo $KeyId ?>]" class="select_employee employee" value="<?php echo  $value['Employee']['id']; ?>" id="checkbox-<?php echo $KeyId; ?>">

                            <input type="hidden" name="data[Attendance][id][<?php echo $KeyId ?>]" class="select_employee attendance" value="<?php echo !empty($value['Attendance']['in']) ? $value['Attendance']['in']: '';  ?>" id="checkbox-<?php echo $KeyId; ?>">

                            <div class="img">

                              <?php  $style = '';
                                            $serverPath = $this->Html->url('/',true);  

                                            if (!empty($value['Employee']['image'])) {


                                                $background =  $serverPath.'img/uploads/employee/'.$value['Employee']['image'].'?d='.rand(0,1000).time();    
                                            } else {

                                                 $background =  $serverPath.'img/default-profile.png';   
                                            }

                                            ?>

                            <img alt="" src="<?php echo $background?>">
                            </div>
                            <div class="title">
                                <a href="#">
                                    
                                     <?php 
                                            $name = $value['Employee']['first_name'];

                                            $name .= !empty($value['Employee']['middle_name']) ? ' '.$value['Employee']['middle_name'][0] : '';
                                            $name .= !empty($value['Employee']['last_name']) ? ' '.$value['Employee']['last_name'] : '';
                                            $name .= !empty($value['Employee']['suffix']) ? ' '.$value['Employee']['suffix'] : '';

                                            echo ucwords($name); ?> 
                                </a>
                            </div>
                            <div class="post-time">
                            <span class="time-in"> <?php echo !empty( $value['Attendance']['in']) ? 'Time in ( '.date('h:i a',strtotime($value['Attendance']['in'])).' )' : ''; ?>  </span>
                            </div>
                            <div class="time-ago">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                                <div class="clearfix"></div>
                                <div class="reason col-lg-6">

                                    <label class=""> Reason </label>

                                     <input type="text" name="data[OvertimeDetail][reason][<?php echo $KeyId ?>]" class="form-control" value="" id="checkbox">

                                </div>
                            </div>
        </div>


    </li>
<?php } ?>

<?php } else {?>
    
    <div style="color:red"> <label class="lbl lbl-danger">No Result</label> </div>

<?php } ?>