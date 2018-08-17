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

			if (userdata.is_loged == true){
				let sidebardata = '<li><div class="user-view">';
					sidebardata += '<div class="background"><img src="https://share.aljaxus.eu/2018-06-17/28464122690_b861cbfd38_h-05%3A26%3A55pm.jpg" style="min-height:100%; min-width:100%; height:100%; filter:brightness(40%) blur(.5px);"></div>';
					sidebardata += '<a href="#user"><img class="circle" src="https://share.aljaxus.eu/2018-06-17/profile%20image%20mirrored-120px-05%3A07%3A14pm.jpg"></a>';
					sidebardata += '<a href="#name"><span class="white-text name">'+userdata.first+' '+userdata.last+'</span></a>';
					sidebardata += '<a href="#email"><span class="white-text email">'+userdata.email+'</span></a>';
				sidebardata += '</div></li>';
				sidebar.append(sidebardata);
			}

			tabs.forEach(function(tab){

				if ('navbar' in tab){
					let tabnav = tab.navbar;
					let navData = '';

					if (tabnav.element == 'a'){

						let target = 		( 'target' in tabnav ) ? tabnav.target : "_top" ;
						let extraClass =	( 'class' in tabnav ) ? tabnav.class : "" ;
						let text = 			( tabnav.text != null ) ? tabnav.text : "" ;
						let iconPosition = 	( tabnav.text != null ) ? 'left' : '' ;

						navbar.append('<li><a href="'+tabnav.href+'" target="'+target+'" class="'+extraClass+'"><i class="material-icons '+iconPosition+'">'+tabnav.icon+'</i>'+text+'</a></li>');

					} else if (tabnav.element == 'dropdown'){
						let dropdownmenu = '<ul id="'+tabnav.id+'navbar" class="dropdown-content">';
						tabnav.items.forEach(function(item){
							let target = 		( 'target' in item ) ? item.target : "_top" ;
							let extraClass =	( 'class' in item ) ? item.class : "" ;
							let text = 			( item.text != null ) ? item.text : "" ;
							let iconPosition = 	( item.text != null ) ? 'left' : '' ;

							dropdownmenu += '<li><a href="'+item.href+'" target="'+target+'" class="'+extraClass+'"><i class="material-icons '+iconPosition+'">'+item.icon+'</i>'+text+'</a></li>';
						});
						dropdownmenu += '</ul>';

						let extraClass =	( 'class' in tabnav ) ? tabnav.class : "" ;
						let text = 			( tabnav.text != null ) ? tabnav.text : "" ;
						let iconPosition = 	( tabnav.text != null ) ? 'right' : '' ;

						let dropdownbtn = '<li><a class="dropdown-trigger '+extraClass+'" id="'+tabnav.id+'navbarbtn" data-target="'+tabnav.id+'navbar">'+text+'<i class="material-icons '+iconPosition+'">'+tabnav.icon+'</i></a></li>';

						navbar.before(dropdownmenu);
						navbar.append(dropdownbtn);

						$('#'+tabnav.id+'navbarbtn').dropdown({
							'autoTrigger': true,
							'coverTrigger': false,
							'constrainWidth': false,
							'hover': false,
							'inDuration': 230,
							'outDuration': 300
						});
					}

				}
				if ('sidebar' in tab){
					let tabside = tab.sidebar;
					let sideData = '';

					if (tabside.element == 'a'){

						let target = 		( 'target' in tabside ) ? tabside.target : "_top" ;
						let extraClass =	( 'class' in tabside ) ? tabside.class : "" ;

						sidebar.append('<li><a href="'+tabside.href+'" target="'+target+'" class="'+extraClass+'"><i class="material-icons left">'+tabside.icon+'</i>'+tabside.text+'</a></li>');

					} else if (tabside.element == 'dropdown'){

						let extraClass =	( 'class' in tabside ) ? tabside.class : "" ;
						let text = 			( tabside.text != null ) ? tabside.text : "" ;
						let iconPosition = 	( tabside.text != null ) ? 'left' : '' ;

						let collapsible = '<li class="no-padding"><ul id="'+tabside.id+'sidebarbtn" class="collapsible collapsible-accordion '+extraClass+'"><li><a class="collapsible-header"><i class="material-icons '+iconPosition+'">'+tabside.icon+'</i>'+text+'<i class="material-icons right">arrow_drop_down</i></a><div class="collapsible-body"><ul>';
						tabside.items.forEach(function(item){
							let target = 		( 'target' in item ) ? item.target : "_top" ;
							let extraClass =	( 'class' in item ) ? item.class : "" ;
							let text = 			( item.text != null ) ? item.text : "" ;
							let iconPosition = 	( item.text != null ) ? 'left' : '' ;

							collapsible += '<li><a href="'+item.href+'" target="'+target+'" class="'+extraClass+'"><i class="material-icons '+iconPosition+'">'+item.icon+'</i>'+text+'</a></li>';
						});
						collapsible += '</ul></div></li></ul></li>';
						sidebar.append(collapsible);
						$('#'+tabside.id+'sidebarbtn').collapsible();

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
