jQuery(function($){
	
		function addHeadingIds(){
			let headingTypes = ['h2','h3','h4','h5','h6'];
			
			for (let i=0; i<headingTypes.length; i++){
				let elements = $( headingTypes[i] );
				
				elements.attr('id',function(){
					return $(this).text().replace(' ','_');
				});

			}
		}

		function showSubmenu(element){
			element.slideDown().removeClass('no-display');
		}

		function hideSubmenu ( element ) {
			element.slideUp().addClass('no-display');
		}

		function toggleDisplay(element){
			if ( element.hasClass('no-display') ){
				showSubmenu( element );
			} else {
				hideSubMenu( element );
				//element.parent().removeClass('child-open');
			}
		}
/*
		function changeArrowIconDirection(element){
			if ( element.hasClass('fa-arrow-down')){
				element.attr('class','fa fa-arrow-up');
			} else {
				element.attr('class','fa fa-arrow-down');
			}
		}

		function changeArrowIconDirection(element){
			if ( element.hasClass('fa-arrow-down') ){
				element.attr('class','fa fa-arrow-up shake');
				setTimeout(function(){
					element.removeClass('shake');
				},1000);
			} else {
				element.attr('class','fa fa-arrow-down shake');
				setTimeout(function(){
					element.removeClass('shake');
				},1000);
			}
		}
*/

		function changeArrowIconDirection(element){
				let degrees;
				let style = element.css('transform');
				if ( style != 'none' ) {
					let values = style.split('(')[1];
					values = values.split(')')[0];
					values = values.split(',');
					let a = values[0],b=values[1];
					/*let scale = Math.sqrt(a*a+b*b);
					let sin = b/scale;*/
					degrees = Math.round(Math.atan2(b,a)*(180/Math.PI));
				} else {
					degrees = 0;
				}

				let limit = degrees + 180;
				//let regex = /d+/
				//let degrees = rotation==='none'?0:rotation.match(regex), timer;
				//console.log('rotation',angle);
				let loop = setInterval(function(){
					if (degrees<limit){
						degrees+=5;
						element.css('transform','rotate('+degrees+'deg)');
					}else{
						clearInterval(loop);
					}
				},8)
		} 

		addHeadingIds();

		$('.table-of-contents li i').on('click',function(){
			/*if ($(this).parent().hasClass('child-open')){
				console.log('returning');
				return;
			} else {*/
				//$(this).parent().addClass('child-open');
				changeArrowIconDirection($(this));

				childSubmenu = $(this).parent().children('ul');

				childSubmenuIsOpen = !childSubmenu.hasClass('no-display');
				if ( childSubmenuIsOpen ){
					hideSubmenu( childSubmenu );
					/*childSubmenu.find('ul').each(function(){
						hideSubmenu($(this));
						arrowButton = $(this).parent().children('i')
						arrowButton.css('transform','none');
					});*/
				} else {
					showSubmenu ( childSubmenu );
				}
			//}
		})
});