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

<body class="full" data-presentation-id="<?php echo $presentationId; ?>">

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

	<section id="slideshow" class="slideshow">

		<span class="logo-cd-small"></span>
		<span class="logo faded"><i></i> R/GA</span>

		<?php echo $layoutContent ?>

		<div class="slide" id="Cover">
			<div>
				<section>
					<header>
						<h1>Make Day <span class="highlight">/</span></h1>
						<h2>TAKE 2</h2>
					</header>
					<p><strong>A Better Way To Present.</strong></p>
					<p>Halloumipsum dolor sit amet, consectetur adipiscing elit. Middle East rhoncus urna, at semper turpis egestas et. Grilled scelerisque mollis ipsum, id gravida orci viverra sed. Sed sodales dictum ultrices. Etiam nec erat sed ante elementum accumsan nec sit amet nulla.</p>
					<img src="/img/1.jpg" alt="">
				</section>
			</div>
		</div>

		<div class="slide" id="Header">
			<div>
				<section>
					<header>
						<h1>Header</h1>
					</header>
					<p>This <code>&lt;tool&gt;</code> is provided <strong>without</strong> warranty, guarantee, or much in the way of explanation. Note that use of this tool may or may not crash <em>your</em> browser.</p>
					<p><a href="examples/index.htm" target="_blank">This link will be opened in the new tab</a></p>
					<!-- <iframe src="http://www.youtube.com/embed/DvAlZMbqhsw" frameborder="0" allowfullscreen></iframe> -->
				</section>
			</div>
		</div>

		<div class="slide" id="TwoLinesHeader">
			<div>
				<section>
					<header>
						<h1>Two rows.<br>Mighty heading</h1>
					</header>
					<p>This <code>&lt;tool&gt;</code> is provided <strong>without</strong> warranty, guarantee, or much in the way of explanation. Note that use of this tool may or may not crash <em>your</em> browser.</p>
				</section>
			</div>
		</div>

		<div class="slide" id="ThankYou">
			<div>
				<section>
					<header>
						<h1>Shower Presentation Template</h1>
					</header>
					<p>Vadim Makeev, Opera Software</p>
					<ul>
						<li><a href="http://pepelsbey.net">pepelsbey.net</a></li>
						<li><a href="http://twitter.com/pepelsbey">twitter.com/pepelsbey</a></li>
						<li><a href="mailto:pepelsbey@gmail.com">pepelsbey@gmail.com</a></li>
					</ul>
					<p>Shower: <a href="http://github.com/pepelsbey/shower">github.com/pepelsbey/shower</a></p>
				</section>
			</div>
		</div>

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