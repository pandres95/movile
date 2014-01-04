$(document).ready(function(){

var map = L.map('mapse');
 $('a[rel=recicla]').on('click',function(){
 	$('.jumbotron').find('.container').removeClass('container').addClass('smin');
 	$('.jumbotron').css('height','530px');

 	if(!map){
 	  	
 	}
 	

	L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>'
	}).addTo(map);
    navigator.geolocation.getCurrentPosition(function(pos){
      map.setView([parseFloat(geoip_latitude()), parseFloat(geoip_longitude())], 13,{'reset':true});
    });
    
    map.on('click', function(e) {
  		console.log(e.latlng); // e is an event object (MouseEvent in this case)
 	}); 

 });
 
 $('.login').on('click',function(e){
  e.preventDefault();
 	var data = {};
 	    data.user = $('input[name=mail]').val();
 	    data.pass = $('input[name=pass]').val();
 	$.post('/reciclo/login/auth',data,function(res){
       console.log(res);
 	});
 });
 

});
