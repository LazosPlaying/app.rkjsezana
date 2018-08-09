<!--
///////////////////////////////////////////////////////////
/////////////////////// NAVBAR LOADER /////////////////////
///////////////////////////////////////////////////////////
-->
<div class="navbar-fixed">
	<nav id="navigacija-navbar">
	  	<div class="nav-wrapper">
			<a href="#" data-target="slide-out" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
	    	<ul class="right hide-on-med-and-down">
	      		<li><a>Nalaganje ...</a></li>
	    	</ul>
	  	</div>
	</nav>
</div>
<ul id="slide-out" class="sidenav">
    <li><a>Nalaganje ...</a></li>
</ul>
<script>
$(document).ready(function() {
	$('.sidenav').sidenav({
		draggable: true,
		preventScrolling: true,
		inDuration: 350,
		outDuration: 400,
		edge: 'right'
	});
	let navbarData = $.getJSON(
		'/api/get/user/navbar'
	).done(function( requestdata ) {
		console.log("***************************************************");
    	console.log( "navbar - success" );
		console.log( requestdata.data.userdata );
    	console.log( requestdata.data.tabs );
		{
			let userdata = requestdata.data.userdata;
			let tabs = requestdata.data.tabs;
			let navbar = $('#navigacija-navbar').children('div.nav-wrapper').children('ul');
			let sidebar = $('#slide-out');

			navbar.html(null);
			sidebar.html(null);

			if (userdata.is_loged){
				let sidebardata = '<li><div class="user-view">';
				sidebardata += '<div class="background"><img src="https://share.aljaxus.eu/2018-06-17/28464122690_b861cbfd38_h-05%3A26%3A55pm.jpg" style="min-height:100%; min-width:100%; height:100%; filter:brightness(40%) blur(.5px);"></div>';

				sidebardata += '<a href="#user"><img class="circle" src="https://share.aljaxus.eu/2018-06-17/profile%20image%20mirrored-120px-05%3A07%3A14pm.jpg"></a>';
				sidebardata += '<a href="#name"><span class="white-text name">'+userdata.first+' '+userdata.last+'</span></a>';
				sidebardata += '<a href="#email"><span class="white-text email">'+userdata.email+'</span></a>';

				sidebardata += '</div></li>';
				sidebar.append(sidebardata);
			}
			tabs.forEach(function(el) {
				if (el.element == 'a'){
					let target = '_top';
					let extraClass = null;
					if ('target' in el){
						target = el.target;
					}
					if ('class' in el){
						extraClass = ' ' + el.class;
					}
					navbar.append('<li><a href="'+el.href+'" target="'+target+'" class="'+extraClass+'"><i class="material-icons left">'+el.icon+'</i>'+el.text+'</a></li>');
					sidebar.append('<li><a href="'+el.href+'" target="'+target+'" class="'+extraClass+'"><i class="material-icons left">'+el.icon+'</i>'+el.text+'</a></li>');
				} else if (el.element == 'dropdown'){
					{
						let dropdownmenu = '<ul id="'+el.id+'navbar" class="dropdown-content">';
						el.items.forEach(function(el2){
							let target = '_top';
							let extraClass = null;
							if ('target' in el2){
								target = el2.target;
							}
							if ('class' in el2){
								extraClass = ' ' + el2.class;
							}
							dropdownmenu += '<li><a href="'+el2.href+'" target="'+target+'" class="'+extraClass+'"><i class="material-icons left">'+el2.icon+'</i>'+el2.text+'</a></li>';
						});
						dropdownmenu += '</ul>';

						let extraClass = null;
						if ('class' in el){
							extraClass = ' ' + el.class;
						}
						let dropdownbtn = '<li><a class="dropdown-trigger '+extraClass+'" id="'+el.id+'navbarbtn" data-target="'+el.id+'navbar">'+el.text+'<i class="material-icons right">'+el.icon+'</i></a></li>';

						navbar.before(dropdownmenu);
						navbar.append(dropdownbtn);
						$('#'+el.id+'navbarbtn').dropdown({
							'autoTrigger': true,
							'coverTrigger': false,
							'constrainWidth': false,
							'hover': false,
							'inDuration': 230,
							'outDuration': 300
						});
					}
					{
						let extraClass = null;
						if ('class' in el){
							extraClass = ' ' + el.class;
						}
						let collapsible = '<li class="no-padding"><ul id="'+el.id+'sidebarbtn" class="collapsible collapsible-accordion '+extraClass+'"><li><a class="collapsible-header"><i class="material-icons left">'+el.icon+'</i>'+el.text+'<i class="material-icons right">arrow_drop_down</i></a><div class="collapsible-body"><ul>';
						el.items.forEach(function(el2){
							collapsible += '<li><a href="'+el2.href+'"><i class="material-icons left">'+el2.icon+'</i>'+el2.text+'</a></li>';
						});
						collapsible += '</ul></div></li></ul></li>';
						sidebar.append(collapsible);
						$('#'+el.id+'sidebarbtn').collapsible({

						});

					}

				}
			});
		}
  	}).fail(function() {
		console.log("***************************************************");
	    console.log( "navbar - error" );
		M.toast({
			html: '<i class="material-icons">warning</i> Podatki glavnega menija niso dosegljivi',
			displayLength: 10000,
			inDuration: 500,
			outDuration: 500,
			activationPercent: 1
		});
	}).always(function( data ) {
    	console.log( "navbar - process completed" );
	});
});
</script>
