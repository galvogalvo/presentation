<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en_US"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<title><?php echo $pageTitle ?></title>

	<script src="/js/libs/modernizr-2.5.3.min.js"></script>
	<link rel="stylesheet" media="screen" href="/css/all.css">
</head>

<body>

	<div id="content" class="content public-page">
		<span class="logo-cd"></span>
		<span class="logo"><i></i> R/GA</span>
		<?php echo $layoutContent ?>
	</div>

	<?php
	if (isset($requiredJs)) {
		foreach ($requiredJs as $js => $use) {
			echo '<script type="text/javascript" charset="utf-8" src="' . WWW_JS_PATH . $js . '"></script>' . "\n";
		}
	}
	?>

	<script src="/js/libs/jquery-1.8.3.min.js"></script>

</body>
</html>
