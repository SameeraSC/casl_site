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


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = trim($_POST['fullname']);
    $contact = trim($_POST['contact']);
    $email = trim($_POST['email']);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = trim($_POST['address']);

    // Basic validation
    if (!empty($fullname) && !empty($contact) && !empty($gender) && !empty($dob)) {
        
        $sql = "INSERT INTO members (fullname, contact, email, gender, dob, address)
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $fullname, $contact, $email, $gender, $dob, $address);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Member registered successfully!');</script>";
        } else {
            echo "<script>alert('❌ Error: " . $stmt->error . "');</script>";
        }

    } else {
        echo "<script>alert('❗ Please fill in all required fields.');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Church Member Registration</title>
  <style>
    body {
      background: #f5f7fa;
      font-family: Arial, sans-serif;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: left;
      padding: 30px;
    }

    

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;

      border-radius: 20px;
      font-size: 14px;
    }

    input[type="submit"] {
      background-color: #438ef0ff;
      font-size: 14px;
      font-weight: bold;
      color: white;
      border: none;
      cursor: pointer;
      transition: background 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #023ca8ff;
    }

    label {
      font-weight: bold;
      font-size: 13px;
      margin-top: 5px;
      display: block;
    }

    .form-group {
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

  <form class="form-box" method="post" action="register_member.php">
    <h2>Register Member</h2>

    <div class="form-group">
      <label for="fullname">Full Name</label>
      <input type="text" name="fullname" id="fullname" required>
    </div>

    <div class="form-group">
      <label for="contact">Contact Number</label>
      <input type="text" name="contact" id="contact" required>
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" name="email" id="email">
    </div>

    <div class="form-group">
      <label for="gender">Gender</label>
      <select name="gender" id="gender" required>
        <option value="">-- Select Gender --</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
       \
      </select>
    </div>

    <div class="form-group">
      <label for="dob">Date of Birth</label>
      <input type="date" name="dob" id="dob" required>
    </div>

    <div class="form-group">
      <label for="address">Home Address</label>
      <textarea name="address" id="address" rows="3"></textarea>
    </div>

    <input type="submit" name="register" value="Register">
  </form>

</body>
</html>
