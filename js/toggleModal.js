jQuery(function($){
	
	let modal=$('.small-screen-modal');
	
	function toggleModal(element){
		//if element modal is hiddenn, show it
		if ( element.hasClass('no-display') ){
			element.removeClass('no-display');
		}else{
			//othewise, hide it
			element.addClass('no-display');
		}
	}

	//toggle the modal when the navbar search icon is clicked
	$('.small-screen-header-item').click(function(){
		toggleModal(modal);
	});

	//toggle modal when the modal-close button is clicked
	$('.modal-close').click(function(){
		toggleModal(modal);
	})

	//close the modal when the window is resized
	$(window).resize(function(){
		if (!modal.hasClass('no-display')){
			modal.addClass('no-display');
		}
	})

});