// Global app namespace
//------------------------------------------------------------------------------------------------------------
var cloudDeck = cloudDeck || {};


cloudDeck.SlideShow = (function() {

	function SlideShow(aoElement, aoOptions)
	{
		this.options = {};

		this.container = aoElement;

		jQuery.extend(this.options, aoOptions || {});

		this.initialize();

		this.attach();
	}

	// Inherit the MicroEvent class
	SlideShow.prototype = new rga.MicroEvent();

	var SlideShowProto = SlideShow.prototype;

	SlideShowProto.initialize = function()
	{
		this.applyTransform(this.getTransform());

		this.slides = this.toElement().find('.slide');
		this.currentSlide = 1;

		this.goToSlide(this.currentSlide);

		return this;
	}

	SlideShowProto.attach = function()
	{
		var _this = this;

		$(window).on('resize', function(aeEvent) {
			_this.applyTransform(_this.getTransform());
		});
	}

	SlideShowProto.getTransform = function()
	{
		var denominator = Math.max(
			document.body.clientWidth / window.innerWidth,
			document.body.clientHeight / window.innerHeight
		);

		return 'scale(' + (1 / denominator) + ')';
	}

	SlideShowProto.applyTransform = function(asTransform)
	{
		document.body.style.WebkitTransform = asTransform;
		   document.body.style.MozTransform = asTransform;
		    document.body.style.msTransform = asTransform;
		     document.body.style.OTransform = asTransform;
		      document.body.style.transform = asTransform;
	}

	SlideShowProto.goToSlide = function(anSlideNumber)
	{
		$('.slide.active').removeClass('active');

		this.currentSlide = parseInt(anSlideNumber, 10);

		$(this.slides[this.currentSlide-1]).addClass('active');
	}

	SlideShowProto.getCurrentSlide = function()
	{
		return this.currentSlide;
	}

	SlideShowProto.getTotalSlides = function()
	{
		return this.slides.length - 2;
	}

	SlideShowProto.start = function()
	{
		return this;
	}

	SlideShowProto.end = function()
	{
		return this;
	}

	SlideShowProto.toElement = function()
	{
		return this.container;
	}

	return SlideShow;

})();
