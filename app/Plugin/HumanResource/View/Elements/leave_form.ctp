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
                                            echo $this->Form->input('Leave.id', array('class' => 'form-control col-lg-6 required','label' => false,'type' => 'hidden'));
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
                                                                        
                                            $type = array($leavetypeList);

                                        ?>
                                        <?php 

                                            echo $this->Form->input('Leave.type_id',
                                                 array('class' => 'col-lg-6 autocomplete required leave-type-select',
                                                'options' => $type,
                                                'placeholder' => 'Type name',
                                                'empty' => 'Select Type',
                                                //'default' => !empty($this->request->data['Type']['category_id']) ? $employeeData['Type']['category_id'] : '',
                                                //'div' => 'col-lg-12',
                                                'label' => false));

                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Date</label>
                                    <div class="col-lg-8">
                                        <?php
                                            echo $this->Form->input('Leave.date_range', array('class' => 'form-control col-lg-6 required date-leave datepickerDateRange','label' => false,'value' => !empty($this->request->data['Leave']['from']) ? str_replace('-', '/', $this->request->data['Leave']['from']).' - '.str_replace('-', '/', $this->request->data['Leave']['to']) : '','readonly' => true));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Remarks</label>
                                    <div class="col-lg-8">
                                        <?php
                                            echo $this->Form->input('Leave.remarks', array('class' => 'form-control col-lg-6 required','label' => false));
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

        // $('.datepickerDateRange').daterangepicker({

        //     locale: {
        //       format: 'YYYY-MM-DD'
        //     },
        //     startDate: '2015-08-17',
        //     endDate: '2015-08-20'

        // });

    });
</script>