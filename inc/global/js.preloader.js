/*   ___       __             __       ___      ___   ___  __    __       _______.    _______  __    __
    /   \     |  |           |  |     /   \     \  \ /  / |  |  |  |     /       |   |   ____||  |  |  |
   /  ^  \    |  |           |  |    /  ^  \     \  V  /  |  |  |  |    |   (----`   |  |__   |  |  |  |
  /  /_\  \   |  |     .--.  |  |   /  /_\  \     >   <   |  |  |  |     \   \       |   __|  |  |  |  |
 /  _____  \  |  `----.|  `--'  |  /  _____  \   /  .  \  |  `--'  | .----)   |    __|  |____ |  `--'  |
/__/     \__\ |_______| \______/  /__/     \__\ /__/ \__\  \______/  |_______/    (__)_______| \______/
*/
/*
///////////////////////////////////////////////////////////
///////////////////////// PRELOADER ///////////////////////
///////////////////////////////////////////////////////////
*/
// {
// 	$(document).ready(function() {
// 		$('#loader-wrapper').html(null);
// 		console.log('-------------------------------');
// 		$('body').addClass('loaded');
// 		console.log('Disabled preloader');
// 		console.log('-------------------------------');
// 	});
// }


{
	$(document).ready(function() {
		console.log('***************************************************');
		console.log('Preloader - start');
		let status = Cookies.get('preloader');

		console.log('Preloader cookie = '+status);
		if (status == 'false') {
			$('#loader-wrapper').remove();
			console.log('|_ Removing preloader wrapper');
			console.log('|_ Skipping preloader element');

		} else if (status == 'undefined' || status == undefined) {
			$('#loader-wrapper').append('<div id="loader"></div><div class="loader-section section-left"></div><div class="loader-section section-right"></div>');
			Cookies.set('preloader', true);
			console.log('|_ Adding preloader element');
			console.log('|_ Set "preloader" cookie to "true"');

		} else if (status == 'true'){
			console.log('|_ Adding preloader element');
			$('#loader-wrapper').append('<div id="loader"></div><div class="loader-section section-left"></div><div class="loader-section section-right"></div>');


		} else {
			console.log('Preloader -> ERROR -> Cookies.get(\'preloader\') == '+status);
		}

		$('body').css('opacity', '1');
		console.log('Preloader - removed body opacity');
		console.log('Preloader - process completed');
	});
	$(window).on("load", function(){
		$('body').addClass('loaded');
		console.log('***************************************************');
		console.log('Preloader - all content is loaded!');
	});
}
