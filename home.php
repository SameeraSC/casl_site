
<?php
session_start();
if(!isset($_SESSION['userid'])){
   echo "<div style='text-align:center; margin-top:100px;'>
     <h2 style='color:red; text-align:center;'> Access Denied. You do not have permission.</h2>
        <a href='index.html' style='color:blue; text-decoration:none;'>🔙 Go Back to Login Page</a>
      </div>";
exit;}
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

<h1>HOME<h1>

</body>
</html>