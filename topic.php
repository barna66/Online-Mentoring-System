
<!DOCTYPE html>
<html>
<head>
<title> Ask , Answer & Explore... </title>
</head>

<style>
textarea
{   width: 800px;
    height: 200px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
    }
    </style>
<body>
<center>
<br/>
<a href = "post.php?dbname =$dbname&gname=$gname"><button>Post topic</button></a>


<?php


session_start();
$dbname;
$disc=1;
if(isset($_GET['id']))
{
    $sid = $_SESSION["id"];
    $forum=$_SESSION["forum"];
     $id= $_GET['id'];
    $_SESSION["pid"] = $id;

}

 require_once('../mysqli_connect.php');
$query = "SELECT * from $forum where id = $id";
$response = @mysqli_query($dbc, $query);
$name;
if($response)
{
        $query2 = "SELECT Name from student where S_ID = $sid";
    $response2 = @mysqli_query($dbc, $query2);
    if($row2=mysqli_fetch_array($response2))
    {
         $name=$row2['Name'];
    }
    else
    {
        $query2 = "SELECT Name from mentor where M_ID = $sid";
        $response2 = @mysqli_query($dbc, $query2);
        if($row2=mysqli_fetch_array($response2))
        {
            $name=$row2['Name'];
        }
     }
     while($row=mysqli_fetch_array($response))
     {
        echo "<h1>".$row['topic']."</h1>";
         echo "<h5>By <a href='publicWindow.php?ID=$sid&Name=$name'>".$name."</a><br/>Date: ".$row['date']."</h5>";
         echo "<br/><textarea style ='background-color: lightblue;'>".$row['content']."</textarea>";
     }
}
else
    echo "Topic not found.";
?>

<br/></br>
<a href = "reply.php?pid=$id&dbname =$dbname&gname=$gname&disc=$disc"><button>Join Discussion</button></a>

<?php
$rforum = "reply".$forum ;
//echo "</br>".$rforum." ".$id;
$query = "SELECT * from $rforum where id = $id";
$response = @mysqli_query($dbc, $query);
if($response){

         echo "</br></br>All replies : <br>";

 while($row=mysqli_fetch_array($response))
 {
     echo "<br><tr>";
        $r = $row['replier'];
        $n;
        $query2 = "SELECT Name from mentor where M_ID = $r";
        $response2 = @mysqli_query($dbc, $query2);
        if($row2=mysqli_fetch_array($response2))
        {
            $n=$row2['Name'];
        }

        echo "</br>".$n."  ".$row['date']."<br>";

        echo "<textarea style ='text-align:center'>".$row['content']."</textarea>";


 }
}
?>


</center>
</body>
</html>
