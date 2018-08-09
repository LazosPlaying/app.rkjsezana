<div class="card warning-card">
  	<div class="card-content valign-wrapper orange white-text">
		<div class="container">
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
				<a href="#docs-ajax" class="file">ajax</a>
				<a href="#docs-ajax-arrayToJson" class="function">arrayToJson()</a>
				<hr>
				<a href="#docs-array" class="file">array</a>
				<a href="#docs-array-arrayToString" class="function">arrayToString()</a>
				<a href="#docs-array-stringToArray" class="function">stringToArray()</a>
				<a href="#docs-array-arrayToJson" class="function">arrayToJson()</a>
				<hr>
				<a href="#docs-database" class="file">database</a>
				<a href="#docs-database-dbConn" class="class">dbConn()</a>
				<a href="#docs-database-dbConn-mysqli" class="function">mysqli()</a>
				<a href="#docs-database-dbConn-pdo" class="function">pdo()</a>
				<a href="#docs-database-dbConn-oopmysqli" class="function">oopmysqli()</a>
				<a href="#docs-database-dbManipulate" class="class">dbManipulate()</a>
				<a href="#docs-database-dbManipulate-insert" class="function">insert()</a>
				<a href="#docs-database-dbManipulate-select" class="function">select()</a>
				<hr>
				<a href="#docs-email" class="file">mail</a>
				<a href="#docs-email-send" class="function">send()</a>
				<hr>
                <a href="#docs-token" class="file">token</a>
				<a href="#docs-token-create" class="function">create()</a>
				<hr>
                <a href="#docs-firstload" class="file">firstload</a>
				<hr>
				<a href="#docs-sessioncheck" class="file">sessioncheck</a>
				<a href="#docs-sessioncheck-amiloged" class="function">amiloged()</a>
				<hr>
				<a href="#docs-tool" class="file">tool</a>
				<a href="#docs-tool-secToMs" class="function">secToMs()</a>
				<a href="#docs-tool-rndString" class="function">rndString()</a>
				<a href="#docs-tool-png2jpg" class="function">png2jpg()</a>
				<a href="#docs-tool-outputJpg" class="function">outputJpg()</a>
				<hr>
				<a href="#docs-users" class="file">user</a>
				<a href="#docs-user_user" class="class">user()</a>
				<a href="#docs-user_user-getSessionStatus" class="function">getSessionStatus()</a>
				<a href="#docs-user_user-amiloged" class="function">amiloged()</a>
				<a href="#docs-user_getuserip" class="class">getuserip()</a>
				<a href="#docs-user_getuserip-getIpAddress" class="function">getIpAddress()</a>
			</div>
			<div class="col s12 m7 l9 xl9 docs-content">
				<h3 id="docs-ajax">ajax</h3>
                    <h4>Initialisation</h4>
<pre><code>
require_once 'projectRoot/inc/util/ajax.php';
$ajaxUtil = new ajax();
</pre></code>
                		<p>AJAX utility file includes classes and function specifically for AJAX API system. It has different functions documented bellow.</p>
	                <h4>Functions</h4>
						<h5 id="docs-ajax-arrayToJson">arrayToJson()</h5>
							<warn>/!\ THIS FUNCTION IS DEPRECATED - USE the method documented bellow /!\</warn>
							<p>Instead if arrayToJson(), use the php-in-built method `json_encode()` and pass it 3 rules shown bellow.</p>
<pre><code class="php">
	$array = array(
		'par1' => 'example string',
		'par2' => 888,
		'par3' => true
	);
	$code = json_encode($array, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
</code></pre>
<pre><code>
{
    "code": 200,
    "timestamp": 1528472426000,
    "data": {
        "par1": "example string",
        "par2": 888,
        "par3": true
    }
}
</pre></code>
							<p>echoJson requires passing an array of data to it. The function will will return out the passed array in JSON encoded data.</p>
<pre><code class="php">
$arr = array(
	'par1' => 'example string',
	'par2' => 888,
	'par3' => true
);
echo $ajaxUtil->arrayToJson($arr, 200);
</pre></code>
<pre><code>
{
    "code": 200,
    "timestamp": 1528472426000,
    "data": {
        "par1": "example string",
        "par2": 888,
        "par3": true
    }
}
</pre></code>
                <hr>
				<h3 id="docs-array-">array</h3>
                    <h4>Initialisation</h4>
<pre><code>
require_once 'projectRoot/inc/util/array.php';
$arrUtil = new arrayTool();
</pre></code>
                    <h4>Functions</h4>
						<h5 id="docs-array-arrayToString">arrayToString()</h5>
							<warn>/!\ THIS FUNCTION IS DEPRECATED - USE serialize(); /!\</warn>
							<p>arrayToString function can be used to convert an array into a string, for example when saving an array into MySql database. It is using a simple serialize PHP function and returning the given array as a string of data.</p>
<pre><code>
$arr = array(
	'par1' => 'example string',
	'par2' => 888,
	'par3' => true
);
echo $arrUtil->arrayToString($arr);
</pre></code>
<pre><code>
a:3:{s:4:"par1";s:14:"example string";s:4:"par2";i:888;s:4:"par3";b:1;}
</pre></code>
						<h5 id="docs-array-stringToArray">stringToArray()</h5>
							<warn>/!\ THIS FUNCTION IS DEPRECATED - USE unserialize(); /!\</warn>
							<p>stringToArray function can be used to convert a string into an array, for example when querying data from MySql database. It is using a simple unserialize PHP function and returning the querried string as an array of data.</p>
<pre><code>
$str = 'a:3:{s:4:"par1";s:14:"example string";s:4:"par2";i:888;s:4:"par3";b:1;}';
echo $arrUtil->stringToArray($str);
</pre></code>
<pre><code>
// DATA TYPE -> PHP ARRAY
{
    "par1": "example string",
    "par2": 888,
    "par3": true
}
</pre></code>
						<h5 id="docs-array-arrayToJson">arrayToJson()</h5>
							<warn>/!\ THIS FUNCTION IS DEPRECATED - TRY NOT TO USE IT /!\</warn>
							<p>arrayToJson is a pretty similar function to <a href="#docs-ajax-echoJson" class="smoothScroll">echoJson in AJAX section</a> but in this case, no additional data is given.  It simply JSON encodes the given array and returns it.</p>
<pre><code>
$arr = array(
	'par1' => 'example string',
	'par2' => 888,
	'par3' => true
);
echo arrayToJson->arrayToJson($arr);
</pre></code>
<pre><code>
// DATA TYPE -> STRING
{
    "par1": "example string",
    "par2": 888,
    "par3": true
}
</pre></code>
							<p>This function also has some error checking. Here are an example representing the JSON returned the data is not provided or if the provided data is not an array.</p>
<pre><code>
// RETURNED WHEN -> DATA NOT GIVEN
{
    "status": "error",
    "error": "The given value is missing"
}
</pre></code>
<pre><code>
// RETURNED WHEN -> DATA NOT ARRAY
{
    "status": "error",
    "error": "The processed value is not an data array"
}
</pre></code>
                <hr>
				<h3 id="docs-database">database</h3>
                    <h4>Initialisation</h4>
<pre><code>
require_once 'projectRoot/inc/util/database.php';
$dbConn = new dbconn();
$dbUtil = new dbManipulate();
</pre></code>
                		<h4 id="docs-database-dbConn">Functions - dbConn() class</h4>
  							<h5 id="docs-database-dbConn-mysqli">mysqli()</h5>
								<p>mysqli function returns an mysqli_connect() object with an established connection with the MySql server.</p>
<pre><code>
$mysqli_conn = $dbConn->mysqli();
</pre></code>
  							<h5 id="docs-database-dbConn-pdo">pdo()</h5>
								<p>pdo function returns an PDO based object with an established connection with the MySql server.</p>
<pre><code>
$pdo_conn = $dbConn->pdo();
</pre></code>
  							<h5 id="docs-database-dbConn-oopmysqli">oopmysqli()</h5>
								<p>oopmysqli function returns an new mysqli() object with an established connection with the MySql server using Object Oriented Php.</p>
<pre><code>
$oop_conn = $dbConn->oopmysqli();
</pre></code>
                		<h4 id="docs-database-dbManipulate">Functions - dbManipulate() class</h4>
  							<h5 id="docs-database-dbManipulate-insert">insert</h5>
								<p>insert function allows you to directly specify what you want to insert into what table</p>
<pre><code>
// WITH THIS CODE WE WOULD RUN AN SQL STATEMENET AS FOLLOWS:
// INSERT INTO test_users (username, first_name, last_name, age) VALUES ('johnsmith99', 'John', 'Smith', 19);
$queryData = array(
	'table' => 'test_users',
	'columns' => array(
		'username' => 'johnsmith99',
		'first_name' => 'John',
		'last_name' => 'Smith',
		'age' => 19
	)
);
$action = $dbUtil->insert($queryData);
</pre></code>
<pre><code class="javascript">
// THE FUNCTION CALL ABOVE WOULD RETURN US AN ARRAY OF DATA IN FOLLOWING STYLE

// SUCESS RESPONSE
{
    "is_success": true,
    "message": "Database manipulation successful."
}

// ERROR RESPONSE
{
    "is_success": false,
    "message": "One or more parameters are incorrectly provided at util.database.php -> dbManipulate -> insert ! Please inform an administrator."
}
</pre></code>
							<h5 id="docs-database-dbManipulate-select">select</h5>
								<warn>THIS FUNCTION IS NOT FINISHED YET</warn>
								<p>select function returns an array of data that includes information about the query and the data that it has querried from the database.</p>
<pre><code>
// WITH THIS CODE WE WOULD RUN AN SQL STATEMENET AS FOLLOWS:
// SELECT username,first_name,last_name,age FROM test_users WHERE age > 18 AND age < 70
$queryData = array(
	'table' => 'test_users',
	'columns' => array(
		'username',
		'first_name',
		'last_name',
		'age'
	),
	'conditions' => array(
		'relation' => 'AND',
		'data' => array(
			'age' => array(
				'comparison' => '>',
				'value' => 18
			),
			'age' => array(
				'comparison' => '<',
				'value' => 70
			)
		)
	)
);
$dataArray = $dbUtil->select($queryData);

// THIS WOULD RETURN AN NORMAL ARRAY OF DATA
// THAT YOU WOULD GET FROM MYSQLI QUERY USING PREPARED STATEMENTS
</pre></code>
                <hr>
				<h3 id="docs-email">mail</h3>
                    <h4>Initialisation</h4>
<pre><code>
require_once 'projectRoot/inc/util/mail.php';
$mailUtil = new mail();
</pre></code>
                		<h4>Functions</h4>
  							<h5 id="docs-email-send">send</h5>
								<p>The send function is used for sending emails. It requires an awway of data being passed to it when called. The following code would send an email looking like <a href="https://static.rkjsezana.app/examples/email-2018-06-09-1.htm" onclick="window.open('https://static.rkjsezana.app/examples/email-2018-06-09-1.htm', 'newwindow', 'width=640,height=900'); return false;">this</a></p>
<pre><code>
$emailData = array(
	'from' => array(
		'addr' => 'txt',
		'name' => 'txt'
	),
	'to' => array(
		'addr' => 'txt',
		'name' => 'txt'
	),
	content => array(
		'title' => 'Hello from rkjsezana.app',
		'subject' => 'Testing email',
		'html' => 'Hello! I am sending this email using an email utility from my system :) &lt;br&gt;&lt;a href="https://rkjsezana.app"&gt;rkjsezana.app link&lt;/a&gt;',
		'nohtml' => 'Hello! I am sending this email using an email utility from my system :) .......... https://rkjsezana.app - rkjsezana.app link'
	)
);

$mailUtil->send($emailData);
</pre></code>
<pre><code>
// THE PREVIUS CODE WILL RETURN AN ARRAY OF DATA

// SUCCESS
{
	"is_success": true,
    "code": 200,
    "message": "Message has been sent"
}

// ERROR
{
	"is_success": false,
    "code": 500,
    "message": "SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting"
}
</pre></code>
                <hr>
				<h3 id="docs-token">token</h3>
					<p>The "token" utility is a simple tool that allows you to create a token, save it in the database and use it afterwards.</p>
                    <h4>Initialisation</h4>
<pre><code>
require_once 'projectRoot/inc/util/token.php';
$tokenUtil = new token();
</pre></code>
            		<h4>Functions</h4>
						<h5 id="docs-token-create">create</h5>
							<p>When calling the create function in token class, you need to pass it some data, which includes the token type and the user that it is bound to. When finished, it will return an array of data with information about the query and process status.</p>
							<p>Currently supported token types are:</p>
<pre><code>
confirm_email
</pre></code>
							<p>Example function call</p>
<pre><code>
// First parameter represents the user ID, second parameter represents the token type
$tokenData = $tokenUtil->create();
</pre></code>
<pre><code class="javascript">
// THE RETURNED ARRAY RETURNS THE SUCCESS STATUS, TOKEN ITSELF AND THE MESSAGE RECIEVED FROM DATABASE INSERT FUNCTION
{
  "is_success": true,
  "token": "mlB44uN4l2Ew0HC2SygBPd6K0KXJgW",
  "message": "Database manipulation successful."
}

// OR WITH AN ERROR - this is just an example
{
  "is_success": false,
  "token": "mlB44uN4l2Ew0HC2SygBPd6K0KXJgW",
  "message": "Something went wrong when inserting data into the database"
}
</pre></code>
                <hr>
				<h3 id="docs-firstload">firstload</h3>
					<p>The "firstload" utility must be required as first file in any case. It is independent and does not require any additional data.</p>
                    <h4>Initialisation</h4>
<pre><code>
require_once 'projectRoot/inc/util/firstload.php';
</pre></code>
                    	<p>It forces HTTPS if a client is accessing the server though HTTP</p>
<pre><code>
if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' ||
   $_SERVER['HTTPS'] == 1) ||
   isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
   $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
{
   $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   header('HTTP/1.1 301 Moved Permanently');
   header('Location: ' . $redirect);
   exit();
}
</pre></code>
                    	<p>It starts a session if it does not exist yet. It also sets default charset, max upload size basic headers initialises a few global variables</p>
<pre><code>
if (session_status() == PHP_SESSION_NONE){
    session_start();
}
$version = <?php echo $version;?>;
$nowdate = date("Y-m-d");
$nowtime = date("h:i:sa");
$nowdatetime = date("Y-m-d h:i:sa");
//SYSTEM SETTINGS
date_default_timezone_set("Europe/Ljubljana");
ini_set('default_charset', 'utf-8');
ini_set('upload_max_filesize', '2M');
//SET GLOBAL HEADERS
Header("Cache-Control: max-age=259200");
header('Content-Type: text/html; charset=utf-8');
</pre></code>
                <hr>
				<h3 id="docs-sessioncheck">sessionchecks</h3>
					<warn>This utility is deprecated - use <a href="#docs-users" class="smoothScroll">user()</a></warn>
                    <h4>Initialisation</h4>
<pre><code>
require_once 'projectRoot/inc/util/sessioncheck.php';
$sessionUtil = new sessionCheck();
</pre></code>
            		<h4>Functions</h4>
						<h5 id="docs-sessioncheck-amiloged">amiloged</h5>
							<p>amiloged function returns a TRUE of FALSE depending on the session status of the user. If the user is loged in, the function will return TRUE, else it will return FALSE.</p>
<pre><code>
$sessionUtil->amiloged();
</pre></code>
                <hr>
				<h3 id="docs-tool">tools</h3>
                    <h4>Initialisation</h4>
<pre><code>
require_once 'projectRoot/inc/util/tool.php';
$toolsUtil = new tools();
</pre></code>
	                <h4>Functions</h4>
						<h5 id="docs-tool-secToMs">secToMs</h5>
							<warn>This function will change in near future</warn>
							<p>secToMs function will return an intiger which represents an amount of miliseconds that equal to amount of seconds given to the function. The function can also detect if you pass it '1s' - one second. You can also specify a fallback value if you are giving users the option to define the main parameter. Fallback has to be provided in miliseconds - default fallback is 5000</p>
<pre><code>
// FOLLOWING CODE EXAMPLES RETURN TIME IN MILISECONDS

// 15s -> 15000
$toolsUtil->secToMs('15s');
</pre></code>
						<h5 id="docs-tool-rndString">rndString</h5>
							<p>rndString will return a random string when called. It only returns characters that match following regex rule [0-9a-zA-Z] - (simple). You can pass an amount of characters you are requesting - default is 16</p>
<pre><code>
// This will return 16 random characters
$toolsUtil->rndString();

// This will return 64 random characters
$toolsUtil->rndString(64);
</pre></code>
						<h5 id="docs-tool-png2jpg">png2jpg</h5>
							<warn>FUNCTION NOT DOCUMENTED</warn>
							<p>png2jpg will convert the .png image into a JPEG encoded .jpg image file.</p>
<pre><code>
code
</pre></code>
						<h5 id="docs-tool-outputJpg">outputJpg</h5>
							<p>outputJpg will read the .jpg file from provided location, set the HTTP header and output it as a readable file.</p>
<pre><code>
// CALLING THE FUNCTION WILL RETURN AN IMAGE FILE DATA TO REQUESTING CLIENT
$toolsUtil->outputJpg('path/to/image.jpg');
</pre></code>
                <hr>
				<h3 id="docs-user">user</h3>
                    <h4>Initialisation</h4>
<pre><code>
require_once 'projectRoot/inc/util/user.php';
$userUtil = new user();
$ipUtil = new getUserIp();
</pre></code>
            		<h4 id="docs-user_user">Functions - user() class</h4>
						<h5 id="docs-user_user-getSessionStatus">getSessionStatus</h5>
							<p>getSessionStatus function returns a TRUE of FALSE depending on the session status of the user. If the user is loged in, the function will return TRUE, else it will return FALSE.</p>
<pre><code>
if ($userUtil->getSessionStatus() === 'valid'){
	// User is loged in and not locked
} else if ($userUtil->getSessionStatus() === 'locked') {
	// User is locked and should be redirected to /session/locked
} else if ($userUtil->getSessionStatus() === 'dead'){
	// User is not loged in
} else if ($userUtil->getSessionStatus() === 'nosession'){
	// User does not have a set session
} else if ($userUtil->getSessionStatus() === 'notaccepted'){
	// User's accout has not been accepted yet
} else if ($userUtil->getSessionStatus() === 'unconfirmedemail'){
	// User did not confirm his/her email yet
} else {
	// We should never come to this. So if this is run,
	// there is an error and we should totally stop the proccess.
	exit();
}
</pre></code>
						<h5 id="docs-user_user-amiloged">amiLoged</h5>
						<warn>This function is deprecated - use <a href="#docs-user_user-getSessionStatus" class="smoothScroll">getSessionStatus()</a></warn>
							<p>amiloged function returns a TRUE of FALSE depending on the session status of the user. If the user is loged in, the function will return TRUE, else it will return FALSE.</p>
<pre><code>
$userUtil->amiloged();
</pre></code>
            		<h4 id="docs-user_getuserip">Functions - getUserIp() class</h4>
						<h5 id="docs-user_getuserip-getIpAddress">getIpAddress</h5>
							<p>getIpAddress function returns a string that represents the user's address</p>
<pre><code>
$string = $userUtil->amiloged();
</pre></code>
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
.docs .docs-content h3::first-letter, .docs .docs-content h4::first-letter {
	text-transform: capitalize;
}
.docs .docs-content hr {
	margin: 48px 0;
}
</style>
<script>
$(document).ready(function() {
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
		btngrp.find('a.file').each(function(index, el) {
			$(this).addClass('smoothScroll btn btn-small waves-effect waves-light deep-purple darken-2');
		});
		btngrp.find('a.class').each(function(index, el) {
			$(this).addClass('smoothScroll btn btn-small waves-effect waves-light indigo darken-2').css({'margin-left': '8px', 'width': 'calc(100% - 8px)'});
		});
		btngrp.find('a.function').each(function(index, el) {
			$(this).addClass('smoothScroll btn btn-small waves-effect waves-light blue darken-2').css({'margin-left': '16px', 'width': 'calc(100% - 16px)'});
		});
	}
});
</script>
