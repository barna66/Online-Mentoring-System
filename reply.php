
<?php
session_start();
$dbname;
    $gname = $_SESSION["gname"];
    $dbname =trim($_SESSION["dbname"]);
    $dbname = "replyforum".$dbname;
    $sid=trim($_SESSION["id"]);

        $pid = trim($_SESSION["pid"]);
if(isset($_POST['submit']))
{

    $content = @$_POST['content'];
    $date = date("y-m-d");
    $n = "";
    //  echo " ".$content."*** ".$date." *** ".$dbname." *** ".$sid;

    require_once('../mysqli_connect.php');
    $query = "INSERT INTO $dbname (id,replier,date,content) VALUES (?,?,?,?)";

    GLOBAL $dbc;
    $stmt = mysqli_prepare($dbc, $query);

    mysqli_stmt_bind_param($stmt, "ssss", $pid,$sid,$date,$content);

    mysqli_stmt_execute($stmt);

    $affected_rows = mysqli_stmt_affected_rows($stmt);



if( $affected_rows)
echo "Succesfully inserted\n";
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
</style>
</head><body>
<center>
<b>Thanks for your help</b>
</br>
</br>
<form action = "reply.php" method="POST">
<b>Content :</b> <br/>

  <textarea style="  width: 700px;
    height: 400px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;" name="content"></textarea>
  </br>
  <input type="submit" name="submit" value="POST">
</form>

</center>

</body>
</html>


