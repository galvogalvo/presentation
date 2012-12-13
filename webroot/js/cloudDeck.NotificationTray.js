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
		this.mask = this.toElement().find('.mask');
		this.comment = this.toElement().find('.comment');
		this.count = this.toElement().find('.number');
		this.tray = this.toElement().find('.tray');

		this.currentCount = parseInt(this.count.text(), 10);

		return this;
	}

	NotificationTrayProto.attach = function()
	{
		var _this = this;

		this.comment.click(function(aeEvent){
			aeEvent.stopPropagation();
			_this.open();
		});

		this.mask.click(function(aeEvent){
			aeEvent.stopPropagation();
			_this.close();
		});

		this.toElement().on('click', '.dismiss-notification', function(aeEvent){
			aeEvent.stopPropagation();
			_this.remove($(this).parent('li'));
		});
	}

	NotificationTrayProto.getCurrentCount = function()
	{
		return this.currentCount;
	}

	NotificationTrayProto.updateCount = function(anCount)
	{
		var _this = this;

		this.currentCount = anCount;

		if(this.currentCount == 0)
		{
			this.count.addClass('none');
		}
		else
		{
			this.count.removeClass('none');
		}

		this.count.text(this.currentCount);
		this.count.addClass('new');

		setTimeout(function(){
			_this.count.removeClass('new');
		}, 600);

		return this;
	}

	NotificationTrayProto.add = function(asMessage)
	{
		this.tray.prepend('<li>' + asMessage + '<a class="dismiss-notification" href="#">√</a></li>');
		this.updateCount(this.getCurrentCount() + 1);
	}

	NotificationTrayProto.remove = function(aoElement)
	{
		aoElement.remove();
		this.updateCount(this.getCurrentCount() - 1);
	}

	NotificationTrayProto.open = function()
	{
		this.toElement().addClass('open').removeClass('close');

		return this;
	}

	NotificationTrayProto.close = function()
	{
		this.toElement().addClass('close').removeClass('open');

		return this;
	}

	NotificationTrayProto.toElement = function()
	{
		return this.container;
	}

	return NotificationTray;

})();
