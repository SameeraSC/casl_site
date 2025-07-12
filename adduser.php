<?php
session_start();
require 'dbconn.php';

if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['userid'])&& !empty($_POST['password'])&& !empty($_POST['type'])) 
    {

        $fname= $_POST['fname'];
        $lname=$_POST['lname'];
        $userid= $_POST['userid'];
        $password=$_POST['password'];
        $type=$_POST['type'];

        $hashedpassword = password_hash($password , PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (userid,fname,lname,password,type)VALUES(?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss",$userid,$fname,$lname,$hashedpassword,$type );

        $message;
        

        if ($stmt->execute()) {

            echo "Registration successful! You are now logged in as $userid.";
        } else 
        {
             if ($conn->errno === 1062) {
        echo "Username already exists.";
             } else {
        echo "Error: " . $stmt->error;
            }

        }


    } else {

         echo "❗ Please fill in all required fields.";
    }

?>
 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
    
<div class='form'>
<h4> Add User <h4>
<from method="post" action="adduser.php">
    <input type="text" name="fname" id="fname" placeholder="First name"><br>
    <input type="text" name="lname" id="lname" placeholder="Last name"><br>
    <input type="text" name="userid" id="userid" placeholder="User Name"><br>
    <input type="password" name="password" id="password" placeholder="Password"><br>
    <select id="type">

<option value="pastor">Pastor</option>
<option value="admin">Admin</option>
<option value="ass_admin">Assistant Admin</option>
<option value="res_manager">Resource Manager</option>
<option value="doc_staff">Document Staff</option>
<option value="data_staff">Data Enrty Staff</option>
<option value="Guest">Guest</option>
</select>
    <input type="submit" name="submit" value="submit" >
<form>
</div>    
</body>
</html>