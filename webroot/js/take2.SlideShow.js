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
	}

	// Inherit the MicroEvent class
	SlideShow.prototype = new rga.MicroEvent();

	var SlideShowProto = SlideShow.prototype;

	SlideShowProto.initialize = function()
	{
		return this;
	}

	SlideShowProto.start = function()
	{
		console.log('slideshow: start');
		return this;
	}

	SlideShowProto.previous = function()
	{
		console.log('slideshow: previous');
		return this;
	}

	SlideShowProto.next = function()
	{
		console.log('slideshow: next');
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
