<?php
    require_once('../mysqli_connect.php');
    $id = addlashes($_REQUEST['ID']);
    $image = mysql_query("SELECT Photo FROM student WHERE S_ID = $id");
    header("Content-type: image/jpeg");
    echo $image;
?>
