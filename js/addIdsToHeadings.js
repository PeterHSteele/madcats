jQuery(function($){
	
		function addHeadingIds(){
			let headingTypes = ['h2','h3','h4','h5','h6'];
			
			for (let i=0; i<headingTypes.length; i++){
				let elements = $(headingTypes[i]);
				
				elements.attr('id',function(){
					return $(this).text().replace(' ','_');
				});

			}
		}

		function toggleDisplay(element){
			if ( element.hasClass('no-display') ){
				element.removeClass('no-display');
				element.slideDown(100);
			} else {
				element.addClass('no-display')
				element.slideUp(100);
			}
		}

		addHeadingIds();



		/*$('.table-of-contents li').on('click',function(){
			toggleDisplay($(this).children());
		})*/
});