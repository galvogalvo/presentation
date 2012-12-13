// Global app namespace
//------------------------------------------------------------------------------------------------------------
var take2 = take2 || {};


if (typeof console == 'undefined') console = { log: function(){} };

Pusher.log = function(message) {
  if (window.console && window.console.log) window.console.log(message);
};


(function(take2){

	// Dom ready
	$(function(){

		var hash = window.location.hash;

		if(hash == '#presenter')
		{
			// var app = new take2.App();
		}

		var app = new take2.App();

	});

})(take2);
