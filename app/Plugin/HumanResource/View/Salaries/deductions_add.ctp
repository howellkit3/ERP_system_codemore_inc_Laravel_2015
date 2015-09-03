<?php $this->Html->addCrumb('Holidays', array('controller' => 'schedules', 'action' => 'holiday')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'holidays', 'action' => 'add')); ?>
<?php echo $this->Html->css(array(
                        'HumanResource.default',
                        'HumanResource.select2.css',
));?>
<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom',
                        'HumanResource.select2.min',
                        'HumanResource.deductions',
)); ?>
<div style="clear:both"></div>

<?php echo $this->element('payroll_options'); ?><br><br>
<?php echo $this->Form->create('Deduction',array('url'=>(array('controller' => 'deductions','action' => 'add')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>

    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        <center>
                            <h1 class="pull-left">
                                Add Deductions
                            </h1>
                        </center>
                        <?php  echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'salaries', 'action' => 'deductions'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </header>

                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1>  &nbsp </h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">

                                <div class="form-group col-lg-12">
                                    <div class="form-group">
                                       
                                        <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Employee Name </label>
                                                <div class="col-lg-9">
                                                  <?php echo $this->Form->input('employee_id',  array(
                                                        'class' => 'autocomplete col-lg-6 required',
                                                        'options' => $employeeList,
                                                        'label' => false));
                                                    ?>
                                                </div>
                                             </div>
                                        </div>
                                    </div>                              
                                    <div class="form-group">
                                             <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Mode </label>
                                                    
                                                <div class="col-lg-9">
                                                   <div class="form-group pull-left">
                                                    <div class="radio inline-block">
                                                    <input type="radio" checked="checked" value="once" class="mode_type" id="optionsRadios1" name="data[Deduction][mode]">
                                                        <label for="optionsRadios1">
                                                            Once
                                                        </label>
                                                    </div>
                                                    <div class="radio inline-block">
                                                    <input type="radio" class="mode_type" value="installment" id="optionsRadios2" name="data[Deduction][mode]">
                                                        <label for="optionsRadios2">
                                                            Installment
                                                        </label>
                                                    </div>
                                                    </div>
                                                </div>
                                             </div>
                                        </div>      
                                    </div>

                                    <div class="form-group day_type" id="daily" >
                                       <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Day </label>
                                                <div class="col-lg-9">
                                                  
                                                    <?php
                                                        echo $this->Form->input('Deduction.from',
                                                            array(
                                                                'type' => 'text',
                                                                'class' => 'form-control col-lg-6 required datepick',
                                                                'label' => false,
                                                                'value' => date('Y-m-d')
                                                                ));
                                                    ?>

                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                    <div class="form-group day_type" id="monthly" style="display:none">
                                       <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> From / to </label>
                                                <div class="col-lg-9">
                                                  
                                                    <?php
                                                        echo $this->Form->input('Deduction.from',
                                                            array(
                                                                'type' => 'text',
                                                                'class' => 'form-control col-lg-6 required datepickerDateRange',
                                                                'label' => false,
                                                                'disabled' => true,
                                                                'value' => date('Y/m/01').' - '.date('Y/m/t')
                                                                ));
                                                    ?>

                                                </div>
                                             </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Type </label>
                                                <div class="col-lg-9">
                                                  
                                                    <?php
                                                        $holiday_types = array(
                                                                'addition' => 'Addition',
                                                                'ca_fund' => 'CA_Fund',
                                                                'ca_others' => 'CA_Others',
                                                                'sss_loan' => 'SSS_Loan',
                                                                'uniform' => 'Uniform',
                                                                'penalty' => 'Penalty',
                                                                'pagibig_loan' => 'PAGIBIG_Loan',
                                                            );
                                                        echo $this->Form->input('type', array(
                                                            'options' => $holiday_types ,
                                                            'class' => 'form-control col-lg-6 required',
                                                            'label' => false,
                                                            'empty' => '-- Select Type --'
                                                            ));
                                                    ?>
                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Amount </label>
                                                <div class="col-lg-9">
                                                  
                                                    <?php

                                                        echo $this->Form->input('amount', array(
                                                            'class' => 'form-control col-lg-6 required',
                                                            'label' => false,
                                                            ));
                                                    ?>
                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"> Reason </label>
                                                <div class="col-lg-9">
                                                    <?php

                                                        echo $this->Form->input('reason', array(
                                                            'class' => 'form-control col-lg-6 required',
                                                            'label' => false,
                                                            ));
                                                    ?>
                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group col-lg-12 computations">

                                       
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

      </div>
    </div>
      <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
               
                <div class="top-space"></div>
                <div class="main-box-body clearfix">
                    <div class="main-box-body clearfix">
                        <div class="form-horizontal">
                
                            <div class="multi-field clearfix">
                                <div class="col-xs-2 col-md-2"></div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Form->submit('Submit', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                    ?>
                                  
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                   <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'salaries', 'action' => 'deductions'),array('class' =>'btn btn-default','escape' => false));
                                    ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->Form->end(); ?>
<style type="text/css">
    .datepicker-hide .ui-datepicker-year
    {
        display:none;   
    }
    .radio.inline-block {
  margin-left: 15px;
}
</style>
