$(function() {
	$(document).on('click', '.notify', function() {
		var that = $(this);

		that.slideUp(300, function(){
			that.remove();
		})
	})

  	setInterval(function(){
  		if ( $('.notify').length ) {
  			var now = new Date(),
				time = Date.parse(now),
				second = $('.notify:last-child').data('time');

			if ( time - parseInt(second) > 5000 ) {
				$('.notify:last-child:not(:hover)').slideUp(300, function(){
					$('.notify:last-child').remove();
				})
			}
  		}
  	},2000)

});

function addNotify($notifyContent, $notifyType, $notifyName) {
	var now = new Date(),
		time = Date.parse(now);

	if ($notifyType == 'success') {
		var $svg = '<svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>';
	}
	if ($notifyType == 'error') {
		var $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11 15h2v2h-2zm0-8h2v6h-2zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/></svg>';
	}
	if ($notifyType == 'info') {
		var $svg = '<svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"/><path d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z"/></svg>';
	}

	if ( $('.notify').length > 3 ) {
		$('.notify:last-child:not([data-hover])').slideUp(300, function(){
			$('.notify:last-child').remove();
		})
	}

	$('.error-container').prepend(
		'<div class="notify '+$notifyType+'-notify no_active" data-time="'+time+'">'
	    +    '<div class="notify-icon notify-content">'
	    +        ''+$svg+''
	    +    '</div>'
	    +    '<div class="notify-message notify-content">'
	    +        '<p>'+$notifyName+'</p>'
	    +        '<p>'+$notifyContent+'</p>'
	    +    '</div>'
	    +'</div>'
	)

	setTimeout(function(){
		$('.notify').removeClass('no_active');
	},50)
}