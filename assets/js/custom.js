const debounce = ( func, delay ) => {
	let inDebounce;

	return function() {
		const context = this;
		const args = arguments;
		clearTimeout( inDebounce );
		inDebounce = setTimeout( () => func.apply( context, args ), delay );
	};
};

// Navigation.
( function() {
	let i, len;

	const container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	const button = document.getElementsByClassName( 'menu-toggle' )[ 0 ];
	if ( 'undefined' === typeof button ) {
		return;
	}

	const menu = container.getElementsByTagName( 'ul' )[ 0 ];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( container.classList.contains( 'active-mobile' ) === false ) {
			this.classList.add( 'btn-active' );
			container.className += ' active-mobile';
			button.setAttribute( 'aria-expanded', 'true' );
		} else {
			this.classList.remove( 'btn-active' );
			container.className = container.className.replace( 'active-mobile', '' );
			button.setAttribute( 'aria-expanded', 'false' );
		}
	};

	// Close small menu when user clicks outside
	document.addEventListener( 'click', function( event ) {
		const isClickInside = container.contains( event.target );

		if ( ! isClickInside ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
		}
	} );

	// Get all the link elements within the menu.
	const links = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[ i ].addEventListener( 'focus', toggleFocus, true );
		links[ i ].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		let self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function() {
		const parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		const touchStartFn = function( e ) {
			const menuItem = this.parentNode;

			if ( ! menuItem.classList.contains( 'focus' ) ) {
				e.preventDefault();
				for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
					if ( menuItem === menuItem.parentNode.children[ i ] ) {
						continue;
					}
					menuItem.parentNode.children[ i ].classList.remove( 'focus' );
				}
				menuItem.classList.add( 'focus' );
			} else {
				menuItem.classList.remove( 'focus' );
			}
		};

		if ( 'ontouchstart' in window ) {
			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[ i ].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
}() );

document.addEventListener( 'DOMContentLoaded', function() {
	const scrollUp = document.getElementById( 'back_to_top' );

	if ( scrollUp ) {
		const scrollHandler = debounce( function() {
			const scrollPosition = window.pageYOffset || document.body.scrollTop;

			if ( scrollPosition > 300 ) {
				scrollUp.classList.add( 'is-visible' );
			} else {
				scrollUp.classList.remove( 'is-visible' );
			}
		}, 250 );

		window.addEventListener( 'scroll', scrollHandler );

		scrollUp.addEventListener( 'click', ( e ) => {
			e.preventDefault();

			window.scrollTo( {
				top: 0,
				behavior: 'smooth',
			} );
		} );
	}
} );

if ( document.body.classList.contains( 'sticky-nav-enabled' ) ) {
	const body = document.body;

	const headerHeight = document.querySelector( '#masthead' ).offsetHeight;
	const scrollUp = 'scroll-up';
	const scrollDown = 'scroll-down';
	let lastScroll = 0;

	window.addEventListener( 'scroll', () => {
		const currentScroll = window.pageYOffset;
		if ( currentScroll <= headerHeight ) {
			body.classList.remove( scrollUp );
			return;
		}

		if ( currentScroll > lastScroll && ! body.classList.contains( scrollDown ) ) {
			// Down.
			body.classList.remove( scrollUp );
			body.classList.add( scrollDown );
		} else if ( currentScroll < lastScroll && body.classList.contains( scrollDown )
		) {
			// Up.
			body.classList.remove( scrollDown );
			body.classList.add( scrollUp );
		}
		lastScroll = currentScroll;
	} );
}

if ( document.body.classList.contains( 'global-layout-masonry' ) || document.body.classList.contains( 'global-layout-list-masonry' ) ) {
	const elem = document.querySelector( '.site-posts-wrap' );

	if ( elem ) {
		const msnry = new Masonry( elem, {
			itemSelector: 'article',
			columnWidth: 'article:nth-child(2)',
		} );

		imagesLoaded( elem ).on( 'progress', function() {
			// Layout Masonry after each image loads.
			msnry.layout();
		} );
	}
}


//toggle search form
const searchIcon = document.querySelector( '.search-icon' );
const searchForm = document.querySelector( '.search-form-wrap' );


searchIcon.addEventListener('click', function(e){
	e.preventDefault();

	searchIcon.classList.toggle('active');
	searchForm.classList.toggle('active');

	/*if( searchIcon.classList.contains( 'active' ) ) {
		searchIcon.classList.toggle
	}*/

});
