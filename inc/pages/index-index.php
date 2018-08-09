<div class="card">
	<div class="card-content">
		<div class="row" style="margin-bottom:0;">
			<div class="left col s12 m7 l9 xl10">
				<div class="articles">

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

<script src="/externals/home-js.articles.js" charset="utf-8"></script>
<link rel="stylesheet" href="/externals/home-css.articles.css">

<link rel="stylesheet" href="/externals/home-css.accountbox.css">
