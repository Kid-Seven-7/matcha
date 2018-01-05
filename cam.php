<?php

session_start();

if (isset($_GET['no_image']))
{
    echo "<script>alert('Please select a photo to upload first!')</script>";
}
else if (isset($_GET['file_error']))
{
    echo "<script>alert('Error: Image is invalid.')</script>";
}
else if (isset($_GET['format_not_supported']))
{
    echo "<script>alert('Only jpeg, jpg and png are allowed!')</script>";
}
else if (isset($_GET['file_too_large']))
{
    echo "<script>alert('File too large!!!. Try a file less than 10mb')</script>";
}
else if (isset($_GET['file_exists']))
{
    echo "<script>alert('File already exists. Try a different photo')</script>";
}
else if (isset($_GET['file_uploaded']))
{
    echo "<script>alert('File uploaded!')</script>";
}
else if (isset($_GET['file_not_found']))
{
    echo "<script>alert('Error: File not found!')</script>";
}
else if (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_GET['login']) && $_GET['login'] == 1)
{
    echo ("<script>alert('Logged in successfully');</script>");
}
else if ($_SESSION['username'] == "" || $_SESSION['email'] == "")
{
    header("Location: login.php?user=res");
    exit();
}

?>
<!DOCTYPE html>
<html>
    <head>
      <?php include_once 'meta.php' ?>
      <title>Camera</title>
    </head>
    <body>

          <!--Header out here-->
  <div>
    <a href="#">Home</a>
    <a href="#">Profile</a>
    <a href="#">Settings</a>
    <a href="#">Photos</a>
    <a href="#">Logout</a>
    <a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">&#9776;</a>
    </div>
    <!--Stickers-->
    <div>

        </div>
        <div>
            <h1>Matcha</h1><span></span>
        </div>
        <!--Camera here DUDE!!!-->


            <form method="POST" accept-charset="utf-8" name="form1">
                <input name="hidden_data" type="hidden"/>
                </form>

            <form method="POST" accept-charset="utf-8" name="save_canvas">
                <input name="hidden_data_2" type="hidden"/>
            </form>
        </br>
        </br>
        </br>
                <div>
                    <p>© 2017 Matcha</p>
                </div>
            </body>
            </html>
