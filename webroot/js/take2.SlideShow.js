// Global app namespace
//------------------------------------------------------------------------------------------------------------
var take2 = take2 || {};


take2.SlideShow = (function() {

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
		this.toElement().flexslider({
			controlNav: false,
			slideshow: false
		});

		this.positionSlideshow();

		return this;
	}

	SlideShowProto.attach = function()
	{
		var _this = this;

		$(window).resize(function(){
			_this.positionSlideshow();
		});
	}

	SlideShowProto.positionSlideshow = function()
	{
		var windowHeight = $(window).height();

		this.toElement().find('.slide').css('height', windowHeight + 'px')

		var slideshowHeight = this.toElement().height();

		this.toElement().css({
			'max-height': windowHeight + 'px',
			'margin-top': -slideshowHeight / 2 + 'px'
		})
	}

	SlideShowProto.start = function()
	{
		console.log('slideshow: start');
		return this;
	}

	SlideShowProto.goTo = function()
	{
		console.log('slideshow: next');

		this.toElement().find('.flex-next').click();

		return this;
	}

	SlideShowProto.end = function()
	{
		console.log('slideshow: end');
		return this;
	}

	SlideShowProto.toElement = function()
	{
		return this.container;
	}

	return SlideShow;

})();
