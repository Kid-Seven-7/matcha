
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include_once 'includes/meta.php';
    session_start();
  ?>
  <title>geocode</title>
</head>
<body>
  <?php include_once 'includes/header.php' ?>
  <div class="container">
    <h2 id="text-center">Enter Location: </h2>
    <form id="location-form" action="includes/address.php">
      <?php
        if (isset($_GET['latlng'])) {
          echo "<input type='text' id='location-input' class='form-control form-control-lg' value='{$_GET['latlng']}'>";
        }else{
          echo "<input type='text' id='location-input' class='form-control form-control-lg'>";
        }
      ?>
      <!-- <input type="text" id="location-input" class="form-control form-control-lg"> -->
      <input type="hidden" id="address_input" />
      <br>
      <button type="submit" name="submit">Submit</button>
    </form>
    <div id="formatted-address"></div>
    <div id="address-components"></div>
    <div id="geometry"></div>
  </div>

  <script>
    // Call Geocode
    //geocode();

    // Get location form
    var locationForm = document.getElementById('location-form');

    // Listen for submiot
    locationForm.addEventListener('submit', geocode);

    function geocode(e){
      // Prevent actual submit
      e.preventDefault();

      var location = document.getElementById('location-input').value;

      axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
        params:{
          address:location,
          key:'AIzaSyBzju1RnJte6CrsH-u75oH99pVoOVOAc1c'
        }
      })
      .then(function(response){
        // Log full response
        console.log(response);

        // Formatted Address
        var formattedAddress = response.data.results[0].formatted_address;

        window.location.href = "includes/address.php?address=" + formattedAddress;
        alert(formattedAddress);

        document.getElementById('address_input').value = formattedAddress;
        console.log("Address saved " + document.getElementById('address_input').value);
        var formattedAddressOutput = `
          <ul class="list-group">
            <li class="list-group-item">${formattedAddress}</li>
          </ul>
        `;

        // Address Components
        var addressComponents = response.data.results[0].address_components;
        var addressComponentsOutput = '<ul class="list-group">';
        for(var i = 0;i < addressComponents.length;i++){
          addressComponentsOutput += `
            <li class="list-group-item"><strong>${addressComponents[i].types[0]}</strong>: ${addressComponents[i].long_name}</li>
          `;
        }
        addressComponentsOutput += '</ul>';

        // Geometry
        var lat = response.data.results[0].geometry.location.lat;
        var lng = response.data.results[0].geometry.location.lng;
        var geometryOutput = `
          <ul class="list-group">
            <li class="list-group-item"><strong>Latitude</strong>: ${lat}</li>
            <li class="list-group-item"><strong>Longitude</strong>: ${lng}</li>
          </ul>
        `;

        // Output to app
        document.getElementById('formatted-address').innerHTML = formattedAddressOutput;
        document.getElementById('address-components').innerHTML = addressComponentsOutput;
        document.getElementById('geometry').innerHTML = geometryOutput;
      })
      .catch(function(error){
        console.log(error);
      });
    }
  </script>
  <?php



  ?>
</body>
</html>
