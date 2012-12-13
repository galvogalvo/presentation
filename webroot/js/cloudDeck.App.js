// Global app namespace
//------------------------------------------------------------------------------------------------------------
var take2 = take2 || {};


take2.App = (function() {

	function App(aoElement, aoOptions)
	{
		this.options = {};

		jQuery.extend(this.options, aoOptions || {});

		this.initialize();

		this.attach();
	}

	// Inherit the MicroEvent class
	App.prototype = new rga.MicroEvent();

	var AppProto = App.prototype;

	AppProto.initialize = function()
	{
		// Realtime messaging
		this.pusher = new Pusher('20431aa4f88c671606eb');
		this.channel = this.pusher.subscribe('slideshow-1');

		// Application Components
		this.slideshow = new take2.SlideShow($('#slideshow'));

		return this;
	}

	AppProto.attach = function()
	{
		var _this = this;

		$('body').on('click', function(){
			console.log('sfkdsfkjshdk');
			_this.requestGoTo(4);
		})

		// Controls
		this.channel.bind('start', function(aoData) {
			_this.onStartReceived(aoData);
		});

		this.channel.bind('goTo', function(anPageNumber) {
			_this.onGoToReceived(anPageNumber);
		});

		this.channel.bind('end', function(aoData) {
			_this.onEndReceived(aoData);
		});


		// Actions
		this.channel.bind('ask', function(aoData) {
			_this.onAskReceived(aoData);
		});

		return this;
	}

	AppProto.onStartReceived = function(aoData)
	{
		this.slideshow.start();
	}

	AppProto.onGoToReceived = function(anPageNumber)
	{
		this.slideshow.goToSlide(anPageNumber);
	}

	AppProto.onEndReceived = function(aoData)
	{
		this.slideshow.end();
	}

	AppProto.onAskReceived = function(aoData)
	{

	}





	AppProto.requestStart = function()
	{
		$.getJSON('/slide/start?id=1')
			.success(function(aoData){ console.log('start success', aoData); })
			.error(function(){ console.log('start error'); });
	}

	AppProto.requestGoTo = function(anPageNumber)
	{
		$.getJSON('/slide/goTo?id=1&slide=' + anPageNumber)
			.success(function(aoData){ console.log('goTo success', aoData); })
			.error(function(){ console.log('goTo error'); });
	}

	AppProto.requestEnd = function()
	{
		$.getJSON('/slide/end?id=1')
			.success(function(aoData){ console.log('end success', aoData); })
			.error(function(){ console.log('end error'); });
	}

	AppProto.requestAsk = function()
	{
		$.getJSON('/slide/ask?id=1&slide=' + this.slideshow.getCurrentSlide())
			.success(function(aoData){ console.log('ask success', aoData); })
			.error(function(){ console.log('ask error'); });
	}

	return App;

})();
