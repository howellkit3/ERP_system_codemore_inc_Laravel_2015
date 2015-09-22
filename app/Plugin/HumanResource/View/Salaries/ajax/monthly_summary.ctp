<table class="table table-bordered table-hover">
      <tr>
        <td> Employee Name : </td>
        <td> <?php echo ucwords($employees['Employee']['full_name']); ?></td>
      </tr>
         <tr>
        <td> Code : </td>
        <td> <?php echo $employees['Employee']['code']; ?></td>
      </tr>
</table>

<table class="table table-bordered table-hover">
     <thead>
        <tr>
            <th><a href="#"><span>Month</span></a></th>
            <th><a href="#"><span>First Half</span></a></th>
            <th><a href="#"><span>Second Half</span></a></th>
            <th><a href="#"><span> Total </span></a></th>

        </tr>
    </thead>
    <tbody>
        <?php 
            $months = array( '01' => 'January','02' => 'February','03' => 'March','04' => 'April','05' => 'May','06' => 'June','07' => 'July','08' => 'August','09' =>'September', '10' =>'October','11' => 'November','12' => 'December');  
              foreach ($months as $key => $list) :  ?>
                <tr>
                 <td><?php echo $list; ?></td>
                 <td>
                 <?php  
                   $firstHalf = 0;
                 foreach ($employees['Salaries'][$list] as $key => $month) {
                   
                    if (!empty($month['SalaryReport']) && $month['SalaryReport']['salary_type'] == 'first') {
                        
                        $firstHalf = $month['SalaryReport']['basic_pay_month'];

                        echo number_format($month['SalaryReport']['basic_pay_month'],2);
                    } 
                 }

                 ?>
                 </td>
                 <td>
                  <?php 
                  $secondHalf = 0;
                  foreach ($employees['Salaries'][$list] as $key => $month) {
                        
                        if (!empty($month['SalaryReport']) && $month['SalaryReport']['salary_type'] == 'second') {

                            
                              $secondHalf = $month['SalaryReport']['basic_pay_month'];

                              echo number_format($month['SalaryReport']['basic_pay_month'],2);
                        }
                        
                     }

                 ?>   
                </td>
                 <td><?php echo $firstHalf + $secondHalf; ?></td>
                     
                </tr>
            <?php endforeach; ?>    
       
    </tbody>
</table>