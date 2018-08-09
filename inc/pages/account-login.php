<div class="row">
  	<div class="col s12 md10 l8 xl8 offset-s0 offset-md1 offset-l2 offset-xl2" style="margin-top:10vh;">
	  	<div class="card" id="maincard">
				<div class="card-content grey lighten-4">
				<div id="login">

					<div class="row">
				        <div class="input-field col s12">
				          	<i class="material-icons prefix">account_circle</i>
				          	<input id="login-uid" type="text" class="custominput" placeholder="Uporabniško ime">
							<span class="helper-text" data-error="zavrnjeno" data-success="sprejeto"></span>
				        </div>
				        <div class="input-field col s12">
				          	<i class="material-icons prefix">lock</i>
				          	<input id="login-pwd" type="password" class="custominput" placeholder="Geslo">
							<span class="helper-text" data-error="zavrnjeno" data-success="sprejeto"></span>
				        </div>
				        <div class="col s12 right-align">
							<a href="/session/signup"><button class="waves-effect waves-light btn btn-flat blue-text">Registracija</button></a>
							<button id="login-btn" class="waves-effect waves-light btn green">Prijava</button>
						</div>
					</div>

				</div>
				</div>
			</div>
  	</div>
</div>
<script>
$(document).ready(function() {
	$(document).keypress(function(e){if(e.which == 13) {
		login();
    }});

	$('#login-btn').on('click', function(event) {
		event.preventDefault();

		$(this).attr('disabled', true);
		setTimeout(function(){
			$('#login-btn').removeAttr('disabled');
		}, 3000);

		if ( cookieCheckTerms() ){
			login();
		}
	});

	$(".custominput").prop('required',true);
	$(".custominput").attr('oncopy', 'clipboardEvent(); return false;');
    $(".custominput").attr('onpaste', 'clipboardEvent(); return false;');
    $(".custominput").attr('oncut', 'clipboardEvent(); return false;');
    $(".custominput").attr('onfocusout', "this.setAttribute('readonly', '');");
    $(".custominput").attr('onfocus', "this.removeAttribute('readonly');");
});

function clipboardEvent() {
	M.toast({html: 'Dejanje je bilo preprečeno'});
}
function login(){

	let uid 	= $('#login-uid').val();
	let pwd 	= $('#login-pwd').val();
	$.post(
		'/ajax/account.login.php',
		{
			uid: uid,
			pwd: pwd,
			refer: "<?php if(isset($_COOKIE['loginrefer'])){echo $_COOKIE['loginrefer'];}else{echo '/';} ?>"
		}
	).done(function( data ) {
		// M.toast({html: '<i class="material-icons left">check</i> login triggered',activationPercent:0.7});
  	}).fail(function( data ) {
		M.toast({
			html: '<i class="material-icons">warning</i>Med komunikacijo s strežnikom je prišlo do napake'
		});
  	}).always(function( data ) {
		console.log("***************************************************");
		console.log(data);
		{
			let uid = $('#login-uid').parent('div');
			let pwd = $('#login-pwd').parent('div');
			{
				let check1 = data.is_set;
				let check2 = data.is_correct;

				if (check1.uid){
					uid.children('input').removeClass('invalid');
					uid.children('input').addClass('valid');
					uid.children('span.helper-text').attr('data-success', 'Ime je veljavno');
				} else {
					uid.children('input').removeClass('valid');
					uid.children('input').addClass('invalid');
					uid.children('span.helper-text').attr('data-error', 'Zahtevan vpis');
				}
				if (check1.pwd){
					pwd.children('input').removeClass('invalid');
					pwd.children('input').addClass('valid');
					pwd.children('span.helper-text').attr('data-success', 'Geslo je veljavno');
				} else {
					pwd.children('input').removeClass('valid');
					pwd.children('input').addClass('invalid');
					pwd.children('span.helper-text').attr('data-error', 'Zahtevan vpis');
				}
				if (check2.credentials && data.login){
					pwd.children('input').removeClass('invalid');
					pwd.children('input').addClass('valid');
					pwd.children('span.helper-text').attr('data-success', 'Geslo je veljavno');
					{
						M.toast({html: '<i class="material-icons left">check</i> Uspešna prijava',activationPercent:0.7,classes:"green"});
						let htmldata = '<div class="card-content grey lighten-4"><div class="s12 center-align"><h4>Uspešna prijava</h4><p>Preusmerjeni boste v kratkem času...</p></div></div>';
						$('#maincard').html(htmldata);
						setTimeout(function(){
							window.location.replace(data.redirect);
						}, 3000);
					}
				} else {
					pwd.children('input').removeClass('valid');
					pwd.children('input').addClass('invalid');
					pwd.children('span.helper-text').attr('data-error', 'Podatki se ne ujemajo');
					uid.children('input').removeClass('valid');
					uid.children('input').addClass('invalid');
					uid.children('span.helper-text').attr('data-error', 'Podatki se ne ujemajo');
					M.toast({html: '<i class="material-icons left">cancel</i> Podatki se ne ujemajo',activationPercent:0.7,classes:"red"});
				}
			}
		}

	});

}
</script>
