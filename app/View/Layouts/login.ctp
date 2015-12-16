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

		echo $this->Html->css(array('bootstrap/bootstrap.min',
            'font-awesome/css/font-awesome',
            'libs/nanoscroller',
            'compiled/theme_styles',
            'global'
        ));

    ?>

    <?php echo $this->Html->css('fonts.css'); ?>

    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'> -->

    <link type="image/x-icon" href="favicon.png" rel="shortcut icon"/>

	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
	
</head>

<body id="login-page-full">
	<!-- <div id="login-full-wrapper"> -->
		<div class="container">
			<?php echo $this->fetch('content'); ?>
		</div>
	<!-- </div> -->
	
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
        echo $this->Html->script('scripts');
        echo $this->Html->script('demo-rtl');
        echo $this->Html->script('jquery.nanoscroller.min');
        

    ?>
	
	<!-- this page specific inline scripts -->
	
</body>
</html>