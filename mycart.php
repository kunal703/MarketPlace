<html>
<head>

  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MarketPlace</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<?php
  ini_set('mysql.connect_timeout', 300);
  ini_set('default_socket_timeout', 300);
  error_reporting(0);
?>

<?php
session_start();

require "dbconn.php";
require "navbar.php";

$cname = $_SESSION['userSession'];
//echo' <h3> Hi '.$cname.' </h3> ';
//echo("$keyword");



$sqlquery = "select * from purchase where cname = '$cname'";
$result = $conn->query($sqlquery);
$count = $result->num_rows;
if($count==0)
{
  echo'<div class="alert alert-dismissible alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  Cart is Empty!!
  </div>';
}

while($row = mysqli_fetch_array($result))                     // Display all images
{
    echo '<div class="container">
        <div class="row">
          <div class="span12">
            <div class="row">
              <div class="span8">
                <h4><strong>'.$row[1].'</strong></h4>
                <h5>Puttime: '.$row[2].'</h5>
                <h5>Quantity: '.$row[3].'</h5>
                <h5>Purchase price: '.$row[4].'</h5>
                <h5>Order Status: '.$row[5].'</h5>
              </div>
            </div>
            <div class="row">
              <div class="span10">      
               <hr>
                  ';

}
?>


<body>





</body>
</html>