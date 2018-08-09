/*   ___       __             __       ___      ___   ___  __    __       _______.    _______  __    __
    /   \     |  |           |  |     /   \     \  \ /  / |  |  |  |     /       |   |   ____||  |  |  |
   /  ^  \    |  |           |  |    /  ^  \     \  V  /  |  |  |  |    |   (----`   |  |__   |  |  |  |
  /  /_\  \   |  |     .--.  |  |   /  /_\  \     >   <   |  |  |  |     \   \       |   __|  |  |  |  |
 /  _____  \  |  `----.|  `--'  |  /  _____  \   /  .  \  |  `--'  | .----)   |    __|  |____ |  `--'  |
/__/     \__\ |_______| \______/  /__/     \__\ /__/ \__\  \______/  |_______/    (__)_______| \______/
*/
///////////////////////////////////////////////////////////
///////////////////// GLOBAL FUNCTIONS ////////////////////
///////////////////////////////////////////////////////////
function currectTime(){
  var time = new Date($.now());
  time = time.getHours()+"h "+time.getMinutes()+"m "+time.getSeconds()+"s ";
  return time;
}
function animateNumLong(element, number){
    var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
    $(element).animateNumber(
      {
        number: number,
        numberStep: comma_separator_number_step
      }
    );
}
function copyToClipboard(text, msg = "Besedilo kopirano v odložišče"){
    let $temp = $("<textarea>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();

	M.toast({html: '<i class="material-icons left">check</i> '+msg,classes: 'green darken-1'});
}
function cookieCheckTerms(){
	if ( !("terms_accept" in Cookies.get()) ){
		$('#modal-terms').modal('open');
		return false;
	} else {
		if( Cookies.get().terms_accept=="false" ){
			$('#modal-terms').modal('open');
			return false;
		} else if ( Cookies.get().terms_accept=="true" ) {
			return true;
		} else {
			return false;
		}
	}
}
