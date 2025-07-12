<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['userid']) && isset($_SESSION['type']) && isset($_SESSION['fname']) && isset($_SESSION['lname']) && ($_SESSION['type']!=="admin")){
   echo "<div style='text-align:center; margin-top:100px;'>
     <h2 style='color:red; text-align:center;'> Access Denied. You do not have permission.</h2>
        <a href='index.html' style='color:blue; text-decoration:none;'>🔙 Go Back to Login Page</a>
      </div>";
exit;

}
require 'dbconn.php';
include 'navbar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (
        !empty(trim($_POST['fname'])) &&
        !empty(trim($_POST['lname'])) &&
        !empty(trim($_POST['userid'])) &&
        !empty(trim($_POST['password'])) &&
        !empty(trim($_POST['type']))
    ) 
    
    {
       
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
   
    } 
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add User</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      margin: 0;
   
    }

    .wrapper {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .form-section {
      
      flex: 1 1 300px;
      margin-top: 30px;
      margin-left:5px;
    
      max-width: 400px;
      background: #fff;
      padding: 40px;

      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .form-section h4 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
      font-size: 20px;
    }

    input[type="text"],
    input[type="password"],
    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 30px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    input[type="submit"] {
      background-color: #007bff;
      color: white;
      padding: 8px 16px;
      font-size: 14px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      float: right;
    }

    input[type="submit"]:hover {
      background-color: #0069d9;
    }

    .form-section::after {
      content: "";
      display: table;
      clear: both;
    }

    .user-list {
      flex: 1 1 300px;
      margin-top:30px;      
      max-width: 500px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .user-card {
      display: flex;
      align-items: center;
      background: white;
      padding: 12px 16px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.08);
    }

    .user-card img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 15px;
      object-fit: cover;
      background: #eee;
    }

    .user-info h5 {
      margin: 0;
      font-size: 15px;
      font-weight: bold;
    }

    .user-info p {
      margin: 2px 0 0 0;
      font-size: 13px;
      color: #555;
    }

    @media (max-width: 800px) {
      .wrapper {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

  <div class="wrapper">
    
    <!-- Add User Form -->
    <div class="form-section">
      <h4>Add User</h4>
      <form method="post" action="adduser.php">
        <input type="text" name="fname" id="fname" placeholder="First name" required>
        <input type="text" name="lname" id="lname" placeholder="Last name" required>
        <input type="text" name="userid" id="userid" placeholder="User Name" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <select name="type" id="type" required>
          <option value="">Select the Role</option>
          <option value="pastor">Pastor</option>
          <option value="admin">Admin</option>
          <option value="ass_admin">Assistant Admin</option>
          <option value="res_manager">Resource Manager</option>
          <option value="doc_staff">Document Staff</option>
          <option value="data_entry">Data Entry Staff</option>
          <option value="Guest">Guest</option>
        </select>
        <input type="submit" name="submit" value="submit">
      </form>
    </div>

    <!-- Current Users List -->
    <div class="user-list">
     
    <?php
        $sql = "SELECT fname, lname, type FROM user ORDER BY userid DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $allRows = $result->fetch_all(MYSQLI_ASSOC);
            
            foreach ($allRows as $row) {
                $fullName = htmlspecialchars($row['fname'] . ' ' . $row['lname']);
                $utype = htmlspecialchars($row['type']);

                echo "
                <div class='user-card'>
                    <img src='uploads/default-avatar.png' alt='Profile'>
                    <div class='user-info'>
                        <h5>{$fullName}</h5>
                        <p>{$utype}</p>
                    </div>
                </div>";
            }
        } else {
            echo "<p>No users found.</p>";
        }
    ?>
    
</div>

</body>
</html>
