
<?php
session_start();
$dbname;
    $gname = $_SESSION["gname"];
    $dbname =trim($_SESSION["dbname"]);
    $dbname = "forum".$dbname;
    $id=trim($_SESSION["id"]);
if(isset($_POST['submit']))
{

    $t_name = @$_POST['topic'];
    $content = @$_POST['content'];
    $date = date("y-m-d");
    $n = "";
     // echo $t_name ." ".$content." ".$date." ".$dbname." ".$id;

    require_once('../mysqli_connect.php');
    $query = "INSERT INTO $dbname (id,topic,creator,replies,content,date,view) VALUES (?,?,?,?,?,?,?)";

    GLOBAL $dbc;
    $stmt = mysqli_prepare($dbc, $query);

    mysqli_stmt_bind_param($stmt, "sssssss", $n,$t_name,$id,$n,$content,$date,$n);

    mysqli_stmt_execute($stmt);

    $affected_rows = mysqli_stmt_affected_rows($stmt);



if( $affected_rows)
echo " ";
else
mysqli_error($dbc);
echo "<script> window.location.replace('http://localhost:1234/forum.php')</script>";

}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
     resize: none;
    box-sizing: border-box;
}


 body{
         background-image: url("a1.jpg"); background-size: cover;
     background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center bottom;
        }

.row::after {
    content: "";
    clear: both;
    display: block;
     resize: none;
}
[class*="col-"] {
    float: left;
    padding: 15px;
}
.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}
html {
    font-family: "Lucida Sans", sans-serif;
}
.header {
    background-color: #9933cc;
    color: #ffffff;
    padding: 15px;
}
.menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
.menu li {
    padding: 8px;
    margin-bottom: 7px;
    background-color :#33b5e5;
    color: #ffffff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
.menu li:hover {
    background-color: #0099cc;
}

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
</head><body>
<center>
<b>Create a post</b>
</br>
</br>
<form action = "post.php" method="POST">
<b>Topic Name :</b> <br/><input type="text" name="topic" style= "width : 700px;"></br><br/>
<b>Content :</b> <br/>

  <textarea name="content"></textarea>
  </br>
  <input type="submit" name="submit" value="POST">
</form>

</center>

</body>
</html>


