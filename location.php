<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <?php include_once 'includes/meta.php' ?>
  </head>
  <body>
    <?php include_once 'includes/header.php' ?>
    <div id="map"></div>
    <script>

      var map;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -26, lng: 28},
          zoom: 12
        });

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            window.location.href = "geocode.php?latlng=" + pos.lat + "," + pos.lng;

            var cityCircle = new google.maps.Circle({
              strokeColor: '#FF0000',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#FF0000',
              fillOpacity: 0.35,
              map: map,
              center: pos,
              radius: 10000
            });

            var marker = new google.maps.Marker({
              position: pos,
              map: map,
              animation: google.maps.Animation.DROP,
              title: '<?php echo "{$_SESSION['username']}" ?>\'s Current Location'
            });

            cityCircle.setMap(null);

            cityCircle = new google.maps.Circle({
              strokeColor: '#FF0000',
              strokeOpacity: 0.2,
              strokeWeight: 1,
              editable: true,
              fillColor: '#FF0000',
              fillOpacity: 0.3,
              map: map,
              center: pos,
              radius: 10000
            });
            google.maps.event.addListener(cityCircle, 'radius_changed', function () {
              console.log("radius: " + cityCircle.getRadius());
            });
            google.maps.event.addListener(cityCircle, 'center_changed', function () {
              console.log("center: " + cityCircle.getCenter());
            });

            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
          'Error: The Geolocation service failed.' :
          'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLBkjWQXKrFsaMZeDatuXFWENxqmryYPg&callback=initMap">
    </script>
  </body>
</html>
