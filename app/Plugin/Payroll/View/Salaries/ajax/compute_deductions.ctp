<header class="clearfix"><h2 class="pull-left"><b>Summary</b> </h2><div class="clearfix"></div> </header><br>
<table class="table table-bordered summary" >
	<thead><tr><th><span>Date</span></th><th><span>Balance</span></th><th><span>Paid Amount</span></th></tr></thead>
	<tbody>
	<?php if (!empty($payment)) : ?>

			<?php foreach ($payment as $key => $emp) { ?>
					<tr>
					<td>
					<div class="input text"><label for="AmortizationPayrollDate">Payroll Date</label>
						<input type="text" id="AmortizationPayrollDate" value="<?php echo $emp['date'] ?>"  class="form-control" name="data[Amortization][<?php echo $key ?>][payroll_date]">
					</div>

					</td>
					<td>
					<div class="input text"><label for="AmortizationPayrollDate">Balance</label>
						<input type="text" id="AmortizationPayrollDate" value="<?php echo $emp['deduction'] ?>"   class="form-control" name="data[Amortization][<?php echo $key ?>][amount]">
					</div>
					</td>
					<td>
					<div class="input text"><label for="AmortizationPayrollDate">Deduction</label>
						<input type="text" id="AmortizationPayrollDate" value="<?php echo $emp['less'] ?>" class="form-control" name="data[Amortization][<?php echo $key ?>][deduction]">
					</div>
					</td>
					</tr>	
			<?php } ?>
	<?php endif; ?>
	</tbody>	
</table>