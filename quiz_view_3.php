
<!DOCTYPE html>
<html>
<head>
<title>Practise And Practise</title>
</head>


<body>
<?php
//$gname = $_GET["gname"];
include("groupwindow.php");
 $gname = $_SESSION["groupname"];

$state =  $_SESSION["state"];
if($state==0){

echo "<script> window.location.replace('start.php')</script>";


}
 ?>

<style>
body
{
    background-color: #ccff66;
background-size:cover;
background-repeat:
    no-repeat;
background-position:
    right top;
background-attachment:
    fixed;
}
</style>
<center>
<br/>

<?php echo '<table border = "4px;">';
?>
<tr>
<td>
<span>ID</span>
</td>
<td width = '200px;' style = 'text-align : center;color : black'>Creator</td>
<td width = '200px; ' style = 'text-align :center'>Date</td>

</tr>
</center>
</body>
</html>

<?php


//session_start();
$dbname= "quiz".$_SESSION["dbname"];

if(isset($_GET['dbname']))
{
$gname = $_GET['groupname'];
$_SESSION["gname"]= $gname;
$_SESSION["dbname"]= $_GET['dbname'];
$sid= $_GET['sid'];
$_SESSION["id"] = $sid;
// $dbname = "forum".$_GET['dbname'];
$_SESSION["forum"] = $dbname;
}

require_once('../mysqli_connect.php');
$query = "SELECT * from $dbname";
//echo $dbname;
$response = @mysqli_query($dbc, $query);
if($response)
{
$prev_id=0;
while($row=mysqli_fetch_array($response))
{

$id = $row['id'];
if($id == $prev_id)
{
$prev_id = $id;
continue;
}


$creator = $row['M_ID'];
 //echo $creator;
 $name="";
 $query2 = "SELECT Name from mentor where M_ID = $creator";
 $response2 = @mysqli_query($dbc, $query2);
 if($row2=mysqli_fetch_array($response2))
 {
 $name=$row2['Name'];


 }

 $query2 = "SELECT Name from student where S_ID = $creator";
 $response2 = @mysqli_query($dbc, $query2);
 if($row2=mysqli_fetch_array($response2))
 {
 $name=$row2['Name'];
 }


echo "<tr>";

echo "<td style ='text-align:center'><a href='quiz_dup.php?id=$id'>".$row['topic']."</a></td>";
 echo "<td style ='text-align:center'>".$name."</td>";
 echo "<td style ='text-align:center'>".$row['date']."</td>";
 echo "</tr>";
 $prev_id = $id;
 }
   }


  ?>

