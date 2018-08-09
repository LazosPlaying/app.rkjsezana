<div class="card">
  	<div class="card-content" id="maincard">
		<div class="center-align">
			<h5>Nalaganje ...</h5>
			<div class="progress">
		 		<div class="indeterminate"></div>
		 	</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$.post(
		'/api/get/updates',
		{
			page: 1,
			limit: 20
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
		{
			$('#maincard').html('<ul class="updates"></ul>');
		}
		{
			let dat = data.data.updates;
			let mainul = $('.updates');

			dat.forEach(function(el) {
				console.log(el);

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
					content += '<li id="update_'+el.id+'">';
						content += '<i class="material-icons" style="color:'+upd_i_color+';background-color:'+upd_i_background+'">'+upd_i_icon+'</i>';
						content += '<div class="update-post">';
							content += '<span class="update-time"><span class="update-prettytime" timestamp="'+upd_timestamp+'">'+upd_time_formated+'</span> - '+upd_time_formated+'</span>';
							content += '<div class="update-title">'+el.title+'</div>';
							content += '<div class="update-content">';
								content += '<span>'+el.content+'</span>';

								if (el.findoutmore != null){
									content += '<br><br><a class="btn btn-small waves-effect waves-aqua green" href="'+el.findoutmore+'">Poizvedi več</a>';
								}

							content += '</div>';
						content += '</div>';
					content += "</li>";
				}

				mainul.append(content);
			});
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
</script>
<style>
.updates {
  	position: relative;
  	margin: 0 0 30px 0;
  	padding: 0;
  	list-style: none;
}
.updates:before {
  	content: '';
  	position: absolute;
  	top: 0;
  	bottom: 0;
  	width: 4px;
  	background: #ddd;
  	left: 18px;
  	margin: 0;
  	border-radius: 2px;
}
.updates > li {
  	position: relative;
  	margin-right: 10px;
  	margin-bottom: 15px;
}
.updates > li:before,
.updates > li:after {
  	content: " ";
  	display: table;
}
.updates > li:after {
  	clear: both;
}
.updates > li > .update-post {
  	box-shadow: 3px 15px 15px rgba(0, 0, 0, 0.1), 0 0 15px rgba(0, 0, 0, 0.1);
 	border-top: 1px solid rgba(244, 244, 244, .5);
  	border-radius: 3px;
  	margin-top: 0;
  	background: #fff;
  	color: #444;
  	margin-left: 40px;
  	margin-right: 15px;
  	padding: 0;
  	position: relative;
}
.updates > li > .update-post > .update-time {
  	color: #999;
  	float: right;
  	padding: 10px;
  	font-size: 12px;
}
.updates > li > .update-post > .update-title {
 	margin: 0;
 	color: #555;
 	border-bottom: 1px solid #f4f4f4;
 	padding: 10px;
 	font-size: 16px;
 	line-height: 1.1;
}
.updates > li > .update-post > .update-content {
 	padding: 10px;
}
.updates > li > i.material-icons {
  	box-shadow: 3px 8px 5px rgba(0, 0, 0, 0.1);
  	width: 30px;
  	height: 30px;
  	font-size: 18px;
  	line-height: 30px;
  	position: absolute;
  	color: #fff;
  	background: #4caf50;
  	border-radius: 50%;
  	text-align: center;
  	left: 4px;
  	top: 0;
}
</style>
