/*   ___       __             __       ___      ___   ___  __    __       _______.    _______  __    __
    /   \     |  |           |  |     /   \     \  \ /  / |  |  |  |     /       |   |   ____||  |  |  |
   /  ^  \    |  |           |  |    /  ^  \     \  V  /  |  |  |  |    |   (----`   |  |__   |  |  |  |
  /  /_\  \   |  |     .--.  |  |   /  /_\  \     >   <   |  |  |  |     \   \       |   __|  |  |  |  |
 /  _____  \  |  `----.|  `--'  |  /  _____  \   /  .  \  |  `--'  | .----)   |    __|  |____ |  `--'  |
/__/     \__\ |_______| \______/  /__/     \__\ /__/ \__\  \______/  |_______/    (__)_______| \______/
*/
/*
///////////////////////////////////////////////////////////
/////////////////// BACK TO TOP BUTTON ////////////////////
///////////////////////////////////////////////////////////
*/
$(document).ready(function() {
	let topspan = '<span id="scrollToTopSpan" style="display:none;"></span>';
	let newbtn = '<a id="scrollToTopBtn" href="#scrollToTopSpan" class="smoothScroll btn btn-floating btn-md btn-flat waves-effect waves-light red lighten-1" style="float:right;bottom:7px;right:7px;position:fixed;opacity:0;transition:all 1s;"><i class="material-icons">keyboard_arrow_up</i></a>';
	$('main').prepend(topspan);
	$('main').append(newbtn);

	let scrollTrigger = 500;

    var checker = function () {
        var scrollTop = $(window).scrollTop();
        if (scrollTop > scrollTrigger) {
			$('#scrollToTopBtn').css({'opacity': '1', 'height': '40px', 'width': '40px', 'right': '7px', 'bottom': '7px'});
        } else {
			$('#scrollToTopBtn').css({'opacity': '0', 'height': '0', 'width': '0', 'right': '27px', 'bottom': '27px'});
        }
    };
	checker();
	$(window).on('scroll', function () {
        checker();
    });
});
