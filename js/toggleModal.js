jQuery(function($){
	
	let modal=$('.small-screen-modal');

	function closeModal( element ){
		element.addClass( 'no-display' ).attr( 'modal-open', false );
	}
	
	function openModal(element){
		element.removeClass( 'no-display' ).attr( 'modal-open', true );
	}

	//toggle the modal when the navbar search icon is clicked
	$('#small-screen-header-search').click(function(){
		openModal(modal);
	});

	//toggle modal when the modal-close button is clicked
	$('.modal-close').click(function(){
		closeModal( modal )
	})

	//close the modal when the window is resized
	$(window).resize(function(){
		if (!modal.hasClass('no-display')){
			closeModal(modal);
		}
	})

	modal.click(function(e){
		closeModal( modal )
	})
	//if user clicks on input, keep modal open
	$('.small-screen-modal input').click(function(e){
		e.stopPropagation();
	})

});