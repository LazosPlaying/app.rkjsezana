<div class="row">
  	<div class="col s12 md10 l8 xl8 offset-s0 offset-md1 offset-l2 offset-xl2" style="margin-top:10vh;">
	  	<div class="card" id="maincard">
				<div class="card-content grey lighten-4">
					<div class="row">
						<div class="col s4 m4 l4 xl3">
							<img class="responsive-img circle" src="https://via.placeholder.com/500x500">
						</div>
						<div class="col s8 m8 l8 xl9">
					        <div class="input-field col s12">
					          	<i class="material-icons prefix">lock</i>
					          	<input id="unlock-pwd" type="password" class="custominput" placeholder="Geslo">
								<span class="helper-text" data-error="zavrnjeno" data-success="sprejeto"></span>
					        </div>
						</div>
						<div class="col s12 right-align">
							<a href="/ajax/account.logout.php"><button class="waves-effect waves-light btn btn-flat blue-text">Odjava</button></a>
							<button id="unlock-btn" class="waves-effect waves-light btn green">Odkleni račun</button>
						</div>
					</div>
				</div>
			</div>
  	</div>
</div>
