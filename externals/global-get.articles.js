/*   ___       __             __       ___      ___   ___  __    __       _______.    _______  __    __
    /   \     |  |           |  |     /   \     \  \ /  / |  |  |  |     /       |   |   ____||  |  |  |
   /  ^  \    |  |           |  |    /  ^  \     \  V  /  |  |  |  |    |   (----`   |  |__   |  |  |  |
  /  /_\  \   |  |     .--.  |  |   /  /_\  \     >   <   |  |  |  |     \   \       |   __|  |  |  |  |
 /  _____  \  |  `----.|  `--'  |  /  _____  \   /  .  \  |  `--'  | .----)   |    __|  |____ |  `--'  |
/__/     \__\ |_______| \______/  /__/     \__\ /__/ \__\  \______/  |_______/    (__)_______| \______/
*/
/*
///////////////////////////////////////////////////////////
///////////////////// ARTICLES LOADER /////////////////////
///////////////////////////////////////////////////////////
*/
function loadArticles(maindiv, postArgs = {page: 1, limit: 6}) {

	postArgs.page = ( !postArgs.page ) ? 1 : postArgs.page ;
	postArgs.limit = ( !postArgs.limit ) ? 6 : postArgs.limit ;
	postArgs.maxchars = ( !postArgs.maxchars ) ? false : postArgs.maxchars ;

	$.get(
		'/api/get/articles',
		postArgs,
		function(data, textStatus, xhr) {
			/*optional stuff to do after success */
		}
	).done(function( data ) {
		console.log("***************************************************");
		console.log("Articles - success");
		console.log(data.data.info);
		console.log(data.data.articles);
		{
			let dat = data.data.articles;
			maindiv.html('');

			dat.forEach(function(el) {
				let loopDat = [];
				let content = "";
				{
					let a = date = new Date(el.time*1000);

					let months = ['Jan','Feb','Mar','Apr','Maj','Jun','Jul','Avg','Sep','Okt','Nov','Dec'];

					let year = a.getFullYear();
					let month = months[a.getMonth()];
					let day = a.getDate();
					let hour = a.getHours();
					let min = a.getMinutes() < 10 ? '0' + a.getMinutes() : a.getMinutes();
					let sec = a.getSeconds() < 10 ? '0' + a.getSeconds() : a.getSeconds();
					let time = day + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
					let time_nosec = day + ' ' + month + ' ' + year + ' ' + hour + ':' + min ;

					loopDat.timeFormat = time;
					loopDat.timeNoSec = time_nosec;
				}

				{
					{
						loopDat.link = 'https://rkjsezana.app/r/'+el.title.replace(/\s+/g, "-")+'.'+el.id+'/';
					}


					content += '<div class="article" id="article_'+el.id+'">';
						content += '<div class="article-header">';
							content += '<span class="article-time"><span class="article-prettytime" timestamp="'+el.time+'">'+loopDat.timeFormat+'</span> - '+loopDat.timeNoSec+'</span>';
							content += '<div class="article-title"><a href="'+loopDat.link+'">'+el.title+'</a></div>';
						content += '</div>';


						content += '<div class="article-post">';
							content += '<div class="article-content">';
								(postArgs.maxchars != false && el.content.length > postArgs.maxchars) ? content += el.content.substring(0,postArgs.maxchars) + '...' : content += el.content;
							content += '</div>';
							content += '<div class="article-tags">';
								el.tags.forEach(function(tag){
									content += '<a href="/r/tag/'+tag+'"><span class="new badge" data-badge-caption="">'+tag+'</span></a>';
								});
							content += '</div>';
						content += '</div>';
					content += "</div>";
				}

				console.log(['Article id: '+el.id, el, loopDat]);
				maindiv.append(content);
			});
		}
		$(".article-prettytime").prettydate({
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
	}).fail(function( data ) {
		console.log("***************************************************");
		console.log("Articles - fail");
		M.toast({html: '<i class="material-icons">warning</i>Med komunikacijo s strežnikom je prišlo do napake'});
	}).always(function( data ) {
		console.log('|_ postArgs:');
		console.log(postArgs);
		console.log("Articles - process completed");

	});
}
