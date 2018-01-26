<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'includes/meta.php' ?>
    <title>Test</title>
  </head>
  <body>
    <?php include_once 'includes/header.php' ?>
    <div class="ajaxDiv">
      <form action="">
        <select name="ages" onchange="age(this.value)">
          <option value="">Select an age group:</option>
          <option value="teen">teens</option>
          <option value="early_twenties">early twenties</option>
          <option value="mid_twenties">mid twenties</option>
          <option value="late_twenties">late twenties</option>
          <option value="early_thirties">early thirties</option>
          <option value="mid_thirties">mid thirties</option>
          <option value="late_thirties">late thirties</option>
          <option value="early_fourties">early fourties</option>
          <option value="mid_fourties">mid fourties</option>
        </select>
      </form>
      <br>
      <div id="txtHint">Search results will be listed here...</div>
    </div>
    <script>
      function age(str){
        var xhttp;
        if (str == ""){
          document.getElementById("txtHint").innerHTML = "";
          return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
          if (this.readyState == 4 && this.status == 200){
            document.getElementById("txtHint").innerHTML = this.responseText;
          }else{
            console.log("Caught exception : " + this.status);
            console.log(this.statusText);
          }
        };
        xhttp.open("GET", "includes/age.php?q="+str, true);
        xhttp.send();
      }
    </script>

  </body>
</html>
