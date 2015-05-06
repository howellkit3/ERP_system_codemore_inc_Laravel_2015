<style>
<?php include('pdf/word.css'); ?>

</style>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix">
					<h1>Kou Fu Packaging Corp.</h1>
					<h5>Lot 4-5, Blk 3 Phase 2, Mountview Industrial Complex, Bancal, Carmona, Cavite</h5>
					<h6>Tel#: (046) 972-1111 to 13 Fax#: (046) 972-0120</h6><br>
					<h2>Price Quotation</h2><br>
				</header>
			</center>
			
			<div class="main-box-body clearfix">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-2">
							Attention
						</div>
						<div class="col-lg-5">
							:&emsp;
							<?php 
							// 	echo $quotation['Quotation']['attention_details']
								echo !empty($quotation['Quotation']['company_id']) ? ucfirst($companyData[$quotation['Quotation']['company_id']]) : ucfirst($companyData[$inquiryId[$quotation['Quotation']['inquiry_id']]]) 
							?>
						</div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							No : <u>PQ-<?php echo $quotation['Quotation']['uuid'] ?></u>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-5">
							___________________________________________________
						</div>
						<div class="col-lg-4">&emsp;&emsp;&emsp;
							Date :&nbsp;<?php echo !empty($quotation['Quotation']['created']) ? date('Y/m/d', strtotime($quotation['Quotation']['created'])) : '' ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-10">
							Dear :&nbsp; <?php echo ucfirst($quotation['Quotation']['attention_details']) ?>&nbsp;
							<?php //echo ucfirst($contactInfo['ContactPerson']['lastname']) ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-8">
							We are pleased to submit our price quotation on your printing requirement under the following specifications:
						</div>
					</div><br>
					<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Item
							</div>
							<div class="col-lg-8">
								<?php echo $quotation['ProductDetail']['name']?>
							</div>

					</div>
					<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Size
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['size']?>
							</div>

					</div>
					<div>
					<!-- <div class ="boxed2"> -->
					<div class="form-group">
							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Qty<br><br>
								Unit Price<br><br>
								Vat Price<br><br>
								Material
							</div>
							<div class="col-lg-8"><div class="pull-left"></div>
								<?php foreach ($quotation['QuotationItemDetail'] as $itemDetail){ ?>
									<table  class = "tbl">
										<tr>
											
											<td height ="35px" valign ="top" class ="column3 col-md-8"> 
												<div class="col-lg-12">
													<?php echo $itemDetail['quantity'];?> 
												</div>
											</td>	
											
										</tr>

										<tr >
											
											<td height ="35px" valign ="top" class = "column4 col-md-8">
												<div class="col-lg-12">
													<?php echo $itemDetail['unit_price'];?> 
												</div>
											</td>
											
										</tr>

										<tr>
											
											<td height ="40px" class ="column2 col-md-8">
												<div class="col-lg-12">
													<?php echo $itemDetail['vat_price'];?> 
												</div>
											</td>
											
										</tr>

										<tr>
											
											<td height ="30px" class ="column2 col-md-8">
												<div class="col-lg-12">
													<?php echo $itemDetail['material'];?> 
												</div>
											</td>
											
										</tr>

									</table>
								<?php } ?>

							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Color
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['color']?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Process
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['process']?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Packaging
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['packaging']?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Other Specs
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['other_specs']?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Terms
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['Quotation']['payment_terms']?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Validity
							</div>
							<div class="col-lg-8">
								 <?php echo !empty($quotation['Quotation']['validity']) ? date('M d, Y', strtotime($quotation['Quotation']['validity'])) : 'No validity date'; ?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Remarks
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['remarks']?>
							</div>

						</div>
			
						
					

					
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
							<?php echo ucfirst($user['User']['first_name']) ?>&nbsp;
							<?php echo ucfirst($user['User']['last_name'])?>
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
						<div class="col-lg-5" style="display:inline-block !important;">

							Ms. Carryll Yu
							<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">

						</div>
						<br><br>
						<div class=" pull-right col-lg-3" style="display:inline-block !important;">
							<p class = "doc">
								<font size ="1">
									Doc No.: KFP-FR-MKT-07<br>
									REV. No.: 01
								</font>
							</p>
						</div>
					</div>
					<div style ="clear:both">
					</div>
				</form>
			</div>								
		</div>
	</div>	
</div>