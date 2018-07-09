var ContactUs = function () {

    return {
        //main function to initiate the module
        init: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#map',
	            lat: _lat,
				lng: _lng,
			  });
			   var marker = map.addMarker({
					lat: _lat,
					lng: _lng,
		            title: business_name,
		            infoWindow: {
		                content: "<b>"+ business_name +" </b> "+ address1 +", "+ city +"<br> "+ state +",  "+ country +" "+ postal_code +""
		            }
		        });
		
			   marker.infoWindow.open(map, marker);
			});
        }
    };

}();