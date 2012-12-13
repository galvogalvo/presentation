<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en_US"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<title>R/GA Make Day 2012 - A Better Way To Present</title>

	<link rel="stylesheet" media="screen" href="css/all.css">
	<script src="js/libs/modernizr-2.5.3.min.js"></script>

</head>
<body>




	<div id="present" class="present flexslider">

		<ul id="slides" class="slides">
			<li class="slide" style="background-image: url(img/1.jpg);">
				<h1>Main Title</h1>
			</li>
			<li class="slide" style="background-image: url(img/2.jpg);">
				<h1>Main title</h1>
			</li>
			<li class="slide" style="background-image: url(img/3.jpg);">
				<h1>Main title</h1>
			</li>
			<li class="slide" style="background-image: url(img/4.jpg);">
				<h1>Main title</h1>
			</li>
		</ul>

	</div>



	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="js/libs/jquery.flexslider-min.js"></script>

	<script>
		$(function(){

			var $presentView = $('#present');

			$presentView.flexslider({
				controlNav: false,
				directionNav: true
			});

			positionSlider();

			$(window).resize(function(){
				positionSlider();
			});

			function positionSlider()
			{
				var windowHeight = $(window).height();

				$presentView.find('.slide').css('height', windowHeight + 'px')

				var sliderHeight = $presentView.height();

				$presentView.css({
					'max-height': windowHeight + 'px',
					'margin-top': -sliderHeight / 2 + 'px'
				})
			}


		});
	</script>

</body>
</html>