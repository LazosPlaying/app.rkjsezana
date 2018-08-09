<!--
///////////////////////////////////////////////////////////
/////////////////////// TERMS MODAL ///////////////////////
///////////////////////////////////////////////////////////
-->
<!-- Modal Structure -->
<div id="modal-terms" class="modal">
  	<div class="modal-content">

  	</div>
  	<div class="modal-footer">
		<a href="javascript:void(0);" onClick="modalTerms(true);" class="waves-effect waves-green green lighten-3 btn-flat">ACCEPT TERMS OF USAGE</a>
  	</div>
</div>
<style>
#modal-terms{
	min-width:85%;
	min-height: 80vh;
}
#modal-terms > .modal-content {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
}
</style>
<script>
$(document).ready(function() {
	$('#modal-terms').modal({
		preventScrolling: true,
		dismissible: false
   	});
	{
		let modal = $('#modal-terms');
		let content = $('#modal-terms').find('.modal-content');
		content.load('/terms.php');
		$('.terms-open').on('click touchstart', function(event) {
			event.preventDefault();
			modal.modal('open');
		});

	}
});
function modalTerms(status){
	let el = $('#modal-terms');
	if (status){
		Cookies.set('terms_accept', true, { expires: 365 });
	} else {
		Cookies.set('terms_accept', false, { expires: 365 });
	}
	el.modal('close');
}
</script>
