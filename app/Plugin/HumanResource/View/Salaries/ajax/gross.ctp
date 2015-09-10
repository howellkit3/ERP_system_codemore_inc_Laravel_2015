<header class="clearfix">
<h2 class="pull-left">
<b>Expected Gross</b> </h2>
<div class="clearfix"></div>
<p>Month : <?php echo date('F',strtotime($salary['first_half']['payroll_date'])); ?></p>
<div class="clearfix"></div> </header><br>
<table class="table table-bordered summary" >
	<!-- <thead><tr><th><span>First</span></th><th><span>Balance</span></th><th><span>Paid Amount</span></th></tr></thead> -->
	<tbody>
	<?php if (!empty($salary)) : ?>

			<?php foreach ($salary as $key => $emp) { ?>
					<tr>
					<td>
					<label for="AmortizationPayrollDate"> <?php echo Inflector::humanize($key)  ?></label>
					</td>
					<td>
						<?php echo number_format($emp['gross'],2) ?>
					</td>
					</tr>	
			<?php } ?>
	<?php endif; ?>
	</tbody>	
</table>