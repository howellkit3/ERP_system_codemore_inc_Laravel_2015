$(document).ready(function(){

	//check what tabs must be active you need to add #tab-class to make it work
	var active_tab = window.location.hash;
	if (active_tab != '') {
		$('.nav-tabs li,.tab-pane').removeClass('in active');
		$('.nav-tabs li').each(function(){

			if ($(this).attr('alt') == active_tab.replace("#", ""))  {

					$(this).addClass('active');
					$(active_tab).addClass('in active ');	

			}


	});

	}


});