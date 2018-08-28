<div class="card">
	<div class="card-content">
		<div class="row" style="margin-bottom:0;">
			<div class="left col s12 m7 l9 xl10">
				<div class="articles">
					<center>
						<h5>Nalaganje . . .</h5>
						<div class="progress">
				      		<div class="indeterminate"></div>
					  	</div>
					</center>
				</div>
			</div>
			<div class="right col s12 m5 l3 xl2">
				<div class="col s12 hide-on-med-and-down" style="padding:0;margin-top:15px;">
					<div class="accountbox">
						<div class="accountbox-card">
							<?php
								if ($userUtil->getSessionStatus() == 'valid'){
									echo '
									<div style="text-align: right;">
										<p class="green-text" style="text-align: left;">
											you are loged in :)
										</p>
										<br><a href="/ajax/account.logout.php" class="btn btn-small waves-effect waves-light red">logout here</a>
									</div>';
								} else if ($userUtil->getSessionStatus() == 'dead' || $userUtil->getSessionStatus() == 'nosession'){
									echo '
									<div style="text-align: right;">
										<p class="red-text" style="text-align: left;">
											you are not loged in :(
										</p>
										<br><a href="/account/login" class="btn btn-small waves-effect waves-light green">login here</a>
									</div>';
								} else {
									exit();
								}
							?>
						</div>
					</div>
				</div>
				<div class="col s12" style="padding:0;margin-top:15px;">
					<!-- SIDEBAR -->
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ARTICLES JAVASCRIPT -->
<script type="text/javascript">
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
								el.content.length > 1000 ? content += el.content.substring(0,1000) + '...' : content += el.content;

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
		console.log("Articles - process completed");

	});
}
</script>
<!-- ARTICLES CSS -->
<style media="all">
.articles {

}

.articles > .article {
  	box-shadow: 3px 15px 15px rgba(0, 0, 0, 0.1), 0 0 15px rgba(0, 0, 0, 0.1);
  	border-radius: 3px;
  	margin-top: 15px;
  	background: #fff;
  	color: #444;
  	padding: 10px;
  	position: relative;
}
.articles > .article > .article-header {
	display: flow-root;
	border-bottom: 1px solid #f4f4f4;
	margin: 5px 0;
}
.articles > .article > .article-header > .article-time {
  	color: #999;
  	padding: 10px;
  	font-size: 12px;
	float: right;
    max-width: 50%;
}
.articles > .article > .article-header > .article-title {
 	color: #555;
 	padding: 10px;
 	font-size: 16px;
 	line-height: 1.1;
	font-weight: bold;
}
.articles > .article > .article-post > .article-tags {
	text-align: right;
}
.articles > .article > .article-post > .article-tags span.badge {
	float: none;
}
</style>

<!-- ACCOUNTBOX CSS -->
<style media="all">
.accountbox {
	margin-bottom: 5px;
}
.accountbox-card{
	box-shadow: 3px 15px 15px rgba(0, 0, 0, 0.1), 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 3px;
    margin-top: 0;
    background: #fff;
    color: #444;
    padding: 10px;
    position: relative;
}
</style>
