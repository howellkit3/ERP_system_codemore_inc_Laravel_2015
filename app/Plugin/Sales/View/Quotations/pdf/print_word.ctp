<style>
<?php include('word.css'); ?>

</style>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix">
					<h2>KOU FU COLOR PRINTING CORP.</h2>
					<h5>Lot 4-5, Blk 3 Phase 2, Mountview Industrial Complex, Carmona, Cavite</h5>
					<h6>Tel#: (046) 972-1111 to 13 Fax#: (046) 972-0120</h6><br>
					<h4>Price Quotation</h4><br>
				</header>
			</center>
			<table>
				<thead>
					<tr>
						<td style="width:200px;">Attention</td>
						<td>:
							<?php echo !empty($quotation['Quotation']['company_id']) ? $companyData[$quotation['Quotation']['company_id']] : $companyData[$inquiryId[$quotation['Quotation']['inquiry_id']]] 
							?>
						</td>
						<td>No:</td>
					</tr>
					<tr>
						<td></td>
						<td>:
							___________________________________________
						</td>
						<td>Date:
							<?php echo !empty($quotation['Quotation']['created']) ? date('M d, Y', strtotime($quotation['Quotation']['created'])) : '' 
							?>
						</td>
					</tr>
				</thead>
			</table>

			<div class="main-box-body clearfix">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-2">
							Attention
						</div>
						<div class="col-lg-6">:
							<?php echo !empty($quotation['Quotation']['company_id']) ? $companyData[$quotation['Quotation']['company_id']] : $companyData[$inquiryId[$quotation['Quotation']['inquiry_id']]] 
							?>
						</div>
						<div class="col-lg-2">
							No:
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-6">
							_____________________________________________________________________
						</div>
						<div class="col-lg-2">
							  Date:<?php echo !empty($inquiry['Quotation'][0]['created']) ? date('M d, Y', strtotime($inquiry['Quotation'][0]['created'])) : '' ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-10">
							Dear : <?php echo $contactInfo['ContactPerson']['firstname'] ?>
							<?php echo $contactInfo['ContactPerson']['lastname'] ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-8">
							We are pleased to submit our price quotation on your printing requirement under the following specifications:
						</div>
					</div><br>
					<?php foreach ($quotationFieldInfo as $key => $value) { ?>
						<div class="form-group">
							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								<?php echo $field[$value['QuotationField']['custom_fields_id']] ?>
							</div>
							<div class="col-lg-8">
								:<?php echo $value['QuotationField']['description'] ?>
							</div>
						</div>
					<?php } ?>
					<br><br>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-10">
							Respectfully,
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-5">
							<?php echo $user['User']['first_name']?>
							<?php echo $user['User']['last_name']?>
							<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-10">
							Approved by
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-5">
							Ms. Carryll Yu
							<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
						</div>
					</div>
					<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
					<center>
						<header class="main-box-header clearfix">
							<h2>Acceptance Slip</h2><br>
						</header>
					</center>
					<div class="form-group">
						<div class="col-lg-2"></div>
						<div class="col-lg-4">
							Send to manager
						</div>
						<div class="col-lg-4"></div>
						<div class="col-lg-4">
							Date:________________
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-9">
							I do hereby accept the price and other details submitted on your price quotation no.CQO1408129 Also, I do hereby authorize your company to proceed with and supply the work described above.
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2"></div>
						<div class="col-lg-5">
							Athorized by:_________________
						</div>
						<div class="col-lg-4">
							Position:_________________
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-7"></div>
						<div class="col-lg-4">
							Date:_________________
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-9">
							<?php echo (new \DateTime())->format('l, F d, Y '); ?>
						</div>
					</div>
				</form>
			</div>								
		</div>
	</div>	
</div>