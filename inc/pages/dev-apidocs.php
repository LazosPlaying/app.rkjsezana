<div class="card warning-card">
  	<div class="card-content valign-wrapper orange white-text">
		<div class="container">
			<ul>
				<li style="list-style-type: upper-roman;"><p>Celotna API dokumentacija je, ter bo ostala, v angleščini za boljšo ter bolj smiselno razlago - enostavno povedano: izrazi imajo smisel</p></li>
				<li style="list-style-type: upper-roman;"><p>The API documentation is not even close to finished. A lot of things have yet to be added or changed.</p></li>
				<li style="list-style-type: upper-roman;"><p>The documentation is written assuming that you have basic web devlopment knowledge (HTTP requests, what POST and GET methods are, etc.)</p></li>
			</ul>
		</div>
	</div>
</div>
<div class="card">
  	<div class="card-content">
		<div class="row docs">
			<div class="col s12 m5 l4 xl3 docs-nav">
				<!-- <a href="#anchor" class="btn btn-small waves-effect waves-light purple darken-2">text</a> -->
				<a href="#docs-intro" class="method">introduction</a>
				<a href="#docs-intro-httpapi" class="section">What is HTTP API?</a>
				<a href="#docs-intro-responsehandling" class="section">Api response handling</a>
				<hr>
				<a href="#anchor" class="method"></a>
				<a href="#anchor" class="method"></a>
			</div>
            <div class="col s12 m7 l9 xl9 docs-content">
				<h3 id="docs-intro">Introduction</h3>
                    <h4 id="docs-intro-httpapi">What is an http API?</h4>
                		<p>HTTP API is a system that allows a front-end application to safely communicate with a secured database using HTTP (preferebly HTTPS) protocol. It has different functions documented bellow.</p>
                    <h4 id="docs-intro-responsehandling">Api response handling</h4>
					<p>The API will return an array of data which is JSON-formatted. The JSON array will always include basic data (example shown bellow) and an part of array that will include requested data.</p>

			</div>
		</div>
	</div>
</div>
<style>
.docs {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
}
@media only screen and (min-width: 993px) {
	.docs .docs-nav {
		width: calc(25% - 1rem) !important;
	    margin-right: 1rem;
	}
}
.docs .docs-nav .btn {
	width: 100%;
	text-transform: uppercase;
	margin: 3px 0;
}
.docs .docs-content {
	padding-left: 2rem;
}
.docs .docs-content h3 {
	margin-left: -3rem;
}
.docs .docs-content h4 {
	margin-left: -1rem;
}
.docs .docs-content h5 {
	margin-top: 4rem;
	margin-left: 0;
}
.docs .docs-content h3::first-letter, .docs .docs-content h4::first-letter, .docs .docs-content h5::first-letter {
	text-transform: capitalize;
}
.docs .docs-content hr {
	margin: 48px 0;
}
</style>
<script>
{
    let tds = $('.docs').find('td');

    tds.each(function(){
        let html = $(this).html();
        let newhtml = html;
        let reg = /(https?:\/\/)?((([a-zA-Z0-9]*\.){1,2})?[a-zA-Z0-9]*\.[a-zA-Z0-9]{1,9})(\/([^\s]*)?)?/
        let match = html.match(reg);
        if (match){
            let protocol = 'http://'
            let host = match[2];
            let path = '/';
            if (match[1]){
                protocol = match[1];
            }
            if (match[5]){
                path = match[5];
            }
            let url = protocol+host+path;

            newhtml = '<a href="'+url+'" title="'+url+'" target="_blank">'+host+'</a>';
        }
        $(this).html(newhtml);
    });
}
{
	$('warn').each(function(){
		$(this).wrap(function(){
			return '<div class="card"><div class="card-content valign-wrapper red white-text" style="font-weight:bold;padding:8px 24px;"></div></div>';
		});
	})
    $('pre code').each(function(i, block) {
        $(this).addClass('canSelectText');
        $(this).html($(this).html()+'&#13;');
		hljs.configure({
			tabReplace: '    '
		})
        hljs.highlightBlock(block);
    });

}
{
	let btngrp = $('.docs').find('.docs-nav');
	btngrp.find('a.method').each(function(index, el) {
		$(this).addClass('smoothScroll btn btn-small waves-effect waves-light deep-purple darken-2');
	});
	btngrp.find('a.section').each(function(index, el) {
		$(this).addClass('smoothScroll btn btn-small waves-effect waves-light indigo darken-2').css({'margin-left': '8px', 'width': 'calc(100% - 8px)'});
	});
	btngrp.find('a.function').each(function(index, el) {
		$(this).addClass('smoothScroll btn btn-small waves-effect waves-light blue darken-2').css({'margin-left': '16px', 'width': 'calc(100% - 16px)'});
	});
}
</script>
