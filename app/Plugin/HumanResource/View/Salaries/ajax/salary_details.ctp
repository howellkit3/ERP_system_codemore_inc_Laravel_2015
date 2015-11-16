<table class="table table-bordered table-hover text-left">
      <tr>
        <td> Employee Name : </td>
        <td> <?php echo ucwords($employee['Employee']['full_name']); ?></td>
      </tr>
         <tr>
        <td> Code : </td>
        <td> <?php echo $employee['Employee']['code']; ?></td>
      </tr>
      </tr>
        
</table>

<div class="col-lg-12 col-md-8 col-sm-8">
        <div class="main-box clearfix">
          <div class="tabs-wrapper profile-tabs">
            
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-ainfo" data-toggle="tab">Days Work</a></li>
              <li><a href="#tab-deductions" data-toggle="tab">Deductions</a></li>
              <li><a href="#tab-benefits" data-toggle="tab">Gov. Deductions</a></li>
            </ul>
            
            <div class="tab-content">
            
                  <div class="tab-pane fade active in" id="tab-ainfo">
                      
                    <div class="panel-group accordion" id="accordion">

                          <div class="panel panel-default">
                              <?php $totalHours = 0; foreach ($attendances as $key => $listDate) : ?>
                            <div class="panel-heading" style="border-bottom:1px solid #000">
                            <h4 class="panel-title">
                            
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $listDate['Attendance']['id']?>" style="font-size:12px">
                              <div class="col-lg-3">
                               Date : <?php echo !empty($listDate['Attendance']['date']) ? date('Y/m/d',strtotime($listDate['Attendance']['date'] )) : ''; ?>
                              </div>
                              <div class="col-lg-9 text-right">
                                Total Hours: <?php echo !empty($listDate['Result']['regular_hours']) ? $listDate['Result']['regular_hours'] : 0 ?>
                              </div>
                              <div class="clearfix"></div>
                            </a>
                            </h4>
                            </div>
                            <div id="collapse-<?php echo $listDate['Attendance']['id']?>" class="panel-collapse collapse" style="height: 2px;">
                            <div class="panel-body">
                               <table class="table table-bordered table-hover text-left">
                                    <tr> 
                                      <th>Time In</th>
                                      <th>Time Out</th>
                                    </tr>
                                  <tr>
                                  <td> <?php echo !empty($listDate['Attendance']['in']) ? $listDate['Attendance']['in'] : ''; ?></td>
                                  <td> <?php echo !empty($listDate['Attendance']['out']) ? $listDate['Attendance']['out'] : ''; ?></td>
                                  </tr>
                                </table>
                            <table class="table table-bordered table-hover text-left">
                                  <tr>
                                  <td> Regular : </td>
                                  <td> <?php echo ucwords($listDate['Result']['regular_hours']); ?></td>
                                  </tr>
                                  <tr>
                                    <td> OVERTIME : </td>
                                    <td> <?php echo !empty($listDate['Result']['OT']) ? $listDate['Result']['OT'] : ''; ?></td>
                                  </tr>
                                  <tr>
                                    <td> Night Diff : </td>
                                    <td> <?php echo !empty($listDate['Result']['OT']) ? $listDate['Result']['OT'] : ''; ?></td>
                                  </tr>
                                   <tr>
                                    <td> Night Diff OT : </td>
                                    <td> <?php echo !empty($listDate['Result']['OT']) ? $listDate['Result']['OT'] : ''; ?></td>
                                  </tr>
                                   <tr>
                                    <td> LH: </td>
                                    <td> <?php echo !empty($listDate['Result']['OT']) ? $listDate['Result']['OT'] : ''; ?></td>
                                  </tr>
                                   <tr>
                                    <td> SH: </td>
                                    <td> <?php echo !empty($listDate['Result']['OT']) ? $listDate['Result']['OT'] : ''; ?></td>
                                  </tr>

                            </table>
                            </div>
                            </div>
                            <?php $totalHours += !empty($listDate['Result']['regular_hours']) ? $listDate['Result']['regular_hours'] : 0 ; endforeach; ?>

                            <div class=" border total_hours">
                            <div class="col-lg-2"> Total </div>
                            <div class="col-lg-10"> <?php echo $totalHours; ?></div>
                            </div>
                      
                   </div>

                  </div>
              </div>
             <div class="tab-pane fade" id="tab-deductions">
                

                 <table class="table table-bordered table-hover text-left">
                   <?php foreach($loans as $key => $loan) : ?>
                                  <tr>
                                  <td> <?php echo ucwords($loan); ?> : </td>
                                  <td> 0.00<?php //echo ucwords($listDate['Result']['regular_hours']); ?></td>
                                  </tr>
                                  
                    <?php endforeach; ?>      
                  </table>

              
            </div>
            <div class="tab-pane fade" id="tab-benefits">
                

                  <table class="table table-bordered table-hover text-left">
                   <?php 

                   $benefits = array('sss','philhealth','pagibig');

                   foreach( $benefits as $key => $benefit ) : ?>
                                  <tr>
                                  <td> <?php echo strtoupper($benefit); ?> : </td>
                                  <td> 0.00<?php //echo ucwords($listDate['Result']['regular_hours']); ?></td>
                                  </tr>
                                  
                    <?php endforeach; ?>      
                  </table>

            </div>
</div>
<div class="clearfix"></div>