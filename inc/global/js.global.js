/*   ___       __             __       ___      ___   ___  __    __       _______.    _______  __    __
    /   \     |  |           |  |     /   \     \  \ /  / |  |  |  |     /       |   |   ____||  |  |  |
   /  ^  \    |  |           |  |    /  ^  \     \  V  /  |  |  |  |    |   (----`   |  |__   |  |  |  |
  /  /_\  \   |  |     .--.  |  |   /  /_\  \     >   <   |  |  |  |     \   \       |   __|  |  |  |  |
 /  _____  \  |  `----.|  `--'  |  /  _____  \   /  .  \  |  `--'  | .----)   |    __|  |____ |  `--'  |
/__/     \__\ |_______| \______/  /__/     \__\ /__/ \__\  \______/  |_______/    (__)_______| \______/
*/
/*
///////////////////////////////////////////////////////////
//////////////////// GLOBAL JAVASCRIPT ////////////////////
///////////////////////////////////////////////////////////
*/
$(document).ready(function(){

	///////////////////////////////////////////////////////////
	/////////// MATERIALIZE ELEMENTS INITIALISATION ///////////
	///////////////////////////////////////////////////////////
	$('.tabs').tabs();
	$('.modal').modal();
	$('.dropdown-trigger').dropdown();
	$('.sidenav').sidenav();
	$('.collapsible').collapsible();

	///////////////////////////////////////////////////////////
	//////////////// FUNCTION FOR SMOOTH SCROLL ///////////////
	///////////////////////////////////////////////////////////
	$(function() {
	    // This will select everything with the class smoothScroll
	    // This should prevent problems with carousel, scrollspy, etc...
	    $('.smoothScroll').click(function() {
	        //CLOSE THE DROPDOWN IN NAVIGATION
	        $('#navdrop11').removeClass("show");
	        $('#navdrop12').attr("aria-expanded", "false");
	        $('#navdrop13').removeClass("show");
	        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
	            let a = $(this.hash);
	            a = a.length ? a : $('[name=' + this.hash.slice(1) + ']');
	            if (a.length) {
	                $('html,body').animate({
	                    scrollTop: a.offset().top-80
	                }, 1700); // The number here represents the speed of the scroll in milliseconds
	                return false;
	            }
	        }
	    });
	});

});

$(window).on("load", function(){
	setTimeout(function(){
		cookieCheckTerms();
	},1200);
});
