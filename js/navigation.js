jQuery(document).ready(function($){
	const nav = $( '.small-screen-header .primary-nav' ),
		  btn = $( '#nav-toggle' );
	

	function closeNav( btn, nav ){
		btn.attr( 'aria-pressed', true );
		nav.removeClass( 'open' ).attr( 'aria-expanded', false ).slideUp( 300 );
	}

	function openNav( btn, nav){
		btn.attr( 'aria-pressed', false );
		nav.addClass( 'open' ).attr( 'aria-expanded', true ).slideDown( 300 ); 
	}

	btn.click(function(e){
		
		if ( nav.hasClass( 'open' ) ){
			closeNav( btn, nav);
		} else {
			openNav( btn, nav);
		}
	})

	$(window).resize(function(){
		if ( nav.hasClass( 'open' ) ){
			closeNav( btn, nav);
		}
	})

});