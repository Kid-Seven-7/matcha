<form action="config/upload.php" method="POST" enctype="multipart/form-data">
<div class="booth">
<div class="image">
<video id="video" width="400" height="300"></video>
</div>
<div class="canvas">
<canvas class="canvas" id="over_video" width="400" height="300"></canvas>
</div>
</div>
<div class="booth_inputs">
<a href="#" id="capture" class="take">Take Photo!</a>
<br>
<input type="submit" value="Upload Image" name="submit">
</div>
</form>
<script>
//SUPER IMPOSING BEGINS. DAN DAN DAAAAAAN!!!!
var canvas1 = document.getElementById('over_video'),
context1 = canvas1.getContext('2d');
//CAMERA STUFF BEGIN HERE
(function(){
var video = document.getElementById('video'),
canvas = document.getElementById('over_video'),
context = canvas.getContext('2d');
vendorUrl = window.URL || window.webkitURL;
navigator.getMedia = navigator.getUserMedia ||
navigator.webkitGetUserMedia ||
navigator.mozGetUserMedia ||
navigator.msGetUserMedia;
navigator.getMedia({
video: true,
audio: false
}, function (stream) {
video.src = vendorUrl.createObjectURL(stream);
video.play();
}, function (error) {
alert('Error tyring to use camera');
console.log("Camera not found!!!");
});
var clickBtn = document.getElementById('capture').addEventListener('click', function() {
var button = document.getElementById('capture');
context1.clearRect(0, 0, 100, 100);
context.drawImage(video, 0, 0, 400, 300);
//getting image information
var raw = canvas2.toDataURL("image/png");
document.getElementById('hidden_data_2').value = raw;
var fd = new FormData(document.forms["save_canvas"]);
//saving the image
var xhr = new XMLHttpRequest();
xhr.open('POST', 'config/upload_data2.php', true);
xhr.send(fd)
context2.clearRect(0, 0, 100, 100);
//Saving picture taken from the live stream
//getting image information
var raw = canvas.toDataURL("image/png");
document.getElementById('hidden_data').value = raw;
var fd = new FormData(document.forms["form1"]);
//saving the image
var xhr = new XMLHttpRequest();
xhr.open('POST', 'config/upload_data.php', true);
xhr.send(fd);
context.clearRect(0, 0, 400, 300);
new_canvas = document.getElementById('canvas');
new_context = new_canvas.getContext('2d');
new_context.drawImage(video, 0, 0, 400, 300);
new_context.drawImage(img1, 0, 0, 100, 100);
});
})();
//THIS IS THE END OF THE FIRST JS LINES
</script>
<script>

//getting image path via url params
var url  = window.location.href;
var params = url.split("=");

//This is for the upload part.
if (params[1] != null)
{
var file_path = "config/" + params[1];

//displaying the image on the canvas
var canvas = document.getElementById('canvas')

if (canvas != null)
{
var context = canvas.getContext('2d');
console.log("Getting image");
display_image();
function display_image()
{
display_image = new Image();
display_image.src = file_path;
console.log("Url found");

if (file_path.search("upload"))
{
window.location.href = "cam.php";
}
display_image.onload = function(){
context.drawImage(display_image, 0, 0, 400, 300);
console.log("Displaying image");
}
}
}
else
{
console.log("Error: Unable to display image");
}
}
else
{
console.log("No params found");
}
//Header
function myFunction()
{
var x = document.getElementById("myTopnav");
if (x.className === "topnav")
{
x.className += " responsive";
}
else
{
x.className = "topnav";
}
}
//THE END OF THE SECOND JS LINES
</script>
