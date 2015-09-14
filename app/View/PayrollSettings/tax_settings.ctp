<?php echo $this->element('payroll_setting_option');?><br><br>
<div class="row">
  <div class="col-lg-12">
    
    <div class="row">
      <div class="col-lg-12">
        <header class="main-box-header clearfix">
          <h1 class="pull-left">
            Tax Settings
          </h1>
          <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'sss_ranges'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
        </header>

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



                <div class="panel-group accordion" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
   <i class="fa fa-chevron-circle-down"></i> Daily
</a>
</h4>
</div>
<div id="collapseOne" class="panel-collapse collapse" style="height: 2px;">
<div class="panel-body">
  <?php  echo $this->element('taxSetting/daily_table',array('taxes' => $taxes )); ?>
 </div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
<i class="fa fa-chevron-circle-down"></i>  Weekly
</a>
</h4>
</div>
<div id="collapseTwo" class="panel-collapse collapse" style="height: 2px;">
<div class="panel-body">
<?php echo $this->element('taxSetting/weekly_table',array( 'taxes' => $taxes ));?>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
<i class="fa fa-chevron-circle-down"></i>  Semi Monthly
</a>
</h4>
</div>
<div id="collapseThree" class="panel-collapse collapse" style="height: 2px;">
<div class="panel-body">

  <?php  echo $this->element('taxSetting/semi_monthly_table',array( 'taxes' => $taxes ));?>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
<i class="fa fa-chevron-circle-down"></i> 
Monthly
</a>
</h4>
</div>
<div id="collapseFour" class="panel-collapse collapse" style="height: 2px;">
<div class="panel-body">
  <?php echo $this->element('taxSetting/monthly_table',array( 'taxes' => $taxes ));?>
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
</div>