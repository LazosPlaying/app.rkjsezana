<?php if (isset($_GET['par2']) && !empty($_GET['par2'])) { ?>

<div class="card">
	<div class="card-content articles" id="maincard">
		<center>
			<h5>Nalaganje . . .</h5>
			<div class="progress">
	      		<div class="indeterminate"></div>
		  	</div>
		</center>
	</div>
</div>

<!-- ARTICLES JAVASCRIPT -->
<script src="/externals/global-get.articles.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function() {
	let tag =  "<?php echo $_GET['par2'] ?>"
	document.title='Objave z oznako "'+tag+'" - RKJ Sežana';
	loadArticles(
		$('#maincard'),
		{
			bytag: tag,
			maxchars: 1000
		}
	);
});
</script>
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
<?php } else { require __DIR__ . '/error.php'; } ?>
