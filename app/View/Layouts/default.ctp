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
	try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"e2dc129ef418d464a59b90f774bb1667",petok:"1bc56c52a2fc1452a199fd6211669abd63923459-1421920189-1800",zone:"adbee.technology",rocket:"0",apps:{"ga_key":{"ua":"UA-49262924-2","ga_bs":"2"}}}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="//ajax.cloudflare.com/cdn-cgi/nexp/dok3v%3d919620257c/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
	//]]>
	</script>

	<link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css" />
	
	<!-- libraries -->
	<link rel="stylesheet" type="text/css" href="/css/libs/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="/css/libs/nanoscroller.css" />

	<!-- global styles -->
	<link rel="stylesheet" type="text/css" href="/css/compiled/theme_styles.css" />
	
	<!-- Favicon -->
	<link type="image/x-icon" href="favicon.png" rel="shortcut icon" />

	<!-- google font libraries -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
	
</head>

<body class="theme-whbl pace-done">


	<div id="theme-wrapper">
		<?php echo $this->element('defaultLayout/header'); ?>

		<div id="page-wrapper" class="container">
			<div class="row">
				<?php echo $this->element('defaultLayout/right_nav'); ?>

				<!-- Content Section -->
				<div id="content-wrapper">
					<?php echo $this->fetch('content'); ?>
				</div>

			</div>
		</div>
	</div>


	<?php //echo $this->element('sql_dump'); ?>

	<!-- global scripts -->
	<script src="/js/demo-skin-changer.js"></script> <!-- only for demo -->
	
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jquery.nanoscroller.min.js"></script>

	<!-- theme scripts -->
	<script src="/js/scripts.js"></script>
	<script src="/js/pace.min.js"></script>

</body>
</html>