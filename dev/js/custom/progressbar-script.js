$(document).ready(function(){
	$(function() {
		var progressbar = $( "#progressbar" ),
			progressLabel = $( ".progress-label" );
			progressbarValue = progressbar.find( ".ui-progressbar-value" );
		progressbar.progressbar({
		  value: false
		});
		//progressbar.progressbar({
		  //value: false,
		  // change: function() {
			// progressLabel.text( progressbar.progressbar( "value" ) + "%" );
		  // },
		  // complete: function() {
			// progressLabel.text( "Load Complete!" );
		  // }
		//});
	 
		// function progress() {
		  // var val = progressbar.progressbar( "value" ) || 0;
	 
		  // progressbar.progressbar( "value", val + 1 );
	 
		  // if ( val < 99 ) {
			// setTimeout( progress, 10 );
		  // }
		// }
		//setTimeout( progress, 100 );
  });
});