<?php
  ini_set('mysql.connect_timeout', 300);
  ini_set('default_socket_timeout', 300);
  error_reporting(0);
?>
<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MarketPace</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
<body>
  <br>
  <br>
  <form method="post" class="form-horizontal">
    <fieldset>
      <div class="form-group">
        <label for="inputEmail" class="col-lg-2 control-label">Customer name: </label>
        <div class="col-lg-3">
          <input type="text" class="form-control" name="cname" placeholder="Customer name">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword" class="col-lg-2 control-label">Keyword:  </label>
        <div class="col-lg-3">
          <input type="text" class="form-control" name="keyword" placeholder="Keyword">
        </div>
      </div>
      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="submit" class="btn btn-primary" name="btnlogin">Submit</button>
        </div>
      </div>
    </fieldset>
  </form>

<?php

      session_start();                    // Session start
      require 'dbconn.php';                 // Establish connection to database

      /*if(isset($_SESSION['userSession']) != "")       // To keep user signed in if a new tab is openend
      {
        header("Location: timeline.php");         // Redirect the page to Timeline 
        exit;
      }*/
      
      if(isset($_POST['btnlogin']))                                 // Login button activated
      {
        $name = strip_tags($_POST['cname']);
        $keyword = strip_tags($_POST['keyword']);

        $name = $conn->real_escape_string($name);
        $keyword = $conn->real_escape_string($keyword);

        $sqlquery=$conn->query("select cname from Customer where cname='$name'");   // Validate user from users
        $row = $sqlquery->fetch_array();                              // Store result in an array
        $count = $sqlquery->num_rows;                               // Count the number of rows

        if($count==1)                    // Validate cname in database with entered field
        {
          $_SESSION['userSession'] = $name;  
          $_SESSION['keyword'] = $keyword; // To access the username in other files we pass it in session variable
          header("Location: home.php");
          echo("hi");
        }
        else
        {
          echo '<div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Invalid cname 
              </div>';
        }
      }
      
    ?>
</body>
</html>