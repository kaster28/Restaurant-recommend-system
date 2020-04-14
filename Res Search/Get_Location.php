<!DOCTYPE html>
<?php include("header.php");?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Google Map Project</title>
	<style> 
        body{ background-image: url("https://image.ibb.co/fqkgMw/dust_scratches.png");}
        .screen{
            padding-top: 100px;
        }
	#map{height:500px;
	width:100%;
	}
	</style>
</head>
<body>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3IvMzc7WJCriIX21uO_mVTyb49IRwTQo&callback=initMap"
async defer>
</script>
<script>
    window.onload=function(){
	var welcomeStr = "Your current location has found.";
	saysomething(welcomeStr);
}
</script>
    

<div class="screen">
 <center><h2>Your Current Location is Here.</h2></center>
  <div id="map"></div>
 </div>    
    <script>     
   function initMap(){
       var CLat;
       var CLng;
       navigator.geolocation.getCurrentPosition(GetLocation);
       function GetLocation(location){
       //     CLat= location.coords.latitude;
       // CLng= location.coords.longitude;
           console.log(CLat);
           console.log(CLng);
           var options={zoom:12, center:{lat:location.coords.latitude, lng:location.coords.longitude}};
       var map= new google.maps.Map(document.getElementById('map'),options);
       var mark= new google.maps.Marker({
           position:{lat:location.coords.latitude, lng:location.coords.longitude},
           map:map
       })
       }
       
      /* var options={zoom:12, center:{-42.8821, lng:147.3272}};
       var map= new google.maps.Map(document.getElementById('map'),options);
       var mark= new google.maps.Marker({
           position:{lat:-42.8821, lng:147.3272},
           map:map
       })*/
   }
   </script>
   
</body>
</html>