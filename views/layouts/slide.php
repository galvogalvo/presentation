<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en_US"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=1274, user-scalable=no">


	<title>cloudDeck - A Better Way To Present</title>

	<script src="/js/libs/modernizr-2.5.3.min.js"></script>
	<link rel="stylesheet" media="screen" href="/css/all.css">
</head>

<body class="full" data-presentation-id="<?php echo $presentationId; ?>" data-is-leader="<?php echo $isLeader; ?>">

	<div id="notification-tool" class="notification-tool">
		<div class="comment">
			<span class="number none">0</span>
		</div>
		<div class="mask"></div>
		<ul class="tray"></ul>
	</div>

	<div class="question-flag">
		<a href="#" title="Flag for question">Flag for question</a>
	</div>

	<section id="wait" class="extra-slide"><h1>Wait</h1></section>
	<section id="end" class="extra-slide"><h1>the End</h1></section>

	<section id="slideshow" class="slideshow">

		<?php echo $layoutContent ?>

	</section> <!-- /. #slideshow -->


	<script src="http://js.pusher.com/1.12/pusher.min.js"></script>
	<script src="/js/libs/jquery-1.8.3.min.js"></script>

	<script src="/js/rga.MicroEvent.js"></script>
	<script src="/js/cloudDeck.SlideShow.js"></script>
	<script src="/js/cloudDeck.NotificationTray.js"></script>
	<script src="/js/cloudDeck.App.js"></script>

	<script src="/js/script.js"></script>
</body>
</html>