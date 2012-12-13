// Global app namespace
//------------------------------------------------------------------------------------------------------------
var cloudDeck = cloudDeck || {};


cloudDeck.App = (function() {

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
		this.slideshowId = $('body').attr('data-presentation-id');

		// Realtime messaging
		this.pusher = new Pusher('20431aa4f88c671606eb');
		this.channel = this.pusher.subscribe('slideshow-' + this.slideshowId);

		// Application Components
		this.slideshow = new cloudDeck.SlideShow($('#slideshow'));
		this.notificationTray = new cloudDeck.NotificationTray($('#notification-tool'));

		return this;
	}

	AppProto.attach = function()
	{
		var _this = this;

		$('body').on('click', function(){
			_this.requestGoTo(_this.slideshow.getCurrentSlide() + 1);
		});

		$('.question-flag a').on('click', function(aeEvent){
			aeEvent.preventDefault();
			aeEvent.stopPropagation();
			_this.requestAsk();
		});

		// Events
		this.channel.bind('join', function(asName) {
			_this.onJoinReceived(asName);
		});

		this.channel.bind('start', function(aoData) {
			_this.onStartReceived(aoData);
		});

		this.channel.bind('goTo', function(anPageNumber) {
			_this.onGoToReceived(anPageNumber);
		});

		this.channel.bind('end', function(aoData) {
			_this.onEndReceived(aoData);
		});

		this.channel.bind('ask', function(aoData) {
			_this.onAskReceived(aoData);
		});

		return this;
	}

	AppProto.onJoinReceived = function(asName){
		this.notificationTray.add('<span class="name">' + asName + '</span> just joined.');
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
		this.notificationTray.add('Question from <span class="name">' + aoData.name + '</span> (slide: ' + aoData.slide + ').');
	}





	AppProto.requestStart = function()
	{
		$.getJSON('/slide/start?id=' + this.slideshowId)
			.success(function(aoData){ console.log('start success', aoData); })
			.error(function(){ console.log('start error'); });
	}

	AppProto.requestGoTo = function(anPageNumber)
	{
		$.getJSON('/slide/goTo?id=' + this.slideshowId + '&slide=' + anPageNumber)
			.success(function(aoData){ console.log('goTo success', aoData); })
			.error(function(){ console.log('goTo error'); });
	}

	AppProto.requestEnd = function()
	{
		$.getJSON('/slide/end?id=' + this.slideshowId)
			.success(function(aoData){ console.log('end success', aoData); })
			.error(function(){ console.log('end error'); });
	}

	AppProto.requestAsk = function()
	{
		$.getJSON('/slide/ask?id=' + this.slideshowId + '&slide=' + this.slideshow.getCurrentSlide())
			.success(function(aoData){ console.log('ask success', aoData); })
			.error(function(){ console.log('ask error'); });
	}

	return App;

})();
