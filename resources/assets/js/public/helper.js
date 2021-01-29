(function () {
	window.scroll_hidden = function (modal, comp) {
		if (!window.overlay || (window.overlay && comp == window.overlay)) {
			let coef = document.documentElement.scrollHeight - window.innerHeight;
			if (document.body.classList.contains('_scroll_hidden')) {
				setTimeout(function () {
					document.body.classList.remove('_scroll_hidden');
					document.body.removeAttribute("style")
					if (modal === 'modal') {
						window.scrollTo(0, window._scrollTop)
					}
				}, 10)

				window.overlay = false;
			} else {
				let scrollTop = window.pageYOffset;

				if (coef > 0) {
					let offset = window.innerWidth - document.body.clientWidth;
					document.body.style.marginRight = offset + 'px';
				}
				document.body.classList.add('_scroll_hidden');

				if (modal === 'modal') {
					document.body.style.position = 'fixed';
					document.body.style.top = '-' + scrollTop + 'px';
					window._scrollTop = scrollTop;
				}
				window.overlay = comp;
			}
		}
	};
})();
