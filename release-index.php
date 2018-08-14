<div class="card">
	<div class="row">
		<div class="col s12 m12 l12" id="releases">
			<center><h5>Loading . . .</h5></center>
		</div>
	</div>
</div>
<script type="text/javascript">


/*
///////////////////////////////////////////////////////////
///////////////////// RELEASES LOADER /////////////////////
///////////////////////////////////////////////////////////
*/
$(document).ready(function() {
	loadReleases();
});
function loadReleases() {
	$.get(
		'/api/get/releases',
		{
			byid: '<?php echo $_GET['id']; ?>'
		},
		function(data, textStatus, xhr) {
			/*optional stuff to do after success */
		}
	).done(function( data ) {
		console.log("***************************************************");
		console.log("Releases - success");
		console.log("|_ Cleared main #releases div");
		$('#releases').html(null);
		console.log(data);
		{
			let maindiv = $('#releases');

			data.data.releases.forEach(function(el) {
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

					let title = el.title.replace(/(\s|\-)+/g, '-');

					let url = 'https://skinsrestorer.net/r/'+title+'.'+el.id;

					loopDat.url = url.toLowerCase();
				}
				{
					let content = el.content;
					let exp = /((https?:\/\/)?([a-z0-9\.\-]*)\.([a-z0-9]{2,9})((\s)|((\/|\?)([a-z0-9\/<>!\?\=\&]*))))/ig;

					loopDat.content = content.replace(exp, '<a href="$1" title="$1" target="_blank">$2$3.$4</a>');
				}
				{
					switch (el.type) {
						case 'dev':
							loopDat.getBtnColor = 'blue darken-3';
							break;
						case 'alpha':
							loopDat.getBtnColor = 'blue darken-2';
							break;
						case 'beta':
							loopDat.getBtnColor = 'blue darken-1';
							break;
						case 'stable':
							loopDat.getBtnColor = 'green';
							break;
						case 'official':
							loopDat.getBtnColor = 'green';
							break;
						default:
							loopDat.getBtnColor = 'grey';
					}
				}
				{


					content += '<div class="release" id="release_'+el.id+'">';
						content += '<div class="release-header row">';
							content += '<div class="release-title col s12 m8 l9 xl9">'+el.title+'</div>';
							content += '<div class="release-downloadBtn right-align col s6 m4 l3 xl3 push-s6">';
								content += '<a href="https://skinsrestorer.net/get/'+el.id+'" class="waves-effect waves-light btn-small '+loopDat.getBtnColor+'"><i class="material-icons left" style="margin-right:4px;">get_app</i>'+el.type+'</a>';
							content += '</div>';
							content += '<div class="col s6 m8 l9 xl9 pull-s6">';
								content += '<span class="release-time">'+loopDat.timeNoSec+'</span><br>';
							content += '</div>';
							content += '<div class="col s12 m8 l3 xl3 right-align">';
								content += el.downloads+' downloads - Size: '+el.size;
							content += '</div>';
						content += '</div>';


						content += '<div class="release-post">';
							content += '<div class="release-content">';
								content += loopDat.content;
							content += '</div>';
						content += '</div>';
					content += "</div>";
				}
				window.document.title = el.title+' - SkinsRestorer.net';
				console.log(['Release id: '+el.id, el, loopDat]);
				maindiv.append(content);

			});
		}



	}).fail(function( data ) {
		console.log("***************************************************");
		console.log("Releases - fail");
		M.toast({html: '<i class="material-icons">warning</i>Unable to query data from the server'});
	}).always(function( data ) {
		console.log("Releases - process completed");

	});

}


</script>
<style media="screen">
	#releases .release-content {
		overflow-y: hidden;
		-webkit-transition: max-height 0.8s;
		-moz-transition: max-height 0.8s;
		transition: max-height 0.8s;
	}
</style>
<link rel="stylesheet" href="/src/_custom/index.releases.css">
