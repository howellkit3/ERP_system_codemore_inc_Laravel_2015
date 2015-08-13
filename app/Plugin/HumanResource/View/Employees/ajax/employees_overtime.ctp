<ul class="widget-users row">
            <?php foreach ($employees as $key => $employee) : ?>
                <li class="col-md-6">
                    <?php
                        $style = '';

                        if (!empty($employee['Employee']['image'])) {

                        $serverPath = $this->Html->url('/',true);   
                        $background =  $serverPath.'img/uploads/employee/'.$employee['Employee']['image'];  
                          $style = 'background:url('.$background.')';
                    } 

                    ?>
                        <div class="image_profile" style="<?php echo $style; ?>"></div>
                    
                <div class="details">
                    <div class="name">
                       <?php
                        $name =  $this->CustomText->getFullname($employee['Employee'],'first_name',null,'last_name'); 

                         echo $this->Html->link($name,array('controller' => 'employees','action' => 'view',$employee['Employee']['id']),array('target' => '_blank'));

                        ?>
                    </div>
                <div class="time">
                    <i class="fa fa-clock-o"></i> Time In : <?php echo $employee['Attendance']['in']?>
                </div>
                
                <div class="pull-left">
                    <div class="onoffswitch onoffswitch-success">
                            <input type="checkbox" value="<?php echo $employee['Employee']['id']; ?>"  id="myonoffswitch-<?php echo $employee['Employee']['id']; ?>" class="onoffswitch-checkbox" name="data[Employee][id][]">
                            <label for="myonoffswitch-<?php echo $employee['Employee']['id']; ?>" class="onoffswitch-label">
                            <div class="onoffswitch-inner"></div>
                            <div class="onoffswitch-switch"></div>
                            </label>
                    </div>
                </div>

                </div>
                </li>
            <?php endforeach; ?>    
 </ul>