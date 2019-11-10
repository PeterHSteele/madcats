jQuery(function($){
	$(document).ready(function(){
		
		let customHeaderBackgroundImageStyle;
		
		$('head').append('<style id="custom-styles">');
		
		let customH1Style = 'h1{color:'+styles.headingColor+'!important;}';
		
		if (styles.headerBackgroundImage){
			customHeaderBackgroundImageStyle = 'header.large-screen-header{background-image:url('+styles.headerBackgroundImage+')};'
		} 

		if (styles.footerBackgroundImage){
			customFooterBackgroundImageStyle = 'footer{background-image:url('+styles.footerBackgroundImage+');}';
		}
		

		$('#custom-styles').append(customH1Style,customHeaderBackgroundImageStyle,customFooterBackgroundImageStyle);
	});
})