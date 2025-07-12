<?php
session_start();
if(!isset($_SESSION['userid']) || ($_SESSION['type']!=="admin")){
   echo "<div style='text-align:center; margin-top:100px;'>
        <h2 style='color:red; text-align:center;'> Access Denied. You do not have permission.</h2>
         <a href='index.html' style='color:blue; text-decoration:none;'>🔙 Go Back to Login Page</a>
      </div>";
exit;

}


require 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (
        !empty(trim($_POST['fname'])) &&
        !empty(trim($_POST['lname'])) &&
        !empty(trim($_POST['userid'])) &&
        !empty(trim($_POST['password'])) &&
        !empty(trim($_POST['type']))
    ) {
       
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $userid = $_POST['userid'];
        $password = $_POST['password'];
        $type = $_POST['type'];

        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (userid, fname, lname, password, type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $userid, $fname, $lname, $hashedpassword, $type);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>✅ Registration successful!</p>";
        } else {
            if ($conn->errno === 1062) {
                echo "<p style='color:red;'>❌ Username already exists.</p>";
            } else {
                echo "<p style='color:red;'>❌ Error: " . $stmt->error . "</p>";
            }
        }
   
} } else {
        echo "<p style='color:red;'>❗ Please fill in all required fields.</p>";
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
    <form method="post" action="adduser.php">
        <input type="text" name="fname" id="fname" placeholder="First name" required><br>
        <input type="text" name="lname" id="lname" placeholder="Last name"required><br>
        <input type="text" name="userid" id="userid" placeholder="User Name"required><br>
        <input type="password" name="password" id="password" placeholder="Password"required><br>
            <select name="type" id="type"required>
              <option value="">Select the Role</option>
                <option value="pastor">Pastor</option>
                <option value="admin">Admin</option>
                <option value="ass_admin">Assistant Admin</option>
                <option value="res_manager">Resource Manager</option>
                <option value="doc_staff">Document Staff</option>
                <option value="data_entry">Data Entry Staff</option>
                <option value="Guest">Guest</option>
            </select><br>
        <input type="submit" name="submit" value="submit" >
        </form>
        </div>    
    </body>
    </html>