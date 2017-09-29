<?php

$is_true = 0 ;
$ID=0;
$gname;
$course;
$req[0]="";
$req_sid[0]="";
$group[0]="";
$crs[0]="";
$batch[0]="";
$mentor="";
$dbname;
if(isset($_GET['dbname']) && isset($_GET['groupname']) && isset($_GET['sid']) )
{

    $ID = $_GET['sid'];
    $gname = $_GET['groupname'];
    $i = 0;

    $fname = $ID . ".txt";
    $myfile = fopen($fname , "r");
    while(!feof($myfile))
    {
        $str = fgets($myfile);
        $str = trim($str);
        if((strcmp($str,$gname))==0)
        {
          $dbname = fgets($myfile);
          break;
        }
    }
    fclose($myfile);
    for(;$i < strlen($dbname); $i++){

        if(!($dbname[$i] >= "a" && $dbname[$i] <="z" ))
        {
            $mentor = $mentor . $dbname[$i];
        }
    }

    if($ID == $mentor)
        $mentor = "You are the mentor of this group\n";
    else{
        require_once('../mysqli_connect.php');
        $query = "SELECT Name  FROM mentor WHERE M_ID = $mentor";
         $response = @mysqli_query($dbc, $query);

        if($response)
        {
            $row=mysqli_fetch_array($response);
            $mentor = $row['Name'];

        }
    }
}

?>



<!DOCTYPE html>
<html>
<head>
<?php include("groupwindow.php"); ?>
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

<div class="header">
<h1>Ask , Answer , Explore !!</h1>
</div>

<div class="row">

<div class="col-3 menu">
<ul>


<li>The Flight</li>
<li>The City</li>
<li>The Island</li>
<li>The Food</li>
</ul>
</div>

<div class="col-9">

<p><b>Make a question</b></p>

<form>
  <textarea style="  width: 100%;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;" id="pques" name="pques"></textarea>
  </br>
  <input type="submit" value="POST">
</form>



<h1>The City</h1>
<p>Chania is the capital of the Chania region on the island of Crete. The city can be divided in two parts, the old town and the modern city.</p>
<p>Resize the browser window to see how the content respond to the resizing.</p>
</div>

</div>
</body>
</html>


