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
		this.isLeader = $('body').attr('data-is-leader');

		// Realtime messaging
		this.pusher = new Pusher('20431aa4f88c671606eb');
		this.channel = this.pusher.subscribe('slideshow-' + this.slideshowId);

		// Application Components
		this.slideshow = new cloudDeck.SlideShow($('#slideshow'));
		this.notificationTray = new cloudDeck.NotificationTray($('#notification-tool'));

		this.totalSlides = this.slideshow.getTotalSlides();

		return this;
	}

	AppProto.attach = function()
	{
		var _this = this;

		// Leader
		if(this.isLeader == 'true')
		{
			if(!$('body').hasClass('touch'))
			{
				$('slideshow').swipe({
					swipeLeft: function()  { _this.requestGoTo(_this.slideshow.getCurrentSlide() + 1); },
					swipeRight: function() { _this.requestGoTo(_this.slideshow.getCurrentSlide() - 1); },
				});
			}

			$(document).on('keyup', function(aeEvent){

				switch(aeEvent.keyCode)
				{
					case 37: _this.requestGoTo(_this.slideshow.getCurrentSlide() - 1); break;
					case 39: _this.requestGoTo(_this.slideshow.getCurrentSlide() + 1); break;
				}

			});

			this.channel.bind('join', function(asName) {
				_this.onJoinReceived(asName);
			});

			this.channel.bind('ask', function(aoData) {
				_this.onAskReceived(aoData);
			});
		}

		// Viewer
		else
		{
			$('.question-flag a').on('click', function(aeEvent){
				aeEvent.preventDefault();
				aeEvent.stopPropagation();
				_this.requestAsk();
			});
		}

		// Everyone
		this.channel.bind('goTo', function(anPageNumber) {
			_this.onGoToReceived(anPageNumber);
		});

		return this;
	}

	AppProto.onJoinReceived = function(asName){
		var joined = $('<li><strong>' + asName + '</strong> just joined.</li>');
		$('#join-notifications').append(joined);
		setTimeout(function(){
			joined.remove();
		}, 10000);
	}

	AppProto.onGoToReceived = function(anPageNumber)
	{
		if((anPageNumber - 1) > 0 && anPageNumber <= this.totalSlides + 1)
		{
			$('.question-flag').removeClass('inactive');
			$('#slide-progress').html('<strong>' + (anPageNumber - 1) + '</strong>/' + this.totalSlides);
		}
		else
		{
			$('.question-flag').addClass('inactive');
			$('#slide-progress').html('');
		}

		this.slideshow.goToSlide(anPageNumber);
	}

	AppProto.onAskReceived = function(aoData)
	{
		this.notificationTray.add('Question from <strong>' + aoData.name + '</strong>. (slide ' + (aoData.slide - 1) + ')');
	}

	AppProto.requestGoTo = function(anPageNumber)
	{
		if(anPageNumber > 0 && anPageNumber <= (this.totalSlides + 2))
		{
			$.getJSON('/slide/goTo?id=' + this.slideshowId + '&slide=' + anPageNumber)
				.success(function(aoData){ console.log('goTo success', aoData); })
				.error(function(){ console.log('goTo error'); });
		}
	}

	AppProto.requestAsk = function()
	{
		$.getJSON('/slide/ask?id=' + this.slideshowId + '&slide=' + this.slideshow.getCurrentSlide())
			.success(function(aoData){ console.log('ask success', aoData); })
			.error(function(){ console.log('ask error'); });
	}

	return App;

})();
