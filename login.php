<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="./style.css"/>
</head>
<body>

<div class="sitename"><a href="./overview.php"><h1>TaskForce</h1></a></div>
<!-- <div class="topnav">
  <a class= "active" href="./overview.php">Home</a>
  <a href="./mainform.php">Assign Tasks</a>
  <a href="#logout.php">Log Out</a>
  <a href="#about">About</a>
</div> -->







<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location:./overview.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
<div class="c">
     <form class="form" method="post" name="login">
     <p id="rcorner" >
        <h1 class="login-title">Login</h1>
        <p><input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/></p>
        <p><input type="password" class="login-input" name="password" placeholder="Password"/></p>
        <input type="submit" value="Login" name="submit" class="login-button"/>     <a href="passwordreset.php">Forgot Password?</a>
        <p class="link">Dont have an account?<a href="registration.php">Sign up</a></p>
  </form>
 
  </div>
<?php
    }
?>
</body>
</html>
