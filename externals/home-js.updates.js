/*   ___       __             __       ___      ___   ___  __    __       _______.    _______  __    __
    /   \     |  |           |  |     /   \     \  \ /  / |  |  |  |     /       |   |   ____||  |  |  |
   /  ^  \    |  |           |  |    /  ^  \     \  V  /  |  |  |  |    |   (----`   |  |__   |  |  |  |
  /  /_\  \   |  |     .--.  |  |   /  /_\  \     >   <   |  |  |  |     \   \       |   __|  |  |  |  |
 /  _____  \  |  `----.|  `--'  |  /  _____  \   /  .  \  |  `--'  | .----)   |    __|  |____ |  `--'  |
/__/     \__\ |_______| \______/  /__/     \__\ /__/ \__\  \______/  |_______/    (__)_______| \______/
*/
$(document).ready(function() {
	$.post(
		'/api/get/updates',
		{
			page: 1,
			limit: 3
		},
		function(data, textStatus, xhr) {
			/*optional stuff to do after success */
		}
	).done(function( data ) {
		// M.toast({html: '<i class="material-icons left">check</i> Load triggered',activationPercent:0.7});
	}).fail(function( data ) {
		M.toast({html: '<i class="material-icons">warning</i>Med komunikacijo s strežnikom je prišlo do napake'});
	}).always(function( data ) {
		console.log("***************************************************");
		console.log("Updates - success");
		console.log(data.data.info);
		console.log(data.data.updates);
		{
			$('#maincard').html('<ul class="updates"></ul>');
		}
		{
			let dat = data.data.updates;
			let maindiv = $('.right').find('.updates');

			dat.forEach(function(el) {

				let content = "";
				let upd_i_icon = "build";
				let upd_i_color = '#fff';
				let upd_i_background = '#4caf50';
				let upd_timestamp = el.time;
				let upd_time_formated;
				{
					let a = date = new Date(upd_timestamp*1000);

					let months = ['Jan','Feb','Mar','Apr','Maj','Jun','Jul','Avg','Sep','Okt','Nov','Dec'];

					let year = a.getFullYear();
					let month = months[a.getMonth()];
					let day = a.getDate();
					let hour = a.getHours();
					let min = a.getMinutes() < 10 ? '0' + a.getMinutes() : a.getMinutes();
					let sec = a.getSeconds() < 10 ? '0' + a.getSeconds() : a.getSeconds();
					let time = day + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;

					upd_time_formated = time;
				}

				{
					if (el.type === 'general'){
						upd_i_icon = "build";
						upd_i_color = '#fff';
						upd_i_background = '#4caf50';

					} else if (el.type === 'bugfix'){
						upd_i_icon = "bug_report";
						upd_i_color = '#fff';
						upd_i_background = '#d32f2f';

					} else if (el.type === 'language'){
						upd_i_icon = "translate";
						upd_i_color = '#fff';
						upd_i_background = '#039be5';

					} else if (el.type === 'addition'){
						upd_i_icon = "note_add";
						upd_i_color = '#fff';
						upd_i_background = '#512da8';

					} else if (el.type === 'style'){
						upd_i_icon = "style";
						upd_i_color = '#fff';
						upd_i_background = '#d81b60';

					} else if (el.type === 'security'){
						upd_i_icon = "security";
						upd_i_color = '#fff';
						upd_i_background = '#455a64';

					} else if (el.type === 'api'){
						upd_i_icon = "http";
						upd_i_color = '#fff';
						upd_i_background = '#757575';

					} else if (el.type === 'general'){
						upd_i_icon = "build";
						upd_i_color = '#fff';
						upd_i_background = '#4caf50';

					} else if (el.type === 'general'){
						upd_i_icon = "build";
						upd_i_color = '#fff';
						upd_i_background = '#4caf50';

					} else {
						console.log("Error - unknown update type");
						console.log(el);
					}
				}


				{
					content += '<div class="update" id="update_'+el.id+'">';
						content += '<div class="update-header">';
							content += '<i class="material-icons" style="color:'+upd_i_color+';background-color:'+upd_i_background+'">'+upd_i_icon+'</i>';
						content += '</div>';


						content += '<div class="update-post">';
							content += '<div class="update-title">'+el.title+'</div>';
							content += '<span class="update-time update-prettytime" timestamp="'+upd_timestamp+'">'+upd_time_formated+'</span>';
							content += '<div class="update-content">';

							if (el.findoutmore != null){
								content += '<a class="green-text" href="'+el.findoutmore+'">Poizvedi več</a>';
							}

							content += '</div>';
						content += '</div>';
					content += "</div>";
				}

				maindiv.append(content);
			});

			{
				let content = "";
				content += '<div class="update" id="update_goto_updates">';
					content += '<div class="update-header">';
						content += '<i class="material-icons" style="color:#fff;background-color:;">send</i>';
					content += '</div>';


					content += '<div class="update-post">';
						content += '<a class="green-text" href="https://rkjsezana.app/user/updates"><div class="update-title green-text">Preglej več posodobitev</div></a>';
					content += '</div>';
				content += "</div>";
				maindiv.append(content);
			}
		}
		$(".update-prettytime").prettydate({
			afterSuffix: "pozneje",
			beforeSuffix: "od tega",
			autoUpdate: true,
			duration: 5000, // milliseconds
			messages: {
				second: "Just now",
				seconds: "%s sekund %s",
				minute: "Minuto %s",
				minutes: "%s minut %s",
				hour: "Uro %s",
				hours: "%s ur %s",
				day: "Dan %s",
				days: "%s dni %s",
				week: "Teden %s",
				weeks: "%s tednov %s",
				month: "Mesec %s",
				months: "%s mesecev %s",
				year: "Leto %s",
				years: "%s let %s",

				// Extra
				yesterday: "Včeraj",
				beforeYesterday: "Predvčerajšnjim",
				tomorrow: "Jutri",
				afterTomorrow: "Pojutrišnjem"
			}
		});
		console.log("Updates - process completed");

	});

});
