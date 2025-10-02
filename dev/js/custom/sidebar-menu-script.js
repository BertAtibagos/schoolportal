$(document).ready(function(){
	$.ajax({
		type:'GET',
		url: '../class/session-class.php',
		success: function(data){
			var session = data;
			if(session !== undefined){
				var sessionvalue = session.split(',');
				$('li').each(function(){
					$(this).hide();
				});
				$.each(sessionvalue, function(key, value){
					$('li').each(function(){
						if (this.id == value){
							$(this).show();
							return;
						}
					});
				});
			}
		}
	});
});