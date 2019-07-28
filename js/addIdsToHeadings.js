jQuery(function($){
	$(document).ready(function{
		$('h2').attr('id',function(){
			return $(this).text().replace(' ','_');
		})
	});
});