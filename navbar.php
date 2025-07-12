
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

<style>
    body {margin: 0px; padding-top: 50px;}

        ul {font-family: Arial, Helvetica, sans-serif;  
            list-style-type: none;
            flex:wrap;
            padding: 0;
            margin: 0;
            background-color: #363636;
            display: flex;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        li {position: relative;}

        li a {
            font-size: 15px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            display: block;
        }

        li img {
            padding: 4px;
            margin-left: 10px;
            margin-right: 10px;
        }

        .dropdown {
            position: relative; 
            float: left;
            flex:wrap;
            width: auto;
        }

        .dropdown .dropbtn {
            font-size: 15px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
            display: block; 
            width: 100%;
        }

        li a:hover,
        .dropdown:hover .dropbtn {
            background-color: #5a5656;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #dee1e2;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1100;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            white-space: nowrap;
        }

        .dropdown-content a:hover {
            background-color: rgb(255, 251, 251);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }


        .navbar-user-badge {
            font-family: Arial, sans-serif;
            display: inline-block;
            position: fixed;
            top: 5px;
            right: 20px;
            background-color: rgb(0, 162, 255);
            color: #fff;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            line-height: 35px;
            text-align: center;
            font-size: 15px;
            cursor: pointer;
            z-index: 1100;
        }

        .navbar-user-name {
            display: none;
            font-size: 12px;
            padding: 4px;
            background-color: rgb(255, 255, 255);
            color: #5a5656;
            border-radius: 3px;
            white-space: nowrap;
            position: absolute;
            right: 50px;
            top: 50px;
        }

        .navbar-user-badge:hover .navbar-user-name {
            display: block;
        }

        .navbar-user-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .navbar-user-card {
            display: none;
            position: absolute;
            top: 45px;
            right: 0;
            width: 200px;
            background-color: #ffffff;
            color: #5a5656;
            border: 1px solid #ccc;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            padding: 15px;
            border-radius: 5px;
            z-index: 1;
        }

        .navbar-user-badge:hover .navbar-user-card {
            display: block;
        }

        .navbar-user-card-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .navbar-user-info {
            text-align: center;
        }

        .navbar-user-full-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .navbar-user-position {
            font-size: 14px;
            color: #777;
            margin-bottom: 10px;
        }

        .logout-btn {
            display: block;
            width: 100%;
            padding: 8px 0;
            background-color: #5a5656;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #363636;
        }

        /* Media Queries */
        @media screen and (max-width: 768px) {
            ul {
                flex-direction: column;
            }

            li {
                float: none;
                text-align: center;
            }

            .dropdown {
                width: 100%;
                text-align: center;
            }

            .dropdown .dropbtn {
                width: 100%;
                text-align: center;
                padding: 10px 0;
                margin: 0;
            }

            .dropdown-content {
                position: absolute;
                left: 0;
                top: 100%;
                width: 100%;
            }

            .navbar-user-badge {
                top: 10px;
                right: 10px;
                width: 30px;
                height: 30px;
                line-height: 30px;
                font-size: 12px;
            }

            .navbar-user-name {
                right: 40px;
                top: 40px;
            }
        }

        @media screen and (max-width: 480px) {
            li a {
                padding: 10px 12px;
                font-size: 14px;
            }

            .dropdown {
                width: 100%;
            }

            .dropdown .dropbtn {
                font-size: 14px;
                padding: 10px 0;
                margin: 0;
            }
        }

        
</style>
</head>

<body>
   
<ul>
        <li><img src="Menubarlogo.png" alt="logo" style="width:28px;"></li>
         <li><a href="home.php">Home</a></li>
        <li><a href= "Register.php">Register</a></li>
       

         <li class="dropdown">
            <button class="dropbtn">Ministry</button>
            <div class="dropdown-content">
                <a href="#">Outreach</a>
                <a href="#">Events</a>
            </div>
        </li>
        
        <?php       
        if ($_SESSION['type'] == 'admin'|| $_SESSION['type'] == 'pastor') { ?>
         <li class="dropdown">
            <button class="dropbtn">Accounts</button>
                <div class="dropdown-content">
                
                <a href="#">Income</a>
                <a href="#">Expenses</a>
                <a href="#">Payments</a>
               
            
            </div>
         </li>
           
        <li class="dropdown">
            <button class="dropbtn">Admin</button>
            <div class="dropdown-content">
                <a href="adduser.php">Users</a>
             
            </div>
    </li>
        <?php } ?>



   
         <li class="navbar-user-badge">
                <span><?php echo substr($_SESSION['fname'], 0, 1) . substr($_SESSION['lname'], 0, 1); ?></span>
    
            <!-- Hover card -->
                <div class="navbar-user-card">
       
                     <?php $img_path = (!empty($_SESSION['img_path']) && file_exists($_SESSION['img_path']))?
                    $_SESSION['img_path'] :'uploads/default-avatar.png'; ?> 
        
        
                     <img src="<?php echo $img_path; ?>"  alt="User Picture" class="navbar-user-card-image">
            <div class="navbar-user-info">
                    <p class="navbar-user-full-name"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?></p>
                     <p class="navbar-user-position"><?php if (isset($_SESSION['job_title'])) {
                    echo $_SESSION['job_title'];
                     } else { echo 'Job title not set'; } ?></p>
                     <button class="logout-btn" onclick="window.location.href='index.html'">Log Out</button>
            </div>
        </div>
    </li>
</ul> 


</body>

</html>
