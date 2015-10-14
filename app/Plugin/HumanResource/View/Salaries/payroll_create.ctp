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
                        'HumanResource.payroll',
)); ?>
<div style="clear:both"></div>

<?php echo $this->element('payroll_options'); ?><br><br>
<?php echo $this->Form->create('Payroll',array('url'=>(array('controller' => 'salaries','action' => 'payroll_create')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>

    <div class="row">
        <div class="col-lg-12">
        	<div class="row">
                <div class="col-lg-12">
                    <header class="main-box-header clearfix">
                        <center>
                            <h1 class="pull-left">
                                Create Payroll
                            </h1>
                        </center>
                        <?php  echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'salaries', 'action' => 'payroll'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </header>

                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1>  &nbsp </h1>
                        <!-- <div class="top-space"></div> -->
                                    <div class="form-group">
                                       <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Payroll Type </label>
                                                <div class="col-lg-9">
                                                  <?php 
                                                        echo $this->Form->input('type', array(
                                                        'options' => array(
                                                            'normal' => 'Normal Payroll',
                                                            '13_month' => '13th Month'
                                                            ),
                                                        'class' => 'form-control col-lg-6 required',
                                                        'value' => date('m-Y'),
                                                        'label' => false));
                                                    ?>
                                                </div>
                                             </div>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                       <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Departments </label>
                                                <div class="col-lg-9">
                                                  <?php 
                                                        echo $this->Form->input('department', array(
                                                        'options' => $departments,
                                                        'class' => 'form-control col-lg-6 required',
                                                        'empty' => '-- All --',
                                                        'label' => false));
                                                    ?>
                                                </div>
                                             </div>
                                        </div>
                                    </div> 

                                    <div class="payroll_type normal">

                                     <div class="form-group">
                                       <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Month / Year</label>
                                                <div class="col-lg-9">
                                                  <?php 
                                                        echo $this->Form->input('month_year',  array(
                                                        'class' => 'form-control col-lg-6 required monthpick',
                                                        'value' => date('m-Y'),
                                                        'type' => 'text',
                                                        'label' => false));
                                                    ?>
                                                </div>
                                             </div>
                                        </div>
                                    </div>  

                                    <div class="form-group">
                                             <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Period </label>
                                                    
                                                <div class="col-lg-9">
                                                   <div class="form-group pull-left">
                                                    <div class="radio inline-block">
                                                    <input type="radio" checked="checked" value="1:15" data-key="First Half ( 1- 15 )" class="mode_type required" id="optionsRadios1" name="data[Payroll][date]">
                                                        <label for="optionsRadios1">
                                                            First Half ( 1- 15)
                                                        </label>
                                                    </div>
                                                    <div class="radio inline-block">
                                                    <input type="radio" class="mode_type required" value="16:31" data-key="Second Half ( 16 - 30 / 31 ) " id="optionsRadios2" name="data[Payroll][date]">
                                                        <label for="optionsRadios2">
                                                            Second Half ( 16 - 30 / 31 )
                                                        </label>
                                                    </div>
                                                    </div>
                                                </div>
                                             </div>
                                        </div>      
                                    </div>
                                 </div>

                                 <div class="payroll_type 13_month hide" >

                                 <div class="form-group">
                                       
                                       <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Year </label>
                                            <div class="col-lg-9">
                                            <?php 

                                                $firstYear = (int)date('Y') - 10;
                                                $lastYear = $firstYear + 20;
                                                $years = array();
                                                for($i=$firstYear;$i<=$lastYear;$i++)
                                                {
                                                $years[$i]  = $i;
                                                }


                                            echo $this->Form->input('year', array(
                                                'alt' => 'month',
                                                'label' => false,
                                                'options' => $years,
                                                'class' => 'form-control pull-left',
                                                'default' => date('Y'),
                                                'data-name' => 'Address'
                                             ));
                                            ?>
                                                </div>
                                             </div>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                       
                                       <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Payroll Date</label>
                                                <div class="col-lg-9">
                                                  <?php 
                                                        echo $this->Form->input('payroll_date',  array(
                                                        'class' => 'form-control col-lg-6 required datepick',
                                                        'value' => date('Y-m-d'),
                                                        'type' => 'text',
                                                        'label' => false));
                                                    ?>
                                                </div>
                                             </div>
                                        </div>

                                    </div>  

                                    <div class="form-group">
                                       
                                       <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> From / To</label>
                                                <div class="col-lg-9">
                                                  <?php echo $this->Form->input('payroll_range',  array(
                                                        'class' => 'form-control col-lg-6 required daterange',
                                                        'value' => date('Y/01/01').'-'.date('Y/12/31'),   
                                                        'type' => 'text',
                                                        'label' => false));
                                                    ?>
                                                </div>
                                             </div>
                                        </div>

                                    </div>  

                                 </div>

                                    <div class="form-group">
                                       <div class="col-lg-11">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label"> Description </label>
                                                <div class="col-lg-9">
                                                  <?php echo $this->Form->input('description', array(
                                                        'class' => 'form-control col-lg-6',
                                                        'label' => false));
                                                    ?>
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
                                        echo $this->Form->submit('Create payroll', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                    ?>
                                  
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'salaries', 'action' => 'payroll','plugin' => 'human_resource'),array('class' =>'btn btn-default','escape' => false));
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