$(document).ready(function(){
	
	var winWidth = $(window).width();
	var winPos = $(window).scrollTop();
	var sticked = false;
	var navHeight = $('.navWrapper').innerHeight();

	$(window).resize(function(){
		winWidth = $(window).width();
		navHeight = $('.navWrapper').innerHeight();


	});

	$(window).scroll(function(){
		winPos = $(window).scrollTop();
		if(winPos > 400 && !sticked){
			$('header#mainHeader').addClass('stickyHeader').css({'paddingBottom':navHeight+'px'});
			$('.navWrapper').css({'top':'-105%'}).animate({'top':'0'});
			sticked = true;
		}else if(winPos <= 400 && sticked){
			$('.navWrapper').animate({'top':'-105%'},function(){
				$(this).css({'top':''});
				$('header#mainHeader').removeClass('stickyHeader').css({'paddingBottom':''});
			});
			sticked = false;
		}
		
	});
});



var hash = document.location.hash;
var prefix = "tab_";
if (hash) {
    $('.nav-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
} 

// Change hash for page-reload
$('.nav-tabs a').on('shown', function (e) {
    window.location.hash = e.target.hash.replace("#", "#" + prefix);
});