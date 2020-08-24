<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Overview</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>

<div class="sitename"><a href="./overview.php"><h1>TaskForce</h1></a></div>
<div class="topnav">
  <a class= "active" href="./overview.php">Home</a>
  <a href="./mainform.php">Assign Tasks</a>
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
        $c_date = $_REQUEST['adate'];
        if($name=="")
        {if($c_date==""){
        $query    = "SELECT * FROM `taskee` WHERE due_date='$d_date'";
        }
        if($d_date==""){
            $query    = "SELECT * FROM `taskee` WHERE asi_date='$c_date'";
        }
    }
    else{$query    = "SELECT * FROM `taskee` WHERE taskee_name='$name'";}
      
        // $query    = "INSERT into `taskee` (taskee_name, task ,asi_date,due_date)
        //              VALUES ('$name', '$task', '$c_date', '$d_date')";
        // $result   = mysqli_query($con, $query);
        // if ($result) {
        //     echo "<div>
        //           <h3>You are registered successfully.</h3><br/>
        //           <p class='link'><a href='overview.php'>overview page</a> </p>
        //           </div>";
        //  } else {
        //     echo "<div class='form'>
        //           <h3>Required fields are missing.</h3><br/>
        //           <p class='link'>Click here to  again.</p>
        //           </div>";
        //     echo $name;echo"<br>";
        //     echo $task;echo"<br>";
        //     echo $d_date;echo"<br>";
        //     echo $c_date;echo"<br>";
        // }
        $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows==0){echo "<p>No Deadlines for today</p>";}
    else{
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          echo "<p>Name: " . $row["taskee_name"]. "</p> <p>Task:<br>" . "<textarea rows='5' cols='100'>" . $row["task"]. "</textarea></p><p>" ."Date Assigned:". $row["asi_date"]. "</p>"."<p>Deadline:".$row["due_date"]. "</p>";
        }
    }
    } else {
?>

<?php
    require('db.php');
    $d_date  =  date("Y-m-d");
    echo "<h1>Tasks Due Today</h1>";
    $query    = "SELECT * FROM `taskee` WHERE due_date='$d_date'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows==0){echo "<p>No Deadlines for today</p>";}
    else{
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          echo "<p>Name: " . $row["taskee_name"]. "</p> <p>Task:<br>" . "<textarea rows='5' cols='100'>" . $row["task"]. "</textarea></p><p>" ."Date Assigned:". $row["asi_date"]. "</p>"."<p>Deadline:".$row["due_date"]. "</p>";
        }
    }

    echo "<h1>Tasks Assigned Today</h1>";

    $query    = "SELECT * FROM `taskee` WHERE asi_date='$d_date'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows==0){echo "<p>No Tasks assigned today</p>";}
    else{
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          echo "<p>Name: " . $row["taskee_name"]. "</p> <p>Task:<br> " ."<textarea rows='5' cols='100'>". $row["task"]. "</textarea></p><p>" ."Date Assigned:". $row["asi_date"]. "</p>"."<p>Deadline:".$row["due_date"]. "</p>";
        }
    }
    ?>

    <div class="cent">
        <form action="" method="post">
        <p>Name:<input name="tname" placeholder="Enter name"></p>
        <p><label for="asi_date">Task Assigned On:</label>
        <input type="date" id="asi_date" name="adate"></p>
        <p><label for="ddate">Deadline:</label>
        <input type="date" id="ddate" name="ddate"></p>
        <input type="submit" name="submit" value="Filter">
        <!-- <p><a href="login.php">Click to Login</a></p> -->
    </form>
</div>
<?php
    }
?>
</body>
</html>
