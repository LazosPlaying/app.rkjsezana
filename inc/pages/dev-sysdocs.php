<div class="card warning-card">
  	<div class="card-content valign-wrapper orange white-text">
		<div class="container">
			<i class="material-icons left">warning</i>
			<br>
			<ul>
				<li style="list-style-type: upper-roman;"><p>Celotna dokumentacija sistema je, ter bo ostala, v angleščini za boljšo ter bolj smiselno razlago - enostavno povedano: izrazi imajo smisel</p></li>
			</ul>
		</div>
	</div>
</div>
<div class="card">
  	<div class="card-content">
		<div class="row docs">
			<div class="col s12 m5 l3 xl3 docs-nav">
				<!-- <a href="#anchor" class="btn btn-small waves-effect waves-light purple darken-2">text</a> -->
				<a href="#docs-introduction" class="btn btn-small waves-effect waves-light purple darken-2">introduction</a>
				<a href="#docs-usedlibs" class="btn btn-small waves-effect waves-light indigo lighten-1">used libraries</a>
				<a href="#docs-selfhost" class="btn btn-small waves-effect waves-light green accent-4">why selfhost</a>
                <hr>
				<a href="#docs-usedtools" class="btn btn-small waves-effect waves-light indigo lighten-1">Used tools</a>
                <hr>
				<a href="#docs-ajax" class="btn btn-small waves-effect waves-light orange darken-3">Ajax requests</a>
				<a href="#docs-database" class="btn btn-small waves-effect waves-light orange darken-3">Database storage</a>
			</div>
			<div class="col s12 m7 l9 xl9 docs-content">
				<h3 id="docs-introduction">introduction</h3>
					<p>This is just a very simple and fast documentation and explanation how the app is being developed, what libraries are being used and how are all of these hosted, requested and how safe they are.</p>
        		<h5 id="docs-usedlibs">What libraries are in use ?</h5>
					<p>There are quite a few libraries in use at the moment. Bellow you can find a list of all of them, hosting location, their original source and documentation.</p>
                    <div style="overflow:scroll;">
                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Source</th>
                                    <th>Host</th>
                                    <th>Docs</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>materializecss</td>
                                    <td>css, javascript</td>
                                    <td>https://materializecss.com</td>
                                    <td>https://static.aljaxus.eu/lib/materializecss/materializecss-v1.0.0-beta/</td>
                                    <td>https://materializecss.com/getting-started.html</td>
                                </tr>
                                <tr>
    								<td>Tillana font</td>
                                    <td>font</td>
                                    <td>https://fonts.google.com/specimen/Tillana</td>
    								<td>https://fonts.googleapis.com/css?family=Tillana</td>
                                    <td>https://fonts.google.com/specimen/Tillana</td>
                                </tr>
                                <tr>
    								<td>material icons</td>
                                    <td>font</td>
                                    <td>https://material.io/tools/icons/?style=baseline</td>
    								<td>https://fonts.googleapis.com/icon?family=Material+Icons</td>
                                    <td>https://material.io/tools/icons/?style=baseline</td>
                                </tr>
                                <tr>
                                    <td>Font awesome icons</td>
                                    <td>font</td>
                                    <td>https://fontawesome.com/</td>
                                    <td>https://use.fontawesome.com/releases/v5.0.13/js/all.js</td>
                                    <td>https://fontawesome.com/how-to-use/svg-with-js</td>
                                </tr>
                                <tr>
                                    <td>jsCookie</td>
                                    <td>javascript</td>
                                    <td>https://github.com/js-cookie/js-cookie</td>
                                    <td>https://static.aljaxus.eu/lib/js-cookie/js-cookie-v2.2.0.js</td>
                                    <td>https://github.com/js-cookie/js-cookie</td>
                                </tr>
                                <tr>
                                    <td>jQuery</td>
                                    <td>javascript</td>
                                    <td>http://jquery.com/download/</td>
                                    <td>https://static.aljaxus.eu/lib/jquery/jquery-3.3.1/jquery.min.js</td>
                                    <td>http://api.jquery.com/</td>
                                </tr>
                                <tr>
                                    <td>PhpMailer</td>
                                    <td>backend</td>
                                    <td>https://github.com/PHPMailer/PHPMailer</td>
                                    <td>restricted</td>
                                    <td>https://github.com/PHPMailer/PHPMailer#installation--loading</td>
                                </tr>
                                <tr>
                                    <td>highlightJs</td>
                                    <td>javascript, css</td>
                                    <td>https://highlightjs.org/download/</td>
                                    <td>https://static.aljaxus.eu/lib/jquery-highlightjs/highlightjs-2018-06-08/</td>
                                    <td>http://highlightjs.readthedocs.io/en/latest/index.html</td>
                                </tr>
                                <tr>
                                    <td>prettyDate</td>
                                    <td>javascript</td>
                                    <td>https://github.com/fengyuanchen/prettydate</td>
                                    <td>https://static.aljaxus.eu/lib/jquery-prettydate/prettydate.js</td>
                                    <td>http://fengyuanchen.github.io/prettydate/</td>
                                </tr>
                                <tr>
                                    <td>push js</td>
                                    <td>javascript</td>
                                    <td>https://github.com/Nickersoft/push.js</td>
                                    <td>https://static.aljaxus.eu/lib/pushjs.org/pushjs-2018-08-13/</td>
                                    <td>https://pushjs.org/docs/introduction</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
				<h5 id="docs-selfhost">Why selfhost</h5>
					<p>Why self hosting some of the used libraries, you might ask? To answer that we first need to cover how the <a href="https://static/rkjsezana.app" target="_blank">static.rkjsezana.app</a> host even works. It is a separate host which has a few changes in host settings and data that is being passed to the client requesting anything from it. It is a static host, which means that once something has been uploaded to it, it will stay there. If we need a newer version of the library, we will upload it in a separate subdirectory with the newer version's name, one example are <a href="https://static.rkjsezana.app/libs/materializecss-v0.100.2/" target="_blank">materializecss-v0.100.2</a> and <a href="https://static.rkjsezana.app/libs/materializecss-v1.0.0-beta/" target="_blank">materializecss-v1.0.0-beta</a> which are older and newer versions of the main framework used for rkjsezana.app, called materializecss.</p>
                    <p>As said before, everything on <a href="https://static.rkjsezana.app" target="_blank">static.rkjsezana.app</a> is static and when you are requesting something for the first time, a <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers" target="_blank">HTTP Header</a> is passed to you telling your client to cache all the data, which means thath your browser will save all of that data locally, on your device, so the next time you will be using it, it will not have to download it all over again, but instead it will just read it from the local storage. This makes the application run much faster and smoother. It also reduces the amount of data that will be used while using the app - useful for mobile data and slow internet users.</p>
				<hr>
				<h5 id="docs-usedtools">Used tools</h5>
					<p>There are plenty of tools out there on the internet that you do not have to download in order to use them - and we are very grateful for that, because re know that sometimes it is not easy to pay for things, in this case; servers that are hosting these tools, and hot getting anything back.</p>
					<p>The table bellow includes most of tools that have been used in development of this user application.</p>
                    <div style="overflow:scroll;">
                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Usage</th>
                                    <th>Host</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
									<td>PHPTester</td>
                                    <td>Validate and test your PHP code</td>
                                    <td>http://phptester.net</td>
                                </tr>
                                <tr>
									<td>flatuicolorpicker</td>
                                    <td>Color picking</td>
                                    <td>http://www.flatuicolorpicker.com/category/all</td>
                                </tr>
                                <tr>
									<td>IconFinder</td>
                                    <td>Icon usage and editing</td>
                                    <td>https://www.iconfinder.com</td>
                                </tr>
                                <tr>
									<td>Regex101</td>
                                    <td>Creating, testing and validating regex rules</td>
                                    <td>https://regex101.com</td>
                                </tr>
                                <tr>
									<td>LIpsum</td>
                                    <td>Creating, testing and validating regex rules</td>
                                    <td>https://lipsum.com</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
				<hr>
				<h5 id="docs-ajax">Ajax requests and data loading</h5>
					<p><a href="https://en.wikipedia.org/wiki/Ajax_(programming)" target="_blank">AJAX</a> or the full-word name "Asynchronous JavaScript And XML" is a method that developers use to speed up page loading. We are using it to dynamically load different parts of the app, for example notifications, user posts - and everything else. All data that will ever be exchanged between you and the application server is based on AJAX requests. All the requests are based on the provided API that you can read more about in the API documentation <a href="/user/apidocs/">here</a>.</p>
				<h5 id="docs-database">Database storage</h5>
					<p></p>
			</div>
		</div>
	</div>
</div>
<style>
.docs {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
}
.docs .docs-nav .btn {
	width: 100%;
	text-transform: uppercase;
	margin: 3px 0;
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
	let btns = $('.docs').find('.docs-nav').find('.btn');
	btns.addClass('smoothScroll');
}
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
</script>
