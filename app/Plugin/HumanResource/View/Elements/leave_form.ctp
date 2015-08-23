<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
           <!--  <h1>Personal Info</h1> -->
            <div class="top-space"></div>
            <div class="main-box-body clearfix">
                <div class="main-box-body clearfix">
                    <div class="form-horizontal">
                        <div class="form-group">
                        	<div class="col-lg-12">
                         		<div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Employee Name</label>
                                    <div class="col-lg-8">
                                    	<?php
                                            echo $this->Form->input('Leave.id', array('class' => 'form-control leaveID col-lg-6 required','label' => false,'type' => 'hidden'));
                                        ?>
                                        <?php
                                            echo $this->Form->input('Leave.employee_id',
                                                array(
                                                    'id' => 'SearchEmployee',
                                                    'class' => 'col-lg-6 required autocomplete',
                                                    'label' => false,
                                                    'options' => $employees,
                                                    'empty' => '-- Select Employee --'
                                                    ));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
                                    <div class="col-lg-8">
                                        
                                        <?php 
                                            if (!empty($this->request->data)) {

                                                echo $this->Form->input('Leave.type_id',
                                                     array('class' => 'col-lg-6 autocomplete required leave-type-select',
                                                    'options' => array($leavetypeList),
                                                    'placeholder' => 'Type name',
                                                    'disabled' => false,
                                                    'empty' => 'Select Type',
                                                    'label' => false));

                                            }else {
                                                echo $this->Form->input('Leave.type_id',
                                                     array('class' => 'col-lg-6 autocomplete required leave-type-select',
                                                    'options' => array($leavetypeList),
                                                    'placeholder' => 'Type name',
                                                    'disabled' => true,
                                                    'empty' => 'Select Type',
                                                    'label' => false));
                                            }
                                            

                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Limit Hours</label>
                                    <div class="col-lg-2">
                                        
                                        <?php 
                                            if (!empty($this->request->data)) {
                                                $limitHours = $limit[$this->request->data['Leave']['type_id']];

                                            }

                                            echo $this->Form->input('Leave.limit_hours',
                                                 array('class' => 'form-control required limit-hours',
                                                'placeholder' => 'Limit Hours',
                                                'readonly' => true,
                                                'value' => !empty($limitHours) ? $limitHours : '',
                                                'label' => false));

                                        ?>
                                        <input type="hidden" value="0" class="form-control dayrange required" name="dayrange">
                                    </div>

                                    <label for="inputEmail1" class="col-lg-1 control-label">Remaining Hours</label>
                                    <div class="col-lg-2">
                                        
                                        <?php 

                                             echo $this->Form->input('Leave.remaining_hours',
                                                 array('class' => 'form-control required remaining-hours',
                                                'placeholder' => 'Remaining Hours',
                                                'readonly' => true,
                                                'value' => !empty($remainingHours) ? $remainingHours : '',
                                                'label' => false));

                                        ?>
                                        
                                    </div>
                                    <label class="col-lg-1 control-label noted-range">Note : <?php  echo !empty($note) ? $note.' Day/s' : '' ?></label>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Date From</label>
                                    <div class="col-lg-2">
                                       
                                        <input type="date" placeholder="Date From" value="<?php echo !empty($this->request->data['Leave']['from']) ? $this->request->data['Leave']['from'] : '' ?>" day-range="0" class="form-control datepick required from-date-range" name="data[Leave][from]" min="<?php echo !empty($this->request->data['Leave']['to']) ? $this->request->data['Leave']['from'] : date('Y-m-d') ?>">

                                    </div>

                                    <label for="inputEmail1" class="col-lg-1 control-label">Date To</label>
                                    <div class="col-lg-2">

                                        <input type="date" placeholder="Date To" value="<?php echo !empty($this->request->data['Leave']['to']) ? $this->request->data['Leave']['to'] : '' ?>" class="form-control datepick date-to-range required" name="data[Leave][to]" max="<?php echo !empty($this->request->data['Leave']['to']) ? $this->request->data['Leave']['to'] : '' ?>" min="<?php echo !empty($this->request->data['Leave']['to']) ? $this->request->data['Leave']['from'] : '' ?>">
                                       
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Remarks</label>
                                    <div class="col-lg-8">
                                        <?php
                                            echo $this->Form->input('Leave.remarks', array('class' => 'form-control col-lg-6 ','label' => false));
                                        ?>
                                    </div>
                                </div>
                                 
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        // $('.datepick').datepicker({
        //     format: 'YYYY-MM-DD'
        // });
        // $('.datepickerDateRange').daterangepicker({

        //     locale: {
        //       format: 'YYYY-MM-DD'
        //     },
        //     startDate: '2015-08-17',
        //     endDate: '2015-08-20'

        // });

    });
</script>