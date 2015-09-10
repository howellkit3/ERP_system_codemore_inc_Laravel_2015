<table class="table table-bordered table-hover text-left">
      <tr>
        <td> Employee Name : </td>
        <td> <?php echo ucwords($employees['Employee']['full_name']); ?></td>
      </tr>
         <tr>
        <td> Code : </td>
        <td> <?php echo $employees['Employee']['code']; ?></td>
      </tr>
      </tr>
         <tr>
        <td> Deduction : </td>
        <td> <?php echo $deduction['Loan']['name']; ?></td>
      </tr>
      </tr>
      <tr>
        <td> Amount : </td>
        <td> <?php echo $deduction['Deduction']['amount']; ?></td>
      </tr>

      <tr>
        <td> Payment : </td>
        <td> <?php echo $deduction['Deduction']['mode']; ?></td>
      </tr>
       <tr>
        <td> From / to : </td>
        <td> <?php echo $deduction['Deduction']['from'] ?> To <?php echo $deduction['Deduction']['to'] ?></td>
      </tr>
</table>

<table class="table table-bordered" >
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

<div class="paging" id="item_type_pagination">
        <?php
              echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
              echo $this->Paginator->numbers(array('separator' => ''));
              echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $('body').on('click','#item_type_pagination a',function(e){

          $append_cont = $('#result_container');
          
          var getUrl = $(this).attr('href');

          $append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');

          $.ajax({
            url:getUrl,
            type: "GET",
            dataType:'html',
            success:function(result){

              $append_cont.html(result);
            }
          });

          e.preventDefault();

        });


    });
</script>