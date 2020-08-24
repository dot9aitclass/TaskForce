<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="./style.css"/>
</head>
<body>

<div class="sitename"><a href="./overview.php"><h1>TaskForce</h1></a></div>

<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $query    = "INSERT into authors (author_name, password)
                     VALUES ('$username', '" . md5($password) . "')";
        $result   = mysqli_query($con, $query);
        
        $query = "SELECT author_id FROM `authors` WHERE (author_name='$username')";
        $result= mysqli_query($con, $query);

        while($row = mysqli_fetch_assoc($result)) {
           $auth_id=$row["author_id"];
         }
         $query = "CREATE TABLE IF NOT EXISTS taskee". $auth_id ."(task_id INT NOT NULL AUTO_INCREMENT,task TEXT,taskee_id INT ,asi_date DATE, due_date DATE, PRIMARY KEY (task_id));";
         $result   = mysqli_query($con, $query);

         $query = "CREATE TABLE IF NOT EXISTS members". $auth_id ."(taskee_id INT NOT NULL AUTO_INCREMENT,taskee_name VARCHAR(100), PRIMARY KEY(taskee_id));";
         $result   = mysqli_query($con, $query);

        if ($result) {
            echo "<div class='form'>
                  <h3>Registration Done</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Sign Up</h1>
        <p><input type="text" class="login-input" name="username" placeholder="Username" required /></p>
        <input type="password" class="login-input" name="password" placeholder="Password"><br><br>
        <input type="submit" name="submit" value="Sign up" class="login-button">
        <p >Already have an account?<a href="login.php">Login here.</a></p>
    </form>
<?php
    }
?>
</body>
</html>
