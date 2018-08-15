/*   ___       __             __       ___      ___   ___  __    __       _______.    _______  __    __
    /   \     |  |           |  |     /   \     \  \ /  / |  |  |  |     /       |   |   ____||  |  |  |
   /  ^  \    |  |           |  |    /  ^  \     \  V  /  |  |  |  |    |   (----`   |  |__   |  |  |  |
  /  /_\  \   |  |     .--.  |  |   /  /_\  \     >   <   |  |  |  |     \   \       |   __|  |  |  |  |
 /  _____  \  |  `----.|  `--'  |  /  _____  \   /  .  \  |  `--'  | .----)   |    __|  |____ |  `--'  |
/__/     \__\ |_______| \______/  /__/     \__\ /__/ \__\  \______/  |_______/    (__)_______| \______/
*/
///////////////////////////////////////////////////////////
// CHECK FOR USER'S CONNECTION TO THE APPLICATION SERVER //
///////////////////////////////////////////////////////////
{
	let a = false;
	let b = true;
	setInterval(function() {
		$.get(
			"/api/test/user/connection"
		).fail(function() {
			a = true;
		}).done(function( data ) {
			let dat = data.data;
			if (
				(dat.error == true) ||
				(dat.error == 'true') ||
				(dat.error == 'TRUE')
			){
				a = true;
			} else {


					if (dat.session=='valid'){
						let loc = window.location.pathname;
						if (
							(loc=='/account/locked') ||
							(loc=='/account/login') ||
							(loc=='/account/signup')
						){
							window.location.href = "/";
						}
						a = false;

						
					} else if (dat.session=='locked'){
						let loc = window.location.pathname;
						if (
							loc!='/account/locked'
						){
							window.location.href = "/account/locked";
						}
						a = false;

						
					} else if (dat.session=='dead'){
						let loc = window.location.pathname;
						if (
							(loc!='/account/login') &&
							(loc!='/account/signup') &&
							(loc!='/')
						){
							window.location.href = "/account/login";
						}
						a = false;

						
					} else {
						a = false;
					}


			}
		});
	}, 4000);
	setInterval(function(){
		if (b){
			checkStatus();
		}
	}, 5000);
	function checkStatus(){
		if (a){
			M.toast({
				html: '<i class="material-icons">warning</i>Povezava do strežnika je prekinjena',
				displayLength: 10000,
				inDuration: 500,
				outDuration: 500,
				activationPercent: 1,
				classes: 'red',
				completeCallback: function(){checkStatus();}
			});
			b = false;
		} else {
			b = true;
		}
	}
}
