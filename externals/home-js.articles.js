/*
///////////////////////////////////////////////////////////
///////////////////// ARTICLES LOADER /////////////////////
///////////////////////////////////////////////////////////
*/
$(document).ready(function() {
	loadArticles();
});
function loadArticles(page = 1, limit = 6) {
	$.post(
		'/api/get/articles',
		{
			page: page,
			limit: limit
		},
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
			let maindiv = $('.left').find('.articles');

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
						loopDat.link = 'https://rkjsezana.app/article/'+el.title+'.'+el.id+'/';
						loopDat.link = loopDat.link.replace(/\s+/g, "-");
					}


					content += '<div class="article" id="article_'+el.id+'">';
						content += '<div class="article-header">';
							content += '<span class="article-time"><span class="article-prettytime" timestamp="'+el.time+'">'+loopDat.timeFormat+'</span> - '+loopDat.timeNoSec+'</span>';
							content += '<div class="article-title"><a href="'+loopDat.link+'">'+el.title+'</a></div>';
						content += '</div>';


						content += '<div class="article-post">';
							content += '<div class="article-content">';
								el.content.length > 1000 ? content += el.content.substring(0,1000) + '...' : content += el.content;

							content += '</div>';
							content += '<div class="article-tags">';
								el.tags.forEach(function(tag){
									content += '<span class="new badge" data-badge-caption="">'+tag+'</span>';
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
		console.log("Articles - process completed");

	});
}
