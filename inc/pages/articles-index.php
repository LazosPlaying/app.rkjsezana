<div class="card">
	<div class="card-content" id="maincard">
		<center>
			<h5>Nalaganje . . .</h5>
			<div class="progress">
	      		<div class="indeterminate"></div>
		  	</div>
		</center>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	loadArticles(<?php echo $_GET['id']; ?>);
});
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
function loadArticles(id) {
	$.post(
		'/api/get/articles',
		{
			byid: id
		},
		function(data, textStatus, xhr) {
			/*optional stuff to do after success */
		}
	).done(function( data ) {
		console.log("***************************************************");
		console.log("Article - success");
		console.log(data.data.info);
		console.log(data.data.articles);
		{
			let dat = data.data.articles;
			let maindiv = $('#maincard');
			maindiv.html('');

			dat.forEach(function(el) {
				let loopDat = [];
				let content = "";
				{
					// Generate date from timestamp
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
						// Generate acticle URL && replace invalid characters in article title
						loopDat.link = 'https://rkjsezana.app/r/'+el.title.replace(/\s+/g, "-")+'.'+el.id+'/';
					}

					{
						// If the title in URL does not match the actual title of the post with the gived ID, replace current URL with the correct one
						let regex = /.*\/(.*)\.[0-9]*\//g;
						let nowUrlTitle = regex.exec(window.location.href);
						let nowTitle = el.title.replace(/\s+/g, "-");
						if (nowUrlTitle != nowTitle){
							window.history.replaceState(null, el.title+' - RKJ Sežana', loopDat.link);
						}
					}

					content += '<div class="article" id="article_'+el.id+'">';
						content += '<div class="article-header">';
							content += '<span class="article-time"><span class="article-prettytime" timestamp="'+el.time+'">'+loopDat.timeFormat+'</span> - '+loopDat.timeNoSec+'</span>';
							content += '<div class="article-title">'+el.title+'</div>';
						content += '</div>';


						content += '<div class="article-post">';
							content += '<div class="article-content">';
								content += el.content;
							content += '</div>';
							content += '<div class="article-tags">';
								el.tags.forEach(function(tag){
									content += '<a href="/r/tag/'+tag+'"><span class="new badge" data-badge-caption="">'+tag+'</span></a>';
								});
							content += '</div>';
						content += '</div>';
					content += "</div>";
				}

				// Set title to tab that includes article title
				window.document.title = el.title+' - RKJ Sežana';
				// Log all data in the console
				console.log(['Article id: '+el.id, el, loopDat]);
				// Append the generated content to the element
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
		console.log("Article - fail");
		M.toast({html: '<i class="material-icons">warning</i>Med komunikacijo s strežnikom je prišlo do napake'});
	}).always(function( data ) {
		console.log("Article - process completed");

	});
}
</script>
<style media="all">
/*   ___       __             __       ___      ___   ___  __    __       _______.    _______  __    __
    /   \     |  |           |  |     /   \     \  \ /  / |  |  |  |     /       |   |   ____||  |  |  |
   /  ^  \    |  |           |  |    /  ^  \     \  V  /  |  |  |  |    |   (----`   |  |__   |  |  |  |
  /  /_\  \   |  |     .--.  |  |   /  /_\  \     >   <   |  |  |  |     \   \       |   __|  |  |  |  |
 /  _____  \  |  `----.|  `--'  |  /  _____  \   /  .  \  |  `--'  | .----)   |    __|  |____ |  `--'  |
/__/     \__\ |_______| \______/  /__/     \__\ /__/ \__\  \______/  |_______/    (__)_______| \______/
*/
.article {
  	box-shadow: 3px 15px 15px rgba(0, 0, 0, 0.1), 0 0 15px rgba(0, 0, 0, 0.1);
  	border-radius: 3px;
  	margin-top: 15px;
  	background: #fff;
  	color: #444;
  	padding: 10px;
  	position: relative;
}
.article > .article-header {
	display: flow-root;
	border-bottom: 1px solid #f4f4f4;
	margin: 5px 0;
}
.article > .article-header > .article-time {
  	color: #999;
  	padding: 10px;
  	font-size: 12px;
	float: right;
    max-width: 50%;
}
.article > .article-header > .article-title {
 	color: #555;
 	padding: 10px;
 	font-size: 20px;
 	line-height: 1.1;
	font-weight: bold;
}
.article > .article-post > .article-tags {
	text-align: right;
}
.article > .article-post > .article-tags span.badge {
	float: none;
}
</style>
