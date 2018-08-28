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
<script src="/externals/global-get.articles.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function() {
	loadArticles(
		$('.left').find('.articles'),
		{
			maxchars: 1000
		}
	);
});
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
