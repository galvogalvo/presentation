// Global app namespace
//------------------------------------------------------------------------------------------------------------
var cloudDeck = cloudDeck || {};


cloudDeck.NotificationTray = (function() {

	function NotificationTray(aoElement, aoOptions)
	{
		this.options = {};

		this.container = aoElement;

		jQuery.extend(this.options, aoOptions || {});

		this.initialize();

		this.attach();
	}

	// Inherit the MicroEvent class
	NotificationTray.prototype = new rga.MicroEvent();

	var NotificationTrayProto = NotificationTray.prototype;

	NotificationTrayProto.initialize = function()
	{
		return this;
	}

	NotificationTrayProto.attach = function()
	{
		var _this = this;


	}

	NotificationTrayProto.toElement = function()
	{
		return this.container;
	}

	return NotificationTray;

})();
