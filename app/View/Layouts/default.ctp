<?php
	/* --------------------- 
	// @name KoufuNet
	// @desc ERP system to help ease all staff of Koufu Color Printing Corporation
	//
	// @author Jr Relampagos - Systems Architect
	// @author Bien Relampagos - Systems Dev
	// @author Irvin Llanora - Systems Dev
	// @date Jan 22, 2015
	// @developed Codemore Web Development Services
	// @website www.codemoreph.com
	// @email info@codemoreph.com
	*/
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>KoufuNet :: ERP Solution</title>
		
		<!-- bootstrap -->
		<script type="text/javascript">
			//<![CDATA[
			try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"e2dc129ef418d464a59b90f774bb1667",petok:"674c4d58f92e2be71d353931fa99445a1a99e8b2-1421920199-1800",zone:"adbee.technology",rocket:"0",apps:{"ga_key":{"ua":"UA-49262924-2","ga_bs":"2"}}}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="../ajax.cloudflare.com/cdn-cgi/nexp/dok3v%3d919620257c/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
			//]]>
		</script>
		<?php

			echo $this->fetch('meta');
			echo $this->Html->css(array('bootstrap/bootstrap.min',
	            'font-awesome/css/font-awesome',
	            'libs/nanoscroller',
	            'compiled/theme_styles',
	            'global',
	            'libs/daterangepicker',
	            'libs/jquery-jvectormap-1.2.2',
	            'libs/weather-icons'
	        ));

	    ?>

	    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
	    <link type="image/x-icon" href="favicon.png" rel="shortcut icon"/>

	  
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
		
	</head>

	<body id="login-page-full">

		<div id="theme-wrapper">
			<?php echo $this->element('defaultLayout/header'); ?>

			<div id="page-wrapper" class="container">
				<div class="row">
					<?php echo $this->element('defaultLayout/right_nav'); ?>

					<!-- Content Section -->
					<div id="content-wrapper">
						<div class="row">
							<div class="col-lg-12">
								<?php echo $this->fetch('content'); ?>
							</div>
						</div>
						<footer id="footer-bar" class="row">
							<p id="footer-copyright" class="col-xs-12">
								Powered by Cube Theme.
							</p>
						</footer>
					</div>

				</div>
			</div>
		</div>


		<?php //echo $this->element('sql_dump'); ?>

		<!-- global scripts -->
	 
		 <?php
		 	// SCRIPTS
	        echo $this->Html->script('demo-skin-changer');
	        echo $this->Html->script('jquery');
	        echo $this->Html->script('bootstrap');
	        echo $this->fetch('meta');
	        echo $this->fetch('css');
	        echo $this->fetch('script');
	        echo $this->Html->script('jquery.nanoscroller.min');
	        echo $this->Html->script('demo');
	        echo $this->Html->script('moment.min');
	        echo $this->Html->script('jquery-jvectormap-1.2.2.min');
	        echo $this->Html->script('jquery-jvectormap-world-merc-en');
	        echo $this->Html->script('gdp-data');
	        echo $this->Html->script('flot/jquery.flot.min');
	        echo $this->Html->script('flot/jquery.flot.resize.min');
	        echo $this->Html->script('flot/jquery.flot.time.min');
	        echo $this->Html->script('flot/jquery.flot.threshold');
	        echo $this->Html->script('flot/jquery.flot.axislabels');
	        echo $this->Html->script('jquery.sparkline.min');
	        echo $this->Html->script('skycons');
	        //theme scripts
	        echo $this->Html->script('scripts');
	        echo $this->Html->script('pace.min');
	        
	    ?>
    
	</body>
</html>