    <?php  if(!empty($employees)) { ?>

                  <?php foreach ($employees as $key => $employee): ?>

                  <tr >
                    <td> <?php echo $employee['Employee']['code']; ?></td>
                    <td class="">
                    <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
                      </td>
                      <td class="text-center">
                      <?php echo $employee['total_deduction']; ?>
                      </td>
                      <td class="text-center">
                      <?php echo $employee['total_pay']; ?>
                      </td>

                  </tr>


                  <?php  endforeach;  ?>
<?php } ?> 