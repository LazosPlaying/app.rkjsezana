<div class="card" style="margin-top:14vh;">
	<div class="card-content grey lighten-4">
    	<span class="card-title center-align grey-text text-darken-4" style="font-weight:bold;font-size:bigger;">Potrditev / aktivacija</span>
		<div class="row">
			<div class="input-field col s12">
				<i class="material-icons prefix">lock_open</i>
				<input id="confirm-code" type="text" placeholder="Žeton">
			</div>
			<div class="col s12">
				<button id="confirm-btn" class="waves-effect waves-light btn green right" disabled>Aktivacija</button>
			</div>
			<div class="col s12">
				<ul class="collapsible">
  					<li>
						<div class="collapsible-header"><i class="material-icons">live_help</i>Kaj je ta stran?</div>
						<div class="collapsible-body">
							<span>Na tej strani lahko vpišeš žetone, ki so ti bili podani za potrditev raznih akcij, kot na primer potrditev email naslova ob registraciji.</span>
							<br>
							<br><span>Registriral/-a sem sem, vendar nisem dobil/-a žetona - <a id="sendSignupEmail">ponovno pošlji email</a></span>
							<br><span>Še vedno ne vidim sporočila / vpisal sem napačen email naslov - <a href="/user/settings">spremeni svoj email naslov</a></span>
						</div>
  					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- <div class="card-action sticky-action">
		<a class="waves-effect waves-teal btn green lighten-5 black-text" href="/">Na domačo stran</a>
	</div> -->
</div>
<style>
#sendSignupEmail{
	cursor: pointer;
}
</style>
<script>
$('#sendSignupEmail').on('click', function(event) {
	event.preventDefault();
	$.post(
		'/api/send/email/confirm_token'
	).done(function( data ) {
    	console.log( "resend email - success" );
		console.log(data);
		console.log(data.data);
  	}).fail(function() {
    	console.log( "resend email - error" );
  	}).always(function() {
    	console.log( "resend email - process finished" );
  	});
});
$(document).ready(function() {
{
	function getAllUrlParams(url) {

	  // get query string from url (optional) or window
	  var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

	  // we'll store the parameters here
	  var obj = {};

	  // if query string exists
	  if (queryString) {

	    // stuff after # is not part of query string, so get rid of it
	    queryString = queryString.split('#')[0];

	    // split our query string into its component parts
	    var arr = queryString.split('&');

	    for (var i=0; i<arr.length; i++) {
	      // separate the keys and the values
	      var a = arr[i].split('=');

	      // in case params look like: list[]=thing1&list[]=thing2
	      var paramNum = undefined;
	      var paramName = a[0].replace(/\[\d*\]/, function(v) {
	        paramNum = v.slice(1,-1);
	        return '';
	      });

	      // set parameter value (use 'true' if empty)
	      var paramValue = typeof(a[1])==='undefined' ? true : a[1];

	      // (optional) keep case consistent
	      paramName = paramName.toLowerCase();
	      paramValue = paramValue.toLowerCase();

	      // if parameter name already exists
	      if (obj[paramName]) {
	        // convert value to array (if still string)
	        if (typeof obj[paramName] === 'string') {
	          obj[paramName] = [obj[paramName]];
	        }
	        // if no array index number specified...
	        if (typeof paramNum === 'undefined') {
	          // put the value on the end of the array
	          obj[paramName].push(paramValue);
	        }
	        // if array index number specified...
	        else {
	          // put the value at that index number
	          obj[paramName][paramNum] = paramValue;
	        }
	      }
	      // if param name doesn't exist yet, set it
	      else {
	        obj[paramName] = paramValue;
	      }
	    }
	  }

	  return obj;
	}

	let data = getAllUrlParams(window.location + '');
	if ("token" in data){
		$('#confirm-code').val(data.token);
		$('#confirm-code').removeClass('invalid');
		$('#confirm-code').addClass('valid');
		$('#confirm-btn').prop('disabled', false);
	}
	$('#confirm-code').keyup(function() {
		if (($('#confirm-code').val()).length==30){
			$('#confirm-code').removeClass('invalid');
			$('#confirm-code').addClass('valid');
			$('#confirm-btn').prop('disabled', false);
		} else {
			$('#confirm-code').removeClass('valid');
			$('#confirm-code').addClass('invalid');
			$('#confirm-btn').prop('disabled', true);
		}
	});
}
});
</script>
