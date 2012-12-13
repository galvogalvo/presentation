// Global app namespace
//------------------------------------------------------------------------------------------------------------
var cloudDeck = cloudDeck || {};


if (typeof console == 'undefined') console = { log: function(){} };

Pusher.log = function(message) {
  if (window.console && window.console.log) window.console.log(message);
};


(function(cloudDeck){

	// Dom ready
	$(function(){

		var app = new cloudDeck.App();

	});

})(cloudDeck);
