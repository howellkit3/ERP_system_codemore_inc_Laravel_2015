<?php echo $this->Form->create('Tax',array('url'=>(array('controller' => 'payroll_settings','action' => 'tax_settings','daily')))); ?>

    <?php $weekly = !empty($taxes['weekly']) ? $taxes['daily'] : ''; ?>
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
                  <?php echo $this->Form->input('TaxDeduction.id',array(
                    'type' => 'hidden',
                    'label' => false,
                    'class' => 'form-control cols-lg-2',
                    'value' => !empty($taxes['weekly']['TaxDeduction']['id']) ? $taxes['weekly']['TaxDeduction']['id'] : ''
                  )); ?>
                  <?php echo $this->Form->input('TaxDeduction.type',array('type' => 'hidden',
                    'value' => 'weekly',
                    'label' => false, 
                    'class' => 'form-control cols-lg-2'
                  )); ?>
                  <?php echo $this->Form->input(
                    'TaxDeduction.tax_1',array(
                    'value' => !empty($taxes['weekly']['TaxDeduction']['tax_1']) ? $taxes['weekly']['TaxDeduction']['tax_1'] : '0.00',
                    'label' => false, 
                    'class' => 'form-control cols-lg-2 number'
                  )); ?> + 
                  <?php echo $this->Form->input(
                    'TaxDeduction.tax_1_percent',array(
                    'value' => !empty($taxes['weekly']['TaxDeduction']['tax_1_percent']) ? $taxes['weekly']['TaxDeduction']['tax_1_percent'] : '0',
                    'label' => false,
                    'class' => 'form-control cols-lg-2 number'
                  )); ?>% Over 
                 </td>
                 <td>
                 <?php echo $this->Form->input('TaxDeduction.tax_2',array(
                 'value' => !empty($taxes['weekly']['TaxDeduction']['tax_2']) ? $taxes['weekly']['TaxDeduction']['tax_2'] : '0.00',
                 'label' => false,
                 'class' => 'form-control cols-lg-2 number',
                 )); ?> + 
                  <?php echo $this->Form->input('TaxDeduction.tax_2_percent',array(
                  'value' => !empty($taxes['weekly']['TaxDeduction']['tax_2_percent']) ? $taxes['weekly']['TaxDeduction']['tax_2_percent'] : '0',
                  'label' => false,
                  'class' => 'form-control cols-lg-2 number')); ?>% Over 
                </td>
                 <td> 
                 <?php echo $this->Form->input('TaxDeduction.tax_3',
                 array(
                 'value' => !empty($taxes['weekly']['TaxDeduction']['tax_3']) ? $taxes['weekly']['TaxDeduction']['tax_3'] : '0.00',
                 'label' => false,
                 'class' => 'form-control cols-lg-2 number'
                 )); ?> + 
                  <?php echo $this->Form->input('TaxDeduction.tax_3_percent',
                    array(
                    'value' => !empty($taxes['weekly']['TaxDeduction']['tax_3_percent']) ? $taxes['weekly']['TaxDeduction']['tax_3_percent'] : '0',
                    'label' => false,
                    'class' => 'form-control cols-lg-2 number'
                    )); ?>% Over 
                </td>
                 <td>
                  <?php echo $this->Form->input('TaxDeduction.tax_4',array(
                  'value' => !empty($taxes['weekly']['TaxDeduction']['tax_4']) ? $taxes['weekly']['TaxDeduction']['tax_4'] : '0.00',
                  'label' => false,
                  'class' => 'form-control cols-lg-2 number'
                  )); ?> + 
                  <?php echo $this->Form->input('TaxDeduction.tax_4_percent',array(
                  'value' => !empty($taxes['weekly']['TaxDeduction']['tax_4_percent']) ? $taxes['weekly']['TaxDeduction']['tax_4_percent'] : '0'
                  ,'label' => false,
                  'class' => 'form-control cols-lg-2 number'
                  )); ?>% Over 
                </td>
                 <td>
                 <?php echo $this->Form->input('TaxDeduction.tax_5',array(
                 'value' => !empty($taxes['weekly']['TaxDeduction']['tax_5']) ? $taxes['weekly']['TaxDeduction']['tax_5'] : '0.00',
                 'label' => false,
                 'class' => 'form-control cols-lg-2 number'
                 )); ?> + 
                <?php echo $this->Form->input('TaxDeduction.tax_5_percent',
                  array(
                  'value' => !empty($taxes['weekly']['TaxDeduction']['tax_5_percent']) ? $taxes['weekly']['TaxDeduction']['tax_5_percent'] : '0',
                  'label' => false,
                  'class' => 'form-control cols-lg-2 number'
                  )); ?>% Over 
                </td>
                 <td> 
                 <?php echo $this->Form->input('TaxDeduction.tax_6',
                 array(
                 'value' => !empty($taxes['weekly']['TaxDeduction']['tax_6']) ? $taxes['weekly']['TaxDeduction']['tax_6'] : '0.00',
                 'label' => false,
                 'class' => 'form-control cols-lg-2 number'
                 )); ?> + 
                  <?php 
                  echo $this->Form->input('TaxDeduction.tax_6_percent',
                  array(
                  'value' => !empty($taxes['weekly']['TaxDeduction']['tax_6_percent']) ? $taxes['weekly']['TaxDeduction']['tax_6_percent'] : '0',
                  'label' => false, 'class' => 'form-control cols-lg-2 number'
                  )); ?>% Over 
                </td>
                 <td> 
                 <?php echo $this->Form->input('TaxDeduction.tax_7',array(
                 'value' => !empty($taxes['weekly']['TaxDeduction']['tax_7']) ? $taxes['weekly']['TaxDeduction']['tax_7'] : '0.00',
                 'label' => false, 
                 'class' => 'form-control cols-lg-2 number'
                 )); ?> + 
                <?php echo $this->Form->input('TaxDeduction.tax_7_percent',array(
                'value' => !empty($taxes['weekly']['TaxDeduction']['tax_7_percent']) ? $taxes['weekly']['TaxDeduction']['tax_7_percent'] : '0',
                'label' => false, 
                'class' => 'form-control cols-lg-2 number'
                )); ?>% Over 
                  </td>
                 <td> 
                 <?php echo $this->Form->input('TaxDeduction.tax_8',array(
                 'value' => !empty($taxes['weekly']['TaxDeduction']['tax_8']) ? $taxes['weekly']['TaxDeduction']['tax_8'] : '0.00' ,
                 'label' => false, 
                 'class' => 'form-control cols-lg-2 number'
                 )); ?> + 
                  <?php echo $this->Form->input('TaxDeduction.tax_8_percent',array(
                  'value' => !empty($taxes['weekly']['TaxDeduction']['tax_8_percent']) ? $taxes['weekly']['TaxDeduction']['tax_8_percent'] : '0' ,
                  'label' => false,
                  'class' => 'form-control cols-lg-2 number'
                  )); ?>% Over 
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
 

                <?php
                  
                $weekly_taxes = !empty($taxes['weekly']['Tax']) ? $taxes['weekly']['Tax'] : ''; 

                 $status = array('Z' => 'Z', 'S_ME' => 'S / ME', 'S1_ME1' => 'ME1 / S1','S2_ME2' => 'ME2 / S2','S3_ME3' => 'ME3 / S3', 'S4_ME4' => 'ME4 / S4'); ?>

                  <tbody>
                       <?php if (!empty($weekly_taxes)) : ?>

                          <?php $key = 0; foreach ($weekly_taxes as $stats_key => $stats) : ?>
                              <tr>
                                <td class="text-center"> 
                                <?php

                                 echo $this->Form->input($key.'.id',array('value' => $stats['id']));
                                  echo $status[$stats['code']];
                                  echo $this->Form->input($key.'.code',
                                    array(
                                      'value' => $stats['code'] ,
                                      'type' => 'hidden',
                                      'label' => false,
                                      'class' => 'form-control cols-lg-2'
                                      )); 
                                 ?> 
                                </td>
                                <td class="text-center">
                                <?php 
                                 
                                 echo $this->Form->input($key.'.type',
                                  array(
                                    'value' => 'daily',
                                    'type' => 'hidden',
                                    'label' => false,
                                    'class' => 'form-control cols-lg-2'
                                  )); 
                                  echo $this->Form->input($key.'.exempt_rate',
                                  array(
                                    'value' => !empty($stats['exempt_rate']) ? $stats['exempt_rate'] : '0.00',
                                    'label' => false,
                                    'class' => 'form-control cols-lg-2 number'
                                  )); ?> 
                                </td>
                                <td class="text-center">  
                                <?php echo $this->Form->input($key.'.taxes_1',
                                array(
                                  'value' => !empty($stats['taxes_1']) ? $stats['taxes_1'] : '0.00',
                                  'label' => false,
                                  'class' => 'form-control cols-lg-2 number'
                                )); ?>  
                                </td>
                                <td class="text-center">  
                                <?php echo $this->Form->input($key.'.taxes_2',
                                array(
                                'value' => !empty($stats['taxes_2']) ? $stats['taxes_2'] : '0.00' ,
                                'label' => false,
                                'class' => 'form-control cols-lg-2 number'
                                )); ?> 
                                </td>
                                <td class="text-center">  
                                <?php echo $this->Form->input($key.'.taxes_3',
                                array(
                                'value' => !empty($stats['taxes_3']) ? $stats['taxes_3'] : '0.00' ,
                                'label' => false,
                                'class' => 'form-control cols-lg-2 number'
                                )); ?> 

                                </td>
                                <td class="text-right"> 
                                 <?php echo $this->Form->input($key.'.taxes_4',
                                 array(
                                 'value' => !empty($stats['taxes_4']) ? $stats['taxes_4'] : '0.00',
                                 'label' => false,
                                 'class' => 'form-control cols-lg-2 number'
                                 )); ?> 
                                </td>
                                <td class="text-right">
                                   <?php 
                                   echo $this->Form->input($key.'.taxes_5',
                                   array(
                                   'value' => !empty($stats['taxes_5']) ? $stats['taxes_5'] : '0.00',
                                   'label' => false,
                                   'class' => 'form-control cols-lg-2 number'
                                   )); ?>
                                </td>
                                <td class="text-right">  
                                <?php 
                                  echo $this->Form->input($key.'.taxes_6',array(
                                    'value' => !empty($stats['taxes_5']) ? $stats['taxes_6'] : '0.00',
                                    'label' => false,
                                    'class' => 'form-control cols-lg-2 number'
                                    ));
                                 ?> 
                                 </td>
                                <td class="text-right"> 
                                <?php echo $this->Form->input($key.'.taxes_7',array(
                                    'value' =>!empty($stats['taxes_5']) ? $stats['taxes_7'] : '0.00',
                                    'label' => false,
                                    'class' => 'form-control cols-lg-2 number'
                                )); ?> 
                                </td>
                                <td class="text-right"> 
                                   <?php echo $this->Form->input($key.'.taxes_8',array(
                                     'value' => !empty($stats['taxes_5']) ? $stats['taxes_8'] : '0.00',
                                     'label' => false,
                                     'class' => 'form-control cols-lg-2 number'
                                  )); ?> 
                                 </td>
                            </tr>
                          <?php $key++; endforeach; ?>

                       <?php else : ?>

                            <?php $key = 0; foreach ($status as $stats_key => $stats) : ?>
                              <tr>
                                <td class="text-center"> 
                                <?php echo $stats;
                                  echo $this->Form->input($key.'.code',array('value' => $stats_key ,'type' => 'hidden','label' => false, 'class' => 'form-control cols-lg-2')); 
                                 ?> 
                                </td>
                                <td class="text-center">
                                <?php 
                                  echo $this->Form->input($key.'.type',array('value' => 'weekly','type' => 'hidden','label' => false, 'class' => 'form-control cols-lg-2')); 
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

                       <?php endif;?>
                      

                  </tbody>
                
                </table>
                <div class="">
                    <button class="btn btn-success"> <i class="fa fa-floppy-o"></i> Save </button>
                </div>

        <?php echo $this->Form->end(); ?>