<table class="table table-bordered">
                <thead>
                <tr>
                  <th><a href="#"><span>Payroll Date</span></a></th>
                  <th><a class="desc" href="#"><span>Balance</span></a></th>
                  <th class="text-center"><a class="asc" href="#"><span>Deduction</a></span>
                  <th class="text-center"><a class="asc" href="#"><span>Paid</a></span>
                 <!--  <th class="text-right"><span>Actions</span></th> -->
                </tr>
                </thead>
                <tbody>
                <?php foreach ($amortizations as $key => $amortization) : ?>
                     <tr>
                      <td>
                        <?php echo date('Y/m/d',strtotime($amortization['Amortization']['payroll_date'])); ?>
                      </td>
                      <td>
                        <?php echo number_format($amortization['Amortization']['amount'],2); ?>
                      </td>
                      <td class="text-center">
                        <?php echo number_format($amortization['Amortization']['deduction'],2); ?>
                      </td>
                      <td class="text-center">

                        <?php echo !empty($amortization['Amortization']['status']) && $amortization['Amortization']['status'] == 1  ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ?>
                      </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
 </table>