<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en_US"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=1274, user-scalable=no">


	<title><?php echo $pageTitle ?></title>

	<script src="/js/libs/modernizr-2.5.3.min.js"></script>
	<link rel="stylesheet" media="screen" href="/css/all.css">
</head>

<body class="full<?php if($isLeader == 'true'){ echo ' leader'; } else { echo ' viewer'; } ?>" data-presentation-id="<?php echo $presentationId; ?>" data-is-leader="<?php echo $isLeader; ?>">

	<ul id="join-notifications" class="join-notifications"></ul>

	<div id="notification-tool" class="notification-tool no-notifications">
		<div class="comment">
			?
			<span class="number none">0</span>
		</div>
		<div class="mask"></div>
		<ul class="tray"></ul>
	</div>

	<div class="question-flag notification-tool inactive">
		<a href="#" title="Flag for question" class="comment">?</a>
	</div>

	<section id="slideshow" class="slideshow">

		<div class='slide'>
			<div>
				<section>
					<span class='logo faded'><i></i> R/GA</span>
					<img src="/img/wait.png">
				</section>
			</div>
		</div>

		<?php echo $layoutContent ?>

		<div class='slide'>
			<div>
				<section>
					<span class='logo faded'><i></i> R/GA</span>
					<header>
						<h1>Is CloudDeck gonna win?</h1>
						<h2>Please answer on your device.</h2>
					</header>
					<div class="poll">
						<a class="poll-button poll-yes" data-poll-value="1" href="#">YES</a>
						<a class="poll-button poll-no" data-poll-value="0" href="#">NO</a>

						<div id="results" class="poll-results">
							<div data-result="YES" class="poll-result result-yes"><span></span></div>
							<div data-result="NO" class="poll-result result-no"><span></span></div>
						</div>
					</div>
				</section>
			</div>
		</div>

		<div class='slide'>
			<div>
				<section>
					<span class='logo faded'><i></i> R/GA</span>
					<img src="/img/end.png">
				</section>
			</div>
		</div>

		<div id="slide-progress" class="slide-progress"></div>

	</section> <!-- /. #slideshow -->



	<script src="http://js.pusher.com/1.12/pusher.min.js"></script>
	<script src="/js/libs/jquery-1.8.3.min.js"></script>

	<script src="/js/rga.MicroEvent.js"></script>
	<script src="/js/cloudDeck.SlideShow.js"></script>
	<script src="/js/cloudDeck.NotificationTray.js"></script>
	<script src="/js/cloudDeck.App.js"></script>

	<script src="/js/libs/jquery.swipe.js"></script>

	<script src="/js/script.js"></script>
</body>
</html>