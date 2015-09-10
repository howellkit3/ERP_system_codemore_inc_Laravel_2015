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
    Daily
</a>
</h4>
</div>
<div id="collapseOne" class="panel-collapse collapse" style="height: 2px;">
<div class="panel-body">

  <?php echo $this->Form->create('Tax',array('url'=>(array('controller' => 'payroll_settings','action' => 'tax_settings','daily')))); ?>

       <table class="table table-bordered">
                <thead>
                  <tr>
                      <th>1</th>
                      <th>2</th>
                      <th>3</th>
                      <th>4</th>
                      <th>5</th>
                      <th>6</th>
                      <th>7</th>
                      <th>8</th>

                  </tr>
              </thead>
                <tbody>
                <tr>
                 <td>
                  <?php echo $this->Form->input('TaxDeduction.id',array('type' => 'hidden','label' => false, 'class' => 'form-control cols-lg-2')); ?>
                  <?php echo $this->Form->input('TaxDeduction.type',array('type' => 'hidden','value' => 'daily','label' => false, 'class' => 'form-control cols-lg-2')); ?>
                  <?php echo $this->Form->input('TaxDeduction.tax_1',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> + 
                  <?php echo $this->Form->input('TaxDeduction.tax_1_percent',array('value' => '0','label' => false, 'class' => 'form-control cols-lg-2 number')); ?>% Over 
                 </td>
                 <td>
                 <?php echo $this->Form->input('TaxDeduction.tax_2',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> + 
                  <?php echo $this->Form->input('TaxDeduction.tax_2_percent',array('value' => '0','label' => false, 'class' => 'form-control cols-lg-2 number')); ?>% Over 
                </td>
                 <td> 
                 <?php echo $this->Form->input('TaxDeduction.tax_3',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> + 
                  <?php echo $this->Form->input('TaxDeduction.tax_3_percent',array('value' => '0','label' => false, 'class' => 'form-control cols-lg-2 number')); ?>% Over 
                </td>
                 <td>
                  <?php echo $this->Form->input('TaxDeduction.tax_4',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> + 
                  <?php echo $this->Form->input('TaxDeduction.tax_4_percent',array('value' => '0','label' => false, 'class' => 'form-control cols-lg-2 number')); ?>% Over 
                </td>
                 <td>
                 <?php echo $this->Form->input('TaxDeduction.tax_5',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> + 
                  <?php echo $this->Form->input('TaxDeduction.tax_5_percent',array('value' => '0','label' => false, 'class' => 'form-control cols-lg-2 number')); ?>% Over 
                </td>
                 <td> 
                 <?php echo $this->Form->input('TaxDeduction.tax_6',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> + 
                  <?php echo $this->Form->input('TaxDeduction.tax_6_percent',array('value' => '0','label' => false, 'class' => 'form-control cols-lg-2 number')); ?>% Over 
                </td>
                 <td> 
                 <?php echo $this->Form->input('TaxDeduction.tax_7',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> + 
                <?php echo $this->Form->input('TaxDeduction.tax_7_percent',array('value' => '0','label' => false, 'class' => 'form-control cols-lg-2 number')); ?>% Over 
                  </td>
                 <td> 
                 <?php echo $this->Form->input('TaxDeduction.tax_8',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> + 
                  <?php echo $this->Form->input('TaxDeduction.tax_8_percent',array('value' => '0','label' => false, 'class' => 'form-control cols-lg-2 number')); ?>% Over 
                  </td>
                </tr>
                 
                </tbody>
 </table>

 <table class="table table-bordered">
                <thead>
                <tr>
                  <th><a href="#"><span>Code</span></a></th>
                  <th><a class="desc" href="#"><span>Exempt Rate</span></a></th>
                  <th><a class="asc" href="#"><span>1</span></a></th>
                  <th class="text-center"><span>2</span></th>
                  <th class="text-center"><span>3</span></th>
                  <th class="text-right"><span>4</span></th>

                  <th class="text-right"><span>5</span></th>

                  <th class="text-right"><span>6</span></th>

                  <th class="text-right"><span>7</span></th>

                  <th class="text-right"><span>8</span></th>
                </tr>
                </thead>
 

                <?php $status = array('Z' => 'Z', 'S_ME' => 'S / ME', 'S1_ME1' => 'ME1 / S1','S2_ME2' => 'ME2 / S2','S3_ME3' => 'ME3 / S3', 'S4_ME4' => 'ME4 / S4'); ?>

                  <tbody>
                        <?php $key = 0; foreach ($status as $stats_key => $stats) : ?>
                              <tr>
                                <td class="text-center"> 
                                <?php echo $stats;
                                  echo $this->Form->input($key.'.code',array('value' => $stats_key ,'type' => 'hidden','label' => false, 'class' => 'form-control cols-lg-2')); 
                                 ?> 
                                </td>
                                <td class="text-center">
                                <?php 
                                  echo $this->Form->input($key.'.type',array('value' => 'daily','type' => 'hidden','label' => false, 'class' => 'form-control cols-lg-2')); 
                                  echo $this->Form->input($key.'.exempt_rate',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> 
                                </td>
                                <td class="text-center">  
                                <?php echo $this->Form->input($key.'.taxes_1',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?>  
                                </td>
                                <td class="text-center">  
                                <?php echo $this->Form->input($key.'.taxes_2',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> 
                                </td>
                                <td class="text-center">  
                                <?php echo $this->Form->input($key.'.taxes_3',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> 

                                </td>
                                <td class="text-right"> 
                                 <?php echo $this->Form->input($key.'.taxes_4',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> 
                                </td>
                                <td class="text-right">
                                   <?php echo $this->Form->input($key.'.taxes_5',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> 
                                </td>
                                <td class="text-right">  
                                <?php echo $this->Form->input($key.'.taxes_6',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> 
                                 </td>
                                <td class="text-right"> 
                                <?php echo $this->Form->input($key.'.taxes_7',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> 
                                </td>
                                <td class="text-right"> 
                                   <?php echo $this->Form->input($key.'.taxes_8',array('value' => '0.00','label' => false, 'class' => 'form-control cols-lg-2 number')); ?> 
                                 </td>
                            </tr>
                          <?php $key++; endforeach; ?>

                  </tbody>
                
                </table>
                <div class="">
                    <button class="btn btn-success"> <i class="fa fa-floppy-o"></i> Save </button>
                </div>

        <?php echo $this->Form->end(); ?>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
Collapsible Group Item #2
</a>
</h4>
</div>
<div id="collapseTwo" class="panel-collapse collapse" style="height: 2px;">
<div class="panel-body">
Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
Collapsible Group Item #3
</a>
</h4>
</div>
<div id="collapseThree" class="panel-collapse collapse" style="height: 2px;">
<div class="panel-body">
Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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