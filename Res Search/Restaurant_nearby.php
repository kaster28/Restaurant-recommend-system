<!DOCTYPE html>
<?php include("header.php");?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3IvMzc7WJCriIX21uO_mVTyb49IRwTQo&libraries=places"></script>
    <script>

        var map, service, infoWindow;
        function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -42.882, lng: 147.328},
          zoom: 14
        });
        infoWindow = new google.maps.InfoWindow;
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var request = {
              location: pos,
              radius: 1000,
              sensor: true,
              type: ['restaurant']
            }; 
//set current location marker  
               current_marker = new google.maps.Marker({
                map: map,
                animation: google.maps.Animation.BOUNCE,
                position: pos
              });
              
               current_marker.addListener('mouseover', function(){
                   infoWindow.setContent('You are here');
                   infoWindow.open(map, this);
                   current_marker.setAnimation(google.maps.Animation.NONE);
               });
           
            map.setCenter(pos);
            service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, callback);//request and get results
          });
            //speech response
            var welcomeStr = "Nearby Restaurants are shown on map as flags, click the marks to see more details.";
	        saysomething(welcomeStr);
        } else {
         alert("Error: Fail to use the geolocation service!")
        }

      }
        
      function callback(results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            var place = results[i];
            createMarker(place);
          }
        }
      }
        
      function createMarker(place) {
        var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: placeLoc,
          icon: image
        });
        google.maps.event.addListener(marker, 'click', function() {
            var request = {
                reference: place.reference
            };
            service.getDetails(request, function(place, status) {
                var html="";
        if (status == google.maps.places.PlacesServiceStatus.OK) {
                //show details
              infoWindow.setContent(
                '<div><strong>' +place.name+ '</strong><br>'
                +'Address: ' +place.formatted_address+ '<br>'
                +'Phone: ' +place.formatted_phone_number+ '<br>'
                +'<a href ="' +place.url+ '">View on Google Map</a>'+ '</div>');
              infoWindow.open(map, marker);
            ///place.opening_hours.weekday_text, place.icon, place.photos[2], place.reviews[0].author_name/text
            html+="<div class='image'>";
            html+="<img src='" +place.photos[0].getUrl()+ "' height='185px' width='185px'>"+"<img src='" +place.photos[1].getUrl()+ "' height='185px' width='185px'></div> ";
            html+="<div class='info'> <strong><p class='r_name'>" +place.name+ "</p></strong>";
            html+="<p><strong><span>Address: </span></strong><span>" +place.formatted_address+ "</span></p>";
            html+="<p><strong><span>Website: </span></strong><span><a href='" +place.website+ "'>"+place.website+"</a></span></p>";
            html+="<p><strong><span>Rating: </span></strong><span><strong><font color='brown'>" +place.rating+ "</font></strong></span></p>";
            html+="<p><strong><span>Contact Number: </span></strong><span>" +place.formatted_phone_number+ "</span></p>";
            html+="<p><strong><span>Open Hours: </span></strong><span><br>" +place.opening_hours.weekday_text+ "</span></p></div><div class='clear'></div>";
        }
                $("#detail").html(html);
            });
        });
      }

    //main
      google.maps.event.addDomListener(window, 'load', initMap);
    </script>
    
    <style>
        body{ background-image: url("https://image.ibb.co/fqkgMw/dust_scratches.png");}

      .screen{
            padding-top: 100px;
        }
        .image{
            float: left; width: 200px;
        }
        .info{float: right; width: 500px;
            margin-left: 20px;
            text-align: left;}
        
        .r_name{
            font-size: 30px;
            color:red;
        }
        .clear{clear:both;}
      #map{height:500px;
	  width:100%;
	  }
        
      #detail{margin-top: 20px;
        padding: 35px;
        background-color: white;
        }
    </style>
  </head>
  <body>
    <div class="screen">
    <center><h2>Nearby Restaurants</h2></center>
    <div id="map">
    </div>
    <center>
    <div id="detail" style="width:750px">
    <!--<div class="image"><img src="mic.gif" height='185' width='185'></div> 
        <div class="info">
            <strong><p class="r_name">6666</p></strong>
            <p><strong><span>Address: </span></strong><span>1 road</span></p>
            <p><strong><span>Website: </span></strong><span>aaaa.com</span></p>
            <p><strong><span>Rating: </span></strong><span>12.5</span></p>
            <p><strong><span>Contact Number: </span></strong><span>12356</span></p>
            <p><strong><span>Open Hours: </span></strong><span>Monday</span></p>
        </div>-->   
        <h2>please select a flag on the map <font color="red">OvO</font></h2>
    </div>
    </center>
    </div>
  </body>
</html>