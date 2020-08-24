<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>TaskForce</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>

<div class="sitename"><a href="./overview.php"><h1>TaskForce</h1></a></div>
<div class="topnav">
  <a href="./overview.php">Home</a>
  <a class="active" href="./mainform.php">Assign Tasks</a>
  <a href="#logout.php">Log Out</a>
  <a href="#about">About</a>
</div>


<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['tname'])) {
        // removes backslashes
        $name = stripslashes($_REQUEST['tname']);
        //escapes special characters in a string
        $name = mysqli_real_escape_string($con, $name);
        $task    = stripslashes($_REQUEST['task']);
        $d_date  = $_REQUEST['ddate'];
        $c_date = date("Y-m-d");
        $query    = "INSERT into `taskee` (taskee_name, task ,asi_date,due_date)
                     VALUES ('$name', '$task', '$c_date', '$d_date')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'><a href='overview.php'>overview page</a> </p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to  again.</p>
                  </div>";
            echo $name;echo"<br>";
            echo $task;echo"<br>";
            echo $d_date;echo"<br>";
            echo $c_date;echo"<br>";
        }
    } else {
?>

<div class="cent">
    <form action="" method="post">
        <h1>TaskForce</h1>
        <p>Name:<input name="tname" placeholder="Enter name" required /></p>
        <p><label for="task">Task Description:</label></p>
        <p><textarea id="task" name="task" rows="5" cols="50">Enter Task Description</textarea></p>
        <label for="ddate">Deadline:</label>
        <input type="date" id="ddate" name="ddate">
        <input type="submit" name="submit" value="Assign">
        <!-- <p><a href="login.php">Click to Login</a></p> -->
    </form>
</div>
<?php
    }
?>

</body>
</html>
