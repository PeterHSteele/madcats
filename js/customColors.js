jQuery(function($){
	$(document).ready(function(){
		/*let customStyleTag=$('#wp_custom_css'),currentStyle=customStyleTag.attr('type');
		console.log('colors',colors);
		$('h1').css('color',colors.headingColor);*/
		let customHeaderBackgroundImageStyle;
		
		$('head').append('<style id="custom-styles">');
		
		let customH1Style = 'h1{color:'+styles.headingColor+'!important;}';
		
		if (styles.headerBackgroundImage){
			customHeaderBackgroundImageStyle = 'header.large-screen-header{background-image:url('+styles.headerBackgroundImage+')};'
		} 

		if (styles.footerBackgroundImage){
			customFooterBackgroundImageStyle = 'footer{background-image:url('+styles.footerBackgroundImage+');}';
		}
		/*else {
			customHeaderBackgroundImageStyle = 'header.large-screen-header{background-image:none)};';
		}*/

		$('#custom-styles').append(customH1Style,customHeaderBackgroundImageStyle,customFooterBackgroundImageStyle);
	});
})