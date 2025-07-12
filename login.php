
<?php
session_start();
require 'dbconn.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get user input
    $userid = trim($_POST['userid']);
    $password = $_POST['password'];

    // Check if fields are filled
    if (!empty($userid) && !empty($password)) {

        // Prepare SQL to prevent SQL injection
        $sql = "SELECT * FROM user WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify the hashed password
            if (password_verify($password, $user['password'])) {
                // ✅ Successful login
                $_SESSION['userid'] = $user['userid'];
                $_SESSION['fname'] = $user['fname'];
                $_SESSION['type'] = $user['type'];

                echo "<p style='color:green;'>✅ Login successful. Welcome, {$user['fname']}!</p>";

                // Optional: redirect to home or dashboard
                // header("Location: home.php");
                // exit;

            } else {
                echo "<p style='color:red;'>❌ Incorrect password.</p>";
            }

        } else {
            echo "<p style='color:red;'>❌ User not found.</p>";
        }

    } else {
        echo "<p style='color:red;'>❗ Please fill in both fields.</p>";
    }
}
?>

 








