/**
* R/GA - MicroEvent.js
*
* @fileoverview Class to manage of "instance" events
*
* @author Benoît Grélard
*/


// Global R/GA namespace
//------------------------------------------------------------------------------------------------------------
var rga = rga || {};


rga.MicroEvent = (function() {

	function MicroEvent(aoOptions) { }

	var MicroEventProto = MicroEvent.prototype;

	MicroEventProto.trigger = function(asEvent, aoData)
	{
		return this.toElement().trigger(asEvent, aoData);
	};

	MicroEventProto.on = function(asEvent, afCallback)
	{
		return this.toElement().on(asEvent, afCallback);
	};

	// Override this method if you have a main element that represents your class in the DOM
	MicroEventProto.toElement = function()
	{
		if(!this.eventEmitterElement)
		{
			this.eventEmitterElement = $('<div style="display: none;"></div>');
			$('body').append(this.eventEmitterElement);
		}

		return this.eventEmitterElement;
	};

	return MicroEvent;

})();
