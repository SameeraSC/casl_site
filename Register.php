<?php
session_start();
if(!isset($_SESSION['userid']) && isset($_SESSION['type']) && isset($_SESSION['fname']) && isset($_SESSION['lname']) ) {

      echo "<div style='text-align:center; margin-top:100px;'>
     <h2 style='color:red; text-align:center;'> Access Denied. You do not have permission.</h2>
        <a href='index.html' style='color:blue; text-decoration:none;'>🔙 Go Back to Login Page</a>
      </div>";
exit; }
require 'dbconn.php';
include 'navbar.php';