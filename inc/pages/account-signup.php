<div class="row">
  	<div class="col s12 md10 l8 xl8 offset-s0 offset-md1 offset-l2 offset-xl2" style="margin-top:10vh;">
	  	<div class="card" id="maincard">
				<div class="card-content grey lighten-4">
				<div id="signup">

					<div class="row">
				        <div class="input-field col s12 l6">
				          	<i class="material-icons prefix">face</i>
				          	<input id="signup-first" type="text" class="custominput" placeholder="Ime">
							<span class="helper-text" data-error="zavrnjeno" data-success="sprejeto"></span>
				        </div>
				        <div class="input-field col s12 l6">
				          	<i class="material-icons prefix">face</i>
				          	<input id="signup-last" type="text" class="custominput" placeholder="Priimek">
							<span class="helper-text" data-error="zavrnjeno" data-success="sprejeto"></span>
				        </div>
				        <div class="input-field col s12 l6">
				          	<i class="material-icons prefix">account_circle</i>
				          	<input id="signup-uid" type="text" class="custominput" placeholder="Uporabniško ime">
							<span class="helper-text" data-error="zavrnjeno" data-success="sprejeto"></span>
				        </div>
				        <div class="input-field col s12 l6">
				          	<i class="material-icons prefix">email</i>
				          	<input id="signup-email" type="email" class="custominput" placeholder="Email naslov">
							<span class="helper-text" data-error="zavrnjeno" data-success="sprejeto"></span>
				        </div>
				        <div class="input-field col s12 l6">
				          	<i class="material-icons prefix">lock</i>
				          	<input id="signup-pwd1" type="password" class="custominput" placeholder="Geslo">
							<span class="helper-text" data-error="zavrnjeno" data-success="sprejeto"></span>
				        </div>
				        <div class="input-field col s12 l6">
				          	<i class="material-icons prefix">lock</i>
				          	<input id="signup-pwd2" type="password" class="custominput" placeholder="Potrdi geslo">
							<span class="helper-text" data-error="zavrnjeno" data-success="sprejeto"></span>
				        </div>
				        <div class="col s12">
							<div class="col s12 l6">
								<span style="font-size:small;">Z registracijo tega računa potrjujem, da sem prebral ter se strinjam in sprejemam <a class="terms-open" href="/terms.php">pogoje uporabe</a>.</span>
							</div>
							<div class="col s12 right-align">
								<a href="/account/login"><button class="waves-effect waves-light btn btn-flat blue-text">Prijava</button></a>
								<button id="signup-btn" class="waves-effect waves-light btn green">Registracija</button>
							</div>
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
		signup();
    }});

	$('#signup-btn').on('click', function(event) {
		event.preventDefault();

		$(this).attr('disabled', true);
		setTimeout(function(){
			$('#signup-btn').removeAttr('disabled');
		}, 3000);

		if ( cookieCheckTerms() ){
			signup();
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
function signup(){

	$.post(
		'/ajax/account.signup.php',
		{
			first: $('#signup-first').val(),
			last: $('#signup-last').val(),
			uid: $('#signup-uid').val(),
			email: $('#signup-email').val(),
			pwd1: $('#signup-pwd1').val(),
			pwd2: $('#signup-pwd2').val()
		}
	).done(function( data ) {
		// M.toast({html: '<i class="material-icons left">check</i> signup triggered',activationPercent:0.7});
  	}).fail(function( data ) {
		M.toast({
			html: '<i class="material-icons">warning</i>Med komunikacijo s strežnikom je prišlo do napake'
		});
  	}).always(function( data ) {
		console.log("***************************************************");
		console.log(data);
		{
			let first = $('#signup-first').parent('div');
			let last = $('#signup-last').parent('div');
			let uid = $('#signup-uid').parent('div');
			let email = $('#signup-email').parent('div');
			let pwd1 = $('#signup-pwd1').parent('div');
			let pwd2 = $('#signup-pwd2').parent('div');
			{
				let check1 = data.is_set;
				let check2 = data.is_valid;
				let check3 = data.is_free;

				if (check1.first){
					first.children('input').removeClass('invalid');
					first.children('input').addClass('valid');
					first.children('span.helper-text').attr('data-success', 'Ime je veljavno');
					if (check2.first){
						first.children('input').removeClass('invalid');
						first.children('input').addClass('valid');
						first.children('span.helper-text').attr('data-success', 'Ime je veljavno');
					} else {
						first.children('input').removeClass('valid');
						first.children('input').addClass('invalid');
						first.children('span.helper-text').attr('data-error', 'Ime ni veljavno (min 2 znaka, max 16 znakov)');
					}
				} else {
					first.children('input').removeClass('valid');
					first.children('input').addClass('invalid');
					first.children('span.helper-text').attr('data-error', 'Zahtevan vpis');
				}
				if (check1.last){
					last.children('input').removeClass('invalid');
					last.children('input').addClass('valid');
					last.children('span.helper-text').attr('data-success', 'Priimek je veljaven');
					if (check2.last){
						last.children('input').removeClass('invalid');
						last.children('input').addClass('valid');
						last.children('span.helper-text').attr('data-success', 'Priimek je veljaven');
					} else {
						last.children('input').removeClass('valid');
						last.children('input').addClass('invalid');
						last.children('span.helper-text').attr('data-error', 'Priimek ni veljaven (min 2 znaka, max 16 znakov)');
					}
				} else {
					last.children('input').removeClass('valid');
					last.children('input').addClass('invalid');
					last.children('span.helper-text').attr('data-error', 'Zahtevan vpis');
				}
				if (check1.uid){
					uid.children('input').removeClass('invalid');
					uid.children('input').addClass('valid');
					uid.children('span.helper-text').attr('data-success', 'Uporabniško ime je veljavno');
					if (check2.uid){
						uid.children('input').removeClass('invalid');
						uid.children('input').addClass('valid');
						uid.children('span.helper-text').attr('data-success', 'Uporabniško ime je veljavno');
						if (check3.uid){
							uid.children('input').removeClass('invalid');
							uid.children('input').addClass('valid');
							uid.children('span.helper-text').attr('data-success', 'Uporabniško ime je veljavno');
						} else {
							uid.children('input').removeClass('valid');
							uid.children('input').addClass('invalid');
							uid.children('span.helper-text').attr('data-error', 'Uporabniško ime je že v uporabi');
						}
					} else {
						uid.children('input').removeClass('valid');
						uid.children('input').addClass('invalid');
						uid.children('span.helper-text').attr('data-error', 'Uporabniško ime ni veljavno (min 5 znakov, max 32 znakov, a-z 0-9)');
					}
				} else {
					uid.children('input').removeClass('valid');
					uid.children('input').addClass('invalid');
					uid.children('span.helper-text').attr('data-error', 'Zahtevan vpis');
				}
				if (check1.email){
					email.children('input').removeClass('invalid');
					email.children('input').addClass('valid');
					email.children('span.helper-text').attr('data-success', 'Email naslov je veljaven');
					if (check2.email){
						email.children('input').removeClass('invalid');
						email.children('input').addClass('valid');
						email.children('span.helper-text').attr('data-success', 'Email naslov je veljaven');
						if (check3.email){
							email.children('input').removeClass('invalid');
							email.children('input').addClass('valid');
							email.children('span.helper-text').attr('data-success', 'Email naslov je veljaven');
						} else {
							email.children('input').removeClass('valid');
							email.children('input').addClass('invalid');
							email.children('span.helper-text').attr('data-error', 'Email naslov je že v uporabi');
						}
					} else {
						email.children('input').removeClass('valid');
						email.children('input').addClass('invalid');
						email.children('span.helper-text').attr('data-error', 'Email naslov ni veljaven');
					}
				} else {
					email.children('input').removeClass('valid');
					email.children('input').addClass('invalid');
					email.children('span.helper-text').attr('data-error', 'Zahtevan vpis');
				}
				if (check1.pwd1){
					pwd1.children('input').removeClass('invalid');
					pwd1.children('input').addClass('valid');
					pwd1.children('span.helper-text').attr('data-success', 'Geslo je veljavno');
					if (check2.pwd1){
						pwd1.children('input').removeClass('invalid');
						pwd1.children('input').addClass('valid');
						pwd1.children('span.helper-text').attr('data-success', 'Geslo je veljavno');
					} else {
						pwd1.children('input').removeClass('valid');
						pwd1.children('input').addClass('invalid');
						pwd1.children('span.helper-text').attr('data-error', 'Geslo ni veljavno');
					}
				} else {
					pwd1.children('input').removeClass('valid');
					pwd1.children('input').addClass('invalid');
					pwd1.children('span.helper-text').attr('data-error', 'Zahtevan vpis');
				}
				if (check1.pwd2){
					pwd2.children('input').removeClass('invalid');
					pwd2.children('input').addClass('valid');
					pwd2.children('span.helper-text').attr('data-success', 'Geslo je veljavno');
					if (check2.pwd1){
						pwd1.children('input').removeClass('invalid');
						pwd1.children('input').addClass('valid');
						pwd1.children('span.helper-text').attr('data-success', 'Geslo je veljavno');
					} else {
						pwd1.children('input').removeClass('valid');
						pwd1.children('input').addClass('invalid');
						pwd1.children('span.helper-text').attr('data-error', 'Geslo ni veljavno');
					}
				} else {
					pwd2.children('input').removeClass('valid');
					pwd2.children('input').addClass('invalid');
					pwd2.children('span.helper-text').attr('data-error', 'Zahtevan vpis');
				}
			}
		}
		if (data.signup === true){
			M.toast({html: '<i class="material-icons left">check</i> Uspešna registracija',activationPercent:0.7,classes:"green"});
			setTimeout(function(){
				window.location.href = "/account/login";
			}, 3000)
		}

	});

}

</script>
