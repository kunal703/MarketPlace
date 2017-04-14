
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



<body>
<?php
session_start();

require "dbconn.php";
require "navbar.php";
if($_SESSION['userSession'])
{
$cname = $_SESSION['userSession'];
$keyword = $_SESSION['keyword'];
//echo' <h3> Hi '.$cname.' </h3> ';
//echo("$keyword");
if (isset($_GET['hello'])) 
  {
      $rowid = $_GET['id'];
      //echo "$rowid";
      //echo "$cname";
      $sqlquery = " select pprice from product where pname = '$rowid' and pstatus = 'available'";
      $result = $conn->query($sqlquery);
      $row = mysqli_fetch_array($result);
      $count1 = $result->num_rows;
      if($count1==0)
      {
        echo '<div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Oh snap!</strong> Product currently not available 
              </div>';
      }
      else{

      $sqlquery2 = "select * from purchase where cname = '$cname' and  pname = '$rowid' and status = 'pending'";
      $result2 = $conn->query($sqlquery2);
      $count = $result2->num_rows; 
      //echo "$count"; 
      if($count>0)  
      {
        $sqlquery3 = "update purchase set quantity = quantity+1, puprice = puprice+$row[0], putime = now() where cname = '$cname' and  pname = '$rowid' and status = 'pending' ";
        $conn->query($sqlquery3); 

      }

      else
      {
        
        

        $sqlquery1 = "insert into purchase values('$cname','$rowid',now(),1,$row[0],'pending')";
        $conn->query($sqlquery1); 
      }   

      echo '<div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Great!</strong> Product added to cart successfully </a>.
            </div>';
  }
}

if($keyword)
{
  $sqlquery = "select * from product where pdescription like'%$keyword%' union select * from product where pname like'%$keyword%'";
}
else
{
  $sqlquery = "select * from product";
}
$result = $conn->query($sqlquery);
$count = $result->num_rows;
if($count==0)
{
    echo '<div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
               No Products found for this keyword! 
              </div>';
}

while($row = mysqli_fetch_array($result))                     // Display all images
{
    echo '<div class="container">
        <div class="row">
          <div class="span12">
            <div class="row">
              <div class="span8">
                <a href= "home.php?id='.$row[0].'&hello=true"><h4><strong>'.$row[0].'</strong></h4></a>
                <h5>Description: '.$row[1].'</h5>
                <h5>Price: '.$row[2].'</h5>
                <h5>Status: '.$row[3].'</h5>
              </div>
            </div>
            <div class="row">
              <div class="span10">      
               <hr>
                  ';

}
}
else
{

}
?>





</body>
</html>