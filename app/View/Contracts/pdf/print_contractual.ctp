<style>
<?php include('word.css'); ?>

</style>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<center>
				<header class="main-box-header clearfix" >
					<h2 style="padding-bottom:10px;">Kou Fu Packaging Corporation</h2>
					<h6 style="padding-bottom:8px;">Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h6>
					<h6>
						Tel: +63(2)5844928 &nbsp; Fax: +63(2)5844952
					</h6><br>
					<h3>Contractual</h3><br>
				</header>
			</center>

			<table class="layout">
				<thead>
					<tr>
						<td style="width:123px;font-family: Calibri;"> </td>
						<td style="width:20px;"> </td>
						<td style="width:400px;"> </td>
						<td>
							SN : <?php echo $employeeData['Employee']['code'] ?> 
						</td>
					</tr>
					
				</thead>
			</table>

			<table class="layout">
				<thead>
					<tr>
						<td style="width:123px;font-family: Calibri;">EMPLOYEE</td>
						<td style="width:20px;">:</td>
						<td style="width:400px;">
							<?php echo ucwords($employeeData['Employee']['last_name']) ?>, 
							<?php echo ucwords($employeeData['Employee']['first_name']) ?>
							<?php echo ucwords($employeeData['Employee']['middle_name']) ?>
							<?php echo ucwords($employeeData['Employee']['suffix']) ?>
						</td>
						
					</tr>

					<tr>
						<td style="width:123px;font-family: Calibri;">ADDRESS</td>
						<td style="width:20px;">:</td>
						<td style="width:400px;">
							<?php echo ucfirst($employeeData['Address'][0]['address_1']) ?>, <?php echo ucfirst($employeeData['Address'][0]['city']) ?>, <?php echo ucfirst($employeeData['Address'][0]['state_province']) ?>
						</td>
						
					</tr>
				</thead>
			</table>

			<table class="layout">
				<thead>

					<tr>
						<td style="width:123px;font-family: Calibri;">DATE OF BIRTH</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php echo $employeeData['EmployeeAdditionalInformation']['birthday'] ?>
						</td>

						<td style="width:123px;font-family: Calibri;">PLACE OF BIRTH</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php echo $employeeData['EmployeeAdditionalInformation']['birth_place'] ?>
						</td>
						
					</tr>

					<tr>
						<td style="width:123px;font-family: Calibri;">STATUS</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php echo $employeeData['Status']['name'] ?>
						</td>

						<td style="width:123px;font-family: Calibri;">NAME OF SPOUSE</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php //echo $employeeData['EmployeeAdditionalInformation']['birth_place'] ?>
						</td>
						
					</tr>

					<tr>
						<td style="width:123px;font-family: Calibri;">SSS NO</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php //echo $employeeData['Status']['name'] ?>
						</td>

						<td style="width:123px;font-family: Calibri;">TIN NO</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php //echo $employeeData['EmployeeAdditionalInformation']['birth_place'] ?>
						</td>
						
					</tr>

					<tr>
						<td style="width:123px;font-family: Calibri;">POSITION</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php echo ucfirst($employeeData['Position']['name']) ?>/<?php echo ucfirst($employeeData['Department']['name']) ?>
						</td>

						<td style="width:123px;font-family: Calibri;">HIRING DURATION</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php //echo $employeeData['EmployeeAdditionalInformation']['birth_place'] ?>
						</td>
						
					</tr>
				</thead>
			</table>

			<br><br>

			<table class="item-table" style ="line-height:1.6;padding:0px; width:651px; margin-left:23px;table-layout: fixed; display: table" >
				<thead>
					<tr>
						<td class="td-heigth" style=" vertical-align: center;  border:1px solid black;"><center><b>Employment Duration</b></center></td>
						<td class="td-heigth" style=" vertical-align: center;  border:1px solid black;"><center><b>Basic Salary (PHP)</b></center></td>
						<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center><b>Allowance</b></center></td>
						<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center><b>CTPA</b></center></td>
						<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center><b>SEA</b></center></td>
					</tr>
					<tr>
						<td class="td-heigth" style=" vertical-align: center;  border:1px solid black;"><center>-</td>
						<td class="td-heigth" style=" vertical-align: center;  border:1px solid black;"><center>-</center></td>
						<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center>-</center></td>
						<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center>-</center></td>
						<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center><b>-</b></center></td>
					</tr>
				</thead>
			</table>

			<br><br>

			<div class="main-box-body clearfix">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<div class="col-lg-12" style="font-size:15px;margin-left:30px;">
							YOUR APPOINTMENT CARRIES THE FOLLOWING TERMS AND CONDITIONS:<br>
							ANG PAGKAKAHIRANG SA IYO AY NASASAKLAW NG MGA SUMUSUNOD NA TAKDA AT BATAYAN:
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12">
							<ol style="font-size:15px">
								<li>
									This contract is related and valid only for the duration mentioned above, unless sooner terminated as provided in paragraph 8 below.<br>
									Ang Kasunduang ito ay kaugnay at pinagtitibay sa panahon na nakatakda sa itaas, maliban lamang kung ito ay putulin ng mas maaga ayon sa nakasulat sa ika-8 talata sa ibaba.
								</li>
								<li>
									Your relation with the Company and co-employees shall be governed by law, company policies and rules and regulations.<br>
									Ang iyong pakikipag-ugnayan sa Kompanya at sa iyong mga kapwa manggagawa ay nasasaklaw ng batas, mga patakaran, pamamalakad at alintuntunin ng kompanya.
								</li>
								<li>
									Pursuant to the provisions of the Labor Code of the Philippines, you will be rendering a total of forty-eight (48) hours of regular work in a week.  Any work rendered in excess of the said 48 hours will be duly compensated.<br>
									Sang-ayon sa alituntunin ng Labor Code of the Philippines, ikaw ay maglilingkod ng apatnapu’t walong (48) oras sa loob ng isang linggo.  Anumang paglilingkod na hihigit sa nasabing 48 oras ay babayaran ng karamptang kabayaran.
								</li>
								<li>
									The “no-work, no-pay” principle shall apply in the payment of wages and other related compensation.<br>
									Ang patakarang “walang-gawa, walang-bayad” ay gagamitin sa pagtakda ng hustong kabayaran.
								</li>
								<li>
									All violations of the Company Rules and Regulations and of Company policies, as well as of existing policies on behavior and conduct shall be considered a violation of the terms and conditions of this contract.<br>
									Lahat ng paglabag sa mga patakaran at kautusan ng kompanya pati na rin sa mga alituntunin ugnay sa pagpapairal ng kaayusan ay itinuturing na paglabag sa mga alituntunin at mga batayan ng kasunduang ito.
								</li>
								<li>
									If circumstances warrant, you agree to be assigned to any position or place of work or shift schedule that the company may wish to assign to you. <br>
									Kung kinakailangan, ikaw ay pumapayag na idistino o ilalagay o ihalili sa saan mang lugar o anumang gawain na nanaisin ng Kompanya.
								</li>
								<li>
									Your continued employment is likewise dependent on your medical, physical and mental fitness for the job.<br>
									Ang iyong paglilingkod sa kompanyang ito ay makasalalay sa iyong pangagatawan at pangkaisipang kalagayan na nararapat sa iyong tungkulin.
								</li>
								<li>
									The Company reserves the right to terminate your services at any time prior to the expiration of your contract in the event that the services you have been assigned to perform for the Company are no longer required.  <br>
									Ang Kumpanya ay may karapatang tapusin and iyong pamamasukan anumang oras bago matapos and kasunduang ito kung sakaling ang serbisyong itinalaga na iyong gampanan para sa kumpanya ay hindi na kailangan.
								</li>
								<li>
									This Contract shall take effect on the date you will actually report for work and will end on the date indicated above, unless the Contract is sooner terminated.<br>
									Ang kasunduang ito ay magkakabisa sa anumang araw ng iyong panunungkulan sa kumpanya at magtatapos sa petsang nakatakda sa itaas, maliban na lamang kung ang kasunduang ito ay mas maagang ipawalangbisa.
								</li>
								<li>
									The Company expects that you will faithfully perform duties assigned to you to the best of your ability, to devote your full and undivided time to your duties and not to engage or be employed in any other work during your employment with the Company.<br>
									Ang Kompanya ay umaasa na ikaw ay maglilingkod ng may buong katapatan at magbibigay ng serbisyo hanggang sa iyong kakayahan, at hindi kailanman makikipagkasundo o tumanggap ng magtrabaho sa ibang kumpanya habang konektado sa Kompanya.
								</li>
								<li>
									You affirm the truthfulness and correctness of all the information contained in your application for employment, which forms an integral part of this appointment, and any misrepresentation or false information therein shall be sufficient ground for immediate termination of this Contract.<br>
									Pinatotohanan mo ang mga nakasaad sa inyong “application for employment o bio-data” at nauunawaan mo na ang iyong pagbigay ng maling impormasyon ay sapat na dahilan upang ipawalambisa ang Kasunduang ito.
								</li>
								<li>
									At the end of the contracted period specified in this agreement your services shall be terminated without any further notice.<br>
									Sa pagtatapos ng takdang araw ng kontratang pinagkasunduan, ang iyong trabaho/serbisyo sa kumpanya ay kailangang itigil na kahit walang abiso o anumang pagbibilin.
								</li>
								<li>
									You have read and understood the terms and conditions of employment as set forth in this Contract, and the same has been read and explained to you in the dialect you understand and you hereby accept the terms and conditions stipulated above.<br>
									Nabasa at naunawaan mo ang mga patakaran at kautusan na nasasaad sa Kasunduang ito at mga ito ay binasa at ipinaliwanag sa iyo sa wika na iyong naiintindihan, at tinatanggap mo ang nabanggit na mga patakaran at kautusan.
								</li>
								<li>
									You affirm that the information you gave in the course of your application for employment with the company are the truth, and any false information you have given shall be sufficient ground for your termination from employment.<br>
									Iyong pinatutunayan na ang lahat na impormasyon na binigay mo kaugnay sa iyong pag-apply ng trabaho sa Kumpanya ay pawang katotohanan, at anumang maling impormasyon na binigay mo ay sapat na dahilan upang ikaw ay tanggalin sa trabaho.
								</li>
								
							</ol>
						</div>
					</div>
				</form>
			</div>
			<br><br>
			<div class="one">
				<div class="form-group">
					<div class="col-lg-12"><center>___________________________________________<br>Name and Signature of Employee</center></div>
					
				</div>
			</div>

			<div class="one">
				<div class="form-group">
					<div class="col-lg-6"><center>___________________________________________</center></div>
					<div class="col-lg-6" style="font-size:15px">Name and Signature of Company Representative</div>
					
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-1">Date :</div>
			</div>
			
			<br></br>
			Doc No.:  KP-FR-HR1-012 Rev 0<br>
			Effective  16 May 2015
		</div>
	</div>
</div>