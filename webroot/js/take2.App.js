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
		this.pusher = new Pusher('20431aa4f88c671606eb');
		this.controlsChannel = this.pusher.subscribe('controls');
		this.actionsChannel = this.pusher.subscribe('actions');

		return this;
	}

	AppProto.attach = function()
	{
		var _this = this;

		// Controls

		this.controlsChannel.bind('start', function(aoData) {
			_this.onControlsStart(aoData);
		});

		this.controlsChannel.bind('previous', function(aoData) {
			_this.onControlsPrevious(aoData);
		});

		this.controlsChannel.bind('next', function(aoData) {
			_this.onControlsNext(aoData);
		});

		this.controlsChannel.bind('end', function(aoData) {
			_this.onControlsEnd(aoData);
		});


		// Actions

		this.actionsChannel.bind('ask', function(aoData) {
			_this.onActionsAsk(aoData);
		});

		return this;
	}

	AppProto.onControlsStart = function(aoData)
	{

	}

	AppProto.onControlsPrevious = function(aoData)
	{

	}

	AppProto.onControlsNext = function(aoData)
	{

	}

	AppProto.onControlsEnd = function(aoData)
	{

	}

	AppProto.onActionsAsk = function(aoData)
	{

	}

	return App;

})();
