<?php
// header("Content-disposition: attachment; filename="'this.pdf');
// header("Content-type: application/pdf");
?>
<style>
<?php include('word.css'); ?>

</style>

<html>
<head>
	<title>Prepress</title>
</head>
<body>

	<div class="large-padding">
			<div class=" full-width">
					<table class="full-width border header" style="font-family:sans-serif;">
							<tr>
								<td style="text-left" style="padding-left:15px"> <h2  style="padding-left:25px"> Koufu Packaging Corp. </h2> </td>
								<td class="text-right" style="padding-right:15px"> <h1> Prepess Job Ticket </h1> </td>
							</tr>
					</table>
					<table class="full-width border header" style="font-family:sans-serif; padding: 10px ;font-size:12px;">
							<tr>
								<td  style="padding-left:15px">
								<table class="full-width">
									<tr><td style="width:70px"> Customer </td> 
									<td> <div style="border-bottom:1px dashed #000; ">
									<?php echo !empty($companyData[$productData['Product']['company_id']]) ? ucwords($companyData[$productData['Product']['company_id']]) : '';  ?>
									</div></td> 
									</tr>
								</table>
								</td>
								<td  style="padding-left:15px" > <table class="full-width"><tr><td style="width:100px"> Schedule No.  </td> <td> <div style="border-bottom:1px dashed #000; "> <?php echo $ticketUuid; ?> </div> </td> </tr></table>  </td>
								<td style="width:70px"> 
								<table class="full-width">
									<tr><td style="width:30px"> REV </td> 
										<td> <div style="border-bottom:1px dashed #000; "> NEW </div></td> 
									</tr>
								</table> 
								</td>
							</tr>
								<tr>
								<td  style="padding-left:15px">
								<table class="full-width">
									<tr><td style="width:80px"> Item Name </td> 
									<td> <div style="border-bottom:1px dashed #000; "> <?php echo $productData['Product']['name']; ?></div></td> 
									</tr>
								</table>
								</td>
								<td  style="padding-left:15px" > <table class="full-width"><tr><td style="width:120px"> Job Description.  </td> <td> <div style="border-bottom:1px dashed #000; ">  Manual </div> </td> </tr></table>  </td>
								<td> <div style="border-bottom:1px dashed #000; ">  <span style="color:#fff">a</span> </div> </td> </tr></table>  </td>
							</tr>

					</table>

					<table class="full-width border header" style="font-family:sans-serif;  padding-left:20px;font-size:12px;">
							<tr>
								<td class="" style="width:50%; border-right:1px solid #000">
									<div class="full-width">
										<table class="full-width">
											<tr>
												<td style="width:60px">Material</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>
										<table class="full-width">
											<tr>
												<td style="width:60px">Size</td>
												<td>
													<table class="full-width">
														<tr>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">L</td><td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">W</td><td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">D</td><td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">Unit</td><td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>

														</tr>
													</table>

												</td>
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:60px">Size</td>
												<td>
													<table class="full-width">
														<tr>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">C</td><td> <div style="border:1px solid #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">M</td><td> <div style="border:1px solid #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">Y</td><td> <div style="border:1px solid #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">K</td><td> <div style="border:1px solid #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">Other</td><td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>

														</tr>
													</table>

												</td>
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:80px">Spot Name</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>
										<table class="full-width">
											<tr>
												<td style="width:50px">OS</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:80px">Soft Ware</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>


											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:80px">Attached</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:130px">Dieline Approved</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:50px">Ref no</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>


											</tr>
										</table>

									</div>
								</td>
							
								<td class="" style="width:50%; border-right:1px solid #000">
									<div class="full-width">
										<table class="full-width">
											<tr>
												<td style="width:90px">Output Type</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:50px">sets</td>
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:90px"> <span style="color:#fff">a</span> </td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:50px">sets</td>
											</tr>
										</table>


										<table class="full-width">
											<tr>
												<td style="width:90px"> Paper Size </td>
												<td style="width:30px"><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:10px">X</td>
												<td  style="width:30px"><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:30px"> Unit </td>
												<td ><div style="width:30px; border-bottom:1px dashed #000; "> in </div></td>

											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:20px"> Imp </td>
												<td style="width:30px"><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:40px">Outs</td>
												<td  style="width:20px">Gap</td>
												<td  style="width:10px">X</td>
												<td style="width:30px"> <div style="width:30px; border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div> </td>

												<td  style="width:10px">Y</td>
												<td style="width:30px"> <div style="width:30px; border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div> </td>
												<td  style="width:30px">Unit</td>
												<td style="width:30px"> <div style="width:30px; border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div> </td>
												
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:60px">Film Emulsion</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>
										<table class="full-width">
											<tr>
												<td style="width:60px">Imposition Way</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:130px">Imposition Ref no.</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:20px"> PO</td>
												<td style="width:50px"><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
					</table>		
					
					<table class="full-width border header" style="font-family:sans-serif; height: 120px; padding-left:20px;font-size:12px; vertical-align:top">
						<tr>
							<td style="vertical-align:top">
								<p style="font-size:12px">Remarks</p>

								<table class="full-width" style="text-align:center;height:100px; ">
									<tr>
										<td>

											<?php if (!empty($ticketData['JobTicket']['remarks'])) : ?>

												<?php if (strlen($ticketData['JobTicket']['remarks']) > 100) {

												$style = "font-size:11px";
											} else {

													$style = "font-size:12px";
											} ?>

												<p style="<?php echo $style; ?>;"> <?php echo nl2br($ticketData['JobTicket']['remarks']); ?> </p>


										<?php endif; ?>
											

										</td>
									</tr>
								</table>	
								<?php ?>
							</td>	
						</tr>

						<tr>
							<td style="vertical-align:bottom">
								<table class="full-width" style="vertical-align:bottom">
									<tr>
										<td style="width:90px"> Except Date </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>

										<td style="width:50px"> Time </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
										<td style="width:100px"> Finished Date </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
										<td style="width:20px"> By </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
									</tr>
								</table>

							</td>
						</tr>

					</table>


					<table class="full-width border header" style="font-family:sans-serif; padding-left:20px;font-size:12px; vertical-align:top">
						<tr>
							<td style="vertical-align:bottom">
								<table class="full-width" style="vertical-align:bottom">
									<tr>
										<td style="width:90px"> Prepared By </td>
										<td> <div style="border-bottom:1px dashed #000; "> 
											<?php echo $userData['User']['first_name'].', '.$userData['User']['last_name']?>
										 </div></td>

										<td style="width:70px"> Noted by </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
										<td style="width:100px"> Received By </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
									</tr>
								</table>

								<table class="full-width" style="vertical-align:bottom; font-family:sans-serif;font-size:10px">
									<tr>
										<td style="width:40px"> Date/Time </td>
										<td style="width:100px; text-align:center;"> <?php echo date('Y/m/d h:i:s a'); ?></td>

										<td style="width:100px; text-align:center;"> Date/Time </td>
										
										<td style="width:50px; text-align:right;padding-right:50px;"> Date/Time  </td>
									
									</tr>
								</table>

							</td>
						</tr>
					</table>


					<table class="full-width">
									<tr><td style="width:70px"> <div style="border-bottom:2px dashed #000; "> <span style="color:#fff">a</span> </div> </td></tr> 
									
					</table>

					<table class="full-width border header" style="font-family:sans-serif; padding: 10px ;font-size:12px;">
							<tr>
								<td  style="padding-left:15px">
								<table class="full-width">
									<tr><td style="width:70px"> Customer </td> 
									<td> <div style="border-bottom:1px dashed #000; ">
									<?php echo !empty($companyData[$productData['Product']['company_id']]) ? ucwords($companyData[$productData['Product']['company_id']]) : '';  ?>
									</div></td> 
									</tr>
								</table>
								</td>
								<td  style="padding-left:15px" > <table class="full-width"><tr><td style="width:100px"> Schedule No.  </td> <td> <div style="border-bottom:1px dashed #000; "> <?php echo $ticketUuid; ?> </div> </td> </tr></table>  </td>
								<td style="width:70px"> 
								<table class="full-width">
									<tr><td style="width:30px"> REV </td> 
										<td> <div style="border-bottom:1px dashed #000; "> NEW </div></td> 
									</tr>
								</table> 
								</td>
							</tr>
								<tr>
								<td  style="padding-left:15px">
								<table class="full-width">
									<tr><td style="width:80px"> Item Name </td> 
									<td> <div style="border-bottom:1px dashed #000; "> <?php echo $productData['Product']['name']; ?></div></td> 
									</tr>
								</table>
								</td>
								<td  style="padding-left:15px" > <table class="full-width"><tr><td style="width:120px"> Job Description.  </td> <td> <div style="border-bottom:1px dashed #000; ">  Manual </div> </td> </tr></table>  </td>
								<td> <div style="border-bottom:1px dashed #000; ">  <span style="color:#fff">a</span> </div> </td> </tr></table>  </td>
							</tr>

					</table>

					<table class="full-width border header" style="font-family:sans-serif;  padding-left:20px;font-size:12px;">
							<tr>
								<td class="" style="width:50%; border-right:1px solid #000">
									<div class="full-width">
										<table class="full-width">
											<tr>
												<td style="width:60px">Material</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>
										<table class="full-width">
											<tr>
												<td style="width:60px">Size</td>
												<td>
													<table class="full-width">
														<tr>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">L</td><td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">W</td><td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">D</td><td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">Unit</td><td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>

														</tr>
													</table>

												</td>
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:60px">Size</td>
												<td>
													<table class="full-width">
														<tr>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">C</td><td> <div style="border:1px solid #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">M</td><td> <div style="border:1px solid #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">Y</td><td> <div style="border:1px solid #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">K</td><td> <div style="border:1px solid #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>
															<td>
																<table class="full-width">
																	<tr><td style="width:20px">Other</td><td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td></tr>
																</table>
															</td>

														</tr>
													</table>

												</td>
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:80px">Spot Name</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>
										<table class="full-width">
											<tr>
												<td style="width:50px">OS</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:80px">Soft Ware</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>


											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:80px">Attached</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:130px">Dieline Approved</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:50px">Ref no</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>


											</tr>
										</table>

									</div>
								</td>
							
								<td class="" style="width:50%; border-right:1px solid #000">
									<div class="full-width">
										<table class="full-width">
											<tr>
												<td style="width:90px">Output Type</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:50px">sets</td>
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:90px"> <span style="color:#fff">a</span> </td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:50px">sets</td>
											</tr>
										</table>


										<table class="full-width">
											<tr>
												<td style="width:90px"> Paper Size </td>
												<td style="width:30px"><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:10px">X</td>
												<td  style="width:30px"><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:30px"> Unit </td>
												<td ><div style="width:30px; border-bottom:1px dashed #000; "> in </div></td>

											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:20px"> Imp </td>
												<td style="width:30px"><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:40px">Outs</td>
												<td  style="width:20px">Gap</td>
												<td  style="width:10px">X</td>
												<td style="width:30px"> <div style="width:30px; border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div> </td>

												<td  style="width:10px">Y</td>
												<td style="width:30px"> <div style="width:30px; border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div> </td>
												<td  style="width:30px">Unit</td>
												<td style="width:30px"> <div style="width:30px; border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div> </td>
												
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:60px">Film Emulsion</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>
										<table class="full-width">
											<tr>
												<td style="width:60px">Imposition Way</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>

										<table class="full-width">
											<tr>
												<td style="width:130px">Imposition Ref no.</td>
												<td><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
												<td style="width:20px"> PO</td>
												<td style="width:50px"><div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
					</table>		
					
					<table class="full-width border header" style="font-family:sans-serif; height: 120px; padding-left:20px;font-size:12px; vertical-align:top">
						<tr>
							<td style="vertical-align:top">
								<p style="font-size:12px">Remarks</p>

								<table class="full-width" style="text-align:center;height:100px">
									<tr>
										<td> 
											<?php if (!empty($ticketData['JobTicket']['remarks'])) : ?>

												<?php if (strlen($ticketData['JobTicket']['remarks']) > 100) {

												$style = "font-size:11px";
											} else {

													$style = "font-size:12px";
											} ?>

												<p style="<?php echo $style; ?>;"> <?php echo nl2br($ticketData['JobTicket']['remarks']); ?> </p>


										<?php endif; ?>

										 </td>
									</tr>
								</table>	
								<?php ?>
							</td>	
						</tr>

						<tr>
							<td style="vertical-align:bottom">
								<table class="full-width" style="vertical-align:bottom">
									<tr>
										<td style="width:90px"> Except Date </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>

										<td style="width:50px"> Time </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
										<td style="width:100px"> Finished Date </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
										<td style="width:20px"> By </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
									</tr>
								</table>

							</td>
						</tr>

					</table>


					<table class="full-width border header" style="font-family:sans-serif; padding-left:20px;font-size:12px; vertical-align:top">
						<tr>
							<td style="vertical-align:bottom">
								<table class="full-width" style="vertical-align:bottom">
									<tr>
										<td style="width:90px"> Prepared By </td>
										<td> <div style="border-bottom:1px dashed #000; "> 
											<?php echo $userData['User']['first_name'].', '.$userData['User']['last_name']?>
										 </div></td>

										<td style="width:70px"> Noted by </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
										<td style="width:100px"> Received By </td>
										<td> <div style="border-bottom:1px dashed #000; "> <span style="color:#fff">a</span> </div></td>
									</tr>
								</table>

								<table class="full-width" style="vertical-align:bottom; font-family:sans-serif;font-size:10px">
									<tr>
										<td style="width:40px"> Date/Time </td>
										<td style="width:100px; text-align:center;"> <?php echo date('Y/m/d h:i:s a'); ?></td>

										<td style="width:100px; text-align:center;"> Date/Time </td>
										
										<td style="width:50px; text-align:right;padding-right:50px;"> Date/Time  </td>
									
									</tr>
								</table>

							</td>
						</tr>
					</table>



			</div>
	</div>
</body>
</html>