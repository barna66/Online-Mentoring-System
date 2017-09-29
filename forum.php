
<!DOCTYPE html>
<html>
<head>
<title> Ask , Answer & Explore... </title>

</head>


<body>
<?php include("groupwindow.php"); ?>

<style>
body{
        background-color: #ccff66;
        background-size:cover;
        background-repeat: no-repeat;
    background-position: right top;
    background-attachment: fixed;
        }
</style>
<center>
<br/>
<a href = "post.php?dbname =$dbname&gname=$gname"><button>Post topic</button></a>
<?php echo '<table border = "4px;">'; ?>
<tr>
    <td>
    <span>ID</span>
    </td>
    <td width = '200px;' style = 'text-align : center ; color : black' >
    Name
    </td>
    <td width = '200px;' style = 'text-align : center ;color : black'>
   View
    </td>
    <td width = '200px;' style = 'text-align : center;color : black''>
    Creator
    </td>
    <td width = '200px;' style = 'text-align : center'>
    Date
    </td>

</tr>
</center>


</body>
</html>

<?php


//session_start();
$dbname;

//if(isset($_GET['dbname']))
//{
    //$gname = $_GET['groupname'];
    $gname =trim($_SESSION["groupname"]);
     $_SESSION["gname"]= $gname;
    //$_SESSION["dbname"]= $_GET['dbname'];
    $sid = $_SESSION["ID"];
    //$_SESSION["id"] = $sid;
    $dbname =trim($_SESSION["dbname"]);
    $dbname = "forum".$dbname;
    $_SESSION["forum"] = $dbname;
//}

 require_once('../mysqli_connect.php');
$query = "SELECT * from $dbname";
$response = @mysqli_query($dbc, $query);
if($response)
{
    while($row=mysqli_fetch_array($response))
    {
        $id = $row['id'];
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td style ='text-align:center'><a href='topic.php?id=$id'>".$row['topic']."</a></td>";
        echo "<td>".$row['view']."</td>";

        $creator = $row['creator'];
        $name;
        $query2 = "SELECT Name from student where S_ID = $creator";
        $response2 = @mysqli_query($dbc, $query2);
        if($row2=mysqli_fetch_array($response2))
        {
             $name=$row2['Name'];
        }

        $query2 = "SELECT Name from mentor where M_ID = $creator";
        $response2 = @mysqli_query($dbc, $query2);
        if($row2=mysqli_fetch_array($response2))
        {
            $name=$row2['Name'];
        }

        echo "<td>".$name."</td>";
        echo "<td>".$row['date']."</td>";
        echo "</tr>";

}   }

?>

