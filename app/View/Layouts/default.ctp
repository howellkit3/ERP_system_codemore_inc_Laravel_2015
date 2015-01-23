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
								<div class="row">
								    <div class="col-lg-12">
								        <div id="content-header" class="clearfix">
								            <div class="pull-left">

								                <h1>Dashboards</h1>
								                <ol class="breadcrumb">
								                    <?php 
									                    echo $this->Html->getCrumbs(' > ', array(
														    'text' => 'Home',
														    'url' => array('controller' => 'dashboards', 'action' => 'index','plugin' => false),
														    'escape' => false
														));
								                    ?>

								                </ol>
								                
								            </div>

								            <div class="pull-right hidden-xs">
								                <div class="xs-graph pull-left">
								                    <div class="graph-label">
								                        <b><i class="fa fa-shopping-cart"></i> 838</b> Orders
								                    </div>
								                    <div class="graph-content spark-orders"></div>
								                </div>

								                <div class="xs-graph pull-left mrg-l-lg mrg-r-sm">
								                    <div class="graph-label">
								                        <b>&dollar;12.338</b> Revenues
								                    </div>
								                    <div class="graph-content spark-revenues"></div>
								                </div>
								            </div>
								        </div>
								    </div>
								</div>
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